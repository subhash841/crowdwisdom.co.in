<?php
$today = date("Y-m-d H:i:s");
$this->load->helper('common_helper');
?>
<div class="row mb0">
    <?php foreach ($moredata as $md) { ?>
        <div class="col l12 m12 s12">
            <?php
            $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                "(", ")", "{", "}", "|", "/", ";", "'", "<",
                ">", ",", '"', "?");
            $title = str_replace($spchar, "", $md['question']);
            $title = str_replace(' ', '-', $title);
            $uri_parts = explode('?', $_SERVER['REQUEST_URI']);
            //$href = base_url() . 'index.php/Poll/#stockpoll&pid=' . $md['id'] . "/" . $title;. "&title=" . $title
            $href = urlencode(base_url() . "Survey/surveydetail/" . $md['id'] . "?_t=" . time());

            $target = 'target = "_blank"';

            $d1 = strtotime($md['end_date']);
            $d2 = strtotime($today);
            //$end_date = date('Y-m-d', $d1);
            $today = date('Y-m-d', $d2);
            ?>
            <div class="card p20  equal-height" id="card_<?= $md['id']; ?>">
                <div class="card_content pollcard-scrollbar">
                    <div class="row mb0">
                                                            <div class="col m2 s3">
                                                                <div class="votescountbox">
                                                                    <img src="<?= base_url('images/common/vote.png'); ?>" alt=""/>
                                                                    <?php
                                                                        $votesdigits="";
                                                                        if($md['total_votes']>0 && $md['total_votes']<10){
                                                                            $votesdigits="twodigit";
                                                                            $md['total_votes']='0'.$md['total_votes'];
                                                                        }
                                                                        if($md['total_votes']>9 && $md['total_votes']<=99){
                                                                           $votesdigits="twodigit"; 
                                                                        } else if($md['total_votes']>99){
                                                                           $votesdigits="threedigit"; 
                                                                        }
                                                                    ?>
                                                                 <span class="fs14px fw500 votetext_<?= $md['id']; ?> <?= $votesdigits ?>"><?= $md['total_votes'] ?></span>
                                                                </div>
                                                                    <!--<i class="flaticon-info readdescinfo pull-right" onClick="showdescription(<?= $md['id']; ?>, 'md', this)"></i>-->
                                                            </div>
                                                            <div class="col m9 s8">
                                                                <div class="col s12">
                                                                    <div class="row mb10">
                                                                        <h6 class="fs18px tastart fw500 m-0 pollquestion" style=""><?= linkify($md['question']) ?></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php if ($md['user_id'] == $uid) { ?>
                                                            <div class="col m1 s1">
                                                                    <div class="">
                                                                        <a materialize="dropdown" class='dropdown-button pollubhead right'  href='#' data-activates='mypollactions_<?= $md['id']; ?>'>
                                                                            <i class="flaticon-three-1"></i>
                                                                        </a>
                                                                        <ul id='mypollactions_<?= $md['id']; ?>' class='dropdown-content'>

                                                                            <li id="editpoll" class="<?php if ($md['total_votes'] > 25) { echo "hide"; } ?>" data-rowjson='<?php echo json_encode($md); ?>' data-pollid="<?= $md['id'] ?>" data-title="<?= trim(preg_replace('/\s\s+/', ' ', $md['question'])); ?>" >
                                                                                <h6 class="fs16px mypoll ">Edit</h6>
                                                                            </li>
                                                                            <li>
                                                                                <a class="fs16px mypoll modal-trigger confdelete" href="#confirmdelete" data-pollid="<?= $md['id'] ?>">Delete</a>
                                                                                <h6 class="fs16px mypoll">Delete</h6>
                                                                            </li>
                                                                            <li class="hide"><h6 class="fs16px mypoll">Report</h6></li>
                                                                        </ul>
                                                                    </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                    <div class="row mb0 minusmarvote">
                        <div class="col m2 s3 p-0">
<!--                                                            <span class="votescountbox hide-on-med-and-up show-on-small">
                                <span class="flaticon-click ml0"></span>
                                <span class="fs12px fw500 votetext_<?= $md['id']; ?>"><?= $md['total_votes'] ?>  <?= $md['total_votes']>1?"Votes":"Vote"; ?></span>
                            </span>-->
                        </div>
                        <div class="col m9 s8">
                                <?php
                                $display_name = "";
                                if ($md['raised_by_admin'] == "1") {
                                    $display_name = '<img src="' . base_url() . 'images/logo/crowd-wisdom.png" class="bycrowdwisdom">';
                                } else {
                                    $display_name = ($uid == $md['user_id']) ? 'You' : $md['byuser'];
                                }
                                ?>
                                <h6 class="forumsubhead fs12px tastart m-0 lightgray fw500"><i>By <?= $display_name ?>, <?= date('j M Y', strtotime($md['created_date'])); ?> </i></h6>
                        </div>

                    </div>
                    <div class="row mb10">
                        <div class="col m12 s12 polldescr" id="description_<?= $section . $md['id']; ?>">
                            <h6 class="fs14px tastart" style=""><?= linkify($md['description']) ?></h6>
                        </div>
                    </div>
                </div>
                <div class="row mb0">
                    <?php
                    $allowvote = "";
                    $choicedisable = "";
                    if (!empty($md['user_choice'])) {
                        $allowvote = "votedpoll";
                    }
//                    if ($end_date < $today) {
//                        $allowvote = "votedpoll";
//                        $choicedisable = "choicedisabled";
//                    }
                    ?>
                    <div data-tabname="<?= $section ?>" class="polloptions polloption_<?= $md['id']; ?>  p-0 <?= $allowvote ?> <?= $choicedisable ?>" id="polloption<?= $section ?>_<?= $md['id']; ?>">
                        <?php foreach ($md['options'] as $index => $op) { ?>
                            <div class = "col m12 s12">
                                <div class = "row mb7">
                                    <div class="col m12 s12">
                                        <label class = "polloption progress" style="position: relative;">
                                            <?php
                                            $showresults = "";
                                            if ($op['choice'] == "Do not know or skip" || strtolower($op['choice']) == "see the results") {
                                                $showresults = "showresults";
                                            }
                                            ?>
                                            <input class = "with-gap pollchoice_<?= $md['id'] ?> <?= $showresults ?>" name = "pollchoice<?= $section ?>_<?= $md['id'] ?>" data-pollid="<?= $md['id'] ?>" data-type="<?= $section ?>" data-total="<?= $op['total'] ?>" type = "radio" value="<?= $op['choice_id']; ?>" <?= $op['choice_id'] == $md['user_choice'] ? "checked" : "" ?>/>
                                            <span class="customradio">
                                                <i class="flaticon-check selected"></i>
                                            </span>
                                            <span style="position:absolute;" class="fs14px choicetext"><?= ($op['choice'] == "Do not know or skip" || strtolower($op['choice']) == "see the results" ? "<b>See The Results</b>" : $op['choice']) ?></span>
                                            <div class = "determinate <?= $op['choice_id'] == $md['user_choice'] ? "userselected" : "" ?>" style = "width: 0%" data-afterload="<?= $op['avg'] ?>"></div>
                                            <?php if ($op['choice'] != "See the Results") { ?>
                                                <span class="avgpercount fs14px"><?= $op['avg'] ?> %</span>
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                </div>
                <div class="show-on-med-and-up hide-on-small-only">
                    <div class="row mb15">
                        <div class="col s12">
                            <?php if (!empty($md['user_choice'])) { ?>
<!--                                    <span class="votescountbox mr20">
                                        <span class="flaticon-click ml0 mr5"></span>
                                        <span class="fs14px fw500"><?= $md['total_votes'] ?>  Votes</span>
                                    </span>-->
                                    <?php } else { ?>
                                    <button type="submit" data-pollid="<?= $md['id']; ?>"  data-type="gov" data-catid="<?= $md['category_id'] ?>" data-totalvotes="<?= $md['total_votes'] ?>" class="btn btn-default pollbtnvote mr20">Vote</button>
                            <?php } ?>
                            <span class="mr20">
                                <span class="flaticon-multimedia ml0 mr10 fw500 lightgray fs14px  linkpointer  share red-text" data-section="<?= $section ?>" data-pollid="<?= $md['id']; ?>">Share
                                    <div class="tooltip share_<?= $section . $md['id']; ?>"><div class="tooltip-arrow" style="left: 20%;"></div>
                                        <a class="share-icon facebook" data-mobile-iframe="true" href="http://www.facebook.com/sharer/sharer.php?u=<?= $href ?>" target="_blank"><span class="fa fa-facebook"></span></a>
                                        <a class="share-icon twitter" href=" https://twitter.com/intent/tweet?url=<?= $href ?>&ael;text='<?= urlencode($md['question']) ?>'&ael;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
                                        <a class="share-icon whatsapp" href="https://web.whatsapp.com/send?text=<?= $href ?>" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                        <a class="share-icon linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $href ?>&title=<?= $title ?>"  target="_blank"><span class="fa fa-linkedin"></span></a>
                                    </div>
                                </span>
                            </span>
                            <span>
                                <span class="flaticon-comment ml0 mr10 fw500 lightgray fs14px  linkpointer showritecmt red-text" data-section="<?= $section ?>" data-pollid="<?= $md['id']; ?>">Comment
                                </span>
                                <span class="pull-right lightgray fs14px fw500 showcmtcount red-text" data-totalcomments="<?= $md['total_comments'] ?>" data-section="<?= $section ?>" data-pollid="<?= $md['id']; ?>" onclick="showcommentsec(<?= $md['id']; ?>, '<?= $section ?>')"><?= $md['total_comments'] ?> <?= $md['total_comments'] > 1 ? " Comments" : " Comment" ?></span>
                        </div>
                    </div>
                </div>
                <div class="hide-on-med-and-up show-on-small">
                    <div class="row mb15 center">
                       <?php if (!empty($md['user_choice'])) { ?>
<!--                            <span class="votescountbox mr7">
                                <span class="flaticon-click ml0 mr5"></span>
                                <span class="fs10px fw500"><?= $md['total_votes'] ?>  Votes</span>
                            </span>-->
                            <?php } else { ?>
                            <button type="submit" data-pollid="<?= $md['id']; ?>"  data-type="gov" data-catid="<?= $md['category_id'] ?>" data-totalvotes="<?= $md['total_votes'] ?>" class="btn btn-default pollbtnvote mr7">Vote</button>
                            <?php }
                        ?>      
                        <span class="flaticon-multimedia ml0 mr7 fw500 lightgray fs10px  linkpointer share red-text" onclick="share('<?= urldecode($href) ?>', this)" data-section="<?= $section ?>" data-pollid="<?= $md['id']; ?>">Share
                            <div class="tooltip share_<?= $section ?><?= $md['id']; ?>"><div class="tooltip-arrow" style="left: 20%;"></div>
                                <a class="share-icon facebook" data-mobile-iframe="true" href="http://www.facebook.com/sharer/sharer.php?u=<?= $href ?>" target="_blank"><span class="fa fa-facebook"></span></a>
                                <a class="share-icon twitter" href=" https://twitter.com/intent/tweet?url=<?= $href ?>&ael;text='<?= urlencode($md['question']) ?>'&ael;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
                                <a class="share-icon whatsapp" href="whatsapp://send?text=<?= $href ?>" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                <a class="share-icon linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $href ?>&title=<?= $title ?>"  target="_blank"><span class="fa fa-linkedin"></span></a>
                            </div>
                        </span>
                        <span class="flaticon-comment ml0  mr7 fw500 lightgray fs10px  linkpointer showritecmt red-text" data-section="<?= $section ?>" data-pollid="<?= $md['id']; ?>"><?= $md['total_comments'] > 1 ? "Comments" : "Comment" ?> <span class="cmtbadge"><?= $md['total_comments'] ?></span>
                        </span>
                        <!--<span class="pull-right lightgray fs10px mt7 fw500 showcmtcount" data-totalcomments="<?= $md['total_comments'] ?>" data-section="money" data-pollid="<?= $md['id']; ?>" onclick="showcommentsec(<?= $md['id']; ?>, 'money')"><?= $md['total_comments'] ?> comments</span>-->
                    </div>
                </div>

                <div class="loadersmall" style="display:none"></div>
                <div id="togglecmtsec_<?= $section ?>_<?= $md['id']; ?>" class="togglecmtsec">
                    <div class="row mb10">
                        <?php //if ($end_date >= $today) { ?>
                        <form id="postpollcomment" class="postpollcomment" name="postpollcmt" method="POST" action="<?= base_url() ?>Survey/add_comment">
                            <div class="col s12">
                                <div style="position:relative">
                                    <textarea type="text" id="textarea1" class="writereply textarea-scrollbar" data-autoresize name="poll_comment" placeholder="Type your comments here..."></textarea>
                                    <span onclick="$(this).submit()" class="textareaicon"><span class="material-icons prefix sendarrowreply">send</span></span>
                                </div>
                                <input type="hidden" name="poll_id" value="<?= $md['id']; ?>"/>
                                <input type="hidden" name="poll_cmt_id" value="0"/>
                            </div>
                        </form>
                        <?php //} ?>
                    </div>
                    <div class="row mb0" id="pollreact">
                        <div class="commentbox custom-scrollbar">
                            <?php if (!empty($md['All_comments'])) { ?>
                                <?php foreach ($md['All_comments'] as $ac) { ?>
                                    <div class="col s12">
                                        <div class="commentsection" id="cm_<?= $ac['id'] ?>">
                                            <div class="pollcardlist p-0">
                                                <div class="row mb0">
                                                    <div class="col m11 s11">
                                                        <h6 class="forumsubhead fs12px tastart mt5 lightgray fw500"><span class="flaticon-social-2 ml10 mr0"></span><i>By <?= $uid == $ac['user_id'] ? 'You' : $ac['byuser']; ?>, <?= date('j M Y', strtotime($md['created_date'])); ?> </i></h6>
                                                    </div>
                                                    <div class="col m1 s1">
                                                        <?php if ($ac['user_id'] == $uid) { ?>
                                                            <a materialize="dropdown" class='dropdown-button pollubhead right'  data-activates='mypollcmt<?= $ac['id'] ?>'>
                                                                <i class="flaticon-three-1 lightgray is20px"></i>
                                                            </a>
                                                            <ul id='mypollcmt<?= $ac['id'] ?>' class='dropdown-content mpcmt'>
                                                                <li>
                                                                    <a class="fs16px editcmt" data-cmtid="<?= $ac['id'] ?>" data-cmttxt="<?= $ac['comment'] ?>" >Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a class="fs16px deletecmt" data-cmtid="<?= $ac['id'] ?>">Delete</a>
                                                                </li>
                                                            </ul>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="ml45">
                                                    <div class="cmteditbox positir">
                                                        <div class="mr35 whitespacepre"><?= $ac['comment'] ?></div>
                                                        <div class="hide posrela">
                                                            <textarea type="text" data-autoresize rows="2" id="cmt_<?= $ac['id'] ?>" data-value="<?= $ac['comment'] ?>" data-pollid="<?= $md['id'] ?>" data-cmtid="<?= $ac['id'] ?>" readonly class="<?= $ac['user_id'] == $uid ? "commentedit" : "" ?> mb0 textarea-scrollbar"><?= $ac['comment'] ?></textarea>
                                                            <span data-cmtid="<?= $ac['id'] ?>" class="textareaicon1"><span class="material-icons prefix sendarrow">send</span></span>
                                                        </div>
                                                    </div>
                                                    <div class="row txtbluegray cmtop mb0">
                                                        <div class="col m7 s7"><h6 class="fs12px linkpointer showreplies_icon fs12px fw500 lightgray" data-cmtid="<?= $ac['id'] ?>" data-pollid="<?= $md['id'] ?>" data-replyset="0"><i class="flaticon-arrow-1 lightgray"></i>Reply</h6></div>
                                                        <div class="col m5 s5 right right-align">
                                                            <span class="mr10 lightgray fs12px fw500 linkpointer showreplies" data-cmtid="<?= $ac['id'] ?>" data-pollid="<?= $md['id'] ?>" data-replyset="0" data-totalreply="<?= $ac['total_replies'] ?>"><?= $ac['total_replies'] ?><?= $ac['total_replies'] > 1 ? " Replies" : " Reply" ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="replies<?= $ac['id'] ?>" style="display:none;">
                                                        <div class="row m10">
                                                            <?php //if ($end_date >= $today) { ?>
                                                            <form id="postpollcommentrply" method="POST">
                                                                <div class="col m12 s12">
                                                                    <div style="position:relative">
                                                                        <textarea type="text" id="textarea1" class="writereply textarea-scrollbar" data-autoresize name="poll_comment_reply" placeholder="Write a reply"></textarea>
                                                                        <span onclick="$(this).submit()" class="textareaicon"><span class="material-icons prefix sendarrowreply">send</span></span>
                                                                        <input type="hidden" name="poll_id" value="<?= $md['id'] ?>"/>
                                                                        <input type="hidden" name="comment_id" value="<?= $ac['id'] ?>"/>
                                                                    </div>
                                                                </div>

                                                            </form>
                                                            <?php //} ?>
                                                        </div>
                                                        <div id="replylist_<?= $ac['id'] ?>">
                                                        </div>
                                                    </div></div>
                                            </div>
                                            <hr class="commentseprator">
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <?php if ($md['total_comments'] > 2) { ?>
                            <div class="row mb0">
                                <div class="col s12">
                                    <div class="loadmore fs12px fw500 lightgray" style="display:block" data-pageid="0" data-pollid="<?= $md['id']; ?>" data-sectype="<?= $section ?>" data-totalcomments="<?= $md['total_comments'] ?>">View more comments.</div>
                                </div>
                            </div>
                        <?php } else if ($md['total_comments'] == 0) { ?>
                            <div class="row mb0">
                                <div class="col s12">
                                    <div class="nocmtdata fs12px fw500 lightgray" style="display:block" >Currently no comments available.</div>
                                </div>
                            </div>
                            <?php
                        } else {
                            
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    <?php } ?>
<?php if ($total_polls > ($next_page * 10)) { ?>
        <div class="row mb0">
            <div class="center">
                <div class="loadmorepage btn themered" data-category="<?= $category_name ?>" data-pageid="<?= $next_page ?>" data-catid="<?= $category_id ?>">See More</div>
            </div>
        </div>
    <?php } else if ($total_polls <= 10) { ?>
        <div class="loadmorepage btn themered" style="display:none" data-category="<?= $category_name ?>" data-pageid="0" data-catid="<?= $category_id ?>"></div>
    <?php } else { ?>
        <div class="loadmorepage btn themered" style="display:none" data-category="<?= $category_name ?>" data-pageid="0" data-catid="<?= $category_id ?>"></div>
<?php } ?>
</div>