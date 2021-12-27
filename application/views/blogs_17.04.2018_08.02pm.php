<?php //echo "<pre>". print_r($blogs);exit;     ?>
<style>
    h5,h6{
        letter-spacing: 1px;
    }
    .load_feeds{
        padding: 0;
        width: 40px;
        height: 40px;
        margin: 0 12px;
    }
    .page{
        background-color: white !important;
        color: #232b3c;
    }
    .page.current{
        background-color: #232b3c !important;
        color: white !important;
    }
    .pagination-container{
        padding:5% 0;
        padding-bottom: 10%;
    }
    .bottomborder{
        border-bottom:  1px solid #e0e7ea;
    }
    .blogsubject{
        font-size: 15px;
        text-transform: uppercase;
        color:#c3cad8;
        font-weight: 600;
    }

    .blogtitle{
        color:#232b3c;
        margin: 25px 0;
        font-size: 28px;
        font-weight: 500;
    }
    .blogdate{
        font-size: 15px;
        color:#c3cad8;
        font-weight: 500;
        margin: 15px 0;
    }
    .bloglinks{
        font-size: 18px;
        color:#c3cad8;
        font-weight: 500;
    }
    .bloglinks a{
        color: #45bce7;
    }
    .blogtext{
        font-size: 19.1px;
        color: #232b3c;

    }
    .blogimg{
        width:100%;
        height: 450px;

    }
    .mtb7{
        margin: 7% 0;
    }
    .pt50{
        padding-top: 50px; 
    }
    .padd25-0{
        padding:25px 0;
    }
    .f40{
        font-size: 40px; 
    }
    .mtb0-30{
        margin-top: 0;
        margin-bottom: 30px;
    }
    .blogcover{
        background: url(../images/blogs/blogs.png);
        background-repeat: no-repeat;
        background-position: left;
        background-size: contain;
    }
    .darkblue{
        color:#232b3c;
    }
    .blogtextclip{
        text-overflow: ellipsis;
        height: 12em;
        overflow: hidden;
    }
    @media screen and (min-width: 470px) {
        .blogdata .views-row-odd div:first-child {
            float:right;
        }
        .blogdata .views-row-odd div:last-child {
            float:left;
        }
    }
</style>
<div class="white bottomborder">
    <div class="content container pt50">
        <div class="row plr15">
            <div class="blogcover coverleft  padd25-0">
                <h3 class="f40 mtb0-30 darkblue">Opinion</h3>
            </div>
        </div>
        <div class="blogdata">
            <?php
            if (!empty($blogs)) {
                for ($i = 0; $i <= count($blogs) - 1; $i++) {
                    ?>
                    <div class="row <?php echo $i % 2 == 0 ? "views-row-even" : "views-row-odd"; ?>">
                        <div class="col m6 s12 plr15 equal-height">
                            <h5 class="blogsubject" style=""><?= $blogs[$i]['category_name']; ?></h5> 
                            <h4 class="blogtitle" style=""><?= $blogs[$i]['title'] ?></h4>
                            <h5 class="blogdate" style=""><?= date('j-M-Y', strtotime($blogs[$i]['blog_date'])); ?></h5>
                            <div class="bloglinks" style=""><!--By <a>Subhash Chabra</a> & <a>Amitabh Tiwari</a>--></div>
                            <p class="blogtext mtb7 blogtextclip" style="">
                                <?php $description = str_replace("&#34;", '\'', $blogs[$i]['description']); ?>
                                <?php $description = preg_replace("/<style(.*)<\/style>/iUs", "", $description);?>
                                <?php $description= str_replace("&nbsp;"," ",$description);?>
                                <?= strip_tags($description);?>
                            </p>
                            <?php 
                            if (empty($blogs[$i]['category_id'] || $blogs[$i]['sub_category_id'])) {
                                    if (preg_match($reg_exUrl, $blogs[$i]['link'], $url)) {
                                        $href = $url[0];
                                        $target = 'target = "_blank"';
                                    } else {
                                        $href = base_url() . $blogs[$i]['link'];
                                        $target = 'target = "_blank"';
                                    }
                                } else {
                                    $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                                                    "(", ")", "{", "}", "|", "/",";", "'", "<",
                                                    ">", ",");
                                    $title = str_replace($spchar, "", $blogs[$i]['title']);
                                    $title=str_replace(' ','-',$title);
                                    $href = base_url() . 'Blogs/getBlogs/' . $blogs[$i]['id'].'/'.$title;
                                    $target = 'target = "_blank"';
                                }
                            
                            ?>
                            <a href="<?= $href ;?>" target="_blank" class="blueheader fw600 readall" style="" tabindex="0">Read More</a>
                        </div>
                        <div class="col m6 s12 plr15 equal-height">
                            <div style="position:relative;height:100%;width:100%;">
                                <?php if ($blogs[$i]['image'] != "default_blog.png") { ?>
                                    <div style="text-align: center;"><img style="max-width: 100%;width:550px;" src="<?php echo base_url(); ?>images/blogs/<?php echo $blogs[$i]['image']; ?>" alt="Crowd Prediction"></div>
                                <?php } else { ?>
                                    <img src="<?php echo base_url(); ?>images/blogs/<?= $blogs[$i]['image']; ?>" style="position: absolute;top: 30%;height:auto" class="blogimg">
                                <?php } ?>

                            </div>
                        </div>
                    </div>


                <?php } ?>

                <?php
            }
            ?>

            <div class="row views-row-even">
                <div class="col m6 s12 plr15 equal-height">
                    <h5 class="blogsubject" style="">Politics</h5> 
                    <h4 class="blogtitle" style="">The Karnataka Election Field Diary of Sachin Reddy</h4>
                    <h5 class="blogdate" style="">22 March 2018</h5>
                    <div class="bloglinks" style=""><!--By <a>Subhash Chabra</a> & <a>Amitabh Tiwari</a>--></div>
                    <p class="blogtext mtb7" style="">Bijapur city is all set to witness an epic battle. BJP’s ex MLA Appu Pattanashetty is readying ground to get ticket to take on Cong sitting MLA Maqbool Bagwan. Ex BJP man & former central minister BR Yatnal is also an aspirant- if BJP won’t give him ticket, might fight as ind!</p>
                    <a href="<?php echo base_url(); ?>Blogs/sachin_reddy?n=2" target="_blank" class="blueheader fw600 readall" style="" tabindex="0">Read More</a>
                </div>
                <div class="col m6 s12 plr15 equal-height">
                    <img src="<?= base_url('images/blogs/sachin_reddy.png'); ?>" class="blogimg">
                </div>
            </div>
            <div class="row views-row-odd">
                <div class="col m6 s12 plr15 equal-height">
                    <h5 class="blogsubject" style="">Politics</h5> 
                    <h4 class="blogtitle" style="">Yogendra Yadav, Surjit Bhalla versus The Crowd, who will win in Gujarat?</h4>
                    <h5 class="blogdate" style="">14 December 2017</h5>
                    <div class="bloglinks" style=""><!--By <a>Subhash Chabra</a> & <a>Amitabh Tiwari</a>--></div>
                    <p class="blogtext mtb7" style="">Today is the second and final phase of the Gujarat election. A tough campaign has been fought on the ground and this has surprised many. However, all this would mean something only if the results reflect the so-called tough fight on the ground.</p>
                    <!-- <a href="https://insightchandra.wordpress.com/2017/12/14/yogendra-yadav-surjit-bhalla-versus-the-crowd-who-will-win-in-gujarat/" target="_blank" class="blueheader fw600 readall" style="" tabindex="0">Read More</a> -->
                    <a href="<?php echo base_url(); ?>Blogs/singleBlog" target="_blank" class="blueheader fw600 readall" style="" tabindex="0">Read More</a>
                </div>
                <div class="col m6 s12 plr15 equal-height">
                    <img src="<?= base_url('images/blogs/blog-4.png'); ?>" class="blogimg">
                </div>
            </div>
            <div class="row views-row-even">
                <div class="col m6 s12 plr15 equal-height">
                    <h5 class="blogsubject" style="">Politics</h5> 
                    <h4 class="blogtitle" style="">How accurate are exit polls in India</h4>
                    <h5 class="blogdate" style="">09 December 2017</h5>
                    <div class="bloglinks" style=""><!--By <a>Subhash Chabra</a> & <a>Amitabh Tiwari</a>--></div>
                    <p class="blogtext mtb7" style="">Election forecasts by 'experts' have been failing at an alarming rate. In India, our own studies have shown that exit poll can predict no more than 40% of the results accurately. Some notable failures in India and around the world include  </p>
                    <a href="https://www.linkedin.com/pulse/20141122115952-7121961-how-accurate-are-exit-polls/" target="_blank" class="blueheader fw600 readall" style="" tabindex="0">Read More</a>
                </div>
                <div class="col m6 s12 plr15 equal-height">
                    <img src="<?= base_url('images/blogs/blog-2.png'); ?>" class="blogimg" >
                </div>
            </div>
            <div class="row views-row-odd">
                <div class="col m6 s12 plr15 equal-height">
                    <h5 class="blogsubject" style="">Politics</h5> 
                    <h4 class="blogtitle" style="">Exit polls 2017:Why solid data collection rather than methodology is key for higher accuracy</h4>
                    <h5 class="blogdate" style="">08 December 2017</h5>
                    <div class="bloglinks" style=""><!--By <a>Subhash Chabra</a> & <a>Amitabh Tiwari</a>--></div>
                    <p class="blogtext mtb7" style="">Election forecasts by 'experts' have been failing at an alarming rate. In India, our own studies have shown that exit poll can predict no more than 40% of the results accurately. Some notable failures in India and around the world include  </p>
                    <a href="http://www.firstpost.com/politics/exit-polls-2017-why-solid-data-collection-rather-than-methodology-is-key-for-higher-accuracy-3327428.html" target="_blank" class="blueheader fw600 readall" style="" tabindex="0">Read More</a>
                </div>
                <div class="col m6 s12 plr15 equal-height">
                    <img src="<?= base_url('images/blogs/blog-3.png'); ?>" class="blogimg" >
                </div>
            </div>
            <div class="row views-row-even">
                <div class="col m6 s12 plr15 equal-height">
                    <h5 class="blogsubject" style="">Politics</h5> 
                    <h4 class="blogtitle" style="">Time to beat the 'Experts'</h4>
                    <h5 class="blogdate" style="">06 December 2017</h5>
                    <div class="bloglinks" style=""><!--By <a>Subhash Chabra</a> & <a>Amitabh Tiwari</a>--></div>
                    <p class="blogtext mtb7" style="">Election forecasts by 'experts' have been failing at an alarming rate. In India, our own studies have shown that exit poll can predict no more than 40% of the results accurately. Some notable failures in India and around the world include  </p>
                    <a href="https://insightchandra.wordpress.com/2017/12/08/time-to-beat-the-experts/" target="_blank" class="blueheader fw600 readall" style="" tabindex="0">Read More</a>
                </div>
                <div class="col m6 s12 plr15 equal-height">
                    <img src="<?= base_url('images/blogs/blog-1.png'); ?>" class="blogimg">
                </div>
            </div>
        </div>

        <!--<div class="pagination-container" style="">
            <div class="center load-more-container">
                <ul class="pagination">
                    <li class="">
                        <button id="load_feeds" class="btn page btn-load-more load_feeds" data-pagelimit="1"><</button>
                    </li>
                    <li class="">
                        <button id="load_feeds" class="btn page current btn-load-more load_feeds" data-pagelimit="0" disabled="">01</button>
                    </li>
                    <li class="page">
                        <button id="load_feeds" class="btn page btn-load-more load_feeds" data-pagelimit="1">02</button>
                    </li>
                    <li class="page">
                        <button id="load_feeds" class="btn page btn-load-more load_feeds" data-pagelimit="2">03</button>
                    </li>
                    <label style="font-size:20px;">........</label>
                    <li class="page">
                        <button id="load_feeds" class="btn page btn-load-more load_feeds" data-pagelimit="3">04</button>
                    </li>
                    <li class="page">
                        <button id="load_feeds" class="btn page btn-load-more load_feeds" data-pagelimit="1">></button>
                    </li>
                </ul>
            </div>
        </div>-->

    </div>
</div>
<script>
    $(document).ready(function () {
        $('.banner').css('display', 'none');
        $('#aboutus').css('display', 'none');
    });
    $(document).on('click', '.load_feeds', function (e) {
        $('.load_feeds').attr('disabled', false);
        $('.load_feeds').removeClass('current');
        $(this).attr('disabled', true);
        $(this).addClass('current');
    });

</script>

