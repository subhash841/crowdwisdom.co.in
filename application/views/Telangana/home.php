<link href="<?= base_url(); ?>css/style.css?v=1.7" rel="stylesheet" />
<div class="content container px-0">
    <div class="row minus-m-t20"><!--minus-m-t13-->
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
                            </div>
                        </div>
                    </div>-->
                </a>
                <?php
        }
        ?>
        <div class="col-md-9  l8 m12 s12 plr15 equal-height">
            <div class="card cust-border-7 z-depth-4">
                <div class="card-image">
                    <div class="game1 p15 coverleft">
                        <div class="float-left"><h4 class="cardheader blueheader">Current Seat Prediction</h4></div>
                        <?php
                        if ( $is_result_out == "0" ) {
                                ?>
                                <div class="float-right hide-on-med-and-down d-none d-md-block">
                                    <a href="<?php echo base_url() ?>Login?section=seat&e=tel" class="btn lg btn-outline-primary btn-primary rounded-btn mx-auto py-0 savebtn">ఇక్కడ క్లిక్ చేయండి</a>
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
                                $party = ($avg_forecast[ 'local_lang' ] == "") ? $avg_forecast[ 'party_name' ] : $avg_forecast[ 'local_lang' ];
                                echo '<div class="col-md-6 s12 l6 mb-4" data-n="' . $n . '">
                                        <div class="row">
                                            <div class="col-3 s3 equal-height-child"><img src="' . base_url() . 'images/party_logos/' . $avg_forecast[ 'icon' ] . '" style="width: 68px;" class="forecast-result-logo"></div>
                                            <div class="col-8 s8 equal-height-child"><!--s3-->
                                                <div class="" style="margin: 10px;">
                                                    <div class="vfparty">' . $party . '</div>
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
                        <div class="hide-on-large-only text-center d-lg-none" style="padding-top: 20px;">
                            <a href="<?php echo base_url() ?>Login?section=seat&e=tel" class="btn lg btn-outline-primary btn-primary rounded-btn mx-auto py-0 savebtn">ఇక్కడ క్లిక్ చేయండి</a>
                        </div>
                        <?php
                }
                ?>
                <!--<div class="forreasonbtn reasonlink hide-on-med-and-down">
                    <a href="<?php echo base_url() ?>Telangana/Reasons/Page/1" class="">Prediction Reasons</a>
                </div>
                <div class="center reasonlink hide-on-large-only pt15">
                    <a href="<?php echo base_url() ?>Telangana/Reasons/Page/1" class="">Prediction Reasons</a>
                </div>-->
            </div>
        </div>
        <div class="col-md-3 l4 m12 s12 px-0 equal-height hide-on-med-and-down  d-none d-md-block ">
            <div class="card cust-border-7 z-depth-4 padd0 overflow-hidden-x">
                <div>
                    <h4 class="d-block text-center mt-3">आपकी आवाज</h4>
                    <div  class="your_voice_holder article-list "></div>
                </div>
                <div class="my-3 load-btn-holder mt-4 text-center">
                    <a href="#" class="btn btn-outline-primary  your_voice_holder-readmore rounded-btn load-more z-depth-2">Read more</a>

                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-9 l8 m12 s12 plr15 equal-height">
            <div class="card cust-border-7 z-depth-4 mt-0">
                <div class="card-image">
                    <div class="game1 p15 coverleft">
                        <div class="float-left"><h4 class="cardheader blueheader">Current Vote Prediction</h4></div>
                        <?php
                        if ( $is_result_out == "0" ) {
                                ?>
                                <div class="float-right hide-on-med-and-down d-none d-md-block">
                                    <a href="<?php echo base_url() ?>Login?section=vote&e=tel" class="btn lg btn-outline-primary btn-primary rounded-btn mx-auto py-0 savebtn">ఇక్కడ క్లిక్ చేయండి</a>
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
                                $party = ($avg_forecast[ 'local_lang' ] == "") ? $avg_forecast[ 'party_name' ] : $avg_forecast[ 'local_lang' ];
                                echo '<div class="col-md-6 s12 l6 mb-4" data-n="' . $n . '">
                                        <div class="row">
                                            <div class="col-3 s3 equal-height-child"><img src="' . base_url() . 'images/party_logos/' . $avg_forecast[ 'icon' ] . '" style="width: 68px;" class="forecast-result-logo"></div>
                                            <div class="col-8 s8 equal-height-child"><!--s3-->
                                                <div class="forecast-result-percent" style="margin: 10px;">
                                                    <div class="vfparty">' . $party . '</div>
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
                        <div class="hide-on-large-only text-center d-lg-none" style="padding-top: 20px;">
                            <a href="<?php echo base_url() ?>Login?section=vote&e=tel" class="btn lg btn-outline-primary btn-primary rounded-btn mx-auto py-0 savebtn">ఇక్కడ క్లిక్ చేయండి</a>
                        </div>
                        <?php
                }
                ?>
                <!--<div class="forreasonbtn reasonlink hide-on-med-and-down">
                    <a href="<?php echo base_url() ?>Telangana/Reasons/Page/1" class="">Prediction Reasons</a>
                </div>
                <div class="center reasonlink hide-on-large-only pt15">
                    <a href="<?php echo base_url() ?>Telangana/Reasons/Page/1" class="">Prediction Reasons</a>
                </div>-->
            </div>
        </div>
        <!--<div class="col l4 m12 s12 plr15 equal-height hide-on-med-and-down">
            <div class="card cust-border-7 z-depth-4 padd0">
                <div class="card-head">
                    <div class="twitterhead">Rewards</div>
                </div>
                <div class="tweets-container withtable" style="height: 89%;margin-right: 0;"></div>
            </div>
        </div>-->
        <div class="col-md-3 l4 m12 s12 px-md-0 equal-height hide-on-med-and-down  ">

            <div class="card cust-border-7 z-depth-4 padd0 overflow-hidden-x mt-0">
                <div>
                    <h4 class="d-block text-center mt-3">वेब से</h4>
                    <div  class="rated_articles_holder article-list "></div>
                </div>
                <div class="my-3 load-btn-holder mt-4 text-center">
                    <a href="#" class="btn btn-outline-primary  rated_articles_holder-readmore rounded-btn load-more z-depth-2">Read more</a>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-3 l4 m12 s12 plr15 equal-height hide-on-large-only d-lg-none">
            <div class="card cust-border-7 z-depth-4 padd0 overflow-hidden-x">
                <div>
                    <h4 class="d-block text-center mt-3">आपकी आवाज</h4>
                    <div  class="your_voice_holder article-list "></div>
                </div>
                <div class="my-3 load-btn-holder mt-4 text-center">
                    <a href="#" class="btn btn-outline-primary  your_voice_holder-readmore rounded-btn load-more z-depth-2">Read more</a>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="col l4 m12 s12  equal-height px-0 mb-3">
                <div class=" z-depth-4 padd0  bg-w-block">
                    <div class="d-flex py-3 cust-heading">
                        <div class="col-md-4"><h4>Trending <b>Questions</b></h4></div>
                        <div class="col-md-8"><hr></div>
                    </div>
                    <div class=" col">
                        <div class="h-list-detail cust-overflow-scroll">
                            <div class="questions-list  row h-list" style="width: 3810px;" >


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col l4 m12 s12  equal-height px-0 mb-3">
                <div class=" z-depth-4 padd0  bg-w-block">
                    <div class="d-flex py-3 cust-heading">
                        <div class="col-md-4"><h4>Trending  <b>Predictions</b></h4></div>
                        <div class="col-md-8"><hr></div>
                    </div>

                    <div class=" col">
                        <div class="h-list-detail cust-overflow-scroll">
                            <div class="predictions-list  row h-list" >


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
<?= "var base_url='" . base_url() . "';"; ?>
            $(function () {
                get_your_voice('your_voice_holder', 'voices', 'YourVoice/blog_detail/');
                get_your_voice('rated_articles_holder', 'rated_articles', 'RatedArticle/details/');

                function get_your_voice(selector, api, q, offsetdata = 0) {
                    $.ajax({
                        url: base_url + "Common/get_trending_" + api + "",
                        method: "POST",
                        data: {offset: offsetdata, notin: 0}
                    })
                            .done(function (e) {
                                $('.' + selector + '-readmore').attr('data-offset', e.data.length);
                                for (var key in e.data) {
                                    var slug = create_slug(e.data[key].title);
                                    if (e.data.hasOwnProperty(key)) {
                                        $('.' + selector + '').append('<div class="col blog-list-item">\n\
<a href="' + base_url + q + e.data[key].id + '/' + slug + '" class="d-block pb-3" ><div class="voiceimg p-5" style="background: url(' + e.data[key].image + ')  no-repeat center center;"></div><small class="category">' + e.data[key].category + '</small><h6>' + e.data[key].title + '</h6><small class="likes">' + e.data[key].total_likes + ' Likes &nbsp;&nbsp;&nbsp;&nbsp; ' + e.data[key].total_views + ' Views &nbsp;&nbsp;&nbsp;&nbsp;' + e.data[key].total_like_comment + ' Comments</small></a></div>');
                                        if (e.is_available == '1') {
                                            $('.' + selector + '-readmore').removeClass('d-none');
                                        } else {
                                            $('.' + selector + '-readmore').addClass('d-none');
                                        }
                                    }
                                }
                            });
                }

                $('.your_voice_holder-readmore').click(function (e) {
                    get_your_voice('your_voice_holder', 'voices', 'YourVoice/blog_detail/', $(this).attr('data-offset'));
                });
                $('.rated_articles_holder-readmore').click(function (e) {
                    get_your_voice('rated_articles_holder', 'rated_articles', 'RatedArticle/details/', $(this).attr('data-offset'));
                });

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
                    var div = $("<div />", {class: "col-md-4 blog-list-item"})
                    var a = $("<a/>", {
                        href: base_url + q + data.id + '/' + slug,
                        class: "d-block pb-3",
                        "data-content": "Most Popular Blog"
                    })

                    var blogimg = $("<div />", {
                        class: "voiceimg p-5",
                        style: "background: url('" + data.image + "')  no-repeat center center; background-size:cover"
                    });
                    var likes = $("<small />", {class: "likes "}).html(total_likes + " Likes &nbsp;&nbsp;&#9679;&nbsp;&nbsp; " + total_views + " Views &nbsp;&nbsp;&#9679;&nbsp;&nbsp; " + total_comments + " Comments")
                    var category = $("<small />", {class: "category"}).html(data.category);
                    var title = $('<h6 />').html(data.title);

                    a.append(blogimg).append(title).append(likes)

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
            $("a.head-login").attr("href", "<?= base_url() ?>Login?section=seat&e=tel");
            $("a.head-logout").attr("href", "<?= base_url() ?>Login/logout/tel");
        });
</script>
