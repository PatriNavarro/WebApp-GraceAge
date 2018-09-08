<?php

date_default_timezone_set('UTC');

class Medication extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('medication_model');
    }
    public function delete($id) {
        $this->medication_model->deleteMedication($id);
        echo json_encode($id);
    }

    public function deleteAll($user_id){
        $this->medication_model->deleteAllMedication($user_id);
    }


}