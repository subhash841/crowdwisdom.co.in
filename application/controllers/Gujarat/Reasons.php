<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reasons extends Base_Controller {
    //protected $election_period_id = "";
    //protected $state_id = "";
    function __construct() {
        parent::__construct();
        //$this->election_period_id = "2";
        //$this->state_id = "17";
        //$this->load->model('Gujarat/Reasons_Mod');
    }

    function index() {
        //$data['reasons'] = $this->Reasons_Mod->get_users_forecast_and_reasons($this->election_period_id, $this->state_id);
        //$page_title['page_title'] = "Reasons";
        //$this->load->view('header', $page_title);
        //$this->load->view('Karnataka/reason', $data);
        //$this->load->view('Karnataka/footer');
     $data['reasons']= $this->Reasons_Mod->get_forecast_list(1);
    }

}
