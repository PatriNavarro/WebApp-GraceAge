<?php

class Caregiver extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('task_model');
    }

    public function index() {
        $this->home();
    }

    public function home() {
        $my_language = $this->session->userdata('language');
        $this->lang->load('homescreen', $my_language);
        $data_tile11=array('tileTitle'=>  $this->lang->line('survey_results'),'tileIcon'=>base_url().'assets/blue_icons/presentation-1.png');
        $data_tile12=array('tileTitle'=>$this->lang->line('notes'),'tileIcon'=>base_url().'assets/blue_icons/notes-1.png');
        $data_tile21=array('tileTitle'=>$this->lang->line('upload_image'),'tileIcon'=>base_url().'assets/blue_icons/upload.png');
        $data_tile22=array('tileTitle'=>$this->lang->line('medication'),'tileIcon'=>base_url().'assets/blue_icons/medication-1-blue.png');
        $data_calendar=array(
            'tileTitle'=>$this->lang->line('calendar'),
            'tileIcon'=>base_url().'assets/green_icons/calendar-green.png',
            'taskList' => $this->task_model->getTodayTasks());
        $data_home=array(
            'tile11'=>$this->load->view('Home/tiles',$data_tile11,true),
            'tile12'=>$this->load->view('Home/tiles',$data_tile12,true),
            'tile21'=>$this->load->view('Home/tiles',$data_tile21,true),
            'tile22'=>$this->load->view('Home/tiles',$data_tile22,true),
            'calendar'=>$this->load->view('Task/daily_calendar',$data_calendar,true),
            'my_language' => $my_language
        );

        $content=$this->load->view('Home/caregiver_homescreen', $data_home, true);
        $data_general=array(
            'title'=>$this->lang->line('title'),
            'page_content'=>$content,
            'css'=>base_url().'styles/general_page_blue.css',
            'less'=>base_url().'styles/clndr-blue.less',
            'home_link'=>base_url().'index.php/Caregiver/home',
            'color'=>'blue'
        );

        $this->load->view('templates/general_page',$data_general);
    }

    public function surveyresults(){
        $my_language = $this->session->userdata('language');
        $this->lang->load('caregiver_survey', $my_language );
        $user_id = $_SESSION['current_user']->id;
        $this->load->model('Survey_model');

        //      Data pushed to main_page
        $data_main = array(
            'title_text'=> $this->lang->line('title_text'),
            'normal_text'=>$this->lang->line('normal_text'),
            'my_language' => $my_language,
            'reliability_score'=>$this->Survey_model->getReliabilityScore(151),
            'reliance_score'=>$this->Survey_model->getRelianceScore(151)
        );

        //      Data pushed to general_page template
        $data_general = array(
            'title'=> $this->lang->line('survey_results'),
            'page_content'=>$this->load->view('Survey/global_results',$data_main,true),
            'css'=>base_url().'styles/general_page_blue.css',
            'home_link'=>base_url().'index.php/Caregiver/home',
            'color'=>'blue'
        );
        $this->load->view('templates/general_page',$data_general);
    }

    public function notes(){
        $my_language = $this->session->userdata('language');
        $this->lang->load('notes', $my_language );
        $data_tile11=array('tileTitle'=> $this->lang->line('add_notes'),'tileIcon'=>base_url().'assets/blue_icons/notes-1.png');
        $data_tile21=array('tileTitle'=> $this->lang->line('remove_all_notes'),'tileIcon'=>base_url().'assets/blue_icons/notes-1-delete.png');
        //        Data pushed to main_page
        $data_main = array(
            'tile11'=>$this->load->view('Home/tiles',$data_tile11,true),
            'tile21'=>$this->load->view('Home/tiles',$data_tile21,true),
            'my_language' => $this->session->userdata('language')
        );

    //        Data pushed to general_page template
        $data_general = array(
            'title'=>$this->lang->line('title'),
            'page_content'=>$this->load->view('Note/notes',$data_main,true),
            'css'=>base_url().'styles/general_page_blue.css',
            'home_link'=>base_url().'index.php/Caregiver/home',
            'color'=>'blue'
        );
        $this->load->view('templates/general_page',$data_general);
    }

    public function images(){
        $my_language = $this->session->userdata('language');
//        Data pushed to main_page
        $data_main = array(
            'title_text'=>'Choose image to upload',
            'normal_text'=>'List of images',
            'my_language' => $this->session->userdata('language')
        );

//      Data pushed to general_page template
        $data_general = array(
            'home_link'=>base_url().'index.php/Caregiver/home',
            'title'=>'Images',
            'page_content'=>$this->load->view('Caregiver/images',$data_main,true),
            'css'=>base_url().'styles/general_page_blue.css',
            'color'=>'blue'
        );
        $this->load->view('templates/general_page',$data_general);
    }
    
       public function show_upload() {
           $this->load->helper(array('form', 'url'));
        $data_general=array(
            'title'=>'Home',
            'page_content'=>$this->load->view('upload_form', array('error' => ' ')),
            'css'=>base_url().'styles/general_page_blue.css',
            'color'=>'blue'
        );

        $this->load->view('templates/general_page',$data_general);
    }
    
    public function do_upload() {
        $config['upload_path'] = './assets/image_upload/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('upload_form', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
                //      Data pushed to general_page template
            $data_general = array(
                'title'=>'Images',
                'my_language' => $this->session->userdata('language'),
                'page_content'=>$this->load->view('Caregiver/images',$data,true),
                'css'=>base_url().'styles/general_page_blue.css',
                'color'=>'blue'
            );
            $this->load->view('templates/general_page',$data_general);
    
        }
    }
    
    public function remove_image($name){
        
    }

    public function do_pdf_upload() {
        set_time_limit(0);
        ini_set("upload_max_filesize",30);

        $config['upload_path'] = './assets/magazine_upload/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 30000;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('upload_form', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            //      Data pushed to general_page template
            $data_general = array(
                'title'=>'Images',
                'help_title' => 'How to upload images?',
                'help_content' => 'To upload a new image ...',
                'my_language' => $this->session->userdata('language'),
                'page_content'=>$this->load->view('Caregiver/images',$data,true),
                'css'=>base_url().'styles/general_page_blue.css',
                'color'=>'blue'
            );
            $this->load->view('templates/general_page',$data_general);
        }
    }

    public function medication(){
        $my_language = $this->session->userdata('language');
        $this->lang->load('medication', $my_language );
        $data_tile11=array('tileTitle'=> $this->lang->line('add_medication'),'tileIcon'=>base_url().'assets/blue_icons/medication-1-blue.png');
        $data_tile21=array('tileTitle'=> $this->lang->line('remove_all_medication'),'tileIcon'=>base_url().'assets/blue_icons/remove_med.png');
        //        Data pushed to main_page
        $data_main = array(
            'tile11'=>$this->load->view('Home/tiles',$data_tile11,true),
            'tile21'=>$this->load->view('Home/tiles',$data_tile21,true),
            'my_language' => $this->session->userdata('language')
        );

        //        Data pushed to general_page template
        $data_general = array(
            'title'=>$this->lang->line('title'),
            'help_title' => $this->lang->line('help_title'),
            'help_content' => $this->lang->line('help_content'),
            'page_content'=>$this->load->view('Medication/caregiver_medication',$data_main,true),
            'css'=>base_url().'styles/general_page_blue.css',
            'home_link'=>base_url().'index.php/Caregiver/home',
            'color'=>'blue'
        );
        $this->load->view('templates/general_page',$data_general);
    }

    public function calendar(){
//        Data pushed to main_page
        $data_main = array(
            'title_text'=>'Choose day',
            'normal_text'=>'List of tasks for that day'
        );
//
//        Data pushed to general_page template
        $data_general = array(
            'title'=>'Calendar',
            'my_language' => $this->session->userdata('language'),
            'page_content'=>$this->load->view('Task/manage',$data_main,true),
            'css'=>base_url().'styles/general_page_blue.css',
            'less'=>base_url().'styles/clndr-blue.less',
            'home_link'=>base_url().'index.php/Caregiver/home',
            'color'=>'blue'
        );
        $this->load->view('templates/general_page',$data_general);
    }
}
