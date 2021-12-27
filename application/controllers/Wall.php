<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Wall extends CI_Controller {

    private $user_id = 0;
    private $user_alias = "";
    private $silver_points = 0;

    function __construct() {
        parent::__construct();
        $this -> load -> model( "Wall_Mod" );

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

    function index( $id = 0 ) {
        $data = array ();
        $header_data[ 'page_title' ] = "";
        $header_data[ 'page_meta_description' ] = "";
        $header_data[ 'page_meta_keywords' ] = "";
        $header_data[ 'page_img' ] = base_url( "images/logo/preview.jpg" );

        $header_data[ 'uid' ] = $this -> user_id;
        $header_data[ 'silver_points' ] = $this -> silver_points;

        /* inputs */
        $inputs[ 'user_id' ] = $this -> user_id;
        $inputs[ 'id' ] = $id;


        $data = $this -> Wall_Mod -> get_wall_detail( $inputs );

        $this -> load -> view( 'bootstrap_header', $header_data );
        $this -> load -> view( 'wall_list', $data );
        $this -> load -> view( 'bootstrap_footer' );
    }

    function lists() {
        $inputs = $this -> input -> post();
        $data = $this -> Wall_Mod -> get_trending_discussions( $inputs, 10 );

        echo json_encode( $data );
    }

    function detail( $id ) {
        $data = array ();

        $header_data[ 'uid' ] = $this -> user_id;
        $header_data[ 'silver_points' ] = $this -> silver_points;

        /* inputs */
        $inputs[ 'user_id' ] = $this -> user_id;
        $inputs[ 'id' ] = $id;

        $data[ 'data' ] = $this -> Wall_Mod -> get_wall_detail( $inputs );

        $header_data[ 'page_title' ] = $data[ 'data' ][ 0 ][ 'title' ];
        $header_data[ 'page_meta_description' ] = "";
        $header_data[ 'page_meta_keywords' ] = "";
        $header_data[ 'page_img' ] = $data[ 'data' ][ 0 ][ 'image' ];

        $this -> load -> view( 'bootstrap_header', $header_data );
        $this -> load -> view( 'wall', $data );
        $this -> load -> view( 'bootstrap_footer' );
    }

    function raise_wall( $id = 0 ) {
        $sessiondata = $this -> session -> userdata( 'data' );

        if ( ! empty( $sessiondata ) ) {
            $data = array ();
            $header_data[ 'page_title' ] = "Raise Wall";
            $header_data[ 'page_img' ] = base_url( "images/logo/prediction_share_logo.png" );
            $header_data[ 'uid' ] = $this -> user_id;
            $header_data[ 'silver_points' ] = $this -> silver_points;
            $header_data[ 'alias' ] = $this -> user_alias;
            $header_data[ 'page_meta_keywords' ] = "";
            $header_data[ 'page_meta_description' ] = "";

            if ( $id != "0" ) {
                $inputs[ 'id' ] = $id;
                $inputs[ 'user_id' ] = $this -> user_id;
                $data[ 'data' ] = $this -> Wall_Mod -> get_wall_detail( $inputs );
            }

            $this -> load -> view( 'bootstrap_header', $header_data );
            $this -> load -> view( 'raise_wall', $data );
            $this -> load -> view( 'bootstrap_footer' );
        } else {
            redirect( "Index" );
        }
    }

    function create_update_wall() {
        $this -> form_validation -> set_rules( 'title', 'Title', 'trim|required' );
        $this -> form_validation -> set_rules( 'uploaded_filename', 'Upload Image', 'trim|required' );

        if ( $this -> form_validation -> run() === FALSE ) {
            $errors = array (
                "title" => form_error( 'title' ),
                "uploaded_filename" => form_error( 'uploaded_filename' )
            );
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "error", "data" => $errors ) );
        } else {
            $inputs = $this -> input -> post();
            $id = $inputs[ 'wallid' ];
            $inputs[ 'user_id' ] = $this -> user_id;

            $this -> Wall_Mod -> add_update_wall( $inputs );
            $message = ($id == "0") ? "Discussion topic created successfully" : "Discussion topic updated successfully";

            $this -> apiresponse -> sendjson( array ( "status" => true, "message" => $message, "data" => [] ) );
        }
    }

    function add_comment() {
        $user_id = $this -> user_id;
        if ( $user_id > 0 ) {
            $inputs = $this -> input -> post();
            $wallid = $inputs[ 'id' ];
            $wall_comment = $inputs[ 'comment' ];
            $inputs[ 'user_id' ] = $user_id;
            $inputs[ 'comment_id' ] = 0;

            if ( ! empty( $user_id ) && ! empty( $wallid ) && ! empty( $wall_comment ) ) {
                $id = $this -> Wall_Mod -> add_comment_mod( $inputs );
                $comment_data = $this -> Wall_Mod -> get_comment_by_id( $id );
                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Comment added successfully!", "data" => $comment_data ) );
            } else {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
            }
        } else {
            redirect( ' Login?section=wall' );
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
                $id = $this -> Wall_Mod -> add_comment_mod( $inputs );
                $comment_data = $this -> Wall_Mod -> get_comment_by_id( $id );
                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Comment added successfully!", "data" => $comment_data ) );
            } else {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
            }
        } else {
            redirect( ' Login?section=wall' );
        }
    }

    function add_comment_reply() {

        $user_id = $this -> user_id;
        if ( $user_id > 0 ) {
            $inputs = $this -> input -> post();
            $wallid = $inputs[ 'id' ];
            $comment_id = $inputs[ 'comment_id' ];
            $wall_comment_reply = $inputs[ 'comment_reply' ];
            $inputs[ 'user_id' ] = $user_id;
            $inputs[ 'comment_reply_id' ] = 0;

            if ( ! empty( $user_id ) && ! empty( $wallid ) && ! empty( $comment_id ) && ! empty( $wall_comment_reply ) ) {
                $id = $this -> Wall_Mod -> add_comment_reply_mod( $inputs );
                $reply_data = $this -> Wall_Mod -> get_comment_reply_by_id( $id );
                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Reply added successfully!", "data" => $reply_data ) );
            } else {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Write a reply" ) );
            }
        } else {
            redirect( ' Login?section=wall' );
        }
    }

    function update_comment_reply() {

        $user_id = $this -> user_id;
        if ( $user_id > 0 ) {
            $inputs = $this -> input -> post();
            $wallid = $inputs[ 'id' ];
            $comment_id = $inputs[ 'comment_id' ];
            $comment_reply_id = $inputs[ 'comment_reply_id' ];
            $wall_comment_reply = $inputs[ 'comment_reply' ];
            $inputs[ 'user_id' ] = $user_id;

            if ( ! empty( $user_id ) && ! empty( $wallid ) && ! empty( $comment_id ) && ! empty( $comment_reply_id ) && ! empty( $wall_comment_reply ) ) {
                $id = $this -> Wall_Mod -> add_comment_reply_mod( $inputs );
                $reply_data = $this -> Wall_Mod -> get_comment_reply_by_id( $id );
                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Reply added successfully!", "data" => $reply_data ) );
            } else {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Write a reply" ) );
            }
        } else {
            redirect( ' Login?section=wall' );
        }
    }

    /* Delete Comments */

    function delete_comment() {
        $inputs = $this -> input -> post();
        $id = $inputs[ 'id' ]; //this is wall_id 
        $comment_id = $inputs[ 'comment_id' ];

        $data = $this -> Wall_Mod -> delete_comment_mod( $this -> user_id, $id, $comment_id );
        $this -> apiresponse -> sendjson( $data );
    }

    /* Delete reply */

    function delete_comment_reply() {
        $inputs = $this -> input -> post();
        $inputs[ 'uid' ] = $this -> user_id;
        $id = $inputs[ 'id' ]; //this is wall_id 
        $comment_id = $inputs[ 'comment_id' ];
        $reply_id = $inputs[ 'comment_reply_id' ];

        $data = $this -> Wall_Mod -> delete_comment_reply_mod( $inputs );
        $this -> apiresponse -> sendjson( $data );
    }

    function get_comment_replies() {

        $inputs = $this -> input -> post();
        $inputs[ 'uid' ] = $this -> user_id;
        $id = $inputs[ 'id' ]; //this is wall_id 
        $comment_id = $inputs[ 'comment_id' ];
        $offset = $inputs[ 'offset' ];

        if ( ! empty( $comment_id ) && ! empty( $id ) ) {
            $response = $this -> Wall_Mod -> get_comment_replies_mod( $inputs );
            $this -> apiresponse -> sendjson( $response );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Something went wrong" ) );
        }
    }

    function view_more_comments() {
        $inputs = $this -> input -> post();
        $id = $inputs[ 'id' ];
        $offset = $inputs[ 'offset' ];

        $result = $this -> Wall_Mod -> get_more_comments( $inputs );
        $this -> apiresponse -> sendjson( $result );
    }

    function add_update_action() {
        $inputs = $this -> input -> post();
        $inputs[ 'user_id' ] = $this -> user_id;

        $result = $this -> Wall_Mod -> add_like_mod( $inputs );
        $this -> apiresponse -> sendjson( $result );
    }

    function deactive_wall() {
        $wallid = $this -> input -> post( 'id' );
        //var_dump($pollid);exit;
        if ( ! empty( $wallid ) ) {
            $this -> apiresponse -> sendjson( $this -> Wall_Mod -> make_deactive_wall( $wallid ) );
        } else {
            $response = json_encode( array ( "status" => FALSE, "message" => "Something went wrong" ) );
            $this -> apiresponse -> sendjson( $response );
        }
    }

}
