<?php
$today = date( "Y-m-d H:i:s" );
$this -> load -> helper( 'common_helper' );
?>
<style>
    button + .votescountbox{
        display:none;
    }
</style>
<input type="hidden" id="redirecturl" value="<?= base_url() ?>index.php/Login?section=survey">
<div class="content container forumpages forumpagelist surveylists polllists" id="forumdetailpage">
    <div class="col s12">
        <div class="row">
            <div class="col l8 s12 plr15">
                <div class="row slide-on-mobile-button">
                    <div class="col s12 center-align hide-on-med-and-up show-on-small raiseapoll_mob">
                        <div class="olive askvotebanner" id="askvotebanner" style="margin-top: 20px;">
                            <div class="row m-0">
                                <div class="col s4 p0">
                                    <div class="asknwpoll">
                                        <img src="<?= base_url( 'images/banners/raise_poll.png' ); ?>" alt="">
                                    </div>
                                </div>
                                <div class="col s8 p0">
                                    <!--<h3 class="fs12px mtb7px fw500">Ask a Question and earn <br />Rs 1000 if it comes in <br />Top 5 (Responses) by Sunday Evening <br /><a id="show-mobile-discussion" class="btn btn-default bluegray votenow start-discussion" style="margin-top: 10px;">Ask Now</a></h3>-->
                                    <h3 class="fs12px mtb7px fw500">Ask a Question on any topic <br /><a id="show-mobile-discussion" class="btn btn-default bluegray votenow start-discussion" style="margin-top: 10px;">Ask Now</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 left-align show-on-med-and-up hide-on-small-only ">
                        <div class="olive askvotebanner" id="askvotebanner" style="margin-top: 20px;">
                            <div class="row m-0">
                                <div class="col s4">
                                    <div class="asknwpoll">
                                        <img src="<?= base_url( 'images/banners/raise_poll.png' ); ?>" alt="">
                                    </div>
                                </div>

                                <div class="col s8" style="padding: 20px;">
                                    <!--<h3 class="fs16px m-0 fw500">Ask a Question and earn Rs 1000 if it comes in <br /> Top 5 (Responses) by Sunday Evening <br /><a id="show-mobile-discussion" class="btn btn-default bluegray votenow start-discussion" style="margin-top: 10px;transform: translateX(100%);">Ask Now</a></h3>-->
                                    <h3 class="fs16px m-0 fw500"><div class="center-align">Ask a Question on any topic</div> <br /><a id="show-mobile-discussion" class="btn btn-default bluegray votenow start-discussion" style="margin-top: 10px;transform: translateX(130%);">Ask Now</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12">
                    <div class="row slide-on-mobile">
                        <div class="" style="position:relative;">
                            <form id="postpoll" name="myform" method="POST" action="<?= base_url() ?>Survey/add_update_poll"  onsubmit="return validateForm()">
                                <div class="card forumarea">
                                    <div class="row mb0">
                                        <div class="col m12 s12">
                                            <div class="row mb0">
                                                <div class="col s12">
                                                    <textarea id="polltopic" name="polltopic" placeholder="Ask your question with 'What' , 'Why' , 'Which' etc" maxlength="75"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col m12 s12">
                                            <h5 class="fs13px fw600 fieldtitle">Description</h5>
                                            <textarea data-autoresize class="textarea-scrollbar" id="polldescription" name="polldescription" placeholder="Type your description here" maxlength="400" row="3" ></textarea>
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
                                    <div class="row center mt35b20">
                                        <input type="hidden" id="poll_id" name="poll_id" value="0">
                                        <input type="hidden" id="poll_preview" name="poll_preview" value="">
                                        <button type="submit" class="btn btn-default themered orgtored mr10">Save</button>
                                        <button type="reset" class="knowmore borgtored p-0"><h5 class="txtorgtored fs14px fw500">Cancel</h5></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="" style="position:relative">
                        <div class="loadersmall">
                            <div class="lds-roller">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>

                            </div>
                        </div>
                    </div>
                    <div id="elecpoll" class="col s12 active">
                        <div class="row mb0">
                            <?php
                            if ( ! empty( $survey_list ) ) {
                                    ?>
                                    <?php
                                    foreach ( $survey_list as $gov ) {
                                            ?>
                                            <div class="col l12 m12 s12">
                                                <?php
                                                $spchar = array ( "~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "|", "/", ";", "'", "<", ">", ",", '"', "?" );
                                                $title = str_replace( $spchar, "", $gov[ 'question' ] );
                                                $title = str_replace( ' ', '-', $title );

                                                $uri_parts = explode( '?', $_SERVER[ 'REQUEST_URI' ] );

                                                $href = urlencode( base_url() . "Survey/surveydetail/" . $gov[ 'id' ] . "?_t=" . time() );
                                                $target = 'target = "_blank"';
                                                $preview = "";
                                                ?>
                                                <?php
                                                $d1 = strtotime( $gov[ 'end_date' ] );
                                                $d2 = strtotime( $today );
                                                $end_date = date( 'Y-m-d', $d1 );
                                                $today = date( 'Y-m-d', $d2 );
                                                ?>
                                                <div class="card p20  equal-height" id="card_<?= $gov[ 'id' ]; ?>">
                                                    <div class="card_content pollcard-scrollbar">
                                                        <div class="row mb0">
                                                            <div class="col m2 s3">
                                                                <div class="votescountbox">
                                                                    <img src="<?= base_url( 'images/common/vote.png' ); ?>" alt=""/>
                                                                    <?php
                                                                    $votesdigits = "";
                                                                    if ( $gov[ 'total_votes' ] > 0 && $gov[ 'total_votes' ] < 10 ) {
                                                                            $votesdigits = "twodigit";
                                                                            $gov[ 'total_votes' ] = '0' . $gov[ 'total_votes' ];
                                                                    }
                                                                    if ( $gov[ 'total_votes' ] > 9 && $gov[ 'total_votes' ] <= 99 ) {
                                                                            $votesdigits = "twodigit";
                                                                    } else if ( $gov[ 'total_votes' ] > 99 ) {
                                                                            $votesdigits = "threedigit";
                                                                    }
                                                                    ?>
                                                                    <span class="fs14px fw500 votetext_<?= $gov[ 'id' ]; ?> <?= $votesdigits ?>"><?= $gov[ 'total_votes' ] ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col m9 s8">
                                                                <div class="col s12">
                                                                    <div class="row mb10">
                                                                        <h6 class="fs18px tastart fw500 m-0 pollquestion" style=""><?= linkify( $gov[ 'question' ] ) ?></h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            $preview = preg_replace( "/\r\n|\r|\n/", '<br/>', $gov[ 'preview' ] );
                                                            unset( $gov[ 'preview' ] );
                                                            ?>
                                                            <?php if ( $gov[ 'user_id' ] == $uid ) { ?>
                                                                    <div class="col m1 s1">
                                                                        <div class="">
                                                                            <a materialize="dropdown" class='dropdown-button pollubhead right'  href='#' data-activates='mypollactions_<?= $gov[ 'id' ]; ?>'>
                                                                                <i class="flaticon-three-1"></i>
                                                                            </a>
                                                                            <ul id='mypollactions_<?= $gov[ 'id' ]; ?>' class='dropdown-content'>

                                                                                <li id="editpoll" class="<?php
                                                                                if ( $gov[ 'total_votes' ] > 25 ) {
                                                                                        echo "hide";
                                                                                }
                                                                                ?>" data-rowjson='<?php echo json_encode( $gov ); ?>' data-pollid="<?= $gov[ 'id' ] ?>" data-preview="<?= $preview ?>" data-title="<?= trim( preg_replace( '/\s\s+/', ' ', $gov[ 'question' ] ) ); ?>" >
                                                                                    <h6 class="fs16px mypoll ">Edit</h6>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="fs16px mypoll modal-trigger confdelete" href="#confirmdelete" data-pollid="<?= $gov[ 'id' ] ?>">Delete</a>
                                                                                </li>
                                                                                <li class="hide"><h6 class="fs16px mypoll">Report</h6></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="row mb0 minusmarvote">
                                                            <div class="col m2 s3 p-0">
                                                            </div>
                                                            <div class="col m9 s8">
                                                                <?php
                                                                $display_name = "";
                                                                if ( $gov[ 'raised_by_admin' ] == "1" ) {
                                                                        $display_name = '<img src="' . base_url() . 'images/logo/crowd-wisdom.png" class="bycrowdwisdom">';
                                                                } else {
                                                                        $display_name = ($uid == $gov[ 'user_id' ]) ? 'You' : $gov[ 'byuser' ];
                                                                }
                                                                ?>
                                                                <h6 class="forumsubhead fs12px tastart m-0 lightgray fw500"><i>By <?= $display_name ?>, <?= date( 'j M Y', strtotime( $gov[ 'created_date' ] ) ); ?> </i></h6>
                                                            </div>
                                                        </div>
                                                        <div class="row mb10">
                                                            <div class="col m12 s12 polldescr" id="description_gov<?= $gov[ 'id' ]; ?>">
                                                                <h6 class="fs14px tastart" style=""><?= linkify( $gov[ 'description' ] ) ?></h6>
                                                                <?= htmlspecialchars_decode( $preview ) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb0">

                                                        <?php
                                                        $allowvote = "";
                                                        $choicedisable = "";
                                                        if ( ! empty( $gov[ 'user_choice' ] ) ) {
                                                                $allowvote = "votedpoll";
                                                        }
                                                        ?>
                                                        <div data-tabname="gov" class="polloptions polloption_<?= $gov[ 'id' ]; ?>  p-0 <?= $allowvote ?> <?= $choicedisable ?>" id="polloptiongov_<?= $gov[ 'id' ]; ?>">
                                                            <?php foreach ( $gov[ 'options' ] as $index => $op ) { ?>
                                                                    <div class = "col m12 s12">
                                                                        <div class = "row mb7">
                                                                            <div class="col m12 s12">
                                                                                <label class = "polloption progress" style="position: relative;">
                                                                                    <?php
                                                                                    $showresults = "";
                                                                                    if ( $op[ 'choice' ] == "Do not know or skip" || strtolower( $op[ 'choice' ] ) == "see the results" ) {
                                                                                            $showresults = "showresults";
                                                                                    }
                                                                                    ?>
                                                                                    <input class = "with-gap <?= $showresults ?> pollchoice_<?= $gov[ 'id' ] ?>" name = "pollchoicegov_<?= $gov[ 'id' ] ?>" data-pollid="<?= $gov[ 'id' ] ?>" data-type="gov" data-total="<?= $op[ 'total' ] ?>" type = "radio" value="<?= $op[ 'choice_id' ]; ?>" <?= $op[ 'choice_id' ] == $gov[ 'user_choice' ] ? "checked" : "" ?>/>
                                                                                    <span class="customradio">
                                                                                        <i class="flaticon-check selected"></i>
                                                                                    </span>
                                                                                    <span class="fs14px choicetext"><?= ($op[ 'choice' ] == "Do not know or skip" || strtolower( $op[ 'choice' ] ) == "see the results" ? "<b>See The Results</b>" : $op[ 'choice' ]) ?></span><!--style="position:absolute;" -->
                                                                                    <div class = "determinate <?= $op[ 'choice_id' ] == $gov[ 'user_choice' ] ? "userselected" : "" ?>" style = "width: 0%" data-afterload="<?= $op[ 'avg' ] ?>"></div>
                                                                                    <?php
                                                                                    if ( strtolower( $op[ 'choice' ] ) != "see the results" ) {
                                                                                            ?>
                                                                                            <span class="avgpercount fs14px"><?= $op[ 'avg' ] ?> %</span>
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
                                                                <?php if ( ! empty( $gov[ 'user_choice' ] ) ) { ?>
                                                                <?php } else { ?>
                                                                        <button type="submit" data-pollid="<?= $gov[ 'id' ]; ?>"  data-type="gov" data-catid="<?= $gov[ 'category_id' ] ?>" data-totalvotes="<?= $gov[ 'total_votes' ] ?>" class="btn btn-default pollbtnvote mr20">Vote</button>
                                                                <?php } ?>
                                                                <span class="mr20">
                                                                    <span class="flaticon-multimedia ml0 mr10 fw500 lightgray fs14px  linkpointer  share red-text" data-section="gov" data-pollid="<?= $gov[ 'id' ]; ?>" data-shareurl="<?= $href ?>">Share
                                                                        <div class="tooltip share_gov<?= $gov[ 'id' ]; ?>"><div class="tooltip-arrow" style="left: 20%;"></div>
                                                                            <a class="share-icon facebook" data-mobile-iframe="true" href="http://www.facebook.com/sharer/sharer.php?u=<?= $href ?>" target="_blank"><span class="fa fa-facebook"></span></a>
                                                                            <a class="share-icon twitter" href="https://twitter.com/intent/tweet?url=<?= $href ?>&text='<?= urlencode( $gov[ 'question' ] ) ?>'&ael;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
                                                                            <a class="share-icon whatsapp" href="https://web.whatsapp.com/send?text=<?= $href ?>" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                                                            <a class="share-icon linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $href ?>&title=<?= $title ?>"  target="_blank"><span class="fa fa-linkedin"></span></a>
                                                                        </div>
                                                                    </span>
                                                                </span>
                                                                <span>
                                                                    <span class="flaticon-comment ml0 mr10 fw500 lightgray fs14px  linkpointer showritecmt red-text" data-section="gov" data-pollid="<?= $gov[ 'id' ]; ?>">Comment
                                                                    </span>
                                                                    <span class="pull-right lightgray fs14px fw500 showcmtcount red-text" data-totalcomments="<?= $gov[ 'total_comments' ] ?>" data-section="gov" data-pollid="<?= $gov[ 'id' ]; ?>" onclick="showcommentsec(<?= $gov[ 'id' ]; ?>, 'gov')"><?= $gov[ 'total_comments' ] ?> <?= $gov[ 'total_comments' ] > 1 ? " Comments" : " Comment" ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hide-on-med-and-up show-on-small">
                                                        <div class="row mb15 center">
                                                            <?php if ( ! empty( $gov[ 'user_choice' ] ) ) { ?>

                                                            <?php } else { ?>
                                                                    <button type="submit" data-pollid="<?= $gov[ 'id' ]; ?>"  data-type="gov" data-catid="<?= $gov[ 'category_id' ] ?>" data-totalvotes="<?= $gov[ 'total_votes' ] ?>" class="btn btn-default pollbtnvote mr7">Vote</button>
                                                            <?php }
                                                            ?>
                                                            <span class="flaticon-multimedia ml0 mr7 fw500 lightgray fs10px  linkpointer share red-text" data-section="gov" data-pollid="<?= $gov[ 'id' ]; ?>" data-shareurl="<?= $href ?>">Share<!--onclick="share('<?= urldecode( $href ) ?>', this)"-->
                                                                <div class="tooltip share_gov<?= $gov[ 'id' ]; ?>"><div class="tooltip-arrow" style="left: 20%;"></div>
                                                                    <a class="share-icon facebook" data-mobile-iframe="true" href="http://www.facebook.com/sharer/sharer.php?u=<?= $href ?>" target="_blank"><span class="fa fa-facebook"></span></a>
                                                                    <a class="share-icon twitter" href=" https://twitter.com/intent/tweet?url=<?= $href ?>&text='<?= urlencode( $gov[ 'question' ] ) ?>'&ael;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
                                                                    <a class="share-icon whatsapp" href="https://wa.me/?text=<?= $href ?>" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                                                    <a class="share-icon linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $href ?>&title=<?= $title ?>"  target="_blank"><span class="fa fa-linkedin"></span></a>
                                                                </div>
                                                            </span>
                                                            <span class="flaticon-comment ml0  mr7 fw500 lightgray fs10px  linkpointer showritecmt red-text" data-section="gov" data-pollid="<?= $gov[ 'id' ]; ?>"><?= $gov[ 'total_comments' ] > 1 ? "Comments" : "Comment" ?> <span class="cmtbadge"><?= $gov[ 'total_comments' ] ?></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="loadersmall" style="display:none"></div>
                                                    <div id="togglecmtsec_gov_<?= $gov[ 'id' ]; ?>" class="togglecmtsec">
                                                        <div class="row mb10">
                                                            <form id="postpollcomment" class="postpollcomment" name="postpollcmt" method="POST" action="<?= base_url() ?>Survey/add_comment">
                                                                <div class="col s12">
                                                                    <div style="position:relative">
                                                                        <textarea type="text" id="textarea1" class="writereply textarea-scrollbar" data-autoresize name="poll_comment" placeholder="Type your comments here..."></textarea>
                                                                        <span onclick="$(this).submit()" class="textareaicon"><span class="material-icons prefix sendarrowreply">send</span></span>
                                                                    </div>
                                                                    <input type="hidden" name="poll_id" value="<?= $gov[ 'id' ]; ?>"/>
                                                                    <input type="hidden" name="poll_cmt_id" value="0"/>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="row mb0" id="pollreact">
                                                            <div class="commentbox custom-scrollbar">
                                                                <?php
                                                                if ( ! empty( $gov[ 'All_comments' ] ) ) {
                                                                        ?>
                                                                        <?php
                                                                        foreach ( $gov[ 'All_comments' ] as $ac ) {
                                                                                ?>
                                                                                <div class="col s12">
                                                                                    <div class="commentsection" id="cm_<?= $ac[ 'id' ] ?>">
                                                                                        <div class="pollcardlist p-0">
                                                                                            <div class="row mb0">
                                                                                                <div class="col m11 s11">
                                                                                                    <h6 class="forumsubhead fs12px tastart mt5 lightgray fw500"><span class="flaticon-social-2 ml10 mr0"></span><i>By <?= $uid == $ac[ 'user_id' ] ? 'You' : $ac[ 'byuser' ]; ?>, <?= date( 'j M Y', strtotime( $ac[ 'created_date' ] ) ); ?> </i></h6>
                                                                                                </div>
                                                                                                <div class="col m1 s1">
                                                                                                    <?php
                                                                                                    if ( $ac[ 'user_id' ] == $uid ) {
                                                                                                            ?>
                                                                                                            <a materialize="dropdown" class='dropdown-button pollubhead right'  data-activates='mypollcmt<?= $ac[ 'id' ] ?>'>
                                                                                                                <i class="flaticon-three-1 lightgray is20px"></i>
                                                                                                            </a>
                                                                                                            <ul id='mypollcmt<?= $ac[ 'id' ] ?>' class='dropdown-content mpcmt'>
                                                                                                                <li>
                                                                                                                    <a class="fs16px editcmt" data-cmtid="<?= $ac[ 'id' ] ?>" data-cmttxt="<?= $ac[ 'comment' ] ?>" >Edit</a>
                                                                                                                </li>
                                                                                                                <li>
                                                                                                                    <a class="fs16px deletecmt" data-cmtid="<?= $ac[ 'id' ] ?>">Delete</a>
                                                                                                                </li>
                                                                                                            </ul>
                                                                                                            <?php
                                                                                                    }
                                                                                                    ?>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="ml45">
                                                                                                <div class="cmteditbox positir">
                                                                                                    <div class="mr35 whitespacepre"><?= $ac[ 'comment' ] ?></div>
                                                                                                    <div class="hide posrela">
                                                                                                        <textarea type="text" data-autoresize rows="2" id="cmt_<?= $ac[ 'id' ] ?>" data-value="<?= $ac[ 'comment' ] ?>" data-pollid="<?= $gov[ 'id' ] ?>" data-cmtid="<?= $ac[ 'id' ] ?>" readonly class="<?= $ac[ 'user_id' ] == $uid ? "commentedit" : "" ?> mb0 textarea-scrollbar"><?= $ac[ 'comment' ] ?></textarea>
                                                                                                        <span data-cmtid="<?= $ac[ 'id' ] ?>" class="textareaicon1"><span class="material-icons prefix sendarrow">send</span></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row txtbluegray cmtop mb0">
                                                                                                    <div class="col m7 s7"><h6 class="fs12px linkpointer showreplies_icon fs12px fw500 lightgray" data-cmtid="<?= $ac[ 'id' ] ?>" data-pollid="<?= $gov[ 'id' ] ?>" data-replyset="0"><i class="flaticon-arrow-1 lightgray"></i>Reply</h6></div>
                                                                                                    <div class="col m5 s5 right right-align">
                                                                                                        <span class="mr10 lightgray fs12px fw500 linkpointer showreplies" data-cmtid="<?= $ac[ 'id' ] ?>" data-pollid="<?= $gov[ 'id' ] ?>" data-replyset="0" data-totalreply="<?= $ac[ 'total_replies' ] ?>"><?= $ac[ 'total_replies' ] ?><?= $ac[ 'total_replies' ] > 1 ? " Replies" : " Reply" ?></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="replies<?= $ac[ 'id' ] ?>" style="display:none;">
                                                                                                    <div class="row m10">
                                                                                                        <form id="postpollcommentrply" method="POST">
                                                                                                            <div class="col m12 s12">
                                                                                                                <div style="position:relative">
                                                                                                                    <textarea type="text" id="textarea1" class="writereply textarea-scrollbar" data-autoresize name="poll_comment_reply" placeholder="Write a reply"></textarea>
                                                                                                                    <span onclick="$(this).submit()" class="textareaicon"><span class="material-icons prefix sendarrowreply">send</span></span>
                                                                                                                    <input type="hidden" name="poll_id" value="<?= $gov[ 'id' ] ?>"/>
                                                                                                                    <input type="hidden" name="comment_id" value="<?= $ac[ 'id' ] ?>"/>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </form>
                                                                                                    </div>
                                                                                                    <div id="replylist_<?= $ac[ 'id' ] ?>">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
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
                                                            if ( $gov[ 'total_comments' ] > 2 ) {
                                                                    ?>
                                                                    <div class="row mb0">
                                                                        <div class="col s12">
                                                                            <div class="loadmore fs12px fw500 lightgray" style="display:block" data-pageid="0" data-pollid="<?= $gov[ 'id' ]; ?>" data-sectype="gov" data-totalcomments="<?= $gov[ 'total_comments' ] ?>">View more comments.</div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                            } else if ( $gov[ 'total_comments' ] == 0 ) {
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
                                                </div>
                                            </div>
                                    <?php } ?>
                                    <?php if ( $total_polls > 10 ) { ?>
                                            <div class="row mb0">
                                                <div class="center">
                                                    <div class="loadmorepage btn themered" data-category="Governance" data-pageid="1" data-catid="0">See More</div>
                                                </div>
                                            </div>
                                    <?php } ?>
                            <?php } else { ?>
                                    <div class="col l12 m12 s12">
                                        <div class="card p5-20  equal-height">
                                            <div class="card_content center nodatapoll" style="margin: 12% 18%;">
                                                <img src="<?= base_url( 'images/infographics/1.png' ); ?>" style="width: 50%;">
                                                <h3 class="fieldtitle">Seems like there are no questions posted here for you</h3>
                                            </div>
                                        </div>
                                    </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l4 m12 s12 plr15 ">
                <div class="row">
                    <div class="card z-depth-4 padd0 mt15">
                        <div class="card-head p7_20">
                            <div class="bloghead"><span><img src="<?= base_url( 'images/icons/light.png' ); ?>" class="sidecardheadimg"/></span>Trending Surveys</div>
                        </div>
                        <div class="blogs-container withtable trend">
                            <div class="row">
                                <div class="col s12 bindtrend">
                                    <?php if ( ! empty( $trending ) ) { ?>
                                            <?php foreach ( $trending as $trend ) { ?>
                                                    <?php
                                                    //$spchar= array("~","`","!","@","#","$","%","^","&","*","(",")","{","}","|","/",";","'","<",">",",",'"',"?");
                                                    //$title     = str_replace($spchar, "", $trend['question']);
                                                    //$title     = str_replace(' ', '-', $title);
                                                    //$pollsec   = '?ct=' . $trend['category_name'] . '&pid=' . $trend['id'] . '';
                                                    //$uri_parts = explode('?', $_SERVER['REQUEST_URI']);
                                                    //$href      = base_url().'Survey'. $pollsec;
                                                    //redirection to survey details
                                                    $href = base_url() . 'Survey/surveydetail/' . $trend[ 'id' ] . '?t=' . time();
                                                    $target = 'target = "_blank"';
                                                    ?>
                                                    <div class="blogs p15_20">
                                                        <div class="row">
                                                            <a href="<?= $href ?>">
                                                                <div class="col s12">
                                                                    <div class="blog-title truncate"><?= $trend[ 'question' ]; ?></div>
                                                                    <!--<div class="left fs11px fw600 blog-details mt10 text-upper category-display category <?= strtolower( $trend[ 'category_name' ] ); ?>"><?= $trend[ 'category_name' ] ?></div>-->
                                                                    <div class="right blog-details lightgray">
                                                                        <i class="lightgray flaticon-click ml0"></i>
                                                                        <span class="lightgray fs12px"><?= $trend[ 'total_votes' ] ?>  Votes</span>
                                                                    </div>
                                                                    <!--<div class="right blog-details lightgray"><i class="material-icons icon-color">touch_app</i> <span class="total_votes"><?= $trend[ 'total_votes' ] ?> Votes</span></div>-->
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                            <?php } ?>
                                            <div class="loadmoretrending" data-page="1" data-catid="<?= $trending[ 0 ][ 'category_id' ] ?>"></div>
                                    <?php } else { ?>
                                            <div class="center">
                                                <img src="<?= base_url( 'images/infographics/2.png' ); ?>" style="width: 50%;">
                                                <h3 class="fs16px fieldtitle ">No trending questions available. </h3>
                                            </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card z-depth-4 padd0">
                        <div class="card-head p7_20">
                            <div class="bloghead"><span class="flaticon-user mr25 usericon"></span>ANSWERED QUESTIONS</div>
                        </div>
                        <div class="blogs-container withtable myraised">
                            <div class="row">
                                <div class="col s12 bindraised">
                                    <?php
                                    if ( ! empty( $myraised ) ) {
                                            ?>
                                            <?php
                                            foreach ( $myraised as $nvp ) {
                                                    ?>
                                                    <?php
                                                    $spchar = array ( "~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "|", "/", ";", "'", "<", ">", ",", '"', "?" );
                                                    $title = str_replace( $spchar, "", $nvp[ 'question' ] );
                                                    $title = str_replace( ' ', '-', $title );
                                                    $pollsec = '?ct=' . $nvp[ 'category_name' ] . '&pid=' . $nvp[ 'id' ] . '';
                                                    $uri_parts = explode( '?', $_SERVER[ 'REQUEST_URI' ] );
                                                    $href = base_url() . 'Survey' . $pollsec;

                                                    //redirection to survey details
                                                    $href = base_url() . 'Survey/surveydetail/' . $nvp[ 'id' ] . '?t=' . time();
                                                    //$href = base_url() . 'index.php/Poll/#moviepoll&pid=' . $entert['id'] . "/" . $title;
                                                    $target = 'target = "_blank"';
                                                    ?>
                                                    <div class="blogs p15_20">
                                                        <div class="row">
                                                            <a href="<?= $href ?>">
                                                                <div class="col s12">
                                                                    <div class="blog-title truncate"><?= $nvp[ 'question' ]; ?></div>
                                                                    <!--<div class="left fs11px fw600 blog-details text-upper mt10 category-display category <?= strtolower( $nvp[ 'category_name' ] ); ?>"><?= $nvp[ 'category_name' ] ?></div>-->
                                                                    <div class="right blog-details lightgray"><i class="material-icons icon-color">touch_app</i> <span class="total_votes"><?= $nvp[ 'total_votes' ] ?> Votes</span></div>
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
                                                <img src="<?= base_url( 'images/infographics/3.png' ); ?>" style="width: 50%;">
                                                <h3 class="fs16px fieldtitle ">You havent raised any questions yet.</h3>
                                            </div>
                                            <?php
                                    }
                                    ?>
                                </div>
                            </div>    
                        </div>
                        <?php
                        if ( ! empty( $trending ) ) {
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
            <img src="<?= base_url( '/images/banners/coin_f.png' ); ?>" />
            <span class="pointcontainer fs14px"><span class="fs18px" id="points">1</span><br />Point</span>
        </div>
    </div>
    <div class="modal-content bottom" style="padding:1px">

        <div class="center-align fs14px fw500" id="msg" style="margin: 5px;">You earned 1 silver Point</div>
        <div class="center-align fs12px fw500" id="submsg" style="margin: 5px;"></div>
        <div class="center-align optionsbtn" style="margin-top: 0;">
            <span class="fs12px fw500" style="display: block;margin-bottom: 5px;">Do you want to redeem?</span>
            <button class="btn savebtn redimoption orgtored yesredeem" style="">Yes</button>
            <button type="reset" class="knowmore borgtored p-0 redimoption noredeem"><h5 class="txtorgtored fs14px fw500">No</h5></button>
        </div>
    </div>
</div>
<script>var
                options = {loggedin:<?php echo empty( $this -> session -> userdata( 'data' ) )  ?'false':'true'; ?>,
                    alias: '<?= $alias; ?>',
                    toast: '<?= $this -> session -> flashdata( 'toast' ); ?>',
                    uid: <?= $uid; ?>,
                    baseurl: '<?= base_url(); ?>'
                }
</script>
<script src="<?= base_url(); ?>js/survey.js?v=1.8" ></script>
<?php

function encodeURIComponent( $str ) {
        $revert = array (
            '%21' => '!',
            '%2A' => '*',
            '%27' => "'",
            '%28' => '(',
            '%29' => ')'
        );
        return strtr( rawurlencode( $str ), $revert );
}
