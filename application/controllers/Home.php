<?php
/**
 * Created by PhpStorm.
 * User: Patri Navarro
 * Date: 13/11/2017
 * Time: 14:52
 */
date_default_timezone_set('UTC');

class Home extends CI_Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $data_tile11=array('tileTitle'=>'SURVEY RESULTS','tileIcon'=>base_url().'icons/presentation-1.png');
        $data_tile12=array('tileTitle'=>'NOTES','tileIcon'=>base_url().'icons/notes-1.png');
        $data_tile21=array('tileTitle'=>'UPLOAD IMAGE','tileIcon'=>base_url().'icons/image-1.png');
        $data_tile22=array('tileTitle'=>'DEMO VIDEO','tileIcon'=>base_url().'icons/play-button-1.png');
        $data_calendar=array('tileTitle'=>'CALENDAR','tileIcon'=>base_url().'icons/calendar-1.png');

        $data_home=array(
            'tile11'=>$this->load->view('Home/tiles',$data_tile11,true),
            'tile12'=>$this->load->view('Home/tiles',$data_tile12,true),
            'tile21'=>$this->load->view('Home/tiles',$data_tile21,true),
            'tile22'=>$this->load->view('Home/tiles',$data_tile22,true),
            'calendar'=>$this->load->view('Home/calendar',$data_calendar,true)
        );

        $content=$this->load->view('Home/homescreen', $data_home, true);
        $data_general=array(
            'title'=>'Home',
            'help_title' => 'How to work with the homescreen?',
            'help_content' => 'You can click on every group, ...',
            'page_content'=>$content
        );

        $this->load->view('templates/general_page',$data_general);
    }

    public function general_page(){
        $data = array(
            'title'=> 'General Page' ,
            'page_content'=> ''
        ) ;

        $this->load->view('templates/general_page',$data);
    }

    public function surveyresults(){
//      Data pushed to main_page
        $data_main = array(
            'title_text'=>'Write your question here',
            'normal_text'=>'Answers'
        );

//      Data pushed to general_page template
        $data_general = array(
            'title'=>'Survey Results',
            'help_title' => 'How to look at survey results?',
            'help_content' => 'You can see on the left side of the page all the survey questions ...',
            'my_language' => $this->session->userdata('language'),
            'page_content'=>$this->load->view('Home/survey_results',$data_main,true)
        );
        $this->load->view('templates/general_page',$data_general);
    }

    public function notes(){
//        Data pushed to main_page
        $data_main = array(
            'title_text'=>'Heading',
            'normal_text'=>'List of notes'
        );

//        Data pushed to general_page template
        $data_general = array(
            'title'=>'NOTES',
            'page_content'=>$this->load->view('Home/main_page',$data_main,true)
        );
        $this->load->view('templates/general_page',$data_general);
    }

    public function upload_images(){
//        Data pushed to main_page
        $data_main = array(
            'title_text'=>'Choose image to upload',
            'normal_text'=>'List of images'
        );

//        Data pushed to general_page template
        $data_general = array(
            'title'=>'UPLOAD IMAGE',
            'page_content'=>$this->load->view('Home/main_page',$data_main,true)
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
            'title'=>'CALENDAR',
            'page_content'=>$this->load->view('Home/main_page',$data_main,true)
        );
        $this->load->view('templates/general_page',$data_general);
    }
}