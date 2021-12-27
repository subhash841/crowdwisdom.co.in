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
                $this -> load -> model( 'MP/Reasons_Mod' );

                $election_period = get_current_election_period_other( 4 );
                $this -> election_period_id = $election_period[ 0 ][ 'id' ];
                $this -> state_id = $election_period[ 0 ][ 'state_id' ];

        }

        function index() {
                $data[ 'reasons' ] = $this -> Reasons_Mod -> get_users_forecast_and_reasons( $this -> election_period_id, $this -> state_id );
                $data[ 'total_reasons' ] = $this -> Reasons_Mod -> get_forecast_reasons_count( $this -> election_period_id, $this -> state_id );

                $header_data[ 'page_title' ] = "MP - Reasons";
                $header_data[ 'page_img' ] = base_url() . "images/common/MP-logo.png?t=" . time();
                $header_data[ 'page_meta_keywords' ] = "madhyapradeshopinionpoll, madhyapradeshelection, whowillwinmadhyapradesh, madhyapradeshbjp, MadhyaPradeshcongress";
                $header_data[ 'page_meta_description' ] = "Look at the MP opinion polls in 2013. BJP Prediction - 143, 155, 148-160. All predictions were above 140. Look at the MP Opinion Polls in 2018. BJP Prediction - 101, 153, 148-106. It is clear that there is a downward trend in predictions for BJP. The question is, why is there a downward trend?";

                $this -> load -> view( 'header', $page_title );
                $this -> load -> view( 'MP/banner' );
                $this -> load -> view( 'MP/reason', $data );
                $this -> load -> view( 'Allindia/footer' );

        }

        function Page( $offset = 1 ) {
                $data[ 'current_page' ] = $offset;
                $offset = $offset - 1;
                $offset = $offset * 10;

                $data[ 'reasons' ] = $this -> Reasons_Mod -> get_users_forecast_and_reasons( $this -> election_period_id, $this -> state_id, $offset );
                $data[ 'total_reasons' ] = $this -> Reasons_Mod -> get_forecast_reasons_count( $this -> election_period_id, $this -> state_id );

                $header_data[ 'page_title' ] = "MP - Reasons";
                $header_data[ 'page_img' ] = base_url() . "images/common/MP-logo.png?t=" . time();
                $header_data[ 'page_meta_keywords' ] = "madhyapradeshopinionpoll, madhyapradeshelection, whowillwinmadhyapradesh, madhyapradeshbjp, MadhyaPradeshcongress";
                $header_data[ 'page_meta_description' ] = "Look at the MP opinion polls in 2013. BJP Prediction - 143, 155, 148-160. All predictions were above 140. Look at the MP Opinion Polls in 2018. BJP Prediction - 101, 153, 148-106. It is clear that there is a downward trend in predictions for BJP. The question is, why is there a downward trend?";


                $this -> load -> view( 'header', $header_data );
                $this -> load -> view( 'MP/banner' );
                $this -> load -> view( 'MP/reason', $data );
                $this -> load -> view( 'Allindia/footer' );

        }

}
