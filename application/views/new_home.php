<style>
    @media(max-width: 600px)
    {
        .heading,.sub-heading,.how-it-works
        {
            text-align: center;
        }
    }
    .heading
    {
        font-size: 16px !important;
        font-weight: 500 !important;
        margin-top: 20px;
        font-size:18px;
        font-weight: 600;
    }
    .sub-heading{
        font-size: 14px;
        color: rgba(49, 50, 55, 0.34) !important;

    }
    .parent-height
    {
        height: inherit;
        margin: 0 auto;
        display: block;
    }
    .float-left
    {
        float: left!important;
    }
    .float-right
    {
        float: right !important;
    }
    .pad-top-15
    {
        padding-top: 25px;
    }
    .card .card-content p {
        font-weight: 500;
    }
</style>
<!--<div class="banner white">
    <div class="bannercontent" style="max-width: none;">
        <div class="hands"><img src="<?= base_url('/images/banners/icon.png'); ?>"/></div>
        <h4 class="banner-title">Predict for yourself. Get the closest prediction</h4>
        <h6 class="banner_desc">Get the effective answers on the Prediction you create</h6>
        <a href="<?= base_url() ?>Poll" class="btn btn-black savebtn">Ask a Question</a>
    </div>
</div>-->
<div class="content container">
    <div class="row" style="margin-top: 5%;"><!--minus-m-t8-->
        <div class="col s12 m6 l3 xl3 category-cards">
            <a href="<?= base_url() ?>Poll?ct=Governance">
                <div class="card election_card"> <!--blue-grey darken-1-->
                    <div class="card-content white-text">
                        <span class="card-title title center-align">Elections</span>
                        <p class="center-align">Predict the Results of the Latest Election and Economic Results</p>
                    </div>
                    <div class="card-image">
                        <img src="<?= base_url('images/banners/governance.png'); ?>">
                    </div>
                </div>
            </a>
        </div>
        <div class="col s12 m6 l3 xl3 category-cards">
            <a href="<?= base_url() ?>Poll?ct=Money">
                <div class="card money_card">
                    <div class="card-content white-text">
                        <span class="card-title title center-align">Money</span>
                        <p class="center-align">Predict the Performance of Mutual Funds and Stocks</p>
                    </div>
                    <div class="card-image">
                        <img src="<?= base_url('images/banners/stock.png'); ?>">
                    </div>
                </div>
            </a>
        </div>
        <div class="col s12 m6 l3 xl3 category-cards">
            <a href="<?= base_url() ?>Poll?ct=Sports">
                <div class="card sport_card">
                    <div class="card-content white-text">
                        <span class="card-title title center-align">Sports</span>
                        <p class="center-align">Predict the Performance of the Latest Matches (All Sports)</p>
                    </div>
                    <div class="card-image">
                        <img src="<?= base_url('images/banners/sports.png'); ?>">
                    </div>
                </div>
            </a>           
        </div>
        <div class="col s12 m6 l3 xl3 category-cards">
            <a href="<?= base_url() ?>Poll?ct=Entertainment">
                <div class="card entertainment_card">
                    <div class="card-content white-text">
                        <span class="card-title title center-align">Entertainment</span>
                        <p class="center-align">Predict the Performance of the Latest Movies (all languages)</p>
                    </div>
                    <div class="card-image">
                        <img src="<?= base_url('images/banners/movie_reel.png'); ?>">
                    </div>
                </div>
            </a>
        </div>

        <div class="col s12 m12 l8 xl8">
            <div class="card z-depth-3">
                <div class="card-content">
                    <div class="container" style=" padding-bottom: 25px;">
                        <h5 class="cardheader blueheader title center-align how-it-works">How it works ?</h5>
                        <!--<h6 class="banner_desc center-align">Lorem Ipsum is simply dummy text of the printing</h6>-->
                        <div class="row pad-top-15">
                            <div class="col s12 m6 l5 float-left">
                                <img class="parent-height" src="<?= base_url('images/howitworks/1.png'); ?>">
                            </div>
                            <div class="col s12 m6 l7 float-right">
                                <h6 class="heading">Setting up a prediction</h6>
                                <p class="sub-heading">
                                    Options can be a specific number or a range.<br />
                                    Each question has a maximum of 8 options.
                                </p>
                            </div>
                        </div>
                        <div class="row pad-top-15">
                            <div class="col s12 m6 l5 float-right">
                                <img class="parent-height" src="<?= base_url('images/howitworks/2.png'); ?>">
                            </div>
                            <div class="col s12 m6 l7 float-left">
                                <h6 class="heading">How to earn Silver points ?</h6>
                                <p class="sub-heading">Vote a question &amp; Get 1 silver point.</p>
                            </div>

                        </div>
                        <div class="row pad-top-15">
                            <div class="col s12 m6 l5 float-left">
                                <img class="parent-height" src="<?= base_url('images/howitworks/4.png'); ?>">
                            </div>
                            <div class="col s12 m6 l7 float-right">
                                <h6 class="heading">How to earn Gold & Diamond points ?</h6>
                                <p class="sub-heading">
                                    Each correct answer gets you 1 Gold point.<br />
                                    10 gold points get you a diamond point.
                                </p>
                            </div>
                        </div>
                        <div class="row pad-top-15">
                            <div class="col s12 m6 l5 float-right">
                                <img class="parent-height" src="<?= base_url('images/howitworks/3.png'); ?>">
                            </div>
                            <div class="col s12 m6 l7 float-left">
                                <!--<h6 class="heading">How to earn Diamond points ?</h6>-->
                                <p class="sub-heading">
                                    The more the Gold and Diamond points, the more you are valued on the platform
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col l4 m12 s12 plr15 hide-on-med-and-down" style="height: 462px !important;">
            <div class="card z-depth-4 padd0 mt15">
                <div class="card-head p7_20">
                    <div class="bloghead"><span><img src="<?= base_url('images/icons/light.png'); ?>" class="sidecardheadimg"/></span>Trending Predictions</div>
                </div>
                <div class="blogs-container withtable trend" data-trend="">
                    <?php if (!empty($trending)) { ?>
                        <div class="row">
                            <div class="col s12 bindtrend">
                                <?php foreach ($trending as $trend) { ?>
                                    <?php
                                    $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "|", "/", ";", "'", "<", ">", ",", '"', "?");
                                    $title = str_replace($spchar, "", $trend['poll']);
                                    $title = str_replace(' ', '-', $title);
                                    $pollsec = '?ct=' . $trend['category_name'] . '&pid=';
                                    $uri_parts = explode('?', $_SERVER['REQUEST_URI']);
                                    $href = base_url() . 'Poll/polldetail/' . $trend['id'] . $pollsec;

                                    //$href = base_url() . 'Poll/#moviepoll&pid=' . $entert['id'] . "/" . $title;
                                    $target = 'target = "_blank"';
                                    ?>
                                    <div class="blogs p15_20">
                                        <div class="row">
                                            <a href="<?= $href ?>">
                                                <div class="col s12">
                                                    <div class="blog-title truncate"><?= $trend['poll']; ?></div>
                                                    <div class="left fs11px fw600 blog-details mt10 text-upper category-display category <?= strtolower($trend['category_name']); ?>"><?= $trend['category_name'] ?></div>
                                                    <div class="right blog-details lightgray">
                                                        <i class="lightgray flaticon-click ml0"></i>
                                                        <span class="lightgray fs12px"><?= $trend['total_votes'] ?>  Votes</span>
                                                    </div>
                                                    <!--<div class="right blog-details lightgray"><i class="material-icons icon-color">touch_app</i> <span class="total_votes"><?= $trend['total_votes'] ?> Votes</span></div>-->
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="loadmoretrending" data-page="1" data-catid=""></div>
                        <?php
                    } else {
                        ?>
                        <div class="center">
                            <img src="<?= base_url('images/infographics/2.png'); ?>" style="width: 50%;">
                            <h3 class="fs16px fieldtitle ">No trending questions available. </h3>
                        </div>

                        <?php
                    }
                    ?>
                </div>
                <?php
                if (!empty($trending)) {
                    ?>
                    <!--<div class="card-footer" style="">
                        <a href="javascript:void(0)" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                    </div>-->
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col l4 m12 s12 plr15 equal-height hide-on-large-only" style="height: 470px !important;">
            <div class="card z-depth-4 padd0 mt15">
                <div class="card-head p7_20">
                    <div class="bloghead"><span><img src="<?= base_url('images/icons/light.png'); ?>" class="sidecardheadimg"/></span>Trending Predictions</div>
                </div>
                <div class="blogs-container withtable trend" data-trend="">
                    <?php if (!empty($trending)) { ?>
                        <div class="row">
                            <div class="col s12 bindtrend">
                                <?php foreach ($trending as $trend) { ?>
                                    <?php
                                    $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "|", "/", ";", "'", "<", ">", ",", '"', "?");
                                    $title = str_replace($spchar, "", $trend['poll']);
                                    $title = str_replace(' ', '-', $title);
                                    $pollsec = '?ct=' . $trend['category_name'] . '&pid=';
                                    $uri_parts = explode('?', $_SERVER['REQUEST_URI']);
                                    $href = base_url() . 'Poll/polldetail/' . $trend['id'] . $pollsec;

                                    //$href = base_url() . 'Poll/#moviepoll&pid=' . $entert['id'] . "/" . $title;
                                    $target = 'target = "_blank"';
                                    ?>
                                    <div class="blogs p15_20">
                                        <div class="row">
                                            <a href="<?= $href ?>">
                                                <div class="col s12">
                                                    <div class="blog-title truncate"><?= $trend['poll']; ?></div>
                                                    <div class="left fs11px fw600 blog-details mt10 text-upper category-display category <?= strtolower($trend['category_name']); ?>"><?= $trend['category_name'] ?></div>
                                                    <div class="right blog-details lightgray">
                                                        <i class="lightgray flaticon-click ml0"></i>
                                                        <span class="lightgray fs12px"><?= $trend['total_votes'] ?>  Votes</span></div>
                                                        <!--<div class="right blog-details lightgray"><i class="material-icons icon-color">touch_app</i> <span class="total_votes"><?= $trend['total_votes'] ?> Votes</span></div>-->
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="loadmoretrending" data-page="1" data-catid=""></div>
                        <?php
                    } else {
                        ?>
                        <div class="center">
                            <img src="<?= base_url('images/infographics/2.png'); ?>" style="width: 50%;">
                            <h3 class="fs16px fieldtitle ">No trending questions available. </h3>
                        </div>

                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function load_trending_data(categoryid, pageno) {
        $.ajax({
            url: "<?= base_url() ?>NewHome/load_trending_predictions",
            method: "POST",
            data: {categoryid: categoryid, pageno: pageno}
        }).done(function (result) {
            result = JSON.parse(result);
            var html = "";
            if (result['status']) {
                if (result['data'] > 9) {

                } else {
                    $('.loadmoretrending').remove();
                }
            }
            for (var i in result['data']) {
                html += '<div class="blogs p15_20">\
                    <div class="row">\
                        <a href="<?= base_url() ?>Poll/polldetail/'+ result['data'][i]['id'] +'?ct=' + result['data'][i]['category_name'] + '&pid=">\
                            <div class="col s12">\
                                <div class="blog-title truncate">' + result['data'][i]['poll'] + '</div>\
                                <div class="left fs11px fw600 blog-details mt10 text-upper category-display category ' + result['data'][i]['category_name'].toLowerCase() + '">' + result['data'][i]['category_name'] + '</div>\
                                <div class="right blog-details lightgray">\
                                    <i class="lightgray flaticon-click ml0"></i>\
                                    <span class="lightgray fs12px">' + result['data'][i]['total_votes'] + ' Votes</span></div>\
                            </div>\
                        </a>\
                    </div>\
                </div>';
            }
            html += '<div class="loadmoretrending" data-page="' + (parseInt(pageno) + 1) + '" data-catid="' + categoryid + '"></div>';
            if (pageno < 1) {
                $('.trend .bindtrend').html(html);
            } else {
                $('.trend .bindtrend').append(html);
            }
        });
    }

    //on scroll till bottom load trending predictions
    $('.trend').on('scroll', function () {
        if (Math.ceil($(this).scrollTop() + $(this).innerHeight()) >= $(this)[0].scrollHeight) {
            var categoryid = $('.loadmoretrending').attr('data-catid');
            var pageno = $('.loadmoretrending').attr('data-page');
            load_trending_data(categoryid, pageno);
        }
    });
</script>