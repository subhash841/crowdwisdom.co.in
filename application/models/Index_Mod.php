<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Index_mod extends CI_Model {

        function __construct() {
                parent::__construct();

        }

        function get_followed_topics( $user_id = 0 ) {
                $result = array ();
                if ( $user_id > 0 ) {
                        $this -> db -> select( "utf.topic_id" );
                        $this -> db -> from( "users_followed_topics utf" );
                        $this -> db -> where( "utf.user_id = '$user_id' AND utf.is_follow = '1'" );
                        $result = $this -> db -> get() -> result_array();
                }

                return $result;

        }

        function get_trending_prediction( $inputs, $limit = 4 ) {

                /* inputs */
                $user_id = $inputs[ 'user_id' ];
                $offset = $inputs[ 'offset' ];
                $topic_id = $inputs[ 'topic_id' ];
                /* inputs */

                $trending_predictions = array ();
                $followed_predictions_ids = array ();
                $voted_survey = "";
                $uservoted_cond = "";
                $uservoted_cond_order_by = "";

                /* Engagement Checking - START */
                $engagement_ids = array ();
                $this -> db -> select( "pa.poll_id, COUNT(1) as total_response" );
                $this -> db -> from( "poll_action pa" );
                $this -> db -> where( "pa.created_date >= (now() - INTERVAL 24 hour)" );
                $this -> db -> group_by( "pa.poll_id" );
                $this -> db -> order_by( "total_response DESC, pa.poll_id DESC" );
                $action_responses = $this -> db -> get() -> result_array();

                $this -> db -> select( "pc.poll_id, COUNT(1) as total_response" );
                $this -> db -> from( "poll_comments pc" );
                $this -> db -> where( "pc.created_date >= (now() - INTERVAL 24 hour) AND pc.is_active = '1'" );
                $this -> db -> group_by( "pc.poll_id" );
                $this -> db -> order_by( "total_response DESC, pc.id DESC" );
                $comment_responses = $this -> db -> get() -> result_array();

                if ( ! empty( $action_responses ) && ! empty( $comment_responses ) ) { // vote action and comments in last 24 hours
                        foreach ( $action_responses as $lkey => $likes ) {
                                $engagement_ids[ $lkey ][ 'poll_id' ] = $likes[ 'poll_id' ];
                                $engagement_ids[ $lkey ][ 'total_response' ] = $likes[ 'total_response' ];

                                foreach ( $comment_responses as $ckey => $comments ) {
                                        if ( $action_responses[ $lkey ][ 'poll_id' ] == $comments[ 'poll_id' ] ) {
                                                $engagement_ids[ $lkey ][ 'total_response' ] = $likes[ 'total_response' ] + $comments[ 'total_response' ];
                                        } else {
                                                array_push( $engagement_ids, $comments );
                                        }
                                }
                        }
                } else if ( ! empty( $action_responses ) && empty( $comment_responses ) ) { // only vote action in last 24 hours
                        foreach ( $action_responses as $lkey => $likes ) {
                                $engagement_ids[ $lkey ][ 'poll_id' ] = $likes[ 'poll_id' ];
                                $engagement_ids[ $lkey ][ 'total_response' ] = $likes[ 'total_response' ];
                        }
                } else if ( empty( $action_responses ) && ! empty( $comment_responses ) ) { // only comments in last 24 hours
                        foreach ( $comment_responses as $ckey => $comments ) {
                                $engagement_ids[ $ckey ][ 'poll_id' ] = $comments[ 'poll_id' ];
                                $engagement_ids[ $ckey ][ 'total_response' ] = $comments[ 'total_response' ];
                        }
                } else { //there is no engagement in 24 last hours 
                        $engagement_ids = array ();
                }

                $engagement_id_data = "";
                $engagement_order = "";

                if ( ! empty( $engagement_ids ) ) {
                        foreach ( $engagement_ids as $engagement_data ) {
                                $onlyids[] = $engagement_data[ 'poll_id' ];
                                $engagement_id_data .= $engagement_data[ 'poll_id' ] . ",";
                        }
                        $unique = array_reverse( array_unique( $onlyids ) );
                        $engagement_id_data = implode( ',', $unique );
                        $engagement_order = "FIELD(p.id, $engagement_id_data) DESC, ";
                }
                /* Engagement Checking - END */

                //check users following topics
                if ( $topic_id == 0 ) {
                        $followed_result = $this -> get_followed_topics( $user_id );
                        $followed_topic_ids = array ();
                        foreach ( $followed_result as $key => $users_followed_data ) {
                                $followed_topic_ids[] = $users_followed_data[ 'topic_id' ];
                        }

                        if ( ! empty( $followed_topic_ids ) ) {

                                $this -> db -> select( "p.id" );
                                $this -> db -> from( "poll p" );
                                $this -> db -> join( "topic_association ta", "ta.post_id = p.id AND ta.type = 'Poll'", "INNER" );
                                $this -> db -> where_in( "ta.topic_id", $followed_topic_ids );
                                $followed_predictios = $this -> db -> get() -> result_array();

                                foreach ( $followed_predictios as $key => $followd_data ) {
                                        $followed_predictions_ids[] = $followd_data[ 'id' ];
                                }
                        }
                }

                /* if ( $user_id > 0 ) {
                  $users_voted_surveys = "SELECT poll_id FROM poll_action WHERE user_id = '$user_id' AND action= 'Vote'";
                  $users_voted_data = $this -> db -> query( $users_voted_surveys ) -> result_array();

                  foreach ( $users_voted_data as $key => $data ) {
                  $voted_survey .= $data[ 'poll_id' ] . ",";
                  }
                  $voted_survey = chop( $voted_survey, "," );

                  $uservoted_cond = ",(SELECT count(1) from poll_action where poll_id = p.id AND action= 'Vote' AND user_id='$user_id') as is_user_voted";
                  $uservoted_cond_order_by = "is_user_voted ASC,";
                  } */

                /* Get Prediction raised in last 24 hour - START */
                $this -> db -> select( "p.id" );
                $this -> db -> from( "poll p" );
                $this -> db -> where( "(p.created_date) >= (now() - INTERVAL 24 hour) AND p.is_active = '1'" );
                $last24hour_result = $this -> db -> get() -> result_array();
                /* Get Prediction raised in last 24 hour - END */

                $last24hourids = "";

                if ( ! empty( $last24hour_result ) ) {
                        foreach ( $last24hour_result as $key => $last24hour_data ) {
                                $last24hourids .= $last24hour_data[ 'id' ] . ",";
                        }
                        $last24hourids = chop( $last24hourids, "," );
                }
                //Latest First
                $is_new = "";
                if ( $last24hourids != "" ) {
                        $is_new = "FIELD(p.id, $last24hourids) DESC,";
                }

                $is_public = ($topic_id == 0) ? " AND p.is_public = '1'" : " AND (p.is_public = '1' OR p.is_public = '2')";
                
                $this -> db -> select( "p.id, p.poll as title, p.description, p.image, p.total_votes, p.total_comments, (p.total_votes+p.total_comments) as engagement, LOWER(pc.name) as category,p.preview,p.data" );
                $this -> db -> from( "poll p" );
                $this -> db -> join( "poll_category pc", "pc.id = p.category_id", "LEFT" );
                if ( $topic_id > 0 ) {
                        $this -> db -> join( "topic_association ta", "ta.post_id = p.id AND ta.type = 'Poll' AND ta.topic_id = '$topic_id'", "INNER" );
                }
                $this -> db -> where( "p.is_approved = '1' AND p.is_active = '1' $is_public" );
                if ( ! empty( $followed_predictions_ids ) ) {
                        //$this -> db -> where_in( "p.id", $followed_predictions_ids );
                        $this -> db -> or_where_in( "p.id", $followed_predictions_ids );
                }
                $this -> db -> order_by( "$is_new $engagement_order p.id DESC" );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $trending_predictions = $this -> db -> get() -> result_array();
                
                $allids = array ();
                foreach ( $trending_predictions as $key => $prediction_data ) {
                        $id = $prediction_data[ 'id' ];
                        //trending question will load these details not required
                        $allids[] = $id;
                }

                if ( ! empty( $allids ) ) {
                        $counttoberemoved = $this -> remove_prediction_votes_count( $allids );
                }

                for ( $i = 0; $i < count( $trending_predictions ); $i ++ ) {
                        foreach ( $counttoberemoved as $av ) {
                                if ( $av[ 'poll_id' ] == $trending_predictions[ $i ][ 'id' ] ) {
                                        $trending_predictions[ $i ][ 'total_votes' ] = ( string ) ($trending_predictions[ $i ][ 'total_votes' ] - $av[ 'count' ]);
                                }
                        }
                }

                return array ( "status" => TRUE, "message" => "", "data" => $trending_predictions );

        }

        function get_trending_questions( $inputs, $limit = 5 ) {

                /* inputs */
                $user_id = $inputs[ 'user_id' ];
                $offset = $inputs[ 'offset' ];
                $topic_id = $inputs[ 'topic_id' ];
                /* inputs */

                $trending_questions = array ();
                $followed_questions_ids = array ();
                $exclude_private_topic_ids = "";
                /* Get user voted surveys - START */
                $voted_survey = "";
                $uservoted_cond = "";
                $uservoted_cond_order_by = "";

                /* Engagement Checking - START */
                $engagement_ids = array ();
                $this -> db -> select( "sa.poll_id, COUNT(DISTINCT(sa.user_id)) as total_response" );
                $this -> db -> from( "survey_action sa" );
                $this -> db -> where( "sa.created_date >= (now() - INTERVAL 24 hour)" );
                $this -> db -> group_by( "sa.poll_id" );
                $this -> db -> order_by( "total_response DESC, sa.poll_id DESC" );
                $action_responses = $this -> db -> get() -> result_array();

                $this -> db -> select( "sc.poll_id, COUNT(1) as total_response" );
                $this -> db -> from( "survey_comments sc" );
                $this -> db -> where( "sc.created_date >= (now() - INTERVAL 24 hour) AND sc.is_active = '1'" );
                $this -> db -> group_by( "sc.poll_id" );
                $this -> db -> order_by( "total_response DESC, sc.id DESC" );
                $comment_responses = $this -> db -> get() -> result_array();

                if ( ! empty( $action_responses ) && ! empty( $comment_responses ) ) { // vote action and comments in last 24 hours
                        foreach ( $action_responses as $lkey => $likes ) {
                                $engagement_ids[ $lkey ][ 'poll_id' ] = $likes[ 'poll_id' ];
                                $engagement_ids[ $lkey ][ 'total_response' ] = $likes[ 'total_response' ];

                                foreach ( $comment_responses as $ckey => $comments ) {
                                        if ( $action_responses[ $lkey ][ 'poll_id' ] == $comments[ 'poll_id' ] ) {
                                                $engagement_ids[ $lkey ][ 'total_response' ] = $likes[ 'total_response' ] + $comments[ 'total_response' ];
                                        } else {
                                                array_push( $engagement_ids, $comments );
                                        }
                                }
                        }
                } else if ( ! empty( $action_responses ) && empty( $comment_responses ) ) { // only vote action in last 24 hours
                        foreach ( $action_responses as $lkey => $likes ) {
                                $engagement_ids[ $lkey ][ 'poll_id' ] = $likes[ 'poll_id' ];
                                $engagement_ids[ $lkey ][ 'total_response' ] = $likes[ 'total_response' ];
                        }
                } else if ( empty( $action_responses ) && ! empty( $comment_responses ) ) { // only comments in last 24 hours
                        foreach ( $comment_responses as $ckey => $comments ) {
                                $engagement_ids[ $ckey ][ 'poll_id' ] = $comments[ 'poll_id' ];
                                $engagement_ids[ $ckey ][ 'total_response' ] = $comments[ 'total_response' ];
                        }
                } else { //there is no engagement in 24 last hours 
                        $engagement_ids = array ();
                }

                $engagement_id_data = "";
                $engagement_order = "";

                if ( ! empty( $engagement_ids ) ) {
                        foreach ( $engagement_ids as $engagement_data ) {
                                $onlyids[] = $engagement_data[ 'poll_id' ];
                                $engagement_id_data .= $engagement_data[ 'poll_id' ] . ",";
                        }
                        $unique = array_reverse( array_unique( $onlyids ) );
                        $engagement_id_data = implode( ',', $unique );
                        $engagement_order = "FIELD(s.id, $engagement_id_data) DESC, ";
                }
                /* Engagement Checking - END */

                //check users following topics
                if ( $topic_id == 0 ) {
                        $followed_result = $this -> get_followed_topics( $user_id );
                        $followed_topic_ids = array ();
                        foreach ( $followed_result as $key => $users_followed_data ) {
                                $followed_topic_ids[] = $users_followed_data[ 'topic_id' ];
                        }

                        if ( ! empty( $followed_topic_ids ) ) {

                                $this -> db -> select( "s.id" );
                                $this -> db -> from( "survey s" );
                                $this -> db -> join( "topic_association ta", "ta.post_id = s.id AND ta.type = 'Survey'", "INNER" );
                                $this -> db -> where_in( "ta.topic_id", $followed_topic_ids );
                                $followed_predictios = $this -> db -> get() -> result_array();

                                foreach ( $followed_predictios as $key => $followd_data ) {
                                        $followed_questions_ids[] = $followd_data[ 'id' ];
                                }
                        }
                }
                
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
                /* if ( $user_id > 0 ) {
                  $users_voted_surveys = "SELECT poll_id FROM survey_action WHERE user_id = '$user_id' AND action= 'Vote'";
                  $users_voted_data = $this -> db -> query( $users_voted_surveys ) -> result_array();

                  foreach ( $users_voted_data as $key => $data ) {
                  $voted_survey .= $data[ 'poll_id' ] . ",";
                  }
                  $voted_survey = chop( $voted_survey, "," );

                  $uservoted_cond = ",(SELECT count(1) from survey_action where poll_id = s.id AND action= 'Vote' AND user_id='$user_id') as is_user_voted";
                  $uservoted_cond_order_by = "is_user_voted ASC, ";
                  } */

                /* Get Prediction raised in last 24 hour - START */
                $this -> db -> select( "s.id" );
                $this -> db -> from( "survey s" );
                $this -> db -> where( "(s.created_date) >= (now() - INTERVAL 24 hour) AND s.is_active = '1'" );
                $last24hour_result = $this -> db -> get() -> result_array();
                /* Get Prediction raised in last 24 hour - END */

                $last24hourids = "";

                if ( ! empty( $last24hour_result ) ) {
                        foreach ( $last24hour_result as $key => $last24hour_data ) {
                                $last24hourids .= $last24hour_data[ 'id' ] . ",";
                        }
                        $last24hourids = chop( $last24hourids, "," );
                }
                //Latest First
                $is_new = "";
                if ( $last24hourids != "" ) {
                        $is_new = "FIELD(s.id, $last24hourids) DESC,";
                }
 
                $this -> db -> select( "s.id, s.raised_by_admin, s.question, s.description, s.image, s.total_votes, s.total_comments, "
                        . "(s.total_votes+s.total_comments) as engagement, u.alise as alias" );
                $this -> db -> from( "survey s" );
                $this -> db -> join( "users u", "u.id = s.user_id", "LEFT" );
                if ( $topic_id > 0 ) {
                        $this -> db -> join( "topic_association ta", "ta.post_id = s.id AND ta.type = 'Survey' AND ta.topic_id = '$topic_id'", "INNER" );
                } else{
                    $this->db->join("topic_association ta","ta.post_id = s.id AND ta.type = 'Survey'","INNER");
                }
                $this -> db -> where( "s.is_approved = '1' AND s.is_active = '1' $exclude_private_topic_ids" );
                if ( ! empty( $followed_questions_ids ) ) {
                        $this -> db -> where_in( "s.id", $followed_questions_ids );
                }
                $this->db->group_by("s.id");
                $this -> db -> order_by( "$is_new $engagement_order s.id DESC" );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $trending_questions = $this -> db -> get() -> result_array();
                //echo $this->db->last_query();exit;
                $allids = array ();
                foreach ( $trending_questions as $key => $survey_data ) {
                        $id = $survey_data[ 'id' ];
                        //trending question will load these details not required
                        $allids[] = $id;
                }

                if ( ! empty( $allids ) ) {
                        $counttoberemoved = $this -> remove_votes_count( $allids );
                }

                for ( $i = 0; $i < count( $trending_questions ); $i ++ ) {
                        foreach ( $counttoberemoved as $av ) {
                                if ( $av[ 'poll_id' ] == $trending_questions[ $i ][ 'id' ] ) {
                                        $trending_questions[ $i ][ 'total_votes' ] = ( string ) ($trending_questions[ $i ][ 'total_votes' ] - $av[ 'count' ]);
                                }
                        }
                }

                return array ( "status" => TRUE, "message" => "", "data" => $trending_questions );

        }

        function remove_votes_count( $id ) {
                $arr = true;

                if ( ! is_array( $id ) ) {
                        $arr = false;
                        $id = array ( $id );
                }
                $id = implode( ',', $id );
                $query = "select COUNT(1) count, sa.poll_id 
                        from survey_action sa 
                        INNER JOIN survey_choices sc on sc.choice = 'See the Results'
                        WHERE sa.poll_id in ($id) AND sa.choice = sc.id group by poll_id;";
                if ( $arr )
                        $result = $this -> db -> query( $query ) -> result_array();
                else
                        $result = $this -> db -> query( $query ) -> row_array();

                //See the results counts should not be calculated
                return $result;

        }

        function remove_prediction_votes_count( $id ) {
                $arr = true;

                if ( ! is_array( $id ) ) {
                        $arr = false;
                        $id = array ( $id );
                }
                $id = implode( ',', $id );

                $query = "select COUNT(1) as count, pa.poll_id
                    from poll_action pa 
                    INNER JOIN poll_choices pc ON pc.choice = 'See the Results'
                    WHERE pa.poll_id in ($id) AND pa.choice = pc.id group by poll_id";
                if ( $arr )
                        $result = $this -> db -> query( $query ) -> result_array();
                else
                        $result = $this -> db -> query( $query ) -> row_array();

                return $result;

        }

        function get_topics_list( $user_id = 0 ) {

                //check users following topics
                $followed_result = $this -> get_followed_topics( $user_id );
                $last24hour_result = array ();
                /* Get topics raised in last 24 hour - START */
//                $this -> db -> select( "t.id, t.topic, t.image, t.icon, COALESCE(utf.is_follow,0) as is_follow" );
//                $this -> db -> from( "topics t" );
//                $this -> db -> join( "users_followed_topics utf", "utf.topic_id = t.id AND utf.user_id = '$user_id' AND utf.is_follow = '1'", "LEFT" );
//                $this -> db -> where( "(t.created_date) >= (now() - INTERVAL 24 hour) AND t.is_active = '1'" );
//                $this -> db -> order_by( "t.id DESC" );
//                $last24hour_result = $this -> db -> get() -> result_array();
                /* Get Prediction raised in last 24 hour - END */

//                $last24hourids = "";
//
//                if ( ! empty( $last24hour_result ) ) {
//                        foreach ( $last24hour_result as $key => $last24hour_data ) {
//                                $last24hourids .= $last24hour_data[ 'id' ] . ",";
//                        }
//                        $last24hourids = chop( $last24hourids, "," );
//                }
//                
                //Latest First - not in use now
                /* $is_new = "";
                  if ( $last24hourids != "" ) {
                  $is_new = "FIELD(t.id, $last24hourids) DESC,";
                  } */

                /* Get Trending Topic - START */
                $this -> db -> select( "t.id, t.topic, t.image, t.icon" );
                $this -> db -> from( "topics t" );
                $this -> db -> where( "t.is_active = '1' AND is_trending = '1' AND t.is_private = '0'" );
                $this -> db -> order_by( "modified_date DESC" );
                $trending_topic_result = $this -> db -> get() -> result_array();
                /* Get Trending Topic - END */

                $sessiondata = $this->session->userdata('data');
                $logged_in_user_email = "";
                if (!empty($sessiondata)) {
                    $logged_in_user_email = $sessiondata['email'];
                    
                    $this->db->select("t.id, t.topic, t.image, t.icon");
                    $this->db->from("topics t");
                    $this->db->where("t.is_active = '1' AND t.is_private = '1' AND FIND_IN_SET('$logged_in_user_email',t.email_ids)");
                    $private_topics = $this->db->get()->result_array();
                    //print_r($private_topics);
                }
                
                $follow_column = "";
                $follow_order = "";
                if ( ! empty( $followed_result ) ) {
                        $follow_column = ", COALESCE(utf.is_follow,0) as is_follow";
                        $follow_order = " is_follow DESC, ";
                }

                $this -> db -> select( "t.id, t.topic, t.image, t.icon $follow_column" );
                $this -> db -> from( "topics t" );
                if ( ! empty( $followed_result ) ) {
                        $this -> db -> join( "users_followed_topics utf", "utf.topic_id = t.id AND utf.user_id = '$user_id' AND utf.is_follow = '1'", "LEFT" );
                }
                if (!empty($sessiondata)) {
                    $this->db->where("t.is_active = '1' AND (t.is_private = '0' OR (t.is_private = '1' AND FIND_IN_SET('$logged_in_user_email',REPLACE(t.email_ids,' ',''))))");
                }else{
                    $this -> db -> where( "t.is_active = '1' AND t.is_private = '0'" );    
                }
                
                $this -> db -> order_by( "$follow_order t.id DESC" );
                $result = $this -> db -> get() -> result_array();
                
                if ( ! empty( $followed_result ) ) {
                        $result = array_merge( $last24hour_result, $trending_topic_result, $result );
                } else {
                        $result = array_merge( $trending_topic_result, $result );
                }
                foreach ( $result as $key => $topic_data ) {
                        if ( ! isset( $topic_data[ 'is_follow' ] ) ) {
                                $topic_data[ 'is_follow' ] = 0;
                        }
                        $result[ $key ][ 'is_follow' ] = ( int ) $topic_data[ 'is_follow' ];
                }
        
                return array ( "status" => TRUE, "message" => $logged_in_user_email, "data" => $result );

        }

        function follow_topic( $inputs ) {
                $user_id = $inputs[ 'user_id' ];
                $topic_id = $inputs[ 'topic_id' ];
                $is_follow = filter_var( $inputs[ 'is_follow' ], FILTER_VALIDATE_BOOLEAN ) ? 1 : 0;

                /* Check follow exists */
                $this -> db -> select( "1" );
                $this -> db -> from( "users_followed_topics uft" );
                $this -> db -> where( array ( "user_id" => $user_id, "topic_id" => $topic_id ) );
                $result = $this -> db -> get();
                $is_exists = $result -> num_rows();

                if ( $is_exists == 0 ) {
                        $insert_array = array (
                            "user_id" => $user_id,
                            "topic_id" => $topic_id,
                            "is_follow" => $is_follow
                        );
                        $this -> db -> insert( "users_followed_topics", $insert_array );

                        return array ( "status" => TRUE, "message" => "Topic followed", "is_follow" => $is_follow, "data" => "" );
                } else {
                        $update_array = array (
                            "is_follow" => $is_follow
                        );
                        $this -> db -> where( array ( "user_id" => $user_id, "topic_id" => $topic_id ) );
                        $this -> db -> update( "users_followed_topics", $update_array );

                        return array ( "status" => TRUE, "message" => "Topic followed", "is_follow" => $is_follow, "data" => "" );
                }

        }

        function get_topic_detail( $inputs ) {
                $id = $inputs[ 'id' ];
                $user_id = $inputs[ 'user_id' ];

                $is_user_follow_cond = "";
                $is_user_join_cond = "";
                if ( $user_id > 0 ) {
                        $is_user_follow_cond = ", COALESCE(utf.is_follow,0) as is_follow";
                        $is_user_join_cond = ", COALESCE(ujf.is_join,0) as is_join";
                }
                $this -> db -> select( "t.id, t.topic, t.image, t.is_private, t.email_ids $is_user_follow_cond $is_user_join_cond" );
                $this -> db -> from( "topics t" );
                if ( $user_id > 0 ) {
                        $this -> db -> join( "users_followed_topics utf", "utf.topic_id = t.id AND utf.user_id = '$user_id'", "LEFT" );
                        $this -> db -> join( "users_joined_topics ujf", "ujf.topic_id = t.id AND ujf.user_id = '$user_id'", "LEFT" );
                }
                $this -> db -> where( "t.is_active = '1' AND t.id = '$id'" );
                $result = $this -> db -> get() -> row_array();

                return array ( "status" => TRUE, "message" => "", "data" => $result );

        }
        
        function join_topic( $inputs ) {
                $user_id = $inputs[ 'user_id' ];
                $topic_id = $inputs[ 'topic_id' ];
                $is_join = filter_var( $inputs[ 'is_join' ], FILTER_VALIDATE_BOOLEAN ) ? 1 : 0;

                /* Check follow exists */
                $this -> db -> select( "1" );
                $this -> db -> from( "users_joined_topics ujt" );
                $this -> db -> where( array ( "user_id" => $user_id, "topic_id" => $topic_id ) );
                $result = $this -> db -> get();
                $is_exists = $result -> num_rows();

                if ( $is_exists == 0 ) {
                        $insert_array = array (
                            "user_id" => $user_id,
                            "topic_id" => $topic_id,
                            "is_join" => $is_join
                        );
                        $this -> db -> insert( "users_joined_topics", $insert_array );

                        return array ( "status" => TRUE, "message" => "Topic joined", "is_join" => $is_join, "data" => "" );
                } else {
                        $update_array = array (
                            "is_join" => $is_join
                        );
                        $this -> db -> where( array ( "user_id" => $user_id, "topic_id" => $topic_id ) );
                        $this -> db -> update( "users_joined_topics", $update_array );

                        return array ( "status" => TRUE, "message" => "Topic joined", "is_join" => $is_join, "data" => "" );
                }

        }

}
