<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function get_election_period() {
    $CI = & get_instance();

    $CI->db->select("id,from_date,to_date,is_result_out");
    $CI->db->from("election_period");
    $CI->db->where("is_active = '1' AND id = '1'");
    $election_period = $CI->db->get()->result_array();
    return $election_period;
}

function get_all_states() {
    $CI = & get_instance();

    $CI->db->select("id,name");
    $CI->db->from("states");
    $all_states = $CI->db->get()->result_array();
    return $all_states;
}

function get_states() {
    $CI = & get_instance();

    $CI->db->select("id,name");
    $CI->db->from("states");
    $CI->db->where("is_active = '1'");
    $states = $CI->db->get()->result_array();
    return $states;
}

function get_parties() {
    $CI = & get_instance();

    $CI->db->select("id,name,abbreviation,icon");
    $CI->db->from("parties");
    $CI->db->where("is_active = '1'");
    $parties = $CI->db->get()->result_array();
    return $parties;
}

function getConstituencies($state_id) {
    $CI = & get_instance();

    $CI->db->select("id,state_id,name");
    $CI->db->from("constituencies");
    $CI->db->where("is_active = '1' AND state_id = '$state_id'");
    $constituencies = $CI->db->get()->result_array();
    return $constituencies;
}

function getUserDetail($uid) {
    $CI = & get_instance();

    $CI->db->select("*");
    $CI->db->from("users");
    $CI->db->where("id = '$uid'");
    $userdetail = $CI->db->get()->row_array();
    //$userdetail = $CI->db->get()->result_array();
    return $userdetail;
}

function getUserListing() {
    $CI = & get_instance();

    $CI->db->select("*");
    $CI->db->from("users");
    $userdata = $CI->db->get()->result_array();
    return $userdata;
}
function getAllBlogs() {
    $CI = & get_instance();

    $CI->db->select("*");
    $CI->db->from("blogs");
    $CI->db->where("is_active = '1'");
    $CI->db->order_by('blog_order', 'asc');
    $blogsdata = $CI->db->get()->result_array();
    return $blogsdata;
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
        "q" => "#Gujarat election 2017",
        "result_type" => "recent",
        "count" => 10
    );
    $results = $toa->get('search/tweets', $query);
    $tweets = (array) $results->statuses;
    return $tweets;
}

function get_all_certified_users() {
    $CI = & get_instance();

    $CI->db->select("u.id,u.name,u.twitter_id,uer.points");
    $CI->db->from("user_election_rankings uer");
    $CI->db->join("users u", "u.id = uer.user_id", "INNER");
    $CI->db->order_by("uer.points DESC");
    $all_certified_users = $CI->db->get()->result_array();
    return $all_certified_users;
}

function get_certified_users($offset = 0) {
    $CI = & get_instance();

    $CI->db->select("u.id,u.name,u.twitter_id,uer.points");
    $CI->db->from("user_election_rankings uer");
    $CI->db->join("users u", "u.id = uer.user_id", "INNER");
    $CI->db->order_by("uer.points DESC");
    $CI->db->limit("10");
    $CI->db->offset($offset);
    $certified_users = $CI->db->get()->result_array();
    return $certified_users;
}

function get_certified_users_count() {
    $CI = & get_instance();

    $CI->db->select("count(1) as total_certified");
    $CI->db->from("user_election_rankings uer");
    $CI->db->join("users u", "u.id = uer.user_id", "INNER");
    $CI->db->order_by("uer.points DESC");
    $certified_users_count = $CI->db->get()->row_array();
    return $certified_users_count;
}

function createcertificate($text, $id, $twitter_id) {
    $newImage = imagecreatefromjpeg('images/common/crowd-wisdom-certificate.jpg');
    $txtColor = imagecolorallocate($newImage, 7, 14, 182);
    $dtColor = imagecolorallocate($newImage, 0, 0, 0);
    $font = 'assets/fonts/RougeScript-Regular.ttf';

    // Get image Width and Height
    $image_width = imagesx($newImage);
    $image_height = imagesy($newImage);

    // Get Bounding Box Size
    $text_box = imagettfbbox(35, 0, $font, $text);

    // Get your Text Width and Height
    $text_width = $text_box[2] - $text_box[0];
    $text_height = $text_box[7] - $text_box[1];

    // Calculate coordinates of the text
    $x = ($image_width / 2) - ($text_width / 2);
    $y = ($image_height / 2) - ($text_height / 2);
    imagettftext($newImage, 35, 0, $x, $y, $txtColor, $font, $text);
    imagettftext($newImage, 18, 0, 95, 415, $dtColor, $font, date('d-m-Y'));
    //header("Content-type: image/jpeg");
    $path = 'images/certificate/cert-' . $twitter_id . '-' . $id . '.jpg';
    imagejpeg($newImage, $path); //
    return $path;
}
