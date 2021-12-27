<?php
//echo base_url();exit;
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111765819-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-111765819-1');
        </script>
        <title>Crowd Wisdom - Too much load</title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>images/common/favicon.ico" />
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link href="<?php echo base_url(); ?>css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>   
        <link href="<?php echo base_url(); ?>css/login.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="mydiv">
                <div class="text-center animated1 fadeIn">
                    <img src="<?= base_url('images/logo/white-logo.png'); ?>" alt="Company logo" class="co-logo" style="margin-bottom: 20%;" />
                    <h5 class="hometext"><!--Login Below to-->We are experiencing very heavy traffic right now. Please try again in some time</h5>
                    
		<h5><?php echo $heading; ?></h1>
		<?php echo $message; ?>
                    
                </div>
                <!--<div class="disclaimer">* Final Ranking published will include your Twitter ID</div>-->
            </div>
        </div>
        <div class="firstimg animated slideInDown" ><img src="<?= base_url('images/login/loudspeaker.png'); ?>" class="w-90"/></div>
        <div class="secondimg animated slideInUp" ><img src="<?= base_url('images/login/vote_1.png'); ?>" class="w-90"/></div>
        <div class="thirdimg animated slideInUp" ><img src="<?= base_url('images/login/hands-up.png'); ?>" class="w-90"/></div>
        <div class="forthimg animated slideInDown" ><img src="<?= base_url('images/login/checkbox.png'); ?>" class="w-90" /></div>

        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>


    </body>
</html>
