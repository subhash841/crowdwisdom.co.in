<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Base_Exceptions extends CI_Exceptions {

        function __construct() {
                parent::__construct();

        }

        function show_404( $page = '', $log_error = TRUE ) {
                redirect( 'Custom_404' );
        }

}
