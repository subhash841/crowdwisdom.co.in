<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class YourVoice extends CI_Controller {

        private $user_id = 0;
        private $user_alias = "";
        private $silver_points = 0;

        function __construct() {
                parent::__construct();

                $this -> load -> model( 'YourVoice_mod' );

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
                $header_data[ 'page_title' ] = "Your Voice";
                $header_data[ 'page_img' ] = base_url( "images/logo/prediction_share_logo.png" );
                $header_data[ 'uid' ] = $this -> user_id;
                $header_data[ 'silver_points' ] = $this -> silver_points;
                $header_data[ 'alias' ] = $this -> user_alias;
                $header_data[ 'page_meta_keywords' ] = "";
                $header_data[ 'page_meta_description' ] = "";

                $data = array ();

                $this -> load -> view( 'bootstrap_header', $header_data );
                $this -> load -> view( 'yourvoice', $data );
                $this -> load -> view( 'bootstrap_footer' );
        }

        function load_voices() {
                $inputs = $this -> input -> post();
                $offset = $inputs[ 'offset' ];
                $voicenotin = $inputs[ 'notin' ];
                $inputs[ 'topic_id' ] = 0;

                if ( ! $offset ) {
                        $offset = 0;
                }
                $data = $this -> YourVoice_mod -> get_voices( $inputs );
                //print_r( $data );
                //  $data = $this -> convert_from_latin1_to_utf8_recursively( $data );
                echo json_encode( $data );
                //var_dump( json_last_error_msg() );
        }

        function json_last_error_msg() {
                static $ERRORS = array (
                    JSON_ERROR_NONE => 'No error',
                    JSON_ERROR_DEPTH => 'Maximum stack depth exceeded',
                    JSON_ERROR_STATE_MISMATCH => 'State mismatch (invalid or malformed JSON)',
                    JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
                    JSON_ERROR_SYNTAX => 'Syntax error',
                    JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded'
                );

                $error = json_last_error();
                return isset( $ERRORS[ $error ] ) ? $ERRORS[ $error ] : 'Unknown error';
        }

        function convert_from_latin1_to_utf8_recursively( $dat ) {
                if ( is_string( $dat ) ) {
                        return utf8_encode( $dat );
                } elseif ( is_array( $dat ) ) {
                        $ret = [];
                        foreach ( $dat as $i => $d )
                                $ret[ $i ] = $this -> convert_from_latin1_to_utf8_recursively( $d );

                        return $ret;
                } elseif ( is_object( $dat ) ) {
                        foreach ( $dat as $i => $d )
                                $dat -> $i = $this -> convert_from_latin1_to_utf8_recursively( $d );

                        return $dat;
                } else {
                        return $dat;
                }
        }

        function load_articles() {

                $inputs = $this -> input -> post();
                $offset = $inputs[ 'offset' ];
                if ( ! $offset ) {
                        $offset = 0;
                }
                $data = $this -> YourVoice_mod -> get_voices( $offset, 5, 0, $this -> user_id, 2 );

                echo json_encode( $data );
        }

        function blog_detail( $id ) {
                if ( ! $id ) {
                        redirect( "YourVoice" );
                }
                $header_data = array ();
                $data = array ();
                $header_data[ 'uid' ] = $this -> user_id;
                $header_data[ 'silver_points' ] = $this -> silver_points;
                $header_data[ 'alias' ] = $this -> user_alias;

                $header_data[ 'page_title' ] = "";
                $header_data[ 'page_img' ] = "";
                $header_data[ 'page_meta_keywords' ] = "";
                $header_data[ 'page_meta_description' ] = "";
                $header_data[ 'id' ] = $id;

                if ( ! is_numeric( $id ) ) {
                        $this -> output -> set_status_header( '404' );
                        $this -> load -> view( 'bootstrap_header', $header_data );
                        $this -> load -> view( 'yourvoice_details', $data );
                        $this -> load -> view( 'bootstrap_footer' );
                } else {
                        $data = $this -> YourVoice_mod -> get_voices( 0, 7, $id, $this -> user_id );

                        if ( ! isset( $data[ 'data' ][ 0 ][ 'id' ] ) ) {
                                //show_404();
                                $this -> output -> set_status_header( '404' );
                                $this -> load -> view( 'bootstrap_header', $header_data );
                                $this -> load -> view( 'yourvoice_details', array () );
                                $this -> load -> view( 'bootstrap_footer' );
                        } else {
                                //update view count against the blog - every time when page get refresh
                                $this -> db -> set( 'total_views', 'total_views+1', FALSE );
                                $this -> db -> where( "id = '$id'" );
                                $this -> db -> update( "blogs" );

                                $header_data[ 'page_title' ] = $data[ 'data' ][ 0 ][ 'title' ];
                                $header_data[ 'page_img' ] = $data[ 'data' ][ 0 ][ 'image' ];
                                $header_data[ 'page_meta_keywords' ] = $data[ 'data' ][ 0 ][ 'meta_keywords' ];
                                $header_data[ 'page_meta_description' ] = $data[ 'data' ][ 0 ][ 'meta_description' ];
                                $header_data[ 'uid' ] = $this -> user_id;
                                $header_data[ 'silver_points' ] = $this -> silver_points;
                                $header_data[ 'id' ] = $id;
                                $header_data[ 'alias' ] = $this -> user_alias;

                                $this -> load -> view( 'bootstrap_header', $header_data );
                                $this -> load -> view( 'yourvoice_details', $data );
                                $this -> load -> view( 'bootstrap_footer' );
                        }
                }
        }

        function raise_voice( $id = 0 ) {
             
                $sessiondata = $this -> session -> userdata( 'data' );

                if ( ! empty( $sessiondata ) ) {
                        $header_data[ 'page_title' ] = "Raise Your Voice";
                        $header_data[ 'page_img' ] = "";
                        $header_data[ 'uid' ] = $this -> user_id;
                        $header_data[ 'silver_points' ] = $this -> silver_points;
                        $header_data[ 'id' ] = $id;

                        $data = array ();

                        $data[ 'categories' ] = get_blog_category();

                        if ( $id > 0 ) {
                                $data[ 'blog_data' ] = $this -> YourVoice_mod -> get_voices( 0, 7, $id, $this -> user_id );
                                $data[ 'topic_associated' ] = $this -> get_blog_topics( $id );
                        }
                        
                        $this -> load -> view( 'bootstrap_header', $header_data );
                        $this -> load -> view( 'raise_voice', $data );
                        $this -> load -> view( 'bootstrap_footer' );
                } else {
                        redirect( "YourVoice" );
                }
        }

        function get_blog_topics( $postid ) {
                $this -> db -> select( "ta.topic_id,ta.type, t.topic" );
                $this -> db -> from( "topic_association ta" );
                $this -> db -> join( "topics t", "ta.topic_id = t.id", "INNER" );
                $this -> db -> where( "ta.post_id = '$postid' AND ta.type = 'Blog'" );
                $result = $this -> db -> get() -> result_array();

                return $result;

        }
        
        function raise_voice_old( $id = 0 ) {

                $sessiondata = $this -> session -> userdata( 'data' );

                if ( ! empty( $sessiondata ) ) {
                        $header_data[ 'page_title' ] = "Raise Your Voice";
                        $header_data[ 'page_img' ] = "";
                        $header_data[ 'uid' ] = $this -> user_id;
                        $header_data[ 'silver_points' ] = $this -> silver_points;
                        $header_data[ 'id' ] = $id;

                        $data = array ();

                        $data[ 'categories' ] = get_blog_category();

                        if ( $id > 0 ) {
                                $data[ 'blog_data' ] = $this -> YourVoice_mod -> get_voices( 0, 7, $id, $this -> user_id );
                        }
                        $this -> load -> view( 'new_header_1', $header_data );
                        $this -> load -> view( 'raise_voice - Copy', $data );
                        $this -> load -> view( 'new_footer_1' );
                } else {
                        redirect( "YourVoice" );
                }
        }

        /* Create update voice */

        function create_update_voice() {
                if ( $this -> user_id > 0 ) {
                        $inputs = $this -> input -> post();
                        $result = $this -> YourVoice_mod -> create_update_voice_mod( $this -> user_id );
                        $voice_id = $inputs[ 'voice_id' ];

                        $msg = ($voice_id == 0) ? "Thank you. Crowd wisdom will approve your voice soon" : "Thank you. Crowd wisdom will approve your voice soon";

                        $this -> session -> set_flashdata( 'toast', $msg );
                        print_r($result);
                } else {
                        redirect( "YourVoice" );
                }
        }

        function comment_on_voice() {
                $inputs = $this -> input -> post();
                $inputs[ 'user_id' ] = $this -> user_id;
                $voice_id = $inputs[ 'voice_id' ];
                $comment = $inputs[ 'comment' ];

                $data = $this -> YourVoice_mod -> do_comment( $inputs );

                echo json_encode( $data );
        }

        function update_comment_on_voice() {
                $inputs = $this -> input -> post();
                $inputs[ 'user_id' ] = $this -> user_id;
                $voice_id = $inputs[ 'voice_id' ];
                $comment_id = $inputs[ 'comment_id' ];
                $comment = $inputs[ 'comment' ];

                $data = $this -> YourVoice_mod -> update_comment( $inputs );

                echo json_encode( $data );
        }

        /* Load sub category */

        function load_sub_category() {
                $sub_cat_data = $this -> YourVoice_mod -> get_sub_category();
                echo json_encode( array ( "status" => TRUE, "message" => "", "data" => $sub_cat_data ) );
        }

        /* Delete Voice */

        function delete_voice() {
                $inputs = $this -> input -> post();
                $voice_id = $inputs[ 'voice_id' ];
                $res = $this -> YourVoice_mod -> delete_voice_mod( $this -> user_id, $voice_id );

                return array ( "status" => TRUE, "message" => "", "data" => "" );
        }

        /* Like Unlike Voice */

        function like_unlike_voice() {
                $inputs = $this -> input -> post();
                $voice_id = $inputs[ 'voice_id' ];
                $is_user_like = $inputs[ 'is_user_like' ];

                $is_user_like = ($is_user_like == "0") ? "1" : "0";

                $data = $this -> YourVoice_mod -> add_update_like_unlike_voice( $this -> user_id, $voice_id, $is_user_like );
                echo json_encode( $data );
        }

        /* Delete Comments */

        function delete_voice_comment() {
                $inputs = $this -> input -> post();
                $voice_id = $inputs[ 'voice_id' ];
                $comment_id = $inputs[ 'comment_id' ];

                $data = $this -> YourVoice_mod -> delete_voice_comment( $this -> user_id, $voice_id, $comment_id );
                echo json_encode( $data );
        }

        /* Delete reply */

        function delete_voice_comment_reply() {
                $inputs = $this -> input -> post();
                $inputs[ 'user_id' ] = $this -> user_id;
                $voice_id = $inputs[ 'voice_id' ];
                $comment_id = $inputs[ 'comment_id' ];
                $reply_id = $inputs[ 'comment_reply_id' ];

                $data = $this -> YourVoice_mod -> delete_voice_reply( $inputs );
                echo json_encode( $data );
        }

        function load_latest_voices() {
                $inputs = $this -> input -> post();
                $data = $this -> YourVoice_mod -> get_latest_voices( $inputs );
                echo json_encode( $data );
        }

        function view_more_comments() {
                $inputs = $this -> input -> post();

                $result = $this -> YourVoice_mod -> get_more_comments( $inputs );

                echo json_encode( $result );
        }

        function reply_on_comment_voice() {
                $inputs = $this -> input -> post();
                $inputs[ 'user_id' ] = $this -> user_id;

                $data = $this -> YourVoice_mod -> do_reply_on_comment( $inputs );

                echo json_encode( $data );
        }

        function update_comment_reply_on_voice() {
                $inputs = $this -> input -> post();
                $inputs[ 'user_id' ] = $this -> user_id;
                $voice_id = $inputs[ 'voice_id' ];
                $comment_id = $inputs[ 'comment_id' ];
                $comment_reply_id = $inputs[ 'comment_reply_id' ];
                $comment_reply = $inputs[ 'comment_reply' ];

                $data = $this -> YourVoice_mod -> update_comment_reply( $inputs );

                echo json_encode( $data );
        }

        function get_comment_replies() {
                $inputs = $this -> input -> post();

                $data = $this -> YourVoice_mod -> get_replies( $inputs );

                echo json_encode( $data );
        }

}
