<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ApiCommon extends CI_Controller {

    private $user_id = 0;
    private $user_alias = "";
    private $silver_points = 0;

    function __construct() {
        parent::__construct();
        $this -> load -> model( "ApiCommon_Mod" );

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

    function topic_list() {
        $inputs = $this -> input -> post();
        $user_id = $inputs[ 'user_id' ];
        $offset = $inputs[ 'offset' ];
        if ( ! $user_id ) {
            $inputs[ 'user_id' ] = 0;
        }
        if ( ! $offset ) {
            $inputs[ 'offset' ] = 0;
        }

        $data = $this -> ApiCommon_Mod -> get_topics_list( $inputs );
        $this -> apiresponse -> sendjson( $data );
    }

    function searched_topics() {
        $inputs = $this -> input -> post();
        $user_id = $inputs[ 'user_id' ];
        $topic = $inputs[ 'topic' ];

        $data = $this -> ApiCommon_Mod -> get_searched_topics( $inputs );
        $this -> apiresponse -> sendjson( $data );
//                if ( $topic == "" ) {
//                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "No records found", "data" => array () ) );
//                } else {
//                        
//                }
    }

    function follow_topic() {
        $inputs = $this -> input -> post();
        $user_id = $inputs[ 'user_id' ];
        $topic = $inputs[ 'topic_id' ];

        if ( $topic == "" || $topic == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide topic id", "data" => ( object ) array () ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id", "data" => ( object ) array () ) );
        } else if ( $user_id > 0 ) {
            $inputs = $this -> input -> post();
            $data = $this -> ApiCommon_Mod -> follow_topic( $inputs );
            $this -> apiresponse -> sendjson( $data );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in", "data" => ( object ) array () ) );
        }
    }

    function notification_list() {
        $inputs = $this -> input -> post();
        $user_id = $inputs[ 'user_id' ];

        if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id", "data" => ( object ) array () ) );
        } else if ( $user_id > 0 ) {
            $data = $this -> ApiCommon_Mod -> get_nofitication_list( $inputs );
            $this -> apiresponse -> sendjson( $data );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in", "data" => ( object ) array () ) );
        }
    }

}
