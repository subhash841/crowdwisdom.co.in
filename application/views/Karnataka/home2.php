<!-- <style>
    /* scroll bar */
    .card-content.withtable::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(255,255,255,0.3);
        border-radius: 5px;
        /*background-color: #F5F5F5;*/
        background-color: #FFFFFF;
    }

    .card-content.withtable::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #eff2f8;
    }

    .card-content.withtable::-webkit-scrollbar {
        width: 10px;
        /*background-color: #F55F5;*/
        background-color: #FFFFFF;
    }

    .tweets-container.withtable::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(255,255,255,0.3);
        border-radius: 5px;
        /*background-color: #F5F5F5;*/
        background-color: #FFFFFF;
    }

    .tweets-container.withtable::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #eff2f8;
    }

    .tweets-container.withtable::-webkit-scrollbar {
        width: 10px;
        /*background-color: #F55F5;*/
        background-color: #FFFFFF;
    }
    /* scroll bar ends*/

    .cardendbtn{
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
    }

    .party-img{
        cursor: pointer;
    }
    div.party-div .party-img {
        position: relative;
        line-height: 0;
    }
    div.party-div.selected .overlay {
        position: absolute;
        top: 0;
        left: 50%;
        bottom: 0;
        background: rgba(9,177,228,.5);
        width: 65%;
        transform: translate(-50%);
        display: block;
    }

    div.party-div .overlay{
        display: none;
    }

    div.party-div.selected .overlay i {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        color: white;
        text-shadow: 1px 1px 2px #000;
    }
</style> -->
<div class="content container">
    <div class="row minus-m-t8"><!--mb-12-->
        <div class="col l8 s12 plr15 equal-height">
            <form name="user_forecast" id="user_forecast" method="post">
                <div class="card z-depth-4 sm-card">
                    <div class="card-image">
                        <div class="game1 p15 coverleft">
                            <div class="left"><h4 class="mtb5 cardheader blueheader">Your Seat Prediction</h4></div>
                            <?php
                            if ($election_period[0]['is_result_out'] == "0") {
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
                            <input type="hidden" name="election_period" id="election_period" value="<?= $election_period[0]['id'] ?>">
                            <input type="hidden" name="election_state" id="election_state" value="<?= $states[0]['id'] ?>">
                            <tbody>
                                <?php
                                //$actual_seats = ($election_period[0]['is_result_out'] != 0) ? $seat_forecast['actual_seats'] : "TBA";
                                foreach ($user_forecast as $seat_forecast) {
                                    echo '<tr>
                                            <td><img src="' . base_url() . 'images/party_logos/' . $seat_forecast['party_icon'] . '"></td>
                                            <td><h5 class="partyname">' . $seat_forecast['party'] . '</h5>
                                                <h6 class="caption">' . $seat_forecast['abbreviation'] . '</h6>
                                            </td>
                                            <td>
                                                <input type="hidden" name="party[]" id="party" value="' . $seat_forecast['party_id'] . '" />
                                                <input type="text" class="center-align" name="seat_forecast[]" value="' . $seat_forecast['seat_forecast'] . '" />
                                            </td>
                                        </tr>';
                                }
                                ?>
                            </tbody>
                        </table> 
                    </div>
                    <?php
                    if ($election_period[0]['is_result_out'] == "0") {
                        ?>
                        <div class="hide-on-large-only center-align" style="padding-top: 20px;">
                            <input class="btn btn-black savebtn" type="submit" name="save_forecast" id="save_forecast" value="Save">
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </form>
        </div>
        <!--<div class="col m4 s12 plr15 equal-height">
            <div class="card z-depth-4 " style="">
                <div class="card-image">

                </div>
                <div class="card-content">

                </div>
                <div class="card-action">

                </div>
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
                                $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
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
    <div class="row mb-9">
        <div class="col l8 s12 plr15 equal-height">
            <form name="user_vote_forecast" id="user_vote_forecast" method="post">
                <div class="card z-depth-4 sm-card">
                    <div class="card-image">
                        <div class="game2 p15 coverleft">
                            <div class="left"><h4 class="mtb5 cardheader blueheader">Your Vote Prediction</h4></div>
                            <?php
                            if ($election_period[0]['is_result_out'] == "0") {
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
                            <input type="hidden" name="election_period" id="election_period" value="<?= $election_period[0]['id'] ?>">
                            <input type="hidden" name="election_state" id="election_state" value="<?= $states[0]['id'] ?>">
                            <tbody>
                                <?php
                                //$actual_votes = ($election_period[0]['is_result_out'] != 0) ? $vote_forecast['actual_votes'] : "TBA";
                                foreach ($user_forecast as $vote_forecast) {

                                    echo '<tr>
                                            <td><img src="' . base_url() . 'images/party_logos/' . $vote_forecast['party_icon'] . '"></td>
                                            <td><h5 class="partyname">' . $vote_forecast['party'] . '</h5>
                                                <h6 class="caption">' . $vote_forecast['abbreviation'] . '</h6>
                                            </td>
                                            <td>
                                                <input type="hidden" name="party[]" id="party" value="' . $vote_forecast['party_id'] . '" />
                                                <input type="text" class="center-align" name="vote_forecast[]" value="' . $vote_forecast['vote_forcast'] . '" />
                                            </td>
                                        </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    if ($election_period[0]['is_result_out'] == "0") {
                        ?>
                        <div class="hide-on-large-only center-align" style="padding-top: 20px;">
                            <input class="btn btn-black savebtn" type="submit" name="save_forecast" id="save_forecast" value="Save">
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </form>
        </div>
        <!--        <div class="col m4 s12 plr15 equal-height">
                    <div class="card z-depth-4">
                        <div class="card-image game3 covercenter">
                            <div class="center-align"><h4 class="mtb5 blueheader">Constituency Level Prediction</h4></div>
                        </div>
                        <form name="user_constituency_forecast" id="user_constituency_forecast" action="Dashboard/updateUserConstituencyForecast" method="POST">
                            <div class="card-content center" style="padding:0">
                                <div class="input-field">
                                    <select name="constituencies_list" id="constituencies_list">
                                        <option value="0" disabled selected required>Select Constituency</option>
        <?php
        foreach ($constituencies as $constituencies_list) {
            echo '<option value="' . $constituencies_list['id'] . '">' . $constituencies_list['name'] . '</option>';
        }
        ?>
                                    </select>
                                </div>
                                <h6 class="center" style="margin: 10% 0px;">Select one of the party</h6>
        <?php
        foreach ($parties as $parties_list) {
            echo '<div class="col m4">
                                    <div id="party' . $parties_list['id'] . '" class="party-div">
                                        <input type="radio" name="select_party" value="' . $parties_list['id'] . '" />
                                        <div class="party-img">
                                            <img src="images/party_logos/' . $parties_list['icon'] . '" style="width:65%">
                                            <div class="overlay">
                                                <i class="material-icons">check</i>
                                            </div>
                                        </div>
                                        <h6>' . $parties_list['abbreviation'] . '</h6>
                                    </div>
                                </div>';
        }
        ?>
                            </div>
                            <input class="btn btn-large btn-black cardendbtn" type="submit" name="save_constituency" id="save_constituency" value="Save">
                        </form>
                    </div>
                </div>-->
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
</div>
<script>
    $(function () {
<?php if ($this->input->get('section') == 'seat'): ?>
            var gotodo = $('#user_forecast').offset().top - $('.nav-wrapper.container').height();
            $("html, body").animate({scrollTop: gotodo}, 1000);
<?php elseif ($this->input->get('section') == 'vote'): ?>
            var gotodo = $('#user_vote_forecast').offset().top - $('.nav-wrapper.container').height();
            $("html, body").animate({scrollTop: gotodo}, 1000);
<?php endif; ?>

        $('#user_forecast').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                "url": "Dashboard/updateUserForecast",
                "method": "POST",
                "data": $(this).serialize()
            }).done(function (result) {
                result = JSON.parse(result);

                if (result.status) {
                    Materialize.Toast.removeAll();
                    Materialize.toast(result.message + '!', 4000);

                    setTimeout(function () {
                        //window.location.assign("Dashboard");
                        var gotogame2 = $('#user_vote_forecast').offset().top - $('.nav-wrapper.container').height();
                        $("html, body").animate({scrollTop: gotogame2}, 1000);
                    }, 1000);
                }
                else {
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
                    Materialize.Toast.removeAll();
                    Materialize.toast(result.message + '!', 4000);
                }
                else {
                    Materialize.Toast.removeAll();
                    Materialize.toast(result.message + '!', 4000);
                }
            });
        });

        $(".party-img").on('click', function () {
            $(".party-div").removeClass("selected");
            $("input[name=select_constituency]").removeAttr("checked");

            $(this).closest(".col").find(".party-div").addClass("selected");
            $(this).closest(".col").find("input[name=select_constituency]").attr("checked", "checked");
        });
    });
</script>