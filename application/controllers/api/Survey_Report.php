<?php
/**
 * Created by PhpStorm.
 * User: kymeng
 * Date: 30/11/2017
 * Time: 18:37
 */
require(APPPATH.'libraries/REST_Controller.php');

date_default_timezone_set('UTC');

class Survey_Report extends REST_Controller
{
    public function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('survey_model');
    }

    public function index_get($question_id, $startDate, $endDate, $answer=null)
    {
        $user_id = 129;
        $result = null;
        if ($answer == null)
            $result = $this->survey_model->getAnswerSummary($user_id, $question_id, $startDate, $endDate);
        else
            $result = $this->survey_model->getAnswerDate($user_id, $question_id, $startDate, $endDate, $answer);
        $this->response($result);
    }
}