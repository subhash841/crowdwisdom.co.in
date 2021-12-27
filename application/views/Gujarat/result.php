<div class="content container" id="final-result">
    <div class="row minus-m-t8 mb-12">
        <?php
        if ($is_result_out == "1") {
            ?>
            <a href="<?= base_url() ?>Gujarat/Home/resultlist">
                <div class="col s12 plr15">
                    <div id="crowd-winners">
                        <div class="golden-patch text-upper">
                            <div class="shine-me"></div>
                            <div class="winner-title">Predictor Gurus</div>
                        </div>
                        <div class="winners-list">
                            <?php
                            $rank = "";
                            foreach ($certified_users as $key => $users) {
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
                                echo '<div class="winner">
                                    <div class="winner-rank">' . $rank . '</div>
                                    <div class="winner-name">' . $users['name'] . '</div>
                                </div>';

                                if ($num == "5") {
                                    break;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </a>
            <?php
        }
        ?>
        <div class="col l8 m12 s12 plr15 equal-height">
            <div class="card z-depth-4">
                <div class="card-image">
                    <div class="game1 p15 coverleft">
                        <div class="left"><h4 class="cardheader blueheader">Partywise Seat Result</h4></div>
                    </div>
                    <h5 class="cardheadtitle"><!-- How good are you in prediction ? wanna give a try as a see who would be the next ruling party in gujarat elections  --></h5>
                </div>
                <div class="row" style="margin-bottom: 0;margin-top: 20px;">
                    <div class="col s12 l6">
                        <div class="row">
                            <div class="col s5"></div>
                            <div class="col s3 text-upper mmax-title">Actual</div>
                            <div class="col s3 text-upper mmax-title">Average</div>
                        </div>
                    </div>
                    <div class="col s12 l6 hide-on-med-and-down">
                        <div class="row">
                            <div class="col s5"></div>
                            <div class="col s3 text-upper mmax-title">Actual</div>
                            <div class="col s3 text-upper mmax-title">Average</div>
                        </div>
                    </div>
                </div>
                <div class="card-content withtable">
                    <div class="row">
                        <?php
                        $n = 0;
                        $has = 0;
//                        foreach ($user_avg_forecast as $k => $avg_forecast) {
//                            $user_avg_forecast[$k]['avg_seatforecast'] = round($avg_forecast['avg_seatforecast']);
//                            $n += $user_avg_forecast[$k]['avg_seatforecast'];
//                        }
//                        if ($n > 182) {
//                            $user_avg_forecast[count($user_avg_forecast) - 1]['avg_seatforecast'] = $user_avg_forecast[count($user_avg_forecast) - 1]['avg_seatforecast'] - 1;
//                        }
                        foreach ($user_avg_forecast as $k => $avg_forecast) {
                            $user_avg_forecast[$k]['avg_seatforecast'] = round($avg_forecast['avg_seatforecast']);
                            $n += $user_avg_forecast[$k]['avg_seatforecast'];
                            if ($user_avg_forecast[$k]['avg_seatforecast'] > 5) {
                                $has = $k;
                            }
                        }
                        if (isset($user_avg_forecast[$has]['avg_seatforecast'])) {
                            if ($n < 182) {
                                $user_avg_forecast[$has]['avg_seatforecast'] += (182 - $n);
                            } else if ($n > 182) {
                                $user_avg_forecast[$has]['avg_seatforecast'] -= ($n - 182);
                            }
                        }
                        foreach ($user_avg_forecast as $avg_forecast) {
                            echo '<div class="col s12 l6" data-n="' . $n . '">
                                        <div class="row">
                                            <div class="col s3 equal-height-child"><img src="' . base_url() . 'images/party_logos/' . $avg_forecast['icon'] . '" style="width: 68px;" class="forecast-result-logo"></div>
                                            <div class="col s2 equal-height-child mmax-container">
                                                <div class="mmax-count">
                                                    <div class="vfparty">' . $avg_forecast['abbreviation'] . '</div>
                                                </div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container">
                                                <div class="max-count mmax-count">' . $avg_forecast['actual_seats'] . '</div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container">
                                                <div class="min-count mmax-count">' . $avg_forecast['avg_seatforecast'] . '</div>
                                            </div>
                                        </div>
                                    </div>';
                        }
                        ?>
                    </div>
                </div>
                <?php
                if ($is_result_out == "0") {
                    ?>
                    <div class="hide-on-large-only center-align" style="padding-top: 20px;">
                        <a href="Login?section=seat" class="btn btn-black savebtn">Predict now</a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="col l4 m12 s12 plr15 equal-height hide-on-med-and-down">
            <div class="card z-depth-4 padd0">
                <div class="card-head">
                    <div class="bloghead">Your Voice</div>
                </div>
                <div class="blogs-container withtable">
                    <div class="row">
                        <div class="col s12">
                            <?php
                            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                            foreach ($blogs as $blog_list):
                                if (!empty($blog_list['link'])) {
                                    if (preg_match($reg_exUrl, $blog_list['link'], $url)) {
                                        $href = $url[0];
                                        $target = 'target = "_blank"';
                                    } else {
                                        $href = base_url() . $blog_list['link'];
                                        $target = "";
                                    }
                                } else {
                                    $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                                                    "(", ")", "{", "}", "|", "/",";", "'", "<",
                                                    ">", ",");
                                    $title = str_replace($spchar, "", $blog_list['title']);
                                    $title=str_replace(' ','-',$title);
                                    $href = base_url() . 'Blogs/getBlogs/' . $blog_list['id'].'/'.$title;
                                    $target = 'target = "_blank"';
                                }
                                echo '<div class="blogs">
                                        <a href="' . $href . '" ' . $target . '>
                                            <div class="row">
                                                <div class="col s5">
                                                    <img src="' . base_url() . 'images/blogs/' . $blog_list['image'] . '" class="featured-img" style="width: 100%;">
                                                </div>
                                                <div class="col s7">
                                                    <div class="blog-details text-upper">politics</div>
                                                    <div class="blog-title truncate">' . $blog_list['title'] . '</div>
                                                    <div class="blog-details">' . date("d F Y", strtotime($blog_list['created_date'])) . '</div>
                                                    <div class="blog-author"><a href="">' . $blog_list['name'] . '</a></a></div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>';
                            endforeach;
                            ?>

                        </div>
                    </div>    
                </div>
                <div class="card-footer" style="">
                    <a href="<?= base_url() ?>Blogs" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-9">
        <div class="col l8 m12 s12 plr15 equal-height">
            <div class="card z-depth-4">
                <div class="card-image">
                    <div class="game1 p15 coverleft">
                        <div class="left"><h4 class="cardheader blueheader">Partywise Vote Result</h4></div>
                    </div>
                    <h5 class="cardheadtitle"><!-- How good are you in prediction ? wanna give a try as a see who would be the next ruling party in gujarat elections  --></h5>
                </div>
                <div class="row" style="margin-bottom: 0;margin-top: 20px;">
                    <div class="col s12 l6">
                        <div class="row">
                            <div class="col s5"></div>
                            <div class="col s3 text-upper mmax-title">Actual</div>
                            <div class="col s3 text-upper mmax-title">Average</div>
                        </div>
                    </div>
                    <div class="col s12 l6 hide-on-med-and-down">
                        <div class="row">
                            <div class="col s5"></div>
                            <div class="col s3 text-upper mmax-title">Actual</div>
                            <div class="col s3 text-upper mmax-title">Average</div>
                        </div>
                    </div>
                </div>
                <div class="card-content withtable">
                    <div class="row">
                        <?php
                        $n = 0;
                        $has = 0;
                        foreach ($user_avg_forecast as $k => $avg_forecast) {
                            $user_avg_forecast[$k]['avg_voteforcast'] = round($avg_forecast['avg_voteforcast']);
                            $n += $user_avg_forecast[$k]['avg_voteforcast'];
                            if ($user_avg_forecast[$k]['avg_voteforcast'] > 5) {
                                $has = $k;
                            }
                        }
                        if (isset($user_avg_forecast[$has]['avg_voteforcast'])) {
                            if ($n < 100) {
                                $user_avg_forecast[$has]['avg_voteforcast'] += (100 - $n);
                            } else if ($n > 100) {
                                $user_avg_forecast[$has]['avg_voteforcast'] -= ($n - 100);
                            }
                        }
                        foreach ($user_avg_forecast as $avg_forecast) {
                            echo '<div class="col s12 l6" data-n="' . $n . '">
                                        <div class="row">
                                            <div class="col s3 equal-height-child"><img src="' . base_url() . 'images/party_logos/' . $avg_forecast['icon'] . '" style="width: 68px;" class="forecast-result-logo"></div>
                                            <div class="col s2 equal-height-child mmax-container">
                                                <div class="forecast-result-percent mmax-count">
                                                    <div class="vfparty">' . $avg_forecast['abbreviation'] . '</div>
                                                </div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container">
                                                <div class="max-count mmax-count">' . $avg_forecast['actual_votes'] . ' %</div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container">
                                                <div class="min-count mmax-count">' . $avg_forecast['avg_voteforcast'] . ' %</div>
                                            </div>
                                        </div>
                                    </div>';
                        }
                        ?>
                    </div>
                </div>
                <?php
                if ($is_result_out == "0") {
                    ?>
                    <div class="hide-on-large-only center-align" style="padding-top: 20px;">
                        <a href="Login?section=vote" class="btn btn-black savebtn">Predict now</a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="col l4 m12 s12 plr15 equal-height hide-on-med-and-down">
            <div class="card z-depth-4 padd0">
                <div class="card-head">
                    <div class="twitterhead">Rewards</div>
                </div>
                <div class="tweets-container withtable" style="height: 89%;margin-right: 0;">
                    <?php
//                    foreach ($tweets as $result) {
//
//                        echo '<div class="tweets">
//                                    <div class="col m3"><img src="' . $result->user->profile_image_url_https . '" class="tweetprofile"></div>
//                                    <div class="col m9">
//                                        <div class="tweetname">' . $result->user->name . '</div>
//                                        <div class="tweetusername">@' . strtolower(str_replace(' ', '', $result->user->name)) . '</div>
//                                    </div>
//                                    <div class="col m12">
//                                        <div class="tweettext">' . $result->text . '</div>
//                                        <h6 class="tweetdate">' . str_replace('+0000', '', $result->created_at) . '</h6>
//                                    </div>
//                                </div>';
//                    }
                    ?>

                </div>
<!--                <div class="card-footer" style="">
                    <a target="_blank" href="https://twitter.com/search?f=tweets&q=%23GujaratElections" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                </div>-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col l4 m12 s12 plr15 equal-height hide-on-large-only">
            <div class="card z-depth-4 padd0">
                <div class="card-head">
                    <div class="bloghead">Your Voice</div>
                </div>
                <div class="blogs-container withtable">
                    <div class="row">
                        <div class="col s12">
                            <?php
                            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                            foreach ($blogs as $blog_list):
                                if (!empty($blog_list['link'])) {
                                    if (preg_match($reg_exUrl, $blog_list['link'], $url)) {
                                        $href = $url[0];
                                        $target = 'target = "_blank"';
                                    } else {
                                        $href = base_url() . $blog_list['link'];
                                        $target = "";
                                    }
                                } else {
                                    $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                                                    "(", ")", "{", "}", "|", "/",";", "'", "<",
                                                    ">", ",");
                                    $title = str_replace($spchar, "", $blog_list['title']);
                                    $title=str_replace(' ','-',$title);
                                    $href = base_url() . 'Blogs/getBlogs/' . $blog_list['id'].'/'.$title;
                                    $target = 'target = "_blank"';
                                }
                                echo '<div class="blogs">
                                        <a href="' . $href . '" ' . $target . '>
                                            <div class="row">
                                                <div class="col s5">
                                                    <img src="' . base_url() . 'images/blogs/' . $blog_list['image'] . '" class="featured-img" style="width: 100%;">
                                                </div>
                                                <div class="col s7">
                                                    <div class="blog-details text-upper">politics</div>
                                                    <div class="blog-title truncate">' . $blog_list['title'] . '</div>
                                                    <div class="blog-details">' . date("d F Y", strtotime($blog_list['created_date'])) . '</div>
                                                    <div class="blog-author"><a href="">' . $blog_list['name'] . '</a></a></div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>';
                            endforeach;
                            ?>

                        </div>
                    </div>    
                </div>
                <div class="card-footer" style="">
                    <a href="#" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                </div>
            </div>
        </div>
        <div class="col l4 m12 s12 plr15 equal-height hide-on-large-only">
            <div class="card z-depth-4 padd0">
                <div class="card-head">
                    <div class="twitterhead">Rewards</div>
                </div>
                <div class="tweets-container withtable" style="height:450px;">
                    <?php
//                    foreach ($tweets as $result) {
//
//                        echo '<div class="tweets">
//                                    <div class="col m3"><img src="' . $result->user->profile_image_url_https . '" class="tweetprofile"></div>
//                                    <div class="col m9">
//                                        <div class="tweetname">' . $result->user->name . '</div>
//                                        <div class="tweetusername">@' . strtolower(str_replace(' ', '', $result->user->name)) . '</div>
//                                    </div>
//                                    <div class="col m12">
//                                        <div class="tweettext">' . $result->text . '</div>
//                                        <h6 class="tweetdate">' . str_replace('+0000', '', $result->created_at) . '</h6>
//                                    </div>
//                                </div>';
//                    }
                    ?>

                </div>
<!--                <div class="card-footer" style="">
                    <a target="_blank" href="https://twitter.com/search?f=tweets&q=%23GujaratElections" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                </div>-->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    var chart_array = <?php echo "[" . @$chart_array . "]" ?>;

    google.charts.load("current", {packages: ["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['BJP - Bhartiya Janta Party (45%)', 45],
            ['INC - (25%)', 25],
            ['AAP - (10%)', 10],
            ['JDU - (8%)', 8],
            ['NCP - (4%)', 4],
            ['BSP - (4%)', 4],
            ['BRP - (2%)', 2],
            ['GAVP - (2%)', 2]
        ]);

        //var data = google.visualization.arrayToDataTable(chart_array);

        var options = {
            legend: 'none',
            pieSliceText: 'none',
            title: '',
            pieHole: 0.8,
            slices: {
                0: {color: '92a9ff'},
                1: {color: '37b6ff'},
                2: {color: '54e2e0'},
                3: {color: '2ecc71'},
                4: {color: 'ffc600'},
                5: {color: 'ff6767'},
                // 6: {color: 'ffabb9'},
                // 7: {color: 'a774cb'}
            },
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        //document.getElementById('pie-chart').getElementsByTagName('g')[0].setAttribute("style", "transform: translate(-130px)");
        chart.draw(data, options);
    }
</script>