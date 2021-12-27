<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FromTheWeb extends CI_Controller {

    private $user_id = 0;
    private $user_alias = "";
    private $silver_points = 0;

    function __construct() {
        parent::__construct();
        $this -> load -> model( "FromTheWeb_Mod" );

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
        redirect( "Index" );
    }

    function detail( $id = 0 ) {
        $data = array ();
        $header_data[ 'page_title' ] = "";
        $header_data[ 'page_meta_description' ] = "";
        $header_data[ 'page_meta_keywords' ] = "";
        $header_data[ 'page_img' ] = base_url( "images/logo/preview.jpg" );

        $header_data[ 'uid' ] = $this -> user_id;
        $header_data[ 'silver_points' ] = $this -> silver_points;

        $inputs[ 'user_id' ] = $this -> user_id;
        $inputs[ 'id' ] = $id;

        $data[ 'data' ] = $this -> FromTheWeb_Mod -> get_web_detail( $inputs );

        $preview_data = json_decode( $data[ 'data' ][ 0 ][ 'data' ], TRUE );
//                if ( $data[ 'data' ][ 0 ][ 'image' ] == "" ) {
//                        $data[ 'data' ][ 0 ][ 'image' ] = $preview_data[ 'img' ];
//                }
        $header_data[ 'page_title' ] = $data[ 'data' ][ 0 ][ 'title' ];
        $header_data[ 'page_meta_description' ] = $data[ 'data' ][ 0 ][ 'meta_keywords' ];
        $header_data[ 'page_meta_keywords' ] = $data[ 'data' ][ 0 ][ 'meta_description' ];
        $header_data[ 'page_img' ] = $preview_data[ 'img' ] . "?t=" . time(); //base_url( "images/logo/preview.jpg" );

        $this -> load -> view( 'bootstrap_header', $header_data );
        $this -> load -> view( 'fromtheweb', $data );
        $this -> load -> view( 'bootstrap_footer' );
    }

    function post_article( $id = 0 ) {
        $sessiondata = $this -> session -> userdata( 'data' );

        if ( ! empty( $sessiondata ) ) {
            $data = array ();
            $header_data[ 'page_title' ] = "Post Article";
            $header_data[ 'page_img' ] = base_url( "images/logo/prediction_share_logo.png" );
            $header_data[ 'uid' ] = $this -> user_id;
            $header_data[ 'silver_points' ] = $this -> silver_points;
            $header_data[ 'alias' ] = $this -> user_alias;
            $header_data[ 'page_meta_keywords' ] = "";
            $header_data[ 'page_meta_description' ] = "";

            if ( $id != "0" ) {
                $inputs[ 'id' ] = $id;
                $inputs[ 'user_id' ] = $this -> user_id;
                $data[ 'data' ] = $this -> FromTheWeb_Mod -> get_web_detail( $inputs );
            }

            $this -> load -> view( 'bootstrap_header', $header_data );
            $this -> load -> view( 'post_article', $data );
            $this -> load -> view( 'bootstrap_footer' );
        } else {
            redirect( "Login?section=web&type=post" );
        }
    }

    function create_update_article() {
        $this -> form_validation -> set_rules( 'title', 'Title', 'trim|required' );
        $this -> form_validation -> set_rules( 'description', 'Description', 'trim|required' );
        //$this -> form_validation -> set_rules( 'uploaded_filename', 'Upload Image', 'trim|required' );

        if ( $this -> form_validation -> run() === FALSE ) {
            $errors = array (
                "title" => form_error( 'title' ),
                "description" => form_error( 'description' ),
                    //"uploaded_filename" => form_error( 'uploaded_filename' )
            );
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "error", "data" => $errors ) );
        } else {
            $inputs = $this -> input -> post();
            $id = $inputs[ 'webid' ];
            $inputs[ 'user_id' ] = $this -> user_id;

            $this -> FromTheWeb_Mod -> add_update_article( $inputs );
            $message = ($id == "0") ? "Article created successfully" : "Article updated successfully";

            $this -> apiresponse -> sendjson( array ( "status" => true, "message" => $message, "data" => [] ) );
        }
    }

    function deactive_web() {
        $web_id = $this -> input -> post( 'id' );
        //var_dump($pollid);exit;
        if ( ! empty( $web_id ) ) {
            $this -> apiresponse -> sendjson( $this -> FromTheWeb_Mod -> deactive_web( $web_id ) );
        } else {
            $response = json_encode( array ( "status" => FALSE, "message" => "Something went wrong" ) );
            $this -> apiresponse -> sendjson( $response );
        }
    }

    function add_update_action() {
        $inputs = $this -> input -> post();
        $inputs[ 'user_id' ] = $this -> user_id;

        $result = $this -> FromTheWeb_Mod -> add_like_mod( $inputs );
        $this -> apiresponse -> sendjson( $result );
    }

    function add_comment() {
        $user_id = $this -> user_id;
        if ( $user_id > 0 ) {
            $inputs = $this -> input -> post();
            $web_id = $inputs[ 'id' ];
            $web_comment = $inputs[ 'comment' ];
            $inputs[ 'user_id' ] = $user_id;
            $inputs[ 'comment_id' ] = 0;

            if ( ! empty( $user_id ) && ! empty( $web_id ) && ! empty( $web_comment ) ) {
                $id = $this -> FromTheWeb_Mod -> add_comment_mod( $inputs );
                $comment_data = $this -> FromTheWeb_Mod -> get_comment_by_id( $id );
                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Comment added successfully!", "data" => $comment_data ) );
            } else {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
            }
        } else {
            redirect( ' Login?section=web' );
        }
    }

    function update_comment() {
        $user_id = $this -> user_id;
        if ( $user_id > 0 ) {
            $inputs = $this -> input -> post();
            $id = $inputs[ 'id' ];
            $comment_id = $inputs[ 'comment_id' ];
            $comment = $inputs[ 'comment' ];
            $inputs[ 'user_id' ] = $user_id;

            if ( ! empty( $user_id ) && ! empty( $id ) && ! empty( $comment_id ) && ! empty( $comment ) ) {
                $id = $this -> FromTheWeb_Mod -> add_comment_mod( $inputs );
                $comment_data = $this -> FromTheWeb_Mod -> get_comment_by_id( $id );
                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Comment added successfully!", "data" => $comment_data ) );
            } else {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
            }
        } else {
            redirect( ' Login?section=web' );
        }
    }

    /* Delete Comments */

    function delete_comment() {
        $inputs = $this -> input -> post();
        $id = $inputs[ 'id' ]; //this is wall_id 
        $comment_id = $inputs[ 'comment_id' ];

        $data = $this -> FromTheWeb_Mod -> delete_comment_mod( $this -> user_id, $id, $comment_id );
        $this -> apiresponse -> sendjson( $data );
    }

    function get_comment_replies() {

        $inputs = $this -> input -> post();
        $inputs[ 'uid' ] = $this -> user_id;
        $id = $inputs[ 'id' ]; //this is wall_id 
        $comment_id = $inputs[ 'comment_id' ];
        $offset = $inputs[ 'offset' ];

        if ( ! empty( $comment_id ) && ! empty( $id ) ) {
            $response = $this -> FromTheWeb_Mod -> get_comment_replies_mod( $inputs );
            $this -> apiresponse -> sendjson( $response );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Something went wrong" ) );
        }
    }

    function add_comment_reply() {

        $user_id = $this -> user_id;
        if ( $user_id > 0 ) {
            $inputs = $this -> input -> post();
            $web_id = $inputs[ 'id' ];
            $comment_id = $inputs[ 'comment_id' ];
            $web_comment_reply = $inputs[ 'comment_reply' ];
            $inputs[ 'user_id' ] = $user_id;
            $inputs[ 'comment_reply_id' ] = 0;

            if ( ! empty( $user_id ) && ! empty( $web_id ) && ! empty( $comment_id ) && ! empty( $web_comment_reply ) ) {
                $id = $this -> FromTheWeb_Mod -> add_comment_reply_mod( $inputs );
                $reply_data = $this -> FromTheWeb_Mod -> get_comment_reply_by_id( $id );
                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Reply added successfully!", "data" => $reply_data ) );
            } else {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Write a reply" ) );
            }
        } else {
            redirect( ' Login?section=web' );
        }
    }

    function update_comment_reply() {

        $user_id = $this -> user_id;
        if ( $user_id > 0 ) {
            $inputs = $this -> input -> post();
            $web_id = $inputs[ 'id' ];
            $comment_id = $inputs[ 'comment_id' ];
            $comment_reply_id = $inputs[ 'comment_reply_id' ];
            $web_comment_reply = $inputs[ 'comment_reply' ];
            $inputs[ 'user_id' ] = $user_id;

            if ( ! empty( $user_id ) && ! empty( $web_id ) && ! empty( $comment_id ) && ! empty( $comment_reply_id ) && ! empty( $web_comment_reply ) ) {
                $id = $this -> FromTheWeb_Mod -> add_comment_reply_mod( $inputs );
                $reply_data = $this -> FromTheWeb_Mod -> get_comment_reply_by_id( $id );
                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Reply added successfully!", "data" => $reply_data ) );
            } else {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Write a reply" ) );
            }
        } else {
            redirect( ' Login?section=web' );
        }
    }

}
