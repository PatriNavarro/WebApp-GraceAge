<?php

date_default_timezone_set('UTC');

class Note extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('note_model');
    }
    public function delete($id) {
        $this->note_model->deleteNote($id);
        echo json_encode($id);
    }
    
    public function deleteAll($user_id){
        $this->note_model->deleteAllNotes($user_id);
    }
}
