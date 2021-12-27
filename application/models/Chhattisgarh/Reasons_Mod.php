<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reasons_Mod extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_users_forecast_and_reasons($election_period_id, $state_id, $offset = 0, $limit = 10) {
     
        $this->db->select("DISTINCT(uf.user_id), p.abbreviation as party_affilication, s.name as location, fr.reason");
        $this->db->from("user_forecasting uf");
        $this->db->join("users u", "u.id = uf.user_id", "INNER");
        $this->db->join("parties p", "p.id = u.party_affiliation", "LEFT");
        $this->db->join("states s", "s.id = u.location", "LEFT");
        $this->db->join("forecast_reason fr", "fr.user_id = u.id AND fr.period_id = '$election_period_id'", "LEFT");
        $this->db->where("election_period_id = '$election_period_id' AND state_id = '$state_id'");
        $this->db->offset($offset);
        $this->db->limit($limit);
        $userids = $this->db->get()->result_array();

        $users = "";
        $data = array();
        foreach ($userids as $key => $ids) {
            $uid = $ids['user_id'];
            $this->db->select("uf.id,uf.seat_forecast,uf.vote_forcast,p.abbreviation as abbreviation");
            $this->db->from("user_forecasting uf");
            $this->db->join("parties p", "p.id = uf.party_id", "INNER");
            $this->db->where("uf.election_period_id = '$election_period_id' AND uf.state_id = '$state_id' AND uf.user_id = '$uid'");
            $this->db->order_by("uf.party_id");
            $forecasts = $this->db->get()->result_array();

            $data[$key]['user_id'] = $uid;
            $data[$key]['party_affilication'] = $ids['party_affilication'];
            $data[$key]['location'] = $ids['location'];
            $data[$key]['forecast'] = $forecasts;
            $data[$key]['reason'] = $ids['reason'];
        }

        return $data;
    }

    function get_forecast_reasons_count($election_period_id, $state_id) {
        $this->db->select("count(DISTINCT(uf.user_id)) as total_reason");
        $this->db->from("user_forecasting uf");
        $this->db->join("users u", "u.id = uf.user_id", "INNER");
        $this->db->join("parties p", "p.id = u.party_affiliation", "LEFT");
        $this->db->join("states s", "s.id = u.location", "LEFT");
        $this->db->join("forecast_reason fr", "fr.user_id = u.id", "LEFT");
        $this->db->where("election_period_id = '$election_period_id' AND state_id = '$state_id'");
        $result = $this->db->get();
        $result = $result->row_array();
        return $result['total_reason'];
    }

    function get_forecast_list($id) {
        $this->db->select("s.name as state_name ,sp.party_id, sp.actual_seats, sp.actual_votes, p.icon as party_icon, p.name as party, p.abbreviation, COALESCE(uf.seat_forecast,0) as seat_forecast,"
                . " COALESCE(uf.vote_forcast,0) as vote_forcast,uf.user_id , p.abbreviation as party_affilication,fr.seat_forecast_reason,fr.vote_forecast_reason");
        $this->db->from("state_party sp");
        $this->db->join("states s", "s.id = sp.state_id AND s.is_active = '1'", "INNER");
        $this->db->join("parties p", "p.id = sp.party_id AND p.is_active = '1'", "INNER");
        $this->db->join("user_forecasting uf", "uf.state_id = sp.state_id AND uf.party_id = sp.party_id AND uf.election_period_id = sp.election_period_id", "INNER");
        $this->db->join("forecast_reason fr", "fr.user_id=uf.user_id AND fr.period_id=uf.election_period_id", "INNER");
        $this->db->where("sp.election_period_id = '$id' AND sp.is_active = '1'");
        $user_forecast = $this->db->get()->result_array();

        $user_forecast = $this->_group_bymonth($user_forecast, "user_id");
        return $user_forecast;
    }

    function _group_bymonth($array, $key) {
        $i = 0;
        $current = "temp";
        $return = array();
        foreach ($array as $val) {

            if ($current == $val[$key]) {
                $return[$i][] = $val;
            } else {
                $i++;
                $current = $val[$key];
                $return[$i][] = $val;
            }
        }
        return $return;
    }

}
