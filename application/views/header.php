<!DOCTYPE html>
<html>
    <head>

        <title><?= $page_title; ?></title>


        <link rel="shortcut icon" href="<?= base_url(); ?>images/common/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700|Material+Icons" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" />

        <link href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css' rel="stylesheet" />
        <link href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css' rel="stylesheet" />
        <link href="<?= base_url(); ?>css/style.css?v=1.7" rel="stylesheet" />
        <link href="<?= base_url(); ?>assets/fonts/flaticons/font/flaticon.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/simplePagination.min.css" rel="stylesheet" type="text/css"/>
        <link  href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css" rel="stylesheet" />

        <meta name="description" content="<?= (@$page_meta_description == "") ? $page_title : @$page_meta_description ?>" />
        <meta name="keywords" content="<?= @$page_meta_keywords ?>" />
        <meta name="google-site-verification" content="Jx8tII0oSEAmQxzgJsOn8O501OIN8p10Ce8EqtU_Imk" />

        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@crowdwisdom" />
        <meta name="twitter:title" content="<?= $page_title; ?>"/>
        <?php if ( strpos( $_SERVER[ 'REQUEST_URI' ], 'Poll/' ) ) { ?>
                                                        <!--<meta name="twitter:image" content="<?= @$page_img; ?>" />-->
                <meta name="twitter:image" content="<?= base_url() . 'images/logo/' . @$page_img . ".png?_t=" . time() ?>" />
        <?php } else { ?>
                <meta name="twitter:image" content="<?= @$page_img; ?>" />
        <?php } ?>

        <meta property="og:type" content="website" /> 
        <meta property="og:title" content="<?= @$page_title; ?>" />
        <meta property="og:description" content="CrowdWisdom" />
        <meta property="og:url" content="<?= base_url() . ltrim( $_SERVER[ 'REQUEST_URI' ], '/' ); ?>" />
        <?php if ( strpos( $_SERVER[ 'REQUEST_URI' ], 'Poll/' ) ) { ?>
                    <!--<meta name="twitter:image" content="<?= @$page_img; ?>" />-->
                <meta property="og:image" content="<?= base_url() . 'images/logo/' . @$page_img . ".png?_t=" . time() ?>" />
        <?php } else { ?>
                <meta property="og:image" content="<?= @$page_img; ?>" />
        <?php } ?>

        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="627" />

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>

    <body>
        <div id="toast-container"></div>
        <div id="nav">
            <div class="navbar-fixed">
                <nav class="white">
                    <div class="nav-wrapper container">
                        <a href="#" data-activates="slide-out" class="button-collapse show-on-med-and-down" style="color: #333;"><i class="material-icons">menu</i></a>
                        <a href="<?= base_url(); ?>" class="brand-logo left-align">
                            <img src="<?= base_url( 'images/logo/red-logo.png' ); ?>"/>
                        </a>
                        <ul class="right hide-on-med-and-down">
                            <li><a href="#" class="dropdown-button" data-beloworigin="true" data-activates="elections-drop">Lok Sabha 2019</a></li>
                            <li><a href="<?= base_url() ?>Packages/">Competition</a></li>
                            <li><a href="<?= base_url() ?>Wallet/">Wallet</a></li>
                            <li><a href="<?= base_url(); ?>Home/aboutus">About Us</a></li>
                            <?php
                            if ( ! empty( $this -> session -> userdata( 'data' ) ) ) {
                                    echo '<li><a class="head-logout" href="' . base_url() . 'Login/logout">Logout</a></li>';
                            } else {
                                    echo '<li><a class="head-login" href="' . base_url() . 'Login?section=poll">Login</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
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

            <li><a href="<?= base_url() ?>Packages/">Competition</a></li>
            <li><a href="<?= base_url() ?>Wallet/">Wallet</a></li>
            <li><a href="<?= base_url(); ?>Home/aboutus">About Us</a></li>
            <?php
            if ( ! empty( $this -> session -> userdata( 'data' ) ) ) {
                    echo '<li><a class="head-logout" href="' . base_url() . 'Login/logout">Logout</a></li>';
            } else {
                    echo '<li><a class="head-login" href="' . base_url() . 'Login?section=poll">Login</a></li>';
            }
            ?>
            <!--<li><a href="<?= base_url(); ?>Gujarat/Home/resultlist" class="your-ranking1">Ranking</a></li>-->
            <!--style="color: #eb0100;"
            <li><a href="<?= base_url(); ?>Blogs/blogdetails">What is Crowd Wisdom?</a></li>-->

            <!--<li><a href="#">Wallet</a>
                <ul class="wallet-options">

                </ul>
            </li>
            <li><a href="#contact">Contact Us</a></li>-->

        </ul>
