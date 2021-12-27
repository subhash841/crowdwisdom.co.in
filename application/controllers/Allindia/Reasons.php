<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reasons extends CI_Controller {

    private $election_period_id = 0;
    private $state_id = 0;

    function __construct() {
        parent::__construct();

        $this->load->helper('common_helper');
        $this->load->model('Allindia/Reasons_Mod');

        $election_period = get_current_election_period();
        $this->election_period_id = $election_period[0]['id'];
        $this->state_id = $election_period[0]['state_id'];
    }

    function index() {
        $data['reasons'] = $this->Reasons_Mod->get_users_forecast_and_reasons($this->election_period_id, $this->state_id);
        $data['total_reasons'] = $this->Reasons_Mod->get_forecast_reasons_count($this->election_period_id, $this->state_id);

        $page_title['page_title'] = "Reasons";
        $this->load->view('header', $page_title);
        $this->load->view('banner');
        $this->load->view('Allindia/reason', $data);
        $this->load->view('Allindia/footer');
    }

    function Page($offset = 1) {
        $data['current_page'] = $offset;
        $offset = $offset - 1;
        $offset = $offset * 10;
        
        $data['reasons'] = $this->Reasons_Mod->get_users_forecast_and_reasons($this->election_period_id, $this->state_id, $offset);
        $data['total_reasons'] = $this->Reasons_Mod->get_forecast_reasons_count($this->election_period_id, $this->state_id);

        $page_title['page_title'] = "Reasons";
        $this->load->view('header', $page_title);
        $this->load->view('banner');
        $this->load->view('Allindia/reason', $data);
        $this->load->view('Allindia/footer');
    }

    function load_more_reasons() {
        $offset = $this->input->post('page_no');
        $offset = $offset * 10;

        $data = $this->Reasons_Mod->get_users_forecast_and_reasons($this->election_period_id, $this->state_id, $offset);
        if (count($data) > 0) {
            echo json_encode(array("status" => TRUE, "message" => "More reasons found", "data" => $data));
        } else {
            echo json_encode(array("status" => False, "message" => "No more reasons found"));
        }
    }

}
