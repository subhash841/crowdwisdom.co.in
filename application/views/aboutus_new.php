<!--<div class="container">
    <div class="row">
        <div class="col-6">
            <p style="font-family: 'PT Serif', serif;font-size: 20px;">CrowdWisdom is an innovative question based crowdsourcing platform. The Platform is designed to make decisions in your life easier by accessing the best experts in India and around the world </p>
        </div>
        <div class="col-6" style="padding: 10px;background-image: url('http://cw.localhost.com//images/aboutus/intro.png');background-repeat: no-repeat;background-position: right bottom; position: relative;">

        </div>
    </div>
</div>-->
<style>
    @import url('https://fonts.googleapis.com/css?family=PT+Serif:400i');
    @media(max-width: 600px)
    {
        .heading,.sub-heading,.how-it-works
        {
            text-align: center;
        }
        .intro-bg>img
        {
            transform: translate(0,10px);
        }


    }
    @media(max-width: 994px)
    {
        .intro
        {
            background-size: contain;
        }
    }
    @media(min-width: 995px)
    {
        .intro
        {
            background-size: 50%;
        }        
    }

    @media(min-width: 601px) and (max-width: 900px)
    {
        .intro-bg>img
        {
            transform: translate(0px,10px);
        }

    }
    @media(min-width: 901px) and (max-width: 1160px)
    {
        .intro-bg>img
        {
            transform: translate(0px,10px);
        }

    }
    @media(min-width: 1161px)
    {
        .intro-bg>img
        {
            transform: translate(0px,0px);
        }

    }


    @media (max-width: 490px)
    {
        .vision-img
        {
            width: 150px !important;
        }
        .vision-1
        {
            top: 120px !important;
            left: -110px !important;
        }
        .vision-2
        {
            top: -160px !important;
            left: 10px !important;
        }
        .vision-3
        {
            top: -420px !important;
            left: 120px !important;
        }
    }

    @media (max-width: 600px)
    {
        .vision-img
        {
            width: 150px !important;
        }
        .vision-1
        {
            top: 120px !important;
            left: -110px !important;
        }
        .vision-2
        {
            top: -140px !important;
            left: 10px !important;
        }
        .vision-3
        {
            top: -400px !important;
            left: 120px !important;
        }
    }

    @media (max-width: 850px)
    {
        .vision-img
        {
            width: 150px !important;
        }
        .vision-1
        {
            top: 0px !important;
            left: 50px !important;
        }
        .vision-2
        {
            top: -50px !important;
            left: 10px !important;
        }
        .vision-3
        {
            top: -100px !important;
            left: -50px !important;
        }

        .vision-h5
        {
            font-size: 11px !important;
        }
        .vision-p
        {
            width: inherit;
            font-size:6px !important;
        }
    }


    .intro-bg>.row
    {
        margin-bottom: 30px;
    }
    .intro-bg>.row:first-child
    {
        margin-top: 10px;
    }


    .heading
    {
        font-size: 18px !important;
        font-weight: 500 !important;
        margin-top: 20px;
        font-size:18px;
        font-weight: 600;
    }
    .sub-heading{
        font-size: 16px;
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
    .text-center
    {
        text-align: center;
    }
    .mt-13
    {
        margin-top: 13px;
    }
    .fsize-16       
    {
        font-size: 16px;
    }
    .vision-text
    {
        padding: 5px 25px;
        font-size: 17px;
    }
    .abtpage ul:not(.browser-default)>li {
        list-style-type: disc !important;
    }
    .bluish-grey-text
    {
        color:#8293b7;
    }

    .white-grey
    {
        background-color: #eff2f8;
    }
    .dark-blue-text
    {
        color:#00a2ff !important;
    }
    .fw-600
    {
        font-weight: 600;
    }
    .fsize-1_1
    {
        font-size: 1.2rem;
    }
    #survey
    {
        transform: translate(40px,-120px);
    }
    #prediction
    {
        transform: translate(180px,-180px);
    }
    #advice
    {
        transform: translate(350px,-120px);
    }
    #voice
    {
        transform: translate(180px,-40px);
    }
    .vision-img
    {
        width: 200px;
    }
    .vision-1
    {
        position: relative;top:-50px;left:0;
    }
    .vision-2
    {
        line-height: 15px;position: relative;top:-90px;left:0
    }

    .vision-3
    {
        position: relative;top:-110px;left:-50px;
    }
    .vision-h5
    {
        font-size: 15px;
    }
    .vision-p
    {
        font-size:11px;
    }
    .b15white{
        border:15px solid white;
    }
    .catonimg{
        font-size: 1.1rem;
    }
    .cardheader{
        margin: 18px 0;
        font-size: 2.59rem;
    }
    @media only screen and (max-width: 480px){
        .cardheader {
            font-size: 1.6rem;
            text-align: center;
        }
    }
    @media only screen and (max-width: 767px) {
        .catonimg{
            font-size: 1rem;
        }
        .vision-img{
            width:175px !important;
        }
        .vision-p{
            font-size: 8px !important;
        }
    }
</style>
<div class="content container" id='abtpage'>
    <div class="row z-depth-4 mb-5 px-0" style="margin-top: 5%;">
        <div class="col-12 bg-white" style="padding-right: 0px;padding-left: 0px;">
            <div class="card-panel intro " style="padding: 10px;background-image: url('<?php echo base_url() ?>/images/aboutus/intro.png');background-repeat: no-repeat;background-position: right bottom; position: relative;">
                <div class="row" style="font-size: 16px;">
                    <div class="col-md-12" style=";position: relative;margin-top: 20px;margin-bottom: 60px">
                        <p>Crowdwisdom was established to harness the inherent capabilities of citizens who donot otherwise get opportunities to showcase their skills. We provide a platform for citizens to try out various things –</p>
                        <ul>
                            <li>Predict the Future</li>
                            <li>Answer Other people’s questions</li>
                            <li>Post their own articles/ blogs</li>
                            <li>Discuss various topics with each other</li>
                        </ul>
                        <p>To make access and usage easy, the platform is organized around topics making it easy for readers to explore and inform themselves fully around a topic. The freedom to vote, participate and publish without restrictions (beyond found language and fake news) removes the partisan biases that are inherent in most content web-sites. On our web-site, the Citizen is number 1.</p>
                        <p>We completed our first anniversary recently and the chart below gives us great pride and satisfaction. It should to you too because our citizens using their skills managed to beat some of the biggest experts in the country.</p>
                        <p class="text-center"><img src="<?= base_url( 'images/aboutus/graph2.jpg' ) ?>" class="img-fluid"></p>
                        <p>When we calculated the relative ranking versus other pollsters and experts like Dr Surjit Bhalla (ex PM Economic Advisory Council), our platform ranked 3rd. It is these kinds of performances that give us the confidence that our citizens are very smart and know what is happening on the ground.</p>
                        <p>Further, over the last 12 months we have rewarded more than 250 people with cash prizes ranging from Rs 50000 to Rs 500. This is our small way of recognizing their capabilities. This will continue and will grow. Our platform is not only meaningful but also financially rewarding the best of our citizenry.</p>
                        <p>Our results have been quoted in magazines like <span class="bluish-grey-text">Swarajya</span> and <span class="bluish-grey-text">Moneycontrol</span>.</p>
                        <p>Crowdwisdom was started in 2017 by <span class="bluish-grey-text">Subhash Chandra</span> who hails from the little but strategic township of Sunabeda in Odisha, the home of the Sukhoi and MiG engines. Subhash spent 20 years advising CMOs in India and abroad and published a well read book on Customer Satisfaction in 2011. He was involved in two other books – One on Bihar Elections and another, a critical chapter on a book on solving India’s employment situation – <span class="bluish-grey-text">Cutting the Gordian Knot: India’s quest for prosperity</span>. Prior to starting CrowdWisdom Subhash was a political consultant and advised with politicians on election strategy given his deep understanding of Marketing, Consumers and Policy.  He has been twice selected by Linkedin as top Voice of India. He has written often in various digital magazines – <span class="bluish-grey-text">YourStory, Swarajya, The Quint</span>, DailyO, Yahoo etc.</p>
                    </div>
                    <!--<div class="col-md-6 d-flex align-items-center text-center order-md-first order-last" style=";position: relative;margin-top: 60px;margin-bottom: 60px">
                        <p style="font-family: 'PT Serif', serif;font-size: 20px;">CrowdWisdom is an innovative question based crowdsourcing platform. The Platform is designed to make decisions in your life easier by accessing the best experts in India and around the world </p>
                    </div>
                    <div class="col-md-6 s12 m12 l6 intro-bg order-first order-md-last" style="margin-top: 30px;float: right;">
                        <div class="row">
                            <div class="col s6 offset-s3 ">
                                <div style="position:relative" class="w-50 m-auto">
                                    <img src="<?= base_url( 'images/aboutus/intro2.png' ); ?>" style="width:100%;" >
                                    <div class="catonimg text-white" style="position: absolute;top: 0;left: 15%;">Predictions</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6">
                                <div style="position:relative">
                                    <img src="<?= base_url( 'images/aboutus/intro1.png' ); ?>" style="width:100%;">
                                    <div class="catonimg text-white" style="position: absolute;top: 20%;left: 15%;">Survey</div>
                                </div>
                            </div>
                            <div class="col s6">
                                <div style="position:relative" >
                                    <img src="<?= base_url( 'images/aboutus/intro3.png' ); ?>" style="width:100%;">
                                    <div class="catonimg text-white" style="position: absolute;top: 20%;left: 15%;">Advice</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 offset-s3">
                                <div style="position:relative" class="w-50 m-auto">
                                    <img src="<?= base_url( 'images/aboutus/intro4.png' ); ?>" style="width:100%;">
                                    <div class="catonimg text-white" style="position: absolute;top: 0;left: 15%;">Your Voice</div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>


    <!--<div class="row bg-white mb-5">
        <div class="card-panel z-depth-4" style="overflow: hidden;padding: 0;padding-top: 50px;">
            <div class="row">
                <div class="col s10 offset-s1 text-center" style="height: inherit; margin-bottom: 10%">

                    <h4 style="font-size: 2.28rem;line-height: 110%;margin: 1.14rem 0 .912rem 0;font-weight: 400;">Our Vision</h4>
                    <p class="bluish-grey-text vision-text tastart font-weight-normal text-left">During the 3 Prediction exercises carried out between December and May, CrowdWisdom outperformed seasoned experts in the predicting the results of elections and sporting events accurately. In its new avatar in June, CrowdWisdom introduces newer methods that will enable a higher performance using the wisdom of the Crowds. The algorithms will get refined further over time.
                    </p>
                </div>
            </div>

            <div class="row col s12 text-center" style=" margin-bottom:-50px;background-image: url('<?php echo base_url() ?>/images/aboutus/vision.png');background-repeat: no-repeat;background-position: bottom;background-size: cover;position: relative;">
                <div class="col s12 m4" style="min-height: 200px;">
                    <div class="vision-1" >
                        <img src="<?= base_url( 'images/aboutus/vision1.png' ); ?>" class="vision-img">
                        <div style="color:white;width: 200px;position: absolute;color:white;width: 200px;position: absolute;top: 0;left: 50%;transform: translateX(-50%);">
                            <h5 class="vision-h5 font-weight-normal mt-2">December-May</h5><p class="vision-p" >We held 3 Predictions</p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4" style="min-height: 200px;">
                    <div class="vision-2" ><img src="<?= base_url( 'images/aboutus/vision2.png' ); ?>" class="vision-img"><div style="color:white;width: 200px;position: absolute;top: 4%;left: 50%;transform: translateX(-50%);">
                            <h5 class="vision-h5 font-weight-normal"margin-bottom: 0">June</h5><p class="vision-p" >We came up with new avatar with newer methods</p></div></div>

                </div>
                <div class="col s12 m4" style="min-height: 200px;">
                    <div class="vision-3" ><img src="<?= base_url( 'images/aboutus/vision3.png' ); ?>" class="vision-img"><div style="color:white;width: 200px;position: absolute;color:white;width: 200px;position: absolute;top: 6px;left: 50%;transform: translateX(-50%);"><h5 class="vision-h5">COMING SOON</h5></div></div>

                </div>
            </div>




        </div>
    </div>
    <div class="row bg-white mb-5">
        <div class="card-panel z-depth-4 p-md-4 p-0">
            <div class="container px-5" style=" padding-bottom: 25px;">
                <h5 class="cardheader blueheader title center-align text-center how-it-works"style="line-height: 110%;margin: 1.14rem 0 .912rem 0;font-weight: 400;">How it works ?</h5>
                <div class="row pad-top-15">
                    <div class="col s12 m6 l5 float-left col-md-5">
                        <img class="parent-height" src="<?= base_url( 'images/aboutus/hiw1.png' ); ?>">
                    </div>
                    <div class="col s12 m6 l7 float-right col-md-7">
                        <h5 class="heading">Setting up a Prediction</h5>

                        <ul>
                            <li class="bluish-grey-text fsize-16 mt-13">Each Prediction can have only one result.</li>
                            <li class="bluish-grey-text fsize-16 mt-13">Result can be a specific number or a range.</li>
                            <li class="bluish-grey-text fsize-16 mt-13">Results should be available within 2 weeks of setting up by the Prediction.(Except those set up by admin).</li>
                        </ul>

                    </div>
                </div>
                <div class="row pad-top-15">
                    <div class="col s12 m6 l7 float-left col-md-7 order-last order-md-first">
                        <h5 class="heading">Predicting the Result</h5>
                        <ul>
                            <li class="bluish-grey-text fsize-16 mt-13">Each Question has a minimum of 12 options</li>
                            <li class="bluish-grey-text fsize-16 mt-13">You can choose only one Answer</li>
                            <li class="bluish-grey-text fsize-16 mt-13">Think through before Answering</li>
                        </ul>
                    </div>
                    <div class="col s12 m6 l5 float-right col-md-5 order-first order-md-last">
                        <img class="parent-height" src="<?= base_url( 'images/aboutus/hiw2.png' ); ?>">
                    </div>


                </div>
                <div class="row pad-top-15">
                    <div class="col s12 m6 l5 float-left col-md-5">
                        <img class="parent-height" src="<?= base_url( 'images/aboutus/hiw3.png' ); ?>">
                    </div>
                    <div class="col s12 m6 l7 float-right col-md-7">
                        <h5 class="heading">How to Earn ?</h5>
                        <ul>
                            <li class="bluish-grey-text fsize-16 mt-13">Each Answer gets you a Silver Point</li>
                            <li class="bluish-grey-text fsize-16 mt-13">Each Correct Answer gets you a Gold Point</li>
                            <li class="bluish-grey-text fsize-16 mt-13">The more the Gold and Diamond points, the more you are valued on the platform.(Financially and Option wise)</li>
                        </ul>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <div class="row bg-white mb-5 z-depth-4 py-4">
        <div class="col s12 no-padding">
            <div class="card-panel ">
                <div class="row">
                    <div class='col-12 text-center'>
                        <h5 class="cardheader blueheader title center-align how-it-works" style="line-height: 110%;margin: 1.14rem 0 .912rem 0;font-weight: 400;">What do you Earn ?</h5>
                    </div>

                    <div class="col s12 m6 text-center white-grey equal-height b15white">
                        <img src="<?= base_url( 'images/aboutus/earn1.png' ); ?>" style="width: 150px; margin:40px auto;display: block;"/>
                        <p style="font-size: 16px;">
                            Gold and Diamond Point holders get a share of revenue from those who ask questions and Advertisers
                        </p>
                    </div>
                    <div class="col s12 m6 text-center white-grey equal-height b15white">
                        <img src="<?= base_url( 'images/aboutus/earn2.png' ); ?>" style="width: 200px; margin:40px auto;display: block;">
                        <p style="font-size: 15px;">
                            Silver Points holders can use their Points to open a blog or ask a question. We don't collect any personal information. However, if you wish to make more out of your silver points, you can share some personal information like Age, Gender and Location.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row bg-white mb-5">
        <div class="card-panel z-depth-4 py-4">
            <div class="row no-gutters">
                <div class="col s12 text-center">
                    <h4 class="fs22px" style="font-size:22px ;line-height: 110%;margin: 1.14rem 0 .912rem 0;font-weight: 400;">About the Company</h4>
                    <p class="bluish-grey-text vision-text">
                        CrowdWisdom is owned and operated by SC Polling Insights and Consultancy Services LLP. The Management team is headed by <strong><a href="https://www.linkedin.com/in/schandra100/" target="_blank">Mr. Subhash Chandra</a></strong> who is a leading researcher, columnist and a registered investment advisor.
                    </p>
                </div>
            </div>
        </div>
    </div>-->



</div>