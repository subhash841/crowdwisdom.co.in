<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Wall_Mod extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function special_character( $string ) {
        $string = str_replace( "'", "&#039;", $string );
        $string = str_replace( '"', '&#039;', $string );
        return $string;
    }

    function get_wall_detail( $inputs ) {
        $id = $inputs[ 'id' ];
        $user_id = $inputs[ 'user_id' ];

        $this -> db -> select( "f.*" );
        $this -> db -> from( "forums f" );
        $this -> db -> where( "f.id = '$id' AND f.is_active = '1'" );
        $result = $this -> db -> get() -> result_array();
        //echo $this -> db -> last_query();

        $result[ 0 ][ 'comments' ] = $this -> get_wall_comments( $id, 0, 3 );

        if ( count( $result[ 0 ][ 'comments' ] ) > 2 ) {
            unset( $result[ 0 ][ 'comments' ][ count( $result[ 0 ][ 'comments' ] ) - 1 ] );
            $result[ 0 ][ 'more_comments' ] = "1";
        } else {
            $result[ 0 ][ 'more_comments' ] = "0";
        }

        $result[ 0 ][ 'user_actions' ] = $this -> get_user_wall_action( $id, $user_id );
        $result[ 0 ][ 'count_actions' ] = $this -> get_action_counts( $id );
        $result[ 0 ][ 'topic_associated' ] = $this -> get_wall_topics( $id );
        return $result;
    }

    function get_wall_topics( $postid ) {
        $this -> db -> select( "ta.topic_id,ta.type, t.topic, t.is_private, t.email_ids" );
        $this -> db -> from( "topic_association ta" );
        $this -> db -> join( "topics t", "ta.topic_id = t.id", "INNER" );
        $this -> db -> where( "ta.post_id = '$postid' AND ta.type = 'Wall'" );
        $result = $this -> db -> get() -> result_array();

        return $result;
    }

    function add_update_wall( $inputs ) {

        $user_id = $inputs[ 'user_id' ];
        $wall_id = $inputs[ 'wallid' ];
        $title = $this -> special_character( $inputs[ 'title' ] );
        $topics = $inputs[ 'topics' ];
        $uploaded_filename = $inputs[ 'uploaded_filename' ];

        $preview_json = $inputs[ 'json_data' ];
        $is_topic_change = $inputs[ 'is_topic_change' ];

        if ( $wall_id == 0 ) {

            $insert_array = array (
                "user_id" => $user_id,
                "title" => $title,
                "image" => $uploaded_filename
            );
            if ( $preview_json != "" ) {
                //$insert_array[ 'data' ] = $preview_json;
            }
            $this -> db -> insert( "forums", $insert_array );
            $last_wall_id = $this -> db -> insert_id();

            //Wall topics addition
            foreach ( $topics as $tp ) {
                $topics_insert[] = array (
                    "topic_id" => $tp,
                    "post_id" => $last_wall_id,
                    "title" => $title,
                    "description" => "",
                    "type" => "Wall"
                );
            }
            $this -> db -> insert_batch( 'topic_association', $topics_insert );
            return TRUE;
        } else {
            $update_array = array (
                "title" => $title,
                "image" => $uploaded_filename
            );

            $this -> db -> where( array ( "id" => $wall_id, "user_id" => $user_id ) );
            $this -> db -> update( "forums", $update_array );

            if ( $is_topic_change != "0" ) {
                //delete all the existing Topics of paricular question
                $this -> db -> where( "post_id = '$wall_id' AND type = 'Wall'" );
                $this -> db -> delete( "topic_association" );

                //Question topics update
                foreach ( $topics as $tp ) {
                    $topics_insert[] = array (
                        "topic_id" => $tp,
                        "post_id" => $wall_id,
                        "title" => $title,
                        "description" => "",
                        "type" => "Wall"
                    );
                }
                $this -> db -> insert_batch( 'topic_association', $topics_insert );
            }
            return TRUE;
        }
    }

    function get_wall_comments( $id, $offset = 0, $limit = 10 ) {

        $this -> db -> select( "fcmt.*, fcmt.id as comment_id, u.alise as alias" );
        $this -> db -> from( 'forum_comments fcmt' );
        $this -> db -> where_in( 'fcmt.forum_id', $id );
        $this -> db -> where( 'fcmt.is_active', 1 );
        $this -> db -> join( 'users u', 'u.id=fcmt.user_id' );
        $this -> db -> offset( $offset );
        $this -> db -> limit( $limit );
        $this -> db -> order_by( "fcmt.id DESC" );
        $result = $this -> db -> get() -> result_array();

        return $result;
    }

    function get_user_wall_action( $id, $user_id ) {
        $this -> db -> select( "fa.*" );
        $this -> db -> from( "forum_action fa" );
        $this -> db -> where( "fa.forum_id = '$id' AND fa.user_id = '$user_id'" );
        $result = $this -> db -> get() -> result_array();
        return $result;
    }

    function get_action_counts( $id ) {
        $this -> db -> select( "fa.*" );
        $this -> db -> from( "forum_action fa" );
        $this -> db -> where( "fa.forum_id = '$id'" );
        $result = $this -> db -> count_all_results();
        //$result = $this -> db -> get() -> result_array();

        $this -> db -> select( "fa.*" );
        $this -> db -> from( "forum_action fa" );
        $this -> db -> where( "fa.forum_id = '$id' AND fa.likes = '1'" );
        $resultlikes = $this -> db -> count_all_results();

        $this -> db -> select( "fa.*" );
        $this -> db -> from( "forum_action fa" );
        $this -> db -> where( "fa.forum_id = '$id' AND fa.dislikes = '1'" );
        $resultdislikes = $this -> db -> count_all_results();

        $this -> db -> select( "fa.*" );
        $this -> db -> from( "forum_action fa" );
        $this -> db -> where( "fa.forum_id = '$id' AND fa.neutral = '1'" );
        $resultneutral = $this -> db -> count_all_results();

        return array ( array ( "total_counts" => $result, "total_likes" => $resultlikes, "total_dislikes" => $resultdislikes, "total_neutral" => $resultneutral ) );
    }

    function add_comment_mod( $inputs ) {
        $id = $inputs[ 'id' ];
        $comment_id = $inputs[ 'comment_id' ];
        $wall_comment = $inputs[ 'comment' ];
        $user_id = $inputs[ 'user_id' ];

        $data = array (
            "forum_id" => $id,
            "user_id" => $user_id,
            "comment" => $wall_comment,
            "is_active" => 1,
            "created_date" => date( 'Y-m-d H:i:s' )
        );

        if ( $comment_id == 0 ) {
            $this -> db -> insert( 'forum_comments', $data );
            $last_comment_id = $this -> db -> insert_id();

            /* Send push notification */
            $owner_id = $this -> get_created_by_id( $id );
            if ( $owner_id != $user_id ) {
                $fields = array (
                    "post_id" => $id,
                    "title" => "commented on your discssion",
                    "text" => $wall_comment,
                    "type" => "Discussion",
                    "subtype" => "Comment",
                    "user_id" => $user_id,
                    "friend_id" => $owner_id,
                    "image" => ""
                );
                $this -> notification -> get_ids_and_fields( $owner_id, $fields, 0 );
            }
            /* Send push notification */
            return $last_comment_id;
        } else {
            $update_data = array (
                "comment" => $wall_comment
            );
            $this -> db -> where( array ( 'id' => $comment_id, "forum_id" => $id, "user_id" => $user_id ) );
            $this -> db -> update( 'forum_comments', $update_data );
            return $comment_id;
        }
    }

    function get_comment_by_id( $id ) {
        $this -> db -> select( "*, id as comment_id" );
        $this -> db -> from( 'forum_comments' );
        $this -> db -> where( 'id', $id );
        $this -> db -> where( 'is_active', 1 );
        $result = $this -> db -> get() -> row_array();
        return $result;
    }

    function add_comment_reply_mod( $inputs ) {
        $wallid = $inputs[ 'id' ];
        $comment_id = $inputs[ 'comment_id' ];
        $user_id = $inputs[ 'user_id' ];
        $wall_comment_reply = $inputs[ 'comment_reply' ];
        $comment_reply_id = $inputs[ 'comment_reply_id' ];

        $data = array (
            "forum_id" => $wallid,
            "comment_id" => $comment_id,
            "user_id" => $user_id,
            "reply" => $wall_comment_reply,
            "is_active" => 1,
            "created_date" => date( 'Y-m-d H:i:s' )
        );

        if ( $comment_reply_id == 0 ) {
            $this -> db -> insert( 'forum_comment_reply', $data );
            $last_reply_id = $this -> db -> insert_id();

            /* Send push notification */
            $reply_data = $this -> get_comment_created_by_id( $comment_id );
            $comment_owner_id = $reply_data[ 0 ][ 'user_id' ];
            $comment = $reply_data[ 0 ][ 'comment' ];
            $alias = $reply_data[ 0 ][ 'alias' ];

            if ( $comment_owner_id != $user_id ) { //checking own comment
                $fields = array (
                    "post_id" => $wallid,
                    "title" => "Reply on comment",
                    "text" => $wall_comment_reply,
                    "type" => "Discussion",
                    "subtype" => "Reply",
                    "user_id" => $user_id,
                    "friend_id" => $comment_owner_id,
                    "image" => "",
                    "comment_id" => $comment_id,
                    "comment" => $comment,
                    "alias" => $alias
                );
                $this -> notification -> get_ids_and_fields( $comment_owner_id, $fields, 0 );
            }
            /* Send push notification */

            return $last_reply_id;
        } else {
            $update_data = array (
                "reply" => $wall_comment_reply
            );
            $this -> db -> where( array ( 'id' => $comment_reply_id, "forum_id" => $wallid, "comment_id" => $comment_id, "user_id" => $user_id ) );
            $this -> db -> update( 'forum_comment_reply', $update_data );
            return $comment_reply_id;
        }
    }

    function get_comment_reply_by_id( $id ) {
        $this -> db -> select( "fcr.*, fcr.id as comment_reply_id, fcr.id as reply_id, u.alise as alias" );
        $this -> db -> from( 'forum_comment_reply fcr' );
        $this -> db -> join( "users u", "u.id = fcr.user_id", "INNER" );
        $this -> db -> where( 'fcr.id', $id );
        $result = $this -> db -> get() -> row_array();
        return $result;
    }

    function delete_comment_mod( $uid, $id, $comment_id ) {
        $this -> db -> where( array ( "id" => $comment_id, "user_id" => $uid, "forum_id" => $id ) );
        $this -> db -> update( "forum_comments", array ( "is_active" => "0" ) );
        return array ( "status" => TRUE, "message" => "Comment deleted successfully", "data" => ( object ) array () );
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

        $this -> db -> select( "fc.*, fc.id as comment_id, u.alise as alias" );
        $this -> db -> from( "forum_comments fc" );
        $this -> db -> join( "users u", "u.id = fc.user_id", "INNER" );
        $this -> db -> where( "fc.forum_id = '$id'" );
        $this -> db -> where( "fc.is_active = '1'" );
        $this -> db -> offset( $offset );
        $this -> db -> limit( $limit );
        $this -> db -> order_by( "fc.id DESC" );
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

    function get_comment_replies_mod( $inputs, $limit = 6 ) {
        $id = $inputs[ 'id' ]; //this is poll_id 
        $comment_id = $inputs[ 'comment_id' ];
        $offset = $inputs[ 'offset' ];

        $this -> db -> select( "fcr.*,fcr.id as reply_id,u.alise as alias" );
        $this -> db -> from( "forum_comment_reply fcr" );
        $this -> db -> join( "users u", "u.id = fcr.user_id", "INNER" );
        $this -> db -> where( "fcr.forum_id = '$id' AND fcr.comment_id = '$comment_id' AND fcr.is_active = '1'" );
        $this -> db -> order_by( "fcr.id DESC" );
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

    /* Like, Dislike and Neutral Mod functions */

    function add_like_mod( $inputs ) {
        $wallid = $inputs[ 'id' ];
        $user_id = $inputs[ 'user_id' ];
        $action_type = $inputs[ 'type' ];
        /* $wall_like = $inputs[ 'like' ];
          $wall_dislike = $inputs[ 'dislike' ];
          $wall_neutral = $inputs[ 'neutral' ]; */

        $wall_like = $wall_dislike = $wall_neutral = 0;

        if ( $action_type == "like" ) {
            $wall_like = 1;
        } elseif ( $action_type == "dislike" ) {
            $wall_dislike = 1;
        } elseif ( $action_type == "neutral" ) {
            $wall_neutral = 1;
        }

        $data = array (
            "forum_id" => $wallid,
            "user_id" => $user_id,
            "likes" => $wall_like,
            "dislikes" => $wall_dislike,
            "neutral" => $wall_neutral,
            "created_date" => date( 'Y-m-d H:i:s' )
        );

        $this -> db -> where( 'forum_id', $wallid );
        $this -> db -> where( 'user_id', $user_id );
        $query = $this -> db -> get( 'forum_action' );
        if ( $query -> num_rows() == 0 ) {
            $this -> db -> insert( 'forum_action', $data );
            return $this -> db -> insert_id();
        } else {
            $update_data = array (
                "likes" => $wall_like,
                "dislikes" => $wall_dislike,
                "neutral" => $wall_neutral
            );
            $this -> db -> where( array ( "forum_id" => $wallid, "user_id" => $user_id ) );
            $this -> db -> update( 'forum_action', $update_data );
            return $wallid;
        }

        /* if ( $comment_reply_id == 0 ) {
          $this -> db -> insert( 'forum_comment_reply', $data );
          return $this -> db -> insert_id();
          } else {
          $update_data = array (
          "reply" => $wall_comment_reply
          );
          $this -> db -> where( array ( 'id' => $comment_reply_id, "forum_id" => $wallid, "comment_id" => $comment_id, "user_id" => $user_id ) );
          $this -> db -> update( 'forum_comment_reply', $update_data );
          return $comment_id;
          } */
    }

    function get_trending_discussions( $inputs, $limit ) {

        $topic_id = $inputs[ 'topic_id' ];
        $user_id = $inputs[ 'user_id' ];
        $offset = $inputs[ 'offset' ];
        $relatedTopics = $inputs[ 'relatedTopics' ];

        $followed_blog_ids = "";
        $last24hourids = "";

        /* Get Wall raised in last 24 hour - START */
        $this -> db -> select( "f.id" );
        $this -> db -> from( "forums f" );
        $this -> db -> where( "(f.created_date) >= (now() - INTERVAL 24 hour) AND f.is_active = '1'" );
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
        $this -> db -> select( "fa.forum_id, sum(fa.likes + fa.dislikes + fa.neutral) as total_response" );
        $this -> db -> from( "forum_action fa" );
        $this -> db -> where( "fa.modified_date >= (now() - INTERVAL 24 hour)" );
        $this -> db -> group_by( "fa.forum_id" );
        $this -> db -> order_by( "total_response DESC, fa.id DESC" );
        $likes_responses = $this -> db -> get() -> result_array();

        $this -> db -> select( "fc.forum_id, COUNT(1) as total_response" );
        $this -> db -> from( "forum_comments fc" );
        $this -> db -> where( "fc.created_date >= (now() - INTERVAL 24 hour) AND fc.is_active = '1'" );
        $this -> db -> group_by( "fc.forum_id" );
        $this -> db -> order_by( "total_response DESC, fc.id DESC" );
        $comment_responses = $this -> db -> get() -> result_array();

        if ( ! empty( $likes_responses ) && ! empty( $comment_responses ) ) { // likes and comments in last 24 hours
            foreach ( $likes_responses as $lkey => $likes ) {
                $engagement_ids[ $lkey ][ 'forum_id' ] = $likes[ 'forum_id' ];
                $engagement_ids[ $lkey ][ 'total_response' ] = $likes[ 'total_response' ];

                foreach ( $comment_responses as $ckey => $comments ) {
                    if ( $likes_responses[ $lkey ][ 'forum_id' ] == $comments[ 'forum_id' ] ) {
                        $engagement_ids[ $lkey ][ 'total_response' ] = $likes[ 'total_response' ] + $comments[ 'total_response' ];
                    } else {
                        array_push( $engagement_ids, $comments );
                    }
                }
            }
        } else if ( ! empty( $likes_responses ) && empty( $comment_responses ) ) { // only likes in last 24 hours
            foreach ( $likes_responses as $lkey => $likes ) {
                $engagement_ids[ $lkey ][ 'forum_id' ] = $likes[ 'forum_id' ];
                $engagement_ids[ $lkey ][ 'total_response' ] = $likes[ 'total_response' ];
            }
        } else if ( empty( $likes_responses ) && ! empty( $comment_responses ) ) { // only comments in last 24 hours
            foreach ( $comment_responses as $ckey => $comments ) {
                $engagement_ids[ $ckey ][ 'forum_id' ] = $comments[ 'forum_id' ];
                $engagement_ids[ $ckey ][ 'total_response' ] = $comments[ 'total_response' ];
            }
        } else { //there is no engagement in 24 last hours 
            $engagement_ids = array ();
        }

        $engagement_id_data = "";
        $engagement_order = "";

        if ( ! empty( $engagement_ids ) ) {
            foreach ( $engagement_ids as $engagement_data ) {
                $onlyids[] = $engagement_data[ 'forum_id' ];
                $engagement_id_data .= $engagement_data[ 'forum_id' ] . ",";
            }
            $unique = array_reverse( array_unique( $onlyids ) );
            $engagement_id_data = implode( ',', $unique );
            $engagement_order = "FIELD(f.id, $engagement_id_data) DESC, ";
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
                $this -> db -> select( "f.id" );
                $this -> db -> from( "forums f" );
                $this -> db -> join( "topic_association ta", "ta.post_id = f.id AND ta.type = 'Wall'", "INNER" );
                $this -> db -> where_in( "ta.topic_id", $followed_topic_ids );
                $followed_wall = $this -> db -> get() -> result_array();

                foreach ( $followed_wall as $key => $followd_data ) {
                    $followed_blog_ids .= $followd_data[ 'id' ] . ",";
                }
                $followed_blog_ids = chop( $followed_blog_ids, "," );
            }
        }
        /* Followed Topic Handling - END */

        /* Latest 24 hour raised - START */
        $is_new = "";
        if ( $last24hourids != "" ) {
            $is_new = "FIELD(f.id, $last24hourids) DESC,";
        }
        /* Latest 24 hour raised - END */

        $relatedIds = "";
        $this -> db -> select( "f.id, f.user_id, f.title, f.image, f.total_like as total_likes, f.total_like, f.total_neutral, f.total_dislike, f.total_comments, COALESCE(u.alise, 'Anonymous') as alias" );
        $this -> db -> from( "forums f" );
        $this -> db -> join( "users u", "u.id = f.user_id", "LEFT" );
        if ( $topic_id > 0 ) {
            $this -> db -> join( "topic_association ta", "ta.post_id = f.id AND ta.type = 'Wall' AND ta.topic_id = '$topic_id'", "INNER" );
        } else {
            if ( ! empty( $relatedTopics ) ) {
                foreach ( $relatedTopics as $value ) {
                    $relatedIds .= $value . ",";
                }
                $relatedIds = chop( $relatedIds, "," );
                $this -> db -> join( "topic_association ta", "ta.post_id = f.id AND ta.type = 'Wall' AND ta.topic_id in ($relatedIds)", "INNER" );
            }
        }
        $this -> db -> where( "f.is_active = '1'" );
        if ( $followed_blog_ids != "" ) {
            $this -> db -> where( "f.id in ($followed_blog_ids)" );
        }
        $this -> db -> offset( $offset );
        $this -> db -> limit( $limit );
        $this -> db -> order_by( "$is_new $engagement_order f.id DESC" );
        $this -> db -> group_by( "f.id" );
        $data = $this -> db -> get() -> result_array();

        foreach ( $data as $key => $wall_data ) {
            if ( $wall_data[ 'user_id' ] == "" || $wall_data[ 'user_id' ] == "1" ) {
                $data[ $key ][ 'raised_by_admin' ] = "1";
            } else {
                $data[ $key ][ 'raised_by_admin' ] = "0";
            }
        }

        return array ( "status" => true, "message" => "", "data" => $data );
    }

    function make_deactive_wall( $forumid ) {
        $this -> db -> where( 'id', $forumid );
        $this -> db -> update( 'forums', array ( 'is_active' => 0 ) );
        return array ( "status" => TRUE, "message" => "Deleted successfully" );
    }

    function get_created_by_id( $id ) {

        $this -> db -> select( 'f.user_id' );
        $this -> db -> from( 'forums f' );
        $this -> db -> where( "f.id = '$id'" );
        return $this -> db -> get() -> result_array()[ 0 ][ 'user_id' ];
    }

    function get_comment_created_by_id( $id ) {
        $this -> db -> select( 'fc.user_id, fc.comment, u.alise as alias' );
        $this -> db -> from( 'forum_comments fc' );
        $this -> db -> join( 'users u', "u.id = fc.user_id", "INNER" );
        $this -> db -> where( "fc.id = '$id'" );
        return $this -> db -> get() -> result_array();
    }

}
