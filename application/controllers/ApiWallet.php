<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ApiWallet extends CI_Controller {

    private $user_id = 0;
    private $user_alias = "";
    private $silver_points = 0;

    function __construct() {
        parent::__construct();
        $this -> load -> model( "Wallet_Mod" );

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

    function user_profile() {
        $inputs = $this -> input -> post();
        $user_id = $inputs[ 'user_id' ];

        if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $data = $this -> Wallet_Mod -> get_user_details( $user_id );
            if ( ! $data[ 'location' ] ) {
                $data[ 'location' ] = "";
            }
            if ( ! $data[ 'party_affiliation' ] ) {
                $data[ 'party_affiliation' ] = "";
            }

            $data[ 'points' ] = ( string ) ($data[ 'total_silver' ] + $data[ 'total_gold' ]);

            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "User's profile data", "user_data" => $data ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
        }
    }

    /* users_point_history
     * this will be used for mobile app 
     * 
     */

    function user_point_history() {
        $inputs = $this -> input -> post();

        $user_id = $inputs[ 'user_id' ];
        $offset = ($inputs) ? $inputs[ 'offset' ] : 0;
        $limit = 11;

        if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $this -> db -> select( "DATE_FORMAT(ph.created_date,'%D %b %Y') as date, COALESCE(t.topic,'') as topic, ph.type as category, ph.action, ph.point_type as points, ph.points as value, ph.id, ph.post_id, ph.user_id, ph.choice_id" );
            $this -> db -> from( "points_history ph" );
            $this -> db -> join( "topics t", "t.id = ph.topic_id", "LEFT" );
            $this -> db -> where( "user_id = '$user_id' AND ph.points > 0" );
            $this -> db -> offset( $offset );
            $this -> db -> limit( $limit );
            $result = $this -> db -> get() -> result_array();

            if ( count( $result ) > 10 ) {
                unset( $result[ count( $result ) - 1 ] );
                $is_available = "1";
            } else {
                $is_available = "0";
            }
            $data = $this -> Wallet_Mod -> get_user_details( $user_id );
            $points = ( string ) ($data[ 'total_silver' ] + $data[ 'total_gold' ]);

            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "User's points data", "points_history" => $result, "is_available" => $is_available, "points" => $points ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
        }
    }

    function get_users_points() {
        $inputs = $this -> input -> post();

        $user_id = $inputs[ 'user_id' ];

        if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $this -> db -> select( "u.unearned_points" );
            $this -> db -> from( "users u" );
            $this -> db -> where( "u.id = '$user_id'" );
            $data = $this -> db -> get() -> row_array();
            $points = $data[ 'unearned_points' ];

            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "User's points data", "points" => $points ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
        }
    }

}
