<?php
/**
 * Created by PhpStorm.
 * User: kymeng
 * Date: 01/12/2017
 * Time: 14:54
 */
require(APPPATH.'libraries/REST_Controller.php');

date_default_timezone_set('UTC');

class Survey extends REST_Controller
{
    public function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('survey_model');
    }

    public function index_get()
    {
        $surveyResult = $this->survey_model->getQuestions();
        $this->response($surveyResult);
    }
}