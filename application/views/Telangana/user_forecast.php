<link href="<?= base_url(); ?>css/style.css?v=1.7" rel="stylesheet" />
<div class="content px-0 container"><!--style="margin-top: 100px;"-->
    <div class="row minus-m-t20 ">
        <div class="col-md-9 l8 s12 plr15 equal-height">
            <form name="user_forecast" id="user_forecast" method="post" autocomplete="off">
                <div class="card cust-border-7 z-depth-4 sm-card">
                    <div class="card-image">
                        <div class="game1 p15 coverleft">
                            <div class="float-left"><h4 class="mtb5 cardheader blueheader">Your Seat Prediction</h4></div>
                            <?php
                            if ( $is_result_out == "0" ) {
                                    ?>
                                    <div class="float-right hide-on-med-and-down d-none d-md-block">
                                        <input class="btn lg btn-outline-primary btn-primary rounded-btn mx-auto py-0 savebtn save-seat-vote-forecast" type="button" name="save_forecast" id="save_forecast" value="Save"> <!--type="submit"-->
                                    </div>
                                    <?php
                            }
                            ?>
                        </div>
                        <table class="table-forecast w-100">
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
                                        $party = ($seat_forecast[ 'local_lang' ] == "") ? $seat_forecast[ 'party' ] : $seat_forecast[ 'local_lang' ];
                                        echo '<tr>
                                            <td><img src="' . base_url() . 'images/party_logos/' . $seat_forecast[ 'party_icon' ] . '"></td>
                                            <td><h5 class="partyname">' . $party . '</h5>
                                                <h6 class="caption">' . $seat_forecast[ 'abbreviation' ] . '</h6>
                                            </td>
                                            <td>
                                                <input type="hidden" name="party[]" id="party" value="' . $seat_forecast[ 'party_id' ] . '" />
                                                <input type="text" class="text-center cust-input-text" name="seat_forecast[]" value="' . $seat_forecast[ 'seat_forecast' ] . '" />
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
                            <div class="hide-on-large-only text-center d-lg-none" style="padding-top: 20px;">
                                <input class="btn lg btn-outline-primary btn-primary rounded-btn mx-auto py-0 savebtn save-seat-vote-forecast" type="button" name="save_forecast" id="save_forecast" value="Save"><!--type="submit" -->
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
            </form>
        </div>
        <!--web view Blog-->
        <div class="col-md-3 l4 m12 s12 px-md-0 equal-height hide-on-med-and-down d-none d-md-block ">
            <div class="card cust-border-7 cust-border-7 z-depth-4 padd0 overflow-hidden-x">
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
    <div class="row"><!-- mb-9-->
        <div class="col-md-9 l8 s12 plr15 equal-height">
            <form name="user_vote_forecast" id="user_vote_forecast" method="post" autocomplete="off">
                <div class="card cust-border-7 z-depth-4 sm-card mt-0">
                    <div class="card-image">
                        <div class="game2 p15 coverleft">
                            <div class="float-left"><h4 class="mtb5 cardheader blueheader">Your Vote Prediction</h4></div>
                            <?php
                            if ( $is_result_out == "0" ) {
                                    ?>
                                    <div class="float-right hide-on-med-and-down d-none d-md-block">
                                        <input class="btn lg btn-outline-primary btn-primary rounded-btn mx-auto py-0 savebtn save-seat-vote-forecast" type="button" name="save_forecast" id="save_forecast" value="Save"><!--type="submit" -->
                                    </div>
                                    <?php
                            }
                            ?>
                        </div>
                        <table class="table-forecast w-100">
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
                                        $party = ($vote_forecast[ 'local_lang' ] == "") ? $vote_forecast[ 'party' ] : $vote_forecast[ 'local_lang' ];
                                        echo '<tr>
                                            <td><img src="' . base_url() . 'images/party_logos/' . $vote_forecast[ 'party_icon' ] . '"></td>
                                            <td><h5 class="partyname">' . $party . '</h5>
                                                <h6 class="caption">' . $vote_forecast[ 'abbreviation' ] . '</h6>
                                            </td>
                                            <td>
                                                <!--<input type="hidden" name="party[]" id="party" value="' . $vote_forecast[ 'party_id' ] . '" />-->
                                                <input type="text" class="text-center cust-input-text" name="vote_forecast[]" value="' . $vote_forecast[ 'vote_forcast' ] . '" />
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
                            <div class="hide-on-large-only text-center d-lg-none" style="padding-top: 20px;">
                                <input class="btn lg btn-outline-primary btn-primary rounded-btn mx-auto py-0 savebtn save-seat-vote-forecast" type="button" name="save_forecast" id="save_forecast" value="Save"><!--type="submit" -->
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
            </form>
        </div>
        <div class="col-md-3 l4 m12 s12 px-md-0 equal-height hide-on-med-and-down  d-none d-md-block">

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
        <!--web view tweets-->
        <!--<div class="col l4 s12 plr15 equal-height hide-on-med-and-down">
            <div class="card cust-border-7 z-depth-4 padd0">
                <div class="card-head">
                    <div class="twitterhead">Rewards</div>
                </div>
                <div class="tweets-container withtable"  style="height: 89%;margin-right: 0;"></div>
            </div>
        </div>-->
    </div>
    <div class="row" id="forecast_reason" class="forecast_reason mobileview">
        <div class="col s12 pr-md-0 equal-height">
            <div class="card cust-border-7 z-depth-4 sm-card cust-border-7 h-auto mt-0">
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
                            <textarea id="update_user_forecast_reason" name="update_user_forecast_reason" minlength="20" maxlength="300" placeholder="What are the reasons for your forecast?"class="materialize-textarea cust-textarea-input my-3" rows="4"><?= htmlspecialchars( $reason ) ?></textarea>
                            <label for="textarea1">Prediction Reason</label>
                        </div>
                    </div>
                </div>
                <?php
                if ( $is_result_out == "0" ) {
                        ?>
                        <div class="text-center" style="padding-top: 20px;">
                            <input class="btn lg btn-outline-primary btn-primary rounded-btn mx-auto py-0 savebtn save-seat-vote-forecast" type="submit" name="save_forecast_reason" id="save_forecast_reason" value="Save">
                        </div>
                        <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <!--Mobile view Blog-->
        <div class="col l4 m12 s12 plr15 equal-height hide-on-large-only d-lg-none">
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
        <div class="col-md-3 l4 m12 s12 px-md-0 equal-height hide-on-med-and-down d-lg-none ">

            <div class="card cust-border-7 cust-border-7 z-depth-4 padd0 overflow-hidden-x mt-0">
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

    <div id="alert_placeholder" class="fixed-bottom mx-auto col-md-5 col mb-4 text-center"></div>
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
            var user_location = "<?= $_SESSION[ 'data' ][ 'location' ]; ?>";

            $("a.head-login").attr("href", "<?= base_url() ?>Login?section=seat&e=tel");
            $("a.head-logout").attr("href", "<?= base_url() ?>Login/logout/tel");


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
            });

            if (vote_forecast == 100 || vote_forecast == "100") {
                $("#is_vote_forecast").val("0");
            } else {
                $("#is_vote_forecast").val("");
            }

            $("#update_user_forecast_reason").on('keyup change', function () {
                var reason = $(this).val();
                $('[name="user_forecast_reason"]').val(reason);
            });


            $(".save-seat-vote-forecast").on("click", function (e) {
                //e.preventDefault();
                var seat_sum = 0;
                var vote_sum = 0;
                var reason = $("#update_user_forecast_reason").val();
                var election_period = $("#election_period").val();
                var election_state = $("#election_state").val();
                var seat_forecast = [];
                var vote_forecast = [];
                var party = [];

                console.log(user_location);

                $('input[name^="seat_forecast"]').each(function () {
                    seat_sum += parseInt($(this).val());
                    seat_forecast.push($(this).val())
                });

                $('input[name^="vote_forecast"]').each(function () {
                    vote_sum += parseInt($(this).val());
                    vote_forecast.push($(this).val())
                });

                $('input[name^="party"]').each(function () {
                    party.push($(this).val())
                });
                function showalert(message, alerttype) {
                    $('#alert_placeholder').fadeIn('fast');
                    $('#alert_placeholder').html("<div class ='alert alert-" + alerttype + "' >" + message + "<button type='button' class='close' data-dismiss='alert' aria-label='close'><span aria-hidden='true'>&times</span></button></div> ");
                    setTimeout(function () {
                        $('#alert_placeholder').fadeOut('fast');
                    }, 3000);
                }
                if (user_location == "") {

                    showalert("Please complete your profile first", 'danger');
                    setTimeout(function () {
                        window.location.assign("<?= base_url() ?>Profile");
                    }, 1000);

                } else if (seat_sum !=<?= $total_seats ?>) {
                    var gotodo = $('#user_forecast').offset().top - $('.nav-wrapper.container').height();
                    $("html, body").animate({scrollTop: gotodo}, 1000);
                    showalert("Your score is " + seat_sum + ". Total must add upto <?= $total_seats ?>.", 'danger');
                } else if (vote_sum != 100) {
                    var gotodo = $('#user_vote_forecast').offset().top - $('.nav-wrapper.container').height();
                    $("html, body").animate({scrollTop: gotodo}, 1000);
                    showalert("Your score is " + vote_sum + ". Total must add upto 100%.", 'danger');
                } else if (reason == "") {
                    var gotoreason = $("#forecast_reason").offset().top - $('.nav-wrapper.container').height();
                    $("html, body").animate({scrollTop: gotoreason}, 1000);
                    showalert("Please provide reason below", 'danger');
                } else if ($.trim($('#update_user_forecast_reason').val()).length < 20) {
                    showalert("Reason should be Minimum 20 characters", 'danger');
                } else {
                    var data = {election_period: election_period, election_state: election_state, user_forecast_reason: reason, party: party, seat_forecast: seat_forecast, vote_forecast: vote_forecast};

                    $.ajax({
                        url: "Dashboard/updateUserForecast",
                        method: "POST",
                        data: data
                    }).done(function (result) {
                        result = JSON.parse(result);

                        if (result.status) {

                            showalert("Thanks for Sharing your prediction.", 'danger');
                            setTimeout(function () {
                                window.location.assign("../Telangana/Home?a=1537522851");
                            }, 1000);
                        }
                    });
                }
            });

            /*$('#user_forecast').on('submit', function (e) {
             e.preventDefault();
             
             $.ajax({
             "url": "Dashboard/updateUserForecast",
             "method": "POST",
             "data": $(this).serialize()
             }).done(function (result) {
             result = JSON.parse(result);
             
             if (result.status) {
             
             $("#is_seat_forecast").val("0");
             
             showalert(result.message + '!', 4000);
             var is_seat_forecast = $("#is_seat_forecast").val();
             var is_vote_forecast = $("#is_vote_forecast").val();
             if (is_seat_forecast == "0" || is_vote_forecast == "0") {
             setTimeout(function () {
             window.location.assign("../Telangana/Reasons/Page/1");
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
             
             showalert(result.message + '!', 4000);
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
             
             showalert(result.message + '!', 4000);
             var is_seat_forecast = $("#is_seat_forecast").val();
             var is_vote_forecast = $("#is_vote_forecast").val();
             if (is_seat_forecast == "0" || is_vote_forecast == "0") {
             setTimeout(function () {
             window.location.assign("../Telangana/Reasons/Page/1");
             }, 1000);
             }
             } else {
             if (result.data == "2") {
             //$("#is_vote_forecast").val("2");
             var gotoreason = $("#forecast_reason").offset().top - $('.nav-wrapper.container').height();
             $("html, body").animate({scrollTop: gotoreason}, 1000);
             }
             $("#is_vote_forecast").val("");
             
             showalert(result.message + '!', 4000);
             }
             });
             });*/
//        $("#save_forecast_reason").on("click", function () {
//            if ($('#update_user_forecast_reason').val() != "") {
//                if ($.trim($('#update_user_forecast_reason').val()).length < 20) {
//                    
//                    showalert("Minimum 20 characters ", 4000);
//                    $('[name="update_user_forecast_reason"]').val('');
//                    return false;
//                } else {
//                    var election_period = $("#election_period").val();
//                    var election_state = $("#election_state").val();
//                    var seat_forecast = $('input[name^="seat_forecast"]');
//                    var vote_forecast = $('input[name^="vote_forecast"]');
//                    var reason = $.trim($('#update_user_forecast_reason').val());
//
//                    var data = {election_period: election_period, election_state: election_state, user_forecast_reason: reason, seat_forecast: seat_forecast, vote_forecast: vote_forecast};
//                    $.ajax({
//                        url: "Dashboard/updateUserForecast",
//                        method: "POST",
//                        data: data
//                    }).done(function (result) {
//                        result = JSON.parse(result);
//
//                        if (result.status) {
//                            console.log(result);
//                        }
//                    });
//                }
//            } else {
//                
//                showalert("Please provide reason", 4000);
//            }
//        });
            //Save forecast with reason        
            /*$("#save_forecast_reason").on("click", function () {
             var is_seat_forecast = $("#is_seat_forecast").val();
             var is_vote_forecast = $("#is_vote_forecast").val();
             
             if ($('#update_user_forecast_reason').val() != "") {
             if ($.trim($('#update_user_forecast_reason').val()).length < 20) {
             
             showalert("Minimum 20 characters ", 4000);
             $('[name="update_user_forecast_reason"]').val('');
             return false;
             }
             if (is_seat_forecast == "" && is_vote_forecast == "0") {
             $('#user_forecast').submit();
             } else if (is_seat_forecast == "0" && is_vote_forecast == "") {
             $("#user_vote_forecast").submit();
             } else if (is_seat_forecast == "0" && is_vote_forecast == "0") {
             setTimeout(function () {
             window.location.assign("../Telangana/Reasons/Page/1");
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
             
             showalert("Total must add upto <?= $total_seats ?>.!", 4000);
             var gotodo = $('#user_forecast').offset().top - $('.nav-wrapper.container').height();
             $("html, body").animate({scrollTop: gotodo}, 1000);
             } else if (vote_forecast != 100) {
             
             showalert("Total must add upto 100%.", 4000);
             var gotodo = $('#user_vote_forecast').offset().top - $('.nav-wrapper.container').height();
             $("html, body").animate({scrollTop: gotodo}, 1000);
             } else {
             $("#is_seat_forecast").val("");
             
             showalert("Please select reason", 4000);
             }
             
             }
             
             //            } else {
             //                //submit seat forecast form
             //                $('#user_forecast').submit();
             //                $("#user_vote_forecast").submit();
             //                setTimeout(function () {
             //                    window.location.assign("../Telangana/Reasons");
             //                },3000);
             //            }
             });*/
            $(document).on('change', '#update_user_forecast_reason', function () {
                $("#is_seat_forecast").val("");
            })

            $(document).on('change', 'input[name^="seat_forecast"]', function () {
                $("#is_seat_forecast").val("");
            })
            $(document).on('change', 'input[name^="vote_forecast"]', function () {
                $("#is_vote_forecast").val("");
            });
        });
</script>