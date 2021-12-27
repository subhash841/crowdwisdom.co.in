<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ApiHome extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this -> load -> model( 'Index_Mod' );
        $this -> load -> model( 'YourVoice_mod' );
        $this -> load -> model( 'Wall_Mod' );
        $this -> load -> model( "Packages_Mod" );
        $this -> load -> model( "ApiFromTheWeb_Mod" );
    }

    function home() {
        $inputs = $this -> input -> post();
        $user_id = $inputs[ 'user_id' ];
        $offset = $inputs[ 'offset' ];
        $topic_id = $inputs[ 'topic_id' ];

        $data = array ();
        if ( $user_id == "" ) {
            $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Please provide user id" ) );
        } else { //if ( $user_id > 0 )
            $trending_predictions_data = $this -> Index_Mod -> get_trending_prediction( $inputs );
            $trending_questions_data = $this -> Index_Mod -> get_trending_questions( $inputs, 6 );
            $trending_voice_data = $this -> YourVoice_mod -> get_voices( $inputs, 4, 0, $this -> user_id );
            $trending_discussions_data = $this -> Wall_Mod -> get_trending_discussions( $inputs, 3 );
            $competetion_data = $this -> Packages_Mod -> get_package_lists( $user_id );
            $rated_article_data = $this -> ApiFromTheWeb_Mod -> get_trending_article_list( $inputs, 4 );

            $topic_name = "";
            $is_follow = 0;

            if ( $topic_id > 0 ) {
                $inputs[ 'id' ] = $topic_id;
                $result = $this -> Index_Mod -> get_topic_detail( $inputs );
                $topic_name = $result[ 'data' ][ 'topic' ];
                if ( isset( $result[ 'data' ][ 'is_follow' ] ) ) {
                    $is_follow = $result[ 'data' ][ 'is_follow' ];
                } else {
                    $is_follow = 0;
                }
            }
            $data = array (
                "status" => TRUE,
                "message" => "",
                "data" => array (
                    "prediction_list" => $trending_predictions_data[ 'data' ],
                    "question_list" => $trending_questions_data[ 'data' ],
                    "your_voice_list" => $trending_voice_data[ 'data' ],
                    "rated_article_list" => $rated_article_data,
                    "competetion_list" => $competetion_data[ 'data' ],
                    "discussion_list" => $trending_discussions_data[ 'data' ],
                ),
                "topic_name" => $topic_name,
                "is_follow" => ( int ) $is_follow
            );
            $this -> apiresponse -> sendjson( $data );
        }
//                else {
//                        $this -> apiresponse -> sendjson( array ( "status" => FALSE, "message" => "Seems that you are not logged in" ) );
//                }
    }

}
