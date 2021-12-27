<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Stock/Results_Mod');
        $this->load->helper('common_helper');
    }

    function index1() {
        $data['blogs'] = getAllBlogs();
        $data['tweets'] = get_twitter_tweets("#stocks");
        $this->load->view('Stock/header');
        $this->load->view('Stock/home', $data);
        $this->load->view('Stock/footer');
    }

    function index() {
        $available = "0";
        $codes = "";
        $stock_period = get_stock_period();
        $stock_period_id = $stock_period[0]['id'];

        $election_period = get_election_period();
        $election_period_id = $election_period[0]['id'];

        $page_title['page_title'] = "Crowdwisdom";
        $data['user_avg_forecast'] = $this->Results_Mod->get_stock_avg_forecasting($stock_period_id);
        $data['user_election_avg_forecast'] = $this->Results_Mod->get_seat_vote_avg_forecasting($election_period_id);

        $data['blogs'] = getAllBlogs();
        $data['tweets'] = get_twitter_tweets("#stocks");
        $data['is_result_out'] = $stock_period[0]['is_result_out'];
        $data['weekly_endon_date'] = $stock_period[0]['weekly_endon_date'];
        $data['monthly_endon_date'] = $stock_period[0]['monthly_endon_date'];
        $data['yearly_endon_date'] = $stock_period[0]['yearly_endon_date'];
        //$data['certified_users'] = get_certified_users();

        foreach ($data['user_avg_forecast'] as $stock_forecast) {
            $codes .= $stock_forecast['stock_code'] . ",";
        }
        $codes = chop($codes, ",");
        $data['stock_codes'] = $codes;

        $this->load->view('Stock/header', $page_title);
        $this->load->view('Stock/home', $data);
        $this->load->view('Stock/footer');
    }

    function losers() {
        $this->load->view('Stock/header');
        $this->load->view('Stock/home-losers');
        $this->load->view('Stock/footer');
    }

    function gainerslist() {
        $this->load->view('Stock/header');
        $this->load->view('Stock/gainers');
        $this->load->view('Stock/footer');
    }

    function loserslist() {
        $this->load->view('Stock/header');
        $this->load->view('Stock/losers');
        $this->load->view('Stock/footer');
    }

    function expert_forecast() {
        $available = "0";
        $codes = "";
        $is_expert_avg = TRUE;
        $stock_period = get_stock_period();
        $stock_period_id = $stock_period[0]['id'];

        $page_title['page_title'] = "Crowdwisdom";
        $data['user_avg_forecast'] = $this->Results_Mod->get_stock_avg_forecasting($stock_period_id, $is_expert_avg);
        $data['blogs'] = getAllBlogs();
        $data['tweets'] = get_twitter_tweets("#stocks");
        $data['is_result_out'] = $stock_period[0]['is_result_out'];
        $data['weekly_endon_date'] = $stock_period[0]['weekly_endon_date'];
        $data['monthly_endon_date'] = $stock_period[0]['monthly_endon_date'];
        $data['yearly_endon_date'] = $stock_period[0]['yearly_endon_date'];
        //$data['certified_users'] = get_certified_users();

        foreach ($data['user_avg_forecast'] as $stock_forecast) {
            $codes .= $stock_forecast['stock_code'] . ",";
        }
        $codes = chop($codes, ",");
        $data['stock_codes'] = $codes;

        $this->load->view('Stock/header', $page_title);
        $this->load->view('Stock/expert_forecast', $data);
        $this->load->view('Stock/footer');
    }

    function getStockPriceDetails() {
        $symbol = $this->input->post('symbol');
        $result = get_stock_price_details($symbol);
        echo $result;
    }

}
