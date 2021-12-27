<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FromTheWeb_Mod extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function special_character( $string ) {
        $string = str_replace( "'", "&#039;", $string );
        $string = str_replace( '"', '&#039;', $string );
        return $string;
    }

    function get_trending_article_list( $inputs ) {
        $topic_id = $inputs[ 'topic_id' ];
        $user_id = $inputs[ 'user_id' ];
        $offset = $inputs[ 'offset' ];
        $limit = $inputs[ 'limit' ];
        $relatedTopics = $inputs[ 'relatedTopics' ];

        $followed_blog_ids = "";
        $last24hourids = "";
        $exclude_private_topic_ids = "";

        /* Get Wall raised in last 24 hour - START */
        $this -> db -> select( "w.id" );
        $this -> db -> from( "web w" );
        $this -> db -> where( "(w.created_date) >= (now() - INTERVAL 24 hour) AND w.is_active = '1'" );
        $last24hour_result = $this -> db -> get() -> result_array();

        if ( ! empty( $last24hour_result ) ) {
            foreach ( $last24hour_result as $key => $last24hour_data ) {
                $last24hourids .= $last24hour_data[ 'id' ] . ",";
            }
            $last24hourids = chop( $last24hourids, "," );
        }
        /* Get Wall raised in last 24 hour - END */

        /* Engagement Checking - START */
        $engagement_ids = array ();
        $this -> db -> select( "wa.web_id, sum(wa.likes + wa.dislikes + wa.neutral) as total_response" );
        $this -> db -> from( "web_action wa" );
        $this -> db -> where( "wa.modified_date >= (now() - INTERVAL 24 hour)" );
        $this -> db -> group_by( "wa.web_id" );
        $this -> db -> order_by( "total_response DESC, wa.id DESC" );
        $likes_responses = $this -> db -> get() -> result_array();

        $this -> db -> select( "wc.web_id, COUNT(1) as total_response" );
        $this -> db -> from( "web_comments wc" );
        $this -> db -> where( "wc.created_date >= (now() - INTERVAL 24 hour) AND wc.is_active = '1'" );
        $this -> db -> group_by( "wc.web_id" );
        $this -> db -> order_by( "total_response DESC, wc.id DESC" );
        $comment_responses = $this -> db -> get() -> result_array();

        if ( ! empty( $likes_responses ) && ! empty( $comment_responses ) ) { // likes and comments in last 24 hours
            foreach ( $likes_responses as $lkey => $likes ) {
                $engagement_ids[ $lkey ][ 'web_id' ] = $likes[ 'web_id' ];
                $engagement_ids[ $lkey ][ 'total_response' ] = $likes[ 'total_response' ];

                foreach ( $comment_responses as $ckey => $comments ) {
                    if ( $likes_responses[ $lkey ][ 'web_id' ] == $comments[ 'web_id' ] ) {
                        $engagement_ids[ $lkey ][ 'total_response' ] = $likes[ 'total_response' ] + $comments[ 'total_response' ];
                    } else {
                        array_push( $engagement_ids, $comments );
                    }
                }
            }
        } else if ( ! empty( $likes_responses ) && empty( $comment_responses ) ) { // only likes in last 24 hours
            foreach ( $likes_responses as $lkey => $likes ) {
                $engagement_ids[ $lkey ][ 'web_id' ] = $likes[ 'web_id' ];
                $engagement_ids[ $lkey ][ 'total_response' ] = $likes[ 'total_response' ];
            }
        } else if ( empty( $likes_responses ) && ! empty( $comment_responses ) ) { // only comments in last 24 hours
            foreach ( $comment_responses as $ckey => $comments ) {
                $engagement_ids[ $ckey ][ 'web_id' ] = $comments[ 'web_id' ];
                $engagement_ids[ $ckey ][ 'total_response' ] = $comments[ 'total_response' ];
            }
        } else { //there is no engagement in 24 last hours 
            $engagement_ids = array ();
        }

        $engagement_id_data = "";
        $engagement_order = "";

        if ( ! empty( $engagement_ids ) ) {
            foreach ( $engagement_ids as $engagement_data ) {
                $onlyids[] = $engagement_data[ 'web_id' ];
                $engagement_id_data .= $engagement_data[ 'web_id' ] . ",";
            }
            $unique = array_reverse( array_unique( $onlyids ) );
            $engagement_id_data = implode( ',', $unique );
            $engagement_order = "FIELD(w.id, $engagement_id_data) DESC, ";
        }

        /* Engagement Checking - END */

        /* Followed Topic Handling - START */
        if ( $topic_id == 0 ) {
            $followed_result = get_followed_topics( $user_id );
            $followed_topic_ids = array ();
            foreach ( $followed_result as $key => $users_followed_data ) {
                $followed_topic_ids[] = $users_followed_data[ 'topic_id' ];
            }

            if ( ! empty( $followed_topic_ids ) ) {
                $this -> db -> select( "w.id" );
                $this -> db -> from( "web w" );
                $this -> db -> join( "topic_association ta", "ta.post_id = w.id AND ta.type = 'Web'", "INNER" );
                $this -> db -> where_in( "ta.topic_id", $followed_topic_ids );
                $followed_web = $this -> db -> get() -> result_array();

                foreach ( $followed_web as $key => $followd_data ) {
                    $followed_blog_ids .= $followd_data[ 'id' ] . ",";
                }
                $followed_blog_ids = chop( $followed_blog_ids, "," );
            }
        }
        /* Followed Topic Handling - END */

        /* Latest 24 hour raised - START */
        $is_new = "";
        if ( $last24hourids != "" ) {
            $is_new = "FIELD(w.id, $last24hourids) DESC,";
        }
        /* Latest 24 hour raised - END */

        $sessiondata = $this->session->userdata('data');
        if(!empty($sessiondata)){
            $logged_in_email = $sessiondata['email'];
            $this->db->select("id");
            $this->db->from("topics t");
            $this->db->where("(t.is_private = '0' OR FIND_IN_SET('$logged_in_email',t.email_ids))");
            $accessible_topic_ids_result = $this->db->get()->result_array();

            if(!empty($accessible_topic_ids_result)){
                foreach($accessible_topic_ids_result as $t_ids){
                    $accessible_topic_ids .= $t_ids['id'].",";
                }
                $accessible_topic_ids = chop($accessible_topic_ids, ",");
                $exclude_private_topic_ids = " AND (ta.topic_id = '0' OR ta.topic_id IN($accessible_topic_ids))";
            }
        }
                
        $this -> db -> select( "w.id, w.user_id, w.title as question, w.description, w.image, w.data, w.total_like, w.total_neutral, "
                . "w.total_dislike, (w.total_like + w.total_neutral + w.total_dislike) as total_votes, w.total_comments, "
                . "w.meta_keywords, w.meta_description, w.is_active, w.created_date, w.modified_date" );
        $this -> db -> from( "web w" );
        $this -> db -> join( "users u", "u.id = w.user_id", "LEFT" );
        if ( $topic_id > 0 ) {
            $this -> db -> join( "topic_association ta", "ta.post_id = w.id AND ta.type = 'Web' AND ta.topic_id = '$topic_id'", "INNER" );
        } else if ( ! empty( $relatedTopics ) ) {
            foreach ( $relatedTopics as $value ) {
                $relatedIds .= $value . ",";
            }
            $relatedIds = chop( $relatedIds, "," );
            $this -> db -> join( "topic_association ta", "ta.post_id = w.id AND ta.type = 'Web' AND ta.topic_id in ($relatedIds)", "INNER" );
        } else{
            $this->db->join("topic_association ta","ta.post_id = w.id AND ta.type = 'Web'","INNER");
        }
        
        $this -> db -> where( "w.is_active = '1' $exclude_private_topic_ids" );
        if ( $followed_blog_ids != "" ) {
            //$this -> db -> where( "w.id in ($followed_blog_ids)" );
        }
        $this -> db -> order_by( "$is_new $engagement_order w.id DESC" );
        $this -> db -> group_by( "w.id" );
        $this -> db -> limit( $limit );
        $result = $this -> db -> get() -> result_array();

        foreach ( $result as $key => $fromtheweb ) {
            $result[ $key ][ 'data' ] = json_decode( $fromtheweb[ 'data' ] );

            if ( $fromtheweb[ 'image' ] == "" ) {
                $json_data = json_decode( $fromtheweb[ 'data' ], TRUE );
                $result[ $key ][ 'image' ] = $json_data[ 'img' ];
            } else {
                //$result[ $key ][ 'image' ] = base_url( str_replace( "https://", "", $fromtheweb[ 'image' ] ) );
                $result[ $key ][ 'image' ] = $fromtheweb[ 'image' ];
            }
        }
        return $result;
    }

    function get_web_detail( $inputs ) {
        $id = $inputs[ 'id' ];
        $user_id = $inputs[ 'user_id' ];

        $this -> db -> select( "w.*" );
        $this -> db -> from( "web w" );
        $this -> db -> where( "w.is_active = '1' AND id = '$id'" );
        $result = $this -> db -> get() -> result_array();
        //echo $this -> db -> last_query();

        $result[ 0 ][ 'comments' ] = $this -> get_web_comments( $id, 0, 3 );
        $result[ 0 ][ 'topic_associated' ] = $this -> get_web_topics( $id );

        if ( count( $result[ 0 ][ 'comments' ] ) > 2 ) {
            unset( $result[ 0 ][ 'comments' ][ count( $result[ 0 ][ 'comments' ] ) - 1 ] );
            $result[ 0 ][ 'more_comments' ] = "1";
        } else {
            $result[ 0 ][ 'more_comments' ] = "0";
        }

        $result[ 0 ][ 'user_actions' ] = $this -> get_user_web_action( $id, $user_id );
        $result[ 0 ][ 'count_actions' ] = $this -> get_action_counts( $id );

        return $result;
    }

    function get_web_comments( $id, $offset = 0, $limit = 10 ) {

        $this -> db -> select( "wc.*, wc.id as comment_id, u.alise as alias" );
        $this -> db -> from( 'web_comments wc' );
        $this -> db -> where_in( 'wc.web_id', $id );
        $this -> db -> where( 'wc.is_active', 1 );
        $this -> db -> join( 'users u', 'u.id = wc.user_id' );
        $this -> db -> offset( $offset );
        $this -> db -> limit( $limit );
        $this -> db -> order_by( "wc.id DESC" );
        $result = $this -> db -> get() -> result_array();

        return $result;
    }

    function get_web_topics( $postid ) {
        $this -> db -> select( "ta.topic_id,ta.type, t.topic" );
        $this -> db -> from( "topic_association ta" );
        $this -> db -> join( "topics t", "ta.topic_id = t.id", "INNER" );
        $this -> db -> where( "ta.post_id = '$postid' AND ta.type = 'Web'" );
        $result = $this -> db -> get() -> result_array();

        return $result;
    }

    function add_update_article( $inputs ) {

        $user_id = $inputs[ 'user_id' ];
        $web_id = $inputs[ 'webid' ];
        $title = $this -> special_character( $inputs[ 'title' ] );
        $description = $this -> special_character( $inputs[ 'description' ] );
        $topics = $inputs[ 'topics' ];
        $uploaded_filename = ( ! $inputs[ 'uploaded_filename' ]) ? "" : $inputs[ 'uploaded_filename' ];

        $preview_json = $inputs[ 'json_data' ];
        $is_topic_change = $inputs[ 'is_topic_change' ];

        if ( $web_id == 0 ) {

            $insert_array = array (
                "user_id" => $user_id,
                "title" => $title,
                "description" => $description,
                "image" => $uploaded_filename
            );
            if ( $preview_json != "" ) {
                $insert_array[ 'data' ] = $preview_json;
            }
            $this -> db -> insert( "web", $insert_array );
            $last_web_id = $this -> db -> insert_id();

            //Wall topics addition
            foreach ( $topics as $tp ) {
                $topics_insert[] = array (
                    "topic_id" => $tp,
                    "post_id" => $last_web_id,
                    "title" => $title,
                    "description" => "",
                    "type" => "Web"
                );
            }
            $this -> db -> insert_batch( 'topic_association', $topics_insert );
            return TRUE;
        } else {
            $update_array = array (
                "title" => $title,
                "description" => $description,
                "image" => $uploaded_filename
            );
            if ( $preview_json != "" ) {
                $update_array[ 'data' ] = $preview_json;
            }
            $this -> db -> where( array ( "id" => $web_id, "user_id" => $user_id ) );
            $this -> db -> update( "web", $update_array );

            if ( $is_topic_change != "0" ) {
                //delete all the existing Topics of paricular question
                $this -> db -> where( "post_id = '$web_id' AND type = 'Web'" );
                $this -> db -> delete( "topic_association" );

                //Question topics update
                foreach ( $topics as $tp ) {
                    $topics_insert[] = array (
                        "topic_id" => $tp,
                        "post_id" => $web_id,
                        "title" => $title,
                        "description" => $description,
                        "type" => "Web"
                    );
                }
                $this -> db -> insert_batch( 'topic_association', $topics_insert );
            }
            return TRUE;
        }
    }

    function deactive_web( $web_id ) {
        $this -> db -> where( 'id', $web_id );
        $this -> db -> update( 'web', array ( 'is_active' => 0 ) );
        return array ( "status" => TRUE, "message" => "Deleted successfully" );
    }

    /* Like, Dislike and Neutral Mod functions */

    function add_like_mod( $inputs ) {
        $web_id = $inputs[ 'id' ];
        $user_id = $inputs[ 'user_id' ];
        $action_type = $inputs[ 'type' ];

        $web_like = $web_dislike = $web_neutral = 0;

        if ( $action_type == "like" ) {
            $web_like = 1;
        } elseif ( $action_type == "dislike" ) {
            $web_dislike = 1;
        } elseif ( $action_type == "neutral" ) {
            $web_neutral = 1;
        }

        $data = array (
            "web_id" => $web_id,
            "user_id" => $user_id,
            "likes" => $web_like,
            "dislikes" => $web_dislike,
            "neutral" => $web_neutral
        );

        $this -> db -> where( 'web_id', $web_id );
        $this -> db -> where( 'user_id', $user_id );
        $query = $this -> db -> get( 'web_action' );
        if ( $query -> num_rows() == 0 ) {
            $this -> db -> insert( 'web_action', $data );
            return $this -> db -> insert_id();
        } else {
            $update_data = array (
                "likes" => $web_like,
                "dislikes" => $web_dislike,
                "neutral" => $web_neutral
            );
            $this -> db -> where( array ( "web_id" => $web_id, "user_id" => $user_id ) );
            $this -> db -> update( 'web_action', $update_data );
            return $web_id;
        }
    }

    function add_comment_mod( $inputs ) {
        $id = $inputs[ 'id' ];
        $comment_id = $inputs[ 'comment_id' ];
        $web_comment = $inputs[ 'comment' ];
        $user_id = $inputs[ 'user_id' ];

        $data = array (
            "web_id" => $id,
            "user_id" => $user_id,
            "comment" => $web_comment,
            "is_active" => 1
        );

        if ( $comment_id == 0 ) {
            $this -> db -> insert( 'web_comments', $data );
            return $this -> db -> insert_id();
        } else {
            $update_data = array (
                "comment" => $web_comment
            );
            $this -> db -> where( array ( 'id' => $comment_id, "web_id" => $id, "user_id" => $user_id ) );
            $this -> db -> update( 'web_comments', $update_data );
            return $comment_id;
        }
    }

    function get_comment_by_id( $id ) {
        $this -> db -> select( "wc.*, wc.id as comment_id" );
        $this -> db -> from( 'web_comments wc' );
        $this -> db -> where( 'wc.id', $id );
        $this -> db -> where( 'wc.is_active', 1 );
        $result = $this -> db -> get() -> row_array();
        return $result;
    }

    function delete_comment_mod( $uid, $id, $comment_id ) {
        $this -> db -> where( array ( "id" => $comment_id, "user_id" => $uid, "web_id" => $id ) );
        $this -> db -> update( "web_comments", array ( "is_active" => "0" ) );
        return array ( "status" => TRUE, "message" => "", "data" => "" );
    }

    function get_comment_replies_mod( $inputs, $limit = 6 ) {
        $id = $inputs[ 'id' ]; //this is poll_id 
        $comment_id = $inputs[ 'comment_id' ];
        $offset = $inputs[ 'offset' ];

        $this -> db -> select( "wcr.*, wcr.id as comment_reply_id, wcr.id as reply_id,u.alise as alias" );
        $this -> db -> from( "web_comment_reply wcr" );
        $this -> db -> join( "users u", "u.id = wcr.user_id", "INNER" );
        $this -> db -> where( "wcr.web_id = '$id' AND wcr.comment_id = '$comment_id' AND wcr.is_active = '1'" );
        $this -> db -> order_by( "wcr.id DESC" );
        $this -> db -> offset( $offset );
        $this -> db -> limit( $limit );
        $result = $this -> db -> get() -> result_array();

        $is_available = "0";
        if ( count( $result ) > 5 ) {
            unset( $result[ count( $result ) - 1 ] );
            $is_available = "1";
        } else {
            $is_available = "0";
        }
        return array ( "status" => TRUE, "message" => "", "data" => $result, "is_available" => $is_available );
    }

    function add_comment_reply_mod( $inputs ) {
        $web_id = $inputs[ 'id' ];
        $comment_id = $inputs[ 'comment_id' ];
        $user_id = $inputs[ 'user_id' ];
        $web_comment_reply = $inputs[ 'comment_reply' ];
        $comment_reply_id = $inputs[ 'comment_reply_id' ];

        $data = array (
            "web_id" => $web_id,
            "comment_id" => $comment_id,
            "user_id" => $user_id,
            "reply" => $web_comment_reply,
            "is_active" => 1
        );

        if ( $comment_reply_id == 0 ) {
            $this -> db -> insert( 'web_comment_reply', $data );
            return $this -> db -> insert_id();
        } else {
            $update_data = array (
                "reply" => $web_comment_reply
            );
            $this -> db -> where( array ( 'id' => $comment_reply_id, "web_id" => $web_id, "comment_id" => $comment_id, "user_id" => $user_id ) );
            $this -> db -> update( 'web_comment_reply', $update_data );
            return $comment_reply_id;
        }
    }

    function get_comment_reply_by_id( $id ) {
        $this -> db -> select( "wcr.*, wcr.id as comment_reply_id, wcr.id as reply_id, u.alise as alias" );
        $this -> db -> from( 'web_comment_reply wcr' );
        $this -> db -> join( "users u", "u.id = wcr.user_id", "INNER" );
        $this -> db -> where( 'wcr.id', $id );
        $result = $this -> db -> get() -> row_array();
        return $result;
    }

    function get_user_web_action( $id, $user_id ) {
        $this -> db -> select( "wa.*" );
        $this -> db -> from( "web_action wa" );
        $this -> db -> where( "wa.web_id = '$id' AND wa.user_id = '$user_id'" );
        $result = $this -> db -> get() -> result_array();
        return $result;
    }

    function get_action_counts( $id ) {

        $this -> db -> select( "wa.*, count(1) as total_counts, sum(wa.likes) as total_likes, sum(wa.dislikes) as total_dislikes, sum(wa.neutral) as total_neutral" );
        $this -> db -> from( "web_action wa" );
        $this -> db -> where( "wa.web_id = '$id'" );
        $result = $this -> db -> get() -> result_array();

        return $result;
//                $this -> db -> select( "fa.*" );
//                $this -> db -> from( "forum_action fa" );
//                $this -> db -> where( "fa.forum_id = '$id'" );
//                $result = $this -> db -> count_all_results();
//
//                $this -> db -> select( "fa.*" );
//                $this -> db -> from( "forum_action fa" );
//                $this -> db -> where( "fa.forum_id = '$id' AND fa.likes = '1'" );
//                $resultlikes = $this -> db -> count_all_results();
//
//                $this -> db -> select( "fa.*" );
//                $this -> db -> from( "forum_action fa" );
//                $this -> db -> where( "fa.forum_id = '$id' AND fa.dislikes = '1'" );
//                $resultdislikes = $this -> db -> count_all_results();
//
//                $this -> db -> select( "fa.*" );
//                $this -> db -> from( "forum_action fa" );
//                $this -> db -> where( "fa.forum_id = '$id' AND fa.neutral = '1'" );
//                $resultneutral = $this -> db -> count_all_results();
//
//                return array ( array ( "total_counts" => $result, "total_likes" => $resultlikes, "total_dislikes" => $resultdislikes, "total_neutral" => $resultneutral ) );
    }

    /* delete reply of comment */

    function delete_comment_reply_mod( $inputs ) {
        $uid = $inputs[ 'uid' ];
        $id = $inputs[ 'id' ]; //this is wall_id 
        $comment_id = $inputs[ 'comment_id' ];
        $comment_reply_id = $inputs[ 'comment_reply_id' ];

        $delete_reply_array = array (
            "is_active" => "0"
        );
        $this -> db -> where( array ( "id" => $comment_reply_id, "user_id" => $uid, "forum_id" => $id, "comment_id" => $comment_id ) );
        $this -> db -> update( "forum_comment_reply", $delete_reply_array );
        // echo $this -> db -> last_query();
        return array ( "status" => TRUE, "message" => "Reply deleted successfully", "data" => ( object ) array () );
    }

    function get_more_comments( $inputs, $limit = 6 ) {
        $id = $inputs[ 'id' ];
        $offset = $inputs[ 'offset' ];

        $this -> db -> select( "wc.*, wc.id as comment_id, u.alise as alias" );
        $this -> db -> from( "web_comments wc" );
        $this -> db -> join( "users u", "u.id = wc.user_id", "INNER" );
        $this -> db -> where( "wc.forum_id = '$id'" );
        $this -> db -> where( "wc.is_active = '1'" );
        $this -> db -> offset( $offset );
        $this -> db -> limit( $limit );
        $this -> db -> order_by( "wc.id DESC" );
        $result = $this -> db -> get() -> result_array();

        foreach ( $result as $key => $comments_data ) {
            $result[ $key ][ 'alias' ] = ($comments_data[ 'alias' ] == "") ? "Crowdwisdom" : $comments_data[ 'alias' ];
        }

        $is_available = "0";
        if ( count( $result ) > 5 ) {
            unset( $result[ count( $result ) - 1 ] );
            $is_available = "1";
        } else {
            $is_available = "0";
        }
        return array ( "status" => TRUE, "message" => "", "data" => $result, "is_available" => $is_available );
    }

}
