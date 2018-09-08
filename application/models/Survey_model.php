<?php

class Survey_model extends CI_Model {
    
    function getQuestionData($question_id) {
        $result = $this->db->get_where('question', array('question_id' => $question_id))->result();
        if(count($result) == 0)
        {
            return 0;
        }
        else
        {
            return $result;
        }
    }
    
    public function getLatestQuestionId($user_id) {
        $this->db->select_max('question_id');
        $this->db->where('user_id', $user_id);
        $result = $this->db->get('answer')->result(); 
        if(count($result) == 0)
        {
            return 0;
        }
        else
        {
            return $result[0]->question_id;
        }
    }
    
    function getChoices($question_id) {
        $result = $this->db->get_where('choice', array('question_id' => $question_id))->result();
        if(count($result) == 0)
        {
            return 0;
        }
        else
        {
            return $result;
        }
    }
    
    public function saveAnswer($data) {
        $this->db->insert('answer', $data);
    }

    public function getResultByDate($user_id, $date) {
        $sql = str_replace('%user_id%', $user_id, GET_RESULT_SQL);
        $sql = str_replace('%created_date%', $date, $sql);
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function getQuestion($question_id) {
        $this->db->where('id', $question_id);
        $result = $this->db->get('question')->result();
        if(count($result) == 0)
            return null;
        else
            return $result[0];
    }
    public function getAnswerSummary($user_id, $question_id, $start_date, $end_date) {
        $sql = str_replace('%user_id%', $user_id, GET_ANSWER_SUMMARY_BETWEEN_DATES);
        $sql = str_replace('%question_id%', $question_id, $sql);
        $sql = str_replace('%start_date%', $start_date, $sql);
        $sql = str_replace('%end_date%', $end_date, $sql);
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function getAnswerDate($user_id, $question_id, $start_date, $end_date, $answer) {
        $sql = str_replace('%user_id%', $user_id, GET_ANSWER_DATE_BY_ANSWER);
        $sql = str_replace('%question_id%', $question_id, $sql);
        $sql = str_replace('%start_date%', $start_date, $sql);
        $sql = str_replace('%end_date%', $end_date, $sql);
        $sql = str_replace('%answer%', $answer, $sql);
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function getQuestions() {
        return $this->db->get('question')->result();
    }
    public function getReliabilityScore($user_id) {
        $sql = str_replace('%user_id%', $user_id, GET_RELIABILITY_SCORE);
        $query = $this->db->query($sql);
        $row=$query->row_array();
        return $row['score'];

    }

    public function getRelianceScore($user_id) {
        $sql = str_replace('%user_id%', $user_id, GET_RELIANCE_SCORE);
        $query = $this->db->query($sql);
        $row=$query->row_array();
        return $row['score'];
    }
}

?>
