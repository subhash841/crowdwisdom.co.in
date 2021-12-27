<script>
    $(document).on('click', 'a#show-mobile-discussion', function () {
        console.log('here');
        $('.slide-on-mobile').slideToggle();
    })
</script>
<!--<div class="loadersmall" style="display:none"></div>-->
<div class="content container forumpages forumpagelist polllists" id="forumdetailpage">
    <div class="row mb0">
        <div class="col m12 s12">
            <ul id="tabs-swipe-demo" class="tabs forumtypetab">
                <li class="tab col m2 m2_5"><a href="#mydiscuss"><i class="flaticon-social"></i> My Decisions</a></li>
                <li class="tab col m2 m2_5"><a href="#elecpoll"><i class="flaticon-interface"></i> Governance</a></li>
                <li class="tab col m2 m2_5"><a href="#stockpoll"><i class="flaticon-money"></i> Money</a></li>
                <li class="tab col m2 m2_5"><a href="#sportpoll"><i class="flaticon-ball"></i> Sports</a></li>
                <li class="tab col m2 m2_5"><a href="#moviepoll"><i class="flaticon-tool"></i> Entertainment</a></li>
            </ul>
        </div>
    </div>
    <div class="row slide-on-mobile-button">
        <!--        <a id="show-mobile-discussion" class="start-discussion discussred show-on-small hide-on-med-and-up">Raise a Poll</a>-->
        <div class="col s12 center-align hide-on-med-and-up show-on-small raiseapoll_mob">
            <?php if (empty($_SESSION['data'])) { ?> 
                <a id="loginbtn" href="<?= base_url() ?>Login?section=poll" class="btn btn-default start-discussion themered">Login to discuss</a> 
            <?php } else { ?>
                <!--<a id="show-mobile-discussion" class="btn btn-default start-discussion themered">Raise a poll</a>-->
                <a id="show-mobile-discussion" class="btn btn-default start-discussion themered">
                    <img src="<?= base_url('images/forums/raise.png'); ?>" align="middle">
                    Raise a Poll
                </a>
            <?php }
            ?>
        </div>
        <div class="col s12 left-align show-on-med-and-up hide-on-small-only ">
            <div class="row">
                <?php if (empty($_SESSION['data'])) { ?>
                    <div class="col s12 raiseapoll">
                        <a id="loginbtn" href="<?= base_url() ?>Login?section=poll" class="btn btn-default start-discussion themered">Login to discuss</a> 
                    </div>
                <?php } else {
                    ?>
                    <div class="col s3 raiseapoll">
                        <a id="show-mobile-discussion" class="btn btn-default start-discussion themered">
                            <img src="<?= base_url('images/forums/raise.png'); ?>" align="middle">
                            Raise a Poll
                        </a>
                    </div>
                    <div class="col s9">
                        <div style="position:relative">
                            <img src="<?= base_url('images/forums/tag.png'); ?>" class="raisepollofferimg">
                            <span class="raisepolloffer fs13px">Raise a poll for <span class="flaticon-money-2 rupees"></span><span class="fs18px">50</span> or <span class="fs18px">50</span> Points <span class="flaticon-signs info"></span></span>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>
    <div class="col s12"><div class="row slide-on-mobile">
            <div class="col l12 m12 s12" style="position:relative;">
                <?php if (empty($_SESSION['data'])) {
                    ?>
                    <!--<div class="forum-overlay">
                        <a href="<?= base_url() ?>Login?section=discussion" class="btn btn-default start-discussion themered">Login to discuss</a>
                    </div>-->
                <?php }
                ?>
                <form id="postpoll" name="myform" method="POST" action="<?= base_url() ?>/Poll/add_update_poll" onkeypress="return event.keyCode != 13;" onsubmit="return validateForm()">
                    <div class="card forumarea" data-clickredirect="">
                        <div class="row mb10">
                            <div class="col m6 s12">
                                <div class="row mb10">
                                    <div class="col s12">
                                        <textarea id="polltopic" name="polltopic" placeholder="Raise Something ...." maxlength="75"></textarea>
                                    </div>
                                </div>
                                <div class="row mb10">
                                    <div class="col s12">
                                        <h5 class="fs12px f500">Select Category</h5>
                                        <select id="pollcatergory" name="pollcatergory">
                                            <option value="" selected disabled>Select Category</option>
                                            <?php
                                            foreach ($category_list as $pollcat) {
                                                echo '<option value="' . $pollcat['id'] . '">' . $pollcat['name'] . '</option>';
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col m6 s12">
                                <textarea id="polldescription" style="height:10em" name="polldescription" placeholder="Description About Poll...." maxlength="300" ></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <h5 class="fs12px f500 p0-10">Choices</h5>
                            <div class="col s12" id="choiceslist">
                                <div class="row choice mb10">
                                    <div class="col s11">
                                        <input type="text" name="choice[]" placeholder="Enter Choices"/>
                                    </div>
                                    <div class="col s1 no-padding">
                                        <i class="flaticon-delete removechoice hide"></i>
                                    </div>
                                </div>
                                <div class="row choice mb10">
                                    <div class="col s11">
                                        <input type="text" name="choice[]" placeholder="Enter Choices"/>
                                    </div>
                                    <div class="col s1 no-padding">
                                        <i class="flaticon-delete removechoice hide"></i>
                                    </div>
                                </div>
                                <div class="row choice mb10">
                                    <div class="col s11">
                                        <input type="text" name="choice[]" placeholder="Enter Choices"/>
                                    </div>
                                    <div class="col s1 no-padding">
                                        <i class="flaticon-delete removechoice hide"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12" id="staticoption">
                                <div class="row choice mb10">
                                    <div class="col s11">
                                        <input type="text" name="static1" placeholder="Don't Know (skip)" disabled/>
                                    </div>
                                </div>
                                <div class="row choice mb10">
                                    <div class="col s11">
                                        <input type="text" name="static2" placeholder="None Of The Above" disabled/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn addmorechoice">Add Choice</div>
                        <h5 class="fs12px center gray">(Text in the last Choice adds a New Field)</h5>
                        <div class="row center mt35b20">
                            <input type="hidden" id="poll_id" name="poll_id" value="0">
                            <button type="submit" class="btn btn-default themered br7px mr10">Save</button>
                            <button type="reset" class="btn btn-default secondarybtn br7px">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div></div>
    <div class="col s12"><div class="row">
            <div class="col l12 s12 p-0">
                <div id="mydiscuss" class="col s12">
                    <div class="row">
                        <?php if (!empty($mypoll)) { ?>
                            <?php foreach ($mypoll as $mp) { ?>
                                <div class="col l3 m3 s12">
                                    <?php
                                    $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                                        "(", ")", "{", "}", "|", "/", ";", "'", "<",
                                        ">", ",");
                                    $title = str_replace($spchar, "", $mp['poll']);
                                    $title = str_replace(' ', '-', $title);
                                    $href = base_url() . 'Poll/polldetail/' . $mp['id'] . "/" . $title;
                                    $target = 'target = "_blank"';
                                    ?>

                                    <div class="card p10  equal-height" data-clickredirect="<?= $href ?>">
                                        <div class="card_content pollcard-scrollbar">
                                            <div class="row mb10">
                                                <div class="col m12 s11">
                                                    <div class="col m6 s6"><h6 class="forumsubhead fs12px tastart" style="color: #6F7781;"><a href="#"><i>By <?= $user_id == $mp['user_id'] ? 'You' : $mp['byuser']; ?></i></a></h6></div>
                                                    <div class="col m6 s6"><h6 class="forumsubhead fs10px"><i><?= date('j M Y', strtotime($mp['created_date'])); ?></i></h6></div>
                                                    <div class="col m12 s10">
                                                        <div class="category fs12px <?= strtolower($mp['category_name']); ?>"><?= $mp['category_name']; ?></div>
                                                    </div>
                                                    <div class="col m9 s10">
                                                        <h6 class="fs14px tastart" style=""><?= $mp['poll'] ?></h6>
                                                    </div>
                                                    <div class="col m3 s2">
                                                        <a href="#" class="descsh" onClick="showdescription(<?= $mp['id']; ?>, 'mp')">view</a>
                                                    </div>
                                                    <div class="col m12 s12 polldescr" id="description_mp<?= $mp['id']; ?>">
                                                        <h6 class="fs14px tastart" style=""><?= $mp['description'] ?></h6>
                                                    </div>
                                                </div>
                                                <!--                                                <div class="col m1 s1">
                                                                                                    <div class="votescountbox"><span><?= $mp['total_votes'] ?></span><div class="text">Voted</div></div>
                                                                                                </div>-->
                                            </div>
                                            <div class="row mb0">
                                                <div data-tabname="mp63" class="polloptions polloption_<?= $mp['id']; ?> col m11 p-0 <?php
                                                if (!empty($mp['user_choice'])) {
                                                    echo "votedpoll";
                                                }
                                                ?>" id="polloptionmp_<?= $mp['id']; ?>">
                                                     <?php foreach ($mp['options'] as $index => $op) { ?>
                                                        <div class = "col m12 s12">
                                                            <div class = "row mb0">
                                                                <div class="col m2 s2">
                                                                    <label>
                                                                        <input class = "with-gap" class="pollchoice_<?= $mp['id'] ?>" name = "pollchoicemp_<?= $mp['id'] ?>" data-type="mp" data-total="<?= $op['total'] ?>" type = "radio" value="<?= $op['choice_id']; ?>" <?= $op['choice_id'] == $mp['user_choice'] ? "checked" : "" ?>/>
                                                                        <span class="customradio"></span>
                                                                    </label>
                                                                </div>
                                                                <div class = "col m10 s10">
                                                                    <div class = "row mb0">
                                                                        <div class = "col m12 s12 tastart"><h6 class="fs15px tastart mtb3 multiline-ellipsis"><?= $op['choice'] ?></h6></div>
                                                                    </div>
                                                                    <div class = "row mb10">
                                                                        <div class = "col m10 s9">
                                                                            <div class = "polloption progress">
                                                                                <div class = "determinate" style = "width: 0%" data-afterload="<?= $op['avg'] ?>"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class = "col m2 s3"><label class = "votepergain fs10px"><?= $op['avg'] ?>%</label></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="col s12 center-align">
                                                    <input type="submit" data-pollid="<?= $mp['id']; ?>"  data-type="mp" data-catid="<?= $mp['category_id'] ?>" data-totalvotes="<?= $mp['total_votes'] ?>" class="btn btn-default themered pollbtnvote <?php
                                                    if (!empty($mp['user_choice'])) {
                                                        echo "disabled";
                                                    }
                                                    ?>" value="vote"/>
                                                </div>
                                            </div>
                                            <hr style="width: 99%;border: 0.2px solid #ebf3fc;">

                                        </div>
                                        <div class="p7">
                                            <div class="row mb0">
                                                <div class="col s12 cmtop center-align">
        <!--                                                    <a href="<?= base_url() ?>Poll/polldetail/<?= $mp['id'] ?>" class="flaticon-multimedia  mr20 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-pollid="1" data-replyset="0"><?= $mp['total_comments'] ?> comments</a>-->
                                                    <div class="col s6"><span class="flaticon-multimedia-1  mr20 fw500 gray fs12px  linkpointer showreplies share" data-section="mp" data-pollid="<?= $mp['id']; ?>">Share
                                                            <div class="tooltip share_mp<?= $mp['id']; ?>"><div class="tooltip-arrow" style="left: 20%;"></div>
                                                                <a class="share-icon facebook" data-mobile-iframe="true" href="http://www.facebook.com/sharer/sharer.php?u='<?= base_url() ?>Poll/polldetail/<?= $mp['id'] ?>/<?= $title ?>'" target="_blank"><span class="fa fa-facebook"></span></a>
                                                                <a class="share-icon twitter" href="https://twitter.com/share?url='<?= base_url() ?>Poll/polldetail/<?= $mp['id'] ?>/<?= $title ?>'&ael;text='Poll title'&ael;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
                                                                <a class="share-icon whatsapp" href="https://web.whatsapp.com/send?text='<?= base_url() ?>Poll/polldetail/<?= $mp['id'] ?>/<?= $title ?>'" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                                            </div>
                                                        </span></div>
                                                    <div class="col s6"><a href="<?= base_url() ?>Poll/polldetail/<?= $mp['id'] ?>" class="fs12px mr20 fw500">View More</a></div>
                                                </div>
                                                <!--                                                <div class="col s12 cmtop right-align hide-on-med-and-up show-on-small">
                                                                                                    <a href="<?= base_url() ?>Poll/polldetail/<?= $mp['id'] ?>" class="flaticon-multimedia  mr10 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-pollid="1" data-replyset="0"><?= $mp['total_comments'] ?> comments</a>
                                                                                                    <span class="flaticon-multimedia-1  mr10 fw500 gray fs12px  linkpointer showreplies share" onclick="share('<?= base_url() ?>Poll/polldetail/<?= $mp['id'] ?>')">Share</span>
                                                                                                    <a href="<?= base_url() ?>Poll/polldetail/<?= $mp['id'] ?>" class="fs12px mr10 fw500">View More</a>
                                                                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="card p5-20  equal-height" data-clickredirect="">
                                <div class="card_content ">
                                    <h5 >Your Polls will appear here</h5>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div id="elecpoll" class="col s12 active">
                    <div class="row">
                        <?php $tabarray = strtolower($category_list[0]['name']); ?>
                        <?php if (!empty($$tabarray)) { ?>
                            <?php foreach ($$tabarray as $el) { ?>
                                <div class="col l3 m3 s12">
                                    <?php
                                    $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                                        "(", ")", "{", "}", "|", "/", ";", "'", "<",
                                        ">", ",");
                                    $title = str_replace($spchar, "", $el['poll']);
                                    $title = str_replace(' ', '-', $title);
                                    $href = base_url() . 'Poll/polldetail/' . $el['id'] . "/" . $title;
                                    $target = 'target = "_blank"';
                                    ?>

                                    <div class="card p10  equal-height" data-clickredirect="<?= $href ?>">
                                        <div class="card_content pollcard-scrollbar">
                                            <div class="row mb10">
                                                <div class="col m12 s11">
                                                    <div class="col m6 s6"><h6 class="forumsubhead fs12px tastart" style="color: #6F7781;"><a href="#"><i>By <?= $user_id == $el['user_id'] ? 'You' : $el['byuser']; ?></i></a></h6></div>
                                                    <div class="col m6 s6"><h6 class="forumsubhead fs10px"><i><?= date('j M Y', strtotime($el['created_date'])); ?></i></h6></div>
                                                    <div class="col m12 s10">
                                                        <div class="category fs12px <?= strtolower($el['category_name']); ?>"><?= $el['category_name']; ?></div>
<!--                                                        <h6 class="fs14px tastart" style=""><?= $el['poll'] ?></h6>-->
                                                    </div>
                                                    <div class="col m9 s10">
                                                        <h6 class="fs14px tastart" style=""><?= $el['poll'] ?></h6>
                                                    </div>
                                                    <div class="col m3 s2">
                                                        <a href="#" class="descsh" onClick="showdescription(<?= $el['id']; ?>, 'el')">view</a>
                                                    </div>
                                                    <div class="col m12 s12 polldescr" id="description_el<?= $el['id']; ?>">
                                                        <h6 class="fs14px tastart" style=""><?= $el['description'] ?></h6>
                                                    </div>
                                                </div>
                                                <!--                                                <div class="col m1 s1">
                                                                                                    <div class="votescountbox"><span><?= $el['total_votes'] ?></span><div class="text">Voted</div></div>
                                                                                                </div>-->
                                            </div>
                                            <div class="row mb0">
                                                <div data-tabname="el63" class="polloptions polloption_<?= $el['id']; ?> col m11 p-0 <?php
                                                if (!empty($el['user_choice'])) {
                                                    echo "votedpoll";
                                                }
                                                ?>" id="polloptionel_<?= $el['id']; ?>">
                                                     <?php foreach ($el['options'] as $index => $op) { ?>
                                                        <div class = "col m12 s12">
                                                            <div class = "row mb0">
                                                                <div class="col m2 s2">
                                                                    <label>
                                                                        <input class = "with-gap" class="pollchoice_<?= $el['id'] ?>" name = "pollchoiceel_<?= $el['id'] ?>" data-type="el" data-total="<?= $op['total'] ?>" type = "radio" value="<?= $op['choice_id']; ?>" <?= $op['choice_id'] == $el['user_choice'] ? "checked" : "" ?>/>
                                                                        <span class="customradio"></span>
                                                                    </label>
                                                                </div>
                                                                <div class = "col m10 s10">
                                                                    <div class = "row mb0">
                                                                        <div class = "col m12 s12 tastart"><h6 class="fs15px tastart mtb3 multiline-ellipsis"><?= $op['choice'] ?></h6></div>
                                                                    </div>
                                                                    <div class = "row mb10">
                                                                        <div class = "col m10 s9">
                                                                            <div class = "polloption progress">
                                                                                <div class = "determinate" style = "width: 0%" data-afterload="<?= $op['avg'] ?>"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class = "col m2 s3"><label class = "votepergain fs10px"><?= $op['avg'] ?>%</label></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="col s12 center-align">
                                                    <input type="submit" data-pollid="<?= $el['id']; ?>"  data-type="el" data-catid="<?= $el['category_id'] ?>" data-totalvotes="<?= $el['total_votes'] ?>" class="btn btn-default themered pollbtnvote <?php
                                                    if (!empty($el['user_choice'])) {
                                                        echo "disabled";
                                                    }
                                                    ?>" value="vote"/>
                                                </div>
                                            </div>
                                            <hr style="width: 99%;border: 0.2px solid #ebf3fc;">

                                        </div>
                                        <div class="p7">
                                            <div class="row mb0">
                                                <div class="col s12 cmtop center-align">
        <!--                                                    <a href="<?= base_url() ?>Poll/polldetail/<?= $el['id'] ?>" class="flaticon-multimedia  mr20 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-pollid="1" data-replyset="0"><?= $el['total_comments'] ?> comments</a>-->
                                                    <div class="col s6"><span class="flaticon-multimedia-1  mr20 fw500 gray fs12px  linkpointer showreplies share" data-section="el" data-pollid="<?= $el['id']; ?>">Share
                                                            <div class="tooltip share_el<?= $el['id']; ?>"><div class="tooltip-arrow" style="left: 20%;"></div>
                                                                <a class="share-icon facebook" data-mobile-iframe="true" href="http://www.facebook.com/sharer/sharer.php?u='<?= base_url() ?>Poll/polldetail/<?= $el['id'] ?>/<?= $title ?>'" target="_blank"><span class="fa fa-facebook"></span></a>
                                                                <a class="share-icon twitter" href="https://twitter.com/share?url='<?= base_url() ?>Poll/polldetail/<?= $el['id'] ?>/<?= $title ?>'&ael;text='Poll title'&ael;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
                                                                <a class="share-icon whatsapp" href="https://web.whatsapp.com/send?text='<?= base_url() ?>Poll/polldetail/<?= $el['id'] ?>/<?= $title ?>'" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                                            </div>
                                                        </span></div>
                                                    <div class="col s6"><a href="<?= base_url() ?>Poll/polldetail/<?= $el['id'] ?>" class="fs12px mr20 fw500">View More</a></div>
                                                </div>
                                                <!--                                                <div class="col s12 cmtop right-align hide-on-med-and-up show-on-small">
                                                                                                    <a href="<?= base_url() ?>Poll/polldetail/<?= $el['id'] ?>" class="flaticon-multimedia  mr10 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-pollid="1" data-replyset="0"><?= $el['total_comments'] ?> comments</a>
                                                                                                    <span class="flaticon-multimedia-1  mr10 fw500 gray fs12px  linkpointer showreplies share" onclick="share('<?= base_url() ?>Poll/polldetail/<?= $el['id'] ?>')">Share</span>
                                                                                                    <a href="<?= base_url() ?>Poll/polldetail/<?= $el['id'] ?>" class="fs12px mr10 fw500">View More</a>
                                                                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="card p5-20  equal-height" data-clickredirect="">
                                <div class="card_content ">
                                    <h5 >Your Polls will appear here</h5>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div id="stockpoll" class="col s12">
                    <div class="row">
                        <?php $tabarray = strtolower($category_list[1]['name']); ?>
                        <?php if (!empty($$tabarray)) { ?>
                            <?php foreach ($$tabarray as $st) { ?>
                                <div class="col l3 m3 s12">
                                    <?php
                                    $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                                        "(", ")", "{", "}", "|", "/", ";", "'", "<",
                                        ">", ",");
                                    $title = str_replace($spchar, "", $st['poll']);
                                    $title = str_replace(' ', '-', $title);
                                    $href = base_url() . 'Poll/polldetail/' . $st['id'] . "/" . $title;
                                    $target = 'target = "_blank"';
                                    ?>

                                    <div class="card p10  equal-height" data-clickredirect="<?= $href ?>">
                                        <div class="card_content pollcard-scrollbar">
                                            <div class="row mb10">
                                                <div class="col m12 s11">
                                                    <div class="col m6 s6"><h6 class="forumsubhead fs12px tastart" style="color: #6F7781;"><a href="#"><i>By <?= $user_id == $st['user_id'] ? 'You' : $st['byuser']; ?></i></a></h6></div>
                                                    <div class="col m6 s6"><h6 class="forumsubhead fs10px"><i><?= date('j M Y', strtotime($st['created_date'])); ?></i></h6></div>
                                                    <div class="col m12 s10">
                                                        <div class="category fs12px <?= strtolower($st['category_name']); ?>"><?= $st['category_name']; ?></div>
<!--                                                        <h6 class="fs14px tastart" style=""><?= $st['poll'] ?></h6>-->
                                                    </div>
                                                    <div class="col m9 s10">
                                                        <h6 class="fs14px tastart" style=""><?= $st['poll'] ?></h6>
                                                    </div>
                                                    <div class="col m3 s2">
                                                        <a href="#" class="descsh" onClick="showdescription(<?= $st['id']; ?>, 'st')">view</a>
                                                    </div>
                                                    <div class="col m12 s12 polldescr" id="description_st<?= $st['id']; ?>">
                                                        <h6 class="fs14px tastart" style=""><?= $st['description'] ?></h6>
                                                    </div>
                                                </div>
                                                <!--                                                <div class="col m1 s1">
                                                                                                    <div class="votescountbox"><span><?= $st['total_votes'] ?></span><div class="text">Voted</div></div>
                                                                                                </div>-->
                                            </div>
                                            <div class="row mb0">
                                                <div data-tabname="st63" class="polloptions polloption_<?= $st['id']; ?> col m11 p-0 <?php
                                                if (!empty($st['user_choice'])) {
                                                    echo "votedpoll";
                                                }
                                                ?>" id="polloptionst_<?= $st['id']; ?>">
                                                     <?php foreach ($st['options'] as $index => $op) { ?>
                                                        <div class = "col m12 s12">
                                                            <div class = "row mb0">
                                                                <div class="col m2 s2">
                                                                    <label>
                                                                        <input class = "with-gap" class="pollchoice_<?= $st['id'] ?>" name = "pollchoicest_<?= $st['id'] ?>" data-type="st" data-total="<?= $op['total'] ?>" type = "radio" value="<?= $op['choice_id']; ?>" <?= $op['choice_id'] == $st['user_choice'] ? "checked" : "" ?>/>
                                                                        <span class="customradio"></span>
                                                                    </label>
                                                                </div>
                                                                <div class = "col m10 s10">
                                                                    <div class = "row mb0">
                                                                        <div class = "col m12 s12 tastart"><h6 class="fs15px tastart mtb3 multiline-ellipsis"><?= $op['choice'] ?></h6></div>
                                                                    </div>
                                                                    <div class = "row mb10">
                                                                        <div class = "col m10 s9">
                                                                            <div class = "polloption progress">
                                                                                <div class = "determinate" style = "width: 0%" data-afterload="<?= $op['avg'] ?>"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class = "col m2 s3"><label class = "votepergain fs10px"><?= $op['avg'] ?>%</label></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="col s12 center-align">
                                                    <input type="submit" data-pollid="<?= $st['id']; ?>"  data-type="st" data-catid="<?= $st['category_id'] ?>" data-totalvotes="<?= $st['total_votes'] ?>" class="btn btn-default themered pollbtnvote <?php
                                                    if (!empty($st['user_choice'])) {
                                                        echo "disabled";
                                                    }
                                                    ?>" value="vote"/>
                                                </div>
                                            </div>
                                            <hr style="width: 99%;border: 0.2px solid #ebf3fc;">

                                        </div>
                                        <div class="p7">
                                            <div class="row mb0">
                                                <div class="col s12 cmtop center-align">
        <!--                                                    <a href="<?= base_url() ?>Poll/polldetail/<?= $st['id'] ?>" class="flaticon-multimedia  mr20 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-pollid="1" data-replyset="0"><?= $st['total_comments'] ?> comments</a>-->
                                                    <div class="col s6"><span class="flaticon-multimedia-1  mr20 fw500 gray fs12px  linkpointer showreplies share" data-section="st" data-pollid="<?= $st['id']; ?>">Share
                                                            <div class="tooltip share_st<?= $st['id']; ?>"><div class="tooltip-arrow" style="left: 20%;"></div>
                                                                <a class="share-icon facebook" data-mobile-iframe="true" href="http://www.facebook.com/sharer/sharer.php?u='<?= base_url() ?>Poll/polldetail/<?= $st['id'] ?>/<?= $title ?>'" target="_blank"><span class="fa fa-facebook"></span></a>
                                                                <a class="share-icon twitter" href="https://twitter.com/share?url='<?= base_url() ?>Poll/polldetail/<?= $st['id'] ?>/<?= $title ?>'&ael;text='Poll title'&ael;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
                                                                <a class="share-icon whatsapp" href="https://web.whatsapp.com/send?text='<?= base_url() ?>Poll/polldetail/<?= $st['id'] ?>/<?= $title ?>'" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                                            </div>
                                                        </span></div>
                                                    <div class="col s6"><a href="<?= base_url() ?>Poll/polldetail/<?= $st['id'] ?>" class="fs12px mr20 fw500">View More</a></div>
                                                </div>
                                                <!--                                                <div class="col s12 cmtop right-align hide-on-med-and-up show-on-small">
                                                                                                    <a href="<?= base_url() ?>Poll/polldetail/<?= $st['id'] ?>" class="flaticon-multimedia  mr10 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-pollid="1" data-replyset="0"><?= $st['total_comments'] ?> comments</a>
                                                                                                    <span class="flaticon-multimedia-1  mr10 fw500 gray fs12px  linkpointer showreplies share" onclick="share('<?= base_url() ?>Poll/polldetail/<?= $st['id'] ?>')">Share</span>
                                                                                                    <a href="<?= base_url() ?>Poll/polldetail/<?= $st['id'] ?>" class="fs12px mr10 fw500">View More</a>
                                                                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            <?php } ?>
                        <?php } else { ?>
                            <div class="card p5-20  equal-height" data-clickredirect="">
                                <div class="card_content ">
                                    <h5 >Your Polls will appear here</h5>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div id="sportpoll" class="col s12 ">
                    <div class="row">
                        <?php $tabarray = strtolower($category_list[2]['name']); ?>
                        <?php if (!empty($$tabarray)) { ?>
                            <?php foreach ($$tabarray as $sp) { ?>
                                <div class="col l3 m3 s12">
                                    <?php
                                    $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                                        "(", ")", "{", "}", "|", "/", ";", "'", "<",
                                        ">", ",");
                                    $title = str_replace($spchar, "", $sp['poll']);
                                    $title = str_replace(' ', '-', $title);
                                    $href = base_url() . 'Poll/polldetail/' . $sp['id'] . "/" . $title;
                                    $target = 'target = "_blank"';
                                    ?>

                                    <div class="card p10  equal-height" data-clickredirect="<?= $href ?>">
                                        <div class="card_content pollcard-scrollbar">
                                            <div class="row mb10">
                                                <div class="col m12 s11">
                                                    <div class="col m6 s6"><h6 class="forumsubhead fs12px tastart" style="color: #6F7781;"><a href="#"><i>By <?= $user_id == $sp['user_id'] ? 'You' : $sp['byuser']; ?></i></a></h6></div>
                                                    <div class="col m6 s6"><h6 class="forumsubhead fs10px"><i><?= date('j M Y', strtotime($sp['created_date'])); ?></i></h6></div>
                                                    <div class="col m12 s10">
                                                        <div class="category fs12px <?= strtolower($sp['category_name']); ?>"><?= $sp['category_name']; ?></div>
<!--                                                        <h6 class="fs14px tastart" style=""><?= $sp['poll'] ?></h6>-->
                                                    </div>
                                                    <div class="col m9 s10">
                                                        <h6 class="fs14px tastart" style=""><?= $sp['poll'] ?></h6>
                                                    </div>
                                                    <div class="col m3 s2">
                                                        <a href="#" class="descsh" onClick="showdescription(<?= $sp['id']; ?>, 'sp')">view</a>
                                                    </div>
                                                    <div class="col m12 s12 polldescr" id="description_sp<?= $sp['id']; ?>">
                                                        <h6 class="fs14px tastart" style=""><?= $sp['description'] ?></h6>
                                                    </div>
                                                </div>
                                                <!--                                                <div class="col m1 s1">
                                                                                                    <div class="votescountbox"><span><?= $sp['total_votes'] ?></span><div class="text">Voted</div></div>
                                                                                                </div>-->
                                            </div>
                                            <div class="row mb0">
                                                <div data-tabname="sp63" class="polloptions polloption_<?= $sp['id']; ?> col m11 p-0 <?php
                                                if (!empty($sp['user_choice'])) {
                                                    echo "votedpoll";
                                                }
                                                ?>" id="polloptionsp_<?= $sp['id']; ?>">
                                                     <?php foreach ($sp['options'] as $index => $op) { ?>
                                                        <div class = "col m12 s12">
                                                            <div class = "row mb0">
                                                                <div class="col m2 s2">
                                                                    <label>
                                                                        <input class = "with-gap" class="pollchoice_<?= $sp['id'] ?>" name = "pollchoicesp_<?= $sp['id'] ?>" data-type="sp" data-total="<?= $op['total'] ?>" type = "radio" value="<?= $op['choice_id']; ?>" <?= $op['choice_id'] == $sp['user_choice'] ? "checked" : "" ?>/>
                                                                        <span class="customradio"></span>
                                                                    </label>
                                                                </div>
                                                                <div class = "col m10 s10">
                                                                    <div class = "row mb0">
                                                                        <div class = "col m12 s12 tastart"><h6 class="fs15px tastart mtb3 multiline-ellipsis"><?= $op['choice'] ?></h6></div>
                                                                    </div>
                                                                    <div class = "row mb10">
                                                                        <div class = "col m10 s9">
                                                                            <div class = "polloption progress">
                                                                                <div class = "determinate" style = "width: 0%" data-afterload="<?= $op['avg'] ?>"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class = "col m2 s3"><label class = "votepergain fs10px"><?= $op['avg'] ?>%</label></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="col s12 center-align">
                                                    <input type="submit" data-pollid="<?= $sp['id']; ?>"  data-type="sp" data-catid="<?= $sp['category_id'] ?>" data-totalvotes="<?= $sp['total_votes'] ?>" class="btn btn-default themered pollbtnvote <?php
                                                    if (!empty($sp['user_choice'])) {
                                                        echo "disabled";
                                                    }
                                                    ?>" value="vote"/>
                                                </div>
                                            </div>
                                            <hr style="width: 99%;border: 0.2px solid #ebf3fc;">

                                        </div>
                                        <div class="p7">
                                            <div class="row mb0">
                                                <div class="col s12 cmtop center-align">
        <!--                                                    <a href="<?= base_url() ?>Poll/polldetail/<?= $sp['id'] ?>" class="flaticon-multimedia  mr20 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-pollid="1" data-replyset="0"><?= $sp['total_comments'] ?> comments</a>-->
                                                    <div class="col s6"><span class="flaticon-multimedia-1  mr20 fw500 gray fs12px  linkpointer showreplies share" data-section="sp" data-pollid="<?= $sp['id']; ?>">Share
                                                            <div class="tooltip share_sp<?= $sp['id']; ?>"><div class="tooltip-arrow" style="left: 20%;"></div>
                                                                <a class="share-icon facebook" data-mobile-iframe="true" href="http://www.facebook.com/sharer/sharer.php?u='<?= base_url() ?>Poll/polldetail/<?= $sp['id'] ?>/<?= $title ?>'" target="_blank"><span class="fa fa-facebook"></span></a>
                                                                <a class="share-icon twitter" href="https://twitter.com/share?url='<?= base_url() ?>Poll/polldetail/<?= $sp['id'] ?>/<?= $title ?>'&ael;text='Poll title'&ael;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
                                                                <a class="share-icon whatsapp" href="https://web.whatsapp.com/send?text='<?= base_url() ?>Poll/polldetail/<?= $sp['id'] ?>/<?= $title ?>'" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                                            </div>
                                                        </span></div>
                                                    <div class="col s6"><a href="<?= base_url() ?>Poll/polldetail/<?= $sp['id'] ?>" class="fs12px mr20 fw500">View More</a></div>
                                                </div>
                                                <!--                                                <div class="col s12 cmtop right-align hide-on-med-and-up show-on-small">
                                                                                                    <a href="<?= base_url() ?>Poll/polldetail/<?= $sp['id'] ?>" class="flaticon-multimedia  mr10 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-pollid="1" data-replyset="0"><?= $sp['total_comments'] ?> comments</a>
                                                                                                    <span class="flaticon-multimedia-1  mr10 fw500 gray fs12px  linkpointer showreplies share" onclick="share('<?= base_url() ?>Poll/polldetail/<?= $sp['id'] ?>')">Share</span>
                                                                                                    <a href="<?= base_url() ?>Poll/polldetail/<?= $sp['id'] ?>" class="fs12px mr10 fw500">View More</a>
                                                                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="card p5-20  equal-height" data-clickredirect="">
                                <div class="card_content ">
                                    <h5 >Your Polls will appear here</h5>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div id="moviepoll" class="col s12">
                    <div class="row">
                        <?php $tabarray = strtolower($category_list[3]['name']); ?>
                        <?php if (!empty($$tabarray)) { ?>
                            <?php foreach ($$tabarray as $mv) { ?>
                                <div class="col l3 m3 s12">
                                    <?php
                                    $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                                        "(", ")", "{", "}", "|", "/", ";", "'", "<",
                                        ">", ",");
                                    $title = str_replace($spchar, "", $mv['poll']);
                                    $title = str_replace(' ', '-', $title);
                                    $href = base_url() . 'Poll/polldetail/' . $mv['id'] . "/" . $title;
                                    $target = 'target = "_blank"';
                                    ?>

                                    <div class="card p10  equal-height" data-clickredirect="<?= $href ?>">
                                        <div class="card_content pollcard-scrollbar">
                                            <div class="row mb10">
                                                <div class="col m12 s11">
                                                    <div class="col m6 s6"><h6 class="forumsubhead fs12px tastart" style="color: #6F7781;"><a href="#"><i>By <?= $user_id == $mv['user_id'] ? 'You' : $mv['byuser']; ?></i></a></h6></div>
                                                    <div class="col m6 s6"><h6 class="forumsubhead fs10px"><i><?= date('j M Y', strtotime($mv['created_date'])); ?></i></h6></div>
                                                    <div class="col m12 s10">
                                                        <div class="category fs12px <?= strtolower($mv['category_name']); ?>"><?= $mv['category_name']; ?></div>
<!--                                                        <h6 class="fs14px tastart" style=""><?= $mv['poll'] ?></h6>-->
                                                    </div>
                                                    <div class="col m9 s10">
                                                        <h6 class="fs14px tastart" style=""><?= $mv['poll'] ?></h6>
                                                    </div>
                                                    <div class="col m3 s2">
                                                        <a href="#" class="descsh" onClick="showdescription(<?= $mv['id']; ?>, 'mv')">view</a>
                                                    </div>
                                                    <div class="col m12 s12 polldescr" id="description_mv<?= $mv['id']; ?>">
                                                        <h6 class="fs14px tastart" style=""><?= $mv['description'] ?></h6>
                                                    </div>
                                                </div>
                                                <!--                                                <div class="col m1 s1">
                                                                                                    <div class="votescountbox"><span><?= $mv['total_votes'] ?></span><div class="text">Voted</div></div>
                                                                                                </div>-->
                                            </div>
                                            <div class="row mb0">
                                                <div data-tabname="mv63" class="polloptions polloption_<?= $mv['id']; ?> col m11 p-0 <?php
                                                if (!empty($mv['user_choice'])) {
                                                    echo "votedpoll";
                                                }
                                                ?>" id="polloptionmv_<?= $mv['id']; ?>">
                                                     <?php foreach ($mv['options'] as $index => $op) { ?>
                                                        <div class = "col m12 s12">
                                                            <div class = "row mb0">
                                                                <div class="col m2 s2">
                                                                    <label>
                                                                        <input class = "with-gap" class="pollchoice_<?= $mv['id'] ?>" name = "pollchoicemv_<?= $mv['id'] ?>" data-type="mv" data-total="<?= $op['total'] ?>" type = "radio" value="<?= $op['choice_id']; ?>" <?= $op['choice_id'] == $mv['user_choice'] ? "checked" : "" ?>/>
                                                                        <span class="customradio"></span>
                                                                    </label>
                                                                </div>
                                                                <div class = "col m10 s10">
                                                                    <div class = "row mb0">
                                                                        <div class = "col m12 s12 tastart"><h6 class="fs15px tastart mtb3 multiline-ellipsis"><?= $op['choice'] ?></h6></div>
                                                                    </div>
                                                                    <div class = "row mb10">
                                                                        <div class = "col m10 s9">
                                                                            <div class = "polloption progress">
                                                                                <div class = "determinate" style = "width: 0%" data-afterload="<?= $op['avg'] ?>"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class = "col m2 s3"><label class = "votepergain fs10px"><?= $op['avg'] ?>%</label></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="col s12 center-align">
                                                    <input type="submit" data-pollid="<?= $mv['id']; ?>"  data-type="mv" data-catid="<?= $mv['category_id'] ?>" data-totalvotes="<?= $mv['total_votes'] ?>" class="btn btn-default themered pollbtnvote <?php
                                                    if (!empty($mv['user_choice'])) {
                                                        echo "disabled";
                                                    }
                                                    ?>" value="vote"/>
                                                </div>
                                            </div>
                                            <hr style="width: 99%;border: 0.2px solid #ebf3fc;">

                                        </div>
                                        <div class="p7">
                                            <div class="row mb0">
                                                <div class="col s12 cmtop center-align">
        <!--                                                    <a href="<?= base_url() ?>Poll/polldetail/<?= $mv['id'] ?>" class="flaticon-multimedia  mr20 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-pollid="1" data-replyset="0"><?= $mv['total_comments'] ?> comments</a>-->
                                                    <div class="col s6"><span class="flaticon-multimedia-1  mr20 fw500 gray fs12px  linkpointer showreplies share" data-section="mv" data-pollid="<?= $mv['id']; ?>">Share
                                                            <div class="tooltip share_mv<?= $mv['id']; ?>"><div class="tooltip-arrow" style="left: 20%;"></div>
                                                                <a class="share-icon facebook" data-mobile-iframe="true" href="http://www.facebook.com/sharer/sharer.php?u='<?= base_url() ?>Poll/polldetail/<?= $mv['id'] ?>/<?= $title ?>'" target="_blank"><span class="fa fa-facebook"></span></a>
                                                                <a class="share-icon twitter" href="https://twitter.com/share?url='<?= base_url() ?>Poll/polldetail/<?= $mv['id'] ?>/<?= $title ?>'&ael;text='Poll title'&ael;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
                                                                <a class="share-icon whatsapp" href="https://web.whatsapp.com/send?text='<?= base_url() ?>Poll/polldetail/<?= $mv['id'] ?>/<?= $title ?>'" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                                            </div>
                                                        </span></div>
                                                    <div class="col s6"><a href="<?= base_url() ?>Poll/polldetail/<?= $mv['id'] ?>/<?= $title ?>" class="fs12px mr20 fw500">View More</a></div>
                                                </div>
                                                <!--                                                <div class="col s12 cmtop right-align hide-on-med-and-up show-on-small">
                                                                                                    <a href="<?= base_url() ?>Poll/polldetail/<?= $mv['id'] ?>" class="flaticon-multimedia  mr10 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-pollid="1" data-replyset="0"><?= $mv['total_comments'] ?> comments</a>
                                                                                                    <span class="flaticon-multimedia-1  mr10 fw500 gray fs12px  linkpointer showreplies share" onclick="share('<?= base_url() ?>Poll/polldetail/<?= $mv['id'] ?>')">Share</span>
                                                                                                    <a href="<?= base_url() ?>Poll/polldetail/<?= $mv['id'] ?>" class="fs12px mr10 fw500">View More</a>
                                                                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="card p5-20  equal-height" data-clickredirect="">
                                <div class="card_content ">
                                    <h5 >Your Polls will appear here</h5>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.0.8/d3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/PieChart/js/donut-pie-chart.js" type="text/javascript"></script>-->
<script>
//    $("#tabs-swipe-demo").tabs({
//        create: function (event, ui) {
//            //executed after tab is created.
//            $('.tabs_content').show();
//        },
//        show: function (event, ui) {
//            //on every tabs clicked
//        }
//    });

    $(function () {
        //$('#loginbtn').attr('href','<?= base_url() ?>Login?section=poll&p=gov')
        console.log(window.location.hash);
        if (window.location.hash) {
            var hash = window.location.hash; //Puts hash in variable, and removes the # character
            console.log(hash);
            $('#tabs-swipe-demo>li>a').removeClass('active');
            if (hash == "#elecpoll") {
                $('#pollcatergory').val("1");
                $('#pollcatergory').material_select();
                $('#tabs-swipe-demo>li>a[href="#elecpoll"]').addClass('active');
                $('#loginbtn').attr('href', '<?= base_url() ?>Login?section=poll&p=gov')
            } else if (hash == "#stockpoll") {
                $('#pollcatergory').val("2");
                $('#pollcatergory').material_select();
                $('#tabs-swipe-demo>li>a[href="#stockpoll"]').addClass('active');
                $('#loginbtn').attr('href', '<?= base_url() ?>Login?section=poll&p=mon')
            } else if (hash == "#sportpoll") {
                $('#pollcatergory').val("3");
                $('#pollcatergory').material_select();
                $('#tabs-swipe-demo>li>a[href="#sportpoll"]').addClass('active');
                $('#loginbtn').attr('href', '<?= base_url() ?>Login?section=poll&p=spo')
            } else if (hash == "#moviepoll") {
                $('#pollcatergory').val("4");
                $('#pollcatergory').material_select();
                $('#tabs-swipe-demo>li>a[href="#moviepoll"]').addClass('active');
                $('#loginbtn').attr('href', '<?= base_url() ?>Login?section=poll&p=ent')
            } else {
                $('#tabs-swipe-demo>li>a[href="#elecpoll"]').addClass('active');
                $('#loginbtn').attr('href', '<?= base_url() ?>Login?section=poll&p=gov')
            }
        } else {
            $('#tabs-swipe-demo>li>a[href="#elecpoll"]').addClass('active');
            $('#loginbtn').attr('href', '<?= base_url() ?>Login?section=poll&p=gov')
        }

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
//   );

    function showComments(id) {
        //$('div[class^="replies"]').slideUp();
        $('.replies' + id).slideToggle();
    }


    function validateForm() {
        var topic = $("#polltopic").val();
        var polldescri = $('#polldescription').val();
        var pollcategory = $("#pollcatergory").val();
        var choicearray = $("input[name='choice[]']")
                .map(function () {
                    return $(this).val();
                }).get();


        if (topic == "") {
            Materialize.Toast.removeAll();
            Materialize.toast('Please write Poll topic!', 4000);
            return false;
        }
        if (polldescri == "") {
            Materialize.Toast.removeAll();
            Materialize.toast('Please write Poll description!', 4000);
            return false;
        }
        if (pollcategory == "" || pollcategory == null) {
            Materialize.Toast.removeAll();
            Materialize.toast('Please Select Category!', 4000);
            return false;
        }
        if (choicearray && choicearray.length < 2) {
            Materialize.Toast.removeAll();
            Materialize.toast('Please write choices!', 4000);
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

    $("#mobtabcategories").on('change', function () {
        var selectedCategory = $(this).val();
        //console.log(selectedCategory);
        //window.location.href=selectedCategory;
        window.location.assign(selectedCategory);
        window.location.reload();
    });

    $("#tabs-swipe-demo.tabs > li > a").click(function (e) {
        var id = $(e.target).attr("href").substr(1);
        if (id == "elecpoll") {
            $('#forumcatergory').val("1");
            $('#forumcatergory').material_select();
            $('#loginbtn').attr('href', '<?= base_url() ?>Login?section=poll&p=gov')
        } else if (id == "stockpoll") {
            $('#forumcatergory').val("2");
            $('#forumcatergory').material_select();
            $('#loginbtn').attr('href', '<?= base_url() ?>Login?section=poll&p=mon')
        } else if (id == "sportpoll") {
            $('#forumcatergory').val("3");
            $('#forumcatergory').material_select();
            $('#loginbtn').attr('href', '<?= base_url() ?>Login?section=poll&p=spo')
        } else if (id == "moviepoll") {
            $('#forumcatergory').val("4");
            $('#forumcatergory').material_select();
            $('#loginbtn').attr('href', '<?= base_url() ?>Login?section=poll&p=ent')
        } else {
            $('#loginbtn').attr('href', '<?= base_url() ?>Login?section=poll&p=myp')
        }
    });


    $('body').scroll(function () {
        //console.log("hello");
        var mainscroll = $(this).scrollTop() + $(this).innerHeight();
        var footerheight = $('#footer').height();
        if (mainscroll - footerheight >= $(this)[0].scrollHeight - 1) {
            console.log("hello");
        }
    });


    $(document).on('click', '.addmorechoice', function (e) {
        //alert("one row added");
        if ($('#staticoption').css('display') == "none") {
            $('#staticoption').css('display', 'block');
        }
        var visible = $("#choiceslist .choice").length;
        var html = "";
        if (visible < 6) {
            if (visible < 3) {
                $('.choice .removechoice').addClass('hide');
            } else {
                $('.choice .removechoice').removeClass('hide');
            }
            //$(this).addClass("shown")
            html = '<div class="row choice mb10">\
                    <div class="col s11">\
                        <input type="text" name="choice[]" placeholder="Enter Choices"/>\
                    </div>\
                    <div class="col s1 no-padding">\
                        <i class="flaticon-delete removechoice"></i>\
                    </div>\
                </div>';
            $('#choiceslist').append(html);
            if (visible == 5) {
                $(this).addClass('disabled');
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

        if ($("input[name='pollchoice" + section + "_" + pollid + "']").is(":checked")) {
            var userchoice = $("input[name='pollchoice" + section + "_" + pollid + "']:checked").val();

            $.ajax({
                "url": "<?= base_url() ?>Poll/addpollchoice",
                "method": "POST",
                "data": {"poll_id": pollid, "choice": userchoice, "category_id": categoryid}
            }).done(function (result) {
                result = JSON.parse(result);
                console.log(result);
                if (result['status'])
                {

                    $('.polloption_' + pollid).each(function () {
                        var html = "";
                        var tabname = $(this).attr('data-tabname');
                        for (var i in result['data']['options']) {
                            var isvoted = result['data']['options'][i]['choice_id'] == userchoice ? "checked" : "";
                            console.log(isvoted);
                            html += '<div class = "col m6 s12">\
                                    <div class = "row mb0">\
                                        <div class="col m1 s2">\
                                            <label>\
                                                <input class = "with-gap" class="pollchoice_' + pollid + '" name = "pollchoice' + tabname + '_' + pollid + '" data-type="' + tabname + '" data-total="' + result['data']['options'][i]['total'] + '" type = "radio" value="' + result['data']['options'][i]['choice_id'] + '" ' + isvoted + '/>\
                                                <span class="customradio"></span>\
                                            </label>\
                                        </div>\
                                        <div class = "col m11 s10">\
                                            <div class = "row mb0">\
                                                <div class = "col m12 s12 tastart"><h6 class="fs15px tastart mtb3 multiline-ellipsis">' + result['data']['options'][i]['choice'] + '</h6></div>\
                                            </div>\
                                            <div class = "row mb10">\
                                                <div class = "col m10 s9">\
                                                    <div class = "polloption progress">\
                                                        <div class = "determinate" style = "width: 0%" data-afterload="' + result['data']['options'][i]['avg'] + '"></div>\
                                                    </div>\
                                                </div>\
                                                <div class = "col m2 s3"><label class = "votepergain fs10px">' + result['data']['options'][i]['avg'] + '%</label></div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>';
                        }
                        $("#polloption" + tabname + "_" + pollid).html(html);

                        $("#polloption" + tabname + "_" + pollid).addClass('votedpoll');
                        console.log("#polloption" + tabname + "_" + pollid + " .determinate");
                        setTimeout(function () {
                            $("#polloption" + tabname + "_" + pollid + " .determinate").each(function () {
                                var newper = $(this).attr('data-afterload');
                                $(this).css('width', newper + '%');
                            });
                        }, 100)

                    });

                    //$('input[name ^=pollchoice][name $=' + pollid + '][value=' + userchoice + ']').attr('checked', true);
                    $('input[data-pollid=' + pollid + ']').addClass('disabled');
                    Materialize.Toast.removeAll();
                    Materialize.toast(result['message'], 4000);
                } else {
<?php if (empty($this->session->userdata('data'))) { ?>
                        window.location.assign("<?= base_url() ?>Login");
<?php } ?>
                }

            });

        } else {
            Materialize.Toast.removeAll();
            Materialize.toast('Please select choice', 4000);
        }

        //console.log(userchoice);
    });

    $(function () {

    });
    $(document).on('click', '.share', function (e) {
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
    });
</script>
<script>
    $(".determinate").each(function () {
        var newper = $(this).attr('data-afterload');
        $(this).css('width', newper + '%');
    });

    $(".votedpoll input[type='radio']").attr('disabled', true);

    function share(url) {

        if (navigator.share) {
            navigator.share({
                title: 'Web Fundamentals',
                text: 'Check out Web Fundamentals — it rocks!',
                url: url
            })
//                    .then(() = > console.log('Successful share'))
//                    .catch((error) = > console.log('Error sharing', error));
        }
    }
    $('.polllists .card').click(function (e) {
        var redirectto = $(this).attr('data-clickredirect');
        var shareclick = e.target.className.indexOf("share");
        console.log(shareclick);
        console.log(e.target.className);
        if ((e.target.className == "customradio" || e.target.className == "with-gap") || shareclick != -1 || redirectto == "" || e.target.className == "descsh") {

        } else {
            window.location.assign(redirectto);
        }
    });

    function showdescription(id, type) {
        console.log(id);
        console.log(type);
        $('#description_' + type + id).slideToggle('slow');
    }
</script>

