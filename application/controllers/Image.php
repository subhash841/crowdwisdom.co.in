<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Image extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Forum_Mod');
    }

    function convertImage($id) {
        $data['forum_detail'] = $this->Forum_Mod->get_forum_by_id($id, 0);
        $data['page_image'] = $data['forum_detail']['image'];
        
        $data = $data['page_image'];
        $pos  = strpos($data, ';');
        $type = explode(':', substr($data, 0, $pos))[1];
        header("Content-type: ".$type);
        $data = str_replace('data:'.$type.',', '', $data);
        $data = str_replace(' ', '+', $data);
        echo base64_decode($data);
        
//        echo '<img src="'.$data['page_image'].'" />';
    }

}
