<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reasons extends CI_Controller {

        private $election_period_id = 0;
        private $state_id = 0;

        function __construct() {
                parent::__construct();

                $this -> load -> helper( 'common_helper' );
                $this -> load -> model( 'Chhattisgarh/Reasons_Mod' );

                $election_period = get_current_election_period_other( 5 );
                $this -> election_period_id = $election_period[ 0 ][ 'id' ];
                $this -> state_id = $election_period[ 0 ][ 'state_id' ];

        }

        function index() {
                $data[ 'reasons' ] = $this -> Reasons_Mod -> get_users_forecast_and_reasons( $this -> election_period_id, $this -> state_id );
                $data[ 'total_reasons' ] = $this -> Reasons_Mod -> get_forecast_reasons_count( $this -> election_period_id, $this -> state_id );

                $header_data[ 'page_title' ] = "Chhattisgarh - Reasons";
                $header_data[ 'page_img' ] = base_url() . "images/common/CH-logo.PNG?t=" . time();
                $header_data[ 'page_meta_keywords' ] = "chhattisgarhopinionpoll, chhattisgarhelection, whowillwinchhattisgarh, chhattisgarhbjp, chhattisgarhcongress";
                $header_data[ 'page_meta_description' ] = "We have launched the Chhattisgarh Assembly Election 2018 Weekly Prediction Tracker.  We update the data every wednesday morning. You can change your predictions as often as you wish until the day of the election. Please note, this is a crowdsourcing prediction platform. So we will welcome as many as predictions as possible. See the result below.";

                $this -> load -> view( 'header', $header_data );
                $this -> load -> view( 'Chhattisgarh/banner' );
                $this -> load -> view( 'Chhattisgarh/reason', $data );
                $this -> load -> view( 'Allindia/footer' );

        }

        function Page( $offset = 1 ) {
                $data[ 'current_page' ] = $offset;
                $offset = $offset - 1;
                $offset = $offset * 10;

                $data[ 'reasons' ] = $this -> Reasons_Mod -> get_users_forecast_and_reasons( $this -> election_period_id, $this -> state_id, $offset );
                $data[ 'total_reasons' ] = $this -> Reasons_Mod -> get_forecast_reasons_count( $this -> election_period_id, $this -> state_id );

                $header_data[ 'page_title' ] = "Chhattisgarh - Reasons";
                $header_data[ 'page_img' ] = base_url() . "images/common/CH-logo.PNG?t=" . time();
                $header_data[ 'page_meta_keywords' ] = "chhattisgarhopinionpoll, chhattisgarhelection, whowillwinchhattisgarh, chhattisgarhbjp, chhattisgarhcongress";
                $header_data[ 'page_meta_description' ] = "We have launched the Chhattisgarh Assembly Election 2018 Weekly Prediction Tracker.  We update the data every wednesday morning. You can change your predictions as often as you wish until the day of the election. Please note, this is a crowdsourcing prediction platform. So we will welcome as many as predictions as possible. See the result below.";

                $this -> load -> view( 'header', $header_data );
                $this -> load -> view( 'Chhattisgarh/banner' );
                $this -> load -> view( 'Chhattisgarh/reason', $data );
                $this -> load -> view( 'Allindia/footer' );

        }

}
