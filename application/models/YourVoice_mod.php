<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class YourVoice_mod extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*
     * Search Ids in associative array
     */

    function searchForId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['blog_id'] === $id) {
                return $key;
            }
        }
        return null;
    }

    function get_followed_topics($user_id = 0) {
        $result = array();
        if ($user_id > 0) {
            $this->db->select("utf.topic_id");
            $this->db->from("users_followed_topics utf");
            $this->db->where("utf.user_id = '$user_id' AND utf.is_follow = '1'");
            $result = $this->db->get()->result_array();
        }

        return $result;
    }

    function get_voices($inputs, $limit = 8, $id = 0, $uid = 0, $type = 1) {
        $offset = $inputs['offset'];
        $voicenotin = $inputs['notin'];
        $topic_id = $inputs['topic_id'];
        $relatedTopics = $inputs['relatedTopics'];

        $columns = "";
        $followed_blog_ids = "";

        if (!$offset) {
            $offset = 0;
        }

        $new_limit = ($offset == 0) ? 8 : (($offset >= 7) ? 6 : 7);
        if ($limit < 8)
            $new_limit = $limit;

        if ($id != 0) {
            $columns = "b.id,COALESCE(b.user_id,0) as user_id,b.name,b.category_id,b.sub_category_id,b.title,b.description,b.image,b.blog_date,"
                    . "b.total_likes,b.total_comments,b.total_views,b.link,b.type,b.is_approve,b.is_active,b.blog_order,b.created_date,"
                    . "b.modified_date,u.alise as alias,bc.name as category,COALESCE(b.meta_keywords,'') as meta_keywords, COALESCE(b.meta_description) as meta_description";
        } else {
            /* Get Trending blog - START */
            $trending_id = "";
            $remove_trending_id = "";

//                        if ( $offset == 0 ) {
////                                $get_trending_blog = "SELECT id, total_like_comment
////                                    FROM (
////                                        SELECT id, (b.total_likes+b.total_comments) as total_like_comment
////                                        FROM blogs b
////                                        WHERE b.is_approve = '1' AND b.is_active = '1' AND b.type = '1'
////                                    ) t ORDER by total_like_comment DESC limit 1";
//                                $get_trending_blog = "SELECT *, (b.comments + b.likes ) AS total
//                                                        FROM (
//                                                                select p.id,
//                                                                (select count(1) FROM blog_comments t1 where t1.voice_id = p.id and t1.is_active = '1' and t1.created_date >= (now()-interval 24 hour)) comments,
//                                                                (select count(t2.is_like) from blog_likes t2 where t2.blog_id = p.id and t2.created_date >=(now()-interval 24 hour) AND is_like = '1') likes
//                                                                from blogs p
//                                                        ) as b
//                                               ORDER BY total DESC limit 1";
//                                $trending_data = $this -> db -> query( $get_trending_blog ) -> result_array();
//                                $total = $trending_data[ 0 ][ 'total' ];
//
//                                /* Remove From Last 1 hour */
//                                if ( $total != "0" ) {
//                                        $trending_id = $trending_data[ 0 ][ 'id' ];
//                                        if ( $trending_id != "" ) {
//                                                $remove_trending_id = " AND id not in ($trending_id)";
//                                        }
//                                } else {
//                                        $trending_id = "";
//                                        $remove_trending_id = "";
//                                }
//                        }
            /* Get Trending blog - END */

            $engagement_ids = array();
            $this->db->select("bl.blog_id as voice_id, sum(bl.is_like) as total_response");
            $this->db->from("blog_likes bl");
            $this->db->where("bl.created_date >= (now() - INTERVAL 24 hour) AND bl.is_like = '1'");
            $this->db->group_by("bl.blog_id");
            $this->db->order_by("total_response DESC, bl.id DESC");
            $likes_responses = $this->db->get()->result_array();

            $this->db->select("bc.voice_id, COUNT(1) as total_response");
            $this->db->from("blog_comments bc");
            $this->db->where("bc.created_date >= (now() - INTERVAL 24 hour) AND bc.is_active = '1'");
            $this->db->group_by("bc.voice_id");
            $this->db->order_by("total_response DESC, bc.id DESC");
            $comment_responses = $this->db->get()->result_array();

            if (!empty($likes_responses) && !empty($comment_responses)) { // likes and comments in last 24 hours
                foreach ($likes_responses as $lkey => $likes) {
                    $engagement_ids[$lkey]['voice_id'] = $likes['voice_id'];
                    $engagement_ids[$lkey]['total_response'] = $likes['total_response'];

                    foreach ($comment_responses as $ckey => $comments) {
                        if ($likes_responses[$lkey]['voice_id'] == $comments['voice_id']) {
                            $engagement_ids[$lkey]['total_response'] = $likes['total_response'] + $comments['total_response'];
                        } else {
                            array_push($engagement_ids, $comments);
                        }
                    }
                }
            } else if (!empty($likes_responses) && empty($comment_responses)) { // only likes in last 24 hours
                foreach ($likes_responses as $lkey => $likes) {
                    $engagement_ids[$lkey]['voice_id'] = $likes['voice_id'];
                    $engagement_ids[$lkey]['total_response'] = $likes['total_response'];
                }
            } else if (empty($likes_responses) && !empty($comment_responses)) { // only comments in last 24 hours
                foreach ($comment_responses as $ckey => $comments) {
                    $engagement_ids[$ckey]['voice_id'] = $comments['voice_id'];
                    $engagement_ids[$ckey]['total_response'] = $comments['total_response'];
                }
            } else { //there is no engagement in 24 last hours
                $engagement_ids = array();
            }

            //check users following topics
            if ($topic_id == 0) {
                $followed_result = $this->get_followed_topics($uid);
                $followed_topic_ids = array();
                foreach ($followed_result as $key => $users_followed_data) {
                    $followed_topic_ids[] = $users_followed_data['topic_id'];
                }

                if (!empty($followed_topic_ids)) {

                    $this->db->select("b.id");
                    $this->db->from("blogs b");
                    $this->db->join("topic_association ta", "ta.post_id = b.id AND ta.type = 'Blog'", "INNER");
                    $this->db->where_in("ta.topic_id", $followed_topic_ids);
                    $followed_predictios = $this->db->get()->result_array();

                    foreach ($followed_predictios as $key => $followd_data) {
                        $followed_blog_ids .= $followd_data['id'] . ",";
                    }
                    $followed_blog_ids = chop($followed_blog_ids, ",");
                }
            }

            /* Get Voices raised in last 1 hour - START */
            $this->db->select("b.id");
            $this->db->from("blogs b");
            $this->db->where("(b.created_date) >= (now() - INTERVAL 24 hour) AND b.is_active = '1' $remove_trending_id");
            $last1hour_result = $this->db->get()->result_array();

            $last1hourids = "";

            if (!empty($last1hour_result)) {
                foreach ($last1hour_result as $key => $last1hour_data) {
                    $last1hourids .= $last1hour_data['id'] . ",";
                }
                $last1hourids = chop($last1hourids, ",");
            }
            /* Get Voices raised in last 1 hour - END */

            $columns = "b.id,COALESCE(b.user_id,0) as user_id,b.name,b.category_id,b.sub_category_id,b.title,LEFT(b.description,300) as description,b.image,b.blog_date,"
                    . "b.total_likes,b.total_comments,b.total_views,b.link,b.type,b.is_approve,b.is_active,b.blog_order,b.created_date,"
                    . "b.modified_date,u.alise as alias,bc.name as category, (b.total_likes+b.total_comments) as total_like_comment,"
                    . "COALESCE(b.meta_keywords,'') as meta_keywords, COALESCE(b.meta_description) as meta_description";
        }

        $order_limit_clause = "";
        $notin_cond = "";
        $where = "";

        if ($voicenotin) {
            $notin_cond = " AND b.id not in ($voicenotin)";
        }
        if ($id != 0) {
            $where = " AND b.id = '$id'";
        } else {
            if ($type == 2) {
                $where = " AND b.type = '2'";
            } else {
                $where = " AND b.type = '1'";
            }

            /* Trending Blog ID - START */
            $trending_blog_id = "";
            if ($trending_id != "") {
                $trending_blog_id = "FIELD(a.id, $trending_id) DESC,";
            }
            /* Trending Blog ID - END */

            /* Latest 1 hour raised - START */
            $is_new = "";
            if ($last1hourids != "") {
                $is_new = "FIELD(a.id, $last1hourids) DESC,";
            }
            /* Latest 1 hour raised - END */

            /* last 24 hours enganement - START */
            $engagement_id_data = "";
            $engagement_order = "";

            if (!empty($engagement_ids)) {
                foreach ($engagement_ids as $engagement_data) {
                    $onlyids[] = $engagement_data['voice_id'];
                    $engagement_id_data .= $engagement_data['voice_id'] . ",";
                }
                //$unique = array_unique( $onlyids );
                $unique = array_reverse(array_unique($onlyids));
                $engagement_id_data = implode(',', $unique);
                $engagement_order = "FIELD(a.id, $engagement_id_data) DESC,";
            }
            /* last 24 hours enganement - END */

            $order_limit_clause = "order by $trending_blog_id $is_new $engagement_order a.id DESC limit $new_limit offset $offset"; //a.total_like_comment DESC,
        }

        $topic_cond = "";
        $topic_where = "";
        $relatedIds = "";
        if ($topic_id > 0) {
            $topic_cond = " INNER JOIN topic_association ta ON ta.post_id = b.id AND ta.type = 'Blog' AND ta.topic_id = '$topic_id' ";
        } else if (!empty($relatedTopics)) {
            foreach ($relatedTopics as $value) {
                $relatedIds .= $value . ",";
            }
            $relatedIds = chop($relatedIds, ",");
            $topic_cond = " INNER JOIN topic_association ta ON ta.post_id = b.id AND ta.type = 'Blog' AND ta.topic_id in ($relatedIds) ";
        } else {
            $topic_cond = " INNER JOIN topic_association ta ON ta.post_id = b.id AND ta.type = 'Blog'";
        }

        $sessiondata = $this->session->userdata('data');
        $exclude_private_topic_ids = "";
        if (!empty($sessiondata)) {
            $logged_in_email = $sessiondata['email'];
            $this->db->select("id");
            $this->db->from("topics t");
            $this->db->where("(t.is_private = '0' OR FIND_IN_SET('$logged_in_email',t.email_ids))");
            $accessible_topic_ids_result = $this->db->get()->result_array();

            if (!empty($accessible_topic_ids_result)) {
                foreach ($accessible_topic_ids_result as $t_ids) {
                    $accessible_topic_ids .= $t_ids['id'] . ",";
                }
                $accessible_topic_ids = chop($accessible_topic_ids, ",");
                $exclude_private_topic_ids = " AND (ta.topic_id = '0' OR ta.topic_id IN($accessible_topic_ids))";
            }
        } else {
            $this->db->select("id");
            $this->db->from("topics t");
            $this->db->where("t.is_private = '1'");
            $private_topic_ids_result = $this->db->get()->result_array();

            foreach ($private_topic_ids_result as $t_ids) {
                $not_accessible_topic_ids .= $t_ids['id'] . ",";
            }
            $not_accessible_topic_ids = chop($not_accessible_topic_ids, ",");
            $exclude_private_topic_ids = " AND ta.topic_id NOT IN($not_accessible_topic_ids)";
        }

        if ($followed_blog_ids != "") {
            $topic_where = " AND b.id in ($followed_blog_ids)";
        }
        $query = "select a.* FROM (
                    SELECT $columns
                    FROM blogs b
                    LEFT JOIN users u ON u.id = b.user_id
                    LEFT JOIN blog_category bc ON bc.id = b.category_id
                    $topic_cond
                    WHERE b.is_active = '1' AND b.is_approve = '1' $notin_cond $where $topic_where $exclude_private_topic_ids
                    GROUP BY b.id
                ) as a
                $order_limit_clause";

        $result = $this->db->query($query)->result_array();

        foreach ($result as $key => $voice_data) {

            /* Image handling - START */
            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/"; // The Regular Expression filter

            if (preg_match($reg_exUrl, $voice_data['image'], $url)) { // Check if there is a url in the text
                $result[$key]['image'] = base_url(str_replace("https://", "", $voice_data['image']));
            } else {

                $result[$key]['image'] = base_url("images/blogs/" . $voice_data['image']); // if no urls in the text just return the text
                //$result[$key]['image'] = str_replace(cdn_url(), "", $result[$key]['image']);
                $result[$key]['image'] = str_replace("imgcdn.crowdwisdom.co.in/", "", $result[$key]['image']);
            }

            /* Image handling - END */

            $result[$key]['alias'] = ($voice_data['alias'] == "") ? "Crowdwisdom" : $voice_data['alias'];

            if ($voice_data['user_id'] == "" || $voice_data['user_id'] == "0") {
                $result[$key]['raised_by_admin'] = "1";
            } else {
                $result[$key]['raised_by_admin'] = "0";
            }

            if ($id != 0 && $uid != 0) {
                //this condition will work only for detail view and logged in Users
                $count_data = $this->get_user_like($uid, $id); //get User count
                $count = ($count_data->num_rows() == 0) ? "0" : $count_data->row_array()['is_like'];

                $result[$key]['is_user_liked'] = $count;
            } else if ($id != 0) {
                //this condition is for details view without login
                $result[$key]['is_user_liked'] = "0";
            } else {
                //this section is for list view
                $result[$key]['is_user_liked'] = "0";
                $result[$key]['description'] = trim(preg_replace('/\s+/', ' ', strip_tags($result[$key]['description'])));
            }
        }

        if ($id != 0) {
            $result[0]['comments'] = $this->get_voice_comments($id);
            if (count($result[0]['comments']) > 2) {
                unset($result[0]['comments'][count($result[0]['comments']) - 1]);
                $result[0]['more_comments'] = "1";
            } else {
                $result[0]['more_comments'] = "0";
            }
            $result[0]['topic_associated'] = $this->get_voice_topics($id);
        }

        $is_available = "0";
        if (count($result) > 7) {
            unset($result[count($result) - 1]);
            $is_available = "1";
        } else {
            $is_available = "0";
        }

        return array("status" => TRUE, "message" => "", "data" => $result, "is_available" => $is_available);
    }

    function get_voice_topics($postid) {
        $this->db->select("ta.topic_id,ta.type, t.topic, t.is_private, t.email_ids");
        $this->db->from("topic_association ta");
        $this->db->join("topics t", "ta.topic_id = t.id", "INNER");
        $this->db->where("ta.post_id = '$postid' AND ta.type = 'Blog'");
        $result = $this->db->get()->result_array();

        return $result;
    }

//    function get_voices($inputs, $limit = 8, $id = 0, $uid = 0, $type = 1) {
//        $offset = $inputs['offset'];
//        $voicenotin = $inputs['notin'];
//        if (!$offset) {
//            $offset = 0;
//        }
//          $new_limit = ($offset == 0) ? 8 : 7;
//
//        if ($id != 0) {
//            $this->db->select("b.id,b.user_id,b.name,b.category_id,b.sub_category_id,b.title,b.description,b.image,b.blog_date,"
//                    . "b.total_likes,b.total_comments,b.link,b.type,b.is_approve,b.is_active,b.blog_order,b.created_date,"
//                    . "b.modified_date,u.alise as alias,bc.name as category");
//        } else {
//            /* Get Voices raised in last 1 hour - START */
//            $this->db->select("b.id");
//            $this->db->from("blogs b");
//            $this->db->where("(b.created_date) >= (now() - INTERVAL 1 hour) AND b.is_active = '1'");
//            $last1hour_result = $this->db->get()->result_array();
//
//            $last1hourids = "";
//
//            if (!empty($last1hour_result)) {
//                foreach ($last1hour_result as $key => $last1hour_data) {
//                    $last1hourids .= $last1hour_data['id'] . ",";
//                }
//                $last1hourids = chop($last1hourids, ",");
//            }
//            /* Get Voices raised in last 1 hour - END */
//
//            $this->db->select("b.id,b.user_id,b.name,b.category_id,b.sub_category_id,b.title,LEFT(b.description,300) as description,b.image,b.blog_date,"
//                    . "b.total_likes,b.total_comments,b.link,b.type,b.is_approve,b.is_active,b.blog_order,b.created_date,"
//                    . "b.modified_date,u.alise as alias,bc.name as category, (b.total_likes+b.total_comments) as total_like_comment");
//        }
//
//        $this->db->from("blogs b");
//        $this->db->join("users u", "u.id = b.user_id", "LEFT");
//        $this->db->join("blog_category bc", "bc.id = b.category_id", "INNER");
//        $this->db->where("b.is_active = '1'");
//        $this->db->where("b.is_approve = '1'");
//
//        if ($voicenotin) {
//            $this->db->where("b.id not in ($voicenotin)");
//        }
//        if ($id != 0) {
//            $this->db->where("b.id = '$id'");
//        } else {
//            if ($type == 2) {
//                $this->db->where("type = '2'");
//            } else {
//                $this->db->where("type = '1'");
//            }
//
//            /* Latest 1 hour raised, most liked in last 4 hours and 24 hours - START */
//            $is_new = "";
//            if ($last1hourids != "") {
//                $is_new = "FIELD(b.id, $last1hourids) DESC,";
//            }
//            /* Latest 1 hour raised, most liked in last 4 hours and 24 hours - END */
//            $this->db->order_by("$is_new b.id DESC");
//            $this->db->offset($offset);
//            $this->db->limit($limit);
//        }
//        //$this->db->order_by("b.id DESC");
//        $result = $this->db->get()->result_array();
//
//        foreach ($result as $key => $voice_data) {
//
//            if ($id != 0 && $uid != 0) {
//                //this condition will work only for detail view and logged in Users
//                $count_data = $this->get_user_like($uid, $id); //get User count
//                $count = ($count_data->num_rows() == 0) ? "0" : $count_data->row_array()['is_like'];
//
//                $result[$key]['is_user_liked'] = $count;
//            } else if ($id != 0) {
//                //this condition is for details view without login
//                $result[$key]['is_user_liked'] = "0";
//            } else {
//                //this section is for list view
//                $result[$key]['is_user_liked'] = "0";
//                $result[$key]['description'] = trim(preg_replace('/\s+/', ' ', strip_tags($result[$key]['description'])));
//            }
//        }
//
//        if ($id != 0) {
//            $result[0]['comments'] = $this->get_voice_comments($id);
//            if (count($result[0]['comments']) > 2) {
//                unset($result[0]['comments'][count($result[0]['comments']) - 1]);
//                $result[0]['more_comments'] = "1";
//            } else {
//                $result[0]['more_comments'] = "0";
//            }
//        }
//
//        $is_available = "0";
//        if (count($result) > 6) {
//            unset($result[count($result) - 1]);
//            $is_available = "1";
//        } else {
//            $is_available = "0";
//        }
//
//        return array("status" => TRUE, "message" => "", "data" => $result, "is_available" => $is_available);
//    }

    function get_sub_category() {
        $inputs = $this->input->post();
        $category_id = $inputs['category_id'];

        $this->db->select("bs.id, bs.name");
        $this->db->from("blog_subcategory bs");
        $this->db->where("category_id = '$category_id'");
        return $this->db->get()->result_array();
    }

    function create_update_voice_mod($uid) {
        $inputs = $this->input->post();

        $voice_id = $inputs['voice_id'];
        $voice_topic = $inputs['voice_topic'];
        $voice_desc = $inputs['voice_desc'];
        $topics = $inputs['topics'];
        $is_topic_change = $inputs['is_topic_change'];
        if ($voice_id == 0) {
            //insert
            $voice_image_name = $_FILES['voiceImageUpload']['name'];
            $voice_image_type = $_FILES['voiceImageUpload']['type'];
            $voice_image_tmp_name = $_FILES['voiceImageUpload']['tmp_name'];
            $voice_image_size = $_FILES['voiceImageUpload']['size'];

            $get_ext = explode(".", $voice_image_name);
            $extension = end($get_ext);
            $newfilename = str_replace(" ", "_", $get_ext[0]) . time() . "." . $extension;

            move_uploaded_file($voice_image_tmp_name, "images/blogs/" . $newfilename);

            $insert_voice = array(
                "user_id" => $uid,
                "title" => $voice_topic,
                "description" => $voice_desc,
                "image" => $newfilename,
                "type" => "1"
            );

            $this->db->insert("blogs", $insert_voice);
            $last_blog_id = $this->db->insert_id();

            //Blog topics addition
            foreach ($topics as $tp) {
                $topics_insert[] = array(
                    "topic_id" => $tp,
                    "post_id" => $last_blog_id,
                    "type" => "Blog"
                );
            }

            $this->db->insert_batch('topic_association', $topics_insert);

            $sessiondata = $this->session->userdata('data');
            $_SESSION['data']['silver_points'] = $sessiondata['silver_points'] - 25;


            /* update points of user */
            $this->db->where("id = '$uid'");
            $this->db->update("users", array("unearned_points" => $_SESSION['data']['silver_points']));

            return TRUE;
        } else {
            //update
            $update_voice = array(
                "title" => $voice_topic,
                "description" => $voice_desc,
                "is_approve" => "0"
            );

            if ($uploaded_filename != "") {
                $update_voice['image'] = $uploaded_filename;
            }
            $voice_image_name = $_FILES['voiceImageUpload']['name'];
            $voice_image_type = $_FILES['voiceImageUpload']['type'];
            $voice_image_tmp_name = $_FILES['voiceImageUpload']['tmp_name'];
            $voice_image_size = $_FILES['voiceImageUpload']['size'];

            if ($voice_image_name != "") {
                $get_ext = explode(".", $voice_image_name);
                $extension = end($get_ext);
                $newfilename = str_replace(" ", "_", $get_ext[0]) . time() . "." . $extension;
                move_uploaded_file($voice_image_tmp_name, "images/blogs/" . $newfilename);
                $update_voice['image'] = $newfilename;
            }

            $this->db->where("id = '$voice_id' AND user_id = '$uid'");
            $this->db->update("blogs", $update_voice);

            if ($is_topic_change != "0") {
                //delete all the existing choices of paricular prediction
                $this->db->where("post_id = '$voice_id' AND type = 'Blog'");
                $this->db->delete("topic_association");

                //Blog topics addition
                foreach ($topics as $tp) {
                    $topics_insert[] = array(
                        "topic_id" => $tp,
                        "post_id" => $voice_id,
                        "type" => "Blog"
                    );
                }
                $this->db->insert_batch('topic_association', $topics_insert);
            }

            return TRUE;
        }
    }

    function do_comment($inputs) {
        $uid = $inputs['user_id'];
        $voice_id = $inputs['voice_id'];
        $comment = $inputs['comment'];

        $insert_comment = array(
            "user_id" => $uid,
            "voice_id" => $voice_id,
            "comment" => $comment
        );

        $this->db->insert("blog_comments", $insert_comment);
        $last_id = $this->db->insert_id();

        /* Send push notification */
        $owner_id = $this->get_created_by_id($voice_id);
        if ($owner_id != $uid) { //checking own comment
            $fields = array(
                "post_id" => $voice_id,
                "title" => "commented on your voice",
                "text" => $comment,
                "type" => "Voice",
                "subtype" => "Comment",
                "user_id" => $uid,
                "friend_id" => $owner_id,
                "image" => "",
                "comment_id" => $last_id
            );
            $this->notification->get_ids_and_fields($owner_id, $fields, 0);
        }
        /* Send push notification */

        return array("status" => TRUE, "message" => "", "data" => array("comment_id" => $last_id));
    }

    function update_comment($inputs) {
        $uid = $inputs['user_id'];
        $voice_id = $inputs['voice_id'];
        $comment_id = $inputs['comment_id'];
        $comment = $inputs['comment'];

        $update_array = array(
            "comment" => $comment
        );

        $this->db->where(array("id" => $comment_id, "user_id" => $uid, "voice_id" => $voice_id));
        $this->db->update("blog_comments", $update_array);

        return array("status" => TRUE, "message" => "", "data" => "");
    }

    function add_update_like_unlike_voice($uid, $voice_id, $is_user_like) {

        $count_data = $this->get_user_like($uid, $voice_id);
        $count = $count_data->num_rows();

        if ($count > 0) {
            $update_like_action = array(
                "is_like" => $is_user_like
            );
            $this->db->where(array("user_id" => $uid, "blog_id" => $voice_id));
            $this->db->update("blog_likes", $update_like_action);
        } else {
            //insert
            $insert_like_action = array(
                "user_id" => $uid,
                "blog_id" => $voice_id,
                "is_like" => $is_user_like
            );
            $this->db->insert("blog_likes", $insert_like_action);
        }
        $total_likes = $this->get_voice_total_likes($voice_id);
        $data = array("total_likes" => $total_likes);

        /* Send push notification */
        if ($is_user_like == "1") {
            $owner_id = $this->get_created_by_id($voice_id);
            if ($owner_id != $uid) { //checking own vote
                $fields = array(
                    "post_id" => $voice_id,
                    "title" => "Like on voice",
                    "text" => "",
                    "type" => "Voice",
                    "subtype" => "Like",
                    "user_id" => $uid,
                    "friend_id" => $owner_id,
                    "image" => ""
                );

                $this->notification->get_ids_and_fields($owner_id, $fields, 0);
            }
        }
        /* Send push notification */

        return array("status" => TRUE, "message" => "Action performed sucessfully", "data" => $data);
    }

    function get_user_like($uid, $voice_id) {
        $this->db->select("is_like");
        $this->db->from("blog_likes bl");
        $this->db->where("bl.user_id = '$uid' AND bl.blog_id = '$voice_id'");
        $user_like_data = $this->db->get();
        return $user_like_data;
    }

    function get_voice_total_likes($voice_id) {
        $this->db->select("sum(bl.is_like) as total_likes");
        $this->db->from("blog_likes bl");
        $this->db->where("bl.blog_id = '$voice_id'");
        $count_data = $this->db->get()->row_array();

        return $count_data['total_likes'];
    }

    function get_voice_comments($voice_id, $offset = 0, $limit = 3) {
        $this->db->select("bc.*,u.alise");
        $this->db->from("blog_comments bc");
        $this->db->join("users u", "u.id = bc.user_id", "LEFT");
        $this->db->where("bc.voice_id = '$voice_id'");
        $this->db->where("bc.is_active = '1'");
        $this->db->order_by("bc.id DESC");
        $this->db->offset($offset);
        $this->db->limit($limit);
        $result = $this->db->get()->result_array();

        foreach ($result as $key => $comments_data) {
            $result[$key]['alise'] = ($comments_data['alise'] == "") ? "Crowdwisdom" : $comments_data['alise'];
        }

        return $result;
    }

    function delete_voice_mod($uid, $voice_id) {
        $this->db->where(array("user_id" => $uid, "id" => $voice_id));
        $delete_array = array(
            "is_active" => "0"
        );
        $this->db->update("blogs", $delete_array);
        return TRUE;
    }

    function delete_voice_comment($uid, $voice_id, $comment_id) {
        $this->db->where(array("id" => $comment_id, "user_id" => $uid, "voice_id" => "$voice_id"));
        $this->db->update("blog_comments", array("is_active" => "0"));
        return array("status" => TRUE, "message" => "Comment deleted successfully", "data" => "");
    }

    function get_latest_voices($inputs, $limit = 7) {
        $voiceid = $inputs['voiceid'];

        $this->db->select("b.id,b.title,b.image,b.created_date,b.total_likes,b.total_views,bc.name as category");
        $this->db->from("blogs b");
        $this->db->join("blog_category bc", "bc.id = b.category_id", "INNER");
        $this->db->limit($limit);
        $this->db->order_by("b.id DESC");
        $this->db->where("b.is_active = '1' AND b.is_approve = '1' AND type = '1' AND b.id not in ('$voiceid')");
        $result = $this->db->get()->result_array();

        return array("status" => TRUE, "message" => "", "data" => $result);
    }

    function get_more_comments($inputs, $limit = 6) {
        $voice_id = $inputs['voice_id'];
        $offset = $inputs['offset'];

        $this->db->select("bc.*,u.alise as alias");
        $this->db->from("blog_comments bc");
        $this->db->join("users u", "u.id = bc.user_id", "INNER");
        $this->db->where("bc.voice_id = '$voice_id'");
        $this->db->where("bc.is_active = '1'");
        $this->db->offset($offset);
        $this->db->limit($limit);
        $this->db->order_by("bc.id DESC");
        $result = $this->db->get()->result_array();

        foreach ($result as $key => $comments_data) {
            $result[$key]['alias'] = ($comments_data['alias'] == "") ? "Crowdwisdom" : $comments_data['alias'];
        }

        $is_available = "0";
        if (count($result) > 5) {
            unset($result[count($result) - 1]);
            $is_available = "1";
        } else {
            $is_available = "0";
        }
        return array("status" => TRUE, "message" => "", "data" => $result, "is_available" => $is_available);
    }

    /* Reply on comments */

    function do_reply_on_comment($inputs) {
        $user_id = $inputs['user_id'];
        $voice_id = $inputs['voice_id'];
        $comment_id = $inputs['comment_id'];
        $comment_reply = $inputs['comment_reply'];

        $insert_comment_reply = array(
            "user_id" => $user_id,
            "voice_id" => $voice_id,
            "comment_id" => $comment_id,
            "reply" => $comment_reply
        );

        $this->db->insert("blog_comments_reply", $insert_comment_reply);
        $last_id = $this->db->insert_id();

        /* Send push notification */
        $reply_data = $this->get_comment_created_by_id($comment_id);
        $comment_owner_id = $reply_data[0]['user_id'];
        $comment = $reply_data[0]['comment'];
        $alias = $reply_data[0]['alias'];

        if ($comment_owner_id != $user_id) { //checking own comment
            $fields = array(
                "post_id" => $voice_id,
                "title" => "Reply on comment",
                "text" => $comment_reply,
                "type" => "Voice",
                "subtype" => "Reply",
                "user_id" => $user_id,
                "friend_id" => $comment_owner_id,
                "image" => "",
                "comment_id" => $comment_id,
                "comment" => $comment,
                "alias" => $alias
            );
            $this->notification->get_ids_and_fields($comment_owner_id, $fields, 0);
        }
        /* Send push notification */

        return array("status" => TRUE, "message" => "", "data" => array("reply_id" => $last_id));
    }

    /* Update Reply on comments */

    function update_comment_reply($inputs) {
        $uid = $inputs['user_id'];
        $voice_id = $inputs['voice_id'];
        $comment_id = $inputs['comment_id'];
        $comment_reply_id = $inputs['comment_reply_id'];
        $comment_reply = $inputs['comment_reply'];

        $update_reply_array = array(
            "reply" => $comment_reply
        );

        $this->db->where(array("id" => $comment_reply_id, "user_id" => $uid, "voice_id" => $voice_id, "comment_id" => $comment_id));
        $this->db->update("blog_comments_reply", $update_reply_array);

        return array("status" => TRUE, "message" => "", "data" => "");
    }

    /* Get Replies of comment */

    function get_replies($inputs, $limit = 6) {
        $voice_id = $inputs['voice_id'];
        $comment_id = $inputs['comment_id'];
        $offset = $inputs['offset'];

        $this->db->select("bcr.*,u.alise as alias");
        $this->db->from("blog_comments_reply bcr");
        $this->db->join("users u", "u.id = bcr.user_id", "INNER");
        $this->db->where("bcr.voice_id = '$voice_id' AND bcr.comment_id = '$comment_id' AND bcr.is_active = '1'");
        $this->db->order_by("bcr.id DESC");
        $this->db->offset($offset);
        $this->db->limit($limit);
        $result = $this->db->get()->result_array();

        $is_available = "0";
        if (count($result) > 5) {
            unset($result[count($result) - 1]);
            $is_available = "1";
        } else {
            $is_available = "0";
        }

        return array("status" => TRUE, "message" => "", "data" => $result, "is_available" => $is_available);
    }

    /* delete reply of comment */

    function delete_voice_reply($inputs) {
        $uid = $inputs['user_id'];
        $voice_id = $inputs['voice_id'];
        $comment_id = $inputs['comment_id'];
        $comment_reply_id = $inputs['comment_reply_id'];

        $delete_reply_array = array(
            "is_active" => "0"
        );
        $this->db->where(array("id" => $comment_reply_id, "user_id" => $uid, "voice_id" => $voice_id, "comment_id" => $comment_id));
        $this->db->update("blog_comments_reply", $delete_reply_array);

        return array("status" => TRUE, "message" => "Reply deleted successfully", "data" => "");
    }

    function get_created_by_id($id) {

        $this->db->select('b.user_id');
        $this->db->from('blogs b');
        $this->db->where("b.id = '$id'");
        return $this->db->get()->result_array()[0]['user_id'];
    }

    function get_comment_created_by_id($id) {
        $this->db->select('bc.user_id, bc.comment, u.alise as alias');
        $this->db->from('blog_comments bc');
        $this->db->join('users u', "u.id = bc.user_id", "INNER");
        $this->db->where("bc.id = '$id'");
        return $this->db->get()->result_array();
    }

}
