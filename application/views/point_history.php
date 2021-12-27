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


    .heading
    {
        font-weight: 600;
        font-size: 16px;
        text-align: center;
        margin-bottom: 0;
    }
    .sub-heading
    {
        text-align: center;
        color: white;
        font-size: 16px;
        margin-top: 5px;
    }

    .image-in-card
    {
        transform: translateY(75%);
        margin-right: 10px;
    }
    .ml-15
    {
        margin-left: 15px;
    }
    .text-center
    {
        text-align: center;
    }
    .btn-in-card
    {
        font-weight: 600;
        border-radius: 100px;
        padding: 0 15px;
        font-size: 14px;
    }
    .wallet-card-panel
    {
        padding:10px 24px;
        position: relative;
        z-index: 1;
    }
    .points-card .shadowimg{
        z-index: 0;
        margin-top: -55px;
    }
    /*.card-panel.wallet-card-panel.equal-height::after
    {
        z-index: -2;
        background-image: url('http://localhost/crowdwisdom/code/webportal/images/wallet/5.png');
        background-size: contain;
        transform: translateY(50%);
    }*/

    .points-display{
        padding: 3% 8% 3% 3%;
        background: #bec1c6;
        border-radius: 20px;
    }
    .points-display img{
        width: 8%;
        margin-right: 3%;
        vertical-align: middle;
    }

    .silver-gradient{
        background-image: -webkit-linear-gradient( -43deg, #ffffff , #b2b2b2 40%, #ffffff 60%, #b2b2b2 80% );
        background-image: linear-gradient( -43deg, #ffffff , #b2b2b2 40%, #ffffff 60%, #b2b2b2 80% );
    }
    .silver-text{
        color: #55585c;
    }
    .gold-gradient{
        background-image: -webkit-linear-gradient( -43deg, #d6a444 , #ffd971 40%, #d6a444 60%, #ffd971 80% );
        background-image: linear-gradient( -43deg, #d6a444 , #ffd971 40%, #d6a444 60%, #ffd971 80% );
    }
    .gold-text{
        color: #6e582c;
    }
    .diamond-gradient{
        background-image: -webkit-linear-gradient( -43deg, #394650 , #303438 40%, #394650 60%, #303438 80% );
        background-image: linear-gradient( -43deg, #394650 , #303438 40%, #394650 60%, #303438 80% );
    }
    .diamond-text{
        color: #303438;
    }

    @media (min-width: 600px) and (max-width: 768px)
    {
        .image-col
        {
            margin-right: 0 !important;
        }
        .sub-heading{
            font-size: 14px;
        }
    }
    @media (max-width: 588px)
    {
        .small-screen-translateY
        {
            transform: translateY(-10%)!important;
        }
        .image-in-card
        {
            transform: translateY(0);
            margin-right: 10px;
            /*transform: translateX(200%);*/
        }
        .image-in-card.diamond
        {
            transform: translateY(0);
            margin-right: 10px;
            /*transform: translateX(250%);*/

        }

        .points-display{
            padding: 5% 10% 5% 5%;
            background: #6F7C98;
            border-radius: 20px;
        }
        .points-display img{
            width: 15%;
            margin-right: 5%;
            vertical-align: middle;
        }
        .points-card .shadowimg{
            width: 100%;
            margin-top: -50px;
        }
    }

</style>
<?php $userdata = $this -> session -> userdata( 'data' ); ?>
<div class="banner" style="background: #232b3c;min-height: 50vh; padding-top: 1%;">
    <div class="center-align">
        <p style="color: #fff;font-size: 25px;margin-bottom: 10px;"><?= $user_detail[ 'alise' ]; ?></p>
        <!--<p class="profile-locaton">
            <span id="user-location"><img src="<?= base_url( 'images/common/location.png' ); ?>"> <?= $user_detail[ 'location' ] ?></span>
            <span id="party-affiliation"> <?= $user_detail[ 'party' ] . " - " . $user_detail[ 'abbreviation' ] ?></span>
        </p>-->
        <p class="profile-rank">
            <span id="user-medal"><span style="z-index: 3;position: absolute;color:black; font-weight: 500;margin-left:30px; margin-top:8px;font-size:16px"><span style="font-weight: 900"><?= $userdata[ 'silver_points' ]; ?></span>Points</span><img src="<?= base_url( 'images/wallet/1.png' ); ?>"></span>
            <!--<span id="user-rank" style="font-size: 18px;font-weight: 400;"><?= $userdata[ 'silver_points' ]; ?> Points</span>-->
        </p>
    </div>
</div>
<div class="content container" id="final-result-all">
    <div class="row minus-m-t12 mb-12 small-screen-translateY" style=" z-index: 3;position: relative;">
        <div class="col s12 m4 points-card center-align">
            <div class="card-panel wallet-card-panel equal-height silver-gradient"><!--#ffda81,#ff6c00-->
                <div class="row" >
                    <div class="col s12 m6 l3 image-col center-align" style="">
                        <img class="image-in-card" src="<?= base_url( 'images/wallet/2.png' ); ?>" style>
                    </div>
                    <div class="col s12 m6 l9 text-center white-text p0">
                        <p class="heading text-upper text-center silver-text">Silver Points</p>
                        <p class="sub-heading ml-15 silver-text">Vote More. Earn More<br><br></p>
                        <a class="text-center btn white btn-in-card silver-text"><?= $userdata[ 'silver_points' ]; ?> points</a><!--style="color:#ff6c00;"-->
                    </div>                    
                </div>
            </div>
            <img src="<?= base_url( 'images/wallet/5.png' ); ?>" class="shadowimg"/>
        </div>
        <div class="col s12 m4 points-card center-align">
            <div class="card-panel wallet-card-panel equal-height gold-gradient">
                <div class="row">
                    <div class="col s12 m6 l3 image-col center-align" style="">
                        <img class="image-in-card" src="<?= base_url( 'images/wallet/3.png' ); ?>" style>
                    </div>
                    <div class="col s12 m6 l9 text-center white-text p0">
                        <p class="heading text-upper text-center gold-text">Gold Points</p>
                        <p class="sub-heading ml-15 gold-text">Wow!! You earned Gold points on right answers</p>
                        <a class="text-center btn white btn-in-card gold-text"><?= $user_detail[ 'gold_points' ] ?> points</a>
                    </div>
                </div>
            </div>
            <img src="<?= base_url( 'images/wallet/5.png' ); ?>" class="shadowimg"/>
        </div>
        <div class="col s12 m4 points-card center-align">
            <div class="card-panel wallet-card-panel equal-height diamond-gradient">
                <div class="row">
                    <div class="col s12 m6 l3 image-col center-align" style="">
                        <img class="image-in-card diamond" src="<?= base_url( 'images/wallet/4.png' ); ?>" style>
                    </div>
                    <div class="col s12 m6 l9 text-center white-text p0">
                        <p class="heading text-upper text-center">Diamond Points</p>
                        <p class="sub-heading ml-15">Superb!! You earned Diamond points on redemption</p>
                        <a class="text-center btn white btn-in-card diamond-text">0 points</a>  
                    </div>
                </div>
            </div>
            <img src="<?= base_url( 'images/wallet/5.png' ); ?>" class="shadowimg"/>
        </div>
    </div>
    <div class="row minus-m-t12">
        <div class="col s12">
            <div class="card" style="padding: 0;margin-top: 0;">
                <div class="row">
                    <div class="col s6 m1 offset-m3">
                        <img src="<?= base_url( 'images/wallet/6.png' ); ?>" style="height: 80px; padding: 0;transform: translateY(15%);float: right">
                    </div>
                    <div class="col s6 m5">
                        <p style="font-weight: 500;font-size: 18px;text-align: center; margin-bottom: 0">Your total predictions <strong class="red-text" style="font-weight: 600"><?= $total_prediction ?></strong><p>
                        <!--<p style="    text-align: center;
                           margin-top: -10px;"> Awesome !! Keep up the spirit and continue predicting...</p>-->

                    </div>
                </div>
            </div>                
        </div>
    </div>

    <div class="row minus-m-t12 mb-12"><!--minus-m-t8-->
        <div class="col s12 plr15 equal-height">
            <!--Desktop View-->
            <div class="card z-depth-4 hide-on-med-and-down">
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
                    foreach ( $user_point_history as $key => $history ) {
                            $class = "";
                            $action = "";
                            if ( $history[ 'category' ] == "Governance" ) {
                                    $class = "governance_category";
                            }
                            if ( $history[ 'category' ] == "Sports" ) {
                                    $class = "sport_category";
                            }
                            if ( $history[ 'category' ] == "Entertainment" ) {
                                    $class = "entertain_category";
                            }
                            if ( $history[ 'category' ] == "Money" ) {
                                    $class = "money_category";
                            }

                            if ( $history[ 'action' ] == "Poll Raised" ) {
                                    $action = "Raised";
                                    $text_style = 'style="color: #eb0100;"';
                                    $plus_minus = "-";
                            } else {
                                    $action = $history[ 'action' ];
                                    $text_style = "";
                                    $plus_minus = "+";
                            }
                            echo '<div class="row point-list">
                                <div class="col s12 m3">
                                    <div class="date" ' . $text_style . '>' . $history[ 'created_date' ] . '</div><!--23<sup>rd</sup> May 2018-->
                                </div>
                                <div class="col s12 m3">
                                    <div><span class="category ' . $class . '">' . $history[ 'category' ] . '</span></div>
                                </div>
                                <div class="col s12 m3">
                                    <div class="action" ' . $text_style . '>' . $action . '</div>
                                </div>
                                <div class="col s12 m3">
                                    <div class="points" ' . $text_style . '>
                                        <span class="points-display">
                                            <img src="' . base_url() . 'images/wallet/2.png">' . $plus_minus . $history[ 'points' ] . '
                                        </span>
                                    </div>
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
            <!--/Desktop View-->

            <!--Mobile View-->
            <div class="card z-depth-4 hide-on-large-only">
                <div class="card-image">
                    <div class="resultlist-title p15 coverleft">
                        <div class="left">
                            <h4 class="cardheader blueheader">Trust Points History</h4>
                        </div>
                    </div>
                </div>
                <div class="card-content withtable resultlist center-align" style="max-height: 350px;"><!-- max-height: inherit; margin-top: 50px;-->
                    <?php
                    foreach ( $user_point_history as $key => $history ) {
                            $class = "";
                            $action = "";
                            if ( $history[ 'category' ] == "Governance" ) {
                                    $class = "governance_category";
                            }
                            if ( $history[ 'category' ] == "Sports" ) {
                                    $class = "sport_category";
                            }
                            if ( $history[ 'category' ] == "Entertainment" ) {
                                    $class = "entertain_category";
                            }
                            if ( $history[ 'category' ] == "Money" ) {
                                    $class = "money_category";
                            }

                            if ( $history[ 'action' ] == "Poll Raised" ) {
                                    $action = "Raised";
                                    $text_style = 'style="color: #eb0100;"';
                                    $plus_minus = "-";
                            } else {
                                    $action = $history[ 'action' ];
                                    $text_style = "";
                                    $plus_minus = "+";
                            }
                            echo '<div class="row point-list">
                                <div class="col s5 m3">
                                    <div class="text-upper mmax-title">Date</div>
                                </div>
                                <div class="col s7 m3">
                                    <div class="date" ' . $text_style . '>' . $history[ 'created_date' ] . '</div><!--23<sup>rd</sup> May 2018-->
                                </div>
                                <div class="col s5 m3">
                                    <div class="text-upper mmax-title">Category</div>
                                </div>
                                <div class="col s7 m3">
                                    <div><span class="category ' . $class . '">' . $history[ 'category' ] . '</span></div>
                                </div>
                                <div class="col s5 m3">
                                    <div class="text-upper mmax-title">Action</div>
                                </div>
                                <div class="col s7 m3">
                                    <div class="action" ' . $text_style . '>' . $action . '</div>
                                </div>
                                <div class="col s5 m3">
                                    <div class="text-upper mmax-title">Points</div>
                                </div>
                                <div class="col s7 m3">
                                    <div class="points" ' . $text_style . '>
                                        <span class="points-display">
                                            <img src="' . base_url() . 'images/wallet/2.png">' . $plus_minus . $history[ 'points' ] . '
                                        </span>
                                    </div>
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
            <!--/Mobile View-->
        </div>
    </div>

    <input type="hidden" name="current_page" id="current_page" value="1">
    <?php if ( $total_history > 10 ) { ?>
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
<?php if ( $total_history > 10 ) { ?>
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