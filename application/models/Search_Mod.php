<?php

class Search_mod extends CI_Model {

        function __construct() {
                parent::__construct();

        }
        
        function get_search_list($inputs){
                
                $poll_ids = $survey_ids = $ratedArticle_ids = $blogs_ids = $wall_ids = array();
                $query = "";
                
                $searchTerm = $inputs['search'];
                
                $this -> db -> select( "*" );
                $this -> db -> from( "topic_associaton" );
                //$this->db->like('title', $searchTerm);
                //$this->db->like('description', $searchTerm);
                $search_result_data = $this -> db -> get() -> result_array();
                
                foreach ($search_result_data as $key => $item){
                        if($item['type'] == "Poll"){
                                array_push($poll_ids, $item['post_id']);
                        }
                        if($item['type'] == "Survey"){
                                array_push($survey_ids, $item['post_id']);
                        }
                        if($item['type'] == "RatedArticles"){
                                array_push($ratedArticle_ids, $item['post_id']);
                        }
                        if($item['type'] == "Blog" || $item['type'] == "Article"){
                                array_push($blogs_ids, $item['post_id']);
                        }
                        if($item['type'] == "Wall"){
                                array_push($wall_ids, $item['post_id']);
                        }
                }
                
                if (!empty($poll_ids)){
                      $query .= "SELECT * FROM poll WHERE id IN (".$poll_ids.");";  
                }
                
                if (!empty($survey_ids)){
                      $query .= "SELECT * FROM survey WHERE id IN (".$survey_ids.");";  
                }
                
                if (!empty($ratedArticle_ids)){
                      $query .= "SELECT * FROM article WHERE id IN (".$ratedArticle_ids.");";  
                }
                
                if (!empty($blogs_ids)){
                      $query .= "SELECT * FROM blogs WHERE id IN (".$blogs_ids.");";  
                }
                
                if (!empty($wall_ids)){
                      $query .= "SELECT * FROM forum WHERE id IN (".$wall_ids.");";  
                }
        }
        
        
        function get_topics_list($inputs){
                
                $term = $inputs['sterm'];
                
                $this -> db -> select( "t.*" );
                $this -> db -> from( "topics t" );
                $this -> db -> like( "topic", $term);
                $this -> db -> where( "t.is_active = '1'" );
                $this -> db -> order_by("t.id DESC");
                $result = $this -> db -> get() -> result_array();
                //echo $this -> db -> last_query();

                return array ( "status" => TRUE, "message" => "", "data" => $result );
        }
        
}
