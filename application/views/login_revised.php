<html>
    <head>
        <title>CrowdWisdom</title>

        <link rel="shortcut icon" href="<?= base_url( "images/common/favicon.ico" ) ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,500,700" rel="stylesheet">

        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="google-site-verification" content="Jx8tII0oSEAmQxzgJsOn8O501OIN8p10Ce8EqtU_Imk" />

        <!--Twitter Meta tags-->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@crowdwisdom" />
        <meta name="twitter:title" content="CrowdWisdom"/>
        <meta name="twitter:image" content="CrowdWisdom" />

        <!--FB Meta tags-->
        <meta property="og:type" content="website" />
        <meta property="og:description" content="CrowdWisdom" />
        <meta property="og:title" content="CrowdWisdom" />
        <meta property="og:url" content="CrowdWisdom" />
        <meta property="og:image" content="CrowdWisdom" />

        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="627" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <!-- START BOOTSTRAP DATETIME PICKER CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <!-- END BOOTSTRAP DATETIME PICKER CSS -->
        <link href="<?= base_url(); ?>css/one.css?v=2.06" rel="stylesheet" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <style>
            .no-link{
                text-decoration: none !important;
            }
        </style>
    </head>
    <body class="p-0" data-base_url="<?= base_url() ?>">
        <div class="container-fluid">

            <div class="row login h-100">
                <div class="login-imgs">
                    <img src="<?= base_url( "/images/login/01.jpg?v=1" ) ?>"  />
                    <img src="<?= base_url( "/images/login/01.jpg?v=1" ) ?>" class="l1" style="opacity:0" />
                    <img src="<?= base_url( "/images/login/02.jpg?v=1" ) ?>" class="l2" style="opacity:0" />
                    <img src="<?= base_url( "/images/login/03.jpg?v=1" ) ?>" class="l3" style="opacity:0" />
                    <img src="<?= base_url( "/images/login/04.jpg?v=1" ) ?>" class="l4" style="opacity:0" />
                </div>
                <div class="col-md-8 d-none d-md-block"></div>
                <div class="col-md-4 text-center login-cont h-100 d-flex align-items-center justify-content-center">
                    <div class="row">
                        <div class="col text-center">

                            <img class="my-5 d-none d-md-block px-5 img-fluid" src="<?= base_url( 'images/headerlogo/crowd-wisdom-500.png' ); ?>"/>
                            <img class="my-5 img-fluid px-5 d-md-none" src="<?= base_url( 'images/headerlogo/logo-white-vertical-500.png' ); ?>"/>
                            <!--<h3 class="font-weight-bold">SIGN UP</h3>-->
                            <h5 class="text-center font-weight-bold">Click below for your vote to be counted</h5>
                            <h4 class="pt-5"><b>Login With</b></h4>

                            <a href="#" id="facebook" class="no-link">
                                <img class="m-1 p-1" src="<?= base_url( 'images/icons/03.png' ); ?>" style="width: 60px;"/>
                            </a>
                            <a href="<?= base_url() ?>Login/twitterlogin" class="no-link">
                                <img class="m-1 p-1" src="<?= base_url( 'images/icons/04.png' ); ?>" style="width: 60px;"/>
                            </a>
                            <a href="<?= base_url() ?>Login/googlelogin" class="no-link">
                                <img class="m-1 p-1" src="<?= base_url( 'images/icons/05.png' ); ?>" style="width: 60px;"/>
                            </a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <script>
                $(function () {
                    window.fbAsyncInit = function () {
                        FB.init({
                            appId: '202892733630302', //my app
                            cookie: true,
                            xfbml: true,
                            version: 'v2.2'
                        });
                    };
                    (function (d, debug) {
                        var js, id = 'facebook-jssdk',
                                ref = d.getElementsByTagName('script')[0];
                        if (d.getElementById(id)) {
                            return;
                        }
                        js = d.createElement('script');
                        js.id = id;
                        js.async = true;
                        js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
                        ref.parentNode.insertBefore(js, ref);
                    }(document, /*debug*/ false));

                    //Onclick for fb login
                    $("#facebook").on("click", function (e) {
                        e.preventDefault();
                        FB.login(function (response) {
                            if (response.authResponse) {
                                access_token = response.authResponse.accessToken;
                                FB.api('/me?fields=id,name,email,gender,permissions', function (response) {
                                    // alert(response.permissions);
                                    name = response.name;
                                    user_id = response.id;
                                    user_email = response.email;
                                    gender = response.gender;
                                    // alert("name="+name+" user_id="+user_id+" gender"+gender+" email="+user_email);
                                    FB.api('/me/picture?type=normal', function (response) {
                                        //profile_image = response.data.url;
                                        profile_image = "";
                                        //var data = "access_token="+access_token+"&name="+name+"&user_id="+user_id+"&user_email="+user_email+"&gender="+gender+"&profile_image="+profile_image;
                                        var data = {
                                            access_token: access_token,
                                            name: name,
                                            user_id: user_id,
                                            user_email: user_email,
                                            gender: gender,
                                            profile_image: profile_image
                                        }
                                        $.ajax({
                                            url: "Login/fblogin",
                                            type: 'POST',
                                            data: data,
                                            success: function (obj) {
                                                //        if (obj == "200")
                                                //            {
                                                //            window.location.reload();
                                                //            }
                                            },
                                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                                //alert(textStatus);
                                                // $('#confirm_msg').html('An error occured! please try after sometime. Status:'+textStatus+"Error: " + errorThrown).show();
                                                // window.location.reload();
                                            }
                                        }).done(function (response) {
                                            response = JSON.parse(response);
                                            if (response.status) {
                                                window.location.assign(response.redirect_url);
                                            } else {
                                                window.location.assign(response.redirect_url);
                                            }
                                        });
                                    });
                                });
                            } else {
                                alert("Login attempt failed!");
                            }
                        }, {
                            scope: 'email,public_profile'
                        });
                    });
                });
        </script>

    </body>
</html>