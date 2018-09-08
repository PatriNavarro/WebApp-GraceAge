<?php
/**
 * Created by PhpStorm.
 * User: kymeng
 * Date: 20/11/2017
 * Time: 22:36
 */
require(APPPATH.'libraries/REST_Controller.php');

date_default_timezone_set('UTC');

class Task extends REST_Controller
{
    public function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('task_model');
    }
    public function index_get($date)
    {
        $this->response($this->task_model->getTasks($date));
    }

    public function index_post()
    {
        $data_model = array(
            'description'=>$_POST['description'],
            'task_date'=>$_POST['task_date'],
            'user_id'=>1);
        $this->task_model->createTask($data_model);
        $refer =  $this->agent->referrer();
        redirect($refer);
    }

}