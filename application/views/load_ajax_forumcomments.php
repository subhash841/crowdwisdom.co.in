<ul id="commentstab" class="tabs" style="padding-left:0px;background: transparent;">
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
                                            <textarea id="textarea1" name="forum_comment_reply" placeholder="Write a reply" class="materialize-textarea forumcommentarea mb0"></textarea>
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
                                            <textarea id="textarea1" name="forum_comment_reply" placeholder="Write a reply"class="materialize-textarea forumcommentarea mb0"></textarea>
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
                                            <textarea id="textarea1" name="forum_comment_reply" placeholder="Write a reply"class="materialize-textarea forumcommentarea mb0"></textarea>
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
<script>
   $('#commentstab').tabs();
</script>