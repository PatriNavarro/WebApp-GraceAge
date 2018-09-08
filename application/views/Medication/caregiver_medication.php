<?php
$this->lang->load('medication', $my_language );
?>

<link rel="stylesheet" href="<?=base_url();?>styles/homescreen.css">
<link rel="stylesheet" href="<?=base_url();?>styles/notes.css">

<script>
    $(document).ready(function () {
        //delete all notes
        var user_id = "1";
        $('#confirm-modal').on('click', '#btn-note-delete-all', function(){
            $.ajax({url: "<?=base_url();?>index.php/Medication/deleteAll/"+user_id, success: function(){
                    $("#medication-table").empty();
                    $("#medication-table").html('<tr id="no-notes-row"><td><p>There is no medication yet...</p></td></tr>');
                }});
        });

        //delete one med
        $('#medication-table').on('click', '.delete-button', function() {
            $.ajax({url: "<?=base_url();?>index.php/medication/delete/"+this.id, success: function(result){
                    id = result.replace(/"/g, '');
                    $('#task-'+id).remove();
                }});
        });

        //edit a medication
        $('#medication-table').on('click', '.edit-button', function() {
            $("#modal-create-header").html("<?=$this->lang->line('edit_medication')?>");
            $('#task-creation-form').attr('action', '<?=base_url();?>index.php/api/medication/existing');
            var rowID = this.id;
            $.ajax({url: "<?=base_url();?>index.php/api/medication/"+rowID+"/row", success: function(result){
                    $("#title").val(result[0].title);
                    $("#content").val(result[0].content);
                    $("#day").val(result[0].day);
                    $("#rowID").val(result[0].id)
                }});
        });
        //Create medication inside database
        $('#head-row').on('click', '.add-note', function(){
            $("#modal-create-header").html("<?=$this->lang->line('add_medication')?>");
            $('#task-creation-form').attr('action', '<?=base_url();?>index.php/api/medication/new');
        });

        //add medication to webpage
        $.ajax({url: "<?=base_url();?>index.php/api/medication/"+user_id+"/user", success: function(result){
                var allMedication = '';
                for(i=0; i < result.length; i++)
                    allMedication += medicationToViewModel(result[i]);

                if(result.length === 0)
                {
                    $("#medication-table").html('<tr id="no-notes-row"><td><p>There is no medication yet...</p></td></tr>');
                }
                else
                {
                    $("#medication-table").html(allMedication);
                }
            }});
    });
</script>

<div class="row" id="head-row">
    <div id="column-nav" class="col-xs-4 col-sm-4 col-md-4">
        <div class="row row1">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <a data-step="2" data-intro="<?=$this->lang->line('h_add_med')?>" data-position='right' href="#" class="add-note" data-toggle="modal" data-target="#create-modal"><?php echo $tile11;?></a>
            </div>
        </div>
        <div class="row row2">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <a data-step="3" data-intro="<?=$this->lang->line('h_remove_med')?>" data-position='right' href="#" data-toggle="modal" data-target="#confirm-modal"><?php echo $tile21;?></a>
            </div>
        </div>
    </div>
    <div data-step="1" data-intro="<?=$this->lang->line('h_list_med')?>" data-position='left' id="column-note" class="col-xs-8 col-sm-8 col-md-8">
        <div class="row">
            <table id="medication-table">

            </table>
        </div>
    </div>
</div>

<!--Dialog code that appears when you click on 'add medication'-->
<div class="modal fade" id="create-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="modal-create-header" class="modal-header">
                <?=$this->lang->line('add_medication')?>
            </div>
            <form class="form-horizontal" id="task-creation-form" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="title"> <?=$this->lang->line('medication_title')?> </label>
                        <div class="col-xs-10">
                            <input type="text" name="title" id="title" class="form-control" autofocus="" required="" placeholder="<?=$this->lang->line('medication_title_placeholder')?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="day"> <?=$this->lang->line('medication_day')?> </label>
                        <div class="col-xs-10">
                            <select class="form-control" id="day" name="day">
                                <option><?=$this->lang->line('monday')?></option>
                                <option><?=$this->lang->line('tuesday')?></option>
                                <option><?=$this->lang->line('wednesday')?></option>
                                <option><?=$this->lang->line('thursday')?></option>
                                <option><?=$this->lang->line('friday')?></option>
                                <option><?=$this->lang->line('saturday')?></option>
                                <option><?=$this->lang->line('sunday')?></option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="content"><?=$this->lang->line('content')?></label>
                        <div class="col-xs-10">
                            <textarea name="content" id="content" class="form-control" required="" rows="10" cols="30" placeholder="<?=$this->lang->line('medication_content_placeholder')?>"></textarea>
                        </div>
                    </div>
                    <div class="form-group" style="display:none;">
                        <input type="text" name="rowID" id="rowID" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn-note-save" type="submit" class="btn btn-default"><?=$this->lang->line('save')?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?=$this->lang->line('cancel')?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Dialog code that appears when you click on 'delete all notes'-->
<div class="modal fade" id="confirm-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <?=$this->lang->line('confirm_delete')?>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-xs-10">
                            <p><?=$this->lang->line('confirm_delete_message')?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn-note-delete-all" type="submit" class="btn btn-default"><?=$this->lang->line('yes')?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?=$this->lang->line('no')?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- to use validate function -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!--to use .ajax function-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>

<!--Javascript file for creating medication structure after get-request and before putting it into webpage-->
<!--<script src="--><?//=base_url();?><!--scripts/note.js" type="text/javascript"></script>-->
<script src="<?=base_url();?>scripts/medication.js" type="text/javascript"></script>
