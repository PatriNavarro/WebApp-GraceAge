<?php
/**
 * Created by PhpStorm.
 * User: kymeng
 * Date: 07/11/2017
 * Time: 14:29
 */
date_default_timezone_set('UTC');


class Account_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->library('accountViewModel');
    }
    public function getAccount($id) {
        $result = $this->db->get_where('user', array('id' => $id))->result();
        if (count($result)!= 1)
            return null;
        $currentAccount = $this->accountviewmodel->createViewModel($result[0]);
        return $currentAccount;
    }
    public function validateUsername($username) {
        $result = $this->db->get_where('user', array('username' => $username))->result();
        if (count($result)== 0)
            return true;
        return false;
    }
    public function validateDependingUser($id) {
        $result = $this->db->get_where('user', array('depending_user_id' => $id))->result();
        if (count($result)== 0)
            return true;
        return false;
    }
    public function getAccounts($offset, $limit, $query) {
        if ($query != null)
            $this->db->like($query);
        $this->db->limit($offset, $limit);
        $result = $this->db->get('user')->result();
        $accountList = array();
        foreach ($result as $row) {
            $currentAccount = $this->accountviewmodel->createViewModel($row);
            array_push($accountList, $currentAccount);
        }
        return $accountList;
    }
    public function unlink($id) {
        $data_model = array('depending_user_id' => null);
        $this->db->set($data_model);
        $this->db->where('id', $id);
        $this->db->update('user', $data_model);
    }
    public function authenticate($username, $password, $isElderly = false) {
        $password = md5($password);
        $query = array('username'=>$username, 'password'=>$password);
        if ($isElderly) {
            $query['user_type'] = 3;
        }
        $this->db->where($query);
        $result = $this->db->get('user')->result();
        $found = count($result);
        if ($found != 1)
            return 0;
        return $result[0]->id;
    }
    public function createAccount($data) {
        $data_model = $this->accountviewmodel->createDataModel($data);
        $this->db->insert('user', $data_model);
    }
    public function updateAccount($data) {
        $data_model = $this->accountviewmodel->createDataModel($data);
        $id = $data_model['id'];
        unset($data_model['id']);
        $this->db->set($data_model);
        $this->db->where('id', $id);
        $this->db->update('user', $data_model);
    }
    public function deleteAccount($id) {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }
}