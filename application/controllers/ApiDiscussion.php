<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ApiDiscussion extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this -> load -> model( "Wall_Mod" );
        $this -> load -> model( "ApiDiscussion_Mod" );
    }

    /* List of Discussion */

    function lists() {
        $inputs = $this -> input -> post();

        $topic_id = $inputs[ 'topic_id' ];
        $user_id = $inputs[ 'user_id' ];
        $offset = $inputs[ 'offset' ];

        if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else { //if ( $user_id > 0 )
            $data = $this -> Wall_Mod -> get_trending_discussions( $inputs, 10 );
            $this -> apiresponse -> sendjson( $data );
        }
//                else {
//                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
//                }
    }

    /* Detail of predictions */

    public function detail() {
        $inputs = $this -> input -> post();
        $data = $this -> ApiDiscussion_Mod -> get_wall_detail( $inputs );

        $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "No Data found", "data" => $data ) );
    }

    function create_update_wall() {
        $inputs = $this -> input -> post();

        $wall_id = $inputs[ 'id' ];
        $user_id = $inputs[ 'user_id' ];
        $title = $inputs[ 'title' ];
        $topics = $inputs[ 'topics' ];
        $uploaded_filename = $inputs[ 'uploaded_filename' ];

        //$preview_json = $inputs[ 'json_data' ];
        $is_topic_change = $inputs[ 'is_topic_change' ];

        if ( $wall_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide discussion wall id" ) );
        } else if ( $title == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please enter title" ) );
        } else if ( count( $topics ) == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please enter topic" ) );
        } else if ( $uploaded_filename == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please upload image" ) );
        } else if ( ! in_array( $is_topic_change, array ( 0, 1 ) ) ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "is topic modified?" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $this -> ApiDiscussion_Mod -> add_update_wall( $inputs );
            $message = ($wall_id == "0") ? "Discussion wall created successfully" : "Discussion wall updated successfully";
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => $message, "data" => ( object ) array () ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in", "data" => ( object ) array () ) );
        }
    }

    function vote_action() {
        $inputs = $this -> input -> post();

        $id = $inputs[ 'id' ];
        $type = $inputs[ 'type' ];
        $user_id = $inputs[ 'user_id' ];

        if ( $id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide discussion wall id" ) );
        } else if ( $type == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide type" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $isvote = $this -> ApiDiscussion_Mod -> add_action_mod( $inputs );
            $msg = ( $id == 0 ) ? "Vote added sucessfully" : "Vote updated sucessfully";
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => $msg ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
        }
    }

    function add_comment() {
        $inputs = $this -> input -> post();

        $id = $inputs[ 'id' ];
        $comment_id = $inputs[ 'comment_id' ];
        $comment = $inputs[ 'comment' ];
        $user_id = $inputs[ 'user_id' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide discussion wall id" ) );
        } else if ( $comment == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $last_commnet_id = $this -> Wall_Mod -> add_comment_mod( $inputs );
            $comment_data = $this -> Wall_Mod -> get_comment_by_id( $last_commnet_id );
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Comment added successfully!", "data" => $comment_data ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
        }
    }

    function update_comment() {
        $inputs = $this -> input -> post();

        $id = $inputs[ 'id' ];
        $comment_id = $inputs[ 'comment_id' ];
        $comment = $inputs[ 'comment' ];
        $user_id = $inputs[ 'user_id' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide discussion wall id" ) );
        } else if ( $comment_id == "" || $comment_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $comment == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $last_commnet_id = $this -> Wall_Mod -> add_comment_mod( $inputs );
            $comment_data = $this -> Wall_Mod -> get_comment_by_id( $last_commnet_id );
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Comment updated successfully!", "data" => $comment_data ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
        }
    }

    function view_more_comments() {
        $inputs = $this -> input -> post();
        $id = $inputs[ 'id' ];
        $offset = $inputs[ 'offset' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide discussion wall id" ) );
        } else {
            $result = $this -> Wall_Mod -> get_more_comments( $inputs );
            $this -> apiresponse -> sendjson( $result );
        }
    }

    function delete_comment() {
        $inputs = $this -> input -> post();
        $id = $inputs[ 'id' ]; //this is poll_id 
        $comment_id = $inputs[ 'comment_id' ];
        $user_id = $inputs[ 'user_id' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide discussion wall id" ) );
        } else if ( $comment_id == "" || $comment_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $data = $this -> Wall_Mod -> delete_comment_mod( $user_id, $id, $comment_id );
            $this -> apiresponse -> sendjson( $data );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
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
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide discussion wall id" ) );
        } else if ( $comment_id == "" || $comment_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $comment_reply == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $last_commnet_reply_id = $this -> Wall_Mod -> add_comment_reply_mod( $inputs );
            $reply_data = $this -> Wall_Mod -> get_comment_reply_by_id( $last_commnet_reply_id );
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Reply added successfully!", "data" => $reply_data ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
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
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide discussion wall id" ) );
        } else if ( $comment_id == "" || $comment_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $comment_reply_id == "" || $comment_reply_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment reply id" ) );
        } else if ( $comment_reply == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $last_commnet_reply_id = $this -> Wall_Mod -> add_comment_reply_mod( $inputs );
            $reply_data = $this -> Wall_Mod -> get_comment_reply_by_id( $last_commnet_reply_id );
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Reply updated successfully!", "data" => $reply_data ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
        }
    }

    /* Delete reply */

    function delete_comment_reply() {
        $inputs = $this -> input -> post();

        $id = $inputs[ 'id' ]; //this is wall_id 
        $comment_id = $inputs[ 'comment_id' ];
        $comment_reply_id = $inputs[ 'comment_reply_id' ];
        $user_id = $inputs[ 'user_id' ];
        $inputs[ 'uid' ] = $user_id;

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide discussion wall id" ) );
        } else if ( $comment_id == "" || $comment_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $comment_reply_id == "" || $comment_reply_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment reply id" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $data = $this -> Wall_Mod -> delete_comment_reply_mod( $inputs );
            $this -> apiresponse -> sendjson( $data );
        }
    }

    function get_comment_replies() {

        $inputs = $this -> input -> post();
        $id = $inputs[ 'id' ]; //this is poll_id 
        $comment_id = $inputs[ 'comment_id' ];
        $offset = $inputs[ 'offset' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide prediction id" ) );
        } else if ( $comment_id == "" || $comment_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else {
            $response = $this -> Wall_Mod -> get_comment_replies_mod( $inputs );
            $this -> apiresponse -> sendjson( $response );
        }
    }

}
