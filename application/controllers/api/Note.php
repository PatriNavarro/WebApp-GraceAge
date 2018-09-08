
<?php

require(APPPATH.'libraries/REST_Controller.php');

date_default_timezone_set('UTC');

class Note extends REST_Controller
{
    public function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('note_model');
    }

    //public function index_get($user_id)
    public function index_get($id,$selectID)
    {   
        if($selectID == "row")
        {
            $this->response($this->note_model->getNoteByID($id));
        }
            
        if($selectID == "user")
        {
            $this->response($this->note_model->getNotes($id));
        }   
    }

    public function index_put($id)
    {

    }

    public function index_post($type)
    {
        if($type == "new")      //new note
        {
            $data_model = array(
                'title'=>$_POST['title'],
                'content'=>$_POST['content'],
                'user_id'=>1);
            $this->note_model->createNote($data_model);
        }
        
        if($type == "existing")     //replace note with new content and/or title
        {
            $data_model = array(
                'id'=>$_POST['rowID'],
                'title'=>$_POST['title'],
                'content'=>$_POST['content'],
                'user_id'=>1);
            $this->note_model->updateNote($data_model);
        }
        
        $refer = $this->agent->referrer();
        redirect($refer);
    }

    public function index_delete($id)
    {

    }
}
