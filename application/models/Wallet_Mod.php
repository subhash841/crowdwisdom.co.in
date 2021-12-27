<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Wallet_Mod extends CI_Model {

        function __construct() {
                parent::__construct();

        }

        function get_user_details( $user_id ) {
                $this -> db -> select( "u.id, u.alise as alias, u.email, u.earned_points as total_gold, u.unearned_points as total_silver,"
                        . "s.name as location, p.name as party_affiliation" );
                $this -> db -> from( "users u" );
                $this -> db -> join( "states s", "s.id = u.location", "LEFT" );
                $this -> db -> join( "parties p", "p.id = u.party_affiliation", "LEFT" );
                $this -> db -> where( "u.id = '$user_id'" );
                $result = $this -> db -> get() -> row_array();

                $result[ 'total_diamond' ] = floor( $result[ 'total_gold' ] / 10 );
                return $result;

        }

        function get_points_history( $user_id, $offset = 0, $limit = 100 ) {
                $this -> db -> select( "DATE_FORMAT(ph.created_date,'%D %b %Y') as date, COALESCE(t.topic,'') as topic, ph.type as category, ph.action, ph.point_type as points, ph.points as value, ph.id, ph.post_id, ph.user_id, ph.choice_id" );
                $this -> db -> from( "points_history ph" );
                $this -> db -> join( "topics t", "t.id = ph.topic_id", "LEFT" );
                $this -> db -> where( "user_id = '$user_id'" );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $result = $this -> db -> get() -> result_array();
                return $result;

        }

        function update_user_profile_mod( $user_id, $data ) {
                $alias = $data[ 'alias' ];
                $location = $data[ 'location' ];
                $party_affiliation = $data[ 'party_affiliation' ];

                $update_array = array (
                    "alise" => $alias,
                    "location" => $location,
                    "party_affiliation" => $party_affiliation,
                );
                $this -> db -> where( "id", $user_id );
                $this -> db -> update( "users", $update_array );
                return TRUE;

        }

        function update_name_mod( $user_id, $name ) {
                if ( $name == '' || is_null( $name ) ) {
                        echo json_encode( array ( 'status' => 'false' ) );
                } else {
                        $update_array = array ( "alise" => $name );
                        $this -> db -> where( "id", $user_id );
                        $this -> db -> update( "users", $update_array );
                        $_SESSION[ 'data' ][ 'alise' ] = $name;

                        echo json_encode( array ( 'status' => 'true', 'name' => $name ) );
                }

        }

}
