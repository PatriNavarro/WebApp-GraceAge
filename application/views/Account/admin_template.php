<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>styles/admin.css">
    
    <title>{title}</title>
    {libraries}
</head>

<body>
    <div id="navigation-bar">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: rgba(0, 86, 233,0.7); border-color: #7AA8F5; margin-bottom: 0; ">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-stacked">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?=base_url();?>">
                        Grace Age 2.0
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="nav-stacked"  >
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active nav-item-selected">
                            <a href="<?=base_url();?>index.php/account/manage"><?= $this->lang->line('manage_account')?></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="modal" data-target="#magazine-modal"><?= $this->lang->line('manage_digital_magazine')?></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=base_url();?>index.php/account/logout" ><?= $this->lang->line('logout')?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container blur" style="margin-top: 70px;">
        {content}
    </div>
    
    <!--Dialog code that appears when you click on 'delete all notes'-->
    <div class="modal fade" id="magazine-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="modal-create-header" class="modal-header">
                    Upload magazine
                </div>
                <form class="form-horizontal" id="upload-magazine-form" method="post">
                    <?php if (isset($error)) echo $error; ?>
                    <?php echo form_open_multipart('index.php/Caregiver/do_pdf_upload'); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <p id="magazine-upload-warning">Pay attention: when you upload a new magazine, the old one is automatically deleted!</p> 
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">
                                File input
                            </label>
                            <input type="file" id="exampleInputFile" />
                            <p class="help-block">
                                Example block-level help text here.
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn-magazine-upload" type="submit" class="btn btn-default">Upload</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>