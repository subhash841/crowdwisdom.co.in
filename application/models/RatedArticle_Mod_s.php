<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RatedArticle_Mod_s extends CI_Model {

        protected $choicepoints = 0;

        function __construct() {
                parent::__construct();
                $this -> choicepoints = 500;

        }

        /*
         * param articleid is a article for which comment is done
         * param user_id if a user from which comment is done
         * param article_comment is a text for commment
         * param article_cmt is a id of comment if you want to edit comment

         */

        function add_comment_mod( $articleid, $user_id, $article_comment, $article_cmt ) {
                $data = array (
                    "article_id" => $articleid,
                    "user_id" => $user_id,
                    "comment" => $article_comment,
                    "is_active" => 1,
                    "created_date" => date( 'Y-m-d H:i:s' )
                );
                $this -> db -> cache_delete_all();
                if ( $article_cmt == 0 ) {
                        $this -> db -> insert( 'article_comments', $data );
                        return $this -> db -> insert_id();
                } else {
                        $this -> db -> where( 'id', $article_cmt );
                        $this -> db -> update( 'article_comments', $data );
                        return $article_cmt;
                }

        }

        /*
         * param articleid is a article for which comment reply is done
         * param user_id if a user from which comment is done
         * param article_comment_reply is a text for commment reply
         * param comment_id is a id of comment for which reply is done
         */

        function add_comment_reply_mod( $articleid, $user_id, $article_comment_reply, $comment_id ) {
                $data = array (
                    "article_id" => $articleid,
                    "comment_id" => $comment_id,
                    "user_id" => $user_id,
                    "reply" => $article_comment_reply,
                    "is_active" => 1,
                    "created_date" => date( 'Y-m-d H:i:s' )
                );
                $this -> db -> cache_delete_all();
                $this -> db -> insert( 'article_comment_reply', $data );
                return $this -> db -> insert_id();

        }

        /*

         * param input is array of post param includes 
          -article_id -> article is a id of that article

         * param user_id if a user from which comment is done
         * param article_comment_reply is a text for commment reply
         * param comment_id is a id of comment for which reply is done

         */

        function add_update_article_mod( $input, $user_id ) {

                $articleid = $input[ 'article_id' ];
                $articletopic = $this -> special_character( $input[ 'articletopic' ] );
                //$articlecategory = $input['articlecatergory'];
                //$link = $input['detailurl'];
                $link = "";
                $choiceoption = $input[ 'choice' ];
                $articledescription = $this -> special_character( $input[ 'articledescription' ] );
                $preview = htmlspecialchars( $input[ 'article_preview' ] );
                //$enddate = date('Y-m-d', strtotime($input['enddate']));
                $choiceoption = array_filter( $choiceoption );

                $filename = $_FILES[ 'fileUpload' ][ 'name' ];
                $filetype = $_FILES[ 'fileUpload' ][ 'type' ];
                $tmpname = $_FILES[ 'fileUpload' ][ 'tmp_name' ];
                $filesize = $_FILES[ 'fileUpload' ][ 'size' ];

                $newfilename = "";
                if ( $filename != "" ) {
                        $get_ext = explode( ".", $filename );
                        $extension = end( $get_ext );
                        $newfilename = str_replace( " ", "_", $get_ext[ 0 ] ) . time() . "." . $extension;
                        move_uploaded_file( $tmpname, "images/relatedarticle/" . $newfilename );
                }

                $this -> db -> cache_delete_all();
                if ( $articleid == "0" ) {
                        $insert = array (
                            "user_id" => $user_id,
                            "category_id" => 0,
                            'description' => $articledescription,
                            "question" => $articletopic,
                            "url" => $link,
                            "preview" => $preview,
                            "is_active" => 1,
                            "image" => $newfilename,
                                //"end_date" => $enddate,
                                //"created_date" => date('Y-m-d H:i:s')
                        );

                        if ( $input[ 'json_data' ] != "" ) {
                                $insert[ 'data' ] = $input[ 'json_data' ];
                        }

                        $this -> db -> insert( "article", $insert );

                        $addedarticleid = $this -> db -> insert_id();
                        foreach ( $choiceoption as $co ) {
                                $choiceinsert[] = array (
                                    "article_id" => $addedarticleid,
                                    "choice" => $this -> special_character( $co ),
                                    "is_active" => 1,
                                );
                        }
//            $staticvalue1[] = array(
//                "article_id" => $addedarticleid,
//                "choice" => "See the Results",
//                "is_active" => 1,
//            );
//            $staticvalue2[] = array(
//                "article_id" => $addedarticleid,
//                "choice" => "None of the above",
//                "is_active" => 1,
//            );
//            $staticvalue = array_merge($staticvalue1, $staticvalue2);
//            $choiceinsert = array_merge($choiceinsert, $staticvalue);

                        $this -> db -> insert_batch( 'article_choices', $choiceinsert );

//            $points = array(
//                'article_id' => $addedarticleid,
//                'user_id' => $user_id,
//                'choice' => 0,
//                'points' => $this->choicepoints,
//                'category_id' => 0,
//                'action' => 'Article Raised'
//            );
//           $this->db->insert("article_action", $points);
//            $this->db->set('unearned_points', "unearned_points-$this->choicepoints", FALSE);
//            $this->db->where("id", $user_id);
//            $this->db->update('users');
//            $sessiondata = $this->session->userdata('data');
//            $_SESSION['data']['silver_points'] = $sessiondata['silver_points'] - 500;

                        return $addedarticleid;
                } else {

                        $update = array (
                            "category_id" => 0,
                            "question" => $articletopic,
                            'description' => $articledescription,
                            "url" => $link,
                            "is_active" => 1,
                            "is_approved" => 1,
                            "total_votes" => 0,
                            "total_comments" => 0,
                            "preview" => $preview
                                //"end_date" => $enddate,
                        );
                        if ( $input[ 'json_data' ] != "" ) {
                                $update[ 'data' ] = $input[ 'json_data' ];
                        }

                        if ( $newfilename != "" ) {
                                $update[ 'image' ] = $newfilename;
                        }

                        $this -> db -> where( "id = '$articleid'" );
                        $this -> db -> update( "article", $update );
                        /* this will delete related choices,votes and comments and comment_reply after update */
                        $this -> db -> where( 'article_id', $articleid );
                        $this -> db -> delete( 'article_choices' );

                        $this -> db -> where( 'article_id', $articleid );
                        $this -> db -> where( 'action', 'Vote' );
                        $this -> db -> delete( 'article_action' );

                        $this -> db -> where( 'article_id', $articleid );
                        $this -> db -> delete( 'article_comments' );

                        $this -> db -> where( 'article_id', $articleid );
                        $this -> db -> delete( 'article_comment_reply' );


                        foreach ( $choiceoption as $co ) {
                                $choiceinsert[] = array (
                                    "article_id" => $articleid,
                                    "choice" => $this -> special_character( $co ),
                                    "is_active" => 1,
                                );
                        }
//            $staticvalue1[] = array(
//                "article_id" => $articleid,
//                "choice" => "See the Results",
//                "is_active" => 1,
//            );
//            $staticvalue2[] = array(
//                "article_id" => $articleid,
//                "choice" => "None of the above",
//                "is_active" => 1,
//            );
//            $staticvalue = array_merge($staticvalue1, $staticvalue2);
//            $choiceinsert = array_merge($choiceinsert, $staticvalue);
                        $this -> db -> insert_batch( 'article_choices', $choiceinsert );

                        return $articleid;
                }

        }

        function add_article_action( $forumid, $userid, $type ) {
                $data = array (
                    'article_id' => $forumid,
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
                $this -> db -> where( 'article_id', $forumid );
                $this -> db -> where( 'user_id', $userid );
                $this -> db -> from( 'article_action' );
                $result = $this -> db -> get();
                $this -> db -> cache_delete_all();
                if ( $result -> num_rows() > 0 ) {
                        $currentaction = $result -> row_array();
                        $this -> db -> where( 'id', $currentaction[ 'id' ] );
                        $this -> db -> update( 'article_action', $data );
                        return 0;
                } else {
                        $this -> db -> insert( 'article_action', $data );
                        return 1;
                }

        }

        function get_article_by_id( $id, $user_id, $offset = 0, $limit = 10 ) {
                $this -> db -> select( "p.*,u.alise as byuser,GROUP_CONCAT(pc1.id) as choice_id,"
                        . "GROUP_CONCAT(pc1.choice) as choice,(SELECT choice from article_action  where article_id = p.id AND  action= 'Vote' AND user_id=" . $user_id . ") as user_choice" );
                $this -> db -> from( 'article p' );

                $this -> db -> join( 'article_choices pc1', 'pc1.article_id=p.id' );
                $this -> db -> join( 'users u', 'u.id=p.user_id', "LEFT" );
                $this -> db -> where( 'p.id', $id );
                $this -> db -> where( 'p.is_active', 1 );
                $this -> db -> where( 'p.is_approved', 1 );
                //$this->db->where('date(p.end_date)>="'.date('Y-m-d').'"');
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $result = $this -> db -> get();


                $mydiscussion = $result -> row_array();
                $data = array ();
                if ( $mydiscussion[ 'id' ] != "" ) {
                        $id = $mydiscussion[ 'id' ];
                        $total_votes = $mydiscussion[ 'total_votes' ];

                        $mydiscussion[ 'options' ] = $this -> calculateavgvotes( $id, $total_votes );
                        $mydiscussion[ 'All_comments' ] = $this -> get_article_comments( $id, 0, 2 );
                        $mydiscussion[ 'total_comments' ] = $this -> get_article_comments_count( $id, 'All' );

                        //$article_id = $mydiscussion['id'];
                        //get the total count to be subtracted of "See the Results" Option
                        $counttoberemoved = $this -> remove_votes_count( $id );
                        $mydiscussion[ 'total_votes' ] = $mydiscussion[ 'total_votes' ] - $counttoberemoved;
                } else {
                        $mydiscussion[ 'options' ] = array ();
                        $mydiscussion[ 'All_comments' ] = array ();
                        $mydiscussion[ 'total_comments' ] = array ();
                        $mydiscussion[ 'total_votes' ] = 0;
                }

                $data = $mydiscussion;
                return $mydiscussion;

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

        function get_article_comments_count( $id, $type ) {

                $this -> db -> select( "count(1) as count" );
                $this -> db -> from( 'article_comments pcmts' );
                //$this->db->join('article_action facts', 'facts.user_id=fcmts.user_id AND facts.article_id=fcmts.article_id');
                $this -> db -> where( 'pcmts.article_id', $id );
                $this -> db -> where( 'pcmts.is_active', 1 );
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
                $this -> db -> from( 'article_comments' );
                $this -> db -> where( 'id', $id );
                $this -> db -> where( 'is_active', 1 );
                $result = $this -> db -> get() -> row_array();
                return $result;

        }

        function get_comment_reply_by_id( $id ) {
                $this -> db -> select( "*" );
                $this -> db -> from( 'article_comment_reply' );
                $this -> db -> where( 'id', $id );
                $result = $this -> db -> get() -> row_array();
                return $result;

        }

        function get_article_comments( $id, $offset = 0, $limit = 10 ) {

                $this -> db -> select( "pcmt.*,u.alise as byuser" );
//                . "IFNULL(pcl.is_like, 0) as userlike");
                $this -> db -> from( 'article_comments pcmt' );
                $this -> db -> where( 'pcmt.article_id', $id );
                $this -> db -> where( 'pcmt.is_active', 1 );
                $this -> db -> join( 'users u', 'u.id=pcmt.user_id' );
                //$this->db->join('article_comment_likes pcl', 'pcl.comment_id=pcmt.id AND pcl.user_id=pcmt.user_id', 'LEFT');
                //$this->db->join('article_action fact', 'fact.user_id=fcmt.user_id AND fact.article_id=fcmt.article_id');
//        if ($type == "like") {
//            $this->db->where('fact.likes', 1);
//            //$this->db->where('fact.article_id', $id);
//        } else if ($type == "dislike") {
//            $this->db->where('fact.dislikes', 1);
//            //$this->db->where('fact.article_id', $id);
//        } else if ($type == "neutral") {
//            $this->db->where('fact.neutral', 1);
//            //$this->db->where('fact.article_id', 1);
//        } else {
//            
//        }
                $this -> db -> order_by( 'pcmt.id', 'DESC' );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $result = $this -> db -> get() -> result_array();
                //echo $this->db->last_query();exit;


                return $result;

        }

        function get_my_article( $user_id, $offset = 0, $limit = 10 ) {
                $this -> db -> select( "p.*,u.alise as byuser,GROUP_CONCAT(pc1.id) as choice_id,"
                        . "GROUP_CONCAT(pc1.choice) as choice,(SELECT choice from article_action  where article_id = p.id AND action= 'Vote' AND user_id=" . $user_id . ") as user_choice"
//                .",pa.choice as user_choice"
//                ."(SELECT count(likes) from article_action  where article_id = f.id AND likes = 1) as total_likes,"
//                ."(SELECT count(dislikes) from article_action  where article_id = f.id AND dislikes = 1) as total_dislikes,"
//                ."(SELECT count(neutral) from article_action  where article_id = f.id AND neutral = 1) as total_neutral"
                );
                $this -> db -> from( 'article p' );
                $this -> db -> join( 'article_choices pc1', 'pc1.article_id=p.id' );
                //$this->db->join('article_action pa', 'pa.article_id=p.id AND pa.user_id='.$user_id.'');
                $this -> db -> join( 'users u', 'u.id=p.user_id', "LEFT" );
                $this -> db -> where( 'p.user_id', $user_id );
                $this -> db -> where( 'p.is_active', 1 );
                $this -> db -> where( 'date(p.end_date)>="' . date( 'Y-m-d' ) . '"' );
                //$this->db->where('p.is_approved', 1);
                $this -> db -> group_by( 'p.id' );
                $this -> db -> order_by( 'p.id', 'DESC' );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $result = $this -> db -> get();
                $myarticle = $result -> result_array();

                foreach ( $myarticle as $key => $mp ) {
                        $id = $mp[ 'id' ];
                        $total_votes = $mp[ 'total_votes' ];

                        $myarticle[ $key ][ 'options' ] = $this -> calculateavgvotes( $id, $total_votes );
                        //var_dump($total_votes);exit;
                }

                return $myarticle;

        }

        function get_trending_by_category( $category, $user_id, $offset = 0, $limit = 10 ) {

                if ( ! empty( $this -> input -> get() ) ) {
                        $articleid = $this -> input -> get( 'pid' );
                }
                /* if you want to add trending by 4 hours */
                if ( is_numeric( $category ) ) {
                        $newcategory = $category;
                } else {
                        $newcategory = 1;
                }

                /* Get highest voted articles in Last 4 hours - START */
                $fourhourvotedids = "";

                $this -> db -> select( "sa.article_id, count(1) as max_votes" );
                $this -> db -> from( "article_action sa" );
                $this -> db -> where( "(now() - interval 4 hour <= sa.created_date) AND sa.action= 'Vote'" );
                $this -> db -> group_by( "sa.article_id" );
                $this -> db -> order_by( "max_votes ASC" );
                $this -> db -> order_by( "sa.article_id ASC" );
                $result = $this -> db -> get();
                $last_four_hour_max_voted = $result -> result_array();
                //echo $this->db->last_query();exit;

                foreach ( $last_four_hour_max_voted as $four_hour_data ) {
                        $fourhourvotedids .= $four_hour_data[ "article_id" ] . ",";
                }
                $fourhourvotedids = chop( $fourhourvotedids, "," );

                /* Get highest voted articles in Last 4 hours - END */

                $this -> db -> select( "p.*,u.alise as byuser,GROUP_CONCAT(pc1.id) as choice_id,"
                        . "GROUP_CONCAT(pc1.choice) as choice,(SELECT choice from article_action  where article_id = p.id AND action= 'Vote' AND user_id=" . $user_id . ") as user_choice" );

                $this -> db -> from( "article p" );

                $this -> db -> join( 'article_choices pc1', 'pc1.article_id=p.id' );
                $this -> db -> join( "users u", "u.id=p.user_id", "LEFT" );
                //$this->db->order_by('p.total_votes', 'DESC');
                if ( $category != "all" ) {
                        //$this->db->where("p.category_id", $category);
                }

                $this -> db -> where( "p.is_active", 1 );
                if ( $category != "myraised" ) {
                        $this -> db -> where( 'p.is_approved', 1 );
                }
                //
                //$this->db->where('date(p.end_date)>="'.date('Y-m-d').'"');
                $this -> db -> group_by( 'p.id' );
                //$this->db->order_by('p.total_like DESC');
                if ( $fourhourvotedids != "" ) {
                        $this -> db -> order_by( "FIELD(p.id, $fourhourvotedids) DESC,p.id DESC" );
                } else {
                        $this -> db -> order_by( "p.id DESC" );
                }

                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                //$this->db->order_by('p.id', 'DESC');
                $result = $this -> db -> get();
                //echo $this->db->last_query();exit;

                $categorydata = $result -> result_array();

                foreach ( $categorydata as $key => $catd ) {
                        $id = $catd[ 'id' ];

                        $counttoberemoved = $this -> remove_votes_count( $id );
                        $categorydata[ $key ][ 'total_votes' ] = $categorydata[ $key ][ 'total_votes' ] - $counttoberemoved;
                }

                return $categorydata;

        }

        function get_total_articles( $category ) {

                $archive = $this -> get_archive_article();
                $archive_ids = "";
                if ( ! empty( $archive ) ) {
                        foreach ( $archive as $archive_data ) {
                                $archive_ids .= $archive_data[ 'id' ] . ",";
                        }
                        $archive_ids = chop( $archive_ids, ',' );
                        $archive_ids = " AND p.id not in ($archive_ids)";
                }

                $this -> db -> select( 'count(1) as total' );
                $this -> db -> from( 'article p' );
                $this -> db -> where( "p.is_active", 1 );
                $this -> db -> where( "p.is_approved $archive_ids" );

                //$this->db->where('date(p.end_date)>="'.date('Y-m-d').'"');
                $total = $this -> db -> get() -> row_array();
                return $total[ 'total' ];

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
                foreach ( $result as $key => $articledata ) {
                        $id = $articledata[ 'id' ];
                        $counttoberemoved = $this -> remove_votes_count( $id );

                        $result[ $key ][ 'data' ] = json_decode( $result[ $key ][ 'data' ] );

                        $result[ $key ][ 'total_votes' ] = $result[ $key ][ 'total_votes' ] - $counttoberemoved;
                }

                return $result;

        }

        function get_article_list( $user_id, $offset = 0, $limit = 10 ) {

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

                foreach ( $article_data as $key => $data ) {
                        $id = $data[ 'id' ];
                        $total_votes = $data[ 'total_votes' ];
                        $article_data[ $key ][ 'options' ] = $this -> calculateavgvotes( $id, $total_votes );
                        $article_data[ $key ][ 'All_comments' ] = $this -> get_article_comments( $id, 0, 2 );
                        $article_data[ $key ][ 'total_comments' ] = $this -> get_article_comments_count( $id, 'All' );

                        $article_data[ $key ][ 'data' ] = json_decode( $article_data[ $key ][ 'data' ] );
                        $counttoberemoved = $this -> remove_votes_count( $id );
                        $article_data[ $key ][ 'total_votes' ] = $article_data[ $key ][ 'total_votes' ] - $counttoberemoved;
                }

                return $article_data;

        }

        function get_article_by_category( $category, $user_id, $articleid = 0, $offset = 0, $limit = 10 ) {
                if ( ! empty( $this -> input -> get() ) ) {
                        $articleid = $this -> input -> get( 'pid' );
                }

                /* Get highest voted articles in Last 4 hours - START */
                $fourhourvotedids = "";
                $this -> db -> select( "sa.article_id, count(1) as max_votes" );
                $this -> db -> from( "article_action sa" );
                $this -> db -> where( "(now() - interval 4 hour <= sa.created_date) AND sa.action= 'Vote'" );
                $this -> db -> group_by( "sa.article_id" );
                $this -> db -> order_by( "max_votes ASC" );
                $this -> db -> order_by( "sa.article_id ASC" );
                $result = $this -> db -> get();
                $last_four_hour_max_voted = $result -> result_array();

                foreach ( $last_four_hour_max_voted as $four_hour_data ) {
                        $fourhourvotedids .= $four_hour_data[ "article_id" ] . ",";
                }
                $fourhourvotedids = chop( $fourhourvotedids, "," );
                /* Get highest voted articles in Last 4 hours - END */

                /* end */
                $this -> db -> select( "p.*,u.alise as byuser,GROUP_CONCAT(pc1.id SEPARATOR '|') as choice_id,"
                        . "GROUP_CONCAT(pc1.choice SEPARATOR '|') as choice,"
                        . "(SELECT choice from article_action where article_id = p.id AND action= 'Vote' AND user_id=" . $user_id . ") as user_choice" );

                $this -> db -> from( "article p" );
                $this -> db -> join( 'article_choices pc1', 'pc1.article_id=p.id' );
                $this -> db -> join( "users u", "u.id=p.user_id", "LEFT" );
                if ( is_numeric( $category ) ) {
                        
                } else {
                        if ( $category == "voted" ) {
                                $this -> db -> where( "p.id IN (select article_id from article_action where user_id=$user_id)" );
                        } else if ( $category == "notvoted" ) {
                                $this -> db -> where( "p.id NOT IN (select article_id from article_action where user_id=$user_id)" );
                        } else if ( $category == "trending" ) {
                                //$this->db->order_by('p.total_votes', 'DESC');
                        } else if ( $category == "myraised" ) {
                                $this -> db -> where( 'p.user_id', $user_id );
                        }
                }


                $articleid_also = "";
                if ( $fourhourvotedids != "" ) {
                        if ( $articleid != 0 && $offset == 0 ) {
                                $articleid_also = "," . $articleid;
                        }
                        $fourhourvotedids = $fourhourvotedids . "" . $articleid_also;
                        $this -> db -> order_by( "FIELD(p.id, $fourhourvotedids) DESC,p.id DESC" );
                } else if ( $articleid != 0 && $offset == 0 ) {
                        $articleid_also = $articleid;
                        $fourhourvotedids = $fourhourvotedids . "" . $articleid_also;
                        $this -> db -> order_by( "FIELD(p.id, $fourhourvotedids) DESC,p.id DESC" );
                } else {
                        $this -> db -> order_by( "p.id DESC" );
                }

                if ( $articleid != 0 && $offset == 0 ) {
                        //$this->db->order_by("FIELD(p.id, $articleid) DESC,p.id");
                } else if ( $articleid != 0 && $offset > 0 ) {
                        $this -> db -> where( "p.id<>", $articleid );
                }

                $this -> db -> where( "p.is_active", 1 );
                if ( $category != "myraised" ) {
                        $this -> db -> where( 'p.is_approved', 1 );
                }
                //$this->db->where('date(p.end_date)>="'.date('Y-m-d').'"');
                //
        $this -> db -> group_by( 'p.id' );

                //$this->db->order_by('p.id DESC');
                //$this->db->order_by('p.total_like DESC');

                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                //$this->db->order_by('trending', 'DESC');//four hours trending
                $result = $this -> db -> get();

                //echo $this->db->last_query();exit;
                $categorydata = $result -> result_array();



                foreach ( $categorydata as $key => $catd ) {
                        $id = $catd[ 'id' ];
                        $total_votes = $catd[ 'total_votes' ];
                        $categorydata[ $key ][ 'options' ] = $this -> calculateavgvotes( $id, $total_votes );
                        $categorydata[ $key ][ 'All_comments' ] = $this -> get_article_comments( $id, 0, 2 );
                        $categorydata[ $key ][ 'total_comments' ] = $this -> get_article_comments_count( $id, 'All' );

                        $counttoberemoved = $this -> remove_votes_count( $id );
                        $categorydata[ $key ][ 'total_votes' ] = $categorydata[ $key ][ 'total_votes' ] - $counttoberemoved;
                }

                return $categorydata;

        }

        function get_comment_replies_mod( $forumid, $commentid, $offset = 0, $limit = 5 ) {
                $this -> db -> select( 'pcr.*,u.alise as byuser' );
                $this -> db -> where( 'pcr.article_id', $forumid );
                $this -> db -> where( 'pcr.comment_id', $commentid );
                $this -> db -> where( 'pcr.is_active', 1 );
                $this -> db -> offset( $offset );
                $this -> db -> limit( $limit );
                $this -> db -> from( 'article_comment_reply pcr' );
                $this -> db -> join( 'users u', 'u.id=pcr.user_id' );
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

        function make_deactive_article( $forumid ) {
                $this -> db -> where( 'id', $forumid );
                $this -> db -> cache_delete_all();
                $this -> db -> update( 'article', array ( 'is_active' => 0 ) );
                $response = json_encode( array ( "status" => TRUE, "message" => "Article deleted successfully" ) );
                echo $response;
                exit;

        }

        function make_deactive_comment( $cmtid ) {
                $this -> db -> select( 'article_id' );
                $this -> db -> where( 'id', $cmtid );
                $this -> db -> from( 'article_comments' );
                $result = $this -> db -> get() -> row_array();
                $article_id = $result[ 'article_id' ];

                $this -> db -> where( 'id', $cmtid );
                $this -> db -> update( 'article_comments', array ( 'is_active' => 0 ) );

                $total_active = $this -> get_article_comments_count( $article_id, 'All' );
                $this -> db -> set( 'total_comments', $total_active );
                $this -> db -> where( "id", $article_id );
                $this -> db -> cache_delete_all();
                $this -> db -> update( 'article' );
                $comments = $this -> get_article_comments( $article_id, 0, 2 );
                $response = json_encode( array ( "status" => TRUE, "message" => "Deleted successfully", "data" => $comments, "ques_no" => $article_id, "total" => $total_active ) );
                echo $response;
                exit;

        }

        function addarticlechoice_mod( $input, $user_id ) {
                $articleid = $input[ 'article_id' ];
                $choice = $input[ 'choice' ];
                $category = $input[ 'category_id' ];
                //$user_id = $input['user_id'];
                $data = array (
                    "article_id" => $articleid,
                    "user_id" => $user_id,
                    "choice" => $choice,
                    "category_id" => 0,
                    'action' => 'Vote'
                );
                //var_dump($data);exit;
                $this -> db -> select( 'id' );
                $this -> db -> where( 'article_id', $articleid );
                $this -> db -> where( 'user_id', $user_id );
                $this -> db -> where( 'action', 'Vote' );
                $this -> db -> from( 'article_action' );
                $this -> db -> cache_delete_all();
                $result = $this -> db -> get();
                if ( $result -> num_rows() > 0 ) {
                        //$alreadyvote = $result -> row_array();
                        //$this -> db -> where( 'id', $alreadyvote[ 'id' ] );
                        //$this -> db -> update( 'article_action', $data );
                        return 1;
                } else {
                        $data[ 'points' ] = 1;
                        $data[ 'action' ] = 'Vote';
                        $this -> db -> insert( 'article_action', $data );

                        $sessiondata = $this -> session -> userdata( 'data' );
                        $_SESSION[ 'data' ][ 'silver_points' ] = $sessiondata[ 'silver_points' ] + 1;

                        $this -> db -> set( 'unearned_points', "unearned_points+1", FALSE );
                        $this -> db -> where( "id", $user_id );

                        $this -> db -> update( 'users' );



                        return 0;
                }

        }

        function likecomment_mod( $cmtid, $user_id ) {

                $data = array (
                    "comment_id" => $cmtid,
                    "user_id" => $user_id,
                );
                $this -> db -> select( 'id,is_like' );
                $this -> db -> where( 'user_id', $user_id );
                $this -> db -> where( 'comment_id', $cmtid );
                $this -> db -> from( 'article_comment_likes' );
                $this -> db -> cache_delete_all();
                $result = $this -> db -> get();
                if ( $result -> num_rows() > 0 ) {
                        $like = $result -> row_array();
                        $data[ 'is_like' ] = $like[ 'is_like' ] == 0 ? 1 : 0;

                        $this -> db -> where( 'id', $like[ 'id' ] );
                        $this -> db -> update( 'article_comment_likes', $data );
                        $msg = $like[ 'is_like' ] == 0 ? 'Like' : 'Dislike';
                        $response = json_encode( array ( "status" => TRUE, "message" => "Comment $msg successfully", "islike" => $data[ 'is_like' ] ) );
                } else {
                        $data[ 'is_like' ] = 1;
                        $this -> db -> insert( 'article_comment_likes', $data );
                        $response = json_encode( array ( "status" => TRUE, "message" => "Comment liked successfully" ) );
                }
                echo $response;
                exit;

        }

        function remove_votes_count( $article_id ) {

                $query = "select COUNT(1) remove_count
                        from article_action aa 
                        INNER JOIN article_choices ac ON ac.article_id = '$article_id' AND ac.choice = 'Click to see Rating'
                        WHERE aa.article_id = '$article_id' AND aa.choice = ac.id;";
                $result = $this -> db -> query( $query ) -> row_array();

                $counttoberemoved = $result[ 'remove_count' ]; //See the results counts should not be calculated
                return $counttoberemoved;

        }

        function special_character( $string ) {
                $string = str_replace( "'", "&#039;", $string );
                $string = str_replace( '"', '&#039;', $string );
                return $string;

        }

}
