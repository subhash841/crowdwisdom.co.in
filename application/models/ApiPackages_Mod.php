<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ApiPackages_Mod extends CI_Model {

        function __construct() {
                parent::__construct();

        }

        function get_package_lists( $inputs, $limit = 11 ) {
                $user_id = $inputs[ 'user_id' ];
                $offset = $inputs[ 'offset' ];

                $this -> db -> select( "p.*, (CASE WHEN pp.id THEN 1 ELSE 0 END) as purchased" );
                $this -> db -> from( "package p" );
                $this -> db -> join( "package_purchased pp", "pp.package_id = p.id AND pp.user_id = '$user_id'", "LEFT" );
                $this -> db -> where( "p.is_active = '1' AND p.end_date > now()" );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $result = $this -> db -> get() -> result_array();

                if ( count( $result ) > 10 ) {
                        unset( $result[ count( $result ) - 1 ] );
                        $is_available = "1";
                } else {
                        $is_available = "0";
                }
                $response = array ( "status" => TRUE, "message" => "No data found", "data" => $result, "is_available" => $is_available );
                return $response;

        }

        function get_package_info( $inputs ) {
                $package_id = $inputs[ 'id' ];
                $user_id = $inputs[ 'user_id' ];

                $this -> db -> select( "p.id, p.name, p.prize_text, p.point_required_text, p.reward_text, p.price, p.image, p.end_date, "
                        . "COUNT(pd.module_id) as prediction_count, (CASE WHEN pp.id THEN 1 ELSE 0 END) as purchased" );
                $this -> db -> from( "package p" );
                $this -> db -> join( "package_data pd", "pd.package_id = p.id", "LEFT" );
                $this -> db -> join( "package_purchased pp", "pp.package_id = p.id AND pp.user_id = '$user_id'", "LEFT" );
                $this -> db -> where( "p.is_active = '1' AND p.id = '$package_id'" );
                $result = $this -> db -> get() -> result_array();

                $silver_points = $this -> get_users_points( $user_id );
                $response = array ( "status" => TRUE, "message" => "No data found", "data" => $result[ 0 ], "silver_points" => $silver_points );
                return $response;

        }

        function get_users_points( $user_id ) {
                $this -> db -> select( "u.unearned_points" );
                $this -> db -> from( "users u" );
                $this -> db -> where( "u.id = '$user_id'" );
                $data = $this -> db -> get() -> row_array();
                return $data[ 'unearned_points' ];

        }

        function purchase_package_mod( $inputs ) {
                $package_id = $inputs[ 'id' ];
                $user_id = $inputs[ 'user_id' ];

                $this -> db -> select( "p.*" );
                $this -> db -> from( "package p" );
                $this -> db -> where( "p.is_active = '1' AND p.end_date > now() AND id = '$package_id'" );
                $result = $this -> db -> get() -> row_array();

                $purchase_amt = ( int ) $result[ 'price' ];

                $users_points = $this -> get_users_points( $user_id );

                if ( $users_points < $purchase_amt ) {
                        return FALSE;
                } else {
                        $insert_package_purchage = array (
                            "package_id" => $package_id,
                            "user_id" => $user_id,
                            "amount" => $purchase_amt
                        );
                        $result = $this -> db -> insert( "package_purchased", $insert_package_purchage );
                        if ( $result ) {
                                $this -> db -> where( "id = '$user_id'" );
                                $this -> db -> set( "unearned_points", "unearned_points-$purchase_amt", FALSE );
                                $this -> db -> update( "users" );
                                return TRUE;
                        }
                }

        }

}
