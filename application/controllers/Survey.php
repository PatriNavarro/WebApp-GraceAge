<?php
/**
 * Created by PhpStorm.
 * User: kymeng
 * Date: 26/11/2017
 * Time: 22:50
 */
date_default_timezone_set('UTC');
class Survey extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('survey_model');
    }

    function results() {
        $my_language = $this->session->userdata('language');
        $this->lang->load('caregiver_survey', $my_language );


        $data = array('figure' => 1); //1 is the data from the model

        $data_general = array(
            'title'=> $this->lang->line('survey_results'),
            'help_title' => $this->lang->line('help_title'),
            'help_content' => $this->lang->line('help_content'),
            'page_content'=>$this->load->view('Survey/detail_info/visualization', $data, true),
            'css'=>base_url().'styles/general_page_blue.css',
            'home_link'=>base_url().'index.php/Caregiver/home',
            'color'=>'blue'
        );
        $this->load->view('templates/general_page',$data_general);

    }
    function visualize($question_id) {
        $my_language = $this->session->userdata('language');
        $this->lang->load('caregiver_survey', $my_language );

        $currentQuestion = $this->survey_model->getQuestion($question_id);
        $data = array(
            'id' => $question_id,
            'question' => $currentQuestion->question,
            'order' => $currentQuestion->question_id);

        $data_general = array(
            'title'=> $this->lang->line('survey_results'),
            'help_title' => $this->lang->line('help_title'),
            'help_content' => $this->lang->line('help_content'),
            'page_content'=>$this->parser->parse('Survey/visualization', $data, true),
            'css'=>base_url().'styles/general_page_blue.css',
            'home_link'=>base_url().'index.php/Caregiver/home',
            'color'=>'blue'
        );
        $this->load->view('templates/general_page',$data_general);
    }

    function detail($question_id, $answer, $startDate, $endDate ) {
        $my_language = $this->session->userdata('language');
        $this->lang->load('caregiver_survey', $my_language );

        $currentQuestion = $this->survey_model->getQuestion($question_id);
        $data = array(
            'id' => $question_id,
            'question' => $currentQuestion->question,
            'order' => $currentQuestion->question_id);

        $data_general = array(
            'title'=> $this->lang->line('survey_results'),
            'help_title' => $this->lang->line('help_title'),
            'help_content' => $this->lang->line('help_content'),
            'page_content'=>$this->parser->parse('Survey/visualization', $data, true),
            'css'=>base_url().'styles/general_page_blue.css',
            'home_link'=>base_url().'index.php/Caregiver/home',
            'color'=>'blue'
        );
        $this->load->view('templates/general_page',$data_general);
    }
    
    public function process_answer() {
        if (!empty($_POST['submit'])) {
            $user_id = $_SESSION['current_user']->id;
            $this->load->model('Survey_model');
            $data['created_date'] = date('Y-m-d H:i:s', time());
            $question_id = $_SESSION['question_id'];
            $data['question_id'] = $question_id;
            $data['user_id'] = $user_id;
            $data['selected_value'] = $_POST['answer'];
            $this->Survey_model->saveAnswer($data);
            $_SESSION['question_id']++;
        }
        redirect('index.php/Elderly/survey'); /* Redirect browser */
        exit();
    }

    public function get_previous_question() {
        if(isset($_SESSION['question_id']))
        {
            if($_SESSION['question_id'] == 1)
            {
                //already checked when the button is pressed in survey.php, this is a safety check
                alert("Can't go back, this is the first question!");
            }
            else
            {
                $_SESSION['question_id']--;
            }
        }
        else
        {
            //current question is the last filled out question + 1 (next question)
            $_SESSION['question_id'] = $this->Survey_model->getLatestQuestionId($user_id) + 1;
            if($_SESSION['question_id'] == 1)
            {
                //already checked when the button is pressed in survey.php, this is a safety check
                alert("Can't go back, this is the first question!");
            }
            else
            {
                $_SESSION['question_id']--;
            }
        }
        redirect('index.php/Elderly/survey'); /* Redirect browser */
    }

    public function reliability_explanation(){
        $my_language = $this->session->userdata('language');
        $this->lang->load('caregiver_survey', $my_language );
        $user_id = $_SESSION['current_user']->id;
        $this->load->model('Survey_model');

        //      Data pushed to main_page
        $data_main = array(
            'title_text'=> $this->lang->line('title_text'),
            'normal_text'=>$this->lang->line('normal_text'),
            'my_language' => $my_language,
            'reliability_score'=>$this->Survey_model->getReliabilityScore(151)
        );

        //      Data pushed to general_page template
        $data_general = array(
            'title'=> $this->lang->line('survey_results'),
            'page_content'=>$this->load->view('Survey/explanations/reliability_explanation',$data_main,true),
            'css'=>base_url().'styles/general_page_blue.css',
            'home_link'=>base_url().'index.php/Caregiver/home',
            'color'=>'blue'
        );
        $this->load->view('templates/general_page',$data_general);
    }
}