<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AppLogin_Mod extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function authenicate( $inputs ) {
        $name = $inputs[ 'name' ];
        $social_id = $inputs[ 'social_id' ];
        $twitter_handle = $inputs[ 'twitter_handle' ];
        $email = $inputs[ 'email' ];
        $login_type = $inputs[ 'login_type' ];

        $where_cond = "";
        if ( $login_type == "Facebook" && $email != "" ) {
            $where_cond = " AND email = '$email'";
        }
        if ( $login_type == "Twitter" && $twitter_handle != "" ) {
            $where_cond = " AND twitter_id = '$twitter_handle'";
        }
        if ( $login_type == "Google" && $email != "" ) {
            $where_cond = " AND email = '$email'";
        }

        $this -> db -> select( "u.id, u.name, u.email, u.login_type, COALESCE(u.alise,'') as alias, u.tnc_agree, u.earned_points as gold_points, "
                . "u.unearned_points as silver_points" );
        $this -> db -> from( "users u" );
        $this -> db -> where( "login_type = '$login_type' AND u.social_id = '$social_id' $where_cond" );
        $result = $this -> db -> get();


        $is_exists = $result -> num_rows();

        if ( $is_exists == "0" ) {
            $insert_array = array (
                "name" => $name,
                "social_id" => $social_id,
                "twitter_id" => $twitter_handle,
                "email" => $email,
                "login_type" => $login_type,
                "unearned_points" => "0",
            );

            $this -> db -> insert( "users", $insert_array );
            $last_id = $this -> db -> insert_id();

            $data = array (
                "id" => "$last_id",
                "user_id" => "$last_id",
                "name" => $name,
                "email" => $email,
                "login_type" => $login_type,
                "alias" => "",
                "tnc_agree" => "0",
                "gold_points" => "0",
                "silver_points" => "0",
                "token" => ""
            );
            return $data;
        } else {
            $data = $result -> row_array();
            $data[ 'token' ] = "";
            $data[ 'user_id' ] = $data[ 'id' ];
            return $data;
        }
    }

    public function generate_access_token( $uid, $ttl = 86400 ) {
        $token = bin2hex( openssl_random_pseudo_bytes( 16 ) );
        $delete = true;
        //$delete = $this->delete_access_token($uid);
        if ( $delete ) {
            $ins_accesstoken = "INSERT INTO tbl_access_token (user_id,access_token,time_to_leave,created_date) VALUES('$uid','$token','$ttl',now())";
            $insres = $this -> db -> query( $ins_accesstoken );
            if ( $insres ) {
                return $token;
                exit();
            }
        }
    }

    public function update_user_profile( $inputs ) {
        $inputs = $this -> input -> post();
        $alias = $alias = $inputs[ 'alias' ];
        $party_affiliation = $inputs[ 'party_affiliation' ];
        $location = $inputs[ 'location' ];
        $tnc_agree = $inputs[ 'tnc_agree' ];
        $user_id = $inputs[ 'user_id' ];

        $update = array (
            "alise" => $alias,
            "location" => "",
            "party_affiliation" => "",
            "tnc_agree" => $tnc_agree
        );

        $this -> db -> where( "id = $user_id" );
        $this -> db -> update( 'users', $update );
        return TRUE;
    }

    public function update_device_token_and_type( $inputs ) {
        $device_token = $inputs[ 'device_token' ];
        $device_type = $inputs[ 'device_type' ];
        $user_id = $inputs[ 'user_id' ];

        $update_array = array (
            "device_token" => $device_token,
            "device_type" => $device_type
        );

        $this -> db -> where( "id = '$user_id'" );
        $this -> db -> update( "users", $update_array );
        return TRUE;
    }

    function logout( $inputs ) {
        $user_id = $inputs[ 'user_id' ];

        $update_array = array (
            "device_token" => NULL,
        );

        $this -> db -> where( "id = '$user_id'" );
        $this -> db -> update( "users", $update_array );
        return TRUE;
    }

}
