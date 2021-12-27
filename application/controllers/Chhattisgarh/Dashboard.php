<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dashboard extends Base_Controller {

        private $user_id = 0;
        private $election_period_id = 0;
        private $state_id = 0;
        private $total_seats = 0;
        private $is_result_out = NULL;

        function __construct() {
                parent::__construct();
                $this -> load -> helper( 'common_helper' );
                $this -> load -> model( 'Chhattisgarh/Dashboard_Mod' );
                $userdata = $this -> session -> userdata( 'data' );

                $this -> user_id = $userdata[ 'uid' ];

                $election_period = get_current_election_period_other( 5 );
                $this -> election_period_id = $election_period[ 0 ][ 'id' ];
                $this -> state_id = $election_period[ 0 ][ 'state_id' ];
                $this -> total_seats = $election_period[ 0 ][ 'total_seats' ];
                $this -> is_result_out = $election_period[ 0 ][ 'is_result_out' ];

        }

        function index() {
                $this -> forecastDetails();

        }

        function forecastDetails() {
                $user_id = $this -> user_id;
                $state_id = $this -> state_id;
                $election_period_id = $this -> election_period_id;

                $header_data[ 'page_title' ] = "Chhattisgarh - Prediction";
                $header_data[ 'page_img' ] = base_url() . "images/common/CH-logo.PNG?t=" . time();
                $header_data[ 'page_meta_keywords' ] = "chhattisgarhopinionpoll, chhattisgarhelection, whowillwinchhattisgarh, chhattisgarhbjp, chhattisgarhcongress";
                $header_data[ 'page_meta_description' ] = "We have launched the Chhattisgarh Assembly Election 2018 Weekly Prediction Tracker.  We update the data every wednesday morning. You can change your predictions as often as you wish until the day of the election. Please note, this is a crowdsourcing prediction platform. So we will welcome as many as predictions as possible. See the result below.";
                //$data['election_period'] = get_election_period();
                //$data['states'] = get_states();
                //$data['parties'] = get_parties();

                $data[ 'blogs' ] = getAllBlogs();
                $data[ 'election_period_id' ] = $this -> election_period_id;
                $data[ 'state_id' ] = $this -> state_id;
                $data[ 'is_result_out' ] = $this -> is_result_out;
                $data[ 'total_seats' ] = $this -> total_seats;

                $data[ 'user_forecast' ] = $this -> Dashboard_Mod -> get_user_forecast_details( $user_id, $election_period_id, $state_id );
                $data[ 'forecast_reason' ] = $this -> Dashboard_Mod -> get_user_forecast_reason( $user_id, $election_period_id );
                $this -> load -> view( 'bootstrap_header', $header_data );
                $this -> load -> view( 'Chhattisgarh/banner' );
                $this -> load -> view( 'Chhattisgarh/user_forecast', $data );
                $this -> load -> view( 'bootstrap_footer' );

        }

        /* STEP - 1
         * 
         * updateUserForecast
         * Update users SEAT AND VOTE forecast when user play any game
         */

        function updateUserForecast() {
                $is_result_out = $this -> is_result_out;

                if ( $is_result_out == "1" ) {
                        echo json_encode( array ( "status" => FALSE, "message" => "अनुमान कार्यक्रम अब बंद हो गया है", "redirect_url" => "" ) );
                        return false;
                }
                if ( $_SESSION[ 'data' ][ 'location' ] == "" ) {
                        echo json_encode( array ( "status" => FALSE, "message" => "कृपया अपनी प्रोफाइल पहले पूरा करें", "redirect_url" => "Profile" ) );
                        return false;
                }
                $inputs = $this -> input -> post();
                $inputs[ 'user_id' ] = $this -> user_id;
                $inputs[ 'total_seats' ] = $this -> total_seats;

                $this -> Dashboard_Mod -> update_user_forecast( $inputs );

        }

}
