<?php
/**
 * Created by PhpStorm.
 * User: kymeng
 * Date: 20/11/2017
 * Time: 23:57
 */

date_default_timezone_set('UTC');

class Task extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('task_model');
    }
    public function delete($id) {
        $this->task_model->deleteTask($id);
        echo json_encode($id);
    }


}