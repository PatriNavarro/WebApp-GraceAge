<?php
$this->lang->load('help_button', $my_language );
?>

<link rel="stylesheet" href="<?=base_url();?>styles/homescreen.css">

<div id="column-left" class="col-sm-12 col-md-4">
    <div class="row row1">
        <a data-step="1" data-intro="<?=$this->lang->line('h_survey_results')?>" data-position='right' href="<?=base_url();?>index.php/Caregiver/surveyresults">
            <?php echo $tile11;?>
        </a>
    </div>
    <div class="row row2">
        <a data-step="2" data-intro="<?=$this->lang->line('h_upload_image')?>" data-position='right' href="<?=base_url();?>index.php/Caregiver/images">
        <?php echo $tile21;?>
        </a>
    </div>
</div>
<div id="column-center" class="col-sm-12 col-md-4">
    <div class="row row1">
        <a data-step="3" data-intro="<?=$this->lang->line('h_notes')?>" data-position='right' href="<?=base_url();?>index.php/Caregiver/notes">
        <?php echo $tile12;?>
        </a>
    </div>
    <div class="row row2">
        <a data-step="4" data-intro="<?=$this->lang->line('h_medication_caregiver')?>" data-position='right' href="<?=base_url();?>index.php/Caregiver/medication">
            <?php echo $tile22;?>
        </a>
    </div>
</div>
<div id="column-right" class="col-sm-12 col-md-4">
    <a data-step="5" data-intro="<?=$this->lang->line('h_calendar_caregiver')?>" data-position='left' href="<?=base_url();?>index.php/Caregiver/calendar">
    <?php echo $calendar;?>
    </a>
</div>