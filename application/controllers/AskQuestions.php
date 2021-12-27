<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AskQuestions extends CI_Controller {

    private $user_id = 0;
    private $user_alias = "";
    private $silver_points = 0;

    function __construct() {
        parent::__construct();
        $this -> load -> model( "AskQuestions_Mod" );

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
        $header_data[ 'page_title' ] = "Ask Questions";
        $header_data[ 'page_img' ] = base_url( "images/logo/prediction_share_logo.png" );
        $header_data[ 'uid' ] = $this -> user_id;
        $header_data[ 'silver_points' ] = $this -> silver_points;
        $header_data[ 'alias' ] = $this -> user_alias;
        $header_data[ 'page_meta_keywords' ] = "";
        $header_data[ 'page_meta_description' ] = "";

        $data = array ();

        $this -> load -> view( 'bootstrap_header', $header_data );
        $this -> load -> view( 'ask_questions', $data );
        $this -> load -> view( 'bootstrap_footer' );
    }

    /* List of predictions for web and mobile view both */

    function lists() {
        $inputs = $this -> input -> post();
        $data = $this -> AskQuestions_Mod -> get_questions_list( $inputs );

        echo json_encode( $data );
    }

    /* Detail view of web view */

    function details( $id ) {
        $data = array ();

        $header_data[ 'uid' ] = $this -> user_id;
        $header_data[ 'silver_points' ] = $this -> silver_points;
        $header_data[ 'alias' ] = $this -> user_alias;

        $inputs[ 'id' ] = $id;
        $inputs[ 'user_id' ] = $this -> user_id;
        $data = $this -> AskQuestions_Mod -> get_question_detail( $inputs );

        $header_data[ 'page_title' ] = $data[ 'data' ][ 0 ][ 'title' ];
        $header_data[ 'page_meta_keywords' ] = $data[ 'data' ][ 0 ][ 'meta_keywords' ];
        $header_data[ 'page_meta_description' ] = $data[ 'data' ][ 0 ][ 'meta_description' ];
        if ( $data[ 'data' ][ 0 ][ 'image' ] == "" ) {
            $header_data[ 'page_img' ] = base_url( "images/logo/prediction_share_logo.png" ) . "?t=" . time();
        } else {
            $header_data[ 'page_img' ] = $data[ 'data' ][ 0 ][ 'image' ] . "?t=" . time();
        }

        $header_data[ 'id' ] = $id;
        unset( $data[ 'extra_param' ] );
        unset( $data[ 'is_available' ] );

        $this -> load -> view( 'bootstrap_header', $header_data );
        $this -> load -> view( 'askquestion_detail', $data );
        $this -> load -> view( 'bootstrap_footer' );
    }

    /* Detail view api of Mobile view */

    function detail() {
        $inputs = $this -> input -> post();
        $data = $this -> AskQuestions_Mod -> get_question_detail( $inputs );
        $this -> apiresponse -> sendjson( $data );
    }

    function answered_questions() {
        $sessiondata = $this -> session -> userdata( 'data' );
        $inputs = $this -> input -> post();
        if ( ! empty( $sessiondata ) ) {
            $inputs[ 'user_id' ] = $this -> user_id;
        }

        $data = $this -> AskQuestions_Mod -> get_answered_questions( $inputs );
        echo json_encode( $data );
    }

    function raise_question( $id = 0 ) {
        $sessiondata = $this -> session -> userdata( 'data' );

        if ( ! empty( $sessiondata ) ) {
            $data = array ();
            $header_data[ 'page_title' ] = "Raise Question";
            $header_data[ 'page_img' ] = base_url( "images/logo/prediction_share_logo.png" );
            $header_data[ 'uid' ] = $this -> user_id;
            $header_data[ 'silver_points' ] = $this -> silver_points;
            $header_data[ 'alias' ] = $this -> user_alias;
            $header_data[ 'page_meta_keywords' ] = "";
            $header_data[ 'page_meta_description' ] = "";

            if ( $id != "0" ) {
                $inputs[ 'id' ] = $id;
                $inputs[ 'user_id' ] = $this -> user_id;
                $data = $this -> AskQuestions_Mod -> get_question_detail( $inputs );
            }

            $this -> load -> view( 'bootstrap_header', $header_data );
            $this -> load -> view( 'raise_question', $data );
            $this -> load -> view( 'bootstrap_footer' );
        } else {
            redirect( "AskQuestions" );
        }
    }

    function create_update_question() {
        $this -> form_validation -> set_rules( 'title', 'Title', 'trim|required' );
        $this -> form_validation -> set_rules( 'description', 'Description', 'trim|required' );
        $this -> form_validation -> set_rules( 'choices[]', 'Choice', 'trim|required' );
        $this -> form_validation -> set_rules( 'uploaded_filename', 'Upload Image', 'trim|required' );

        if ( $this -> form_validation -> run() === FALSE ) {
            $errors = array (
                "title" => form_error( 'title' ),
                "description" => form_error( 'description' ),
                "choices" => form_error( 'choices' ),
                "uploaded_filename" => form_error( 'uploaded_filename' )
            );
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "error", "data" => $errors ) );
        } else {
            $inputs = $this -> input -> post();
            $id = $inputs[ 'questionid' ];
            $inputs[ 'user_id' ] = $this -> user_id;

            $this -> AskQuestions_Mod -> add_update_question( $inputs );
            $message = ($id == "0") ? "Question created successfully" : "Question updated successfully";

            $this -> apiresponse -> sendjson( array ( "status" => true, "message" => $message, "data" => [] ) );
        }
    }

    function vote_action() {
        $input = $this -> input -> post();

        $sessiondata = $this -> session -> userdata( 'data' );
        if ( ! empty( $sessiondata ) ) {
            $user_id = $sessiondata[ 'uid' ];
            $isvote = $this -> AskQuestions_Mod -> vote_action_mod( $input, $user_id );
            $id = $input[ 'id' ];

            $inputs[ 'id' ] = $id;
            $inputs[ 'user_id' ] = $user_id;

            $vote = $this -> AskQuestions_Mod -> get_question_detail( $inputs );
            $vote[ "data" ] = $vote[ "data" ][ 0 ];
            if ( $isvote == 0 ) {
                $vote[ 'isnew' ] = 1;
                $this -> apiresponse -> sendjson( $vote );
            } else {
                $vote[ 'isnew' ] = 0;
                $this -> apiresponse -> sendjson( $vote );
            }
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "", "redirect_url" => "Login" ) );
        }
    }

    function add_comment() {
        $user_id = $this -> user_id;
        if ( $user_id > 0 ) {
            $inputs = $this -> input -> post();
            $questionid = $inputs[ 'id' ];
            $comment = $inputs[ 'comment' ];
            $inputs[ 'user_id' ] = $user_id;
            $inputs[ 'comment_id' ] = 0;

            if ( ! empty( $user_id ) && ! empty( $questionid ) && ! empty( $comment ) ) {
                $id = $this -> AskQuestions_Mod -> add_comment_mod( $inputs );
                $comment_data = $this -> AskQuestions_Mod -> get_comment_by_id( $id );
                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Comment added successfully!", "data" => $comment_data ) );
            } else {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
            }
        } else {
            redirect( ' Login?section=question' );
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
                $id = $this -> AskQuestions_Mod -> add_comment_mod( $inputs );
                $comment_data = $this -> AskQuestions_Mod -> get_comment_by_id( $id );
                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Comment added successfully!", "data" => $comment_data ) );
            } else {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
            }
        } else {
            redirect( ' Login?section=poll' );
        }
    }

    /* Delete Comments */

    function delete_comment() {
        $inputs = $this -> input -> post();
        $id = $inputs[ 'id' ]; //this is poll_id 
        $comment_id = $inputs[ 'comment_id' ];

        $data = $this -> AskQuestions_Mod -> delete_comment_mod( $this -> user_id, $id, $comment_id );
        $this -> apiresponse -> sendjson( $data );
    }

    function view_more_comments() {
        $inputs = $this -> input -> post();
        $id = $inputs[ 'id' ];
        $offset = $inputs[ 'offset' ];

        $result = $this -> AskQuestions_Mod -> get_more_comments( $inputs );
        $this -> apiresponse -> sendjson( $result );
    }

    function get_comment_replies() {

        $inputs = $this -> input -> post();
        $inputs[ 'uid' ] = $this -> user_id;
        $id = $inputs[ 'id' ]; //this is poll_id 
        $comment_id = $inputs[ 'comment_id' ];
        $offset = $inputs[ 'offset' ];

        if ( ! empty( $comment_id ) && ! empty( $id ) ) {
            $response = $this -> AskQuestions_Mod -> get_comment_replies_mod( $inputs );
            $this -> apiresponse -> sendjson( $response );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Something went wrong" ) );
        }
    }

    function add_comment_reply() {

        $user_id = $this -> user_id;
        if ( $user_id > 0 ) {
            $inputs = $this -> input -> post();
            $pollid = $inputs[ 'id' ];
            $comment_id = $inputs[ 'comment_id' ];
            $poll_comment_reply = $inputs[ 'comment_reply' ];
            $inputs[ 'user_id' ] = $user_id;
            $inputs[ 'comment_reply_id' ] = 0;

            if ( ! empty( $user_id ) && ! empty( $pollid ) && ! empty( $comment_id ) && ! empty( $poll_comment_reply ) ) {
                $id = $this -> AskQuestions_Mod -> add_comment_reply_mod( $inputs );
                $reply_data = $this -> AskQuestions_Mod -> get_comment_reply_by_id( $id );
                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Reply added successfully!", "data" => $reply_data ) );
            } else {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Write a reply" ) );
            }
        } else {
            redirect( ' Login?section=poll' );
        }
    }

    function update_comment_reply() {

        $user_id = $this -> user_id;
        if ( $user_id > 0 ) {
            $inputs = $this -> input -> post();
            $pollid = $inputs[ 'id' ];
            $comment_id = $inputs[ 'comment_id' ];
            $comment_reply_id = $inputs[ 'comment_reply_id' ];
            $poll_comment_reply = $inputs[ 'comment_reply' ];
            $inputs[ 'user_id' ] = $user_id;

            if ( ! empty( $user_id ) && ! empty( $pollid ) && ! empty( $comment_id ) && ! empty( $comment_reply_id ) && ! empty( $poll_comment_reply ) ) {
                $id = $this -> AskQuestions_Mod -> add_comment_reply_mod( $inputs );
                $reply_data = $this -> AskQuestions_Mod -> get_comment_reply_by_id( $id );
                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Reply added successfully!", "data" => $reply_data ) );
            } else {
                $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Write a reply" ) );
            }
        } else {
            redirect( ' Login?section=poll' );
        }
    }

    /* Delete reply */

    function delete_comment_reply() {
        $inputs = $this -> input -> post();
        $inputs[ 'uid' ] = $this -> user_id;
        $id = $inputs[ 'id' ]; //this is poll_id 
        $comment_id = $inputs[ 'comment_id' ];
        $reply_id = $inputs[ 'comment_reply_id' ];

        $data = $this -> AskQuestions_Mod -> delete_comment_reply_mod( $inputs );
        $this -> apiresponse -> sendjson( $data );
    }

}
