<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ApiYourVoice_Mod extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_voices() {

        /* Get Voices raised in last 1 hour - START */
        $this -> db -> select( "b.id" );
        $this -> db -> from( "blogs b" );
        $this -> db -> where( "(b.created_date) >= (now() - INTERVAL 24 hour) AND b.is_active = '1'" );
        $last1hour_result = $this -> db -> get() -> result_array();

        $last24hourids = "";
        $is_new = "";

        if ( ! empty( $last1hour_result ) ) {
            foreach ( $last1hour_result as $key => $last1hour_data ) {
                $last24hourids .= $last1hour_data[ 'id' ] . ",";
            }
            $last24hourids = chop( $last24hourids, "," );

            if ( $last24hourids != "" ) {
                $is_new = "FIELD(b.id, $last24hourids) DESC,";
            }
        }
        /* Get Voices raised in last 1 hour - END */

        /* Engagement Checking - START */
        $engagement_ids = array ();
        $this -> db -> select( "bl.blog_id as voice_id, sum(bl.is_like) as total_response" );
        $this -> db -> from( "blog_likes bl" );
        $this -> db -> where( "bl.created_date >= (now() - INTERVAL 24 hour) AND bl.is_like = '1'" );
        $this -> db -> group_by( "bl.blog_id" );
        $this -> db -> order_by( "total_response DESC, bl.id DESC" );
        $likes_responses = $this -> db -> get() -> result_array();

        $this -> db -> select( "bc.voice_id, COUNT(1) as total_response" );
        $this -> db -> from( "blog_comments bc" );
        $this -> db -> where( "bc.created_date >= (now() - INTERVAL 24 hour) AND bc.is_active = '1'" );
        $this -> db -> group_by( "bc.voice_id" );
        $this -> db -> order_by( "total_response DESC, bc.id DESC" );
        $comment_responses = $this -> db -> get() -> result_array();

        if ( ! empty( $likes_responses ) && ! empty( $comment_responses ) ) { // likes and comments in last 24 hours
            foreach ( $likes_responses as $lkey => $likes ) {
                $engagement_ids[ $lkey ][ 'voice_id' ] = $likes[ 'voice_id' ];
                $engagement_ids[ $lkey ][ 'total_response' ] = $likes[ 'total_response' ];

                foreach ( $comment_responses as $ckey => $comments ) {
                    if ( $likes_responses[ $lkey ][ 'voice_id' ] == $comments[ 'voice_id' ] ) {
                        $engagement_ids[ $lkey ][ 'total_response' ] = $likes[ 'total_response' ] + $comments[ 'total_response' ];
                    } else {
                        array_push( $engagement_ids, $comments );
                    }
                }
            }
        } else if ( ! empty( $likes_responses ) && empty( $comment_responses ) ) { // only likes in last 24 hours
            foreach ( $likes_responses as $lkey => $likes ) {
                $engagement_ids[ $lkey ][ 'voice_id' ] = $likes[ 'voice_id' ];
                $engagement_ids[ $lkey ][ 'total_response' ] = $likes[ 'total_response' ];
            }
        } else if ( empty( $likes_responses ) && ! empty( $comment_responses ) ) { // only comments in last 24 hours
            foreach ( $comment_responses as $ckey => $comments ) {
                $engagement_ids[ $ckey ][ 'voice_id' ] = $comments[ 'voice_id' ];
                $engagement_ids[ $ckey ][ 'total_response' ] = $comments[ 'total_response' ];
            }
        } else { //there is no engagement in 24 last hours 
            $engagement_ids = array ();
        }


        $engagement_id_data = "";
        $engagement_order = "";

        if ( ! empty( $engagement_ids ) ) {
            foreach ( $engagement_ids as $engagement_data ) {
                $onlyids[] = $engagement_data[ 'voice_id' ];
                $engagement_id_data .= $engagement_data[ 'voice_id' ] . ",";
            }
            $unique = array_reverse( array_unique( $onlyids ) );
            $engagement_id_data = implode( ',', $unique );
            $engagement_order = "FIELD(b.id, $engagement_id_data) DESC";
        }


        /* Engagement Checking - END */

        /* Get Your Voices - START */
        $this -> db -> select( "b.*" );
        $this -> db -> from( "blogs b" );
        $this -> db -> where( "b.is_active = '1' AND b.is_approve = '1'" );
        $this -> db -> group_by( "b.id" );
        $this -> db -> order_by( " $is_new $engagement_order" );
        $result = $this -> db -> get();
        $data = $result -> result_array();

        /* Get Your Voices - END */
        return $data;
    }

    function add_update_voice( $inputs ) {

        $id = $inputs[ 'voice_id' ];
        $title = $inputs[ 'title' ];
        $topics = $inputs[ 'topics' ];
        $description = $inputs[ 'description' ];
        $user_id = $inputs[ 'user_id' ];
        $uploaded_filename = $inputs[ 'uploaded_filename' ];
        $is_topic_change = $inputs[ 'is_topic_change' ];

        if ( $id == 0 ) {
            $insert_voice = array (
                "user_id" => $user_id,
                "title" => $title,
                "description" => $description,
                "image" => $uploaded_filename,
                "type" => "1"
            );

            $this -> db -> insert( "blogs", $insert_voice );
            $last_blog_id = $this -> db -> insert_id();

            //Blog topics addition
            foreach ( $topics as $tp ) {
                $topics_insert[] = array (
                    "topic_id" => $tp,
                    "post_id" => $last_blog_id,
                    "type" => "Blog",
                    "title" => $title,
                    "description" => $description
                );
            }

            $this -> db -> insert_batch( 'topic_association', $topics_insert );

            /* update points of user */
            $this -> db -> where( "id = '$user_id'" );
            $this -> db -> set( "unearned_points", "unearned_points-25", FALSE );
            $this -> db -> update( "users" );

            /* Send push notification */ //Notification will be sent once it will get approve
//            $fields = array (
//                "post_id" => $last_blog_id,
//                "title" => "New Voice Added",
//                "text" => $title,
//                "type" => "Voice",
//                "subtype" => "Add",
//                "user_id" => $user_id,
//                "friend_id" => $user_id,
//                "image" => ""
//            );
//            $this -> notification -> get_ids_and_fields( 0, $fields, $user_id );
            /* Send push notification */

            return TRUE;
        } else {

            //update
            $update_voice = array (
                "title" => $title,
                "description" => $description,
                "is_approve" => "0"
            );

            if ( $uploaded_filename != "" ) {
                $update_voice[ 'image' ] = $uploaded_filename;
            }
            $this -> db -> where( "id = '$id' AND user_id = '$user_id'" );
            $this -> db -> update( "blogs", $update_voice );

            if ( $is_topic_change != "0" ) {
                //delete all the existing topics of paricular blog
                $this -> db -> where( "post_id = '$id' AND type = 'Blog'" );
                $this -> db -> delete( "topic_association" );

                //Blog topics addition
                foreach ( $topics as $tp ) {
                    $topics_insert[] = array (
                        "topic_id" => $tp,
                        "post_id" => $id,
                        "type" => "Blog",
                        "title" => $title,
                        "description" => $description
                    );
                }
                $this -> db -> insert_batch( 'topic_association', $topics_insert );
            }

            return TRUE;
        }
    }

    function get_comment_by_id( $id ) {
        $this -> db -> select( "*, id as comment_id" );
        $this -> db -> from( 'blog_comments' );
        $this -> db -> where( 'id', $id );
        $this -> db -> where( 'is_active', 1 );
        $result = $this -> db -> get() -> row_array();
        return $result;
    }

    function get_comment_reply_by_id( $id ) {
        $this -> db -> select( "bcr.*, bcr.id as comment_reply_id, bcr.id as reply_id, u.alise as alias" );
        $this -> db -> from( 'blog_comments_reply bcr' );
        $this -> db -> join( "users u", "u.id = bcr.user_id", "INNER" );
        $this -> db -> where( 'bcr.id', $id );
        $result = $this -> db -> get() -> row_array();
        return $result;
    }

}
