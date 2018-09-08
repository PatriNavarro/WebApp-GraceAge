<link rel="stylesheet" href="<?=base_url();?>styles/login.css">

<?php
$this->lang->load('login_form', $my_language);
?>

<script>
    $(document).ready(function() {
        $('#caregiver_help').hide();

        /*$('.language_select').show();*/
        $('#login-submit').click(function () {
            $.ajax({
                type: 'POST',
                url: '<?=base_url();?>index.php/api/Authentication',
                data: $("#login-form").serialize(),
                dataTYpe: 'jsonp',
                success: function (result) {
                    if (result.link != '')
                        $(location).attr('href', result.link);
                    if (result.link == '' && result.message == '')
                        $('#message').html('Username & password not entered');
                    else
                        $('#message').html(result.message);
                    $('#server-response-modal').modal('show');

                }
            });
        });
    });


    /*$(function(){
        $('.caregiver-button').click(function(){
            $('.panel-choice').hide();
            $('.panel-body').show();
        })
    })*/
</script>

<div class="container-fluid" id="caregiver-form">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="wrapper">
                            <nav class="navbar navbar-default fixed-top">
                                <form id="navbar-content" class="content">
                                    <select id="selector" class="language_select">
                                        <?php if ($my_language === 'english') { ?>
                                            <option value="english">English</option>
                                            <option value="dutch">Nederlands</option>
                                        <?php } else { ?>
                                            <option value="dutch">Nederlands</option>
                                            <option value="english">English</option>
                                        <?php } ?>
                                    </select>
                                </form>
                            </nav>
                        </div>
                        <div class="col-xs-12">
                            <img id="logo" src="<?=base_url();?>assets/logo-regular.png" alt="Grace Age Logo">
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-choice">
                    <div class="row">
                        <div class="col-sm-12"  id="main-content">
                            <div class="row">
                                <p id="welcome"><?= $this->lang->line('welcome')?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="login-form"  role="form" style="display: block;">
                                <div class="form-group">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="<?=$this->lang->line('username')?>" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="<?= $this->lang->line('password')?>">
                                </div>
                                <div class="form-group text-center">
                                    <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                    <label for="remember"> <?= $this->lang->line('remember')?> </label>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input  type="button" name="login-submit" id="login-submit" tabindex="4" class="form-control btn caregiver-button" value="<?= $this->lang->line('login')?>" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <a href="" tabindex="5" class="forgot-password"> <?= $this->lang->line('lost_password')?> </a>
                                                <p class="register"><?= $this->lang->line('no_account')?><a class="register-account" href="<?=base_url();?>index.php/Account/create"><?= $this->lang->line('register_here')?></a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

