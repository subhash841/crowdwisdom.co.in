<style>
    .blogtext a, .blogtext a i {
        color: #039be5 !important;
    }
</style>
<div class="bottomborder" id="blogdetailpage">
    <div class="content container" >
        <div class="row">
            <div class="col l8 m12 s12">
                <div class="card z-depth-4 fullblogcard" style="padding-bottom:0px;">
                    <?php if (!empty($blog_list)) { ?>
                        <?php
                        if ($blog_list['subcategory_name'] == "Karnataka") {
                            $linkurl = base_url() . "Karnataka/Home";
                        } else if ($blog_list['subcategory_name'] == "Gujrat") {
                            $linkurl = base_url() . "Gujrat/Home";
                        } else {
                            $linkurl = "#";
                        }
                        ?>
                        <div class="btn btn-primary link" style="display: none;"><a href="<?php echo $linkurl; ?>">Prediction <?php echo $blog_list['subcategory_name'] ?></a></div>
                        <div class="row mb0" style="padding: 10px 0;">
                            <h5 class="blogsubject" style=""><?php echo $blog_list['category_name'] ?></h5> 

                            <div class="row ">
                                <div class="col l8 m6 s12">
                                    <h4 class="blogtitle" style=""><?php echo $blog_list['title'] ?></h4>
                                    <h5 class="blogdate hide-on-med-and-down" style=""><?php echo date('j-M-Y', strtotime($blog_list['blog_date'])); ?></h5>
                                </div>
                                <div class="col l4 m6 s12">
                                    <h5 class="blogdate hide-on-large-only" style=""><?php echo date('j-M-Y', strtotime($blog_list['blog_date'])); ?></h5>
                                    <div class="sharebtnsdetails hide-on-large-only center-align">
                                        <?php
                                        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                        //$actual_link=urlencode($actual_link);
                                        ?>
                                        <a class="share-icon facebook" href="http://www.facebook.com/sharer/sharer.php?u=<?= $actual_link ?>" target="_blank"><span class="fa fa-facebook"></span></a>
                                        <a class="share-icon twitter" href="https://twitter.com/share?url=<?= $actual_link ?>&amp;text=<?= $blog_list['title']; ?>&amp;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
    <!--                                            <a class="share-icon googleplus" href="https://plus.google.com/share?url=<?= $actual_link ?>"><span class="fa fa-google-plus" target="_blank"></span></a>-->
                                        <a class="share-icon whatsapp" href="https://web.whatsapp.com/send?text=<?= $actual_link ?>" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                    </div>
                                    <div class="sharebtnsdetails right hide-on-med-and-down">
    <?php $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
                                        <a class="share-icon facebook" href="http://www.facebook.com/sharer.php?u=<?= $actual_link ?>" target="_blank"><span class="fa fa-facebook"></span></a>
                                        <a class="share-icon twitter" href="https://twitter.com/share?url=<?= $actual_link ?>&amp;text=<?= $blog_list['title']; ?>&amp;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
    <!--                                            <a class="share-icon googleplus" href="https://plus.google.com/share?url=<?= $actual_link ?>"><span class="fa fa-google-plus" target="_blank"></span></a>-->
                                        <a class="share-icon whatsapp" href="https://web.whatsapp.com/send?text=<?= $actual_link ?>" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                    </div>

                                    <!--                            <a id="share" class="share-toggle share-icon share-expanded" href="#"></a>-->

                                </div>
                            </div>

                            <div class="bloglinks" style=""><!--By <a>Subhash Chabra</a> & <a>Amitabh Tiwari</a>--></div>
                            <?php if ($blog_list['image'] != "default_blog.png") { ?>
                                <div style="text-align: center;"><img style="max-width: 100%;width:350px;" src="<?php echo base_url(); ?>images/blogs/<?php echo $blog_list['image']; ?>" alt="Crowd Prediction"></div>
                                <?php } ?>
                            <div class="blogtext">
                                <?php $description = str_replace("&#34;", '\'', $blog_list['description']); ?>
                                    <?php $description = str_replace("&nbsp;", " ", $blog_list['description']); ?>
                                <div class="blogdescrtext" style="max-height: 100%;">
                                <?= $description; ?>
                                </div>
                                <?php
//                                $justcontent = strip_tags($description);
//                                if (strlen($justcontent) > 200) {
//                                    //var_dump($justcontent);exit;
//                                    echo '<div class="readmoreblog">read more</div>';
//                                }
                                ?>

                            </div>
                        </div>
<?php } else { ?>
                        <div class="row" style="padding: 20px 0;">
                            <h4>No data found</h4>
                        </div>
<?php } ?>
                </div>

            </div>
            <div class="col l4 m12 s12 equal-height">
                <div class="card z-depth-4 padd0 ">
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
                                            $target = 'target = "_blank"';
                                        }
                                    } else {
                                        //$title = preg_replace('/[^A-Za-z0-9 \-]/', '', $blog_list['title']);
                                        $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                                            "(", ")", "{", "}", "|", "/", ";", "'", "<", "?",
                                            ">", ",");
                                        $title = str_replace($spchar, "", $blog_list['title']);
                                        $title = str_replace(' ', '-', $title);
                                        $href = base_url() . 'Blogs/getBlogs/' . $blog_list['id'] . '/' . $title;
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
                        <a href="<?= base_url() ?>Blogs" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.banner').css('display', 'none');
        $('#aboutus').css('display', 'none');
    })
    $(document).ready(function ($) {

//        $('.card__share > a').on('click', function (e) {
//
//            e.preventDefault() // prevent default action - hash doesn't appear in url
//            var alreadyexpanded = $('.share-expanded').length;
//            if (alreadyexpanded >= 1) {
//                $(this).parent().find('div').toggleClass('card__social--active');
//                $(this).toggleClass('share-expanded');
//                $('.card__share .card__social').removeClass('card__social--active');
//                $('.card__share .share-toggle').removeClass('share-expanded');
//            } else {
//                console.log("event1");
//                $(this).parent().find('div').toggleClass('card__social--active');
//                $(this).toggleClass('share-expanded');
//            }
//
//        });
        $('.sharebtnsdetails .whatsapp').each(function (event) {
            var current_url = $(this).attr('href');

            var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

            if (isMobile) {
                var current_url = current_url.replace("https://web.whatsapp.com/", "whatsapp://");
            } else {
                var current_url = current_url.replace("whatsapp://", "https://web.whatsapp.com/");
            }
            $(this).attr('href', current_url);
        });

        //$('.blogtext img').parent().css('text-align','center');
    });
    /*$(document).on('click', '.readmoreblog', function (e) {
     if ($(this).hasClass('more')) {
     $('.blogdescrtext').css('max-height', '300px');
     //$('.card').addClass('mh130');
     $(this).removeClass('more')
     $(this).html('Read More');
     } else {
     $('.blogdescrtext').css('max-height', '100%');
     //$('.card').removeClass('mh130');
     $(this).addClass('more')
     $(this).html('Read Less');
     }
     
     })*/
</script>