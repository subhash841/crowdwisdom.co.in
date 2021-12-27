<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RatedArticle extends CI_Controller {

    private $user_id = 0;
    private $user_alias = "";

    function __construct() {
        parent::__construct();
        $this->load->model('RatedArticle_Mod_s');
        //global variable for sidebar option in ratedArticle
        $this->firstsidebarchoice = 'voted';
        /* choose among voted|notvoted|trending|myraised */

        $sessiondata = $this->session->userdata('data');
        if (!empty($sessiondata)) {
            $this->user_id = $sessiondata['uid'];
            $this->user_alias = $sessiondata['alise'];
        } else {
            $this->user_id = 0;
            $this->user_alias = "";
        }
    }

    function index() {
        $data = array();
        $header_data['page_title'] = "CrowdWisdom";
        $header_data['page_img'] = base_url("images/logo/Rated_Articles_share3.jpg");

        $data['uid'] = $this->user_id;
        $data['alias'] = $this->user_alias;
        $data['articles'] = $this->RatedArticle_Mod_s->get_article_list($this->user_id);
        $data['total_articles']['articles'] = $this->RatedArticle_Mod_s->get_total_articles(0);
        //$data['archive_article'] = $this->RatedArticle_Mod_s->get_archive_article();

        if ($this->firstsidebarchoice == "voted") {
            $data['sidebarname'] = "Rated Ads";
        } else if ($this->firstsidebarchoice == "notvoted") {
            $data['sidebarname'] = "New Questions";
        } else if ($this->firstsidebarchoice == "myraised") {
            $data['sidebarname'] = "My Questions";
        } else {
            $data['sidebarname'] = "Trending Questions";
        }

        $this->load->view('header', $header_data);
        $this->load->view('article', $data);
        $this->load->view('footer');
    }

    function load_archive_article() {
        $inputs = $this->input->post();
        $pageno = $inputs['pageno'];

        $offset = $pageno * 10;

        $data = $this->RatedArticle_Mod_s->get_archive_article($offset, 10, "archive");
        echo json_encode(array("status" => TRUE, "message" => "", "data" => $data));
    }

    function index1() {
        $sessiondata = $this->session->userdata('data');
        $header_data['page_title'] = "CrowdWisdom";
        $header_data['page_img'] = base_url("images/logo/Rated_Articles_share3.jpg");

        $data['user_info'] = $sessiondata;

        if (!empty($sessiondata)) {
            $data['user_info'] = $sessiondata;
            $user_id = $sessiondata['uid'];
            $data['user_id'] = $user_id;
        } else {
            $user_id = 0;
            $data['user_info']['uid'] = 0;
            $data['user_id'] = $user_id;
        }
        $article_cat = 0;
        $articleid = 0;
        $cat_id = 0;

        $data['articles'] = $this->RatedArticle_Mod_s->get_article_list($this->user_id);
        $data['archive_article'] = $this->RatedArticle_Mod_s->get_archive_article();

        $data['myraised'] = $this->RatedArticle_Mod_s->get_article_by_category('myraised', $this->user_id);
        //$data['articles'] = $this->RatedArticle_Mod_s->get_article_by_category($cat_id, $user_id, $articleid);
        $data['trending'] = $this->RatedArticle_Mod_s->get_article_by_category($this->firstsidebarchoice, $this->user_id);
        //$data['trending'] = $this->RatedArticle_Mod_s->get_trending_by_category($cat_id, $user_id);
        $data['total_articles']['articles'] = $this->RatedArticle_Mod_s->get_total_articles($cat_id);

        if ($this->firstsidebarchoice == "voted") {
            $data['sidebarname'] = "Rated Ads";
        } else if ($this->firstsidebarchoice == "notvoted") {
            $data['sidebarname'] = "New Questions";
        } else if ($this->firstsidebarchoice == "myraised") {
            $data['sidebarname'] = "My Questions";
        } else {
            $data['sidebarname'] = "Trending Questions";
        }

        $this->load->view('header', $header_data);
        $this->load->view('article', $data);
        $this->load->view('footer');
    }

    function details($id = NULL, $title = NULL) {
        $data['page_img'] = base_url("images/logo/Rated_Articles_share3.jpg");
        $sessiondata = $this->session->userdata('data');
        if (!empty($sessiondata)) {
            $data['user_info'] = $sessiondata;
            $user_id = $sessiondata['uid'];
        } else {
            $user_id = 0;
            $data['user_info']['uid'] = 0;
        }
        $data['article_id'] = $id;
        //$data['votedarticle'] = $this->RatedArticle_Mod_s->get_article_by_category('voted', $user_id);
        //$data['notvotedarticle'] = $this->RatedArticle_Mod_s->get_article_by_category('notvoted', $user_id);
        //$data['trending'] = $this->RatedArticle_Mod_s->get_article_by_category('trending', $user_id);
        //$data['myraised'] = $this->RatedArticle_Mod_s->get_article_by_category('myraised', $user_id);
        $data['article_detail'] = $this->RatedArticle_Mod_s->get_article_by_id($id, $user_id);
        //$data['archive_article'] = $this->RatedArticle_Mod_s->get_archive_article();
        //$article_cat = $this->RatedArticle_Mod_s->get_article_category();


        $articleid = 0;
        $cat_id = 0;


        $data['user_id'] = $sessiondata['uid'];
        //$data['votedarticle'] = $this->RatedArticle_Mod_s->get_article_by_category('voted', $user_id, $articleid);
        //$data['notvotedarticle'] = $this->RatedArticle_Mod_s->get_article_by_category('notvoted', $user_id, $articleid);
        //$data['trending'] = $this->RatedArticle_Mod_s->get_trending_by_category($data['article_detail']['category_id'], $user_id);
        //$data['trending'] = $this->RatedArticle_Mod_s->get_article_by_category($this->firstsidebarchoice, $user_id);
        //$data['page_title'] = $data['article_detail']['article'];
        $page_title = str_replace('"', '\'', $data['article_detail']['question']);
        $data['page_title'] = str_replace('&#039;', '\'', $page_title);

        //$data['page_img'] = $data['article_detail']['category_name'];
        if ($this->firstsidebarchoice == "voted") {
            $data['sidebarname'] = "Rated Ads";
        } else if ($this->firstsidebarchoice == "notvoted") {
            $data['sidebarname'] = "New Questions";
        } else if ($this->firstsidebarchoice == "myraised") {
            $data['sidebarname'] = "My Questions";
        } else {
            $data['sidebarname'] = "Trending Questions";
        }
        $this->load->view('header', $data);
        $this->load->view('articledetail', $data);
        $this->load->view('footer');
    }

    function add_update_article() {
        $sessiondata = $this->session->userdata('data');
        if (!empty($sessiondata)) {
            $inputs = $this->input->post();

            $discussion_id = $inputs['article_id'];
            $user_id = $sessiondata['uid'];
            $newaddedid = $this->RatedArticle_Mod_s->add_update_article_mod($inputs, $user_id);

            $msg = ($discussion_id == "0") ? "Article created successfully" : "Article updated successfully";

            $toastmsg = json_encode(array("status" => TRUE, "message" => $msg));
            $this->session->set_flashdata('toast', $msg);
            redirect('RatedArticle');
//            $category_id = $inputs['articlecatergory'];
//            $article_cat = $this->RatedArticle_Mod_s->get_article_category();
//            foreach ($article_cat as $fc) {
//                if ($category_id == $fc['id']) {
//                    $category_name = $fc['name'];
//                    redirect('RatedArticle');
//                }
//            }
        } else {
            redirect('Login?section=article');
        }
    }

    function article_action() {
        $sessiondata = $this->session->userdata('data');
        if (!empty($sessiondata)) {
            $articleid = $this->input->post('articleid');
            $userid = $this->input->post('userid');
            $type = $this->input->post('type');

            if (!empty($articleid) && !empty($userid) && !empty($type)) {
                $isnew = $this->RatedArticle_Mod_s->add_article_action($articleid, $userid, $type);
                $sessiondata = $this->session->userdata('data');
                $data['user_info'] = $sessiondata;
                $data['article_id'] = $articleid;
                $data['like_comments'] = $this->RatedArticle_Mod_s->get_article_comments($articleid, 'like');
                $data['dislike_comments'] = $this->RatedArticle_Mod_s->get_article_comments($articleid, 'dislike');
                $data['neutral_comments'] = $this->RatedArticle_Mod_s->get_article_comments($articleid, 'neutral');
                $data['total_like_comments'] = $this->RatedArticle_Mod_s->get_article_comments_count($articleid, 'like');
                $data['total_dislike_comments'] = $this->RatedArticle_Mod_s->get_article_comments_count($articleid, 'dislike');
                $data['total_neutral_comments'] = $this->RatedArticle_Mod_s->get_article_comments_count($articleid, 'neutral');

                $this->load->view('load_ajax_articlecomments', $data);
            }
        } else {
            echo json_encode(array("status" => FALSE, "message" => "", "redirect_url" => " Login"));
        }
    }

    function add_comment() {
        $sessiondata = $this->session->userdata('data');
        if (!empty($sessiondata)) {
            $user_id = $sessiondata['uid'];
            $articleid = $this->input->post('article_id');
            $article_cmt = $this->input->post('article_cmt_id');
            $article_comment = $this->input->post('article_comment');
            if (!empty($user_id) && !empty($articleid) && !empty($article_comment)) {
                $id = $this->RatedArticle_Mod_s->add_comment_mod($articleid, $user_id, $article_comment, $article_cmt);
                $comment_data = $this->RatedArticle_Mod_s->get_comment_by_id($id);
                echo json_encode(array("status" => TRUE, "message" => "Comment added successfully!", "data" => $comment_data));
                exit;
            } else {
                echo json_encode(array("status" => FALSE, "message" => "Please write comment"));
                exit;
            }
        } else {
            redirect(' Login?section=article');
        }
        //redirect(' Article/articledetail/' . $articleid);
    }

    function add_comment_reply() {

        $sessiondata = $this->session->userdata('data');
        if (!empty($sessiondata)) {
            $user_id = $sessiondata['uid'];
            $articleid = $this->input->post('article_id');
            $comment_id = $this->input->post('comment_id');
            $article_comment_reply = $this->input->post('article_comment_reply');
            if (!empty($user_id) && !empty($articleid) && !empty($comment_id) && !empty($article_comment_reply)) {
                $id = $this->RatedArticle_Mod_s->add_comment_reply_mod($articleid, $user_id, $article_comment_reply, $comment_id);
                $reply_data = $this->RatedArticle_Mod_s->get_comment_reply_by_id($id);
                echo json_encode(array("status" => TRUE, "message" => "Reply added successfully!", "data" => $reply_data));
            } else {
                echo json_encode(array("status" => FALSE, "message" => "Write a reply"));
            }
        } else {
            redirect('Login?section=article');
        }
    }

    function get_comment_replies() {
        $sessiondata = $this->session->userdata('data');

        $articleid = $this->input->post('articleid');
        $commentid = $this->input->post('commentid');
        $pagelimit = $this->input->post('pagelimit');
        $pagelimit = $pagelimit * 5;
        //echo $articleid." ".$commentid." ".$pagelimit;exit;
        if (!empty($commentid) && !empty($articleid)) {
            $response = $this->RatedArticle_Mod_s->get_comment_replies_mod($articleid, $commentid, $pagelimit);
            echo $response;
            exit;
            //$this->session->set_flashdata('toast', "reply added successfully!");
        } else {
            echo json_encode(array("status" => FALSE, "message" => "Something went wrong"));
            exit;
            //$this->session->set_flashdata('toast', "Please fill required field");
        }
    }

    function load_more_comments() {
        $sessiondata = $this->session->userdata('data');

        $articleid = $this->input->post('articleid');
        //$type = $this->input->post('type');
        $offset = $this->input->post('pagelimit');
        if ($offset != 0) {
            $offset = $offset * 10;
            $limit = 10;
        } else {
            $offset = 2;
            $limit = 8;
        }


        $comments = $this->RatedArticle_Mod_s->get_article_comments($articleid, $offset, $limit);
        if (empty($comments)) {
            $response = json_encode(array("status" => FALSE, "message" => "No Comments found"));
        } else {
            $response = json_encode(array("status" => TRUE, "message" => "Comments found", "data" => $comments));
        }
        echo $response;
        exit;
    }

    function deactive_article() {
        $articleid = $this->input->post('articleid');
        //var_dump($articleid);exit;
        if (!empty($articleid)) {
            $this->RatedArticle_Mod_s->make_deactive_article($articleid);
        }
        $response = json_encode(array("status" => FALSE, "message" => "Something went wrong"));
        echo $response;
        exit;
    }

    function deactivecmt() {
        $cmtid = $this->input->post('comment');
        //$articlecmt=
        //var_dump($articleid);exit;
        if (!empty($cmtid)) {
            $this->RatedArticle_Mod_s->make_deactive_comment($cmtid);
        }
        $response = json_encode(array("status" => FALSE, "message" => "Something went wrong"));
        echo $response;
        exit;
    }

    function likecomment() {
        $sessiondata = $this->session->userdata('data');
        if (!empty($sessiondata)) {
            $user_id = $sessiondata['uid'];
            $cmtid = $this->input->post('comment');
            if (!empty($cmtid)) {
                $this->RatedArticle_Mod_s->likecomment_mod($cmtid, $user_id);
            }
            $response = json_encode(array("status" => FALSE, "message" => "Something went wrong"));
            echo $response;
            exit;
        } else {
            redirect(' Login?section=article');
        }
    }

    function addarticlechoice() {
        $input = $this->input->post();

        $sessiondata = $this->session->userdata('data');
        if (!empty($sessiondata)) {
            $user_id = $sessiondata['uid'];
            $isvote = $this->RatedArticle_Mod_s->addarticlechoice_mod($input, $user_id);
            $articleid = $input['article_id'];
            $vote = $this->RatedArticle_Mod_s->get_article_by_id($articleid, $user_id);
            if ($isvote == 0) {
                echo json_encode(array("status" => TRUE, "message" => "You got one point", "data" => $vote, "isnew" => 1));
            } else {
                echo json_encode(array("status" => TRUE, "message" => "Vote changed successfully", "data" => $vote, "isnew" => 0));
            }
            //var_dump($vote);exit;
        } else {
            echo json_encode(array("status" => FALSE, "message" => "", "redirect_url" => " Login"));
        }
    }

    function getsilverpoints() {
        $this->load->helper('common_helper');
        $points = get_silver_points();
        echo $points;
    }

//    function load_more_articles(){
//        $category_id=$this->input->post('category_id');
//        $offset=$this->input->post('offset');
//        $offset=$offset*10;
//        $articleid=0;
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
//        $article_data=$this->RatedArticle_Mod_s->get_article_by_category($category_id,$user_id,$articleid,$cat_id,$offset);
//        echo '<pre>';
//        print_r($article_data);exit;
//    }

    function loadmoremyraised() {
        $pageno = $this->input->post('pageno');
        $pageno = $pageno * 10;
        $sessiondata = $this->session->userdata('data');
        $articleid = 0;
        if (!empty($sessiondata)) {
            $data['user_info'] = $sessiondata;
            $user_id = $sessiondata['uid'];
            $data['user_id'] = $user_id;
        } else {
            $user_id = 0;
            $data['user_info']['uid'] = 0;
            $data['user_id'] = $user_id;
        }
        $result = $this->RatedArticle_Mod_s->get_article_by_category('myraised', $user_id, $articleid, $pageno);
        $status = TRUE;
        if (empty($result)) {
            $status = FALSE;
        }
        echo json_encode(array("status" => $status, "message" => "Trending data found", "data" => $result));
    }

    function loadmoretrending() {
        $cat_id = $this->input->post('categoryid');
        $pageno = $this->input->post('pageno');
        $type = $this->input->post('type');
        $articleid = 0;

        $data['next_page'] = $pageno + 1;
        $pageno = $pageno * 10;
        $sessiondata = $this->session->userdata('data');
        if (!empty($sessiondata)) {
            $data['user_info'] = $sessiondata;
            $user_id = $sessiondata['uid'];
            $data['user_id'] = $user_id;
        } else {
            $user_id = 0;
            $data['user_info']['uid'] = 0;
            $data['user_id'] = $user_id;
        }
        //$result = $this->RatedArticle_Mod_s->get_article_list($user_id, $pageno);
        $result = $this->RatedArticle_Mod_s->get_article_by_category($this->firstsidebarchoice, $user_id, 0, $pageno);
        //$result = $this->RatedArticle_Mod_s->get_trending_by_category('all', $user_id, $pageno);

        $status = TRUE;
        if (empty($result)) {
            $status = FALSE;
        }
        echo json_encode(array("status" => $status, "message" => "Trending data found", "data" => $result));
    }

    function loadmorearticledata() {
        $cat_id = $this->input->post('categoryid');
        $pageno = $this->input->post('pageno');
        $type = "gov";
        $articleid = $this->input->post('articleid');

        if (empty($articleid)) {
            $articleid = 0;
        }

        $data['next_page'] = $pageno + 1;
        $pageno = $pageno * 10;
        $sessiondata = $this->session->userdata('data');
        //$article_cat = $this->RatedArticle_Mod_s->get_article_category();
        if (!empty($sessiondata)) {
            $data['user_info'] = $sessiondata;
            $user_id = $sessiondata['uid'];
            $data['user_id'] = $user_id;
        } else {
            $user_id = 0;
            $data['user_info']['uid'] = 0;
            $data['user_id'] = $user_id;
        }

        $data['moredata'] = $this->RatedArticle_Mod_s->get_article_list($user_id, $pageno);
        //$data['moredata'] = $this->RatedArticle_Mod_s->get_article_by_category($cat_id, $user_id, $articleid, $pageno);
        $data['total_articles'] = $this->RatedArticle_Mod_s->get_total_articles($cat_id);

        $data['category_name'] = "";
        $data['section'] = $type;
        $data['category_id'] = $cat_id;
        $this->load->view('load_ajax_article', $data);
    }

    function getmetatags() {
        $url = $this->input->post('url');
        $data = file_get_contents($url);
        $dom = new DomDocument;
        @$dom->loadHTML($data);

        $xpath = new DOMXPath($dom);
        # query metatags with og prefix
        $metas = $xpath->query('//*/meta[starts-with(@property, \'og:\')]');

        $og = array();

        foreach ($metas as $meta) {
            # get property name without og: prefix
            $property = str_replace('og:', '', $meta->getAttribute('property'));
            # get content
            $content = $meta->getAttribute('content');
            $og[$property] = $content;
        }
        //var_dump($og);exit;
        if (!isset($og['image'])) {
            $og['image'] = base_url() . 'images/common/no-image.png';
        }
        if (!isset($og['description'])) {
            $og['description'] = "";
        }
        if (!isset($og['url'])) {
            $og['url'] = "";
        }
        $og['url'] = parse_url($url)['host'];
        if (!isset($og['title'])) {
            $res = preg_match("/<title>(.*)<\/title>/siU", $data, $title_matches);
            if (!$res)
                return null;

            // Clean up title: remove EOL's and excessive whitespace.
            $title = preg_replace('/\s+/', ' ', $title_matches[1]);
            $title = trim($title);
            $og['title'] = $title;
        }
        echo json_encode(array("status" => TRUE, "data" => $og));
    }

}
