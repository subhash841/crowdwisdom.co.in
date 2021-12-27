<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Base_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();

        $userdata = $this->session->userdata('data');
        if (empty($userdata)) {
            redirect('Login');
        }
    }

    function render($page, $data) {
        $this->load->view('header');
        $this->load->view($page, $data);
        $this->load->view('footer');
    }

}
