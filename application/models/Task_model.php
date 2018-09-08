<?php
/**
 * Created by PhpStorm.
 * User: kymeng
 * Date: 20/11/2017
 * Time: 22:38
 */
date_default_timezone_set('UTC');


class Task_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getTasks($date)
    {
        $user_id = $_SESSION['current_user']->id;
        $result = $this->db->get_where('task',
            array(
                'Date(task_date)' => $date,
                'user_id' => $user_id
            )
        )->result();
        return $result;
    }
    public function getTodayTasks() {
        $today =date("Y-m-d");

        return $this->getTasks($today);
    }
    public function createTask($data)
    {
        $this->db->insert('task', $data);
    }

    public function updateTask($data)
    {
        $data_model = $this->accountviewmodel->createDataModel($data);
        $this->db->replace('task', $data_model);
    }

    public function deleteTask($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('task');
    }
}