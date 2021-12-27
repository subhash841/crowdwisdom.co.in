<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ApiPackages extends CI_Controller {

    private $user_id = 0;
    private $user_alias = "";
    private $silver_points = 0;

    function __construct() {
        parent::__construct();
        $this -> load -> model( 'ApiPackages_Mod' );

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

    function lists() {
        $inputs = $this -> input -> post();

        $user_id = $inputs[ 'user_id' ];

        if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else { //if ( $user_id > 0 )
            $data = $this -> ApiPackages_Mod -> get_package_lists( $inputs );
            $this -> apiresponse -> sendjson( $data );
        }
//        else {
//            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
//        }
    }

    function package_info() {
        $inputs = $this -> input -> post();

        $package_id = $inputs[ 'id' ];
        $user_id = $inputs[ 'user_id' ];

        if ( $package_id == "" || $package_id == "0" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide package id" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else { //if ( $user_id > 0 )
            $data = $this -> ApiPackages_Mod -> get_package_info( $inputs );
            $this -> apiresponse -> sendjson( $data );
        }
//        else {
//            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
//        }
    }

    function is_package_purchased( $id, $user_id ) {
        $this -> db -> select( "1" );
        $this -> db -> from( "package_purchased pp" );
        $this -> db -> where( "pp.package_id = '$id' AND pp.user_id = '$user_id'" );
        $user_pkg_result = $this -> db -> get();
        return $user_pkg_result -> num_rows();
    }

    function get_package_question_ids( $package_id ) {
        $this -> db -> select( "pd.module_id" );
        $this -> db -> from( "package_data pd" );
        $this -> db -> where( "pd.package_id = '$package_id'" );
        $result = $this -> db -> get() -> result_array();
        $ids = array ();
        foreach ( $result as $ids_data ) {
            $ids[] = $ids_data[ 'module_id' ];
        }
        return $ids;
    }

    function purchase_package() {
        $inputs = $this -> input -> post();

        $package_id = $inputs[ 'id' ];
        $user_id = $inputs[ 'user_id' ];

        if ( $package_id == "" || $package_id == "0" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide package id" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $is_package_purchased = $this -> is_package_purchased( $package_id, $user_id );
            $question_ids = $this -> get_package_question_ids( $package_id );
            if ( $is_package_purchased > 0 ) {
                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "You already purchased this package", "question_ids" => $question_ids ) );
            } else {
                $data = $this -> ApiPackages_Mod -> purchase_package_mod( $inputs );
                if ( $data ) {
                    $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Package purchased successfully", "question_ids" => $question_ids ) );
                } else {
                    $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "You do not have sufficient silver points" ) );
                }
            }
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
        }
    }

}
