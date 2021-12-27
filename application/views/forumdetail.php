<!--<div class="loadersmall" style="display:none"></div>-->
<script>
    $(document).on('click', 'a#show-mobile-discussion', function () {
        console.log('here');
        $('.slide-on-mobile').slideToggle();
    })
</script>
<div class="content container forumpages" id="forumdetailpage">

    <div class="row mb0">
        <div class="col m12 s12">
            <ul id="tabs-swipe-demo" class="tabs z-depth-4 forumtypetab">

                <li class="tab col m2 m2_5"><a href="<?= base_url() ?>Forum/#mydiscuss" <?php //$forum_detail['category_name']=="Elections" ? "class='active'" : ""                      ?> target="_self"><i class="flaticon-social"></i> My Forums</a></li>
                <li class="tab col m2 m2_5"><a href="<?= base_url() ?>Forum/#elecforum" <?= $forum_detail['category_name'] == "Elections" ? "class='active'" : "" ?> data-category="Elections" target="_self"><i class="flaticon-interface"></i> Elections</a></li>
                <li class="tab col m2 m2_5"><a href="<?= base_url() ?>Forum/#stockforum" <?= $forum_detail['category_name'] == "Stocks" ? "class='active'" : "" ?> data-category="Stocks" target="_self"><i class="flaticon-money"></i> Stocks</a></li>
                <li class="tab col m2 m2_5"><a href="<?= base_url() ?>Forum/#sportforum" <?= $forum_detail['category_name'] == "Sports" ? "class='active'" : "" ?> data-category="Sports" target="_self"><i class="flaticon-ball"></i> Sports</a></li>
                <li class="tab col m2 m2_5"><a href="<?= base_url() ?>Forum/#movieforum" <?= $forum_detail['category_name'] == "Movies" ? "class='active'" : "" ?> data-category="Movies" target="_self"><i class="flaticon-tool"></i> Movies</a></li>
            </ul>

<!--            <select id="mobtabcategories" class="hide-on-med-and-up mobcatselecttabs center mtb10" name="mobtabcategories" data-navigate="<?php base_url() ?>/Forum/">
    <option value="" disabled selected>Select Discussions</option>
    <option value="#mydiscuss">My Discussions</option>
    <option value="#elecforum">Elections</option>
    <option value="#stockforum">Stocks</option>
    <option value="#sportforum">Sports</option>
    <option value="#movieforum">Movies</option>
</select>-->
        </div>
    </div>
    <div class="row slide-on-mobile-button">
        <div class="col s12 center-align">
            <?php if (empty($_SESSION['data'])) {
                ?> <a href="<?= base_url() ?>Login?section=discussion" class="btn btn-default start-discussion themered">Login to discuss</a> <?php
            } else {
                ?> <a id="show-mobile-discussion" class="btn btn-default start-discussion themered">Start discussion</a> <?php }
            ?>
        </div>
    </div>
    <div class="row slide-on-mobile">
        <div class="col l12 m12 s12" style="position:relative;">
            <?php if (empty($_SESSION['data'])) {
                ?>
                <div class="forum-overlay">
                    <a href="<?= base_url() ?>Login?section=discussion" class="btn btn-default start-discussion themered">Login to discuss</a>
                </div>
            <?php }
            ?>
            <form id="postforum" name="myform" method="POST" action="<?= base_url() ?>/Forum/add_update_discussion"  onsubmit="return validateForm()" enctype="multipart/form-data"> 
                <div class="card forumarea">
                    <div class="row mb0">
                        <div class="col l2 m3 s6 offset-s3">
                            <div id="userActions">
                                <i class="flaticon-arrows"></i>
<!--                                <p class="fs14px center show-on-large hide-on-med-and-down" style="margin: 0;">Drag &amp; Drop</p>-->
                                <p class="fs14px center" style="margin: 0;">Upload Image</p>
                                <p class="fs12px center" style="margin-top: 0;">(.jpeg or .png)</p>
                                <label class="fileContainer btn drag-browsebtn fallback" for="fileUpload" style="background:#00b6ff;color:white;">
                                    Browse
                                    <input type="file" id="fileUpload" name="fileUpload" accept="image/gif, image/jpeg, image/png" onchange="readURL(this);" style="display:none"/>
                                </label>
                                <img id="imgPrime" src="" name="drangndropimg"/>
                                <div id="removethumb"><i class="fa fa-times"></i></div>
                            </div>
                        </div>
                        <div class="col l10 m9 s12">
                            <div class="row mb0 ">
                                <div class="col m12 s12">
                                    <textarea id="textarea1" placeholder="Write whats on your mind ..." name="forumtopic" class="materialize-textarea forumaddpostarea mb0"></textarea>
                                </div>
                            </div>
                            <div class="row mb0">
                                <div class="col m12 s12 hide-on-med-and-down">
                                    <textarea id="yvideoarea" placeholder="Share youtube video link here"class="materialize-textarea forumaddpostarea mb0" style="visibility:hidden"></textarea>
                                </div>
                            </div>
                            <div class="row mb0" style="padding: 5px;border-top: 1px solid lightgrey;">
                                <div style="color: #00aff2;">
                                    <div class="col m3 s12">
                                        <select id="forumcatergory" name="forumcategory">
                                            <option value="" disabled selected>SELECT CATEGORY</option>
                                            <option value="1">Elections</option>
                                            <option value="2">Stocks</option>
                                            <option value="3">Sports</option>
                                            <option value="4">Movies</option>
                                        </select>
                                    </div>
                                    <div class="col m7 s12" style="margin-top:5px;">
                                        <div style="display:none;">
                                            <i class="flaticon-link"></i>
                                            <a>ADD VIDEO URL</a></div>
                                    </div>
                                    <div class="col m2 s12">
                                        <input type="hidden" id="cwimg" name="cwimg"/>
                                        <input type="hidden" id="videolink" name="videolink"/>
                                        <input type="hidden" id="discussion_id" name="discussion_id" value="0">
                                        <input class="btn btn-default themered right" type="submit" class="" value="Post">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="row">
        <div class="col l8 s12 plr15 equal-height">

            <div class="card z-depth-4 p10" >
                <div class="card_content p0-10">
                    <div class="row mb10">

                        <div class="col m5 s12"><img class="forumcarddetailimg m10-0" src="<?= base_url() . 'images/forums/' . $forum_detail['image'] ?>" alt="Crowd Prediction" style="width:100%"></div>


                        <div class="col m7 s12" style="margin-top:20px;">
                            <!--<label class="forumsubhead text-uppercase fw700 fs16px">Elections</label>-->
                            <div class="row">
                                <div class="col m3 s5">
                                    <div class="btn react category <?= strtolower($forum_detail['category_name']); ?>"><?= $forum_detail['category_name']; ?></div>
                                </div>
                                <div class="col m8 s7">

                                    <div class="sharebtnsdetails right hide-on-med-and-down">
                                        <?php $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
                                        <a class="share-icon facebook" href="http://www.facebook.com/sharer.php?u=<?= $actual_link ?>" target="_blank"><span class="fa fa-facebook"></span></a>
                                        <a class="share-icon twitter" href="https://twitter.com/share?url=<?= $actual_link ?>&amp;text='forum title'&amp;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
                                        <a class="share-icon googleplus" href="https://plus.google.com/share?url=<?= $actual_link ?>"><span class="fa fa-google-plus" target="_blank"></span></a>
                                        <a class="share-icon whatsapp" href="https://web.whatsapp.com/send?text=<?= $actual_link ?>" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                    </div>
                                    <div class="sharebtnsdetails hide-on-large-only center-align">
                                        <?php $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
                                        <a class="share-icon facebook" href="http://www.facebook.com/sharer/sharer.php?u=<?= $actual_link ?>" target="_blank"><span class="fa fa-facebook"></span></a>
                                        <a class="share-icon twitter" href="https://twitter.com/share?url=<?= $actual_link ?>&amp;text='forum title'&amp;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
                                        <a class="share-icon googleplus" href="https://plus.google.com/share?url=<?= $actual_link ?>"><span class="fa fa-google-plus" target="_blank"></span></a>
                                        <a class="share-icon whatsapp" href="whatsapp://send?text=<?= $actual_link ?>" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                    </div>

                                </div>
                                <div class="col m1">
                                    <?php if ($forum_detail['user_id'] == $user_info['uid']) { ?>
                                        <div class="">
                                            <a materialize="dropdown" class='dropdown-button forumsubhead right'  href='#' data-activates='myforumactions'>
                                                <i class="flaticon-three"></i>
                                            </a>
                                            <ul id='myforumactions' class='dropdown-content'>
                                                <li id="editforum" data-forumid="<?= $forum_id ?>" data-title="<?= trim(preg_replace('/\s\s+/', ' ', $forum_detail['title']));?>" data-image="<?= base_url() . 'images/forums/' . $forum_detail['image'] ?>">
                                                    <h6 class="fs16px myforum">Edit</h6>
                                                </li>
                                                <li>
                                                    <a class="fs16px myforum modal-trigger confdelete" href="#confirmdelete" data-forumid="<?= $forum_id ?>">Delete</a>
<!--                                                       <h6 class="fs16px myforum">Delete</h6>-->
                                                </li>
<!--                                                <li><h6 class="fs16px myforum">Report</h6></li>-->
                                            </ul>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row"><div class="col s12"><h6 class="fs20px sf16 tastart"><?= $forum_detail['title']; ?></h6></div></div>
                            <div class="row mb10">
                                <div class="col s8"><h6 class="forumsubhead fs14px" style="color: #00aff2;"><i class="flaticon-social-2"></i><i style="margin-left: 10px;"><?= $forum_detail['user_id'] == $user_info['uid'] ? "By Me" : $forum_detail['byuser'] ?></i></h6></div>
                                <div class="col s4"><h6 class="forumsubhead fs12px right right-align"><i><?= date('j M Y', strtotime($forum_detail['created_date'])); ?></i></h6></div>
                            </div>
                        </div>
                    </div>
                    <!--<hr style="margin:10px;">-->
                    <div class="row mb10">
                        <div class="col l8 offset-l4">
                            <?php
                            $total_like = $forum_detail['total_like'];
                            $total_neutral = $forum_detail['total_neutral'];
                            $total_dislike = $forum_detail['total_dislike'];
                            $total_react = $total_like + $total_neutral + $total_dislike;
                            $total_percent = 0;
                            $likeper = 0;
                            $neutralper = 0;
                            $dislikeper = 0;
                            if ($total_like > 0) {
                                $likeper = round(($total_like / $total_react) * 100);
                                //$likeper = $likeper == 0.5 ? 0.5 : round($likeper, 2);
                            }
                            if ($total_neutral > 0) {
                                $neutralper = round(($total_neutral / $total_react) * 100);
                                //$neutralper = $neutralper == 0.5 ? 0.5 : round($neutralper, 2);
                            }
                            if ($total_dislike > 0) {
                                $dislikeper = round(($total_dislike / $total_react) * 100);
                                //$dislikeper = $dislikeper == 0.5 ? 0.5 : round($dislikeper, 2);
                            }
                            $total_percent = ($likeper + $neutralper + $dislikeper);
                            if ($total_percent > 100) {
                                $neutralper -= 1;
                            }
                            if ($total_percent != 0 && $total_percent < 100) {
                                $neutralper += 1;
                            }
                            ?>
                            <div style="display:none" class="reactcountdata" data-totallike="<?= $total_like ?>" data-totaldislike="<?= $total_dislike ?>" data-totalneutral="<?= $total_neutral ?>"></div>
                        </div>
                    </div>
                    <div class="row mb10">
                        <div class="col l7 m6 s12 mb15">
                            <div class="row mb10">
                                <div class="col m4 s4 mb3"><div class="btn forumaction like <?= $forum_detail['is_like'] == 1 ? "active" : "" ?>" data-forumid="<?= $forum_id ?>" data-byuserid="<?= $forum_detail['user_id'] ?>" data-userid="<?= $user_info['uid'] ?>" data-btntype="like"><span></span>Like</div></div>
                                <div class="col m4 s4 mb3"><div class="btn forumaction neutral <?= $forum_detail['is_neutral'] == 1 ? "active" : "" ?>" data-forumid="<?= $forum_id ?>" data-byuserid="<?= $forum_detail['user_id'] ?>" data-userid="<?= $user_info['uid'] ?>" data-btntype="neutral"><span></span>Neutral</div></div>
                                <div class="col m4 s4 mb3"><div class="btn forumaction dislike <?= $forum_detail['is_dislikes'] == 1 ? "active" : "" ?>" data-forumid="<?= $forum_id ?>" data-byuserid="<?= $forum_detail['user_id'] ?>" data-userid="<?= $user_info['uid'] ?>" data-btntype="dislike"><span></span>Dislike</div></div>
                            </div>
                            <?php //if (($forum_detail['is_like'] == 0 && $forum_detail['is_dislikes'] == 0 && $forum_detail['is_neutral'] == 0)) { ?>
                                <div class="row mb10" id="usercmtoption">
                                    <small style="padding-left:15px;font-size: 14px;color: #E81010;">Click on Like/Dislike/Neutral button to comment below</small>
                                </div>
                            <?php //} ?>
                        </div>

                        <div class="col l5 m6 s12 forumdetailprogress">
                            <div class="row mb10">
                                <div class="col m4 s4 mb3">
                                    <div class="left progressforumcir" id="containlike<?= $forum_id ?>" data-isselect="<?= $forum_detail['is_like']; ?>" data-btntype="like" data-tabname="" data-formid="<?= $forum_id ?>" data-byuserid="<?= $forum_detail['user_id'] ?>" data-userid="<?= $user_info['uid'] ?>" data-per="<?= $likeper ?>">
                                    </div>
                                </div>
                                <div class="col m4 s4 mb3">
                                    <div class="left progressforumcir" id="containneutral<?= $forum_id ?>" data-isselect="<?= $forum_detail['is_neutral']; ?>" data-btntype="neutral" data-tabname="" data-formid="<?= $forum_id ?>" data-byuserid="<?= $forum_detail['user_id'] ?>" data-userid="<?= $user_info['uid'] ?>" data-per="<?= $neutralper ?>">
                                    </div>
                                </div>
                                <div class="col m4 s4 mb3">
                                    <div class="left progressforumcir" id="containdislike<?= $forum_id ?>" data-isselect="<?= $forum_detail['is_dislikes']; ?>" data-btntype="dislike" data-tabname="" data-formid="<?= $forum_id ?>" data-byuserid="<?= $forum_detail['user_id'] ?>" data-userid="<?= $user_info['uid'] ?>" data-per="<?= $dislikeper ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    //&& $forum_detail['user_id'] != $user_info['uid']
                    if (($forum_detail['is_like'] == 0 && $forum_detail['is_dislikes'] == 0 && $forum_detail['is_neutral'] == 0)) {
                        $displaynone = 'style="display:none;"';
                        $disabletextbox = "disabled";
                        $placeholderwarn = "Please choose opinion first";
                    } else {
                        $displaynone = "";
                        $disabletextbox = "";
                        $placeholderwarn = "Write a reply first ...";
                    }
                    ?>
                    <div class="moredata1" <?= $displaynone; ?>>
                        <div class="row mb0">
                            <form id="postforumcomment" method="POST" action="<?= base_url() ?>Forum/add_comment">
                                <div class="col m10 s12">
                                    <textarea id="textarea1" name="forum_comment" placeholder="Type your comments here..."class="materialize-textarea forumcommentarea mb0"></textarea>
                                    <input type="hidden" name="forum_id" value="<?= $forum_id ?>"/>
                                </div>
                                <div class="col m2 s12">
                                    <input type="submit" class="btn btn-default bluegray forumbtncmt right" value="Post"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card z-depth-4 p10" >
                <div class="card_content p0-10">
                    <div class="loadersmall" style="display:none"></div>
                    <h4 class="fs14px text-uppercase txtbluegray">Comments</h4>
                    <div class="row " id="forumreact">
                        <ul id="commentstab" class="tabs" style="padding-left:0px;background: transparent;">
<!--                                    <li class="tab"><a href="#test-swipe-1">All <span style="color:#bbc4d3">(12)</span></a></li>-->
                            <li class="tab"><a href="#likecomments">like <span class="new badgecount like"><?= $total_like_comments ?></span></a></li>
                            <li class="tab"><a href="#neutralcomments">Neutral <span class="new badgecount neutral"><?= $total_neutral_comments ?></span></a></li>
                            <li class="tab"><a href="#dislikecomments">Dislike <span class="new badgecount dislike"><?= $total_dislike_comments ?></span></a></li>

                        </ul>
                        <div class="moredata1">
                            <div id="likecomments" class="col s12 tab-content">
                                <div class="commentbox">
                                    <?php if (empty($like_comments)) { ?>
                                        <h6 class="txtbluegray">Currently no comments available.</h6>
                                    <?php } else { ?>
                                        <?php foreach ($like_comments as $lc) { ?>
                                            <div class="commentsection border-top-bluegray">
                                                <div class="forumcardlist p-0">
                                                    <div class="row mb0">
                                                        <div class="col m7 s7"><h6 class="forumsubhead fs14px" style="color: #00aff2;"><i class="flaticon-social-2"></i><i style="margin-left: 5px;"><?= $lc['user_id'] == $user_info['uid'] ? "By Me" : $lc['byuser'] ?></i></h6></div>
                                                        <div class="col m5 s5"><h6 class="forumsubhead fs12px right right-align"><i><?= date('j M Y', strtotime($lc['created_date'])); ?></i></h6></div>
                                                    </div>
                                                    <div class="ml30">
                                                        <h3 class="fs14px mtb10 tastart"><?= $lc['comment'] ?></h3>
                                                        <div class="row txtbluegray text-uppercase">
                                                            <div class="col m7 s7"><h6 class="fs12px linkpointer showreplies_icon" data-cmtid="<?= $lc['id'] ?>" data-forumid="<?= $forum_id ?>"><i class="flaticon-arrow"></i>Reply</h6></div>
                                                            <div class="col m5 s5"><h6 class="fs12px right right-align linkpointer showreplies" data-cmtid="<?= $lc['id'] ?>" data-forumid="<?= $forum_id ?>" data-replyset="0"><?= $lc['total_replies'] ?> replies</h6></div>
                                                        </div>
                                                    </div>
                                                    <div class="replies<?= $lc['id'] ?>" style="display:none;">
                                                        <div class="row m10">
                                                            <form id="postforumcommentrply" method="POST">
                                                                <div class="col m10 s12">
                                                                    <textarea id="textarea1" name="forum_comment_reply" placeholder="<?= $placeholderwarn ?>" class="materialize-textarea forumcommentarea mb0" <?= $disabletextbox; ?>></textarea>
                                                                    <input type="hidden" name="forum_id" value="<?= $forum_id ?>"/>
                                                                    <input type="hidden" name="comment_id" value="<?= $lc['id'] ?>"/>
                                                                </div>
                                                                <div class="col m2 s12">
                                                                    <input type="submit" class="btn btn-default bluegray forumbtnrply right" value="send"/>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div id="replylist_<?= $lc['id'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <div class="loadmore" data-type="like" data-pageid="1" data-forumid="<?= $forum_id; ?>">View more</div>
                            </div>
                            <div id="neutralcomments" class="col s12 tab-content border-top-bluegray">
                                <div class="commentbox"><?php if (empty($neutral_comments)) { ?>
                                        <h6 class="txtbluegray">Currently no comments available.</h6>
                                    <?php } else { ?>
                                        <?php foreach ($neutral_comments as $nc) { ?>
                                            <div class="commentsection border-top-bluegray">
                                                <div class="forumcardlist p-0">
                                                    <div class="row mb0">
                                                        <div class="col m6 s6"><h6 class="forumsubhead fs14px" style="color: #00aff2;"><i class="flaticon-social-2"></i><i style="margin-left: 5px;"><?= $nc['user_id'] == $user_info['uid'] ? "By Me" : $nc['byuser']; ?></i></h6></div>
                                                        <div class="col m6 s6"><h6 class="forumsubhead fs12px right right-align"><i><?= date('j M Y', strtotime($nc['created_date'])); ?></i></h6></div>
                                                    </div>
                                                    <div class="ml30">
                                                        <h3 class="fs14px mtb10 tastart"><?= $nc['comment'] ?></h3>
                                                        <div class="row txtbluegray text-uppercase">
                                                            <div class="col m6 s6"><h6 class="fs12px linkpointer showreplies_icon" data-cmtid="<?= $nc['id'] ?>" data-forumid="<?= $forum_id ?>"><i class="flaticon-arrow"></i>Reply</h6></div>
                                                            <div class="col m6 s6"><h6 class="fs12px right right-align linkpointer showreplies" data-cmtid="<?= $nc['id'] ?>" data-forumid="<?= $forum_id ?>" data-replyset="0"><?= $nc['total_replies'] ?> replies</h6></div>
                                                        </div>
                                                    </div>
                                                    <div class="replies<?= $nc['id'] ?>" style="display:none;">
                                                        <div class="row mb0">
                                                            <form id="postforumcommentrply" method="POST">
                                                                <div class="col m10">
                                                                    <textarea id="textarea1" name="forum_comment_reply" placeholder="<?= $placeholderwarn ?>"class="materialize-textarea forumcommentarea mb0" <?= $disabletextbox ?>></textarea>
                                                                    <input type="hidden" name="forum_id" value="<?= $forum_id ?>"/>
                                                                    <input type="hidden" name="comment_id" value="<?= $nc['id'] ?>"/>
                                                                </div>
                                                                <div class="col m2">
                                                                    <input type="submit" class="btn btn-default bluegray forumbtnrply" value="send"/>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div id="replylist_<?= $nc['id'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    <?php } ?></div>
                                <div class="loadmore" data-type="neutral" data-pageid="1" data-forumid="<?= $forum_id; ?>">View more</div>
                            </div>
                            <div id="dislikecomments" class="col s12 tab-content border-top-bluegray">
                                <div class="commentbox"><?php if (empty($dislike_comments)) { ?>
                                        <h6 class="txtbluegray">Currently no comments available.</h6>
                                    <?php } else { ?>
                                        <?php foreach ($dislike_comments as $dc) { ?>
                                            <div class="commentsection border-top-bluegray">
                                                <div class="forumcardlist p-0">
                                                    <div class="row mb0">
                                                        <div class="col m6 s6"><h6 class="forumsubhead fs14px" style="color: #00aff2;"><i class="flaticon-social-2"></i><i style="margin-left: 5px;"><?= $dc['user_id'] == $user_info['uid'] ? "By Me" : $dc['byuser'] ?></i></h6></div>
                                                        <div class="col m6 s6"><h6 class="forumsubhead fs12px right right-align"><i><?= date('j M Y', strtotime($dc['created_date'])); ?></i></h6></div>
                                                    </div>
                                                    <div class="ml30">
                                                        <h3 class="fs14px mtb10 tastart"><?= $dc['comment'] ?></h3>
                                                        <div class="row txtbluegray text-uppercase">
                                                            <div class="col m6 s6"><h6 class="fs12px linkpointer showreplies_icon" data-cmtid="<?= $dc['id'] ?>" data-forumid="<?= $forum_id ?>" ><i class="flaticon-arrow"></i>Reply</h6></div>
                                                            <div class="col m6 s6"><h6 class="fs12px right right-align linkpointer showreplies" data-cmtid="<?= $dc['id'] ?>" data-forumid="<?= $forum_id ?>" data-replyset="0"><?= $dc['total_replies'] ?> replies</h6></div>
                                                        </div>
                                                    </div>
                                                    <div class="replies<?= $dc['id'] ?>" style="display:none;">
                                                        <div class="row mb0">
                                                            <form id="postforumcommentrply" method="POST">
                                                                <div class="col m10">
                                                                    <textarea id="textarea1" name="forum_comment_reply" placeholder="<?= $placeholderwarn ?>"class="materialize-textarea forumcommentarea mb0" <?= $disabletextbox ?>></textarea>
                                                                    <input type="hidden" name="forum_id" value="<?= $forum_id ?>"/>
                                                                    <input type="hidden" name="comment_id" value="<?= $dc['id'] ?>"/>
                                                                </div>
                                                                <div class="col m2">
                                                                    <input type="submit" class="btn btn-default bluegray forumbtnrply" value="send"/>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div id="replylist_<?= $dc['id'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    <?php } ?></div>
                                <div class="loadmore" data-type="dislike" data-pageid="1" data-forumid="<?= $forum_id; ?>">View more</div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
        <div class="col l4 m12 s12 plr15">
            <div class="card z-depth-4 padd0 ">
                <div class="card-head">
                    <div class="bloghead">Other Discussions</div>
                </div>
                <div class="blogs-container withtable">
                    <div class="row">
                        <div class="col s12">
                            <?php foreach ($allforum as $af) { ?>
                                <div class="blogs">
                                    <a href="<?= base_url() ?>Forum/forumdetail/<?= $af['id'] ?>">
                                    </a>
                                    <div class="row">
                                        <a href="<?= base_url() ?>Forum/forumdetail/<?= $af['id'] ?>">
                                            <div class="col s5">
                                                <img src="<?= base_url() . 'images/forums/'.$af['image']; ?>" class="featured-img" style="width: 100%;">
                                            </div>
                                        </a>
                                        <div class="col s7">
                                            <a href="<?= base_url() ?>Forum/forumdetail/<?= $af['id'] ?>">
                                                <div class="blog-details text-upper"><?= $af['category_name']; ?></div>
                                                <div class="blog-title truncate"><?= $af['title']; ?></div>
                                                <div class="blog-details"><?= date('j M Y', strtotime($af['created_date'])); ?></div>
                                            </a>
                                            <div class="blog-author"><a href="<?= base_url() ?>Forum/forumdetail/<?= $af['id'] ?>" target="_blank"></a><a href=""></a></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>    
                </div>
                <div class="card-footer hide" style="">
                    <a href="<?= base_url() ?>Forum" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.0.8/d3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/PieChart/js/donut-pie-chart.js" type="text/javascript"></script>-->
<div id="confirmdelete" class="modal">
    <div class="modal-content">
        <h5 class="fs16px">Are you sure want to delete this forum ?</h5>
<!--      <p>A bunch of text</p>-->
    </div>
    <div class="modal-footer">
      <a href="#!" class="btn themered waves-effect waves-green yes" data-forumid="">Yes</a>
      <a href="#!" class="btn modal-close waves-effect waves-red no">No</a>
    </div>
  </div>
<script>
    $(function () {

        //var instance = M.Tabs.init(el, options);
        //instance.select('mydiscuss');

    });
    $(document).on('click', '.forumaction', function (e) {
        var forum_id = $(this).attr('data-forumid');
        var byuserid = $(this).attr('data-byuserid');
        var userid = $(this).attr('data-userid');
        var btntype = $(this).attr('data-btntype');
        var currentchoice = $('.forumaction.active').attr('data-btntype');
        $.ajax({
            url: "<?php echo base_url(); ?>Forum/forum_action",
            method: "POST",
            data: {forumid: forum_id, userid: userid, type: btntype},
        }).done(function (response) {

<?php if (empty($this->session->userdata('data'))) {
    ?>
                window.location.assign("<?= base_url() ?>Login");
<?php }
?>

            $('#forumreact').html(response);

            var totallike = $('.reactcountdata').attr('data-totallike');
            var totaldislike = $('.reactcountdata').attr('data-totaldislike');
            var totalneutral = $('.reactcountdata').attr('data-totalneutral');
            $('.moredata1').css('display', 'block');
            $('.forumaction').removeClass('active');
            $('.forumaction[data-btntype=' + btntype + ']').addClass('active');
            $('.moredata1 .tab-content').removeClass('active');

            console.log(currentchoice);
            console.log(btntype);

            if (currentchoice == btntype) {

            } else {
                console.log("here");
                console.log("before like " + totallike);
                console.log("before neutral " + totalneutral);
                console.log("before dislike " + totaldislike);

                if (currentchoice == "like") {
                    if (parseInt(totallike) > 0) {
                        totallike = parseInt(totallike) - 1;
                    }
                } else if (currentchoice == "dislike") {
                    if (parseInt(totaldislike) > 0) {
                        totaldislike = parseInt(totaldislike) - 1;
                    }

                } else if (currentchoice == "neutral") {
                    if (parseInt(totalneutral) > 0) {
                        totalneutral = parseInt(totalneutral) - 1;
                    }

                }

                if (btntype == "like") {
                    totallike = parseInt(totallike) + 1;
                } else if (btntype == "dislike") {
                    totaldislike = parseInt(totaldislike) + 1;
                } else if (btntype == "neutral") {
                    totalneutral = parseInt(totalneutral) + 1;
                }
            }


            console.log("like " + totallike);
            console.log("neutral " + totalneutral);
            console.log("dislike " + totaldislike);
            $('.reactcountdata').attr('data-totallike', totallike);
            $('.reactcountdata').attr('data-totaldislike', totaldislike);
            $('.reactcountdata').attr('data-totalneutral', totalneutral);

            var totalreact = parseInt(totallike) + parseInt(totaldislike) + parseInt(totalneutral);
            var total_percent = 0;
            var likeper = 0;
            var neutralper = 0;
            var dislikeper = 0;
            if (totallike > 0) {
                likeper = Math.round((totallike / totalreact) * 100);
                //$likeper = $likeper == 0.5 ? 0.5 : round($likeper, 2);
            }
            if (totalneutral > 0) {
                neutralper = Math.round((totalneutral / totalreact) * 100);
                //$neutralper = $neutralper == 0.5 ? 0.5 : round($neutralper, 2);
            }
            if (totaldislike > 0) {
                dislikeper = Math.round((totaldislike / totalreact) * 100);
                //$dislikeper = $dislikeper == 0.5 ? 0.5 : round($dislikeper, 2);
            }
            total_percent = (likeper + neutralper + dislikeper);
            if (total_percent > 100) {
                neutralper -= 1;
            }
            if (total_percent != 0 && total_percent < 100) {
                neutralper += 1;
            }
            var progress = '<div class="row mb10">\
                                <div class="col m4 s4 mb3">\
                                    <div class="left progressforumcir" id="containlike' + forum_id + '" data-btntype="like" data-tabname="" data-formid="' + forum_id + '" data-byuserid="' + byuserid + '" data-userid="' + userid + '" data-per="' + likeper + '">\
                                    </div>\
                                </div>\
                                <div class="col m4 s4 mb3">\
                                    <div class="left progressforumcir" id="containneutral' + forum_id + '" data-btntype="neutral" data-tabname="" data-formid="' + forum_id + '" data-byuserid="' + byuserid + '" data-userid="' + userid + '" data-per="' + neutralper + '">\
                                    </div>\
                                </div>\
                                <div class="col m4 s4 mb3">\
                                    <div class="left progressforumcir" id="containdislike' + forum_id + '" data-btntype="dislike" data-tabname="" data-formid="' + forum_id + '" data-byuserid="' + byuserid + '" data-userid="' + userid + '" data-per="' + dislikeper + '">\
                                    </div>\
                                </div>\
                            </div>';
            $('.forumdetailprogress').html(progress);
            $('.progressforumcir').each(function (event) {
                var forumid = $(this).attr('data-formid');
                var data_per = $(this).attr('data-per');
                var type = $(this).attr('data-btntype');
                var tabname = $(this).attr('data-tabname');
                var percent = data_per;
                if (type == "like") {
                    color = '#27ce71';
                } else if (type == "neutral") {
                    color = '#00b6ff';
                } else {
                    color = '#ff5f4e';
                }
                var bar = new ProgressBar.Circle("#contain" + type + "" + forumid + "" + tabname, {
                    strokeWidth: 6,
                    easing: 'easeInOut',
                    duration: 1400,
                    color: color,
                    trailColor: '#eee',
                    trailWidth: 6,
                    svgStyle: null,
                    text: {
                        value: '<b class="blueblack-txt">' + percent + '%</b><h6 class="fs9px m-0">' + type + '</h6>',
                        color: color,
                        className: 'progressbar__label',
                        autoStyle: true
                    }
                });
                bar.animate(data_per / 100);
            });
            //$('#usercmtoption').css('display', 'none');
        });

    });


    $(function () {
<?php if ($this->session->flashdata('toast')) { ?>
            Materialize.Toast.removeAll();
            Materialize.toast('<?= $this->session->flashdata('toast') ?>', 4000);
            return false;
<?php } ?>
    });
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

//    $('.dropdown-button').dropdown({
//        inDuration: 300,
//        outDuration: 225,
//        constrain_width: false, // Does not change width of dropdown to that of the activator
//        hover: true, // Activate on hover
//        gutter: 0, // Spacing from edge
//        belowOrigin: false // Displays dropdown below the button
//    }
//    );

    function showComments(id) {
        //$('div[class^="replies"]').slideUp();
        $('.replies' + id).slideToggle();
    }


    function validateForm() {
        var topic = $("#textarea1").val();
        var forumcategory = $("#forumcatergory").val();

        var Coverimage = $("#fileUpload").val();

        var discuss_topic=$('#discussion_id').val();

        console.log(Coverimage)
        //var drangndropimg = $('#imgPrime').attr('src');
        //alert(drangndropimg);
        var cwimg = $('#cwimg').val();
        if (topic == "") {
            Materialize.Toast.removeAll();
            Materialize.toast('Please write discussion topic!', 4000);
            return false;
        }
        if (forumcategory == "" || forumcategory == null) {
            Materialize.Toast.removeAll();
            Materialize.toast('Please Select Category!', 4000);
            return false;
        }

        if (!Coverimage && cwimg == "" && discuss_topic==0) { // returns true if the string is not empty
            Materialize.Toast.removeAll();
            Materialize.toast('Please select image', 4000);
            return false;
        }
        if(discuss_topic!=0 && $('#imgPrime').attr('src')==""){

            Materialize.Toast.removeAll();
            Materialize.toast('Please select image', 4000);
            return false;
        }
    }


    function readURL(input) {
        console.log(input.files);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                //$('#falseinput').attr('src', e.target.result);
                //$('#base').val(e.target.result);
                $("#imgPrime").attr("src", e.target.result);
                $('#imgPrime').css('display', 'block');
                $('.dz-preview').remove();
                $('#removethumb').css('display', 'block');
                //$('#cwimg').val(e.target.result)
                document.getElementById('removethumb').addEventListener('click', function () {
                    //_this.removeAllFiles();
                    $("#imgPrime").attr("src", '');
                    $('#imgPrime').css('display', 'none');
                    $('#removethumb').css('display', 'none');
                    $('input[type=file]').val(null);
                });
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function () {
        $("#tabs-swipe-demo1").tabs();
    });
</script>
<script>

    $(document).on('click', '.showreplies,.showreplies_icon', function (e) {
        var forumid = $(this).attr('data-forumid');
        var commentid = $(this).attr('data-cmtid');
        var pagelimit = $(this).attr('data-replyset');
        var currentcontent = $('#replylist_' + commentid).text();
        $.ajax({
            url: "<?php echo base_url(); ?>Forum/get_comment_replies",
            method: "POST",
            data: {forumid: forumid, commentid: commentid, pagelimit: pagelimit},
        }).done(function (result) {
            result = JSON.parse(result);
            //console.log(result);
            var html = "";
            if (result.status) {
                var groupLength = result['data'].length;
                //console.log(groupLength);
                result['data'].reverse();
                if (groupLength >= 4) {
                    html += '<a class="morereplies" data-replyset="' + (parseInt(pagelimit) + 1) + '" data-forumid="' + forumid + '" data-cmtid="' + commentid + '">previous replies</a>'
                }
                for (var i in result['data']) {
                    //console.log(result['data'][i]['id']);
                    var replyby = result['data'][i]['user_id'] ==<?= $user_info['uid']; ?> ? "By Me" : result['data'][i]['byuser'];
                    var formattedDate = getDateString(new Date(result['data'][i]['created_date']), "d M y")
                    html += '<div class="row mb0">\
                                <div class="col m6 s6"><h6 class="forumsubhead fs14px" style="color: #00aff2;"><i class="flaticon-social-2"></i><i style="margin-left: 5px;">' + replyby + '</i></h6>\
                                </div>\
                                <div class="col m6 s6"><h6 class="forumsubhead fs12px right right-align"><i>' + formattedDate + '</i></h6>\
                                </div>\
                            </div>\
                            <div class="ml30">\
                                <h3 class="fs14px mtb10 tastart">' + result['data'][i]['reply'] + '</h3>\
                            </div>';
                    if ((parseInt(i) + 1) != (groupLength)) {
                        html += '<hr class="commentseprator">';
                    }
                }

                $('#replylist_' + commentid).html(html);
            }

            $('.replies' + commentid).slideToggle();
        });
    });

    $(document).on('click', '.morereplies', function (e) {
        var forumid = $(this).attr('data-forumid');
        var commentid = $(this).attr('data-cmtid');
        var pagelimit = $(this).attr('data-replyset');
        $('.replies' + commentid + ' .morereplies').remove();

        $.ajax({
            url: "<?php echo base_url(); ?>Forum/get_comment_replies",
            method: "POST",
            data: {forumid: forumid, commentid: commentid, pagelimit: pagelimit},
        }).done(function (result) {
            result = JSON.parse(result);
            //console.log(result);
            var html = "";
            if (result.status) {
                var groupLength = result['data'].length;
                result['data'].reverse();
                //console.log(groupLength);
                if (groupLength >= 4) {
                    html += '<a class="morereplies" data-replyset="' + (parseInt(pagelimit) + 1) + '" data-forumid="' + forumid + '" data-cmtid="' + commentid + '">view more replies</a>'
                }
                for (var i in result['data']) {
                    //console.log(result['data'][i]['id']);
                    var replyby = result['data'][i]['user_id'] ==<?= $user_info['uid']; ?> ? "By Me" : result['data'][i]['byuser'];
                    var formattedDate = getDateString(new Date(result['data'][i]['created_date']), "d M y")
                    html += '<div class="row mb0">\
                                <div class="col m6 s6"><h6 class="forumsubhead fs14px" style="color: #00aff2;"><i class="flaticon-social-2"></i><i style="margin-left: 5px;">' + replyby + '</i></h6>\
                                </div>\
                                <div class="col m6 s6"><h6 class="forumsubhead fs12px right right-align"><i>' + formattedDate + '</i></h6>\
                                </div>\
                            </div>\
                            <div class="ml30">\
                                <h3 class="fs14px mtb10 tastart">' + result['data'][i]['reply'] + '</h3>\
                            </div>';
                    //console.log((i + 1));
                    html += '<hr class="commentseprator">';

                }

                $('#replylist_' + commentid).prepend(html);
                //$('.replies' + commentid).slideToggle();
            }
            //$('.replies' + commentid).slideToggle();
        });
    });
</script>
<script>
    var getDateString = function (date, format) {
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                getPaddedComp = function (comp) {
                    return ((parseInt(comp) < 10) ? ('0' + comp) : comp)
                },
                formattedDate = format,
                o = {
                    "y+": date.getFullYear(), // year
                    "M+": months[date.getMonth()], //month
                    "d+": getPaddedComp(date.getDate()), //day
                    "h+": getPaddedComp((date.getHours() > 12) ? date.getHours() % 12 : date.getHours()), //hour
                    "H+": getPaddedComp(date.getHours()), //hour
                    "m+": getPaddedComp(date.getMinutes()), //minute
                    "s+": getPaddedComp(date.getSeconds()), //second
                    "S+": getPaddedComp(date.getMilliseconds()), //millisecond,
                    "b+": (date.getHours() >= 12) ? 'PM' : 'AM'
                };

        for (var k in o) {
            if (new RegExp("(" + k + ")").test(format)) {
                formattedDate = formattedDate.replace(RegExp.$1, o[k]);
            }
        }
        return formattedDate;
    };

    activeCommentTab = "likecomments";
    $("#commentstab.tabs > li > a").click(function (e) {
        var id = $(e.target).attr("href").substr(1);
        activeCommentTab = id;
        flag = 0;
        //window.location.hash = id;
    });
    var flag = 0;
    var replyflag = 0;
    $('.commentbox').scroll(function () {
        if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight - 1 && flag == 0) {
            flag = 1;
            var activetab = $("#commentstab.tabs > li > a.active").attr("href").substr(1);
            //alert(activetab);
            var commenttypes = $("#" + activetab + " .loadmore").attr('data-type');
            var loadlimit = $("#" + activetab + " .loadmore").attr('data-pageid');
            var forum_id = $("#" + activetab + " .loadmore").attr('data-forumid');
            //alert(commenttypes);
            $.ajax({
                url: "<?php echo base_url(); ?>Forum/load_more_comments",
                method: "POST",
                data: {forumid: forum_id, type: commenttypes, pagelimit: loadlimit},
            }).done(function (result) {
                result = JSON.parse(result);
                var html = "";
                if (result.status) {
                    for (var i in result['data']) {
                        var replyby = result['data'][i]['user_id'] ==<?= $user_info['uid']; ?> ? "By Me" : result['data'][i]['byuser'];
                        var formattedDate = getDateString(new Date(result['data'][i]['created_date']), "d M y")
                        html += '<div class="commentsection border-top-bluegray">\
                                    <div class="forumcardlist p-0">\
                                        <div class="row mb0">\
                                        <div class="col m6 s6"><h6 class="forumsubhead fs14px" style="color: #00aff2;"><i class="flaticon-social-2"></i><i style="margin-left: 5px;">' + replyby + '</i></h6></div>\
                                        <div class="col m6 s6"><h6 class="forumsubhead fs12px right right-align"><i>' + formattedDate + '</i></h6></div>\
                                    </div>\
                                    <div class="ml30">\
                                        <h3 class="fs14px mtb10 tastart">' + result['data'][i]['comment'] + '</h3>\
                                        <div class="row txtbluegray text-uppercase">\
                                            <div class="col m6 s6"><h6 class="fs12px linkpointer showreplies_icon" data-cmtid="' + result['data'][i]['id'] + '" data-forumid="' + result['data'][i]['forum_id'] + '"><i class="flaticon-arrow"></i>Reply</h6></div>\
                                            <div class="col m6 s6"><h6 class="fs12px right right-align linkpointer showreplies" data-cmtid="' + result['data'][i]['id'] + '" data-forumid="' + result['data'][i]['forum_id'] + '" >' + result['data'][i]['total_replies'] + ' replies</h6></div>\
                                        </div>\
                                    </div>\
                                    <div class="replies' + result['data'][i]['id'] + '" style="display:none;">\
                                        <div class="row mb0">\
                                            <form id="postforumcommentrply" class="postforumcommentrply" method="POST">\
                                                <div class="col m10">\
                                                    <textarea id="textarea1" name="forum_comment_reply" placeholder="Write a reply" class="materialize-textarea forumcommentarea mb0"></textarea>\
                                                    <input type="hidden" name="forum_id" value="' + result['data'][i]['forum_id'] + '"/>\
                                                    <input type="hidden" name="comment_id" value="' + result['data'][i]['id'] + '"/>\
                                                </div>\
                                                <div class="col m2">\
                                                    <input type="submit" class="btn btn-default bluegray forumbtnrply" value="send"/>\
                                                </div>\
                                            </form>\
                                        </div>\
                                        <div id="replylist_' + result['data'][i]['id'] + '">\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>';
                    }
                    $("#" + activetab + " .commentbox").append(html);
                    $("#" + activetab + " .loadmore").attr('data-pageid', parseInt(loadlimit) + 1);
                    flag = 0;
                } else {
//                    Materialize.Toast.removeAll();
//                    Materialize.toast("No more comments", 4000);
//                    return false;
                    flag = 1;
                }
            });
        }
    });
    $('[id^=replylist_]').scroll(function () {
        if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight - 1 && replyflag == 0) {

        }
    });
    $("#mobtabcategories").on('change', function () {
        var selectedCategory = $(this).val();
        window.location.assign('../' + selectedCategory);
    });
    $(function () {
        var activetab = $("#tabs-swipe-demo.tabs > li > a.active").attr("data-category");
        //alert(activetab);
        if (activetab == "Elections") {
            $('#forumcatergory').val("1");
            $('#forumcatergory').material_select();
        } else if (activetab == "Stocks") {
            $('#forumcatergory').val("2");
            $('#forumcatergory').material_select();
        } else if (activetab == "Sports") {
            $('#forumcatergory').val("3");
            $('#forumcatergory').material_select();
        } else if (activetab == "Movies") {
            $('#forumcatergory').val("4");
            $('#forumcatergory').material_select();
        }
    });

    $('#postforumcomment').submit(function (e) {
        e.preventDefault();
        $('.loadersmall').css('display', 'block');
        $.ajax({
            url: $(this).attr('action'),
            method: "POST",
            data: $(this).serialize(),
        }).done(function (result) {
<?php if (empty($this->session->userdata('data'))) { ?>
                window.location.assign("<?= base_url() ?>Login");
<?php } ?>
            result = JSON.parse(result);
            if (result['status']) {
                Materialize.Toast.removeAll();
                Materialize.toast(result['message'], 4000);
                var html = "";
                console.log(result['data']);
                var formattedDate = getDateString(new Date(result['data']['created_date']), "d M y")
                html = '<div class="commentsection">\
                        <div class="forumcardlist p-0">\
                            <div class="row mb0">\
                                <div class="col m6 s6"><h6 class="forumsubhead fs14px" style="color: #00aff2;"><i class="flaticon-social-2"></i><i style="margin-left: 5px;">By Me</i></h6></div>\
                                <div class="col m6 s6"><h6 class="forumsubhead fs12px right right-align"><i>' + formattedDate + '</i></h6></div>\
                            </div>\
                            <div class="ml30">\
                                <h3 class="fs14px mtb10 tastart">' + result['data']['comment'] + '</h3>\
                                <div class="row txtbluegray text-uppercase">\
                                    <div class="col m6 s6"><h6 class="fs12px linkpointer showreplies_icon" data-cmtid="' + result['data']['id'] + '" data-forumid="' + result['data']['forum_id'] + '"><i class="flaticon-arrow"></i>Reply</h6></div>\
                                    <div class="col m6 s6"><h6 class="fs12px right right-align linkpointer showreplies" data-cmtid="' + result['data']['id'] + '" data-forumid="' + result['data']['forum_id'] + '" data-replyset="0">0 Reply</h6></div>\
                                </div>\
                            </div>\
                            <div class="replies' + result['data']['id'] + '" style="display:none;">\
                                <div class="row mb0">\
                                    <form id="postforumcommentrply" method="POST">\
                                        <div class="col m10">\
                                            <textarea id="textarea1" name="forum_comment_reply" placeholder="Write a reply first ..." class="materialize-textarea forumcommentarea mb0"></textarea>\
                                            <input type="hidden" name="forum_id" value="' + result['data']['forum_id'] + '">\
                                            <input type="hidden" name="comment_id" value="' + result['data']['id'] + '">\
                                        </div>\
                                        <div class="col m2">\
                                            <input type="submit" class="btn btn-default bluegray forumbtnrply" value="send">\
                                        </div>\
                                    </form>\
                                </div>\
                                <div id="replylist_' + result['data']['id'] + '">\
                                </div>\
                            </div>\
                        </div>\
                    </div>';
                var user_opinion = $('.forumaction.active').attr('data-btntype');
                if (user_opinion == "like") {
                    var currentcount = $('#commentstab>li>a .like').html();
                    if (currentcount < 1) {
                        $('#likecomments .commentbox h6').css('display', 'none');
                    }
                    $('#commentstab>li>a .like').html(parseInt(currentcount) + 1);
                    $("#likecomments .commentbox").prepend(html);
                } else if (user_opinion == "neutral") {
                    var currentcount = $('#commentstab>li>a .neutral').html();
                    if (currentcount < 1) {
                        $('#neutralcomments .commentbox h6').css('display', 'none');
                    }
                    $('#commentstab>li>a .neutral').html(parseInt(currentcount) + 1);
                    $("#neutralcomments .commentbox").prepend(html);
                } else if (user_opinion == "dislike") {
                    var currentcount = $('#commentstab>li>a .dislike').html();
                    if (currentcount < 1) {
                        $('#dislikecomments .commentbox h6').css('display', 'none');
                    }
                    $('#commentstab>li>a .dislike').html(parseInt(currentcount) + 1);
                    $("#dislikecomments .commentbox").prepend(html);
                } else {

                }
                $('#postforumcomment')[0].reset();
            } else {
                Materialize.Toast.removeAll();
                Materialize.toast(result['message'], 4000);
            }
        });
        setTimeout(function (e) {
            $('.loadersmall').css('display', 'none');
        }, 1000)
    });
//    $('.postforumcommentrply').submit(function (e) {
    $(document).on('submit', '#postforumcommentrply', function (e) {
        e.preventDefault();
        var _this = $(this);
        $('.loadersmall').css('display', 'block');
        $.ajax({
            url: '<?php echo base_url(); ?>Forum/add_comment_reply',
            method: "POST",
            data: $(this).serialize(),
        }).done(function (result) {
<?php if (empty($this->session->userdata('data'))) { ?>
                window.location.assign("<?= base_url() ?>Login");
<?php } ?>
            result = JSON.parse(result);
            if (result['status']) {
                var html = "";
                console.log(result['data']);
                var formattedDate = getDateString(new Date(result['data']['created_date']), "d M y")
                html = '<hr class="commentseprator"><div class="row mb0">\
                        <div class="col m6 s6">\
                            <h6 class="forumsubhead fs14px" style="color: #00aff2;">\
                                <i class="flaticon-social-2"></i>\
                                <i style="margin-left: 5px;">By Me</i></h6>\
                        </div>\
                        <div class="col m6 s6">\
                            <h6 class="forumsubhead fs12px right right-align"><i>' + formattedDate + '</i></h6>\
                        </div>\
                    </div>\
                        <div class="ml30">\
                                <h3 class="fs14px mtb10 tastart">' + result['data']['reply'] + '</h3>\
                            </div>';
                $('#replylist_' + result['data']['comment_id']).append(html);
                //$('#postforumcommentrply')[0].reset();
                $('Form#postforumcommentrply').trigger("reset");
                var currentreplies = $('.showreplies[data-cmtid=' + result['data']['comment_id'] + ']').html();
                $('.showreplies[data-cmtid=' + result['data']['comment_id'] + ']').html(parseInt(currentreplies) + 1 + " Replies");
            } else {
                Materialize.Toast.removeAll();
                Materialize.toast(result['message'], 4000);
            }
            var cmt_id = result['data']['comment_id'];
            console.log(cmt_id);
            adv = Math.round($('#' + activeCommentTab + ' .commentbox').scrollTop() + $("#replylist_" + cmt_id + " > div:last-child").position().top) - 70;
            //position = $('.commentbox').scrollTop() + $("#replylist_"+cmt_id+" > div:last-child").position().top - $('.commentbox').height()/2 + $("#replylist_"+cmt_id+" > div:last-child").height()/2;
            console.log(adv);
            console.log("#replylist_" + cmt_id + " > div:last-child");
            $('.commentbox').animate({
                scrollTop: adv
            }, 2000);
        });
        setTimeout(function (e) {
            $('.loadersmall').css('display', 'none');
        }, 1000)


    });
</script>
<script>
    $(document).on('click', '#editforum', function (e) {
        var forumid = $(this).attr('data-forumid');
        var forumtitle = $(this).attr('data-title');
        var preview = $(this).attr('data-image');
        
        $('#discussion_id').val(forumid);
        $('#textarea1').val(forumtitle);
        $('#imgPrime').attr('src', preview);
        $('#imgPrime').css('display', 'block');
        $('#removethumb').css('display', 'block');
        document.getElementById('removethumb').addEventListener('click', function () {
            //_this.removeAllFiles();
            $("#imgPrime").attr("src", '');
            $('#imgPrime').css('display', 'none');
            $('#removethumb').css('display', 'none');
            $('input[type=file]').val(null);
        });
>>>>>>> df1d683f6e4333797f1d723bdb5f4dea317ced07
    });
    
   $(document).on('click','.confdelete',function(e){
       var forumid=$(this).attr('data-forumid');
       $('#confirmdelete .yes').attr('data-forumid',forumid);
       //alert("hello");
   });
   
   $(document).on('click','.yes',function(e){
       var forumid=$(this).attr('data-forumid');
       $.ajax({
            url: '<?php echo base_url(); ?>Forum/deactive_forum',
            method: "POST",
            data: {forumid:forumid},
        }).done(function (result) {
            console.log(result);
            result = JSON.parse(result);
            console.log(result);
            if (result['status']) {
                Materialize.Toast.removeAll();
                Materialize.toast(result['message'], 4000);
                setTimeout(function(){
                    window.location.assign("<?= base_url() ?>Forum");
                },2000)
            }
        });
   });
</script>


