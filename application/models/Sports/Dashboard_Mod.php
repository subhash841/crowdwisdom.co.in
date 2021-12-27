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

        function get_user_sport_forecast_details( $user_id, $sport_period_id, $sport_id ) {
                $this -> db -> select( "m.team_id, m.actual_score, m.actual_wicket, m.is_inning_over, st.icon as team_icon, st.name as team, st.abbreviation, COALESCE(sf.score_forecast,0) as score_forecast,"
                        . "COALESCE(sf.wicket_forecast,0) as wicket_forcast" );
                $this -> db -> from( "matches m" );
                $this -> db -> join( "sports s", "s.id = m.sport_id AND s.is_active = '1'", "INNER" );
                $this -> db -> join( "sport_teams st", "st.id = m.team_id AND st.is_active = '1'", "INNER" );
                $this -> db -> join( "sport_forecasting sf", "sf.sport_id = m.sport_id AND sf.team_id = m.team_id AND sf.sport_period_id = m.sport_period_id AND sf.user_id = '$user_id'", "LEFT" );
                $this -> db -> where( "m.sport_period_id = '$sport_period_id' AND m.sport_id = '$sport_id' AND m.is_active = '1'" );
                $user_forecast = $this -> db -> get() -> result_array();

                return $user_forecast;
        }

        function update_user_forecast( $inputs ) {
                $user_id = $inputs[ 'user_id' ];
                $sport_period_id = $inputs[ 'sport_period' ];
                $sport_id = $inputs[ 'sport_id' ];
                $reason = $inputs[ 'user_forecast_reason' ];

                //forecast reason handling
                $reasondata = array (
                    "user_id" => $user_id,
                    "period_id" => $sport_period_id,
                    "forecast_type" => 'Sport'
                );
                $this -> db -> select( 'id' );
                $this -> db -> from( 'forecast_reason' );
                $this -> db -> where( array ( "user_id" => $user_id, "period_id" => $sport_period_id, "forecast_type" => "Sport" ) );
                $resonexist = $this -> db -> get();
                $this -> db -> cache_delete_all();
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
                $this -> db -> from( "sport_forecasting" );
                $this -> db -> where( "user_id = '$user_id' AND sport_period_id = '$sport_period_id' AND sport_id = '$sport_id'" );
                $is_already_forecast = $this -> db -> get() -> num_rows();

                /* Add Update SEAT forecast */
                if ( isset( $inputs[ 'seat_forecast' ] ) && ! empty( $inputs[ 'seat_forecast' ] ) ) {
                        $seat_sum = "0";

                        foreach ( $seat_forcast as $setforecastsum ) {
                                if ( $setforecastsum == 0 || $setforecastsum == "" ) {
                                        echo json_encode( array ( "status" => FALSE, "message" => "Please enter score for both the teams", "data" => "" ) );
                                        return false;
                                }
                                if ( $setforecastsum > 300 ) {
                                        echo json_encode( array ( "status" => FALSE, "message" => "Score should be less then 300", "data" => "" ) );
                                        return false;
                                }
                                //$seat_sum += $setforecastsum;
                        }

                        if ( empty( $reason ) || strlen( trim( $reason ) ) < 20 ) {
                                echo json_encode( array ( "status" => FALSE, "message" => "Please provide reason below.", "data" => "1" ) );
                                return false;
                        }
                        if ( $is_already_forecast == 0 ) {

                                $this -> db -> where( array ( "user_id" => $user_id, "period_id" => $sport_period_id, "forecast_type" => "Sport" ) );
                                $this -> db -> update( 'forecast_reason', array ( "reason" => $reason ) );

                                foreach ( $party as $key => $party_id ) {
                                        $insert_forecast[] = array (
                                            "user_id" => $user_id,
                                            "sport_period_id" => $sport_period_id,
                                            "sport_id" => $sport_id,
                                            "team_id" => $party_id,
                                            "score_forecast" => $seat_forcast[ $key ]
                                        );
                                }
                                $this -> db -> insert_batch( 'sport_forecasting', $insert_forecast );
                                echo json_encode( array ( "status" => TRUE, "message" => "Data saved successfully." ) );
                                return true;
                        } else {
                                $this -> db -> where( array ( "user_id" => $user_id, "period_id" => $sport_period_id, "forecast_type" => "Sport" ) );
                                $this -> db -> update( 'forecast_reason', array ( "reason" => $reason ) );

                                foreach ( $party as $key => $party_id ) {
                                        $update_forecast = array (
                                            "score_forecast" => $seat_forcast[ $key ]
                                        );
                                        $this -> db -> where( array ( "user_id" => $user_id, "sport_period_id" => $sport_period_id, "sport_id" => $sport_id, "team_id" => $party_id ) );
                                        $this -> db -> update( 'sport_forecasting', $update_forecast );
                                }
                                echo json_encode( array ( "status" => TRUE, "message" => "Data saved successfully." ) );
                                return true;
                        }
                }

                /* Add Update VOTE forecast */
                if ( isset( $inputs[ 'vote_forecast' ] ) && ! empty( $inputs[ 'vote_forecast' ] ) ) {

                        $vote_sum = "0";
                        foreach ( $vote_forcast as $setforecastsum ) {
                                if ( $setforecastsum == "" ) {
                                        echo json_encode( array ( "status" => FALSE, "message" => "Please enter wickets fallen for both the teams", "data" => "" ) );
                                        return false;
                                }
                                if ( $setforecastsum > 10 ) {
                                        echo json_encode( array ( "status" => FALSE, "message" => "Wicket fall should be less then equals to 10", "data" => "" ) );
                                        return false;
                                }
                                //$vote_sum += $setforecastsum;
                        }
//            if ($vote_sum > 100) {
//                echo json_encode(array("status" => FALSE, "message" => "Total must add upto 100%.", "data" => ""));
//                return false;
//            }
//            if ($vote_sum < 100) {
//                echo json_encode(array("status" => FALSE, "message" => "Total must add upto 100%.", "data" => ""));
//                return false;
//            }
                        if ( empty( $reason ) || strlen( trim( $reason ) ) < 20 ) {
                                echo json_encode( array ( "status" => FALSE, "message" => "Please provide reason below.", "data" => "2" ) );
                                return false;
                        }
                        if ( $is_already_forecast == 0 ) {

                                $this -> db -> where( array ( "user_id" => $user_id, "period_id" => $sport_period_id, "forecast_type" => "Sport" ) );
                                $this -> db -> update( 'forecast_reason', array ( "reason" => $reason ) );

                                foreach ( $party as $key => $party_id ) {
                                        $insert_forecast[] = array (
                                            "user_id" => $user_id,
                                            "sport_period_id" => $sport_period_id,
                                            "sport_id" => $sport_id,
                                            "team_id" => $party_id,
                                            "wicket_forecast" => $vote_forcast[ $key ]
                                        );
                                }
                                $this -> db -> insert_batch( 'sport_forecasting', $insert_forecast );
                                echo json_encode( array ( "status" => TRUE, "message" => "Data saved successfully." ) );
                                return true;
                        } else {
                                $this -> db -> where( array ( "user_id" => $user_id, "period_id" => $sport_period_id ) );
                                $this -> db -> update( 'forecast_reason', array ( "reason" => $reason ) );

                                foreach ( $party as $key => $party_id ) {
                                        $update_forecast = array (
                                            "wicket_forecast" => $vote_forcast[ $key ]
                                        );
                                        $this -> db -> where( array ( "user_id" => $user_id, "sport_period_id" => $sport_period_id, "sport_id" => $sport_id, "team_id" => $party_id ) );
                                        $this -> db -> update( 'sport_forecasting', $update_forecast );
                                }

                                echo json_encode( array ( "status" => TRUE, "message" => "Data saved successfully." ) );
                                return true;
                        }
                }
        }

        function get_user_sport_forecast_reason( $user_id, $election_period ) {
                $this -> db -> select( '*' );
                $this -> db -> from( 'forecast_reason' );
                $this -> db -> where( array ( "user_id" => $user_id, "period_id" => $election_period ) );
                $resonexist = $this -> db -> get();

                return $resonexist -> row_array();
        }

}
