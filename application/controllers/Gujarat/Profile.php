<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Profile extends Base_Controller {

    private $user_id = 0;

    function __construct() {
        parent::__construct();
        $userdata = $this->session->userdata('data');

        $this->user_id = $userdata['uid'];
        $this->load->model('Gujarat/Results_Mod');
        $this->load->helper('Gujarat/common_helper');
    }

    function index() {
        $data['user_detail'] = getUserDetail($this->user_id);
        $data['all_states'] = get_all_states();
        $data['parties_list'] = get_parties();
        
        //$this->load->view('Gujarat/header');
        //$this->load->view('profile', $data);
        //$this->load->view('Gujarat/footer');
        //$this->render('profile', $data);
        $id = $this->user_id;
        $data = $this->Results_Mod->get_actual_and_users_seat_vote_forecast($id);
        $this->load->view('Gujarat/singleresult', $data);
        $this->load->view('Gujarat/footer');
    }

    function updateUserProfile() {
        $inputs = $this->input->post();

        $update = array(
            "location" => $inputs['location'],
            "party_affiliation" => $inputs['party_affiliation']
        );

        $uid = $this->user_id;
        $this->db->where("id = $uid");
        $this->db->update('users', $update);

        echo json_encode(array("status" => TRUE, "message" => "Profile updated successfully"));
    }

}
