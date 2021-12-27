<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Forum extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('Forum_Mod');
    }

    function index()
    {
        $sessiondata = $this->session->userdata('data');
        $data['page_title'] = "Forum";
        $data['user_info'] = $sessiondata;
        $data['mydiscussions'] = $this->Forum_Mod->get_my_discussions($sessiondata['uid']);
        $forum_cat = $this->Forum_Mod->get_forum_category();

        $data['category_list'] = $forum_cat;
        $data['user_id'] = $sessiondata['uid'];
        //$data['allforum'] = $this->Forum_Mod->get_forum_by_category('All');
        foreach ($forum_cat as $fc) {
            $data[strtolower($fc['name'])] = $this->Forum_Mod->get_forum_by_category($fc['id']);
        }
//        echo "<pre>";
//        print_r($data);exit;
        $this->load->view('header', $data);
        $this->load->view('forum', $data);
        $this->load->view('footer');
    }

    function forumdetail($id = NULL, $title = NULL)
    {
        $sessiondata = $this->session->userdata('data');
        if (!empty($sessiondata)) {
            $data['user_info'] = $sessiondata;
            $user_id = $sessiondata['uid'];
        } else {
            $user_id = 0;
            $data['user_info']['uid'] = 0;
        }
        $data['forum_id'] = $id;
        $data['allforum'] = $this->Forum_Mod->get_forum_by_category('All');
        $data['forum_detail'] = $this->Forum_Mod->get_forum_by_id($id, $user_id);
        $data['page_title'] = $data['forum_detail']['title'];
        $data['page_image'] = $data['forum_detail']['image'];
        $data['All_comments'] = $this->Forum_Mod->get_forum_comments($id, 'All');
        $data['like_comments'] = $this->Forum_Mod->get_forum_comments($id, 'like');
        $data['dislike_comments'] = $this->Forum_Mod->get_forum_comments($id, 'dislike');
        $data['neutral_comments'] = $this->Forum_Mod->get_forum_comments($id, 'neutral');
        $data['total_comments'] = $this->Forum_Mod->get_forum_comments_count($id, 'All');
        $data['total_like_comments'] = $this->Forum_Mod->get_forum_comments_count($id, 'like');
        $data['total_dislike_comments'] = $this->Forum_Mod->get_forum_comments_count($id, 'dislike');
        $data['total_neutral_comments'] = $this->Forum_Mod->get_forum_comments_count($id, 'neutral');

        $this->load->view('header', $data);
        $this->load->view('forumdetail', $data);
        $this->load->view('footer');
    }

    function add_update_discussion()
    {
        $sessiondata = $this->session->userdata('data');
        if (!empty($sessiondata)) {
            $inputs = $this->input->post();

            $discussion_id = $inputs['discussion_id'];
            $user_id = $sessiondata['uid'];
            $newaddedid = $this->Forum_Mod->add_update_discussion_mod($inputs, $user_id);

            $msg = ($discussion_id == "0") ? "Added discussion successfully" : "discussion updated successfully";
            $toastmsg = json_encode(array("status" => TRUE, "message" => $msg));
            $this->session->set_flashdata('toast', $msg);
            redirect('Forum/forumdetail/' . $newaddedid);
        } else {
            redirect('Login');
        }
    }

    function forum_action()
    {
        $sessiondata = $this->session->userdata('data');
        if (!empty($sessiondata)) {
            $forumid = $this->input->post('forumid');
            $userid = $this->input->post('userid');
            $type = $this->input->post('type');

            if (!empty($forumid) && !empty($userid) && !empty($type)) {
                $isnew = $this->Forum_Mod->add_forum_action($forumid, $userid, $type);
                $sessiondata = $this->session->userdata('data');
                $data['user_info'] = $sessiondata;
                $data['forum_id'] = $forumid;
                $data['like_comments'] = $this->Forum_Mod->get_forum_comments($forumid, 'like');
                $data['dislike_comments'] = $this->Forum_Mod->get_forum_comments($forumid, 'dislike');
                $data['neutral_comments'] = $this->Forum_Mod->get_forum_comments($forumid, 'neutral');
                $data['total_like_comments'] = $this->Forum_Mod->get_forum_comments_count($forumid, 'like');
                $data['total_dislike_comments'] = $this->Forum_Mod->get_forum_comments_count($forumid, 'dislike');
                $data['total_neutral_comments'] = $this->Forum_Mod->get_forum_comments_count($forumid, 'neutral');

                $this->load->view('load_ajax_forumcomments', $data);
            }
        } else {
            echo json_encode(array("status" => FALSE, "message" => "", "redirect_url" => "Login"));
        }
    }

    function add_comment()
    {
        $sessiondata = $this->session->userdata('data');
        if (!empty($sessiondata)) {
            $user_id = $sessiondata['uid'];
            $forumid = $this->input->post('forum_id');
            $forum_comment = $this->input->post('forum_comment');
            if (!empty($user_id) && !empty($forumid) && !empty($forum_comment)) {
                $id = $this->Forum_Mod->add_comment_mod($forumid, $user_id, $forum_comment);
                $comment_data = $this->Forum_Mod->get_comment_by_id($id);
                echo json_encode(array("status" => TRUE, "message" => "Comment added successfully!", "data" => $comment_data));
                exit;
            } else {
                echo json_encode(array("status" => FALSE, "message" => "Please write comment"));
                exit;
            }
        } else {
            redirect('Login');
        }
        //redirect('Forum/forumdetail/' . $forumid);
    }

    function add_comment_reply()
    {

        $sessiondata = $this->session->userdata('data');
        if (!empty($sessiondata)) {
            $user_id = $sessiondata['uid'];
            $forumid = $this->input->post('forum_id');
            $comment_id = $this->input->post('comment_id');
            $forum_comment_reply = $this->input->post('forum_comment_reply');
            if (!empty($user_id) && !empty($forumid) && !empty($comment_id) && !empty($forum_comment_reply)) {
                $id = $this->Forum_Mod->add_comment_reply_mod($forumid, $user_id, $forum_comment_reply, $comment_id);
                $reply_data = $this->Forum_Mod->get_comment_reply_by_id($id);
                echo json_encode(array("status" => TRUE, "message" => "Reply added successfully!", "data" => $reply_data));
            } else {
                echo json_encode(array("status" => FALSE, "message" => "Please write comment"));
            }
        } else {
            redirect('Login');
        }
    }

    function get_comment_replies()
    {
        $sessiondata = $this->session->userdata('data');
        
            $forumid = $this->input->post('forumid');
            $commentid = $this->input->post('commentid');
            $pagelimit = $this->input->post('pagelimit');
            $pagelimit = $pagelimit * 5;
            //echo $forumid." ".$commentid." ".$pagelimit;exit;
            if (!empty($commentid) && !empty($forumid)) {
                $response = $this->Forum_Mod->get_comment_replies_mod($forumid, $commentid, $pagelimit);
                echo $response;
                exit;
                //$this->session->set_flashdata('toast', "reply added successfully!");
            } else {
                echo json_encode(array("status" => FALSE, "message" => "Something went wrong"));
                exit;
                //$this->session->set_flashdata('toast', "Please fill required field");
            }
        
    }

    function load_more_comments()
    {
        $sessiondata = $this->session->userdata('data');
        
            $forumid = $this->input->post('forumid');
            $type = $this->input->post('type');
            $offset = $this->input->post('pagelimit');
            $offset = $offset * 10;

            $comments = $this->Forum_Mod->get_forum_comments($forumid, $type, $offset);
            if (empty($comments)) {
                $response = json_encode(array("status" => FALSE, "message" => "No Comments found"));
            } else {
                $response = json_encode(array("status" => TRUE, "message" => "Comments found", "data" => $comments));
            }
            echo $response;
            exit;
        
    }
    function deactive_forum(){
        $forumid= $this->input->post('forumid');
        //var_dump($forumid);exit;
        if(!empty($forumid)){
          $this->Forum_Mod->make_deactive_forum($forumid);  
        }
        $response = json_encode(array("status" => FALSE, "message" => "Something went wrong"));
        echo $response;exit;
    }
}
