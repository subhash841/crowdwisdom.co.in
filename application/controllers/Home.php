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
    private $user_alias = "";
    private $silver_points = 0;

    function __construct() {
        parent::__construct();
        $this -> load -> model( 'Results_Mod' );
        $this -> load -> helper( 'common_helper' );

        $election_period = get_current_election_period();
        $this -> election_period_id = $election_period[ 0 ][ 'id' ];
        $this -> state_id = $election_period[ 0 ][ 'state_id' ];
        $this -> total_seats = $election_period[ 0 ][ 'total_seats' ];
        $this -> is_result_out = $election_period[ 0 ][ 'is_result_out' ];

        $sessiondata = $this -> session -> userdata( 'data' );
        if ( ! empty( $sessiondata ) ) {
            $this -> user_id = $sessiondata[ 'uid' ];
            $this -> user_alias = $sessiondata[ 'alise' ];
            $this -> silver_points = $sessiondata[ 'silver_points' ];
        } else {
            $this -> user_id = 0;
            $this -> user_alias = "";
            $this -> silver_points = 0;
        }
    }

    function index() {
        $election_period_id = $this -> election_period_id;
        $state_id = $this -> state_id;
        $total_seats = $this -> total_seats;
        $data = array ();

        $header_data[ 'page_title' ] = "Home";
        $header_data[ 'page_img' ] = base_url() . "images/common/lok_sabha2019.PNG";

        $data[ 'user_avg_forecast' ] = $this -> Results_Mod -> get_avg_seat_vote_forecast( $election_period_id, $state_id );
        $data[ 'is_result_out' ] = $this -> is_result_out;
        $data[ 'total_seats' ] = $this -> total_seats;
        $data[ 'blogs' ] = getAllBlogs();

        $this -> load -> view( 'header', $header_data );
        $this -> load -> view( 'banner' );

        if ( ! empty( $data[ 'user_avg_forecast' ] ) ) {

            foreach ( $data[ 'user_avg_forecast' ] as $avg_forecast ) {
                if ( round( $avg_forecast[ 'avg_seatforecast' ] ) > 0 ) {
                    $available = "1";
                    break;
                }
            }

            $load_view = ($available == "1") ? "home" : "default_home";
            $this -> load -> view( $load_view, $data );
        } else {
            $this -> load -> view( 'default_home', $data );
        }

        $this -> load -> view( 'footer' );
    }

    function index_old() {
        //redirect('Stock/Home');
        $available = "0";
        $election_period = get_election_period();
        $election_period_id = $election_period[ 0 ][ 'id' ];

        $data[ 'page_title' ] = "Home";
        $data[ 'user_avg_forecast' ] = $this -> Results_Mod -> get_seat_vote_avg_forecasting( $election_period_id );
        $data[ 'blogs' ] = getAllBlogs();
        $data[ 'is_result_out' ] = $election_period[ 0 ][ 'is_result_out' ];
        $data[ 'certified_users' ] = get_certified_users();

        $this -> load -> view( 'header', $data );
        //Enable Result page for party wise result - after result declaration
        //$this->load->view('result', $data);

        if ( ! empty( $data[ 'user_avg_forecast' ] ) ) {

            foreach ( $data[ 'user_avg_forecast' ] as $avg_forecast ) {
                if ( round( $avg_forecast[ 'avg_seatforecast' ] ) > 0 ) {
                    $available = "1";
                    break;
                }
            }

            $load_view = ($available == "1") ? "home1" : "home";
            $this -> load -> view( $load_view, $data );
        } else {
            $this -> load -> view( 'home', $data );
        }
        $this -> load -> view( 'footer' );
    }

    function home() {
        $this -> load -> view( 'header' );
        $this -> load -> view( 'home1' );
        $this -> load -> view( 'footer' );
    }

    function aboutus() {
        $header_data[ 'page_title' ] = "About Us";
        $header_data[ 'page_meta_description' ] = "";
        $header_data[ 'page_meta_keywords' ] = "";
        $header_data[ 'page_img' ] = base_url( "images/logo/preview.jpg" );
        $header_data[ 'uid' ] = $this -> user_id;
        $header_data[ 'silver_points' ] = $this -> silver_points;

        $this -> load -> view( 'bootstrap_header', $header_data );
        $this -> load -> view( 'aboutus_new' );
        $this -> load -> view( 'bootstrap_footer' );
    }

    function aboutus_old_copy_backup() {
        $data[ 'page_title' ] = "About Us";
        $this -> load -> view( 'header', $data );
        $this -> load -> view( 'aboutus' );
        $this -> load -> view( 'footer' );
    }

    function result() {
        $available = "0";
        $election_period = get_election_period();
        $election_period_id = $election_period[ 0 ][ 'id' ];

        $data[ 'user_avg_forecast' ] = $this -> Results_Mod -> get_seat_vote_avg_forecasting( $election_period_id );
        $data[ 'blogs' ] = getAllBlogs();
        $data[ 'tweets' ] = get_twitter_tweets();
        $data[ 'is_result_out' ] = $election_period[ 0 ][ 'is_result_out' ];
        $data[ 'certified_users' ] = get_certified_users();

        $this -> load -> view( 'header' );
        $this -> load -> view( 'result', $data );
        $this -> load -> view( 'footer' );
    }

    function resultlist() {
        $data[ 'certified_users' ] = get_certified_users();
        $this -> load -> view( 'resultlist', $data );
        $this -> load -> view( 'footer' );
    }

    function singleresult( $id ) {
        $data = $this -> Results_Mod -> get_actual_and_users_seat_vote_forecast( $id );
        $this -> load -> view( 'singleresult', $data );
        $this -> load -> view( 'footer' );
    }

    function ajax_users_list( $offset ) {
        $certified_users = get_certified_users( $offset );
        echo json_encode( $certified_users );
    }

}
