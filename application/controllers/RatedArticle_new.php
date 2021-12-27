<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RatedArticle extends CI_Controller {

        private $user_id = 0;
        private $user_alias = "";
        private $silver_points = 0;

        function __construct() {
                parent::__construct();
                $this -> load -> model( 'RatedArticle_Mod' );

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
                $header_data[ 'page_title' ] = "Rated Article";
                $header_data[ 'page_img' ] = base_url( "images/logo/prediction_share_logo.png" );
                $header_data[ 'uid' ] = $this -> user_id;
                $header_data[ 'silver_points' ] = $this -> silver_points;
                $header_data[ 'alias' ] = $this -> user_alias;
                $header_data[ 'page_meta_keywords' ] = "";
                $header_data[ 'page_meta_description' ] = "";

                $data = array ();

                $this -> load -> view( 'bootstrap_header', $header_data );
                $this -> load -> view( 'rated_article', $data );
                $this -> load -> view( 'bootstrap_footer' );
        }

        /* List of predictions for web and mobile view both */

        function lists() {
                $inputs = $this -> input -> post();
                $data = $this -> RatedArticle_Mod -> get_article_list( $inputs );

                $this -> apiresponse -> sendjson( $data );
        }

        /* Detail view of web view */

        function details( $id ) {
                $inputs[ 'id' ] = $id;
                $inputs[ 'user_id' ] = $this -> user_id;
                $this -> RatedArticle_Mod -> get_article_detail( $inputs );
                echo $id;
        }

        /* Detail view api of Mobile view */

        function detail() {
                $inputs = $this -> input -> post();
                $data = $this -> RatedArticle_Mod -> get_article_detail( $inputs );
                $this -> apiresponse -> sendjson( $data );
        }

        function answered_articles() {
                $sessiondata = $this -> session -> userdata( 'data' );
                $inputs = $this -> input -> post();
                if ( ! empty( $sessiondata ) ) {
                        $inputs[ 'user_id' ] = $this -> user_id;
                }

                $data = $this -> RatedArticle_Mod -> get_answered_articles( $inputs );
                $this -> apiresponse -> sendjson( $data );
        }

        function raise_article( $id = 0 ) {
                $sessiondata = $this -> session -> userdata( 'data' );

                if ( ! empty( $sessiondata ) ) {
                        $data = array ();
                        $header_data[ 'page_title' ] = "Raise Article";
                        $header_data[ 'page_img' ] = base_url( "images/logo/prediction_share_logo.png" );
                        $header_data[ 'uid' ] = $this -> user_id;
                        $header_data[ 'silver_points' ] = $this -> silver_points;
                        $header_data[ 'alias' ] = $this -> user_alias;
                        $header_data[ 'page_meta_keywords' ] = "";
                        $header_data[ 'page_meta_description' ] = "";

                        if ( $id != "0" ) {
                                $inputs[ 'id' ] = $id;
                                $inputs[ 'user_id' ] = $this -> user_id;
                                $data = $this -> RatedArticle_Mod -> get_article_detail( $inputs );
                        }

                        $this -> load -> view( 'bootstrap_header', $header_data );
                        $this -> load -> view( 'raise_article', $data );
                        $this -> load -> view( 'bootstrap_footer' );
                } else {
                        redirect( "RatedArticle" );
                }
        }

        function create_update_article() {
                $this -> form_validation -> set_rules( 'title', 'Title', 'trim|required' );
                $this -> form_validation -> set_rules( 'description', 'Description', 'trim|required' );
                $this -> form_validation -> set_rules( 'choices[]', 'Choice', 'trim|required' );
                //$this -> form_validation -> set_rules( 'uploaded_filename', 'Upload Image', 'trim|required' );

                if ( $this -> form_validation -> run() === FALSE ) {
                        $errors = array (
                            "title" => form_error( 'title' ),
                            "description" => form_error( 'description' ),
                            "choices" => form_error( 'choices' ),
                                //"uploaded_filename" => form_error( 'uploaded_filename' )
                        );
                        $this -> apiresponse -> sendjson( json_encode( array ( "status" => FALSE, "message" => "error", "data" => $errors ) ) );
                } else {
                        $inputs = $this -> input -> post();
                        $id = $inputs[ 'articleid' ];
                        $inputs[ 'user_id' ] = $this -> user_id;

                        $this -> RatedArticle_Mod -> add_update_article( $inputs );
                        $message = ($id == "0") ? "Question created successfully" : "Question updated successfully";

                        $this -> apiresponse -> sendjson( json_encode( array ( "status" => true, "message" => $message, "data" => [] ) ) );
                }
        }

        function generate_preview() {
                $url = $this -> input -> post( 'url' );
                $data = getmetatags( $url );

                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "data" => $data ) );
        }

}
