<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Topics_Mod extends CI_Model {

        function __construct() {
                parent::__construct();

        }

        function get_topics_list() {
                $this -> db -> select( "t.id, t.topic, t.image" );
                $this -> db -> from( "topics t" );
                $this -> db -> where( "t.is_active = '1'" );
                $result = $this -> db -> get() -> result_array();
                return array ( "status" => TRUE, "message" => "", "data" => $result );

        }

}
