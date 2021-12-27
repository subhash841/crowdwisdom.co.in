<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dashboard_Mod extends CI_Model {

        function __construct() {
                parent::__construct();

        }

        function get_user_forecast_details( $user_id, $election_period_id, $state_id ) {
                $array_of_ordered_ids = array ( 1, 2, 3, 6, 10, 11, 12, 13, 14, 15, 16, 8 );
                $order = sprintf( 'FIELD(sp.party_id, %s)', implode( ', ', $array_of_ordered_ids ) );

                $this -> db -> select( "sp.party_id, sp.actual_seats, sp.actual_votes, p.icon as party_icon, p.name as party, p.abbreviation, COALESCE(uf.seat_forecast,0) as seat_forecast,"
                        . " COALESCE(uf.vote_forcast,0) as vote_forcast" );
                $this -> db -> from( "state_party sp" );
                $this -> db -> join( "states s", "s.id = sp.state_id AND s.is_active = '1'", "INNER" );
                $this -> db -> join( "parties p", "p.id = sp.party_id AND p.is_active = '1'", "INNER" );
                $this -> db -> join( "user_forecasting uf", "uf.state_id = sp.state_id AND uf.party_id = sp.party_id AND uf.election_period_id = sp.election_period_id AND uf.user_id = '$user_id'", "LEFT" );
                $this -> db -> where( "sp.election_period_id = '$election_period_id' AND sp.state_id = '$state_id' AND sp.is_active = '1'" );
                $this -> db -> order_by( $order );
                $user_forecast = $this -> db -> get() -> result_array();

                return $user_forecast;

        }

        function get_seat_vote_avg_forecasting() {

                $this -> db -> select( "id,election_period_id,state_id,party_id, AVG(seat_forecast) as avg_seatforecast, AVG(vote_forcast) as vote_forcast" );
                $this -> db -> from( "user_forecasting" );
                $this -> db -> where( array ( "election_period_id" => "2", "state_id" => "17" ) );
                $this -> db -> group_by( "party_id" );
                $avg_forecasting = $this -> db -> get() -> result_array();
                return $avg_forecasting;

        }

        function update_user_forecast( $inputs ) {
                $user_id = $inputs[ 'user_id' ];
                $total_seats = $inputs[ 'total_seats' ];
                $election_period_id = $inputs[ 'election_period' ];
                $state_id = $inputs[ 'election_state' ];
                $reason = $inputs[ 'user_forecast_reason' ];

                //forecast reason handling
                $reasondata = array (
                    "user_id" => $user_id,
                    "period_id" => $election_period_id,
                    "forecast_type" => 'Election'
                );
                $this -> db -> select( 'id' );
                $this -> db -> from( 'forecast_reason' );
                $this -> db -> where( array ( "user_id" => $user_id, "period_id" => $election_period_id ) );
                $resonexist = $this -> db -> get();
                if ( ! ($resonexist -> num_rows() > 0) ) {
                        $this -> db -> insert( 'forecast_reason', $reasondata );
                }

                //these are array for party ids, seat forecast and vote forecast
                $party = $inputs[ 'party' ];
                $seat_forcast = isset( $inputs[ 'seat_forecast' ] ) ? $inputs[ 'seat_forecast' ] : array ();
                $vote_forcast = isset( $inputs[ 'vote_forecast' ] ) ? $inputs[ 'vote_forecast' ] : array ();

                /* update game played by user */
                $update_user_game_played = array (
                    "is_game_played" => "1"
                );
                $this -> db -> where( "id = $user_id" );
                $this -> db -> cache_delete_all();
                $this -> db -> update( "users", $update_user_game_played );
                /* update game played by user */

                $this -> db -> select( "1" );
                $this -> db -> from( "user_forecasting" );
                $this -> db -> where( "user_id = '$user_id' AND election_period_id = '$election_period_id' AND state_id = '$state_id'" );
                $is_already_forecast = $this -> db -> get() -> num_rows();

                /* Add Update SEAT forecast */
                if ( isset( $inputs[ 'seat_forecast' ] ) && ! empty( $inputs[ 'seat_forecast' ] ) ) {
                        $seat_sum = "0";
                        foreach ( $seat_forcast as $setforecastsum ) {
                                $seat_sum += $setforecastsum;
                        }

                        if ( $seat_sum != $total_seats ) {
                                echo json_encode( array ( "status" => FALSE, "message" => "Your score is $seat_sum. Total must add upto $total_seats.", "data" => "", "redirect_url" => "" ) );
                                return false;
                        }
                        if ( empty( $reason ) || strlen( trim( $reason ) ) < 20 ) {
                                echo json_encode( array ( "status" => FALSE, "message" => "Please provide reason below.", "data" => "1", "redirect_url" => "" ) );
                                return false;
                        }
                        if ( $is_already_forecast == 0 ) {

                                $this -> db -> where( array ( "user_id" => $user_id, "period_id" => $election_period_id ) );
                                $this -> db -> update( 'forecast_reason', array ( "reason" => $reason ) );

                                foreach ( $party as $key => $party_id ) {
                                        $insert_forecast[] = array (
                                            "user_id" => $user_id,
                                            "election_period_id" => $election_period_id,
                                            "state_id" => $state_id,
                                            "party_id" => $party_id,
                                            "seat_forecast" => $seat_forcast[ $key ],
                                            "vote_forcast" => $vote_forcast[ $key ]
                                        );
                                }
                                $this -> db -> insert_batch( 'user_forecasting', $insert_forecast );
                                echo json_encode( array ( "status" => TRUE, "message" => "Data saved successfully." ) );
                                return true;
                        } else {
                                $this -> db -> where( array ( "user_id" => $user_id, "period_id" => $election_period_id ) );
                                $this -> db -> update( 'forecast_reason', array ( "reason" => $reason ) );

                                foreach ( $party as $key => $party_id ) {
                                        $update_forecast = array (
                                            "seat_forecast" => $seat_forcast[ $key ],
                                            "vote_forcast" => $vote_forcast[ $key ]
                                        );
                                        $this -> db -> where( array ( "user_id" => $user_id, "election_period_id" => $election_period_id, "state_id" => $state_id, "party_id" => $party_id ) );
                                        $this -> db -> update( 'user_forecasting', $update_forecast );
                                }
                                echo json_encode( array ( "status" => TRUE, "message" => "Data saved successfully." ) );
                                return true;
                        }
                }

                /* Add Update VOTE forecast */
//                if ( isset( $inputs[ 'vote_forecast' ] ) && ! empty( $inputs[ 'vote_forecast' ] ) ) {
//
//                        $vote_sum = "0";
//                        foreach ( $vote_forcast as $setforecastsum ) {
//                                $vote_sum += $setforecastsum;
//                        }
//                        if ( $vote_sum > 100 ) {
//                                echo json_encode( array ( "status" => FALSE, "message" => "Your score is $vote_sum. Total must add upto 100%.", "data" => "", "redirect_url" => "" ) );
//                                return false;
//                        }
//                        if ( $vote_sum < 100 ) {
//                                echo json_encode( array ( "status" => FALSE, "message" => "Your score is $vote_sum. Total must add upto 100%.", "data" => "", "redirect_url" => "" ) );
//                                return false;
//                        }
//                        if ( empty( $reason ) || strlen( trim( $reason ) ) < 20 ) {
//                                echo json_encode( array ( "status" => FALSE, "message" => "Please provide reason below.", "data" => "2", "redirect_url" => "" ) );
//                                return false;
//                        }
//                        if ( $is_already_forecast == 0 ) {
//
//                                $this -> db -> where( array ( "user_id" => $user_id, "period_id" => $election_period_id ) );
//                                $this -> db -> update( 'forecast_reason', array ( "reason" => $reason ) );
//
//                                foreach ( $party as $key => $party_id ) {
//                                        $insert_forecast[] = array (
//                                            "user_id" => $user_id,
//                                            "election_period_id" => $election_period_id,
//                                            "state_id" => $state_id,
//                                            "party_id" => $party_id,
//                                            "vote_forcast" => $vote_forcast[ $key ]
//                                        );
//                                }
//                                $this -> db -> insert_batch( 'user_forecasting', $insert_forecast );
//                                echo json_encode( array ( "status" => TRUE, "message" => "Data saved successfully." ) );
//                                return true;
//                        } else {
//                                $this -> db -> where( array ( "user_id" => $user_id, "period_id" => $election_period_id ) );
//                                $this -> db -> update( 'forecast_reason', array ( "reason" => $reason ) );
//
//                                foreach ( $party as $key => $party_id ) {
//                                        $update_forecast = array (
//                                            "vote_forcast" => $vote_forcast[ $key ]
//                                        );
//                                        $this -> db -> where( array ( "user_id" => $user_id, "election_period_id" => $election_period_id, "state_id" => $state_id, "party_id" => $party_id ) );
//                                        $this -> db -> update( 'user_forecasting', $update_forecast );
//                                }
//                                echo json_encode( array ( "status" => TRUE, "message" => "Data saved successfully." ) );
//                                return true;
//                        }
//                }

        }

        function update_user_constituency_forecast( $inputs ) {
                $this -> db -> select( "1" );
                $this -> db -> from( "user_election_rankings" );
                $this -> db -> where( "user_id = '$user_id' AND election_period_id = '$election_period_id'" );
                $is_diff = $this -> db -> get() -> num_rows();

        }

        function add_update_forecast_difference( $user_id, $election_period_id, $seat_diff, $vote_diff ) {
                $this -> db -> select( "1" );
                $this -> db -> from( "user_election_rankings" );
                $this -> db -> where( "user_id = '$user_id' AND election_period_id = '$election_period_id'" );
                $is_diff = $this -> db -> get() -> num_rows();
                $this -> db -> cache_delete_all();

                if ( $is_diff == 0 ) {
                        $insert_user_prediction_diff = array (
                            "user_id" => $user_id,
                            "election_period_id" => $election_period_id,
                            "seat_prediction_diff" => $seat_diff,
                            "vote_prediction_diff" => $vote_diff
                        );
                        $this -> db -> insert( 'user_election_rankings', $insert_user_prediction_diff );
                } else {
                        $update_user_prediction_diff = array (
                            "seat_prediction_diff" => $seat_diff,
                            "vote_prediction_diff" => $vote_diff
                        );
                        $this -> db -> where( array ( "user_id" => $user_id, "election_period_id" => $election_period_id ) );
                        $this -> db -> update( 'user_election_rankings', $update_user_prediction_diff );
                }

                return TRUE;

        }

        function apply_initial_rank_to_users( $election_period_id ) {
                $s = $v = 1;
                $previous_seat_diff = "";
                $previous_vote_diff = "";

                /* Get Ordered SEAT differences */
                $seat_ordered_diff = $this -> get_ordered_seat_vote_diff( $election_period_id, "Seat" );
                $this -> db -> cache_delete_all();

                foreach ( $seat_ordered_diff as $do_seat_ranking ) {

                        if ( $do_seat_ranking[ 'seat_prediction_diff' ] == $previous_seat_diff ) {
                                $s = $s - 1;
                        } else {
                                $s = $s;
                        }

                        $update_seat_first_rank = array (
                            "seat_first_rank" => $s
                        );

                        $this -> db -> where( array ( "id" => $do_seat_ranking[ 'id' ] ) );
                        $this -> db -> update( 'user_election_rankings', $update_seat_first_rank );

                        $previous_seat_diff = $do_seat_ranking[ 'seat_prediction_diff' ];
                        $s ++;
                }

                /* Get Ordered VOTE differences */
                $vote_ordered_diff = $this -> get_ordered_seat_vote_diff( $election_period_id, "Vote" );

                foreach ( $vote_ordered_diff as $do_vote_ranking ) {

                        if ( $do_vote_ranking[ 'vote_prediction_diff' ] == $previous_vote_diff ) {
                                $v = $v - 1;
                        } else {
                                $v = $v;
                        }

                        $update_vote_first_rank = array (
                            "vote_first_rank" => $v
                        );
                        $this -> db -> where( array ( "id" => $do_vote_ranking[ 'id' ] ) );
                        $this -> db -> update( 'user_election_rankings', $update_vote_first_rank );

                        $previous_vote_diff = $do_vote_ranking[ 'vote_prediction_diff' ];
                        $v ++;
                }

                return TRUE;

        }

        function get_ordered_seat_vote_diff( $election_period_id, $orderby_for ) {
                $orderby = "";
                if ( $orderby_for == "Seat" ) {
                        $orderby = "seat_prediction_diff";
                } else {
                        $orderby = "vote_prediction_diff";
                }
                $this -> db -> select( "id,user_id,election_period_id,$orderby" );
                $this -> db -> from( "user_election_rankings" );
                $this -> db -> where( "election_period_id = '$election_period_id'" );
                $this -> db -> order_by( "$orderby ASC" );
                $get_diff = $this -> db -> get() -> result_array();

                return $get_diff;

        }

        function update_winning_gap_of_users( $election_period_id, $state_id ) {
                /*
                 * Seat winning gap calculation 
                 */

                $max_seats = $this -> get_max_actual_seats_details( $election_period_id, $state_id );
                $seat_party_id = $max_seats[ 0 ][ 'party_id' ];
                $actual_seats = $max_seats[ 0 ][ 'actual_seats' ];

                //get users seat forecast and update winning gap
                $this -> db -> select( "user_id,seat_forecast" );
                $this -> db -> from( "user_forecasting" );
                $this -> db -> where( array ( "election_period_id" => $election_period_id, "state_id" => $state_id, "party_id" => $seat_party_id ) );
                $get_seat_forecast = $this -> db -> get() -> result_array();
                $this -> db -> cache_delete_all();

                foreach ( $get_seat_forecast as $seat_forecast ) {
                        $seat_winning_gap = abs( $actual_seats - $seat_forecast[ 'seat_forecast' ] );

                        $update_seat_winning_gap = array (
                            "seat_winning_gap" => $seat_winning_gap
                        );

                        $this -> db -> where( array ( "user_id" => $seat_forecast[ 'user_id' ], "election_period_id" => $election_period_id ) );
                        $this -> db -> update( 'user_election_rankings', $update_seat_winning_gap );
                }

                /*
                 * Vote winning gap calculation 
                 */

                $max_votes = $this -> get_max_actual_votes_details( $election_period_id, $state_id );
                $vote_party_id = $max_votes[ 0 ][ 'party_id' ];
                $actual_votes = $max_votes[ 0 ][ 'actual_votes' ];

                //get users vote forecast and update winning gap
                $this -> db -> select( "user_id,vote_forcast" );
                $this -> db -> from( "user_forecasting" );
                $this -> db -> where( array ( "election_period_id" => $election_period_id, "state_id" => $state_id, "party_id" => $vote_party_id ) );
                $get_vote_forecast = $this -> db -> get() -> result_array();

                foreach ( $get_vote_forecast as $vote_forecast ) {
                        $vote_winning_gap = abs( $actual_votes - $vote_forecast[ 'vote_forcast' ] );

                        $update_vote_winning_gap = array (
                            "vote_winning_gap" => $vote_winning_gap
                        );

                        $this -> db -> where( array ( "user_id" => $vote_forecast[ 'user_id' ], "election_period_id" => $election_period_id ) );
                        $this -> db -> update( 'user_election_rankings', $update_vote_winning_gap );
                }

                return TRUE;

        }

        function get_max_actual_seats_details( $election_period_id, $state_id ) {
                $this -> db -> select( "party_id,max(actual_seats) as actual_seats" );
                $this -> db -> from( "state_party" );
                $this -> db -> where( array ( "election_period_id => $election_period_id", "state_id" => $state_id ) );
                $max_seats = $this -> db -> get() -> result_array(); // result array because if two party get same no of actual seats 
                return $max_seats;

        }

        function get_max_actual_votes_details( $election_period_id, $state_id ) {
                $this -> db -> select( "party_id,max(actual_votes) as actual_votes" );
                $this -> db -> from( "state_party" );
                $this -> db -> where( array ( "election_period_id => $election_period_id", "state_id" => $state_id ) );
                $max_votes = $this -> db -> get() -> result_array();
                return $max_votes;

        }

        function apply_second_rank_to_users( $election_period_id ) {
                $s = $v = 1;

                /* Get Ordered SEAT differences */
                $seat_ordered_winning_gap = $this -> get_ordered_seat_vote_winning_gap( $election_period_id, "Seat" );
                $this -> db -> cache_delete_all();

                foreach ( $seat_ordered_winning_gap as $do_seat_winning_gap_ranking ) {

                        $update_seat_second_rank = array (
                            "seat_second_rank" => $s
                        );

                        $this -> db -> where( array ( "id" => $do_seat_winning_gap_ranking[ 'id' ] ) );
                        $this -> db -> update( 'user_election_rankings', $update_seat_second_rank );

                        $s ++;
                }

                /* Get Ordered VOTE differences */
                $vote_ordered_winning_gap = $this -> get_ordered_seat_vote_winning_gap( $election_period_id, "Vote" );

                foreach ( $vote_ordered_winning_gap as $do_vote_winning_gap_ranking ) {

                        $update_vote_second_rank = array (
                            "vote_second_rank" => $v
                        );
                        $this -> db -> where( array ( "id" => $do_vote_winning_gap_ranking[ 'id' ] ) );
                        $this -> db -> update( 'user_election_rankings', $update_vote_second_rank );

                        $v ++;
                }

                return TRUE;

        }

        function get_ordered_seat_vote_winning_gap( $election_period_id, $orderby_for ) {
                $orderby = "";
                if ( $orderby_for == "Seat" ) {
                        $orderby = "seat_winning_gap";
                } else {
                        $orderby = "vote_winning_gap";
                }
                $this -> db -> select( "id,user_id,election_period_id,$orderby" );
                $this -> db -> from( "user_election_rankings" );
                $this -> db -> where( "election_period_id = '$election_period_id'" );
                $this -> db -> order_by( "$orderby ASC" );
                $get_ordered_winning_gap = $this -> db -> get() -> result_array();

                return $get_ordered_winning_gap;

        }

        function get_and_update_avg_rank_of_users( $election_period_id ) {

                $this -> db -> select( "id,user_id,(seat_first_rank+seat_second_rank) as seat_avg,(vote_first_rank+vote_second_rank) as vote_avg" );
                $this -> db -> from( "user_election_rankings" );
                $this -> db -> where( "election_period_id = '$election_period_id'" );
                $get_seat_vote_total_rank = $this -> db -> get() -> result_array();
                $this -> db -> cache_delete_all();
                foreach ( $get_seat_vote_total_rank as $total_seat_vote ) {
                        $seat_avg = $total_seat_vote[ 'seat_avg' ] / 2;
                        $vote_avg = $total_seat_vote[ 'vote_avg' ] / 2;

                        $update_avg_ranking = array (
                            "seat_rank_avg" => $seat_avg,
                            "vote_rank_avg" => $vote_avg
                        );
                        $this -> db -> where( array ( "id" => $total_seat_vote[ 'id' ], "user_id" => $total_seat_vote[ 'user_id' ] ) );
                        $this -> db -> update( 'user_election_rankings', $update_avg_ranking );
                }

                return TRUE;

        }

        function get_and_update_final_rank_of_users( $election_period_id ) {
                $s = $v = 1;

                /* Get Ordered SEAT differences */
                $seat_ordered_for_final_rank = $this -> get_ordered_seat_vote_for_final_rank( $election_period_id, "Seat" );
                $this -> db -> cache_delete_all();
                foreach ( $seat_ordered_for_final_rank as $do_seat_for_final_rank ) {

                        $update_seat_final_rank = array (
                            "seat_final_rank" => $s
                        );

                        $this -> db -> where( array ( "id" => $do_seat_for_final_rank[ 'id' ] ) );
                        $this -> db -> update( 'user_election_rankings', $update_seat_final_rank );

                        $s ++;
                }

                /* Get Ordered VOTE differences */
                $vote_ordered_for_final_rank = $this -> get_ordered_seat_vote_for_final_rank( $election_period_id, "Vote" );
                $this -> db -> cache_delete_all();
                foreach ( $vote_ordered_for_final_rank as $do_vote_for_final_rank ) {

                        $update_vote_final_rank = array (
                            "vote_final_rank" => $v
                        );
                        $this -> db -> where( array ( "id" => $do_vote_for_final_rank[ 'id' ] ) );
                        $this -> db -> update( 'user_election_rankings', $update_vote_final_rank );

                        $v ++;
                }

                return TRUE;

        }

        function get_ordered_seat_vote_for_final_rank( $election_period_id, $orderby_for ) {
                $orderby = "";
                if ( $orderby_for == "Seat" ) {
                        $orderby = "seat_rank_avg";
                } else {
                        $orderby = "vote_rank_avg";
                }
                $this -> db -> select( "id,user_id,election_period_id,$orderby" );
                $this -> db -> from( "user_election_rankings" );
                $this -> db -> where( "election_period_id = '$election_period_id'" );
                $this -> db -> order_by( "$orderby ASC" );
                $get_ordered_winning_gap = $this -> db -> get() -> result_array();

                return $get_ordered_winning_gap;

        }

        function before_points_calculation( $election_period_id ) {

                $this -> db -> select( "id,user_id,election_period_id,seat_final_rank,vote_final_rank" );
                $this -> db -> from( "user_election_rankings" );
                $this -> db -> where( "election_period_id = '$election_period_id'" );
                $get_seat_vote_final_ranks = $this -> db -> get() -> result_array();
                $this -> db -> cache_delete_all();
                foreach ( $get_seat_vote_final_ranks as $seat_vote_final_ranks ) {
                        $calc = 0.5 * $seat_vote_final_ranks[ 'seat_final_rank' ] + 0.5 * $seat_vote_final_ranks[ 'vote_final_rank' ];

                        $update_calc = array (
                            "calculation" => $calc
                        );

                        $this -> db -> where( array ( "id" => $seat_vote_final_ranks[ 'id' ], "user_id" => $seat_vote_final_ranks[ 'user_id' ], "election_period_id" => $seat_vote_final_ranks[ 'election_period_id' ] ) );
                        $this -> db -> update( 'user_election_rankings', $update_calc );
                }

        }

        function give_points_to_users( $election_period_id ) {
                //give 1000 points to user who get the lowest calculation

                $this -> db -> select( "id,user_id,min(calculation) as lowest_val" );
                $this -> db -> from( "user_election_rankings" );
                $this -> db -> where( array ( "election_period_id" => $election_period_id ) );
                $lowest_val = $this -> db -> get() -> row_array();

                $user = $lowest_val[ 'user_id' ];
                $lowest_calc = $lowest_val[ 'lowest_val' ];

                $update_point = array (
                    "points" => 1000
                );
                $this -> db -> where( array ( "id" => $lowest_val[ 'id' ], "user_id" => $user ) );
                $this -> db -> cache_delete_all();
                $this -> db -> update( "user_election_rankings", $update_point );

                //calculate give points to other user except who get the lowest calculation
                $this -> db -> select( "id,user_id,election_period_id,calculation" );
                $this -> db -> from( "user_election_rankings" );
                $this -> db -> where( "election_period_id = $election_period_id AND user_id <> $user" );
                $points_for_other_users = $this -> db -> get() -> result_array();


                foreach ( $points_for_other_users as $points_calc ) {
                        $points = 1000 - (($points_calc[ 'calculation' ] - $lowest_calc) / $lowest_calc);

                        $update_point_for_other_users = array (
                            "points" => $points
                        );
                        $this -> db -> where( array ( "id" => $points_calc[ 'id' ], "user_id" => $points_calc[ 'user_id' ] ) );
                        $this -> db -> update( "user_election_rankings", $update_point_for_other_users );
                }

        }

        function get_user_forecast_reason( $user_id, $election_period ) {
                $this -> db -> select( '*' );
                $this -> db -> from( 'forecast_reason' );
                $this -> db -> where( array ( "user_id" => $user_id, "period_id" => $election_period ) );
                $resonexist = $this -> db -> get();

                return $resonexist -> row_array();

        }

}
