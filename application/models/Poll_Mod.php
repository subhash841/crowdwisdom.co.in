<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Poll_Mod extends CI_Model {

        protected $choicepoints = 0;

        function __construct() {
                parent::__construct();
                $this -> choicepoints = 500;
        }

        function get_poll_by_category( $category, $user_id, $pollid = 0, $offset = 0, $limit = 10 ) {
                if ( is_numeric( $category ) ) {
                        $newcategory = $category;
                } else {
                        $newcategory = 1;
                }

                /* Get user voted Poll - START */
                $voted_poll = "";
                $uservoted_cond = "";
                $uservoted_cond_order_by = "";

                if ( $user_id > 0 ) {
                        $users_voted_surveys = "SELECT poll_id FROM poll_action WHERE user_id = '$user_id' AND action= 'Vote'";
                        $users_voted_data = $this -> db -> query( $users_voted_surveys ) -> result_array();

                        foreach ( $users_voted_data as $key => $data ) {
                                $voted_poll .= $data[ 'poll_id' ] . ",";
                        }
                        $voted_poll = chop( $voted_poll, "," );

                        $uservoted_cond = ",(SELECT count(1) from poll_action where poll_id = p.id AND action= 'Vote' AND user_id='$user_id') as is_user_voted";
                        $uservoted_cond_order_by = "is_user_voted ASC,";
                }
                /* Get user voted surveys - END */

                $remove_from_last1_hour = "";
                $myvoted_cond = "";
                if ( $voted_poll != "" ) {
                        $remove_from_last1_hour = " AND p.id not in ($voted_poll)";
                        $myvoted_cond = "AND pa.poll_id not in ($voted_poll)";
                }

                /* Get Surveys raised in last 1 hour - START */
                $this -> db -> select( "p.id" );
                $this -> db -> from( "poll p" );
                $this -> db -> where( "(p.created_date + INTERVAL 20 MINUTE) >= (now() - INTERVAL 1 hour) AND p.is_active = '1' $remove_from_last1_hour" );
                $last1hour_result = $this -> db -> get() -> result_array();
                /* Get Surveys raised in last 1 hour - END */

                /* Get highest voted polls in Last 4 hours - START */
                $fourhourvotedids = "";

                $this -> db -> select( "pa.poll_id, pa.category_id, count(1) as max_votes" );
                $this -> db -> from( "poll_action pa" );
                $this -> db -> where( "(now() - interval 4 hour <= pa.created_date) AND pa.category_id = '$newcategory' AND pa.action= 'Vote' $myvoted_cond" );
                $this -> db -> group_by( "pa.poll_id" );
                $this -> db -> order_by( "max_votes ASC" );
                $this -> db -> order_by( "pa.poll_id ASC" );
                $result = $this -> db -> get();
                $last_four_hour_max_voted = $result -> result_array();

                /* Get highest voted polls in Last 4 hours - START */

                /* remove id exists in last 1 hour raised from last 4 hours max voted - START */
                $last1hourids = "";

                if ( ! empty( $last1hour_result ) ) {
                        foreach ( $last1hour_result as $key => $last1hour_data ) {

                                $key = $this -> searchForId( $last1hour_data[ 'id' ], $last_four_hour_max_voted );
                                if ( $key !== null ) {
                                        unset( $last_four_hour_max_voted[ $key ] );
                                }
                                $last1hourids .= $last1hour_data[ 'id' ] . ",";
                        }
                        $last1hourids = chop( $last1hourids, "," );
                }
                /* remove id exists in last 1 hour raised from last 4 hours max voted - START */

                foreach ( $last_four_hour_max_voted as $four_hour_data ) {
                        $fourhourvotedids .= $four_hour_data[ "poll_id" ] . ",";
                }
                $fourhourvotedids = chop( $fourhourvotedids, "," );

                /* Get highest voted polls in Last 24 hours - START */
                $remove_from_24_hours_if_in_4_hours = "";
                if ( $fourhourvotedids != "" ) {
                        $remove_from_24_hours_if_in_4_hours = " AND pa.poll_id not in ($fourhourvotedids)";
                }
                $tweentythourvotedids = "";

                $this -> db -> select( "pa.poll_id, pa.category_id, count(1) as max_votes" );
                $this -> db -> from( "poll_action pa" );
                $this -> db -> where( "(now() - interval 24 hour <= pa.created_date) AND pa.category_id = '$newcategory' AND pa.action= 'Vote' $myvoted_cond $remove_from_24_hours_if_in_4_hours" );
                $this -> db -> group_by( "pa.poll_id" );
                $this -> db -> order_by( "max_votes ASC" );
                $this -> db -> order_by( "pa.poll_id ASC" );
                $result = $this -> db -> get();
                $last_tweenty_four_hour_max_voted = $result -> result_array();

                /* remove id exists in last 1 hour raised from last 24 hours max voted - START */
                $last1hourids_in24hour = "";

                if ( ! empty( $last1hour_result ) ) {
                        foreach ( $last1hour_result as $key => $last1hour_data ) {

                                $key = $this -> searchForId( $last1hour_data[ 'id' ], $last_tweenty_four_hour_max_voted );
                                if ( $key !== null ) {
                                        unset( $last_tweenty_four_hour_max_voted[ $key ] );
                                }
                                $last1hourids_in24hour .= $last1hour_data[ 'id' ] . ",";
                        }
                        $last1hourids_in24hour = chop( $last1hourids_in24hour, "," );
                }
                /* remove id exists in last 1 hour raised from last 24 hours max voted - START */

                foreach ( $last_tweenty_four_hour_max_voted as $tweenty_four_hour_data ) {
                        $tweentythourvotedids .= $tweenty_four_hour_data[ "poll_id" ] . ",";
                }
                $tweentythourvotedids = chop( $tweentythourvotedids, "," );

                /* Get highest voted polls in Last 24 hours - END */

                $this -> db -> select( "p.*,pc.name as category_name,u.alise as byuser,"
                        . "(SELECT choice from poll_action  where poll_id = p.id AND action= 'Vote' AND user_id=" . $user_id . ") as user_choice,"
                        . "(CASE WHEN p.end_date < now() - INTERVAL 1 DAY THEN 1 ELSE 0 END ) as expired $uservoted_cond" );
                $this -> db -> from( "poll p" );
                $this -> db -> join( "poll_category pc", "pc.id=p.category_id", "INNER" );
                $this -> db -> join( "users u", "u.id=p.user_id", "LEFT" );
                $this -> db -> where( "p.is_active = '1'" );
                $this -> db -> where( "p.category_id", $category );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );

                //Latest First
                $is_new = "";
                if ( $last1hourids != "" ) {
                        $is_new = "FIELD(p.id, $last1hourids) DESC,";
                }

                //Most voted in last 4 hours
                $in_lastfourhours = "";
                if ( $fourhourvotedids != "" ) {
                        $in_lastfourhours = "FIELD(p.id, $fourhourvotedids) DESC,";
                }

                //Most voted in last 24 hours
                $in_last24hours = "";
                if ( $tweentythourvotedids != "" ) {
                        $in_last24hours = "FIELD(p.id, $tweentythourvotedids) DESC,";
                }

                $this -> db -> order_by( "expired ASC, $uservoted_cond_order_by $is_new $in_lastfourhours $in_last24hours p.id DESC" );
                $result = $this -> db -> get();

                //echo $this -> db -> last_query();exit;
                $categorydata = $result -> result_array();

                $allids = array ();
                foreach ( $categorydata as $key => $catd ) {
                        $id = $catd[ 'id' ];
                        $allids[] = $id;

                        $total_votes = $catd[ 'total_votes' ];
                        $categorydata[ $key ][ 'options' ] = $this -> calculateavgvotes( $id, $total_votes );

                        //$counttoberemoved = $this -> remove_votes_count( $id );
                        //$categorydata[ $key ][ 'total_votes' ] = $categorydata[ $key ][ 'total_votes' ] - $counttoberemoved;
                }

                $allcomments = $this -> get_all_poll_comments( $allids, 0, 2 );
                $commentcounts = $this -> get_poll_comments_count( $allids, 'All' );

                $counttoberemoved = $this -> remove_prediction_votes_count( $allids );

                for ( $i = 0; $i < count( $categorydata ); $i ++ ) {

                        foreach ( $allcomments as $av ) {
                                if ( $av[ 'poll_id' ] == $categorydata[ $i ][ 'id' ] ) {
                                        $categorydata[ $i ][ 'All_comments' ][] = $av;
                                }
                        }

                        foreach ( $commentcounts as $av ) {
                                if ( $av[ 'poll_id' ] == $categorydata[ $i ][ 'id' ] ) {
                                        $categorydata[ $i ][ 'total_comments' ] = $av[ 'count' ];
                                }
                        }

                        foreach ( $counttoberemoved as $av ) {
                                if ( $av[ 'poll_id' ] == $categorydata[ $i ][ 'id' ] ) {
                                        $categorydata[ $i ][ 'total_votes' ] = $categorydata[ $i ][ 'total_votes' ] - $av[ 'count' ];
                                }
                        }
                }

                return $categorydata;
        }

        function get_poll_by_category1( $category, $user_id, $pollid = 0, $offset = 0, $limit = 10 ) {
                /* if you want to add trending by 4 hours */

                if ( is_numeric( $category ) ) {
                        $newcategory = $category;
                } else {
                        $newcategory = 1;
                }

                /* Get user voted Poll - START */
                $voted_survey = "";
                $uservoted_cond = "";
                $uservoted_cond_order_by = "";

                if ( $user_id > 0 ) {
                        $users_voted_surveys = "SELECT poll_id FROM poll_action WHERE user_id = '$user_id' AND action= 'Vote'";
                        $users_voted_data = $this -> db -> query( $users_voted_surveys ) -> result_array();

                        foreach ( $users_voted_data as $key => $data ) {
                                $voted_survey .= $data[ 'poll_id' ] . ",";
                        }
                        $voted_survey = chop( $voted_survey, "," );

                        $uservoted_cond = ",(SELECT count(1) from poll_action where poll_id = p.id AND action= 'Vote' AND user_id='$user_id') as is_user_voted";
                        $uservoted_cond_order_by = "is_user_voted ASC,";
                }
                /* Get user voted surveys - END */

                $remove_from_last1_hour = "";
                $myvoted_cond = "";
                if ( $voted_survey != "" ) {
                        $remove_from_last1_hour = " AND p.id not in ($voted_survey)";
                        $myvoted_cond = "AND pa.poll_id not in ($voted_survey)";
                }

                /* Get Surveys raised in last 1 hour - START */
                $this -> db -> select( "p.id" );
                $this -> db -> from( "poll p" );
                $this -> db -> where( "(p.created_date + INTERVAL 20 MINUTE) >= (now() - INTERVAL 1 hour) AND p.is_active = '1' $remove_from_last1_hour" );
                $last1hour_result = $this -> db -> get() -> result_array();
                /* Get Surveys raised in last 1 hour - END */

                /* Get highest voted polls in Last 4 hours - START */
                $fourhourvotedids = "";

                $this -> db -> select( "pa.poll_id, pa.category_id, count(1) as max_votes" );
                $this -> db -> from( "poll_action pa" );
                $this -> db -> where( "(now() - interval 4 hour <= pa.created_date) AND pa.category_id = '$newcategory' AND pa.action= 'Vote' $myvoted_cond" );
                $this -> db -> group_by( "pa.poll_id" );
                $this -> db -> order_by( "max_votes ASC" );
                $this -> db -> order_by( "pa.poll_id ASC" );
                $result = $this -> db -> get();
                $last_four_hour_max_voted = $result -> result_array();

                /* Get highest voted polls in Last 4 hours - START */

                /* remove id exists in last 1 hour raised from last 4 hours max voted - START */
                $last1hourids = "";

                if ( ! empty( $last1hour_result ) ) {
                        foreach ( $last1hour_result as $key => $last1hour_data ) {

                                $key = $this -> searchForId( $last1hour_data[ 'id' ], $last_four_hour_max_voted );
                                if ( $key !== null ) {
                                        unset( $last_four_hour_max_voted[ $key ] );
                                }
                                $last1hourids .= $last1hour_data[ 'id' ] . ",";
                        }
                        $last1hourids = chop( $last1hourids, "," );
                }
                /* remove id exists in last 1 hour raised from last 4 hours max voted - START */

                foreach ( $last_four_hour_max_voted as $four_hour_data ) {
                        $fourhourvotedids .= $four_hour_data[ "poll_id" ] . ",";
                }
                $fourhourvotedids = chop( $fourhourvotedids, "," );

                /* Get highest voted polls in Last 4 hours - END */

                /* Get highest voted polls in Last 24 hours - START */
                $tweentythourvotedids = "";

                $this -> db -> select( "pa.poll_id, pa.category_id, count(1) as max_votes" );
                $this -> db -> from( "poll_action pa" );
                $this -> db -> where( "(now() - interval 24 hour <= pa.created_date) AND pa.category_id = '$newcategory' AND pa.action= 'Vote' $myvoted_cond" );
                $this -> db -> group_by( "pa.poll_id" );
                $this -> db -> order_by( "max_votes ASC" );
                $this -> db -> order_by( "pa.poll_id ASC" );
                $result = $this -> db -> get();
                $last_tweenty_four_hour_max_voted = $result -> result_array();

                /* remove id exists in last 1 hour raised from last 24 hours max voted - START */
                $last1hourids_in24hour = "";

                if ( ! empty( $last1hour_result ) ) {
                        foreach ( $last1hour_result as $key => $last1hour_data ) {

                                $key = $this -> searchForId( $last1hour_data[ 'id' ], $last_tweenty_four_hour_max_voted );
                                if ( $key !== null ) {
                                        unset( $last_tweenty_four_hour_max_voted[ $key ] );
                                }
                                $last1hourids_in24hour .= $last1hour_data[ 'id' ] . ",";
                        }
                        $last1hourids_in24hour = chop( $last1hourids_in24hour, "," );
                }
                /* remove id exists in last 1 hour raised from last 24 hours max voted - START */

                foreach ( $last_tweenty_four_hour_max_voted as $tweenty_four_hour_data ) {
                        $tweentythourvotedids .= $tweenty_four_hour_data[ "poll_id" ] . ",";
                }
                $tweentythourvotedids = chop( $tweentythourvotedids, "," );

                /* Get highest voted polls in Last 24 hours - END */

                /* end */
                //GROUP_CONCAT(pc1.id) as choice_id,GROUP_CONCAT(pc1.choice) as choice,
                //(CASE WHEN p.created_date >= (now() - interval 20 MINUTE) THEN 1 ELSE 0 END) as is_new,
                $this -> db -> select( "p.*,pc.name as category_name,u.alise as byuser,"
                        . "(SELECT choice from poll_action  where poll_id = p.id AND action= 'Vote' AND user_id=" . $user_id . ") as user_choice,"
                        . "(CASE WHEN p.end_date < now() - INTERVAL 1 DAY THEN 1 ELSE 0 END ) as expired $uservoted_cond" );

                $this -> db -> from( "poll p" );
                $this -> db -> join( "poll_category pc", "pc.id=p.category_id", "INNER" );
                //$this -> db -> join( 'poll_choices pc1', 'pc1.poll_id=p.id' );
                $this -> db -> join( "users u", "u.id=p.user_id", "LEFT" );

                if ( $category == "voted" ) {
                        $this -> db -> where( "p.id IN (select poll_id from poll_action where user_id=$user_id)" );
                } else if ( $category == "notvoted" ) {
                        $this -> db -> where( "p.id NOT IN (select poll_id from poll_action where user_id=$user_id)" );
                } else if ( $category == "trending" ) {
                        $this -> db -> order_by( 'p.total_votes', 'DESC' );
                } else if ( $category == "myraised" ) {
                        $this -> db -> where( 'p.user_id', $user_id );
                } else {

                        $this -> db -> where( "p.category_id", $category );

                        $is_new = "";
                        if ( $last1hourids != "" ) {
                                $is_new = "FIELD(p.id, $last1hourids) DESC,";
                        }

                        $is_new_24hour = "";
                        if ( $last1hourids_in24hour != "" ) {
                                $is_new_24hour = "FIELD(p.id, $last1hourids_in24hour) DESC,";
                        }

                        $pollid_also = "";
                        if ( $fourhourvotedids != "" ) {
                                if ( $pollid != 0 && $offset == 0 ) {
                                        $pollid_also = "," . $pollid;
                                }
                                $fourhourvotedids = $fourhourvotedids . "" . $pollid_also;
                                $this -> db -> order_by( "expired ASC, $is_new $uservoted_cond_order_by FIELD(p.id, $fourhourvotedids) DESC,p.end_date DESC" );
                        } else if ( $tweentythourvotedids != "" ) {
                                if ( $pollid != 0 && $offset == 0 ) {
                                        $pollid_also = "," . $pollid;
                                }
                                $tweentythourvotedids = $tweentythourvotedids . "" . $pollid_also;
                                $this -> db -> order_by( "expired ASC, $is_new_24hour $uservoted_cond_order_by FIELD(p.id, $tweentythourvotedids) DESC,p.end_date DESC" );
                        } else if ( $pollid != 0 && $offset == 0 ) {
                                $pollid_also = $pollid;
                                $fourhourvotedids = $fourhourvotedids . "" . $pollid_also;
                                $this -> db -> order_by( "expired ASC, $is_new $uservoted_cond_order_by FIELD(p.id, $fourhourvotedids) DESC,p.end_date DESC" );
                        } else {
                                $this -> db -> order_by( "expired ASC, $uservoted_cond_order_by p.total_votes DESC, p.end_date DESC" );
                        }

                        if ( $pollid != 0 && $offset == 0 ) {
                                //$this->db->order_by("FIELD(p.id, $pollid) DESC,p.id");
                        } else if ( $pollid != 0 && $offset > 0 ) {
                                //$this->db->order_by("p.id"); 
                                $this -> db -> where( "p.id<>", $pollid );
                        }
                }

                $this -> db -> where( "p.is_active", 1 );
                if ( $category != "myraised" ) {
                        $this -> db -> where( 'p.is_approved', 1 );
                }
                //$this->db->where('date(p.end_date)>="'.date('Y-m-d').'"');
                //
        $this -> db -> group_by( 'p.id' );
                //$this->db->order_by('p.total_like DESC');

                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                //$this->db->order_by('trending', 'DESC');//four hours trending
                $result = $this -> db -> get();

                //echo $this->db->last_query();exit;
                $categorydata = $result -> result_array();

                $allids = array ();
                foreach ( $categorydata as $key => $catd ) {
                        $id = $catd[ 'id' ];
                        $allids[] = $id;

                        $total_votes = $catd[ 'total_votes' ];
                        $categorydata[ $key ][ 'options' ] = $this -> calculateavgvotes( $id, $total_votes );
                        //$categorydata[$key]['All_comments'] = $this->get_poll_comments($id, 0, 2);
                        //$categorydata[$key]['total_comments'] = $this->get_poll_comments_count($id, 'All');
                        //var_dump($total_votes);exit;

                        $counttoberemoved = $this -> remove_votes_count( $id );
                        $categorydata[ $key ][ 'total_votes' ] = $categorydata[ $key ][ 'total_votes' ] - $counttoberemoved;
                }

                $allcomments = $this -> get_all_poll_comments( $allids, 0, 2 );
                $commentcounts = $this -> get_poll_comments_count( $allids, 'All' );

                for ( $i = 0; $i < count( $categorydata ); $i ++ ) {

                        foreach ( $allcomments as $av ) {
                                if ( $av[ 'poll_id' ] == $categorydata[ $i ][ 'id' ] ) {
                                        $categorydata[ $i ][ 'All_comments' ][] = $av;
                                }
                        }

                        foreach ( $commentcounts as $av ) {
                                if ( $av[ 'poll_id' ] == $categorydata[ $i ][ 'id' ] ) {
                                        $categorydata[ $i ][ 'total_comments' ] = $av[ 'count' ];
                                }
                        }
                }

                return $categorydata;
        }

        function get_treding_predictions( $user_id, $offset = 0, $limit = 10 ) {

                /* Get user voted Poll - START */
                $voted_survey = "";
                $uservoted_cond = "";
                $uservoted_cond_order_by = "";

                if ( $user_id > 0 ) {
                        $users_voted_surveys = "SELECT poll_id FROM poll_action WHERE user_id = '$user_id' AND action= 'Vote'";
                        $users_voted_data = $this -> db -> query( $users_voted_surveys ) -> result_array();

                        foreach ( $users_voted_data as $key => $data ) {
                                $voted_survey .= $data[ 'poll_id' ] . ",";
                        }
                        $voted_survey = chop( $voted_survey, "," );

                        $uservoted_cond = ",(SELECT count(1) from poll_action where poll_id = p.id AND action= 'Vote' AND user_id = '$user_id') as is_user_voted";
                        $uservoted_cond_order_by = "is_user_voted ASC, ";
                }
                /* Get user voted surveys - END */

                $remove_from_last1_hour = "";
                $myvoted_cond = "";
                if ( $voted_survey != "" ) {
                        $remove_from_last1_hour = " AND p.id not in ($voted_survey)";
                        $myvoted_cond = "AND pa.poll_id not in ($voted_survey)";
                }

                /* Get Polls raised in last 1 hour - START */
                $this -> db -> select( "p.id" );
                $this -> db -> from( "poll p" );
                $this -> db -> where( "(p.created_date + INTERVAL 20 MINUTE) >= (now() - INTERVAL 1 hour) AND p.is_active = '1' $remove_from_last1_hour" );
                $last1hour_result = $this -> db -> get() -> result_array();
                /* Get Polls raised in last 1 hour - END */

                /* Get highest voted polls in Last 4 hours - START */
                $fourhourvotedids = "";

                $this -> db -> select( "pa.poll_id, pa.category_id, count(1) as max_votes" );
                $this -> db -> from( "poll_action pa" );
                $this -> db -> where( "(now() - interval 4 hour <= pa.created_date) AND pa.action= 'Vote' $myvoted_cond" ); //AND pa.category_id = '$newcategory'
                $this -> db -> group_by( "pa.poll_id" );
                $this -> db -> order_by( "max_votes ASC" );
                $this -> db -> order_by( "pa.poll_id ASC" );
                $result = $this -> db -> get();
                $last_four_hour_max_voted = $result -> result_array();

                /* Get highest voted polls in Last 4 hours - END */

                /* remove id exists in last 1 hour raised from last 4 hours max voted - START */
                $last1hourids = "";

                if ( ! empty( $last1hour_result ) ) {
                        foreach ( $last1hour_result as $key => $last1hour_data ) {

                                $key = $this -> searchForId( $last1hour_data[ 'id' ], $last_four_hour_max_voted );
                                if ( $key !== null ) {
                                        unset( $last_four_hour_max_voted[ $key ] );
                                }
                                $last1hourids .= $last1hour_data[ 'id' ] . ",";
                        }
                        $last1hourids = chop( $last1hourids, "," );
                }
                /* remove id exists in last 1 hour raised from last 4 hours max voted - END */

                foreach ( $last_four_hour_max_voted as $four_hour_data ) {
                        $fourhourvotedids .= $four_hour_data[ "poll_id" ] . ",";
                }
                $fourhourvotedids = chop( $fourhourvotedids, "," );

                /* Get highest voted polls in Last 4 hours - END */

                /* Get highest voted polls in Last 24 hours - START */
                $tweentythourvotedids = "";

                $this -> db -> select( "pa.poll_id, pa.category_id, count(1) as max_votes" );
                $this -> db -> from( "poll_action pa" );
                $this -> db -> where( "(now() - interval 24 hour <= pa.created_date) AND pa.action= 'Vote' $myvoted_cond" ); //AND pa.category_id = '$newcategory' 
                $this -> db -> group_by( "pa.poll_id" );
                $this -> db -> order_by( "max_votes ASC" );
                $this -> db -> order_by( "pa.poll_id ASC" );
                $result = $this -> db -> get();
                $last_tweenty_four_hour_max_voted = $result -> result_array();

                /* remove id exists in last 1 hour raised from last 24 hours max voted - START */
                $last1hourids_in24hour = "";

                if ( ! empty( $last1hour_result ) ) {
                        foreach ( $last1hour_result as $key => $last1hour_data ) {

                                $key = $this -> searchForId( $last1hour_data[ 'id' ], $last_tweenty_four_hour_max_voted );
                                if ( $key !== null ) {
                                        unset( $last_tweenty_four_hour_max_voted[ $key ] );
                                }
                                $last1hourids_in24hour .= $last1hour_data[ 'id' ] . ",";
                        }
                        $last1hourids_in24hour = chop( $last1hourids_in24hour, "," );
                }
                /* remove id exists in last 1 hour raised from last 24 hours max voted - END */

                foreach ( $last_tweenty_four_hour_max_voted as $tweenty_four_hour_data ) {
                        $tweentythourvotedids .= $tweenty_four_hour_data[ "poll_id" ] . ",";
                }
                $tweentythourvotedids = chop( $tweentythourvotedids, "," );

                /* Get highest voted polls in Last 24 hours - END */

                //Prediction Data fetching - START
                $this -> db -> select( "p.id, p.poll, p.total_votes, pc.name as category_name,"
                        . "(CASE WHEN p.end_date < now() - INTERVAL 1 DAY THEN 1 ELSE 0 END ) as expired $uservoted_cond" );
                $this -> db -> from( "poll p" );
                $this -> db -> join( "poll_category pc", "pc.id = p.category_id", "INNER" );

                $is_new = "";
                if ( $last1hourids != "" ) {
                        $is_new = "FIELD(p.id, $last1hourids) DESC,";
                }

                $is_new_24hour = "";
                if ( $last1hourids_in24hour != "" ) {
                        $is_new_24hour = "FIELD(p.id, $last1hourids_in24hour) DESC,";
                }

                $pollid_also = "";
                if ( $fourhourvotedids != "" ) {
                        $fourhourvotedids = $fourhourvotedids . "" . $pollid_also;
                        $this -> db -> order_by( "expired ASC, $is_new $uservoted_cond_order_by FIELD(p.id, $fourhourvotedids) DESC,p.end_date DESC" );
                } else if ( $tweentythourvotedids != "" ) {
                        $tweentythourvotedids = $tweentythourvotedids . "" . $pollid_also;
                        $this -> db -> order_by( "expired ASC, $is_new_24hour $uservoted_cond_order_by FIELD(p.id, $tweentythourvotedids) DESC,p.end_date DESC" );
                } else {
                        $this -> db -> order_by( "expired ASC, $uservoted_cond_order_by p.total_votes DESC, p.end_date DESC" );
                }

                $this -> db -> where( "p.is_approved = '1' AND p.is_active = '1'" );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $trending_result = $this -> db -> get() -> result_array();
                //echo $this->db->last_query();exit;
                //Prediction Data END

                foreach ( $trending_result as $key => $prediction_data ) {
                        $id = $prediction_data[ 'id' ];

                        $counttoberemoved = $this -> remove_votes_count( $id );
                        $trending_result[ $key ][ 'total_votes' ] = $trending_result[ $key ][ 'total_votes' ] - $counttoberemoved;
                }
                return $trending_result;
        }

        /*

         * param pollid is a poll for which comment is done
         * param user_id if a user from which comment is done
         * param poll_comment is a text for commment
         * param poll_cmt is a id of comment if you want to edit comment

         */

        function add_comment_mod( $pollid, $user_id, $poll_comment, $poll_cmt ) {
                $data = array (
                    "poll_id" => $pollid,
                    "user_id" => $user_id,
                    "comment" => $poll_comment,
                    "is_active" => 1,
                    "created_date" => date( 'Y-m-d H:i:s' )
                );
                $this -> db -> cache_delete_all();
                if ( $poll_cmt == 0 ) {
                        $this -> db -> insert( 'poll_comments', $data );
                        return $this -> db -> insert_id();
                } else {
                        $this -> db -> where( 'id', $poll_cmt );
                        $this -> db -> update( 'poll_comments', $data );
                        return $poll_cmt;
                }
        }

        /*

         * param pollid is a poll for which comment reply is done
         * param user_id if a user from which comment is done
         * param poll_comment_reply is a text for commment reply
         * param comment_id is a id of comment for which reply is done

         */

        function add_comment_reply_mod( $pollid, $user_id, $poll_comment_reply, $comment_id ) {
                $data = array (
                    "poll_id" => $pollid,
                    "comment_id" => $comment_id,
                    "user_id" => $user_id,
                    "reply" => $poll_comment_reply,
                    "is_active" => 1,
                    "created_date" => date( 'Y-m-d H:i:s' )
                );
                $this -> db -> cache_delete_all();
                $this -> db -> insert( 'poll_comment_reply', $data );
                return $this -> db -> insert_id();
        }

        /*

         * param input is array of post param includes 
          -poll_id -> poll is a id of that poll

         * param user_id if a user from which comment is done
         * param poll_comment_reply is a text for commment reply
         * param comment_id is a id of comment for which reply is done

         */

        function add_update_poll_mod( $input, $user_id ) {


                $pollid = $input[ 'poll_id' ];
                $polltopic = $this -> special_character( $input[ 'polltopic' ] );
                $pollcategory = $input[ 'pollcatergory' ];
//        $link = $input['detailurl'];
                $link = "";
                $choiceoption = $input[ 'choice' ];
                $polldescription = $this -> special_character( $input[ 'polldescription' ] );
                //$preview=urlencode($input['poll_preview']);
                $preview = htmlspecialchars( $input[ 'poll_preview' ] );
                $enddate = date( 'Y-m-d', strtotime( $input[ 'enddate' ] ) );
                $choiceoption = array_filter( $choiceoption );
                $this -> db -> cache_delete_all();
                if ( $pollid == "0" ) {
                        $insert = array (
                            "user_id" => $user_id,
                            "category_id" => $pollcategory,
                            'description' => $polldescription,
                            "poll" => $polltopic,
                            "url" => $link,
                            "is_active" => 1,
                            "end_date" => $enddate,
                            "preview" => $preview,
                            "created_date" => date( 'Y-m-d H:i:s' )
                        );

                        $this -> db -> insert( "poll", $insert );

                        $addedpollid = $this -> db -> insert_id();
                        foreach ( $choiceoption as $co ) {
                                $choiceinsert[] = array (
                                    "poll_id" => $addedpollid,
                                    "choice" => $this -> special_character( $co ),
                                    "is_active" => 1,
                                );
                        }
                        $staticvalue1[] = array (
                            "poll_id" => $addedpollid,
                            "choice" => "See the Results",
                            "is_active" => 1,
                        );
                        $staticvalue2[] = array (
                            "poll_id" => $addedpollid,
                            "choice" => "None of the above",
                            "is_active" => 1,
                        );
                        $staticvalue = array_merge( $staticvalue1, $staticvalue2 );
                        $choiceinsert = array_merge( $choiceinsert, $staticvalue );

                        //var_dump($choiceinsert);exit;


                        $this -> db -> insert_batch( 'poll_choices', $choiceinsert );
                        $points = array (
                            'poll_id' => $addedpollid,
                            'user_id' => $user_id,
                            'choice' => 0,
                            'points' => $this -> choicepoints,
                            'category_id' => $pollcategory,
                            'action' => 'Poll Raised'
                        );
                        $this -> db -> insert( "poll_action", $points );

                        $this -> db -> set( 'unearned_points', "unearned_points-$this -> choicepoints", FALSE );
                        $this -> db -> where( "id", $user_id );
                        $this -> db -> update( 'users' );
                        $sessiondata = $this -> session -> userdata( 'data' );
                        $_SESSION[ 'data' ][ 'silver_points' ] = $sessiondata[ 'silver_points' ] - 500;
                        return $addedpollid;
                } else {
                        $update = array (
                            "category_id" => $pollcategory,
                            "poll" => $polltopic,
                            'description' => $polldescription,
                            "url" => $link,
                            "is_active" => 1,
                            "is_approved" => 0,
                            "total_votes" => 0,
                            "total_comments" => 0,
                            "preview" => $preview,
                            "end_date" => $enddate,
                        );

                        $this -> db -> where( "id = '$pollid'" );
                        $this -> db -> update( "poll", $update );

                        /* this will delete related choices,votes and comments and comment_reply after update */
                        $this -> db -> where( 'poll_id', $pollid );
                        $this -> db -> delete( 'poll_choices' );

                        $this -> db -> where( 'poll_id', $pollid );
                        $this -> db -> where( 'action', 'Vote' );
                        $this -> db -> delete( 'poll_action' );

                        $this -> db -> where( 'poll_id', $pollid );
                        $this -> db -> delete( 'poll_comments' );

                        $this -> db -> where( 'poll_id', $pollid );
                        $this -> db -> delete( 'poll_comment_reply' );

                        foreach ( $choiceoption as $co ) {
                                $choiceinsert[] = array (
                                    "poll_id" => $pollid,
                                    "choice" => $co,
                                    "is_active" => 1,
                                );
                        }
                        $staticvalue1[] = array (
                            "poll_id" => $pollid,
                            "choice" => "See the Results",
                            "is_active" => 1,
                        );
                        $staticvalue2[] = array (
                            "poll_id" => $pollid,
                            "choice" => "None of the above",
                            "is_active" => 1,
                        );
                        $staticvalue = array_merge( $staticvalue1, $staticvalue2 );
                        $choiceinsert = array_merge( $choiceinsert, $staticvalue );
                        $this -> db -> insert_batch( 'poll_choices', $choiceinsert );

                        return $pollid;
                }
        }

        function add_poll_action( $forumid, $userid, $type ) {
                $data = array (
                    'poll_id' => $forumid,
                    'user_id' => $userid,
                );
                if ( $type == "like" ) {
                        $data[ 'likes' ] = 1;
                        $data[ 'dislikes' ] = 0;
                        $data[ 'neutral' ] = 0;
                } else if ( $type == "dislike" ) {
                        $data[ 'likes' ] = 0;
                        $data[ 'dislikes' ] = 1;
                        $data[ 'neutral' ] = 0;
                } else if ( $type == "neutral" ) {
                        $data[ 'likes' ] = 0;
                        $data[ 'dislikes' ] = 0;
                        $data[ 'neutral' ] = 1;
                }
                $this -> db -> select( 'id' );
                $this -> db -> where( 'poll_id', $forumid );
                $this -> db -> where( 'user_id', $userid );
                $this -> db -> from( 'poll_action' );
                $result = $this -> db -> get();
                if ( $result -> num_rows() > 0 ) {
                        $currentaction = $result -> row_array();
                        $this -> db -> where( 'id', $currentaction[ 'id' ] );
                        $this -> db -> update( 'poll_action', $data );
                        return 0;
                } else {
                        $this -> db -> insert( 'poll_action', $data );
                        return 1;
                }
        }

        //,GROUP_CONCAT(pc1.id) as choice_id,GROUP_CONCAT(pc1.choice) as choice,
        function get_poll_by_id( $id, $user_id, $offset = 0, $limit = 10 ) {
                $this -> db -> select( "p.*,pc.name as category_name,u.alise as byuser,"
                        . "(SELECT choice from poll_action  where poll_id = p.id AND  action= 'Vote' AND user_id=" . $user_id . ") as user_choice" );
                $this -> db -> from( 'poll p' );
                $this -> db -> join( 'poll_category pc', 'pc.id=p.category_id' );
                //$this -> db -> join( 'poll_choices pc1', 'pc1.poll_id=p.id' );
                $this -> db -> join( 'users u', 'u.id=p.user_id', "LEFT" );
                $this -> db -> where( 'p.id', $id );
                $this -> db -> where( 'p.is_active', 1 );
                $this -> db -> where( 'p.is_approved', 1 );
                //$this->db->where('date(p.end_date)>="'.date('Y-m-d').'"');
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $result = $this -> db -> get();
                $mydiscussion = $result -> row_array();


                $id = $mydiscussion[ 'id' ];
                $total_votes = $mydiscussion[ 'total_votes' ];
                $mydiscussion[ 'options' ] = $this -> calculateavgvotes( $id, $total_votes );
                $mydiscussion[ 'All_comments' ] = $this -> get_poll_comments( $id, 0, 2 );
                $mydiscussion[ 'total_comments' ] = $this -> get_poll_comments_count( $id, 'All' );
                //var_dump($total_votes);exit;

                $data = array ();
                $poll_id = $mydiscussion[ 'id' ];

                //get the total count to be subtracted of "See the Results" Option
                $counttoberemoved = $this -> remove_votes_count( $poll_id );

                $mydiscussion[ 'total_votes' ] = $mydiscussion[ 'total_votes' ] - $counttoberemoved;

                $data = $mydiscussion;

                return $data;
        }

        function calculateavgvotes( $id, $total_votes ) {
                $this -> db -> select( 'count(1) as actualvotes' );
                $this -> db -> from( 'poll_action pa' );
                $this -> db -> join( 'poll_choices polc', 'polc.id=pa.choice', 'Inner' );
                $this -> db -> where( 'pa.poll_id', $id );
                $this -> db -> where( 'polc.choice !=', "See the Results" );
                $donknw = $this -> db -> get() -> row_array();
                $total_votes = $donknw[ 'actualvotes' ];

                $this -> db -> select( 'pc1.id as choice_id,pc1.choice' );
                $this -> db -> from( 'poll_choices pc1' );
                $this -> db -> where( 'pc1.poll_id', $id );
                $this -> db -> group_by( 'pc1.id' );
                $choices = $this -> db -> get() -> result_array();

                $ch_ids = array ();
                foreach ( $choices as $key => $c1 ) {
                        $ch_ids[] = $c1[ 'choice_id' ];
                }

                $this -> db -> select( 'count(1) as total, choice' );
                $this -> db -> from( 'poll_action' );
                $this -> db -> where_in( 'choice', $ch_ids );
                $this -> db -> where( 'poll_id', $id );
                $this -> db -> group_by( 'choice' );
                $resultcount = $this -> db -> get();
                $count_array = $resultcount -> result_array();

                foreach ( $choices as $key => $c1 ) {

                        $choices[ $key ][ 'total' ] = 0;
                        foreach ( $count_array as $count_data ) {
                                if ( $choices[ $key ][ 'choice_id' ] == $count_data[ 'choice' ] ) {
                                        $choices[ $key ][ 'total' ] = $count_data[ 'total' ];
                                }
                        }

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

        function get_poll_comments_count( $id, $type ) {

                $arr = true;
                if ( ! is_array( $id ) ) {
                        $arr = false;
                        $id = array ( $id );
                }
                $this -> db -> select( "count(1) as count, pcmts.poll_id as poll_id" );
                $this -> db -> from( 'poll_comments pcmts' );
                //$this->db->join('survey_action facts', 'facts.user_id=fcmts.user_id AND facts.poll_id=fcmts.poll_id');
                $this -> db -> where_in( 'pcmts.poll_id', $id );

                $this -> db -> where( 'pcmts.is_active', 1 );
//        if ($type == "like") {
//            $this->db->where('facts.likes', 1);
//        } else if ($type == "dislike") {
//            $this->db->where('facts.dislikes', 1);
//        } else if ($type == "neutral") {
//            $this->db->where('facts.neutral', 1);
//        } else {
//            
//        }

                if ( $arr ) {
                        $this -> db -> group_by( 'pcmts.poll_id' );
                        $result = $this -> db -> get() -> result_array();
                } else {
                        $result = $this -> db -> get() -> row_array()[ 'count' ];
                }
                return $result;
        }

        function get_poll_comments_count1( $id, $type ) {

                $this -> db -> select( "count(1) as count" );
                $this -> db -> from( 'poll_comments pcmts' );
                //$this->db->join('poll_action facts', 'facts.user_id=fcmts.user_id AND facts.poll_id=fcmts.poll_id');
                $this -> db -> where( 'pcmts.poll_id', $id );
                $this -> db -> where( 'pcmts.is_active', 1 );
//        if ($type == "like") {
//            $this->db->where('facts.likes', 1);
//        } else if ($type == "dislike") {
//            $this->db->where('facts.dislikes', 1);
//        } else if ($type == "neutral") {
//            $this->db->where('facts.neutral', 1);
//        } else {
//            
//        }
                $result = $this -> db -> get() -> row_array();
                return $result[ 'count' ];
        }

        function get_comment_by_id( $id ) {
                $this -> db -> select( "*" );
                $this -> db -> from( 'poll_comments' );
                $this -> db -> where( 'id', $id );
                $this -> db -> where( 'is_active', 1 );
                $result = $this -> db -> get() -> row_array();
                return $result;
        }

        function get_comment_reply_by_id( $id ) {
                $this -> db -> select( "*" );
                $this -> db -> from( 'poll_comment_reply' );
                $this -> db -> where( 'id', $id );
                $result = $this -> db -> get() -> row_array();
                return $result;
        }

        function get_all_poll_comments( $id, $offset = 0, $limit = 10 ) {

                $arr = true;

                if ( ! is_array( $id ) ) {
                        $arr = false;
                        $id = array ( $id );
                }
                $id = implode( ',', $id );

                $sql = "SELECT  *
                        FROM
                        (
                                SELECT pcmt.*, u.alise as byuser,
                                @rn := IF(@prev = pcmt.poll_id, @rn + 1, 1) AS rn,
                                @prev := pcmt.poll_id
                                FROM poll_comments pcmt
                                JOIN users u ON u.id=pcmt.user_id
                                JOIN (SELECT @prev := NULL, @rn := 0) AS vars
                                WHERE pcmt.poll_id IN($id)
                                AND pcmt.is_active = 1
                                ORDER BY pcmt.poll_id, pcmt.created_date DESC
                        ) AS T1
                        WHERE rn <= 2";
                $result = $this -> db -> query( $sql ) -> result_array();

                return $result;
        }

        function get_poll_comments( $id, $offset = 0, $limit = 10 ) {

                $this -> db -> select( "pcmt.*,u.alise as byuser" );
//                . "IFNULL(pcl.is_like, 0) as userlike");
                $this -> db -> from( 'poll_comments pcmt' );
                $this -> db -> where_in( 'pcmt.poll_id', $id );
                $this -> db -> where( 'pcmt.is_active', 1 );
                $this -> db -> join( 'users u', 'u.id=pcmt.user_id' );
                //$this->db->join('poll_comment_likes pcl', 'pcl.comment_id=pcmt.id AND pcl.user_id=pcmt.user_id', 'LEFT');
                //$this->db->join('poll_action fact', 'fact.user_id=fcmt.user_id AND fact.poll_id=fcmt.poll_id');
//        if ($type == "like") {
//            $this->db->where('fact.likes', 1);
//            //$this->db->where('fact.poll_id', $id);
//        } else if ($type == "dislike") {
//            $this->db->where('fact.dislikes', 1);
//            //$this->db->where('fact.poll_id', $id);
//        } else if ($type == "neutral") {
//            $this->db->where('fact.neutral', 1);
//            //$this->db->where('fact.poll_id', 1);
//        } else {
//            
//        }
                $this -> db -> order_by( 'pcmt.created_date', 'DESC' );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $result = $this -> db -> get() -> result_array();
                //echo $this->db->last_query();exit;


                return $result;
        }

        function get_my_poll( $user_id, $offset = 0, $limit = 10 ) {
                $this -> db -> select( "p.*,pc.name as category_name,u.alise as byuser,GROUP_CONCAT(pc1.id) as choice_id,"
                        . "GROUP_CONCAT(pc1.choice) as choice,(SELECT choice from poll_action  where poll_id = p.id AND action= 'Vote' AND user_id=" . $user_id . ") as user_choice"
//                .",pa.choice as user_choice"
//                ."(SELECT count(likes) from poll_action  where poll_id = f.id AND likes = 1) as total_likes,"
//                ."(SELECT count(dislikes) from poll_action  where poll_id = f.id AND dislikes = 1) as total_dislikes,"
//                ."(SELECT count(neutral) from poll_action  where poll_id = f.id AND neutral = 1) as total_neutral"
                );
                $this -> db -> from( 'poll p' );
                $this -> db -> join( 'poll_category pc', 'pc.id=p.category_id' );
                $this -> db -> join( 'poll_choices pc1', 'pc1.poll_id=p.id' );
                //$this->db->join('poll_action pa', 'pa.poll_id=p.id AND pa.user_id='.$user_id.'');
                $this -> db -> join( 'users u', 'u.id=p.user_id', "LEFT" );
                $this -> db -> where( 'p.user_id', $user_id );
                $this -> db -> where( 'p.is_active', 1 );
                $this -> db -> where( 'date(p.end_date)>="' . date( 'Y-m-d' ) . '"' );
                //$this->db->where('p.is_approved', 1);
                $this -> db -> group_by( 'p.id' );
                $this -> db -> order_by( 'p.id', 'DESC' );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $result = $this -> db -> get();
                $mypoll = $result -> result_array();

                foreach ( $mypoll as $key => $mp ) {
                        $id = $mp[ 'id' ];
                        $total_votes = $mp[ 'total_votes' ];

                        $mypoll[ $key ][ 'options' ] = $this -> calculateavgvotes( $id, $total_votes );
                        //var_dump($total_votes);exit;
                }

                return $mypoll;
        }

        function get_trending_by_category( $category, $user_id, $offset = 0, $limit = 10 ) {

                if ( is_numeric( $category ) ) {
                        $newcategory = $category;
                } else {
                        $newcategory = 1;
                }

                /* Get highest voted polls in Last 4 hours - START */
                $fourhourvotedids = "";

                $this -> db -> select( "pa.poll_id, pa.category_id, count(1) as max_votes" );
                $this -> db -> from( "poll_action pa" );
                $this -> db -> where( "(now() - interval 4 hour <= pa.created_date) AND pa.category_id = '$newcategory' AND pa.action= 'Vote'" );
                $this -> db -> group_by( "pa.poll_id" );
                $this -> db -> order_by( "max_votes ASC" );
                $this -> db -> order_by( "pa.poll_id ASC" );
                $result = $this -> db -> get();
                $last_four_hour_max_voted = $result -> result_array();
                //echo $this->db->last_query();exit;
                //echo $result->num_rows();exit;
                foreach ( $last_four_hour_max_voted as $four_hour_data ) {
                        $fourhourvotedids .= $four_hour_data[ "poll_id" ] . ",";
                }
                $fourhourvotedids = chop( $fourhourvotedids, "," );

                /* Get highest voted polls in Last 4 hours - END */

                $this -> db -> select( "p.*,pc.name as category_name,u.alise as byuser,"
                        . "(SELECT choice from poll_action  where poll_id = p.id AND action= 'Vote' AND user_id=" . $user_id . ") as user_choice" );
                $this -> db -> from( "poll p" );
                $this -> db -> join( "poll_category pc", "pc.id=p.category_id", "INNER" );
                //$this -> db -> join( 'poll_choices pc1', 'pc1.poll_id=p.id' );
                $this -> db -> join( "users u", "u.id=p.user_id", "LEFT" );
                //$this->db->order_by('p.total_votes', 'DESC');
                if ( $category != "all" ) {
                        $this -> db -> where( "p.category_id", $category );
                }

                $this -> db -> where( "p.is_active", 1 );
                if ( $category != "myraised" ) {
                        $this -> db -> where( 'p.is_approved', 1 );
                }
                //
                //$this->db->where('date(p.end_date)>="'.date('Y-m-d').'"');
                $this -> db -> group_by( 'p.id' );
                //$this->db->order_by('p.total_like DESC');

                if ( $fourhourvotedids != "" ) {
                        $this -> db -> order_by( "FIELD(p.id, $fourhourvotedids) DESC,p.id DESC" );
                } else {
                        $this -> db -> order_by( "p.id DESC" );
                }

                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                //$this->db->order_by('p.id', 'DESC');
                $result = $this -> db -> get();


                $categorydata = $result -> result_array();

                foreach ( $categorydata as $key => $catd ) {
                        $id = $catd[ 'id' ];

                        $counttoberemoved = $this -> remove_votes_count( $id );
                        $categorydata[ $key ][ 'total_votes' ] = $categorydata[ $key ][ 'total_votes' ] - $counttoberemoved;
                }

                return $categorydata;
        }

        function get_total_polls( $category ) {
                $this -> db -> select( 'count(1) as total' );
                $this -> db -> from( 'poll p' );
                $this -> db -> where( "p.is_active", 1 );
                $this -> db -> where( 'p.is_approved', 1 );
                $this -> db -> where( "p.category_id", $category );
                //$this->db->where('date(p.end_date)>="'.date('Y-m-d').'"');
                $total = $this -> db -> get() -> row_array();
                return $total[ 'total' ];
        }

        function searchForId( $id, $array ) {
                foreach ( $array as $key => $val ) {
                        if ( $val[ 'poll_id' ] === $id ) {
                                return $key;
                        }
                }
                return null;
        }

        function get_poll_list( $category, $user_id, $pollid = 0, $offset = 0, $limit = 10 ) {

                if ( is_numeric( $category ) ) {
                        $newcategory = $category;
                } else {
                        $newcategory = 1;
                }

                /* Get user voted Poll - START */
                $voted_survey = "";

                if ( $user_id > 0 ) {
                        $users_voted_surveys = "SELECT poll_id FROM poll_action WHERE user_id = '$user_id' AND action= 'Vote'";
                        $users_voted_data = $this -> db -> query( $users_voted_surveys ) -> result_array();

                        foreach ( $users_voted_data as $key => $data ) {
                                $voted_survey .= $data[ 'poll_id' ] . ",";
                        }
                        $voted_survey = chop( $voted_survey, "," );
                }
                /* Get user voted surveys - END */

                $remove_from_last1_hour = "";
                $myvoted_cond = "";
                if ( $voted_survey != "" ) {
                        $remove_from_last1_hour = " AND p.id not in ($voted_survey)";
                        $myvoted_cond = "AND pa.poll_id not in ($voted_survey)";
                }

                /* Get Polls raised in last 1 hour - START */
                $this -> db -> select( "p.id" );
                $this -> db -> from( "poll p" );
                $this -> db -> where( "(p.created_date + INTERVAL 20 MINUTE) >= (now() - INTERVAL 1 hour) AND p.is_active = '1' $remove_from_last1_hour" );
                $last1hour_result = $this -> db -> get() -> result_array();
                /* Get Polls raised in last 1 hour - END */

                /* Get highest voted polls in Last 4 hours - START */
                $fourhourvotedids = "";

                $this -> db -> select( "pa.poll_id, pa.category_id, count(1) as max_votes" );
                $this -> db -> from( "poll_action pa" );
                $this -> db -> where( "(now() - interval 4 hour <= pa.created_date) AND pa.category_id = '$newcategory' AND pa.action= 'Vote' $myvoted_cond" );
                $this -> db -> group_by( "pa.poll_id" );
                $this -> db -> order_by( "max_votes ASC" );
                $this -> db -> order_by( "pa.poll_id ASC" );
                $result = $this -> db -> get();
                $last_four_hour_max_voted = $result -> result_array();

                /* Get highest voted polls in Last 4 hours - END */

                /* remove id exists in last 1 hour raised from last 4 hours max voted - START */
                $last1hourids = "";

                if ( ! empty( $last1hour_result ) ) {
                        foreach ( $last1hour_result as $key => $last1hour_data ) {

                                $key = $this -> searchForId( $last1hour_data[ 'id' ], $last_four_hour_max_voted );
                                if ( $key !== null ) {
                                        unset( $last_four_hour_max_voted[ $key ] );
                                }
                                $last1hourids .= $last1hour_data[ 'id' ] . ",";
                        }
                        $last1hourids = chop( $last1hourids, "," );
                }
                /* remove id exists in last 1 hour raised from last 4 hours max voted - END */

                foreach ( $last_four_hour_max_voted as $four_hour_data ) {
                        $fourhourvotedids .= $four_hour_data[ "poll_id" ] . ",";
                }
                $fourhourvotedids = chop( $fourhourvotedids, "," );

                /* Get highest voted polls in Last 4 hours - END */

                /* Get highest voted polls in Last 24 hours - START */
                $tweentythourvotedids = "";

                $this -> db -> select( "pa.poll_id, pa.category_id, count(1) as max_votes" );
                $this -> db -> from( "poll_action pa" );
                $this -> db -> where( "(now() - interval 24 hour <= pa.created_date) AND pa.category_id = '$newcategory' AND pa.action= 'Vote' $myvoted_cond" );
                $this -> db -> group_by( "pa.poll_id" );
                $this -> db -> order_by( "max_votes ASC" );
                $this -> db -> order_by( "pa.poll_id ASC" );
                $result = $this -> db -> get();
                $last_tweenty_four_hour_max_voted = $result -> result_array();

                /* remove id exists in last 1 hour raised from last 24 hours max voted - START */
                $last1hourids_in24hour = "";

                if ( ! empty( $last1hour_result ) ) {
                        foreach ( $last1hour_result as $key => $last1hour_data ) {

                                $key = $this -> searchForId( $last1hour_data[ 'id' ], $last_tweenty_four_hour_max_voted );
                                if ( $key !== null ) {
                                        unset( $last_tweenty_four_hour_max_voted[ $key ] );
                                }
                                $last1hourids_in24hour .= $last1hour_data[ 'id' ] . ",";
                        }
                        $last1hourids_in24hour = chop( $last1hourids_in24hour, "," );
                }
                /* remove id exists in last 1 hour raised from last 24 hours max voted - END */

                foreach ( $last_tweenty_four_hour_max_voted as $tweenty_four_hour_data ) {
                        $tweentythourvotedids .= $tweenty_four_hour_data[ "poll_id" ] . ",";
                }
                $tweentythourvotedids = chop( $tweentythourvotedids, "," );

                /* Get highest voted polls in Last 24 hours - END */

                $this -> db -> select( "p.*, pc.name as category_name, u.alise as byuser, "
                        . "(CASE WHEN p.created_date >= (now() - interval 20 MINUTE) THEN 1 ELSE 0 END) as is_new, "
                        . "(CASE WHEN p.end_date < now() - INTERVAL 1 DAY THEN 1 ELSE 0 END ) as expired, "
                        . "(SELECT count(1) from poll_action where poll_id = p.id AND action= 'Vote' AND user_id = '$user_id') as is_user_voted " );
                $this -> db -> from( "poll p" );
                $this -> db -> join( "poll_category pc", "pc.id = p.category_id", "INNER" );
                $this -> db -> join( "users u", "u.id = p.user_id", "LEFT" );

                if ( $category == "voted" ) {
                        $this -> db -> where( "p.id IN (select poll_id from poll_action where user_id=$user_id)" );
                } else if ( $category == "notvoted" ) {
                        $this -> db -> where( "p.id NOT IN (select poll_id from poll_action where user_id=$user_id)" );
                } else if ( $category == "trending" ) {
                        $this -> db -> order_by( 'p.total_votes', 'DESC' );
                } else if ( $category == "myraised" ) {
                        $this -> db -> where( 'p.user_id', $user_id );
                } else {

                        $this -> db -> where( "p.category_id", $category );

                        $is_new = "";
                        if ( $last1hourids != "" ) {
                                $is_new = "FIELD(p.id, $last1hourids) DESC,";
                        }

                        $is_new_24hour = "";
                        if ( $last1hourids_in24hour != "" ) {
                                $is_new_24hour = "FIELD(p.id, $last1hourids_in24hour) DESC,";
                        }

                        $pollid_also = "";
                        if ( $fourhourvotedids != "" ) {
                                if ( $pollid != 0 && $offset == 0 ) {
                                        $pollid_also = "," . $pollid;
                                }
                                $fourhourvotedids = $fourhourvotedids . "" . $pollid_also;
                                $this -> db -> order_by( "expired ASC, $is_new is_user_voted ASC, FIELD(p.id, $fourhourvotedids) DESC,p.end_date DESC" );
                        } else if ( $tweentythourvotedids != "" ) {
                                if ( $pollid != 0 && $offset == 0 ) {
                                        $pollid_also = "," . $pollid;
                                }
                                $tweentythourvotedids = $tweentythourvotedids . "" . $pollid_also;
                                $this -> db -> order_by( "expired ASC, $is_new_24hour is_user_voted ASC, FIELD(p.id, $tweentythourvotedids) DESC,p.end_date DESC" );
                        } else if ( $pollid != 0 && $offset == 0 ) {
                                $pollid_also = $pollid;
                                $fourhourvotedids = $fourhourvotedids . "" . $pollid_also;
                                $this -> db -> order_by( "expired ASC, $is_new is_user_voted ASC, FIELD(p.id, $fourhourvotedids) DESC,p.end_date DESC" );
                        } else {
                                $this -> db -> order_by( "expired ASC, is_user_voted ASC, p.total_votes DESC, p.end_date DESC" );
                        }

                        if ( $pollid != 0 && $offset == 0 ) {
                                //$this->db->order_by("FIELD(p.id, $pollid) DESC,p.id");
                        } else if ( $pollid != 0 && $offset > 0 ) {
                                $this -> db -> where( "p.id<>", $pollid );
                        }
                }

                $this -> db -> where( "p.is_active = '1' AND p.is_approved = '1'" );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $result = $this -> db -> get();

                //echo $this->db->last_query();exit;
                $polldata = $result -> result_array();

                foreach ( $polldata as $key => $catd ) {
                        $id = $catd[ 'id' ];
                        $total_votes = $catd[ 'total_votes' ];
                        $polldata[ $key ][ 'options' ] = $this -> calculateavgvotes( $id, $total_votes );
                        $polldata[ $key ][ 'All_comments' ] = $this -> get_poll_comments( $id, 0, 2 );
                        $polldata[ $key ][ 'total_comments' ] = $this -> get_poll_comments_count( $id, 'All' );

                        $counttoberemoved = $this -> remove_votes_count( $id );
                        $polldata[ $key ][ 'total_votes' ] = $polldata[ $key ][ 'total_votes' ] - $counttoberemoved;
                }

                return $polldata;
        }

        function get_poll_category() {
                $this -> db -> select( 'id,name' );
                $this -> db -> from( 'poll_category' );
                $this -> db -> where( 'is_active', 1 );
                $result = $this -> db -> get();
                return $result -> result_array();
        }

        function get_comment_replies_mod( $forumid, $commentid, $offset = 0, $limit = 5 ) {
                $this -> db -> select( 'pcr.*,u.alise as byuser' );
                $this -> db -> where( 'pcr.poll_id', $forumid );
                $this -> db -> where( 'pcr.comment_id', $commentid );
                $this -> db -> where( 'pcr.is_active', 1 );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $this -> db -> from( 'poll_comment_reply pcr' );
                $this -> db -> join( 'users u', 'u.id=pcr.user_id' );
                $this -> db -> order_by( 'id', 'DESC' );
                $result = $this -> db -> get();
                if ( $result -> num_rows() > 0 ) {
                        $replies = $result -> result_array();
                        $response = json_encode( array ( "status" => TRUE, "message" => "replies found", "data" => $replies ) );
                } else {
                        $response = json_encode( array ( "status" => FALSE, "message" => "No replies found" ) );
                }
                return $response;
        }

        function make_deactive_poll( $forumid ) {
                $this -> db -> where( 'id', $forumid );
                $this -> db -> cache_delete_all();
                $this -> db -> update( 'poll', array ( 'is_active' => 0 ) );
                $response = json_encode( array ( "status" => TRUE, "message" => "Deleted successfully" ) );
                echo $response;
                exit;
        }

        function make_deactive_comment( $cmtid, $pollpage ) {
                $this -> db -> select( 'poll_id' );
                $this -> db -> where( 'id', $cmtid );
                $this -> db -> from( 'poll_comments' );
                $result = $this -> db -> get() -> row_array();
                $poll_id = $result[ 'poll_id' ];

                $this -> db -> where( 'id', $cmtid );
                $this -> db -> cache_delete_all();
                $this -> db -> update( 'poll_comments', array ( 'is_active' => 0 ) );

                $total_active = $this -> get_poll_comments_count( $poll_id, 'All' );
                $this -> db -> set( 'total_comments', $total_active );
                $this -> db -> where( "id", $poll_id );
                $this -> db -> update( 'poll' );
                if ( $pollpage > 0 ) {
                        $pollpage = $pollpage * 10;
                        $comments = $this -> get_poll_comments( $poll_id, 0, $pollpage );
                } else {
                        $comments = $this -> get_poll_comments( $poll_id, 0, 2 );
                }
                $response = json_encode( array ( "status" => TRUE, "message" => "Deleted successfully", "data" => $comments, "ques_no" => $poll_id, "total" => $total_active ) );
                echo $response;
                exit;
        }

        function addpollchoice_mod( $input, $user_id ) {
                $pollid = $input[ 'poll_id' ];
                $choice = $input[ 'choice' ];
                $category = $input[ 'category_id' ];
                //$user_id = $input['user_id'];
                $data = array (
                    "poll_id" => $pollid,
                    "user_id" => $user_id,
                    "choice" => $choice,
                    "category_id" => $category,
                    'action' => 'Vote'
                );
                //var_dump($data);exit;
                $this -> db -> select( 'id' );
                $this -> db -> where( 'poll_id', $pollid );
                $this -> db -> where( 'user_id', $user_id );
                $this -> db -> where( 'action', 'Vote' );
                $this -> db -> from( 'poll_action' );

                $this -> db -> cache_delete_all();
                $result = $this -> db -> get();
                if ( $result -> num_rows() > 0 ) {
                        $alreadyvote = $result -> row_array();
                        $this -> db -> where( 'id', $alreadyvote[ 'id' ] );
                        $this -> db -> update( 'poll_action', $data );
                        return 1;
                } else {
                        $data[ 'points' ] = 1;
                        $data[ 'action' ] = 'Vote';
                        $this -> db -> insert( 'poll_action', $data );

                        $sessiondata = $this -> session -> userdata( 'data' );
                        $_SESSION[ 'data' ][ 'silver_points' ] = $sessiondata[ 'silver_points' ] + 1;

                        $this -> db -> set( 'unearned_points', "unearned_points+1", FALSE );
                        $this -> db -> where( "id", $user_id );
                        $this -> db -> update( 'users' );



                        return 0;
                }
        }

        function likecomment_mod( $cmtid, $user_id ) {

                $data = array (
                    "comment_id" => $cmtid,
                    "user_id" => $user_id,
                );
                $this -> db -> select( 'id,is_like' );
                $this -> db -> where( 'user_id', $user_id );
                $this -> db -> where( 'comment_id', $cmtid );
                $this -> db -> from( 'poll_comment_likes' );
                $result = $this -> db -> get();
                $this -> db -> cache_delete_all();
                if ( $result -> num_rows() > 0 ) {
                        $like = $result -> row_array();
                        $data[ 'is_like' ] = $like[ 'is_like' ] == 0 ? 1 : 0;

                        $this -> db -> where( 'id', $like[ 'id' ] );
                        $this -> db -> update( 'poll_comment_likes', $data );
                        $msg = $like[ 'is_like' ] == 0 ? 'Like' : 'Dislike';
                        $response = json_encode( array ( "status" => TRUE, "message" => "Comment $msg successfully", "islike" => $data[ 'is_like' ] ) );
                } else {
                        $data[ 'is_like' ] = 1;
                        $this -> db -> insert( 'poll_comment_likes', $data );
                        $response = json_encode( array ( "status" => TRUE, "message" => "Comment liked successfully" ) );
                }
                echo $response;
                exit;
        }

        function update_csv( $filepath ) {
                if ( ($handle = fopen( $filepath, "r" )) !== FALSE ) {
                        while ( ($data = fgetcsv( $handle, 1000, "," )) !== FALSE ) {
                                $num = count( $data );

                                for ( $c = 0; $c < $num; $c ++ ) {
                                        $user_id = $data[ 0 ];
                                        $choice_id = $data[ 1 ];
                                        $created_date = $data[ 2 ];
//                    var_dump($user_id);
//                    var_dump($choice_id);
//                    var_dump($created_date);
                                        $data = array (
                                            "poll_id" => 3,
                                            "user_id" => $this -> getuserbymail( $user_id ),
                                            "choice" => $this -> getuserchoiceid( $choice_id ),
                                            "points" => 1,
                                            "category_id" => 1,
                                            "action" => "Vote",
                                            "created_date" => $created_date
                                        );
                                        //$this->db->insert('poll_action',$data);
                                        break;
                                }
                        }
                        fclose( $handle );
                }
        }

        function getuserbymail( $user_id ) {
                $this -> db -> select( 'id' );
                $this -> db -> from( 'users' );
                $this -> db -> where( 'email', $user_id );
                $result = $this -> db -> get() -> row_array();
                return $result[ 'id' ];
        }

        function getuserchoiceid( $choice_id ) {
                $this -> db -> select( 'id' );
                $this -> db -> from( 'poll_choices' );
                $this -> db -> where( 'choice', $choice_id );
                $result = $this -> db -> get() -> row_array();
                return $result[ 'id' ];
        }

        //subtract the vote count for the See the Results Option
        function remove_votes_count( $survey_id ) {

                $query = "select COUNT(1) remove_count
                    from poll_action pa 
                    INNER JOIN poll_choices pc ON pc.poll_id = '$survey_id' AND pc.choice = 'See the Results'
                    WHERE pa.poll_id = '$survey_id' AND pa.choice = pc.id";
                $result = $this -> db -> query( $query ) -> row_array();

                $counttoberemoved = $result[ 'remove_count' ]; //See the results counts should not be calculated
                return $counttoberemoved;
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

        function special_character( $string ) {
                $string = str_replace( "'", "&#039;", $string );
                $string = str_replace( '"', '&#039;', $string );
                return $string;
        }

        function get_answered_prediction( $inputs, $offset, $limit = 10 ) {
                //print_r($inputs);
                $uid = $inputs[ 'uid' ];
                $categoryid = $inputs[ 'categoryid' ];

                $this -> db -> select( "p.id,p.poll,p.total_votes,pc.name as category_name" );
                $this -> db -> from( "poll p" );
                $this -> db -> join( "poll_category pc", "pc.id=p.category_id", "INNER" );
                $this -> db -> where( "p.id in (SELECT poll_id FROM poll_action pa WHERE user_id = '$uid' AND category_id = '$categoryid')" );
                $this -> db -> limit( $limit );
                $this -> db -> offset( $offset );
                $result = $this -> db -> get() -> result_array();

                foreach ( $result as $key => $data ) {
                        $id = $data[ 'id' ];
                        $counttoberemoved = $this -> remove_votes_count( $id );
                        $result[ $key ][ 'total_votes' ] = $result[ $key ][ 'total_votes' ] - $counttoberemoved;
                }

                return $result;
        }

        function get_experts_result( $inputs ) {
                $poll_id = $inputs[ 'id' ];

                $this -> db -> select( "pc.id as choice, SUM(COALESCE(u.earned_points,0)) as total_gold, "
                        . "SUM(COALESCE(u.unearned_points,0)) as total_silver, pc.choice as option, pc.type" );
                $this -> db -> from( "poll_choices pc" );
                $this -> db -> join( "poll_action pa", "pa.choice = pc.id", "LEFT" );
                $this -> db -> join( "users u", "u.id = pa.user_id", "LEFT" );
                $this -> db -> where( "pc.poll_id = '$poll_id'" );
                $this -> db -> group_by( "pc.id" );
                $result = $this -> db -> get() -> result_array();

                $a = array ();
                $total = 0;

                foreach ( $result as $key => $expert_data ) {
                        if ( $expert_data[ 'type' ] == "1" ) {
                                $a[ $key ] = $expert_data[ 'total_gold' ] * 0.75 + $expert_data[ 'total_silver' ] * 0.25;
                                $result[ $key ][ 'calculated_sum' ] = ( string ) $a[ $key ];
                                $total += $a[ $key ];
                        } else {
                                $result[ $key ][ 'calculated_sum' ] = "0"; //this is for see the results option
                        }
                }

                foreach ( $result as $key => $expert_data_with_sum ) {
                        if ( $expert_data_with_sum[ 'type' ] == "1" ) {
                                $result[ $key ][ 'expert_percent' ] = ( string ) round( ($expert_data_with_sum[ 'calculated_sum' ] / $total) * 100, 2 );
                        } else {
                                $result[ $key ][ 'expert_percent' ] = "0"; //this is for see the results option
                        }
                }

                return array ( "status" => TRUE, "message" => "", "data" => $result );
        }

}
