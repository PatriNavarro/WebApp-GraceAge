<?php
$this->lang->load('elderly_survey', $my_language );
?>

<link rel="stylesheet" href="<?=base_url();?>styles/survey.css">
<link rel="stylesheet" href="<?=base_url();?>styles/homescreen.css">
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>
    window.onload=function() {   
    document.getElementById("submit-form-button").disabled=true;
        if(<?php echo $question_id;?> == 1)
        {
            document.getElementById("prev-button").disabled=true;
        }
    }
    
    $(document).ready(function() {
        $('#prev-button').click(function(){
            window.location.href = "<?php echo base_url();?>index.php/Survey/get_previous_question";
        });
        if(<?php echo $question_id ?> > 40)
        {
            $('#progress-bar-container').hide();
            $('#form-container').hide();
            $('#submit-form-button').hide();
            var dummy = '<h1 id="survey-done-header"><?=$this->lang->line('survey_done')?></h1>';
            $(dummy).insertBefore("#buttons-container");
            
        }
    });
    function check() {
        var ele = document.getElementsByName('answer');
        var flag=0;
        for(var i=0;i<ele.length;i++)
        {
            if(ele[i].checked)
            flag=1;
        } 
        if(flag==1)
        {
            document.getElementById('submit-form-button').disabled=false;
        }
    }
    function addNumber(e){
        if ($('#number_input').val().length >= <?php echo $question_data[0]->question_type?>)
            return;
        var v = $('#number_input').val();
        $('#number_input').val(v + e);
        document.getElementById('submit-form-button').disabled=false;
    }
    function clearForm(){
        $('#number_input').val( "" );
        document.getElementById('submit-form-button').disabled=true;        
    }
</script>

<div id="jumbotron-content" class="container">
    <div id="jumbotron-area" class="jumbotron">
        <div data-step="5" data-intro="<?=$this->lang->line('h_prog_bar')?>" data-position='down' class="container" id="progress-bar-container">
            <div class="progress">
                <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="0"
                    aria-valuemin="0" aria-valuemax="100" style="width:<?php echo (($question_id)-1)/40*100 ?>%">
                </div>
            </div>
        </div>
        
        <div id="form-container" class="container">
            <div data-step="1" data-intro="<?=$this->lang->line('h_question')?>" data-position='down' id="question-container">
                <h1 id="question" style="text-align: center; padding-top:2%;"> <?= $question_id?>. <?php if($my_language == "dutch") {
                                                                                            echo $question_data[0]->question."";
                                                                                            } else {
                                                                                            echo $question_data[0]->vraag."";
                                                                                        }?></h1>            
            </div>
            
            <form id="myForm" class ="content" action="<?php echo base_url();?>index.php/Survey/process_answer" method="POST">
                <div data-step="2" data-intro="<?=$this->lang->line('h_answers')?>" data-position='down' id="choices-container">
                    <script>
                        if(<?php echo $question_data[0]->question_type?> == 1)
                        {
                            <?php $amount = count($choices) . "";
                                $row_index = 0;
                                $choice_nr = 0;
                            foreach ($choices as $choice) { ?>
                                if(<?=$row_index?> % 2 == 0)
                                {
                                    var row_dummy = '<div id="choice-row<?=floor($row_index/2)?>" class="row display-flex" <?php if($amount < 7) {echo 'style="height: 150px"';}
                                                                                                                                    else {echo 'style="margin-top: auto; margin-bottom:auto;"';}?>></div>';
                                    document.getElementById('choices-container').innerHTML += row_dummy;
                                }
                                var dummy = `<div class="col-md-6" id="choice<?= $choice_nr ?>"><input type="radio" id="answer<?= $choice->value ?>" 
                                                  value="<?= $choice->value ?>" name="answer" class="check" onclick="check()"/>
                                             <label for="answer<?= $choice->value ?>" class="btn btn-success btn-lg btn-block">
                                                <?php if($this->session->get_userdata('language') == 'english')
                                                {
                                                    echo $choice->choice_description;
                                                } else {
                                                    echo $choice->nl_choice_description;
                                                }?></label></div>`;
                                document.getElementById('choice-row<?= floor($row_index/2)?>').innerHTML += dummy;
                                <?php $row_index++; $choice_nr++?>
                            <?php } ?>
                            if(<?=$amount?> % 2 == 1)
                            {
                                document.getElementById("choice<?= $amount - 1?>").className = "col-md-12";
                            }
                        }
                        if(<?php echo $question_data[0]->question_type?> > 1)
                        {
                            var row_dummy = '<div id="choice-row0" class="row display-flex" ></div>';
                            document.getElementById('choices-container').innerHTML += row_dummy;
                            var number_input =
                            `<div id='number-input-container'>
                            <input id='number_input' class='text-field' type='number' value='' name='answer'  />
                            <br/>
                            <input type='button' class='PINbutton' name='1' value='1' id='1' onClick=addNumber(1); />
                            <input type='button' class='PINbutton' name='2' value='2' id='2' onClick=addNumber(2); />
                            <input type='button' class='PINbutton' name='3' value='3' id='3' onClick=addNumber(3); />
                            <br>
                            <input type='button' class='PINbutton' name='4' value='4' id='4' onClick=addNumber(4); />
                            <input type='button' class='PINbutton' name='5' value='5' id='5' onClick=addNumber(5); />
                            <input type='button' class='PINbutton' name='6' value='6' id='6' onClick=addNumber(6); />
                            <br>
                            <input type='button' class='PINbutton' name='7' value='7' id='7' onClick=addNumber(7); />
                            <input type='button' class='PINbutton' name='8' value='8' id='8' onClick=addNumber(8); />
                            <input type='button' class='PINbutton' name='9' value='9' id='9' onClick=addNumber(9); />
                            <br>
                            <input type='button' class='PINbutton clear' name='-' value='clear' id='-' onClick=clearForm(); />
                            <input type='button' class='PINbutton' name='0' value='0' id='0' onClick=addNumber(0); />
                            </div>`;
                            document.getElementById('choice-row0').innerHTML += number_input; 
                            $amount = <?php echo count($choices) . ""; ?>;
                            var col_dummy = '<div id="choice-row1" class="col-md-6"></div>';
                            document.getElementById('choice-row0').innerHTML += col_dummy;   
                            <?php foreach ($choices as $choice) { ?>
                            var dummy = `<input type="radio" id="answer<?= $choice->value ?>" value="<?= $choice->value ?>" name="answer" class="check" onclick="check()"/>
                                             <label for="answer<?= $choice->value ?>" class="btn btn-success btn-lg btn-block">
                                                <?php if($this->session->get_userdata('language') == 'english')
                                                {
                                                    echo $choice->choice_description;
                                                } else {
                                                    echo $choice->nl_choice_description;
                                                }?></label>`;
                            document.getElementById('choice-row1').innerHTML += dummy;  
                            <?php } ?>
                        }
                    </script>
                </div> 
            </form>
        </div>
        <div id="buttons-container">
                    <div id="submit-form-button-div">
                        <button id="submit-form-button" data-step="3" data-intro="<?=$this->lang->line('h_next_q')?>" data-position='up'
                                type="submit" form="myForm" value="Next" name="submit" href="#" type="button"
                                class="btn btn-lg">
                            <?=$this->lang->line('next')?>
                        </button>
                    </div>
                    <button data-step="4" data-intro="<?=$this->lang->line('h_prev_q')?>" data-position='up'
                            id="prev-button" href="#" type="button" class="btn btn-lg">
                        <?=$this->lang->line('previous')?>
                    </button>
        </div>
    </div>
</div>
