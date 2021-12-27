<?php

class Search extends CI_Controller {

        private $user_id = 0;
        private $user_alias = "";
        private $silver_points = 0;

        function __construct() {
                parent::__construct();

                $this -> load -> model( 'Index_Mod' );
                $this->load->model('Search_Mod');
                $this -> load -> model( 'Survey_Mod' );
                $this -> load -> model( 'YourVoice_mod' );
                $this -> load -> model( 'RatedArticle_Mod' );

                $sessiondata = $this -> session -> userdata( 'data' );
                if ( ! empty( $sessiondata ) ) {
                        $this -> user_id = $sessiondata[ 'uid' ];
                        $this -> user_alias = $sessiondata[ 'alise' ];
                        $this -> silver_points = $sessiondata[ 'silver_points' ];
                } else {
                        $this -> user_id = 0;
                        $this -> user_alias = "";
                        $this -> silver_points = 0;
                }

        }
        
        
        function index(){
                $data = array ();
                $header_data[ 'page_title' ] = "Search";
                $header_data[ 'page_meta_description' ] = "";
                $header_data[ 'page_meta_keywords' ] = "";
                $header_data[ 'page_img' ] = base_url( "images/logo/preview.jpg" );

                $header_data[ 'uid' ] = $this -> user_id;
                $header_data[ 'silver_points' ] = $this -> silver_points;

                //$data[ 'lists' ] = $this -> Topics_Mod -> get_topics_list();

                $this -> load -> view( 'bootstrap_header', $header_data );
                $this -> load -> view( 'search' );
                $this -> load -> view( 'bootstrap_footer', $header_data );
        }
        
        function topic_list() {
                //$user_id = $this -> user_id;
                //Filter Form Data
                $inputs = $this->input->post();
                $data = $this -> Search_Mod -> get_topics_list($inputs);
                $this -> apiresponse -> sendjson( $data );

        }
        
}
