<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AppLogin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this -> load -> model( 'AppLogin_Mod' );
    }

    function social_login() {

        $this -> form_validation -> set_rules( 'login_type', 'Login Type', 'trim|required' );
        $this -> form_validation -> set_rules( 'social_id', 'Social ID', 'trim|required' );
        $this -> form_validation -> set_rules( 'email', 'Email', 'trim' );
        $this -> form_validation -> set_rules( 'name', 'Name', 'trim|required' );
        $this -> form_validation -> set_rules( 'twitter_handle', 'Twitter Handle', 'trim' );

        $data = array ();
        if ( $this -> form_validation -> run() === FALSE ) {

            if ( form_error( "login_type" ) != "" ) {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => strip_tags( form_error( "login_type" ) ), "data" => $data ) );
            } else if ( form_error( "social_id" ) != "" ) {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => strip_tags( form_error( "social_id" ) ), "data" => $data ) );
            } else if ( form_error( "email" ) != "" ) {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => strip_tags( form_error( "email" ) ), "data" => $data ) );
            } else if ( form_error( "name" ) != "" ) {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => strip_tags( form_error( "name" ) ), "data" => $data ) );
            }
        } else {
            $inputs = $this -> input -> post();
            $login_type = $inputs[ 'login_type' ];
            $email = $inputs[ 'email' ];

            if ( ! in_array( $login_type, array ( "Facebook", "Twitter", "Google" ) ) ) {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Invalid login medium", "data" => $data ) );
            } else if ( $login_type == "Google" && $email == "" ) {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "The Email field is required.", "data" => $data ) );
            } else {
                $data = $this -> AppLogin_Mod -> authenicate( $inputs );
                $data[ 'uid' ] = $data[ 'user_id' ];
                $_SESSION[ 'data' ] = $data;
                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Data found", "data" => $data ) );
            }
        }
    }

    function update_profile() {
        $inputs = $this -> input -> post();
        $alias = $alias = $inputs[ 'alias' ];
        $party_affiliation = $inputs[ 'party_affiliation' ];
        $location = $inputs[ 'location' ];
        $tnc_agree = $inputs[ 'tnc_agree' ];
        $user_id = $inputs[ 'user_id' ];

        if ( $alias == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please enter your alias" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $result = $this -> AppLogin_Mod -> update_user_profile( $inputs );
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Profile updated successfully!", "data" => array () ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
        }
    }

    function update_device_token_and_type() {
        $this -> form_validation -> set_rules( 'device_token', 'Device Token', 'trim|required' );
        $this -> form_validation -> set_rules( 'device_type', 'Device Type', 'trim|required' );

        $data = array ();
        if ( $this -> form_validation -> run() === FALSE ) {

            if ( form_error( "device_token" ) != "" ) {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => strip_tags( form_error( "device_token" ) ), "data" => $data ) );
            } else if ( form_error( "device_type" ) != "" ) {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => strip_tags( form_error( "device_type" ) ), "data" => $data ) );
            }
        } else {
            $inputs = $this -> input -> post();
            $user_id = $inputs[ 'user_id' ];
            $device_type = $inputs[ 'device_type' ];

            if ( ! in_array( $device_type, array ( "Android", "Ios" ) ) ) {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Invalid device type", "data" => $data ) );
            } else if ( $user_id == "" ) {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
            } else if ( $user_id > 0 ) {
                $data = $this -> AppLogin_Mod -> update_device_token_and_type( $inputs );
                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Device token and updated successfully", "data" => ( object ) array () ) );
            } else {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
            }
        }
    }

    function logout() {
        $inputs = $this -> input -> post();
        $user_id = $inputs[ 'user_id' ];

        if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            session_destroy();
            $data = $this -> AppLogin_Mod -> logout( $inputs );
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "You are logged out successfully", "data" => ( object ) array () ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
        }
    }

}
