<div class="content container">
    <div class="row minus-m-t8 mb-12">
        <div class="col l8 s12 plr15 equal-height">
            <div class="card z-depth-4 " >
                <div class="card-image p15 game1 covercenter">
                    <div class="center-align"><h4 class="mtb5 blueheader">Seat Prediction</h4></div>
                </div>
                <div class="card-content center">
                    <div class="" style="height: 54vh;"><img src="images/common/seat-forecast.png" style="margin: 10% 0;"/></div>
                    <!-- <div class="discription" style="font-size: 21px;font-weight: 400;color: #82828C;margin-bottom: 40px;line-height: 1.3;">How good you are in prediction? Wanna give a try as to see who would be the next ruling party in gujrat elections.</div> -->
                    <div class=""><a href="Login" class="btn btn-black btn-large w40">Predict Now</a></div>
                </div>
            </div>
        </div>
        <!--<div class="col m4 s12 plr15 equal-height">
            <div class="card z-depth-4 " >
                <div class="card-image game3 covercenter">
                    <div class="center-align"><h4 class="mtb5 blueheader">Constituency Level Prediction</h4></div>
                </div>
                <div class="card-content" style="padding:0">
                    <div class="center-align" style="height: 42vh;"><img src="images/common/map.png" style="margin: 25% 0;"/></div>
                    <div class="center-align discription" style="font-size: 21px;font-weight: 400;color: #82828C;margin-bottom: 40px;line-height: 1.3;">Did you try out the other games? Are you enjoying playing this.</div>
                </div>
                <div class="btn btn-large btn-black cardendbtn">save</div>
            </div>
        </div>-->
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
                                                    $target = "";
                                            }
                                    } else {
                                            $spchar = array ( "~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                                                "(", ")", "{", "}", "|", "/", ";", "'", "<",
                                                ">", "," );
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
                            <!--<div class="blogs">
                                <div class="row">
                                    <div class="col s5">
                                        <img src="images/common/profile.png" class="featured-img" style="width: 100%;">
                                    </div>
                                    <div class="col s7">
                                        <div class="blog-details text-upper">politics</div>
                                        <div class="blog-title truncate">This will some blog title on the website with truncate feature</div>
                                        <div class="blog-details">10 December 2017</div>
                                        <div class="blog-author">By <a href="">Subhash Chandra</a> &amp; <a href="">Amitabh Tiwari</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="blogs">
                                <div class="row">
                                    <div class="col s5">
                                        <img src="images/common/profile.png" class="featured-img" style="width: 100%;">
                                    </div>
                                    <div class="col s7">
                                        <div class="blog-details text-upper">politics</div>
                                        <div class="blog-title truncate">This will some blog title on the website with truncate feature</div>
                                        <div class="blog-details">10 December 2017</div>
                                        <div class="blog-author">By <a href="">Subhash Chandra</a> &amp; <a href="">Amitabh Tiwari</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="blogs">
                                <div class="row">
                                    <div class="col s5">
                                        <img src="images/common/profile.png" class="featured-img" style="width: 100%;">
                                    </div>
                                    <div class="col s7">
                                        <div class="blog-details text-upper">politics</div>
                                        <div class="blog-title truncate">This will some blog title on the website with truncate feature</div>
                                        <div class="blog-details">10 December 2017</div>
                                        <div class="blog-author">By <a href="">Subhash Chandra</a> &amp; <a href="">Amitabh Tiwari</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="blogs">
                                <div class="row">
                                    <div class="col s5">
                                        <img src="images/common/profile.png" class="featured-img" style="width: 100%;">
                                    </div>
                                    <div class="col s7">
                                        <div class="blog-details text-upper">politics</div>
                                        <div class="blog-title truncate">This will some blog title on the website with truncate feature</div>
                                        <div class="blog-details">10 December 2017</div>
                                        <div class="blog-author">By <a href="">Subhash Chandra</a> &amp; <a href="">Amitabh Tiwari</a></div>
                                    </div>
                                </div>
                            </div>-->
                        </div>
                    </div>    
                </div>
                <div class="card-footer" style="">
                    <a href="<?= base_url() ?>Blogs" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-2" style="">
        <div class="col l8 s12 plr15 equal-height">
            <div class="card z-depth-4 " >
                <div class="card-image p15 game2 covercenter">
                    <div class="center-align"><h4 class="mtb5 blueheader">Vote Prediction</h4></div>
                </div>
                <div class="card-content" style="padding:0">
                    <div class="center-align" style="height: 54vh;"><img src="images/common/vote-forecast.png" style="margin: 10% 0;"/></div>
                    <!-- <div class="center-align discription" style="font-size: 21px;font-weight: 400;color: #82828C;margin-bottom: 40px;line-height: 1.3;">How good you are in prediction? Wanna give a try as to see who would be the next ruling party in gujrat elections.</div> -->
                    <div class="center-align"><a href="Login" class="btn btn-black btn-large w40">Predict Now</a></div>
                </div>
            </div>
        </div>
        <div class="col l4 s12 plr15 equal-height hide-on-med-and-down">
            <div class="card z-depth-4 padd0">
                <div class="card-head">
                    <div class="twitterhead">Rewards</div>
                </div>
                <div class="tweets-container withtable">
                    <?php
//                    foreach ($tweets as $result) {
//
//                        echo '<div class="tweets">
//                                    <div class="col m3"><img src="' . $result->user->profile_image_url_https . '" class="tweetprofile"></div>
//                                    <div class="col m9">
//                                        <div class="tweetname">' . $result->user->name . '</div>
//                                        <div class="tweetusername">@' . strtolower(str_replace(' ', '', $result->user->name)) . '</div>
//                                    </div>
//                                    <div class="col m12">
//                                        <div class="tweettext">' . $result->text . '</div>
//                                        <h6 class="tweetdate">' . str_replace('+0000', '', $result->created_at) . '</h6>
//                                    </div>
//                                </div>';
//                    }
                    ?>
                    <!-- <div class="tweets">
                        <div class="col m3"><img src="images/common/profile.png" class="tweetprofile"></div>
                        <div class="col m9">
                            <div class="tweetname">Vineet Balan</div>
                            <div class="tweetusername">@vinitbalan</div>
                        </div>
                        <div class="col m12">
                            <div class="tweettext">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                            <h6 class="tweetdate">10 AM &nbsp;&nbsp;&#8226;&nbsp;&nbsp; 10 December 2017</h6>
                        </div>
                    </div>
                    <div class="tweets">
                        <div class="col m3"><img src="images/common/profile.png" class="tweetprofile"></div>
                        <div class="col m9">
                            <div class="tweetname">Vineet Balan</div>
                            <div class="tweetusername">@vinitbalan</div>
                        </div>
                        <div class="col m12">
                            <div class="tweettext">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                            <h6 class="tweetdate">10 AM &nbsp;&nbsp;&#8226;&nbsp;&nbsp; 10 December 2017</h6>
                        </div>
                    </div>
                    <div class="tweets">
                        <div class="col m3"><img src="images/common/profile.png" class="tweetprofile"></div>
                        <div class="col m9">
                            <div class="tweetname">Vineet Balan</div>
                            <div class="tweetusername">@vinitbalan</div>
                        </div>
                        <div class="col m12">
                            <div class="tweettext">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                            <h6 class="tweetdate">10 AM &nbsp;&nbsp;&#8226;&nbsp;&nbsp; 10 December 2017</h6>
                        </div>
                    </div>
                    <div class="tweets">
                        <div class="col m3"><img src="images/common/profile.png" class="tweetprofile"></div>
                        <div class="col m9">
                            <div class="tweetname">Vineet Balan</div>
                            <div class="tweetusername">@vinitbalan</div>
                        </div>
                        <div class="col m12">
                            <div class="tweettext">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                            <h6 class="tweetdate">10 AM &nbsp;&nbsp;&#8226;&nbsp;&nbsp; 10 December 2017</h6>
                        </div>
                    </div>
                    <div class="tweets">
                        <div class="col m3"><img src="images/common/profile.png" class="tweetprofile"></div>
                        <div class="col m9">
                            <div class="tweetname">Vineet Balan</div>
                            <div class="tweetusername">@vinitbalan</div>
                        </div>
                        <div class="col m12">
                            <div class="tweettext">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                            <h6 class="tweetdate">10 AM &nbsp;&nbsp;&#8226;&nbsp;&nbsp; 10 December 2017</h6>
                        </div>
                    </div>
                    <div class="tweets">
                        <div class="col m3"><img src="images/common/profile.png" class="tweetprofile"></div>
                        <div class="col m9">
                            <div class="tweetname">Vineet Balan</div>
                            <div class="tweetusername">@vinitbalan</div>
                        </div>
                        <div class="col m12">
                            <div class="tweettext">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                            <h6 class="tweetdate">10 AM &nbsp;&nbsp;&#8226;&nbsp;&nbsp; 10 December 2017</h6>
                        </div>
                    </div> -->
                </div>
                <!--                <div class="card-footer" style="">
                                    <a target="_blank" href="https://twitter.com/search?f=tweets&q=%23KarnatakaElection2018" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                                </div>-->
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
                            foreach ( $blogs as $blog_list ):
                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                                    if ( ! empty( $blog_list[ 'link' ] ) ) {
                                            if ( preg_match( $reg_exUrl, $blog_list[ 'link' ], $url ) ) {
                                                    $href = $url[ 0 ];
                                                    $target = 'target = "_blank"';
                                            } else {
                                                    $href = base_url() . $blog_list[ 'link' ];
                                                    $target = "";
                                            }
                                    } else {
                                            $spchar = array ( "~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                                                "(", ")", "{", "}", "|", "/", ";", "'", "<",
                                                ">", "," );
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
                            <!--<div class="blogs">
                                <div class="row">
                                    <div class="col s5">
                                        <img src="images/common/profile.png" class="featured-img" style="width: 100%;">
                                    </div>
                                    <div class="col s7">
                                        <div class="blog-details text-upper">politics</div>
                                        <div class="blog-title truncate">This will some blog title on the website with truncate feature</div>
                                        <div class="blog-details">10 December 2017</div>
                                        <div class="blog-author">By <a href="">Subhash Chandra</a> &amp; <a href="">Amitabh Tiwari</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="blogs">
                                <div class="row">
                                    <div class="col s5">
                                        <img src="images/common/profile.png" class="featured-img" style="width: 100%;">
                                    </div>
                                    <div class="col s7">
                                        <div class="blog-details text-upper">politics</div>
                                        <div class="blog-title truncate">This will some blog title on the website with truncate feature</div>
                                        <div class="blog-details">10 December 2017</div>
                                        <div class="blog-author">By <a href="">Subhash Chandra</a> &amp; <a href="">Amitabh Tiwari</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="blogs">
                                <div class="row">
                                    <div class="col s5">
                                        <img src="images/common/profile.png" class="featured-img" style="width: 100%;">
                                    </div>
                                    <div class="col s7">
                                        <div class="blog-details text-upper">politics</div>
                                        <div class="blog-title truncate">This will some blog title on the website with truncate feature</div>
                                        <div class="blog-details">10 December 2017</div>
                                        <div class="blog-author">By <a href="">Subhash Chandra</a> &amp; <a href="">Amitabh Tiwari</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="blogs">
                                <div class="row">
                                    <div class="col s5">
                                        <img src="images/common/profile.png" class="featured-img" style="width: 100%;">
                                    </div>
                                    <div class="col s7">
                                        <div class="blog-details text-upper">politics</div>
                                        <div class="blog-title truncate">This will some blog title on the website with truncate feature</div>
                                        <div class="blog-details">10 December 2017</div>
                                        <div class="blog-author">By <a href="">Subhash Chandra</a> &amp; <a href="">Amitabh Tiwari</a></div>
                                    </div>
                                </div>
                            </div>-->
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
//                                    <div class="col m3"><img src="' . $result->user->profile_image_url_https . '" class="tweetprofile"></div>
//                                    <div class="col m9">
//                                        <div class="tweetname">' . $result->user->name . '</div>
//                                        <div class="tweetusername">@' . strtolower(str_replace(' ', '', $result->user->name)) . '</div>
//                                    </div>
//                                    <div class="col m12">
//                                        <div class="tweettext">' . $result->text . '</div>
//                                        <h6 class="tweetdate">' . str_replace('+0000', '', $result->created_at) . '</h6>
//                                    </div>
//                                </div>';
//                    }
                    ?>
                    <!-- <div class="tweets">
                        <div class="col m3"><img src="images/common/profile.png" class="tweetprofile"></div>
                        <div class="col m9">
                            <div class="tweetname">Vineet Balan</div>
                            <div class="tweetusername">@vinitbalan</div>
                        </div>
                        <div class="col m12">
                            <div class="tweettext">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                            <h6 class="tweetdate">10 AM &nbsp;&nbsp;&#8226;&nbsp;&nbsp; 10 December 2017</h6>
                        </div>
                    </div>
                    <div class="tweets">
                        <div class="col m3"><img src="images/common/profile.png" class="tweetprofile"></div>
                        <div class="col m9">
                            <div class="tweetname">Vineet Balan</div>
                            <div class="tweetusername">@vinitbalan</div>
                        </div>
                        <div class="col m12">
                            <div class="tweettext">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                            <h6 class="tweetdate">10 AM &nbsp;&nbsp;&#8226;&nbsp;&nbsp; 10 December 2017</h6>
                        </div>
                    </div>
                    <div class="tweets">
                        <div class="col m3"><img src="images/common/profile.png" class="tweetprofile"></div>
                        <div class="col m9">
                            <div class="tweetname">Vineet Balan</div>
                            <div class="tweetusername">@vinitbalan</div>
                        </div>
                        <div class="col m12">
                            <div class="tweettext">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                            <h6 class="tweetdate">10 AM &nbsp;&nbsp;&#8226;&nbsp;&nbsp; 10 December 2017</h6>
                        </div>
                    </div>
                    <div class="tweets">
                        <div class="col m3"><img src="images/common/profile.png" class="tweetprofile"></div>
                        <div class="col m9">
                            <div class="tweetname">Vineet Balan</div>
                            <div class="tweetusername">@vinitbalan</div>
                        </div>
                        <div class="col m12">
                            <div class="tweettext">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                            <h6 class="tweetdate">10 AM &nbsp;&nbsp;&#8226;&nbsp;&nbsp; 10 December 2017</h6>
                        </div>
                    </div>
                    <div class="tweets">
                        <div class="col m3"><img src="images/common/profile.png" class="tweetprofile"></div>
                        <div class="col m9">
                            <div class="tweetname">Vineet Balan</div>
                            <div class="tweetusername">@vinitbalan</div>
                        </div>
                        <div class="col m12">
                            <div class="tweettext">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                            <h6 class="tweetdate">10 AM &nbsp;&nbsp;&#8226;&nbsp;&nbsp; 10 December 2017</h6>
                        </div>
                    </div>
                    <div class="tweets">
                        <div class="col m3"><img src="images/common/profile.png" class="tweetprofile"></div>
                        <div class="col m9">
                            <div class="tweetname">Vineet Balan</div>
                            <div class="tweetusername">@vinitbalan</div>
                        </div>
                        <div class="col m12">
                            <div class="tweettext">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                            <h6 class="tweetdate">10 AM &nbsp;&nbsp;&#8226;&nbsp;&nbsp; 10 December 2017</h6>
                        </div>
                    </div> -->
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