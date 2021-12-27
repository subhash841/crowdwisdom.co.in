<?php
//echo base_url();exit;
?>
<!DOCTYPE html>
<html>
    <head>

        <title>Crowd Wisdom - Login</title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>images/common/favicon.ico" />
        <!--Import Google Icon Font-->
        <!--Import materialize.css-->

        <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css" type="text/css" rel="stylesheet"  media="screen,projection"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700|Material+Icons" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>   
        <link href="<?php echo base_url(); ?>css/login.css?v=1.4" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="mydiv">
                <div class="text-center animated1 fadeIn">
                    <img src="<?= base_url('images/logo/white-logo.png'); ?>" alt="Company logo" class="co-logo" style="margin-bottom: 20%;" />
                    <h5 class="hometext"><!--Login Below to-->Click below for your vote to be counted</h5>
                    <div>
                        <a href="<?= base_url() ?>Login/twitterlogin" class="waves-effect waves-light btn socal-login btn-large">
                            <!--<i class="fa fa-twitter fa-1x social-icon twittericon loginbtntext"></i>-->
                            <img src="<?= base_url('images/icons/twitter.png'); ?>" class="googleimg"/>
                            <span class="m-l-20 fs16px loginbtntext" style="margin-left: 12px;">LOGIN</span>
                        </a>
                    </div>
                    <div>
                        <a href="#" id="facebook" class="waves-effect waves-light btn socal-login btn-large">
                            <!--<i class="fa fa-facebook fa-1x social-icon facebookicon loginbtntext"></i>-->
                            <img src="<?= base_url('images/icons/facebook.png'); ?>" class="googleimg"/>
                            <span class="m-l-20 fs16px loginbtntext" style="margin-left: 12px;">LOGIN</span>
                        </a>
                    </div>
                    <div>
                        <a href="<?php echo base_url(); ?>Login/googlelogin" id="googlelogin" class="waves-effect waves-light btn socal-login btn-large">
<!--                            <i class="fa fa-google-plus fa-1x social-icon googleplusicon"></i>-->
                            <img src="<?= base_url('images/icons/googlelogin.png'); ?>" class="googleimg"/>
                            <span class="m-l-20 fs16px loginbtntext" style="margin-left: 12px;">LOGIN <!--WITH GOOGLE--></span>
                        </a>
                    </div>
                </div>
                <!--<div class="disclaimer">* Final Ranking published will include your Twitter ID</div>-->
            </div>
        </div>
        <div class="firstimg animated slideInDown" ><img src="<?= base_url('images/login/loudspeaker.png'); ?>" class="w-90"/></div>
        <div class="secondimg animated slideInUp" ><img src="<?= base_url('images/login/vote_1.png'); ?>" class="w-90"/></div>
        <div class="thirdimg animated slideInUp" ><img src="<?= base_url('images/login/hands-up.png'); ?>" class="w-90"/></div>
        <div class="forthimg animated slideInDown" ><img src="<?= base_url('images/login/checkbox.png'); ?>" class="w-90" /></div>

        <!--Import jQuery before materialize.js-->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111765819-1"></script>
        <script>
                window.dataLayer = window.dataLayer || [];
                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());

                gtag('config', 'UA-111765819-1');
        </script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
        <script type="text/javascript">
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
                $(document).ready(function () {
                    $('#facebook').click(function (e) {
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
