<div class="content container">
    <div class="row minus-m-t8 mb-12">
        <div class="col l8 s12 plr15 equal-height">
            <div class="card z-depth-4 " >
                <div class="card-image p15 game1 covercenter">
                    <div class="center-align"><h4 class="mtb5 blueheader">Seat Prediction</h4></div>
                </div>
                <div class="card-content center">
                    <div class="" style="height: 54vh;"><img src="<?= base_url('images/common/seat-forecast.png'); ?>" style="margin: 10% 0;"/></div>
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
                                    $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                                                    "(", ")", "{", "}", "|", "/",";", "'", "<",
                                                    ">", ",");
                                    $title = str_replace($spchar, "", $blog_list['title']);
                                    $title=str_replace(' ','-',$title);
                                    $href = base_url() . 'Blogs/getBlogs/' . $blog_list['id'].'/'.$title;
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
            <div class="card z-depth-4 " >
                <div class="card-image p15 game2 covercenter">
                    <div class="center-align"><h4 class="mtb5 blueheader">Vote Prediction</h4></div>
                </div>
                <div class="card-content" style="padding:0">
                    <div class="center-align" style="height: 54vh;"><img src="<?= base_url('images/common/vote-forecast.png'); ?>" style="margin: 10% 0;"/></div>
                    <!-- <div class="center-align discription" style="font-size: 21px;font-weight: 400;color: #82828C;margin-bottom: 40px;line-height: 1.3;">How good you are in prediction? Wanna give a try as to see who would be the next ruling party in gujrat elections.</div> -->
                    <div class="center-align"><a href="Login" class="btn btn-black btn-large w40">Predict Now</a></div>
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
                                    $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                                                    "(", ")", "{", "}", "|", "/",";", "'", "<",
                                                    ">", ",");
                                    $title = str_replace($spchar, "", $blog_list['title']);
                                    $title=str_replace(' ','-',$title);
                                    $href = base_url() . 'Blogs/getBlogs/' . $blog_list['id'].'/'.$title;
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
                                                    <div class="blog-author">By <a href="">' . $blog_list['name'] . '</a></a></div>
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
    </div>
</div>