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

        <title>Elections Prediction - <?= $page_title; ?></title>
        <!--Import Google Icon Font-->
        <link rel="shortcut icon" href="<?php echo base_url('images/common/crowd-wisdom.png'); ?>" />
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

        <style>
            .mobile-submenu, .mobile-submenu-live{
                display: none;
            }
        </style>
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
                            <!--<li style="display:none"><a href="<?php echo base_url(); ?>Stock/Home">Stock</a></li>
                            <li><a class="dropdown-button" data-beloworigin="true" href="#" data-activates="elections-drop">Predictions</a></li>
                            <li><a href="<?php echo base_url(); ?>Forum/">Questions</a></li>
                            <li><a href="<?php echo base_url(); ?>Gujarat/Home/resultlist" class="your-ranking1">Ranking</a></li>
                            style="color: #eb0100;"
                            <li><a href="<?php echo base_url(); ?>Blogs/blogdetails">About us</a></li>
                            <li><a href="<?php echo base_url(); ?>Home/aboutus">About Us</a></li>
                            <li><a href="<?php echo base_url(); ?>Blogs">Opinion</a></li>
                            <li><a class="dropdown-button" data-beloworigin="true" href="#" data-activates="wallet-drop" href="#">Wallet</a></li>
                            <li><a href="#contact">Contact Us</a></li>-->
                            <li><a href="#" class="dropdown-button" data-beloworigin="true" data-activates="elections-drop">Lok Sabha 2019</a></li>
                            <li><a href="<?php echo base_url(); ?>">Predictions</a></li>
                            <!--<li><a href="<?php echo base_url(); ?>Forum/">WisdomForum</a></li>-->
                            <li><a href="<?php echo base_url(); ?>Blogs">Your Voice</a></li>
                            <?php
                            if (!empty($this->session->userdata('data'))) {
                                echo '<li><a href="' . base_url() . 'Profile/pointsHistory/1">Wallet</a></li>';
                            } else {
                                echo '<li><a href="' . base_url() . 'Login?section=wallet">Wallet</a></li>';
                            }
                            ?>
                            <li><a href="<?php echo base_url(); ?>Home/aboutus">About</a></li>
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
            </div>
        </div>
        <!-- Desktop View elections drop menu -->
        <ul id='elections-drop' class='dropdown-content'>
            <li><a href="<?php echo base_url(); ?>Allindia/Home?a=1">Lok Sabha 2019</a></li>
            <li><a href="<?php echo base_url(); ?>MP/Home?a=2">Madhya Pradesh</a></li>
            <li><a href="<?php echo base_url(); ?>Chhattisgarh/Home?a=5">Chhattisgarh</a></li>
            <li><a href="<?php echo base_url(); ?>Rajasthan/Home?a=4">Rajasthan</a></li>
            <li><a href="<?php echo base_url(); ?>Sports/Home">Sports</a></li>
            <li><a href="<?php echo base_url(); ?>Gujarat/Home">Gujarat</a></li>
            <li><a href="<?php echo base_url(); ?>Karnataka/Home">Karnataka</a></li>
        </ul>
        <ul id='wallet-drop' class='dropdown-content' style="padding-left:0px;">
            <?php
            if (!empty($this->session->userdata('data'))) {
                echo '<li><a href="' . base_url() . 'Login/logout">Logout</a></li>';
            } else {
                echo '<li><a href="' . base_url() . 'Login">Login</a></li>';
            }
            ?>
        </ul>
        <!--Mobile View Drawer-->
        <ul id="slide-out" class="side-nav">
            <li class="center-align">
                <a href="<?php echo base_url(); ?>" class="brand-logo">
                    <img src="<?= base_url('images/logo/red-logo.png'); ?>"/>
                </a>
            </li>
            <li><div class="divider"></div></li>
            <li>
                <a href="javascript:void(0);" class="mobile-submenu-live-item">Lok Sabha 2019</a>
                <ul class="live-sub-menu mobile-submenu-live">
                    <li><a href="<?php echo base_url(); ?>Allindia/Home?a=1">Lok Sabha 2019</a></li>
                    <li><a href="<?php echo base_url(); ?>Gujarat/Home">Gujarat</a></li>
                    <li><a href="<?php echo base_url(); ?>Karnataka/Home">Karnataka</a></li>
                    <li><a href="<?php echo base_url(); ?>MP/Home?a=2">Madhya Pradesh</a></li>
                    <li><a href="<?php echo base_url(); ?>Chhattisgarh/Home?a=5">Chhattisgarh</a></li>
                    <li><a href="<?php echo base_url(); ?>Rajasthan/Home?a=4">Rajasthan</a></li>
                    <li><a href="<?php echo base_url(); ?>Sports/Home">Sports</a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>" class="mobile-submenu-item">Predictions</a>
            </li>
            <!--<li><a href="<?php echo base_url(); ?>Forum/">WisdomForum</a></li>-->
            <li><a href="<?php echo base_url(); ?>Blogs">Your Voice</a></li>
            <?php
            if (!empty($this->session->userdata('data'))) {
                echo '<li><a href="' . base_url() . 'Profile/pointsHistory/1">Wallet</a></li>';
            } else {
                echo '<li><a href="' . base_url() . 'Login?section=wallet">Wallet</a></li>';
            }
            ?>
            <li><a href="<?php echo base_url(); ?>Home/aboutus">About Us</a></li>
            <?php
            if (!empty($this->session->userdata('data'))) {
                echo '<li><a href="' . base_url() . 'Login/logout">Logout</a></li>';
            } else {
                echo '<li><a href="' . base_url() . 'Login?section=poll">Login</a></li>';
            }
            ?>
            <!--<li><a href="<?php echo base_url(); ?>Gujarat/Home/resultlist" class="your-ranking1">Ranking</a></li>-->
            <!--style="color: #eb0100;"
            <li><a href="<?php echo base_url(); ?>Blogs/blogdetails">What is Crowd Wisdom?</a></li>-->

            <!--<li><a href="#">Wallet</a>
                <ul class="wallet-options">

                </ul>
            </li>
            <li><a href="#contact">Contact Us</a></li>-->

        </ul>
        <script>
            $(document).on('click', '.mobile-submenu-item', function () {
                $(this).closest('li').find('.mobile-submenu').slideToggle()
            });
            $(document).on('click', '.mobile-submenu-live-item', function () {
                $(this).closest('li').find('.mobile-submenu-live').slideToggle()
            });
            $(".your-ranking").on('click', function (e) {
                e.preventDefault();
                Materialize.Toast.removeAll();
                Materialize.toast('Ranking will be released after results are announced!', 4000);
            });
        </script>
        <!--<nav class="orange lighten-2 flat hide-on-med-and-down">
            <div class="nav-wrapper container">
                <form>
                    <div class="input-field">
                        <input id="search" type="search" required="">
                        <label for="search"><i class="mdi-action-search"></i></label>
                        <i class="mdi-navigation-close"></i>
                    </div>
                </form>
            </div>
        </nav>-->
        <div class="banner white " style="">
            <img src="<?= base_url('images/common/Left_image.png'); ?>" class="absolute left-lion header-lions" />
            <img src="<?= base_url('images/common/Right_image.png'); ?>" class="absolute posright right-lion header-lions" />
            <div class="bannercontent">
                <h4 class="bannertitle">
                    <div class="bg-patch">
                        <h2 class="rw-sentence">
                            <!--<div class="rw-words rw-words-1">
                                <span>Gujarat</span>
                                <span>ગુજરાત</span>
                                <span>Gujarat</span>
                                <span>ગુજરાત</span>
                                <span>Gujarat</span>
                                <span>ગુજરાત</span>
                            </div>-->
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
                    <div class="election">Elections 2018</div>
                </h4>
                <div class="hands"><img src="<?= base_url('images/common/singlehand.png'); ?>" height="259"/></div>
                <!--<h5 class="bannerdiscr">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lectus lectus, ullamcorper sed efficitur sit amet, malesuada id tortor. Etiam nec dapibus nibh.</h5>
                <div class="home-welcome">
                    <div class="pure-g-r">
                        <div class="pure-u-1-2">
                            <div class="main-example">
                                <div class="countdown-container" id="main-example"></div>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>