<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reasons extends CI_Controller {

    protected $election_period_id = "";
    protected $state_id = "";

    function __construct() {
        parent::__construct();
        $this->election_period_id = "2";
        $this->state_id = "17";
        $this->load->model('Karnataka/Reasons_Mod');
    }

    function index() {
        $data['reasons'] = $this->Reasons_Mod->get_users_forecast_and_reasons($this->election_period_id, $this->state_id);
        $page_title['page_title'] = "Reasons";
        $this->load->view('header', $page_title);
        $this->load->view('Karnataka/reason', $data);
        $this->load->view('Karnataka/footer');

//        $data['reasons'] = $this->Reasons_Mod->get_forecast_list(2);
//        $data['page_title'] = "Reasons";
//        $this->load->view('header', $data);
//        $this->load->view('Karnataka/reason', $data);
//        $this->load->view('Karnataka/footer');
    }
    
    function load_more_reasons(){
        $offset= $this->input->post('page_no');
        $offset=$offset*10;
        
        $data=$this->Reasons_Mod->get_users_forecast_and_reasons($this->election_period_id, $this->state_id,$offset);
        if(count($data)>0){
            echo json_encode(array("status"=>TRUE,"message"=>"More reasons found","data"=>$data));
        } else {
            echo json_encode(array("status"=>False,"message"=>"No more reasons found"));
        }
    }

}
