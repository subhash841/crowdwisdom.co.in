<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <title><?= $page_title; ?></title>

        <link rel="shortcut icon" href="<?= base_url( 'images/common/crowd-wisdom.png' ); ?>" />
        <!--Import materialize.css-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css" type="text/css" rel="stylesheet"  media="screen,projection"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700|Material+Icons" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">

        <link href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css' rel="stylesheet">
        <link href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css' rel="stylesheet">
        <link href="<?= base_url(); ?>css/style.css?v=1.8" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/fonts/flaticons/font/flaticon.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/simplePagination.min.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <meta name="description" content="<?= @$page_description ?>" />
        <meta name="keywords" content="CrowdWisdom, Crowd Wisdom, crowdwisdom, crowd wisdom, India Predictions, India Election Predictions, 
              Stock Market Predictions, Movie Predictions, Movie Reviews, Crowdsourced Content, Crowdsourced Surveys, Crowdsourced Advice, Advice, Advise, 
              election game, opinion poll, election polls, vidhan shabha election, upcoming election in India, next election in India, assembly election 2018,
              lok sabha election, India result, election results, election, India Crowd Sourcing, Wisdom Of The Crowds, India Free Surveys, Lok Sabha Elections 2019,
              Lok Sabha Election Analysis, Assembly Election Analysis, Assembly Election opinion Polls 2018, Lok Sabha Opinion Polls 2019, 
              Chhattisgarh Assembly Opinion Polls 2018, Madhya Pradesh Assembly Opinion Polls 2018, Rajasthan Assembly Opinion Polls 2018, Rajasthan Elections 2018,
              MP Elections 2018, Bollywood Box Office Predictions, Indian Economy Forecasts, Worst Mutual Funds, Worst Mutual Fund Company, Worst Insurance Company,
              Best Performing Mutual Funds, Best Performing Life Insurance, Asian Games Hockey Predictions, Modi Ratings, Rahul Ratings, Andhra Pradesh Assembly Opinion Polls 2019,
              Cricket Results Prediction, best mutual funds 2018, best mutual funds for sip, best mutual funds with top 5 mutual funds for sip, best mutual fund company in india,
              cricket match predictions, Top Indian Paid surveys, Top Rated Surveys for India, assembly election 2019, assembly election 2019" />
        <meta name="google-site-verification" content="Jx8tII0oSEAmQxzgJsOn8O501OIN8p10Ce8EqtU_Imk" />
        <!--Facebook Meta tags-->
        <meta property="og:type" content="website" /> 
        <meta property="og:title" content="<?= @$page_title; ?>" />
        <meta property="og:description" content="CrowdWisdom is India's top web-site for election and other predictions, surveys to gauge Indian habits and attitudes and algorithm driven crowdsourcing based advice." />
        <meta property="og:image" content="<?= @$page_img; ?>"/>
        <!--Twitter Meta tags-->
        <!--<meta name='twitter:card' content='summary'/>-->
        <meta name="twitter:card" content="summary_large_image"/>
        <meta name="twitter:site" content="@crowdwisdom"/>
        <meta name="twitter:title" content="<?= $page_title; ?>"/>
        <meta name="twitter:image" content="<?= @$page_img; ?>" />
        <style>
            .cust-text{
                position: absolute;
                bottom: 0;
                width: 100%;
                padding: 4px;
                padding-left: 15px;
                color: white;
                background: linear-gradient(to right, rgba(255,51,51,0.8), rgba(255,255,255,0.2));
                border-bottom-left-radius: 5px;
                margin: 0;
            }

            .modal{
                width: 30%;
            }
            @media only screen and (max-width: 992px){
                .modal {
                    width: 80%;
                }
                .banner-text{
                    transform: translateX(25%);
                    font-size: 15px !important;
                    top: 15%;
                    position: absolute;
                }
                .raise_voice_banner .btn.btn-success{
                    top: 70% !important;
                    font-size: 12px !important;
                    height: 35px !important;
                }

                .blog-content h6{
                    font-size: 0.9rem;
                }
                .blog-content .description.ellipsis{
                    color: #828FB7 !important;
                    font-size: 0.813rem !important;
                }
                .blog-content .artical-title{
                    font-size: 1.2rem;
                }
            </style>

        </head>
        <body data-base_url="<?= base_url() ?>" data-uid="<?= @$uid ?>" data-silver_points="<?= @$silver_points ?>" data-detailid="<?= @$id ?>">
            <div id="toast-container"></div>
            <div id="nav">
                <div class="navbar-fixed">
                    <nav class="upper centerlogo">
                        <div class="nav-wrapper container">
                            <ul class="hide-on-med-and-down socialnetwork">
                                <li><a href="https://www.facebook.com/CrowdWisdomPolitics360/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/CrowdWisdom360" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
                                <!--<li><a class="dropdown-button" data-beloworigin="true" href="#" data-activates="wallet-drop" href="#">Wallet</a></li>-->
                                <?php
//                            if (!empty($this->session->userdata('data'))) {
//                                echo '<li><a href="' . base_url() . 'Login/logout">Logout</a></li>';
//                            } else {
//                                echo '<li><a href="' . base_url() . 'Login?section=poll">Login</a></li>';
//                            }
                                ?>
                            </ul>
                        </div>
                    </nav>
                    <nav class="white margin texttheme centerlogo">
                        <div class="nav-wrapper container">
                            <a href="#" data-activates="slide-out" class="button-collapse show-on-med-and-down" style="color: #333;"><i class="material-icons">menu</i></a>
                            <a href="<?= base_url(); ?>" class="brand-logo left-align hide-on-large-only">
                                <img src="<?= base_url( 'images/logo/red-logo.png' ); ?>"/>
                            </a>
                            <div class="hide-on-med-and-down" style="padding-left: 3.2%;">
                                <a href="<?= base_url() ?>NewHome/prediction">Predictions</a>
                                <a href="<?= base_url() ?>RatedArticle">Ad Ratings</a>
                                <a href="<?= base_url(); ?>Survey">Ask Questions</a>
                                <a href="<?= base_url() ?>YourVoice">Your Voice</a>
                                <!--<a class="dropdown-button" data-beloworigin="true" href="#" data-activates="survey-drop">Surveys</a>-->
                                <!--<a class="dropdown-button" data-beloworigin="true" href="#" data-activates="survey-drop">Articles</a>-->
                                <div id="logo">
                                    <a href="<?= base_url(); ?>" >
                                        <img src="<?= base_url( 'images/headerlogo/crowd-wisdom-500.png' ); ?>"/>
                                    </a>
                                </div>
                                <a href="<?= base_url(); ?>Home/aboutus">About us</a>
                                <?php
                                if ( ! empty( $this -> session -> userdata( 'data' ) ) ) {
                                        echo '<a href="' . base_url() . 'Profile/pointsHistory/1"><!--<div class="walletcoin"><span>0</span></div>-->Wallet</a>';
                                } else {
                                        echo '<a href="' . base_url() . 'Login?section=wallet"><!--<div class="walletcoin"><span>0</span></div>-->Wallet</a>';
                                }
                                ?>

                                <a class="dropdown-button" data-beloworigin="true" href="#" data-activates="elections-drop"><img src="<?= base_url( 'images/headerlogo/rocket.png' ); ?>" class="liverocket">Lok Sabha 2019</a>
                                <?php
                                if ( ! empty( $this -> session -> userdata( 'data' ) ) ) {
                                        //echo '<a href="' . base_url() . 'Login/logout">Logout</a>';
                                        echo '<a href="' . base_url() . 'Login/logout" class="logout borgtored p-0"><h5 class="txtorgtored fs14px fw500">Logout</h5></a>';
                                } else {
                                        //echo '<a href="' . base_url() . 'Login?section=poll">Login</a>';
                                        echo '<a href="' . base_url() . 'Login?section=home" class="login borgtored p-0 head-login"><h5 class="txtorgtored fs14px fw500">Login</h5></a>';
                                }
                                ?>
                            </div>
                    </nav>
                </div>
            </div>
            <!-- Survey drop-down----->
            <!--<ul id='survey-drop' class='dropdown-content'>
                <li><a href="<?= base_url(); ?>RatedArticle">Rated Articles</a></li>
            </ul>-->
            <!-- elections drop menu -->
            <ul id='elections-drop' class='dropdown-content'>
                <li><a href="<?= base_url(); ?>Allindia/Home?a=1">Lok Sabha 2019</a></li>
                <li><a href="<?= base_url(); ?>Telangana/Home">Telangana</a></li>
                <li><a href="<?= base_url(); ?>MP/Home?a=2">Madhya Pradesh</a></li>
                <li><a href="<?= base_url(); ?>Chhattisgarh/Home?a=5">Chhattisgarh</a></li>
                <li><a href="<?= base_url(); ?>Rajasthan/Home?a=4">Rajasthan</a></li>
                <li><a href="<?= base_url(); ?>Sports/Home">Sports</a></li>
                <li><a href="<?= base_url(); ?>Gujarat/Home">Gujarat</a></li>
                <li><a href="<?= base_url(); ?>Karnataka/Home">Karnataka</a></li>
            </ul>
            <!--Mobile View Drawer-->
            <ul id="slide-out" class="side-nav">
                <li class="center-align">
                    <a href="<?= base_url(); ?>" class="brand-logo">
                        <img src="<?= base_url( 'images/logo/red-logo.png' ); ?>"/>
                    </a>
                </li>
                <li><div class="divider"></div></li>
                <li>
                    <a href="javascript:void(0);" class="mobile-submenu-live-item">Lok Sabha 2019</a>
                    <ul class="live-sub-menu mobile-submenu-live">
                        <li><a href="<?= base_url(); ?>Allindia/Home?a=1">Lok Sabha 2019</a></li>
                        <li><a href="<?= base_url(); ?>Telangana/Home">Telangana</a></li>
                        <li><a href="<?= base_url(); ?>MP/Home?a=2">Madhya Pradesh</a></li>
                        <li><a href="<?= base_url(); ?>Chhattisgarh/Home?a=5">Chhattisgarh</a></li>
                        <li><a href="<?= base_url(); ?>Rajasthan/Home?a=4">Rajasthan</a></li>
                        <li><a href="<?= base_url(); ?>Sports/Home">Sports</a></li>
                        <li><a href="<?= base_url(); ?>Gujarat/Home">Gujarat</a></li>
                        <li><a href="<?= base_url(); ?>Karnataka/Home">Karnataka</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url() ?>NewHome/prediction" class="mobile-submenu-item">Predictions</a>
                </li>
                <li><a href="<?= base_url() ?>RatedArticle">Ad Ratings</a></li>
                <li><a href="<?= base_url(); ?>Survey">Ask Questions</a></li>
                <li><a href="<?= base_url(); ?>YourVoice">Your Voice</a></li>
                <!--<li>
                    <a href="javascript:void(0);" class="mobile-submenu-live-item">Articles</a>
                    <ul class="live-sub-menu mobile-submenu-live">
                        <li><a href="<?= base_url(); ?>RatedArticle">Rated Articles</a></li>
                    </ul>
                </li>-->
                <?php
                if ( ! empty( $this -> session -> userdata( 'data' ) ) ) {
                        echo '<li><a href="' . base_url() . 'Profile/pointsHistory/1">Wallet</a></li>';
                } else {
                        echo '<li><a href="' . base_url() . 'Login?section=wallet">Wallet</a></li>';
                }
                ?>
                <li><a href="<?= base_url(); ?>Home/aboutus">About Us</a></li>
                <?php
                if ( ! empty( $this -> session -> userdata( 'data' ) ) ) {
                        echo '<li><a href="' . base_url() . 'Login/logout">Logout</a></li>';
                } else {
                        echo '<li><a href="' . base_url() . 'Login?section=home" class="head-login">Login</a></li>';
                }
                ?>
            </ul>

