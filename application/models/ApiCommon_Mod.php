<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ApiCommon_Mod extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function searchForId( $id, $result ) {
        foreach ( $result as $key => $data ) {
            if ( $id == $data[ 'id' ] ) {
                return $key;
            }
        }
        return null;
    }

    function get_followed_topics( $user_id = 0 ) {
        $result = array ();
        if ( $user_id > 0 ) {
            $this -> db -> select( "utf.topic_id" );
            $this -> db -> from( "users_followed_topics utf" );
            $this -> db -> where( "utf.user_id = '$user_id' AND utf.is_follow = '1'" );
            $result = $this -> db -> get() -> result_array();
        }

        return $result;
    }

    function get_topics_list( $inputs, $limit = 11 ) {
        $user_id = $inputs[ 'user_id' ];
        $offset = $inputs[ 'offset' ];

        //check users following topics
        $followed_result = $this -> get_followed_topics( $user_id );

        /* Get Trending Topic - START */
        $this -> db -> select( "t.id, t.topic, t.image, t.icon" );
        $this -> db -> from( "topics t" );
        $this -> db -> where( "t.is_active = '1' AND is_trending = '1'" );
        $this -> db -> order_by( "modified_date DESC" );
        $trending_topic_result = $this -> db -> get() -> result_array();
        /* Get Trending Topic - END */

        $follow_column = "";
        $follow_order = "";
        if ( ! empty( $followed_result ) ) {
            $follow_column = ", COALESCE(utf.is_follow,0) as is_follow";
            $follow_order = " is_follow DESC, ";
        }

        $this -> db -> select( "t.id, t.topic, t.image, t.icon $follow_column" );
        $this -> db -> from( "topics t" );
        if ( ! empty( $followed_result ) ) {
            $this -> db -> join( "users_followed_topics utf", "utf.topic_id = t.id AND utf.user_id = '$user_id' AND utf.is_follow = '1'", "INNER" );
        }
        $this -> db -> where( "t.is_active = '1'" );
        $this -> db -> order_by( "$follow_order t.id DESC" );
        $this -> db -> offset( $offset );
        $this -> db -> limit( $limit );
        $result = $this -> db -> get() -> result_array();

        if ( count( $result ) > 10 ) {
            unset( $result[ count( $result ) - 1 ] );
            $is_available = "1";
        } else {
            $is_available = "0";
        }

        /* Duplicate entries remove */
        foreach ( $trending_topic_result as $key => $trending_topic_data ) {
            $ky = $this -> searchForId( $trending_topic_data[ 'id' ], $result );
            if ( $ky !== null ) {
                unset( $result[ $ky ] );
            }
        }

        if ( $offset == 0 ) {
            $result = array_merge( $trending_topic_result, $result );
        }

        //$result = array_map( "unserialize", array_unique( array_map( "serialize", $result ) ) );

        foreach ( $result as $key => $topic_data ) {
            if ( ! isset( $topic_data[ 'is_follow' ] ) ) {
                $topic_data[ 'is_follow' ] = 0;
            }
            $result[ $key ][ 'is_follow' ] = ( int ) $topic_data[ 'is_follow' ];
        }

        return array ( "status" => TRUE, "message" => "", "data" => array_values( $result ), "is_available" => $is_available );
    }

    function get_searched_topics( $inputs ) {
        $user_id = $inputs[ 'user_id' ];
        $topic = $inputs[ 'topic' ];

        $topic_cond = "";
        if ( $topic != "" ) {
            $topic_cond = "AND t.topic like '%$topic%'";
        }
        $this -> db -> select( "t.id, t.topic, t.icon" );
        $this -> db -> from( "topics t" );
        $this -> db -> where( "t.is_active = '1' $topic_cond" );
        $this -> db -> order_by( "t.id DESC" );
        $result = $this -> db -> get() -> result_array();

        return array ( "status" => TRUE, "message" => "", "data" => $result );
    }

    function follow_topic( $inputs ) {
        $user_id = $inputs[ 'user_id' ];
        $topic_id = $inputs[ 'topic_id' ];
        $is_follow = filter_var( $inputs[ 'is_follow' ], FILTER_VALIDATE_BOOLEAN ) ? 1 : 0;

        /* Check follow exists */
        $this -> db -> select( "1" );
        $this -> db -> from( "users_followed_topics uft" );
        $this -> db -> where( array ( "user_id" => $user_id, "topic_id" => $topic_id ) );
        $result = $this -> db -> get();
        $is_exists = $result -> num_rows();

        if ( $is_exists == 0 ) {
            $insert_array = array (
                "user_id" => $user_id,
                "topic_id" => $topic_id,
                "is_follow" => $is_follow
            );
            $this -> db -> insert( "users_followed_topics", $insert_array );

            return array ( "status" => TRUE, "message" => "Topic followed successfully", "is_follow" => $is_follow, "data" => ( object ) array () );
        } else {
            $update_array = array (
                "is_follow" => $is_follow
            );
            $this -> db -> where( array ( "user_id" => $user_id, "topic_id" => $topic_id ) );
            $this -> db -> update( "users_followed_topics", $update_array );

            $message = ($is_follow) ? "Topic followed sucessfully" : "Topic unfollowed sucessfully";
            return array ( "status" => TRUE, "message" => $message, "is_follow" => $is_follow, "data" => ( object ) array () );
        }
    }

    function get_nofitication_list( $inputs, $limit = 11 ) {
        $user_id = $inputs[ 'user_id' ];

        $this -> db -> select( "n.id, n.own_id, n.post_id, n.title, n.text, n.type, n.subtype, n.image, n.comment_id, n.alias, n.comment, n.created_date" );
        $this -> db -> from( "notifications n" );
        $this -> db -> where( "n.is_active = '1' AND n.own_id = '$user_id'" );
        $this -> db -> order_by( "n.id DESC" );
        $result = $this -> db -> get() -> result_array();

        if ( count( $result ) > 10 ) {
            unset( $result[ count( $result ) - 1 ] );
            $is_available = "1";
        } else {
            $is_available = "0";
        }

        return array ( "status" => TRUE, "message" => "", "data" => $result, "is_available" => $is_available );
    }

}
