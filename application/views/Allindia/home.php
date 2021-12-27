<div class="content container">
    <div class="row minus-m-t8 mb-12"><!--minus-m-t13-->
        <?php
        if ( $is_result_out == "1" ) {
                ?>
                <a href="Home/resultlist">
                    <!--<div class="col s12 plr15">
                        <div id="crowd-winners">
                            <div class="golden-patch text-upper">
                                <div class="shine-me"></div>
                                <div class="winner-title">oracle certified</div>
                            </div>
                            <div class="winners-list">
                    <?php
                    $rank = "";
                    foreach ( $certified_users as $key => $users ) {
                            $num = $key + 1;
                            if ( $num == 1 ) {
                                    $rank = "$num<sup>st</sup>";
                            } else if ( $num == 2 ) {
                                    $rank = "$num<sup>nd</sup>";
                            } else if ( $num == 3 ) {
                                    $rank = "$num<sup>rd</sup>";
                            } else {
                                    $rank = "$num<sup>th</sup>";
                            }
                            echo '<div class="winner">
                                    <div class="winner-rank">' . $rank . '</div>
                                    <div class="winner-name">' . $users[ 'name' ] . '</div>
                                </div>';

                            if ( $num == "5" ) {
                                    break;
                            }
                    }
                    ?>
                                <div class="winner">
                                    <div class="winner-rank">2<sup>nd</sup></div>
                                    <div class="winner-name">Vineet Balan</div>
                                </div>
                                <div class="winner">
                                    <div class="winner-rank">3<sup>rd</sup></div>
                                    <div class="winner-name">Piyush Jain</div>
                                </div>
                                <div class="winner">
                                    <div class="winner-rank">4<sup>th</sup></div>
                                    <div class="winner-name">Suhail Tamboli</div>
                                </div>
                                <div class="winner">
                                    <div class="winner-rank">5<sup>th</sup></div>
                                    <div class="winner-name">Aaditi Parab</div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                </a>
                <?php
        }
        ?>
        <div class="col l8 m12 s12 plr15 equal-height">
            <div class="card z-depth-4">
                <div class="card-image">
                    <div class="game1 p15 coverleft">
                        <div class="left"><h4 class="cardheader blueheader">Current Seat Prediction</h4></div>
                        <?php
                        if ( $is_result_out == "0" ) {
                                ?>
                                <div class="right hide-on-med-and-down">
                                    <a href="<?php echo base_url() ?>Login?section=seat" class="btn btn-black savebtn">Predict now</a>
                                </div>
                                <?php
                        }
                        ?>
                    </div>
                    <h5 class="cardheadtitle"></h5>
                </div>
                <!--<div class="row" style="margin-bottom: 0;margin-top: 20px;">
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
                </div>-->
                <div class="card-content withtable">
                    <div class="row">
                        <?php
                        $n = 0;
                        $has = 0;
                        foreach ( $user_avg_forecast as $k => $avg_forecast ) {
                                $user_avg_forecast[ $k ][ 'avg_seatforecast' ] = round( $avg_forecast[ 'avg_seatforecast' ] );
                                $n += $user_avg_forecast[ $k ][ 'avg_seatforecast' ];
                                if ( $user_avg_forecast[ $k ][ 'avg_seatforecast' ] > 5 ) {
                                        $has = $k;
                                }
                        }
                        if ( isset( $user_avg_forecast[ $has ][ 'avg_seatforecast' ] ) ) {
                                if ( $n < $total_seats ) {
                                        $user_avg_forecast[ $has ][ 'avg_seatforecast' ] += ($total_seats - $n);
                                } else if ( $n > $total_seats ) {
                                        $user_avg_forecast[ $has ][ 'avg_seatforecast' ] -= ($n - $total_seats);
                                }
                        }
                        foreach ( $user_avg_forecast as $avg_forecast ) {
                                echo '<div class="col s12 l6" data-n="' . $n . '">
                                        <div class="row">
                                            <div class="col s3 equal-height-child"><img src="' . base_url() . 'images/party_logos/' . $avg_forecast[ 'icon' ] . '" style="width: 68px;" class="forecast-result-logo"></div>
                                            <div class="col s8 equal-height-child"><!--s3-->
                                                <div class="" style="margin: 10px;">
                                                    <div class="vfparty">' . $avg_forecast[ 'party_name' ] . '</div>
                                                    <div class="vfseats">' . $avg_forecast[ 'avg_seatforecast' ] . '</div>
                                                </div>
                                            </div>
                                            <!--<div class="col s5 m5 l5 progress-container">
                                                <div class="progress">
                                                    <div class="determinate" style="width: ' . $avg_forecast[ 'avg_seatforecast' ] . '%"></div>
                                                </div>
                                            </div>
                                            <div class="col s2 equal-height-child mmax-container">
                                                <div class="max-count mmax-count">' . @$avg_forecast[ 'maximum_seat' ] . '</div>
                                            </div>
                                            <div class="col s2 equal-height-child mmax-container">
                                                <div class="min-count mmax-count">' . @$avg_forecast[ 'minimum_seat' ] . '</div>
                                            </div>-->
                                        </div>
                                    </div>';
                        }
                        ?>
                    </div>
                </div>
                <?php
                if ( $is_result_out == "0" ) {
                        ?>
                        <div class="hide-on-large-only center-align" style="padding-top: 20px;">
                            <a href="<?php echo base_url() ?>Login?section=seat" class="btn btn-black savebtn">Predict now</a>
                        </div>
                        <?php
                }
                ?>
                <div class="forreasonbtn reasonlink hide-on-med-and-down">
                    <a href="<?php echo base_url() ?>Allindia/Reasons/Page/1" class="">Prediction Reasons</a>
                </div>
                <div class="center reasonlink hide-on-large-only pt15">
                    <a href="<?php echo base_url() ?>Allindia/Reasons/Page/1" class="">Prediction Reasons</a>
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
                            foreach ( $blogs as $blog_list ):
                                    if ( ! empty( $blog_list[ 'link' ] ) ) {
                                            if ( preg_match( $reg_exUrl, $blog_list[ 'link' ], $url ) ) {
                                                    $href = $url[ 0 ];
                                                    $target = 'target = "_blank"';
                                            } else {
                                                    $href = base_url() . $blog_list[ 'link' ];
                                                    $target = 'target = "_blank"';
                                            }
                                    } else {
                                            $title = $blog_list[ 'title' ];
                                            $title = str_replace( '!', ' ', $title );
                                            $title = str_replace( '@', ' ', $title );
                                            $title = str_replace( '#', ' ', $title );
                                            $title = str_replace( '$', ' ', $title );
                                            $title = str_replace( '%', ' ', $title );
                                            $title = str_replace( '^', ' ', $title );
                                            $title = str_replace( '&', ' ', $title );
                                            $title = str_replace( '*', ' ', $title );
                                            $title = str_replace( '(', ' ', $title );
                                            $title = str_replace( ')', ' ', $title );
                                            $title = str_replace( ',', ' ', $title );
                                            $title = str_replace( '.', ' ', $title );
                                            $title = str_replace( ' ', '_', $title );
                                            $title = str_replace( ' ', '_', $title );
                                            $href = base_url() . 'Blogs/getBlogs/' . $blog_list[ 'id' ] . '/' . $title;
                                            $target = 'target = "_blank"';
                                    }
                                    echo '<div class="blogs">
                                        <a href="' . $href . '" ' . $target . '>
                                            <div class="row">
                                                <div class="col s5">
                                                    <img src="' . base_url() . 'images/blogs/' . $blog_list[ 'image' ] . '" class="featured-img" style="width: 100%;">
                                                </div>
                                                <div class="col s7">
                                                    <div class="blog-details text-upper">politics</div>
                                                    <div class="blog-title truncate">' . $blog_list[ 'title' ] . '</div>
                                                    <div class="blog-details">' . date( "d F Y", strtotime( $blog_list[ 'created_date' ] ) ) . '</div>
                                                    <div class="blog-author"><a href="">' . $blog_list[ 'name' ] . '</a></a></div>
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
    <div class="row mb-2">
        <div class="col l8 m12 s12 plr15 equal-height">
            <div class="card z-depth-4">
                <div class="card-image">
                    <div class="game1 p15 coverleft">
                        <div class="left"><h4 class="cardheader blueheader">Current Vote Prediction</h4></div>
                        <?php
                        if ( $is_result_out == "0" ) {
                                ?>
                                <div class="right hide-on-med-and-down">
                                    <a href="<?php echo base_url() ?>Login?section=seat" class="btn btn-black savebtn">Predict now</a>
                                </div>
                                <?php
                        }
                        ?>
                    </div>
                    <h5 class="cardheadtitle"></h5>
                </div>
                <!--<div class="row" style="margin-bottom: 0;margin-top: 20px;">
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
                </div>-->
                <div class="card-content withtable">    
                    <div class="row">
                        <?php
                        $n = 0;
                        $has = 0;
                        foreach ( $user_avg_forecast as $k => $avg_forecast ) {
                                $user_avg_forecast[ $k ][ 'avg_voteforcast' ] = round( $avg_forecast[ 'avg_voteforcast' ] );
                                $n += $user_avg_forecast[ $k ][ 'avg_voteforcast' ];
                                if ( $user_avg_forecast[ $k ][ 'avg_voteforcast' ] > 5 ) {
                                        $has = $k;
                                }
                        }
                        if ( isset( $user_avg_forecast[ $has ][ 'avg_voteforcast' ] ) ) {
                                if ( $n == 0 ) {
                                        $user_avg_forecast[ $has ][ 'avg_voteforcast' ] += $n;
                                } else if ( $n < 100 ) {
                                        $user_avg_forecast[ $has ][ 'avg_voteforcast' ] += (100 - $n);
                                } else if ( $n > 100 ) {
                                        $user_avg_forecast[ $has ][ 'avg_voteforcast' ] -= ($n - 100);
                                }
                        }
                        foreach ( $user_avg_forecast as $avg_forecast ) {
                                echo '<div class="col s12 l6" data-n="' . $n . '">
                                        <div class="row">
                                            <div class="col s3 equal-height-child"><img src="' . base_url() . 'images/party_logos/' . $avg_forecast[ 'icon' ] . '" style="width: 68px;" class="forecast-result-logo"></div>
                                            <div class="col s8 equal-height-child"><!--s3-->
                                                <div class="forecast-result-percent" style="margin: 10px;">
                                                    <div class="vfparty">' . $avg_forecast[ 'party_name' ] . '</div>
                                                    <div class="vfseats">' . $avg_forecast[ 'avg_voteforcast' ] . ' %</div>
                                                </div>
                                            </div>
                                            <!--<div class="col s5 m5 l5 progress-container">
                                                <div class="progress">
                                                    <div class="determinate" style="width: ' . $avg_forecast[ 'avg_voteforcast' ] . '%"></div>
                                                </div>
                                            </div>
                                            <div class="col s2 equal-height-child mmax-container">
                                                <div class="max-count mmax-count">' . @$avg_forecast[ 'maximum_vote' ] . '%</div>
                                            </div>
                                            <div class="col s2 equal-height-child mmax-container">
                                                <div class="min-count mmax-count">' . @$avg_forecast[ 'minimum_vote' ] . '%</div>
                                            </div>-->
                                        </div>
                                    </div>';
                        }
                        ?>
                    </div>
                </div>
                <?php
                if ( $is_result_out == "0" ) {
                        ?>
                        <div class="hide-on-large-only center-align" style="padding-top: 20px;">
                            <a href="<?php echo base_url() ?>Login?section=vote" class="btn btn-black savebtn">Predict now</a>
                        </div>
                        <?php
                }
                ?>
                <div class="forreasonbtn reasonlink hide-on-med-and-down">
                    <a href="<?php echo base_url() ?>Allindia/Reasons/Page/1" class="">Prediction Reasons</a>
                </div>
                <div class="center reasonlink hide-on-large-only pt15">
                    <a href="<?php echo base_url() ?>Allindia/Reasons/Page/1" class="">Prediction Reasons</a>
                </div>
            </div>
        </div>
        <div class="col l4 m12 s12 plr15 equal-height hide-on-med-and-down">
            <div class="card z-depth-4 padd0">
                <div class="card-head">
                    <div class="twitterhead">Rewards</div>
                </div>
                <div class="tweets-container withtable" style="height: 89%;margin-right: 0;"></div>
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
                            foreach ( $blogs as $blog_list ):
                                    if ( ! empty( $blog_list[ 'link' ] ) ) {
                                            if ( preg_match( $reg_exUrl, $blog_list[ 'link' ], $url ) ) {
                                                    $href = $url[ 0 ];
                                                    $target = 'target = "_blank"';
                                            } else {
                                                    $href = base_url() . $blog_list[ 'link' ];
                                                    $target = "";
                                            }
                                    } else {
                                            $title = $blog_list[ 'title' ];
                                            $title = str_replace( '!', ' ', $title );
                                            $title = str_replace( '@', ' ', $title );
                                            $title = str_replace( '#', ' ', $title );
                                            $title = str_replace( '$', ' ', $title );
                                            $title = str_replace( '%', ' ', $title );
                                            $title = str_replace( '^', ' ', $title );
                                            $title = str_replace( '&', ' ', $title );
                                            $title = str_replace( '*', ' ', $title );
                                            $title = str_replace( '(', ' ', $title );
                                            $title = str_replace( ')', ' ', $title );
                                            $title = str_replace( ',', ' ', $title );
                                            $title = str_replace( '.', ' ', $title );
                                            $title = str_replace( ' ', '_', $title );
                                            $href = base_url() . 'Blogs/getBlogs/' . $blog_list[ 'id' ] . '/' . $title;
                                            $target = 'target = "_blank"';
                                    }
                                    echo '<div class="blogs">
                                        <a href="' . $href . '" ' . $target . '>
                                            <div class="row">
                                                <div class="col s5">
                                                    <img src="' . base_url() . 'images/blogs/' . $blog_list[ 'image' ] . '" class="featured-img" style="width: 100%;">
                                                </div>
                                                <div class="col s7">
                                                    <div class="blog-details text-upper">politics</div>
                                                    <div class="blog-title truncate">' . $blog_list[ 'title' ] . '</div>
                                                    <div class="blog-details">' . date( "d F Y", strtotime( $blog_list[ 'created_date' ] ) ) . '</div>
                                                    <div class="blog-author"><a href="">' . $blog_list[ 'name' ] . '</a></a></div>
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
                <div class="tweets-container withtable" style="height: 450px;"></div>
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