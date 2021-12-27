<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Poll extends CI_Controller {

        private $user_id = 0;
        private $user_alias = "";

        function __construct() {
                parent::__construct();
                $this -> load -> model( 'Poll_Mod' );

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
                $data = array ();
                $header_data[ 'page_title' ] = "CrowdWisdom";
                $header_data[ 'page_img' ] = base_url() . "images/logo/prediction_share_logo.png";

                $data[ 'uid' ] = $this -> user_id;
                $data[ 'alias' ] = $this -> user_alias;
                $data[ 'category_list' ] = $this -> Poll_Mod -> get_poll_category();

                $this -> load -> view( 'header', $header_data );
                $this -> load -> view( 'poll', $data );
                $this -> load -> view( 'footer' );
        }

        function load_more_poll() {
                $cat_id = $this -> input -> post( 'categoryid' );
                $pageno = $this -> input -> post( 'pageno' );
                $type = $this -> input -> post( 'type' );
                $pollid = $this -> input -> post( 'pollid' );

                if ( empty( $pollid ) ) {
                        $pollid = 0;
                }

                $data[ 'next_page' ] = $pageno + 1;
                $pageno = $pageno * 10;

                $data[ 'moredata' ] = $this -> Poll_Mod -> get_poll_by_category( $cat_id, $this -> user_id, $pollid, $pageno );
                $data[ 'total_polls' ] = $this -> Poll_Mod -> get_total_polls( $cat_id );

                $category_name = "";
                $poll_cat = $this -> Poll_Mod -> get_poll_category();
                foreach ( $poll_cat as $fc ) {
                        if ( $cat_id == $fc[ 'id' ] ) {
                                $category_name = $fc[ 'name' ];
                        }
                }
                $data[ 'uid' ] = $this -> user_id;
                $data[ 'alias' ] = $this -> user_alias;

                $data[ 'category_name' ] = $category_name;
                $data[ 'section' ] = $type;
                $data[ 'category_id' ] = $cat_id;
                $this -> load -> view( 'load_ajax_poll', $data );
        }

        function index1() {
                $sessiondata = $this -> session -> userdata( 'data' );
                $data[ 'page_title' ] = "CrowdWisdom";
                $data[ 'page_img' ] = base_url() . "images/logo/prediction_share_logo.png";

                $data[ 'user_info' ] = $sessiondata;

                if ( ! empty( $sessiondata ) ) {
                        $data[ 'user_info' ] = $sessiondata;
                        $user_id = $sessiondata[ 'uid' ];
                        $data[ 'user_id' ] = $user_id;
                } else {
                        $user_id = 0;
                        $data[ 'user_info' ][ 'uid' ] = 0;
                        $data[ 'user_id' ] = $user_id;
                }

                $poll_cat = $this -> Poll_Mod -> get_poll_category();
                $pollid = 0;
                $cat_id = 0;

                $data[ 'category_list' ] = $poll_cat;
                if ( strpos( $_SERVER[ 'REQUEST_URI' ], "elecpoll" ) !== false ) {
                        $category_name = "Governance";
                } else if ( strpos( $_SERVER[ 'REQUEST_URI' ], "stockpoll" ) !== false ) {
                        $category_name = "Money";
                } else if ( strpos( $_SERVER[ 'REQUEST_URI' ], "sportpoll" ) !== false ) {
                        $category_name = "Sports";
                } else if ( strpos( $_SERVER[ 'REQUEST_URI' ], "moviepoll" ) !== false ) {
                        $category_name = "Entertainment";
                } else {
                        //$category_name="Governance";
                        $category_name = "Elections";
                }

                if ( ! empty( $this -> input -> get() ) ) {
                        $pollid = $this -> input -> get( 'pid' );
                        if ( $this -> input -> get( 'section' ) ) {
                                $category_name = $this -> input -> get( 'section' );
                        }
                        if ( $this -> input -> get( 'ct' ) ) {
                                $category_name = $this -> input -> get( 'ct' );
                                if ( $category_name == "Governance" ) {
                                        $category_name = "Elections";
                                } else {
                                        $category_name = $category_name;
                                }
                        }
                }
                $data[ 'myraised' ] = $this -> Poll_Mod -> get_poll_by_category( 'myraised', $this -> user_id );
                if ( empty( $category_name ) ) {
                        $cat_id = 1;
                        $data[ 'governance' ] = $this -> Poll_Mod -> get_poll_by_category( $cat_id, $this -> user_id, $pollid );
                        $data[ 'trending' ] = $this -> Poll_Mod -> get_trending_by_category( $cat_id, $this -> user_id );
                        $data[ 'total_polls' ][ 'governance' ] = $this -> Poll_Mod -> get_total_polls( $cat_id );
                } else {
                        foreach ( $poll_cat as $fc ) {
                                if ( $category_name == $fc[ 'name' ] ) {
                                        $cat_id = $fc[ 'id' ];
                                        $data[ strtolower( $fc[ 'name' ] ) ] = $this -> Poll_Mod -> get_poll_by_category( $cat_id, $this -> user_id, $pollid );
                                        $data[ 'trending' ] = $this -> Poll_Mod -> get_trending_by_category( $fc[ 'id' ], $this -> user_id );
                                        $data[ 'total_polls' ][ strtolower( $fc[ 'name' ] ) ] = $this -> Poll_Mod -> get_total_polls( $fc[ 'id' ] );
                                        //$data['total_polls'][strtolower($fc['name'])] = $this->Poll_Mod->get_total_polls($cat_id);
                                }
                        }
                }

                $data[ 'page_img' ] = $category_name;

                /* page title finding */
                $this -> load -> view( 'header', $data );
                $this -> load -> view( 'poll', $data );
                $this -> load -> view( 'footer' );
        }

        function polldetail( $id = NULL, $title = NULL ) {
                //$this->output->enable_profiler(TRUE);

                $data[ 'page_title' ] = "CrowdWisdom";
                $data[ 'page_img' ] = base_url( "images/logo/prediction_share_logo.png" );

                $data[ 'poll_id' ] = $id;

                $data[ 'id' ] = $id;

                //$data['votedpoll'] = $this->Poll_Mod->get_poll_by_category('voted', $user_id);
                //$data['notvotedpoll'] = $this->Poll_Mod->get_poll_by_category('notvoted', $user_id);
                //$data['trending'] = $this->Poll_Mod->get_poll_by_category('trending', $user_id);
                //$data['myraised'] = $this->Poll_Mod->get_poll_by_category('myraised', $this->user_id);
                //$pollid = 0;
                //$cat_id = 0;

                $data[ 'uid' ] = $this -> user_id;
                $data[ 'alias' ] = $this -> user_alias;
                $data[ 'category_list' ] = $this -> Poll_Mod -> get_poll_category();
                $data[ 'poll_detail' ] = $this -> Poll_Mod -> get_poll_by_id( $id, $this -> user_id );

                //$data['votedpoll'] = $this->Poll_Mod->get_poll_by_category('voted', $this->user_id, $pollid);
                //$data['notvotedpoll'] = $this->Poll_Mod->get_poll_by_category('notvoted', $this->user_id, $pollid);
                //$data['trending'] = $this->Poll_Mod->get_trending_by_category($data['poll_detail']['category_id'], $this->user_id);
                //$data['page_title'] = $data['poll_detail']['poll'];
                $data[ 'page_title' ] = str_replace( '"', '\'', $data[ 'poll_detail' ][ 'poll' ] );
                $data[ 'page_img' ] = $data[ 'poll_detail' ][ 'category_name' ];


                $data[ 'silver_points' ] = $this -> silver_points;
                $this -> load -> view( 'header', $data );
                $this -> load -> view( 'polldetail', $data );
                $this -> load -> view( 'footer' );
        }

        function add_update_poll() {
                $sessiondata = $this -> session -> userdata( 'data' );
                if ( ! empty( $sessiondata ) ) {
                        $inputs = $this -> input -> post();

                        //$discussion_id = $inputs['poll_id'];
                        $user_id = $sessiondata[ 'uid' ];
                        $newaddedid = $this -> Poll_Mod -> add_update_poll_mod( $inputs, $user_id );

                        //$msg = ($discussion_id == "0") ? "CrowdWisdom will approve your question shortly" : "poll updated successfully";
                        $msg = "CrowdWisdom will approve your question shortly";
                        $toastmsg = json_encode( array ( "status" => TRUE, "message" => $msg ) );
                        $this -> session -> set_flashdata( 'toast', $msg );
                        $category_id = $inputs[ 'pollcatergory' ];
                        $poll_cat = $this -> Poll_Mod -> get_poll_category();
                        foreach ( $poll_cat as $fc ) {
                                if ( $category_id == $fc[ 'id' ] ) {
                                        $category_name = $fc[ 'name' ];
                                        redirect( 'Poll?ct=' . $category_name . '' );
                                }
                        }
                } else {
                        redirect( ' Login?section=poll' );
                }
        }

        function poll_action() {
                $sessiondata = $this -> session -> userdata( 'data' );
                if ( ! empty( $sessiondata ) ) {
                        $pollid = $this -> input -> post( 'pollid' );
                        $userid = $this -> input -> post( 'userid' );
                        $type = $this -> input -> post( 'type' );

                        if ( ! empty( $pollid ) && ! empty( $userid ) && ! empty( $type ) ) {
                                $isnew = $this -> Poll_Mod -> add_poll_action( $pollid, $userid, $type );
                                $sessiondata = $this -> session -> userdata( 'data' );
                                $data[ 'user_info' ] = $sessiondata;
                                $data[ 'poll_id' ] = $pollid;
                                $data[ 'like_comments' ] = $this -> Poll_Mod -> get_poll_comments( $pollid, 'like' );
                                $data[ 'dislike_comments' ] = $this -> Poll_Mod -> get_poll_comments( $pollid, 'dislike' );
                                $data[ 'neutral_comments' ] = $this -> Poll_Mod -> get_poll_comments( $pollid, 'neutral' );
                                $data[ 'total_like_comments' ] = $this -> Poll_Mod -> get_poll_comments_count( $pollid, 'like' );
                                $data[ 'total_dislike_comments' ] = $this -> Poll_Mod -> get_poll_comments_count( $pollid, 'dislike' );
                                $data[ 'total_neutral_comments' ] = $this -> Poll_Mod -> get_poll_comments_count( $pollid, 'neutral' );

                                $this -> load -> view( 'load_ajax_pollcomments', $data );
                        }
                } else {
                        echo json_encode( array ( "status" => FALSE, "message" => "", "redirect_url" => " Login" ) );
                }
        }

        function add_comment() {
                $sessiondata = $this -> session -> userdata( 'data' );
                if ( ! empty( $sessiondata ) ) {
                        $user_id = $sessiondata[ 'uid' ];
                        $pollid = $this -> input -> post( 'poll_id' );
                        $poll_cmt = $this -> input -> post( 'poll_cmt_id' );
                        $poll_comment = $this -> input -> post( 'poll_comment' );
                        if ( ! empty( $user_id ) && ! empty( $pollid ) && ! empty( $poll_comment ) ) {
                                $id = $this -> Poll_Mod -> add_comment_mod( $pollid, $user_id, $poll_comment, $poll_cmt );
                                $comment_data = $this -> Poll_Mod -> get_comment_by_id( $id );
                                echo json_encode( array ( "status" => TRUE, "message" => "Comment added successfully!", "data" => $comment_data ) );
                                exit;
                        } else {
                                echo json_encode( array ( "status" => FALSE, "message" => "Please write comment" ) );
                                exit;
                        }
                } else {
                        redirect( ' Login?section=poll' );
                }
                //redirect(' Poll/polldetail/' . $pollid);
        }

        function add_comment_reply() {

                $sessiondata = $this -> session -> userdata( 'data' );
                if ( ! empty( $sessiondata ) ) {
                        $user_id = $sessiondata[ 'uid' ];
                        $pollid = $this -> input -> post( 'poll_id' );
                        $comment_id = $this -> input -> post( 'comment_id' );
                        $poll_comment_reply = $this -> input -> post( 'poll_comment_reply' );
                        if ( ! empty( $user_id ) && ! empty( $pollid ) && ! empty( $comment_id ) && ! empty( $poll_comment_reply ) ) {
                                $id = $this -> Poll_Mod -> add_comment_reply_mod( $pollid, $user_id, $poll_comment_reply, $comment_id );
                                $reply_data = $this -> Poll_Mod -> get_comment_reply_by_id( $id );
                                echo json_encode( array ( "status" => TRUE, "message" => "Reply added successfully!", "data" => $reply_data ) );
                        } else {
                                echo json_encode( array ( "status" => FALSE, "message" => "Write a reply" ) );
                        }
                } else {
                        redirect( ' Login?section=poll' );
                }
        }

        function get_comment_replies() {
                $sessiondata = $this -> session -> userdata( 'data' );

                $pollid = $this -> input -> post( 'pollid' );
                $commentid = $this -> input -> post( 'commentid' );
                $pagelimit = $this -> input -> post( 'pagelimit' );
                $pagelimit = $pagelimit * 5;
                //echo $pollid." ".$commentid." ".$pagelimit;exit;
                if ( ! empty( $commentid ) && ! empty( $pollid ) ) {
                        $response = $this -> Poll_Mod -> get_comment_replies_mod( $pollid, $commentid, $pagelimit );
                        echo $response;
                        exit;
                        //$this->session->set_flashdata('toast', "reply added successfully!");
                } else {
                        echo json_encode( array ( "status" => FALSE, "message" => "Something went wrong" ) );
                        exit;
                        //$this->session->set_flashdata('toast', "Please fill required field");
                }
        }

        function load_more_comments() {
                $sessiondata = $this -> session -> userdata( 'data' );

                $pollid = $this -> input -> post( 'pollid' );
                //$type = $this->input->post('type');
                $offset = $this -> input -> post( 'pagelimit' );
                if ( $offset != 0 ) {
                        $offset = $offset * 10;
                        $limit = 10;
                } else {
                        $offset = 2;
                        $limit = 8;
                }


                $comments = $this -> Poll_Mod -> get_poll_comments( $pollid, $offset, $limit );
                if ( empty( $comments ) ) {
                        $response = json_encode( array ( "status" => FALSE, "message" => "No Comments found" ) );
                } else {
                        $response = json_encode( array ( "status" => TRUE, "message" => "Comments found", "data" => $comments ) );
                }
                echo $response;
                exit;
        }

        function deactive_poll() {
                $pollid = $this -> input -> post( 'pollid' );
                //var_dump($pollid);exit;
                if ( ! empty( $pollid ) ) {
                        $this -> Poll_Mod -> make_deactive_poll( $pollid );
                }
                $response = json_encode( array ( "status" => FALSE, "message" => "Something went wrong" ) );
                echo $response;
                exit;
        }

        function deactivecmt() {
                $cmtid = $this -> input -> post( 'comment' );
                $pollpage = $this -> input -> post( 'pageno' );

                //var_dump($pollid);exit;
                if ( ! empty( $cmtid ) ) {
                        $this -> Poll_Mod -> make_deactive_comment( $cmtid, $pollpage );
                }
                $response = json_encode( array ( "status" => FALSE, "message" => "Something went wrong" ) );
                echo $response;
                exit;
        }

        function likecomment() {
                $sessiondata = $this -> session -> userdata( 'data' );
                if ( ! empty( $sessiondata ) ) {
                        $user_id = $sessiondata[ 'uid' ];
                        $cmtid = $this -> input -> post( 'comment' );
                        if ( ! empty( $cmtid ) ) {
                                $this -> Poll_Mod -> likecomment_mod( $cmtid, $user_id );
                        }
                        $response = json_encode( array ( "status" => FALSE, "message" => "Something went wrong" ) );
                        echo $response;
                        exit;
                } else {
                        redirect( ' Login?section=poll' );
                }
        }

        function addpollchoice() {
                $input = $this -> input -> post();

                $sessiondata = $this -> session -> userdata( 'data' );
                if ( ! empty( $sessiondata ) ) {
                        $user_id = $sessiondata[ 'uid' ];
                        $isvote = $this -> Poll_Mod -> addpollchoice_mod( $input, $user_id );
                        $pollid = $input[ 'poll_id' ];
                        $vote = $this -> Poll_Mod -> get_poll_by_id( $pollid, $user_id );
                        if ( $isvote == 0 ) {
                                echo json_encode( array ( "status" => TRUE, "message" => "You got one point", "data" => $vote, "isnew" => 1 ) );
                        } else {
                                echo json_encode( array ( "status" => TRUE, "message" => "Vote changed successfully", "data" => $vote, "isnew" => 0 ) );
                        }
                        //var_dump($vote);exit;
                } else {
                        echo json_encode( array ( "status" => FALSE, "message" => "", "redirect_url" => " Login" ) );
                }
        }

        function getsilverpoints() {
                $this -> load -> helper( 'common_helper' );
                $points = get_silver_points();
                echo $points;
        }

//    function getmetatags(){
//    var_dump($this->input->post());exit;
//        var_dump($url);exit;
//    }

        function getmetatags() {
                $url = $this -> input -> post( 'url' );
                $data = file_get_contents( $url );
                $dom = new DomDocument;
                @$dom -> loadHTML( $data );

                $xpath = new DOMXPath( $dom );
                # query metatags with og prefix
                $metas = $xpath -> query( '//*/meta[starts-with(@property, \'og:\')]' );

                $og = array ();

                foreach ( $metas as $meta ) {
                        # get property name without og: prefix
                        $property = str_replace( 'og:', '', $meta -> getAttribute( 'property' ) );
                        # get content
                        $content = $meta -> getAttribute( 'content' );
                        $og[ $property ] = $content;
                }
                //var_dump($og);exit;
                if ( ! isset( $og[ 'image' ] ) ) {
                        $og[ 'image' ] = base_url() . 'images/common/no-image.png';
                }
                if ( ! isset( $og[ 'description' ] ) ) {
                        $og[ 'description' ] = "";
                }
                if ( ! isset( $og[ 'url' ] ) ) {
                        $og[ 'url' ] = "";
                }
                $og[ 'url' ] = parse_url( $url )[ 'host' ];
                if ( ! isset( $og[ 'title' ] ) ) {
                        $res = preg_match( "/<title>(.*)<\/title>/siU", $data, $title_matches );
                        if ( ! $res )
                                return null;

                        // Clean up title: remove EOL's and excessive whitespace.
                        $title = preg_replace( '/\s+/', ' ', $title_matches[ 1 ] );
                        $title = trim( $title );
                        $og[ 'title' ] = $title;
                }
                echo json_encode( array ( "status" => TRUE, "data" => $og ) );
        }

//    function load_more_polls(){
//        $category_id=$this->input->post('category_id');
//        $offset=$this->input->post('offset');
//        $offset=$offset*10;
//        $pollid=0;
//        $cat_id=0;
//        
//        $sessiondata = $this->session->userdata('data');
//        if (!empty($sessiondata)) {
//            $data['user_info'] = $sessiondata;
//            $user_id = $sessiondata['uid'];
//        } else {
//            $user_id = 0;
//            $data['user_info']['uid'] = 0;
//        }
//        
//        $poll_data=$this->Poll_Mod->get_poll_by_category($category_id,$user_id,$pollid,$cat_id,$offset);
//        echo '<pre>';
//        print_r($poll_data);exit;
//    }

        function loadmoremyraised() {
                $pageno = $this -> input -> post( 'pageno' );
                $pageno = $pageno * 10;
                $sessiondata = $this -> session -> userdata( 'data' );
                $pollid = 0;
                if ( ! empty( $sessiondata ) ) {
                        $data[ 'user_info' ] = $sessiondata;
                        $user_id = $sessiondata[ 'uid' ];
                        $data[ 'user_id' ] = $user_id;
                } else {
                        $user_id = 0;
                        $data[ 'user_info' ][ 'uid' ] = 0;
                        $data[ 'user_id' ] = $user_id;
                }
                $result = $this -> Poll_Mod -> get_poll_by_category( 'myraised', $user_id, $pollid, $pageno );
                $status = TRUE;
                if ( empty( $result ) ) {
                        $status = FALSE;
                }
                echo json_encode( array ( "status" => $status, "message" => "Trending data found", "data" => $result ) );
        }

        function loadmoretrending() {

                //$this->output->enable_profiler(true);
                $cat_id = $this -> input -> post( 'categoryid' );
                $pageno = $this -> input -> post( 'pageno' );
                $type = $this -> input -> post( 'type' );
                $pollid = 0;

                $data[ 'next_page' ] = $pageno + 1;
                $pageno = $pageno * 10;
                $sessiondata = $this -> session -> userdata( 'data' );
                $poll_cat = $this -> Poll_Mod -> get_poll_category();
                if ( ! empty( $sessiondata ) ) {
                        $data[ 'user_info' ] = $sessiondata;
                        $user_id = $sessiondata[ 'uid' ];
                        $data[ 'user_id' ] = $user_id;
                } else {
                        $user_id = 0;
                        $data[ 'user_info' ][ 'uid' ] = 0;
                        $data[ 'user_id' ] = $user_id;
                }
                if ( empty( $cat_id ) ) {
                        $result = $this -> Poll_Mod -> get_trending_by_category( 'all', $user_id, $pageno );
                } else {
                        foreach ( $poll_cat as $fc ) {
                                if ( $cat_id == $fc[ 'id' ] ) {
                                        $category_name = $fc[ 'name' ];
                                        //$data['moredata'] = $this->Poll_Mod->get_poll_by_category($cat_id, $user_id, $pollid,$pageno);
                                        $result = $this -> Poll_Mod -> get_trending_by_category( $cat_id, $user_id, $pageno );
                                        //$data['total_polls'] = $this->Poll_Mod->get_total_polls($cat_id);
                                }
                        }
                }
                $status = TRUE;
                if ( empty( $result ) ) {
                        $status = FALSE;
                }
                echo json_encode( array ( "status" => $status, "message" => "Trending data found", "data" => $result ) );
        }

        function loadmorepolldata() {
                $cat_id = $this -> input -> post( 'categoryid' );
                $pageno = $this -> input -> post( 'pageno' );
                $type = $this -> input -> post( 'type' );
                $pollid = $this -> input -> post( 'pollid' );

                if ( empty( $pollid ) ) {
                        $pollid = 0;
                }
                $data[ 'next_page' ] = $pageno + 1;
                $pageno = $pageno * 10;
                $sessiondata = $this -> session -> userdata( 'data' );
                $poll_cat = $this -> Poll_Mod -> get_poll_category();
                if ( ! empty( $sessiondata ) ) {
                        $data[ 'user_info' ] = $sessiondata;
                        $user_id = $sessiondata[ 'uid' ];
                        $data[ 'uid' ] = $user_id;
                } else {
                        $user_id = 0;
                        $data[ 'user_info' ][ 'uid' ] = 0;
                        $data[ 'uid' ] = $user_id;
                }
                foreach ( $poll_cat as $fc ) {
                        if ( $cat_id == $fc[ 'id' ] ) {
                                $category_name = $fc[ 'name' ];
                                $data[ 'moredata' ] = $this -> Poll_Mod -> get_poll_by_category( $cat_id, $user_id, $pollid, $pageno );
                                //$data['trending']['moredata'] = $this->Poll_Mod->get_trending_by_category($cat_id, $user_id);
                                $data[ 'total_polls' ] = $this -> Poll_Mod -> get_total_polls( $cat_id );
                        }
                }
                $data[ 'category_name' ] = $category_name;
                $data[ 'section' ] = $type;
                $data[ 'category_id' ] = $cat_id;
                $this -> load -> view( 'load_ajax_poll', $data );
        }

        function load_my_answered_prediction() {
                $inputs = $this -> input -> post();
                $inputs[ 'uid' ] = $this -> user_id;

                $pageno = $inputs[ 'pageno' ];

                $data[ 'next_page' ] = $pageno + 1;
                $pageno = $pageno * 10;

                $data = $this -> Poll_Mod -> get_answered_prediction( $inputs, $pageno );

                if ( ! empty( $data ) ) {
                        echo json_encode( array ( "status" => TRUE, "message" => "My Answered data found", "data" => $data ) );
                } else {
                        echo json_encode( array ( "status" => FALSE, "message" => "My Answered data found", "data" => $data ) );
                }
        }

        function experts_result() {
                $inputs = $this -> input -> post();
                $result = $this -> Poll_Mod -> get_experts_result( $inputs );
                echo json_encode( $result );
        }

}
