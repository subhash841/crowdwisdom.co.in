<!DOCTYPE html>
<html>
    <head>
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
                            <li><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li><a href="<?php echo base_url(); ?>Home/resultlist" class="yours-ranking">Ranking</a></li>
                            <li><a style="color: #eb0100;" href="<?php echo base_url(); ?>Blogs/blogdetails">What is Crowd Wisdom?</a></li>
                            <li><a href="<?php echo base_url(); ?>Home/aboutus">About Us</a></li>
                            <li><a href="<?php echo base_url(); ?>Blogs">Opinion</a></li>
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
        <ul id="slide-out" class="side-nav">
            <li class="center-align">
                <a href="<?php echo base_url(); ?>Home" class="brand-logo">
                    <img src="<?= base_url('images/logo/red-logo.png'); ?>"/>
                </a>
            </li>
            <li><div class="divider"></div></li>
            <li><a href="<?php echo base_url(); ?>Home">Home</a></li>
            <li><a href="<?php echo base_url(); ?>" class="your-ranking">Your Ranking</a></li>
            <li><a style="color: #eb0100;" href="<?php echo base_url(); ?>Blogs/blogdetails">What is Crowd Wisdom?</a></li>
            <li><a href="<?php echo base_url(); ?>Home/aboutus">About Us</a></li>
            <li><a href="<?php echo base_url(); ?>Blogs">Opinion</a></li>
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
        <div class="banner" style="background: #232b3c;">
            <div class="center-align">
                <p style="color: #fff;font-size: 25px;margin-bottom: 10px;"><?= $user_detail['name'] ?></p>
                <p class="profile-locaton">
                    <span id="user-location"><img src="<?= base_url('/images/common/location.png'); ?>"> <?= $user_detail['location'] ?></span>
                    <!--<span id="party-affiliation"><?= $user_detail['party'] . " - " . $user_detail['abbreviation'] ?></span>-->
                </p>
                <p class="profile-rank">
                    <span id="user-medal"><img src="<?= base_url('/images/common/medal.png'); ?>"></span><span id="user-rank">Congratulations !!! Your rank is 
                        <?php
//                        if (isset($user_detail['rank'])) {
//                            if ($user_detail['rank'] == 1) {
//                                $rank = $user_detail['rank'] . "<sup>st</sup>";
//                            } else if ($user_detail['rank'] == 2) {
//                                $rank = $user_detail['rank'] . "<sup>nd</sup>";
//                            } else if ($user_detail['rank'] == 3) {
//                                $rank = $user_detail['rank'] . "<sup>rd</sup>";
//                            } else {
//                                $rank = $user_detail['rank'] . "<sup>th</sup>";
//                            }
//                            echo $rank;
//                        }
                        if (isset($_GET['r'])) {
                            if ($_GET['r'] == 1) {
                                $rank = $_GET['r'] . "<sup>st</sup>";
                            } else if ($_GET['r'] == 2) {
                                $rank = $_GET['r'] . "<sup>nd</sup>";
                            } else if ($_GET['r'] == 3) {
                                $rank = $_GET['r'] . "<sup>rd</sup>";
                            } else {
                                $rank = $_GET['r'] . "<sup>th</sup>";
                            }
                            echo $rank;
                        }
                        ?>
                    </span>
                </p>
                <?php
                if ($user_detail['rank'] <= 20 || in_array($user_detail['id'], array("31", "67", "102", "158", "182", "207", "225"))) {
                    echo '<a class="cw-btn modal-trigger center-align" href="#certificate-modal"><div>View Certificate</div></a>';
                    echo '<script>$(function(){
                            $(window).on("load",function(){
                                $("#certificate-modal").modal("open");
                            });
                        });</script>';
                }
                ?>
            </div>
        </div>
        <!-- Modal Structure -->
        <script>
            window.twttr = (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0],
                        t = window.twttr || {};
                if (d.getElementById(id))
                    return t;
                js = d.createElement(s);
                js.id = id;
                js.src = "https://platform.twitter.com/widgets.js";
                fjs.parentNode.insertBefore(js, fjs);
                t._e = [];
                t.ready = function (f) {
                    t._e.push(f);
                };
                return t;
            }(document, "script", "twitter-wjs"));
        </script>
        <div id="certificate-modal" class="modal">
            <div class="modal-content">
                <img src="<?php echo base_url() . $user_detail['certificate_path'] ?>" style="width: 100%; max-width: 750px;">
                <?php
                $userdata = $this->session->userdata('data');

                if ($userdata['uid'] == $user_detail['id']) {
                    $url = urlencode("https://crowdwisdom.co.in/webportal/Home/singleresult/".$userdata['uid']."?r=".$user_detail['rank']);

                    echo '<div class = "right-align">
                            <a class = "waves-effect waves-light twitter-share-btn twitter-share-button" href="https://twitter.com/intent/tweet?text=Thanks%20to%20your%20excellent%20forecasting%20in%20the%20Gujarat%20election%2C%20you%20are%20certified%20as%20a%20Predictor%20Guru%20by%20Crowdwisdom.&tw_p=tweetbutton&url='.$url.'&via=crowdwisdom360"><i class = "fa fa-twitter" aria-hidden = "true" data-size="large"></i>Share</a>
                        </div>';
                }
                ?>
            </div>
        </div>
        <div class="content container" id="final-result-single">
            <div class="row minus-m-t8 mb-12">
                <div class="col s12 plr15 equal-height">
                    <div class="card z-depth-4">
                        <div class="card-image">
                            <div class="game1 p15 containcenter">
                                <div class="center-align">
                                    <h4 class="cardheader blueheader">Seat Prediction</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 0;margin-top: 20px;">
                            <div class="col s12 l6">
                                <div class="row">
                                    <div class="col s6"></div>
                                    <div class="col s2 text-upper mmax-title">Prediction</div>
                                    <div class="col s2 text-upper mmax-title">Actual</div>
                                </div>
                            </div>
                            <div class="col s12 l6 hide-on-med-and-down">
                                <div class="row">
                                    <div class="col s6"></div>
                                    <div class="col s2 text-upper mmax-title">Prediction</div>
                                    <div class="col s2 text-upper mmax-title">Actual</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-content withtable">
                            <div class="row">
                                <?php
                                foreach ($actual_and_user_forecast as $seat_and_actual_forecast):
                                    echo '<div class="col s12 l6" data-n="' . $seat_and_actual_forecast['user_id'] . '">
                                            <div class="row">
                                                <div class="col s3 equal-height-child">
                                                    <img src="' . base_url() . 'images/party_logos/' . $seat_and_actual_forecast['icon'] . '" style="width: 68px;" class="forecast-result-logo"></div>
                                                <div class="col s3 equal-height-child mmax-container">
                                                    <div class="mmax-count">
                                                        <div class="vfparty">' . $seat_and_actual_forecast['abbreviation'] . '</div>
                                                    </div>
                                                </div>
                                                <div class="col s2 equal-height-child mmax-container">
                                                    <div class="max-count mmax-count">' . $seat_and_actual_forecast['seat_forecast'] . '</div>
                                                </div>
                                                <div class="col s2 equal-height-child mmax-container">
                                                    <div class="min-count mmax-count">' . $seat_and_actual_forecast['actual_seats'] . '</div>
                                                </div>
                                            </div>
                                        </div>';
                                endforeach;
                                ?>
                                <!--<div class="col s12 l6" data-n="183">
                                    <div class="row">
                                        <div class="col s3 equal-height-child">
                                            <img src="/CrowdWisdom/Code/webportal/images/party_logos/Congress.png" style="width: 68px;" class="forecast-result-logo"></div>
                                        <div class="col s3 equal-height-child mmax-container">
                                            <div class="mmax-count">
                                                <div class="vfparty">INC</div>
                                            </div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="max-count mmax-count">0</div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="min-count mmax-count">62</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 l6" data-n="183">
                                    <div class="row">
                                        <div class="col s3 equal-height-child">
                                            <img src="/CrowdWisdom/Code/webportal/images/party_logos/bahujan-samaj-party.png" style="width: 68px;" class="forecast-result-logo"></div>
                                        <div class="col s3 equal-height-child mmax-container">
                                            <div class="mmax-count">
                                                <div class="vfparty">BSP</div>
                                            </div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="max-count mmax-count">0</div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="min-count mmax-count">1</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 l6" data-n="183">
                                    <div class="row">
                                        <div class="col s3 equal-height-child">
                                            <img src="/CrowdWisdom/Code/webportal/images/party_logos/no-logo.png" style="width: 68px;" class="forecast-result-logo"></div>
                                        <div class="col s3 equal-height-child mmax-container">
                                            <div class="mmax-count">
                                                <div class="vfparty">AIHCP</div>
                                            </div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="max-count mmax-count">0</div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="min-count mmax-count">2</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 l6" data-n="183">
                                    <div class="row">
                                        <div class="col s3 equal-height-child">
                                            <img src="/CrowdWisdom/Code/webportal/images/party_logos/ncp.png" style="width: 68px;" class="forecast-result-logo"></div>
                                        <div class="col s3 equal-height-child mmax-container">
                                            <div class="mmax-count">
                                                <div class="vfparty">NCP</div>
                                            </div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="max-count mmax-count">0</div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="min-count mmax-count">1</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 l6" data-n="183">
                                    <div class="row">
                                        <div class="col s3 equal-height-child">
                                            <img src="/CrowdWisdom/Code/webportal/images/party_logos/shs.png" style="width: 68px;" class="forecast-result-logo"></div>
                                        <div class="col s3 equal-height-child mmax-container">
                                            <div class="mmax-count">
                                                <div class="vfparty">SHS</div>
                                            </div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="max-count mmax-count">0</div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="min-count mmax-count">0</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 l6" data-n="183">
                                    <div class="row">
                                        <div class="col s3 equal-height-child">
                                            <img src="/CrowdWisdom/Code/webportal/images/party_logos/no-logo.png" style="width: 68px;" class="forecast-result-logo"></div>
                                        <div class="col s3 equal-height-child mmax-container">
                                            <div class="mmax-count">
                                                <div class="vfparty">INP</div>
                                            </div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="max-count mmax-count">0</div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="min-count mmax-count">4</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 l6" data-n="183">
                                    <div class="row">
                                        <div class="col s3 equal-height-child">
                                            <img src="/CrowdWisdom/Code/webportal/images/party_logos/no-logo.png" style="width: 68px;" class="forecast-result-logo"></div>
                                        <div class="col s3 equal-height-child mmax-container">
                                            <div class="mmax-count">
                                                <div class="vfparty">OTH</div>
                                            </div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="max-count mmax-count">0</div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="min-count mmax-count">2</div>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 plr15 equal-height">
                    <div class="card z-depth-4">
                        <div class="card-image">
                            <div class="game1 p15 containcenter">
                                <div class="center-align">
                                    <h4 class="cardheader blueheader">Vote Prediction</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 0;margin-top: 20px;">
                            <div class="col s12 l6">
                                <div class="row">
                                    <div class="col s6"></div>
                                    <div class="col s2 text-upper mmax-title">Prediction</div>
                                    <div class="col s2 text-upper mmax-title">Actual</div>
                                </div>
                            </div>
                            <div class="col s12 l6 hide-on-med-and-down">
                                <div class="row">
                                    <div class="col s6"></div>
                                    <div class="col s2 text-upper mmax-title">Prediction</div>
                                    <div class="col s2 text-upper mmax-title">Actual</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-content withtable">
                            <div class="row">
                                <?php
                                foreach ($actual_and_user_forecast as $vote_and_actual_forecast):
                                    echo '<div class="col s12 l6" data-n="' . $vote_and_actual_forecast['user_id'] . '">
                                            <div class="row">
                                                <div class="col s3 equal-height-child">
                                                    <img src="' . base_url() . 'images/party_logos/' . $vote_and_actual_forecast['icon'] . '" style="width: 68px;" class="forecast-result-logo"></div>
                                                <div class="col s3 equal-height-child mmax-container">
                                                    <div class="mmax-count">
                                                        <div class="vfparty">' . $vote_and_actual_forecast['abbreviation'] . '</div>
                                                    </div>
                                                </div>
                                                <div class="col s2 equal-height-child mmax-container">
                                                    <div class="max-count mmax-count">' . $vote_and_actual_forecast['vote_forcast'] . '%</div>
                                                </div>
                                                <div class="col s2 equal-height-child mmax-container">
                                                    <div class="min-count mmax-count">' . $vote_and_actual_forecast['actual_votes'] . '%</div>
                                                </div>
                                            </div>
                                        </div>';
                                endforeach;
                                ?>
                                <!--<div class="col s12 l6" data-n="183">
                                    <div class="row">
                                        <div class="col s3 equal-height-child">
                                            <img src="/CrowdWisdom/Code/webportal/images/party_logos/bjp.png" style="width: 68px;" class="forecast-result-logo"></div>
                                        <div class="col s3 equal-height-child mmax-container">
                                            <div class="mmax-count">
                                                <div class="vfparty">BJP</div>
                                            </div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="max-count mmax-count">0</div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="min-count mmax-count">110</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 l6" data-n="183">
                                    <div class="row">
                                        <div class="col s3 equal-height-child">
                                            <img src="/CrowdWisdom/Code/webportal/images/party_logos/Congress.png" style="width: 68px;" class="forecast-result-logo"></div>
                                        <div class="col s3 equal-height-child mmax-container">
                                            <div class="mmax-count">
                                                <div class="vfparty">INC</div>
                                            </div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="max-count mmax-count">0</div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="min-count mmax-count">62</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 l6" data-n="183">
                                    <div class="row">
                                        <div class="col s3 equal-height-child">
                                            <img src="/CrowdWisdom/Code/webportal/images/party_logos/bahujan-samaj-party.png" style="width: 68px;" class="forecast-result-logo"></div>
                                        <div class="col s3 equal-height-child mmax-container">
                                            <div class="mmax-count">
                                                <div class="vfparty">BSP</div>
                                            </div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="max-count mmax-count">0</div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="min-count mmax-count">1</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 l6" data-n="183">
                                    <div class="row">
                                        <div class="col s3 equal-height-child">
                                            <img src="/CrowdWisdom/Code/webportal/images/party_logos/no-logo.png" style="width: 68px;" class="forecast-result-logo"></div>
                                        <div class="col s3 equal-height-child mmax-container">
                                            <div class="mmax-count">
                                                <div class="vfparty">AIHCP</div>
                                            </div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="max-count mmax-count">0</div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="min-count mmax-count">2</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 l6" data-n="183">
                                    <div class="row">
                                        <div class="col s3 equal-height-child">
                                            <img src="/CrowdWisdom/Code/webportal/images/party_logos/ncp.png" style="width: 68px;" class="forecast-result-logo"></div>
                                        <div class="col s3 equal-height-child mmax-container">
                                            <div class="mmax-count">
                                                <div class="vfparty">NCP</div>
                                            </div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="max-count mmax-count">0</div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="min-count mmax-count">1</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 l6" data-n="183">
                                    <div class="row">
                                        <div class="col s3 equal-height-child">
                                            <img src="/CrowdWisdom/Code/webportal/images/party_logos/shs.png" style="width: 68px;" class="forecast-result-logo"></div>
                                        <div class="col s3 equal-height-child mmax-container">
                                            <div class="mmax-count">
                                                <div class="vfparty">SHS</div>
                                            </div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="max-count mmax-count">0</div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="min-count mmax-count">0</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 l6" data-n="183">
                                    <div class="row">
                                        <div class="col s3 equal-height-child">
                                            <img src="/CrowdWisdom/Code/webportal/images/party_logos/no-logo.png" style="width: 68px;" class="forecast-result-logo"></div>
                                        <div class="col s3 equal-height-child mmax-container">
                                            <div class="mmax-count">
                                                <div class="vfparty">INP</div>
                                            </div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="max-count mmax-count">0</div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="min-count mmax-count">4</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 l6" data-n="183">
                                    <div class="row">
                                        <div class="col s3 equal-height-child">
                                            <img src="/CrowdWisdom/Code/webportal/images/party_logos/no-logo.png" style="width: 68px;" class="forecast-result-logo"></div>
                                        <div class="col s3 equal-height-child mmax-container">
                                            <div class="mmax-count">
                                                <div class="vfparty">OTH</div>
                                            </div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="max-count mmax-count">0</div>
                                        </div>
                                        <div class="col s2 equal-height-child mmax-container">
                                            <div class="min-count mmax-count">2</div>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>