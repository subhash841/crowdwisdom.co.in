<?php //echo "<pre>"; print_r($reasons);exit;                                                     ?>

<style>
    .p10pb5{
        padding: 10px;
        padding-bottom: 5px;
    }
    .m-0{
        margin: 0 !important; 
    }
    .p-0{
        padding: 0 !important;
    }
    .mb-0{
        margin-bottom: 0;
    }
    .addforumarea{
        margin-top: 7px !important;
        color:#000;
        height: 2rem !important;
        min-height: 2rem !important;
        margin-bottom: 0px !important;
        padding: 0 !important;
        border: none !important;
        font-size: 14px !important;
    }
    input.addforumarea:focus:not([readonly]){
        border: none;
        box-shadow: none;
    }
    .postforum{
        cursor: pointer;
        height: 50px;
        text-align: center;
        padding:10px;
        color: white;
        font-weight: 700;
        font-size: 18px;
        float: right;
    }
    .forumsubhead{
        color:#bbc4d3;

    }
    .text-uppercase{
        text-transform: uppercase;
    }
    .fw700{
        font-weight: 700;
    }
    .padd15{
        padding: 15px;
    }
    .fs16px{
        font-size: 16px;
    }
    .fs12px{
        font-size: 12px;
    }
    .fs14px{
        font-size: 14px;
    }
    .fs18px{
        font-size: 18px;
    }
    .fa-1_5x{
        font-size: 1.5em;
    }
    .capsule{
        display: table;
        border: 1px solid;
        border-radius: 5px;
        margin: 5px 0;

    }
    .capsule__btn,
    .capsule__body{
        display: table-cell;
        padding: 0 4px;
    }
    .mb10{
        margin-bottom: 10px;
    }
    .agree .capsule__btn{
        color: #398e5e;
    }
    .disagree .capsule__btn{
        color: #b9393a;
    }
    .neutral .capsule__btn{
        color: #c78e33; 
    }
    .agree .capsule__body{
        background-color:#398e5e;
        color:white
    }
    .disagree .capsule__body{
        background-color: #b9393a;
        color:white
    }
    .neutral .capsule__body{
        background-color: #c78e33;
        color:white
    }
    .agree{

        border:1px solid #398e5e;
    }
    .disagree{
        border:1px solid #b9393a;

    }
    .neutral{
        border:1px solid #c78e33;

    }
    .forumcardimg{
        max-height: 40vh;
        max-width: 100%;
        /* width: 550px; */
        /* height: 250px; */
        object-fit: contain;
    }

    #newdropdown{
        margin-top: 5px;
        width: fit-content !important;
        position: absolute ;
        top:auto!important;
        left:auto !important;
        right: 0 !important;
        padding-left: 0px !important; 
    }
    .custom-file-upload {
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
        font-size: 14px;
    }
    .dropdown-content li{
        min-height: auto !important;
    }
    .tabs .tab a {
        color: #4c4c4c;
    }
    .tabs .tab a:hover, .tabs .tab a.active {
        background-color: red;
        color: white;
    }
    .tabs .indicator{
        background-color: transparent;
    }
</style>
<div class="content container">
    <div class="row mb0 minus-m-t8"><!--mb-12-->
        <div class="col m12 s12 equal-height">
            <ul id="tabs-swipe-demo " class="tabs z-depth-4" style="width: 80%;margin-top: 100px;padding-left: 0">
                <li class="tab "><a href="#mydiscuss"><i class="flaticon-social"></i> My Discussion</a></li>
                <li class="tab "><a href="#elecforum"><i class="flaticon-interface"></i> Elections</a></li>
                <li class="tab "><a href="#stockforum"><i class="flaticon-money"></i> Stocks</a></li>
                <li class="tab "><a href="#sportforum"><i class="flaticon-ball"></i> Sports</a></li>
                <li class="tab "><a href="#movieforum"><i class="flaticon-tool"></i> Movies</a></li>
            </ul>
        </div>
    </div>
    <div class="card p-0 z-depth-4" style="width: 80%;margin: 5px auto;">
        <div class="row mb-0">
            <div class="col m10 s12">
                <div class="input-field col s12 m-0">
                    <input id="textarea1" placeholder="What is on your mind ....."class="materialize-textarea addforumarea">
                </div>
            </div>
            <div class="col m1 s12" style="">
                <div class="postforum red" style="font-size: 15px;font-weight: 500;">
                    Post
                </div>
            </div>
            <div class="col m1 s12" style="">
                <a materialize="dropdown" class='postforum gray dropdown-button btn'  href='#' data-activates='newdropdown'>
                    <h6 style="font-size:12px;margin:0;text-transform: capitalize;cursor: pointer">upload image</h6>
                </a>
                <!-- Dropdown Structure -->
                <ul id='newdropdown' class='dropdown-content'>
                    <li>
                        <label for="file-upload" class="custom-file-upload">
                            <i class="fa fa-cloud-upload"></i> From Computer
                        </label>
                        <input id="file-upload" type="file" style="display:none"/>
                    </li>
                    <li>
                        <label for="file-upload1" class="custom-file-upload">
                            <i class="fa fa-cloud-upload"></i> From URL
                        </label>
                        <input id="file-upload1" type="file" style="display:none"/>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="mydiscuss" class="col s12">
        <div class="row">
            <div class="col m3 s12">
                <div class="card z-depth-4" style="padding:0px;">
                    <div class="mb0">
                        <div class="">
                            <div class="center"><img class="forumcardimg" src="/CrowdWisdom/Code/webportal//images/blogs/Pictures-Download-HD-Car-Wallpapers1523964400.jpg" alt="Crowd Prediction"></div>
                        </div>
                    </div>
                    <div class="card_content" style="padding: 0 10px;">
                        <label class="forumsubhead text-uppercase fw700 fs12px">Elections</label>
                        <h6 class="fs14px" style="text-align:start">Why is Karnataka election such a close one?</h6>
                        <div class="row mb10">
                            <div class="col m6 s12"><h6 class="forumsubhead fs12px">3 March 2018</h6></div>
                            <div class="col m6 s12"><h6 class="forumsubhead fs12px right">By <a href="#">Anup Pandey</a></h6></div>
                        </div>
                        <div class="row mb10">
                            <div>
                                <div class="col m4 s4">
                                    <div class="capsule  agree brand-style">
                                        <a class="capsule__btn "><i class="fa fa-thumbs-o-up fa-1_5x" aria-hidden="true"></i></a>
                                        <div class="capsule__body ">50%</div>
                                    </div>
                                </div>
                                <div class="col m4 s4">
                                    <div class="capsule  neutral brand-style">
                                        <a class="capsule__btn"><i class="fa fa-thumbs-o-up fa-1_5x" aria-hidden="true"></i></a>
                                        <div class="capsule__body">50%</div>
                                    </div>
                                </div>
                                <div class="col m4 s4">
                                    <div class="capsule  disagree brand-style">
                                        <a class="capsule__btn "><i class="fa fa-thumbs-o-up fa-1_5x" aria-hidden="true"></i></a>
                                        <div class="capsule__body ">50%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col m4 s12">

            </div>
        </div>
    </div>
    <div id="elecforum" class="col s12 ">
        <div class="row">
            <div class="col m3 s12">
                <div class="card z-depth-4" style="padding:0px;">
                    <div class="mb0">
                        <div class="">
                            <div class="center"><img class="forumcardimg" src="/CrowdWisdom/Code/webportal//images/blogs/Pictures-Download-HD-Car-Wallpapers1523964400.jpg" alt="Crowd Prediction"></div>
                        </div>
                    </div>
                    <div class="card_content" style="padding: 0 10px;">
                        <label class="forumsubhead text-uppercase fw700 fs12px">Elections</label>

                        <h6 class="fs14px" style="text-align:start">Why is Karnataka election such a close one?</h6>
                        <div class="row mb10">
                            <div class="col m6 s12"><h6 class="forumsubhead fs12px">3 March 2018</h6></div>
                            <div class="col m6 s12"><h6 class="forumsubhead fs12px right">By <a href="#">Anup Pandey</a></h6></div>
                        </div>
                        <div class="row mb10">
                            <div>
                                <div class="col m4 s4">
                                    <div class="capsule  agree brand-style">
                                        <a class="capsule__btn "><i class="fa fa-thumbs-o-up fa-1_5x" aria-hidden="true"></i></a>
                                        <div class="capsule__body ">50%</div>
                                    </div>
                                </div>
                                <div class="col m4 s4">
                                    <div class="capsule  neutral brand-style">
                                        <a class="capsule__btn"><i class="fa fa-thumbs-o-up fa-1_5x" aria-hidden="true"></i></a>
                                        <div class="capsule__body">50%</div>
                                    </div>
                                </div>
                                <div class="col m4 s4">
                                    <div class="capsule  disagree brand-style">
                                        <a class="capsule__btn "><i class="fa fa-thumbs-o-up fa-1_5x" aria-hidden="true"></i></a>
                                        <div class="capsule__body ">50%</div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>


                </div>
            </div>
            <div class="col m4 s12">

            </div>
        </div>
    </div>
    <div id="stockforum" class="col s12 ">
        <div class="row">
            <div class="col m3 s12">
                <div class="card z-depth-4" style="padding:0px;">
                    <div class="mb0">
                        <div class="">
                            <div class="center"><img class="forumcardimg" src="/CrowdWisdom/Code/webportal//images/blogs/Pictures-Download-HD-Car-Wallpapers1523964400.jpg" alt="Crowd Prediction"></div>
                        </div>
                    </div>
                    <div class="card_content" style="padding: 0 10px;">
                        <label class="forumsubhead text-uppercase fw700 fs12px">Elections</label>

                        <h6 class="fs14px" style="text-align:start">Why is Karnataka election such a close one?</h6>
                        <div class="row mb10">
                            <div class="col m6 s12"><h6 class="forumsubhead fs12px">3 March 2018</h6></div>
                            <div class="col m6 s12"><h6 class="forumsubhead fs12px right">By <a href="#">Anup Pandey</a></h6></div>
                        </div>
                        <div class="row mb10">
                            <div>
                                <div class="col m4 s4">
                                    <div class="capsule  agree brand-style">
                                        <a class="capsule__btn "><i class="fa fa-thumbs-o-up fa-1_5x" aria-hidden="true"></i></a>
                                        <div class="capsule__body ">50%</div>
                                    </div>
                                </div>
                                <div class="col m4 s4">
                                    <div class="capsule  neutral brand-style">
                                        <a class="capsule__btn"><i class="fa fa-thumbs-o-up fa-1_5x" aria-hidden="true"></i></a>
                                        <div class="capsule__body">50%</div>
                                    </div>
                                </div>
                                <div class="col m4 s4">
                                    <div class="capsule  disagree brand-style">
                                        <a class="capsule__btn "><i class="fa fa-thumbs-o-up fa-1_5x" aria-hidden="true"></i></a>
                                        <div class="capsule__body ">50%</div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>


                </div>
            </div>
            <div class="col m4 s12">

            </div>
        </div>
    </div>
    <div id="sportforum" class="col s12">
        <div class="row">
            <div class="col m3 s12">
                <div class="card z-depth-4" style="padding:0px;">
                    <div class="mb0">
                        <div class="">
                            <div class="center"><img class="forumcardimg" src="/CrowdWisdom/Code/webportal//images/blogs/Pictures-Download-HD-Car-Wallpapers1523964400.jpg" alt="Crowd Prediction"></div>
                        </div>
                    </div>
                    <div class="card_content" style="padding: 0 10px;">
                        <label class="forumsubhead text-uppercase fw700 fs12px">Elections</label>

                        <h6 class="fs14px" style="text-align:start">Why is Karnataka election such a close one?</h6>
                        <div class="row mb10">
                            <div class="col m6 s12"><h6 class="forumsubhead fs12px">3 March 2018</h6></div>
                            <div class="col m6 s12"><h6 class="forumsubhead fs12px right">By <a href="#">Anup Pandey</a></h6></div>
                        </div>
                        <div class="row mb10">
                            <div>
                                <div class="col m4 s4">
                                    <div class="capsule  agree brand-style">
                                        <a class="capsule__btn "><i class="fa fa-thumbs-o-up fa-1_5x" aria-hidden="true"></i></a>
                                        <div class="capsule__body ">50%</div>
                                    </div>
                                </div>
                                <div class="col m4 s4">
                                    <div class="capsule  neutral brand-style">
                                        <a class="capsule__btn"><i class="fa fa-thumbs-o-up fa-1_5x" aria-hidden="true"></i></a>
                                        <div class="capsule__body">50%</div>
                                    </div>
                                </div>
                                <div class="col m4 s4">
                                    <div class="capsule  disagree brand-style">
                                        <a class="capsule__btn "><i class="fa fa-thumbs-o-up fa-1_5x" aria-hidden="true"></i></a>
                                        <div class="capsule__body ">50%</div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>


                </div>
            </div>
            <div class="col m4 s12">

            </div>
        </div>
    </div>
    <div id="movieforum" class="col s12 ">
        <div class="row">
            <div class="col m3 s12">
                <div class="card z-depth-4" style="padding:0px;">
                    <div class="mb0">
                        <div class="">
                            <div class="center"><img class="forumcardimg" src="/CrowdWisdom/Code/webportal//images/blogs/Pictures-Download-HD-Car-Wallpapers1523964400.jpg" alt="Crowd Prediction"></div>
                        </div>
                    </div>
                    <div class="card_content" style="padding: 0 10px;">
                        <label class="forumsubhead text-uppercase fw700 fs12px">Elections</label>

                        <h6 class="fs14px" style="text-align:start">Why is Karnataka election such a close one?</h6>
                        <div class="row mb10">
                            <div class="col m6 s12"><h6 class="forumsubhead fs12px">3 March 2018</h6></div>
                            <div class="col m6 s12"><h6 class="forumsubhead fs12px right">By <a href="#">Anup Pandey</a></h6></div>
                        </div>
                        <div class="row mb10">
                            <div>
                                <div class="col m4 s4">
                                    <div class="capsule  agree brand-style">
                                        <a class="capsule__btn "><i class="fa fa-thumbs-o-up fa-1_5x" aria-hidden="true"></i></a>
                                        <div class="capsule__body ">50%</div>
                                    </div>
                                </div>
                                <div class="col m4 s4">
                                    <div class="capsule  neutral brand-style">
                                        <a class="capsule__btn"><i class="fa fa-thumbs-o-up fa-1_5x" aria-hidden="true"></i></a>
                                        <div class="capsule__body">50%</div>
                                    </div>
                                </div>
                                <div class="col m4 s4">
                                    <div class="capsule  disagree brand-style">
                                        <a class="capsule__btn "><i class="fa fa-thumbs-o-up fa-1_5x" aria-hidden="true"></i></a>
                                        <div class="capsule__body ">50%</div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>


                </div>
            </div>
            <div class="col m4 s12">

            </div>
        </div>
    </div>
</div>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.0.8/d3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/PieChart/js/donut-pie-chart.js" type="text/javascript"></script>-->
<script>
//    $(document).ready(function (e) {
//        $(".exp").donutpie();
//        var data = [
//            {"name": "JavaScript", "hvalue": 20},
//            {"name": "HTML5", "hvalue": 2},
//            {"name": "CSS3", "hvalue": 25},
//            // assign a color if you'd like to or one would be set for you.
//            {"name": "Ruby", "hvalue": 5, "color": "#00ff00"}
//        ];
//
//        $(".exp").donutpie('update', data);
//        $(".exp").donutpie({
//            radius: 5,
//            tooltip: true,
//            tooltipClass: "donut-pie-tooltip-bubble"
//        });
//    });
    //$('.dropdown-button').dropdown();

    $('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrain_width: false, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        gutter: 0, // Spacing from edge
        belowOrigin: false // Displays dropdown below the button
    }
    );
</script>

