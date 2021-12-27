<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FakeNews extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('FakeNew_Mod');
    }

    function index() {
        $header_data['page_title'] = "Fake News";
        $header_data['page_img'] = base_url() . "images/logo/prediction_share_logo.png";
        $data = array();
        
        $data['fake_news'] = $this->FakeNew_Mod->get_fake_news();
        
        $this->load->view('header', $header_data);
        $this->load->view('fakenews');
        $this->load->view('footer');
    }

}
