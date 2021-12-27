<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reasons extends CI_Controller {

    private $sport_period_id = 0;
    private $sport_id = 0;

    function __construct() {
        parent::__construct();

        $this->load->helper('common_helper');
        $this->load->model('Sports/Reasons_Mod');

        $sport_period = get_current_sport_period(1);
        $this->sport_period_id = $sport_period[0]['id'];
        $this->sport_id = $sport_period[0]['sport_id'];
    }

    function index() {
        $data['reasons'] = $this->Reasons_Mod->get_users_sport_forecast_and_reasons($this->sport_period_id, $this->sport_id, 'Sport');
        $data['total_reasons'] = $this->Reasons_Mod->get_forecast_reasons_count($this->sport_period_id, $this->sport_id, 'Sport');

        $header_data['page_title'] = "Reasons";
        $header_data['page_img'] = base_url() . "images/common/ipl_preview.jpg";
        $this->load->view('header', $header_data);
        $this->load->view('Sports/banner');
        $this->load->view('Sports/reason', $data);
        $this->load->view('Allindia/footer');
    }

    function Page($offset = 1) {
        $data['current_page'] = $offset;
        $offset = $offset - 1;
        $offset = $offset * 10;

        $data['reasons'] = $this->Reasons_Mod->get_users_sport_forecast_and_reasons($this->sport_period_id, $this->sport_id, 'Sport', $offset);
        $data['total_reasons'] = $this->Reasons_Mod->get_forecast_reasons_count($this->sport_period_id, $this->sport_id, 'Sport');

        $header_data['page_title'] = "Reasons";
        $header_data['page_img'] = base_url() . "images/common/ipl_preview.jpg";

        $this->load->view('header', $header_data);
        $this->load->view('Sports/banner');
        $this->load->view('Sports/reason', $data);
        $this->load->view('Allindia/footer');
    }

}
