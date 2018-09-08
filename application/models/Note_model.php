<?php

date_default_timezone_set('UTC');

class Note_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getNotes($user_id)
    {
        $result = $this->db->get_where('note', array('user_id' => $user_id))->result();
        return $result;
    }
    
    public function getNoteByID($id)
    {
        $result = $this->db->get_where('note', array('id' => $id))->result();
        return $result;
    }

    public function createNote($data)
    {
        $this->db->insert('note', $data);
    }

    public function updateNote($data)
    {
        $this->db->replace('note', $data);
    }

    public function deleteNote($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('note');
    }
    
    public function deleteAllNotes($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->delete('note');
    }
}