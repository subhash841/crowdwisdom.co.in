<html>
    <head>
        <title><?= $page_title ?></title>

        <link rel="shortcut icon" href="<?= base_url( "images/common/favicon.ico" ) ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <meta name="description" content="<?= (@$page_meta_description == "") ? $page_title : @$page_meta_description ?>" />
        <meta name="keywords" content="<?= @$page_meta_keywords ?>" />
        <meta name="google-site-verification" content="Jx8tII0oSEAmQxzgJsOn8O501OIN8p10Ce8EqtU_Imk" />

        <!--Twitter Meta tags-->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@crowdwisdom" />
        <meta name="twitter:title" content="<?= $page_title ?>"/>
        <meta name="twitter:image" content="<?= $page_img ?>" />

        <!--FB Meta tags-->
        <meta property="og:type" content="website" /> 
        <meta property="og:description" content="CrowdWisdom" />
        <meta property="og:title" content="<?= $page_title ?>" />
        <meta property="og:url" content="<?= base_url() . ltrim( $_SERVER[ 'REQUEST_URI' ], '/' ) ?>" />
        <meta property="og:image" content="<?= $page_img ?>" />

        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="627" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
        <link href="<?= base_url(); ?>css/one.css?v=2.10" rel="stylesheet" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
        <style>
            canvas{
                -moz-user-select: none;
                -webkit-user-select: none;
                -ms-user-select: none;
            }
        </style>
        <script>
            $(function () {

                $('#dismiss, .overlay-menu').on('click', function () {
                    $('#sidebar').removeClass('active');
                    $('.overlay-menu').removeClass('active');
                });

                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').addClass('active');
                    $('.overlay-menu').addClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            })
<?= "var base_url='" . base_url() . "'; var uid=" . $uid . ";"; ?>

        </script>
        <?php
        $win = "";
        if ( strlen( strstr( $_SERVER[ 'HTTP_USER_AGENT' ], "Windows" ) ) > 0 ) {
            $win = "win";
        }
        ?>
        <!--        <link rel="manifest" href="/manifest.json" />
                <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
                <script>
                    var OneSignal = window.OneSignal || [];
                    OneSignal.push(function () {
                        OneSignal.init({
                            appId: "daaffe38-5e7e-41d7-8291-10018fc017af",
                            autoRegister: false,
                            notifyButton: {
                                enable: true,
                            },
                        });
                    });
                </script>-->
                <!--        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
                        <script>
                                        var OneSignal = window.OneSignal || [];
                                        OneSignal.push(function () {
                                            OneSignal.init({
                                                appId: "65de5ca8-2d56-4a28-95d9-3c81f21ec3f0",
                                                autoRegister: false,
                                                notifyButton: {
                                                    enable: true,
                                                },
                                            });
                                        });
                        </script>-->
    </head>
    <body data-base_url="<?= base_url() ?>" data-uid="<?= $uid ?>" data-silver_points="<?= $silver_points ?>" data-detailid="<?= @$id ?>" data-alias='<?= @$alias; ?>' class="<?= @$win ?>">


        <div class="header-bg nav-bg ">
            <div class="container px-0">
                <div class="row">
                    <div class="col-3 d-flex text-left justify-content-left align-items-center">
                        <div class="logo-holder">
                            <a href="<?= base_url() ?>">
                                <img src="<?= base_url( 'images/headerlogo/logo-white-vertical-500.png' ); ?>" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    <div class="col-6 pt-4 align-items-center text-center">
                        <div class="row">
                            <div class="col-12 m-auto">
                                <div class="form-group">
                                    <input type="text" class="cust-search w-75 px-3 text-white" placeholder="Search by topic" value="">
                                    <i class="fa fa-search position-relative left26 text-white"></i>
                                    <div class="header-searched-topics row d-flex align-items-center position-absolute mx-5 px-3 w-75 z-depth-3">
                                        <div class="results w-100 bg-light"></div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-3 d-flex align-items-center justify-content-end text-right">

                        <img src="<?= base_url( 'images/headerlogo/coin.svg?v' ); ?>" style="width: 30px;" class="img-fluid"><p class="text-white font-weight-500 m-0 p-2 mr-3"><?= $silver_points ?></p>
                        <?php
                        if ( ! empty( $this -> session -> userdata( 'data' ) ) ) {
                            echo '<a href="' . base_url() . 'Login/logout" class="btn btn-sm border border-light rounded-btn text-white px-3">Logout</a>';
                        } else {
                            echo '<a href="' . base_url() . 'Login?section=home" class="btn btn-sm border border-light rounded-btn text-white px-3 head-login">Login</a>';
                        }
                        ?>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12 mainmenu">
                        <div class="row m-auto text-center justify-content-center menuholder">
                            <div class="col-md-2  text-center ">                        
                                <a href="<?= base_url() ?>Packages" class="text-white">Competition</a>
                            </div>
                            <div class="col-md-2  text-center">                        
                                <a href="<?= base_url() ?>Wallet" class="text-white">Wallet</a>
                            </div>
                            <div class="col-md-2  text-center">                        
                                <a href="<?= base_url(); ?>Home/aboutus" class="text-white">ABOUT US</a>
                            </div>
                            <!--<div class="col-md-2 p-0 text-center dropdown">
                                <a class="text-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Assembly 2018</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item py-2" href="<?= base_url(); ?>Allindia/Home?a=1">Lok Sabha 2019</a>
                                    <a class="dropdown-item py-2" href="<?= base_url(); ?>AP/Home">Andhra Pradesh</a>
                                    <a class="dropdown-item py-2" href="<?= base_url(); ?>Telangana/Home">Telangana</a>
                                    <a class="dropdown-item py-2" href="<?= base_url(); ?>MP/Home?a=2">Madhya Pradesh</a>
                                    <a class="dropdown-item py-2" href="<?= base_url(); ?>Chhattisgarh/Home?a=5">Chhattisgarh</a>
                                    <a class="dropdown-item py-2" href="<?= base_url(); ?>Rajasthan/Home?a=4">Rajasthan</a>
                                    <a class="dropdown-item py-2" href="<?= base_url(); ?>Sports/Home">Sports</a>
                                    <a class="dropdown-item py-2" href="<?= base_url(); ?>Gujarat/Home">Gujarat</a>
                                    <a class="dropdown-item py-2" href="<?= base_url(); ?>Karnataka/Home">Karnataka</a>
                                </div>

                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <nav id="sidebar" class="d-block d-md-none">
            <div class="sidebar-header">
                <span class="center-align">
                    <a href="<?= base_url(); ?>" class="brand-logo d-block">
                        <img class="img-fluid" src="<?= base_url( "/images/logo/red-logo.png" ) ?>">
                    </a>
                </span>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a class="" href="<?= base_url() ?>Packages">Competition</a>
                </li>
                <li class="">
                    <a class="" href="<?= base_url() ?>Wallet">Wallet</a>
                </li>
                <li class="">
                    <a class="" href="<?= base_url(); ?>Home/aboutus">About Us</a>
                </li>

                <li class=""><!--d-none-->
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Assembly 2018<img src="<?= base_url( 'images/headerlogo/rocket.png' ) ?>" /></a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a class="" href="<?= base_url(); ?>Allindia/Home?a=1">Lok Sabha 2019</a>
                        </li>
                        <li>
                            <a class="" href="<?= base_url(); ?>AP/Home">Andhra Pradesh</a>
                        </li>
                        <li>
                            <a class="" href="<?= base_url(); ?>Telangana/Home">Telangana</a>
                        </li>
                        <li>
                            <a class="" href="<?= base_url(); ?>MP/Home?a=2">Madhya Pradesh</a>
                        </li>
                        <li>
                            <a class="" href="<?= base_url(); ?>Chhattisgarh/Home?a=5">Chhattisgarh</a>
                        </li>
                        <li>
                            <a class="" href="<?= base_url(); ?>Rajasthan/Home?a=4">Rajasthan</a>
                        </li>
                        <li>
                            <a class="" href="<?= base_url(); ?>Sports/Home">Sports</a>
                        </li>
                        <li>
                            <a class="" href="<?= base_url(); ?>Gujarat/Home">Gujarat</a>
                        </li>
                        <li>
                            <a class="" href="<?= base_url(); ?>Karnataka/Home">Karnataka</a>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <?php
                    if ( ! empty( $this -> session -> userdata( 'data' ) ) ) {
                        echo '<a href="' . base_url() . 'Login/logout" class="">Logout</a>';
                    } else {
                        echo '<a href="' . base_url() . 'Login?section=home" class="">Login</a>';
                    }
                    ?>
                </li>

            </ul>

        </nav>
        <div id="mobilemenu" class="d-sm-block d-md-none">
            <nav class="navbar navbar-expand-lg bg-white w-100 nav-bg">

                <button class="border-none navbar-toggler position-absolute" type="button" id="sidebarCollapse">
                    <span class="navbar-toggler-icon  cust-toggler-btn"></span>
                </button>

                <div class="text-center m-auto w-75 d-none" id="mobile-search">
                    <div class="row" >
                        <div class="col-12 m-auto" >
                            <div class="form-group d-flex align-items-center justify-content-center mb-0">
                                <input type="text" class="cust-search height-32 text-white w-75 pt-1 px-3" placeholder="Search by topic" value="">
                                <div class="top32 header-searched-topics row d-flex align-items-center position-absolute px-2 mx-1 pr-3 w-75 z-depth-3">
                                    <div class="results w-100 bg-light"></div>
                                </div>
                            </div>
                        </div>                            
                    </div>
                </div>
                <a href="<?= base_url() ?>" class="navbar-brand text-center w-100 mr-0 m-img">
                    <img src="<?= base_url( 'images/headerlogo/logo-white-vertical-500.png' ); ?>" class="img-fluid w-50"/>
                </a>
                <div class="icon-holder position-absolute right26 ">
                    <i class="fa fa-search text-white"></i>
                </div>


            </nav>
        </div>

        <div class="overlay-menu"></div>
