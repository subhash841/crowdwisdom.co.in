<?php
$today = date("Y-m-d H:i:s");
?>
<style>
    button + .votescountbox{
        display:none;
    }
    </style>
<input type="hidden" id="redirecturl" value="<?= base_url() ?>Login?section=survey">
<div class="content container forumpages forumpagelist polllists" id="forumdetailpage">
    <div class="col s12">
        <div class="row">
            <div class="col l8 s12 plr15">
                <!--<div class="row mb0">
                    <div class="col m12 s12">
                        <ul id="tabs-swipe-demo" class="tabs forumtypetab">
                            <li class="tab col m3"><a href="#elecpoll" data-catid="<?= $category_list[0]['id'] ?>" data-type="gov" class="<?= !empty($governance) ? "active" : "" ?>"><i class="flaticon-interface"></i> Governance</a></li>
                            <li class="tab col m3"><a href="#stockpoll" data-catid="<?= $category_list[1]['id'] ?>" data-type="money" class="<?= !empty($money) ? "active" : "" ?>"><i class="flaticon-money"></i> Money</a></li>
                            <li class="tab col m3"><a href="#sportpoll" data-catid="<?= $category_list[2]['id'] ?>" data-type="sport" class="<?= !empty($sports) ? "active" : "" ?>" ><i class="flaticon-ball"></i> Sports</a></li>
                            <li class="tab col m3"><a href="#moviepoll" data-catid="<?= $category_list[3]['id'] ?>" data-type="entert" class="<?= !empty($entertainment) ? "active" : "" ?>" ><i class="flaticon-movie"></i> Entertainment</a></li>
                        </ul>
                    </div>
                </div>-->
                <div class="row slide-on-mobile-button">
                    <!--        <a id="show-mobile-discussion" class="start-discussion discussred show-on-small hide-on-med-and-up">Raise a Poll</a>-->
                    <div class="col s12 center-align hide-on-med-and-up show-on-small raiseapoll_mob">
                        <div class="olive askvotebanner" id="askvotebanner" style="margin-top: 20px;">
                            <div class="row m-0">
                                <div class="col s4 p0">
                                    <div class="asknwpoll">
                                        <img src="<?= base_url('images/banners/raise_poll.png'); ?>" alt="">
                                    </div>
                                </div>

                                <div class="col s8 p0">
                                    <h3 class="fs12px mtb7px fw500">Take a survey for free <a id="show-mobile-discussion" class="btn btn-default bluegray votenow start-discussion ">Ask Now</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 left-align show-on-med-and-up hide-on-small-only ">
                        <div class="olive askvotebanner" id="askvotebanner" style="margin-top: 20px;">
                            <div class="row m-0">
                                <div class="col s4">
                                    <div class="asknwpoll">
                                        <img src="<?= base_url('images/banners/raise_poll.png'); ?>" alt="">
                                    </div>
                                </div>

                                <div class="col s8" style="padding: 20px;">
                                    <h3 class="fs16px m-0 fw500">Take a survey for free <a id="show-mobile-discussion" class="btn btn-default bluegray votenow start-discussion ">Ask Now</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12">
                    <div class="row slide-on-mobile">
                        <div class="" style="position:relative;">
                            <?php
if (empty($_SESSION['data'])) {
?>
                                <!--<div class="forum-overlay">
                                    <a href="<?= base_url() ?>Login?section=discussion" class="btn btn-default start-discussion themered">Login to discuss</a>
                                </div>-->
                            <?php
}
?>
                            <form id="postpoll" name="myform" method="POST" action="<?= base_url() ?>Survey/add_update_poll"  onsubmit="return validateForm()">
                                <div class="card forumarea">
                                    <div class="row mb0">
                                        <div class="col m12 s12">
                                            <div class="row mb0">
                                                <div class="col s12">
                                                    <textarea id="polltopic" name="polltopic" placeholder="Ask your question with 'What' , 'Why' , 'Which' etc" maxlength="75"></textarea>
                                                </div>
                                            </div>
                                            <!--<div class="row mb0">
                                                <div class="col s12">
                                                    <h5 class="fs13px fw600 fieldtitle">Select a Category</h5>
                                                    <div id="pollcatergory">
                                                        <?php
                                                            foreach ($category_list as $pollcat) {
                                                                echo '<div class="col m3 s6">';
                                                                echo '<input type="radio" id="cat_' . $pollcat['id'] . '" name="pollcatergory" value="' . $pollcat['id'] . '">
                                                                                                                                <label for="cat_' . $pollcat['id'] . '"><div class="p5-10 ">' . $pollcat['name'] . '</div></label>';

                                                                echo '</div>';
                                                            }
                                                        ?>
                                                    </div>
                                                    <input type="radio" id="test2" name="radio-group">
                                                    <label for="test2"><span>Peach</span></label>
                                                    <input type="radio" id="test3" name="radio-group">
                                                    <label for="test3"><span>Orange</span></label>
                                                </div>
                                            </div>-->
                                        </div>
                                        <div class="col m12 s12">
                                            <h5 class="fs13px fw600 fieldtitle">Description</h5>
                                            <textarea data-autoresize class="textarea-scrollbar" id="polldescription" name="polldescription" placeholder="Type your description here" maxlength="300" row="3" ></textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <h5 class="fs13px fw600 p0-10 fieldtitle">Choices</h5>
                                        <div class="col s12" id="choiceslist">
                                            <div class="row choice mb10">
                                                <div class="col s11">
                                                    <input type="text" name="choice[]" maxlength="35"  placeholder="Enter your choice here"/>
                                                </div>
                                                <div class="col s1 no-padding">
                                                    <i class="flaticon-plus addmorechoice"></i>
                                                    <i class="flaticon-delete removechoice hide"></i>
                                                </div>
                                            </div>
                                            <div class="row choice mb10">
                                                <div class="col s11">
                                                    <input type="text" name="choice[]" maxlength="35" placeholder="Enter your choice here"/>
                                                </div>
                                                <div class="col s1 no-padding">
                                                    <i class="flaticon-plus addmorechoice"></i>
                                                    <i class="flaticon-delete removechoice hide"></i>
                                                </div>
                                            </div>
                                            <div class="row choice mb10">
                                                <div class="col s11">
                                                    <input type="text" name="choice[]" maxlength="35" placeholder="Enter your choice here"/>
                                                </div>
                                                <div class="col s1 no-padding">
                                                    <i class="flaticon-plus addmorechoice"></i>
                                                    <i class="flaticon-delete removechoice "></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12" id="staticoption">
                                            <div class="row choice mb10">
                                                <div class="col s11">
                                                    <div style="position:relative">
                                                        <input type="text" name="static1" disabled/>
                                                        <span class="asterisk" for="static1">See the Results</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row choice mb10">
                                                <div class="col s11">
                                                    <div style="position:relative">
                                                        <input type="text" name="static2" disabled/>
                                                        <span class="asterisk" for="static2">None of the above</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="row">
                                        <div class="col m12 s12">
                                            <h5 class="fs13px fw600 fieldtitle">End Date</h5>
                                            <input type="" id="enddate" id="enddate" name="enddate" data-toggle="datepicker" autocomplete="off" readonly="true">
                                        </div>
                                    </div>-->
                                    <div class="row center mt35b20">
                                        <input type="hidden" id="poll_id" name="poll_id" value="0">
                                        <button type="submit" class="btn btn-default themered orgtored mr10">Save</button>
                                        <button type="reset" class="knowmore borgtored p-0"><h5 class="txtorgtored fs14px fw500">Cancel</h5></button>
                                        <!--                                        <button type="reset" class="btn btn-default knowmore white    borgtored"><h5 class="txtorgtored fs14px">Cancel</h5></button>-->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="" style="position:relative">
                            <div class="loadersmall">
                                <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                            </div>
                        </div>
                    <div id="elecpoll" class="col s12" <?= !empty($governance) ? "active" : "" ?>>
                        <div class="row mb0">
                            <?php
                            $tabarray = strtolower($category_list[0]['name']);
                            
                            ?>
                            <?php
                            if (isset($$tabarray)) {
                                ?>
                                <?php
                                if (!empty($$tabarray)) {
                                    ?>
                                    <?php
                                    foreach ($$tabarray as $gov) {
                                        ?>
                                        <div class="col l12 m12 s12">
                                            <?php
                                            $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "|", "/", ";", "'", "<", ">", ",", '"', "?");
                                            $title = str_replace($spchar, "", $gov['question']);
                                            $title = str_replace(' ', '-', $title);

                                            //$href = base_url() . 'Poll/#elecpoll&pid=' . $gov['id'] . "/" . $title;
                                            $uri_parts = explode('?', $_SERVER['REQUEST_URI']);

                                            //$href   = urlencode((isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $uri_parts[0] . "/surveydetail/" . $gov['id'] . "?_t=" . time());
                                            $href = urlencode(base_url() . "Survey/surveydetail/" . $gov['id'] . "?_t=" . time());
                                            $target = 'target = "_blank"';
                                            ?>
                                            <?php
                                            $d1 = strtotime($gov['end_date']);
                                            $d2 = strtotime($today);
                                            $end_date = date('Y-m-d', $d1);
                                            $today = date('Y-m-d', $d2);
                                            ?>
                                            <div class="card p20  equal-height" id="card_<?= $gov['id']; ?>">
                                                <div class="card_content pollcard-scrollbar">
                                                    <div class="row mb0">
                                                        <div class="col m10 s10">
                                                            <div class="col s12">
                                                                <div class="row mb10">
                                                                    <h6 class="fs18px tastart fw500 m-0" style=""><?= $gov['question'] ?></h6>
                                                                </div>
                                                            </div>
                                                            <div class="col s12">
                                                                <div class="row mb0">
                                                                    <?php
                                                                    $display_name = "";
                                                                    if ($gov['raised_by_admin'] == "1") {
                                                                        $display_name = '<img src="' . base_url() . 'images/logo/crowd-wisdom.png" class="bycrowdwisdom">';
                                                                    } else {
                                                                        $display_name = ($user_id == $gov['user_id']) ? 'You' : $gov['byuser'];
                                                                    }
                                                                    ?>
                                                                    <h6 class="forumsubhead fs12px tastart m-0 lightgray fw500"><i>By <?= $display_name ?>, <?= date('j M Y', strtotime($gov['created_date'])); ?> </i></h6>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php if ($gov['user_id'] == $user_info['uid']) { ?>
                                                            <div class="col m1 s1">
                <!--                                                        <i class="flaticon-info readdescinfo pull-right" onClick="showdescription(<?= $gov['id']; ?>, 'gov', this)"></i>-->
                                                            </div>
                                                            <div class="col m1 s1">
                                                                <div class="">
                                                                    <a materialize="dropdown" class='dropdown-button pollubhead right'  href='#' data-activates='mypollactions_<?= $gov['id']; ?>'>
                                                                        <i class="flaticon-three-1"></i>
                                                                    </a>
                                                                    <ul id='mypollactions_<?= $gov['id']; ?>' class='dropdown-content'>

                                                                        <li id="editpoll" class="<?php if ($gov['total_votes'] > 25) { echo "hide"; } ?>" data-rowjson='<?php echo json_encode($gov); ?>' data-pollid="<?= $gov['id'] ?>" data-title="<?= trim(preg_replace('/\s\s+/', ' ', $gov['question'])); ?>" >
                                                                            <h6 class="fs16px mypoll ">Edit</h6>
                                                                        </li>
                                                                        <li>
                                                                            <a class="fs16px mypoll modal-trigger confdelete" href="#confirmdelete" data-pollid="<?= $gov['id'] ?>">Delete</a>
<!--                                                                            <h6 class="fs16px mypoll">Delete</h6>-->
                                                                        </li>
                                                                        <li class="hide"><h6 class="fs16px mypoll">Report</h6></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <?php } else { ?>
                                                            <div class="col m2 s2">
                    <!--                                                            <i class="flaticon-info readdescinfo pull-right" onClick="showdescription(<?= $gov['id']; ?>, 'gov', this)"></i>-->
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="row mb10">
                                                        <div class="col m12 s12 polldescr" id="description_gov<?= $gov['id']; ?>">
                                                            <h6 class="fs14px tastart" style=""><?= $gov['description'] ?></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb0">

                                                    <?php
                                                    $allowvote = "";
                                                    $choicedisable = "";
                                                    if (!empty($gov['user_choice'])) {
                                                        $allowvote = "votedpoll";
                                                    }
//                                                    if ($end_date < $today) {
//                                                        $allowvote="votedpoll";
//                                                        $choicedisable = "choicedisabled";
//                                                    }
                                                    ?>
                                                    <div data-tabname="gov" class="polloptions polloption_<?= $gov['id']; ?>  p-0 <?= $allowvote ?> <?= $choicedisable ?>" id="polloptiongov_<?= $gov['id']; ?>">
                                                        <?php foreach ($gov['options'] as $index => $op) { ?>
                                                            <div class = "col m12 s12">
                                                                <div class = "row mb7">
                                                                    <div class="col m12 s12">
                                                                        <label class = "polloption progress" style="position: relative;">
                                                                            <?php 
                                                                            $showresults="";
                                                                                if($op['choice'] == "Do not know or skip" || strtolower($op['choice']) == "see the results") {
                                                                                    $showresults="showresults";
                                                                                    
                                                                            } ?>
                                                                            <input class = "with-gap <?= $showresults ?> pollchoice_<?= $gov['id'] ?>" name = "pollchoicegov_<?= $gov['id'] ?>" data-pollid="<?= $gov['id'] ?>" data-type="gov" data-total="<?= $op['total'] ?>" type = "radio" value="<?= $op['choice_id']; ?>" <?= $op['choice_id'] == $gov['user_choice'] ? "checked" : "" ?>/>
                                                                            <span class="customradio">
                                                                                <i class="flaticon-check selected"></i>
                                                                            </span>
                                                                            <span class="fs14px choicetext"><?= ($op['choice'] == "Do not know or skip" || strtolower($op['choice']) == "see the results" ? "<b>See The Results</b>" : $op['choice']) ?></span><!--style="position:absolute;" -->
                                                                            <div class = "determinate <?= $op['choice_id'] == $gov['user_choice'] ? "userselected" : "" ?>" style = "width: 0%" data-afterload="<?= $op['avg'] ?>"></div>
                                                                            <?php
                                                                            if (strtolower($op['choice']) != "see the results") {
                                                                                ?>
                                                                                <span class="avgpercount fs14px"><?= $op['avg'] ?> %</span>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="show-on-med-and-up hide-on-small-only">
                                                    <div class="row mb15">
                                                        <div class="col s12">
                                                            <?php if (!empty($gov['user_choice'])) { ?>
                                                            <span class="votescountbox mr20">
                                                                <span class="flaticon-click ml0 mr5"></span>
                                                                <span class="fs14px fw500"><?= $gov['total_votes'] ?>  Votes</span>
                                                            </span>
                                                            <?php } else { ?>
                                                            <button type="submit" data-pollid="<?= $gov['id']; ?>"  data-type="gov" data-catid="<?= $gov['category_id'] ?>" data-totalvotes="<?= $gov['total_votes'] ?>" class="btn btn-default pollbtnvote mr20">Vote</button>
                                                            <?php } ?>
                                                            <span class="mr20">
                                                                <span class="flaticon-multimedia ml0 mr10 fw500 lightgray fs14px  linkpointer  share" data-section="gov" data-pollid="<?= $gov['id']; ?>">Share
                                                                    <div class="tooltip share_gov<?= $gov['id']; ?>"><div class="tooltip-arrow" style="left: 20%;"></div>
                                                                        <a class="share-icon facebook" data-mobile-iframe="true" href="http://www.facebook.com/sharer/sharer.php?u=<?= $href ?>" target="_blank"><span class="fa fa-facebook"></span></a>
                                                                        <a class="share-icon twitter" href="https://twitter.com/intent/tweet?url=<?= $href ?>&text='<?= urlencode($gov['question']) ?>'&ael;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
                                                                        <a class="share-icon whatsapp" href="https://web.whatsapp.com/send?text=<?= $href ?>" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                                                        <a class="share-icon linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $href ?>&title=<?= $title ?>"  target="_blank"><span class="fa fa-linkedin"></span></a>
                                                                    </div>
                                                                </span>
                                                            </span>
                                                            <span>
                                                                <span class="flaticon-comment ml0 mr10 fw500 lightgray fs14px  linkpointer showritecmt " data-section="gov" data-pollid="<?= $gov['id']; ?>">Comment
                                                                </span>
                                                                <span class="pull-right lightgray fs14px fw500 showcmtcount" data-totalcomments="<?= $gov['total_comments'] ?>" data-section="gov" data-pollid="<?= $gov['id']; ?>" onclick="showcommentsec(<?= $gov['id']; ?>, 'gov')"><?= $gov['total_comments'] ?> <?= $gov['total_comments']>1 ? " Comments" : " Comment" ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hide-on-med-and-up show-on-small">
                                                    <div class="row mb15 center">
                                                        <?php if (!empty($gov['user_choice'])) { ?>
                                                        <span class="votescountbox mr7">
                                                            <span class="flaticon-click ml0 mr5"></span>
                                                            <span class="fs10px fw500"><?= $gov['total_votes'] ?>  Votes</span>
                                                        </span>
                                                        <?php } else { ?>
                                                        <button type="submit" data-pollid="<?= $gov['id']; ?>"  data-type="gov" data-catid="<?= $gov['category_id'] ?>" data-totalvotes="<?= $gov['total_votes'] ?>" class="btn btn-default pollbtnvote mr7">Vote</button>
                                                        <?php }
                                                        ?>
                                                        <span class="flaticon-multimedia ml0 mr7 fw500 lightgray fs10px  linkpointer share" onclick="share('<?= urldecode($href) ?>', this)" data-section="gov" data-pollid="<?= $gov['id']; ?>">Share
                                                            <div class="tooltip share_gov<?= $gov['id']; ?>"><div class="tooltip-arrow" style="left: 20%;"></div>
                                                                <a class="share-icon facebook" data-mobile-iframe="true" href="http://www.facebook.com/sharer/sharer.php?u=<?= $href ?>" target="_blank"><span class="fa fa-facebook"></span></a>
                                                                <a class="share-icon twitter" href=" https://twitter.com/intent/tweet?url=<?= $href ?>&text='<?= urlencode($gov['question']) ?>'&ael;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
                                                                <a class="share-icon whatsapp" href="whatsapp://send?text=<?= $href ?>" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                                                <a class="share-icon linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $href ?>&title=<?= $title ?>"  target="_blank"><span class="fa fa-linkedin"></span></a>
                                                            </div>
                                                        </span>

                                                        <span class="flaticon-comment ml0  mr7 fw500 lightgray fs10px  linkpointer showritecmt " data-section="gov" data-pollid="<?= $gov['id']; ?>"><?= $gov['total_comments']>1?"Comments":"Comment"?> <span class="cmtbadge"><?= $gov['total_comments'] ?></span>
                                                        </span>
            <!--                                                        <span class="pull-right lightgray fs10px mt7 fw500 showcmtcount" data-totalcomments="<?= $gov['total_comments'] ?>" data-section="gov" data-pollid="<?= $gov['id']; ?>" onclick="showcommentsec(<?= $gov['id']; ?>, 'gov')"><?= $gov['total_comments'] ?> Comments</span>-->
                                                    </div>
                                                </div>
                                                <div class="loadersmall" style="display:none"></div>
                                                <div id="togglecmtsec_gov_<?= $gov['id']; ?>" class="togglecmtsec">
                                                    <?php
                                                    //if ($end_date >= $today) {
                                                        ?>
                                                        <div class="row mb10">
                                                            <form id="postpollcomment" class="postpollcomment" name="postpollcmt" method="POST" action="<?= base_url() ?>Survey/add_comment">
                                                                <div class="col s12">
                                                                    <div style="position:relative">
                                                                        <textarea type="text" id="textarea1" class="writereply textarea-scrollbar" data-autoresize name="poll_comment" placeholder="Type your comments here..."></textarea>
                                                                        <span onclick="$(this).submit()" class="textareaicon"><span class="material-icons prefix sendarrowreply">send</span></span>
                                                                    </div>
                                                                    <input type="hidden" name="poll_id" value="<?= $gov['id']; ?>"/>
                                                                    <input type="hidden" name="poll_cmt_id" value="0"/>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <?php
                                                    //}
                                                    ?>
                                                    <div class="row mb0" id="pollreact">
                                                        <div class="commentbox custom-scrollbar">
                                                            <?php
                                                            if (!empty($gov['All_comments'])) {
                                                                ?>
                                                                <?php
                                                                foreach ($gov['All_comments'] as $ac) {
                                                                    ?>
                                                                    <div class="col s12">
                                                                        <div class="commentsection" id="cm_<?= $ac['id'] ?>">
                                                                            <div class="pollcardlist p-0">
                                                                                <div class="row mb0">
                                                                                    <div class="col m11 s11">
                                                                                        <h6 class="forumsubhead fs12px tastart mt5 lightgray fw500"><span class="flaticon-social-2 ml10 mr0"></span><i>By <?= $user_id == $ac['user_id'] ? 'You' : $ac['byuser']; ?>, <?= date('j M Y', strtotime($ac['created_date'])); ?> </i></h6>
                                                                                    </div>
                                                                                    <div class="col m1 s1">
                                                                                        <?php
                                                                                        if ($ac['user_id'] == $user_info['uid']) {
                                                                                            ?>
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
                                                                                            <?php
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="ml45">
                                                                                    <div class="cmteditbox positir">
                                                                                        <div class="mr35 whitespacepre"><?= $ac['comment'] ?></div>
                                                                                        <div class="hide posrela">
                                                                                            <textarea type="text" data-autoresize rows="2" id="cmt_<?= $ac['id'] ?>" data-value="<?= $ac['comment'] ?>" data-pollid="<?= $gov['id'] ?>" data-cmtid="<?= $ac['id'] ?>" readonly class="<?= $ac['user_id'] == $user_info['uid'] ? "commentedit" : "" ?> mb0 textarea-scrollbar"><?= $ac['comment'] ?></textarea>
                                                                                            <span data-cmtid="<?= $ac['id'] ?>" class="textareaicon1"><span class="material-icons prefix sendarrow">send</span></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row txtbluegray cmtop mb0">
                                                                                        <div class="col m7 s7"><h6 class="fs12px linkpointer showreplies_icon fs12px fw500 lightgray" data-cmtid="<?= $ac['id'] ?>" data-pollid="<?= $gov['id'] ?>" data-replyset="0"><i class="flaticon-arrow-1 lightgray"></i>Reply</h6></div>
                                                                                        <div class="col m5 s5 right right-align">
                                                                                            <span class="mr10 lightgray fs12px fw500 linkpointer showreplies" data-cmtid="<?= $ac['id'] ?>" data-pollid="<?= $gov['id'] ?>" data-replyset="0" data-totalreply="<?= $ac['total_replies'] ?>"><?= $ac['total_replies'] ?><?= $ac['total_replies']>1 ? " Replies" : " Reply" ?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="replies<?= $ac['id'] ?>" style="display:none;">
                                                                                        <div class="row m10">
                                                                                            <?php
                                                                                            //if ($end_date >= $today) {
                                                                                                ?>
                                                                                                <form id="postpollcommentrply" method="POST">
                                                                                                    <div class="col m12 s12">
                                                                                                        <div style="position:relative">
                                                                                                            <textarea type="text" id="textarea1" class="writereply textarea-scrollbar" data-autoresize name="poll_comment_reply" placeholder="Write a reply"></textarea>
                                                                                                            <span onclick="$(this).submit()" class="textareaicon"><span class="material-icons prefix sendarrowreply">send</span></span>
                                                                                                            <input type="hidden" name="poll_id" value="<?= $gov['id'] ?>"/>
                                                                                                            <input type="hidden" name="comment_id" value="<?= $ac['id'] ?>"/>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </form>
                                                                                                <?php
                                                                                            //}
                                                                                            ?>
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
                                                                ?>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <?php
                                                        if ($gov['total_comments'] > 2) {
                                                            ?>
                                                            <div class="row mb0">
                                                                <div class="col s12">
                                                                    <div class="loadmore fs12px fw500 lightgray" style="display:block" data-pageid="0" data-pollid="<?= $gov['id']; ?>" data-sectype="gov" data-totalcomments="<?= $gov['total_comments'] ?>">View more comments.</div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        } else if ($gov['total_comments'] == 0) {
                                                            ?>
                                                            <div class="row mb0">
                                                                <div class="col s12">
                                                                    <div class="nocmtdata fs12px fw500 lightgray" style="display:block" >Currently no comments available.</div>
                                                                </div>
                                                            </div>
                                                        <?php } else {

                                                        } ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                <?php } ?>
                                    <?php if ($total_polls['governance'] > 10) { ?>
                                        <div class="row mb0">
                                            <div class="center">
                                                <div class="loadmorepage btn themered" data-category="Governance" data-pageid="1" data-catid="<?= $category_list[0]['id'] ?>">See More</div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                    <div class="col l12 m12 s12">
                                        <div class="card p5-20  equal-height">
                                            <div class="card_content center nodatapoll" style="margin: 12% 18%;">
                                                <img src="<?= base_url('images/infographics/1.png'); ?>" style="width: 50%;">
                                                <h3 class="fieldtitle">Seems like there are no questions posted here for you</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                <?php }?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l4 m12 s12 plr15 hide-on-med-and-down show-on-large">
                <div class="row">
                    <div class="card z-depth-4 padd0 mt15">
                        <div class="card-head p7_20">
                            <div class="bloghead"><span><img src="<?= base_url('images/icons/light.png'); ?>" class="sidecardheadimg"/></span>Trending Surveys</div>
                        </div>
                        <div class="blogs-container withtable trend" data-trend="">
                            <?php if (!empty($trending)) { ?>
                                <div class="row">
                                    <div class="col s12 bindtrend">
                                        <?php foreach ($trending as $trend) { ?>
                                            <?php
                                                    $spchar= array("~","`","!","@","#","$","%","^","&","*","(",")","{","}","|","/",";","'","<",">",",",'"',"?");
                                                     $title     = str_replace($spchar, "", $trend['question']);
                                                     $title     = str_replace(' ', '-', $title);
                                                     $pollsec   = '?ct=' . $trend['category_name'] . '&pid=' . $trend['id'] . '';
                                                     $uri_parts = explode('?', $_SERVER['REQUEST_URI']);
                                                     $href      = base_url().'Survey'. $pollsec;

                                                     //$href = base_url() . 'Poll/#moviepoll&pid=' . $entert['id'] . "/" . $title;
                                                     $target = 'target = "_blank"';
                                             ?>
                                            <div class="blogs p15_20">
                                                <div class="row">
                                                    <a href="<?= $href ?>">
                                                        <div class="col s12">
                                                            <div class="blog-title truncate"><?= $trend['question']; ?></div>
<!--                                                            <div class="left fs11px fw600 blog-details mt10 text-upper category-display category <?= strtolower($trend['category_name']); ?>"><?= $trend['category_name'] ?></div>-->
                                                            <div class="right blog-details lightgray">
                                                                <i class="lightgray flaticon-click ml0"></i>
                                                                <span class="lightgray fs12px"><?= $trend['total_votes'] ?>  Votes</span></div>
        <!--                                                        <div class="right blog-details lightgray"><i class="material-icons icon-color">touch_app</i> <span class="total_votes"><?= $trend['total_votes'] ?> Votes</span></div>-->
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php
                                                }
                                            ?>
                                    </div>
                                </div>
                            <div class="loadmoretrending" data-page="1" data-catid="<?= $trending[0]['category_id']?>"></div>
                            <?php
                                } else {
                                ?>
                                <div class="center">
                                    <img src="<?= base_url('images/infographics/2.png'); ?>" style="width: 50%;">
                                    <h3 class="fs16px fieldtitle ">No trending questions available. </h3>
                                </div>

                            <?php
}
?>
                        </div>            


                        <?php
if (!empty($trending)) {
?>
                            <!--                    <div class="card-footer" style="">
                                                    <a href="javascript:void(0)" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                                                </div>-->
                        <?php
}
?>
                    </div>
                </div>
                <div class="row">
                    <div class="card z-depth-4 padd0">
                        <div class="card-head p7_20">
                            <div class="bloghead"><span class="flaticon-user mr25 usericon"></span>My Surveys</div>
                        </div>
                        <div class="blogs-container withtable myraised">
                            <div class="row">
                                <div class="col s12 bindraised">
                                    <?php
if (!empty($myraised)) {
?>
                                        <?php
    foreach ($myraised as $nvp) {
?>
                                            <?php
        $spchar= array("~","`","!","@","#","$","%","^","&","*","(",")","{","}","|","/",";","'","<",">",",",'"',"?");
        $title     = str_replace($spchar, "", $nvp['question']);
        $title     = str_replace(' ', '-', $title);
        $pollsec   = '?ct=' . $nvp['category_name'] . '&pid=' . $nvp['id'] . '';
        $uri_parts = explode('?', $_SERVER['REQUEST_URI']);
        $href      = base_url().'Survey'. $pollsec;
        
        //$href = base_url() . 'Poll/#moviepoll&pid=' . $entert['id'] . "/" . $title;
        $target = 'target = "_blank"';
?>
                                            <div class="blogs p15_20">
                                                <div class="row">
                                                    <a href="<?= $href ?>">
                                                    <div class="col s12">
                                                        <div class="blog-title truncate"><?= $nvp['question']; ?></div>
<!--                                                        <div class="left fs11px fw600 blog-details text-upper mt10 category-display category <?= strtolower($nvp['category_name']); ?>"><?= $nvp['category_name'] ?></div>-->
                                                        <div class="right blog-details lightgray"><i class="material-icons icon-color">touch_app</i> <span class="total_votes"><?= $nvp['total_votes'] ?> Votes</span></div>
                                                    </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php
    }
?>
                                    <div class="loadmoremyraised" data-page="1" data-catid="myraised"></div>
                                    <?php
} else {
?>
                                        <div class="center">
                                            <img src="<?= base_url('images/infographics/3.png'); ?>" style="width: 50%;">
                                            <h3 class="fs16px fieldtitle ">You havent raised any questions yet.</h3>
                                        </div>
                                    <?php
}
?>
                                </div>
                            </div>    
                        </div>
                        <?php
if (!empty($trending)) {
?>
                            <!--                    <div class="card-footer" style="">
                                                    <a href="javascript:void(0)" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                                                </div>-->
                        <?php
}
?>
                    </div></div>
            </div>
            <div class="col l4 m12 s12 plr15 show-on-medium-and-down hide-on-large-only">
                <div class="row">
                    <div class="card z-depth-4 padd0 mt15">
                        <div class="card-head p7_20">
                            <div class="bloghead"><span><img src="<?= base_url('images/icons/light.png'); ?>" class="sidecardheadimg"/></span>Trending Surveys</div>
                        </div>
                        <div class="blogs-container withtable trend">
                            <?php if (!empty($trending)) { ?>
                                <div class="row">
                                    <div class="col s12 bindtrend">
                                        <?php foreach ($trending as $trend) { ?>
                                            <?php
                                                $spchar= array("~","`","!","@","#","$","%","^","&","*","(",")","{","}","|","/",";","'","<",">",",",'"',"?");
                                                $title     = str_replace($spchar, "", $trend['question']);
                                                $title     = str_replace(' ', '-', $title);
                                                $pollsec   = '?ct=' . $trend['category_name'] . '&pid=' . $trend['id'] . '';
                                                $uri_parts = explode('?', $_SERVER['REQUEST_URI']);
                                                $href      = base_url().'Survey'. $pollsec;
                                                $target = 'target = "_blank"';
                                            ?>
                                            <div class="blogs p15_20">
                                                <div class="row">
                                                    <a href="<?= $href ?>">
                                                        <div class="col s12">
                                                            <div class="blog-title truncate"><?= $trend['question']; ?></div>
                                                            <!--<div class="left fs11px fw600 blog-details mt10 text-upper category-display category <?= strtolower($trend['category_name']); ?>"><?= $trend['category_name'] ?></div>-->
                                                            <div class="right blog-details lightgray">
                                                                <i class="lightgray flaticon-click ml0"></i>
                                                                <span class="lightgray fs12px"><?= $trend['total_votes'] ?>  Votes</span></div>
        <!--                                                        <div class="right blog-details lightgray"><i class="material-icons icon-color">touch_app</i> <span class="total_votes"><?= $trend['total_votes'] ?> Votes</span></div>-->
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <div class="loadmoretrending" data-page="1" data-catid="<?= $trending[0]['category_id']?>"></div>
                            <?php } else { ?>
                                <div class="center">
                                    <img src="<?= base_url('images/infographics/2.png'); ?>" style="width: 50%;">
                                    <h3 class="fs16px fieldtitle ">No trending questions available. </h3>
                                </div>
                            <?php } ?>
                        </div>
                        <?php if (!empty($trending)) { ?>
                            <!--<div class="card-footer" style="">
                                    <a href="javascript:void(0)" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                                </div>-->
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="card z-depth-4 padd0">
                        <div class="card-head p7_20">
                            <div class="bloghead"><span class="flaticon-user mr25 usericon"></span>My Surveys</div>
                        </div>
                        <div class="blogs-container withtable myraised">
                            <div class="row">
                                <div class="col s12 bindraised">
                                    <?php
if (!empty($myraised)) {
?>
                                        <?php
    foreach ($myraised as $nvp) {
?>
                                            <?php
        $spchar= array("~","`","!","@","#","$","%","^","&","*","(",")","{","}","|","/",";","'","<",">",",",'"',"?");
        $title     = str_replace($spchar, "", $nvp['question']);
        $title     = str_replace(' ', '-', $title);
        $pollsec   = '?ct=' . $nvp['category_name'] . '&pid=' . $nvp['id'] . '';
        $uri_parts = explode('?', $_SERVER['REQUEST_URI']);
        $href      = base_url().'Survey'. $pollsec;   
        
        //$href = base_url() . 'Poll/#moviepoll&pid=' . $entert['id'] . "/" . $title;
        $target = 'target = "_blank"';
?>
                                            <div class="blogs p15_20">
                                                <div class="row">
                                                    <a href="<?= $href ?>">
                                                    <div class="col s12">
                                                        <div class="blog-title truncate"><?= $nvp['question']; ?></div>
                                                        <!--<div class="left fs11px fw600 blog-details text-upper mt10 category-display category <?= strtolower($nvp['category_name']); ?>"><?= $nvp['category_name'] ?></div>-->
                                                        <div class="right blog-details lightgray"><i class="material-icons icon-color">touch_app</i> <span class="total_votes"><?= $nvp['total_votes'] ?> Votes</span></div>
                                                    </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php
    }
?>
                                    <div class="loadmoremyraised" data-page="1" data-catid="myraised"></div>
                                    <?php
} else {
?>
                                        <div class="center">
                                            <img src="<?= base_url('images/infographics/3.png'); ?>" style="width: 50%;">
                                            <h3 class="fs16px fieldtitle ">You havent raised any questions yet.</h3>
                                        </div>
                                    <?php
}
?>
                                </div>
                            </div>    
                        </div>
                        <?php
if (!empty($trending)) {
?>
                            <!--                    <div class="card-footer" style="">
                                                    <a href="javascript:void(0)" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                                                </div>-->
                        <?php
}
?>
                    </div></div>
            </div>
        </div>
    </div>
</div>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.0.8/d3.min.js"></script>
<script src="<?php
echo base_url();
?>assets/PieChart/js/donut-pie-chart.js" type="text/javascript"></script>-->
<div id="confirmdelete" class="modal">
    <div class="modal-content">
        <h5 class="fs16px">Are you sure want to delete this Survey ?</h5>
        <!--      <div>A bunch of text</div>-->
    </div>
    <div class="modal-footer">
        <a href="#!" class="btn themered waves-effect waves-green yes" data-pollid="">Yes</a>
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
    
    $(function(){
        //create form slide down
        $("a#show-mobile-discussion").on('click',function(){
            <?php
                if(empty($this->session->userdata('data'))){
            ?>
                    var redirecturl = $('#redirecturl').val();
                    window.location.assign(redirecturl);
            <?php
                } else if(empty($user_info['alise'])){
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
                    $('.slide-on-mobile').slideDown();poll_id
                    $('#polltopic').focus();
            <?php
                }
            ?>
        });
        
        //reset form slide up
        $('#postpoll button[type="reset"]').on('click',function(){
            $('.slide-on-mobile').slideUp();
            $('#polltopic').blur();
            $('#postpoll')[0].reset();
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
            $("html, body").animate({ scrollTop: 0 }, "slow");
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
                    $('.choice .removechoice').removeClass('hide');
                }
            } else {
                $('.choice .removechoice').addClass('hide');
                Materialize.Toast.removeAll();
                Materialize.toast('Minimum two options should be there', 4000);
            }
        });
        //click see more button
        $(document).on('click', '.loadmorepage', function(e){
            var categoryid = $(this).attr('data-catid');
            var pageno = $(this).attr('data-pageid');
            var type = "";
            //var type = $('#tabs-swipe-demo>li>a.active').attr('data-type');
            $(this).replaceWith("<div class='lds-roller pageloader' id='pageloader'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>");
            loaddatafortab(categoryid, pageno, type);
        });
        
        //trending scroll down to load more
        $('.trend').on('scroll', function() {
            if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                var categoryid=$('.loadmoretrending').attr('data-catid');
                var pageno=$('.loadmoretrending').attr('data-page');
                loaddatafortrending(categoryid, pageno);
            }
        });
        
        //My raised scroll down to load more
        $('.myraised').on('scroll', function() {
            if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                var categoryid=$('.loadmoremyraised').attr('data-catid');
                var pageno=$('.loadmoremyraised').attr('data-page');
                loaddataformyraised(categoryid, pageno);
            }
        });
        
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
        var topic = $("#polltopic").val();
        var polldescri = $('#polldescription').val();
        //var enddate = $('#enddate').val();
        
        //var pollcategory = $('input[name="pollcatergory"]:checked').val() ? true : false;
        var choicearray = $("input[name='choice[]']").map(function () {
            return $(this).val();
        }).get();
        
        var choiceelement = checkArray(choicearray);

        if (topic == "") {
            Materialize.Toast.removeAll();
            Materialize.toast('Please enter question topic', 4000);
            return false;
        }
//        if (enddate == "") {
//            Materialize.Toast.removeAll();
//            Materialize.toast('Please enter the date', 4000);
//            return false;
//        }
        if (polldescri == "") {
            Materialize.Toast.removeAll();
            Materialize.toast('Please enter question description', 4000);
            return false;
        }
//        if (!pollcategory) {
//            Materialize.Toast.removeAll();
//            Materialize.toast('Please Select Category', 4000);
//            return false; 
//        }
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
    
//    $(document).ready(function(){
//        $('.loadersmall').css('display','none');
//    });
    $(function () {
        var login_redirect = $("#redirecturl").val();
        $(".head-login").attr("href", login_redirect);
        });
        $(document).on('click', '.yesredeem', function (e) {
        $('#pointsModal').modal('close');
        $('.slide-on-mobile').slideDown();
        $('#polltopic').focus();
        $('.askvotebanner').css('display', 'none');
        setTimeout(function () {
        $('#polltopic').focus();
        }, 100);
        });
        $(document).on('click', '.noredeem', function (e) {
        $('#pointsModal').modal('close');
        });
//        $(document).on('click', 'a#show-mobile-discussion', function () {
//        $('#pointsModal').removeClass('small');
//    <?php
if (empty($this->session->userdata('data'))) {
?>//
//                var redirecturl = $('#redirecturl').val();
//                window.location.assign(redirecturl);
//    <?php
} else {
    if (empty($user_info['alise'])) {
?>//
//                    Materialize.Toast.removeAll();
//                    Materialize.toast('Please enter your alias first.', 2000);
//                    setTimeout(function () {
//                    var redirect_url = $("#redirecturl").val();
//                    var redirect_sess = redirect_url.split("?");
//                    window.location.href = '<?= base_url() ?>Profile?' + redirect_sess[1];
//                    }, 2000)
//    <?php
    } else {
?>//
//                    $.ajax({
//                    "url": "<?= base_url() ?>Poll/getsilverpoints",
//                            "method": "POST",
//                    }).done(function (result) {
//
//                    if (parseInt(result) > 500) {
//                    $('#pointsModal #title').html('Your Balance Points');
//                    $('#pointsModal #points').html(result);
//                    $('#pointsModal #msg').html('Redeem 500 Points to ask');
//                    $('#pointsModal #submsg').html('');
//                    $('#pointsModal .optionsbtn').css('display', 'block');
//                    $('#pointsModal').modal('open');
//                    } else {
//                    $('#pointsModal #title').html('Your Balance Points');
//                    $('#pointsModal #points').html(result);
//                    //$('#pointsModal #msg').html("<span style='color:#eb1000'>You can't raise any Poll</span>");
//                    $('#pointsModal #msg').hide();
//                    $('#pointsModal #submsg').html("You must have 500 silver points to ask a question");
//                    $('#pointsModal .optionsbtn').css('display', 'none');
//                    $('#pointsModal').modal('open');
//                    }
//                    });
//        <?php
    }
}
?>//
//    })
//            $(document).on('click', '#postpoll button[type="reset"]', function () {
//    
//    $('.slide-on-mobile').slideUp();
//    $('#postpoll')[0].reset();
//    //$('#polltopic').blur();
//    var defaultchoice = '<div class="row choice mb10">\
//                                <div class="col s11">\
//                                    <input type="text" name="choice[]" maxlength="35" placeholder="Enter your choice here"/>\
//                                </div>\
//                                <div class="col s1 no-padding">\
//                                    <i class="flaticon-plus addmorechoice"></i>\
//                                    <i class="flaticon-delete removechoice hide"></i>\
//                                </div>\
//                            </div>\
//                            <div class="row choice mb10">\
//                                <div class="col s11">\
//                                    <input type="text" name="choice[]" maxlength="35" placeholder="Enter your choice here"/>\
//                                </div>\
//                                <div class="col s1 no-padding">\
//                                    <i class="flaticon-plus addmorechoice"></i>\
//                                    <i class="flaticon-delete removechoice hide"></i>\
//                                </div>\
//                            </div>\
//                            <div class="row choice mb10">\
//                                <div class="col s11">\
//                                    <input type="text" name="choice[]"  maxlength="35" placeholder="Enter your choice here"/>\
//                                </div>\
//                                <div class="col s1 no-padding">\
//                                    <i class="flaticon-plus addmorechoice"></i>\
//                                    <i class="flaticon-delete removechoice "></i>\
//                                </div>\
//                            </div>';
//    $('#choiceslist').html(defaultchoice);
//    $('.askvotebanner').css('display', 'block');
//    })
</script>
<script>


    $(function () {
        //$('#loginbtn').attr('href','<?= base_url() ?>Login?section=poll&p=gov')

        if (window.location.href) {
            var hash = window.location.href; //Puts hash in variable, and removes the # character
            
            $('#tabs-swipe-demo>li>a').removeClass('active');
            if (hash.indexOf("#elecpoll") != -1 || hash.indexOf("Governance") != -1) {
                $('input[name="pollcatergory"][value="1"]').prop('checked', true);
                $('#tabs-swipe-demo>li>a[href="#elecpoll"]').addClass('active');
                $('#elecpoll').addClass('active');
                $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=gov');

            } else if (hash.indexOf("#stockpoll") != -1 || hash.indexOf("Money") != -1) {
                $('input[name="pollcatergory"][value="2"]').prop('checked', true);
                $('#tabs-swipe-demo>li>a[href="#stockpoll"]').addClass('active');
                $('#stockpoll').addClass('active');
                
                $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=mon');

            } else if (hash.indexOf("#sportpoll") != -1 || hash.indexOf("Sports") != -1) {
                $('input[name="pollcatergory"][value="3"]').prop('checked', true);
                $('#tabs-swipe-demo>li>a[href="#sportpoll"]').addClass('active');
                $('#sportpoll').addClass('active');
                
                $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=spo');
            } else if (hash.indexOf("#moviepoll") != -1 || hash.indexOf("Entertainment") != -1) {
                $('input[name="pollcatergory"][value="4"]').prop('checked', true);
                $('#tabs-swipe-demo>li>a[href="#moviepoll"]').addClass('active');
                
                $('#moviepoll').addClass('active');
                $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=ent');
            } else {
                $('input[name="pollcatergory"][value="1"]').prop('checked', true);
                $('#tabs-swipe-demo>li>a[href="#elecpoll"]').addClass('active');
                $('#elecpoll').addClass('active');
                //$('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=gov');
                $('#redirecturl').val('<?= base_url() ?>Login?section=survey');
            }
        } else {
            $('input[name="pollcatergory"][value="1"]').prop('checked', true);
            $('#tabs-swipe-demo>li>a[href="#elecpoll"]').addClass('active');
            $('#elecpoll').addClass('active');
            //$('#loginbtn').attr('href', '<?= base_url() ?>Login?section=poll&p=gov')
            $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=gov');
        }

    });
            $(function () {
<?php if ($this->session->flashdata('toast')) { ?>
                Materialize.Toast.removeAll();
                Materialize.toast('<?= $this->session->flashdata('toast') ?>', 4000);
                //return false;
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
//   );

    function showComments(id) {
    //$('div[class^="replies"]').slideUp();
    $('.replies' + id).slideToggle();
    }


//    function validateForm() {
//    var topic = $("#polltopic").val();
//    var polldescri = $('#polldescription').val();
//    var enddate = $('#enddate').val();
//    //var pollcategory = $("#pollcatergory").val();
//    var pollcategory = $('input[name="pollcatergory"]:checked').val() ? true : false
//            var choicearray = $("input[name='choice[]']")
//            .map(function () {
//            return $(this).val();
//            }).get();
//    var choiceelement = checkArray(choicearray);
//    
//    if (topic == "") {
//    Materialize.Toast.removeAll();
//    Materialize.toast('Please enter question topic', 4000);
//    return false;
//    }
//    if (enddate == "") {
//    Materialize.Toast.removeAll();
//    Materialize.toast('Please enter the date', 4000);
//    return false;
//    }
//    if (polldescri == "") {
//    Materialize.Toast.removeAll();
//    Materialize.toast('Please enter question description', 4000);
//    return false;
//    }
//    if (!pollcategory) {
//    Materialize.Toast.removeAll();
//    Materialize.toast('Please Select Category', 4000);
//    return false; }
//    if (choiceelement == 0) {
//    Materialize.Toast.removeAll();
//    Materialize.toast('Please enter Choice', 4000);
//    return false;
//    }
//    if (choiceelement < 2) {
//    Materialize.Toast.removeAll();
//    Materialize.toast('Please enter atleast two choices', 4000);
//    return false;
//    }     }

//    function checkArray(my_arr) {
//    var count = 0;
//    for (var i = 0; i < my_arr.length; i++) {
//    if (my_arr[i] != "")
//            count++;
//    }
//    return count;
//    }

    function readURL(input) {
    
    if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
    //$('#falseinput').attr('src', e.target.result);
    //$('#base').val(e.target.result);
    $("#imgPrime").attr("src", e.target.result);
    $('#imgPrime').css('display', 'block');
    $('.dz-preview').remove(); $('#removethumb').css('display', 'block');
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
    });</script>
<script>
    var getDateString = function (date, format) {

            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            getPaddedComp = function (comp) {
                    return ((parseInt(comp) < 10) ? ('0' + comp) : comp)
                    },             formattedDate = format,
            o = {
                    "y+": date.getFullYear(), // year
                    "M+": months[date.getMonth()], //month
                            "d+": getPaddedComp(date.getDate()), //day
                            "h+": getPaddedComp((date.getHours() > 12) ? date.getHours() % 12 : date.getHours()), //hour
                            "H+": getPaddedComp(date.getHours()), //hour
                            "m+": getPaddedComp(date.getMinutes()), //minute
                            "s+": getPaddedComp(date.getSeconds()), //second
                            "S+": getPaddedComp(date.getMilliseconds()), //millisecond,
            "b+" :  (date.getHours() >= 12) ? 'PM' : 'AM'
            };
    for (var k in o) {
            if (new RegExp("(" + k + ")").test(format)) {
            formattedDate = formattedDate.replace(RegExp.$1, o[k]);
    }
    }
    return formattedDate;
    };
    $("#mobtabcategories").on('change', function () {
    var selectedCategory = $(this).val();
    //console.log(selectedCategory);
    //window.location.href=selectedCategory;
    window.location.assign(selectedCategory);
    window.location.reload();
    });
    $(document).on('click', '#tabs-swipe-demo.tabs > li > a', function (e) {
    var id = $(this).attr("href");
    var categoryid = $(this).attr('data-catid');
    var type = $(this).attr('data-type');
    if (typeof (id) != "undefined") {
    id = id.substr(1);
    var pageno = 0;
    var tendpage = 0;
    if (id == "elecpoll") {
    $('input[name="pollcatergory"][value="1"]').prop('checked', true);
        history.pushState(null, null, '?ct=Governance');
        $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=gov');
        $(".head-login").attr("href", '<?= base_url() ?>Login?section=poll&p=gov');
        pageno = $('.loadmorepage[data-category="Governance"]').attr('data-pageid');
    
    } else  if (id == "stockpoll") {
    $('input[name="pollcatergory"][value="2"]').prop('checked', true);
        history.pushState(null, null, '?ct=Money');
        $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=mon');
        $(".head-login").attr("href", '<?= base_url() ?>Login?section=poll&p=mon');
        pageno = $('.loadmorepage[data-category="Money"]').attr('data-pageid');
    
    } else if (id == "sportpoll") {
    $('input[name="pollcatergory"][value="3"]').prop('checked', true);
    history.pushState(null, null, '?ct=Sports');
        $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=spo');
        $(".head-login").attr("href", '<?= base_url() ?>Login?section=poll&p=spo');
        pageno = $('.loadmorepage[data-category="Sports"]').attr('data-pageid');
    
    } else if (id == "moviepoll") {
    $('input[name="pollcatergory"][value="4"]').prop('checked', true);
    history.pushState(null, null, '?ct=Entertainment');
        
        $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=ent');
        $(".head-log i n").attr("href", '<?= base_url() ?>Login?section=poll&p=ent');
        pageno = $('.loadmorepage[data-category="Entertainment"]').attr('data-pageid');
    } else {
        history.pushState(null, null, '?ct=Governance');
        $('#redirecturl').val('<?= base_url() ?>Login?section=poll');
        $(".head-login").attr("href", '<?= base_url() ?>Login?section=poll');
        pageno = $('.loadmorepage[data-category="Governance"]').attr('data-pageid');
    }
    
        if (typeof (pageno) == "undefined"){
            pageno = 0;
        }
        tendpage=0;
            loaddatafortrending(categoryid, tendpage, type)

        if (parseInt(pageno) < 1){
        loaddatafortab(categoryid, pageno, type)
        }

    }
    });
    
    $(document).on('click', '.addmorechoice', function (e) {
    //alert("one row added");
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

    //$(this).addClass("shown")
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
    $('.choice .removechoice').removeClass('hide');
    }
    } else {
    $('.choice .removechoice').addClass('hide');
    //$('.choice:first-child .removechoice').css('display', 'none');
    Materialize.Toast.removeAll();
    Materialize.toast('Minimum two options should be there', 4000);
    }
    });
    //    $(document).on('click', '.with-gap', function (e) {
    //        $('.with-gap').closest('.card').addClass('votedpoll');
    //        //$(this).closest('.btgray').addClass('activepollop');
//    });

$(document).on('click', '.pollbtnvote', function (e) {
    var pollid = $(this).attr('data-pollid'); 
    var section = $(this).attr('data-type');
    var categoryid = $(this).attr('data-catid');
    var userchoice = $("input[name='pollchoice" + section + "_" + pollid + "']:checked").val();
    <?php
        if (empty($this->session->userdata('data'))) {
    ?>
            localStorage.pollid = pollid;
            localStorage.choiseid = userchoice;
            localStorage.categoryid = categoryid;
            localStorage.section = section;
    <?php
        }
    ?>

    if ($("input[name='pollchoice" + section + "_" + pollid + "']").is(":checked")) {
        <?php
        if (empty($this->session->userdata('data'))) {
        ?>
            var redirecturl = $('#redirecturl').val();
            redirecturl = redirecturl + "&t=2&pid=" + pollid;
            window.location.assign(redirecturl);
        <?php
        }
        ?>


            $.ajax({
            "url": "<?= base_url() ?>Survey/addpollchoice",
                    "method": "POST",
            "data": {"poll_id": pollid, "choice": userchoice, "category_id": categoryid}
            }).done(function (result) {
            result = JSON.parse(result);

            if (result['status'])
            {

            $('.polloption_' + pollid).each(function () {
            var html = "";
            var tabname = $(this).attr('data-tabname');
            for (var i in result['data']['options']) {
                    var isvoted = result['data']['options'][i]['choice_id'] == userchoice ? "checked" : "";

            var totalavg = result['data']['options'][i]['choice'] != "See the Results" ? '<span class="avgpercount fs14px">' + result['data']['options'][i]['avg'] + ' %</span>' : "";
            var userselected = result['data']['options'][i]['choice_id'] == userchoice ? "userselected" : ""; var isnoclickchoice = result['data']['options'][i]['choice'] == "See the Results" ? "fw600" : "";
            html += '<div class = "col m12 s12">\
                                                <div class = "row mb7">\
                                                    <div class="col m12 s12">\
                                                        <label class = "polloption progress" style="position: relative;">\
                                                            <input class = "with-gap" class="pollchoice_' + pollid + '" name = "pollchoice' + tabname + '_' + pollid + '" data-type="' + tabname + '" data-total="' + result['data']['options'][i]['total'] + '" type = "radio" value="' + result['data']['options'][i]['choice_id'] + '" ' + isvoted + '/>\
                                                            <span class="customradio">\
                                                                <i class="flaticon-check selected"></i>\
                                                            </span>\
                                                            <span class="fs14px choicetext">' + (result['data']['options'][i]['choice'] == "Do not know or skip" || result['data']['options'][i]['choice'].toLowerCase() == "see the results" ? "<b>See The Results</b>" : result['data']['options'][i]['choice']) + '</span><!--style="position:absolute;" -->\
                                                            <div class = "determinate ' + userselected + '" style = "width: 0%" data-afterload="' + result['data']['options'][i]['avg'] + '"></div>\
                                                            ' + totalavg + '\
                                                        </label>\
                                                    </div>\
                                                </div>\
                                            </div>';
        //                            html += '<div class = "col m6 s12">\
        //                                    <div class = "row mb0">\
        //                                        <div class="col m1 s2">\
        //                                            <label>\
        //                                                <input class = "with-gap" class="pollchoice_' + pollid + '" name = "pollchoice' + tabname + '_' + pollid + '" data-type="' + tabname + '" data-total="' + result['data']['options'][i]['total'] + '" type = "radio" value="' + result['data']['options'][i]['choice_id'] + '" ' + isvoted + '/>\
        //                                                <span class="customradio"></span>\
        //                                            </label>\
        //                                        </div>\
        //                                        <div class = "col m11 s10">\
        //                                            <div class = "row mb0">\
        //                                                <div class = "col m12 s12 tastart"><h6 class="fs15px tastart mtb3 multiline-ellipsis">' + result['data']['options'][i]['choice'] + '</h6></div>\
        //                                            </div>\
        //                                            <div class = "row mb10">\
        //                                                <div class = "col m10 s9">\
        //                                                    <div class = "polloption progress">\
        //                                                        <div class = "determinate" style = "width: 0%" data-afterload="' + result['data']['options'][i]['avg'] + '"></div>\
        //                                                    </div>\
        //                                                </div>\
        //                                                <div class = "col m2 s3"><label class = "votepergain fs10px">' + result['data']['options'][i]['avg'] + '%</label></div>\
        //                                            </div>\
        //                                        </div>\
        //                                    </div>\
        //                                </div>';
                                }

                                $("#polloption" + tabname + "_" + pollid).html(html);
                                $("#polloption" + tabname + "_" + pollid).addClass('votedpoll');
                                $(".votedpoll input[type='radio']").attr('disabled', true);

                                setTimeout(function () {
                                    $("#polloption" + tabname + "_" + pollid + " .determinate").each(function () {
                                        var newper = $(this).attr('data-afterload');
                                        $(this).css('width', newper + '%');
                                    });
                                }, 100)

                            });

                            $('input[name ^=pollchoice][name $=' + pollid + '][value=' + userchoice + ']').attr('checked', true);
                            console.log(result['data']['total_votes']);
                            
                            var changebtn = '<span class="votescountbox mr20">\
                                                <span class="flaticon-click ml0 mr5"></span>\
                                                <span class="fs14px fw500">' + result['data']['total_votes'] + '  Votes</span>\
                                            </span>';
                            $('button[data-pollid="' + pollid + '"].pollbtnvote').parent().prepend(changebtn);
                            $('button[data-pollid="' + pollid + '"].pollbtnvote').remove();
                            $('#togglecmtsec_' + section + '_' + pollid).slideDown('slow');
                            loaddatafortrending(0,0);
                            loaddataformyraised(0,0);
                            //$('#pointsModal').addClass('small');
                            if(result['isnew']==1){
                                $('#pointsModal #title').html('Congratulations');
                                $('#pointsModal #points').html('1');
                                $('#pointsModal #msg').html("You earned 1 Silver point");
                                $('#pointsModal #submsg').html("");
                                $('#pointsModal .optionsbtn').css('display', 'none');
                                $('#pointsModal').modal('open');

                                setTimeout(function () {
                                    $('#pointsModal').modal('close');
                                }, 3000)
                            }

        //                    Materialize.Toast.removeAll();
        //                    Materialize.toast(result['message'], 4000);
                        }
                    });

        } else {
            Materialize.Toast.removeAll();
            Materialize.toast('Please select choice', 4000);
        }        
    });

    $(function () {
        var pollid = localStorage.pollid;
        var userchoice = localStorage.choiseid;
        var categoryid = localStorage.categoryid;
        var section = localStorage.section;
        if (typeof (localStorage.pollid) != "undefined" && typeof (localStorage.choiseid) != "undefined" && typeof (localStorage.categoryid) != "categoryid") {
            $.ajax({
                "url": "<?= base_url() ?>Survey/addpollchoice",
                "method": "POST",
                "data": {"poll_id": pollid, "choice": userchoice, "category_id": categoryid}
            }).done(function (result) {
                result = JSON.parse(result);
                
                if (result['status'])
                {
                    localStorage.clear();
                    $('.polloption_' + pollid).each(function () {
                        var html = "";
                        var tabname = $(this).attr('data-tabname');
                        for (var i in result['data']['options']) {
                            var isvoted = result['data']['options'][i]['choice_id'] == userchoice ? "checked" : "";
                            var totalavg = result['data']['options'][i]['choice'] != "See the Results" ? '<span class="avgpercount fs14px">' + result['data']['options'][i]['avg'] + ' %</span>' : "";
                            var userselected = result['data']['options'][i]['choice_id'] == userchoice ? "userselected" : "";
                            var isnoclickchoice = result['data']['options'][i]['choice'] == "See the Results" ? "fw600" : "";
                            html += '<div class = "col m12 s12">\
                                        <div class = "row mb7">\
                                            <div class="col m12 s12">\
                                                <label class = "polloption progress" style="position: relative;">\
                                                    <input class = "with-gap" class="pollchoice_' + pollid + '" name = "pollchoice' + tabname + '_' + pollid + '" data-type="' + tabname + '" data-total="' + result['data']['options'][i]['total'] + '" type = "radio" value="' + result['data']['options'][i]['choice_id'] + '" ' + isvoted + '/>\
                                                    <span class="customradio">\
                                                        <i class="flaticon-check selected"></i>\
                                                    </span>\
                                                    <span class="fs14px choicetext">' + (result['data']['options'][i]['choice'] == "Do not know or skip" || result['data']['options'][i]['choice'].toLowerCase() == "see the results" ? "<b>See The Results</b>" : result['data']['options'][i]['choice']) + '</span><!--style="position:absolute;" -->\
                                                    <div class = "determinate ' + userselected + '" style = "width: 0%" data-afterload="' + result['data']['options'][i]['avg'] + '"></div>\
                                                    ' + totalavg + '\
                                                </label>\
                                            </div>\
                                        </div>\
                                    </div>';
                        }
                        $("#polloption" + tabname + "_" + pollid).html(html);
                        $("#polloption" + tabname + "_" + pollid).addClass('votedpoll');
                        //$(".votedpoll input[type='radio']").attr('disabled', true);
                        
                        setTimeout(function () {
                            $("#polloption" + tabname + "_" + pollid + " .determinate").each(function () {
                                var newper = $(this).attr('data-afterload');
                                $(this).css('width', newper + '%');
                            });
                        }, 100)
                    });
                    var changebtn = '<span class="votescountbox mr20">\
                                        <span class="flaticon-click ml0 mr5"></span>\
                                        <span class="fs14px fw500">' + result['data']['total_votes'] + '  Votes</span>\
                                    </span>';
                    //$('button[data-pollid="' + pollid + '"].pollbtnvote').parent().prepend(changebtn);
                    //$('button[data-pollid="' + pollid + '"].pollbtnvote').remove();
                    $('#togglecmtsec_' + section + '_' + pollid).slideDown('slow');
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
            var poll_id = $(this).attr('data-pollid');
            var section = $(this).attr('data-section');

            var $this = $(this),
                    $tooltip = $this.find('.tooltip');
            //alert(poll_id);

            if (!$tooltip.hasClass('In')) {
                $('.tooltip').stop(true, true).fadeOut(500);
                $('.share_' + section + poll_id).fadeIn(100);
                $tooltip.addClass('In');
            } else {
                $tooltip.removeClass('In');
                $('.share_' + section + poll_id).stop(true, true).fadeOut(500);
            }
        }
    });
</script>
<script>
    
    $(".determinate").each(function () {
    var newper = $(this).attr('data-afterload');
    $(this).css('width', newper + '%');
    });
    setTimeout(function () {
        $(".votedpoll input[type='radio']").attr('disabled', true);
        }, 100)
    
    function share(url, _this) {
    if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {

    } else {
    if (navigator.share) {
    navigator.share({
    //title: 'Web Fundamentals',
    //text: 'Check out Web Fundamentals — it rocks!',
    url: url
    })
//                    .then(() = > console.log('Successful share'))
//                    .catch((error) = > console.log('Error sharing', error));
    }
    }
    

    }
//    $('.polllists .card').click(function (e) {
//        var redirectto = $(this).attr('data-clickredirect');

//        var classuserd = e.target.className;
//        var isValid = false;

//        if (classuserd.indexOf("share") != -1) {
//            isValid = true;
//        } else if (classuserd.indexOf("customradio") != -1) {
//            isValid = true;
//        } else if (classuserd.indexOf("with-gap") != -1) {
//            isValid = true;
//        } else if (classuserd.indexOf("readdescinfo") != -1) {
//            isValid = true;
//        } else {
//            isValid = false;
//        }

//        if (isValid || redirectto == "") {
//
//        } else {
//            //window.location.assign(redirectto);
//        }
//    });

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
    var poll_comment = $(this).val();
    var poll_id = $(this).attr('data-pollid');
    var poll_cmt_id = $(this).attr('data-cmtid');
    $.ajax({
    url: '<?= base_url() ?>Survey/add_comment',
            method: "POST",
            data: {poll_comment: poll_comment, poll_id: poll_id, poll_cmt_id: poll_cmt_id},
    }).done(function (result) {
<?php
if (empty($this->session->userdata('data'))) {
?>
        //                    window.location.assign("<?= base_url() ?>Login?section=poll");
        var redirecturl = $('#redirecturl').val();
        redirecturl = redirecturl + "&t=2&pid=" + poll_id;
        window.location.assign(redirecturl);
<?php
}
?>
    result = JSON.parse(result);
    if (result['status']) {
    $('.cmteditbox').removeClass('active');
//                    Materialize.Toast.removeAll();
//                    Materialize.toast("Comment updated Successfully", 4000);
    }
    });
    }
    })
            $(document).on('blur', '.commentedit', function (e) {

//    if ($(this).val() == "") {
//    var text = $(this).attr('value');

//    $(this).val(text);
//    }
//    $('.commentedit').css('height', '35px');
//    $('.commentedit').next().css('height', '35px');
//    $('.commentedit').closest('.cmteditbox').find('.whitespacepre').removeClass('hide');
//    $('.cmteditbox').removeClass('active');
//    $('.commentedit').parent().addClass('hide');
    })
    $('html').click(function (e) {
    var classused = e.target.className;
    
    if (!classused.indexOf(" share") != - 1){
    $('.tooltip').removeClass('In');
    $('.tooltip').stop(true, true).fadeOut(500);
    }
    if (classused.indexOf("material-icons prefix sendarrow") != - 1) {

    } else if (classused.indexOf("textareaicon1") != - 1) {
//
    } else if(classused.indexOf("commentedit") != - 1){
        
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
    var poll_comment = $("#cmt_" + cmt_id).val();
    var original_cmt = $("#cmt_" + cmt_id).val();
    var poll_id = $("#cmt_" + cmt_id).attr('data-pollid');
    var poll_cmt_id = $("#cmt_" + cmt_id).attr('data-cmtid');
    
    if (poll_comment == "") {
    Materialize.Toast.removeAll();
    Materialize.toast("Please enter your comment", 4000);
    }
    
    $.ajax({
    url: '<?= base_url() ?>Survey/add_comment',
            method: "POST",
            data: {poll_comment: poll_comment, poll_id: poll_id, poll_cmt_id: poll_cmt_id},
    }).done(function (result) {
<?php
if (empty($this->session->userdata('data'))) {
?>
        //window.location.assign("<?= base_url() ?>Login?section=poll");
        var redirecturl = $('#redirecturl').val();
        redirecturl = redirecturl + "&t=2&pid=" + poll_id;
        window.location.assign(redirecturl);
<?php
}
?>
    result = JSON.parse(result);
    if (result['status']) {
    $('#cmt_' + poll_cmt_id).attr('data-value', poll_comment)
            $('.cmteditbox').removeClass('active');
//                Materialize.Toast.removeAll();
//                Materialize.toast("Comment updated Successfully", 4000);
    }
    });
    });
    $(document).on('click', '.sendarrow', function (e) {
    var cmt_id = $(this).parent().attr('data-cmtid');
    var poll_comment = $("#cmt_" + cmt_id).val();
    var original_cmt = $("#cmt_" + cmt_id).val();
    var poll_id = $("#cmt_" + cmt_id).attr('data-pollid');
    var poll_cmt_id = $("#cmt_" + cmt_id).attr('data-cmtid');
    
    if (poll_comment == "") {
    Materialize.Toast.removeAll();
    Materialize.toast("Please enter your comment", 4000);
    }


    
    $.ajax({
    url: '<?= base_url() ?>Survey/add_comment',
            method: "POST",
            data: {poll_comment: poll_comment, poll_id: poll_id, poll_cmt_id: poll_cmt_id},
    }).done(function (result) {
<?php
if (empty($this->session->userdata('data'))) {
?>
        //window.location.assign("<?= base_url() ?>Login?section=poll");
        var redirecturl = $('#redirecturl').val();
        redirecturl = redirecturl + "&t=2&pid=" + poll_id;
        window.location.assign(redirecturl);
<?php
}
?>
    result = JSON.parse(result);
    if (result['status']) {
    $('#cmt_' + poll_cmt_id).attr('data-value', poll_comment);
    var height = $('#cmt_' + cmt_id).closest('.cmteditbox').find('p').height();
    $('#cmt_' + cmt_id).closest('.cmteditbox').find('.whitespacepre').html(poll_comment);
    $('#cmt_' + cmt_id).closest('.cmteditbox').find('.whitespacepre').toggleClass('hide');
    $('#cmt_' + cmt_id).css('height', height);
    $('#cmt_' + cmt_id).next().css('height', height);
    $('.cmteditbox').removeClass('active');
    $('#cmt_' + poll_cmt_id).parent().toggleClass('hide');
//                Materialize.Toast.removeAll();
//                Materialize.toast("Comment updated Successfully", 4000);
    }
    });
    });
    function showcommentsec(id, type)
    {
    $('#togglecmtsec_' + type + '_' + id).slideToggle('slow');
    }


    $(document).on('click', '.showritecmt', function (e) {
    var poll_id = $(this).attr('data-pollid');
    var type = $(this).attr('data-section');
    var id = $(this).attr('data-pollid');
    $('#togglecmtsec_' + type + '_' + id).slideToggle('slow');
    });</script>

<script>

    $(document).on('click', '.showreplies,.showreplies_icon', function (e) {
    var pollid = $(this).attr('data-pollid');
    var commentid = $(this).attr('data-cmtid');
<?php
if (empty($this->session->userdata('data'))) {
?>
        //window.location.assign("<?= base_url() ?>Login");
        var redirecturl = $('#redirecturl').val();
        redirecturl = redirecturl + "&t=2&pid=" + pollid + "&cmt=" + commentid;
        window.location.assign(redirecturl);
<?php
} else {
?>

        var pagelimit = $(this).attr('data-replyset');
        var currentcontent = $('#replylist_' + commentid).text();
        var totalreply=$('.showreplies[data-cmtid="'+commentid+'"]').attr('data-totalreply');
        
        var totalshow=parseInt(pagelimit)+1;
        totalshow=parseInt(totalshow)*5;
        $.ajax({
        url: "<?php
    echo base_url();
?>Survey/get_comment_replies",
                method: "POST",
                data: {pollid: pollid, commentid: commentid, pagelimit: pagelimit},
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
                                                                        <input type="text" id="cmt_' + commentid + '" data-value="' + result['data'][i]['reply'] + '" data-pollid="' + pollid + '" data-cmtid="' + commentid + '" readonly="readonly" class="' + cmtedit + ' mb0" value="' + result['data'][i]['reply'] + '">\
                                                                        <span data-cmtid="' + commentid + '" class="material-icons prefix textareaicon1">send</span>\
                                                                    </div>\
                                                                </div>';
        html += '<hr class="commentseprator">';
        }
        if(totalreply>totalshow){
            html += '<a class="morereplies fs12px fw500 lightgray" data-replyset="' + (parseInt(pagelimit) + 1) + '" data-pollid="' + pollid + '" data-cmtid="' + commentid + '">view more replies</a>';
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
    var pollid = $(this).attr('data-pollid');
    var commentid = $(this).attr('data-cmtid');
    var pagelimit = $(this).attr('data-replyset');
    $('.replies' + commentid + ' .morereplies').remove();
    
    var totalreply=$('.showreplies[data-cmtid="'+commentid+'"]').attr('data-totalreply');
    var totalshow=parseInt(pagelimit)+1;
    totalshow=parseInt(totalshow)*5;
    $.ajax({
    url: "<?php
echo base_url();
?>Survey/get_comment_replies",
            method: "POST",
            data: {pollid: pollid, commentid: commentid, pagelimit: pagelimit},
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
                                        <input type="text" data-value="' + result['data'][i]['reply'] + '" id="cmt_' + commentid + '" data-pollid="' + pollid + '" data-cmtid="' + commentid + '" readonly="readonly" class="' + cmtedit + ' mb0" value="' + result['data'][i]['reply'] + '">\
                                        <span data-cmtid="' + commentid + '" class="material-icons prefix textareaicon1">send</span>\
                                    </div>\n\
                                </div>';
    html += '<hr class="commentseprator">';
    }
    
    if(totalreply>totalshow){
        html += '<a class="morereplies fs12px fw500 lightgray" data-replyset="' + (parseInt(pagelimit) + 1) + '" data-pollid="' + pollid + '" data-cmtid="' + commentid + '">view more replies</a>';
    }
    
    $('#replylist_' + commentid).append(html);
    //$('.replies' + commentid).slideToggle();
    }
    //$('.replies' + commentid).slideToggle();
    });
    });</script>

<script>
    $(document).on('click', '.loadmore', function (e) {

    var loadlimit = $(this).attr('data-pageid');
    var poll_id = $(this).attr('data-pollid');
    var type = $(this).attr('data-sectype');
    var total_comments = $(this).attr('data-totalcomments');
    //var endDate = new Date(Date.parse($(this).attr('data-enddate')));
<?php
if (empty($this->session->userdata('data'))) {
?>
        var redirecturl = $('#redirecturl').val();
        redirecturl = redirecturl + "&t=2&pid=" + poll_id
                window.location.assign(redirecturl);
<?php
} else {
?>
        $.ajax({
        url: "<?php
    echo base_url();
?>Survey/load_more_comments",
                method: "POST",
                data: {pollid: poll_id, pagelimit: loadlimit},
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
//        if (endDate <= TodayDate) {
//        editcmts = true;
//        // throw error here..
//        }
        var iscmtedit = "";
        
        if (result['data'][i]['user_id'] ==<?= $user_info['uid']; ?> && editcmts) {
        var iscmtedit = result['data'][i]['user_id'] ==<?= $user_info['uid']; ?> ? "commentedit" : "";
        cmtedit = '<a materialize="dropdown" class="dropdown-button pollubhead right" data-activates="mypollcmt' + result['data'][i]['id'] + '">\
                                                                            <i class="flaticon-three-1 lightgray is20px"></i>\
                                                                        </a>\
                                                                        <ul id="mypollcmt' + result['data'][i]['id'] + '" class="dropdown-content mpcmt">\
                                                                            <li>\
                                                                                <a class="fs16px editcmt" data-cmtid="' + result['data'][i]['id'] + '" data-cmttxt="' + result['data'][i]['comment'] + '" >Edit</a>\
                                                                            </li>\
                                                                            <li>\
                                                                                <a class="fs16px deletecmt" data-cmtid="' + result['data'][i]['id'] + '">Delete</a>\
                                                                            </li>\
                                                                        </ul>';
        }
        if (editcmts){
        postreply = '<form id="postpollcommentrply" method="POST">\
                                                    <div class="col m12 s12">\
                                                        <div style="position:relative">\
                                                            <textarea type="text" id="textarea1" class="writereply textarea-scrollbar" data-autoresize name="poll_comment_reply" placeholder="Write a reply"></textarea>\
                                                            <span onclick="$(this).submit()" class="textareaicon"><span class="material-icons prefix sendarrowreply">send</span></span>\
                                                            <input type="hidden" name="poll_id" value="' + result['data'][i]['poll_id'] + '"/>\
                                                            <input type="hidden" name="comment_id" value="' + result['data'][i]['id'] + '"/>\
                                                        </div>\
                                                    </div>\
                                                </form>';
        }

        var isuserlike = result['data'][i]['userlike'] == 0 ? "like.png" : "like1.png";
        var formattedDate = getDateString(new Date(result['data'][i]['created_date'].replace(' ', 'T')), "d M y")
        var replyword=parseInt(result['data'][i]['total_replies'])>1?" Replies":" Reply";
                html += '<div class="col s12">\
                                                                    <div class="commentsection" id="cm_' + result['data'][i]['id'] + '">\
                                                                        <div class="pollcardlist p-0">\
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
                                                                                        <textarea type="text" data-autoresize rows="1" id="cmt_' + result['data'][i]['id'] + '" data-value="' + result['data'][i]['comment'] + '" data-pollid="' + poll_id + '" data-cmtid="' + result['data'][i]['id'] + '" readonly class="' + iscmtedit + ' mb0 textarea-scrollbar">' + result['data'][i]['comment'] + '</textarea>\
                                                                                        <span data-cmtid="' + result['data'][i]['id'] + '" class="textareaicon1"><span class="material-icons prefix sendarrow">send</span></span>\
                                                                                    </div>\
                                                                                </div>\
                                                                                <div class="row txtbluegray cmtop mb0">\
                                                                                    <div class="col m7 s7"><h6 class="fs12px linkpointer showreplies_icon fs12px fw500 lightgray" data-cmtid="' + result['data'][i]['id'] + '" data-pollid="' + result['data'][i]['poll_id'] + '" data-replyset="0"><i class="flaticon-arrow-1 lightgray"></i>Reply</h6></div>\
                                                                                    <div class="col m5 s5 right right-align">\
                                                                                        <span class="mr10 lightgray fs12px fw500 linkpointer showreplies" data-cmtid="' + result['data'][i]['id'] + '" data-pollid="' + result['data'][i]['poll_id'] + '" data-replyset="0" data-totalreply="' + result['data'][i]['total_replies'] + '">' + result['data'][i]['total_replies'] + ' '+replyword+'</span>\
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
        $('#togglecmtsec_' + type + '_' + poll_id + ' .commentbox').append(html);
        var newtotalcmts = $('#togglecmtsec_' + type + '_' + poll_id + ' .commentbox .commentsection').length;
        
        if ((parseInt(newtotalcmts) + 1) <= total_comments) {
        $('#togglecmtsec_' + type + '_' + poll_id + ' .loadmore').attr('data-pageid', parseInt(loadlimit) + 1);
        } else {
        $('#togglecmtsec_' + type + '_' + poll_id + ' .loadmore').css('display', 'none');
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
        //                    Materialize.Toast.removeAll();
        //                    Materialize.toast("No more comments", 4000);
        //                    return false;
        flag = 1;
        }
        });
        //}
<?php
}
?>
    });
    
$(document).on('submit','form[name="postpollcmt"]',function(e){
        e.preventDefault();
        e.stopPropagation();
        //$('.loadersmall').css('display', 'block');
        var poll_id = $('#postpollcomment input[name="poll_id"]').val();
        var redirecturl = $('#redirecturl').val();
        redirecturl = redirecturl + "&t=2&pid=" + poll_id;

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
                        
        //                Materialize.Toast.removeAll();
        //                Materialize.toast(result['message'], 4000);
                        var html = "";
                        
                        var isuserlike = result['data']['userlike'] == 0 ? "like.png" : "like1.png";
                        var formattedDate = getDateString(new Date(result['data']['created_date'].replace(' ', 'T')), "d M y")
                        var replyby = result['data']['user_id'] ==<?= $user_info['uid']; ?> ? "You" : result['data']['byuser'];
                        var iscmtedit = result['data']['user_id'] ==<?= $user_info['uid']; ?> ? "commentedit" : "";
                        var cmtedit = "";
                        if (result['data']['user_id'] ==<?= $user_info['uid']; ?>) {
                            cmtedit = '<a materialize="dropdown" class="dropdown-button1 pollubhead right" id="cmtdrop_' + result['data']['id'] + '" data-activates="mypollcmt' + result['data']['id'] + '">\
                                                            <i class="flaticon-three-1 lightgray is20px"></i>\
                                                        </a>\
                                                        <ul id="mypollcmt' + result['data']['id'] + '" class="dropdown-content mpcmt">\
                                                            <li>\
                                                                <a class="fs16px editcmt" data-cmtid="' + result['data']['id'] + '" data-cmttxt="' + result['data']['comment'] + '" >Edit</a>\
                                                            </li>\
                                                            <li>\
                                                                <a class="fs16px deletecmt" data-cmtid="' + result['data']['id'] + '">Delete</a>\
                                                            </li>\
                                                        </ul>';
        //                    cmtedit = '<a materialize="dropdown" class="dropdown-button pollubhead right " data-activates="mypollcmt' + result['data']['id'] + '">\
        //                                                    <i class="flaticon-three-1  lightgray is20px"></i>\
        //                                                </a>\
        //                                                <ul id="mypollcmt' + result['data']['id'] + '" class="dropdown-content mpcmt">\
        //                                                    <li>\
        //                                                        <a class="fs16px editcmt" data-cmtid="' + result['data']['id'] + '" data-cmttxt="' + result['data']['comment'] + '" >Edit</a>\
        //                                                    </li>\
        //                                                    <li>\
        //                                                        <a class="fs16px deletecmt" data-cmtid="' + result['data']['id'] + '">Delete</a>\
        //                                                    </li>\
        //                                                </ul>';
                        }
                        var replyword=parseInt(result['data']['total_replies'])>1?" Replies":" Reply";
                        html = '<div class="col s12">\
                                            <div class="commentsection" id="cm_' + result['data']['id'] + '">\
                                                <div class="pollcardlist p-0">\
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
                                                                <textarea type="text" data-autoresize rows="1" id="cmt_' + result['data']['id'] + '" data-value="' + result['data']['comment'] + '" data-pollid="' + poll_id + '" data-cmtid="' + result['data']['id'] + '" readonly class="' + iscmtedit + ' mb0 textarea-scrollbar">' + result['data']['comment'] + '</textarea>\
                                                                <span data-cmtid="' + result['data']['id'] + '" class="textareaicon1"><span class="material-icons prefix sendarrow">send</span></span>\
                                                            </div>\
                                                        </div>\
                                                        <div class="row txtbluegray cmtop mb0">\
                                                            <div class="col m7 s7"><h6 class="fs12px linkpointer showreplies_icon fs12px fw500 lightgray" data-cmtid="' + result['data']['id'] + '" data-pollid="' + result['data']['poll_id'] + '" data-replyset="0"><i class="flaticon-arrow-1 lightgray"></i>Reply</h6></div>\
                                                            <div class="col m5 s5 right right-align">\
                                                                <span class="mr10 lightgray fs12px fw500 linkpointer showreplies" data-cmtid="' + result['data']['id'] + '" data-pollid="' + result['data']['poll_id'] + '" data-replyset="0" data-totalreply="' + result['data']['total_replies'] + '">' + result['data']['total_replies'] + ' '+replyword+'</span>\
                                                            </div>\
                                                        </div>\
                                                        <div class="replies' + result['data']['id'] + '" style="display:none;">\
                                                            <div class="row m10">\
                                                                <form id="postpollcommentrply" method="POST">\
                                                                <div class="col m12 s12">\
                                                                    <div style="position:relative">\
                                                                        <textarea type="text" id="textarea1" class="writereply textarea-scrollbar" data-autoresize name="poll_comment_reply" placeholder="Write a reply"></textarea>\
                                                                        <span onclick="$(this).submit()" class="textareaicon"><span class="material-icons prefix sendarrowreply">send</span></span>\
                                                                        <input type="hidden" name="poll_id" value="' + result['data']['poll_id'] + '"/>\
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
                        $('[id^="togglecmtsec_"][id$="_' + result['data']['poll_id'] + '"] .commentbox').prepend(html);
                        $('textarea[name="poll_comment"]').val("");
                        $('textarea[name="poll_comment"]').css('height', '35px');
                        $('textarea[name="poll_comment"]').next().css('height', '35px');
                        var comments = $('.showcmtcount[data-pollid=' + result['data']['poll_id'] + ']').attr('data-totalcomments');
                        
                        if (parseInt(comments) == 0) {
                            $('[id^="togglecmtsec_"][id$="_' + result['data']['poll_id'] + '"] .nocmtdata').css('display', 'none');
                        }
                        var newcommentscount = parseInt(comments) + 1;
                        
                        $('.showcmtcount[data-pollid=' + result['data']['poll_id'] + ']').attr('data-totalcomments', newcommentscount);
                        var commentword=newcommentscount>1?"Comments":"Comment"
                        $('.showcmtcount[data-pollid=' + result['data']['poll_id'] + ']').html(newcommentscount + " "+commentword);//cmtbadge
                        //$('.showcmtcount[data-pollid=' + result['data']['poll_id'] + ']').html(newcommentscount + " Comments");//cmtbadge
                        $('.show-on-small .showritecmt[data-pollid=' + result['data']['poll_id'] + ']').html(commentword+"<span class='cmtbadge'>"+newcommentscount+"</span>");
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
        //                $('.mypollcmt' + result['data']['id'] + '').dropdown({
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
    $(document).on('submit', '#postpollcommentrply', function (e) {
    e.preventDefault();
    e.stopPropagation();
    var _this = $(this);
    var poll_id = $('#postpollcommentrply input[name="poll_id"]').val();
    var redirecturl = $('#redirecturl').val();
    redirecturl = redirecturl + "&t=2&pid=" + poll_id;
<?php
if (empty($this->session->userdata('data'))) {
?>
        window.location.assign(redirecturl);
<?php
} else {
?>
    <?php
    if (empty($user_info['alise'])) {
?>
            Materialize.Toast.removeAll();
            Materialize.toast('Please enter your alias first.', 2000);
            setTimeout(function () {
            var redirect_url = $("#redirecturl").val();
            var redirect_sess = redirect_url.split("?");
            window.location.href = '<?= base_url() ?>Profile?' + redirect_sess[1];
            }, 2000)
    <?php
    } else {
?>
            //$('.loadersmall').css('display', 'block');
            $.ajax({
            url: '<?php
        echo base_url();
?>Survey/add_comment_reply',
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
                                                                <input type="text" id="cmt_16" data-pollid="5" data-cmtid="' + result['data']['comment_id'] + '" readonly="readonly" class="mb0" value="' + result['data']['reply'] + '">\
                                                                <span data-cmtid="16" class="material-icons prefix textareaicon1">send</span>\
                                                            </div>\
                                                        </div><hr class="commentseprator">';
            $('#replylist_' + result['data']['comment_id']).prepend(html);
            //$('#postpollcommentrply')[0].reset();
            $('Form#postpollcommentrply').trigger("reset");
            var currentreplies = $('.showreplies[data-cmtid=' + result['data']['comment_id'] + ']').html();
            $('.writereply').css('height', '35px');
            $('.writereply').next().css('height', '35px');
            totalreply=parseInt(currentreplies) + 1;
            var replyword=totalreply>1?"Replies":"Reply";        
            $('.showreplies[data-cmtid=' + result['data']['comment_id'] + ']').html(totalreply+" "+replyword);
            } else {
            Materialize.Toast.removeAll();
            Materialize.toast(result['message'], 4000);
            }
            var cmt_id = result['data']['comment_id'];
            
            adv = Math.round($('#pollreact .commentbox').scrollTop() + $("#replylist_" + cmt_id + " > div:last").position().top) - 70;
            
            $('.commentbox').animate({
            scrollTop: adv
            }, 2000);
            });
    <?php
    }
?>
<?php
}
?>
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
    url: '<?= base_url() ?>Survey/deactivecmt',
            method: "POST",
            data: {comment: cmt_id},
    }).done(function (result) {

    result = JSON.parse(result);
    $('#pollreact .commentbox #cm_' + cmt_id).slideUp('slow');
    var commentsword=result['total']>1?"Comments":"Comment";
    $('.showcmtcount[data-pollid=' + result['ques_no'] + ']').html(result['total'] + ' '+ commentsword);
    
    $('.show-on-small .showritecmt[data-pollid="' + result['ques_no'] + '"]').html(commentsword+"<span class='cmtbadge'>"+result['total']+"</span>");
    
    $('.showcmtcount[data-pollid=' + result['ques_no'] + ']').attr('data-totalcomments',result['total']);
    var comments = $('.showcmtcount[data-pollid=' + result['ques_no'] + ']').attr('data-totalcomments');
    
    if (parseInt(comments) == 0) {
    $('[id^="togglecmtsec_"][id$="_' + result['data']['poll_id'] + '"] .nocmtdata').css('display', 'none');
    }
    var pageno = $('.loadmore[data-pollid=' + result['ques_no'] + ']').attr('data-pageid');
    if (parseInt(pageno) > 0) {
        console.log(result['total']);
        console.log(parseInt(pageno)*10);
        if (result['total'] >= parseInt(pageno)*10) {
            $('.loadmore[data-pollid=' + result['ques_no'] + ']').css('display', 'block');
        } else {
            $('.loadmore[data-pollid=' + result['ques_no'] + ']').css('display', 'none');
        }
    } else {
    if (result['total'] < 2) {
        $('.loadmore[data-pollid=' + result['ques_no'] + ']').css('display', 'none');
    }
    setTimeout(function () {
    var html = "";
    for (var i in result['data']) {
    var replyby = result['data'][i]['user_id'] ==<?= $user_info['uid']; ?> ? "You" : result['data'][i]['byuser'];
    var iscmtedit = result['data'][i]['user_id'] ==<?= $user_info['uid']; ?> ? "commentedit" : "";
    var cmtedit = "";
    if (result['data'][i]['user_id'] ==<?= $user_info['uid']; ?>) {
    cmtedit = '<a materialize="dropdown" class="dropdown-button pollubhead right" data-activates="mypollcmt' + result['data'][i]['id'] + '">\
                    <i class="flaticon-three-1 lightgray is20px"></i>\
                </a>\
                <ul id="mypollcmt' + result['data'][i]['id'] + '" class="dropdown-content mpcmt">\
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
    var replyword=parseInt(result['data'][i]['total_replies'])>1?" Replies":" Reply";
            html += '<div class="col s12">\
                                            <div class="commentsection" id="cm_' + result['data'][i]['id'] + '">\
                                                <div class="pollcardlist p-0">\
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
                                                                <textarea type="text" data-autoresize rows="1" id="cmt_' + result['data'][i]['id'] + '" data-value="' + result['data'][i]['comment'] + '" data-pollid="' + result['ques_no'] + '" data-cmtid="' + result['data'][i]['id'] + '" readonly class="' + iscmtedit + ' mb0 textarea-scrollbar">' + result['data'][i]['comment'] + '</textarea>\
                                                                <span data-cmtid="' + result['data'][i]['id'] + '" class="textareaicon1"><span class="material-icons prefix sendarrow">send</span></span>\
                                                            </div>\
                                                        </div>\
                                                        <div class="row txtbluegray cmtop mb0">\
                                                            <div class="col m7 s7"><h6 class="fs12px linkpointer showreplies_icon fs12px fw500 lightgray" data-cmtid="' + result['data'][i]['id'] + '" data-pollid="' + result['data'][i]['poll_id'] + '"><i class="flaticon-arrow-1 lightgray"></i>Reply</h6></div>\
                                                            <div class="col m5 s5 right right-align">\
                                                                <span class="mr10 lightgray fs12px fw500 linkpointer showreplies" data-cmtid="' + result['data'][i]['id'] + '" data-pollid="' + result['data'][i]['poll_id'] + '" data-replyset="0" data-totalreply="' + result['data'][i]['total_replies'] + '">' + result['data'][i]['total_replies'] + ' '+replyword+'</span>\
                                                            </div>\
                                                        </div>\
                                                        <div class="replies' + result['data'][i]['id'] + '" style="display:none;">\
                                                            <div class="row m10">\
                                                            <form id="postpollcommentrply" method="POST">\
                                                                <div class="col m12 s12">\
                                                                    <div style="position:relative">\
                                                                        <textarea type="text" id="textarea1" class="writereply textarea-scrollbar" data-autoresize name="poll_comment_reply" placeholder="Write a reply"></textarea>\
                                                                        <span onclick="$(this).submit()" class="textareaicon"><span class="material-icons prefix sendarrowreply">send</span></span>\
                                                                        <input type="hidden" name="poll_id" value="' + result['data'][i]['poll_id'] + '"/>\
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
    $(document).on('click', '#editpoll', function (e) {
    $('.slide-on-mobile').slideDown('slow');
    var pollid = $(this).attr('data-pollid');
    var data = $(this).attr('data-rowjson');
    data = JSON.parse(data);
    $("#pollcatergory input[value=" + data['category_id'] + "]").attr('checked', true);
    $('#polldescription').val(data['description']);
    $('#poll_id').val(pollid);
    $('#polltopic').val(data['question']);
    $('#detailurl').val(data['url']);
    var choiceid = data['choice_id'];
    var choice = data['choice'];
    var html = "";
    var choiceidarr = choiceid.split(',');
    var choicearr = choice.split(',');
    //var dbDate = data['end_date'];
    
    //var date2=getDateString(new Date(data['end_date'].replace(' ', 'T')), "d M y");
    //$('#enddate').datepicker('setDate', date2);
    for (var i = 0; i < choiceidarr.length - 2; i++)
    {

    var ishown = i == choiceidarr.length - 1 ? "" : "shown";
    if (i > 9) {
    break;
    }
    html += '<div class="row choice mb10">\
                        <div class="col s11">\
                            <input type="text" name="choice[]" maxlength="35" placeholder="Enter your choice here" value="' + choicearr[i] + '" class="' + ishown + '"/>\
                        </div>\
                        <div class="col s1 no-padding">\
                            <i class="flaticon-plus addmorechoice"></i>\
                            <i class="flaticon-delete removechoice"></i>\
                        </div>\
                    </div>';
    }
   console.log(html);
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
    var pollid = $(this).attr('data-pollid');
    $('#confirmdelete .yes').attr('data-pollid', pollid);
    //alert("hello");
    });
    $(document).on('click', '.yes', function (e) {
    var pollid = $(this).attr('data-pollid');
    $.ajax({
    url: '<?php
echo base_url();
?>Survey/deactive_poll',
            method: "POST",
            data: {pollid: pollid},
    }).done(function (result) {
    
    result = JSON.parse(result);
    
    if (result['status']) {
    Materialize.Toast.removeAll();
    Materialize.toast(result['message'], 4000);
    $('#card_' + pollid).slideUp('slow');
    $('#confirmdelete').modal('close');
    
    var categoryid=$('#tabs-swipe-demo>li>a.active').attr('data-catid');
    loaddatafortrending(0,0);
    loaddataformyraised(0,0);

//                setTimeout(function () {
//                    window.location.assign("<?= base_url() ?>Poll");
//                }, 2000)
    }
    });
    });</script>

<script>
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
    $(document).on('keypress', '#polltopic,.choice input', function (e) {
    if (e.which == 13) {
    e.preventDefault();
    }
    })
//$(function () {
//    $('.mypagination').each(function(){
//        var _this=$(this);
//        var total=$(this).attr('data-total');
//        var category_id=1;
//        $('.mypagination').pagination({
//        items: total,
//        itemsOnPage: 2,
//        displayedPages: 3,
//        currentPage: "1",
//        cssStyle: 'light-theme',
//        onPageClick:function(pageNumber,event){
////          alert(_this.attr('data-total'));
//             $.ajax({
//                 url: '<?php
echo base_url();
?>Poll/load_more_polls',
//                method: "POST",
//                data: {offset: pageNumber,type:category_id},
//             }).done(function(res){
//                 
//             });
//        }
//    });
//    })
//    
//});
//  $('.tooltip .twitter').each(function(){
//      var url=$(this).attr('data-url');
//      var poll=$(this).attr('data-title');
//      url=encodeURIComponent(url);
//      $(this).attr('href','https://twitter.com/intent/tweet?url='+url+'&ael;text="'+poll+'"&ael;hashtags=Crowdwisdom');
//  });

            jQuery.fn.putCursorAtEnd = function() {
            return this.each(function() {
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
            setTimeout(function() {
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
                .on("focus", function() { // could be on any event
                searchInput.putCursorAtEnd()
            });
            
    </script>
<script>
    function loaddatafortrending(categoryid, pageno)
    {
        
    $.ajax({
    url: '<?php echo base_url();?>Survey/loadmoretrending',
            method: "POST",
            data: {categoryid: categoryid, pageno:pageno},
    }).done(function (result) {
    
    result = JSON.parse(result);
    var html = "";
    
    if (result['status']) {
        $('.loadmoretrending').remove();
    
    var catname="";
    if(categoryid=="1"){
       catname="Governance"; 
    } else if(categoryid=="2"){
       catname="Money"; 
    } else if(categoryid=="3"){
        catname="Sports";
    } else if(categoryid=="4"){
        catname="Entertainment";
    } else {
        catname="Governance"; 
    }
    for (var i in result['data']){
    html += '<div class="blogs p15_20">\
                <div class="row">\
                    <a href="<?= base_url() ?>Survey?pid='+result['data'][i]['id']+'">\
                        <div class="col s12">\
                            <div class="blog-title truncate">' + result['data'][i]['question'] + '</div>\
                            <!--<div class="left fs11px fw600 blog-details mt10 text-upper category-display category ' + result['data'][i]['category_name'] + '">' + result['data'][i]['category_name'] + '</div>.toLowerCase()-->\
                            <div class="right blog-details lightgray">\
                                <i class="lightgray flaticon-click ml0"></i>\
                                <span class="lightgray fs12px">' + result['data'][i]['total_votes'] + ' Votes</span></div>\
                        </div>\
                    </a>\
                </div>\
            </div>';
    }
    html+='<div class="loadmoretrending" data-page="'+(parseInt(pageno)+1)+'" data-catid="'+categoryid+'"></div>';
    
        if(parseInt(pageno)<1){
            $('.trend .bindtrend').html(html);
        } else {
            $('.trend .bindtrend').append(html);
        }
        
    } 
    });
    }
    function loaddataformyraised(categoryid, pageno)
    {
        console.log(categoryid);
        console.log(pageno);
    $.ajax({
    url: '<?php echo base_url();?>Survey/loadmoremyraised',
            method: "POST",
            data: {categoryid: categoryid, pageno:pageno},
    }).done(function (result) {
    
    result = JSON.parse(result);
    var html = "";
    if (result['status']) {
        $('.loadmoremyraised').remove();
    
    var catname="";
    if(categoryid=="1"){
       catname="Governance"; 
    } else if(categoryid=="2"){
       catname="Money"; 
    } else if(categoryid=="3"){
        catname="Sports";
    } else if(categoryid=="4"){
        catname="Entertainment";
    } else {
        catname="Governance"; 
    }
    for (var i in result['data']){
    html += '<div class="blogs p15_20">\
                <div class="row">\
                    <a href="<?= base_url() ?>Survey?pid='+result['data'][i]['id']+'">\
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
    html+='<div class="loadmoremyraised" data-page="'+(parseInt(pageno)+1)+'" data-catid="myraised"></div>';
    //console.log(html);
        if(parseInt(pageno)<1){
            $('.myraised .bindraised').html(html)
        } else {
            $('.myraised .bindraised').append(html)
        }
        
    } else {
        //$('.loaddataformyraised').remove();
    }
    });
    }
    function loaddatafortab(categoryid, pageno, type)
    {
        var pollid = getUrlVars()["pid"];
        $('.loadersmall').css('display','block');
            $.ajax({
            url: '<?php echo base_url();?>Survey/loadmorepolldata',
                    method: "POST",
                    data: {categoryid: categoryid, pageno:pageno, type:type,pollid:pollid},
            }).done(function (result) {
    //console.log(result);
        if (parseInt(categoryid) == 1){
        $('#elecpoll').append(result);
        } else if (parseInt(categoryid) == 2){
        $('#stockpoll').append(result);
        } else if (parseInt(categoryid) == 3){
        $('#sportpoll').append(result);
        } else {
        $('#moviepoll').append(result);
        }
        $('.loadersmall').css('display','none');
        $('.dropdown-button').dropdown({
                inDuration: 300,
                outDuration: 225,
                constrain_width: false, // Does not change width of dropdown to that of the activator
                hover: false, // Activate on hover
                gutter: 0, // Spacing from edge
                belowOrigin: false, // Displays dropdown below the button
                alignment: 'left' // Displays dropdown with edge aligned to the left of button
        })
        setTimeout(function () {
            $(".determinate").each(function () {
                var newper = $(this).attr('data-afterload');
                $(this).css('width', newper + '%');
            });
        }, 100)
         setTimeout(function () {
        $(".votedpoll input[type='radio']").attr('disabled', true);
        }, 100)
        
        $('.pageloader').hide();
    });
    }
    
    
</script>
<script>
    /* Dont Delete this part, Can be useful later - for showing the results to the not logged in users */
//    $(document).on('change','input[type=radio]',function(){
//        if($(this).hasClass('showresults')){
//            var pollid=$(this).attr('data-pollid');
//            $('.polloption_'+pollid).addClass('votedpoll');
//            setTimeout(function () {
//               $("polloption_"+pollid+" .determinate").each(function () {
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
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
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

