<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ApiAskQuestions extends CI_Controller {

        function __construct() {
                parent::__construct();

                $this -> load -> model( "ApiAskQuestions_Mod" );

        }

        function special_character( $string ) {
                $string = str_replace( "'", "&#039;", $string );
                $string = str_replace( '"', '&#039;', $string );
                return $string;

        }

        function lists() {
                $inputs = $this -> input -> post();
                $offset = $inputs[ 'offset' ];

                $response_data = $this -> ApiAskQuestions_Mod -> get_questions_list( $inputs );
                $this -> apiresponse -> sendjson( $response_data );

        }

        function detail() {
                $inputs = $this -> input -> post();
                $inputs[ 'user_id' ];

                $response_data = $this -> ApiAskQuestions_Mod -> get_question_detail( $inputs );
                $this -> apiresponse -> sendjson( $response_data );

        }

        function create_update_question() {
                $inputs = $this -> input -> post();

                $questionid = $inputs[ 'questionid' ];
                $user_id = $inputs[ 'user_id' ];
                $title = $this -> special_character( $inputs[ 'title' ] );
                $description = $this -> special_character( $inputs[ 'description' ] );
                $topics = $inputs[ 'topics' ];
                $choices = $inputs[ 'choices' ];
                $select_choice = $inputs[ 'select_choice' ];
                $uploaded_filename = $inputs[ 'uploaded_filename' ];
                $is_topic_change = $inputs[ 'is_topic_change' ];
                $is_choice_change = $inputs[ 'is_choice_change' ];

                if ( $questionid == "" ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide ask question id" ) );
                } else if ( $title == "" ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please enter title" ) );
                } else if ( $description == "" ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please enter description" ) );
                } else if ( count( $topics ) == 0 ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please enter topic" ) );
                } else if ( count( $choices ) == 0 ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please enter choices" ) );
                } else if ( ! in_array( $select_choice, array ( 0, 1 ) ) ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please please choice is single or multiple" ) );
                } else if ( $uploaded_filename == "" ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please upload image" ) );
                } else if ( ! in_array( $is_choice_change, array ( 0, 1 ) ) ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "is topic modified?" ) );
                } else if ( ! in_array( $is_choice_change, array ( 0, 1 ) ) ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "is choice modified?" ) );
                } else if ( $user_id == "" ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
                } else if ( $user_id > 0 ) {
                        $this -> ApiAskQuestions_Mod -> add_update_question( $inputs );
                        $message = ($questionid == "0") ? "Question created successfully" : "Question updated successfully";
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
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide ask question id" ) );
                } else if ( count( $choice ) == 0 ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide choice ids" ) );
                } else if ( $user_id == "" ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
                } else if ( $user_id > 0 ) {
                        $isvote = $this -> ApiAskQuestions_Mod -> vote_action_mod( $inputs, $user_id );

                        $vote = $this -> ApiAskQuestions_Mod -> get_question_detail( $inputs );

                        if ( $isvote == 0 ) {
                                $vote[ 'isnew' ] = 1;
                                $this -> apiresponse -> sendjson( $vote );
                        } else {
                                $vote[ 'isnew' ] = 0;
                                $this -> apiresponse -> sendjson( $vote );
                        }
                } else {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in", "data" => array () ) );
                }

        }

        function add_comment() {
                $inputs = $this -> input -> post();

                $id = $inputs[ 'id' ];
                $comment_id = $inputs[ 'comment_id' ];
                $comment = $inputs[ 'comment' ];
                $user_id = $inputs[ 'user_id' ];

                if ( $id == "" || $id == 0 ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide ask question id" ) );
                } else if ( $comment == "" ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
                } else if ( $user_id == "" ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
                } else if ( $user_id > 0 ) {
                        $last_commnet_id = $this -> ApiAskQuestions_Mod -> add_comment_mod( $inputs );
                        $comment_data = $this -> ApiAskQuestions_Mod -> get_comment_by_id( $last_commnet_id );
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
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide ask question id" ) );
                } else if ( $comment_id == "" || $comment_id == 0 ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
                } else if ( $comment == "" ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
                } else if ( $user_id == "" ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
                } else if ( $user_id > 0 ) {
                        $last_commnet_id = $this -> ApiAskQuestions_Mod -> add_comment_mod( $inputs );
                        $comment_data = $this -> ApiAskQuestions_Mod -> get_comment_by_id( $last_commnet_id );
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
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide ask question id" ) );
                } else {
                        $result = $this -> ApiAskQuestions_Mod -> get_more_comments( $inputs );
                        $this -> apiresponse -> sendjson( $result );
                }

        }

        function delete_comment() {
                $inputs = $this -> input -> post();
                $id = $inputs[ 'id' ]; //this is question id 
                $comment_id = $inputs[ 'comment_id' ];
                $user_id = $inputs[ 'user_id' ];

                if ( $id == "" || $id == 0 ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide ask question id" ) );
                } else if ( $comment_id == "" || $comment_id == 0 ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
                } else if ( $user_id == "" ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
                } else if ( $user_id > 0 ) {
                        $data = $this -> ApiAskQuestions_Mod -> delete_comment_mod( $user_id, $id, $comment_id );
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
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide ask question id" ) );
                } else if ( $comment_id == "" || $comment_id == 0 ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
                } else if ( $comment_reply == "" ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
                } else if ( $user_id == "" ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
                } else if ( $user_id > 0 ) {
                        $last_commnet_reply_id = $this -> ApiAskQuestions_Mod -> add_comment_reply_mod( $inputs );
                        $reply_data = $this -> ApiAskQuestions_Mod -> get_comment_reply_by_id( $last_commnet_reply_id );
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
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide ask question id" ) );
                } else if ( $comment_id == "" || $comment_id == 0 ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
                } else if ( $comment_reply_id == "" || $comment_reply_id == 0 ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment reply id" ) );
                } else if ( $comment_reply == "" ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please write comment" ) );
                } else if ( $user_id == "" ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
                } else if ( $user_id > 0 ) {
                        $last_commnet_reply_id = $this -> ApiAskQuestions_Mod -> add_comment_reply_mod( $inputs );
                        $reply_data = $this -> ApiAskQuestions_Mod -> get_comment_reply_by_id( $last_commnet_reply_id );
                        $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "Reply updated successfully!", "data" => $reply_data ) );
                } else {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
                }

        }

        /* Delete reply */

        function delete_comment_reply() {
                $inputs = $this -> input -> post();

                $id = $inputs[ 'id' ]; //this is question id 
                $comment_id = $inputs[ 'comment_id' ];
                $comment_reply_id = $inputs[ 'comment_reply_id' ];
                $user_id = $inputs[ 'user_id' ];

                if ( $id == "" || $id == 0 ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide ask question id" ) );
                } else if ( $comment_id == "" || $comment_id == 0 ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
                } else if ( $comment_reply_id == "" || $comment_reply_id == 0 ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment reply id" ) );
                } else if ( $user_id == "" ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
                } else if ( $user_id > 0 ) {
                        $data = $this -> ApiAskQuestions_Mod -> delete_comment_reply_mod( $inputs );
                        $this -> apiresponse -> sendjson( $data );
                }

        }

        function get_comment_replies() {

                $inputs = $this -> input -> post();
                $id = $inputs[ 'id' ]; //this is question id 
                $comment_id = $inputs[ 'comment_id' ];
                $offset = $inputs[ 'offset' ];

                if ( $id == "" || $id == 0 ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide ask question id" ) );
                } else if ( $comment_id == "" || $comment_id == 0 ) {
                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide comment id" ) );
                } else {
                        $response = $this -> ApiAskQuestions_Mod -> get_comment_replies_mod( $inputs );
                        $this -> apiresponse -> sendjson( $response );
                }

        }

}
