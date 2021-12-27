<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Index extends CI_Controller {

    private $user_id = 0;
    private $user_alias = "";
    private $silver_points = 0;

    function __construct() {
        parent::__construct();

        $this -> load -> model( 'Index_Mod' );
        $this -> load -> model( 'Survey_Mod' );
        $this -> load -> model( 'YourVoice_mod' );
        $this -> load -> model( 'RatedArticle_Mod' );
        $this -> load -> model( 'Wall_Mod' );
        $this -> load -> model( 'FromTheWeb_Mod' );

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
        //$this -> output -> enable_profiler( true );
        $data = array ();
        $header_data[ 'page_title' ] = "Wisdom Of The Crowds: India Crowd Sourcing, India Free Surveys - CrowdWisdom";
        $header_data[ 'page_meta_description' ] = "CrowdWisdom uses the concept of Wisdom of the Crowds, India Crowd Sourcing, India Free Surveys and Crowd Sources the most relevant and accurate predictions, information and advice.";
        $header_data[ 'page_meta_keywords' ] = "CrowdWisdom, Crowd Wisdom, crowdwisdom, crowd wisdom, India Predictions, India Election Predictions, 
              Stock Market Predictions, Movie Predictions, Movie Reviews, Crowdsourced Content, Crowdsourced Surveys, Crowdsourced Advice, Advice, Advise, 
              election game, opinion poll, election polls, vidhan shabha election, upcoming election in India, next election in India, assembly election 2018,
              lok sabha election, India result, election results, election, India Crowd Sourcing, Wisdom Of The Crowds, India Free Surveys, Lok Sabha Elections 2019,
              Lok Sabha Election Analysis, Assembly Election Analysis, Assembly Election opinion Polls 2018, Lok Sabha Opinion Polls 2019, 
              Chhattisgarh Assembly Opinion Polls 2018, Madhya Pradesh Assembly Opinion Polls 2018, Rajasthan Assembly Opinion Polls 2018, Rajasthan Elections 2018,
              MP Elections 2018, Bollywood Box Office Predictions, Indian Economy Forecasts, Worst Mutual Funds, Worst Mutual Fund Company, Worst Insurance Company,
              Best Performing Mutual Funds, Best Performing Life Insurance, Asian Games Hockey Predictions, Modi Ratings, Rahul Ratings, Andhra Pradesh Assembly Opinion Polls 2019,
              Cricket Results Prediction, best mutual funds 2018, best mutual funds for sip, best mutual funds with top 5 mutual funds for sip, best mutual fund company in india,
              cricket match predictions, Top Indian Paid surveys, Top Rated Surveys for India, assembly election 2019, assembly election 2019";
        $header_data[ 'page_img' ] = base_url( "images/logo/preview.jpg" );

        $header_data[ 'uid' ] = $this -> user_id;
        $header_data[ 'silver_points' ] = $this -> silver_points;

        /* inputs */
        $inputs[ 'user_id' ] = $this -> user_id;
        $inputs[ 'offset' ] = 0;
        $inputs[ 'topic_id' ] = 0;
        $inputs[ 'notin' ] = 0;
        /* inputs */

        $data[ "trending_predictions" ] = $this -> Index_Mod -> get_trending_prediction( $inputs );
        $data[ "trending_questions" ] = $this -> Index_Mod -> get_trending_questions( $inputs, 6 );
        $data[ "trending_voice" ] = $this -> YourVoice_mod -> get_voices( $inputs, 4, 0, $this -> user_id );

        //$data[ "trending_editors_choice_data" ] = $this -> YourVoice_mod -> get_voices( $inputs, 6, 0, 0, 2 );
        $data[ "trending_discussions" ] = $this -> Wall_Mod -> get_trending_discussions( $inputs, 3 );

        $this -> load -> view( 'bootstrap_header', $header_data );
        $this -> load -> view( 'home_revised', $data );
        $this -> load -> view( 'bootstrap_footer', $header_data );
    }

    function trending_predictions() {
        //$trending_predictions = $this->Poll_Mod->get_poll_by_category(1, $this->user_id, 0, 0, 4);
        $trending_predictions = $this -> Index_Mod -> get_trending_prediction( $this -> user_id );

        $this -> apiresponse -> sendjson( $trending_predictions );
    }

    function trending_questions() {
        //$trending_questions = $this->Survey_Mod->get_trending_surveys($this->user_id, 0, 4);
        $trending_questions = $this -> Index_Mod -> get_trending_questions( $this -> user_id );

        $trending_question_data = array ( "status" => TRUE, "message" => "", "data" => $trending_questions );

        $this -> apiresponse -> sendjson( $trending_question_data );
    }

    function get_trending_voice() {
        $inputs[ 'offset' ] = 0;
        $inputs[ 'notin' ] = 0;

        $trending_voice_data = $this -> YourVoice_mod -> get_voices( $inputs );

        $this -> apiresponse -> sendjson( $trending_voice_data );
    }

    function get_trending_editors_voice() {
        $inputs[ 'offset' ] = 0;
        $inputs[ 'notin' ] = 0;

        $trending_editors_choice_data = $this -> YourVoice_mod -> get_voices( $inputs, 8, 0, 0, 2 );


        $this -> apiresponse -> sendjson( $trending_editors_choice_data );
    }

//        function get_trending_rated_articles() {
//
//                //$this -> output -> enable_profiler( true );
//                $trending_rated_articles_data = array ();
//                $trending_rated_articles_data = $this -> RatedArticle_Mod -> get_trending_article_list( $this -> user_id, 0, 4 );
//
//                if ( empty( $trending_rated_articles_data ) ) {
//                        $offset = 0;
//                        $trending_rated_articles_data = $this -> RatedArticle_Mod -> get_archive_article( $offset, 4, "archive" );
//                } else {
//                        $other_trending_article_count = 4 - count( $trending_rated_articles_data );
//                        $offset = 0;
//                        if ( count( $trending_rated_articles_data ) < 4 && $other_trending_article_count != 0 ) {
//                                $other_articles = $this -> RatedArticle_Mod -> get_archive_article( $offset, $other_trending_article_count, "archive" );
//                                foreach ( $other_articles as $archive_data ) {
//                                        array_push( $trending_rated_articles_data, $archive_data );
//                                }
//                        }
//                }
//                $this -> apiresponse -> sendjson( $trending_rated_articles_data );
//
//        }

    function get_trending_rated_articles() {
        $inputs = $this -> input -> post();
        //$inputs[ 'topic_id' ] = 0;
        $inputs[ 'user_id' ] = $this -> user_id;
        $inputs[ 'offset' ] = 0;
        $inputs[ 'limit' ] = 4;

        $trending_rated_articles_data = $this -> FromTheWeb_Mod -> get_trending_article_list( $inputs );

        $this -> apiresponse -> sendjson( $trending_rated_articles_data );
    }

    /* Topic list for mobile and web both views */

    function topic_list() {
        $user_id = $this -> user_id;

        $data = $this -> Index_Mod -> get_topics_list( $user_id );
        $this -> apiresponse -> sendjson( $data );
    }

    function follow_topic() {
        if ( $this -> user_id > 0 ) {
            $inputs = $this -> input -> post();
            $inputs[ 'user_id' ] = $this -> user_id;

            $data = $this -> Index_Mod -> follow_topic( $inputs );
            $this -> apiresponse -> sendjson( $data );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => false, "message" => "You are not logged in", "data" => "" ) );
        }
    }
    
     function join_topic() {
        if ( $this -> user_id > 0 ) {
            $inputs = $this -> input -> post();
            $inputs[ 'user_id' ] = $this -> user_id;

            $data = $this -> Index_Mod -> join_topic( $inputs );
            $this -> apiresponse -> sendjson( $data );
        } else {
            $this -> apiresponse -> sendjson( array ( "status" => false, "message" => "You are not logged in", "data" => "" ) );
        }
    }

}
