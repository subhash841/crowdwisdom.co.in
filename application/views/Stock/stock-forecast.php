<div class="content container stock-forecast-container">
    <div class="row minus-m-t13 mb-12">
        <div class="col l8 s12 plr15 equal-height">
            <div class="card z-depth-4 " >
                <div class="card-image p15 covercenter stocks-bg">
                    <div class="center-align"><h4 class="mtb5 cardheader blueheader">Today's Stocks </h4></div>
                </div>
                <div class="card-content center">
                    <table class="receiverTable yourstock">
                        <tr>
                            <th>STOCK/INDEX</th>
                            <th>WEEKLY <br /><?= ($weekly_endon_date == "") ? "" : "(" . date("d-m-Y", strtotime($weekly_endon_date)) . ")" ?></th>
                            <th>MONTHLY <br /><?= ($monthly_endon_date == "") ? "" : "(" . date("d-m-Y", strtotime($monthly_endon_date)) . ")" ?></th>
                            <th>YEARLY <br /><?= ($yearly_endon_date == "") ? "" : "(" . date("d-m-Y", strtotime($yearly_endon_date)) . ")" ?></th>
                        </tr>
                    </table>
                    <form name="user_stock_forecast" id="user_stock_forecast" method="POST">
                        <input type="hidden" name="stock_codes" id="stock_codes" value="<?= $stock_codes; ?>" />
                        <div class="row gainerslist forecast-stocks custom-scrollbar">
                            <div class="col s12">
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
                                    //print_r($user_forecast);
                                    foreach ($user_forecast as $forecast):
                                        $weekly_disable = "";
                                        $monthly_disable = "";
                                        $yearly_disable = "";

                                        if ($forecast['is_weekly_stop'] == "1") {
                                            $weekly_disable = 'readonly="readonly"';
                                        }
                                        if ($forecast['is_monthly_stop'] == "1") {
                                            $monthly_disable = 'readonly="readonly"';
                                        }
                                        if ($forecast['is_yearly_stop'] == "1") {
                                            $yearly_disable = 'readonly="readonly"';
                                        }
                                        echo '<tr>
                                            <td class="f18 ' . $forecast['stock_code'] . '">
                                                <span class="tooltipped cursor-pointer" data-position="bottom" data-delay="50" data-tooltip="' . $forecast['stock_name'] . '">
                                                    <span>' . $forecast['stock_code'] . '</span>
                                                </span>
                                                <div class="fw block s-price">267.00</div>
                                            </td>
                                            <td>
                                                <input type="hidden" name="stock_id[]" value="' . $forecast['stock_id'] . '" />
                                                <input type="hidden" name="most_rated[]" id="most_rated' . $forecast['stock_id'] . '" value="' . $forecast['stock_rating'] . '" />
                                                <input type="text" name="stock_weekly_forecast[]" class="stock_weekly_forecast' . $forecast['stock_id'] . '" value="' . $forecast['weekly_forecast'] . '" data-stockid="' . $forecast['stock_id'] . '" maxlength="8" ' . $weekly_disable . ' class="only-float"/>
                                            </td>
                                            <td>
                                                <input type="text" name="stock_monthly_forecast[]" class="stock_monthly_forecast' . $forecast['stock_id'] . '" value="' . $forecast['monthly_forecast'] . '" data-stockid="' . $forecast['stock_id'] . '" maxlength="8" ' . $monthly_disable . ' class="only-float"/>
                                            </td>
                                            <td>
                                                <input type="text" name="stock_yearly_forecast[]" class="stock_yearly_forecast' . $forecast['stock_id'] . '" value="' . $forecast['yearly_forecast'] . '" data-stockid="' . $forecast['stock_id'] . '" maxlength="8" ' . $yearly_disable . ' class="only-float"/>
                                            </td>
                                        </tr>';
                                    endforeach;
                                    ?>
                                </table>
                                <!-- </div> -->
                                <!-- </div> -->
                            </div>
                        </div>
                        <?php
                        if ($is_result_out == "0" && ($is_weekly_stop == "0" || $is_monthly_stop == "0" || $is_yearly_stop == "0")) {
                            ?>
                            <div class="center-align">
                                <input type="submit" name="save_forecast" id="save_forecast" class="btn btn-black btn-large stocksavebtn" value="Save">
                            </div>
                            <?php
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="col l4 m12 s12 plr15 equal-height hide-on-med-and-down">
            <div class="card z-depth-4 padd0 external-info-container">
                <div class="card-head">
                    <div class="bloghead">Your Voice</div>
                </div>
                <div class="blogs-container withtable">
                    <div class="row">
                        <div class="col s12">
                            <?php
                            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                            foreach ($blogs as $blog_list):
                                $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                                if (!empty($blog_list['link'])) {
                                    if (preg_match($reg_exUrl, $blog_list['link'], $url)) {
                                        $href = $url[0];
                                        $target = 'target = "_blank"';
                                    } else {
                                        $href = base_url() . $blog_list['link'];
                                        $target = "";
                                    }
                                } else {
                                    $title=preg_replace('/[^A-Za-z0-9 \-]/', '',$blog_list['title']); 
                                    $title=str_replace(' ','_',$title);
                                    $href = base_url() . 'Blogs/getBlogs/' . $blog_list['id'];
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
            <div class="card z-depth-4 padd0 external-info-container">
                <div class="card-head">
                    <div class="twitterhead">Rewards</div>
                </div>
                <div class="tweets-container withtable">
                    <?php
//                    foreach ($tweets as $result) {
//
//                        echo '<div class="tweets">
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
//                    }
                    ?>
                </div>
<!--                <div class="card-footer" style="">
                    <a target="_blank" href="https://twitter.com/search?f=tweets&q=%23KarnatakaElection2018" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                </div>-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col l8 s12 plr15">
            <img src="../../images/common/experts-advice.png" class="experts-advice hide-on-small-only" onclick="location.href = 'Home/expert_forecast';" style="width: 100%; cursor: pointer;">
            <div class="experts-advice-xs hide-on-med-and-up">
                <img src="../../images/common/experts-advice-xs.png" style="width: 100%;">
                <div>
                    <h5>Would you like to know our experts rating</h5>
                    <a href="#">Know more</a>
                </div>
            </div>
        </div>
        <!-- <div class="card z-depth-4" style="min-height: 25vh;"></div> -->
    </div>
    <!-- <div class="row mb-2" style="">
        <div class="col l8 s12 plr15 equal-height">
            <div class="card z-depth-4">
                <div class="card-image p15 covercenter forecast-bg">
                    <div class="center-align"><h4 class="mtb5 cardheader blueheader">Current Seat Prediction </h4></div>
                </div>
                <h5 class="center-align grey-color">Results displayed are for karnataka's seat forecast</h5>    
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
                        <div class="col s12 l6" data-n="223">
                            <div class="row">
                                <div class="col s3 equal-height-child" style="height: 74px;"><img src="../images/party_logos/Congress.png" style="width: 68px;" class="forecast-result-logo"></div>
                                <div class="col s3 equal-height-child" style="height: 74px;">
                                    <div class="" style="margin: 10px;">
                                        <div class="vfparty">INC</div>
                                        <div class="vfseats">71</div>
                                    </div>
                                </div>
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="max-count mmax-count">114</div>
                                </div>
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="min-count mmax-count">0</div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 l6" data-n="223">
                            <div class="row">
                                <div class="col s3 equal-height-child" style="height: 74px;"><img src="../images/party_logos/bjp.png" style="width: 68px;" class="forecast-result-logo"></div>
                                <div class="col s3 equal-height-child" style="height: 74px;">
                                    <div class="" style="margin: 10px;">
                                        <div class="vfparty">BJP</div>
                                        <div class="vfseats">108</div>
                                    </div>
                                </div>
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="max-count mmax-count">135</div>
                                </div>
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="min-count mmax-count">0</div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 l6" data-n="223">
                            <div class="row">
                                <div class="col s3 equal-height-child" style="height: 74px;"><img src="../images/party_logos/Janata_Dal_Secular.png" style="width: 68px;" class="forecast-result-logo"></div>
                                <div class="col s3 equal-height-child" style="height: 74px;">
                                    <div class="" style="margin: 10px;">
                                        <div class="vfparty">JDS</div>
                                        <div class="vfseats">37</div>
                                    </div>
                                </div>
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="max-count mmax-count">80</div>
                                </div>
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="min-count mmax-count">0</div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 l6" data-n="223">
                            <div class="row">
                                <div class="col s3 equal-height-child" style="height: 74px;"><img src="../images/party_logos/no-logo.png" style="width: 68px;" class="forecast-result-logo"></div>
                                <div class="col s3 equal-height-child" style="height: 74px;">
                                    <div class="" style="margin: 10px;">
                                        <div class="vfparty">INP</div>
                                        <div class="vfseats">5</div>
                                    </div>
                                </div>
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="max-count mmax-count">10</div>
                                </div>
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="min-count mmax-count">0</div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 l6" data-n="223">
                            <div class="row">
                                <div class="col s3 equal-height-child" style="height: 74px;"><img src="../images/party_logos/no-logo.png" style="width: 68px;" class="forecast-result-logo"></div>
                                <div class="col s3 equal-height-child" style="height: 74px;">
                                    <div class="" style="margin: 10px;">
                                        <div class="vfparty">OTH</div>
                                        <div class="vfseats">3</div>
                                    </div>
                                </div>
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="max-count mmax-count">20</div>
                                </div>
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="min-count mmax-count">0</div>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>

                <div class="center-align" >
                    <a href="Login?section=seat" class="btn btn-black btn-large stocksavebtn">Predict now</a>
                </div>
            </div>
        </div>
        <div class="col l4 s12 plr15 equal-height hide-on-med-and-down">
            <div class="card z-depth-4 padd0">
                <div class="card-head">
                    <div class="twitterhead">Twitter Tweets</div>
                </div>
                <div class="tweets-container withtable">
    <?php
    foreach ($tweets as $result) {

        echo '<div class="tweets">
                                                    <div class="col m3"><img src="' . $result->user->profile_image_url_https . '" class="tweetprofile"></div>
                                                    <div class="col m9">
                                                    <div class="tweetname">' . $result->user->name . '</div>
                                                    <div class="tweetusername">@' . strtolower(str_replace(' ', '', $result->user->name)) . '</div>
                                                    </div>
                                                    <div class="col m12">
                                                    <div class="tweettext">' . $result->text . '</div>
                                                    <h6 class="tweetdate">' . str_replace('+0000', '', $result->created_at) . '</h6>
                                                    </div>
                                                    </div>';
    }
    ?>
                </div>
                <div class="card-footer" style="">
                    <a target="_blank" href="https://twitter.com/search?f=tweets&q=%23KarnatakaElection2018" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                </div>
            </div>
        </div>
    </div> -->
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
                                    $title=preg_replace('/[^A-Za-z0-9 \-]/', '',$blog_list['title']); 
                                    $title=str_replace(' ','_',$title);
                                    $href = base_url() . 'Blogs/getBlogs/' . $blog_list['id'];
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
        <div class="col l4 s12 plr15 equal-height hide-on-large-only">
            <div class="card z-depth-4 padd0">
                <div class="card-head">
                    <div class="twitterhead">Rewards</div>
                </div>
                <div class="tweets-container withtable">
                    <?php
//                    foreach ($tweets as $result) {
//
//                        echo '<div class="tweets">
//                        <div class="col m3"><img src="' . $result->user->profile_image_url_https . '" class="tweetprofile"></div>
//                        <div class="col m9">
//                        <div class="tweetname">' . $result->user->name . '</div>
//                        <div class="tweetusername">@' . strtolower(str_replace(' ', '', $result->user->name)) . '</div>
//                        </div>
//                        <div class="col m12">
//                        <div class="tweettext">' . $result->text . '</div>
//                        <h6 class="tweetdate">' . str_replace('+0000', '', $result->created_at) . '</h6>
//                        </div>
//                        </div>';
//                    }
                    ?>

                </div>
<!--                <div class="card-footer" style="">
                    <a target="_blank" href="https://twitter.com/search?f=tweets&q=%23KarnatakaElection2018" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                </div>-->
            </div>
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

<script>
    $(function () {
        //Submit users forecast details
        $("#user_stock_forecast").on("submit", function (event) {
            event.preventDefault();

            $.ajax({
                "url": "ForecastDetails/updateUserForecast",
                "method": "POST",
                "data": $(this).serialize()
            }).done(function (result) {
                result = JSON.parse(result);
                if (result.status) {
                    Materialize.Toast.removeAll();
                    Materialize.toast(result.message + '!', 4000);
                }
                else {
                    Materialize.Toast.removeAll();
                    Materialize.toast(result.message + '!', 4000);
                }

            });
        });

        $('.only-float').keypress(function (event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        // change the most rated stock to display order by
        $('input').on('change', function () {
            var value = $(this).val();
            var curr_stock_id = $(this).attr("data-stockid");

            if (value == "" || value == "0.00" || value == "0") {
                $(this).val("0.00");
            }
            var curr_weekly = $(".stock_weekly_forecast" + curr_stock_id).val();
            var curr_monthly = $(".stock_monthly_forecast" + curr_stock_id).val();
            var curr_yearly = $(".stock_yearly_forecast" + curr_stock_id).val();

            if (curr_weekly != "" && curr_monthly != "" && curr_yearly != "" && (curr_weekly != "0.00" || curr_monthly != "0.00" || curr_yearly != "0.00")) {
                $("#most_rated" + curr_stock_id).val("1");
            }
            else {
                $(this).val("0.00");
                $("#most_rated" + curr_stock_id).val("0");
            }
        });
    });
</script>