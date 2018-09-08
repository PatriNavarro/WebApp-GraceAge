<?php
/**
 * Created by PhpStorm.
 * User: kymeng
 * Date: 27/10/2017
 * Time: 16:14
 */

date_default_timezone_set('UTC');

class Account extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('account_model');
    }

    public function template() {
        $data = array(
            'title' => 'Grace Age',
        );
        $this->template->load('default', 'content', $data);
    }

    public function index() {

       $this->login();
    }

    public function create(){
        $my_language = $this->session->userdata('language');
        $this->lang->load('manage_account', $my_language);
        $content = $this->parser->parse('Account/account_properties',
            array(
                'title' => $this->lang->line('create_new_user_account'),
                'js_var'=>'',
                'my_language' => $this->session->userdata('language')
        ), true);
        $libraries = $this->load->view('Libraries/form_validation', '', true);
        $data = array (
            'title' => $this->lang->line('create_user'),
            'libraries' => $libraries, 
            'content' => $content
        );

        $this->parser->parse('Account/admin_template', $data);
    }

    public function edit($id){
        $my_language = $this->session->userdata('language');
        $this->lang->load('manage_account', $my_language);
        if ($_SESSION['current_user']->user_type != 1)
            $id = $_SESSION['current_user']->id;
        $current_account = $this->account_model->getAccount($id);
        if (property_exists($current_account, 'depending_user_id'))
            $current_account->depending_user = $this->account_model->getAccount($current_account->depending_user_id);
        $content = $this->parser->parse('Account/account_properties',
            array(
                'title' => $this->lang->line('modify_user_account'),
                'js_var'=>'data='.json_encode($current_account),
                'my_language' => $this->session->userdata('language')
            ), true);
        $libraries = $this->load->view('Libraries/form_validation', '', true);
        $data = array ('libraries' => $libraries, 'content' => $content,);

        $this->parser->parse('Account/admin_template', $data);
    }

    public function unlink($id) {
        if ($_SESSION['current_user']->user_type != 1)
            if ($_SESSION['current_user']->id != $id)
            {
                redirect(base_url().'index.php/Account/edit/'.$id);
                return;
            }
        $this->account_model->unlink($id);
        redirect(base_url().'index.php/Account/edit/'.$id);
    }
    public function delete($id) {
        $this->account_model->deleteAccount($id);
    }

    public function manage() {
        $my_language = $this->session->userdata('language');
        $this->lang->load('manage_account', $my_language);
        $content = $this->parser->parse('Account/manage_account', 
            array(
                'my_language' => $this->session->userdata('language')
        ), true);

        $libraries = $this->load->view('Libraries/data_grid', '', true);
        $data = array (
            'title' => $this->lang->line('manage_users'),
            'libraries' => $libraries, 
            'content' => $content
        );

        $this->parser->parse('Account/admin_template', $data);
    }

    public function login() {
        $my_language = $this->session->userdata('language');
        $this->lang->load('login_form', $my_language);
        $data = array(
            'title' => $this->lang->line('login'),
            'my_language' => $this->session->userdata('language')
        );
        $this->template->load('default', 'Account/login', $data);
    }
    
    public function logout() {
        $_SESSION['authenticated'] = false;
        $this->caregiver();
    }

    public function setLanguage(){
        $lang = isset($_GET['language']) ? $_GET['language'] : 'english';
        //set user session's language to the language
        if ($lang == 'english') {
            $this->session->set_userdata('language', 'english');
        }
        else if ($lang == 'dutch') {
            $this->session->set_userdata('language', 'dutch');
        }

        /*redirect(base_url().'index.php/');*/
    }
}
