<!DOCTYPE html>

<html>

<head>
    <!-- A <meta> viewport element gives the browser instructions on how to control the page's dimensions and scaling.
    The width=device-width part sets the width of the page to follow the screen-width of the device (which will vary depending on the device).
    The initial-scale=1.0 part sets the initial zoom level when the page is first loaded by the browser. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Adding the favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url();?>assets/iconapple-touch-.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url();?>assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url();?>assets/favicon-16x16.png">
    <link rel="manifest" href="<?=base_url();?>assets/manifest.json">
    <link rel="mask-icon" href="<?=base_url();?>assets/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
    
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url();?>styles/login.css">

    <title><?php echo $title; ?></title>
</head>

<body>

<script>

    $(document).ready(function(){
        /*$("#selector").css("display","none");*/
        $(".language_select").on('change',function(){
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: "<?=base_url();?>index.php/Account/setLanguage",
                data: { 'language' : $(this).val() }
            })
        });
    });

    /*$(document).ajaxStop(function(){
        window.location.reload();
    });*/


</script>

<div id="default-body">
    <?php echo $body; ?> <!-- body is a placeholder for an embedded view-->
</div>

</body>

</html>