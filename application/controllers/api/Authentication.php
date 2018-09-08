<?php
/**
 * Created by PhpStorm.
 * User: kymeng
 * Date: 06/12/2017
 * Time: 22:21
 */
require(APPPATH.'libraries/REST_Controller.php');

date_default_timezone_set('UTC');

class Authentication extends REST_Controller {
    public function __construct($config = 'rest'){
        parent::__construct($config);
        $this->load->model('account_model');
    }

    public function index_post() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');


        $id = $this->account_model->authenticate($username, $password);
        $currentUser = null;

        if ($id != 0) {
            $this->session->set_userdata('authenticated', true);
            $currentUser = $this->account_model->getAccount($id);
            $_SESSION['current_user'] = $currentUser;
            $_SESSION['user_type'] = $currentUser->user_type;
        }
        else {
            $this->session->set_userdata('authenticated', false);
            $this->response(
                array(
                    'message'=> WRONG_USER_CREDENTIAL,
                    'link' => ''
            ));
            return;
        }

        $link = '';
        switch ($currentUser->user_type) {
            case ADMIN: $link=base_url().'index.php/Account/manage';break;
            case ELDERLY: $link=base_url().'index.php/Elderly/home';break;
            case CAREGIVER: $link=base_url().'index.php/Caregiver/home';break;
        }
        $this->response(
            array(
                'message'=> '',
                'link' => $link
            ));
    }


}