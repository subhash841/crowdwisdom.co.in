<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Results_Mod extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_seat_vote_avg_forecasting($election_period_id) {

        /* Get AVG SEAT Forecasts */
        $this->db->select("uf.id,uf.election_period_id,uf.state_id,uf.party_id,AVG(uf.seat_forecast) as avg_seatforecast,p.name as party_name, p.abbreviation, p.icon");
        $this->db->from("user_forecasting uf");
        $this->db->join("parties p", "uf.party_id = p.id", "INNER");
        $this->db->where("election_period_id = $election_period_id AND state_id = 17 AND user_id not in (select user_id from user_forecasting WHERE election_period_id = $election_period_id and state_id = 17 group by user_id having sum(seat_forecast) = 0)");
        $this->db->group_by("party_id");
        //$this->db->order_by("party_id"); for gujrat
        $this->db->order_by("uf.id");
        $avg_forecasting['avg_seatforecast'] = $this->db->get()->result_array();

        /* Get AVG VOTE Forecasts */
        $this->db->select("uf.id,uf.election_period_id,uf.state_id,uf.party_id,AVG(uf.vote_forcast) as avg_voteforcast,p.name as party_name, p.abbreviation, p.icon");
        $this->db->from("user_forecasting uf");
        $this->db->join("parties p", "uf.party_id = p.id", "INNER");
        $this->db->where("election_period_id = $election_period_id AND state_id = 17 AND user_id not in (select user_id from user_forecasting WHERE election_period_id = $election_period_id and state_id = 17 group by user_id having sum(vote_forcast) = 0)");
        $this->db->group_by("party_id");
        //$this->db->order_by("party_id"); for gujrat
        $this->db->order_by("uf.id");
        $avg_forecasting['avg_voteforcast'] = $this->db->get()->result_array();

        //get min max SEAT forecast
        $this->db->select("party_id, MAX(seat_forecast) as maximum_seat, MIN(seat_forecast) as minimum_seat");
        $this->db->from("user_forecasting");
        $this->db->where("election_period_id = $election_period_id AND state_id = 17");
        $this->db->group_by("party_id");
        //$this->db->order_by("party_id"); for gujrat
        $this->db->order_by("id");
        $min_max_seat_forecasting = $this->db->get()->result_array();

        //get min max VOTE forecast
        $this->db->select("party_id, MAX(vote_forcast) as maximum_vote, MIN(vote_forcast) as minimum_vote");
        $this->db->from("user_forecasting");
        $this->db->where("election_period_id = $election_period_id AND state_id = 17");
        $this->db->group_by("party_id");
        //$this->db->order_by("party_id"); for gujrat
        $this->db->order_by("id");
        $min_max_vote_forecasting = $this->db->get()->result_array();

        //Get actual result for SEAT and VOTE forecast
        $this->db->select("election_period_id,state_id,party_id,actual_seats,actual_votes");
        $this->db->from("state_party");
        $this->db->where("is_active = '1' AND election_period_id = $election_period_id AND state_id = 17");
        $this->db->order_by('party_id');
        $actual_seat_vote_result = $this->db->get()->result_array();

        $forecast = [];
        foreach ($avg_forecasting['avg_seatforecast'] as $key => $forecasting) {

            $avg_forecasting['avg_seatforecast'][$key]['avg_voteforcast'] = 0;
            if (isset($avg_forecasting['avg_voteforcast'][$key])) {
                $avg_forecasting['avg_seatforecast'][$key]['avg_voteforcast'] = $avg_forecasting['avg_voteforcast'][$key]['avg_voteforcast'];
            }
            $avg_forecasting['avg_seatforecast'][$key]['maximum_seat'] = $min_max_seat_forecasting[$key]['maximum_seat'];
            $avg_forecasting['avg_seatforecast'][$key]['minimum_seat'] = $min_max_seat_forecasting[$key]['minimum_seat'];

            $avg_forecasting['avg_seatforecast'][$key]['maximum_vote'] = $min_max_vote_forecasting[$key]['maximum_vote'];
            $avg_forecasting['avg_seatforecast'][$key]['minimum_vote'] = $min_max_vote_forecasting[$key]['minimum_vote'];

            $avg_forecasting['avg_seatforecast'][$key]['actual_seats'] = $actual_seat_vote_result[$key]['actual_seats'];
            $avg_forecasting['avg_seatforecast'][$key]['actual_votes'] = $actual_seat_vote_result[$key]['actual_votes'];

            $forecast[] = $avg_forecasting['avg_seatforecast'][$key];
        }

        return $forecast;
    }

    function get_stock_avg_forecasting($stock_period_id, $is_expert_avg = false) {
        //$this->db->select("sf.id,sf.stock_period_id,sf.stock_id,AVG(sf.weekly_forecast) as weekly_forecast, AVG(sf.monthly_forecast) as monthly_forecast,"
        //        . "AVG(sf.yearly_forecast) as yearly_forecast, s.name as stock_name, s.code as stock_code");
        //$this->db->from("stock_forecasting sf");
        //$this->db->join("stocks s", "sf.stock_id = s.id", "INNER");
        //$this->db->where("election_period_id = $stock_period_id AND user_id not in (select user_id from stock_forecasting WHERE stock_forecasting = $stock_period_id group by user_id having sum(weekly_forecast) = 0)");
        //$this->db->group_by("sf.stock_id");
        //$avg_forecasting['avg_stockforecast'] = $this->db->get()->result_array();
//        echo $this->db->last_query();
//        exit;
        //$forecast = [];
        //foreach ($avg_forecasting['avg_stockforecast'] as $key => $forecasting) {
        //    $forecast[] = $forecasting;
        //}
        //return $forecast;

        $this->db->select("sip.stock_period_id, sip.stock_id, COALESCE(AVG(sf.weekly_forecast),'0.00') as weekly_forecast, COALESCE(AVG(sf.monthly_forecast),'0.00') as monthly_forecast, COALESCE(AVG(sf.yearly_forecast),'0.00') as yearly_forecast, s.name as stock_name, s.code as stock_code");
        $this->db->from("stock_into_period sip");
        $this->db->join("stock_forecasting sf", "sf.stock_id = sip.stock_id", "LEFT");
        $this->db->join("stocks s", "sip.stock_id = s.id", "INNER");
        $this->db->where("sip.stock_period_id = '$stock_period_id'");
        if ($is_expert_avg) {
            $this->db->where("sf.is_expert = '1'");
        }
        $this->db->group_by("sip.stock_id");
        $this->db->order_by("sip.stock_rating DESC");
        
        $avg_forecasting['avg_stockforecast'] = $this->db->get()->result_array();
        //echo $this->db->last_query();
        //exit;

        $forecast = array();
        foreach ($avg_forecasting['avg_stockforecast'] as $key => $forecasting) {
            $forecast[] = $forecasting;
        }
        return $forecast;
    }

    function get_actual_and_users_seat_vote_forecast($id) {
        //Get actual result for SEAT and VOTE forecast

        $this->db->select("u.id,u.name,u.rank,u.points,u.certificate_path,s.name as location,p.name as party,p.abbreviation");
        $this->db->from("users u");
        $this->db->join("states s", "s.id = u.location", "INNER");
        $this->db->join("parties p", "p.id = u.party_affiliation", "INNER");
        $this->db->where("u.id = $id");
        $user_detail = $this->db->get()->row_array();


        $this->db->select("uf.*,p.name,p.abbreviation,p.icon,sp.actual_seats,sp.actual_votes");
        $this->db->from("user_forecasting uf");
        $this->db->join("parties p", "p.id = uf.party_id", "INNER");
        $this->db->join("state_party sp", "sp.party_id = uf.party_id", "INNER");
        $this->db->where("user_id = $id");
        $this->db->order_by('party_id');
        $actual_seat_vote_result = $this->db->get()->result_array();

        $data['user_detail'] = $user_detail;
        $data['actual_and_user_forecast'] = $actual_seat_vote_result;

        return $data;
    }

}
