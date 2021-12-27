<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ApiAskQuestions_Mod extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function special_character( $string ) {
        $string = str_replace( "'", "&#039;", $string );
        $string = str_replace( '"', '&#039;', $string );
        return $string;
    }

    function get_questions_list( $inputs, $limit = 8 ) {
        $offset = $inputs[ 'offset' ];

        $new_limit = ($offset == 0) ? 8 : (($offset >= 7) ? 7 : 7);

        $this -> db -> select( "s.id, s.user_id, s.raised_by_admin, s.question as title, s.description, s.image, s.total_votes, s.total_comments, "
                . "s.is_multiple, s.created_date" );
        $this -> db -> from( "survey s" );
        $this -> db -> where( "s.is_approved = '1' AND s.is_active = '1'" );
        $this -> db -> offset( $offset );
        $this -> db -> limit( $limit );
        $this -> db -> order_by( "s.id DESC" );
        $result = $this -> db -> get() -> result_array();

        /* Checking more data available or not - START */
        $is_available = "0";
        if ( count( $result ) >= 7 ) {
            unset( $result[ count( $result ) - 1 ] );
            $is_available = "1";
        } else {
            $is_available = "0";
        }
        /* Checking more data available or not - END */

        $ids = array ();
        foreach ( $result as $key => $questions_data ) {
            $ids[] = $questions_data[ 'id' ];
            $result[ $key ][ 'topics' ] = array ();
            if ( $questions_data[ 'image' ] == "" ) {
                $result[ $key ][ 'image' ] = base_url( "images/logo/prediction_share_logo.png" );
            }
        }

        /* fetcing Topic associated with it - START */
        if ( ! empty( $ids ) ) {
            $topics_associated = $this -> get_topic_associated_to_questions( $ids );

            foreach ( $topics_associated as $ta_assoc ) {
                foreach ( $result as $key => $questions_data ) {
                    if ( $ta_assoc[ 'post_id' ] == $questions_data[ 'id' ] ) {
                        $result[ $key ][ 'topics' ][] = $ta_assoc[ 'topic_id' ];
                    }
                }
            }
        }
        /* fetcing Topic associated with it - END */

        /* Remove Vote counts of prediction - START */
        $counttoberemoved = $this -> remove_vote_counts( $ids );

        for ( $i = 0; $i < count( $result ); $i ++ ) {
            foreach ( $counttoberemoved as $removeids ) {
                if ( $removeids[ 'poll_id' ] == $result[ $i ][ 'id' ] ) {
                    $revised_total = $result[ $i ][ 'total_votes' ] - $removeids[ 'count' ];
                    $result[ $i ][ 'total_votes' ] = "$revised_total";
                }
            }
        }

        /* Remove Vote counts of prediction - END */

        $extra_param = ( object ) array ( "total" => "0" );
        return array ( "status" => TRUE, "message" => "", "data" => $result, "extra_param" => $extra_param, "is_available" => $is_available );
    }

    /* Topics associated with questions */

    function get_topic_associated_to_questions( $ids ) {
        $this -> db -> select( "ta.*" );
        $this -> db -> from( "topic_association ta" );
        $this -> db -> where_in( "ta.post_id", $ids );
        $this -> db -> where( "ta.type = 'Survey'" );
        $result = $this -> db -> get() -> result_array();
        return $result;
    }

    /* Remove see the results vote count */

    function remove_vote_counts( $id ) {
        $arr = true;

        if ( ! is_array( $id ) ) {
            $arr = false;
            $id = array ( $id );
        }
        $id = implode( ',', $id );
        $query = "select COUNT(1) count, sa.poll_id 
                        from survey_action sa 
                        INNER JOIN survey_choices sc on sc.type = '0'
                        WHERE sa.poll_id in ($id) AND sa.choice = sc.id group by poll_id;";
        if ( $arr ) {
            $result = $this -> db -> query( $query ) -> result_array();
        } else {
            $result = $this -> db -> query( $query ) -> row_array();
        }

        //See the results counts should not be calculated
        return $result;
    }

    function get_question_detail( $inputs ) {
        $id = $inputs[ 'id' ];
        $user_id = $inputs[ 'user_id' ];

        $userchoice = "";
        if ( $user_id > 0 ) {
            $userchoice = ", COALESCE(GROUP_CONCAT(sa.choice),'') as users_choice";
        }

        $this -> db -> select( "s.id, s.user_id, s.raised_by_admin, s.question as title, s.description, s.image, s.total_votes, s.total_comments, "
                . "s.is_multiple, s.created_date, COALESCE(u.alise,'') as alias $userchoice " );
        $this -> db -> from( "survey s" );
        $this -> db -> join( "users u", "u.id = s.user_id", "LEFT" );
        if ( $user_id > 0 ) {
            $this -> db -> join( "survey_action sa", "sa.poll_id = s.id AND sa.user_id = '$user_id'", "LEFT" );
        }
        $this -> db -> where( "s.id = '$id' AND s.is_approved = '1' AND s.is_active = '1'" );
        $this -> db -> offset( $offset );
        $this -> db -> limit( $limit );
        $this -> db -> order_by( "s.id DESC" );
        $result = $this -> db -> get() -> result_array();

        $ids = array ();
        foreach ( $result as $key => $questions_data ) {
            $ids[] = $questions_data[ 'id' ];
            $result[ $key ][ 'topics' ] = array ();
            $result[ $key ][ 'options' ] = array ();
            if ( $questions_data[ 'image' ] == "" ) {
                $result[ $key ][ 'image' ] = base_url( "images/logo/prediction_share_logo.png" );
            }
        }

        /* fetcing Topic associated with it - START */
        if ( ! empty( $ids ) ) {
            $topics_associated = $this -> get_topic_associated_to_questions( $ids );

            foreach ( $topics_associated as $ta_assoc ) {
                foreach ( $result as $key => $questions_data ) {
                    if ( $ta_assoc[ 'post_id' ] == $questions_data[ 'id' ] ) {
                        $result[ $key ][ 'topics' ][] = $ta_assoc[ 'topic_id' ];
                    }
                }
            }
        }
        /* fetcing Topic associated with it - END */

        /* Remove Vote counts of prediction - START */
        $counttoberemoved = $this -> remove_vote_counts( $result[ 0 ][ 'id' ] );

        for ( $i = 0; $i < count( $result ); $i ++ ) {
            if ( $counttoberemoved[ 'poll_id' ] == $result[ $i ][ 'id' ] ) {
                $revised_total = $result[ $i ][ 'total_votes' ] - $counttoberemoved[ 'count' ];
                $result[ $i ][ 'total_votes' ] = "$revised_total";
            }
        }

        if ( $user_id == 0 ) {
            $result[ 0 ][ 'users_choice' ] = "";
        }

        $result[ 0 ][ 'options' ] = $this -> get_questions_option( $ids );
        $result[ 0 ][ 'options' ] = $this -> get_options_percent( $result[ 0 ][ 'options' ], $ids );

        $extra_param = ( object ) array ( "total" => "0" );
        return array ( "status" => TRUE, "message" => "", "data" => $result[ 0 ], "extra_param" => $extra_param, "is_available" => "0" );
    }

    function get_questions_option( $ids ) {
        if ( ! is_array( $ids ) ) {
            $ids = array ( $ids );
        }

        $ids = implode( ",", $ids );
        $this -> db -> select( "sc.id as choice_id, sc.survey_id, sc.choice, sc.type" );
        $this -> db -> from( "survey_choices sc" );
        $this -> db -> where( "sc.survey_id in ($ids)" );
        $result = $this -> db -> get() -> result_array();
        return $result;
    }

    /**
     * $choices - choices of surveys
     * $ids - array of survey id's
     */
    function get_options_percent( $choices, $ids ) {
        $ch_ids = array ();
        foreach ( $choices as $ch ) {
            if ( $ch[ 'choice' ] != "See the Results" ) {
                $ch_ids[] = $ch[ 'choice_id' ];
            }
        }
        $ids = implode( ",", $ids );

        $this -> db -> select( "count(1) as total_votes, sa.choice, sa.poll_id" );
        $this -> db -> from( "survey_action sa" );
        $this -> db -> where( "sa.poll_id in ($ids)" );
        $this -> db -> where_in( "sa.choice", $ch_ids );
        $this -> db -> group_by( "sa.choice" );
        $result = $this -> db -> get();
        $percentage_data = $result -> result_array();
        //echo $this -> db -> last_query();exit;
        $total = 0;
//                foreach ( $percentage_data as $data ) {
//                        $total += $data[ 'total_votes' ];
//                }

        /* Get Distinct Usets count */
        $this -> db -> select( "count(DISTINCT(sa.user_id)) as total_votes" );
        $this -> db -> from( "survey_action sa" );
        $this -> db -> where( "sa.poll_id in ($ids)" );
        $this -> db -> where_in( "sa.choice", $ch_ids );
        $result = $this -> db -> get();
        //echo $this -> db -> last_query();exit;
        $total_votes = $result -> result_array();
        $total = $total_votes[ 0 ][ 'total_votes' ];

        foreach ( $choices as $key => $ch ) {
            $choices[ $key ][ 'total_votes' ] = 0;
            $choices[ $key ][ 'avg' ] = "0";
            foreach ( $percentage_data as $data ) {

                if ( $choices[ $key ][ 'choice_id' ] == $data[ 'choice' ] ) {
                    $choices[ $key ][ 'total_votes' ] = $data[ 'total_votes' ];
                    $avg = ($data[ 'total_votes' ] / $total) * 100;
                    if ( $avg != 100 && $avg != 0 ) {
                        $avg = number_format( $avg, 1, '.', '' );
                    }

                    $choices[ $key ][ 'avg' ] = ( string ) $avg;
                }
            }
        }

        return $choices;
    }

    function add_comment_mod( $inputs ) {
        $questionid = $inputs[ 'id' ];
        $comment = $inputs[ 'comment' ];
        $user_id = $inputs[ 'user_id' ];
        $comment_id = $inputs[ 'comment_id' ];

        $data = array (
            "poll_id" => $questionid,
            "user_id" => $user_id,
            "comment" => $comment,
            "is_active" => 1,
            "created_date" => date( 'Y-m-d H:i:s' )
        );

        if ( $comment_id == 0 ) {
            $this -> db -> insert( 'survey_comments', $data );
            $last_comment_id = $this -> db -> insert_id();

            /* Send push notification */
            $owner_id = $this -> get_created_by_id( $questionid );
            if ( $owner_id != $user_id ) { //checking own comment
                $fields = array (
                    "post_id" => $questionid,
                    "title" => "Comment on question",
                    "text" => $comment,
                    "type" => "Questions",
                    "subtype" => "Comment",
                    "user_id" => $user_id,
                    "friend_id" => $owner_id,
                    "image" => "",
                    "comment_id" => "$last_comment_id",
                );
                $this -> notification -> get_ids_and_fields( $owner_id, $fields, 0 );
            }
            /* Send push notification */

            return $last_comment_id;
        } else {
            $update_data = array (
                "comment" => $comment
            );
            $this -> db -> where( array ( 'id' => $comment_id, "poll_id" => $questionid, "user_id" => $user_id ) );
            $this -> db -> update( 'survey_comments', $update_data );
            return $comment_id;
        }
    }

    function get_comment_by_id( $id ) {
        $this -> db -> select( "*, id as comment_id" );
        $this -> db -> from( 'survey_comments' );
        $this -> db -> where( 'id', $id );
        $this -> db -> where( 'is_active', 1 );
        $result = $this -> db -> get() -> row_array();

        return $result;
    }

    function delete_comment_mod( $uid, $id, $comment_id ) {
        $this -> db -> where( array ( "id" => $comment_id, "user_id" => $uid, "poll_id" => $id ) );
        $this -> db -> update( "survey_comments", array ( "is_active" => "0" ) );
        return array ( "status" => TRUE, "message" => "Comment deleted successfully", "data" => ( object ) array () );
    }

    function get_more_comments( $inputs, $limit = 6 ) {
        $id = $inputs[ 'id' ];
        $offset = $inputs[ 'offset' ];

        $this -> db -> select( "sc.*, sc.id as comment_id, u.alise as alias" );
        $this -> db -> from( "survey_comments sc" );
        $this -> db -> join( "users u", "u.id = sc.user_id", "INNER" );
        $this -> db -> where( "sc.poll_id = '$id'" );
        $this -> db -> where( "sc.is_active = '1'" );
        $this -> db -> offset( $offset );
        $this -> db -> limit( $limit );
        $this -> db -> order_by( "sc.id DESC" );
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

    function add_comment_reply_mod( $inputs ) {
        $questionid = $inputs[ 'id' ];
        $comment_id = $inputs[ 'comment_id' ];
        $user_id = $inputs[ 'user_id' ];
        $comment_reply = $inputs[ 'comment_reply' ];
        $comment_reply_id = $inputs[ 'comment_reply_id' ];

        $data = array (
            "poll_id" => $questionid,
            "comment_id" => $comment_id,
            "user_id" => $user_id,
            "reply" => $comment_reply,
            "is_active" => 1,
            "created_date" => date( 'Y-m-d H:i:s' )
        );

        if ( $comment_reply_id == 0 ) {
            $this -> db -> insert( 'survey_comment_reply', $data );
            $last_reply_id = $this -> db -> insert_id();

            /* Send push notification */
            $reply_data = $this -> get_comment_created_by_id( $comment_id );
            $comment_owner_id = $reply_data[ 0 ][ 'user_id' ];
            $comment = $reply_data[ 0 ][ 'comment' ];
            $alias = $reply_data[ 0 ][ 'alias' ];

            if ( $comment_owner_id != $user_id ) { //checking own comment
                $fields = array (
                    "post_id" => $questionid,
                    "title" => "Reply on comment",
                    "text" => $comment_reply,
                    "type" => "Questions",
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
                "reply" => $comment_reply
            );
            $this -> db -> where( array ( 'id' => $comment_reply_id, "poll_id" => $questionid, "comment_id" => $comment_id, "user_id" => $user_id ) );
            $this -> db -> update( 'survey_comment_reply', $update_data );
            return $comment_reply_id;
        }
    }

    function get_comment_reply_by_id( $id ) {
        $this -> db -> select( "scr.*, scr.id as comment_reply_id, scr.id as reply_id, u.alise as alias" );
        $this -> db -> from( 'survey_comment_reply scr' );
        $this -> db -> join( "users u", "u.id = scr.user_id", "INNER" );
        $this -> db -> where( 'scr.id', $id );
        $result = $this -> db -> get() -> row_array();
        return $result;
    }

    /* delete reply of comment */

    function delete_comment_reply_mod( $inputs ) {
        $id = $inputs[ 'id' ]; //this is question id 
        $comment_id = $inputs[ 'comment_id' ];
        $comment_reply_id = $inputs[ 'comment_reply_id' ];
        $user_id = $inputs[ 'user_id' ];

        $delete_reply_array = array (
            "is_active" => "0"
        );
        $this -> db -> where( array ( "id" => $comment_reply_id, "user_id" => $user_id, "poll_id" => $id, "comment_id" => $comment_id ) );
        $this -> db -> update( "survey_comment_reply", $delete_reply_array );
        return array ( "status" => TRUE, "message" => "Reply deleted successfully", "data" => ( object ) array () );
    }

    function get_comment_replies_mod( $inputs, $limit = 6 ) {
        $id = $inputs[ 'id' ]; //this is question id 
        $comment_id = $inputs[ 'comment_id' ];
        $offset = $inputs[ 'offset' ];

        $this -> db -> select( "scr.*,scr.id as reply_id,u.alise as alias" );
        $this -> db -> from( "survey_comment_reply scr" );
        $this -> db -> join( "users u", "u.id = scr.user_id", "INNER" );
        $this -> db -> where( "scr.poll_id = '$id' AND scr.comment_id = '$comment_id' AND scr.is_active = '1'" );
        $this -> db -> order_by( "scr.id DESC" );
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

    function add_update_question( $inputs ) {

        $user_id = $inputs[ 'user_id' ];
        $questionid = $inputs[ 'questionid' ];
        $title = $this -> special_character( $inputs[ 'title' ] );
        $description = $this -> special_character( $inputs[ 'description' ] );
        $topics = $inputs[ 'topics' ];
        $choices = $inputs[ 'choices' ];
        $select_choice = $inputs[ 'select_choice' ];
        $uploaded_filename = $inputs[ 'uploaded_filename' ];

        $preview_json = $inputs[ 'json_data' ];
        $is_topic_change = $inputs[ 'is_topic_change' ];
        $is_choice_change = $inputs[ 'is_choice_change' ];

        if ( $questionid == 0 ) {

            $insert_array = array (
                "user_id" => $user_id,
                "question" => $title,
                "description" => $description,
                "image" => $uploaded_filename,
                "is_multiple" => $select_choice
            );
            if ( $preview_json != "" ) {
                $insert_array[ 'data' ] = $preview_json;
            }
            $this -> db -> insert( "survey", $insert_array );
            $last_question_id = $this -> db -> insert_id();

            //Question choices addition
            foreach ( $choices as $ch ) {
                $choice_type = ($ch == "See the Results") ? "0" : "1";
                $choice_insert[] = array (
                    "survey_id" => $last_question_id,
                    "choice" => $this -> special_character( $ch ),
                    "type" => $choice_type
                );
            }
            $this -> db -> insert_batch( 'survey_choices', $choice_insert );

            //Question topics addition
            foreach ( $topics as $tp ) {
                $topics_insert[] = array (
                    "topic_id" => $tp,
                    "post_id" => $last_question_id,
                    "title" => $title,
                    "description" => $description,
                    "type" => "Survey"
                );
            }
            $this -> db -> insert_batch( 'topic_association', $topics_insert );

            /* Send push notification */
            $fields = array (
                "post_id" => $last_question_id,
                "title" => "New Question Added",
                "text" => $title,
                "type" => "Questions",
                "subtype" => "Add",
                "user_id" => $user_id,
                "friend_id" => $user_id,
                "image" => ""
            );
            $this -> notification -> get_ids_and_fields( 0, $fields, $user_id );
            /* Send push notification */

            return TRUE;
        } else {
            $update_array = array (
                "question" => $title,
                "description" => $description,
                "image" => $uploaded_filename,
                "is_multiple" => $select_choice
            );

            if ( $is_choice_change != "0" ) {
                $update_array[ 'total_votes' ] = "0";
            }
            $this -> db -> where( array ( "id" => $questionid, "user_id" => $user_id ) );
            $this -> db -> update( "survey", $update_array );

            if ( $is_topic_change != "0" ) {
                //delete all the existing Topics of paricular question
                $this -> db -> where( "post_id = '$questionid' AND type = 'Survey'" );
                $this -> db -> delete( "topic_association" );

                //Question topics update
                foreach ( $topics as $tp ) {
                    $topics_insert[] = array (
                        "topic_id" => $tp,
                        "post_id" => $questionid,
                        "title" => $title,
                        "description" => $description,
                        "type" => "Survey"
                    );
                }
                $this -> db -> insert_batch( 'topic_association', $topics_insert );
            }

            if ( $is_choice_change != "0" ) {
                //delete all the existing choices of paricular question
                $this -> db -> where( "survey_id = '$questionid'" );
                $this -> db -> delete( "survey_choices" );

                //insert new choices for the paricular question
                foreach ( $choices as $ch ) {
                    $choice_type = ($ch == "See the Results") ? "0" : "1";
                    $choice_insert[] = array (
                        "survey_id" => $questionid,
                        "choice" => $this -> special_character( $ch ),
                        "type" => $choice_type
                    );
                }
                $this -> db -> insert_batch( 'survey_choices', $choice_insert );
            }
            return TRUE;
        }
    }

    function vote_action_mod( $inputs, $user_id ) {
        $pollid = $inputs[ 'id' ];
        $choice = $inputs[ 'choice' ];
        //$category = $inputs[ 'category_id' ];

        $data = array ();
        foreach ( $choice as $key => $ch ) {
            $points = ($key == 0) ? 2 : 0;
            $data[] = array (
                "poll_id" => $pollid,
                "user_id" => $user_id,
                "choice" => $ch,
                "category_id" => 0,
                'action' => 'Vote',
                'points' => $points
            );
        }

        $this -> db -> select( 'id' );
        $this -> db -> where( 'poll_id', $pollid );
        $this -> db -> where( 'user_id', $user_id );
        $this -> db -> where( 'action', 'Vote' );
        $this -> db -> from( 'survey_action' );
        $result = $this -> db -> get();

        if ( $result -> num_rows() > 0 ) {

            $this -> db -> where( "poll_id = '$pollid' and user_id = '$user_id'" );
            $this -> db -> delete( "survey_action" );

            $this -> db -> insert_batch( 'survey_action', $data );
//                        $alreadyvote = $result -> row_array();
//                        $this -> db -> where( 'id', $alreadyvote[ 'id' ] );
//                        $this -> db -> update( 'survey_action', $data );
            return 1;
        } else {
            $this -> db -> insert_batch( 'survey_action', $data );

            $sessiondata = $this -> session -> userdata( 'data' );
            $_SESSION[ 'data' ][ 'silver_points' ] = $sessiondata[ 'silver_points' ] + 2;

            $this -> db -> set( 'unearned_points', "unearned_points+2", FALSE );
            $this -> db -> where( "id", $user_id );
            $this -> db -> update( 'users' );

            /* Send push notification */
            $owner_id = $this -> get_created_by_id( $pollid );
            if ( $owner_id != $user_id ) { //checking own vote
                $fields = array (
                    "post_id" => $pollid,
                    "title" => "Vote on question",
                    "text" => "",
                    "type" => "Questions",
                    "subtype" => "Vote",
                    "user_id" => $user_id,
                    "friend_id" => $owner_id,
                    "image" => ""
                );
                $this -> notification -> get_ids_and_fields( $owner_id, $fields, 0 );
            }
            /* Send push notification */

            return 0;
        }
    }

    function get_created_by_id( $id ) {

        $this -> db -> select( 's.user_id' );
        $this -> db -> from( 'survey s' );
        $this -> db -> where( "s.id = '$id'" );
        return $this -> db -> get() -> result_array()[ 0 ][ 'user_id' ];
    }

    function get_comment_created_by_id( $id ) {
        $this -> db -> select( 'sc.user_id, sc.comment, u.alise as alias' );
        $this -> db -> from( 'survey_comments sc' );
        $this -> db -> join( 'users u', "u.id = sc.user_id", "INNER" );
        $this -> db -> where( "sc.id = '$id'" );
        return $this -> db -> get() -> result_array();
    }

}
