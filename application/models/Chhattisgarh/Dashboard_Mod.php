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
                //$array_of_ordered_ids = array(1, 2, 3, 6, 10, 11, 12, 13, 14, 15, 16, 8);
                //$order = sprintf('FIELD(sp.party_id, %s)', implode(', ', $array_of_ordered_ids));

                $this -> db -> select( "sp.party_id, sp.actual_seats, sp.actual_votes, p.icon as party_icon, p.name as party, p.bilingual_name, p.abbreviation, COALESCE(uf.seat_forecast,0) as seat_forecast,"
                        . " COALESCE(uf.vote_forcast,0) as vote_forcast" );
                $this -> db -> from( "state_party sp" );
                $this -> db -> join( "states s", "s.id = sp.state_id AND s.is_active = '1'", "INNER" );
                $this -> db -> join( "parties p", "p.id = sp.party_id AND p.is_active = '1'", "INNER" );
                $this -> db -> join( "user_forecasting uf", "uf.state_id = sp.state_id AND uf.party_id = sp.party_id AND uf.election_period_id = sp.election_period_id AND uf.user_id = '$user_id'", "LEFT" );
                $this -> db -> where( "sp.election_period_id = '$election_period_id' AND sp.state_id = '$state_id' AND sp.is_active = '1'" );
                //$this->db->order_by($order);
                $user_forecast = $this -> db -> get() -> result_array();

                return $user_forecast;

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
                $this -> db -> update( "users", $update_user_game_played );
                /* update game played by user */

                $this -> db -> select( "1" );
                $this -> db -> from( "user_forecasting" );
                $this -> db -> where( "user_id = '$user_id' AND election_period_id = '$election_period_id' AND state_id = '$state_id'" );
                $is_already_forecast = $this -> db -> get() -> num_rows();
                $this -> db -> cache_delete_all();
                /* Add Update SEAT forecast */
                if ( isset( $inputs[ 'seat_forecast' ] ) && ! empty( $inputs[ 'seat_forecast' ] ) ) {
                        $seat_sum = "0";
                        foreach ( $seat_forcast as $setforecastsum ) {
                                $seat_sum += $setforecastsum;
                        }

                        if ( $seat_sum != $total_seats ) {
                                echo json_encode( array ( "status" => FALSE, "message" => "आपका स्कोर $seat_sum है। कुल $total_seats तक होना चाहिए", "data" => "", "redirect_url" => "" ) );
                                return false;
                        }
                        if ( empty( $reason ) || strlen( trim( $reason ) ) < 20 ) {
                                echo json_encode( array ( "status" => FALSE, "message" => "कृपया नीचे कारण प्रदान करें", "data" => "1", "redirect_url" => "" ) );
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
                                echo json_encode( array ( "status" => TRUE, "message" => "डेटा सफलतापूर्वक सहेजा गया" ) );
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
                                echo json_encode( array ( "status" => TRUE, "message" => "डेटा सफलतापूर्वक सहेजा गया" ) );
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
//                                echo json_encode( array ( "status" => FALSE, "message" => "आपका स्कोर $vote_sum है। कुल 100% तक होना चाहिए", "data" => "", "redirect_url" => "" ) );
//                                return false;
//                        }
//                        if ( $vote_sum < 100 ) {
//                                echo json_encode( array ( "status" => FALSE, "message" => "आपका स्कोर $vote_sum है। कुल 100% तक होना चाहिए", "data" => "", "redirect_url" => "" ) );
//                                return false;
//                        }
//                        if ( empty( $reason ) || strlen( trim( $reason ) ) < 20 ) {
//                                echo json_encode( array ( "status" => FALSE, "message" => "कृपया नीचे कारण प्रदान करें", "data" => "2", "redirect_url" => "" ) );
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
//                                echo json_encode( array ( "status" => TRUE, "message" => "डेटा सफलतापूर्वक सहेजा गया" ) );
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
//                                echo json_encode( array ( "status" => TRUE, "message" => "डेटा सफलतापूर्वक सहेजा गया" ) );
//                                return true;
//                        }
//                }

        }

        function get_user_forecast_reason( $user_id, $election_period ) {
                $this -> db -> select( '*' );
                $this -> db -> from( 'forecast_reason' );
                $this -> db -> where( array ( "user_id" => $user_id, "period_id" => $election_period ) );
                $resonexist = $this -> db -> get();

                return $resonexist -> row_array();

        }

}
