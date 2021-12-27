<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Packages extends CI_Controller {

        private $user_id = 0;
        private $user_alias = "";
        private $silver_points = 0;

        function __construct() {
                parent::__construct();
                $this -> load -> model( "Packages_Mod" );

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
                $header_data[ 'page_title' ] = "";
                $header_data[ 'page_meta_description' ] = "";
                $header_data[ 'page_meta_keywords' ] = "";
                $header_data[ 'page_img' ] = base_url( "images/logo/preview.jpg" );

                $header_data[ 'uid' ] = $this -> user_id;
                $header_data[ 'silver_points' ] = $this -> silver_points;

                $this -> load -> view( 'bootstrap_header', $header_data );
                $this -> load -> view( 'packages', $data );
                $this -> load -> view( 'bootstrap_footer' );

        }

        function lists() {
                $data = $this -> Packages_Mod -> get_package_lists( $this -> user_id );
                $this -> apiresponse -> sendjson( $data );

        }

        function detail( $packageid, $currentid = 0 ) {
                $user_id = $this -> user_id;
                if ( $user_id > 0 ) {

                        $is_package_purchased = $this -> is_package_purchased( $packageid, $user_id );
                        if ( $is_package_purchased > 0 ) {
                                $inputs[ 'id' ] = $packageid;
                                $inputs[ 'user_id' ] = $this -> user_id;
                                $inputs[ 'current_id' ] = $currentid;

                                $data = $this -> Packages_Mod -> get_package_details( $inputs );


                                if ( $currentid == 0 ) {
                                        $currentid = $data[ 'data' ][ 0 ][ "id" ];
                                }
                                $data[ 'current' ] = $currentid;
                                $header_data[ 'page_title' ] = "Predictions";
                                $header_data[ 'page_img' ] = base_url( "images/logo/prediction_share_logo.png" );
                                $header_data[ 'uid' ] = $this -> user_id;
                                $header_data[ 'silver_points' ] = $this -> silver_points;
                                $header_data[ 'alias' ] = $this -> user_alias;
                                $header_data[ 'page_meta_keywords' ] = "";
                                $header_data[ 'page_meta_description' ] = "";

                                foreach ( $data[ 'data' ] as $key => $value ) {
                                        if ( $value[ 'id' ] == $inputs[ 'current_id' ] ) {
                                                $data[ 'data' ] = array ();
                                                $data[ 'data' ][ 0 ] = $value;
                                                continue;
                                        }
                                }

                                $header_data[ 'id' ] = $currentid;
                                $this -> load -> view( 'bootstrap_header', $header_data );
                                $this -> load -> view( 'prediction_detail', $data );
                                $this -> load -> view( 'bootstrap_footer' );
                        } else {
                                redirect( "Index" );
                        }
                } else {
                        redirect( "Login?section=home" );
                }

        }

        function is_package_purchased( $id, $user_id ) {
                $this -> db -> select( "1" );
                $this -> db -> from( "package_purchased pp" );
                $this -> db -> where( "pp.package_id = '$id' AND pp.user_id = '$user_id'" );
                $user_pkg_result = $this -> db -> get();
                return $user_pkg_result -> num_rows();

        }

        function purchase_package( $id ) {
                $user_id = $this -> user_id;
                if ( $user_id > 0 ) {
                        $is_package_purchased = $this -> is_package_purchased( $id, $user_id );
                        if ( $is_package_purchased > 0 ) {
                                redirect( "Packages/detail/$id" );
                        } else {
                                $this -> db -> select( "p.*" );
                                $this -> db -> from( "package p" );
                                $this -> db -> where( "p.is_active = '1' AND p.end_date > now() AND id = '$id'" );
                                $result = $this -> db -> get() -> row_array();

                                $purchase_amt = ( int ) $result[ 'price' ];

                                $insert_package_purchage = array (
                                    "package_id" => $id,
                                    "user_id" => $user_id,
                                    "amount" => $purchase_amt
                                );
                                $result = $this -> db -> insert( "package_purchased", $insert_package_purchage );

                                if ( $result ) {
                                        $_SESSION[ 'data' ][ 'silver_points' ] = $_SESSION[ 'data' ][ 'silver_points' ] - $purchase_amt;

                                        $this -> db -> where( "id = '$user_id'" );
                                        $this -> db -> set( "unearned_points", "unearned_points-$purchase_amt", FALSE );
                                        $this -> db -> update( "users" );
                                        redirect( "Packages/detail/$id" );
                                }
                        }
                } else {
                        redirect( "Login?section=home" );
                }

        }

        function package_info( $id ) {

                $header_data[ 'uid' ] = $this -> user_id;
                $header_data[ 'silver_points' ] = $this -> silver_points;
                $header_data[ 'alias' ] = $this -> user_alias;


                $data[ 'data' ] = $this -> Packages_Mod -> get_package_info( $id );

                $header_data[ 'page_title' ] = $data[ 'data' ][ 'package_info' ][ 0 ][ 'name' ];
                //$header_data[ 'page_img' ] = base_url( str_replace( "https://", "", $data[ 'data' ][ 'package_info' ][ 0 ][ 'image' ] ) )."?t=".time();
                $header_data[ 'page_img' ] = $data[ 'data' ][ 'package_info' ][ 0 ][ 'image' ] . "?t=" . time();
                $header_data[ 'page_meta_keywords' ] = "";
                $header_data[ 'page_meta_description' ] = "";

                $this -> load -> view( 'bootstrap_header', $header_data );
                $this -> load -> view( 'package_info', $data );
                $this -> load -> view( 'bootstrap_footer' );

        }

}
