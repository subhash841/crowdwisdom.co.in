<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Home extends CI_Controller {

        private $election_period_id = 0;
        private $state_id = 0;
        private $total_seats = 0;
        private $is_result_out = NULL;
        private $user_id = 0;

        function __construct() {
                parent::__construct();
                $this -> load -> helper( 'common_helper' );
                $this -> load -> model( 'Rajasthan/Results_Mod' );

                $election_period = get_current_election_period_other( 6 );
                $this -> election_period_id = $election_period[ 0 ][ 'id' ];
                $this -> state_id = $election_period[ 0 ][ 'state_id' ];
                $this -> total_seats = $election_period[ 0 ][ 'total_seats' ];
                $this -> is_result_out = $election_period[ 0 ][ 'is_result_out' ];

                $sessiondata = $this -> session -> userdata( 'data' );
                if ( ! empty( $sessiondata ) ) {
                        $this -> user_id = $sessiondata[ 'uid' ];
                } else {
                        $this -> user_id = 0;
                }

        }

        function index() {
                $election_period_id = $this -> election_period_id;
                $state_id = $this -> state_id;
                $total_seats = $this -> total_seats;
                $data = array ();

                $header_data[ 'page_title' ] = "Rajasthan opinion poll, Rajasthan election prediction, who will win Rajasthan election";
                $header_data[ 'page_img' ] = base_url() . "images/common/RJ-logo.PNG?t=" . time();
                $header_data[ 'page_meta_keywords' ] = "Rajasthanopinionpoll, rajasthanelection, whowillwinrajasthan, rajasthanbjp, rajasthancongress";
                $header_data[ 'page_meta_description' ] = "The Rajasthan Assembly Election 2018 is a Daily Prediction Tracker updated every morning. You can change your predictions as often as you wish until the day of the election. Please note, this is a crowdsourcing prediction platform. So we will welcome as many as predictions as possible. See the result below.";
                $header_data[ 'uid' ] = $this -> user_id;
                
                $data[ 'user_avg_forecast' ] = $this -> Results_Mod -> get_avg_seat_vote_forecast( $election_period_id, $state_id );
                $data[ 'is_result_out' ] = $this -> is_result_out;
                $data[ 'total_seats' ] = $this -> total_seats;
                $data[ 'blogs' ] = getAllBlogs();

                $this -> load -> view( 'bootstrap_header', $header_data );
                $this -> load -> view( 'Rajasthan/banner' );

                if ( ! empty( $data[ 'user_avg_forecast' ] ) ) {

                        foreach ( $data[ 'user_avg_forecast' ] as $avg_forecast ) {
                                if ( round( $avg_forecast[ 'avg_seatforecast' ] ) > 0 ) {
                                        $available = "1";
                                        break;
                                }
                        }

                        $load_view = ($available == "1") ? "Rajasthan/home" : "Rajasthan/default_home";
                        $this -> load -> view( $load_view, $data );
                } else {
                        $this -> load -> view( 'Rajasthan/default_home', $data );
                }

                $this -> load -> view( 'bootstrap_footer' );

        }

}
