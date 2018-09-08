<?php
/**
 * Created by PhpStorm.
 * User: kymeng
 * Date: 27/11/2017
 * Time: 10:47
 */
require(APPPATH.'libraries/REST_Controller.php');

date_default_timezone_set('UTC');

class Survey_Result extends REST_Controller
{
    public function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('survey_model');
    }

    public function index_get($date)
    {
        $surveyResult = $this->survey_model->getResultByDate(129, $date);
        $this->response($surveyResult);
    }
}