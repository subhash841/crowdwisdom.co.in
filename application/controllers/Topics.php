<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Topics extends CI_Controller {

        private $user_id = 0;
        private $user_alias = "";
        private $silver_points = 0;

        function __construct() {
                parent::__construct();

                $this -> load -> model( "Topics_Mod" );

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
                $data = array ();
                $header_data[ 'page_title' ] = "Topics";
                $header_data[ 'page_meta_description' ] = "";
                $header_data[ 'page_meta_keywords' ] = "";
                $header_data[ 'page_img' ] = base_url( "images/logo/preview.jpg" );

                $header_data[ 'uid' ] = $this -> user_id;
                $header_data[ 'silver_points' ] = $this -> silver_points;

                $data[ 'lists' ] = $this -> Topics_Mod -> get_topics_list();

                $this -> load -> view( 'bootstrap_header', $header_data );
                $this -> load -> view( 'topics', $data );
                $this -> load -> view( 'bootstrap_footer', $header_data );

        }

}
