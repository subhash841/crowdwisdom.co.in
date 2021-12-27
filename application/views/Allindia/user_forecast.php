<div class="content container"><!--style="margin-top: 100px;"-->
    <div class="row minus-m-t8 mb-12">
        <div class="col l8 s12 plr15 equal-height">
            <form name="user_forecast" id="user_forecast" method="post">
                <div class="card z-depth-4 sm-card">
                    <div class="card-image">
                        <div class="game1 p15 coverleft">
                            <div class="left"><h4 class="mtb5 cardheader blueheader">Your Seat Prediction</h4></div>
                            <?php
                            if ( $is_result_out == "0" ) {
                                    ?>
                                    <div class="right hide-on-med-and-down">
                                        <input class="btn btn-black savebtn" type="submit" name="save_forecast" id="save_forecast" value="Save">
                                    </div>
                                    <?php
                            }
                            ?>
                        </div>
                        <table class="table-forecast">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th style="width: 70%;float: left;">PARTY NAME</th>
                                    <th>NO OF SEATS</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-content withtable">
                        <table class="table-responsive table-forecast" id="game1">
                            <input type="hidden" name="election_period" id="election_period" value="<?= $election_period_id ?>">
                            <input type="hidden" name="election_state" id="election_state" value="<?= $state_id ?>">
                            <tbody>
                                <?php
                                foreach ( $user_forecast as $seat_forecast ) {
                                        echo '<tr>
                                            <td><img src="' . base_url() . 'images/party_logos/' . $seat_forecast[ 'party_icon' ] . '"></td>
                                            <td><h5 class="partyname">' . $seat_forecast[ 'party' ] . '</h5>
                                                <h6 class="caption">' . $seat_forecast[ 'abbreviation' ] . '</h6>
                                            </td>
                                            <td>
                                                <input type="hidden" name="party[]" id="party" value="' . $seat_forecast[ 'party_id' ] . '" />
                                                <input type="text" class="center-align" name="seat_forecast[]" value="' . $seat_forecast[ 'seat_forecast' ] . '" />
                                            </td>
                                        </tr>';
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                    <?php
                    if ( isset( $forecast_reason[ 'reason' ] ) ) {
                            $reason = $forecast_reason[ 'reason' ];
                    } else {
                            $reason = "";
                    }
                    ?>
                    <div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="hidden" name="user_forecast_reason" placeholder="Why do you want to do forecast?" value="<?= htmlspecialchars( $reason ); ?>" />
                            </div>
                        </div>
                    </div>

                    <?php
                    if ( $is_result_out == "0" ) {
                            ?>
                            <div class="hide-on-large-only center-align" style="padding-top: 20px;">
                                <input class="btn btn-black savebtn" type="submit" name="save_forecast" id="save_forecast" value="Save">
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
            </form>
        </div>
        <!--web view Blog-->
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
                                            $spchar = array ( "~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "|", "/", ";", "'", "<", ">",
                                                "," );
                                            $title = str_replace( $spchar, "", $blog_list[ 'title' ] );
                                            $title = str_replace( ' ', '-', $title );
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
    <div class="row"><!-- mb-9-->
        <div class="col l8 s12 plr15 equal-height">
            <form name="user_vote_forecast" id="user_vote_forecast" method="post">
                <div class="card z-depth-4 sm-card">
                    <div class="card-image">
                        <div class="game2 p15 coverleft">
                            <div class="left"><h4 class="mtb5 cardheader blueheader">Your Vote Prediction</h4></div>
                            <?php
                            if ( $is_result_out == "0" ) {
                                    ?>
                                    <div class="right hide-on-med-and-down">
                                        <input class="btn btn-black savebtn" type="submit" name="save_forecast" id="save_forecast" value="Save">
                                    </div>
                                    <?php
                            }
                            ?>
                        </div>
                        <table class="table-forecast">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th style="width: 70%;float: left;">PARTY NAME</th>
                                    <th>PERCENTAGE</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-content withtable">
                        <table class="table-responsive table-forecast" id="game1">
                            <input type="hidden" name="election_period" id="election_period" value="<?= $election_period_id ?>">
                            <input type="hidden" name="election_state" id="election_state" value="<?= $state_id ?>">
                            <tbody>
                                <?php
                                foreach ( $user_forecast as $vote_forecast ) {

                                        echo '<tr>
                                            <td><img src="' . base_url() . 'images/party_logos/' . $vote_forecast[ 'party_icon' ] . '"></td>
                                            <td><h5 class="partyname">' . $vote_forecast[ 'party' ] . '</h5>
                                                <h6 class="caption">' . $vote_forecast[ 'abbreviation' ] . '</h6>
                                            </td>
                                            <td>
                                                <input type="hidden" name="party[]" id="party" value="' . $vote_forecast[ 'party_id' ] . '" />
                                                <input type="text" class="center-align" name="vote_forecast[]" value="' . $vote_forecast[ 'vote_forcast' ] . '" />
                                            </td>
                                        </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    if ( isset( $forecast_reason[ 'reason' ] ) ) {
                            $reason = $forecast_reason[ 'reason' ];
                    } else {
                            $reason = "";
                    }
                    ?>
                    <div >
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="hidden" name="user_forecast_reason" placeholder="Why do you want to do forecast?" value="<?= htmlspecialchars( $reason ) ?>" />
                            </div>
                        </div>
                    </div>
                    <?php
                    if ( $is_result_out == "0" ) {
                            ?>
                            <div class="hide-on-large-only center-align" style="padding-top: 20px;">
                                <input class="btn btn-black savebtn" type="submit" name="save_forecast" id="save_forecast" value="Save">
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
            </form>
        </div>
        <!--web view tweets-->
        <div class="col l4 s12 plr15 equal-height hide-on-med-and-down">
            <div class="card z-depth-4 padd0">
                <div class="card-head">
                    <div class="twitterhead">Rewards</div>
                </div>
                <div class="tweets-container withtable"  style="height: 89%;margin-right: 0;"></div>
            </div>
        </div>
    </div>
    <div class="row" id="forecast_reason" class="forecast_reason mobileview">
        <div class="col s12 plr15 equal-height">
            <div class="card z-depth-4 sm-card">
                <input type="hidden" name="is_seat_forecast" id="is_seat_forecast" value="0" />
                <input type="hidden" name="is_vote_forecast" id="is_vote_forecast" value="0" />
                <?php
                if ( isset( $forecast_reason[ 'reason' ] ) ) {
                        $reason = $forecast_reason[ 'reason' ];
                } else {
                        $reason = "";
                }
                ?>
                <div class="textareabox">
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="update_user_forecast_reason" name="update_user_forecast_reason" minlength="20" maxlength="300" placeholder="What are the reasons for your forecast?"class="materialize-textarea" rows="4"><?= htmlspecialchars( $reason ) ?></textarea>
                            <label for="textarea1">Prediction Reason</label>
                        </div>
                    </div>
                </div>
                <?php
                if ( $is_result_out == "0" ) {
                        ?>
                        <div class="center-align" style="padding-top: 20px;">
                            <input class="btn btn-black savebtn" type="submit" name="save_forecast_reason" id="save_forecast_reason" value="Save">
                        </div>
                        <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <!--Mobile view Blog-->
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
                                            $spchar = array ( "~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "|", "/", ";", "'", "<", ">",
                                                "," );
                                            $title = str_replace( $spchar, "", $blog_list[ 'title' ] );
                                            $title = str_replace( ' ', '-', $title );
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
        <!--Mobile view Tweets-->
        <div class="col l4 s12 plr15 equal-height hide-on-large-only">
            <div class="card z-depth-4 padd0">
                <div class="card-head">
                    <div class="twitterhead">Rewards</div>
                </div>
                <div class="tweets-container withtable" style="height:450px;"></div>
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
<?php if ( $this -> input -> get( 'section' ) == 'seat' ): ?>
                    var gotodo = $('#user_forecast').offset().top - $('.nav-wrapper.container').height();
                    $("html, body").animate({scrollTop: gotodo}, 1000);
<?php elseif ( $this -> input -> get( 'section' ) == 'vote' ): ?>
                    var gotodo = $('#user_vote_forecast').offset().top - $('.nav-wrapper.container').height();
                    $("html, body").animate({scrollTop: gotodo}, 1000);
<?php endif; ?>
            var seat_forecast = 0;
            $('input[name^="seat_forecast"]').each(function () {
                seat_forecast += parseInt($(this).val());
            });

            if (seat_forecast == <?= $total_seats ?> || seat_forecast == "<?= $total_seats ?>") {
                $("#is_seat_forecast").val("0");
            } else {
                $("#is_seat_forecast").val("");
            }
            var vote_forecast = 0;
            $('input[name^="vote_forecast"]').each(function () {
                vote_forecast += parseInt($(this).val());
            })

            if (vote_forecast == 100 || vote_forecast == "100") {
                $("#is_vote_forecast").val("0");
            } else {
                $("#is_vote_forecast").val("");
            }

            $("#update_user_forecast_reason").on('keyup change', function () {
                var reason = $(this).val();
                $('[name="user_forecast_reason"]').val(reason);
            });

            $('#user_forecast').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    "url": "Dashboard/updateUserForecast",
                    "method": "POST",
                    "data": $(this).serialize()
                }).done(function (result) {
                    result = JSON.parse(result);

                    if (result.status) {

                        $("#is_seat_forecast").val("0");
                        Materialize.Toast.removeAll();
                        Materialize.toast(result.message + '!', 4000);
                        var is_seat_forecast = $("#is_seat_forecast").val();
                        var is_vote_forecast = $("#is_vote_forecast").val();
                        if (is_seat_forecast == "0" || is_vote_forecast == "0") {
                            setTimeout(function () {
                                window.location.assign("../Allindia/Reasons/Page/1");
                            }, 1000);
                        }
                        //setTimeout(function () {
                        //window.location.assign("Dashboard");
                        //var gotogame2 = $('#user_vote_forecast').offset().top - $('.nav-wrapper.container').height();
                        //$("html, body").animate({scrollTop: gotogame2}, 1000);
                        //}, 1000);
                    } else {
                        if (result.data == "1") {
                            //$("#is_seat_forecast").val("1");
                            var gotoreason = $("#forecast_reason").offset().top - $('.nav-wrapper.container').height();
                            $("html, body").animate({scrollTop: gotoreason}, 1000);
                        }
                        $("#is_seat_forecast").val("");
                        Materialize.Toast.removeAll();
                        Materialize.toast(result.message + '!', 4000);
                    }
                });
            });

            $("#user_vote_forecast").on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    "url": "Dashboard/updateUserForecast",
                    "method": "POST",
                    "data": $(this).serialize()
                }).done(function (result) {
                    result = JSON.parse(result);
                    if (result.status) {
                        $("#is_vote_forecast").val("0");
                        Materialize.Toast.removeAll();
                        Materialize.toast(result.message + '!', 4000);
                        var is_seat_forecast = $("#is_seat_forecast").val();
                        var is_vote_forecast = $("#is_vote_forecast").val();
                        if (is_seat_forecast == "0" || is_vote_forecast == "0") {
                            setTimeout(function () {
                                window.location.assign("../Allindia/Reasons/Page/1");
                            }, 1000);
                        }
                    } else {
                        if (result.data == "2") {
                            //$("#is_vote_forecast").val("2");
                            var gotoreason = $("#forecast_reason").offset().top - $('.nav-wrapper.container').height();
                            $("html, body").animate({scrollTop: gotoreason}, 1000);
                        }
                        $("#is_vote_forecast").val("");
                        Materialize.Toast.removeAll();
                        Materialize.toast(result.message + '!', 4000);
                    }
                });
            });

            //Save forecast with reason
            $("#save_forecast_reason").on("click", function () {
                var is_seat_forecast = $("#is_seat_forecast").val();
                var is_vote_forecast = $("#is_vote_forecast").val();

                if ($('#update_user_forecast_reason').val() != "") {
                    if ($.trim($('#update_user_forecast_reason').val()).length < 20) {
                        Materialize.Toast.removeAll();
                        Materialize.toast("Minimum 20 characters ", 4000);
                        $('[name="update_user_forecast_reason"]').val('');
                        return false;
                    }
                    if (is_seat_forecast == "" && is_vote_forecast == "0") {
                        $('#user_forecast').submit();
                    } else if (is_seat_forecast == "0" && is_vote_forecast == "") {
                        $("#user_vote_forecast").submit();
                    } else if (is_seat_forecast == "0" && is_vote_forecast == "0") {
                        setTimeout(function () {
                            window.location.assign("../Allindia/Reasons/Page/1");
                        }, 1000);
                    } else {
                        if (is_seat_forecast == "") {
                            $('#user_forecast').submit();
                            return false;
                        }
                        if (is_vote_forecast == "") {
                            $("#user_vote_forecast").submit();
                            return false;
                        }
                        $('#user_forecast').submit();
                        $("#user_vote_forecast").submit();
                    }
                } else {
                    var seat_forecast = 0;
                    $('input[name^="seat_forecast"]').each(function () {
                        seat_forecast += parseInt($(this).val());
                    })

                    var vote_forecast = 0;
                    $('input[name^="vote_forecast"]').each(function () {
                        vote_forecast += parseInt($(this).val());
                    })
                    if (seat_forecast != <?= $total_seats ?>) {
                        Materialize.Toast.removeAll();
                        Materialize.toast("Total must add upto <?= $total_seats ?>.!", 4000);
                        var gotodo = $('#user_forecast').offset().top - $('.nav-wrapper.container').height();
                        $("html, body").animate({scrollTop: gotodo}, 1000);
                    } else if (vote_forecast != 100) {
                        Materialize.Toast.removeAll();
                        Materialize.toast("Total must add upto 100%.", 4000);
                        var gotodo = $('#user_vote_forecast').offset().top - $('.nav-wrapper.container').height();
                        $("html, body").animate({scrollTop: gotodo}, 1000);
                    } else {
                        $("#is_seat_forecast").val("");
                        Materialize.Toast.removeAll();
                        Materialize.toast("Please select reason", 4000);
                    }

                }

//            } else {
//                //submit seat forecast form
//                $('#user_forecast').submit();
//                $("#user_vote_forecast").submit();
//                setTimeout(function () {
//                    window.location.assign("../Allindia/Reasons");
//                },3000);
//            }
            });
            $(document).on('change', '#update_user_forecast_reason', function () {
                $("#is_seat_forecast").val("");
            })

            $(document).on('change', 'input[name^="seat_forecast"]', function () {
                $("#is_seat_forecast").val("");
            })
            $(document).on('change', 'input[name^="vote_forecast"]', function () {
                $("#is_vote_forecast").val("");
            })
            $(".party-img").on('click', function () {
                $(".party-div").removeClass("selected");
                $("input[name=select_constituency]").removeAttr("checked");

                $(this).closest(".col").find(".party-div").addClass("selected");
                $(this).closest(".col").find("input[name=select_constituency]").attr("checked", "checked");
            });
        });
</script>