<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AskQuestions_Mod extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_questions_list( $inputs, $limit = 8 ) {
        $offset = $inputs[ 'offset' ];
        $relatedTopics = $inputs[ 'relatedTopics' ];

        $new_limit = ($offset == 0) ? 8 : (($offset >= 7) ? 7 : 7);

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
        } else{
            $this->db->select("id");
            $this->db->from("topics t");
            $this->db->where("t.is_private = '1'");
            $private_topic_ids_result = $this->db->get()->result_array();

            foreach($private_topic_ids_result as $t_ids){
                $not_accessible_topic_ids .= $t_ids['id'].",";
            }
            $not_accessible_topic_ids = chop($not_accessible_topic_ids, ",");
            $exclude_private_topic_ids = " AND ta.topic_id NOT IN($not_accessible_topic_ids)";
        }
        
        $this -> db -> select( "s.id, s.user_id, s.question as title, COALESCE(s.image,'') as image, s.total_votes, s.total_comments" );
        $this -> db -> from( "survey s" );
        $this -> db -> where( "s.is_active = '1' AND s.is_approved = '1' $exclude_private_topic_ids" );
        if ( ! empty( $relatedTopics ) ) {
            foreach ( $relatedTopics as $value ) {
                $relatedIds .= $value . ",";
            }
            $relatedIds = chop( $relatedIds, "," );
            $this -> db -> join( "topic_association ta", "ta.post_id = s.id AND ta.type = 'Survey' AND ta.topic_id in ($relatedIds)", "INNER" );
        } else {
            $this->db->join("topic_association ta","ta.post_id = s.id AND ta.type = 'Survey'","INNER");
        }
        $this -> db -> order_by( "s.id DESC" );
        $this -> db -> group_by( "s.id" );
        $this -> db -> offset( $offset );
        $this -> db -> limit( $new_limit );
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

    function get_topic_associated_to_questions( $ids ) {
        $this -> db -> select( "ta.*" );
        $this -> db -> from( "topic_association ta" );
        $this -> db -> where_in( "ta.post_id", $ids );
        $this -> db -> where( "ta.type = 'Survey'" );
        $result = $this -> db -> get() -> result_array();
        return $result;
    }

//        function get_questions_list( $inputs, $limit = 8 ) {
//                $offset = $inputs[ 'offset' ];
//
//                $new_limit = ($offset == 0) ? 8 : (($offset >= 7) ? 7 : 7);
//
//                $this -> db -> select( "s.id, s.user_id, s.topic_id, s.question as title, COALESCE(s.image,'') as image, s.total_votes, "
//                        . "s.total_comments, COALESCE(t.topic,'') as topic" );
//                $this -> db -> from( "survey s" );
//                $this -> db -> join( "topics t", "t.id = s.topic_id", "LEFT" );
//                $this -> db -> where( "s.is_active = '1' AND s.is_approved = '1'" );
//                $this -> db -> offset( $offset );
//                $this -> db -> limit( $new_limit );
//                $result = $this -> db -> get() -> result_array();
//                //echo $this -> db -> last_query();exit;
//
//                /* Checking more data available or not - START */
//                $is_available = "0";
//                if ( count( $result ) >= 7 ) {
//                        unset( $result[ count( $result ) - 1 ] );
//                        $is_available = "1";
//                } else {
//                        $is_available = "0";
//                }
//                /* Checking more data available or not - END */
//
//                $ids = array ();
//                foreach ( $result as $key => $questions_data ) {
//                        $ids[] = $questions_data[ 'id' ];
//                        if ( $questions_data[ 'image' ] == "" ) {
//                                $result[ $key ][ 'image' ] = base_url( "images/logo/prediction_share_logo.png" );
//                        }
//                }
//
//                /* Remove Vote counts of prediction - START */
//                $counttoberemoved = $this -> remove_vote_counts( $ids );
//
//                for ( $i = 0; $i < count( $result ); $i ++ ) {
//                        foreach ( $counttoberemoved as $removeids ) {
//                                if ( $removeids[ 'poll_id' ] == $result[ $i ][ 'id' ] ) {
//                                        $revised_total = $result[ $i ][ 'total_votes' ] - $removeids[ 'count' ];
//                                        $result[ $i ][ 'total_votes' ] = "$revised_total";
//                                }
//                        }
//                }
//
//                /* Remove Vote counts of prediction - END */
//
//                $extra_param = ( object ) array ( "total" => "0" );
//                return array ( "status" => TRUE, "message" => "", "data" => $result, "extra_param" => $extra_param, "is_available" => $is_available );
//
//        }

    function get_question_detail( $inputs ) {
        $id = $inputs[ 'id' ];
        $user_id = $inputs[ 'user_id' ];

        /* $this -> db -> select( "s.id, s.user_id, s.topic_id, s.category_id, s.raised_by_admin, s.question as title, s.description, "
          . "s.preview, s.url, COALESCE(s.image,'') as image, s.total_votes, s.total_comments, s.created_date,"
          . "COALESCE(t.topic,'') as topic, COALESCE(sa.choice,'') as users_choice" );
          $this -> db -> from( "survey s" );
          $this -> db -> join( "survey_action sa", "sa.poll_id = s.id AND sa.user_id = '$user_id'", "LEFT" );
          $this -> db -> join( "topics t", "t.id = s.topic_id", "LEFT" );
          $this -> db -> where( "s.id = '$id' AND s.is_active = '1' AND s.is_approved = '1'" ); */

        $userchoice = "";
        if ( $user_id > 0 ) {
            $userchoice = ", COALESCE(GROUP_CONCAT(sa.choice),'') as users_choice";
        }

        $this -> db -> select( "s.id, s.user_id, s.raised_by_admin,s.is_stop, s.is_multiple, COALESCE(u.alise,'') as alias, s.question as title, s.description, "
                . "COALESCE(s.image,'') as image, s.total_votes, s.total_comments, s.meta_keywords, s.meta_description, s.created_date $userchoice" );
        $this -> db -> from( "survey s" );
        $this -> db -> join( 'users u', 'u.id = s.user_id', "LEFT" );
        if ( $user_id > 0 ) {
            $this -> db -> join( "survey_action sa", "sa.poll_id = s.id AND sa.user_id = '$user_id'", "LEFT" );
        }
        $this -> db -> where( "s.id = '$id' AND s.is_active = '1' AND s.is_approved = '1'" );
        $this -> db -> order_by( "s.id" );
        $result = $this -> db -> get() -> result_array();

        /* Remove Vote counts of prediction - START */
        $counttoberemoved = $this -> remove_vote_counts( $id );

        for ( $i = 0; $i < count( $result ); $i ++ ) {
            if ( $counttoberemoved[ 'poll_id' ] == $result[ $i ][ 'id' ] ) {
                $revised_total = $result[ $i ][ 'total_votes' ] - $counttoberemoved[ 'count' ];
                $result[ $i ][ 'total_votes' ] = "$revised_total";
            }
        }

        if ( $user_id == 0 ) {
            $result[ 0 ][ 'users_choice' ] = "";
        }
        //get the options of prediction
        //$result[ 0 ][ 'options' ] = $this -> get_question_options( $id );
        $total_votes = $result[ 0 ][ 'total_votes' ];

        $result[ 0 ][ 'options' ] = $this -> get_questions_option( array ( $id ) );
        $result[ 0 ][ 'options' ] = $this -> get_options_percent( $result[ 0 ][ 'options' ], array ( $id ) );

        //$result[ 0 ][ 'options' ] = $this -> calculateavgvotes( $id, $total_votes );
        //$result[ 0 ][ 'options' ] = $this -> getavg( $result[ 0 ][ 'options' ], $id );

        $result[ 0 ][ 'comments' ] = $this -> get_poll_comments( $id, 0, 3 );

        if ( count( $result[ 0 ][ 'comments' ] ) > 2 ) {
            unset( $result[ 0 ][ 'comments' ][ count( $result[ 0 ][ 'comments' ] ) - 1 ] );
            $result[ 0 ][ 'more_comments' ] = "1";
        } else {
            $result[ 0 ][ 'more_comments' ] = "0";
        }

        $result[ 0 ][ 'total_comments' ] = $this -> get_poll_comments_count( $id, 'All' );
        $result[ 0 ][ 'total_views' ] = "0";

        //get topics associated
        $result[ 0 ][ 'topic_associated' ] = $this -> get_question_topics( $id );

        $extra_param = ( object ) array ();
        return array ( "status" => TRUE, "message" => "", "data" => $result, "extra_param" => $extra_param, "is_available" => "" );
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

                    $choices[ $key ][ 'avg' ] = $avg;
                }
            }
        }

        return $choices;
    }

    function calculateavgvotes( $id, $total_votes = 0 ) {
        if ( ! is_array( $id ) ) {
            $id = array ( $id );
        }
        $this -> db -> select( 'pc1.id as choice_id,pc1.choice,pc1.survey_id as poll_id' );
        $this -> db -> from( 'survey_choices pc1' );
        $this -> db -> where_in( 'pc1.survey_id', $id );
        $this -> db -> group_by( 'pc1.id' );
        $choices = $this -> db -> get() -> result_array();

        $ch_ids = array ();
        foreach ( $choices as $key => $c1 ) {
            $ch_ids[] = $c1[ 'choice_id' ] . ",";
        }

        $this -> db -> select( 'count(1) as total,choice,poll_id' );
        $this -> db -> from( 'survey_action' );
        $this -> db -> where_in( "choice", $ch_ids );
        $this -> db -> where_in( 'poll_id', $id );
        $this -> db -> group_by( array ( "choice", "poll_id" ) );
        $resultcount = $this -> db -> get();
        $count_array = $resultcount -> result_array();

        foreach ( $choices as $key => $c1 ) {
            $choices[ $key ][ 'total' ] = 0;

            foreach ( $count_array as $count_data ) {
                if ( $choices[ $key ][ 'choice_id' ] == $count_data[ 'choice' ] ) {
                    $choices[ $key ][ 'total' ] = $count_data[ 'total' ];
                }
            }
        }
        return $choices;
    }

    function getavg( $choices, $id ) {

        $total_votes = 0;
        /* foreach ( $choices as $key => $c1 ) {
          if ( $c1[ 'choice' ] != "See the Results" ) {
          $total_votes += $choices[ $key ][ 'total' ];
          }
          } */
        /* Get total unique votes - START */
        $ch_ids = array ();
        foreach ( $choices as $ch ) {
            if ( $ch[ 'choice' ] != "See the Results" ) {
                $ch_ids[] = $ch[ 'choice_id' ];
            }
        }

        $this -> db -> select( "count(DISTINCT(sa.user_id)) as total" );
        $this -> db -> from( "survey_action sa" );
        $this -> db -> where_in( "choice", $ch_ids );
        $this -> db -> where( "poll_id = '$id'" );
        $result = $this -> db -> get() -> row_array();
        $total_votes = $result[ 'total' ];
        /* Get total unique votes - END */

        foreach ( $choices as $key => $c1 ) {

            $sum = 0;

            if ( $total_votes > 0 ) {
                $sum = $choices[ $key ][ 'total' ] / $total_votes;
            }
            if ( $c1[ 'choice' ] != "See the Results" ) {
                $avg = $sum;
                $avg = $avg * 100;
                if ( $avg != 100 && $avg != 0 ) {
                    $avg = number_format( $avg, 1, '.', '' );
                }

                $choices[ $key ][ 'avg' ] = $avg;
            } else {
                $choices[ $key ][ 'avg' ] = 0;
            }
        }
        return $choices;
    }

    function get_poll_comments( $id, $offset = 0, $limit = 10 ) {
        $arr = true;
        if ( ! is_array( $id ) ) {
            $arr = false;
            $id = array ( $id );
        }
        $this -> db -> select( "sc.*,sc.id as comment_id, u.alise as alias" );
        $this -> db -> from( 'survey_comments sc' );
        $this -> db -> where_in( 'sc.poll_id', $id );
        $this -> db -> where( 'sc.is_active', 1 );
        $this -> db -> join( 'users u', 'u.id = sc.user_id' );
        if ( $arr ) {
            $this -> db -> group_by( 'sc.poll_id' );
        }
        $this -> db -> order_by( 'sc.created_date', 'DESC' );
        $this -> db -> offset( $offset );
        $this -> db -> limit( $limit );
        $result = $this -> db -> get() -> result_array();

        return $result;
    }

    function get_poll_comments_count( $id, $type ) {
        $arr = true;
        if ( ! is_array( $id ) ) {
            $arr = false;
            $id = array ( $id );
        }
        $this -> db -> select( "count(1) as count, pcmts.poll_id as poll_id" );
        $this -> db -> from( 'survey_comments pcmts' );
        $this -> db -> where_in( 'pcmts.poll_id', $id );

        $this -> db -> where( 'pcmts.is_active', 1 );

        if ( $arr ) {
            $this -> db -> group_by( 'pcmts.poll_id' );
            $result = $this -> db -> get() -> result_array();
        } else {
            $result = $this -> db -> get() -> row_array()[ 'count' ];
        }
        return $result;
    }

    function get_question_options( $question_id ) {
        $this -> db -> select( "sc.id, sc.choice, sc.type" );
        $this -> db -> from( "survey_choices sc" );
        $this -> db -> where( "sc.survey_id = '$question_id'" );
        $result = $this -> db -> get() -> result_array();

        return $result;
    }

    function get_question_topics( $postid ) {
        $this -> db -> select( "ta.topic_id,ta.type, t.topic, t.is_private, t.email_ids" );
        $this -> db -> from( "topic_association ta" );
        $this -> db -> join( "topics t", "ta.topic_id = t.id", "INNER" );
        $this -> db -> where( "ta.post_id = '$postid' AND ta.type = 'Survey'" );
        $result = $this -> db -> get() -> result_array();

        return $result;
    }

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

    function get_answered_questions( $inputs, $limit = 11 ) {

        $offset = $inputs[ 'offset' ];
        $user_id = $inputs[ 'user_id' ];

        //$new_limit = ($offset == 0) ? 8 : (($offset >= 7) ? 7 : 7);

        $this -> db -> select( "s.id, s.topic_id, s.question as title, COALESCE(s.image,'') as image, s.total_votes, s.total_comments, "
                . "COALESCE(t.topic,'') as topic" );
        $this -> db -> from( "survey_action sa" );
        $this -> db -> join( "survey s", "s.id = sa.poll_id", "LEFT" );
        $this -> db -> join( "topics t", "t.id = s.topic_id", "LEFT" );
        $this -> db -> where( "sa.user_id = '$user_id'" );
        $this -> db -> offset( $offset );
        $this -> db -> limit( $limit );
        $result = $this -> db -> get() -> result_array();

        /* Checking more data available or not - START */
        $is_available = "0";
        if ( count( $result ) >= 10 ) {
            unset( $result[ count( $result ) - 1 ] );
            $is_available = "1";
        } else {
            $is_available = "0";
        }
        /* Checking more data available or not - END */

        $ids = array ();
        foreach ( $result as $questions_data ) {
            $ids[] = $questions_data[ 'id' ];
        }

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
            return 0;
        }
    }

    /*

     * param pollid is a poll for which comment is done
     * param user_id if a user from which comment is done
     * param poll_comment is a text for commment
     * param poll_cmt is a id of comment if you want to edit comment

     */

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
            return $this -> db -> insert_id();
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
        return array ( "status" => TRUE, "message" => "", "data" => "" );
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

    function get_comment_replies_mod( $inputs, $limit = 6 ) {
        $id = $inputs[ 'id' ]; //this is poll_id 
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

    /*

     * param pollid is a poll for which comment reply is done
     * param user_id if a user from which comment is done
     * param poll_comment_reply is a text for commment reply
     * param comment_id is a id of comment for which reply is done

     */

    function add_comment_reply_mod( $inputs ) {
        $pollid = $inputs[ 'id' ];
        $comment_id = $inputs[ 'comment_id' ];
        $user_id = $inputs[ 'user_id' ];
        $poll_comment_reply = $inputs[ 'comment_reply' ];
        $comment_reply_id = $inputs[ 'comment_reply_id' ];

        $data = array (
            "poll_id" => $pollid,
            "comment_id" => $comment_id,
            "user_id" => $user_id,
            "reply" => $poll_comment_reply,
            "is_active" => 1,
            "created_date" => date( 'Y-m-d H:i:s' )
        );

        if ( $comment_reply_id == 0 ) {
            $this -> db -> insert( 'survey_comment_reply', $data );
            return $this -> db -> insert_id();
        } else {
            $update_data = array (
                "reply" => $poll_comment_reply
            );
            $this -> db -> where( array ( 'id' => $comment_reply_id, "poll_id" => $pollid, "comment_id" => $comment_id, "user_id" => $user_id ) );
            $this -> db -> update( 'survey_comment_reply', $update_data );
            return $comment_id;
        }
    }

    function get_comment_reply_by_id( $id ) {
        $this -> db -> select( "*, id as comment_reply_id" );
        $this -> db -> from( 'survey_comment_reply' );
        $this -> db -> where( 'id', $id );
        $result = $this -> db -> get() -> row_array();
        return $result;
    }

    /* delete reply of comment */

    function delete_comment_reply_mod( $inputs ) {
        $uid = $inputs[ 'uid' ];
        $id = $inputs[ 'id' ]; //this is poll_id 
        $comment_id = $inputs[ 'comment_id' ];
        $comment_reply_id = $inputs[ 'comment_reply_id' ];

        $delete_reply_array = array (
            "is_active" => "0"
        );
        $this -> db -> where( array ( "id" => $comment_reply_id, "user_id" => $uid, "poll_id" => $id, "comment_id" => $comment_id ) );
        $this -> db -> update( "survey_comment_reply", $delete_reply_array );
        return array ( "status" => TRUE, "message" => "", "data" => "" );
    }

    function special_character( $string ) {
        $string = str_replace( "'", "&#039;", $string );
        $string = str_replace( '"', '&#039;', $string );
        return $string;
    }

}
