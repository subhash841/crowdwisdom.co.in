<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dashboard extends Base_Controller {

    private $user_id = 0;
    private $sport_period_id = 0;
    private $sport_id = 0;
    private $is_result_out = NULL;

    function __construct() {
        parent::__construct();
        $this->load->helper('common_helper');
        $this->load->model('Sports/Dashboard_Mod');
        $userdata = $this->session->userdata('data');

        $this->user_id = $userdata['uid'];

        $sport_period = get_current_sport_period(1);
        $this->sport_period_id = $sport_period[0]['id'];
        $this->sport_id = $sport_period[0]['sport_id'];
        $this->is_result_out = $sport_period[0]['is_result_out'];
    }

    public function index() {
        $user_id = $this->user_id;
        $sport_id = $this->sport_id;
        $sport_period_id = $this->sport_period_id;

        $header_data['page_title'] = "Sports - Prediction";
        $header_data['page_img'] = base_url() . "images/common/ipl_preview.jpg";

        $data['blogs'] = getAllBlogs();
        $data['sport_period_id'] = $sport_period_id;
        $data['sport_id'] = $sport_id;
        $data['is_result_out'] = $this->is_result_out;

        $data['user_forecast'] = $this->Dashboard_Mod->get_user_sport_forecast_details($user_id, $sport_period_id, $sport_id);
        $data['forecast_reason'] = $this->Dashboard_Mod->get_user_sport_forecast_reason($user_id, $sport_period_id);

        $this->load->view('header', $header_data);
        $this->load->view('Sports/banner');
        $this->load->view('Sports/user_forecast', $data);
        $this->load->view('footer');
    }

    /* STEP - 1
     * 
     * updateUserForecast
     * Update users SEAT AND VOTE forecast when user play any game
     */

    function updateUserForecast() {
        $is_result_out = $this->is_result_out;

        if ($is_result_out == "1") {
            echo json_encode(array("status" => FALSE, "message" => "Forecast programe has stoped now."));
            return false;
        }
        $inputs = $this->input->post();
        $inputs['user_id'] = $this->user_id;

        $this->Dashboard_Mod->update_user_forecast($inputs);
    }

}
