<?php

date_default_timezone_set('UTC');

class Medication_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getMedication($user_id)
    {
        $result = $this->db->get_where('medication', array('user_id' => $user_id))->result();
        return $result;
    }

    public function getMedicationByID($id)
    {
        $result = $this->db->get_where('medication', array('id' => $id))->result();
        return $result;
    }

    public function getMedicationByDay($day)
    {
        $result = $this->db->get_where('medication', array('day' => $day))->result();
        return $result;
    }


    public function createMedication($data)
    {
        $this->db->insert('medication', $data);
    }

    public function updateMedication($data)
    {
        $this->db->replace('medication', $data);
    }

    public function deleteMedication($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('medication');
    }

    public function deleteAllMedication($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->delete('medication');
    }
}