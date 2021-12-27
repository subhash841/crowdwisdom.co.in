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

        <title><?= $page_title; ?></title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link href="<?php echo base_url(); ?>css/materialize.min.css" type="text/css" rel="stylesheet"  media="screen,projection"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/init.js?v1"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.marquee.min.js"></script>
        <link href='<?php echo base_url(); ?>assets/slick/slick.css' rel="stylesheet">
        <link href='<?php echo base_url(); ?>assets/slick/slick-theme.css' rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/Flipclock/css/flipTimer.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/jQueryCounter/css/syntax.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/jQueryCounter/css/main.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/responsive.css" rel="stylesheet">
        <style>
            .homebanner .slick-list{
                height: 65vh;   
            }
            .homebanner .slick-dots{
                top: 65%;
            }
            .slick-dots li button:before {
                font-size: 10px;
            }
            .slick-dots li {
                margin: 0;
            }
            .banner{
                padding-top: 0%!important; 
            }
            .minus-m-t13 {
                /*margin-top: -13%;*/
                margin-top: 0%;
            }

            .homebanner .slick-prev{
                left: 0px;
                z-index: 100;
            }
            .homebanner .slick-next{
                right: 0px;
                z-index: 100;
            }
            .block{
                display: block;
            }
            .fw{
                font-weight: 800;
            }
            .stocksavebtn{
                padding: 0px 65px;
                height: 60px;
                line-height: 60px;
                font-weight: 800;
            }

            .card.maxhauto{
                min-height: 130vh !important;

            }
            .slick-slide img {
                display: inline !important;
            }
            .external-info-container {
                height: 49.3%;
            }
            .blogs-container, .tweets-container {
                height: 80%;
            }
            form#user_stock_forecast .gainerslist.forecast-stocks {
                max-height: 900px !important;
                min-height: 350px;
                overflow-y: scroll;
                overflow-x: hidden;
            }
        </style>
        <?php
        $userdata = $this->session->userdata('data');
        if (strlen($userdata['certificate_path']) > 0) {
            ?>
            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:site" content="@crowdwisdom360" />
            <meta name="twitter:title" content="Crowdwisdom Certified Predictor Guru" />
            <meta name="twitter:description" content="Congratulations <?php echo ucwords($userdata['name']); ?>, Thanks to your excellent forecasting in the Gujarat election, you are certified as a Predictor Guru by Crowdwisdom." />
            <meta name="twitter:image" content="<?php echo base_url() . $userdata['certificate_path']; ?>" />
        <?php } ?>
    </head>

    <body>
        <div id="toast-container"></div>
        <div id="nav">
            <div class="navbar-fixed">
                <nav class="white">
                    <div class="nav-wrapper container">
                        <a href="#" data-activates="slide-out" class="button-collapse show-on-med-and-down" style="color: #333;"><i class="material-icons">menu</i></a>
                        <a href="<?php echo base_url(); ?>" class="brand-logo left-align">
                            <img src="<?= base_url('images/logo/red-logo.png'); ?>"/>
                        </a>
                        <ul class="right hide-on-med-and-down">
                            <!--<li><a href="<?php echo base_url(); ?>Stock/Home">Home</a></li>
                            <li><a class="dropdown-button" data-beloworigin="true" href="#" data-activates="elections-drop">Category</a></li>
                            <li><a href="<?php echo base_url(); ?>Stock/Home">Stock</a></li>-->
                            <li><a href="#" class="dropdown-button" data-beloworigin="true" href="#" data-activates="elections-drop">Predictions</a></li>
                            <li><a href="<?php echo base_url(); ?>Forum/">WisdomForum</a></li>
                            <li><a href="<?php echo base_url(); ?>Blogs">Opinion</a></li>
                            <li><a href="<?php echo base_url(); ?>Gujarat/Home/resultlist" class="your-ranking1">Ranking</a></li>
                            <li><a style="color: #eb0100;" href="<?php echo base_url(); ?>Blogs/blogdetails">What is Crowd Wisdom?</a></li>
                            <li><a href="<?php echo base_url(); ?>Home/aboutus">About Us</a></li>
                            <li><a href="<?php echo base_url(); ?>Profile">Profile</a></li>
                            <!--<li><a href="#contact">Contact Us</a></li>-->
                            <?php
                            if (!empty($this->session->userdata('data'))) {
                                echo '<li><a href="' . base_url() . 'Login/logout">Logout</a></li>';
                            } else {
                                echo '<li><a href="' . base_url() . 'Login">Login</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- elections drop menu -->
        <!--<ul id='elections-drop' class='dropdown-content'>
            <li><a href="<?php echo base_url(); ?>Stock/Home">Stock</a></li>
            <li><a href="<?php echo base_url(); ?>Karnataka/Home">Elections</a></li>
        </ul>-->
        <ul id='elections-drop' class='dropdown-content'>
            <li><a href="<?php echo base_url(); ?>Gujarat/Home">Gujarat</a></li>
            <li><a href="<?php echo base_url(); ?>Karnataka/Home">Karnataka</a></li>
        </ul>

        <ul id="slide-out" class="side-nav">
            <li class="center-align">
                <a href="<?php echo base_url(); ?>Home" class="brand-logo">
                    <img src="<?= base_url('images/logo/red-logo.png'); ?>"/>
                </a>
            </li>
            <li><div class="divider"></div></li>
            <li><a href="#">Predictions</a>
                <ul class="elections-sub-menu">
                    <li><a href="<?php echo base_url(); ?>Stock/Home">Gujarat</a></li>
                    <li><a href="<?php echo base_url(); ?>Karnataka/Home">Karnataka</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url(); ?>Forum/">Wisdom Forum</a></li>
            <li><a href="<?php echo base_url(); ?>Gujarat/Home/resultlist" class="your-ranking1">Ranking</a></li>
            <li><a style="color: #eb0100;" href="<?php echo base_url(); ?>Blogs/blogdetails">What is Crowd Wisdom?</a></li>
            <li><a href="<?php echo base_url(); ?>Home/aboutus">About Us</a></li>
<!--            <li><a href="<?php echo base_url(); ?>Blogs">Opinion</a></li>-->
            <li><a href="<?php echo base_url(); ?>Profile">Profile</a></li>
            <!--<li><a href="#contact">Contact Us</a></li>-->
            <?php
            if (!empty($this->session->userdata('data'))) {
                echo '<li><a href="' . base_url() . 'Login/logout">Logout</a></li>';
            } else {
                echo '<li><a href="' . base_url() . 'Login">Login</a></li>';
            }
            ?>
        </ul>
        <script>
            $(".your-ranking").on('click', function (e) {
                e.preventDefault();
                Materialize.Toast.removeAll();
                Materialize.toast('Ranking will be released after results are announced!', 4000);
            });

        </script>

        <!--        <div class="slider-banner banner white " style="">
        
                    <div class="homebanner">
                        <div>
                            <div class="container">
                                <div class="row">
                                    <div class="col s12 m4">
                                        <div class="banner-img">
                                            <img src="<?= base_url('images/common/stocksbanner.png'); ?>">
                                        </div>
                                    </div>
                                    <div class="col s12 m8">
                                        <div class="banner-text-wrapper">
                                            <div class="banner-text">
                                                <h4 class="banner-header red-text">Stocks Crowd Prediction</h4>
                                                <div class="banner-content">Please share your forecasts for 10 stocks listed this week. Became a certified expert forecaster by repeatedly forecasting accurately</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row">
                                <img src="<?= base_url('images/common/Left_image.png'); ?>" class="absolute left-lion header-lions" />
                                <img src="<?= base_url('images/common/Right_image.png'); ?>" class="absolute posright right-lion header-lions" />
                                <div class="bannercontent">
                                    <h4 class="bannertitle">
                                        <div class="bg-patch">
                                            <h2 class="rw-sentence">
        
                                                <div class="rw-words rw-words-1">
                                                    <span>karnataka</span>
                                                    <span>ಕರ್ನಾಟಕ</span>
                                                    <span>karnataka</span>
                                                    <span>ಕರ್ನಾಟಕ</span>
                                                    <span>karnataka</span>
                                                    <span>ಕರ್ನಾಟಕ</span>
                                                </div>
                                            </h2>
                                        </div>
                                        <div class="election">Elections 2017</div>
                                    </h4>
                                    <div class="hands">
                                        <img src="<?= base_url('images/common/singlehand.png'); ?>" height="259"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->