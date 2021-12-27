<div class="content container">
    <div class="row minus-m-t13 mb-12">
        <div class="col l8 s12 plr15 equal-height">
            <div class="card z-depth-4">
                <div class="card-image p15 covercenter forecast-bg">
                    <div class="center-align"><h4 class="mtb5 cardheader blueheader">Current Seat Prediction </h4></div>
                </div>
                <h5 class="center-align grey-color">Karnataka</h5>
                <div class="row" style="margin-bottom: 0;margin-top: 20px;">
                    <div class="col s12 l6">
                        <div class="row">
                            <div class="col s6"></div>
                            <div class="col s2 text-upper mmax-title">MAX</div>
                            <div class="col s2 text-upper mmax-title">MIN</div>
                        </div>
                    </div>
                    <div class="col s12 l6 hide-on-med-and-down">
                        <div class="row">
                            <div class="col s6"></div>
                            <div class="col s2 text-upper mmax-title">MAX</div>
                            <div class="col s2 text-upper mmax-title">MIN</div>
                        </div>
                    </div>
                </div>
                <div class="card-content withtable" style="margin: 30px 0;">
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
                        foreach ($user_election_avg_forecast as $k => $avg_forecast) {
                            $user_election_avg_forecast[$k]['avg_seatforecast'] = round($avg_forecast['avg_seatforecast']);
                            $n += $user_election_avg_forecast[$k]['avg_seatforecast'];
                            if ($user_election_avg_forecast[$k]['avg_seatforecast'] > 5) {
                                $has = $k;
                            }
                        }
                        if (isset($user_election_avg_forecast[$has]['avg_seatforecast'])) {
                            if ($n < 224) {
                                $user_election_avg_forecast[$has]['avg_seatforecast'] += (224 - $n);
                            } else if ($n > 224) {
                                $user_election_avg_forecast[$has]['avg_seatforecast'] -= ($n - 224);
                            }
                        }
                        foreach ($user_election_avg_forecast as $avg_forecast) {
                            echo '<div class="col s12 l6" data-n="' . $n . '">
                                        <div class="row">
                                            <div class="col s3 equal-height-child"><img src="' . base_url() . 'images/party_logos/' . $avg_forecast['icon'] . '" style="width: 68px;" class="forecast-result-logo"></div>
                                            <div class="col s3 equal-height-child">
                                                <div class="" style="margin: 10px;">
                                                    <div class="vfparty">' . $avg_forecast['abbreviation'] . '</div>
                                                    <div class="vfseats">' . $avg_forecast['avg_seatforecast'] . '</div>
                                                </div>
                                            </div>
                                            <!--<div class="col s5 m5 l5 progress-container">
                                                <div class="progress">
                                                    <div class="determinate" style="width: ' . $avg_forecast['avg_seatforecast'] . '%"></div>
                                                </div>
                                            </div>-->
                                            <div class="col s2 equal-height-child mmax-container">
                                                <div class="max-count mmax-count">' . $avg_forecast['maximum_seat'] . '</div>
                                            </div>
                                            <div class="col s2 equal-height-child mmax-container">
                                                <div class="min-count mmax-count">' . $avg_forecast['minimum_seat'] . '</div>
                                            </div>
                                        </div>
                                    </div>';
                        }
                        ?>
                    </div>
                </div>

                <div class="center-align" >
                    <a href="../Login?section=seat&url=karnataka" class="btn btn-black btn-large stocksavebtn">Predict now</a>
                </div>
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
                                        $target = 'target = "_blank"';
                                    }
                                } else {
                                    //$title=preg_replace('/[^A-Za-z0-9 \-]/', '',$blog_list['title']); 
                                    $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                                        "(", ")", "{", "}", "|", "/", ";", "'", "<",
                                        ">", ",");
                                    $title = str_replace($spchar, "", $blog_list['title']);
                                    $title = str_replace(' ', '-', $title);
                                    $href = base_url() . 'Blogs/getBlogs/' . $blog_list['id'] . '/' . $title;
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
    <div class="row mb-2" style="">
        <div class="col l8 s12 plr15 equal-height">
            <div class="card z-depth-4 " >
                <div class="card-image p15 covercenter stocks-bg">
                    <div class="center-align"><h4 class="mtb5 cardheader blueheader">Today's Stocks </h4></div>
                </div>
                <div>
                    <table class="receiverTable yourstock bindStockPrice">
                        <tr>
                            <th>STOCK/INDEX</th>
                            <th>WEEKLY <br /><?= ($weekly_endon_date == "") ? "" : "(" . date("d-m-Y", strtotime($weekly_endon_date)) . ")" ?></th>
                            <th>MONTHLY <br /><?= ($monthly_endon_date == "") ? "" : "(" . date("d-m-Y", strtotime($monthly_endon_date)) . ")" ?></th>
                            <th>YEARLY <br /><?= ($yearly_endon_date == "") ? "" : "(" . date("d-m-Y", strtotime($yearly_endon_date)) . ")" ?></th>
                        </tr>
                </div>
                </table>
            </div>
            <div class="card-content center withtable">
                <div class="row gainerslist">
                    <div class="col s12">
                        <input type="hidden" name="stock_codes" id="stock_codes" value="<?= $stock_codes; ?>" />
                        <!-- <div class="row gainerslist" style="margin-bottom: 0;margin-top: 20px;"> -->
                        <!-- <div class=""> -->
                        <table class="sourceTable yourstock bindStockPrice">
                            <!-- <tr>
                                <th>STOCK/INDEX</th>
                                <th>WEEKLY</th>
                                <th>MONTHLY</th>
                                <th>YEARLY</th>
                            </tr> -->
                            <?php
                            foreach ($user_avg_forecast as $stock_forecast):
                                $var = "";
                                echo '<tr>
                                            <td class="f18 ' . $stock_forecast['stock_code'] . '">
                                                <span class="tooltipped cursor-pointer" data-position="bottom" data-delay="50" data-tooltip="' . $stock_forecast['stock_name'] . '">
                                                    <span>' . $stock_forecast['stock_code'] . '</span>
                                                </span>
                                                <div class="fw block s-price">267.00</div>
                                            </td>
                                            <td>' . round($stock_forecast['weekly_forecast'], 2) . '</td>
                                            <td>' . round($stock_forecast['monthly_forecast'], 2) . '</td>
                                            <td>' . round($stock_forecast['yearly_forecast'], 2) . '</td>
                                        </tr>';
                            endforeach;
                            ?>
                        </table>
                        <!-- </div> -->
                        <!-- </div> -->
                    </div>
                </div>

                <!-- <div class="discription" style="font-size: 21px;font-weight: 400;color: #82828C;margin-bottom: 40px;line-height: 1.3;">How good you are in prediction? Wanna give a try as to see who would be the next ruling party in gujrat elections.</div> -->
            </div>
            <?php
            if ($is_result_out == "0") {
                ?>
                <div class="center-align">
                    <a href="<?= base_url() ?>Stock/ForecastDetails" class="btn btn-black btn-large stocksavebtn">Predict now</a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <div class="col l4 s12 plr15 equal-height hide-on-med-and-down">
        <div class="card z-depth-4 padd0">
            <div class="card-head">
                <div class="twitterhead">Rewards</div>
            </div>
            <div class="tweets-container withtable" style="margin-right: 0;">
                <?php
//                foreach ($tweets as $result) {
//
//                    echo '<div class="tweets">
//                                                    <div class="col m3"><img src="' . $result->user->profile_image_url_https . '" class="tweetprofile"></div>
//                                                    <div class="col m9">
//                                                    <div class="tweetname">' . $result->user->name . '</div>
//                                                    <div class="tweetusername">@' . strtolower(str_replace(' ', '', $result->user->name)) . '</div>
//                                                    </div>
//                                                    <div class="col m12">
//                                                    <div class="tweettext">' . $result->text . '</div>
//                                                    <h6 class="tweetdate">' . str_replace('+0000', '', $result->created_at) . '</h6>
//                                                    </div>
//                                                    </div>';
//                }
                ?>
            </div>
            <!--<div class="card-footer" style="">
                <a target="_blank" href="https://twitter.com/search?f=tweets&q=%23KarnatakaElection2018" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
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
                                    "(", ")", "{", "}", "|", "/", ";", "'", "<",
                                    ">", ",");
                                $title = str_replace($spchar, "", $blog_list['title']);
                                $title = str_replace(' ', '-', $title);
                                $href = base_url() . 'Blogs/getBlogs/' . $blog_list['id'] . '/' . $title;
                                $target = 'target = "_blank"';
                            }
                            //var_dump($href);exit;
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
    <div class="col l4 s12 plr15 equal-height hide-on-large-only">
        <div class="card z-depth-4 padd0">
            <div class="card-head">
                <div class="twitterhead">Rewards</div>
            </div>
            <div class="tweets-container withtable" style="height: 450px;">
                <?php
//                foreach ($tweets as $result) {
//
//                    echo '<div class="tweets">
//                                <div class="col m3"><img src="' . $result->user->profile_image_url_https . '" class="tweetprofile"></div>
//                                <div class="col m9">
//                                <div class="tweetname">' . $result->user->name . '</div>
//                                <div class="tweetusername">@' . strtolower(str_replace(' ', '', $result->user->name)) . '</div>
//                                </div>
//                                <div class="col m12">
//                                <div class="tweettext">' . $result->text . '</div>
//                                <h6 class="tweetdate">' . str_replace('+0000', '', $result->created_at) . '</h6>
//                                </div>
//                            </div>';
//                }
                ?>
            </div>
            <!--<div class="card-footer" style="">
                <a target="_blank" href="https://twitter.com/search?f=tweets&q=%23KarnatakaElection2018" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
            </div>-->
        </div>
    </div>

    <div class="row">

        <div class="col l4 m12 s12 plr15 equal-height ">
            <div class="card z-depth-4 padd0 bg-w-block">
                <div class="card-head">
                    <div class="twitterhead">वेब से</div>
                </div>

                <div class="blogs-container col">
                    <div class=" article-list rated-list withtable col">
                    </div>
                    <div class="col load-btn-holder mt-4 text-center">
                        <a href="#" class="btn btn-outline-primary readmore rounded-btn load-more z-depth-2">Read more</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="col l4 m12 s12 plr15 equal-height ">
            <div class="card z-depth-4 padd0  bg-w-block">
                <div class="card-head">
                    <div class="twitterhead">सवाल</div>
                </div>
                <div class="blogs-container col">
                    <div class=" article-list questions-list withtable col">
                    </div>
                    <div class="col load-btn-holder mt-4 text-center">
                        <a href="#" class="btn btn-outline-primary readmore rounded-btn load-more z-depth-2">Read more</a>

                    </div>
                </div>


            </div>
        </div>
        <div class="col l4 m12 s12 plr15 equal-height ">
            <div class="card z-depth-4 padd0  bg-w-block">
                <div class="card-head">
                    <div class="twitterhead">अनुमान</div>
                </div>

                <div class="blogs-container col">
                    <div class=" article-list predictions-list withtable col">
                    </div>
                    <div class="col load-btn-holder mt-4 text-center">
                        <a href="#" class="btn btn-outline-primary readmore rounded-btn load-more z-depth-2">Read more</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
<?= "var base_url='" . base_url() . "';"; ?>
            $(function () {

                $(".load-more").on("click", function (e) {
                    e.preventDefault();
                    load_sidebar($(this).closest(".bg-w-block").find(".article-list"), $(this).attr("data-load"), $(this).attr("data-offset"))
                })
                load_sidebar($(".predictions-list"), "predictions");
                load_sidebar($(".questions-list"), "questions");
                load_sidebar($(".rated-list"), "rated_articles");
                function load_sidebar(b, q = "voices", offset = 0) {
                    $.ajax({
                        url: base_url + "Common/get_trending_" + q,
                        method: "POST",
                        data: {offset: offset, notin: 0}
                    }).done(function (result) {

                        var data = result['data'];
                        var html = b;
                        if (data.length > 0) {

                            for (var i in data) {
                                html.append(getblock(data[i], q));
                            }

                            if (result['is_available'] == "1") {
                                $(".load-more", b.parent())
                                        .attr("data-load", q).attr("data-offset", offset + data.length)
                                        .closest('.load-btn-holder').removeClass('fade');
                            } else {
                                $(".load-more", b.parent())
                                        .attr("data-load", q).attr("data-offset", offset + data.length)
                                        .closest('.load-btn-holder').addClass('fade');
                            }

                            var tt = $(".h-list-detail .h-list");
                            tt.width($('.blog-list-item', tt).length * $(".blog-list-item", tt).outerWidth() + 100)

                        }
                    });
                }

                function getblock(data, q) {

                    if (q == "voices")
                        q = "YourVoice/blog_detail/"
                    else if (q == "questions")
                        q = "AskQuestions/details/"
                    else if (q == "rated_articles")
                        q = "RatedArticle/details/"

                    var total_likes = convert_numbers(data.total_likes);
                    var total_views = convert_numbers(data.total_views);
                    var total_comments = convert_numbers(data.total_comments);
                    var slug = create_slug(data.title);
                    var div = $("<div />", {class: "row blog-list-item"})
                    var a = $("<a/>", {
                        href: base_url + q + data.id + '/' + slug,
                        class: "d-block pb-3",
                        "data-content": "Most Popular Blog"
                    })

                    var blogimg = $("<div />", {
                        class: "col s5 p-5",
                        style: "background: url('" + data.image + "')  no-repeat center center;height:80px; background-size:cover"
                    });
                    var likes = $("<small />", {class: "likes blog-details"}).html(total_likes + " Likes &nbsp;&nbsp;&#9679;&nbsp;&nbsp; " + total_views + " Views &nbsp;&nbsp;&#9679;&nbsp;&nbsp; " + total_comments + " Comments")
                    var category = $("<small />", {class: "category"}).html(data.category);
                    var title = $('<div />', {class: "blog-title truncate"}).html(data.title);

                    a
                            .append(blogimg)
                            .append($("<div>", {class: "col s7"})
                                    .append(title)
                                    .append(likes))



                    div.append(a);
                    return div;
                }

                function convert_numbers(value) {
                    if (isNaN(value))
                        return 0;
                    var newvalue = value;
                    var suffixNum = '';
                    if (value >= 1000) {
                        suffixNum = ("" + value).length;
                        if (suffixNum == 4 || suffixNum == 5 || suffixNum == 6) {
                            newvalue = Math.floor(value / 1000) + "K";
                        }
                        if (suffixNum >= 7) {
                            newvalue = Math.floor(value / 1000000) + "M";
                        }
                    }
                    return newvalue;
                }

                /*Slug creation for blog */
                function create_slug(string) {
                    var slug_string = '';
                    slug_string = string.replace(/[~`!@#$%^&*()_=+{}|\/;'<>?,]/g, ''); //remove special characters from slug
                    slug_string = slug_string.split(' ').join('-'); //creating slug

                    return slug_string;
                }

            })
    </script>
</div>