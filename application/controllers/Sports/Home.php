<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('common_helper');
        $this->load->model('Sports/Results_Mod');

        $sport_period = get_current_sport_period(1);
        $this->sport_period_id = $sport_period[0]['id'];
        $this->sport_id = $sport_period[0]['sport_id'];
        $this->is_result_out = $sport_period[0]['is_result_out'];
    }

    public function index() {
        $sport_period_id = $this->sport_period_id;
        $sport_id = $this->sport_id;

        $header_data['page_title'] = "Cricket Results Prediction - CrowdWisdom";
        $header_data['page_description'] = "CrowdWisdom uses the concept of Cricket Results Prediction and Crowd Sources the most relevant and accurate predictions, information and advice.";
        $header_data['page_img'] = base_url() . "images/common/ipl_preview.jpg";

        $data['user_avg_forecast'] = $this->Results_Mod->get_avg_sport_forecast($sport_period_id, $sport_id);
        $data['is_result_out'] = $this->is_result_out;
        $data['blogs'] = getAllBlogs();

        $this->load->view('header', $header_data);
        $this->load->view('Sports/banner');

        if (!empty($data['user_avg_forecast'])) {

            foreach ($data['user_avg_forecast'] as $avg_forecast) {
                if (round($avg_forecast['avg_scoreforecast']) > 0) {
                    $available = "1";
                    break;
                }
            }

            $load_view = ($available == "1") ? "Sports/home" : "Sports/default_home";
            $this->load->view($load_view, $data);
        } else {
            $this->load->view('Sports/default_home', $data);
        }

        $this->load->view('footer');
    }

}
