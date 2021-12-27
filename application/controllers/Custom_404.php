<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Custom_404 extends CI_Controller {

        function __construct() {
                parent::__construct();
        }

        function index() {
                $this -> output -> set_status_header( '404' );
                $this -> load -> view( '404' );
        }

}
