<?php

class Blogs extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('common_helper');
    }

    function index() {
        $data['page_title'] = "Blogs";
        $data['blogs'] = getAllBlogs();
        $this->load->view('header', $data);
        $this->load->view('blogs', $data);
        $this->load->view('footer');
    }

    function blogdetails() {
        $data['page_title'] = "Blog Detail";
        $this->load->view('header', $data);
        $this->load->view('blogdetails');
        $this->load->view('footer');
    }

    function singleBlog() {
        $data['page_title'] = "Blog Detail";
        $this->load->view('header', $data);
        $this->load->view('singleblog.php');
        $this->load->view('footer');
    }

    //this function is temporay untill dynamic blogs completed
    function sachin_reddy() {
        $data['page_title'] = "The Karnataka Election Field Diary of Sachin Reddy";
        $this->load->view('header', $data);
        $this->load->view('sachinblog.php');
        $this->load->view('footer');
    }

    function political_baba() {
        $data['page_title'] = "What Matters in Karnataka? A blog by PoliticalBaba";
        $this->load->view('header', $data);
        $this->load->view('politicalbaba.php');
        $this->load->view('footer');
    }

    function getBlogs($id = NULL, $title = NULL) {
        $data['blog_list'] = get_blog_by_id($id);
        $data['blogs'] = getAllBlogs();
        $page_title['page_title'] = str_replace("&#39;", "'", $data['blog_list']['title']);
        $page_title['page_img'] = base_url("images/blogs/" . $data['blog_list']['image']);

        $this->load->view('header', $page_title);
        $this->load->view('blogs_byid', $data);
        $this->load->view('footer');
    }

}
