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

        <meta charset="UTF-8">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <title><?= $page_title; ?></title>

        <link rel="shortcut icon" href="<?php echo base_url('images/common/crowd-wisdom.png'); ?>" />
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link href="<?php echo base_url(); ?>css/materialize.min.css" type="text/css" rel="stylesheet"  media="screen,projection"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cuprum" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
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
        <link href="<?php echo base_url(); ?>assets/fonts/flaticons/font/flaticon.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/dragndrop/dropzone.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/Pagination/simplePagination.css" rel="stylesheet" type="text/css"/>


        <!--Facebook Meta tags-->
        <meta property="og:image" content="<?= @$page_img; ?>"/>
        <!--Twitter Meta tags-->
        <!--<meta name='twitter:card' content='summary'/>-->
        <meta name="twitter:card" content="summary_large_image"/>
        <meta name="twitter:site" content="@crowdwisdom"/>
        <meta name="twitter:title" content="<?= $page_title; ?>"/>
        <meta name="twitter:image" content="<?= @$page_img; ?>" />

        <style>
            .banner {
                min-height: 80vh;
                position: relative;
                padding-top: 4%;
            }
            .hands {
                margin-top: 10vh;
                margin-bottom: 5vh;
            }
            .bannercontent .savebtn {
                margin-top: 6vh;
                background: linear-gradient(to right, #ff4e00,#ff0000) !important;
            }
            nav.upper {
                background-color: #EFF2F9;
                height: 35px;
                line-height: 35px;
            }
            nav.white.margin{
                margin-top: 35px;
            }
            .banner_desc{
                font-size: 17px;
                color: rgba(49, 50, 55, 0.34);
            }
            .category-cards{
                margin-bottom: 20px;
                height: 350px;
            }
            .card-title.title{
                text-transform: uppercase;
                font-size: 20px;
                font-weight: 400;
            }
            p.point-head {
                margin: 10px 10px !important;
                font-size: 16px;
                font-weight: 600;
            }
            p.point-desc {
                margin: 10px 10px !important;
                font-size: 15px;
                color: rgba(49, 50, 55, 0.40) !important;
                text-align: left;
            }
            h4.number{
                font-weight: 600;
            }
            .category-display{
                background-color: #E6E8EA;;
                padding: 1px 10px;
                border-radius: 15px;
                margin-top: 5px;
            }

            .card.election_card{
                background: linear-gradient(#43A79F, #FDFFFE);
            }
            .card.election_card .card-image {
                position: absolute;
                right: 0;
                bottom: 0;
                width: 70%;
            }

            .card.money_card{
                background: linear-gradient(#42B8D2, #FDFFFE);
            }
            .card.money_card .card-image {
                position: absolute;
                left: 50%;
                transform: translatex(-50%);
                bottom: 5%;
                width: 90%;
            }

            .card.sport_card{
                background: linear-gradient(#9FA8B1, #FDFFFE);
            }
            .card.sport_card .card-image {
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translatex(-50%);
                width: 90%;
            }
            .card.entertainment_card{
                background: linear-gradient(#B39EC9, #FDFFFE);
            }
            .card.entertainment_card .card-image {
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translatex(-50%);
                width: 90%;
            }

            .icon-color{
                color: #8697BE;
                vertical-align: middle;
            }
            .total_votes{
                color : #A6A9B0;
            }

            .point-infographic img{
                width: 90%;
            }

            .bloghead img{
                width: 10%;
                vertical-align: middle;
                margin-right: 10px;
            }
            .card-head {
                padding: 10px 25px;
            }

            .card-footer{
                padding: 15px;
            }

            @media only screen and (min-width: 450px) and (max-width: 600px) {
                .card.entertainment_card .card-image {
                    position: absolute;
                    bottom: 0;
                    left: 50%;
                    transform: translatex(-50%);
                    width: 46%; 
                }
                .card.election_card .card-image {
                    position: absolute;
                    right: 0;
                    bottom: 0;
                    width: 46%;
                }
            }

            @media only screen and (max-width: 480px) {
                nav.white.margin {
                    margin-top: 0;
                }

                h4.banner-title{
                    font-size: 1.28rem;
                }
                h6.banner_desc {
                    font-size: 1.0rem;
                    color: rgba(49, 50, 55, 0.50);
                }
                .bannercontent .savebtn {
                    margin-top: 2vh;
                    background: linear-gradient(to right, #ff4e00,#ff0000) !important;
                }
                .card.election_card .card-image {
                    width: 60%;
                }
                .card.money_card .card-image {
                    position: absolute;
                    left: 50%;
                    transform: translatex(-50%);
                    bottom: 5%;
                    width: 80%;
                }
                .point-infographic img{
                    width: 50%;
                }
            }
        </style>
    </head>
    <body>
        <div id="toast-container"></div>
        <div id="nav">
            <div class="navbar-fixed">
                <nav class="upper">
                    <div class="nav-wrapper container">
                        <ul class="right hide-on-med-and-down">
                            <li><a class="dropdown-button" data-beloworigin="true" href="#" data-activates="wallet-drop" href="#">Wallet</a></li>
                            <?php
                            if (!empty($this->session->userdata('data'))) {
                                echo '<li><a href="' . base_url() . 'Login/logout">Logout</a></li>';
                            } else {
                                echo '<li><a href="' . base_url() . 'Login?section=poll">Login</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </nav>
                <nav class="white margin">
                    <div class="nav-wrapper container">
                        <a href="#" data-activates="slide-out" class="button-collapse show-on-med-and-down" style="color: #333;"><i class="material-icons">menu</i></a>
                        <a href="<?php echo base_url(); ?>" class="brand-logo left-align">
                            <img src="<?= base_url('images/logo/red-logo.png'); ?>"/>
                        </a>
                        <ul class="right hide-on-med-and-down">
                            <li><a href="<?php echo base_url(); ?>Poll">Ask a Question</a></li>
                            <li><a class="dropdown-button" data-beloworigin="true" href="#" data-activates="elections-drop">Predictions</a></li>
                            <li><a href="<?php echo base_url(); ?>Blogs/blogdetails">About us</a></li>
                            <li><a href="<?php echo base_url(); ?>Blogs">Opinion</a></li>
                            <!--<li><a class="dropdown-button" data-beloworigin="true" href="#" data-activates="wallet-drop" href="#">Wallet</a></li>-->
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- elections drop menu -->
        <ul id='elections-drop' class='dropdown-content'>
            <li><a href="<?php echo base_url(); ?>Gujarat/Home">Gujarat</a></li>
            <li><a href="<?php echo base_url(); ?>Karnataka/Home">Karnataka</a></li>
            <li><a href="<?php echo base_url(); ?>Allindia/Home?a=1">India</a></li>
            <li><a href="<?php echo base_url(); ?>MP/Home?a=2">Madhya Pradesh</a></li>
            <li><a href="<?php echo base_url(); ?>Chhattisgarh/Home?a=5">Chhattisgarh</a></li>
            <li><a href="<?php echo base_url(); ?>Rajasthan/Home?a=4">Rajasthan</a></li>
            <li><a href="<?php echo base_url(); ?>Sports/Home">Sports</a></li>
        </ul>
        <!--Mobile screen slide navigation-->
        <ul id="slide-out" class="side-nav">
            <li class="center-align">
                <a href="<?php echo base_url(); ?>Home" class="brand-logo">
                    <img src="<?= base_url('images/logo/red-logo.png'); ?>"/>
                </a>
            </li>
            <li><div class="divider"></div></li>
            <li><a href="#">Predictions</a>
                <ul class="elections-sub-menu">
                    <li><a href="<?php echo base_url(); ?>Gujarat/Home">Gujarat</a></li>
                    <li><a href="<?php echo base_url(); ?>Karnataka/Home">Karnataka</a></li>
                    <li><a href="<?php echo base_url(); ?>Allindia/Home?a=1">India</a></li>
                    <li><a href="<?php echo base_url(); ?>MP/Home?a=2">Madhya Pradesh</a></li>
                    <li><a href="<?php echo base_url(); ?>Chhattisgarh/Home?a=5">Chhattisgarh</a></li>
                    <li><a href="<?php echo base_url(); ?>Rajasthan/Home?a=4">Rajasthan</a></li>
                    <li><a href="<?php echo base_url(); ?>Sports/Home">Sports</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url(); ?>Poll">Ask a Question</a></li>
            <li><a href="<?php echo base_url(); ?>Blogs/blogdetails">What is Crowd Wisdom?</a></li>
            <li><a href="<?php echo base_url(); ?>Blogs">Opinion</a></li>
            <li><a href="#">Wallet</a>
                <ul class="wallet-options">
                    <?php
                    if (!empty($this->session->userdata('data'))) {
                        echo '<li><a href="' . base_url() . 'Login/logout">Logout</a></li>';
                    } else {
                        echo '<li><a href="' . base_url() . 'Login?section=poll">Login</a></li>';
                    }
                    ?>
                </ul>
            </li>
        </ul>
