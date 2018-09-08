<!--<script src="../../assets/scripts/userManagement.js"> </script>!-->     <!--not working because he cannot recognize the base URL in a js file!-->
<?php
$this->lang->load('account_properties', $my_language);
?>

<script>
    var dependingElderlyUI = '';
    $(document).ready(function() {
        {js_var}
        $('#caregiver-info').hide();
        $("input[name='user_type']").change(function(){
            if ($(this).val() == '2')
                $('#caregiver-info').show();
            else
                $('#caregiver-info').hide();
        });
        $('#frm-account').validate({
            rules: {
                display_name:{
                    required: true,
                    maxlength: 75,
                },
                username: {
                    required: true,
                    maxlength: 35,
                },
                email: {
                    email: true,
                    maxlength: 90,
                },
                password: {
                    required: true,
                    maxlength: 50,
                },
                c_password: {
                    required: true,
                    equalTo: "#password"
                },
                description: {
                    maxlength: 45,
                }
            }
        });
        $('#elderly-name').hide();
        $('#btn-unlink').hide();
        if (typeof(data) !== 'undefined') {
            $('#unlink-a').attr('href', $('#unlink-a').attr('href')+data.id);
            $('#id').val(data.id);
            $('#display_name').val(data.display_name);
            $('#username').val(data.username);
            $('#email').val(data.email);
            $('#description').val(data.description);
            $('input:radio[name="user_type"]').filter('[value="'+data.user_type+'"]').attr('checked', true);
            $('input:radio[name="preferred_language"]').filter('[value="'+data.preferred_language+'"]').attr('checked', true);
            if (data.depending_user != null) {
                $('#elderly-password-group').remove();
                $('#c_elderlyLogin').hide();
                $('#elderly-name').show();
                $('#btn-unlink').show();
                $('#elderly-name').val(data.depending_user.display_name + ' (' + data.depending_user.username+')');
            }
        }
        $('#btn-submit').click(function () {
            $.ajax({
                type: 'POST',
                url: '<?=base_url();?>index.php/api/Account',
                data: $("#frm-account").serialize(),
                dataTYpe: 'jsonp',
                success: function (result) {
                    if (result.message == '')
                        $(location).attr('href', '<?=base_url();?>index.php/');
                    $('#message').html(result.message);
                    $('#server-response-modal').modal('show');
                }
            });
        })
    });
</script>

<div class="row">
    <div class="col-xs-12">
        <h2 class="page-title">{title}</h2>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-8 col-sm-7">
        <form id="frm-account" class="form-horizontal">
            <input type="hidden" id="id" name="id" />
            <div class="form-group">
                <label class="control-label col-sm-2"><?= $this->lang->line('full_name')?></label>
                <div class="col-sm-10">
                    <input name="display_name" type="text" class="form-control" id="display_name" placeholder="<?= $this->lang->line('full_name')?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2"><?= $this->lang->line('username')?></label>
                <div class="col-sm-10">
                    <input name="username" type="text" class="form-control" id="username" placeholder="<?=$this->lang->line('login_name')?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2"><?= $this->lang->line('email')?></label>
                <div class="col-sm-10">
                    <input name="email" type="email" aria-describedby="emailHelp" class="form-control" id="email" placeholder="<?= $this->lang->line('email')?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2"><?= $this->lang->line('password')?></label>
                <div class="col-sm-10">
                    <input name="password" type="password" class="form-control" id="password" placeholder="<?= $this->lang->line('password')?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2"><?= $this->lang->line('repeat_password')?></label>
                <div class="col-sm-10">
                    <input name="c_password" type="password" class="form-control" id="c_password" placeholder="<?= $this->lang->line('password')?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2"><?= $this->lang->line('description')?></label>
                <div class="col-sm-10">
                    <input name="description" type="text" class="form-control" id="description" placeholder="<?= $this->lang->line('description')?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2"><?= $this->lang->line('preferred_language')?></label>
                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input class="form-check-input" type="radio" name="preferred_language" value="2" checked="checked"/>Nederlands
                    </label>

                    <label class="radio-inline">
                        <input class="form-check-input" type="radio" name="preferred_language" value="1"/>English
                    </label>

                </div>

            </div>
            <div class="form-group">
                <label class="control-label col-sm-2"><?= $this->lang->line('user_type')?></label>
                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input class="form-check-input" type="radio" name="user_type" value="1"/> <?= $this->lang->line('admin')?>
                    </label>

                    <label class="radio-inline">
                        <input id="rdo-caregiver" class="form-check-input" type="radio" name="user_type" value="2"/> <?= $this->lang->line('caregiver')?>
                    </label>

                    <label class="radio-inline">
                        <input class="form-check-input" type="radio" name="user_type" value="3" checked="checked"/> <?= $this->lang->line('elderly')?>
                    </label>
                </div>
            </div>
            <div id="caregiver-info">
                <div class="form-group"  >
                    <label class="control-label col-sm-2"><?= $this->lang->line('elderly_username')?></label>
                    <div class="col-sm-10">
                        <input name="elderly_username" type="text" class="form-control" id="c_elderlyLogin" placeholder="<?= $this->lang->line('login_name_elderly')?>" />
                        <input type="text" disabled class="form-control" id="elderly-name" placeholder="<?= $this->lang->line('login_name_elderly')?>" />
                    </div>
                </div>
                <div class="form-group" id="elderly-password-group"}>
                    <label class="control-label col-sm-2"><?= $this->lang->line('password')?></label>
                    <div class="col-sm-10">
                        <input name="elderly_password" type="password" class="form-control" id="e_password" placeholder="<?= $this->lang->line('password')?>"/>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-2 pull-right" id="btn-unlink">
                    <a id="unlink-a" href="<?=base_url();?>index.php/Account/unlink/">
                        <button type="button" class="btn btn-default">Unlink Elderly</button>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-2 pull-right">
                    <button id="btn-submit" type="button" class="btn btn-default tangible-shadow" style="border-color: darkgray; outline: none;">
                        <?= $this->lang->line('save')?>
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

<div class="modal fade" id="server-response-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title col-xs-10">Operation Failed</h4>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            <div class="modal-body">
                <div id="message"></div>

            </div>
        </div>
    </div>
</div>
