<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dashboard extends Base_Controller {

    private $user_id = 0;
    private $state_id = 0;

    function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_Mod');
        $this->load->helper('common_helper');
        $userdata = $this->session->userdata('data');

        $this->user_id = $userdata['uid'];
        $this->state_id = '17';
    }

    function index() {
        $this->forecastDetails();
    }

    function get_twitter_tweets() {
        require_once APPPATH . 'libraries/twitteroauth/OAuth.php';
        require_once APPPATH . 'libraries/twitteroauth/TwitterOAuth.php';

        define('CONSUMER_KEY', 'ULpQloiD7Cc5Tig4RVjzBE7Qp');
        define('CONSUMER_SECRET', 'QTsBYnWrhODkPtmuM3kpdnaDZWoGVuRFFeMEbFmEtUsNPLN7mF');
        define('ACCESS_TOKEN', '938676930483707904-nsRb8yAZcmbCqI6W0toM7HQwKIJ8FRk');
        define('ACCESS_TOKEN_SECRET', 'nRu1GVNGQzWYVgDD5i3LYncYMrf6PCpKYyFw46k3DsGHR');

        $toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

        $query = array(
            "q" => "#GujaratElections 2017",
            "result_type" => "recent",
            "count" => 10
        );
        $results = $toa->get('search/tweets', $query);
        $tweets = (array) $results->statuses;
        return $tweets;
//        foreach ($tweets as $result) {
//            echo $result->user->profile_background_image_url_https. "<br />";
//            echo $result->user->name. "<br />";
//            echo $result->text. "<br />";
//            echo $result->created_at. "<br />";
//            echo "<br /><br />";
//        }
    }

    function forecastDetails() {
        $user_id = $this->user_id;
        $state_id = $this->state_id;

        $data['page_title'] = "";
        $data['election_period'] = get_election_period();
        $data['states'] = get_states();
        $data['parties'] = get_parties();
        $data['constituencies'] = getConstituencies($state_id);
        $data['user_forecast'] = $this->Dashboard_Mod->get_user_forecast_details($user_id, $data['election_period'][0]['id'], $state_id);
        $data['blogs'] = getAllBlogs();
        $data['tweets'] = get_twitter_tweets("#GujaratElections 2017");

        $this->load->view('header', $data);
        //$this->render('home2', $data);
        $this->load->view('home2', $data);
        $this->load->view('footer');
    }

    function updateUserConstituencyForecast() {
        $inputs = $this->input->post();

        $this->Dashboard_Mod->update_user_constituency_forecast($inputs);
        redirect('Dashboard');
    }

    /* STEP - 1
     * 
     * updateUserForecast
     * Update users SEAT AND VOTE forecast when user play any game
     */

    function updateUserForecast() {
        $result_check = get_election_period();
        $is_result_out = $result_check[0]['is_result_out'];

        if ($is_result_out == "1") {
            echo json_encode(array("status" => FALSE, "message" => "Forecast programe has stoped now."));
            return false;
        }
        $inputs = $this->input->post();
        $inputs['user_id'] = $this->user_id;
        $this->Dashboard_Mod->update_user_forecast($inputs);
        //redirect('Dashboard');
    }

}
