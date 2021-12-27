<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Results extends Base_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Results_Mod');
    }

    function index() {
        $election_period = get_election_period();
        $election_period_id = $election_period[0]['id'];

        $data['user_avg_forecast'] = $this->Results_Mod->get_seat_vote_avg_forecasting($election_period_id);
        $this->render('home1', $data);
    }

}
