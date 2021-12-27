<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Predictions_Mod extends CI_Model {

    function __construct() {
        parent::__construct();
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

    function get_prediction_list($inputs, $limit = 8) {
        $offset = $inputs['offset'];
        $user_id = $inputs['user_id'];
        $relatedTopics = $inputs['relatedTopics'];
        $topic_id = 0;

        $new_limit = ($offset == 0) ? 8 : (($offset >= 7) ? 7 : 7);

        $last24hourids = "";
        /* Get Wall raised in last 24 hour - START */
        $this->db->select("p.id");
        $this->db->from("poll p");
        $this->db->where("(p.created_date) >= (now() - INTERVAL 24 hour) AND p.is_active = '1'");
        $last24hour_result = $this->db->get()->result_array();

        if (!empty($last24hour_result)) {
            foreach ($last24hour_result as $key => $last24hour_data) {
                $last24hourids .= $last24hour_data['id'] . ",";
            }
            $last24hourids = chop($last24hourids, ",");
        }
        /* Get Wall raised in last 24 hour - END */

        /* Engagement Checking - START */
        $engagement_ids = array();
        $this->db->select("pa.poll_id, COUNT(1) as total_response");
        $this->db->from("poll_action pa");
        $this->db->where("pa.created_date >= (now() - INTERVAL 24 hour)");
        $this->db->group_by("pa.poll_id");
        $this->db->order_by("total_response DESC, pa.poll_id DESC");
        $action_responses = $this->db->get()->result_array();

        $this->db->select("pc.poll_id, COUNT(1) as total_response");
        $this->db->from("poll_comments pc");
        $this->db->where("pc.created_date >= (now() - INTERVAL 24 hour) AND pc.is_active = '1'");
        $this->db->group_by("pc.poll_id");
        $this->db->order_by("total_response DESC, pc.id DESC");
        $comment_responses = $this->db->get()->result_array();

        if (!empty($action_responses) && !empty($comment_responses)) { // vote action and comments in last 24 hours
            foreach ($action_responses as $lkey => $likes) {
                $engagement_ids[$lkey]['poll_id'] = $likes['poll_id'];
                $engagement_ids[$lkey]['total_response'] = $likes['total_response'];

                foreach ($comment_responses as $ckey => $comments) {
                    if ($action_responses[$lkey]['poll_id'] == $comments['poll_id']) {
                        $engagement_ids[$lkey]['total_response'] = $likes['total_response'] + $comments['total_response'];
                    } else {
                        array_push($engagement_ids, $comments);
                    }
                }
            }
        } else if (!empty($action_responses) && empty($comment_responses)) { // only vote action in last 24 hours
            foreach ($action_responses as $lkey => $likes) {
                $engagement_ids[$lkey]['poll_id'] = $likes['poll_id'];
                $engagement_ids[$lkey]['total_response'] = $likes['total_response'];
            }
        } else if (empty($action_responses) && !empty($comment_responses)) { // only comments in last 24 hours
            foreach ($comment_responses as $ckey => $comments) {
                $engagement_ids[$ckey]['poll_id'] = $comments['poll_id'];
                $engagement_ids[$ckey]['total_response'] = $comments['total_response'];
            }
        } else { //there is no engagement in 24 last hours 
            $engagement_ids = array();
        }

        $engagement_id_data = "";
        $engagement_order = "";

        if (!empty($engagement_ids)) {
            foreach ($engagement_ids as $engagement_data) {
                $onlyids[] = $engagement_data['poll_id'];
                $engagement_id_data .= $engagement_data['poll_id'] . ",";
            }
            $unique = array_reverse(array_unique($onlyids));
            $engagement_id_data = implode(',', $unique);
            $engagement_order = "FIELD(p.id, $engagement_id_data) DESC, ";
        }
        /* Engagement Checking - END */

        //check users following topics
        if ($topic_id == 0) {
            $followed_result = $this->get_followed_topics($user_id);
            $followed_topic_ids = array();
            foreach ($followed_result as $key => $users_followed_data) {
                $followed_topic_ids[] = $users_followed_data['topic_id'];
            }

            if (!empty($followed_topic_ids)) {

                $this->db->select("p.id");
                $this->db->from("poll p");
                $this->db->join("topic_association ta", "ta.post_id = p.id AND ta.type = 'Poll'", "INNER");
                $this->db->where_in("ta.topic_id", $followed_topic_ids);
                $followed_predictios = $this->db->get()->result_array();

                foreach ($followed_predictios as $key => $followd_data) {
                    $followed_predictions_ids[] = $followd_data['id'];
                }
            }
        }

        /* Latest 24 hour raised - START */
        $is_new = "";
        if ($last24hourids != "") {
            $is_new = "FIELD(p.id, $last24hourids) DESC,";
        }
        /* Latest 24 hour raised - END */

        $relatedIds = "";
        $this->db->select("p.id, p.user_id, p.topic_id, p.poll as title, COALESCE(p.image,'') as image, p.total_votes, "
                . "p.total_comments"); //, COALESCE(ta.topic,'') as topic
        $this->db->from("poll p");
        //$this -> db -> join( "topics t", "t.id = p.topic_id", "LEFT" );
        if ($topic_id > 0) {
            $this->db->join("topic_association ta", "ta.post_id = f.id AND ta.type = 'Poll' AND ta.topic_id = '$topic_id'", "INNER");
        } else {
            if (!empty($relatedTopics)) {
                foreach ($relatedTopics as $value) {
                    $relatedIds .= $value . ",";
                }
                $relatedIds = chop($relatedIds, ",");
                $this->db->join("topic_association ta", "ta.post_id = p.id AND ta.type = 'Poll' AND ta.topic_id in ($relatedIds)", "INNER");
            }
        }

        $this->db->where("p.is_active = '1' AND p.is_approved = '1' AND p.is_public = '1'");
        if (!empty($followed_predictions_ids)) {
            $this->db->where_in("p.id", $followed_predictions_ids);
        }
        $this->db->group_by("p.id");
        $this->db->order_by("$is_new $engagement_order p.id DESC");
        $this->db->offset($offset);
        $this->db->limit($new_limit);
        $result = $this->db->get()->result_array();
        //echo $this -> db -> last_query();exit;

        /* Checking more data available or not - START */
        $is_available = "0";
        if (count($result) >= 7) {
            unset($result[count($result) - 1]);
            $is_available = "1";
        } else {
            $is_available = "0";
        }
        /* Checking more data available or not - END */

        $ids = array();
        foreach ($result as $key => $prediction_data) {
            $ids[] = $prediction_data['id'];
            if ($prediction_data['image'] == "") {
                $result[$key]['image'] = base_url("images/logo/prediction_share_logo.png");
            }
        }

        /* Remove Vote counts of prediction - START */
        if (!empty($result)) {
            $counttoberemoved = $this->remove_vote_counts($ids);

            for ($i = 0; $i < count($result); $i ++) {
                foreach ($counttoberemoved as $removeids) {
                    if ($removeids['poll_id'] == $result[$i]['id']) {
                        $revised_total = $result[$i]['total_votes'] - $removeids['count'];
                        $result[$i]['total_votes'] = "$revised_total";
                    }
                }
            }
        }
        /* Remove Vote counts of prediction - END */

        $extra_param = (object) array("total" => "0");
        return array("status" => TRUE, "message" => "", "data" => $result, "extra_param" => $extra_param, "is_available" => $is_available);
    }

    function get_prediction_detail($inputs) {
        $id = $inputs['id'];
        $user_id = $inputs['user_id'];

        /* $this -> db -> select( "p.id, p.user_id, p.raised_by_admin, p.poll as title, p.description, "
          . "COALESCE(p.image,'') as image, p.total_votes, p.total_comments, p.average, p.email_ids,"
          . "p.end_date, p.created_date, COALESCE(t.topic,'') as topic, COALESCE(pa.choice,'') as users_choice,"
          . "GROUP_CONCAT(ta.topic_id ) as topic_ids, GROUP_CONCAT(t.topic) as associated_topics " );
          $this -> db -> from( "poll p" );
          $this -> db -> join( "poll_action pa", "pa.poll_id = p.id AND pa.user_id = '$user_id'", "LEFT" );
          $this -> db -> join( "topic_association ta", "ta.post_id = '$id'", "LEFT" );
          $this -> db -> join( "topics t", "t.id = ta.topic_id", "LEFT" );
          $this -> db -> where( "p.id = '$id' AND p.is_active = '1' AND is_approved = '1'" );
          $this -> db -> group_by( "p.id" ); */

        $userchoice = "";
        if ($user_id > 0) {
            $userchoice = ", COALESCE(pa.choice,'') as users_choice";
        }

        $this->db->select("p.id, p.user_id, p.raised_by_admin,COALESCE(u.alise,'') as alias,p.poll as title, p.description, p.data, "
                . "COALESCE(p.image,'') as image, p.total_votes, p.total_comments, p.meta_keywords, p.meta_description,p.average, "
                . "p.email_ids, p.is_public, p.preview,p.end_date, p.created_date $userchoice");
        $this->db->from("poll p");
        if ($user_id > 0) {
            $this->db->join("poll_action pa", "pa.poll_id = p.id AND pa.user_id = '$user_id'", "LEFT");
        }
        $this->db->join('users u', 'u.id = p.user_id', "LEFT");
        $this->db->where("p.id = '$id' AND p.is_active = '1' AND is_approved = '1'");
        $result = $this->db->get()->result_array();

        /* Remove Vote counts of prediction - START */
        $counttoberemoved = $this->remove_vote_counts($result[0]['id']);

        for ($i = 0; $i < count($result); $i ++) {
            if ($counttoberemoved['poll_id'] == $result[$i]['id']) {
                $revised_total = $result[$i]['total_votes'] - $counttoberemoved['count'];
                $result[$i]['total_votes'] = "$revised_total";
            }
        }

        //get the options of prediction
        //$result[ 0 ][ 'options' ] = $this -> get_prediction_options( $id );

        $total_votes = $result[0]['total_votes'];

        if ($user_id == 0) {
            $result[0]['users_choice'] = "";
        }
        $result[0]['options'] = $this->calculateavgvotes($id, $total_votes);
        $result[0]['comments'] = $this->get_poll_comments($id, 0, 3);

        if (count($result[0]['comments']) > 2) {
            unset($result[0]['comments'][count($result[0]['comments']) - 1]);
            $result[0]['more_comments'] = "1";
        } else {
            $result[0]['more_comments'] = "0";
        }

        $result[0]['total_comments'] = $this->get_poll_comments_count($id, 'All');
        $result[0]['total_views'] = "0";

        //get topics associated
        $result[0]['topic_associated'] = $this->get_prediction_topics($id);


        $extra_param = (object) array();
        return array("status" => TRUE, "message" => "", "data" => $result, "extra_param" => $extra_param, "is_available" => "");
    }

    function calculateavgvotes($id, $total_votes) {
        $this->db->select('count(1) as actualvotes');
        $this->db->from('poll_action pa');
        $this->db->join('poll_choices polc', 'polc.id=pa.choice', 'INNER');
        $this->db->where('pa.poll_id', $id);
        $this->db->where('polc.choice !=', "See the Results");
        $donknw = $this->db->get()->row_array();
        $total_votes = $donknw['actualvotes'];

        $this->db->select('pc1.id as choice_id,pc1.choice, pc1.type');
        $this->db->from('poll_choices pc1');
        $this->db->where('pc1.poll_id', $id);
        $this->db->group_by('pc1.id');
        $choices = $this->db->get()->result_array();

        $ch_ids = array();
        foreach ($choices as $key => $c1) {
            $ch_ids[] = $c1['choice_id'];
        }

        $this->db->select('count(1) as total, choice');
        $this->db->from('poll_action');
        $this->db->where_in('choice', $ch_ids);
        $this->db->where('poll_id', $id);
        $this->db->group_by('choice');
        $resultcount = $this->db->get();
        $count_array = $resultcount->result_array();

        foreach ($choices as $key => $c1) {

            $choices[$key]['total'] = 0;
            foreach ($count_array as $count_data) {
                if ($choices[$key]['choice_id'] == $count_data['choice']) {
                    $choices[$key]['total'] = $count_data['total'];
                }
            }

            $sum = 0;
            if ($total_votes > 0) {
                $sum = $choices[$key]['total'] / $total_votes;
            }

            if ($c1['choice'] != "See the Results") {
                $avg = $sum;
                $avg = $avg * 100;
                if ($avg != 100 && $avg != 0) {
                    $avg = number_format($avg, 1, '.', '');
                }

                $choices[$key]['avg'] = "$avg";
            } else {
                $choices[$key]['avg'] = "0";
            }
        }

        return $choices;
    }

    function get_poll_comments($id, $offset = 0, $limit = 10) {

        $this->db->select("pcmt.*, pcmt.id as comment_id, u.alise as alias");
        $this->db->from('poll_comments pcmt');
        $this->db->where_in('pcmt.poll_id', $id);
        $this->db->where('pcmt.is_active', 1);
        $this->db->join('users u', 'u.id=pcmt.user_id');
        $this->db->offset($offset);
        $this->db->limit($limit);
        $this->db->order_by("pcmt.id DESC");
        $result = $this->db->get()->result_array();

        return $result;
    }

    function get_poll_comments_count($id, $type) {

        $arr = true;
        if (!is_array($id)) {
            $arr = false;
            $id = array($id);
        }
        $this->db->select("count(1) as count, pcmts.poll_id as poll_id");
        $this->db->from('poll_comments pcmts');
        //$this->db->join('survey_action facts', 'facts.user_id=fcmts.user_id AND facts.poll_id=fcmts.poll_id');
        $this->db->where_in('pcmts.poll_id', $id);

        $this->db->where('pcmts.is_active', 1);

        if ($arr) {
            $this->db->group_by('pcmts.poll_id');
            $result = $this->db->get()->result_array();
        } else {
            $result = $this->db->get()->row_array()['count'];
        }
        return $result;
    }

    function get_prediction_options($prediction_id) {
        $this->db->select("pc.id, pc.choice, pc.type");
        $this->db->from("poll_choices pc");
        $this->db->where("pc.poll_id = '$prediction_id'");
        $result = $this->db->get()->result_array();

        return $result;
    }

    function get_prediction_topics($postid) {
        $this->db->select("ta.topic_id,ta.type, t.topic");
        $this->db->from("topic_association ta");
        $this->db->join("topics t", "ta.topic_id = t.id", "INNER");
        $this->db->where("ta.post_id = '$postid' AND ta.type = 'poll'");
        $result = $this->db->get()->result_array();

        return $result;
    }

    function get_category($array) {
        $this->db->select('count(id) as category_count');
        $this->db->from('topics');
        $this->db->where('category', '1');
        $this->db->where_in('id', $array);
        return reset($this->db->get()->result_array());
    }

    function remove_vote_counts($ids) {
        $arr = TRUE;
        if (!is_array($ids)) {
            $arr = FALSE;
            $ids = array($ids);
        }
        $id = implode(",", $ids);

        $query = "select COUNT(1) as count, pa.poll_id
                    from poll_action pa 
                    INNER JOIN poll_choices pc ON pc.type = '0'
                    WHERE pa.poll_id in ($id) AND pa.choice = pc.id group by poll_id";

        if ($arr) {
            $result = $this->db->query($query)->result_array();
        } else {
            $result = $this->db->query($query)->row_array();
        }
        return $result;
    }

    function get_answered_prediction($inputs, $limit = 11) {

        $offset = $inputs['offset'];
        $user_id = $inputs['user_id'];

        //$new_limit = ($offset == 0) ? 8 : (($offset >= 7) ? 7 : 7);

        $this->db->select("p.id, p.topic_id, p.poll as title, COALESCE(p.image,'') as image, p.total_votes, p.total_comments, "
                . "COALESCE(t.topic,'') as topic");
        $this->db->from("poll_action pa");
        $this->db->join("poll p", "p.id = pa.poll_id", "LEFT");
        $this->db->join("topics t", "t.id = p.topic_id", "LEFT");
        $this->db->where("pa.user_id = '$user_id'");
        $this->db->offset($offset);
        $this->db->limit($limit);
        $result = $this->db->get()->result_array();

        /* Checking more data available or not - START */
        $is_available = "0";
        if (count($result) >= 10) {
            unset($result[count($result) - 1]);
            $is_available = "1";
        } else {
            $is_available = "0";
        }
        /* Checking more data available or not - END */

        $ids = array();
        foreach ($result as $prediction_data) {
            $ids[] = $prediction_data['id'];
        }

        /* Remove Vote counts of prediction - START */
        $counttoberemoved = $this->remove_vote_counts($ids);

        for ($i = 0; $i < count($result); $i ++) {
            foreach ($counttoberemoved as $removeids) {
                if ($removeids['poll_id'] == $result[$i]['id']) {
                    $revised_total = $result[$i]['total_votes'] - $removeids['count'];
                    $result[$i]['total_votes'] = "$revised_total";
                }
            }
        }

        /* Remove Vote counts of prediction - END */

        $extra_param = (object) array("total" => "0");
        return array("status" => TRUE, "message" => "", "data" => $result, "extra_param" => $extra_param, "is_available" => $is_available);
    }

    function add_update_prediction($inputs) {

        $user_id = $inputs['user_id'];
        $predictionid = $inputs['predictionid'];
        $title = $this->special_character($inputs['title']);
        $description = $this->special_character($inputs['description']);
        //$topics = $inputs[ 'topics' ];
        $choices = $inputs['choices'];
        $emails = $inputs['emails'];
        $uploaded_filename = $inputs['uploaded_filename'];
        $end_date = date("Y-m-d", strtotime($inputs['end_date']));
        $user_email = $inputs['user_email'];

        $preview_json = $inputs['json_data'];
        $is_topic_change = $inputs['is_topic_change'];
        $is_choice_change = $inputs['is_choice_change'];

        if ($predictionid == 0) {

            $insert_array = array(
                "user_id" => $user_id,
                "poll" => $title,
                "description" => $description,
                "image" => $uploaded_filename,
                "email_ids" => $emails,
                "is_public" => "2",
                "is_approved" => "1",
                "is_active" => "1",
                "end_date" => $end_date
            );

            if ($preview_json != "") {
                $insert_array['data'] = $preview_json;
                $insert_array['image'] = json_decode($preview_json, TRUE)['img'];
            }
            $this->db->insert("poll", $insert_array);
            $last_prediction_id = $this->db->insert_id();

            //Prediction choices addition
            foreach ($choices as $ch) {
                $choice_type = ($ch == "See the Results") ? "0" : "1";
                $choice_insert[] = array(
                    "poll_id" => $last_prediction_id,
                    "choice" => $this->special_character($ch),
                    "type" => $choice_type
                );
            }
            $this->db->insert_batch('poll_choices', $choice_insert);
            //Prediction topics addition
//                        foreach ( $topics as $tp ) {
//                                $topics_insert[] = array (
//                                    "topic_id" => $tp,
//                                    "post_id" => $last_prediction_id,
//                                    "title" => $title,
//                                    "description" => $description,
//                                    "type" => "Poll"
//                                );
//                        }
//                        $this -> db -> insert_batch( 'topic_association', $topics_insert );
            //if ( $user_email != "" ) {

            $message .= "Hello, <br /><br />";
            /*   $message .= "Launch your own private predictions <br /><br />";
              $message .= "How does this work?<br /><br />";
              $message .= "<ol>"
              . "<li>Enter your prediction question</li>"
              . "<li>List the choices</li>"
              . "<li>Write down the e-mail addresses of all your friends</li>"
              . "<li>Launch the prediction</li>"
              . "<li>Once the last date is done, you will get a mail asking you to choose the right answer</li>"
              . "<li>Once you choose the answer, the results and names of the winners will go to all the participants</li>"
              . "</ol>";
              $message .= "<br /><br />";
              $message .= "You can use this in your business for sales predictions, competitive activity monitoring etc. You can also use it for fun activities. None of your questions will be visible to the public.<br /><br />"; */
            $message .= "New Question - $title.<br /><br />";
            $message .= "To participate: <br />" . base_url() . "Predictions/details/" . $last_prediction_id;
            $message .= "<br /><br />";
            $message .= "Win Amazon Voucher for answering this,";
            $message .= "<br /><br />";
            $message .= "Regards,<br /><br />CrowdWisdom Team";
            send_email($emails, $user_email, $title, $message, 'send_bcc');
            //}

            /* Send push notification */ //Private Prediction is only accessible to invited users
            /* $fields = array (
              "post_id" => $last_prediction_id,
              "title" => "New Prediction Added",
              "text" => $title,
              "type" => "Prediction",
              "subtype" => "Add",
              "user_id" => $user_id,
              "friend_id" => $user_id,
              "image" => ""
              );
              $this -> notification -> get_ids_and_fields( 0, $fields, $user_id ); */
            /* Send push notification */
            return TRUE;
        } else {

            $update_array = array(
                "poll" => $title,
                "description" => $description,
                "image" => $uploaded_filename,
                "email_ids" => $emails,
                "end_date" => $end_date
            );
            if ($is_choice_change != "0") {
                $update_array['total_votes'] = "0";
            }
            if ($preview_json != "") {
                $update_array['data'] = $preview_json;
                $update_array['image'] = json_decode($preview_json, TRUE)['img'];
            }

            $this->db->where(array("id" => $predictionid, "user_id" => $user_id));
            $this->db->update("poll", $update_array);

//                        if ( $is_topic_change != "0" ) {
//                                //delete all the existing choices of paricular prediction
//                                $this -> db -> where( "post_id = '$predictionid' AND type = 'Poll'" );
//                                $this -> db -> delete( "topic_association" );
//
//                                //Prediction topics addition
//                                foreach ( $topics as $tp ) {
//                                        $topics_insert[] = array (
//                                            "topic_id" => $tp,
//                                            "post_id" => $predictionid,
//                                            "title" => $title,
//                                            "description" => $description,
//                                            "type" => "Poll"
//                                        );
//                                }
//                                $this -> db -> insert_batch( 'topic_association', $topics_insert );
//                        }

            if ($is_choice_change != "0") {
                //delete all the existing choices of paricular prediction
                $this->db->where("poll_id = '$predictionid'");
                $this->db->delete("poll_choices");

                //insert new choices for the paricular prediction
                foreach ($choices as $ch) {
                    $choice_type = ($ch == "See the Results") ? "0" : "1";
                    $choice_insert[] = array(
                        "poll_id" => $last_prediction_id,
                        "choice" => $this->special_character($ch),
                        "type" => $choice_type
                    );
                }
                $this->db->insert_batch('poll_choices', $choice_insert);
            }

            //if ($user_email != "") {
            $message .= "Hello, <br /><br />";
            /*   $message .= "Launch your own private predictions <br /><br />";
              $message .= "How does this work?<br /><br />";
              $message .= "<ol>"
              . "<li>Enter your prediction question</li>"
              . "<li>List the choices</li>"
              . "<li>Write down the e-mail addresses of all your friends</li>"
              . "<li>Launch the prediction</li>"
              . "<li>Once the last date is done, you will get a mail asking you to choose the right answer</li>"
              . "<li>Once you choose the answer, the results and names of the winners will go to all the participants</li>"
              . "</ol>";
              $message .= "<br /><br />";
              $message .= "You can use this in your business for sales predictions, competitive activity monitoring etc. You can also use it for fun activities. None of your questions will be visible to the public.<br /><br />"; */
            $message .= "New Question - $title.<br /><br />";
            $message .= "To participate: <br />" . base_url() . "Predictions/details/" . $predictionid;
            $message .= "<br /><br />";
            $message .= "Win Amazon Voucher for answering this,";
            $message .= "<br /><br />";
            $message .= "Regards,<br /><br />CrowdWisdom Team";
            send_email($emails, $user_email, $title, $message, 'send_bcc');
            //}

            return TRUE;
        }
    }

    function vote_action_mod($inputs, $user_id) {
        $pollid = $inputs['id'];
        $choice = $inputs['choice'];
        //$category = $inputs[ 'category_id' ];
        $data = array(
            "poll_id" => $pollid,
            "user_id" => $user_id,
            "choice" => $choice,
            "category_id" => 0,
            'action' => 'Vote'
        );

        $this->db->select('id');
        $this->db->where('poll_id', $pollid);
        $this->db->where('user_id', $user_id);
        $this->db->where('action', 'Vote');
        $this->db->from('poll_action');

        $result = $this->db->get();

        $owner_id = $this->get_created_by_id($pollid);
        if ($result->num_rows() > 0) {
            $alreadyvote = $result->row_array();
            $this->db->where('id', $alreadyvote['id']);
            $this->db->update('poll_action', $data);

            /* Send push notification */
            if ($owner_id != $user_id) { //checking own vote
                $fields = array(
                    "post_id" => $pollid,
                    "title" => "Vote on prediction",
                    "text" => "",
                    "type" => "Prediction",
                    "subtype" => "Vote",
                    "user_id" => $user_id,
                    "friend_id" => $owner_id,
                    "image" => ""
                );
                $this->notification->get_ids_and_fields($owner_id, $fields, 0);
            }
            /* Send push notification */
            return 1;
        } else {
            $data['points'] = 1;
            $data['action'] = 'Vote';
            $this->db->insert('poll_action', $data);

            $sessiondata = $this->session->userdata('data');
            $_SESSION['data']['silver_points'] = $sessiondata['silver_points'] + 1;

            $this->db->set('unearned_points', "unearned_points+1", FALSE);
            $this->db->where("id", $user_id);
            $this->db->update('users');

            /* Send push notification */
            if ($owner_id != $user_id) { //checking own vote
                $fields = array(
                    "post_id" => $pollid,
                    "title" => "Vote on prediction",
                    "text" => "",
                    "type" => "Prediction",
                    "subtype" => "Vote",
                    "user_id" => $user_id,
                    "friend_id" => $owner_id,
                    "image" => ""
                );
                $this->notification->get_ids_and_fields($owner_id, $fields, 0);
            }
            /* Send push notification */
            return 0;
        }
    }

    function special_character($string) {
        $string = str_replace("'", "&#039;", $string);
        $string = str_replace('"', '&#039;', $string);
        return $string;
    }

    /*

     * param pollid is a poll for which comment is done
     * param user_id if a user from which comment is done
     * param poll_comment is a text for commment
     * param poll_cmt is a id of comment if you want to edit comment

     */

    function add_comment_mod($inputs) {
        $id = $inputs['id'];
        $comment_id = $inputs['comment_id'];
        $poll_comment = $inputs['comment'];
        $user_id = $inputs['user_id'];

        $data = array(
            "poll_id" => $id,
            "user_id" => $user_id,
            "comment" => $poll_comment,
            "is_active" => 1,
            "created_date" => date('Y-m-d H:i:s')
        );

        if ($comment_id == 0) {
            $this->db->insert('poll_comments', $data);
            $last_comment_id = $this->db->insert_id();
            /* Send push notification */
            $owner_id = $this->get_created_by_id($id);
            if ($owner_id != $user_id) { //checking own comment
                $fields = array(
                    "post_id" => $id,
                    "title" => "Comment on prediction",
                    "text" => $poll_comment,
                    "type" => "Prediction",
                    "subtype" => "Comment",
                    "user_id" => $user_id,
                    "friend_id" => $owner_id,
                    "image" => ""
                );
                $this->notification->get_ids_and_fields($owner_id, $fields, 0);
            }
            /* Send push notification */
            return $last_comment_id;
        } else {
            $update_data = array(
                "comment" => $poll_comment
            );
            $this->db->where(array('id' => $comment_id, "poll_id" => $id, "user_id" => $user_id));
            $this->db->update('poll_comments', $update_data);
            return $comment_id;
        }
    }

    function get_comment_by_id($id) {
        $this->db->select("*, id as comment_id");
        $this->db->from('poll_comments');
        $this->db->where('id', $id);
        $this->db->where('is_active', 1);
        $result = $this->db->get()->row_array();
        return $result;
    }

    /*

     * param pollid is a poll for which comment reply is done
     * param user_id if a user from which comment is done
     * param poll_comment_reply is a text for commment reply
     * param comment_id is a id of comment for which reply is done

     */

    function add_comment_reply_mod($inputs) {
        $pollid = $inputs['id'];
        $comment_id = $inputs['comment_id'];
        $user_id = $inputs['user_id'];
        $poll_comment_reply = $inputs['comment_reply'];
        $comment_reply_id = $inputs['comment_reply_id'];

        $data = array(
            "poll_id" => $pollid,
            "comment_id" => $comment_id,
            "user_id" => $user_id,
            "reply" => $poll_comment_reply,
            "is_active" => 1,
            "created_date" => date('Y-m-d H:i:s')
        );

        if ($comment_reply_id == 0) {
            $this->db->insert('poll_comment_reply', $data);
            $last_reply_id = $this->db->insert_id();

            /* Send push notification */
            $reply_data = $this->get_comment_created_by_id($comment_id);
            $comment_owner_id = $reply_data[0]['user_id'];
            $comment = $reply_data[0]['comment'];
            $alias = $reply_data[0]['alias'];

            if ($comment_owner_id != $user_id) { //checking own comment
                $fields = array(
                    "post_id" => $pollid,
                    "title" => "Reply on comment",
                    "text" => $poll_comment_reply,
                    "type" => "Prediction",
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

            return $last_reply_id;
        } else {
            $update_data = array(
                "reply" => $poll_comment_reply
            );
            $this->db->where(array('id' => $comment_reply_id, "poll_id" => $pollid, "comment_id" => $comment_id, "user_id" => $user_id));
            $this->db->update('poll_comment_reply', $update_data);
            return $comment_reply_id;
        }
    }

    function get_comment_reply_by_id($id) {
        $this->db->select("pcr.*, pcr.id as comment_reply_id, pcr.id as reply_id, u.alise as alias");
        $this->db->from('poll_comment_reply pcr');
        $this->db->join("users u", "u.id = pcr.user_id", "INNER");
        $this->db->where('pcr.id', $id);
        $result = $this->db->get()->row_array();
        return $result;
    }

    function delete_comment_mod($uid, $id, $comment_id) {
        $this->db->where(array("id" => $comment_id, "user_id" => $uid, "poll_id" => $id));
        $this->db->update("poll_comments", array("is_active" => "0"));
        return array("status" => TRUE, "message" => "Comment deleted successfully", "data" => (object) array());
    }

    /* delete reply of comment */

    function delete_comment_reply_mod($inputs) {
        $uid = $inputs['user_id'];
        $id = $inputs['id']; //this is poll_id 
        $comment_id = $inputs['comment_id'];
        $comment_reply_id = $inputs['comment_reply_id'];

        $delete_reply_array = array(
            "is_active" => "0"
        );
        $this->db->where(array("id" => $comment_reply_id, "user_id" => $uid, "poll_id" => $id, "comment_id" => $comment_id));
        $this->db->update("poll_comment_reply", $delete_reply_array);
        // echo $this -> db -> last_query();
        return array("status" => TRUE, "message" => "Reply deleted successfully", "data" => "");
    }

    function get_more_comments($inputs, $limit = 6) {
        $id = $inputs['id'];
        $offset = $inputs['offset'];

        $this->db->select("pc.*, pc.id as comment_id, u.alise as alias");
        $this->db->from("poll_comments pc");
        $this->db->join("users u", "u.id = pc.user_id", "INNER");
        $this->db->where("pc.poll_id = '$id'");
        $this->db->where("pc.is_active = '1'");
        $this->db->offset($offset);
        $this->db->limit($limit);
        $this->db->order_by("pc.id DESC");
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

    function get_comment_replies_mod($inputs, $limit = 6) {
        $id = $inputs['id']; //this is poll_id 
        $comment_id = $inputs['comment_id'];
        $offset = $inputs['offset'];

        $this->db->select("pcr.*,pcr.id as reply_id,u.alise as alias");
        $this->db->from("poll_comment_reply pcr");
        $this->db->join("users u", "u.id = pcr.user_id", "INNER");
        $this->db->where("pcr.poll_id = '$id' AND pcr.comment_id = '$comment_id' AND pcr.is_active = '1'");
        $this->db->order_by("pcr.id DESC");
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

    function make_deactive_poll($forumid) {
        $this->db->where('id', $forumid);
        $this->db->update('poll', array('is_active' => 0));
        return array("status" => TRUE, "message" => "Deleted successfully");
    }

    function get_experts_result($inputs) {
        $poll_id = $inputs['id'];

        $this->db->select("pc.id as choice, SUM(COALESCE(u.earned_points,0)) as total_gold, "
                . "SUM(COALESCE(u.unearned_points,0)) as total_silver, pc.choice as option, pc.type");
        $this->db->from("poll_choices pc");
        $this->db->join("poll_action pa", "pa.choice = pc.id", "LEFT");
        $this->db->join("users u", "u.id = pa.user_id", "LEFT");
        $this->db->where("pc.poll_id = '$poll_id'");
        $this->db->group_by("pc.id");
        $result = $this->db->get()->result_array();

        $a = array();
        $total = 0;

        foreach ($result as $key => $expert_data) {
            if ($expert_data['type'] == "1") {
                $a[$key] = $expert_data['total_gold'] * 0.75 + $expert_data['total_silver'] * 0.25;
                $result[$key]['calculated_sum'] = (string) $a[$key];
                $total += $a[$key];
            } else {
                $result[$key]['calculated_sum'] = "0"; //this is for see the results option
            }
        }

        foreach ($result as $key => $expert_data_with_sum) {
            if ($expert_data_with_sum['type'] == "1") {
                $result[$key]['expert_percent'] = ($total == 0) ? "0" : (string) round(($expert_data_with_sum['calculated_sum'] / $total) * 100, 2);
            } else {
                $result[$key]['expert_percent'] = "0"; //this is for see the results option
            }
        }

        return array("status" => TRUE, "message" => "", "data" => $result);
    }

    function get_created_by_id($id) {

        $this->db->select('p.user_id');
        $this->db->from('poll p');
        $this->db->where("p.id = '$id'");
        return $this->db->get()->result_array()[0]['user_id'];
    }

    function get_comment_created_by_id($id) {
        $this->db->select('pc.user_id, pc.comment, u.alise as alias');
        $this->db->from('poll_comments pc');
        $this->db->join('users u', "u.id = pc.user_id", "INNER");
        $this->db->where("pc.id = '$id'");
        return $this->db->get()->result_array();
    }

    function get_trend_result($inputs) {
        $poll_id = $inputs['id'];

        $this->db->select("pa.*, count(1) as total_vote, week(pa.created_date) as week_no, pc.choice as choice_name");
        $this->db->from("poll_action pa");
        $this->db->join("poll_choices pc", "pc.id = pa.choice", "INNER");
        $this->db->where("pa.poll_id = '$poll_id'");
        $this->db->group_by("choice, week_no");
        $result = $this->db->get()->result_array();
        return array("status" => TRUE, "message" => "", "data" => $result);
    }

}
