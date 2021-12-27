<div class="content container">
    <div class="row minus-m-t13 mb-12">
        <div class="col l8 s12 plr15 equal-height">
            <div class="card z-depth-4 " >
                <div class="card-image p15 covercenter stocks-bg">
                    <div class="center-align">
                        <h4 class="mtb5 cardheader blueheader">Today's Stocks </h4>
                    </div>
                </div>
                <div class="card-content center">
                    <div class="row loserslist">
                        <div class="col s12">
                            <table class="yourstock">
                                <tr>
                                    <th>STOCK/INDEX</th>
                                    <th>WEEKLY</th>
                                    <th>MONTHLY</th>
                                    <th>YEARLY</th>
                                </tr>
                                <tr>
                                    <td class="f18">
                                        AMBUJACEM
                                        <div class="fw block">267.00</div>
                                    </td>
                                    <td>948.80</td>
                                    <td>948.80</td>
                                    <td>948.80</td>
                                </tr>
                                <tr>
                                    <td class="f18">
                                        AMBUJACEM
                                        <div class="fw block">267.00</div>
                                    </td>
                                    <td>948.80</td>
                                    <td>948.80</td>
                                    <td>948.80</td>
                                </tr>
                                <tr>
                                    <td class="f18">
                                        AMBUJACEM
                                        <div class="fw block">267.00</div>
                                    </td>
                                    <td>948.80</td>
                                    <td>948.80</td>
                                    <td>948.80</td>
                                </tr>
                                <tr>
                                    <td class="f18">
                                        AMBUJACEM
                                        <div class="fw block">267.00</div>
                                    </td>
                                    <td>948.80</td>
                                    <td>948.80</td>
                                    <td>948.80</td>
                                </tr>
                                <tr>
                                    <td class="f18">
                                        AMBUJACEM
                                        <div class="fw block">267.00</div>
                                    </td>
                                    <td>948.80</td>
                                    <td>948.80</td>
                                    <td>948.80</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="discription" style="font-size: 21px;font-weight: 400;color: #82828C;margin-bottom: 40px;line-height: 1.3;">How good you are in prediction? Wanna give a try as to see who would be the next ruling party in gujrat elections.</div> -->
                    <div class="center-align">
                        <a href="../Login?section=stocks" class="btn btn-black btn-large stocksavebtn">Predict now</a>
                    </div>
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
                            foreach ($blogs as $blog_list):
                                if (!empty($blog_list['link'])) {
                                    if (preg_match($reg_exUrl, $blog_list['link'], $url)) {
                                        $href = $url[0];
                                        $target = 'target = "_blank"';
                                    } else {
                                        $href = base_url() . $blog_list['link'];
                                        $target = "";
                                    }
                                } else {
                                    $title=preg_replace('/[^A-Za-z0-9 \-]/', '',$blog_list['title']); 
                                    $title=str_replace(' ','_',$title);
                                    $href = base_url() . 'Blogs/getBlogs/' . $blog_list['id'];
                                    $target = 'target = "_blank"';
                                }
                                echo '<div class="blogs">
                                        <a href="' . $href . '" ' . $target . '>
                                            <div class="row">
                                                <div class="col s5">
                                                    <img src="' . base_url() . 'images/blogs/' . $blog_list['image'] . '" class="featured-img" style="width: 100%;">
                                                </div>
                                                <div class="col s7">
                                                    <div class="blog-details text-upper">politics</div>
                                                    <div class="blog-title truncate">' . $blog_list['title'] . '</div>
                                                    <div class="blog-details">' . date("d F Y", strtotime($blog_list['created_date'])) . '</div>
                                                    <div class="blog-author"><a href="">' . $blog_list['name'] . '</a></a></div>
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
    <div class="row mb-9" style="">
        <div class="col l8 s12 plr15 equal-height">
            <div class="card z-depth-4">
                <div class="card-image p15 covercenter forecast-bg">
                    <div class="center-align"><h4 class="mtb5 cardheader blueheader">Current Seat Prediction </h4></div>
                </div>
                <h5 class="center-align grey-color">Results displayed are for karnataka's seat forecast</h5>    
                <div class="row" style="margin-bottom: 0;margin-top: 20px;">
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
                </div>
                <div class="card-content withtable" style="margin: 30px 0;">
                    <div class="row">
                        <div class="col s12 l6" data-n="223">
                            <div class="row">
                                <div class="col s3 equal-height-child" style="height: 74px;"><img src="../../images/party_logos/Congress.png" style="width: 68px;" class="forecast-result-logo"></div>
                                <div class="col s3 equal-height-child" style="height: 74px;">
                                    <div class="" style="margin: 10px;">
                                        <div class="vfparty">INC</div>
                                        <div class="vfseats">71</div>
                                    </div>
                                </div>
                                <!--<div class="col s5 m5 l5 progress-container">
                                    <div class="progress">
                                        <div class="determinate" style="width: 71%"></div>
                                    </div>
                                </div>-->
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="max-count mmax-count">114</div>
                                </div>
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="min-count mmax-count">0</div>
                                </div>
                            </div>
                        </div><div class="col s12 l6" data-n="223">
                            <div class="row">
                                <div class="col s3 equal-height-child" style="height: 74px;"><img src="../../images/party_logos/bjp.png" style="width: 68px;" class="forecast-result-logo"></div>
                                <div class="col s3 equal-height-child" style="height: 74px;">
                                    <div class="" style="margin: 10px;">
                                        <div class="vfparty">BJP</div>
                                        <div class="vfseats">108</div>
                                    </div>
                                </div>
                                <!--<div class="col s5 m5 l5 progress-container">
                                    <div class="progress">
                                        <div class="determinate" style="width: 108%"></div>
                                    </div>
                                </div>-->
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="max-count mmax-count">135</div>
                                </div>
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="min-count mmax-count">0</div>
                                </div>
                            </div>
                        </div><div class="col s12 l6" data-n="223">
                            <div class="row">
                                <div class="col s3 equal-height-child" style="height: 74px;"><img src="../../images/party_logos/Janata_Dal_Secular.png" style="width: 68px;" class="forecast-result-logo"></div>
                                <div class="col s3 equal-height-child" style="height: 74px;">
                                    <div class="" style="margin: 10px;">
                                        <div class="vfparty">JDS</div>
                                        <div class="vfseats">37</div>
                                    </div>
                                </div>
                                <!--<div class="col s5 m5 l5 progress-container">
                                    <div class="progress">
                                        <div class="determinate" style="width: 37%"></div>
                                    </div>
                                </div>-->
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="max-count mmax-count">80</div>
                                </div>
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="min-count mmax-count">0</div>
                                </div>
                            </div>
                        </div><div class="col s12 l6" data-n="223">
                            <div class="row">
                                <div class="col s3 equal-height-child" style="height: 74px;"><img src="../../images/party_logos/no-logo.png" style="width: 68px;" class="forecast-result-logo"></div>
                                <div class="col s3 equal-height-child" style="height: 74px;">
                                    <div class="" style="margin: 10px;">
                                        <div class="vfparty">INP</div>
                                        <div class="vfseats">5</div>
                                    </div>
                                </div>
                                <!--<div class="col s5 m5 l5 progress-container">
                                    <div class="progress">
                                        <div class="determinate" style="width: 5%"></div>
                                    </div>
                                </div>-->
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="max-count mmax-count">10</div>
                                </div>
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="min-count mmax-count">0</div>
                                </div>
                            </div>
                        </div><div class="col s12 l6" data-n="223">
                            <div class="row">
                                <div class="col s3 equal-height-child" style="height: 74px;"><img src="../../images/party_logos/no-logo.png" style="width: 68px;" class="forecast-result-logo"></div>
                                <div class="col s3 equal-height-child" style="height: 74px;">
                                    <div class="" style="margin: 10px;">
                                        <div class="vfparty">OTH</div>
                                        <div class="vfseats">3</div>
                                    </div>
                                </div>
                                <!--<div class="col s5 m5 l5 progress-container">
                                    <div class="progress">
                                        <div class="determinate" style="width: 3%"></div>
                                    </div>
                                </div>-->
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="max-count mmax-count">20</div>
                                </div>
                                <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                    <div class="min-count mmax-count">0</div>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>

                <div class="center-align" >
                    <a href="../Login?section=seat" class="btn btn-black btn-large stocksavebtn">Predict now</a>
                </div>
            </div>
            <!--            <div class="card z-depth-4 " >
                            <div class="card-image p15 game2 covercenter">
                                <div class="center-align"><h4 class="mtb5 blueheader">Vote Prediction</h4></div>
                            </div>
                            <div class="card-content withtable">
                                <div class="row">
                                    <div class="col s12 l6" data-n="99">
                                        <div class="row">
                                            <div class="col s3 equal-height-child" style="height: 74px;"><img src="../images/party_logos/bjp.png" style="width: 68px;" class="forecast-result-logo"></div>
                                            <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="forecast-result-percent mmax-count">
                                                    <div class="vfparty">BJP</div>
                                                </div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="max-count mmax-count">49.10 %</div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="min-count mmax-count">47 %</div>
                                            </div>
                                        </div>
                                    </div><div class="col s12 l6" data-n="99">
                                        <div class="row">
                                            <div class="col s3 equal-height-child" style="height: 74px;"><img src="../images/party_logos/Congress.png" style="width: 68px;" class="forecast-result-logo"></div>
                                            <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="forecast-result-percent mmax-count">
                                                    <div class="vfparty">INC</div>
                                                </div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="max-count mmax-count">42.30 %</div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="min-count mmax-count">41 %</div>
                                            </div>
                                        </div>
                                    </div><div class="col s12 l6" data-n="99">
                                        <div class="row">
                                            <div class="col s3 equal-height-child" style="height: 74px;"><img src="../images/party_logos/bahujan-samaj-party.png" style="width: 68px;" class="forecast-result-logo"></div>
                                            <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="forecast-result-percent mmax-count">
                                                    <div class="vfparty">BSP</div>
                                                </div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="max-count mmax-count">0.70 %</div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="min-count mmax-count">1 %</div>
                                            </div>
                                        </div>
                                    </div><div class="col s12 l6" data-n="99">
                                        <div class="row">
                                            <div class="col s3 equal-height-child" style="height: 74px;"><img src="../images/party_logos/no-logo.png" style="width: 68px;" class="forecast-result-logo"></div>
                                            <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="forecast-result-percent mmax-count">
                                                    <div class="vfparty">AIHCP</div>
                                                </div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="max-count mmax-count">0.30 %</div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="min-count mmax-count">1 %</div>
                                            </div>
                                        </div>
                                    </div><div class="col s12 l6" data-n="99">
                                        <div class="row">
                                            <div class="col s3 equal-height-child" style="height: 74px;"><img src="../images/party_logos/ncp.png" style="width: 68px;" class="forecast-result-logo"></div>
                                            <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="forecast-result-percent mmax-count">
                                                    <div class="vfparty">NCP</div>
                                                </div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="max-count mmax-count">0.60 %</div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="min-count mmax-count">1 %</div>
                                            </div>
                                        </div>
                                    </div><div class="col s12 l6" data-n="99">
                                        <div class="row">
                                            <div class="col s3 equal-height-child" style="height: 74px;"><img src="../images/party_logos/shs.png" style="width: 68px;" class="forecast-result-logo"></div>
                                            <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="forecast-result-percent mmax-count">
                                                    <div class="vfparty">SHS</div>
                                                </div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="max-count mmax-count">0.00 %</div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="min-count mmax-count">0 %</div>
                                            </div>
                                        </div>
                                    </div><div class="col s12 l6" data-n="99">
                                        <div class="row">
                                            <div class="col s3 equal-height-child" style="height: 74px;"><img src="../images/party_logos/no-logo.png" style="width: 68px;" class="forecast-result-logo"></div>
                                            <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="forecast-result-percent mmax-count">
                                                    <div class="vfparty">INP</div>
                                                </div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="max-count mmax-count">4.30 %</div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="min-count mmax-count">4 %</div>
                                            </div>
                                        </div>
                                    </div><div class="col s12 l6" data-n="99">
                                        <div class="row">
                                            <div class="col s3 equal-height-child" style="height: 74px;"><img src="../images/party_logos/no-logo.png" style="width: 68px;" class="forecast-result-logo"></div>
                                            <div class="col s2 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="forecast-result-percent mmax-count">
                                                    <div class="vfparty">OTH</div>
                                                </div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="max-count mmax-count">2.70 %</div>
                                            </div>
                                            <div class="col s3 equal-height-child mmax-container" style="height: 74px;">
                                                <div class="min-count mmax-count">5 %</div>
                                            </div>
                                        </div>
                                    </div>                    
                                </div>
                                
                            </div>
                            <div class="center-align"><a href="Login" class="btn btn-black btn-large w40">Predict Now</a></div>
                                            <div class="card-content" style="padding:0">
                                                <div class="center-align" style="height: 54vh;"><img src="images/common/vote-forecast.png" style="margin: 10% 0;"/></div>
                                                 <div class="center-align discription" style="font-size: 21px;font-weight: 400;color: #82828C;margin-bottom: 40px;line-height: 1.3;">How good you are in prediction? Wanna give a try as to see who would be the next ruling party in gujrat elections.</div> 
                                                
                                            </div>
                                        </div>-->
                                    </div>
                                    <div class="col l4 s12 plr15 equal-height hide-on-med-and-down">
                                        <div class="card z-depth-4 padd0">
                                            <div class="card-head">
                                                <div class="twitterhead">Twitter Tweets</div>
                                            </div>
                                            <div class="tweets-container withtable">
                                                <?php
                                                foreach ($tweets as $result) {

                                                    echo '<div class="tweets">
                                                    <div class="col m3"><img src="' . $result->user->profile_image_url_https . '" class="tweetprofile"></div>
                                                    <div class="col m9">
                                                    <div class="tweetname">' . $result->user->name . '</div>
                                                    <div class="tweetusername">@' . strtolower(str_replace(' ', '', $result->user->name)) . '</div>
                                                    </div>
                                                    <div class="col m12">
                                                    <div class="tweettext">' . $result->text . '</div>
                                                    <h6 class="tweetdate">' . str_replace('+0000', '', $result->created_at) . '</h6>
                                                    </div>
                                                    </div>';
                                                }
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
                <div class="card-footer" style="">
                    <a target="_blank" href="https://twitter.com/search?f=tweets&q=%23KarnatakaElection2018" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                </div>
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
                            foreach ($blogs as $blog_list):
                                if (!empty($blog_list['link'])) {
                                    if (preg_match($reg_exUrl, $blog_list['link'], $url)) {
                                        $href = $url[0];
                                        $target = 'target = "_blank"';
                                    } else {
                                        $href = base_url() . $blog_list['link'];
                                        $target = "";
                                    }
                                } else {
                                    $title=preg_replace('/[^A-Za-z0-9 \-]/', '',$blog_list['title']); 
                                    $title=str_replace(' ','_',$title);
                                    $href = base_url() . 'Blogs/getBlogs/' . $blog_list['id'];
                                    $target = 'target = "_blank"';
                                }
                                echo '<div class="blogs">
                                        <a href="' . $href . '" ' . $target . '>
                                            <div class="row">
                                                <div class="col s5">
                                                    <img src="' . base_url() . 'images/blogs/' . $blog_list['image'] . '" class="featured-img" style="width: 100%;">
                                                </div>
                                                <div class="col s7">
                                                    <div class="blog-details text-upper">politics</div>
                                                    <div class="blog-title truncate">' . $blog_list['title'] . '</div>
                                                    <div class="blog-details">' . date("d F Y", strtotime($blog_list['created_date'])) . '</div>
                                                    <div class="blog-author"><a href="">' . $blog_list['name'] . '</a></a></div>
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
                    <div class="twitterhead">Twitter Tweets</div>
                </div>
                <div class="tweets-container withtable">
                    <?php
                    foreach ($tweets as $result) {

                        echo '<div class="tweets">
                        <div class="col m3"><img src="' . $result->user->profile_image_url_https . '" class="tweetprofile"></div>
                        <div class="col m9">
                        <div class="tweetname">' . $result->user->name . '</div>
                        <div class="tweetusername">@' . strtolower(str_replace(' ', '', $result->user->name)) . '</div>
                        </div>
                        <div class="col m12">
                        <div class="tweettext">' . $result->text . '</div>
                        <h6 class="tweetdate">' . str_replace('+0000', '', $result->created_at) . '</h6>
                        </div>
                        </div>';
                    }
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
                <div class="card-footer" style="">
                    <a target="_blank" href="https://twitter.com/search?f=tweets&q=%23KarnatakaElection2018" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                </div>
            </div>
        </div>
    </div>
</div>