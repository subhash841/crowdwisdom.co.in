<?php
$today = date("Y-m-d H:i:s");
$this->load->helper('common_helper');
?>
<style>
    button + .votescountbox{
        display:none;
    }
</style>
<input type="hidden" id="redirecturl" value="<?= base_url() ?>Login?section=article">
<div class="content container forumpages forumpagelist articlelists articledetail" id="forumdetailpage">
    <div class="col s12">
        <div class="row">
            <div class="col l8 s12 plr15">
                <div class="row">
                    <div class="" style="position:relative">
                        <div class="loadersmall">
                            <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                        </div>
                    </div>
                    <div id="elecarticle" class="col s12" <?= !empty($articles) ? "active" : "" ?>>
                        <div class="row mb0">
                            <?php if (isset($article_detail)) { ?>
                                <?php if (!empty($article_detail)) { 
                                        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                                ?>
                                        <div class="col l12 m12 s12">
                                            <?php
                                            $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "|", "/", ";", "'", "<", ">", ",", '"', "?");
                                            $title = str_replace($spchar, "", $article_detail['question']);
                                            $title = str_replace(' ', '-', $title);
                                            $uri_parts = explode('?', $_SERVER['REQUEST_URI']);
                                            $href = urlencode(base_url() . "RatedArticle/articledetail/" . $article_detail['id'] . "?_t=" . time());
                                            $target = 'target = "_blank"';
                                            $preview="";
                                            ?>
                                            <?php
                                            $d1 = strtotime($article_detail['end_date']);
                                            $d2 = strtotime($today);
                                            $end_date = date('Y-m-d', $d1);
                                            $today = date('Y-m-d', $d2);
                                            ?>
                                            <div class="card p20  equal-height" id="card_<?= $article_detail['id']; ?>">
                                                <div class="card_content articlecard-scrollbar">
                                                    <div class="row mb0">
                                                        <div class="col m2 s3">
                                                            <div class="votescountbox">
                                                                <img src="<?= base_url('images/common/vote.png'); ?>" alt=""/>
                                                                <?php
                                                                $votesdigits = "";
                                                                if ($article_detail['total_votes'] > 0 && $article_detail['total_votes'] < 10) {
                                                                    $votesdigits = "twodigit";
                                                                    $article_detail['total_votes'] = '0' . $article_detail['total_votes'];
                                                                }
                                                                if ($article_detail['total_votes'] > 9 && $article_detail['total_votes'] <= 99) {
                                                                    $votesdigits = "twodigit";
                                                                } else if ($article_detail['total_votes'] > 99) {
                                                                    $votesdigits = "threedigit";
                                                                }
                                                                ?>
                                                                <span class="fs14px fw500 votetext_<?= $article_detail['id']; ?> <?= $votesdigits ?>"><?= $article_detail['total_votes'] ?></span>
                                                            </div>
                                                        <!--<i class="flaticon-info readdescinfo pull-right" onClick="showdescription(<?= $article_detail['id']; ?>, 'gov', this)"></i>-->
                                                        </div>
                                                        <div class="col m9 s8">
                                                            <div class="col s12">
                                                                <div class="row mb10">
                                                                    <h6 class="fs18px tastart fw500 m-0 articlequestion" style=""><?= linkify($article_detail['question']) ?></h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php $preview = preg_replace("/\r\n|\r|\n/",'<br/>',$article_detail['preview']);
                                                            unset($article_detail['preview']);
                                                            ?>
                                                        <?php if ($article_detail['user_id'] == $user_info['uid']) { ?>
<!--                                                            <div class="col m1 s1">
                                                                <div class="">
                                                                    <a materialize="dropdown" class='dropdown-button articleubhead right'  href='#' data-activates='myarticleactions_<?= $article_detail['id']; ?>'>
                                                                        <i class="flaticon-three-1"></i>
                                                                    </a>
                                                                    <ul id='myarticleactions_<?= $article_detail['id']; ?>' class='dropdown-content'>

                                                                        <li id="editarticle" class="<?php
                                                                        if ($article_detail['total_votes'] > 25) {
                                                                            echo "hide";
                                                                        }
                                                                        ?>" data-rowjson='<?php echo json_encode($article_detail); ?>' data-articleid="<?= $article_detail['id'] ?>" data-preview="<?= $preview ?>" data-title="<?= trim(preg_replace('/\s\s+/', ' ', $article_detail['question'])); ?>" >
                                                                            <h6 class="fs16px myarticle ">Edit</h6>
                                                                        </li>
                                                                        <li>
                                                                            <a class="fs16px myarticle modal-trigger confdelete" href="#confirmdelete" data-articleid="<?= $article_detail['id'] ?>">Delete</a>
                                                                        </li>
                                                                        <li class="hide"><h6 class="fs16px myarticle">Report</h6></li>
                                                                    </ul>
                                                                </div>
                                                            </div>-->
                                                        <?php } ?>
                                                    </div>
                                                    <div class="row mb0 minusmarvote">
                                                        <div class="col m2 s3 p-0">
                                                            <!--<span class="votescountbox hide-on-med-and-up show-on-small">
                                                                <span class="flaticon-click ml0"></span>
                                                                <span class="fs12px fw500 votetext_<?= $article_detail['id']; ?>"><?= $article_detail['total_votes'] ?>  <?= $article_detail['total_votes'] > 1 ? "Votes" : "Vote"; ?></span>
                                                            </span>-->
                                                        </div>
                                                        <div class="col m9 s8">
                                                            <?php
                                                            $display_name = "";
                                                            if ($article_detail['raised_by_admin'] == "1") {
                                                                $display_name = '<img src="' . base_url() . 'images/logo/crowd-wisdom.png" class="bycrowdwisdom">';
                                                            } else {
                                                                $display_name = ($user_id == $article_detail['user_id']) ? 'You' : $article_detail['byuser'];
                                                            }
                                                            ?>
                                                            <h6 class="forumsubhead fs12px tastart m-0 lightgray fw500"><i>By <?= $display_name ?>, <?= date('j M Y', strtotime($article_detail['created_date'])); ?> </i></h6>
                                                        </div>
                                                    </div>
                                                    <div class="row mb10">
                                                        <div class="col m12 s12 articledescr" id="description_gov<?= $article_detail['id']; ?>">
                                                            <h6 class="fs14px tastart" style="font-weight: 600;">
                                                                <?php
                                                                    if (preg_match($reg_exUrl, $article_detail['description'], $title_url)) {
                                                                        //$desc = preg_replace($reg_exUrl, "<a href='" . $title_url[0] . "' target='_blank'>" . $title_url[0] . "</a> ", $article_detail['description']);
                                                                        $desc = str_replace($title_url[0], "", $article_detail['description']);
                                                                        $link = $title_url[0];
                                                                    } else {
                                                                        $desc = $article_detail['description'];
                                                                        $link = "";
                                                                    }
                                                                    if($link==""){
                                                                    echo '<div class="row">
                                                                            <div class="col m4 s12">
                                                                                <div class="previewimg"><br>
                                                                                    <img src="'.base_url().'images/relatedarticle/'.$article_detail['image'].'" class="linkpreviewimg">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col m8 s12">
                                                                                <div class="previewtext">
                                                                                    <h3 class="fs14px lightgray tastart">'.$desc.'</h3>
                                                                                </div>
                                                                            </div>
                                                                        </div>';
                                                                    }
                                                                    else{
                                                                        echo $desc;
                                                                    }
                                                                ?>
                                                            </h6><!--linkify-->
                                                            <?php
                                                                if($link!=""){
                                                                    echo '<a href="'.$title_url[0].'" target="_blank">'.htmlspecialchars_decode($preview).'</a>';
                                                                }
                                                                else{
                                                                    echo htmlspecialchars_decode($preview);
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb0">
                                                    <?php
                                                    $allowvote = "";
                                                    $choicedisable = "";
                                                    if (!empty($article_detail['user_choice'])) {
                                                        $allowvote = "votedarticle";
                                                    }
                                                    ?>
                                                    <div data-tabname="gov" class="articleoptions articleoption_<?= $article_detail['id']; ?>  p-0 <?= $allowvote ?> <?= $choicedisable ?>" id="articleoptiongov_<?= $article_detail['id']; ?>">
                                                        <?php foreach ($article_detail['options'] as $index => $op) { ?>
                                                            <div class = "col m12 s12">
                                                                <div class = "row mb7">
                                                                    <div class="col m12 s12">
                                                                        <label class = "articleoption progress" style="position: relative;">
                                                                            <?php
                                                                            $showresults = "";
                                                                            if ($op['choice'] == "Do not know or skip" || strtolower($op['choice']) == "click to see rating") {
                                                                                $showresults = "showresults";
                                                                            }
                                                                            ?>
                                                                            <input class = "with-gap <?= $showresults ?> articlechoice_<?= $article_detail['id'] ?>" name = "articlechoicegov_<?= $article_detail['id'] ?>" data-articleid="<?= $article_detail['id'] ?>" data-type="gov" data-total="<?= $op['total'] ?>" type = "radio" value="<?= $op['choice_id']; ?>" <?= $op['choice_id'] == $article_detail['user_choice'] ? "checked" : "" ?>/>
                                                                            <span class="customradio">
                                                                                <i class="flaticon-check selected"></i>
                                                                            </span>
                                                                            <span class="fs14px choicetext"><?= ($op['choice'] == "Do not know or skip" || strtolower($op['choice']) == "click to see rating" ? "<b>Click to see Rating</b>" : $op['choice']) ?></span><!--style="position:absolute;" -->
                                                                            <div class = "determinate <?= $op['choice_id'] == $article_detail['user_choice'] ? "userselected" : "" ?>" style = "width: 0%" data-afterload="<?= $op['avg'] ?>"></div>
                                                                            <?php
                                                                            if (strtolower($op['choice']) != "click to see rating") {
                                                                                ?>
                                                                                <span class="avgpercount fs14px"><?= $op['avg'] ?> %</span>
                                                                                <?php
                                                                            }
                                                                            ?>
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
                                                            <?php if (empty($article_detail['user_choice'])) { ?>
                                                                <button type="submit" data-articleid="<?= $article_detail['id']; ?>"  data-type="gov" data-catid="<?= $article_detail['category_id'] ?>" data-totalvotes="<?= $article_detail['total_votes'] ?>" class="btn btn-default articlebtnvote mr20">Vote</button>
                                                            <?php } ?>
                                                            <span class="mr20">
                                                                <span class="flaticon-multimedia ml0 mr10 fw500 lightgray fs14px  linkpointer  share red-text" data-section="gov" data-articleid="<?= $article_detail['id']; ?>">Share
                                                                    <div class="tooltip share_gov<?= $article_detail['id']; ?>"><div class="tooltip-arrow" style="left: 20%;"></div>
                                                                        <a class="share-icon facebook" data-mobile-iframe="true" href="http://www.facebook.com/sharer/sharer.php?u=<?= $href ?>" target="_blank"><span class="fa fa-facebook"></span></a>
                                                                        <a class="share-icon twitter" href="https://twitter.com/intent/tweet?url=<?= $href ?>&text='<?= urlencode($article_detail['question']) ?>'&ael;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
                                                                        <a class="share-icon whatsapp" href="https://web.whatsapp.com/send?text=<?= $href ?>" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                                                        <a class="share-icon linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $href ?>&title=<?= $title ?>"  target="_blank"><span class="fa fa-linkedin"></span></a>
                                                                    </div>
                                                                </span>
                                                            </span>
                                                            <span>
                                                                <span class="flaticon-comment ml0 mr10 fw500 lightgray fs14px  linkpointer showritecmt red-text" data-section="gov" data-articleid="<?= $article_detail['id']; ?>">Comment
                                                                </span>
                                                                <span class="pull-right lightgray fs14px fw500 showcmtcount red-text" data-totalcomments="<?= $article_detail['total_comments'] ?>" data-section="gov" data-articleid="<?= $article_detail['id']; ?>" onclick="showcommentsec(<?= $article_detail['id']; ?>, 'gov')"><?= $article_detail['total_comments'] ?> <?= $article_detail['total_comments'] > 1 ? " Comments" : " Comment" ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hide-on-med-and-up show-on-small">
                                                    <div class="row mb15 center">
                                                        <?php if (empty($article_detail['user_choice'])) { ?>
                                                            <button type="submit" data-articleid="<?= $article_detail['id']; ?>"  data-type="gov" data-catid="<?= $article_detail['category_id'] ?>" data-totalvotes="<?= $article_detail['total_votes'] ?>" class="btn btn-default articlebtnvote mr7">Vote</button>
                                                        <?php } ?>
                                                        <span class="flaticon-multimedia ml0 mr7 fw500 lightgray fs10px  linkpointer share red-text" onclick="share('<?= urldecode($href) ?>', this)" data-section="gov" data-articleid="<?= $article_detail['id']; ?>">Share
                                                            <div class="tooltip share_gov<?= $article_detail['id']; ?>"><div class="tooltip-arrow" style="left: 20%;"></div>
                                                                <a class="share-icon facebook" data-mobile-iframe="true" href="http://www.facebook.com/sharer/sharer.php?u=<?= $href ?>" target="_blank"><span class="fa fa-facebook"></span></a>
                                                                <a class="share-icon twitter" href=" https://twitter.com/intent/tweet?url=<?= $href ?>&text='<?= urlencode($article_detail['question']) ?>'&ael;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
                                                                <a class="share-icon whatsapp" href="whatsapp://send?text=<?= $href ?>" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                                                <a class="share-icon linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $href ?>&title=<?= $title ?>"  target="_blank"><span class="fa fa-linkedin"></span></a>
                                                            </div>
                                                        </span>

                                                        <span class="flaticon-comment ml0  mr7 fw500 lightgray fs10px  linkpointer showritecmt red-text" data-section="gov" data-articleid="<?= $article_detail['id']; ?>"><?= $article_detail['total_comments'] > 1 ? "Comments" : "Comment" ?> <span class="cmtbadge"><?= $article_detail['total_comments'] ?></span>
                                                        </span>
                                                        <!--<span class="pull-right lightgray fs10px mt7 fw500 showcmtcount" data-totalcomments="<?= $article_detail['total_comments'] ?>" data-section="gov" data-articleid="<?= $article_detail['id']; ?>" onclick="showcommentsec(<?= $article_detail['id']; ?>, 'gov')"><?= $article_detail['total_comments'] ?> Comments</span>-->
                                                    </div>
                                                </div>
                                                <div class="loadersmall" style="display:none"></div>
                                                <div id="togglecmtsec_gov_<?= $article_detail['id']; ?>" class="togglecmtsec">
                                                    <div class="row mb10">
                                                        <form id="postarticlecomment" class="postarticlecomment" name="postarticlecmt" method="POST" action="<?= base_url() ?>RatedArticle/add_comment">
                                                            <div class="col s12">
                                                                <div style="position:relative">
                                                                    <textarea type="text" id="textarea1" class="writereply textarea-scrollbar" data-autoresize name="article_comment" placeholder="Type your comments here..."></textarea>
                                                                    <span onclick="$(this).submit()" class="textareaicon"><span class="material-icons prefix sendarrowreply">send</span></span>
                                                                </div>
                                                                <input type="hidden" name="article_id" value="<?= $article_detail['id']; ?>"/>
                                                                <input type="hidden" name="article_cmt_id" value="0"/>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="row mb0" id="articlereact">
                                                        <div class="commentbox custom-scrollbar">
                                                            <?php if (!empty($article_detail['All_comments'])) { ?>
                                                                <?php foreach ($article_detail['All_comments'] as $ac) { ?>
                                                                    <div class="col s12">
                                                                        <div class="commentsection" id="cm_<?= $ac['id'] ?>">
                                                                            <div class="articlecardlist p-0">
                                                                                <div class="row mb0">
                                                                                    <div class="col m11 s11">
                                                                                        <h6 class="forumsubhead fs12px tastart mt5 lightgray fw500"><span class="flaticon-social-2 ml10 mr0"></span><i>By <?= $user_id == $ac['user_id'] ? 'You' : $ac['byuser']; ?>, <?= date('j M Y', strtotime($ac['created_date'])); ?> </i></h6>
                                                                                    </div>
                                                                                    <div class="col m1 s1">
                                                                                        <?php if ($ac['user_id'] == $user_info['uid']) { ?>
                                                                                            <a materialize="dropdown" class='dropdown-button articleubhead right'  data-activates='myarticlecmt<?= $ac['id'] ?>'>
                                                                                                <i class="flaticon-three-1 lightgray is20px"></i>
                                                                                            </a>
                                                                                            <ul id='myarticlecmt<?= $ac['id'] ?>' class='dropdown-content mpcmt'>
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
                                                                                            <textarea type="text" data-autoresize rows="2" id="cmt_<?= $ac['id'] ?>" data-value="<?= $ac['comment'] ?>" data-articleid="<?= $article_detail['id'] ?>" data-cmtid="<?= $ac['id'] ?>" readonly class="<?= $ac['user_id'] == $user_info['uid'] ? "commentedit" : "" ?> mb0 textarea-scrollbar"><?= $ac['comment'] ?></textarea>
                                                                                            <span data-cmtid="<?= $ac['id'] ?>" class="textareaicon1"><span class="material-icons prefix sendarrow">send</span></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row txtbluegray cmtop mb0">
                                                                                        <div class="col m7 s7"><h6 class="fs12px linkpointer showreplies_icon fs12px fw500 lightgray" data-cmtid="<?= $ac['id'] ?>" data-articleid="<?= $article_detail['id'] ?>" data-replyset="0"><i class="flaticon-arrow-1 lightgray"></i>Reply</h6></div>
                                                                                        <div class="col m5 s5 right right-align">
                                                                                            <span class="mr10 lightgray fs12px fw500 linkpointer showreplies" data-cmtid="<?= $ac['id'] ?>" data-articleid="<?= $article_detail['id'] ?>" data-replyset="0" data-totalreply="<?= $ac['total_replies'] ?>"><?= $ac['total_replies'] ?><?= $ac['total_replies'] > 1 ? " Replies" : " Reply" ?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="replies<?= $ac['id'] ?>" style="display:none;">
                                                                                        <div class="row m10">
                                                                                            <form id="postarticlecommentrply" method="POST">
                                                                                                <div class="col m12 s12">
                                                                                                    <div style="position:relative">
                                                                                                        <textarea type="text" id="textarea1" class="writereply textarea-scrollbar" data-autoresize name="article_comment_reply" placeholder="Write a reply"></textarea>
                                                                                                        <span onclick="$(this).submit()" class="textareaicon"><span class="material-icons prefix sendarrowreply">send</span></span>
                                                                                                        <input type="hidden" name="article_id" value="<?= $article_detail['id'] ?>"/>
                                                                                                        <input type="hidden" name="comment_id" value="<?= $ac['id'] ?>"/>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                        <div id="replylist_<?= $ac['id'] ?>">
                                                                                        </div>
                                                                                    </div></div>
                                                                            </div>
                                                                            <hr class="commentseprator">
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                        <?php
                                                        if ($article_detail['total_comments'] > 2) {
                                                            ?>
                                                            <div class="row mb0">
                                                                <div class="col s12">
                                                                    <div class="loadmore fs12px fw500 lightgray" style="display:block" data-pageid="0" data-articleid="<?= $article_detail['id']; ?>" data-sectype="gov" data-totalcomments="<?= $article_detail['total_comments'] ?>">View more comments.</div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        } else if ($article_detail['total_comments'] == 0) {
                                                            ?>
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
                                                <h6 class=" center" style="margin-bottom: -10px;"><a href="<?= base_url() ?>RatedArticle" class="btn themered " id="viewallprediction" style="text-transform:  capitalize;color:  white;">View all articles</a></h6>
                                            </div>
                                        </div>  
                                <?php } else { ?>
                                    <div class="col l12 m12 s12">
                                        <div class="card p5-20  equal-height">
                                            <div class="card_content center nodataarticle" style="margin: 12% 18%;">
                                                <img src="<?= base_url('images/infographics/1.png'); ?>" style="width: 50%;">
                                                <h3 class="fieldtitle">Seems like there are no questions posted here for you</h3>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l4 m12 s12 plr15 hide-on-med-and-down show-on-large">
                <div class="row">
                    <div class="card z-depth-4 padd0 mt15">
                        <div class="card-head p7_20">
                            <div class="bloghead"><span><img src="<?= base_url('images/icons/light.png'); ?>" class="sidecardheadimg"/></span><?= $sidebarname ?></div>
                        </div>
                        <div class="blogs-container withtable trend" data-trend="">
                            <?php if (!empty($trending)) { ?>
                                <div class="row">
                                    <div class="col s12 bindtrend">
                                        <?php foreach ($trending as $trend) { ?>
                                            <?php
                                            $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "|", "/", ";", "'", "<", ">", ",", '"', "?");
                                            $title = str_replace($spchar, "", $trend['question']);
                                            $title = str_replace(' ', '-', $title);
                                            $articlesec = '&pid=' . $trend['id'] . '';
                                            $uri_parts = explode('?', $_SERVER['REQUEST_URI']);
                                            $href = base_url() . 'RatedArticle/articledetail/' . $trend['id'];
                                            $target = 'target = "_blank"';
                                            ?>
                                            <div class="blogs p15_20">
                                                <div class="row">
                                                    <a href="<?= $href ?>">
                                                        <div class="col s12">
                                                            <div class="blog-title truncate"><?= $trend['question']; ?></div>
                                                            <div class="right blog-details lightgray">
                                                                <i class="lightgray flaticon-click ml0"></i>
                                                                <span class="lightgray fs12px"><?= $trend['total_votes'] ?>  Votes</span></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="loadmoretrending" data-page="1" data-catid="<?= $trending[0]['category_id'] ?>"></div>
                            <?php } else { ?>
                                <div class="center">
                                    <img src="<?= base_url('images/infographics/2.png'); ?>" style="width: 50%;">
                                    <!--<h3 class="fs16px fieldtitle ">No trending questions available. </h3>-->
                                    <h3 class="fs16px fieldtitle ">You haven't rated any article yet.</h3>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card z-depth-4 padd0">
                        <div class="card-head p7_20">
                            <div class="bloghead"><span class="flaticon-user mr25 usericon"></span>My Articles</div>
                        </div>
                        <div class="blogs-container withtable myraised">
                            <div class="row">
                                <div class="col s12 bindraised">
                                    <?php if (!empty($myraised)) { ?>
                                        <?php foreach ($myraised as $nvp) { ?>
                                            <?php
                                            $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "|", "/", ";", "'", "<", ">", ",", '"', "?");
                                            $title = str_replace($spchar, "", $nvp['question']);
                                            $title = str_replace(' ', '-', $title);
                                            $articlesec = '&pid=' . $nvp['id'] . '';
                                            $uri_parts = explode('?', $_SERVER['REQUEST_URI']);
                                            $href = base_url() . 'RatedArticle/articledetail/' . $nvp['id'];
                                            $target = 'target = "_blank"';
                                            ?>
                                            <div class="blogs p15_20">
                                                <div class="row">
                                                    <a href="<?= $href ?>">
                                                        <div class="col s12">
                                                            <div class="blog-title truncate"><?= $nvp['question']; ?></div>
                                                            <div class="right blog-details lightgray"><i class="material-icons icon-color">touch_app</i> <span class="total_votes"><?= $nvp['total_votes'] ?> Votes</span></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="loadmoremyraised" data-page="1" data-catid="myraised"></div>
                                    <?php } else { ?>
                                        <div class="center">
                                            <img src="<?= base_url('images/infographics/3.png'); ?>" style="width: 50%;">
                                            <h3 class="fs16px fieldtitle ">You haven't posted any article yet.</h3>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l4 m12 s12 plr15 show-on-medium-and-down hide-on-large-only">
                <div class="row">
                    <div class="card z-depth-4 padd0 mt15">
                        <div class="card-head p7_20">
                            <div class="bloghead"><span><img src="<?= base_url('images/icons/light.png'); ?>" class="sidecardheadimg"/></span><?= $sidebarname ?></div>
                        </div>
                        <div class="blogs-container withtable trend">
                            <?php if (!empty($trending)) { ?>
                                <div class="row">
                                    <div class="col s12 bindtrend">
                                        <?php foreach ($trending as $trend) { ?>
                                            <?php
                                            $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "|", "/", ";", "'", "<", ">", ",", '"', "?");
                                            $title = str_replace($spchar, "", $trend['question']);
                                            $title = str_replace(' ', '-', $title);
                                            $articlesec = '&pid=' . $trend['id'] . '';
                                            $uri_parts = explode('?', $_SERVER['REQUEST_URI']);
                                            $href = base_url() . 'RatedArticle/articledetail/' . $trend['id'];
                                            $target = 'target = "_blank"';
                                            ?>
                                            <div class="blogs p15_20">
                                                <div class="row">
                                                    <a href="<?= $href ?>">
                                                        <div class="col s12">
                                                            <div class="blog-title truncate"><?= $trend['question']; ?></div>
                                                            <div class="right blog-details lightgray">
                                                                <i class="lightgray flaticon-click ml0"></i>
                                                                <span class="lightgray fs12px"><?= $trend['total_votes'] ?>  Votes</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="loadmoretrending" data-page="1" data-catid="<?= $trending[0]['category_id'] ?>"></div>
                            <?php } else { ?>
                                <div class="center">
                                    <img src="<?= base_url('images/infographics/2.png'); ?>" style="width: 50%;">
                                    <!--<h3 class="fs16px fieldtitle ">No trending questions available. </h3>-->
                                    <h3 class="fs16px fieldtitle ">You haven't rated any article yet.</h3>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card z-depth-4 padd0">
                        <div class="card-head p7_20">
                            <div class="bloghead"><span class="flaticon-user mr25 usericon"></span>My Articles</div>
                        </div>
                        <div class="blogs-container withtable myraised">
                            <div class="row">
                                <div class="col s12 bindraised">
                                    <?php if (!empty($myraised)) { ?>
                                        <?php foreach ($myraised as $nvp) { ?>
                                            <?php
                                            $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "|", "/", ";", "'", "<", ">", ",", '"', "?");
                                            $title = str_replace($spchar, "", $nvp['question']);
                                            $title = str_replace(' ', '-', $title);
                                            $articlesec = '&pid=' . $nvp['id'] . '';
                                            $uri_parts = explode('?', $_SERVER['REQUEST_URI']);
                                            $href = base_url() . 'RatedArticle/articledetail/' . $nvp['id'];
                                            $target = 'target = "_blank"';
                                            ?>
                                            <div class="blogs p15_20">
                                                <div class="row">
                                                    <a href="<?= $href ?>">
                                                        <div class="col s12">
                                                            <div class="blog-title truncate"><?= $nvp['question']; ?></div>
                                                            <div class="right blog-details lightgray"><i class="material-icons icon-color">touch_app</i> <span class="total_votes"><?= $nvp['total_votes'] ?> Votes</span></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="loadmoremyraised" data-page="1" data-catid="myraised"></div>
                                    <?php } else { ?>
                                        <div class="center">
                                            <img src="<?= base_url('images/infographics/3.png'); ?>" style="width: 50%;">
                                            <h3 class="fs16px fieldtitle ">You haven't posted any article yet.</h3>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="confirmdelete" class="modal">
    <div class="modal-content">
        <h5 class="fs16px">Are you sure want to delete this Article ?</h5>
        <!--      <div>A bunch of text</div>-->
    </div>
    <div class="modal-footer">
        <a href="#!" class="btn themered waves-effect waves-green yes" data-articleid="">Yes</a>
        <a href="#!" class="btn modal-close waves-effect waves-red no">No</a>
    </div>
</div>
<!-- Points modal Display -->
<div id="pointsModal" class="modal modal-sm pointmodal">
    <div class="modal-content upper" style="padding:1px">
        <div class="center-align fs18px" id="title">Congratulation</div>
        <div class="center-align" style="position: relative;margin: 0;">
            <img src="<?= base_url('/images/banners/coin_f.png'); ?>" />
            <span class="pointcontainer fs14px"><span class="fs18px" id="points">1</span><br />Point</span>
        </div>
    </div>
    <div class="modal-content bottom" style="padding:1px">

        <div class="center-align fs14px fw500" id="msg" style="margin: 5px;">You earned 1 silver Point</div>
        <div class="center-align fs12px fw500" id="submsg" style="margin: 5px;"></div>
        <div class="center-align optionsbtn" style="margin-top: 0;">
            <span class="fs12px fw500" style="display: block;margin-bottom: 5px;">Do you want to redeem?</span>
            <button href="javascript:void(0)" class="btn savebtn redimoption orgtored yesredeem" style="">Yes</button>
            <button type="reset" class="knowmore borgtored p-0 redimoption noredeem"><h5 class="txtorgtored fs14px fw500">No</h5></button>
        </div>
    </div>
</div>

<script>

    $(function () {
        //create form slide down
        $("a#show-mobile-discussion").on('click', function () {
<?php
if (empty($this->session->userdata('data'))) {
    ?>
                var redirecturl = $('#redirecturl').val();
                window.location.assign(redirecturl);
    <?php
} else if (empty($user_info['alise'])) {
    ?>
                Materialize.Toast.removeAll();
                Materialize.toast('Please enter your alias first.', 2000);
                setTimeout(function () {
                    var redirect_url = $("#redirecturl").val();
                    var redirect_sess = redirect_url.split("?");
                    window.location.href = '<?= base_url() ?>Profile?' + redirect_sess[1];
                }, 2000);
    <?php
} else {
    ?>
                $('.askvotebanner').css('display', 'none');
                $('.slide-on-mobile').slideDown();
                $('#articletopic').focus();
    <?php
}
?>
        });

        //reset form slide up
        $('#postarticle button[type="reset"]').on('click', function () {
            $('.slide-on-mobile').slideUp();
            $('#articletopic').blur();
            $('#postarticle')[0].reset();
            var defaultchoice = '<div class="row choice mb10">\
                                    <div class="col s11">\
                                        <input type="text" name="choice[]" maxlength="35" placeholder="Enter your choice here"/>\
                                    </div>\
                                    <div class="col s1 no-padding">\
                                        <i class="flaticon-plus addmorechoice"></i>\
                                        <i class="flaticon-delete removechoice hide"></i>\
                                    </div>\
                                </div>\
                                <div class="row choice mb10">\
                                    <div class="col s11">\
                                        <input type="text" name="choice[]" maxlength="35" placeholder="Enter your choice here"/>\
                                    </div>\
                                    <div class="col s1 no-padding">\
                                        <i class="flaticon-plus addmorechoice"></i>\
                                        <i class="flaticon-delete removechoice hide"></i>\
                                    </div>\
                                </div>\
                                <div class="row choice mb10">\
                                    <div class="col s11">\
                                        <input type="text" name="choice[]"  maxlength="35" placeholder="Enter your choice here"/>\
                                    </div>\
                                    <div class="col s1 no-padding">\
                                        <i class="flaticon-plus addmorechoice"></i>\
                                        <i class="flaticon-delete removechoice "></i>\
                                    </div>\
                                </div>';
            $('#choiceslist').html(defaultchoice);
            $('.askvotebanner').css('display', 'block');
            $("html, body").animate({scrollTop: 0}, "slow");
        });

        //add more choices
        $(document).on('click', '.addmorechoice', function (e) {
            e.stopPropagation();
            if ($('#staticoption').css('display') == "none") {
                $('#staticoption').css('display', 'block');
            }
            var visible = $("#choiceslist .choice").length;

            var html = "";
            var addbtnstatus = "";
            if (visible < 10) {
                if (visible == 9) {
                    addbtnstatus = "hide";
                }

                html = '<div class="row choice mb10">\
                            <div class="col s11">\
                                <input type="text" name="choice[]" maxlength="35" placeholder="Enter your choice here"/>\
                            </div>\
                            <div class="col s1 no-padding">\
                                <i class="flaticon-plus addmorechoice ' + addbtnstatus + '"></i>\
                                <i class="flaticon-delete removechoice"></i>\
                            </div>\
                        </div>';
                $('#choiceslist').append(html);
                if (visible < 2) {
                    $('.choice .removechoice').addClass('hide');
                } else {
                    $('.choice .removechoice').removeClass('hide');
                }
            }
        });
//        
        //remove choices
        $(document).on('click', '.removechoice', function (e) {
            if ($('.addmorechoice').hasClass('disabled')) {
                $('.addmorechoice').removeClass('disabled');
            }
            var visible = $("#choiceslist .choice").length;
            if (visible >= 2) {
                $(this).parent().parent().remove();
                if (visible <= 3) {
                    $('.choice .removechoice').addClass('hide');
                } else {
                    $('.choice:last-child .addmorechoice').removeClass('hide');
                    $('.choice .removechoice').removeClass('hide');
                }
            } else {

                $('.choice .removechoice').addClass('hide');
                Materialize.Toast.removeAll();
                Materialize.toast('Minimum two options should be there', 4000);
            }
        });

        //click see more button
        $(document).on('click', '.loadmorepage', function (e) {
            var categoryid = $(this).attr('data-catid');
            var pageno = $(this).attr('data-pageid');
            var type = "";

            $(this).replaceWith("<div class='lds-roller pageloader' id='pageloader'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>");
            loaddatafortab(categoryid, pageno, type);
        });

        //trending scroll down to load more
        $('.trend').on('scroll', function () {
            if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                var categoryid = $('.loadmoretrending').attr('data-catid');
                var pageno = $('.loadmoretrending').attr('data-page');
                loaddatafortrending(categoryid, pageno);
            }
        });

        //My raised scroll down to load more
        $('.myraised').on('scroll', function () {
            if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                var categoryid = $('.loadmoremyraised').attr('data-catid');
                var pageno = $('.loadmoremyraised').attr('data-page');
                loaddataformyraised(categoryid, pageno);
            }
        });

        var login_redirect = $("#redirecturl").val();
        $(".head-login").attr("href", login_redirect);

        $("#tabs-swipe-demo1").tabs();

<?php if ($this->session->flashdata('toast')) { ?>
            Materialize.Toast.removeAll();
            Materialize.toast('<?= $this->session->flashdata('toast') ?>', 4000);
<?php } ?>

    });

    function checkArray(my_arr) {
        var count = 0;
        for (var i = 0; i < my_arr.length; i++) {
            if (my_arr[i] != "")
                count++;
        }
        return count;
    }

    function validateForm() {
        var topic = $("#articletopic").val();
        var articledescri = $('#articledescription').val();
        var choicearray = $("input[name='choice[]']").map(function () {
            return $(this).val();
        }).get();

        var choiceelement = checkArray(choicearray);
        if (topic == "") {
            Materialize.Toast.removeAll();
            Materialize.toast('Please enter question topic', 4000);
            return false;
        }
        if (articledescri == "") {
            Materialize.Toast.removeAll();
            Materialize.toast('Please enter question description', 4000);
            return false;
        }
        if (choiceelement == 0) {
            Materialize.Toast.removeAll();
            Materialize.toast('Please enter Choice', 4000);
            return false;
        }
        if (choiceelement < 2) {
            Materialize.Toast.removeAll();
            Materialize.toast('Please enter atleast two choices', 4000);
            return false;
        }
    }

    $(document).on('click', '.yesredeem', function (e) {
        $('#pointsModal').modal('close');
        $('.slide-on-mobile').slideDown();
        $('#articletopic').focus();
        $('.askvotebanner').css('display', 'none');
        setTimeout(function () {
            $('#articletopic').focus();
        }, 100);
    });

    $(document).on('click', '.noredeem', function (e) {
        $('#pointsModal').modal('close');
    });

    function showComments(id) {
        $('.replies' + id).slideToggle();
    }
</script>
<script>
    var currentarticleid = $(".determinate:first").parent().find('input').attr('data-articleid');
    var maxper = 0;
    $(".determinate").each(function () {
        var newper = $(this).attr('data-afterload');
        $(this).css('width', newper + '%');
        var articleid = $(this).parent().find('input').attr('data-articleid');
        if (parseInt(currentarticleid) == parseInt(articleid))
        {
            if (parseFloat(newper) > parseFloat(maxper)) {
                //$('.articleoption_'+articleid+' .determinate').parent().removeClass('maxper');
                //$(this).parent().addClass('maxper');
                maxper = newper;
            }
        } else {
            maxper = newper;
            //$(this).parent().addClass('maxper');
            currentarticleid = $(this).parent().find('input').attr('data-articleid');
        }
    });
    setTimeout(function () {
        $(".votedarticle input[type='radio']").attr('disabled', true);
    }, 100)

    function share(url, _this) {
        if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
        } else {
            if (navigator.share) {
                navigator.share({
                    url: url
                });
            }
        }
    }

    function showdescription(id, type, ele) {

        $(ele).toggleClass('active');
        $('#description_' + type + id).slideToggle('slow');
    }
</script>

<script>
    $(document).on('click', '.commentedit', function (e) {
        var cmtid = $(this).attr('data-cmtid');
        $(this).parent().addClass('active');
        $('#cmt_' + cmtid).removeAttr('readonly');
        $('#cmt_' + cmtid).focus();
    })
    $(document).on('blur', '.commentedit', function (e) {
        var cmtid = $(this).attr('data-cmtid');
        $('#cmt_' + cmtid).attr('readonly', true);
        //$(this).parent().removeClass('active');
    })
    $.each($('textarea[data-autoresize]'), function () {
        var offset = this.offsetHeight - this.clientHeight;
        var resizeTextarea = function (el) {
            var newvalue = el.scrollHeight + offset;
            $(el).css('height', 'auto').css('height', newvalue);
            $(el).next('span').css('height', 'auto').css('height', newvalue);
        };
        $(this).on('keyup input', function () {
            resizeTextarea(this);
        }).removeAttr('data-autoresize');
    });
    $(document).on('keypress', '.commentedit', function (e) {
        if (e.which == 13 && e.which == 13) {
            $(this).val($(this).val() + "\n");
        } else if (e.which == 13) {
            var article_comment = $(this).val();
            var article_id = $(this).attr('data-articleid');
            var article_cmt_id = $(this).attr('data-cmtid');
            $.ajax({
                url: '<?= base_url() ?>RatedArticle/add_comment',
                method: "POST",
                data: {article_comment: article_comment, article_id: article_id, article_cmt_id: article_cmt_id},
            }).done(function (result) {
<?php if (empty($this->session->userdata('data'))) { ?>
                    var redirecturl = $('#redirecturl').val();
                    redirecturl = redirecturl + "&t=2&pid=" + article_id;
                    window.location.assign(redirecturl);
<?php } ?>
                result = JSON.parse(result);
                if (result['status']) {
                    $('.cmteditbox').removeClass('active');
                }
            });
        }
    })

    $('html').click(function (e) {
        var classused = e.target.className;
        if (!classused.indexOf(" share") != -1) {
            $('.tooltip').removeClass('In');
            $('.tooltip').stop(true, true).fadeOut(500);
        }
        if (classused.indexOf("material-icons prefix sendarrow") != -1) {

        } else if (classused.indexOf("textareaicon1") != -1) {
//
        } else if (classused.indexOf("commentedit") != -1) {

        } else {
            $('.cmteditbox').removeClass('active');
            $(".commentedit").each(function (index) {
                var oldval = $(this).attr('data-value');
                $(this).val(oldval);
                $(this).css('height', '35px');
                $(this).next().css('height', '35px');
                $(this).closest('.cmteditbox').find('.whitespacepre').removeClass('hide');
                $(this).removeClass('active');
                $(this).parent().addClass('hide');
            });
        }
    });
    //.textareaicon1
    $(document).on('click', '.textareaicon1', function (e) {
        var cmt_id = $(this).attr('data-cmtid');
        var article_comment = $("#cmt_" + cmt_id).val();
        var original_cmt = $("#cmt_" + cmt_id).val();
        var article_id = $("#cmt_" + cmt_id).attr('data-articleid');
        var article_cmt_id = $("#cmt_" + cmt_id).attr('data-cmtid');
        if (article_comment == "") {
            Materialize.Toast.removeAll();
            Materialize.toast("Please enter your comment", 4000);
        }
        $.ajax({
            url: '<?= base_url() ?>RatedArticle/add_comment',
            method: "POST",
            data: {article_comment: article_comment, article_id: article_id, article_cmt_id: article_cmt_id},
        }).done(function (result) {
<?php if (empty($this->session->userdata('data'))) { ?>
                var redirecturl = $('#redirecturl').val();
                redirecturl = redirecturl + "&t=2&pid=" + article_id;
                window.location.assign(redirecturl);
<?php } ?>
            result = JSON.parse(result);
            if (result['status']) {
                $('#cmt_' + article_cmt_id).attr('data-value', article_comment);
                $('.cmteditbox').removeClass('active');
            }
        });
    });
    $(document).on('click', '.sendarrow', function (e) {
        var cmt_id = $(this).parent().attr('data-cmtid');
        var article_comment = $("#cmt_" + cmt_id).val();
        var original_cmt = $("#cmt_" + cmt_id).val();
        var article_id = $("#cmt_" + cmt_id).attr('data-articleid');
        var article_cmt_id = $("#cmt_" + cmt_id).attr('data-cmtid');
        if (article_comment == "") {
            Materialize.Toast.removeAll();
            Materialize.toast("Please enter your comment", 4000);
        }
        $.ajax({
            url: '<?= base_url() ?>RatedArticle/add_comment',
            method: "POST",
            data: {article_comment: article_comment, article_id: article_id, article_cmt_id: article_cmt_id},
        }).done(function (result) {
<?php
if (empty($this->session->userdata('data'))) {
    ?>
                var redirecturl = $('#redirecturl').val();
                redirecturl = redirecturl + "&t=2&pid=" + article_id;
                window.location.assign(redirecturl);
    <?php
}
?>
            result = JSON.parse(result);
            if (result['status']) {
                $('#cmt_' + article_cmt_id).attr('data-value', article_comment);
                var height = $('#cmt_' + cmt_id).closest('.cmteditbox').find('p').height();
                $('#cmt_' + cmt_id).closest('.cmteditbox').find('.whitespacepre').html(article_comment);
                $('#cmt_' + cmt_id).closest('.cmteditbox').find('.whitespacepre').toggleClass('hide');
                $('#cmt_' + cmt_id).css('height', height);
                $('#cmt_' + cmt_id).next().css('height', height);
                $('.cmteditbox').removeClass('active');
                $('#cmt_' + article_cmt_id).parent().toggleClass('hide');

            }
        });
    });
    function showcommentsec(id, type)
    {
        $('#togglecmtsec_' + type + '_' + id).slideToggle('slow');
    }
    $(document).on('click', '.showritecmt', function (e) {
        var article_id = $(this).attr('data-articleid');
        var type = $(this).attr('data-section');
        var id = $(this).attr('data-articleid');
        $('#togglecmtsec_' + type + '_' + id).slideToggle('slow');
    });</script>

<script>

    $(document).on('click', '.showreplies,.showreplies_icon', function (e) {
        var articleid = $(this).attr('data-articleid');
        var commentid = $(this).attr('data-cmtid');
<?php
if (empty($this->session->userdata('data'))) {
    ?>
            //window.location.assign("<?= base_url() ?>Login");
            var redirecturl = $('#redirecturl').val();
            redirecturl = redirecturl + "&t=2&pid=" + articleid + "&cmt=" + commentid;
            window.location.assign(redirecturl);
    <?php
} else {
    ?>

            var pagelimit = $(this).attr('data-replyset');
            var currentcontent = $('#replylist_' + commentid).text();
            var totalreply = $('.showreplies[data-cmtid="' + commentid + '"]').attr('data-totalreply');
            var totalshow = parseInt(pagelimit) + 1;
            totalshow = parseInt(totalshow) * 5;
            $.ajax({
                url: "<?= base_url(); ?>RatedArticle/get_comment_replies",
                method: "POST",
                data: {articleid: articleid, commentid: commentid, pagelimit: pagelimit},
            }).done(function (result) {
                result = JSON.parse(result);
                var html = "";
                if (result.status) {
                    var groupLength = result['data'].length;
                    for (var i in result['data']) {

                        var replyby = result['data'][i]['user_id'] ==<?= $user_info['uid']; ?> ? "You" : result['data'][i]['byuser'];
                        var formattedDate = getDateString(new Date(result['data'][i]['created_date'].replace(' ', 'T')), "d M y");
                        var cmtedit = "";
                        var iscmtedit = result['data'][i]['user_id'] ==<?= $user_info['uid']; ?> ? "commentedit" : "";
                        html += '<div class="row mb0">\
                                                        <div class="col m11 s11">\
                                                            <h6 class="forumsubhead fs12px tastart mt5 lightgray fw500"><span class="flaticon-social-2 ml10 mr0"></span><i>By ' + replyby + ', ' + formattedDate + '</i></h6>\
                                                        </div>\
                                                        <div class="col m1 s1">\
                                                        ' + cmtedit + '</div>\
                                                    </div>\n\
                                                    <div class="ml45">\
                                                        <div class="mr35 whitespacepre">' + result['data'][i]['reply'] + '</div>\
                                                        <div class="cmteditbox hide posrela">\
                                                            <input type="text" id="cmt_' + commentid + '" data-value="' + result['data'][i]['reply'] + '" data-articleid="' + articleid + '" data-cmtid="' + commentid + '" readonly="readonly" class="' + cmtedit + ' mb0" value="' + result['data'][i]['reply'] + '">\
                                                            <span data-cmtid="' + commentid + '" class="material-icons prefix textareaicon1">send</span>\
                                                        </div>\
                                                    </div>';
                        html += '<hr class="commentseprator">';
                    }
                    if (totalreply > totalshow) {
                        html += '<a class="morereplies fs12px fw500 lightgray" data-replyset="' + (parseInt(pagelimit) + 1) + '" data-articleid="' + articleid + '" data-cmtid="' + commentid + '">view more replies</a>';
                    }

                    $('#replylist_' + commentid).html(html);
                }

                $('.replies' + commentid).slideToggle();
            });
    <?php
}
?>
    });
    $(document).on('click', '.morereplies', function (e) {
        var articleid = $(this).attr('data-articleid');
        var commentid = $(this).attr('data-cmtid');
        var pagelimit = $(this).attr('data-replyset');
        $('.replies' + commentid + ' .morereplies').remove();
        var totalreply = $('.showreplies[data-cmtid="' + commentid + '"]').attr('data-totalreply');
        var totalshow = parseInt(pagelimit) + 1;
        totalshow = parseInt(totalshow) * 5;
        $.ajax({
            url: "<?php
echo base_url();
?>RatedArticle/get_comment_replies",
            method: "POST",
            data: {articleid: articleid, commentid: commentid, pagelimit: pagelimit},
        }).done(function (result) {
            result = JSON.parse(result);
            var html = "";
            if (result.status) {
                var groupLength = result['data'].length;
                for (var i in result['data']) {

                    var replyby = result['data'][i]['user_id'] ==<?= $user_info['uid']; ?> ? "By" : result['data'][i]['byuser'];
                    var formattedDate = getDateString(new Date(result['data'][i]['created_date'].replace(' ', 'T')), "d M y");
                    var iscmtedit = result['data'][i]['user_id'] ==<?= $user_info['uid']; ?> ? "commentedit" : "";
                    var cmtedit = "";
                    html += '<div class="row mb0">\
                                    <div class="col m11 s11">\
                                        <h6 class="forumsubhead fs12px tastart mt5 lightgray fw500"><span class="flaticon-social-2 ml10 mr0"></span><i>' + replyby + ', ' + formattedDate + '</i></h6>\
                                    </div>\
                                    <div class="col m1 s1">\
                                    ' + cmtedit + '</div>\
                                </div>\n\
                                <div class="ml45">\
                                    <div class="mr35 whitespacepre">' + result['data'][i]['reply'] + '</div>\
                                    <div class="cmteditbox hide posrela">\
                                        <input type="text" data-value="' + result['data'][i]['reply'] + '" id="cmt_' + commentid + '" data-articleid="' + articleid + '" data-cmtid="' + commentid + '" readonly="readonly" class="' + cmtedit + ' mb0" value="' + result['data'][i]['reply'] + '">\
                                        <span data-cmtid="' + commentid + '" class="material-icons prefix textareaicon1">send</span>\
                                    </div>\n\
                                </div>';
                    html += '<hr class="commentseprator">';
                }

                if (totalreply > totalshow) {
                    html += '<a class="morereplies fs12px fw500 lightgray" data-replyset="' + (parseInt(pagelimit) + 1) + '" data-articleid="' + articleid + '" data-cmtid="' + commentid + '">view more replies</a>';
                }

                $('#replylist_' + commentid).append(html);
            }

        });
    });</script>

<script>
    $(document).on('click', '.loadmore', function (e) {

        var loadlimit = $(this).attr('data-pageid');
        var article_id = $(this).attr('data-articleid');
        var type = $(this).attr('data-sectype');
        var total_comments = $(this).attr('data-totalcomments');
        //var endDate = new Date(Date.parse($(this).attr('data-enddate')));
<?php
if (empty($this->session->userdata('data'))) {
    ?>
            var redirecturl = $('#redirecturl').val();
            redirecturl = redirecturl + "&t=2&pid=" + article_id
            window.location.assign(redirecturl);
    <?php
} else {
    ?>
            $.ajax({
                url: "<?php
    echo base_url();
    ?>RatedArticle/load_more_comments",
                method: "POST",
                data: {articleid: article_id, pagelimit: loadlimit},
            }).done(function (result) {
                result = JSON.parse(result);
                var html = "";
                if (result.status) {

                    for (var i in result['data']) {
                        var replyby = result['data'][i]['user_id'] ==<?= $user_info['uid']; ?> ? "You" : result['data'][i]['byuser'];
                        var cmtedit = "";
                        var TodayDate = new Date();
                        var editcmts = true;
                        var postreply = "";
                        var iscmtedit = "";
                        if (result['data'][i]['user_id'] ==<?= $user_info['uid']; ?> && editcmts) {
                            var iscmtedit = result['data'][i]['user_id'] ==<?= $user_info['uid']; ?> ? "commentedit" : "";
                            cmtedit = '<a materialize="dropdown" class="dropdown-button articleubhead right" data-activates="myarticlecmt' + result['data'][i]['id'] + '">\
                                                        <i class="flaticon-three-1 lightgray is20px"></i>\
                                                    </a>\
                                                    <ul id="myarticlecmt' + result['data'][i]['id'] + '" class="dropdown-content mpcmt">\
                                                        <li>\
                                                            <a class="fs16px editcmt" data-cmtid="' + result['data'][i]['id'] + '" data-cmttxt="' + result['data'][i]['comment'] + '" >Edit</a>\
                                                        </li>\
                                                        <li>\
                                                            <a class="fs16px deletecmt" data-cmtid="' + result['data'][i]['id'] + '">Delete</a>\
                                                        </li>\
                                                    </ul>';
                        }
                        if (editcmts) {
                            postreply = '<form id="postarticlecommentrply" method="POST">\
                                                        <div class="col m12 s12">\
                                                            <div style="position:relative">\
                                                                <textarea type="text" id="textarea1" class="writereply textarea-scrollbar" data-autoresize name="article_comment_reply" placeholder="Write a reply"></textarea>\
                                                                <span onclick="$(this).submit()" class="textareaicon"><span class="material-icons prefix sendarrowreply">send</span></span>\
                                                                <input type="hidden" name="article_id" value="' + result['data'][i]['article_id'] + '"/>\
                                                                <input type="hidden" name="comment_id" value="' + result['data'][i]['id'] + '"/>\
                                                            </div>\
                                                        </div>\
                                                    </form>';
                        }

                        var isuserlike = result['data'][i]['userlike'] == 0 ? "like.png" : "like1.png";
                        var formattedDate = getDateString(new Date(result['data'][i]['created_date'].replace(' ', 'T')), "d M y")
                        var replyword = parseInt(result['data'][i]['total_replies']) > 1 ? " Replies" : " Reply";
                        html += '<div class="col s12">\
                                                <div class="commentsection" id="cm_' + result['data'][i]['id'] + '">\
                                                    <div class="articlecardlist p-0">\
                                                            <div class="row mb0">\
                                                                <div class="col m11 s11">\
                                                                    <h6 class="forumsubhead fs12px tastart mt5 lightgray fw500"><span class="flaticon-social-2 ml10 mr0"></span><i>By ' + replyby + ', ' + formattedDate + ' </i></h6>\
                                                                </div>\
                                                                <div class="col m1 s1">\
                                                                ' + cmtedit + '\
                                                                </div>\
                                                            </div>\
                                                        <div class="ml45">\
                                                            <div class="cmteditbox positir">\
                                                                <div class="mr35 whitespacepre">' + result['data'][i]['comment'] + '</div>\
                                                                <div class="hide posrela">\
                                                                    <textarea type="text" data-autoresize rows="1" id="cmt_' + result['data'][i]['id'] + '" data-value="' + result['data'][i]['comment'] + '" data-articleid="' + article_id + '" data-cmtid="' + result['data'][i]['id'] + '" readonly class="' + iscmtedit + ' mb0 textarea-scrollbar">' + result['data'][i]['comment'] + '</textarea>\
                                                                    <span data-cmtid="' + result['data'][i]['id'] + '" class="textareaicon1"><span class="material-icons prefix sendarrow">send</span></span>\
                                                                </div>\
                                                            </div>\
                                                            <div class="row txtbluegray cmtop mb0">\
                                                                <div class="col m7 s7"><h6 class="fs12px linkpointer showreplies_icon fs12px fw500 lightgray" data-cmtid="' + result['data'][i]['id'] + '" data-articleid="' + result['data'][i]['article_id'] + '" data-replyset="0"><i class="flaticon-arrow-1 lightgray"></i>Reply</h6></div>\
                                                                <div class="col m5 s5 right right-align">\
                                                                    <span class="mr10 lightgray fs12px fw500 linkpointer showreplies" data-cmtid="' + result['data'][i]['id'] + '" data-articleid="' + result['data'][i]['article_id'] + '" data-replyset="0" data-totalreply="' + result['data'][i]['total_replies'] + '">' + result['data'][i]['total_replies'] + ' ' + replyword + '</span>\
                                                                </div>\
                                                            </div>\
                                                            <div class="replies' + result['data'][i]['id'] + '" style="display:none;">\
                                                                <div class="row m10">\
                                                                ' + postreply + '</div>\
                                                                <div id="replylist_' + result['data'][i]['id'] + '">\
                                                                </div>\
                                                            </div>\
                                                            </div>\
                                                    </div>\
                                                    <hr class="commentseprator">\
                                                </div>\
                                            </div>';
                    }
                    $('#togglecmtsec_' + type + '_' + article_id + ' .commentbox').append(html);
                    var newtotalcmts = $('#togglecmtsec_' + type + '_' + article_id + ' .commentbox .commentsection').length;
                    if ((parseInt(newtotalcmts) + 1) <= total_comments) {
                        $('#togglecmtsec_' + type + '_' + article_id + ' .loadmore').attr('data-pageid', parseInt(loadlimit) + 1);
                    } else {
                        $('#togglecmtsec_' + type + '_' + article_id + ' .loadmore').css('display', 'none');
                    }
                    setTimeout(function () {
                        $('.dropdown-button').dropdown({
                            inDuration: 300,
                            outDuration: 225,
                            constrain_width: false, // Does not change width of dropdown to that of the activator
                            hover: false, // Activate on hover
                            gutter: 0, // Spacing from edge
                            belowOrigin: false, // Displays dropdown below the button
                            alignment: 'left' // Displays dropdown with edge aligned to the left of button
                        }
                        )
                    }, 100)

                    flag = 0;
                } else {
                    flag = 1;
                }
            });

    <?php
}
?>
    });
    $(document).on('submit', 'form[name="postarticlecmt"]', function (e) {
        e.preventDefault();
        e.stopPropagation();
        //$('.loadersmall').css('display', 'block');
        var article_id = $('#postarticlecomment input[name="article_id"]').val();
        var redirecturl = $('#redirecturl').val();
        redirecturl = redirecturl + "&t=2&pid=" + article_id;
<?php if (empty($this->session->userdata('data'))) { ?>
            window.location.assign(redirecturl);
<?php } else { ?>
    <?php if (empty($user_info['alise'])) { ?>
                Materialize.Toast.removeAll();
                Materialize.toast('Please enter your alias first.', 2000);
                setTimeout(function () {
                    var redirect_url = $("#redirecturl").val();
                    var redirect_sess = redirect_url.split("?");
                    window.location.href = '<?= base_url() ?>Profile?' + redirect_sess[1];
                }, 2000)
    <?php } else { ?>
                $.ajax({
                    url: $(this).attr('action'),
                    method: "POST",
                    data: $(this).serialize(),
                }).done(function (result) {

                    result = JSON.parse(result);
                    if (result['status']) {

                        var html = "";
                        var isuserlike = result['data']['userlike'] == 0 ? "like.png" : "like1.png";
                        var formattedDate = getDateString(new Date(result['data']['created_date'].replace(' ', 'T')), "d M y")
                        var replyby = result['data']['user_id'] ==<?= $user_info['uid']; ?> ? "You" : result['data']['byuser'];
                        var iscmtedit = result['data']['user_id'] ==<?= $user_info['uid']; ?> ? "commentedit" : "";
                        var cmtedit = "";
                        if (result['data']['user_id'] ==<?= $user_info['uid']; ?>) {
                            cmtedit = '<a materialize="dropdown" class="dropdown-button1 articleubhead right" id="cmtdrop_' + result['data']['id'] + '" data-activates="myarticlecmt' + result['data']['id'] + '">\
                                                    <i class="flaticon-three-1 lightgray is20px"></i>\
                                                </a>\
                                                <ul id="myarticlecmt' + result['data']['id'] + '" class="dropdown-content mpcmt">\
                                                    <li>\
                                                        <a class="fs16px editcmt" data-cmtid="' + result['data']['id'] + '" data-cmttxt="' + result['data']['comment'] + '" >Edit</a>\
                                                    </li>\
                                                    <li>\
                                                        <a class="fs16px deletecmt" data-cmtid="' + result['data']['id'] + '">Delete</a>\
                                                    </li>\
                                                </ul>';
                        }
                        var replyword = parseInt(result['data']['total_replies']) > 1 ? " Replies" : " Reply";
                        html = '<div class="col s12">\
                                            <div class="commentsection" id="cm_' + result['data']['id'] + '">\
                                                <div class="articlecardlist p-0">\
                                                        <div class="row mb0">\
                                                            <div class="col m11 s11">\
                                                                <h6 class="forumsubhead fs12px tastart mt5 lightgray fw500"><span class="flaticon-social-2 ml10 mr0"></span><i>By ' + replyby + ', ' + formattedDate + ' </i></h6>\
                                                            </div>\
                                                            <div class="col m1 s1">\
                                                            ' + cmtedit + '</div>\
                                                        </div>\
                                                    <div class="ml45">\
                                                         <div class="cmteditbox positir">\
                                                            <div class="mr35 whitespacepre">' + result['data']['comment'] + '</div>\
                                                            <div class="hide posrela">\
                                                                <textarea type="text" data-autoresize rows="1" id="cmt_' + result['data']['id'] + '" data-value="' + result['data']['comment'] + '" data-articleid="' + article_id + '" data-cmtid="' + result['data']['id'] + '" readonly class="' + iscmtedit + ' mb0 textarea-scrollbar">' + result['data']['comment'] + '</textarea>\
                                                                <span data-cmtid="' + result['data']['id'] + '" class="textareaicon1"><span class="material-icons prefix sendarrow">send</span></span>\
                                                            </div>\
                                                        </div>\
                                                        <div class="row txtbluegray cmtop mb0">\
                                                            <div class="col m7 s7"><h6 class="fs12px linkpointer showreplies_icon fs12px fw500 lightgray" data-cmtid="' + result['data']['id'] + '" data-articleid="' + result['data']['article_id'] + '" data-replyset="0"><i class="flaticon-arrow-1 lightgray"></i>Reply</h6></div>\
                                                            <div class="col m5 s5 right right-align">\
                                                                <span class="mr10 lightgray fs12px fw500 linkpointer showreplies" data-cmtid="' + result['data']['id'] + '" data-articleid="' + result['data']['article_id'] + '" data-replyset="0" data-totalreply="' + result['data']['total_replies'] + '">' + result['data']['total_replies'] + ' ' + replyword + '</span>\
                                                            </div>\
                                                        </div>\
                                                        <div class="replies' + result['data']['id'] + '" style="display:none;">\
                                                            <div class="row m10">\
                                                                <form id="postarticlecommentrply" method="POST">\
                                                                <div class="col m12 s12">\
                                                                    <div style="position:relative">\
                                                                        <textarea type="text" id="textarea1" class="writereply textarea-scrollbar" data-autoresize name="article_comment_reply" placeholder="Write a reply"></textarea>\
                                                                        <span onclick="$(this).submit()" class="textareaicon"><span class="material-icons prefix sendarrowreply">send</span></span>\
                                                                        <input type="hidden" name="article_id" value="' + result['data']['article_id'] + '"/>\
                                                                        <input type="hidden" name="comment_id" value="' + result['data']['id'] + '"/>\
                                                                    </div>\
                                                                </div>\
                                                            </form>\
                                                            </div>\
                                                            <div id="replylist_' + result['data']['id'] + '">\
                                                            </div>\
                                                        </div>\
                                                        </div>\
                                                </div>\
                                                <hr class="commentseprator">\
                                            </div>\
                                    </div>';
                        $('[id^="togglecmtsec_"][id$="_' + result['data']['article_id'] + '"] .commentbox').prepend(html);
                        $('textarea[name="article_comment"]').val("");
                        $('textarea[name="article_comment"]').css('height', '35px');
                        $('textarea[name="article_comment"]').next().css('height', '35px');
                        var comments = $('.showcmtcount[data-articleid=' + result['data']['article_id'] + ']').attr('data-totalcomments');
                        if (parseInt(comments) == 0) {
                            $('[id^="togglecmtsec_"][id$="_' + result['data']['article_id'] + '"] .nocmtdata').css('display', 'none');
                        }
                        var newcommentscount = parseInt(comments) + 1;
                        $('.showcmtcount[data-articleid=' + result['data']['article_id'] + ']').attr('data-totalcomments', newcommentscount);
                        var commentword = newcommentscount > 1 ? "Comments" : "Comment"
                        $('.showcmtcount[data-articleid=' + result['data']['article_id'] + ']').html(newcommentscount + " " + commentword); //cmtbadge
                        //$('.showcmtcount[data-articleid=' + result['data']['article_id'] + ']').html(newcommentscount + " Comments");//cmtbadge
                        $('.show-on-small .showritecmt[data-articleid=' + result['data']['article_id'] + ']').html(commentword + "<span class='cmtbadge'>" + newcommentscount + "</span>");
                        setTimeout(function () {
                            $('#cmtdrop_' + result['data']['id'] + '').dropdown({
                                inDuration: 300,
                                outDuration: 225,
                                constrain_width: true, // Does not change width of dropdown to that of the activator
                                hover: false, // Activate on hover
                                gutter: 0, // Spacing from edge
                                belowOrigin: false, // Displays dropdown below the button
                                alignment: 'left' // Displays dropdown with edge aligned to the left of button
                            }
                            )
                        }, 100);
                        $.each($('textarea[data-autoresize]'), function () {
                            var offset = this.offsetHeight - this.clientHeight;
                            var resizeTextarea = function (el) {
                                var newvalue = el.scrollHeight + offset;
                                $(el).css('height', 'auto').css('height', newvalue);
                                $(el).next('span').css('height', 'auto').css('height', newvalue);
                            };
                            $(this).on('keyup input', function () {
                                resizeTextarea(this);
                            }).removeAttr('data-autoresize');
                        });
                        //                $('.myarticlecmt' + result['data']['id'] + '').dropdown({
                        //                    inDuration: 300,
                        //                    outDuration: 225,
                        //                    constrain_width: false, // Does not change width of dropdown to that of the activator
                        //                    hover: false, // Activate on hover
                        //                    gutter: 0, // Spacing from edge
                        //                    belowOrigin: false, // Displays dropdown below the button
                        //                    alignment: 'left' // Displays dropdown with edge aligned to the left of button
                        //                });
                    } else {
                        Materialize.Toast.removeAll();
                        Materialize.toast(result['message'], 4000);
                    }
                });
    <?php } ?>
<?php } ?>
    });
    $(document).on('submit', '#postarticlecommentrply', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var _this = $(this);
        var article_id = $('#postarticlecommentrply input[name="article_id"]').val();
        var redirecturl = $('#redirecturl').val();
        redirecturl = redirecturl + "&t=2&pid=" + article_id;
<?php if (empty($this->session->userdata('data'))) { ?>
            window.location.assign(redirecturl);
<?php } else { ?>
    <?php if (empty($user_info['alise'])) { ?>
                Materialize.Toast.removeAll();
                Materialize.toast('Please enter your alias first.', 2000);
                setTimeout(function () {
                    var redirect_url = $("#redirecturl").val();
                    var redirect_sess = redirect_url.split("?");
                    window.location.href = '<?= base_url() ?>Profile?' + redirect_sess[1];
                }, 2000)
    <?php } else { ?>
                $.ajax({
                    url: '<?= base_url(); ?>RatedArticle/add_comment_reply',
                    method: "POST",
                    data: $(this).serialize(),
                }).done(function (result) {

                    result = JSON.parse(result);
                    if (result['status']) {
                        var html = "";
                        var formattedDate = getDateString(new Date(result['data']['created_date'].replace(' ', 'T')), "d M y");
                        var cmtedit = "";
                        html = '<div class="row mb0">\
                                                    <div class="col m11 s11">\
                                                        <h6 class="forumsubhead fs12px tastart mt5 lightgray fw500"><span class="flaticon-social-2 ml10 mr0"></span><i>By You, ' + formattedDate + '</i></h6>\
                                                    </div>\
                                                    <div class="col m1 s1">\
                                                    ' + cmtedit + '</div>\
                                                </div>\
                                                <div class="ml45">\
                                                    <div class="mr35 whitespacepre">' + result['data']['reply'] + '</div>\
                                                    <div class="cmteditbox hide posrela">\
                                                        <input type="text" id="cmt_16" data-articleid="5" data-cmtid="' + result['data']['comment_id'] + '" readonly="readonly" class="mb0" value="' + result['data']['reply'] + '">\
                                                        <span data-cmtid="16" class="material-icons prefix textareaicon1">send</span>\
                                                    </div>\
                                                </div><hr class="commentseprator">';

                        $('#replylist_' + result['data']['comment_id']).prepend(html);
                        //$('#postarticlecommentrply')[0].reset();
                        $('Form#postarticlecommentrply').trigger("reset");
                        var currentreplies = $('.showreplies[data-cmtid=' + result['data']['comment_id'] + ']').html();
                        $('.writereply').css('height', '35px');
                        $('.writereply').next().css('height', '35px');
                        totalreply = parseInt(currentreplies) + 1;
                        var replyword = totalreply > 1 ? "Replies" : "Reply";
                        $('.showreplies[data-cmtid=' + result['data']['comment_id'] + ']').html(totalreply + " " + replyword);
                    } else {
                        Materialize.Toast.removeAll();
                        Materialize.toast(result['message'], 4000);
                    }
                    var cmt_id = result['data']['comment_id'];
                    adv = Math.round($('#articlereact .commentbox').scrollTop() + $("#replylist_" + cmt_id + " > div:last").position().top) - 70;
                    $('.commentbox').animate({
                        scrollTop: adv
                    }, 2000);
                });
    <?php } ?>
<?php } ?>
    });
    $(document).on('click', '.editcmt', function (e) {
        var cmt_id = $(this).attr('data-cmtid');
        $('#cmt_' + cmt_id).removeAttr('readonly');
        $('#cmt_' + cmt_id).parent().addClass('active');
        $('#cmt_' + cmt_id).parent().toggleClass('hide');
        var height = $('#cmt_' + cmt_id).closest('.cmteditbox').find('p').height();
        $('#cmt_' + cmt_id).closest('.cmteditbox').find('.whitespacepre').toggleClass('hide');
        $('#cmt_' + cmt_id).css('height', height);
        $('#cmt_' + cmt_id).next().css('height', height);
        //$('#cmt_' + cmt_id).parent().addClass('active');
        $('#cmt_' + cmt_id).focus();
    });
    $(document).on('click', '.deletecmt', function (e) {
        var cmt_id = $(this).attr('data-cmtid');
        $.ajax({
            url: '<?= base_url() ?>RatedArticle/deactivecmt',
            method: "POST",
            data: {comment: cmt_id},
        }).done(function (result) {

            result = JSON.parse(result);
            $('#articlereact .commentbox #cm_' + cmt_id).slideUp('slow');
            var commentsword = result['total'] > 1 ? "Comments" : "Comment";
            $('.showcmtcount[data-articleid=' + result['ques_no'] + ']').html(result['total'] + ' ' + commentsword);
            $('.show-on-small .showritecmt[data-articleid="' + result['ques_no'] + '"]').html(commentsword + "<span class='cmtbadge'>" + result['total'] + "</span>");
            $('.showcmtcount[data-articleid=' + result['ques_no'] + ']').attr('data-totalcomments', result['total']);
            var comments = $('.showcmtcount[data-articleid=' + result['ques_no'] + ']').attr('data-totalcomments');
            if (parseInt(comments) == 0) {
                $('[id^="togglecmtsec_"][id$="_' + result['data']['article_id'] + '"] .nocmtdata').css('display', 'none');
            }
            var pageno = $('.loadmore[data-articleid=' + result['ques_no'] + ']').attr('data-pageid');
            if (parseInt(pageno) > 0) {
                console.log(result['total']);
                console.log(parseInt(pageno) * 10);
                if (result['total'] >= parseInt(pageno) * 10) {
                    $('.loadmore[data-articleid=' + result['ques_no'] + ']').css('display', 'block');
                } else {
                    $('.loadmore[data-articleid=' + result['ques_no'] + ']').css('display', 'none');
                }
            } else {
                if (result['total'] < 2) {
                    $('.loadmore[data-articleid=' + result['ques_no'] + ']').css('display', 'none');
                }
                setTimeout(function () {
                    var html = "";
                    for (var i in result['data']) {
                        var replyby = result['data'][i]['user_id'] ==<?= $user_info['uid']; ?> ? "You" : result['data'][i]['byuser'];
                        var iscmtedit = result['data'][i]['user_id'] ==<?= $user_info['uid']; ?> ? "commentedit" : "";
                        var cmtedit = "";
                        if (result['data'][i]['user_id'] ==<?= $user_info['uid']; ?>) {
                            cmtedit = '<a materialize="dropdown" class="dropdown-button articleubhead right" data-activates="myarticlecmt' + result['data'][i]['id'] + '">\
                                            <i class="flaticon-three-1 lightgray is20px"></i>\
                                        </a>\
                                        <ul id="myarticlecmt' + result['data'][i]['id'] + '" class="dropdown-content mpcmt">\
                                            <li>\
                                                <a class="fs16px editcmt" data-cmtid="' + result['data'][i]['id'] + '" data-cmttxt="' + result['data'][i]['comment'] + '" >Edit</a>\
                                            </li>\
                                            <li>\
                                                <a class="fs16px deletecmt" data-cmtid="' + result['data'][i]['id'] + '">Delete</a>\
                                            </li>\
                                        </ul>';
                        }
                        var isuserlike = result['data'][i]['userlike'] == 0 ? "like.png" : "like1.png";
                        var formattedDate = getDateString(new Date(result['data'][i]['created_date'].replace(' ', 'T')), "d M y")
                        var replyword = parseInt(result['data'][i]['total_replies']) > 1 ? " Replies" : " Reply";
                        html += '<div class="col s12">\
                                            <div class="commentsection" id="cm_' + result['data'][i]['id'] + '">\
                                                <div class="articlecardlist p-0">\
                                                        <div class="row mb0">\
                                                            <div class="col m11 s11">\
                                                                <h6 class="forumsubhead fs12px tastart mt5 lightgray fw500"><span class="flaticon-social-2 ml10 mr0"></span><i>By ' + replyby + ', ' + formattedDate + ' </i></h6>\
                                                            </div>\
                                                            <div class="col m1 s1">\
                                                            ' + cmtedit + '\
                                                            </div>\
                                                        </div>\
                                                    <div class="ml45">\
                                                        <div class="cmteditbox positir">\
                                                            <div class="mr35 whitespacepre">' + result['data'][i]['comment'] + '</div>\
                                                            <div class="hide posrela">\
                                                                <textarea type="text" data-autoresize rows="1" id="cmt_' + result['data'][i]['id'] + '" data-value="' + result['data'][i]['comment'] + '" data-articleid="' + result['ques_no'] + '" data-cmtid="' + result['data'][i]['id'] + '" readonly class="' + iscmtedit + ' mb0 textarea-scrollbar">' + result['data'][i]['comment'] + '</textarea>\
                                                                <span data-cmtid="' + result['data'][i]['id'] + '" class="textareaicon1"><span class="material-icons prefix sendarrow">send</span></span>\
                                                            </div>\
                                                        </div>\
                                                        <div class="row txtbluegray cmtop mb0">\
                                                            <div class="col m7 s7"><h6 class="fs12px linkpointer showreplies_icon fs12px fw500 lightgray" data-cmtid="' + result['data'][i]['id'] + '" data-articleid="' + result['data'][i]['article_id'] + '"><i class="flaticon-arrow-1 lightgray"></i>Reply</h6></div>\
                                                            <div class="col m5 s5 right right-align">\
                                                                <span class="mr10 lightgray fs12px fw500 linkpointer showreplies" data-cmtid="' + result['data'][i]['id'] + '" data-articleid="' + result['data'][i]['article_id'] + '" data-replyset="0" data-totalreply="' + result['data'][i]['total_replies'] + '">' + result['data'][i]['total_replies'] + ' ' + replyword + '</span>\
                                                            </div>\
                                                        </div>\
                                                        <div class="replies' + result['data'][i]['id'] + '" style="display:none;">\
                                                            <div class="row m10">\
                                                            <form id="postarticlecommentrply" method="POST">\
                                                                <div class="col m12 s12">\
                                                                    <div style="position:relative">\
                                                                        <textarea type="text" id="textarea1" class="writereply textarea-scrollbar" data-autoresize name="article_comment_reply" placeholder="Write a reply"></textarea>\
                                                                        <span onclick="$(this).submit()" class="textareaicon"><span class="material-icons prefix sendarrowreply">send</span></span>\
                                                                        <input type="hidden" name="article_id" value="' + result['data'][i]['article_id'] + '"/>\
                                                                        <input type="hidden" name="comment_id" value="' + result['data'][i]['id'] + '"/>\
                                                                    </div>\
                                                                </div>\
                                                            </form>\
                                                            </div>\
                                                            <div id="replylist_' + result['data'][i]['id'] + '">\
                                                            </div>\
                                                        </div>\
                                                        </div>\
                                                </div>\
                                                <hr class="commentseprator">\
                                            </div>\
                                        </div>';
                    }
                    $('[id^="togglecmtsec_"][id$="_' + result['ques_no'] + '"] .commentbox').html(html);
                    setTimeout(function () {
                        $('.dropdown-button').dropdown({
                            inDuration: 300,
                            outDuration: 225,
                            constrain_width: false, // Does not change width of dropdown to that of the activator
                            hover: false, // Activate on hover
                            gutter: 0, // Spacing from edge
                            belowOrigin: false, // Displays dropdown below the button
                            alignment: 'left' // Displays dropdown with edge aligned to the left of button
                        }
                        )
                    }, 100);
                }, 1000);
            }
        });
    });</script>
<script>

    $(document).on('click', '#editarticle', function (e) {
        $('.slide-on-mobile').slideDown('slow');
        var articleid = $(this).attr('data-articleid');
        var data = $(this).attr('data-rowjson');
        data = JSON.parse(data);
        $("#articlecatergory input[value=" + data['category_id'] + "]").attr('checked', true);
        $('#articledescription').val(data['description']);
        $('#articledescription').css('height', 'auto');
        $('#article_id').val(articleid);
        $('#articletopic').val(data['question']);
        $('#detailurl').val(data['url']);
        var choiceid = data['choice_id'];
        var choice = data['choice'];
        var html = "";
        var choiceidarr = choiceid.split('|');
        var choicearr = choice.split('|');
        var add_more_icon = '';
        for (var i = 0; i < choiceidarr.length - 2; i++)
        {
            var ishown = i == choiceidarr.length - 1 ? "" : "shown";
            if (i > 9) {
                break;
            }
            add_more_icon = (i == 9) ? '<i class="flaticon-plus addmorechoice hide"></i>' : '<i class="flaticon-plus addmorechoice"></i>';
            html += '<div class="row choice mb10">\
                            <div class="col s11">\
                                <input type="text" name="choice[]" maxlength="35" placeholder="Enter your choice here" value="' + custom_stringify(choicearr[i]) + '" class="' + ishown + '"/>\
                            </div>\
                            <div class="col s1 no-padding">\
                                ' + add_more_icon + '\
                                <i class="flaticon-delete removechoice"></i>\
                            </div>\
                        </div>';
        }
        //console.log(html);
        $('#choiceslist').html(html);
        $('#staticoption').css('display', 'block');
        if (choiceidarr.length > 2) {
            $('.choice:first-child .removechoice').css('display', 'block');
        } else {
            $('.choice:first-child .removechoice').css('display', 'none');
        }

        $('html, body').animate({scrollTop: $('.slide-on-mobile').offset().top - 100}, 1000);
    });
    $(document).on('click', '.confdelete', function (e) {
        var articleid = $(this).attr('data-articleid');
        $('#confirmdelete .yes').attr('data-articleid', articleid);
        //alert("hello");
    });
    $(document).on('click', '.yes', function (e) {
        var articleid = $(this).attr('data-articleid');
        $.ajax({
            url: '<?php echo base_url(); ?>RatedArticle/deactive_article',
            method: "POST",
            data: {articleid: articleid},
        }).done(function (result) {

            result = JSON.parse(result);
            if (result['status']) {
                Materialize.Toast.removeAll();
                Materialize.toast(result['message'], 4000);
                $('#card_' + articleid).slideUp('slow');
                $('#confirmdelete').modal('close');
                var categoryid = $('#tabs-swipe-demo>li>a.active').attr('data-catid');
                loaddatafortrending(0, 0);
                loaddataformyraised(0, 0);
            }
        });
    });</script>

<script>
    /* START Custome stringify string */
    function custom_stringify(string) {
        return string;
    }
    /* END Custome stringify string */
    function GetURLParameter(sParam)
    {
        var sPageURL = window.location.href;
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++)
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam)
            {
                return sParameterName[1];
            }
        }
    }
    ;
    $(document).on('keypress', '#articletopic,.choice input', function (e) {
        if (e.which == 13) {
            e.preventDefault();
        }
    });
    jQuery.fn.putCursorAtEnd = function () {
        return this.each(function () {
            // Cache references
            var $el = $(this),
                    el = this;
            // Only focus if input isn't already
            if (!$el.is(":focus")) {
                $el.focus();
            }
            // If this function exists... (IE 9+)
            if (el.setSelectionRange) {
                // Double the length because Opera is inconsistent about whether a carriage return is one character or two.
                var len = $el.val().length * 2;
                // Timeout seems to be required for Blink
                setTimeout(function () {
                    el.setSelectionRange(len, len);
                }, 1);
            } else {
                // As a fallback, replace the contents with itself
                // Doesn't work in Chrome, but Chrome supports setSelectionRange
                $el.val($el.val());
            }
            // Scroll to the bottom, in case we're in a tall textarea
            // (Necessary for Firefox and Chrome)
            this.scrollTop = 999999;
        });
    };
    var searchInput = $(".commentedit");
    searchInput
            .putCursorAtEnd() // should be chainable
            .on("focus", function () { // could be on any event
                searchInput.putCursorAtEnd()
            });
</script>
<script>
    function loaddatafortrending(categoryid, pageno)
    {
        $.ajax({
            url: '<?php echo base_url(); ?>RatedArticle/loadmoretrending',
            method: "POST",
            data: {categoryid: categoryid, pageno: pageno},
        }).done(function (result) {

            result = JSON.parse(result);
            var html = "";
            if (result['status']) {
                $('.loadmoretrending').remove();
                var catname = "";
                if (categoryid == "1") {
                    catname = "Governance";
                } else if (categoryid == "2") {
                    catname = "Money";
                } else if (categoryid == "3") {
                    catname = "Sports";
                } else if (categoryid == "4") {
                    catname = "Entertainment";
                } else {
                    catname = "Governance";
                }
                for (var i in result['data']) {
                    html += '<div class="blogs p15_20">\
                                <div class="row">\
                                    <a href="<?= base_url() ?>RatedArticle?pid=' + result['data'][i]['id'] + '">\
                                        <div class="col s12">\
                                            <div class="blog-title truncate">' + result['data'][i]['question'] + '</div>\
                                            <div class="right blog-details lightgray">\
                                                <i class="lightgray flaticon-click ml0"></i>\
                                                <span class="lightgray fs12px">' + result['data'][i]['total_votes'] + ' Votes</span></div>\
                                        </div>\
                                    </a>\
                                </div>\
                            </div>';
                }
                html += '<div class="loadmoretrending" data-page="' + (parseInt(pageno) + 1) + '" data-catid="' + categoryid + '"></div>';
                if (parseInt(pageno) < 1) {
                    $('.trend .bindtrend').html(html);
                } else {
                    $('.trend .bindtrend').append(html);
                }

            }
        });
    }
    function loaddataformyraised(categoryid, pageno)
    {
        $.ajax({
            url: '<?php echo base_url(); ?>RatedArticle/loadmoremyraised',
            method: "POST",
            data: {categoryid: categoryid, pageno: pageno},
        }).done(function (result) {
            result = JSON.parse(result);
            var html = "";
            if (result['status']) {
                $('.loadmoremyraised').remove();
                var catname = "";
                if (categoryid == "1") {
                    catname = "Governance";
                } else if (categoryid == "2") {
                    catname = "Money";
                } else if (categoryid == "3") {
                    catname = "Sports";
                } else if (categoryid == "4") {
                    catname = "Entertainment";
                } else {
                    catname = "Governance";
                }
                for (var i in result['data']) {
                    html += '<div class="blogs p15_20">\
                                <div class="row">\
                                    <a href="<?= base_url() ?>RatedArticle?pid=' + result['data'][i]['id'] + '">\
                                        <div class="col s12">\
                                            <div class="blog-title truncate">' + result['data'][i]['question'] + '</div>\
                                            <div class="right blog-details lightgray">\
                                                <i class="lightgray flaticon-click ml0"></i>\
                                                <span class="lightgray fs12px">' + result['data'][i]['total_votes'] + ' Votes</span></div>\
                                        </div>\
                                    </a>\
                                </div>\
                            </div>';
                }
                html += '<div class="loadmoremyraised" data-page="' + (parseInt(pageno) + 1) + '" data-catid="myraised"></div>';
                if (parseInt(pageno) < 1) {
                    $('.myraised .bindraised').html(html)
                } else {
                    $('.myraised .bindraised').append(html)
                }
            } else {

            }
        });
    }

</script>
<script>
    /* Dont Delete this part, Can be useful later - for showing the results to the not logged in users */
//    $(document).on('change','input[type=radio]',function(){
//        if($(this).hasClass('showresults')){
//            var articleid=$(this).attr('data-articleid');
//            $('.articleoption_'+articleid).addClass('votedarticle');
//            setTimeout(function () {
//               $("articleoption_"+articleid+" .determinate").each(function () {
//                   var newper = $(this).attr('data-afterload');
//                   $(this).css('width', newper + '%');
//               });
//           }, 100);
//        }
//    });

    function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
    var getDateString = function(date, format) {
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            getPaddedComp = function(comp) {
                return ((parseInt(comp) < 10) ? ('0' + comp) : comp)
            },
            formattedDate = format,
            o = {
                "y+": date.getFullYear(),
                "M+": months[date.getMonth()],
                "m+": getPaddedComp(date.getMinutes()),
            };
        for (var k in o) {
            if (new RegExp("(" + k + ")").test(format)) {
                formattedDate = formattedDate.replace(RegExp.$1, o[k]);
            }
        }
        return formattedDate;
    };
</script>
<script>
    $(document).on('click', '.articlebtnvote', function(e) {
    var articleid = $(this).attr('data-articleid');
    var section = $(this).attr('data-type');
    var categoryid = $(this).attr('data-catid');
    var userchoice = $("input[name='articlechoice" + section + "_" + articleid + "']:checked").val();
    <?php if (empty($this->session->userdata('data'))) { ?>
                localStorage.articleid = articleid;
                localStorage.choiseid = userchoice;
                localStorage.categoryid = categoryid;
                localStorage.section = section;
    <?php } ?>
    if ($("input[name='articlechoice" + section + "_" + articleid + "']").is(":checked")) {
    <?php if (empty($this->session->userdata('data'))) { ?>
                var redirecturl = $('#redirecturl').val();
                redirecturl = redire c turl + "&t=2&pid=" + articleid;
                window.location.assign(redirecturl);
    <?php } ?>
        $.ajax({
            "url": "<?= base_url() ?>RatedArticle/addarticlechoice",
            "method": "POST",
            "data": {
                "article_id": articleid,
                "choice": userchoice,
                "category_id": categoryid
            }
        }).done(function(result) {
            result = JSON.parse(result);
            if (result['status']) {
                $('.articleoption_' + articleid).each(function() {
                    var html = "";
                    var tabname = $(this).attr('data-tabname');
                    for (var i in result['data']['options']) {
                        var isvoted = result['data']['options'][i]['choice_id'] == userchoice ? "checked" : "";
                        var totalavg = result['data']['options'][i]['choice'] != "Click to see Rating" ? '<span class="avgpercount fs14px">' + result['data']['options'][i]['avg'] + ' %</span>' : "";
                        var userselected = result['data']['options'][i]['choice_id'] == userchoice ? "userselected" : "";
                        var isnoclickchoice = result['data']['options'][i]['choice'] == "Click to see Rating" ? "fw600" : "";
                        html += '<div class = "col m12 s12">\
                                                <div class = "row mb7">\
                                                    <div class="col m12 s12">\
                                                        <label class = "articleoption progress" style="position: relative;">\
                                                            <input class = "with-gap" class="articlechoice_' + articleid + '" name = "articlechoice' + tabname + '_' + articleid + '" data-type="' + tabname + '" data-total="' + result['data']['options'][i]['total'] + '" type = "radio" value="' + result['data']['options'][i]['choice_id'] + '" ' + isvoted + '/>\
                                                                <span class="customradio">\
                                                                    <i class="flaticon-check selected"></i>\
                                                                </span>\
                                                                <span class="fs14px choicetext">' + (result['data']['options'][i]['choice'] == "Do not know or skip" || result['data']['options'][i]['choice'].toLowerCase() == "click to see rating" ? "<b>Click to see Rating</b>" : result['data']['options'][i]['choice']) + '</span>\
                                                                <div class = "determinate ' + userselected + '" style = "width: 0%" data-afterload="' + result['data']['options'][i]['avg'] + '"></div>\     ' + totalavg + '\
                                                        </label>\
                                                    </div>\
                                                </div>\
                                            </div>';
                    }

                    $("#articleoption" + tabname + "_" + articleid).html(html);
                    $("#articleoption" + tabname + "_" + articleid).addClass('votedarticle');
                    $(".votedarticle input[type='radio']").attr('disabled', true);
                    setTimeout(function() {
                        var maxper = 0 //$("#articleoption" + tabname + "_" + articleid + " .determinate:first").parent().addClass('maxper');
                        $("#articleoption" + tabname + "_" + articleid + " .determinate").each(function() {
                            var newper = $(this).attr('data-afterload');
                            $(this).css('width', newper + '%');
                            if (parseFloat(newper) > parseFloat(maxper)) {

                                maxper = newper;
                            }
                        });
                    }, 100)

                });
                $('input[name ^=articlechoice][name $=' + articleid + '][value=' + userchoice + ']').attr('checked', true);
                var changebtn = '<span class="votescountbox mr20">\
                                    <span class="flaticon-click ml0 mr5"></span>\
                                    <span class="fs14px fw500">' + result['data']['total_votes'] + '  Votes</span>\
                                </span>';
                //$('button[data-articleid="' + articleid + '"].articlebtnvote').parent().prepend(changebtn);
                $('button[data-articleid="' + articleid + '"].articlebtnvote').remove();
                $('#togglecmtsec_' + section + '_' + articleid).slideDown('slow');
                var votesword = result['data']['total_votes'] > 1 ? "Votes" : "Vote";
                var votecount = result['data']['total_votes'];
                if (result['data']['total_votes'] > 0 && result['data']['total_votes'] < 99) {
                    $('.votescountbox .votetext_' + articleid + '').addClass('twodigit');
                } else if (result['data']['total_votes'] > 99) {
                    $('.votescountbox .votetext_' + articleid + '').addClass('threedigit');
                }
                if (result['data']['total_votes'] > 0 && result['data']['total_votes'] < 9) {
                    votecount = '0' + result['data']['total_votes'];
                }
                $('.votescountbox .votetext_' + articleid + '').html(votecount);
                loaddatafortrending(0, 0);
                loaddataformyraised(0, 0);

                if (result['isnew'] == 1) {
                    $('#pointsModal #title').html('Congratulations');
                    $('#pointsModal #points').html('1');
                    $('#pointsModal #msg').html("You earned 1 Silver point");
                    $('#pointsModal #submsg').html("");
                    $('#pointsModal .optionsbtn').css('display', 'none');
                    $('#pointsModal').modal('open');

                    setTimeout(function() {
                        $('#pointsModal').modal('close');
                    }, 3000);
                }
            }
        });

    } else {
        Materialize.Toast.removeAll();
        Materialize.toast('Please select choice', 4000);
    }
});

    $(function () {
    var articleid = localStorage.articleid;
    var userchoice = localStorage.choiseid;
    var categoryid = localStorage.categoryid;
    var section = localStorage.section;
    if (typeof (localStorage.articleid) != "undefined" && typeof (localStorage.choiseid) != "undefined" && typeof (localStorage.categoryid) != "categoryid") {
    $.ajax({
        "url": "<?= base_url() ?>RatedArticle/addarticlechoice",
        "method": "POST",
        "data": {"article_id": articleid, "choice": userchoice, "category_id": categoryid}
    }).done(function (result) {
        result = JSON.parse(result);
                    
        if (result['status'])
        {
            localStorage.clear();
            $('.articleoption_' + articleid).each(function () {
                var html = "";
                var tabname = $(this).attr('data-tabname');
                for (var i in result['data']['options']) {
                    var isvoted = result['data']['options'][i]['choice_id'] == userchoice ? "checked" : "";
                    var totalavg = result['data']['options'][i]['choice'] != "Click to see Rating" ? '<span class="avgpercount fs14px">' + result['data']['options'][i]['avg'] + ' %</span>' : "";
                    var userselected = result['data']['options'][i]['choice_id'] == userchoice ? "userselected" : "";
                    var isnoclickchoice = result['data']['options'][i]['choice'] == "Click to see Rating" ? "fw600" : "";
                    html += '<div class = "col m12 s12">\
                                <div class = "row mb7">\
                                    <div class="col m12 s12">\
                                        <label class = "articleoption progress" style="position: relative;">\
                                            <input class = "with-gap" class="articlechoice_' + articleid + '" name = "articlechoice' + tabname + '_' + articleid + '" data-type="' + tabname + '" data-total="' + result['data']['options'][i]['total'] + '" type = "radio" value="' + result['data']['options'][i]['choice_id'] + '" ' + isvoted + '/>\
                                            <span class="customradio">\
                                                <i class="flaticon-check selected"></i>\
                                            </span>\
                                            <span class="fs14px choicetext">' + (result['data']['options'][i]['choice'] == "Click to see Rating" || result['data']['options'][i]['choice'].toLowerCase() == "click to see rating" ? "<b>Click to see Rating</b>" : result['data']['options'][i]['choice']) + '</span><!--style="position:absolute;" -->\
                                            <div class = "determinate ' + userselected + '" style = "width: 0%" data-afterload="' + result['data']['options'][i]['avg'] + '"></div>\
                                            ' + totalavg + '\
                                        </label>\
                                    </div>\
                                </div>\
                            </div>';
                }
                $("#articleoption" + tabname + "_" + articleid).html(html);
                $("#articleoption" + tabname + "_" + articleid).addClass('votedarticle');
                //$(".votedarticle input[type='radio']").attr('disabled', true);
                            
                setTimeout(function () {
                    var maxper=0
                    //$("#articleoption" + tabname + "_" + articleid + " .determinate:first").parent().addClass('maxper');
                    $("#articleoption" + tabname + "_" + articleid + " .determinate").each(function () {
                        var newper = $(this).attr('data-afterload');
                        $(this).css('width', newper + '%');
                        if(parseFloat(newper)>parseFloat(maxper)){
                            //$("#articleoption" + tabname + "_" + articleid + " .determinate").parent().removeClass('maxper');
                            //$(this).parent().addClass('maxper');
                            maxper=newper;
                        }
                    });
                }, 100);
            });
            var changebtn = '<span class="votescountbox mr20">\
                                <span class="flaticon-click ml0 mr5"></span>\
                                <span class="fs14px fw500">' + result['data']['total_votes'] + '  Votes</span>\
                            </span>';
            //$('button[data-articleid="' + articleid + '"].articlebtnvote').parent().prepend(changebtn);
            $('button[data-articleid="' + articleid + '"].articlebtnvote').remove();
            $('#togglecmtsec_' + section + '_' + articleid).slideDown('slow');
                        
            var votesword=result['data']['total_votes']>1?"Votes":"Vote";
                                
            var votecount=result['data']['total_votes'];

            if(result['data']['total_votes']>0 && result['data']['total_votes']<99){
                $('.votescountbox .votetext_'+articleid+'').addClass('twodigit');
            } else if(result['data']['total_votes']>99){
                $('.votescountbox .votetext_'+articleid+'').addClass('threedigit');
            }
            if(result['data']['total_votes']>0 && result['data']['total_votes']<9){
               votecount='0'+result['data']['total_votes'];
            }
            $('.votescountbox .votetext_'+articleid+'').html(votecount);
            loaddatafortrending(0,0);
            loaddataformyraised(0,0);
                        
            if(result['isnew']==1){
                $('#pointsModal').addClass('small');
                $('#pointsModal #title').html('Congratulations');
                $('#pointsModal #points').html('1');
                $('#pointsModal #msg').html("You earned 1 Silver point");
                $('#pointsModal #submsg').html("");
                $('#pointsModal .optionsbtn').css('display', 'none');
                $('#pointsModal').modal('open');
                setTimeout(function () {
                    $('#pointsModal').modal('close');
                }, 3000);
            }
        }
    });
    }
    });

    $(document).on('click', '.share', function (e) {
    var ua = navigator.userAgent.toLowerCase();
    var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
    if (!isAndroid) {
    var article_id = $(this).attr('data-articleid');
    var section = $(this).attr('data-section');

    var $this = $(this),
            $tooltip = $this.find('.tooltip');
    if (!$tooltip.hasClass('In')) {
        $('.tooltip').stop(true, true).fadeOut(500);
        $('.share_' + section + article_id).fadeIn(100);
        $tooltip.addClass('In');
    } else {
        $tooltip.removeClass('In');
        $('.share_' + section + article_id).stop(true, true).fadeOut(500);
    }
    }
    });
    
    (function($){
  var url1 = /(^|&lt;|\s)(www\..+?\..+?)(\s|&gt;|$)/g,
      url2 = /(^|&lt;|\s)(((https?|ftp):\/\/|mailto:).+?)(\s|&gt;|$)/g,

      linkifyThis = function () {
        var childNodes = this.childNodes,
            i = childNodes.length;
        while(i--)
        {
          var n = childNodes[i];
          if (n.nodeType == 3) {
            var html = $.trim(n.nodeValue);
            if (html)
            {
              html = html.replace(/&/g, '&amp;')
                         .replace(/</g, '&lt;')
                         .replace(/>/g, '&gt;')
                         .replace(url1, '$1<a target="_blank" href="http://$2">$2</a>$3')
                         .replace(url2, '$1<a target="_blank" href="$2">$2</a>$5');
              $(n).after(html).remove();
            }
          }
          else if (n.nodeType == 1  &&  !/^(a|button|textarea)$/i.test(n.tagName)) {
            linkifyThis.call(n);
          }
        }
      };

  $.fn.linkify = function () {
    return this.each(linkifyThis);
  };

})(jQuery);

//jQuery('h6.tastart').linkify();
</script>
<?php

function encodeURIComponent($str)
{
    $revert = array(
        '%21' => '!',
        '%2A' => '*',
        '%27' => "'",
        '%28' => '(',
        '%29' => ')'
    );
    return strtr(rawurlencode($str), $revert);
}
?>

