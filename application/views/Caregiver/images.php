<?php
$this->lang->load('caregiver_upload', $my_language);
?>
<link rel="stylesheet" href="<?= base_url(); ?>styles/main_page.css">
<link rel="stylesheet" href="<?= base_url(); ?>styles/homescreen.css">

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">

            <button type="button"  class="btn btn-lg" style="margin:10px" data-toggle="modal" data-target="#image-modal" >
                <?= $this->lang->line('upload_image') ?>
            </button>

        </div>
        <div class="col-md-6">
            <button type="button" class="btn btn-lg" style="margin:10px">
                <?= $this->lang->line('delete_image') ?>
            </button>

        </div>
    </div>
    <div class="row">
        <?php
        $this->load->helper('directory'); //load directory helper
        $dir = "assets/image_upload/"; // Your Path to folder
        $map = directory_map($dir); /* This function reads the directory path specified in the first parameter and builds an array representation of it and all its contained files. */
        $index = 0;
        // a for loop that:
        // - loads all images in the assets/image_upload path
        foreach ($map as $k) {
            ?>
            <img src="<?php echo base_url($dir) . "/" . $k; ?>" style="margin:10px" height="200" width="200" data-toggle="modal" data-target="#image-modal<?php echo $index ?>" >

            <!-- in the for loop generate image Modals with an $index value -->
            <div class="modal fade" id="image-modal<?php echo $index ?>" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <img src="<?php echo base_url($dir) . "/" . $k; ?>" style="margin:10px" height="300" width="300" >
                    <button type="button" class="btn btn-lg" style="margin:10px">
                        <?= $this->lang->line('delete_image') ?>
                    </button>

                </div>
            </div>

            <?php
            $index++;
        }
        ?>


    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">

            <button type="button" class="btn btn-lg" style="margin:10px" data-toggle="modal" data-target="#magazine-modal" >
                <?= $this->lang->line('upload_magazine') ?>
            </button>

        </div>
        <div class="col-md-6">
            <button type="button" class="btn btn-lg" style="margin:10px">
                <?= $this->lang->line('delete_magazine') ?>
            </button>
        </div>
    </div>

    <div class="row">

        <?php
        $this->load->helper('directory'); //load directory helper
        $dir = "assets/magazine_upload/"; // Your Path to folder
        $map = directory_map($dir); /* This function reads the directory path specified in the first parameter and builds an array representation of it and all its contained files. */

        foreach ($map as $k) {
            ?>
            <img src="<?php echo base_url() . "assets/Pdflogo.png" ?>" width="100px" height="100px" />
            <sub> <?php echo $k ?> </sub>
        <?php } ?>
    </div>
</div>

<!-- Magazine Modal -->
<div class="modal fade" id="magazine-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= $this->lang->line('magazine_modal_title') ?></h4>
            </div>
            <div class="modal-body">
                <link rel="stylesheet" href="<?= base_url(); ?>styles/survey.css">
                <?php if (isset($error)) echo $error; ?>
                <?php echo form_open_multipart('index.php/Caregiver/do_pdf_upload'); ?>
                <div class="container">
                    <form>

                        <input type="file" name="userfile" size="20" />

                        <br /><br />

                        <input type="submit" value="upload" />

                    </form>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('close') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- upload Modal -->
<div class="modal fade" id="image-modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= $this->lang->line('image_modal_title') ?></h4>
            </div>
            <div class="modal-body">
                <link rel="stylesheet" href="<?= base_url(); ?>styles/survey.css">
                <?php if (isset($error)) echo $error; ?>
                <?php echo form_open_multipart('index.php/Caregiver/do_upload'); ?>
                <div class="container">
                    <form>

                        <input type="file" name="userfile" />

                        <br /><br />

                        <input type="submit" value="upload" />

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('close') ?></button>
            </div>
        </div>

    </div>
</div>

