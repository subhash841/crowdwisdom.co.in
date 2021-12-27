<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Packages_Mod extends CI_Model {

        function __construct() {
                parent::__construct();

        }

        function get_package_lists( $user_id ) {
                $this -> db -> select( "p.*, (CASE WHEN pp.id THEN 1 ELSE 0 END) as purchased" );
                $this -> db -> from( "package p" );
                $this -> db -> join( "package_purchased pp", "pp.package_id = p.id AND pp.user_id = '$user_id'", "LEFT" );
                $this -> db -> where( "p.is_active = '1' AND (p.end_date + INTERVAL 24 hour) > now()" );
                $result = $this -> db -> get() -> result_array();

                return array ( "status" => TRUE, "message" => "", "data" => $result );

        }

        function get_package_details( $inputs ) {
                $package_id = $inputs[ 'id' ];
                $user_id = $inputs[ 'user_id' ];

                $userchoice = "";
                if ( $user_id > 0 ) {
                        $userchoice = ", COALESCE(pa.choice,'') as users_choice";
                }

                $this -> db -> select( "p.id, p.user_id, p.raised_by_admin,COALESCE(u.alise,'') as alias,p.poll as title, p.description, "
                        . "COALESCE(p.image,'') as image, p.total_votes, p.total_comments, p.meta_keywords, p.meta_description, p.average, "
                        . "p.email_ids, p.end_date, p.created_date $userchoice" );
                $this -> db -> from( "package_data pd" );
                $this -> db -> join( " poll p", "p.id = pd.module_id", "INNER" );
                if ( $user_id > 0 ) {
                        $this -> db -> join( "poll_action pa", "pa.poll_id = p.id AND pa.user_id = '$user_id'", "LEFT" );
                }
                $this -> db -> join( 'users u', 'u.id = p.user_id', "LEFT" );
                $this -> db -> where( "pd.package_id = '$package_id' AND p.is_active = '1' AND p.is_approved = '1'" );

                $result = $this -> db -> get() -> result_array();
                // echo $this ->db->last_query();exit;
                $ids = array ();

                foreach ( $result as $key => $prediction_data ) {
                        $ids[] = $prediction_data[ 'id' ];

                        $result[ $key ][ 'options' ] = $this -> calculateavgvotes( $prediction_data[ 'id' ] );
                        $result[ $key ][ 'total_views' ] = "0";
                }

                if ( ! empty( $ids ) ) {
                        /* Remove Vote counts of prediction - START */
                        $counttoberemoved = $this -> remove_vote_counts( $ids );

                        $allcomments = $this -> get_all_poll_comments( $ids, 0, 2 );

                        for ( $i = 0; $i < count( $result ); $i ++ ) {
                                foreach ( $counttoberemoved as $ctb => $removecount ) {
                                        if ( $removecount[ 'poll_id' ] == $result[ $i ][ 'id' ] ) {
                                                $revised_total = $result[ $i ][ 'total_votes' ] - $removecount[ 'count' ];
                                                $result[ $i ][ 'total_votes' ] = "$revised_total";
                                        }
                                }

                                foreach ( $allcomments as $av ) {
                                        if ( $av[ 'poll_id' ] == $result[ $i ][ 'id' ] ) {
                                                $result[ $i ][ 'comments' ][] = $av;
                                                if ( count( $result[ $i ][ 'comments' ] ) > 2 ) {
                                                        $result[ $i ][ 'more_comments' ] = "1";
                                                } else {
                                                        $result[ $i ][ 'more_comments' ] = "0";
                                                }
                                        } else {
                                                $result[ $i ][ 'comments' ] = array ();
                                                $result[ $i ][ 'more_comments' ] = "0";
                                        }
                                }
                        }
                }

                return array ( "status" => TRUE, "message" => "", "data" => $result, "ids" => $ids, "id" => $package_id );

        }

        function calculateavgvotes( $id ) {
                $this -> db -> select( 'count(1) as actualvotes' );
                $this -> db -> from( 'poll_action pa' );
                $this -> db -> join( 'poll_choices polc', 'polc.id=pa.choice', 'INNER' );
                $this -> db -> where( 'pa.poll_id', $id );
                $this -> db -> where( 'polc.choice !=', "See the Results" );
                $donknw = $this -> db -> get() -> row_array();
                $total_votes = $donknw[ 'actualvotes' ];

                $this -> db -> select( 'pc1.id as choice_id,pc1.choice' );
                $this -> db -> from( 'poll_choices pc1' );
                $this -> db -> where( 'pc1.poll_id', $id );
                $this -> db -> group_by( 'pc1.id' );
                $choices = $this -> db -> get() -> result_array();

                $ch_ids = array ();
                foreach ( $choices as $key => $c1 ) {
                        $ch_ids[] = $c1[ 'choice_id' ];
                }

                $this -> db -> select( 'count(1) as total, choice' );
                $this -> db -> from( 'poll_action' );
                $this -> db -> where_in( 'choice', $ch_ids );
                $this -> db -> where( 'poll_id', $id );
                $this -> db -> group_by( 'choice' );
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

                        if ( $c1[ 'choice' ] != "See the Results" ) {
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

        function remove_vote_counts( $ids ) {
                $arr = TRUE;
                if ( ! is_array( $ids ) ) {
                        $arr = FALSE;
                        $ids = array ( $ids );
                }
                $id = implode( ",", $ids );

                $query = "select COUNT(1) as count, pa.poll_id
                    from poll_action pa 
                    INNER JOIN poll_choices pc ON pc.type = '0'
                    WHERE pa.poll_id in ($id) AND pa.choice = pc.id group by poll_id";

                if ( $arr ) {
                        $result = $this -> db -> query( $query ) -> result_array();
                } else {
                        $result = $this -> db -> query( $query ) -> row_array();
                }
                return $result;

        }

        function get_all_poll_comments( $id, $offset = 0, $limit = 10 ) {

                $arr = true;

                if ( ! is_array( $id ) ) {
                        $arr = false;
                        $id = array ( $id );
                }
                $id = implode( ',', $id );

                $sql = "SELECT  *
                        FROM
                        (
                                SELECT pcmt.*, pcmt.id as comment_id, u.alise as alias,
                                @rn := IF(@prev = pcmt.poll_id, @rn + 1, 1) AS rn,
                                @prev := pcmt.poll_id
                                FROM poll_comments pcmt
                                JOIN users u ON u.id=pcmt.user_id
                                JOIN (SELECT @prev := NULL, @rn := 0) AS vars
                                WHERE pcmt.poll_id IN($id)
                                AND pcmt.is_active = 1
                                ORDER BY pcmt.poll_id, pcmt.created_date DESC
                        ) AS T1
                        WHERE rn <= 2";
                $result = $this -> db -> query( $sql ) -> result_array();

                return $result;

        }

        function get_package_info( $id ) {
                $this -> db -> select( 'p.id, p.name, p.prize_text, p.point_required_text, p.reward_text, p.price, p.image, p.end_date, '
                        . '(CASE WHEN pp.id THEN 1 ELSE 0 END) as purchased' );
                $this -> db -> from( "package p" );
                $this -> db -> join( "package_purchased pp", "pp.package_id = p.id AND pp.user_id = '$user_id'", "LEFT" );
                $this -> db -> where( 'p.is_active', '1' );
                $this -> db -> where( 'p.id', $id );

                $result[ 'package_info' ] = $this -> db -> get() -> result_array();

                $query = $this -> db -> query( "SELECT * FROM package_data WHERE package_id = '$id'" );
                $result[ 'question_count' ] = $query -> num_rows();
                return $result;

        }

}
