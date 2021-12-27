<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ApiPredictions extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this -> load -> model( "Predictions_Mod" );
    }

    function special_character( $string ) {
        $string = str_replace( "'", "&#039;", $string );
        $string = str_replace( '"', '&#039;', $string );
        return $string;
    }

    /* List of predictions */

    public function lists() {
        $inputs = $this -> input -> post();
        $offset = $inputs[ 'offset' ];
        if ( ! $offset ) {
            $offset = 0;
        }
        $data = $this -> Predictions_Mod -> get_prediction_list( $inputs );

        $this -> apiresponse -> sendjson( $data );
    }

    /* Detail of predictions */

    public function detail() {
        $inputs = $this -> input -> post();
        $data = $this -> Predictions_Mod -> get_prediction_detail( $inputs );
        $data[ 'data' ] = $data[ 'data' ][ 0 ];
        $this -> apiresponse -> sendjson( $data );
    }

    function create_update_prediction() {
        $inputs = $this -> input -> post();

        $predictionid = $inputs[ 'predictionid' ];
        $user_id = $inputs[ 'user_id' ];
        $title = $this -> special_character( $inputs[ 'title' ] );
        $description = $this -> special_character( $inputs[ 'description' ] );
        $topics = $inputs[ 'topics' ];
        $choices = $inputs[ 'choices' ];
        $emails = $inputs[ 'emails' ];
        $uploaded_filename = $inputs[ 'uploaded_filename' ];
        $end_date = date( "Y-m-d", strtotime( $inputs[ 'end_date' ] ) );
        $is_topic_change = $inputs[ 'is_topic_change' ];
        $is_choice_change = $inputs[ 'is_choice_change' ];

        if ( $predictionid == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide prediction id" ) );
        } else if ( $title == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please enter title" ) );
        } else if ( $description == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please enter description" ) );
        } else if ( count( $topics ) == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please enter topic" ) );
        } else if ( count( $choices ) == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please enter choices" ) );
        } else if ( $emails == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please enter choices" ) );
        } else if ( $uploaded_filename == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please upload image" ) );
        } else if ( $end_date == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please enter end date" ) );
        } else if ( ! in_array( $is_choice_change, array ( 0, 1 ) ) ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "is topic modified?" ) );
        } else if ( ! in_array( $is_choice_change, array ( 0, 1 ) ) ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "is choice modified?" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $this -> Predictions_Mod -> add_update_prediction( $inputs );
            $message = ($predictionid == "0") ? "Private prediction created successfully" : "Private prediction update successfully";
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => $message, "data" => [] ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
        }
    }

    function vote_action() {
        $inputs = $this -> input -> post();

        $id = $inputs[ 'id' ];
        $choice = $inputs[ 'choice' ];
        $user_id = $inputs[ 'user_id' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide prediction id" ) );
        } else if ( $choice == "" || $choice == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide choice id" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $isvote = $this -> Predictions_Mod -> vote_action_mod( $inputs, $user_id );

            $vote = $this -> Predictions_Mod -> get_prediction_detail( $inputs );
            $vote[ "data" ] = $vote[ "data" ][ 0 ];
            if ( $isvote == 0 ) {
                $vote[ 'isnew' ] = 1;
                $this -> apiresponse -> sendjson( $vote );
            } else {
                $vote[ 'isnew' ] = 0;
                $this -> apiresponse -> sendjson( $vote );
            }
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
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide prediction id" ) );
        } else if ( $comment == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $last_commnet_id = $this -> Predictions_Mod -> add_comment_mod( $inputs );
            $comment_data = $this -> Predictions_Mod -> get_comment_by_id( $last_commnet_id );
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
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide prediction id" ) );
        } else if ( $comment_id == "" || $comment_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $comment == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $last_commnet_id = $this -> Predictions_Mod -> add_comment_mod( $inputs );
            $comment_data = $this -> Predictions_Mod -> get_comment_by_id( $last_commnet_id );
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
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide prediction id" ) );
        } else {
            $result = $this -> Predictions_Mod -> get_more_comments( $inputs );
            $this -> apiresponse -> sendjson( $result );
        }
    }

    function delete_comment() {
        $inputs = $this -> input -> post();
        $id = $inputs[ 'id' ]; //this is poll_id 
        $comment_id = $inputs[ 'comment_id' ];
        $user_id = $inputs[ 'user_id' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide prediction id" ) );
        } else if ( $comment_id == "" || $comment_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $data = $this -> Predictions_Mod -> delete_comment_mod( $user_id, $id, $comment_id );
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
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide prediction id" ) );
        } else if ( $comment_id == "" || $comment_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $comment_reply == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $last_commnet_reply_id = $this -> Predictions_Mod -> add_comment_reply_mod( $inputs );
            $reply_data = $this -> Predictions_Mod -> get_comment_reply_by_id( $last_commnet_reply_id );
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
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide prediction id" ) );
        } else if ( $comment_id == "" || $comment_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $comment_reply_id == "" || $comment_reply_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment reply id" ) );
        } else if ( $comment_reply == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $last_commnet_reply_id = $this -> Predictions_Mod -> add_comment_reply_mod( $inputs );
            $reply_data = $this -> Predictions_Mod -> get_comment_reply_by_id( $last_commnet_reply_id );
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Reply updated successfully!", "data" => $reply_data ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
        }
    }

    /* Delete reply */

    function delete_comment_reply() {
        $inputs = $this -> input -> post();

        $id = $inputs[ 'id' ]; //this is poll_id 
        $comment_id = $inputs[ 'comment_id' ];
        $comment_reply_id = $inputs[ 'comment_reply_id' ];
        $user_id = $inputs[ 'user_id' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide prediction id" ) );
        } else if ( $comment_id == "" || $comment_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $comment_reply_id == "" || $comment_reply_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment reply id" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $data = $this -> Predictions_Mod -> delete_comment_reply_mod( $inputs );
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
            $response = $this -> Predictions_Mod -> get_comment_replies_mod( $inputs );
            $this -> apiresponse -> sendjson( $response );
        }
    }

    function experts_result() {
        $inputs = $this -> input -> post();
        $result = $this -> Predictions_Mod -> get_experts_result( $inputs );
        $this -> apiresponse -> sendjson( $result );
    }

}
