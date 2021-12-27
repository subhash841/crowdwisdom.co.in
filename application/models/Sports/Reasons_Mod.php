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

    function get_users_sport_forecast_and_reasons($sport_period_id, $sport_id, $forecast_type, $offset = 0, $limit = 10) {
        $this->db->select("DISTINCT(sf.user_id), p.abbreviation as party_affilication, s.name as location, fr.reason");
        $this->db->from("sport_forecasting sf");
        $this->db->join("users u", "u.id = sf.user_id", "INNER");
        $this->db->join("parties p", "p.id = u.party_affiliation", "LEFT");
        $this->db->join("states s", "s.id = u.location", "LEFT");
        $this->db->join("forecast_reason fr", "fr.user_id = u.id AND fr.period_id = '$sport_period_id' AND fr.forecast_type = '$forecast_type'", "LEFT");
        $this->db->where("sport_period_id = '$sport_period_id' AND sport_id = '$sport_id'");
        $this->db->offset($offset);
        $this->db->limit($limit);
        $userids = $this->db->get()->result_array();

        $users = "";
        $data = array();
        foreach ($userids as $key => $ids) {
            $uid = $ids['user_id'];

            $this->db->select("sf.id,sf.score_forecast,sf.wicket_forecast,st.abbreviation as abbreviation");
            $this->db->from("sport_forecasting sf");
            $this->db->join("sport_teams st", "st.id = sf.team_id", "INNER");
            $this->db->where("sf.sport_period_id = '$sport_period_id' AND sf.sport_id = '$sport_id' AND sf.user_id = '$uid'");
            $this->db->order_by("sf.team_id");
            $forecasts = $this->db->get()->result_array();

            $data[$key]['user_id'] = $uid;
            $data[$key]['party_affilication'] = $ids['party_affilication'];
            $data[$key]['location'] = $ids['location'];
            $data[$key]['forecast'] = $forecasts;
            $data[$key]['reason'] = $ids['reason'];
        }
        return $data;
    }

    function get_forecast_reasons_count($sport_period_id, $sport_id, $forecast_type) {
        $this->db->select("count(DISTINCT(sf.user_id)) as total_reason");
        $this->db->from("sport_forecasting sf");
        $this->db->join("users u", "u.id = sf.user_id", "INNER");
        $this->db->join("parties p", "p.id = u.party_affiliation", "LEFT");
        $this->db->join("states s", "s.id = u.location", "LEFT");
        $this->db->join("forecast_reason fr", "fr.user_id = u.id", "LEFT");
        $this->db->where("sport_period_id = '$sport_period_id' AND sport_id = '$sport_id'");
        $result = $this->db->get();
        $result = $result->row_array();
        return $result['total_reason'];
    }

}
