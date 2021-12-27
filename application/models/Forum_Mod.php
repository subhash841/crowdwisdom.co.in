<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Forum_Mod extends CI_Model {

        function __construct() {
                parent::__construct();
        }

        function add_comment_mod( $forumid, $user_id, $forum_comment ) {
                $data = array (
                    "forum_id" => $forumid,
                    "user_id" => $user_id,
                    "comment" => $forum_comment,
                    "is_active" => 1
                );
                $this -> db -> cache_delete_all();
                $this -> db -> insert( 'forum_comments', $data );
                return $this -> db -> insert_id();
        }

        function add_comment_reply_mod( $forumid, $user_id, $forum_comment_reply, $comment_id ) {
                $data = array (
                    "forum_id" => $forumid,
                    "comment_id" => $comment_id,
                    "user_id" => $user_id,
                    "reply" => $forum_comment_reply,
                    "is_active" => 1
                );
                $this -> db -> cache_delete_all();
                $this -> db -> insert( 'forum_comment_reply', $data );
                return $this -> db -> insert_id();
        }

        function add_update_discussion_mod( $input, $user_id ) {
                $forumid = $input[ 'discussion_id' ];
                $forumtopic = $input[ 'forumtopic' ];
                $forumcategory = $input[ 'forumcategory' ];
                $cwimg = $input[ 'cwimg' ];

                $videolink = $input[ 'videolink' ];


                $filename = $_FILES[ 'fileUpload' ][ 'name' ];
                $filetype = $_FILES[ 'fileUpload' ][ 'type' ];
                $tmpname = $_FILES[ 'fileUpload' ][ 'tmp_name' ];
                $filesize = $_FILES[ 'fileUpload' ][ 'size' ];

                if ( $filename != "" ) {
                        $get_ext = explode( ".", $filename );
                        $extension = end( $get_ext );
                        $newfilename = str_replace( " ", "_", $get_ext[ 0 ] ) . time() . "." . $extension;
                        move_uploaded_file( $tmpname, "images/forums/" . $newfilename );
                }
                $this -> db -> cache_delete_all();

                if ( $forumid == "0" ) {
                        $insert = array (
                            "user_id" => $user_id,
                            "category_id" => $forumcategory,
                            "title" => $forumtopic,
                            "image" => $newfilename,
                            "video_link" => $videolink,
                            "is_active" => 1
                        );
                        $this -> db -> insert( "forums", $insert );
                        $addedforumid = $this -> db -> insert_id();
                        return $addedforumid;
                } else {
                        $update = array (
                            "category_id" => $forumcategory,
                            "title" => $forumtopic,
                            "video_link" => $youtubelink,
                            "is_active" => 1
                        );
                        if ( $filename != "" ) {
                                $update[ 'image' ] = $newfilename;
                        }
                        $this -> db -> where( "id = '$forumid'" );
                        $this -> db -> update( "forums", $update );
                        return $forumid;
                }
        }

        function add_forum_action( $forumid, $userid, $type ) {
                $data = array (
                    'forum_id' => $forumid,
                    'user_id' => $userid,
                );
                if ( $type == "like" ) {
                        $data[ 'likes' ] = 1;
                        $data[ 'dislikes' ] = 0;
                        $data[ 'neutral' ] = 0;
                } else if ( $type == "dislike" ) {
                        $data[ 'likes' ] = 0;
                        $data[ 'dislikes' ] = 1;
                        $data[ 'neutral' ] = 0;
                } else if ( $type == "neutral" ) {
                        $data[ 'likes' ] = 0;
                        $data[ 'dislikes' ] = 0;
                        $data[ 'neutral' ] = 1;
                }
                $this -> db -> select( 'id' );
                $this -> db -> where( 'forum_id', $forumid );
                $this -> db -> where( 'user_id', $userid );
                $this -> db -> from( 'forum_action' );
                $result = $this -> db -> get();
                $this -> db -> cache_delete_all();
                if ( $result -> num_rows() > 0 ) {
                        $currentaction = $result -> row_array();
                        $this -> db -> where( 'id', $currentaction[ 'id' ] );
                        $this -> db -> update( 'forum_action', $data );
                        return 0;
                } else {
                        $this -> db -> insert( 'forum_action', $data );
                        return 1;
                }
        }

        function get_forum_by_id( $id, $user_id, $offset = 0, $limit = 10 ) {

                if ( $user_id != 0 ) {
                        $this -> db -> select( "f.*,fc.name as category_name,u.name as byuser" );
                        $this -> db -> select( ",(SELECT count(likes) from forum_action  where forum_id = f.id AND user_id=" . $user_id . " AND likes = 1) as is_like," .
                                "(SELECT count(neutral) from forum_action  where forum_id = f.id AND user_id=" . $user_id . " AND neutral = 1) as is_neutral," .
                                "(SELECT count(dislikes) from forum_action  where forum_id = f.id AND user_id=" . $user_id . " AND dislikes = 1) as is_dislikes," );
                } else {
                        $this -> db -> select( "f.*,fc.name as category_name,u.name as byuser,0 as is_like,0 as is_neutral,0 as is_dislikes" );
                }

                $this -> db -> from( 'forums f' );
                $this -> db -> join( 'forum_category fc', 'fc.id=f.category_id' );
                $this -> db -> join( 'users u', 'u.id=f.user_id' );
                $this -> db -> where( 'f.id', $id );
                $this -> db -> where( 'f.is_active', 1 );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $result = $this -> db -> get();
                $mydiscussion = $result -> row_array();
                return $mydiscussion;
        }

        function get_forum_comments_count( $id, $type ) {

                $this -> db -> select( "count(1) as count" );
                $this -> db -> from( 'forum_comments fcmts' );
                //$this->db->join('forum_action facts', 'facts.user_id=fcmts.user_id AND facts.forum_id=fcmts.forum_id');
                $this -> db -> where( 'fcmts.forum_id', $id );
//        if ($type == "like") {
//            $this->db->where('facts.likes', 1);
//        } else if ($type == "dislike") {
//            $this->db->where('facts.dislikes', 1);
//        } else if ($type == "neutral") {
//            $this->db->where('facts.neutral', 1);
//        } else {
//            
//        }
                $result = $this -> db -> get() -> row_array();
                return $result[ 'count' ];
        }

        function get_comment_by_id( $id ) {
                $this -> db -> select( "*" );
                $this -> db -> from( 'forum_comments' );
                $this -> db -> where( 'id', $id );
                $result = $this -> db -> get() -> row_array();
                return $result;
        }

        function get_comment_reply_by_id( $id ) {
                $this -> db -> select( "*" );
                $this -> db -> from( 'forum_comment_reply' );
                $this -> db -> where( 'id', $id );
                $result = $this -> db -> get() -> row_array();
                return $result;
        }

        function get_forum_comments( $id, $type, $offset = 0, $limit = 10 ) {
                $this -> db -> select( "fcmt.*,u.name as byuser" );
                $this -> db -> from( 'forum_comments fcmt' );
                $this -> db -> where( 'fcmt.forum_id', $id );
                $this -> db -> where( 'fcmt.is_active', 1 );
                $this -> db -> join( 'users u', 'u.id=fcmt.user_id' );
                //$this->db->join('forum_action fact', 'fact.user_id=fcmt.user_id AND fact.forum_id=fcmt.forum_id');
//        if ($type == "like") {
//            $this->db->where('fact.likes', 1);
//            //$this->db->where('fact.forum_id', $id);
//        } else if ($type == "dislike") {
//            $this->db->where('fact.dislikes', 1);
//            //$this->db->where('fact.forum_id', $id);
//        } else if ($type == "neutral") {
//            $this->db->where('fact.neutral', 1);
//            //$this->db->where('fact.forum_id', 1);
//        } else {
//            
//        }
                $this -> db -> order_by( 'fcmt.id', 'DESC' );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $result = $this -> db -> get() -> result_array();



                return $result;
        }

        function get_my_discussions( $user_id, $offset = 0, $limit = 10 ) {
                $this -> db -> select( "f.*,fc.name as category_name,u.name as byuser," .
                        "(SELECT count(likes) from forum_action  where forum_id = f.id AND likes = 1) as total_likes," .
                        "(SELECT count(dislikes) from forum_action  where forum_id = f.id AND dislikes = 1) as total_dislikes," .
                        "(SELECT count(neutral) from forum_action  where forum_id = f.id AND neutral = 1) as total_neutral"
                );
                $this -> db -> from( 'forums f' );
                $this -> db -> join( 'forum_category fc', 'fc.id=f.category_id' );
                $this -> db -> join( 'users u', 'u.id=f.user_id' );
                $this -> db -> where( 'f.user_id', $user_id );
                $this -> db -> where( 'f.is_active', 1 );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $result = $this -> db -> get();
                $mydiscussion = $result -> result_array();
                return $mydiscussion;
        }

        function get_forum_by_category( $category, $offset = 0, $limit = 10 ) {
                $this -> db -> select( "f.*,fc.name as category_name,u.name as byuser," .
                        "(SELECT count(likes) from forum_action  where forum_id = f.id AND likes = 1) as total_likes," .
                        "(SELECT count(dislikes) from forum_action where forum_id = f.id AND dislikes = 1) as total_dislikes," .
                        "(SELECT count(neutral) from forum_action where forum_id = f.id AND neutral = 1) as total_neutral"
                );
                $this -> db -> from( "forums f" );
                $this -> db -> join( "forum_category fc", "fc.id=f.category_id" );
                $this -> db -> join( "users u", "u.id=f.user_id" );
                if ( $category == "All" ) {
                        //$this->db->where("f.category_id", $category);
                } else {
                        $this -> db -> where( "f.category_id", $category );
                }

                $this -> db -> where( "f.is_active", 1 );
                $this -> db -> order_by( 'f.total_like DESC' );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $result = $this -> db -> get();
                $categorydata = $result -> result_array();

                return $categorydata;
        }

        function get_forum_category() {
                $this -> db -> select( 'id,name' );
                $this -> db -> from( 'forum_category' );
                $this -> db -> where( 'is_active', 1 );
                $result = $this -> db -> get();
                return $result -> result_array();
        }

        function get_comment_replies_mod( $forumid, $commentid, $offset = 0, $limit = 5 ) {
                $this -> db -> select( 'fcr.*,u.name as byuser' );
                $this -> db -> where( 'fcr.forum_id', $forumid );
                $this -> db -> where( 'fcr.comment_id', $commentid );
                $this -> db -> where( 'fcr.is_active', 1 );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $this -> db -> from( 'forum_comment_reply fcr' );
                $this -> db -> join( 'users u', 'u.id=fcr.user_id' );
                $this -> db -> order_by( 'id', 'DESC' );
                $result = $this -> db -> get();
                if ( $result -> num_rows() > 0 ) {
                        $replies = $result -> result_array();
                        $response = json_encode( array ( "status" => TRUE, "message" => "replies found", "data" => $replies ) );
                } else {
                        $response = json_encode( array ( "status" => FALSE, "message" => "No replies found" ) );
                }
                return $response;
        }

        function make_deactive_forum( $forumid ) {
                $this -> db -> where( 'id', $forumid );
                $this -> db -> cache_delete_all();
                $this -> db -> update( 'forums', array ( 'is_active' => 0 ) );
                $response = json_encode( array ( "status" => TRUE, "message" => "Deleted successfully" ) );
                echo $response;
                exit;
        }

}
