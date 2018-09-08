

<?php
//$this->lang->load('caregiver_survey', $my_language );
?>


<link rel="stylesheet" href="<?=base_url();?>styles/main_page.css">
<link rel="stylesheet" href="<?=base_url();?>styles/homescreen.css">

<div id="jumbotron-content" class="container">
    <div id="jumbotron-area" class="jumbotron">
        <table style="width: 100%;">
            <tr>
                <td style="text-align: right">

                </td>
                <td style="text-align: right">
                    Result From: <input id="dtp-start-date" type="date" placeholder="Date">
                    To <input id="dtp-end-date" type="date" placeholder="Date">
                    <input type="hidden" id="question_id" value="{id}">
                    <button id="btn-visualize" type="button" class="btn btn-small">Visualize</button>
                </td>
            </tr>
        </table>
        <div>
            <br/>
            <div class="row">
                <h1 id="question-text">{order}. {question}</h1>
            </div>
            <div id="chart_div"></div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="answer-date-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Date of selected choice</h4>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>            </div>
            <div class="modal-body">
                <div id="selected-description"></div>
                <ul id="lst-answer-date">

                </ul>
            </div>

        </div>

    </div>
</div>

<script src="<?=base_url();?>scripts/config.js" type="text/javascript"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="<?=base_url();?>scripts/site.js" type="text/javascript"></script>
<script src="<?=base_url();?>scripts/visualization.js" type="text/javascript"></script>




