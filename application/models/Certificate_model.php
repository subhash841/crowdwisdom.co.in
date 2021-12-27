<?php

class Certificate_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function check_users($username, $password) {
        $query = $this->db->get_where('customer', array('email_id' => $username, 'password' => md5($password)));
        return $query->row_array();
    }

    public function check_steps_filled() {
        $session_data = $this->session->all_userdata();
        $custid = $session_data['member_id'];
        
        $query = $this->db->query("select 
                (select count(1) from customer_goals where customer_id = '".$custid."' and is_active = 1) as goal_count,
                (select count(1) from customer_income_detail where customer_id = '".$custid."') as income_count,
                (select count(1) from customer_expense_detail where customer_id = '".$custid."') as expense_count,
                (select count(1) from customer_mcq_answer where customer_id = '".$custid."') as mcq_count");
        return $query->row_array();
    }

    public function get_user($id) {
        $query = $this->db->get_where('customer', array('customer_id' => $id));
        return $query->row_array();
    }
}
