<?php

/**
 * 
 */
class TnC extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('tnc');
    }

    function tnc_agree() {
        $session_querystring = $this->session->userdata('querystring');
        //print_r($session_querystring);
        $uid = $_SESSION['data']['uid'];

        $update_tnc = array(
            "tnc_agree" => "1"
        );
        $this->db->where("id = '$uid'");
         $this->db->update("users", $update_tnc);

        if ($_SESSION['data']['alise'] == "" && $_SESSION['data']['location'] == "") {
            redirect('Profile');
        } else {
            $_SESSION['data']['tnc_agree'] = "1";
            if ($session_querystring['section'] == "seat") { //&& $session_querystring['url']=="karnataka"
                if ($session_querystring['e'] == "in") {
                    redirect("Dashboard?section=" . $session_querystring['section']);
                }
                if ($session_querystring['e'] == "mp") {
                    redirect('MP/Dashboard?section=' . $session_querystring['section']);
                }
                if ($session_querystring['e'] == "ch") {
                    redirect('Chhattisgarh/Dashboard?section=' . $session_querystring['section']);
                }
                if ($session_querystring['e'] == "rj") {
                    redirect('Rajasthan/Dashboard?section=' . $session_querystring['section']);
                } else {
                    redirect('Dashboard?section=' . $session_querystring['section']);
                }
            } else if ($session_querystring['section'] == "discussion") {
                redirect('Forum');
            } else if ($session_querystring['section'] == "poll") {
                $pid = "";
                if (@$session_querystring['pid']) {
                    $pid = @$session_querystring['pid'];
                }
                if (@$session_querystring['p'] == "gov") {
                    redirect('Poll#elecpoll&pid=' . $pid);
                }
                if (@$session_querystring['p'] == "mon") {
                    redirect('Poll#stockpoll&pid=' . $pid);
                }
                if (@$session_querystring['p'] == "spo") {
                    redirect('Poll#sportpoll&pid=' . $pid);
                }
                if (@$session_querystring['p'] == "ent") {
                    redirect('Poll#moviepoll&pid=' . $pid);
                }

                if ($session_querystring['p'] == "myp") {
                    redirect('Poll#mydiscuss');
                }
                if (@$session_querystring['p'] == "pdp") {
                    $id = $session_querystring['id'];
                    $view = $session_querystring['view'];
                    redirect('Poll/polldetail/' . $id . '#' . $view);
                } else {
                    redirect('Poll');
                }
            } else if ($session_querystring['section'] == "sc" || $session_querystring['section'] == "wkt") {
                redirect('Sports/Dashboard?section=' . $session_querystring['section']);
            } else if ($session_querystring['section'] == "survey") {
                redirect('Survey');
            } else if ($session_querystring['section'] == "home") {
                redirect('Index');
            } else {
                redirect('Dashboard');
            }
        }
    }
}