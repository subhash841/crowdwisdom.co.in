<script>
    $(document).on('click', 'a#show-mobile-discussion', function () {
        console.log('here');
        $('.slide-on-mobile').slideToggle();
    })
</script>
<!--<div class="loadersmall" style="display:none"></div>-->
<div class="content container forumpages forumpagelist" id="forumdetailpage">
    <div class="row mb0">
        <div class="col m12 s12">
            <ul id="tabs-swipe-demo" class="tabs forumtypetab">
                <li class="tab col m2 m2_5"><a href="#mydiscuss"><i class="flaticon-social"></i> My Polls</a></li>
                <li class="tab col m2 m2_5"><a href="#elecforum" class="active"><i class="flaticon-interface"></i> Elections</a></li>
                <li class="tab col m2 m2_5"><a href="#stockforum"><i class="flaticon-money"></i> Stocks</a></li>
                <li class="tab col m2 m2_5"><a href="#sportforum"><i class="flaticon-ball"></i> Sports</a></li>
                <li class="tab col m2 m2_5"><a href="#movieforum"><i class="flaticon-tool"></i> Movies</a></li>
            </ul>
        </div>
    </div>
    <div class="row slide-on-mobile-button">
        <!--        <a id="show-mobile-discussion" class="start-discussion discussred show-on-small hide-on-med-and-up">Raise a Poll</a>-->
        <div class="col s12 center-align hide-on-med-and-up show-on-small raiseapoll_mob">
            <?php if (empty($_SESSION['data'])) { ?> 
                <a href="<?= base_url() ?>Login?section=discussion" class="btn btn-default start-discussion themered">Login to discuss</a> 
            <?php } else { ?>
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
                 <div class="col s3 raiseapoll">
                    <a href="<?= base_url() ?>Login?section=discussion" class="btn btn-default start-discussion themered">Login to discuss</a>
                 </div>
                <?php } else { ?>
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
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="row slide-on-mobile">
        <div class="col l12 m12 s12" style="position:relative;">
            <?php if (empty($_SESSION['data'])) {
                ?>
                <!--<div class="forum-overlay">
                    <a href="<?= base_url() ?>Login?section=discussion" class="btn btn-default start-discussion themered">Login to discuss</a>
                </div>-->
            <?php }
            ?>
            <form id="postpoll" name="myform" method="POST" action="<?= base_url() ?>/Poll/add_update_poll"  onsubmit="return validateForm()">
                <div class="card forumarea">
                    <div class="row mb10">
                        <div class="col s12">
                            <textarea id="textarea1" name="polltopic" placeholder="Raise Something ...."></textarea>
                        </div>
                    </div>
                    <div class="row mb0">
                        <div class="col m6 s12">
                            <h5 class="fs12px f500">Select Category</h5>
                            <select id="pollcatergory" name="pollcatergory">
                                <option value="" selected disabled>Select Category</option>
                                <option value="1">Elections</option>
                                <option value="2">Stocks</option>
                                <option value="3">Sports</option>
                                <option value="4">Movies</option>
                            </select>
                        </div>
                        <div class="col m6 s12">
                            <h5 class="fs12px f500">URL</h5>
                            <input type="text" name="detailurl" placeholder="Enter URL"/>
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="fs12px f500 p0-10">Choices</h5>
                        <div class="col s12" id="choiceslist">
                            <div class="row choice mb10">
                                <div class="col s11">
                                    <input type="text" name="choice[]"placeholder="Enter Choices"/>
                                </div>
                                <div class="col s1 no-padding">
                                    <i class="flaticon-delete removechoice"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h5 class="fs12px center gray">(Text in the last Choice adds a New Field)</h5>
                    <div class="row center mt35b20">
                        <input type="hidden" id="poll_id" name="poll_id" value="">
                        <button type="submit" class="btn btn-default themered br7px mr10">Save</button>
                        <button type="reset" class="btn btn-default secondarybtn br7px">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col l8 s12 p-0">
            <div id="mydiscuss" class="col s12">

            </div>
            <div id="elecforum" class="col s12 active">
                <div class="row">
                    <div class="col l12 m12 s12">
                        <div class="card p5-20  equal-height">
                            <div class="card_content ">
                                <div class="row mb10">
                                    <div class="col m11 s11">
                                        <div class="col m3 s6"><h6 class="forumsubhead fs12px tastart" style="color: #6F7781;"><a href="#"><i>By You</i></a></h6></div>
                                        <div class="col m9 s6"><h6 class="forumsubhead fs10px"><i>10-May-2018</i></h6></div>
                                        <div class="col m12 s10">
                                            <div class="category fs12px elections">Elections</div>
                                            <h6 class="fs14px tastart" style="">Who will win Karnataka elections</h6>
                                        </div>
                                    </div>
                                    <div class="col m1 s1">
                                        <div class="votescountbox"><span>220</span><div class="text">Voted</div></div>
                                    </div>
                                </div>

                                <div class="row mb0">
                                    <div class="polloptions col m11 p-0" id="polloptionel_1">
                                        <div class = " col m3 s12">
                                            <div class = "row mb0">
                                                <div class = "col m2 s2">
                                                    <label>
                                                        <input class = "with-gap" name = "pollchoice_1" type = "radio" value=""/>
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class = "col m10 s10">
                                                    <div class = "row mb10">
                                                        <div class = "col m6 s6">BJP</div>
                                                        <div class = "col m6 s3"><label class = "fs10px">50%</label></div>
                                                    </div>
                                                    <div class = "row mb10">
                                                        <div class = "col m12 s12">
                                                            <div class = "polloption progress">
                                                                <div class = "determinate" style = "width: 50%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = " col m3 s12">
                                            <div class = "row mb0">
                                                <div class = "col m2 s2">
                                                    <label>
                                                        <input class = "with-gap" name = "pollchoice_1" type = "radio" value=""/>
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class = "col m10 s10">
                                                    <div class = "row mb10">
                                                        <div class = "col m6 s6">INC</div>
                                                        <div class = "col m6 s3"><label class = "fs10px">20%</label></div>
                                                    </div>
                                                    <div class = "row mb10">
                                                        <div class = "col m12 s12">
                                                            <div class = "polloption progress">
                                                                <div class = "determinate" style = "width: 20%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = " col m3 s12">
                                            <div class = "row mb0">
                                                <div class = "col m2 s2">
                                                    <label>
                                                        <input class = "with-gap" name = "pollchoice_1" type = "radio" value=""/>
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class = "col m10 s10">
                                                    <div class = "row mb10">
                                                        <div class = "col m6 s6">JDS</div>
                                                        <div class = "col m6 s3"><label class = "fs10px">30%</label></div>
                                                    </div>
                                                    <div class = "row mb10">
                                                        <div class = "col m12 s12">
                                                            <div class = "polloption progress">
                                                                <div class = "determinate" style = "width: 30%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col m1 s12 show-on-med-and-up hide-on-small-only">
                                        <input type="submit" data-pollid="1"  class="btn btn-default themered pollbtnvote right" value="vote"/>
                                    </div>
                                    <div class="col s12 center-align hide-on-med-and-up show-on-small">
                                        <input type="submit" data-pollid="1"  class="btn btn-default themered pollbtnvote" value="vote"/>
                                    </div>
                                </div>
                                <hr style="width: 99%;border: 0.3px solid #ebf3fc;">
                                <div class="row mb10">
                                    <div class="col s12 cmtop right-align show-on-med-and-up hide-on-small-only">
                                        <a href="<?= base_url()?>/Poll/polldetail/1" class="flaticon-multimedia  mr20 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">25 comments</a>
                                        <span class="flaticon-multimedia-1  mr20 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">Share</span>
                                        <a href="<?= base_url()?>/Poll/polldetail/1" class="fs12px mr20 fw500">View More</a>
                                    </div>
                                    <div class="col s12 cmtop right-align hide-on-med-and-up show-on-small">
                                        <a href="<?= base_url()?>/Poll/polldetail/1" class="flaticon-multimedia  mr10 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">25 comments</a>
                                        <span class="flaticon-multimedia-1  mr10 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">Share</span>
                                        <a href="<?= base_url()?>/Poll/polldetail/1" class="fs12px mr10 fw500">View More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l12 m12 s12">
                        <div class="card p5-20  equal-height">
                            <div class="card_content ">
                                <div class="row mb10">
                                    <div class="col m11 s11">
                                        <div class="col m3 s6"><h6 class="forumsubhead fs12px tastart" style="color: #6F7781;"><a href="#"><i>By You</i></a></h6></div>
                                        <div class="col m9 s6"><h6 class="forumsubhead fs10px"><i>10-May-2018</i></h6></div>
                                        <div class="col m12 s10">
                                            <div class="category fs12px elections">Elections</div>
                                            <h6 class="fs14px tastart" style="">Who will win Karnataka elections</h6>
                                        </div>
                                    </div>
                                    <div class="col m1 s1">
                                        <div class="votescountbox"><span>220</span><div class="text">Voted</div></div>
                                    </div>
                                </div>

                                <div class="row mb0">
                                    <div class="polloptions col m11 p-0" id="polloptionel_2">
                                        <div class = " col m3 s12">
                                            <div class = "row mb0">
                                                <div class = "col m2 s2">
                                                    <label>
                                                        <input class = "with-gap" name = "pollchoice_1" type = "radio" value=""/>
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class = "col m10 s10">
                                                    <div class = "row mb10">
                                                        <div class = "col m6 s6">BJP</div>
                                                        <div class = "col m6 s3"><label class = "fs10px">50%</label></div>
                                                    </div>
                                                    <div class = "row mb10">
                                                        <div class = "col m12 s12">
                                                            <div class = "polloption progress">
                                                                <div class = "determinate" style = "width: 50%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = " col m3 s12">
                                            <div class = "row mb0">
                                                <div class = "col m2 s2">
                                                    <label>
                                                        <input class = "with-gap" name = "pollchoice_1" type = "radio" value=""/>
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class = "col m10 s10">
                                                    <div class = "row mb10">
                                                        <div class = "col m6 s6">INC</div>
                                                        <div class = "col m6 s3"><label class = "fs10px">20%</label></div>
                                                    </div>
                                                    <div class = "row mb10">
                                                        <div class = "col m12 s12">
                                                            <div class = "polloption progress">
                                                                <div class = "determinate" style = "width: 20%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = " col m3 s12">
                                            <div class = "row mb0">
                                                <div class = "col m2 s2">
                                                    <label>
                                                        <input class = "with-gap" name = "pollchoice_1" type = "radio" value=""/>
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class = "col m10 s10">
                                                    <div class = "row mb10">
                                                        <div class = "col m6 s6">JDS</div>
                                                        <div class = "col m6 s3"><label class = "fs10px">30%</label></div>
                                                    </div>
                                                    <div class = "row mb10">
                                                        <div class = "col m12 s12">
                                                            <div class = "polloption progress">
                                                                <div class = "determinate" style = "width: 30%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col m1 s12 show-on-med-and-up hide-on-small-only">
                                        <input type="submit" data-pollid="2"  class="btn btn-default themered pollbtnvote right" value="vote"/>
                                    </div>
                                    <div class="col s12 center-align hide-on-med-and-up show-on-small">
                                        <input type="submit" data-pollid="2"  class="btn btn-default themered pollbtnvote" value="vote"/>
                                    </div>
                                </div>
                                <hr style="width: 99%;border: 0.3px solid #ebf3fc;">
                                <div class="row mb10">
                                    <div class="col s12 cmtop right-align show-on-med-and-up hide-on-small-only">
                                        <a href="<?= base_url()?>/Poll/polldetail/1" class="flaticon-multimedia  mr20 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">25 comments</a>
                                        <span class="flaticon-multimedia-1  mr20 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">Share</span>
                                        <a href="<?= base_url()?>/Poll/polldetail/1" class="fs12px mr20 fw500">View More</a>
                                    </div>
                                    <div class="col s12 cmtop right-align hide-on-med-and-up show-on-small">
                                        <a href="<?= base_url()?>/Poll/polldetail/1" class="flaticon-multimedia  mr10 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">25 comments</a>
                                        <span class="flaticon-multimedia-1  mr10 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">Share</span>
                                        <a href="<?= base_url()?>/Poll/polldetail/1" class="fs12px mr10 fw500">View More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l12 m12 s12">
                        <div class="card p5-20  equal-height">
                            <div class="card_content ">
                                <div class="row mb10">
                                    <div class="col m11 s11">
                                        <div class="col m3 s6"><h6 class="forumsubhead fs12px tastart" style="color: #6F7781;"><a href="#"><i>By You</i></a></h6></div>
                                        <div class="col m9 s6"><h6 class="forumsubhead fs10px"><i>10-May-2018</i></h6></div>
                                        <div class="col m12 s10">
                                            <div class="category fs12px elections">Elections</div>
                                            <h6 class="fs14px tastart" style="">Who will win Karnataka elections</h6>
                                        </div>
                                    </div>
                                    <div class="col m1 s1">
                                        <div class="votescountbox"><span>220</span><div class="text">Voted</div></div>
                                    </div>
                                </div>

                                <div class="row mb0">
                                    <div class="polloptions col m11 p-0" id="polloptionel_3">
                                        <div class = " col m3 s12">
                                            <div class = "row mb0">
                                                <div class = "col m2 s2">
                                                    <label>
                                                        <input class = "with-gap" name = "pollchoice_1" type = "radio" value=""/>
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class = "col m10 s10">
                                                    <div class = "row mb10">
                                                        <div class = "col m6 s6">BJP</div>
                                                        <div class = "col m6 s3"><label class = "fs10px">50%</label></div>
                                                    </div>
                                                    <div class = "row mb10">
                                                        <div class = "col m12 s12">
                                                            <div class = "polloption progress">
                                                                <div class = "determinate" style = "width: 50%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = " col m3 s12">
                                            <div class = "row mb0">
                                                <div class = "col m2 s2">
                                                    <label>
                                                        <input class = "with-gap" name = "pollchoice_1" type = "radio" value=""/>
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class = "col m10 s10">
                                                    <div class = "row mb10">
                                                        <div class = "col m6 s6">INC</div>
                                                        <div class = "col m6 s3"><label class = "fs10px">20%</label></div>
                                                    </div>
                                                    <div class = "row mb10">
                                                        <div class = "col m12 s12">
                                                            <div class = "polloption progress">
                                                                <div class = "determinate" style = "width: 20%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = " col m3 s12">
                                            <div class = "row mb0">
                                                <div class = "col m2 s2">
                                                    <label>
                                                        <input class = "with-gap" name = "pollchoice_1" type = "radio" value=""/>
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class = "col m10 s10">
                                                    <div class = "row mb10">
                                                        <div class = "col m6 s6">JDS</div>
                                                        <div class = "col m6 s3"><label class = "fs10px">30%</label></div>
                                                    </div>
                                                    <div class = "row mb10">
                                                        <div class = "col m12 s12">
                                                            <div class = "polloption progress">
                                                                <div class = "determinate" style = "width: 30%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col m1 s12 show-on-med-and-up hide-on-small-only">
                                        <input type="submit" data-pollid="3"  class="btn btn-default themered pollbtnvote right" value="vote"/>
                                    </div>
                                    <div class="col s12 center-align hide-on-med-and-up show-on-small">
                                        <input type="submit" data-pollid="3"  class="btn btn-default themered pollbtnvote" value="vote"/>
                                    </div>
                                </div>
                                <hr style="width: 99%;border: 0.3px solid #ebf3fc;">
                                <div class="row mb10">
                                    <div class="col s12 cmtop right-align show-on-med-and-up hide-on-small-only">
                                        <a href="<?= base_url()?>/Poll/polldetail/1" class="flaticon-multimedia  mr20 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">25 comments</a>
                                        <span class="flaticon-multimedia-1  mr20 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">Share</span>
                                        <a href="<?= base_url()?>/Poll/polldetail/1" class="fs12px mr20 fw500">View More</a>
                                    </div>
                                    <div class="col s12 cmtop right-align hide-on-med-and-up show-on-small">
                                        <a href="<?= base_url()?>/Poll/polldetail/1" class="flaticon-multimedia  mr10 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">25 comments</a>
                                        <span class="flaticon-multimedia-1  mr10 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">Share</span>
                                        <a href="<?= base_url()?>/Poll/polldetail/1" class="fs12px mr10 fw500">View More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l12 m12 s12">
                        <div class="card p5-20  equal-height">
                            <div class="card_content ">
                                <div class="row mb10">
                                    <div class="col m11 s11">
                                        <div class="col m3 s6"><h6 class="forumsubhead fs12px tastart" style="color: #6F7781;"><a href="#"><i>By You</i></a></h6></div>
                                        <div class="col m9 s6"><h6 class="forumsubhead fs10px"><i>10-May-2018</i></h6></div>
                                        <div class="col m12 s10">
                                            <div class="category fs12px elections">Elections</div>
                                            <h6 class="fs14px tastart" style="">Who will win Karnataka elections</h6>
                                        </div>
                                    </div>
                                    <div class="col m1 s1">
                                        <div class="votescountbox"><span>220</span><div class="text">Voted</div></div>
                                    </div>
                                </div>

                                <div class="row mb0">
                                    <div class="polloptions col m11 p-0" id="polloptionel_4">
                                        <div class = " col m3 s12">
                                            <div class = "row mb0">
                                                <div class = "col m2 s2">
                                                    <label>
                                                        <input class = "with-gap" name = "pollchoice_1" type = "radio" value=""/>
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class = "col m10 s10">
                                                    <div class = "row mb10">
                                                        <div class = "col m6 s6">BJP</div>
                                                        <div class = "col m6 s3"><label class = "fs10px">50%</label></div>
                                                    </div>
                                                    <div class = "row mb10">
                                                        <div class = "col m12 s12">
                                                            <div class = "polloption progress">
                                                                <div class = "determinate" style = "width: 50%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = " col m3 s12">
                                            <div class = "row mb0">
                                                <div class = "col m2 s2">
                                                    <label>
                                                        <input class = "with-gap" name = "pollchoice_1" type = "radio" value=""/>
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class = "col m10 s10">
                                                    <div class = "row mb10">
                                                        <div class = "col m6 s6">INC</div>
                                                        <div class = "col m6 s3"><label class = "fs10px">20%</label></div>
                                                    </div>
                                                    <div class = "row mb10">
                                                        <div class = "col m12 s12">
                                                            <div class = "polloption progress">
                                                                <div class = "determinate" style = "width: 20%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = " col m3 s12">
                                            <div class = "row mb0">
                                                <div class = "col m2 s2">
                                                    <label>
                                                        <input class = "with-gap" name = "pollchoice_1" type = "radio" value=""/>
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class = "col m10 s10">
                                                    <div class = "row mb10">
                                                        <div class = "col m6 s6">JDS</div>
                                                        <div class = "col m6 s3"><label class = "fs10px">30%</label></div>
                                                    </div>
                                                    <div class = "row mb10">
                                                        <div class = "col m12 s12">
                                                            <div class = "polloption progress">
                                                                <div class = "determinate" style = "width: 30%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col m1 s12 show-on-med-and-up hide-on-small-only">
                                        <input type="submit" data-pollid="4"  class="btn btn-default themered pollbtnvote right" value="vote"/>
                                    </div>
                                    <div class="col s12 center-align hide-on-med-and-up show-on-small">
                                        <input type="submit" data-pollid="4"  class="btn btn-default themered pollbtnvote" value="vote"/>
                                    </div>
                                </div>
                                <hr style="width: 99%;border: 0.3px solid #ebf3fc;">
                                <div class="row mb10">
                                    <div class="col s12 cmtop right-align show-on-med-and-up hide-on-small-only">
                                        <a href="<?= base_url()?>/Poll/polldetail/1" class="flaticon-multimedia  mr20 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">25 comments</a>
                                        <span class="flaticon-multimedia-1  mr20 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">Share</span>
                                        <a class="fs12px mr20 fw500">View More</a>
                                    </div>
                                    <div class="col s12 cmtop right-align hide-on-med-and-up show-on-small">
                                        <a href="<?= base_url()?>/Poll/polldetail/1" class="flaticon-multimedia  mr10 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">25 comments</a>
                                        <span class="flaticon-multimedia-1  mr10 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">Share</span>
                                        <a class="fs12px mr10 fw500">View More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l12 m12 s12">
                        <div class="card p5-20  equal-height">
                            <div class="card_content ">
                                <div class="row mb10">
                                    <div class="col m11 s11">
                                        <div class="col m3 s6"><h6 class="forumsubhead fs12px tastart" style="color: #6F7781;"><a href="#"><i>By You</i></a></h6></div>
                                        <div class="col m9 s6"><h6 class="forumsubhead fs10px"><i>10-May-2018</i></h6></div>
                                        <div class="col m12 s10">
                                            <div class="category fs12px elections">Elections</div>
                                            <h6 class="fs14px tastart" style="">Who will win Karnataka elections</h6>
                                        </div>
                                    </div>
                                    <div class="col m1 s1">
                                        <div class="votescountbox"><span>220</span><div class="text">Voted</div></div>
                                    </div>
                                </div>

                                <div class="row mb0">
                                    <div class="polloptions col m11 p-0" id="polloptionel_5">
                                        <div class = " col m3 s12">
                                            <div class = "row mb0">
                                                <div class = "col m2 s2">
                                                    <label>
                                                        <input class = "with-gap" name = "pollchoice_1" type = "radio" value=""/>
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class = "col m10 s10">
                                                    <div class = "row mb10">
                                                        <div class = "col m6 s6">BJP</div>
                                                        <div class = "col m6 s3"><label class = "fs10px">50%</label></div>
                                                    </div>
                                                    <div class = "row mb10">
                                                        <div class = "col m12 s12">
                                                            <div class = "polloption progress">
                                                                <div class = "determinate" style = "width: 50%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = " col m3 s12">
                                            <div class = "row mb0">
                                                <div class = "col m2 s2">
                                                    <label>
                                                        <input class = "with-gap" name = "pollchoice_1" type = "radio" value=""/>
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class = "col m10 s10">
                                                    <div class = "row mb10">
                                                        <div class = "col m6 s6">INC</div>
                                                        <div class = "col m6 s3"><label class = "fs10px">20%</label></div>
                                                    </div>
                                                    <div class = "row mb10">
                                                        <div class = "col m12 s12">
                                                            <div class = "polloption progress">
                                                                <div class = "determinate" style = "width: 20%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = " col m3 s12">
                                            <div class = "row mb0">
                                                <div class = "col m2 s2">
                                                    <label>
                                                        <input class = "with-gap" name = "pollchoice_1" type = "radio" value=""/>
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class = "col m10 s10">
                                                    <div class = "row mb10">
                                                        <div class = "col m6 s6">JDS</div>
                                                        <div class = "col m6 s3"><label class = "fs10px">30%</label></div>
                                                    </div>
                                                    <div class = "row mb10">
                                                        <div class = "col m12 s12">
                                                            <div class = "polloption progress">
                                                                <div class = "determinate" style = "width: 30%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col m1 s12 show-on-med-and-up hide-on-small-only">
                                        <input type="submit" data-pollid="5"  class="btn btn-default themered pollbtnvote right" value="vote"/>
                                    </div>
                                    <div class="col s12 center-align hide-on-med-and-up show-on-small">
                                        <input type="submit" data-pollid="5"  class="btn btn-default themered pollbtnvote" value="vote"/>
                                    </div>
                                </div>
                                <hr style="width: 99%;border: 0.3px solid #ebf3fc;">
                                <div class="row mb10">
                                    <div class="col s12 cmtop right-align show-on-med-and-up hide-on-small-only">
                                        <a href="<?= base_url()?>/Poll/polldetail/1" class="flaticon-multimedia  mr20 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">25 comments</a>
                                        <span class="flaticon-multimedia-1  mr20 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">Share</span>
                                        <a class="fs12px mr20 fw500">View More</a>
                                    </div>
                                    <div class="col s12 cmtop right-align hide-on-med-and-up show-on-small">
                                        <a href="<?= base_url()?>/Poll/polldetail/1" class="flaticon-multimedia  mr10 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">25 comments</a>
                                        <span class="flaticon-multimedia-1  mr10 fw500 gray fs12px  linkpointer showreplies" data-cmtid="1" data-forumid="1" data-replyset="0">Share</span>
                                        <a class="fs12px mr10 fw500">View More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="stockforum" class="col s12">
                <div class="row">
                </div>
            </div>
            <div id="sportforum" class="col s12 ">
                <div class="row">

                </div>
            </div>
            <div id="movieforum" class="col s12">
                <div class="row">
                </div>
            </div>
        </div>
        <div class="col l4 m12 s12 plr15">
            <div class="card z-depth-4 padd0 ">
                <div class="card-head">
                    <div class="bloghead">Answered Polls</div>
                </div>
                <div class="polls-container withtable">
                    <div class="row">
                        <div class="col s12">
                            <?php foreach ($allforum as $af) { ?>
                                <div class="polls">
                                    <a href="<?= base_url() ?>Forum/forumdetail/<?= $af['id'] ?>">
                                    </a>
                                    <div class="row mb10">
                                        <div class="col s12">
                                            <a href="<?= base_url() ?>Forum/forumdetail/<?= $af['id'] ?>">
                                                <div class="poll-details text-upper"><?= $af['category_name']; ?></div>
                                                <div class="poll-title truncate"><?= $af['title']; ?></div>

                                                <div class="poll-details fw500"><?= date('j M Y', strtotime($af['created_date'])); ?></div>
                                                <div class="polloptions"><div class="row mb0"><div class="col m12"><span style="color:#232b3c">Yes</span></div></div>
                                                    <div class="row mb0"><div class="col m12 s12 p-0">
                                                            <div class="col m8 s8">
                                                                <div class="polloption progress">
                                                                    <div class="determinate" style="width: 30%"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col m2 s2"><label class="fs10px mr5">30%</label></div>
                                                            <div class="col m2 s2"><label class="fs10px text-lower">120Voted</label></div>
                                                        </div></div></div>
                                                <div class="polloptions"><div class="row mb0"><div class="col m12"><span style="color:#232b3c">Yes</span></div></div>
                                                    <div class="row mb0"><div class="col m12 s12 p-0">
                                                            <div class="col m8">
                                                                <div class="polloption progress">
                                                                    <div class="determinate" style="width: 30%"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col m2 s2"><label class="fs10px mr5">30%</label></div>
                                                            <div class="col m2 s2"><label class="fs10px text-lower">120Voted</label></div>
                                                        </div></div></div>
                                                <div class="polloptions"><div class="row mb0"><div class="col m12"><span style="color:#232b3c">Yes</span></div></div>
                                                    <div class="row mb0"><div class="col m12 s12 p-0">
                                                            <div class="col m8">
                                                                <div class="polloption progress">
                                                                    <div class="determinate" style="width: 30%"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col m2 s2"><label class="fs10px mr5">30%</label></div>
                                                            <div class="col m2 s2"><label class="fs10px text-lower">120Voted</label></div>
                                                        </div></div></div>
                                                <div class="polloptions"><div class="row mb0"><div class="col m12"><span style="color:#232b3c">Yes</span></div></div>
                                                    <div class="row mb0"><div class="col m12 s12 p-0">
                                                            <div class="col m8">
                                                                <div class="polloption progress">
                                                                    <div class="determinate" style="width: 30%"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col m2 s2"><label class="fs10px mr5">30%</label></div>
                                                            <div class="col m2 s2"><label class="fs10px text-lower">120Voted</label></div>
                                                        </div></div></div>
                                                <div class="polloptions"><div class="row mb0"><div class="col m12"><span style="color:#232b3c">Yes</span></div></div>
                                                    <div class="row mb0"><div class="col m12 s12 p-0">
                                                            <div class="col m8">
                                                                <div class="polloption progress">
                                                                    <div class="determinate" style="width: 30%"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col m2 s2"><label class="fs10px mr5">30%</label></div>
                                                            <div class="col m2 s2"><label class="fs10px text-lower">120Voted</label></div>
                                                        </div></div></div>
                                            </a>
                                            <div class="poll-author"><a href="<?= base_url() ?>Forum/forumdetail/<?= $af['id'] ?>" target="_blank"></a><a href=""></a></div>
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
<script>
    $("#tabs-swipe-demo").tabs({
        create: function (event, ui) {
            //executed after tab is created.
            $('.tabs_content').show();
        },
        show: function (event, ui) {
            //on every tabs clicked
        }
    });
    $(function () {
        if (window.location.hash) {
            var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
            $('#tabs-swipe-demo>li>a').removeClass('active');
            if (hash == "elecforum") {
                $('#forumcatergory').val("1");
                $('#forumcatergory').material_select();
            } else if (hash == "stockforum") {
                $('#forumcatergory').val("2");
                $('#forumcatergory').material_select();
            } else if (hash == "sportforum") {
                $('#forumcatergory').val("3");
                $('#forumcatergory').material_select();
            } else if (hash == "movieforum") {
                $('#forumcatergory').val("4");
                $('#forumcatergory').material_select();
            } else {
                $('#forumcatergory').val("");
                $('#forumcatergory').material_select();
            }
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

    $('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrain_width: false, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        gutter: 0, // Spacing from edge
        belowOrigin: false // Displays dropdown below the button
    }
    );

    function showComments(id) {
        //$('div[class^="replies"]').slideUp();
        $('.replies' + id).slideToggle();
    }


    function validateForm() {
        var topic = $("#textarea1").val();
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
        if (pollcategory == "" || pollcategory == null) {
            Materialize.Toast.removeAll();
            Materialize.toast('Please Select Category!', 4000);
            return false;
        }
        if (choicearray && choicearray.length <= 2) {
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

        if (id == "elecforum") {
            $('#forumcatergory').val("1");
            $('#forumcatergory').material_select();
        } else if (id == "stockforum") {
            $('#forumcatergory').val("2");
            $('#forumcatergory').material_select();
        } else if (id == "sportforum") {
            $('#forumcatergory').val("3");
            $('#forumcatergory').material_select();
        } else if (id == "movieforum") {
            $('#forumcatergory').val("4");
            $('#forumcatergory').material_select();
        } else {
            $('#forumcatergory').val("");
            $('#forumcatergory').material_select();
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


    $(document).on('keypress', '.choice input', function (e) {
        var visible = $("#choiceslist .choice").length;
        var html = "";
        if (!$(this).hasClass("shown") && visible < 8) {
            if (visible > 1) {
                $('.choice:first-child .removechoice').css('display', 'block');
            } else {
                $('.choice:first-child .removechoice').css('display', 'none');
            }
            $(this).addClass("shown")
            html = '<div class="row choice mb10">\
                    <div class="col s11">\
                        <input type="text" name="choice[]"placeholder="Enter Choices"/>\
                    </div>\
                    <div class="col s1 no-padding">\
                        <i class="flaticon-delete removechoice"></i>\
                    </div>\
                </div>';
            $('#choiceslist').append(html);
        }
    });
    $(document).on('click', '.removechoice', function (e) {
        var visible = $("#choiceslist .choice").length;
        if (visible > 2) {
            console.log(visible);
            if (visible > 3) {
                $('.choice:first-child .removechoice').css('display', 'block');
            } else {
                $('.choice:first-child .removechoice').css('display', 'none');
            }
            $(this).parent().parent().remove();
            $("#choiceslist .choice:last-child input").removeClass('shown');

        } else {
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
        //alert("#polloptionel_"+pollid);
        $("#polloptionel_" + pollid).addClass('votedpoll');
//        if ($("input[name='pollchoice_" + pollid + "']").is(":checked")) {
//            var userchoice = $("input[name='pollchoice_" + pollid + "']:checked").val();
//            $.ajax({
//                "url": "Poll/addpollchoice",
//                "method": "POST",
//                "data": {"poll_id": pollid, "choice": userchoice}
//            }).done(function (result) {
//                result = JSON.parse(result);
//                if (result['status'])
//                {
//                    $("#polloption_"+pollid).addClass('votedpoll');
//                    Materialize.Toast.removeAll();
//                    Materialize.toast(result['message'], 4000);
//                } else {
//                    <?php if (empty($this->session->userdata('data'))) { ?>
    //                        window.location.assign("<?= base_url() ?>Login");
    //                    <?php } ?>
//                }
//
//            });
//
//        } else {
//            Materialize.Toast.removeAll();
//            Materialize.toast('Please select choice', 4000);
//        }

        //console.log(userchoice);
    });
</script>


