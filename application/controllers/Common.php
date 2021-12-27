<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Common extends CI_Controller {

        private $user_id = 0;

        function __construct() {
                parent::__construct();
                $this -> load -> model( "Predictions_Mod" );
                $this -> load -> model( "AskQuestions_Mod" );
                $this -> load -> model( 'YourVoice_mod' );
                $this -> load -> model( 'RatedArticle_Mod' );
                $this -> load -> model( "Wall_Mod" );
                $this -> load -> model( "FromTheWeb_Mod" );

                $sessiondata = $this -> session -> userdata( 'data' );
                if ( ! empty( $sessiondata ) ) {
                        $this -> user_id = $sessiondata[ 'uid' ];
                } else {
                        $this -> user_id = 0;
                }

        }

        function get_trending_predictions() {
                $inputs = $this -> input -> post();
                //$offset = $inputs[ 'offset' ];
                $data = $this -> Predictions_Mod -> get_prediction_list( $inputs );

                $this -> apiresponse -> sendjson( $data );

        }

        function get_trending_questions() {
                $inputs = $this -> input -> post();
                //$offset = $inputs[ 'offset' ];
                $data = $this -> AskQuestions_Mod -> get_questions_list( $inputs );

                $this -> apiresponse -> sendjson( $data );

        }

        function get_trending_voices() {
                $inputs = $this -> input -> post();
                $offset = $inputs[ 'offset' ];
                $voicenotin = $inputs[ 'notin' ];
                $inputs[ 'topic_id' ] = 0;

                if ( ! $offset ) {
                        $offset = 0;
                }
                $data = $this -> YourVoice_mod -> get_voices( $inputs );

                $this -> apiresponse -> sendjson( $data );

        }

        function get_trending_rated_articles() {
                $inputs = $this -> input -> post();
                $inputs[ 'topic_id' ] = 0;
                $inputs[ 'user_id' ] = $this -> user_id;
                $inputs[ 'offset' ] = 0;
                $inputs[ 'limit' ] = 6;

                $trending_rated_articles_data = $this -> FromTheWeb_Mod -> get_trending_article_list( $inputs );

                foreach ( $trending_rated_articles_data as $key => $trending_rated_articles ) {
                        $trending_rated_articles_data[ $key ][ 'title' ] = $trending_rated_articles[ 'question' ];
                }
                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "message" => "", "data" => $trending_rated_articles_data ) );

                //$inputs = $this -> input -> post();
                //$offset = $inputs[ 'offset' ];
                //$data = $this -> RatedArticle_Mod -> get_article_list( $inputs );
                //$this -> apiresponse -> sendjson( $data );

        }

        function get_trending_wall() {
                $inputs = $this -> input -> post();

                $inputs[ 'topic_id' ] = 0;
                $inputs[ 'user_id' ] = $this -> user_id;
                $inputs[ 'offset' ] = 0;

                $data = $this -> Wall_Mod -> get_trending_discussions( $inputs, 7 );

                $this -> apiresponse -> sendjson( $data );

        }

        function generate_preview() {
                $url = $this -> input -> post( 'url' );
                $data = getmetatags( $url );

                $this -> apiresponse -> sendjson( array ( "status" => TRUE, "data" => $data ) );

        }

}
