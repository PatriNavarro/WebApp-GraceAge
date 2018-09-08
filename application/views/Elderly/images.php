<link rel="stylesheet" href="<?= base_url(); ?>styles/main_page.css">
<link rel="stylesheet" href="<?=base_url();?>styles/homescreen.css">

<div class="container-fluid">
    
    <div class="row">
        <?php 
$this->load->helper('directory'); //load directory helper
$dir = "assets/image_upload/"; // Your Path to folder
$map = directory_map($dir); /* This function reads the directory path specified in the first parameter and builds an array representation of it and all its contained files. */

foreach ($map as $k)
{?>
     <img src="<?php echo base_url($dir)."/".$k;?>" style="margin:10px" height="200" width="200"  >
<?php }?>
    </div>

</div>



