<?php

require(APPPATH.'libraries/REST_Controller.php');

date_default_timezone_set('UTC');

class Medication extends REST_Controller
{
    public function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('medication_model');
    }

    //public function index_get($user_id)
    public function index_get($id,$selectID)
    {
        if($selectID == "row")
        {
            $this->response($this->medication_model->getMedicationByID($id));
        }

        if($selectID == "user")
        {
            $this->response($this->medication_model->getMedication($id));
        }
    }

    public function index_get_elderly($day)
    {
        $this->response($this->medication_model->getMedicationByDay($day));
    }

    public function index_put($id)
    {

    }

    public function index_post($type)
    {
        if($type == "new")      //new medication
        {
            $data_model = array(
                'title'=>$_POST['title'],
                'day'=>$_POST['day'],
                'content'=>$_POST['content'],
                'user_id'=>1);
            $this->medication_model->createMedication($data_model);
        }

        if($type == "existing")     //replace medication with new content and/or title
        {
            $data_model = array(
                'id'=>$_POST['rowID'],
                'title'=>$_POST['title'],
                'day'=>$_POST['day'],
                'content'=>$_POST['content'],
                'user_id'=>1);
            $this->medication_model->updateMedication($data_model);
        }

        $refer = $this->agent->referrer();
        redirect($refer);
    }

    public function index_delete($id)
    {

    }
}

