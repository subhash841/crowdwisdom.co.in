<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ApiDiscussion_Mod extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function special_character( $string ) {
        $string = str_replace( "'", "&#039;", $string );
        $string = str_replace( '"', '&#039;', $string );
        return $string;
    }

    function get_wall_detail( $inputs ) {
        $id = $inputs[ 'id' ];
        $user_id = $inputs[ 'user_id' ];

        $this -> db -> select( "f.id, f.user_id, f.title, f.image, f.total_like as total_likes, f.total_dislike, f.total_neutral, f.total_comments, "
                . "f.created_date, COALESCE(u.alise,'') as alias, COALESCE(fa.likes,'0') as is_user_like, COALESCE(fa.dislikes,'0') as is_user_dislike, "
                . "COALESCE(fa.neutral,'0') as is_user_neutral" );
        $this -> db -> from( "forums f" );
        $this -> db -> join( "users u", "u.id = f.user_id", "LEFT" );
        $this -> db -> join( "forum_action fa", "fa.forum_id = f.id AND fa.user_id = '$user_id'", "LEFT" );
        $this -> db -> where( "f.id = '$id' AND f.is_active = '1'" );
        $result = $this -> db -> get() -> row_array();

        if ( $result[ 'user_id' ] == "" || $result[ 'user_id' ] == "0" ) {
            $result[ 'raised_by_admin' ] = "1";
        } else {
            $result[ 'raised_by_admin' ] = "0";
        }

        $result[ 'topics' ] = $this -> get_wall_topics( $result[ 'id' ] );
        $result[ 'comments' ] = $this -> get_wall_comments( $id, 0, 3 );

        if ( count( $result[ 'comments' ] ) > 2 ) {
            unset( $result[ 'comments' ][ count( $result[ 'comments' ] ) - 1 ] );
            $result[ 'more_comments' ] = "1";
        } else {
            $result[ 'more_comments' ] = "0";
        }

        return $result;
    }

    function get_wall_topics( $postid ) {
        $this -> db -> select( "ta.topic_id,ta.type, t.topic" );
        $this -> db -> from( "topic_association ta" );
        $this -> db -> join( "topics t", "ta.topic_id = t.id", "INNER" );
        $this -> db -> where( "ta.post_id = '$postid' AND ta.type = 'Wall'" );
        $result = $this -> db -> get() -> result_array();
        return $result;
    }

    function get_wall_comments( $id, $offset = 0, $limit = 10 ) {

        $this -> db -> select( "fcmt.*, fcmt.forum_id as poll_id, fcmt.id as comment_id, u.alise as alias" );
        $this -> db -> from( 'forum_comments fcmt' );
        $this -> db -> where_in( 'fcmt.forum_id', $id );
        $this -> db -> where( 'fcmt.is_active', 1 );
        $this -> db -> join( 'users u', 'u.id = fcmt.user_id', 'INNER' );
        $this -> db -> offset( $offset );
        $this -> db -> limit( $limit );
        $this -> db -> order_by( "fcmt.id DESC" );
        $result = $this -> db -> get() -> result_array();

        return $result;
    }

    function add_update_wall( $inputs ) {

        $wall_id = $inputs[ 'id' ];
        $user_id = $inputs[ 'user_id' ];
        $title = $this -> special_character( $inputs[ 'title' ] );
        $topics = $inputs[ 'topics' ];
        $uploaded_filename = $inputs[ 'uploaded_filename' ];

        $preview_json = $inputs[ 'json_data' ];
        $is_topic_change = $inputs[ 'is_topic_change' ];

        if ( $wall_id == 0 ) {

            $insert_array = array (
                "user_id" => $user_id,
                "title" => $title,
                "image" => $uploaded_filename
            );
            if ( $preview_json != "" ) {
                //$insert_array[ 'data' ] = $preview_json;
            }
            $this -> db -> insert( "forums", $insert_array );
            $last_wall_id = $this -> db -> insert_id();

            //Wall topics addition
            foreach ( $topics as $tp ) {
                $topics_insert[] = array (
                    "topic_id" => $tp,
                    "post_id" => $last_wall_id,
                    "title" => $title,
                    "description" => "",
                    "type" => "Wall"
                );
            }
            $this -> db -> insert_batch( 'topic_association', $topics_insert );

            /* Send push notification */
            $fields = array (
                "post_id" => $last_wall_id,
                "title" => "New Discussion wall created",
                "text" => $title,
                "type" => "Discussion",
                "subtype" => "Add",
                "user_id" => $user_id,
                "friend_id" => $user_id,
                "image" => ""
            );
            $this -> notification -> get_ids_and_fields( 0, $fields, $user_id );
            /* Send push notification */

            return TRUE;
        } else {
            $update_array = array (
                "title" => $title,
                "image" => $uploaded_filename
            );

            $this -> db -> where( array ( "id" => $wall_id, "user_id" => $user_id ) );
            $this -> db -> update( "forums", $update_array );

            if ( $is_topic_change != "0" ) {
                //delete all the existing Topics of paricular question
                $this -> db -> where( "post_id = '$wall_id' AND type = 'Wall'" );
                $this -> db -> delete( "topic_association" );

                //Question topics update
                foreach ( $topics as $tp ) {
                    $topics_insert[] = array (
                        "topic_id" => $tp,
                        "post_id" => $wall_id,
                        "title" => $title,
                        "description" => "",
                        "type" => "Wall"
                    );
                }
                $this -> db -> insert_batch( 'topic_association', $topics_insert );
            }
            return TRUE;
        }
    }

    function add_action_mod( $inputs ) {
        $wallid = $inputs[ 'id' ];
        $user_id = $inputs[ 'user_id' ];
        $action_type = $inputs[ 'type' ];

        $wall_like = $wall_dislike = $wall_neutral = 0;

        if ( $action_type == "like" ) {
            $wall_like = 1;
        } elseif ( $action_type == "dislike" ) {
            $wall_dislike = 1;
        } elseif ( $action_type == "neutral" ) {
            $wall_neutral = 1;
        }

        $data = array (
            "forum_id" => $wallid,
            "user_id" => $user_id,
            "likes" => $wall_like,
            "dislikes" => $wall_dislike,
            "neutral" => $wall_neutral,
            "created_date" => date( 'Y-m-d H:i:s' )
        );

        $this -> db -> where( 'forum_id', $wallid );
        $this -> db -> where( 'user_id', $user_id );
        $query = $this -> db -> get( 'forum_action' );
        if ( $query -> num_rows() == 0 ) {
            $this -> db -> insert( 'forum_action', $data );
            $last_action_id = $this -> db -> insert_id();

            /* Send push notification */
            $owner_id = $this -> get_created_by_id( $wallid );
            if ( $owner_id != $user_id ) { //checking own vote
                $fields = array (
                    "post_id" => $wallid,
                    "title" => "Vote on discussion",
                    "text" => "",
                    "type" => "Discussion",
                    "subtype" => "Like",
                    "user_id" => $user_id,
                    "friend_id" => $owner_id,
                    "image" => ""
                );
                $this -> notification -> get_ids_and_fields( $owner_id, $fields, 0 );
            }
            /* Send push notification */
            return $last_action_id;
        } else {
            $update_data = array (
                "likes" => $wall_like,
                "dislikes" => $wall_dislike,
                "neutral" => $wall_neutral
            );
            $this -> db -> where( array ( "forum_id" => $wallid, "user_id" => $user_id ) );
            $this -> db -> update( 'forum_action', $update_data );
            return $wallid;
        }
    }

    function get_created_by_id( $id ) {

        $this -> db -> select( 'f.user_id' );
        $this -> db -> from( 'forums f' );
        $this -> db -> where( "f.id = '$id'" );
        return $this -> db -> get() -> result_array()[ 0 ][ 'user_id' ];
    }

}
