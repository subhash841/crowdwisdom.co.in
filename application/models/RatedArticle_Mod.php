<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Ratedarticle_Mod extends CI_Model {

        function __construct() {
                parent::__construct();

        }

        function get_article_list( $inputs, $limit = 8 ) {
                $offset = $inputs[ 'offset' ];

                $new_limit = ($offset == 0) ? 8 : (($offset >= 7) ? 7 : 7);

                $this -> db -> select( "a.id, a.user_id, a.topic_id, a.question as title, a.data, COALESCE(a.image,'') as image, a.total_votes, "
                        . "a.total_comments, COALESCE(t.topic,'') as topic" );
                $this -> db -> from( "article a" );
                $this -> db -> join( "topics t", "t.id = a.topic_id", "LEFT" );
                $this -> db -> where( "a.is_active = '1' AND a.is_approved = '1'" );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $new_limit );
                $this -> db -> order_by( "a.id DESC" );
                $result = $this -> db -> get() -> result_array();
                //echo $this -> db -> last_query();exit;

                /* Checking more data available or not - START */
                $is_available = "0";
                if ( count( $result ) >= 7 ) {
                        unset( $result[ count( $result ) - 1 ] );
                        $is_available = "1";
                } else {
                        $is_available = "0";
                }
                /* Checking more data available or not - END */

                $ids = array ();
                foreach ( $result as $key => $article_data ) {
                        $ids[] = $article_data[ 'id' ];

                        if ( $article_data[ 'image' ] == "" ) {
                                $json_data = json_decode( $article_data[ 'data' ], TRUE );
                                $result[ $key ][ 'image' ] = $json_data[ 'img' ];
                        }
                }

                /* Remove Vote counts of prediction - START */
                $counttoberemoved = $this -> remove_vote_counts( $ids );

                for ( $i = 0; $i < count( $result ); $i ++ ) {
                        foreach ( $counttoberemoved as $removeids ) {
                                if ( $removeids[ 'article_id' ] == $result[ $i ][ 'id' ] ) {
                                        $revised_total = $result[ $i ][ 'total_votes' ] - $removeids[ 'count' ];
                                        $result[ $i ][ 'total_votes' ] = "$revised_total";
                                }
                        }
                }

                /* Remove Vote counts of prediction - END */

                $extra_param = ( object ) array ( "total" => "0" );
                return array ( "status" => TRUE, "message" => "", "data" => $result, "extra_param" => $extra_param, "is_available" => $is_available );

        }

        function get_article_detail( $inputs ) {
                $id = $inputs[ 'id' ];
                $user_id = $inputs[ 'user_id' ];

                $this -> db -> select( "a.id, a.user_id, a.topic_id, a.category_id, a.raised_by_admin, a.question as title, a.description, "
                        . "a.preview, a.data, a.url, COALESCE(a.image,'') as image, a.total_votes, a.total_comments, a.created_date,"
                        . "COALESCE(t.topic,'') as topic, COALESCE(aa.choice,'') as users_choice" );
                $this -> db -> from( "article a" );
                $this -> db -> join( "article_action aa", "aa.article_id = a.id AND aa.user_id = '$user_id'", "LEFT" );
                $this -> db -> join( "topics t", "t.id = a.topic_id", "LEFT" );
                $this -> db -> where( "a.id = '$id' AND a.is_active = '1' AND a.is_approved = '1'" );
                $result = $this -> db -> get() -> result_array();

                /* Remove Vote counts of prediction - START */
                $counttoberemoved = $this -> remove_vote_counts( $result[ 0 ][ 'id' ] );

                for ( $i = 0; $i < count( $result ); $i ++ ) {
                        if ( $counttoberemoved[ 'article_id' ] == $result[ $i ][ 'id' ] ) {
                                $revised_total = $result[ $i ][ 'total_votes' ] - $counttoberemoved[ 'count' ];
                                $result[ $i ][ 'total_votes' ] = "$revised_total";
                        }
                }

                //get the options of prediction
                $result[ 0 ][ 'options' ] = $this -> get_article_options( $id );

                $extra_param = ( object ) array ();
                return array ( "status" => TRUE, "message" => "", "data" => $result, "extra_param" => $extra_param, "is_available" => "" );

        }

        function get_article_options( $article_id ) {
                $this -> db -> select( "ac.id, ac.choice, ac.type" );
                $this -> db -> from( "article_choices ac" );
                $this -> db -> where( "ac.article_id = '$article_id'" );
                $result = $this -> db -> get() -> result_array();

                return $result;

        }

        function remove_vote_counts( $id ) {
                $arr = true;

                if ( ! is_array( $id ) ) {
                        $arr = false;
                        $id = array ( $id );
                }
                $id = implode( ',', $id );
                $query = "select COUNT(1) count, aa.article_id 
                        from article_action aa 
                        INNER JOIN article_choices ac on ac.type = '0'
                        WHERE aa.article_id in ($id) AND aa.choice = ac.id group by article_id";
                if ( $arr ) {
                        $result = $this -> db -> query( $query ) -> result_array();
                } else {
                        $result = $this -> db -> query( $query ) -> row_array();
                }

                //See the results counts should not be calculated
                return $result;

        }

        function get_answered_articles( $inputs, $limit = 11 ) {

                $offset = $inputs[ 'offset' ];
                $user_id = $inputs[ 'user_id' ];

                //$new_limit = ($offset == 0) ? 8 : (($offset >= 7) ? 7 : 7);

                $this -> db -> select( "a.id, a.topic_id, a.question as title, COALESCE(a.image,'') as image, a.total_votes, a.total_comments, "
                        . "COALESCE(t.topic,'') as topic" );
                $this -> db -> from( "article_action aa" );
                $this -> db -> join( "article a", "a.id = aa.article_id", "LEFT" );
                $this -> db -> join( "topics t", "t.id = a.topic_id", "LEFT" );
                $this -> db -> where( "aa.user_id = '$user_id'" );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $result = $this -> db -> get() -> result_array();

                /* Checking more data available or not - START */
                $is_available = "0";
                if ( count( $result ) >= 10 ) {
                        unset( $result[ count( $result ) - 1 ] );
                        $is_available = "1";
                } else {
                        $is_available = "0";
                }
                /* Checking more data available or not - END */

                $ids = array ();
                foreach ( $result as $article_data ) {
                        $ids[] = $article_data[ 'id' ];
                }

                /* Remove Vote counts of prediction - START */
                $counttoberemoved = $this -> remove_vote_counts( $ids );

                for ( $i = 0; $i < count( $result ); $i ++ ) {
                        foreach ( $counttoberemoved as $removeids ) {
                                if ( $removeids[ 'article_id' ] == $result[ $i ][ 'id' ] ) {
                                        $revised_total = $result[ $i ][ 'total_votes' ] - $removeids[ 'count' ];
                                        $result[ $i ][ 'total_votes' ] = "$revised_total";
                                }
                        }
                }

                /* Remove Vote counts of prediction - END */

                $extra_param = ( object ) array ( "total" => "0" );
                return array ( "status" => TRUE, "message" => "", "data" => $result, "extra_param" => $extra_param, "is_available" => $is_available );

        }

        function add_update_article( $inputs ) {

                $user_id = $inputs[ 'user_id' ];
                $articleid = $inputs[ 'articleid' ];
                $title = $this -> special_character( $inputs[ 'title' ] );
                $description = $this -> special_character( $inputs[ 'description' ] );
                $choices = $inputs[ 'choices' ];
                $preview = htmlspecialchars( $inputs[ 'article_preview' ] );
                $preview_json = $inputs[ 'json_data' ];

                $uploaded_filename = $inputs[ 'uploaded_filename' ];

                if ( $articleid == 0 ) {

                        $insert_array = array (
                            "user_id" => $user_id,
                            "question" => $title,
                            "description" => $description,
                            "image" => $uploaded_filename,
                            "category_id" => 0,
                            "preview" => $preview,
                            "is_active" => 1,
                        );

                        if ( $preview_json != "" ) {
                                $insert_array[ 'data' ] = $preview_json;
                        }

                        $this -> db -> insert( "article", $insert_array );
                        $last_article_id = $this -> db -> insert_id();

                        //Prediction choices addition
                        foreach ( $choices as $ch ) {
                                $choice_type = ($ch == "Click to see Rating") ? "0" : "1";
                                $choice_insert[] = array (
                                    "article_id" => $last_article_id,
                                    "choice" => $this -> special_character( $ch ),
                                    "type" => $choice_type
                                );
                        }
                        $this -> db -> insert_batch( 'article_choices', $choice_insert );
                        return TRUE;
                } else {
                        $update_array = array (
                            "question" => $title,
                            "description" => $description,
                            "image" => $uploaded_filename
                        );

                        $this -> db -> where( array ( "id" => $articleid, "user_id" => $user_id ) );
                        $this -> db -> update( "survey", $update_array );
                        return TRUE;
                }

        }

        function special_character( $string ) {
                $string = str_replace( "'", "&#039;", $string );
                $string = str_replace( '"', '&#039;', $string );
                return $string;

        }

        /* Home page Trending Articles */

        function get_trending_article_list( $user_id, $offset = 0, $limit = 10 ) {

                $this -> db -> select( "group_concat(a.id) as ids" );
                $this -> db -> from( "article a" );
                $this -> db -> where( "a.created_date >= now() - INTERVAL 1 hour" );
                $result = $this -> db -> get() -> row_array();

                $ids = $result[ 'ids' ];

                $latestfirst_cond = "";
                if ( $ids != "" ) {
                        $latestfirst_cond = "FIELD(id,$ids) DESC, ";
                }

                $archive = $this -> get_archive_article();
                $archive_ids = "";
                if ( ! empty( $archive ) ) {
                        foreach ( $archive as $archive_data ) {
                                $archive_ids .= $archive_data[ 'id' ] . ",";
                        }
                        $archive_ids = chop( $archive_ids, ',' );
                        $archive_ids = " AND a.id not in ($archive_ids)";
                }

                $fetcharticlelist = "SELECT *, (positive_count + negative_count) as total, 
            COALESCE((round((positive_count / (positive_count + negative_count))*100)),0) as positive_percent,
            COALESCE((round((negative_count / (positive_count + negative_count))*100)),0) as negative_percent,
            CASE WHEN (COALESCE((round((negative_count / (positive_count + negative_count))*100)),0) > 30) THEN 1 ELSE 0 END as in_negative, 
            (positive_count - negative_count) as average_total

            FROM 
            (
                SELECT a.*, u.alise as byuser, GROUP_CONCAT(ac.id SEPARATOR '|') as choice_id, GROUP_CONCAT(ac.choice SEPARATOR '|') as choice, 
                (CASE WHEN a.created_date >= (now() - interval 1 hour) THEN 1 ELSE 0 END) as is_new,
                (
                    SELECT choice from article_action where article_id = a.id AND action = 'Vote' AND user_id = '$user_id'
                ) as user_choice,
                (
                    SELECT COUNT(1) FROM article_action aa WHERE aa.article_id = a.id AND choice in (SELECT id FROM 	
                    article_choices 
                    WHERE choice in ('One of the best Ads I have Seen','I like this Ad, Will buy','I like this Ad, Will Consider, May Not Buy','I like this Ad, nothing more') AND 
                    article_id = a.id)
                ) as positive_count, 
                (
                    SELECT COUNT(1) FROM article_action aa WHERE aa.article_id = a.id AND choice in (SELECT id FROM 
                    article_choices 
                    WHERE choice NOT IN ('One of the best Ads I have Seen','I like this Ad, Will buy','I like this Ad, Will Consider, May Not Buy','I like this Ad, nothing more', 
                    'Click to see Rating','None of the above') AND 
                    article_id = a.id)
                ) as negative_count

                FROM article a 
                INNER JOIN article_choices ac ON ac.article_id = a.id 
                LEFT JOIN users u ON u.id = a.user_id
                WHERE a.is_active = '1' $archive_ids
                GROUP BY a.id
            ) as article
            ORDER BY $latestfirst_cond in_negative ASC, average_total DESC
            Limit $offset,$limit";

                $article_data = $this -> db -> query( $fetcharticlelist ) -> result_array();

                $ids = array ();
                foreach ( $article_data as $key => $data ) {
                        $id = $data[ 'id' ];
                        $ids[] = $id;

                        $total_votes = $data[ 'total_votes' ];
                        $article_data[ $key ][ 'options' ] = $this -> calculateavgvotes( $id, $total_votes );
                        $article_data[ $key ][ 'All_comments' ] = $this -> get_article_comments( $id, 0, 2 );
                        $article_data[ $key ][ 'total_comments' ] = $this -> get_article_comments_count( $id, 'All' );

                        $article_data[ $key ][ 'data' ] = json_decode( $article_data[ $key ][ 'data' ] );

                        if ( $data[ 'image' ] == "" ) {
                                $json_data = json_decode( $data[ 'data' ], TRUE );
                                $article_data[ $key ][ 'image' ] = $json_data[ 'img' ];
                        } else {
                                $article_data[ $key ][ 'image' ] = base_url( "/images/relatedarticle/" . $data[ 'image' ] );
                        }
                        //$counttoberemoved = $this -> remove_votes_count( $id );
                        //$article_data[ $key ][ 'total_votes' ] = $article_data[ $key ][ 'total_votes' ] - $counttoberemoved;
                }

                if ( ! empty( $ids ) ) {
                        /* Remove Vote counts of prediction - START */
                        $counttoberemoved = $this -> remove_vote_counts( $ids );

                        for ( $i = 0; $i < count( $result ); $i ++ ) {
                                foreach ( $counttoberemoved as $removeids ) {
                                        if ( $removeids[ 'article_id' ] == $result[ $i ][ 'id' ] ) {
                                                $revised_total = $result[ $i ][ 'total_votes' ] - $removeids[ 'count' ];
                                                $result[ $i ][ 'total_votes' ] = "$revised_total";
                                        }
                                }
                        }

                        /* Remove Vote counts of prediction - END */
                }

                return $article_data;

        }

        function get_archive_article( $offset = 0, $limit = 10, $section = "" ) {
                $this -> db -> select( "a.*" );
                $this -> db -> from( "article a" );
                $this -> db -> where( "a.is_active = '1' AND a.created_date <= now() - INTERVAL 24 hour" );
                if ( $section != "" ) {
                        $this -> db -> offset( $offset );
                        $this -> db -> limit( $limit );
                }
                $result = $this -> db -> get() -> result_array();

                $ids = array ();
                foreach ( $result as $key => $articledata ) {
                        $id = $articledata[ 'id' ];
                        $ids[] = $id;
                        //$counttoberemoved = $this -> remove_votes_count( $id );

                        $result[ $key ][ 'data' ] = json_decode( $result[ $key ][ 'data' ] );

                        if ( $articledata[ 'image' ] == "" ) {
                                $json_data = json_decode( $articledata[ 'data' ], TRUE );
                                $result[ $key ][ 'image' ] = $json_data[ 'img' ];
                        }
                        //$result[ $key ][ 'total_votes' ] = $result[ $key ][ 'total_votes' ] - $counttoberemoved;
                }

                /* Remove Vote counts of prediction - START */
                $counttoberemoved = $this -> remove_vote_counts( $ids );

                for ( $i = 0; $i < count( $result ); $i ++ ) {
                        foreach ( $counttoberemoved as $removeids ) {
                                if ( $removeids[ 'article_id' ] == $result[ $i ][ 'id' ] ) {
                                        $revised_total = $result[ $i ][ 'total_votes' ] - $removeids[ 'count' ];
                                        $result[ $i ][ 'total_votes' ] = "$revised_total";
                                }
                        }
                }

                /* Remove Vote counts of prediction - END */

                return $result;

        }

        function calculateavgvotes( $id, $total_votes ) {
                $this -> db -> select( 'count(1) as actualvotes' );
                $this -> db -> from( 'article_action pa' );
                $this -> db -> join( 'article_choices polc', 'polc.id=pa.choice', 'Inner' );
                $this -> db -> where( 'pa.article_id', $id );
                $this -> db -> where( 'polc.choice !=', "Click to see Rating" );
                $donknw = $this -> db -> get() -> row_array();
                $total_votes = $donknw[ 'actualvotes' ];

                $this -> db -> select( 'pc1.id as choice_id,pc1.choice' );
                $this -> db -> from( 'article_choices pc1' );
                $this -> db -> where( 'pc1.article_id', $id );
                $this -> db -> group_by( 'pc1.id' );
                $choices = $this -> db -> get() -> result_array();

                $ch_ids = "";
                foreach ( $choices as $key => $c1 ) {
                        $ch_ids .= $c1[ 'choice_id' ] . ",";
                }
                $ch_ids = chop( $ch_ids, "," );

                $this -> db -> select( 'count(1) as total,choice' );
                $this -> db -> from( 'article_action' );
                $this -> db -> where( "choice in ($ch_ids)" );
                $this -> db -> where( 'article_id', $id );
                $this -> db -> group_by( "choice" );
                $resultcount = $this -> db -> get();
                $count_array = $resultcount -> result_array();

                foreach ( $choices as $key => $c1 ) {

                        $choices[ $key ][ 'total' ] = 0;
                        foreach ( $count_array as $count_data ) {
                                if ( $choices[ $key ][ 'choice_id' ] == $count_data[ 'choice' ] ) {
                                        $choices[ $key ][ 'total' ] = $count_data[ 'total' ];
                                }
                        }

                        $sum = 0;
                        if ( $total_votes > 0 ) {
                                $sum = $choices[ $key ][ 'total' ] / $total_votes;
                        }

                        if ( $c1[ 'choice' ] != "Click to see Rating" ) {
                                $avg = $sum;
                                $avg = $avg * 100;
                                if ( $avg != 100 && $avg != 0 ) {
                                        $avg = number_format( $avg, 1, '.', '' );
                                }

                                $choices[ $key ][ 'avg' ] = $avg;
                        } else {
                                $choices[ $key ][ 'avg' ] = 0;
                        }
                }

                return $choices;

        }

        function get_article_comments( $id, $offset = 0, $limit = 10 ) {

                $this -> db -> select( "pcmt.*,u.alise as byuser" );
                $this -> db -> from( 'article_comments pcmt' );
                $this -> db -> where( 'pcmt.article_id', $id );
                $this -> db -> where( 'pcmt.is_active', 1 );
                $this -> db -> join( 'users u', 'u.id=pcmt.user_id' );

                $this -> db -> order_by( 'pcmt.id', 'DESC' );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $result = $this -> db -> get() -> result_array();
                //echo $this->db->last_query();exit;
                return $result;

        }

        function get_article_comments_count( $id, $type ) {

                $this -> db -> select( "count(1) as count" );
                $this -> db -> from( 'article_comments pcmts' );
                $this -> db -> where( 'pcmts.article_id', $id );
                $this -> db -> where( 'pcmts.is_active', 1 );
                $result = $this -> db -> get() -> row_array();
                return $result[ 'count' ];

        }

}
