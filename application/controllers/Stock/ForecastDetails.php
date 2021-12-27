<?php

/**
 * 
 */
class ForecastDetails extends Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Stock/ForecastDetails_Mod');
        $this->load->helper('common_helper');

        $userdata = $this->session->userdata('data');
        $this->user_id = $userdata['uid'];
    }

    function index() {
        $codes = "";
        $user_id = $this->user_id;
        $stock_period = get_stock_period();

        $page_title['page_title'] = "Crowdwisdom";
        $data['blogs'] = getAllBlogs();
        $data['tweets'] = get_twitter_tweets("#stocks");
        $data['is_result_out'] = $stock_period[0]['is_result_out'];
        $data['is_weekly_stop'] = $stock_period[0]['is_weekly_stop'];
        $data['is_monthly_stop'] = $stock_period[0]['is_monthly_stop'];
        $data['is_yearly_stop'] = $stock_period[0]['is_yearly_stop'];
        
        $data['weekly_endon_date'] = $stock_period[0]['weekly_endon_date'];
        $data['monthly_endon_date'] = $stock_period[0]['monthly_endon_date'];
        $data['yearly_endon_date'] = $stock_period[0]['yearly_endon_date'];
        
        $data['user_forecast'] = $this->ForecastDetails_Mod->get_user_forecast_details($user_id);

        foreach ($data['user_forecast'] as $stock_forecast) {
            $codes .= $stock_forecast['stock_code'] . ",";
        }
        $codes = chop($codes, ",");
        $data['stock_codes'] = $codes;

        $this->load->view('Stock/header', $page_title);
        $this->load->view('Stock/stock-forecast', $data);
        $this->load->view('Stock/footer');
    }

    function updateUserForecast() {
        $result_check = get_stock_period();
        $is_result_out = $result_check[0]['is_result_out'];
        if ($is_result_out == "1") {
            echo json_encode(array("status" => FALSE, "message" => "Forecast programe has stoped now."));
            return false;
        }
        $inputs = $this->input->post();
        $inputs['user_id'] = $this->user_id;
        $inputs['stock_period_id'] = $result_check[0]['id'];

        $this->ForecastDetails_Mod->update_user_forecast($inputs);
    }

}

?>