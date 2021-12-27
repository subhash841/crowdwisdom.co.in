<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Wallet extends CI_Controller {

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

        /* index - users_point_history
         * this will be used for mobile web 
         * 
         */

        function index() {
                if ( $this -> user_id > 0 ) {
                        $data = array ();
                        $header_data[ 'page_title' ] = "Points History - Crowdwisdom";
                        $header_data[ 'page_meta_description' ] = "";
                        $header_data[ 'page_meta_keywords' ] = "";
                        $header_data[ 'page_img' ] = base_url( "images/logo/preview.jpg" );

                        $header_data[ 'uid' ] = $this -> user_id;
                        $header_data[ 'alias' ] = $this -> user_alias;
                        $header_data[ 'silver_points' ] = $this -> silver_points;
                        $data[ 'silver_points' ] = $this -> silver_points;

                        $data[ 'points_history' ] = $this -> Wallet_Mod -> get_points_history( $this -> user_id );
                        $data[ 'user_data' ] = $this -> Wallet_Mod -> get_user_details( $this -> user_id );
                        $data[ 'user_data' ][ 'points' ] = $this -> silver_points + $data[ 'user_data' ][ 'total_gold' ];

                        $this -> load -> view( "bootstrap_header", $header_data );
                        $this -> load -> view( "points_history", $data );
                        $this -> load -> view( "bootstrap_footer" );
                } else {
                        redirect( "Login?section=wallet" );
                }

        }

        /* profile
         * this will be used for web
         * 
         */

        function profile() {
                $data = array ();
                $header_data[ 'page_title' ] = "Profile - Crowdwisdom";
                $header_data[ 'page_meta_description' ] = "";
                $header_data[ 'page_meta_keywords' ] = "";
                $header_data[ 'page_img' ] = base_url( "images/logo/preview.jpg" );

                $header_data[ 'uid' ] = $this -> user_id;
                $header_data[ 'alias' ] = $this -> user_alias;
                $header_data[ 'silver_points' ] = $this -> silver_points;

                $data[ 'user_data' ] = $this -> Wallet_Mod -> get_user_details( $this -> user_id );
                $data[ 'user_data' ][ 'points' ] = $this -> silver_points + $data[ 'user_data' ][ 'total_gold' ];

                //$data[ 'states' ] = get_all_states();
                //$data[ 'parties' ] = get_parties();

                $this -> load -> view( "bootstrap_header", $header_data );
                $this -> load -> view( "profile_new", $data );
                $this -> load -> view( "bootstrap_footer" );

        }

        /* user_profile
         * this will be used for mobile app 
         * 
         */

        function user_profile() {
                $data = $this -> Wallet_Mod -> get_user_details( $this -> user_id );
                $data[ 'points' ] = $data[ 'total_silver' ] + $data[ 'total_gold' ];

                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "User's profile data", "user_data" => $data ) );

        }

        /* users_point_history
         * this will be used for mobile app 
         * 
         */

        function users_point_history() {
                $inputs = $this -> input -> post();

                $offset = ($inputs) ? $inputs[ 'offset' ] : 0;

                $data = $this -> Wallet_Mod -> get_points_history( $this -> user_id, $offset );

                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "User's points data", "points_history" => $data ) );

        }

        function update_profile() {

                $header_data[ 'page_title' ] = "Update Profile";
                $header_data[ 'page_meta_description' ] = "";
                $header_data[ 'page_meta_keywords' ] = "";
                $header_data[ 'page_img' ] = base_url( "images/logo/preview.jpg" );

                $header_data[ 'uid' ] = $this -> user_id;
                $header_data[ 'alias' ] = $this -> user_alias;
                $header_data[ 'silver_points' ] = $this -> silver_points;

                $data[ 'page_title' ] = "Profile";
                $data[ 'user_detail' ] = getUserDetail( $this -> user_id );
                $data[ 'all_states' ] = get_all_states();
                $data[ 'parties_list' ] = get_parties();


                $this -> load -> view( "bootstrap_header", $header_data );
                $this -> load -> view( 'update_profile', $data );
                $this -> load -> view( "bootstrap_footer" );

        }

        function update_user_profile() {

                $inputs = $this -> input -> post();
                $alias = $inputs[ 'alias' ];
                $location = $inputs[ 'location' ];
                $party_affiliation = $inputs[ 'party_affiliation' ];

                echo $result = $this -> Wallet_Mod -> update_user_profile_mod( $this -> user_id, $inputs );

        }

        function update_name() {
                $inputs = $this -> input -> post();
                $name = $inputs[ 'name' ];
                return $result = $this -> Wallet_Mod -> update_name_mod( $this -> user_id, $name );

        }

}
