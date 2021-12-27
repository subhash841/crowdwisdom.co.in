<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ApiFromTheWeb extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this -> load -> model( "ApiFromTheWeb_Mod" );
    }

    function lists() {
        $inputs = $this -> input -> post();
        $user_id = $inputs[ 'user_id' ];

        if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else { //if ( $user_id > 0 )
            $trending_rated_articles_data = $this -> ApiFromTheWeb_Mod -> get_trending_article_list( $inputs );
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "No data found", "data" => $trending_rated_articles_data ) );
        }
//        else {
//            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
//        }
    }

    function detail() {
        $inputs = $this -> input -> post();

        $id = $inputs[ 'id' ];
        $user_id = $inputs[ 'user_id' ];

        if ( $id == "" || $id == "0" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide article id" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else { //if ( $user_id > 0 )
            $data = $this -> ApiFromTheWeb_Mod -> get_web_detail( $inputs );
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "No data found", "data" => $data ) );
        }
//        else {
//            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
//        }
    }

    function create_update_article() {
        $this -> form_validation -> set_rules( 'title', 'Title', 'trim|required' );
        $this -> form_validation -> set_rules( 'description', 'Description', 'trim|required' );
        //$this -> form_validation -> set_rules( 'uploaded_filename', 'Upload Image', 'trim|required' );

        if ( $this -> form_validation -> run() === FALSE ) {
            if ( form_error( 'title' ) != "" ) {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide title", "data" => ( object ) array () ) );
            } else if ( form_error( 'description' ) != "" ) {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide description", "data" => ( object ) array () ) );
            }
        } else {
            $inputs = $this -> input -> post();
            $id = $inputs[ 'id' ];
            $user_id = $inputs[ 'user_id' ];
            if ( $user_id == "" ) {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
            } else if ( $user_id > 0 ) {
                $this -> ApiFromTheWeb_Mod -> add_update_article( $inputs );
                $message = ($id == "0") ? "Article created successfully" : "Article updated successfully";
                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "$message", "data" => ( object ) array () ) );
            } else {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in", "data" => ( object ) array () ) );
            }
        }
    }

    function delete_article() {
        $inputs = $this -> input -> post();
        $web_id = $inputs[ 'id' ];

        if ( $web_id == "" || $web_id == "0" ) {
            $this -> apiresponse -> sendjson( $this -> ApiFromTheWeb_Mod -> delete_article_mod( $web_id ) );
        } else {
            $response = json_encode( array ( "status" => FALSE, "message" => "Something went wrong", "data" => ( object ) array () ) );
            $this -> apiresponse -> sendjson( $response );
        }
    }

    function add_update_action() {
        $inputs = $this -> input -> post();
        $id = $inputs[ 'id' ];
        $user_id = $inputs[ 'user_id' ];
        $action_type = $inputs[ 'type' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide web id", "data" => ( object ) array () ) );
        } else if ( ! in_array( $action_type, array ( "like", "dislike", "neutral" ) ) ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide valid type", "data" => ( object ) array () ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id", "data" => ( object ) array () ) );
        } else if ( $user_id > 0 ) {
            $result = $this -> ApiFromTheWeb_Mod -> add_update_action_mod( $inputs );
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Action done successfully", "data" => ( object ) array () ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in", "data" => ( object ) array () ) );
        }
    }

    function add_comment() {
        $inputs = $this -> input -> post();

        $id = $inputs[ 'id' ];
        $comment_id = $inputs[ 'comment_id' ];
        $comment = $inputs[ 'comment' ];
        $user_id = $inputs[ 'user_id' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide article id" ) );
        } else if ( $comment == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id", "data" => ( object ) array () ) );
        } else if ( $user_id > 0 ) {
            $comt_id = $this -> ApiFromTheWeb_Mod -> add_comment_mod( $inputs );
            $comment_data = $this -> ApiFromTheWeb_Mod -> get_comment_by_id( $comt_id );
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Comment added successfully!", "data" => $comment_data ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in", "data" => ( object ) array () ) );
        }
    }

    function update_comment() {
        $inputs = $this -> input -> post();

        $id = $inputs[ 'id' ];
        $comment_id = $inputs[ 'comment_id' ];
        $comment = $inputs[ 'comment' ];
        $user_id = $inputs[ 'user_id' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide article id" ) );
        } else if ( $comment_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $comment == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id", "data" => ( object ) array () ) );
        } else if ( $user_id > 0 ) {
            $comt_id = $this -> ApiFromTheWeb_Mod -> add_comment_mod( $inputs );
            $comment_data = $this -> ApiFromTheWeb_Mod -> get_comment_by_id( $comt_id );
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Comment updated successfully!", "data" => $comment_data ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in", "data" => ( object ) array () ) );
        }
    }

    function view_more_comments() {
        $inputs = $this -> input -> post();
        $id = $inputs[ 'id' ];
        $offset = $inputs[ 'offset' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide discussion wall id" ) );
        } else {
            $result = $this -> ApiFromTheWeb_Mod -> get_more_comments( $inputs );
            $this -> apiresponse -> sendjson( $result );
        }
    }

    /* Delete Comments */

    function delete_comment() {
        $inputs = $this -> input -> post();
        $id = $inputs[ 'id' ]; //this is wall_id 
        $comment_id = $inputs[ 'comment_id' ];
        $user_id = $inputs[ 'user_id' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide article id" ) );
        } else if ( $comment_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id", "data" => ( object ) array () ) );
        } else if ( $user_id > 0 ) {
            $data = $this -> ApiFromTheWeb_Mod -> delete_comment_mod( $user_id, $id, $comment_id );
            $this -> apiresponse -> sendjson( $data );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in", "data" => ( object ) array () ) );
        }
    }

    function get_comment_replies() {

        $inputs = $this -> input -> post();
        $id = $inputs[ 'id' ]; //this is web_id 
        $user_id = $inputs[ 'user_id' ];
        $comment_id = $inputs[ 'comment_id' ];
        $offset = $inputs[ 'offset' ];


        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide article id" ) );
        } else if ( $comment_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id", "data" => ( object ) array () ) );
        } else if ( $user_id > 0 ) {
            $response = $this -> ApiFromTheWeb_Mod -> get_comment_replies_mod( $inputs );
            $this -> apiresponse -> sendjson( $response );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in", "data" => ( object ) array () ) );
        }
    }

    function add_comment_reply() {
        $inputs = $this -> input -> post();
        $id = $inputs[ 'id' ];
        $comment_id = $inputs[ 'comment_id' ];
        $comment_reply = $inputs[ 'comment_reply' ];
        $user_id = $inputs[ 'user_id' ];
        $comment_reply_id = $inputs[ 'comment_reply_id' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide article id" ) );
        } else if ( $comment_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $comment_reply == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id", "data" => ( object ) array () ) );
        } else if ( $user_id > 0 ) {
            $reply_id = $this -> ApiFromTheWeb_Mod -> add_comment_reply_mod( $inputs );
            $reply_data = $this -> ApiFromTheWeb_Mod -> get_comment_reply_by_id( $reply_id );
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Reply added successfully!", "data" => $reply_data ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in", "data" => ( object ) array () ) );
        }
    }

    function update_comment_reply() {

        $inputs = $this -> input -> post();
        $id = $inputs[ 'id' ];
        $comment_id = $inputs[ 'comment_id' ];
        $comment_reply = $inputs[ 'comment_reply' ];
        $user_id = $inputs[ 'user_id' ];
        $comment_reply_id = $inputs[ 'comment_reply_id' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide article id" ) );
        } else if ( $comment_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $comment_reply_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment reply id" ) );
        } else if ( $comment_reply == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id", "data" => ( object ) array () ) );
        } else if ( $user_id > 0 ) {
            $reply_id = $this -> ApiFromTheWeb_Mod -> add_comment_reply_mod( $inputs );
            $reply_data = $this -> ApiFromTheWeb_Mod -> get_comment_reply_by_id( $reply_id );
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Reply updated successfully!", "data" => $reply_data ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in", "data" => ( object ) array () ) );
        }
    }

    /* Delete reply */

    function delete_comment_reply() {
        $inputs = $this -> input -> post();

        $id = $inputs[ 'id' ]; //this is wall_id 
        $comment_id = $inputs[ 'comment_id' ];
        $comment_reply_id = $inputs[ 'comment_reply_id' ];
        $user_id = $inputs[ 'user_id' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide article id" ) );
        } else if ( $comment_id == "" || $comment_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $comment_reply_id == "" || $comment_reply_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment reply id" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $data = $this -> ApiFromTheWeb_Mod -> delete_comment_reply_mod( $inputs );
            $this -> apiresponse -> sendjson( $data );
        }
    }

}
