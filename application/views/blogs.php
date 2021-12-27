<input type="hidden" id="redirecturl" value="<?= base_url() ?>Login?section=blog">
<div class="bottomborder white" id="allblogspage">
    <div class="content container pt13">
        <div class="row plr15 mb0">
            <div class="blogcover coverleft padd10-0">
                <h3 class="f40 mtb0-30 darkblue">Your Voice</h3>
            </div>
        </div>
        <div class="blogdata">
            <?php
            if (!empty($blogs)) {
                ?>
                <div class="row">
                    <?php for ($i = 0; $i <= count($blogs) - 1; $i++) {
                        ?>
                        <?php
                        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                        if (!empty($blogs[$i]['link'])) {
                            if (preg_match($reg_exUrl, $blogs[$i]['link'], $url)) {
                                $href = $url[0];
                                $target = 'target = "_blank"';
                            } else {
                                $href = base_url() . $blogs[$i]['link'];
                                $target = 'target = "_blank"';
                            }
                        } else {
                            $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                                "(", ")", "{", "}", "|", "/", ";", "'", "<","?",
                                ">", ",");
                            $title = str_replace("&#39;", "'", $blogs[$i]['title']);
                            $title = str_replace($spchar, "", $title);
                            $title = str_replace(' ', '-', $title);
                            $href = base_url() . 'Blogs/getBlogs/' . $blogs[$i]['id'] . '/' . $title;
                            $target = 'target = "_blank"';
                        }
                        ?>
                        <div class="col m4 s12 paddlr5px ">

                            <div class="blogscard white z-depth-1 equal-height">
                                <a href="<?= $href ?>" <?= $target ?>>
                                    <div class="row mb0">
                                        <div class="blogcardimg">
                                            <div class="tint center"><img src="<?php echo base_url(); ?>/images/blogs/<?= $blogs[$i]['image']; ?>" alt="Crowd Prediction"></div>
                                        </div>
                                    </div>
                                </a>
                                <a href="<?= $href ?>" <?= $target ?>>
                                    <div class="row">
                                        <div class="blogdescr">
                                            <h5 class="blogsubject" style=""><?= $blogs[$i]['category_name']; ?></h5> 
                                            <h4 class="blogtitle" style=""><?= str_replace("&#39;", "'", $blogs[$i]['title']) ?></h4>
                                            <h5 class="blogdate" style=""><?= date('j-M-Y', strtotime($blogs[$i]['blog_date'])); ?></h5>
                                        </div>
                                    </div>
                                </a>
                            </div>


                        </div>

                    <?php } ?>
                </div>
            <?php } ?>
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
    $(document).ready(function ($) {

        $('.card__share > a').on('click', function (e) {

            e.preventDefault() // prevent default action - hash doesn't appear in url
            var alreadyexpanded = $('.share-expanded').length;
            if (alreadyexpanded >= 1) {
                $(this).parent().find('div').toggleClass('card__social--active');
                $(this).toggleClass('share-expanded');
                $('.card__share .card__social').removeClass('card__social--active');
                $('.card__share .share-toggle').removeClass('share-expanded');
            } else {
                console.log("event1");
                 $(this).parent().find('div').toggleClass('card__social--active');
                $(this).toggleClass('share-expanded');
            }

        });
        $('.card__social .whatsapp').each(function(event){
            var current_url=$(this).attr('href');
           
            var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
            
            if (isMobile) {
                var current_url = current_url.replace("https://web.whatsapp.com/", "whatsapp://");
            } else {
                var current_url = current_url.replace("whatsapp://", "https://web.whatsapp.com/");
            }
            $(this).attr('href',current_url);
         });
         
         //login URL Redirection
         $(".head-login").attr("href", '<?= base_url() ?>Login?section=blog');
    });
</script>

