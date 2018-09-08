<?php
$this->lang->load('medication', $my_language );
?>

<link rel="stylesheet" href="<?=base_url();?>styles/homescreen.css">
<link rel="stylesheet" href="<?=base_url();?>styles/main_page.css">
<link rel="stylesheet" href="<?=base_url();?>styles/medication.css">

<div class="container-fluid">
    <div data-step="1" data-intro="<?=$this->lang->line('h_list_med')?>" data-position='right' id="jumbotron-content" class="container">
        <div id="jumbotron-area" class="jumbotron">
            <div class="row day-row">
                <div class="col-md-4 day-names">
                    <h3>
                        <?=$this->lang->line('monday')?>
                    </h3>
                </div>
                <div class="col-md-8">
                    <ul>
                        <?php
                        foreach ($monday as $medication)
                            echo '<li>'.$medication->title.' - '.$medication->content.'</li>';
                        ?>
                    </ul>
                </div>
            </div>
            <div class="row day-row">
                <div class="col-md-4 day-names">
                    <h3>
                        <?=$this->lang->line('tuesday')?>
                    </h3>
                </div>
                <div class="col-md-8">
                    <ul>
                        <?php
                        foreach ($tuesday as $medication)
                            echo '<li>'.$medication->title.' - '.$medication->content.'</li>';
                        ?>
                    </ul>
                </div>
            </div>
            <div class="row day-row">
                <div class="col-md-4 day-names">
                    <h3>
                        <?=$this->lang->line('wednesday')?>
                    </h3>
                </div>
                <div class="col-md-8">
                    <ul>
                        <?php
                        foreach ($wednesday as $medication)
                            echo '<li>'.$medication->title.' - '.$medication->content.'</li>';
                        ?>
                    </ul>
                </div>
            </div>
            <div class="row day-row">
                <div class="col-md-4 day-names">
                    <h3>
                        <?=$this->lang->line('thursday')?>
                    </h3>
                </div>
                <div class="col-md-8">
                    <ul>
                        <?php
                        foreach ($thursday as $medication)
                            echo '<li>'.$medication->title.' - '.$medication->content.'</li>';
                        ?>
                    </ul>
                </div>
            </div>
            <div class="row day-row">
                <div class="col-sm-12 col-md-4 day-names">
                    <h3>
                        <?=$this->lang->line('friday')?>
                    </h3>
                </div>
                <div class="col-sm-12 col-md-8">
                    <ul>
                        <?php
                        foreach ($friday as $medication)
                            echo '<li>'.$medication->title.' - '.$medication->content.'</li>';
                        ?>
                    </ul>
                </div>
            </div>
            <div class="row day-row">
                <div class="col-sm-12 col-md-4 day-names">
                    <h3>
                        <?=$this->lang->line('saturday')?>
                    </h3>
                </div>
                <div class="col-sm-12 col-md-8">
                    <ul>
                        <?php
                        foreach ($saturday as $medication)
                            echo '<li>'.$medication->title.' - '.$medication->content.'</li>';
                        ?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 day-names">
                    <h3>
                        <?=$this->lang->line('sunday')?>
                    </h3>
                </div>
                <div class="col-sm-12 col-md-8">
                    <ul>
                        <?php
                        foreach ($sunday as $medication)
                            echo '<li><h2>'.$medication->title.'</h2> - '.$medication->content.'</li>';
                        ?>
                    </ul>
                </div>
            </div>
            <table id="result-contents" style="width: 100%;">
            </table>
        </div>
    </div>
</div>