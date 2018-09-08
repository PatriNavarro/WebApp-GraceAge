<!DOCTYPE html>

<?php
//$this->lang->load('homescreen', $my_language);
?>

<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="<?php echo $css; ?>">


        <!-- Adding the favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url();?>assets/iconapple-touch-.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url();?>assets/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url();?>assets/favicon-16x16.png">
        <link rel="manifest" href="<?=base_url();?>assets/manifest.json">
        <link rel="mask-icon" href="<?=base_url();?>assets/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">

        <link rel="stylesheet" type="text/css" href="<?=base_url();?>styles/prism.css" />
        <?php
            if(isset($less))
                echo '<link rel="stylesheet/less" type="text/css" href="'.$less.'" />';
        ?>

        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="<?=base_url();?>assets/help_intro.js/introjs_versioned_<?php echo $color;?>.css" rel="stylesheet">
        
        <title><?php echo $title; ?></title>
        
        <script>
            function myFunction() {
                /*here the code of vertical navbar*/
            }
        </script>
    </head>
    
    <body id="body-container" >
        <div id="nav-container" class="container-fluid">
            <nav class="navbar">
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3" id="start-column"><a id="start-button" href="<?php if(isset($home_link)) echo $home_link; ?>" type="button" class="btn btn-lg">HOME</a></div>
                    <div class="col-xs-6 col-sm-6 col-md-6" id="title-column"><?php echo $title;?></div>
                    <div class="row col-xs-3 col-sm-3 col-md-3" id="help-column">
                        <div id="help-left">                      
                            <a id="help_button" href="javascript:void(0);" onclick="javascript:introJs().start();">Help<img id="help-logo" src="<?=base_url();?>assets/help_icon.png"></a>              
                        </div>
                        <div id="help-right">
                            <a id="logout_button" data-toggle="modal" data-target="#confirm-modal" href="#">Logout<img id="logout-logo" src="<?=base_url();?>assets/logout_icon.png"></a>
                        </div>
                        <div id="hamburger">
                            <a href="javascript:void(0);" style="color:white; font-size:34px;" class="icon" onclick="showVerticalNav()">&#9776;</a>            
                        </div>              
                    </div>
                </div>
            </nav>
        </div>

        <div id="content-row" class="row" style="margin-right: 0; margin-left:0;height: 100%; ">
            <?php echo $page_content;?>
        </div>
        
        <div class="modal fade" id="confirm-modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div id="modal-create-header" class="modal-header">
                        Confirmation
                    </div>
                    <form class="form-horizontal" id="task-creation-form" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <p>Are you sure you want to logout?</p>
                            </div>                 
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default">Yes</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </body>

    <script src="<?=base_url();?>scripts/general_page.js"></script>
    <script type="text/javascript" src="<?=base_url();?>assets/help_intro.js/intro.js"></script>
</html>
