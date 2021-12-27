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
                            <li><a href="<?php echo base_url(); ?>" class="your-ranking">Ranking</a></li>
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
            <li><a href="<?php echo base_url(); ?>" class="your-ranking">Ranking</a></li>
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
            });</script>
        <div class="banner" style="background: #232b3c;min-height: 50vh;">
            <div class="center-align">
                <img src="<?= base_url('/images/common/stars.png'); ?>">
                <p style="color: #fff;font-size: 25px;margin-bottom: 10px;">Time for the Gujarat election results...</p>
                <p style="color: #fff;font-size: 20px;margin-top: 10px;">Want to know your ranking...</p>
            </div>
        </div>
        <div class="content container" id="final-result-all">
            <div class="row minus-m-t8 mb-12">
                <div class="col s12 plr15 equal-height">
                    <div class="card z-depth-4">
                        <div class="card-image">
                            <div class="resultlist-title p15 coverleft">
                                <div class="left">
                                    <h4 class="cardheader blueheader">Final Ranking</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-content withtable resultlist center-align" style="margin-top: 50px;max-height: inherit;">
                            <div class="row row-title">
                                <div class="col s12 m3">
                                    <div class="text-upper mmax-title">Name</div>
                                </div>
                                <div class="col s12 m3">
                                    <div class="text-upper mmax-title">twitter id</div>
                                </div>
                                <div class="col s12 m3">
                                    <div class="text-upper mmax-title">rank</div>
                                </div>
                                <div class="col s12 m3">
                                    <div class="text-upper mmax-title">Points</div>
                                </div>
                            </div>
                            <?php
                            $rank = "";
                            $total_certified = get_certified_users_count();
                            $total_pages = ceil($total_certified['total_certified'] / 10);

                            foreach ($certified_users as $key => $users):
                                $num = $key + 1;
                                if ($num == 1) {
                                    $rank = "$num<sup>st</sup>";
                                } else if ($num == 2) {
                                    $rank = "$num<sup>nd</sup>";
                                } else if ($num == 3) {
                                    $rank = "$num<sup>rd</sup>";
                                } else {
                                    $rank = "$num<sup>th</sup>";
                                }
                                echo '<a href="singleresult/' . $users['id'] . '?r=' . $num . '"><div class="row">
                                        <div class="col s12 m3">
                                            <div class="twitter-user">' . $users['name'] . '</div>
                                        </div>
                                        <div class="col s12 m3">
                                            <div class="twitter-handle">@' . $users['twitter_id'] . '</div>
                                        </div>
                                        <div class="col s12 m3">
                                            <div class="user-rank">' . $rank . '</div>
                                        </div>
                                        <div class="col s12 m3">
                                            <div class="user-rank">' . round($users['points']) . '</div>
                                        </div>
                                    </div></a>';
                            endforeach;
                            ?>
                            <!--<div class="row">
                                <div class="col s12 m4">
                                    <div class="twitter-user">Vineet Balan</div>
                                </div>
                                <div class="col s12 m4">
                                    <div class="twitter-handle">@vineetbalan</div>
                                </div>
                                <div class="col s12 m4">
                                    <div class="user-rank">1st</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m4">
                                    <div class="twitter-user">Vineet Balan</div>
                                </div>
                                <div class="col s12 m4">
                                    <div class="twitter-handle">@vineetbalan</div>
                                </div>
                                <div class="col s12 m4">
                                    <div class="user-rank">1st</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m4">
                                    <div class="twitter-user">Vineet Balan</div>
                                </div>
                                <div class="col s12 m4">
                                    <div class="twitter-handle">@vineetbalan</div>
                                </div>
                                <div class="col s12 m4">
                                    <div class="user-rank">1st</div>
                                </div>
                            </div>-->
                        </div>
                        <div class="result-pagination center-align" style="">
                            <ul class="pagination">
                                <!--<li class="disabled"><a href="#"><i class="material-icons">chevron_left</i></a></li>-->
                                <?php
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    $is_active = ($i == 1) ? "active" : "";
                                    echo '<li class="waves-effect ' . $is_active . '"><a href="#" class="page" data-pagenum="' . $i . '">' . $i . '</a></li>';
                                }
                                ?>

                                <!--<li class="waves-effect active"><a href="#!">1</a></li>
                                <li class="waves-effect"><a href="#!">2</a></li>
                                <li class="waves-effect"><a href="#!">3</a></li>
                                <li class="waves-effect pagi-dots"><a href="#!">.</a></li>
                                <li class="waves-effect pagi-dots"><a href="#!">.</a></li>
                                <li class="waves-effect pagi-dots"><a href="#!">.</a></li>
                                <li class="waves-effect pagi-dots"><a href="#!">.</a></li>
                                <li class="waves-effect pagi-dots"><a href="#!">.</a></li>
                                <li class="waves-effect pagi-dots"><a href="#!">.</a></li>
                                <li class="waves-effect pagi-dots"><a href="#!">.</a></li>
                                <li class="waves-effect"><a href="#!">10</a></li>
                                <li class="waves-effect"><a href="#"><i class="material-icons">chevron_right</i></a></li>-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(function () {
                $('.page').on('click', function (e) {
                    e.preventDefault();
                    var offset = 0;
                    $('.pagination li').removeClass('active');
                    var page = $(this).attr("data-pagenum");
                    if (page == 1) {
                        offset = 0;
                    }
                    else {
                        offset = (page * 10) - 10;
                    }

                    $(this).closest('li').addClass('active');
                    $.ajax({
                        "url": "ajax_users_list/" + offset,
                        "method": "POST"
                    }).done(function (result) {
                        result = JSON.parse(result);
                        var html = '<div class="row row-title">\
                                        <div class="col s12 m3">\
                                            <div class="text-upper mmax-title">Name</div>\
                                        </div>\
                                        <div class="col s12 m3">\
                                            <div class="text-upper mmax-title">twitter id</div>\
                                        </div>\
                                        <div class="col s12 m3">\
                                            <div class="text-upper mmax-title">rank</div>\
                                        </div>\
                                        <div class="col s12 m3">\
                                            <div class="text-upper mmax-title">Points</div>\
                                        </div>\
                                    </div>';

                        for (var i in result) {
                            var num = parseInt(i) + 1;
                            var val = offset + num;
                            html += '<a href="singleresult/' + result[i].id + '?r=' + val + '"><div class="row">\
                                <div class="col s12 m3">\
                                    <div class="twitter-user">' + result[i].name + '</div>\
                                </div>\
                                <div class="col s12 m3">\
                                    <div class="twitter-handle">@' + result[i].twitter_id + '</div>\
                                </div>\
                                <div class="col s12 m3">\
                                    <div class="user-rank">' + val + '<sup>th</sup></div>\
                                </div>\
                                <div class="col s12 m3">\
                                    <div class="user-rank">' + Math.round(result[i].points) + '</div>\
                                </div>\
                            </div>\
                        </a>';
                        }
                        $('.card-content.withtable.resultlist').html(html);
                    });
                });
            });
        </script>