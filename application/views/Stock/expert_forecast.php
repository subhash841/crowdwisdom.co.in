<div class="content container stock-forecast-container">
    <div class="row minus-m-t13 mb-12">
        <div class="col l8 s12 plr15 equal-height">
            <div class="card z-depth-4 " >
                <div class="card-image p15 covercenter stocks-bg">
                    <div class="center-align"><h4 class="mtb5 cardheader blueheader">Expert's Stocks </h4></div>
                </div>
                <div class="card-content center">
                    <div class="row gainerslist">
                        <div class="col s12">
                            <input type="hidden" name="stock_codes" id="stock_codes" value="<?= $stock_codes; ?>" />
                            <table class="yourstock bindStockPrice">
                                <tr>
                                    <th>STOCK/INDEX</th>
                                    <th>WEEKLY <br /><?= ($weekly_endon_date == "") ? "" : "(" . date("d-m-Y", strtotime($weekly_endon_date)) . ")" ?></th>
                                    <th>MONTHLY <br /><?= ($monthly_endon_date == "") ? "" : "(" . date("d-m-Y", strtotime($monthly_endon_date)) . ")" ?></th>
                                    <th>YEARLY <br /><?= ($yearly_endon_date == "") ? "" : "(" . date("d-m-Y", strtotime($yearly_endon_date)) . ")" ?></th>
                                </tr>
                                <?php
                                foreach ($user_avg_forecast as $stock_forecast):
                                    $var = "";
                                    echo '<tr>
                                    <td class="f18 ' . $stock_forecast['stock_code'] . '">
                                    <span class="tooltipped cursor-pointer" data-position="bottom" data-delay="50" data-tooltip="' . $stock_forecast['stock_name'] . '">
                                    <span>' . $stock_forecast['stock_code'] . '</span>
                                    </span>
                                    <div class="fw block s-price">267.00</div>
                                    </td>
                                    <td>' . round($stock_forecast['weekly_forecast'], 2) . '</td>
                                    <td>' . round($stock_forecast['monthly_forecast'], 2) . '</td>
                                    <td>' . round($stock_forecast['yearly_forecast'], 2) . '</td>
                                    </tr>';
                                endforeach;
                                ?>
                            </table>
                        </div>
                    </div>
                    <?php
                    if ($is_result_out == "0") {
                        ?>
                        <div class="center-align">
                            <a href="<?= base_url() ?>Stock/ForecastDetails" class="btn btn-black btn-large stocksavebtn">Predict now</a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col l4 m12 s12 plr15 equal-height hide-on-med-and-down">
            <div class="card z-depth-4 padd0 external-info-container">
                <div class="card-head">
                    <div class="bloghead">Your Voice</div>
                </div>
                <div class="blogs-container withtable">
                    <div class="row">
                        <div class="col s12">
                            <?php
                            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                            foreach ($blogs as $blog_list):
                                if (preg_match($reg_exUrl, $blog_list['link'], $url)) {
                                    $href = $url[0];
                                    $target = 'target = "_blank"';
                                } else {
                                    //$href = base_url() . $blog_list['link'];
                                    $href = base_url() . 'Blogs/getBlogs/' . $blog_list['id'];
                                    $target = "";
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
                        </div>
                    </div>    
                </div>
                <div class="card-footer" style="">
                    <a href="<?= base_url() ?>Blogs" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                </div>
            </div>
            <div class="card z-depth-4 padd0 external-info-container">
                <div class="card-head">
                    <div class="twitterhead">Rewards</div>
                </div>
                <div class="tweets-container withtable">
                    <?php
//                    foreach ($tweets as $result) {
//
//                        echo '<div class="tweets">
//                        <div class="col m3"><img src="' . $result->user->profile_image_url_https . '" class="tweetprofile"></div>
//                        <div class="col m9">
//                        <div class="tweetname">' . $result->user->name . '</div>
//                        <div class="tweetusername">@' . strtolower(str_replace(' ', '', $result->user->name)) . '</div>
//                        </div>
//                        <div class="col m12">
//                        <div class="tweettext">' . $result->text . '</div>
//                        <h6 class="tweetdate">' . str_replace('+0000', '', $result->created_at) . '</h6>
//                        </div>
//                        </div>';
//                    }
                    ?>

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
//                        <div class="col m3"><img src="' . $result->user->profile_image_url_https . '" class="tweetprofile"></div>
//                        <div class="col m9">
//                        <div class="tweetname">' . $result->user->name . '</div>
//                        <div class="tweetusername">@' . strtolower(str_replace(' ', '', $result->user->name)) . '</div>
//                        </div>
//                        <div class="col m12">
//                        <div class="tweettext">' . $result->text . '</div>
//                        <h6 class="tweetdate">' . str_replace('+0000', '', $result->created_at) . '</h6>
//                        </div>
//                        </div>';
//                    }
                    ?>
                </div>
<!--                <div class="card-footer" style="">
                    <a target="_blank" href="https://twitter.com/search?f=tweets&q=%23KarnatakaElection2018" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                </div>-->
            </div>
        </div>
    </div>
</div>