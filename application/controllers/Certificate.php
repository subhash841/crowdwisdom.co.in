<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Certificate
 *
 * @author Suhail
 */
class Certificate extends CI_Controller { //CI_Controller

    public function __construct() {
        parent::__construct();
    }

    public function share($id) {
        if (!is_numeric($id)) {
            show404();
        }

        $this->load->model('Certificate_model');
        $user = $this->Certificate_model->get_user($id);
        if (count($user) > 0) {
            if($user['finergized_certified'] != 1){
                show404();
            }
            $user['certificate_path'] = $this->config->item('certificate_path') . $user['certificate_path'];
            
            //if user current investment fall above 80% of suggested investment criteria then give basic pack free
            if ($user['good_investion_classification_bonus'] != 1) {
                $this->load->model('Subscription_cust_mod');
                $this->Subscription_cust_mod->avail_basic_free_plan_on_certificate_sharing($id);
            }
            $this->load->view('certificate', array('user' => $user));
        } else {
            show404();
        }
    }

    private function show404() {
        header('HTTP/1.0 404 Not Found');
        echo 'Page not found';
        exit;
    }

}
