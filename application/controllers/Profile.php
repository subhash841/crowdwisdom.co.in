<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Profile extends Base_Controller {

        private $user_id = 0;

        function __construct() {
                parent::__construct();
                $userdata = $this -> session -> userdata( 'data' );

                $this -> user_id = $userdata[ 'uid' ];
                $this -> load -> model( 'Results_Mod' );
                $this -> load -> helper( 'common_helper' );

        }

        function index() {

                $data[ 'page_title' ] = "Profile";
                $data[ 'user_detail' ] = getUserDetail( $this -> user_id );
                $data[ 'all_states' ] = get_all_states();
                $data[ 'parties_list' ] = get_parties();
                $this -> load -> view( 'header', $data );
                //$this->load->view('banner');
                $this -> load -> view( 'profile', $data );
                $this -> load -> view( 'footer' );

//        $id = $this->user_id;
//        $data = $this->Results_Mod->get_actual_and_users_seat_vote_forecast($id);
//        $this->load->view('singleresult', $data);
//        $this->load->view('footer');

        }

        function updateUserProfile() {
                $inputs = $this -> input -> post();

                $update = array (
                    "alise" => $inputs[ 'alise' ],
                    "location" => @$inputs[ 'location' ],
                    "party_affiliation" => @$inputs[ 'party_affiliation' ]
                );

                $uid = $this -> user_id;
                $this -> db -> where( "id = $uid" );
                $this -> db -> update( 'users', $update );

                $_SESSION[ 'data' ][ 'location' ] = @$inputs[ 'location' ];
                $_SESSION[ 'data' ][ 'alise' ] = $inputs[ 'alise' ];

                echo json_encode( array ( "status" => TRUE, "message" => "Profile updated successfully" ) );

        }

        function pointsHistory( $currentpage = 1 ) {

                $data = array ();
                $header_data[ 'page_title' ] = "Profile";

                $offset = ($currentpage - 1) * 10;

                $data[ 'user_detail' ] = $this -> get_user_details( $this -> user_id );
                $data[ 'user_point_history' ] = $this -> get_point_history( $this -> user_id, $offset );
                $user_total_history = $this -> get_users_total_history( $this -> user_id );
                $user_total_prediction = $this -> get_users_prediction_count( $this -> user_id );

                $data[ 'current_page' ] = $currentpage;
                //$data['total_history'] = 20;
                $data[ 'total_history' ] = $user_total_history[ 'total_history' ];
                $data[ 'total_prediction' ] = $user_total_prediction[ 'total_prediction' ];

                $this -> load -> view( 'header', $header_data );
                $this -> load -> view( 'point_history', $data );
                $this -> load -> view( 'footer' );

        }

        function get_user_details( $id ) {
                $this -> db -> select( "u.id,u.name,u.rank,u.points,u.certificate_path,u.alise,u.earned_points as gold_points, u.unearned_points as silver_points,s.name as location,p.name as party,p.abbreviation" );
                $this -> db -> from( "users u" );
                $this -> db -> join( "states s", "s.id = u.location", "LEFT" );
                $this -> db -> join( "parties p", "p.id = u.party_affiliation", "LEFT" );
                $this -> db -> where( "u.id = $id" );
                return $user_detail = $this -> db -> get() -> row_array();

        }

        function get_point_history( $id, $offset ) {
                $this -> db -> select( "pa.id,pa.poll_id,pa.user_id,pa.choice,pa.points,pa.category_id,pa.action,DATE_FORMAT(pa.created_date, '%D %M %Y') AS created_date,pc.name as category" );
                $this -> db -> from( "poll_action pa" );
                $this -> db -> join( "poll_category pc", "pc.id = pa.category_id", "INNER" );
                $this -> db -> where( "pa.user_id = $id" );
                $this -> db -> limit( 10 );
                $this -> db -> offset( $offset );
                return $user_detail = $this -> db -> get() -> result_array();

        }

        function get_users_total_history( $id ) {
                $this -> db -> select( "count(1) as total_history" );
                $this -> db -> from( "poll_action pa" );
                $this -> db -> join( "poll_category pc", "pc.id = pa.category_id", "INNER" );
                $this -> db -> where( "pa.user_id = $id" );
                return $user_detail = $this -> db -> get() -> row_array();

        }

        function get_users_prediction_count( $id ) {
                $this -> db -> select( "count(1) as total_prediction" );
                $this -> db -> from( "poll p" );
                $this -> db -> where( "p.user_id = $id" );
                return $user_detail = $this -> db -> get() -> row_array();

        }

}
