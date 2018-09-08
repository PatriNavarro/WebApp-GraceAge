<?php
/**
 * Created by PhpStorm.
 * User: kymeng
 * Date: 07/11/2017
 * Time: 14:59
 */
require(APPPATH.'libraries/REST_Controller.php');

date_default_timezone_set('UTC');

class Account extends REST_Controller {
    public function __construct($config = 'rest'){
        parent::__construct($config);
        $this->load->model('account_model');
    }

    public function index_get($id=null) {
        $accountModel = $this->account_model;
        $result = null;
        if ($id != null)
            $result = $accountModel->getAccount($id);
        else {
            $offset = (int)$this->query('pageIndex');
            $limit = (int)$this->query('pageSize') ;
            $offset = $offset;
            $this->db->insert('post_log', array('data' => var_export($offset, true)));

            if (isset($_GET['pageIndex']))
                unset($_GET['pageIndex']);
            if (isset($_GET['pageSize']))
                unset($_GET['pageSize']);
            $query = array_filter($_GET);
            $result = $accountModel->getAccounts($offset, $limit, $query);
        }
        $this->db->insert('post_log', array('data' => var_export($result, true)));

        $response = array(
            'odata.metadata'=> base_url().'api/account/',
            'value' => $result,
            'itemsCount'=> $limit
        );

        $this->response($response);
    }

    public function index_put($id) {
        $this->addDependingUserId();
        $this->account_model->updateAccount($_POST);
        redirect('index.php/Account/manage');
    }
    private function addDependingUserId() {
        $elderlyId = 0;
        $errorMessage = null;
        if ($_POST['user_type'] == 2) {
            $elderlyUser = $_POST['elderly_username'];
            $elderlyPass = $_POST['elderly_password'];
            $elderlyId = $this->account_model->authenticate($elderlyUser, $elderlyPass, true);
            if (is_numeric($elderlyId) && $elderlyId!= '') {
                $elderlyId = (int) $elderlyId;
                if (!$this->account_model->validateDependingUser($elderlyId)) {
                    $elderlyId = 0;
                    $errorMessage = DEPENDING_USER_IS_LINKED;
                }
            }
            else {
                $elderlyId = 0;
                $errorMessage = WRONG_DEPENDING_USER_CREDENTIAL;
            }

        }
        if ($elderlyId != 0)
            $_POST['depending_user_id'] = $elderlyId;
        return $errorMessage;
    }
    public function index_post() {
        if (isset($_POST['id']))
            if ($_POST['id'] != '') {
                $this->index_put($_POST['id']);
                return;
            }
        //check if existed
        if (!$this->account_model->validateUsername($_POST['username'])) {
            $this->response(array('message'=> USERNAME_EXISTED));
            return;
        }

        $errorMessage = $this->addDependingUserId();
        if ($errorMessage != null){
            $this->response(array('message'=> $errorMessage));
            return;
        }

        $this->account_model->createAccount($_POST);
        $this->response(array('message'=> ''));


    }

    public function index_delete($id) {
        $this->account_model->deleteAccount($id);
    }
}