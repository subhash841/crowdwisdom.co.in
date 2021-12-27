<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ForecastDetails extends CI_Controller {

        private $user_id = 0;
        private $election_period_id = 0;
        private $state_id = 0;
        private $total_seats = 0;
        private $is_result_out = NULL;

        function __construct() {
                parent::__construct();
                $this -> load -> model( 'ForecastDetails_Mod' );
                $this -> load -> helper( 'common_helper' );

                $election_period = get_election_period();
                $this -> election_period_id = $election_period[ 0 ][ 'id' ];
                $this -> state_id = $election_period[ 0 ][ 'state_id' ];
                $this -> total_seats = $election_period[ 0 ][ 'total_seats' ];
                $this -> is_result_out = $election_period[ 0 ][ 'is_result_out' ];
        }

        /* Load First view with default data for the User */

        function index() {
                $user_id = $this -> user_id;
                $data[ 'election_period' ] = get_election_period();
                $data[ 'states' ] = get_states();
                $data[ 'user_forecast' ] = $this -> ForecastDetails_Mod -> get_user_forecast_details( $user_id, $this -> election_period_id, $this -> state_id );
                $this -> load -> view( 'forecast_details', $data );
        }

        function getSeatVoteAvgForecasting() {
                //$election_period = get_election_period();
                //$election_period_id = $election_period[0]['id'];
                $election_period_id = $this -> election_period_id;

                $data[ 'user_avg_forecast' ] = $this -> ForecastDetails_Mod -> get_seat_vote_avg_forecasting( $election_period_id );
                $this -> load -> view( 'avg_forecast_details', $data );
        }

        /* STEP - 1
         * 
         * updateUserForecast
         * Update users SEAT AND VOTE forecast when user play any game
         */

        function updateUserForecast() {
                $inputs = $this -> input -> post();
                $inputs[ 'user_id' ] = $this -> user_id;
                $this -> ForecastDetails_Mod -> update_user_forecast( $inputs );
                redirect( 'ForecastDetails' );
        }

        /*
         * addAndUpdateForecastDifference
         * Add and update forecast difference against all users for election period
         */

        function otherStepsCall() {
                //Step 2
                //$this->addAndUpdateForecastDifference();
                //Step 3
                //$this->applyInitialRanktoUsers();
                //Step 4
                //$this->updateWinningGapofUsers();
                //Step 5
                //$this->applySecondRanktoUsers();
                //Step 6
                //$this->getAndUpdateAvgRankofUsers();
                //Step 7
                //$this->getAndUpdateFinalRankofUsers();
                //Step 8
                //$this->beforePointsCalculation();
                //Step 9
                $this -> givePointstoUsers();

                redirect( 'ForecastDetails' );
        }

        /* STEP - 2 this will after election result out
         * 
         * addAndUpdateForecastDifference
         * Add and update forecast difference against all users for election period
         */

        function addAndUpdateForecastDifference() {
                $seat_diff = 0;
                $vote_diff = 0;

                //$userdata = getUserListing();
                //$election_period = get_election_period();
                //$election_period_id = $election_period[0]['id'];
                $election_period_id = $this -> election_period_id;
                $state_id = $this -> state_id;

                $getuserdata = "SELECT * FROM users WHERE id IN (SELECT DISTINCT(user_id) FROM `user_forecasting` WHERE `election_period_id` = $election_period_id)";
                $userdata = $this -> db -> query( $getuserdata ) -> result_array();

                foreach ( $userdata as $user ) {
                        if ( $user[ 'is_game_played' ] == 1 ) {
                                $user_id = $user[ 'id' ];
                                $user_forecast = $this -> ForecastDetails_Mod -> get_user_forecast_details( $user_id, $election_period_id, $state_id );

                                foreach ( $user_forecast as $user_forecast_data ) {
                                        $seat_diff += abs( $user_forecast_data[ 'actual_seats' ] - $user_forecast_data[ 'seat_forecast' ] );
                                        $vote_diff += abs( $user_forecast_data[ 'actual_votes' ] - $user_forecast_data[ 'vote_forcast' ] );
                                }

                                $this -> ForecastDetails_Mod -> add_update_forecast_difference( $user_id, $election_period_id, $seat_diff, $vote_diff );

                                $seat_diff = $vote_diff = 0;
                        }
                }

                return TRUE;
        }

        /* STEP - 3
         * 
         * applyInitialRanktoUsers
         * Apply ranking to users basis of sum of difference 
         */

        function applyInitialRanktoUsers() {
                //$election_period = get_election_period();
                //$election_period_id = $election_period[0]['id'];
                $election_period_id = $this -> election_period_id;

                $this -> ForecastDetails_Mod -> apply_initial_rank_to_users( $election_period_id );

                //redirect('ForecastDetails');
        }

        /* STEP - 4
         * 
         * updateWinningGapofUsers
         * Update winning gap of users 
         */

        function updateWinningGapofUsers() {
                //$election_period = get_election_period();
                //$election_period_id = $election_period[0]['id'];
                $election_period_id = $this -> election_period_id;
                //$state_id = '1';
                $state_id = $this -> state_id;

                $this -> ForecastDetails_Mod -> update_winning_gap_of_users( $election_period_id, $state_id );

                //redirect('ForecastDetails');
        }

        /* STEP - 5
         * 
         * applyInitialRanktoUsers
         * Apply ranking to users basis of sum of difference 
         */

        function applySecondRanktoUsers() {
                //$election_period = get_election_period();
                //$election_period_id = $election_period[0]['id'];
                $election_period_id = $this -> election_period_id;

                $this -> ForecastDetails_Mod -> apply_second_rank_to_users( $election_period_id );

                //redirect('ForecastDetails');
        }

        /* STEP - 6
         * 
         */

        function getAndUpdateAvgRankofUsers() {
                //$election_period = get_election_period();
                //$election_period_id = $election_period[0]['id'];
                $election_period_id = $this -> election_period_id;

                $this -> ForecastDetails_Mod -> get_and_update_avg_rank_of_users( $election_period_id );

                //redirect('ForecastDetails');
        }

        /* STEP - 7
         * 
         */

        function getAndUpdateFinalRankofUsers() {
                //$election_period = get_election_period();
                //$election_period_id = $election_period[0]['id'];
                $election_period_id = $this -> election_period_id;

                $this -> ForecastDetails_Mod -> get_and_update_final_rank_of_users( $election_period_id );

                //redirect('ForecastDetails');
        }

        /* STEP - 8
         * 
         * beforePointsCalculation
         */

        function beforePointsCalculation() {
                //$election_period = get_election_period();
                //$election_period_id = $election_period[0]['id'];
                $election_period_id = $this -> election_period_id;

                $this -> ForecastDetails_Mod -> before_points_calculation( $election_period_id );
        }

        /* STEP - 9
         * 
         * givePointstoUsers
         */

        function givePointstoUsers() {
                //$election_period = get_election_period();
                //$election_period_id = $election_period[0]['id'];
                $election_period_id = $this -> election_period_id;

                $this -> ForecastDetails_Mod -> give_points_to_users( $election_period_id );
        }

        function generate_certificate() {
                $certified_users = get_certified_users();
                //$uid = "225";
                //$certified_users = getUserDetail($uid);

                foreach ( $certified_users as $users ) {
                        $name = $users[ 'name' ];
                        $id = $users[ 'id' ];
                        $twitter_id = $users[ 'twitter_id' ];

                        $path = createcertificate( $name, $id, $twitter_id );

                        $update_cert = array (
                            "certificate_path" => $path
                        );
                        $this -> db -> where( "id = $id" );
                        $this -> db -> update( "users", $update_cert );
                }

                $this -> db -> cache_delete_all();
        }

        function update_rank_of_users() {

                $all_certified_users = get_all_certified_users();

                $s = 1;
                foreach ( $all_certified_users as $all_certified ) {
                        $id = $all_certified[ 'id' ];
                        $points = $all_certified[ 'points' ];

                        $update_rank = array (
                            "rank" => $s,
                            "points" => $points
                        );
                        $this -> db -> where( "id = $id" );
                        $this -> db -> update( "users", $update_rank );
                        $s ++;
                }

                $this -> db -> cache_delete_all();
        }

}
