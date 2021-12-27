<style>
    .minus-m-t12{
        margin-top: -12%;
    }
    .withtable.resultlist{
        color: #434E64;
        font-weight: 500;
    }
    .row-title{
        margin-right: 10px !important;
    }
    .point-list{
        background-color: #eff2f8;
        margin-right: 10px !important;
    }
    .resultlist>.row>.col>div {
        padding: 15px 0;
    }
    span.sport_category{
        background-color: #D8E9FF;
        color: #397798;
    }
    span.governance_category{
        background-color: #EDE3FF;
        color: #5E1FDB;
    }
    span.entertain_category{
        background-color: #FFEED5;
        color: #D59E63;
    }
    span.money_category{
        background-color: #D8E9FF;
        color: #5ABAB3;
    }
    .redeem {
        color: red;
    }
</style>

<div class="banner" style="background: #232b3c;min-height: 50vh; padding-top: 1%;">
    <div class="center-align">
        <p style="color: #fff;font-size: 25px;margin-bottom: 10px;"><?= $user_detail['alise']; ?></p>
        <p class="profile-locaton">
            <span id="user-location"><img src="<?= base_url('/images/common/location.png'); ?>"> <?= $user_detail['location'] ?></span>
            <span id="party-affiliation"> <?= $user_detail['party'] . " - " . $user_detail['abbreviation'] ?></span>
        </p>
        <p class="profile-rank">
            <span id="user-medal"><img src="<?= base_url('/images/common/medal.png'); ?>"></span>
            <span id="user-rank" style="font-size: 18px;font-weight: 400;"><?= $user_detail['unearned_points']; ?> Points</span>
        </p>
    </div>
</div>
<div class="content container" id="final-result-all">
    <div class="row minus-m-t12 mb-12"><!--minus-m-t8-->
        <div class="col s12 plr15 equal-height">
            <div class="card z-depth-4">
                <div class="card-image">
                    <div class="resultlist-title p15 coverleft">
                        <div class="left">
                            <h4 class="cardheader blueheader">Trust Points History</h4>
                        </div>
                    </div>
                </div>
                <div class="card-content withtable center-align">
                    <div class="row row-title">
                        <div class="col s12 m3">
                            <div class="text-upper mmax-title">Date</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="text-upper mmax-title">Category</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="text-upper mmax-title">Action</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="text-upper mmax-title">Points</div>
                        </div>
                    </div>
                </div>
                <div class="card-content withtable resultlist center-align" style="max-height: 350px;"><!-- max-height: inherit; margin-top: 50px;-->
                    <?php
                    foreach ($user_point_history as $key => $history) {
                        $class = "";
                        if ($history['category'] == "Governance") {
                            $class = "governance_category";
                        }
                        if ($history['category'] == "Sports") {
                            $class = "sport_category";
                        }
                        if ($history['category'] == "Entertainment") {
                            $class = "entertain_category";
                        }
                        if ($history['category'] == "Money") {
                            $class = "money_category";
                        }

                        echo '<div class="row point-list">
                                <div class="col s12 m3">
                                    <div class="date">' . $history['created_date'] . '</div><!--23<sup>rd</sup> May 2018-->
                                </div>
                                <div class="col s12 m3">
                                    <div><span class="category ' . $class . '">' . $history['category'] . '</span></div>
                                </div>
                                <div class="col s12 m3">
                                    <div class="action">' . $history['action'] . '</div>
                                </div>
                                <div class="col s12 m3">
                                    <div class="points">+ ' . $history['points'] . '</div>
                                </div>
                            </div>';
                    }
                    ?>
                    <!--<div class="row point-list">
                        <div class="col s12 m3">
                            <div class="date">23<sup>rd</sup> May 2018</div>
                        </div>
                        <div class="col s12 m3">
                            <div><span class="category sport_category">Sports</span></div>
                        </div>
                        <div class="col s12 m3">
                            <div class="action">Vote</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="points">+ 1</div>
                        </div>
                    </div>
                    <div class="row point-list">
                        <div class="col s12 m3">
                            <div class="date">23<sup>rd</sup> May 2018</div>
                        </div>
                        <div class="col s12 m3">
                            <div><span class="category governance_category">Election</span></div>
                        </div>
                        <div class="col s12 m3">
                            <div class="action">Vote</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="points">+ 1</div>
                        </div>
                    </div>
                    <div class="row point-list">
                        <div class="col s12 m3">
                            <div class="date">23<sup>rd</sup> May 2018</div>
                        </div>
                        <div class="col s12 m3">
                            <div><span class="category entertain_category">Movies</span></div>
                        </div>
                        <div class="col s12 m3">
                            <div class="action">Vote</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="points">+ 1</div>
                        </div>
                    </div>
                    <div class="row point-list">
                        <div class="col s12 m3">
                            <div class="date">23<sup>rd</sup> May 2018</div>
                        </div>
                        <div class="col s12 m3">
                            <div><span class="category money_category">Stocks</span></div>
                        </div>
                        <div class="col s12 m3">
                            <div class="action">Vote</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="points">+ 1</div>
                        </div>
                    </div>
                    <div class="row point-list redeem">
                        <div class="col s12 m3">
                            <div class="date">23<sup>rd</sup> May 2018</div>
                        </div>
                        <div class="col s12 m3">
                            <div><span class="category money_category">Stocks</span></div>
                        </div>
                        <div class="col s12 m3">
                            <div class="action">Raised</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="points">-50</div>
                        </div>
                    </div>
                    <div class="row point-list">
                        <div class="col s12 m3">
                            <div class="date">23<sup>rd</sup> May 2018</div>
                        </div>
                        <div class="col s12 m3">
                            <div><span class="category sport_category">Sports</span></div>
                        </div>
                        <div class="col s12 m3">
                            <div class="action">Vote</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="points">+ 1</div>
                        </div>
                    </div>
                    <div class="row point-list">
                        <div class="col s12 m3">
                            <div class="date">23<sup>rd</sup> May 2018</div>
                        </div>
                        <div class="col s12 m3">
                            <div><span class="category governance_category">Election</span></div>
                        </div>
                        <div class="col s12 m3">
                            <div class="action">Vote</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="points">+ 1</div>
                        </div>
                    </div>
                    <div class="row point-list">
                        <div class="col s12 m3">
                            <div class="date">23<sup>rd</sup> May 2018</div>
                        </div>
                        <div class="col s12 m3">
                            <div><span class="category entertain_category">Movies</span></div>
                        </div>
                        <div class="col s12 m3">
                            <div class="action">Vote</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="points">+ 1</div>
                        </div>
                    </div>
                    <div class="row point-list">
                        <div class="col s12 m3">
                            <div class="date">23<sup>rd</sup> May 2018</div>
                        </div>
                        <div class="col s12 m3">
                            <div><span class="category money_category">Stocks</span></div>
                        </div>
                        <div class="col s12 m3">
                            <div class="action">Vote</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="points">+ 1</div>
                        </div>
                    </div>
                    <div class="row point-list">
                        <div class="col s12 m3">
                            <div class="date">23<sup>rd</sup> May 2018</div>
                        </div>
                        <div class="col s12 m3">
                            <div><span class="category entertain_category">Movies</span></div>
                        </div>
                        <div class="col s12 m3">
                            <div class="action">Vote</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="points">+ 1</div>
                        </div>
                    </div>
                    <div class="row point-list">
                        <div class="col s12 m3">
                            <div class="date">23<sup>rd</sup> May 2018</div>
                        </div>
                        <div class="col s12 m3">
                            <div><span class="category money_category">Stocks</span></div>
                        </div>
                        <div class="col s12 m3">
                            <div class="action">Vote</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="points">+ 1</div>
                        </div>
                    </div>
                    <div class="row point-list redeem">
                        <div class="col s12 m3">
                            <div class="date">23<sup>rd</sup> May 2018</div>
                        </div>
                        <div class="col s12 m3">
                            <div><span class="category money_category">Stocks</span></div>
                        </div>
                        <div class="col s12 m3">
                            <div class="action">Raised</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="points">-50</div>
                        </div>
                    </div>
                    <div class="row point-list">
                        <div class="col s12 m3">
                            <div class="date">23<sup>rd</sup> May 2018</div>
                        </div>
                        <div class="col s12 m3">
                            <div><span class="category sport_category">Sports</span></div>
                        </div>
                        <div class="col s12 m3">
                            <div class="action">Vote</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="points">+ 1</div>
                        </div>
                    </div>
                    <div class="row point-list">
                        <div class="col s12 m3">
                            <div class="date">23<sup>rd</sup> May 2018</div>
                        </div>
                        <div class="col s12 m3">
                            <div><span class="category governance_category">Election</span></div>
                        </div>
                        <div class="col s12 m3">
                            <div class="action">Vote</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="points">+ 1</div>
                        </div>
                    </div>
                    <div class="row point-list">
                        <div class="col s12 m3">
                            <div class="date">23<sup>rd</sup> May 2018</div>
                        </div>
                        <div class="col s12 m3">
                            <div><span class="category entertain_category">Movies</span></div>
                        </div>
                        <div class="col s12 m3">
                            <div class="action">Vote</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="points">+ 1</div>
                        </div>
                    </div>
                    <div class="row point-list">
                        <div class="col s12 m3">
                            <div class="date">23<sup>rd</sup> May 2018</div>
                        </div>
                        <div class="col s12 m3">
                            <div><span class="category money_category">Stocks</span></div>
                        </div>
                        <div class="col s12 m3">
                            <div class="action">Vote</div>
                        </div>
                        <div class="col s12 m3">
                            <div class="points">+ 1</div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="current_page" id="current_page" value="1">
    <?php if ($total_history > 10) { ?>
        <div class="row">
            <div class="" style="width:100%;text-align:center;">
                <div class="mypagination" style="display: inline-block"></div>
            </div>
        </div>
    <?php } ?>
<!--<script>
$(function () {
$('.mypagination').pagination({
items: "51",
itemsOnPage: 10,
displayedPages: 3,
currentPage: "1",
hrefTextPrefix: "https://crowdwisdom.co.in/Allindia/Reasons/Page/",
cssStyle: 'light-theme'
});
});
</script>-->
    <script>
<?php if ($total_history > 10) { ?>
            $(function () {
                $('.mypagination').pagination({
                    items: "<?= $total_history; ?>",
                    itemsOnPage: 10,
                    displayedPages: 3,
                    currentPage: "<?= $current_page; ?>",
                    hrefTextPrefix: "<?= base_url() ?>Profile/pointsHistory/",
                    cssStyle: 'light-theme'
                });
            });
<?php } ?>
    </script>
</div>