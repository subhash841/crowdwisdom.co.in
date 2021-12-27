<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Gujarat/Results_Mod');
        //$this->load->helper('Gujarat/common_helper');
    }

    function index() {
        $available = "0";
        $election_period = get_election_period();
        //$election_period_id = $election_period[0]['id'];
        $election_period_id = "1";

        $data['user_avg_forecast'] = $this->Results_Mod->get_seat_vote_avg_forecasting($election_period_id);
        $data['blogs'] = getAllBlogs();

        //$data['tweets'] = get_twitter_tweets();
        $data['tweets'] = array();
        $data['is_result_out'] = $election_period[0]['is_result_out'];
        $data['certified_users'] = get_certified_users();

        $this->load->view('Gujarat/header');
        //Enable Result page for party wise result - after result declaration
        $this->load->view('Gujarat/result', $data);

//        if (!empty($data['user_avg_forecast'])) {
//
//            foreach ($data['user_avg_forecast'] as $avg_forecast) {
//                if (round($avg_forecast['avg_seatforecast']) > 0) {
//                    $available = "1";
//                    break;
//                }
//            }
//
//            $load_view = ($available == "1") ? "home1" : "home";
//            $this->load->view("Gujarat/" . $load_view, $data);
//        } else {
//            $this->load->view('Gujarat/home', $data);
//        }
        $this->load->view('Gujarat/footer');
    }

    function home() {
        $this->load->view('header');
        $this->load->view('home1');
        $this->load->view('footer');
    }

    function aboutus() {
        $this->load->view('header');
        $this->load->view('aboutus');
        $this->load->view('footer');
    }

    function result() {
        $available = "0";
        $election_period = get_election_period();
        $election_period_id = $election_period[0]['id'];

        $data['user_avg_forecast'] = $this->Results_Mod->get_seat_vote_avg_forecasting($election_period_id);
        $data['blogs'] = getAllBlogs();
        $data['tweets'] = get_twitter_tweets();
        $data['is_result_out'] = $election_period[0]['is_result_out'];
        $data['certified_users'] = get_certified_users();

        $this->load->view('Gujarat/header');
        $this->load->view('Gujarat/result', $data);
        $this->load->view('Gujarat/footer');
    }

    function resultlist() {
        $data['certified_users'] = get_certified_users();
        $this->load->view('Gujarat/resultlist', $data);
        $this->load->view('Gujarat/footer');
    }

    function singleresult($id) {
        $data = $this->Results_Mod->get_actual_and_users_seat_vote_forecast($id);
        $this->load->view('Gujarat/singleresult', $data);
        $this->load->view('Gujarat/footer');
    }

    function ajax_users_list($offset) {
        $certified_users = get_certified_users($offset);
        echo json_encode($certified_users);
    }

}
