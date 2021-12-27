<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NewHome extends CI_Controller {

    private $user_id = 0;

    function __construct() {
        parent::__construct();
        $this->load->model('Poll_Mod');

        $sessiondata = $this->session->userdata('data');
        if (!empty($sessiondata)) {
            $this->user_id = $sessiondata['uid'];
        } else {
            $this->user_id = 0;
        }
    }

    function index() {
        $data = array();

        //$header_data['page_title'] = "Wisdom, By the people, for the people";
        $header_data['page_title'] = "Wisdom Of The Crowds: India Crowd Sourcing, India Free Surveys - CrowdWisdom";
        $header_data['page_description'] = "CrowdWisdom uses the concept of Wisdom of the Crowds, India Crowd Sourcing, India Free Surveys and Crowd Sources the most relevant and accurate predictions, information and advice.";
        $header_data['page_img'] = base_url("images/logo/prediction_share_logo.png");

        $this->load->view('new_header_1', $header_data);
        $this->load->view('new_home_1', $data);
        $this->load->view('new_footer_1');
    }

    function prediction() {
        $data = array();

        $header_data['page_title'] = "Home";
        $header_data['page_img'] = base_url("images/logo/prediction_share_logo.png");

        //$data['trending'] = $this->Poll_Mod->get_poll_by_category('trending', $this->user_id);
        //$data['trending'] = $this->Poll_Mod->get_poll_list('trending', $this->user_id);
        $data['trending'] = $this->Poll_Mod->get_treding_predictions($this->user_id);

        $this->load->view('header', $header_data);
        $this->load->view('new_home', $data);
        $this->load->view('footer');
    }

    function load_trending_predictions() {
        $inputs = $this->input->post();
        $category = $inputs['categoryid'];
        $pageno = $inputs['pageno'];

        $offset = $pageno * 10;

        $result = $this->Poll_Mod->get_treding_predictions($this->user_id, $offset);

        $status = TRUE;
        if (empty($result)) {
            $status = FALSE;
        }
        echo json_encode(array("status" => $status, "message" => "Trending data found", "data" => $result));
    }

}
