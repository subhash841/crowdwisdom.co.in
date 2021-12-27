<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reasons_Mod extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_forecast_reasons($id)
    {
        $this->db->select('*');
        $this->db->from('forecast_reason');
        $this->db->where('period_id', $id);
        $result = $this->db->get();
        return $result->result_array();
    }

    function get_forecast_list($id)
    {
        $this->db->select("sp.party_id, sp.actual_seats, sp.actual_votes, p.icon as party_icon, p.name as party, p.abbreviation, COALESCE(uf.seat_forecast,0) as seat_forecast,"
                . " COALESCE(uf.vote_forcast,0) as vote_forcast,uf.user_id");
        $this->db->from("state_party sp");
        $this->db->join("states s", "s.id = sp.state_id AND s.is_active = '1'", "INNER");
        $this->db->join("parties p", "p.id = sp.party_id AND p.is_active = '1'", "INNER");
        $this->db->join("user_forecasting uf", "uf.state_id = sp.state_id AND uf.party_id = sp.party_id AND uf.election_period_id = sp.election_period_id","INNER");
        //$this->db->join("user_forecasting uf", "uf.state_id = sp.state_id AND uf.party_id = sp.party_id AND uf.election_period_id = sp.election_period_id AND uf.user_id = '$user_id'", "LEFT");
        $this->db->where("sp.election_period_id = '$id' AND sp.is_active = '1'");
        $user_forecast = $this->db->get()->result_array();
        
        $user_forecast= $this->_group_byusers($user_forecast,"user_id");
        return $user_forecast;
    }
    
    function _group_byusers($array, $key)
    {
        $i = 0;
        $current = "temp";
        $return = array();
        foreach ($array as $val) {
            //$return[$val[$key]][] = $val;
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
