<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ApiYourVoice extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this -> load -> model( "YourVoice_mod" );
        $this -> load -> model( "ApiYourVoice_Mod" );
    }

    function lists() {
        $inputs = $this -> input -> post();
        $offset = $inputs[ 'offset' ];
        $voicenotin = $inputs[ 'notin' ];
        $topic_id = $inputs[ 'topic_id' ] = 0;
        $user_id = $inputs[ 'user_id' ];

        if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        }
        if ( ! $offset ) {
            $inputs[ 'offset' ] = 0;
        }
        if ( ! $voicenotin ) {
            $inputs[ 'notin' ] = 0;
        }
        if ( ! $topic_id ) {
            $inputs[ 'topic_id' ] = 0;
        }
        $data = $this -> YourVoice_mod -> get_voices( $inputs, 8, 0, $user_id );
        $this -> apiresponse -> sendjson( $data );
        //$data = $this -> ApiYourVoice_Mod -> get_voices();
        //$this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "", "data" => $data ) );
    }

    public function detail() {
        $inputs = $this -> input -> post();
        $id = $inputs[ 'id' ];
        $user_id = $inputs[ 'user_id' ];

        $data = $this -> YourVoice_mod -> get_voices( 0, 7, $id, $user_id );

        $this -> db -> set( 'total_views', 'total_views+1', FALSE );
        $this -> db -> where( "id = '$id'" );
        $this -> db -> update( "blogs" );

        $data[ 'data' ] = $data[ 'data' ][ 0 ];
        $this -> apiresponse -> sendjson( $data );
    }

    function create_update_voice() {
        $inputs = $this -> input -> post();

        $id = $inputs[ 'voice_id' ];
        $title = $inputs[ 'title' ];
        $topics = $inputs[ 'topics' ];
        $description = $inputs[ 'description' ];
        $user_id = $inputs[ 'user_id' ];
        $uploaded_filename = $inputs[ 'uploaded_filename' ];
        $is_topic_change = $inputs[ 'is_topic_change' ];

        if ( $id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide voice id" ) );
        } else if ( $title == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide title" ) );
        } else if ( count( $topics ) == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please enter topic" ) );
        } else if ( $description == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide voice description" ) );
        } else if ( $uploaded_filename == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please upload image" ) );
        } else if ( ! in_array( $is_topic_change, array ( "0", "1" ) ) ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "topic change is not valid" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $this -> ApiYourVoice_Mod -> add_update_voice( $inputs );
            $voice_id = $inputs[ 'voice_id' ];

            $msg = ($voice_id == 0) ? "Thank you. Crowd wisdom will approve your voice soon" : "Thank you. Crowd wisdom will approve your voice soon";

            $points = $this -> get_users_points( $user_id );

            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => $msg, "data" => array (), "points" => $points ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in", "data" => array () ) );
        }
    }

    function add_comment() {
        $inputs = $this -> input -> post();

        $id = $inputs[ 'voice_id' ];
        $comment = $inputs[ 'comment' ];
        $user_id = $inputs[ 'user_id' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide voice id" ) );
        } else if ( $comment == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $data = $this -> YourVoice_mod -> do_comment( $inputs );
            $last_commnet_id = $data[ 'data' ][ 'comment_id' ];
            $comment_data = $this -> ApiYourVoice_Mod -> get_comment_by_id( $last_commnet_id );
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Comment added successfully!", "data" => $comment_data ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
        }
    }

    function update_comment() {

        $inputs = $this -> input -> post();
        $user_id = $inputs[ 'user_id' ];
        $id = $inputs[ 'voice_id' ];
        $comment_id = $inputs[ 'comment_id' ];
        $comment = $inputs[ 'comment' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide voice id" ) );
        } else if ( $comment_id == "" || $comment_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $comment == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $data = $this -> YourVoice_mod -> update_comment( $inputs );
            $comment_data = $this -> ApiYourVoice_Mod -> get_comment_by_id( $comment_id );
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Comment updated successfully!", "data" => $comment_data ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
        }
    }

    function view_more_comments() {
        $inputs = $this -> input -> post();
        $id = $inputs[ 'voice_id' ];
        $offset = $inputs[ 'offset' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide voice id" ) );
        } else {
            $result = $this -> YourVoice_mod -> get_more_comments( $inputs );
            $this -> apiresponse -> sendjson( $result );
        }
    }

    function delete_comment() {
        $inputs = $this -> input -> post();
        $user_id = $inputs[ 'user_id' ];
        $id = $inputs[ 'voice_id' ];
        $comment_id = $inputs[ 'comment_id' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide voice id" ) );
        } else if ( $comment_id == "" || $comment_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $data = $this -> YourVoice_mod -> delete_voice_comment( $user_id, $id, $comment_id );
            $this -> apiresponse -> sendjson( $data );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
        }
    }

    function add_comment_reply() {
        $inputs = $this -> input -> post();

        $id = $inputs[ 'voice_id' ];
        $comment_id = $inputs[ 'comment_id' ];
        $comment_reply = $inputs[ 'comment_reply' ];
        $user_id = $inputs[ 'user_id' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide prediction id" ) );
        } else if ( $comment_id == "" || $comment_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $comment_reply == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $last_commnet_reply_id = $data = $this -> YourVoice_mod -> do_reply_on_comment( $inputs );
            $reply_data = $this -> ApiYourVoice_Mod -> get_comment_reply_by_id( $last_commnet_reply_id[ 'data' ][ 'reply_id' ] );
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Reply added successfully!", "data" => $reply_data ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
        }
    }

    function update_comment_reply() {
        $inputs = $this -> input -> post();

        $id = $inputs[ 'voice_id' ];
        $comment_id = $inputs[ 'comment_id' ];
        $comment_reply = $inputs[ 'comment_reply' ];
        $user_id = $inputs[ 'user_id' ];
        $comment_reply_id = $inputs[ 'comment_reply_id' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide voice id" ) );
        } else if ( $comment_id == "" || $comment_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else if ( $comment_reply_id == "" || $comment_reply_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment reply id" ) );
        } else if ( $comment_reply == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $data = $this -> YourVoice_mod -> update_comment_reply( $inputs );
            $reply_data = $this -> ApiYourVoice_Mod -> get_comment_reply_by_id( $comment_reply_id );
            $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Reply updated successfully!", "data" => $reply_data ) );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
        }
    }

    /* Delete reply */

    function delete_comment_reply() {
        $inputs = $this -> input -> post();

        $id = $inputs[ 'voice_id' ]; //this is poll_id 
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
            $data = $this -> YourVoice_mod -> delete_voice_reply( $inputs );
            $this -> apiresponse -> sendjson( $data );
        }
    }

    function get_comment_replies() {

        $inputs = $this -> input -> post();
        $id = $inputs[ 'voice_id' ]; //this is voice id 
        $comment_id = $inputs[ 'comment_id' ];
        $offset = $inputs[ 'offset' ];

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide prediction id" ) );
        } else if ( $comment_id == "" || $comment_id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
        } else {
            $response = $this -> YourVoice_mod -> get_replies( $inputs );
            $this -> apiresponse -> sendjson( $response );
        }
    }

    function like_unlike_voice() {
        $inputs = $this -> input -> post();
        $id = $inputs[ 'voice_id' ]; //this is voice id 
        $is_user_like = $inputs[ 'is_user_like' ];
        $user_id = $inputs[ 'user_id' ];

        $is_user_like = ($is_user_like == "0") ? "1" : "0";

        if ( $id == "" || $id == 0 ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide your voice id" ) );
        } else if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else if ( $user_id > 0 ) {
            $data = $this -> YourVoice_mod -> add_update_like_unlike_voice( $user_id, $id, $is_user_like );
            $this -> apiresponse -> sendjson( $data );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
        }
    }

    function get_users_points( $user_id ) {
        $this -> db -> select( "u.unearned_points" );
        $this -> db -> from( "users u" );
        $this -> db -> where( "u.id = '$user_id'" );
        $data = $this -> db -> get() -> row_array();
        $points = $data[ 'unearned_points' ];

        return $points;
    }

}
