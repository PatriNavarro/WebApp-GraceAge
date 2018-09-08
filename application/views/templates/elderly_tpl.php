<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="<?=base_url();?>styles/elderly.css">
    <title><?php echo $title; ?></title>
</head>


<script>
//Code for showing a certain login splash
//    $(document).ready(function(){
//
//        $('.welcome-splash').finish().show().delay(1500).fadeOut("slow");
//
//    });

</script>

<body onloadstart="loading()">
<!--Code for showing a certain login splash-->
<!--<div class="welcome-splash">-->
<!--    <div class="row">-->
<!--        text-->
<!--    </div>-->
<!--</div>-->

<div class="wrapper">
    <nav class="navbar navbar-default fixed-top">
        <div id="navbar-content" class="content">
            <button id="home_button" href="<?=base_url();?>index.php/Elderly/home"​​​​​ type="button" class="btn btn-success btn-lg navbar-btn pull-left">
                <span id="home-symbol "class="glyphicon glyphicon-home"></span> Home
            </button>

            <button id="help_button" href="#"​​​​​ type="button" class="btn btn-info btn-lg navbar-btn pull-right">
                Help  <span id="help-symbol" class="glyphicon glyphicon-question-sign"></span>
            </button>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenu4">
                <li><a href="#">Regular link</a></li>
                <li class="disabled"><a href="#">Disabled link</a></li>
                <li><a href="#">Another link</a></li>
            </ul>

        </div>
    </nav>
    <div id="default-body">
        <?php echo $body; ?> <!-- body is a placeholder for an embedded view-->
    </div>

</div>

<footer>
    <p id="footer-text">Copyright © 2017 WebApps Team 7. Groep T All Rights Reserved.
        <!--        <a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a>-->
    </p>
</footer>

</body>

</html>