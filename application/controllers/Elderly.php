<?php

date_default_timezone_set('UTC');

class Elderly extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('task_model');
        $this->load->model('medication_model');
    }

    public function index() {
        $this->home();
    }

    public function home() {
        $my_language = $this->session->userdata('language');
        $this->lang->load('homescreen', $my_language);
        $data_tile11=array('tileTitle'=>$this->lang->line('fill_survey'),'tileIcon'=>base_url().'assets/green_icons/notes-green.png');
        $data_tile12=array('tileTitle'=>$this->lang->line('read_magazine'),'tileIcon'=>base_url().'assets/green_icons/mag.png');
        $data_tile21=array('tileTitle'=>$this->lang->line('photo_gallery'),'tileIcon'=>base_url().'assets/green_icons/image-green.png');
        $data_tile22=array('tileTitle'=>$this->lang->line('medication'),'tileIcon'=>base_url().'assets/green_icons/medication-1-green.png');
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

        $content=$this->load->view('Home/elderly_homescreen', $data_home, true);
        $data_general=array(
            'title'=>$this->lang->line('title'),
            'page_content'=>$content,
            'css'=>base_url().'styles/general_page_green.css',
            'less'=>base_url().'styles/clndr-green.less',
            'home_link'=>base_url().'index.php/Elderly/home',
            'color'=>'green'
        );

        $this->load->view('templates/general_page',$data_general);
    }

    public function general_page(){
        $data = array(
            'title'=> 'General Page' ,
            'page_content'=> '',
            'css'=>base_url().'styles/general_page_green.css',
            'home_link'=>base_url().'index.php/Elderly/home',
            'color'=>'green'
        ) ;

        $this->load->view('templates/general_page',$data);
    }

    public function read_magazine(){
//      Data pushed to main_page
        $my_language = $this->session->userdata('language');
        $this->lang->load('magazine', $my_language);
        $data_tile11=array('tileTitle'=> $this->lang->line('next_page'),'tileIcon'=>base_url().'assets/green_icons/next_page.png');
        $data_tile21=array('tileTitle'=> $this->lang->line('previous_page'),'tileIcon'=>base_url().'assets/green_icons/previous_page.png');
        $data_main = array(
            'tile11'=>$this->load->view('Home/tiles',$data_tile11,true),
            'tile21'=>$this->load->view('Home/tiles',$data_tile21,true),
            'my_language' => $this->session->userdata('language')
        );
        $data_general = array(
            'title'=>'MAGAZINE',
            'page_content'=>$this->load->view('Elderly/magazine',$data_main,true),
            'css'=>base_url().'styles/general_page_green.css',
            'less'=>base_url().'styles/clndr-green.less',
            'home_link'=>base_url().'index.php/Elderly/home',
            'color'=>'green'
        );
        $this->load->view('templates/general_page',$data_general);
    }

    public function images(){
//        Data pushed to main_page
        $data_main = array(
            'title_text'=>'Choose image to upload',
            'normal_text'=>'List of images'
        );

//        Data pushed to general_page template
        $data_general = array(
            'home_link'=>base_url().'index.php/Elderly/home',
            'title'=>'Images',
            'my_language' => $this->session->userdata('language'),
            'page_content'=>$this->load->view('Elderly/images',$data_main,true),
            'css'=>base_url().'styles/general_page_green.css',
            'color'=>'green'
        );
        $this->load->view('templates/general_page',$data_general);
    }

    public function medication(){
        $my_language = $this->session->userdata('language');
        $this->lang->load('medication', $my_language );

//      Data pushed to main_page
        $data_main = array(
            'title_text'=> $this->lang->line('title_text'),
            'normal_text'=>$this->lang->line('normal_text'),
            'my_language' => $my_language,
            'monday'=>$this->medication_model->getMedicationByDay('Monday'),
            'tuesday'=>$this->medication_model->getMedicationByDay('Tuesday'),
            'wednesday'=>$this->medication_model->getMedicationByDay('Wednesday'),
            'thursday'=>$this->medication_model->getMedicationByDay('Thursday'),
            'friday'=>$this->medication_model->getMedicationByDay('Friday'),
            'saturday'=>$this->medication_model->getMedicationByDay('Saturday'),
            'sunday'=>$this->medication_model->getMedicationByDay('Sunday')
        );


//      Data pushed to general_page template
        $data_general = array(
            'title'=> $this->lang->line('title'),
            'page_content'=>$this->load->view('Medication/elderly_medication',$data_main,true),
            'css'=>base_url().'styles/general_page_green.css',
            'home_link'=>base_url().'index.php/Elderly/home',
            'color'=>'green'
        );
        $this->load->view('templates/general_page',$data_general);
    }


    public function calendar(){
        $data = array(
            'days'=> array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday'),
            'day0'=>$this->task_model->getTasks(date("Y-m-d")),
            'day1'=>$this->task_model->getTasks(date("Y-m-d", strtotime("+1 day"))),
            'day2'=>$this->task_model->getTasks(date("Y-m-d", strtotime("+2 day")))
        );


        $data_general = array(
            'title'=>'CALENDAR',
            'page_content'=>$this->parser->parse('Task/eldery_calendar',$data,true),
            'css'=>base_url().'styles/general_page_green.css',
            'less'=>base_url().'styles/clndr-green.less',
            'home_link'=>base_url().'index.php/Elderly/home',
            'color'=>'green'
        );
        $this->load->view('templates/general_page',$data_general);
    }

    public function survey() {
        $my_language = $this->session->userdata('language');
        $this->lang->load('elderly_survey', $my_language );
        $user_id = $_SESSION['current_user']->id;
        $this->load->model('Survey_model');

        if(isset($_SESSION['question_id']))
        {
            $data['question_id'] = $_SESSION['question_id'];
        }
        else
        {
            //current question is the last filled out question + 1 (next question)
            $data['question_id'] = $this->Survey_model->getLatestQuestionId($user_id) + 1;
            $_SESSION['question_id'] = $data['question_id'];
        }
        if($data['question_id'] > 40)
        {
            $data['question_data'] = $this->Survey_model->getQuestionData($data['question_id'] - 1);
            $data['choices'] = $this->Survey_model->getChoices($data['question_id'] - 1);
        }
        else
        {
            $data['question_data'] = $this->Survey_model->getQuestionData($data['question_id']);
            $data['choices'] = $this->Survey_model->getChoices($data['question_id']);
        }
        $data['my_language'] = $my_language;
        $data_general = array(
            'title'=>$this->lang->line('title'),
            'page_content'=> $this->load->view('Elderly/survey',$data,true),
            'css'=>base_url().'styles/general_page_green.css',
            'home_link'=>base_url().'index.php/Elderly/home',
            'color'=>'green'
        );
        $this->parser->parse('templates/general_page',$data_general);
    }

}
