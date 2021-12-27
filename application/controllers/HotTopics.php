<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HotTopics extends CI_Controller {

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
                $this -> detail();

        }

        function detail( $topicid = 0 ) {
                //$this -> output -> enable_profiler( true );
                $data = array ();
                $header_data[ 'page_title' ] = "Hot Topics";
                $header_data[ 'page_meta_description' ] = "";
                $header_data[ 'page_meta_keywords' ] = "";
                $header_data[ 'page_img' ] = base_url( "images/logo/preview.jpg" );

                $header_data[ 'uid' ] = $this -> user_id;
                $header_data[ 'silver_points' ] = $this -> silver_points;


                $inputs[ 'user_id' ] = $this -> user_id;
                $inputs[ 'offset' ] = 0;
                $inputs[ 'topic_id' ] = $topicid;
                $inputs[ 'notin' ] = 0;

                $data[ "trending_predictions" ] = $this -> Index_Mod -> get_trending_prediction( $inputs );
                $data[ "trending_questions" ] = $this -> Index_Mod -> get_trending_questions( $inputs, 6 );
                $data[ "trending_voice" ] = $this -> YourVoice_mod -> get_voices( $inputs, 3 );

                //$data[ "trending_editors_choice_data" ] = $this -> YourVoice_mod -> get_voices( $inputs, 6, 0, 0, 2 );
                $data[ "trending_discussions" ] = $this -> Wall_Mod -> get_trending_discussions( $inputs, 3 );


                if ( $topicid > 0 ) {
                        $inputs[ 'id' ] = $topicid;
                        $data[ 'topicclass' ] = 'd-none';
                        $result = $this -> Index_Mod -> get_topic_detail( $inputs );
                       
                        $data[ 'topic_name' ] = $result[ 'data' ][ 'topic' ];
                        $data['email_ids'] = $result['data']['email_ids'];
                        $data['is_private'] = $result['data']['is_private'];
                        $header_data[ 'page_title' ] = $data[ 'topic_name' ];
                        $header_data[ 'page_img' ] = $result[ 'data' ][ 'image' ] . "?t=" . time();

                        if ( isset( $result[ 'data' ][ 'is_follow' ] ) ) {
                                $data[ 'is_follow' ] = $result[ 'data' ][ 'is_follow' ];
                        } else {
                                $data[ 'is_follow' ] = 0;
                        }
                        
                        if ( isset( $result[ 'data' ][ 'is_join' ] ) ) {
                                $data[ 'is_join' ] = $result[ 'data' ][ 'is_join' ];
                        } else {
                                $data[ 'is_join' ] = 0;
                        }
                        $data[ 'topic_id' ] = $result[ 'data' ][ 'id' ];
                }
//                print_r($this -> Index_Mod -> get_topic_detail( $inputs ));die();
                $this -> load -> view( 'bootstrap_header', $header_data );
                $this -> load -> view( 'home_revised', $data );
                $this -> load -> view( 'bootstrap_footer' );

        }

        function search_topics() {
                $inputs = $this -> input -> post();
                $topic = $inputs[ 'topic' ];
                $excludetopicids = json_decode( $inputs[ 'excludetopic' ] );
                //echo count( $excludetopicids );
                $excludeCond = "";
                if ( count( $excludetopicids ) > 0 ) {
                        $ids = implode( ",", $excludetopicids );
                        $excludeCond = "AND id not in ($ids)";
                }
                //echo $excludeCond;
                $this -> db -> select( "t.*" );
                $this -> db -> from( "topics t" );
                $this -> db -> where( "t.is_active = '1' AND t.is_private = '0' AND t.topic LIKE '%$topic%' $excludeCond" );
                $data = $this -> db -> get() -> result_array();
                //print_r($data);
                $this -> apiresponse -> sendjson( $data );

        }

        function topic_list( $topicid = 0 ) {

                $data = array ();
                $header_data[ 'page_title' ] = "Topic List";
                $header_data[ 'page_meta_description' ] = "";
                $header_data[ 'page_meta_keywords' ] = "";
                $header_data[ 'page_img' ] = base_url( "images/logo/preview.jpg" );

                $header_data[ 'uid' ] = $this -> user_id;
                $header_data[ 'silver_points' ] = $this -> silver_points;

                $this -> load -> view( 'bootstrap_header', $header_data );
                $this -> load -> view( 'topics_list', $data );
                $this -> load -> view( 'bootstrap_footer' );

        }

}
