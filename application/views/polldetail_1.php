<?php
//echo '<pre>';
//print_r($poll_detail);exit;
//$sessiondata=$this->session->userdata('data');
$this -> load -> helper( 'common_helper' );
$today = date( "Y-m-d H:i:s" );
?>

<style>

    .tgl {
        display: none;
    }
    .tgl, .tgl:after, .tgl:before, .tgl *, .tgl *:after, .tgl *:before, .tgl + .tgl-btn {
        box-sizing: border-box;
    }
    .tgl::-moz-selection, .tgl:after::-moz-selection, .tgl:before::-moz-selection, .tgl *::-moz-selection, .tgl *:after::-moz-selection, .tgl *:before::-moz-selection, .tgl + .tgl-btn::-moz-selection {
        background: none;
    }
    .tgl::selection, .tgl:after::selection, .tgl:before::selection, .tgl *::selection, .tgl *:after::selection, .tgl *:before::selection, .tgl + .tgl-btn::selection {
        background: none;
    }
    .tgl + .tgl-btn {
        outline: 0;
        display: block;
        width: 4em;
        height: 2em;
        position: relative;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .tgl + .tgl-btn:after, .tgl + .tgl-btn:before {
        position: relative;
        display: block;
        content: "";
        width: 50%;
        height: 100%;
    }
    .tgl + .tgl-btn:after {
        left: 0;
    }
    .tgl + .tgl-btn:before {
        display: none;
    }
    .tgl.active + .tgl-btn:after {
        left: 50%;
    }

    .tgl{
        display:block;
    }
    .tgl-ios + .tgl-btn {
        background: #fbfbfb;
        border-radius: 2em;
        padding: 2px;
        transition: all .4s ease;
        border: 1px solid #e8eae9;
    }
    .tgl-ios + .tgl-btn:after {
        border-radius: 2em;
        background: #fbfbfb;
        transition: left 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), padding 0.3s ease, margin 0.3s ease;
        box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1), 0 4px 0 rgba(0, 0, 0, 0.08);
    }
    .tgl-ios + .tgl-btn:hover:after {
        will-change: padding;
    }
    .tgl-ios + .tgl-btn:active {
        box-shadow: inset 0 0 0 2em #e8eae9;
    }
    .tgl-ios + .tgl-btn:active:after {
        padding-right: .8em;
    }
    .tgl-ios.active + .tgl-btn {
        background: #86d993;
    }
    .tgl-ios.active + .tgl-btn:active {
        box-shadow: none;
    }
    .tgl-ios.active + .tgl-btn:active:after {
        margin-left: -.8em;
    }
</style>

<!--<div class="loadersmall" style="display:none"></div>-->
<input type="hidden" id="redirecturl" value="<?= base_url() ?>Login?section=poll&p=gov">
<div class="content container forumpages forumpagelist polllists" id="forumdetailpage">
    <div class="col s12">
        <div class="row">
            <div class="col l8 s12 plr15">
                <div class="row mb0">
                    <div class="col m12 s12">
                        <ul id="tabs-swipe-demo" class="tabs forumtypetab">
            <!--                <li class="tab col m2 m2_5"><a href="#mydiscuss"><i class="flaticon-social"></i> My Decisions</a></li>-->
<!--                            <li class="tab col m3"><a href="<?= base_url() ?>Poll#elecpoll" class="active"><i class="flaticon-interface"></i> Governance</a></li>
                            <li class="tab col m3"><a href="<?= base_url() ?>Poll#stockpoll"><i class="flaticon-money"></i> Money</a></li>
                            <li class="tab col m3"><a href="<?= base_url() ?>Poll#sportpoll"><i class="flaticon-ball"></i> Sports</a></li>
                            <li class="tab col m3"><a href="<?= base_url() ?>Poll#moviepoll"><i class="flaticon-movie"></i> Entertainment</a></li>-->
                            <li class="tab col m2 m3"><a href="<?= base_url() ?>Poll?ct=Governance" <?= $poll_detail[ 'category_id' ] == 1 ? "class='active'" : "" ?> data-category="Governance" target="_self"><i class="flaticon-interface"></i> Elections</a></li>
                            <li class="tab col m2 m3"><a href="<?= base_url() ?>Poll?ct=Money" <?= $poll_detail[ 'category_id' ] == 2 ? "class='active'" : "" ?> data-category="Money" target="_self"><i class="flaticon-money"></i> Money</a></li>
                            <li class="tab col m2 m3"><a href="<?= base_url() ?>Poll?ct=Sports" <?= $poll_detail[ 'category_id' ] == 3 ? "class='active'" : "" ?> data-category="Sports" target="_self"><i class="flaticon-ball"></i> Sports</a></li>
                            <li class="tab col m2 m3"><a href="<?= base_url() ?>Poll?ct=Entertainment" <?= $poll_detail[ 'category_id' ] == 4 ? "class='active'" : "" ?> data-category="Entertainment" target="_self"><i class="flaticon-tool"></i> Entertainment</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row slide-on-mobile-button">
                    <!--        <a id="show-mobile-discussion" class="start-discussion discussred show-on-small hide-on-med-and-up">Raise a Poll</a>-->
                    <div class="col s12 center-align hide-on-med-and-up show-on-small raiseapoll_mob">
                        <div class="olive askvotebanner" id="askvotebanner">
                            <div class="row m-0">
                                <div class="col s4 p0">
                                    <div class="asknwpoll">
                                        <img src="<?= base_url( 'images/banners/raise_poll.png' ); ?>" alt="">
                                    </div>
                                </div>

                                <div class="col s8 p0">
                                    <h3 class="fs12px mtb7px fw500">Please Update if Your Predictions are 3 Months Old <!--<a id="show-mobile-discussion" class="btn btn-default bluegray votenow start-discussion ">Ask Now</a>--></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 left-align show-on-med-and-up hide-on-small-only ">
                        <div class="olive askvotebanner" id="askvotebanner" >
                            <div class="row m-0">
                                <div class="col s4">
                                    <div class="asknwpoll">
                                        <img src="<?= base_url( 'images/banners/raise_poll.png' ); ?>" alt="">
                                    </div>
                                </div>

                                <div class="col s8" style="padding: 20px;">
                                    <h3 class="fs16px m-0 fw500">Please Update if Your Predictions are 3 Months Old <!--<a id="show-mobile-discussion" class="btn btn-default bluegray votenow start-discussion ">Ask Now</a>--></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12">
                    <div class="row slide-on-mobile">
                        <div class="" style="position:relative;">
                            <?php if ( empty( $_SESSION[ 'data' ] ) ) {
                                    ?>
                                    <!--<div class="forum-overlay">
                                        <a href="<?= base_url() ?>Login?section=discussion" class="btn btn-default start-discussion themered">Login to discuss</a>
                                    </div>-->
                            <?php }
                            ?>
                            <form id="postpoll" name="myform" method="POST" action="<?= base_url() ?>Poll/add_update_poll"  onsubmit="return validateForm()">
                                <div class="card forumarea">
                                    <div class="row mb0">
                                        <div class="col m12 s12">
                                            <div class="row mb0">
                                                <div class="col s12">
                                                    <textarea id="polltopic" name="polltopic" placeholder="Ask your question with 'What' , 'Why' , 'Which' etc" maxlength="75"></textarea>
                                                </div>
                                            </div>
                                            <!--                                            <div class="row mb10">
                                                                                            <div class="col s12">
                                                                                                <h5 class="fs12px f500">Select a Category</h5>
                                                                                                <select id="pollcatergory" name="pollcatergory">
                                                                                                    <option value="" selected disabled>Select Category</option>
                                            <?php
                                            foreach ( $category_list as $pollcat ) {
                                                    echo '<option value="' . $pollcat[ 'id' ] . '">' . $pollcat[ 'name' ] . '</option>';
                                            }
                                            ?>
                                            
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>-->
                                            <div class="row mb0">
                                                <div class="col s12">
                                                    <h5 class="fs13px fw600 fieldtitle">Select a Category</h5>
                                                    <div id="pollcatergory">
                                                        <?php
                                                        foreach ( $category_list as $pollcat ) {
                                                                echo '<input type="radio" id="cat_' . $pollcat[ 'id' ] . '" name="pollcatergory" value="' . $pollcat[ 'id' ] . '">
                                                                    <label for="cat_' . $pollcat[ 'id' ] . '"><div class="p5-10 ">' . $pollcat[ 'name' ] . '</div></label>';
                                                        }
                                                        ?>
                                                    </div>



<!--                                                        <input type="radio" id="test2" name="radio-group">
    <label for="test2"><span>Peach</span></label>

    <input type="radio" id="test3" name="radio-group">
    <label for="test3"><span>Orange</span></label>-->

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col m12 s12">
                                            <h5 class="fs13px fw600 fieldtitle">Description</h5>
                                            <textarea data-autoresize class="textarea-scrollbar" id="polldescription" name="polldescription" placeholder="Type your description here" maxlength="300" row="3" data-oldtext=""></textarea>

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
                                                        <span class="asterisk" for="static1">See the Results</span></div>

                                                </div>
                                            </div>
                                            <div class="row choice mb10">
                                                <div class="col s11">
                                                    <div style="position:relative">
                                                        <input type="text" name="static2" disabled/>
                                                        <span class="asterisk" for="static2">None of the above</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col m12 s12">
                                            <h5 class="fs13px fw600 fieldtitle">End Date</h5>
                                            <input id="enddate" id="enddate" name="enddate" data-toggle="datepicker" autocomplete="off" >
                                        </div>
                                    </div>
                                    <div class="row center mt35b20">
                                        <input type="hidden" id="poll_id" name="poll_id" value="0">
                                        <input type="hidden" id="poll_preview" name="poll_preview" value="">
                                        <button type="submit" class="btn btn-default themered orgtored mr10">Save</button>
                                        <button type="reset" class="knowmore borgtored p-0"><h5 class="txtorgtored fs14px fw500">Cancel</h5></button>
                                        <!--                                        <button type="reset" class="btn btn-default knowmore white    borgtored"><h5 class="red-text fs14px">Cancel</h5></button>-->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php if ( ! empty( $poll_detail ) ) { ?>
                            <div class="col l12 m12 s12">
                                <?php
                                $spchar = array ( "~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                                    "(", ")", "{", "}", "|", "/", ";", "'", "<",
                                    ">", ",", '"', "?" );
                                $title = str_replace( $spchar, "", $poll_detail[ 'poll' ] );
                                $title = str_replace( ' ', '-', $title );
                                //$href = base_url() . 'Poll/#elecpoll&pid=' . $poll_detail['id'] . "/" . $title;
                                $uri_parts = explode( '?', $_SERVER[ 'REQUEST_URI' ] );

                                $href = urlencode( (isset( $_SERVER[ 'HTTPS' ] ) ? "https" : "http") . "://" . $_SERVER[ 'HTTP_HOST' ] . $uri_parts[ 0 ] . "" );
                                $target = 'target = "_blank"';
                                $preview = "";
                                ?>
                                <?php
                                $d1 = strtotime( $poll_detail[ 'end_date' ] );
                                $d2 = strtotime( $today );
                                $end_date = date( 'Y-m-d', $d1 );
                                $today = date( 'Y-m-d', $d2 );
                                ?>
                                <div class="card p20  equal-height" id="card_<?= $poll_detail[ 'id' ]; ?>">
                                    <div class="card_content pollcard-scrollbar">
                                        <div class="row mb0">
                                            <div class="col m2 s3">
                                                <div class="votescountbox">
                                                    <img src="<?= base_url( 'images/common/vote.png' ); ?>" alt=""/>
                                                    <?php
                                                    $votesdigits = "";
                                                    if ( $poll_detail[ 'total_votes' ] > 0 && $poll_detail[ 'total_votes' ] < 10 ) {
                                                            $votesdigits = "twodigit";
                                                            $poll_detail[ 'total_votes' ] = '0' . $poll_detail[ 'total_votes' ];
                                                    }
                                                    if ( $poll_detail[ 'total_votes' ] > 9 && $poll_detail[ 'total_votes' ] <= 99 ) {
                                                            $votesdigits = "twodigit";
                                                    } else if ( $poll_detail[ 'total_votes' ] > 99 ) {
                                                            $votesdigits = "threedigit";
                                                    }
                                                    ?>
                                                    <span class="fs14px fw500 votetext_<?= $poll_detail[ 'id' ]; ?> <?= $votesdigits ?>"><?= $poll_detail[ 'total_votes' ] ?></span>
                                                </div>
                                                    <!--<i class="flaticon-info readdescinfo pull-right" onClick="showdescription(<?= $poll_detail[ 'id' ]; ?>, 'pd', this)"></i>-->
                                            </div>
                                            <div class="col m9 s8">
                                                <div class="col s12">
                                                    <div class="row mb10">
                                                        <h6 class="fs18px tastart fw500 m-0 pollquestion" style=""><?= linkify( $poll_detail[ 'poll' ] ) ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $preview = preg_replace( "/\r\n|\r|\n/", '<br/>', $poll_detail[ 'preview' ] );
                                            unset( $poll_detail[ 'preview' ] );
                                            ?>
                                            <?php if ( $poll_detail[ 'user_id' ] == $uid && $end_date >= $today ) { ?>
                                                    <div class="col m1 s1">
                                                        <div class="">
                                                            <a materialize="dropdown" class='dropdown-button pollubhead right'  href='#' data-activates='mypollactions_<?= $poll_detail[ 'id' ]; ?>'>
                                                                <i class="flaticon-three-1"></i>
                                                            </a>
                                                            <ul id='mypollactions_<?= $poll_detail[ 'id' ]; ?>' class='dropdown-content'>

                                                                <li id="editpoll" class="<?php
                                                                if ( $poll_detail[ 'total_votes' ] > 25 ) {
                                                                        echo "hide";
                                                                }
                                                                ?>" data-rowjson='<?php echo json_encode( $poll_detail ); ?>' data-pollid="<?= $poll_detail[ 'id' ] ?>" data-preview="<?= $preview ?>" data-title="<?= trim( preg_replace( '/\s\s+/', ' ', $poll_detail[ 'poll' ] ) ); ?>" >
                                                                    <h6 class="fs16px mypoll ">Edit</h6>
                                                                </li>
                                                                <li>
                                                                    <a class="fs16px mypoll modal-trigger confdelete" href="#confirmdelete" data-pollid="<?= $poll_detail[ 'id' ] ?>">Delete</a>

                                                                </li>
                                                                <li class="hide"><h6 class="fs16px mypoll">Report</h6></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                            <?php } ?>
                                        </div>
                                        <div class="row mb0 minusmarvote">
                                            <div class="col m2 s3 p-0 hide">
        <!--                                                            <span class="votescountbox hide-on-med-and-up show-on-small">
                                                    <span class="flaticon-click ml0"></span>
                                                    <span class="fs12px fw500 votetext_<?= $poll_detail[ 'id' ]; ?>"><?= $poll_detail[ 'total_votes' ] ?>  <?= $poll_detail[ 'total_votes' ] > 1 ? "Votes" : "Vote"; ?></span>
                                                </span>-->
                                            </div>
                                            <div class="col m6 s8">
                                                <?php
                                                $display_name = "";
                                                if ( $poll_detail[ 'raised_by_admin' ] == "1" ) {
                                                        $display_name = '<img src="' . base_url() . 'images/logo/crowd-wisdom.png" class="bycrowdwisdom">';
                                                } else {
                                                        $display_name = ($user_id == $poll_detail[ 'user_id' ]) ? 'You' : $poll_detail[ 'byuser' ];
                                                }
                                                ?>
                                                <h6 class="forumsubhead fs12px tastart m-0 lightgray fw500"><i>By <?= $display_name ?>, <?= date( 'j M Y', strtotime( $poll_detail[ 'created_date' ] ) ); ?> </i></h6>

                                            </div>
                                            <?php
                                            $hide = "";

                                            if ( empty( $poll_detail[ 'user_choice' ] ) && ( $end_date >= $today ) ) {
                                                    $hide = "hide";
                                            }
                                            ?>
                                            <div class="col m4 right-align expertsw <?= $hide ?>">
                                                <SMALL style='display: inline-block;line-height: 29px;margin-top: -15px;vertical-align: middle;'>See Expert results</SMALL>
                                                <span style='display:inline-block'>
                                                    <a href='#' class='tgl tgl-ios'></a>
                                                    <label class="tgl-btn check_expert_result" for="cb2" data-pollid="<?= $poll_detail[ 'id' ]; ?>"></label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row mb10">
                                            <div class="col m12 s12 polldescr" id="description_pdpage<?= $poll_detail[ 'id' ]; ?>">
                                                <h6 class="fs14px tastart" style=""><?= linkify( $poll_detail[ 'description' ] ) ?></h6>
                                                <?= htmlspecialchars_decode( $preview ) ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row mb0">
                                        <?php
                                        $allowvote = "";
                                        $choicedisable = "";
                                        if ( ! empty( $poll_detail[ 'user_choice' ] ) ) {
                                                $allowvote = "votedpoll";
                                        }
                                        if ( $end_date < $today ) {
                                                $allowvote = "votedpoll";
                                                $choicedisable = "choicedisabled";
                                        }
                                        ?>
                                        <?php //$allowvote;exit  ?>
                                        <div data-tabname="pdpage" class="polloptions polloption_<?= $poll_detail[ 'id' ]; ?>  p-0 <?= $allowvote ?> <?= $choicedisable ?>" id="polloptionpdpage_<?= $poll_detail[ 'id' ]; ?>">
                                            <?php foreach ( $poll_detail[ 'options' ] as $index => $op ) { ?>
                                                    <div class = "col m12 s12" data-choiceid="<?= $op[ 'choice_id' ] ?>">
                                                        <div class = "row mb7">
                                                            <div class="col m12 s12">
                                                                <label class = "polloption progress" style="position: relative;">
                                                                    <?php
                                                                    $showresults = "";
                                                                    if ( $op[ 'choice' ] == "Do not know or skip" || strtolower( $op[ 'choice' ] ) == "see the results" ) {
                                                                            $showresults = "showresults";
                                                                    }
                                                                    ?>
                                                                    <input class = "with-gap pollchoice_<?= $poll_detail[ 'id' ] ?> <?= $showresults ?>" name = "pollchoicepdpage_<?= $poll_detail[ 'id' ] ?>" data-pollid=<?= $poll_detail[ 'id' ] ?> data-type="pdpage" data-total="<?= $op[ 'total' ] ?>" type = "radio" value="<?= $op[ 'choice_id' ]; ?>" <?= $op[ 'choice_id' ] == $poll_detail[ 'user_choice' ] ? "checked" : "" ?>/>
                                                                    <span class="customradio">
                                                                        <i class="flaticon-check selected"></i>
                                                                    </span>
                                                                    <span style="position:absolute;" class="fs14px choicetext"><?= ($op[ 'choice' ] == "Do not know or skip" || strtolower( $op[ 'choice' ] ) == "see the results" ? "<b>See The Results</b>" : $op[ 'choice' ]) ?></span>
                                                                    <div class = "determinate <?= $op[ 'choice_id' ] == $poll_detail[ 'user_choice' ] ? "userselected" : "" ?>" style = "width: 0%" data-afterload="<?= $op[ 'avg' ] ?>"></div>
                                                                    <?php if ( strtolower( $op[ 'choice' ] ) != "see the results" ) { ?>
                                                                            <span class="avgpercount fs14px"><?= $op[ 'avg' ] ?> %</span>
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
                                                <?php if ( $end_date < $today ) { ?>
                                                                                                                                                                                                                        <!--                                                <span class="votescountbox mr20">
                                                                                                                                                                                                                        <span class="flaticon-click ml0 mr5"></span>
                                                                                                                                                                                                                        <span class="fs14px fw500"><?= $poll_detail[ 'total_votes' ] ?>  Votes</span>
                                                                                                                                                                                                                        </span>-->
                                                <?php } else { ?>
                                                        <input type="submit" data-pollid="<?= $poll_detail[ 'id' ]; ?>"  data-type="pdpage" data-catid="<?= $poll_detail[ 'category_id' ] ?>" data-totalvotes="<?= $poll_detail[ 'total_votes' ] ?>" class="btn btn-default pollbtnvote mr20" value="Vote">
                                                <?php }
                                                ?>

                                                <span class="mr20">
                                                    <span class="flaticon-multimedia ml0 mr10 fw500 lightgray fs14px  linkpointer  share red-text" data-section="pdpage" data-pollid="<?= $poll_detail[ 'id' ]; ?>" data-shareurl="<?= $href ?>">Share
                                                        <div class="tooltip share_pdpage<?= $poll_detail[ 'id' ]; ?>"><div class="tooltip-arrow" style="left: 20%;"></div>
                                                            <a class="share-icon facebook" data-mobile-iframe="true" href="http://www.facebook.com/sharer/sharer.php?u=<?= $href ?>" target="_blank"><span class="fa fa-facebook"></span></a>
                                                            <a class="share-icon twitter" href="https://twitter.com/intent/tweet?url=<?= $href ?>&text='<?= urlencode( $poll_detail[ 'poll' ] ) ?>'&ael;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
                                                            <a class="share-icon whatsapp" href="https://web.whatsapp.com/send?text=<?= $href ?>" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                                            <a class="share-icon linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $href ?>&title=<?= $title ?>"  target="_blank"><span class="fa fa-linkedin"></span></a>
                                                        </div>
                                                    </span>
                                                </span>
                                                <span>
                                                    <span class="flaticon-comment ml0 mr10 fw500 lightgray fs14px  linkpointer showritecmt red-text" data-section="pdpage" data-pollid="<?= $poll_detail[ 'id' ]; ?>">Comment
                                                    </span>
                                                    <span class="fs14px fw600 lightgray ml15px avgvotebox <?= $poll_detail[ 'average' ] > 0 ? "" : "hide" ?>" data-avg="<?= $poll_detail[ 'average' ]; ?>">Avg: <?= $poll_detail[ 'average' ] ?>%</span>
                                                    <span class="pull-right lightgray fs14px fw500 showcmtcount red-text" data-totalcomments="<?= $poll_detail[ 'total_comments' ] ?>" data-section="pdpage" data-pollid="<?= $poll_detail[ 'id' ]; ?>" onclick="showcommentsec(<?= $poll_detail[ 'id' ]; ?>, 'pdpage')"><?= $poll_detail[ 'total_comments' ] ?> <?= $poll_detail[ 'total_comments' ] > 1 ? " Comments" : " Comment" ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hide-on-med-and-up show-on-small">
                                        <div class="row mb15 center">
                                            <?php if ( $end_date < $today ) { ?>
                                                                                                                                                                                                                        <!--                                            <span class="votescountbox mr7">
                                                                                                                                                                                                                        <span class="flaticon-click ml0 mr5"></span>
                                                                                                                                                                                                                        <span class="fs10px fw500"><?= $poll_detail[ 'total_votes' ] ?>  Votes</span>
                                                                                                                                                                                                                        </span>-->
                                            <?php } else { ?>
                                                    <input type="submit" data-pollid="<?= $poll_detail[ 'id' ]; ?>"  data-type="pdpage" data-catid="<?= $poll_detail[ 'category_id' ] ?>" data-totalvotes="<?= $poll_detail[ 'total_votes' ] ?>" class="btn btn-default pollbtnvote mr7 plr10" value="Vote">
                                            <?php }
                                            ?>

                                            <span class="flaticon-multimedia ml0 mr7 fw500 lightgray fs10px  linkpointer share red-text" onclick="share('<?= urldecode( $href ) ?>', this)" data-section="pdpage" data-pollid="<?= $poll_detail[ 'id' ]; ?>" data-shareurl="<?= $href ?>">Share
                                                <div class="tooltip share_pdpage<?= $poll_detail[ 'id' ]; ?>"><div class="tooltip-arrow" style="left: 20%;"></div>
                                                    <a class="share-icon facebook" data-mobile-iframe="true" href="http://www.facebook.com/sharer/sharer.php?u=<?= $href ?>" target="_blank"><span class="fa fa-facebook"></span></a>
                                                    <a class="share-icon twitter" href=" https://twitter.com/intent/tweet?url=<?= $href ?>&text='<?= urlencode( $poll_detail[ 'poll' ] ) ?>'&ael;hashtags=Crowdwisdom" target="_blank"><span class="fa fa-twitter"></span></a>
                                                    <a class="share-icon whatsapp" href="whatsapp://send?text=<?= $href ?>" data-action="share/whatsapp/share" target="_blank"><span class="fa fa-whatsapp"></span></a>
                                                    <a class="share-icon linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $href ?>&title=<?= $title ?>"  target="_blank"><span class="fa fa-linkedin"></span></a>
                                                </div>
                                            </span>

                                            <span class="flaticon-comment ml0  mr7 fw500 lightgray fs10px  linkpointer showritecmt red-text" data-section="pdpage" data-pollid="<?= $poll_detail[ 'id' ]; ?>"><?= $poll_detail[ 'total_comments' ] > 1 ? "Comments" : "Comment" ?> <span class="cmtbadge red-text"><?= $poll_detail[ 'total_comments' ] ?></span>
                                            </span>
                                            <span class="fs10px fw600 lightgray avgvotebox <?= $poll_detail[ 'average' ] > 0 ? "" : "hide" ?>" data-avg="<?= $poll_detail[ 'average' ]; ?>">Avg: <?= $poll_detail[ 'average' ] ?>%</span>
                                            <!--<span class="pull-right lightgray fs10px mt7 fw500 showcmtcount" data-totalcomments="<?= $poll_detail[ 'total_comments' ] ?>" data-section="pdpage" data-pollid="<?= $poll_detail[ 'id' ]; ?>" onclick="showcommentsec(<?= $poll_detail[ 'id' ]; ?>, 'pdpage')"><?= $poll_detail[ 'total_comments' ] ?> comments</span>-->
                                        </div>
                                    </div>
                                    <div class="loadersmall" style="display:none"></div>
                                    <div id="togglecmtsec_pdpage_<?= $poll_detail[ 'id' ]; ?>" class="togglecmtsec">
                                        <div class="row mb10">
                                            <?php if ( $end_date >= $today ) { ?>
                                                    <form id="postpollcomment" class="postpollcomment" name="postpollcmt" method="POST" action="<?= base_url() ?>Poll/add_comment">
                                                        <div class="col s12">
                                                            <div style="position:relative">
                                                                <textarea type="text" id="textarea1" class="writereply textarea-scrollbar" data-autoresize name="poll_comment" placeholder="Type your comments here..."></textarea>
                                                                <span onclick="$(this).submit()" class="textareaicon"><span class="material-icons prefix sendarrowreply">send</span></span>
                                                            </div>
                                                            <input type="hidden" name="poll_id" value="<?= $poll_detail[ 'id' ]; ?>"/>
                                                            <input type="hidden" name="poll_cmt_id" value="0"/>
                                                        </div>
                                                    </form>
                                            <?php } ?>
                                        </div>
                                        <div class="row mb0" id="pollreact">
                                            <div class="commentbox custom-scrollbar">
                                                <?php if ( ! empty( $poll_detail[ 'All_comments' ] ) ) { ?>
                                                        <?php foreach ( $poll_detail[ 'All_comments' ] as $ac ) { ?>
                                                                <div class="col s12">
                                                                    <div class="commentsection" id="cm_<?= $ac[ 'id' ] ?>">
                                                                        <div class="pollcardlist p-0">
                                                                            <div class="row mb0">
                                                                                <div class="col m11 s11">
                                                                                    <h6 class="forumsubhead fs12px tastart mt5 lightgray fw500"><span class="flaticon-social-2 ml10 mr0"></span><i>By <?= $uid == $ac[ 'user_id' ] ? 'You' : $ac[ 'byuser' ]; ?>, <?= date( 'j M Y', strtotime( $ac[ 'created_date' ] ) ); ?> </i></h6>
                                                                                </div>
                                                                                <div class="col m1 s1">
                                                                                    <?php if ( $ac[ 'user_id' ] == $uid && $end_date >= $today ) { ?>
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
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="ml45">
                                                                                <div class="cmteditbox positir">
                                                                                    <div class="mr35 whitespacepre"><?= $ac[ 'comment' ] ?></div>
                                                                                    <div class="hide posrela">
                                                                                        <textarea type="text" data-autoresize rows="2" id="cmt_<?= $ac[ 'id' ] ?>" data-value="<?= $ac[ 'comment' ] ?>" data-pollid="<?= $poll_detail[ 'id' ] ?>" data-cmtid="<?= $ac[ 'id' ] ?>" readonly class="<?= $ac[ 'user_id' ] == $uid ? "commentedit" : "" ?> mb0 textarea-scrollbar"><?= $ac[ 'comment' ] ?></textarea>
                                                                                        <span data-cmtid="<?= $ac[ 'id' ] ?>" class="textareaicon1"><span class="material-icons prefix sendarrow">send</span></span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row txtbluegray cmtop mb0">
                                                                                    <div class="col m7 s7"><h6 class="fs12px linkpointer showreplies_icon fs12px fw500 lightgray" data-cmtid="<?= $ac[ 'id' ] ?>" data-pollid="<?= $poll_detail[ 'id' ] ?>" data-replyset="0"><i class="flaticon-arrow-1 lightgray"></i>Reply</h6></div>
                                                                                    <div class="col m5 s5 right right-align">
                                                                                        <span class="mr10 lightgray fs12px fw500 linkpointer showreplies" data-cmtid="<?= $ac[ 'id' ] ?>" data-pollid="<?= $poll_detail[ 'id' ] ?>" data-replyset="0" data-totalreply="<?= $ac[ 'total_replies' ] ?>"><?= $ac[ 'total_replies' ] ?><?= $ac[ 'total_replies' ] > 1 ? " Replies" : " Reply" ?></span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="replies<?= $ac[ 'id' ] ?>" style="display:none;">
                                                                                    <div class="row m10">
                                                                                        <?php if ( $end_date >= $today ) { ?>
                                                                                                <form id="postpollcommentrply" method="POST">
                                                                                                    <div class="col m12 s12">
                                                                                                        <div style="position:relative">
                                                                                                            <textarea type="text" id="textarea1" class="writereply textarea-scrollbar" data-autoresize name="poll_comment_reply" placeholder="Write a reply"></textarea>
                                                                                                            <span onclick="$(this).submit()" class="textareaicon"><span class="material-icons prefix sendarrowreply">send</span></span>
                                                                                                            <input type="hidden" name="poll_id" value="<?= $poll_detail[ 'id' ] ?>"/>
                                                                                                            <input type="hidden" name="comment_id" value="<?= $ac[ 'id' ] ?>"/>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </form>
                                                                                        <?php } ?>
                                                                                    </div>
                                                                                    <div id="replylist_<?= $ac[ 'id' ] ?>">
                                                                                    </div>
                                                                                </div></div>
                                                                        </div>
                                                                        <hr class="commentseprator">
                                                                    </div>
                                                                </div>
                                                        <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <?php if ( $poll_detail[ 'total_comments' ] > 2 ) { ?>
                                                    <div class="row mb0">
                                                        <div class="col s12">
                                                            <div class="loadmore fs12px fw500 lightgray" style="display:block" data-pageid="0" data-pollid="<?= $poll_detail[ 'id' ]; ?>" data-enddate="<?= $end_date ?>" data-sectype="pdpage" data-totalcomments="<?= $poll_detail[ 'total_comments' ] ?>">View more comments.</div>
                                                        </div>
                                                    </div>
                                            <?php } else if ( $poll_detail[ 'total_comments' ] == 0 ) { ?>
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
                                    <h6 class=" center" style="margin-bottom: -10px;"><a href="#" class="btn themered " id="viewallprediction" style="text-transform:  capitalize;color:  white;">View all predictions</a></h6>
                                </div>
                            </div>

                            <!--                                <div class="row">
                                                                <div class="" style="width:100%;text-align:center;">
                                                                    <div class="mypagination" style="display: inline-block" data-total="<?= $total_polls[ strtolower( $category_list[ 0 ][ 'name' ] ) ] ?>"></div>
                                                                </div>
                                                            </div>-->

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
            <div class="col l4 m12 s12 plr15 hide-on-med-and-down show-on-large">
                <div class="row">
                    <div class="card z-depth-4 padd0 mt15">
                        <div class="card-head p7_20">
                            <div class="bloghead"><span><img src="<?= base_url( 'images/icons/light.png' ); ?>" class="sidecardheadimg"/></span>Trending Predictions</div>
                        </div>
                        <div class="blogs-container withtable trend" data-trend="">
                            <div class="row">
                                <div class="col s12 bindtrend">
                                    <?php if ( ! empty( $trending ) ) { ?>
                                            <?php foreach ( $trending as $trend ) { ?>
                                                    <?php
                                                    $spchar = array ( "~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "|", "/", ";", "'", "<", ">", ",", '"', "?" );
                                                    $title = str_replace( $spchar, "", $trend[ 'poll' ] );
                                                    $title = str_replace( ' ', '-', $title );
                                                    $pollsec = '?ct=' . $trend[ 'category_name' ] . '&pid=' . $trend[ 'id' ] . '';
                                                    $uri_parts = explode( '?', $_SERVER[ 'REQUEST_URI' ] );
                                                    $href = base_url() . 'Poll' . $pollsec;

                                                    //redirection on detail page
                                                    $href = base_url() . 'Poll/polldetail/' . $trend[ 'id' ] . '?t=' . time() . '&ct=' . $trend[ 'category_name' ];
                                                    $target = 'target = "_blank"';
                                                    ?>
                                                    <div class="blogs p15_20">
                                                        <div class="row">
                                                            <a href="<?= $href ?>">
                                                                <div class="col s12">
                                                                    <div class="blog-title truncate"><?= $trend[ 'poll' ]; ?></div>
                                                                    <div class="left fs11px fw600 blog-details mt10 text-upper category-display category <?= strtolower( $trend[ 'category_name' ] ); ?>"><?= $trend[ 'category_name' ] ?></div>
                                                                    <div class="right blog-details lightgray">
                                                                        <i class="lightgray flaticon-click ml0"></i>
                                                                        <span class="lightgray fs12px"><?= $trend[ 'total_votes' ] ?>  Votes</span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php
                                            }
                                            ?>
                                            <div class="loadmoretrending" data-page="1" data-catid="<?= $trending[ 0 ][ 'category_id' ] ?>"></div>
                                            <?php
                                    } else {
                                            ?>
                                            <div class="center">
                                                <img src="<?= base_url( 'images/infographics/2.png' ); ?>" style="width: 50%;">
                                                <h3 class="fs16px fieldtitle ">No trending questions available. </h3>
                                            </div>
                                            <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card z-depth-4 padd0">
                        <div class="card-head p7_20">
                            <div class="bloghead"><span class="flaticon-user mr25 usericon"></span>My Answered Predictions</div>
                        </div>
                        <div class="blogs-container withtable myraised">
                            <div class="row">
                                <div class="col s12 bindraised">
                                    <?php
                                    if ( ! empty( $myraised ) ) {
                                            foreach ( $myraised as $nvp ) {
                                                    $spchar = array ( "~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "|", "/", ";", "'", "<", ">", ",", '"', "?" );
                                                    $title = str_replace( $spchar, "", $nvp[ 'poll' ] );
                                                    $title = str_replace( ' ', '-', $title );
                                                    $pollsec = '?ct=' . $nvp[ 'category_name' ] . '&pid=' . $nvp[ 'id' ] . '';
                                                    $uri_parts = explode( '?', $_SERVER[ 'REQUEST_URI' ] );
                                                    $href = base_url() . 'Poll' . $pollsec;

                                                    //redirection on detail page
                                                    $href = base_url() . 'Poll/polldetail/' . $nvp[ 'id' ] . '?t=' . time() . '&ct=' . $nvp[ 'category_name' ];
                                                    $target = 'target = "_blank"';
                                                    ?>
                                                    <div class="blogs p15_20">
                                                        <div class="row">
                                                            <a href="<?= $href ?>">
                                                                <div class="col s12">
                                                                    <div class="blog-title truncate"><?= $nvp[ 'poll' ]; ?></div>
                                                                    <div class="left fs11px fw600 blog-details text-upper mt10 category-display category <?= strtolower( $nvp[ 'category_name' ] ); ?>"><?= $nvp[ 'category_name' ] ?></div>
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
                    </div>
                </div>
            </div>
            <div class="col l4 m12 s12 plr15 show-on-medium-and-down hide-on-large-only">
                <div class="row">
                    <div class="card z-depth-4 padd0 mt15">
                        <div class="card-head p7_20">
                            <div class="bloghead"><span><img src="<?= base_url( 'images/icons/light.png' ); ?>" class="sidecardheadimg"/></span>Trending Predictions</div>
                        </div>
                        <div class="blogs-container withtable trend">
                            <div class="row">
                                <div class="col s12 bindtrend">
                                    <?php if ( ! empty( $trending ) ) { ?>
                                            <?php foreach ( $trending as $trend ) { ?>
                                                    <?php
                                                    $spchar = array ( "~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "|", "/", ";", "'", "<", ">", ",", '"', "?" );
                                                    $title = str_replace( $spchar, "", $trend[ 'poll' ] );
                                                    $title = str_replace( ' ', '-', $title );
                                                    $pollsec = '?ct=' . $trend[ 'category_name' ] . '&pid=' . $trend[ 'id' ] . '';
                                                    $uri_parts = explode( '?', $_SERVER[ 'REQUEST_URI' ] );
                                                    $href = base_url() . 'Poll' . $pollsec;

                                                    //redirection on detail page
                                                    $href = base_url() . 'Poll/polldetail/' . $trend[ 'id' ] . '?t=' . time() . '&ct=' . $trend[ 'category_name' ];
                                                    $target = 'target = "_blank"';
                                                    ?>
                                                    <div class="blogs p15_20">
                                                        <div class="row">
                                                            <a href="<?= $href ?>">
                                                                <div class="col s12">
                                                                    <div class="blog-title truncate"><?= $trend[ 'poll' ]; ?></div>
                                                                    <div class="left fs11px fw600 blog-details mt10 text-upper category-display category <?= strtolower( $trend[ 'category_name' ] ); ?>"><?= $trend[ 'category_name' ] ?></div>
                                                                    <div class="right blog-details lightgray">
                                                                        <i class="lightgray flaticon-click ml0"></i>
                                                                        <span class="lightgray fs12px"><?= $trend[ 'total_votes' ] ?> <?= $trend[ 'total_votes' ] > 1 ? "Votes" : "Vote"; ?></span>
                                                                    </div>
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
                            <div class="bloghead"><span class="flaticon-user mr25 usericon"></span>My Answered Predictions</div>
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
                                                    $title = str_replace( $spchar, "", $nvp[ 'poll' ] );
                                                    $title = str_replace( ' ', '-', $title );
                                                    $pollsec = '?ct=' . $nvp[ 'category_name' ] . '&pid=' . $nvp[ 'id' ] . '';
                                                    $uri_parts = explode( '?', $_SERVER[ 'REQUEST_URI' ] );
                                                    $href = base_url() . 'Poll' . $pollsec;

                                                    //redirection on detail page
                                                    $href = base_url() . 'Poll/polldetail/' . $nvp[ 'id' ] . '?t=' . time() . '&ct=' . $nvp[ 'category_name' ];
                                                    //$href = base_url() . 'Poll/#moviepoll&pid=' . $entert['id'] . "/" . $title;
                                                    $target = 'target = "_blank"';
                                                    ?>
                                                    <div class="blogs p15_20">
                                                        <div class="row">
                                                            <a href="<?= $href ?>">
                                                                <div class="col s12">
                                                                    <div class="blog-title truncate"><?= $nvp[ 'poll' ]; ?></div>
                                                                    <div class="left fs11px fw600 blog-details text-upper mt10 category-display category <?= strtolower( $nvp[ 'category_name' ] ); ?>"><?= $nvp[ 'category_name' ] ?></div>
                                                                    <div class="right blog-details lightgray"><i class="material-icons icon-color">touch_app</i> <span class="total_votes"><?= $nvp[ 'total_votes' ] ?> <?= $nvp[ 'total_votes' ] > 1 ? "Votes" : "Vote"; ?></span></div>
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

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.0.8/d3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/PieChart/js/donut-pie-chart.js" type="text/javascript"></script>-->
<div id="confirmdelete" class="modal">
    <div class="modal-content">
        <h5 class="fs16px">Are you sure want to delete this Poll ?</h5>
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
            <button href="javascript:void(0)" class="btn savebtn redimoption orgtored yesredeem" style="">Yes</button>
            <button type="reset" class="knowmore borgtored p-0 redimoption noredeem"><h5 class="txtorgtored fs14px fw500">No</h5></button>
        </div>
    </div>
</div>
<script>

        $(document).on('click', '.yesredeem', function (e) {
            $('#pointsModal').modal('close');
            $('.slide-on-mobile').slideDown();
            $('.linkpreview').html('');
            $('#polltopic').focus();
            $('.askvotebanner').css('display', 'none');
            setTimeout(function () {
                $('#polltopic').focus();
            }, 100);
        });

        $(document).on('click', '.noredeem', function (e) {
            $('#pointsModal').modal('close');
        });
        $(document).on('click', 'a#show-mobile-discussion', function () {
            $('#pointsModal').removeClass('small');
<?php if ( empty( $this -> session -> userdata( 'data' ) ) ) { ?>
                    var redirecturl = $('#redirecturl').val();
                    window.location.assign(redirecturl);
        <?php
} else {
        if ( $alias == "" ) {
                ?>
                            Materialize.Toast.removeAll();
                            Materialize.toast('Please enter your alias first.', 2000);
                            setTimeout(function () {
                                var redirect_url = $("#redirecturl").val();
                                var redirect_sess = redirect_url.split("?");
                                window.location.href = '<?= base_url() ?>Profile?' + redirect_sess[1];
                            }, 2000)
        <?php } else {
                ?>
                            $.ajax({
                                "url": "<?= base_url() ?>Poll/getsilverpoints",
                                "method": "POST",
                            }).done(function (result) {

                                if (parseInt(result) > 500) {
                                    $('#pointsModal #title').html('Your Balance Points');
                                    $('#pointsModal #points').html(result);
                                    $('#pointsModal #msg').html('Redeem 500 Points to ask');
                                    $('#pointsModal #submsg').html('');
                                    $('#pointsModal .optionsbtn').css('display', 'block');
                                    $('#pointsModal').modal('open');
                                } else {
                                    $('#pointsModal #title').html('Your Balance Points');
                                    $('#pointsModal #points').html(result);
                                    //$('#pointsModal #msg').html("<span style='color:#eb1000'>You can't raise any Poll</span>");
                                    $('#pointsModal #msg').hide();
                                    $('#pointsModal #submsg').html("You must have 500 silver points to ask a question");
                                    $('#pointsModal .optionsbtn').css('display', 'none');
                                    $('#pointsModal').modal('open');
                                }
                            });

                <?php
        }
}
?>
        })
        $(document).on('click', '#postpoll button[type="reset"]', function () {
            //console.log('here');
            $('.slide-on-mobile').slideUp();
            $('#postpoll')[0].reset();
            //$('#polltopic').blur();
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
        })
</script>
<script>


        $(function () {
            //$('#loginbtn').attr('href','<?= base_url() ?>Login?section=poll&p=gov')

            if (window.location.href) {
                var hash = window.location.href; //Puts hash in variable, and removes the # character
                //console.log(hash);
                var currentcat = $('#tabs-swipe-demo>li>a.active').attr('data-category');
                //console.log(currentcat);
                var tabredirect = "";
                $('#tabs-swipe-demo>li>a').removeClass('active');
                if (currentcat == "Governance") {
                    $('input[name="pollcatergory"][value="1"]').prop('checked', true);
                    $('#tabs-swipe-demo>li>a[data-category="Governance"]').addClass('active');
                    $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=gov');
                    $('#viewallprediction').attr('href', "<?= base_url() ?>Poll?ct=Governance");

                } else if (currentcat == "Money") {
                    //console.log("money");
                    $('input[name="pollcatergory"][value="2"]').prop('checked', true);
                    $('#tabs-swipe-demo>li>a[data-category="Money"]').addClass('active');
                    //$('#stockpoll').addClass('active');
                    $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=mon');
                    $('#viewallprediction').attr('href', "<?= base_url() ?>Poll?ct=Money");

                } else if (currentcat == "Sports") {
                    $('input[name="pollcatergory"][value="3"]').prop('checked', true);
                    $('#tabs-swipe-demo>li>a[data-category="Sports"]').addClass('active');
                    $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=spo');
                    $('#viewallprediction').attr('href', "<?= base_url() ?>Poll?ct=Sports");

                } else if (currentcat == "Entertainment") {
                    $('input[name="pollcatergory"][value="4"]').prop('checked', true);
                    $('#tabs-swipe-demo>li>a[data-category="Entertainment"]').addClass('active');
                    $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=ent');
                    $('#viewallprediction').attr('href', "<?= base_url() ?>Poll?ct=Entertainment");
                } else {
                    $('input[name="pollcatergory"][value="1"]').prop('checked', true);
                    $('#tabs-swipe-demo>li>a[data-category="Governance"]').addClass('active');
                    $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=gov');
                    $('#viewallprediction').attr('href', "<?= base_url() ?>Poll?ct=Governance");
                }
//            tabredirect = $('#tabs-swipe-demo>li>a.active').attr('href');
//            $('#viewallprediction').attr('href', tabredirect);

            } else {
                $('input[name="pollcatergory"][value="1"]').prop('checked', true);
                $('#tabs-swipe-demo>li>a[href="#elecpoll"]').addClass('active');
                $('#elecpoll').addClass('active');

                $('.trend').slideUp();
                $('.trend[data-trend="governance"]').slideDown();

                //$('#loginbtn').attr('href', '<?= base_url() ?>Login?section=poll&p=gov')
                $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=gov');
            }

        });
        $(function () {
<?php if ( $this -> session -> flashdata( 'toast' ) ) { ?>
                    Materialize.Toast.removeAll();
                    Materialize.toast('<?= $this -> session -> flashdata( 'toast' ) ?>', 4000);
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
            var enddate = $('#enddate').val();
            //var pollcategory = $("#pollcatergory").val();
            var pollcategory = $('input[name="pollcatergory"]:checked').val() ? true : false
            var choicearray = $("input[name='choice[]']")
                    .map(function () {
                        return $(this).val();
                    }).get();
            var choiceelement = checkArray(choicearray);
            //console.log(choiceelement);
            if (topic == "") {
                Materialize.Toast.removeAll();
                Materialize.toast('Please enter question topic', 4000);
                return false;
            }
            if (enddate == "") {
                Materialize.Toast.removeAll();
                Materialize.toast('Please enter the date', 4000);
                return false;
            }
            if (polldescri == "") {
                Materialize.Toast.removeAll();
                Materialize.toast('Please enter question description', 4000);
                return false;
            }
            if (!pollcategory) {
                Materialize.Toast.removeAll();
                Materialize.toast('Please Select Category', 4000);
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
            var previewdata = $('.linkpreview').html();
            $('#poll_preview').val(previewdata);
        }

        function checkArray(my_arr) {
            var count = 0;
            for (var i = 0; i < my_arr.length; i++) {
                if (my_arr[i] != "")
                    count++;
            }
            return count;
        }
        function readURL(input) {
            //console.log(input.files);
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
            ////console.log(selectedCategory);
            //window.location.href=selectedCategory;
            window.location.assign(selectedCategory);
            window.location.reload();
        });

        $(document).on('click ', '#tabs-swipe-demo.tabs > li > a', function (e) {

            //e.stopImmediatePropagation();
            var id = $(this).attr("href");
            if (typeof (id) != "undefined") {
                id = id.substr(1);
                //console.log(id);

                if (id == "elecpoll") {

                    $('input[name="pollcatergory"][value="1"]').prop('checked', true);
                    $('.trend').slideUp();
                    $('.trend[data-trend="governance"]').slideDown();
                    //$('#loginbtn').attr('href', '<?= base_url() ?>Login?section=poll&p=gov')
                    $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=gov');

                } else if (id == "stockpoll") {
                    $('input[name="pollcatergory"][value="2"]').prop('checked', true);
                    $('.trend').slideUp();
                    $('.trend[data-trend="money"]').slideDown();
                    //$('#loginbtn').attr('href', '<?= base_url() ?>Login?section=poll&p=mon')
                    $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=mon');
                } else if (id == "sportpoll") {
                    $('input[name="pollcatergory"][value="3"]').prop('checked', true);
                    $('.trend').slideUp();
                    $('.trend[data-trend="sports"]').slideDown();
                    //$('#loginbtn').attr('href', '<?= base_url() ?>Login?section=poll&p=spo')
                    $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=spo');
                } else if (id == "moviepoll") {
                    $('input[name="pollcatergory"][value="4"]').prop('checked', true);
                    $('.trend').slideUp();
                    $('.trend[data-trend="entertainment"]').slideDown();
                    //$('#loginbtn').attr('href', '<?= base_url() ?>Login?section=poll&p=ent')
                    $('#redirecturl').val('<?= base_url() ?>Login?section=poll&p=ent');
                } else {
                    $('.trend').slideUp();
                    $('.trend[data-trend="governance"]').slideDown();
                    //$('#loginbtn').attr('href', '<?= base_url() ?>Login?section=poll&p=myp')
                    $('#redirecturl').val('<?= base_url() ?>Login?section=poll');
                }
            }
        });


        $('body').scroll(function () {
            ////console.log("hello");
            var mainscroll = $(this).scrollTop() + $(this).innerHeight();
            var footerheight = $('#footer').height();
            if (mainscroll - footerheight >= $(this)[0].scrollHeight - 1) {
                //console.log("hello");
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
                if (visible < 2) {
                    $('.choice .removechoice').addClass('hide');
                } else {
                    $('.choice .removechoice').removeClass('hide');
                }
                if (visible == 9) {
                    addbtnstatus = "hide";
                }

                //$(this).addClass("shown")
                html = '<div class="row choice mb10">\
                    <div class="col s11">\
                        <input type="text" name="choice[]" maxlength="35" placeholder="Enter your choice here"/>\
                    </div>\
                    <div class="col s1 no-padding">\
                        <i class="flaticon-plus addmorechoice"></i>\
                        <i class="flaticon-delete removechoice"></i>\
                    </div>\
                </div>';
                $('#choiceslist').append(html);

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
            var _this = $(this);

<?php if ( empty( $this -> session -> userdata( 'data' ) ) ) {
        ?>
                    localStorage.pollid = pollid;
                    localStorage.choiseid = userchoice;
                    localStorage.categoryid = categoryid;
                    localStorage.section = section;
<?php }
?>

            if ($("input[name='pollchoice" + section + "_" + pollid + "']").is(":checked")) {
<?php if ( empty( $this -> session -> userdata( 'data' ) ) ) { ?>
                        var redirecturl = $('#redirecturl').val();
                        redirecturl = redirecturl + "&t=2&pid=" + pollid;
                        window.location.assign(redirecturl);
<?php } ?>


                $.ajax({
                    "url": "<?= base_url() ?>Poll/addpollchoice",
                    "method": "POST",
                    "data": {"poll_id": pollid, "choice": userchoice, "category_id": categoryid}
                }).done(function (result) {
                    result = JSON.parse(result);
                    //console.log(result);
                    if (result['status'])
                    {

                        _this.closest(".card#card_" + pollid).find(".expertsw").removeClass("hide");

                        $('.polloption_' + pollid).each(function () {
                            var html = "";
                            var tabname = $(this).attr('data-tabname');
                            for (var i in result['data']['options']) {
                                var isvoted = result['data']['options'][i]['choice_id'] == userchoice ? "checked" : "";
                                //console.log(isvoted);
                                var totalavg = result['data']['options'][i]['choice'].toLowerCase() != "See the Results" ? '<span class="avgpercount fs14px">' + result['data']['options'][i]['avg'] + ' %</span>' : "";
                                var userselected = result['data']['options'][i]['choice_id'] == userchoice ? "userselected" : "";
                                var isnoclickchoice = result['data']['options'][i]['choice'].toLowerCase() == "See the Results" ? "fw600" : "";
                                html += '<div class = "col m12 s12"  data-choiceid="' + result['data']['options'][i]['choice_id'] + '">\
                                        <div class = "row mb7">\
                                            <div class="col m12 s12">\
                                                <label class = "polloption progress" style="position: relative;">\
                                                    <input class = "with-gap" class="pollchoice_' + pollid + '" name = "pollchoice' + tabname + '_' + pollid + '" data-type="' + tabname + '" data-total="' + result['data']['options'][i]['total'] + '" type = "radio" value="' + result['data']['options'][i]['choice_id'] + '" ' + isvoted + '/>\
                                                    <span class="customradio">\
                                                        <i class="flaticon-check selected"></i>\
                                                    </span>\
                                                    <span style="position:absolute;" class="fs14px choicetext">' + (result['data']['options'][i]['choice'] == "Do not know or skip" || result['data']['options'][i]['choice'].toLowerCase() == "see the results" ? "<b>See The Results</b>" : result['data']['options'][i]['choice']) + '</span>\
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
//                                                <div class = "col m9 s8">\
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
                            //console.log(html);
                            $("#polloption" + tabname + "_" + pollid).html(html);

                            $("#polloption" + tabname + "_" + pollid).addClass('votedpoll');
                            //$(".votedpoll input[type='radio']").attr('disabled', true);
                            //console.log("#polloption" + tabname + "_" + pollid + " .determinate");
                            setTimeout(function () {
                                var maxper = 0
                                $("#polloption" + tabname + "_" + pollid + " .determinate:first").parent().addClass('maxper');
                                $("#polloption" + tabname + "_" + pollid + " .determinate").each(function () {
                                    var newper = $(this).attr('data-afterload');
                                    $(this).css('width', newper + '%');
                                    if (parseFloat(newper) > parseFloat(maxper)) {
                                        $("#polloption" + tabname + "_" + pollid + " .determinate").parent().removeClass('maxper');
                                        $(this).parent().addClass('maxper');
                                        maxper = newper;
                                    }
                                });
                                $('.avgvotebox').each(function () {
                                    var avgper = $(this).attr('data-avg');
                                    if (parseFloat(avgper) > 0)
                                    {
                                        //$(this).html('Avg: '+parseInt(avgper));
                                        $(this).html('Avg: ' + avgper);
                                    } else {
                                        $(this).addClass('hide');
                                    }
                                });
                            }, 100)

                        });

                        //$('input[name ^=pollchoice][name $=' + pollid + '][value=' + userchoice + ']').attr('checked', true);
//                    var changebtn = '<span class="votescountbox mr20">\
//                                        <span class="flaticon-click ml0 mr5"></span>\
//                                        <span class="fs14px fw500">' + result['data']['total_votes'] + '  Votes</span>\
//                                    </span>';
//                    $('input[data-pollid="' + pollid + '"].pollbtnvote').parent().prepend(changebtn);
//                    $('input[data-pollid="' + pollid + '"].pollbtnvote').remove();
                        var votesword = result['data']['total_votes'] > 1 ? "Votes" : "Vote";
                        var votecount = result['data']['total_votes'];

                        if (result['data']['total_votes'] > 0 && result['data']['total_votes'] < 99) {
                            $('.votescountbox .votetext_' + pollid + '').addClass('twodigit');
                        } else if (result['data']['total_votes'] > 99) {
                            $('.votescountbox .votetext_' + pollid + '').addClass('threedigit');
                        }
                        if (result['data']['total_votes'] > 0 && result['data']['total_votes'] < 9) {
                            votecount = '0' + result['data']['total_votes'];
                        }
                        $('.votescountbox .votetext_' + pollid + '').html(votecount);

                        loaddatafortrending(categoryid, 0);
                        //loaddataformyraised(0,0);
                        load_my_answered_prediction(categoryid, 0);
                        //$('.votescountbox .votetext_'+pollid+'').html(result['data']['total_votes']);
                        //$(this).closest('div.card').find('.votescountbox span:nth-child(2)').html(result['data']['total_votes']+' '+votesword);
                        $('#togglecmtsec_' + section + '_' + pollid).slideDown('slow');
                        //$('#pointsModal').addClass('small');
                        if (result['isnew'] == 1) {
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

            ////console.log(userchoice);
        });

        $(function () {
            var pollid = localStorage.pollid;
            var userchoice = localStorage.choiseid;
            var categoryid = localStorage.categoryid;
            var section = localStorage.section;
            if (typeof (localStorage.pollid) != "undefined" && typeof (localStorage.choiseid) != "undefined" && typeof (localStorage.categoryid) != "categoryid") {
                $.ajax({
                    "url": "<?= base_url() ?>Poll/addpollchoice",
                    "method": "POST",
                    "data": {"poll_id": pollid, "choice": userchoice, "category_id": categoryid}
                }).done(function (result) {
                    result = JSON.parse(result);
                    //console.log(result);
                    if (result['status'])
                    {
                        localStorage.clear();
                        $('.polloption_' + pollid).each(function () {
                            var html = "";
                            var tabname = $(this).attr('data-tabname');
                            for (var i in result['data']['options']) {
                                var isvoted = result['data']['options'][i]['choice_id'] == result['data'].user_choice ? "checked" : "";
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
                                                    <span style="position:absolute;" class="fs14px choicetext">' + (result['data']['options'][i]['choice'] == "Do not know or skip" || result['data']['options'][i]['choice'].toLowerCase() == "see the results" ? "<b>See The Results</b>" : result['data']['options'][i]['choice']) + '</span>\
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
                            //console.log("#polloption" + tabname + "_" + pollid + " .determinate");
                            setTimeout(function () {
                                var maxper = 0
                                $("#polloption" + tabname + "_" + pollid + " .determinate:first").parent().addClass('maxper');
                                $("#polloption" + tabname + "_" + pollid + " .determinate").each(function () {
                                    var newper = $(this).attr('data-afterload');
                                    $(this).css('width', newper + '%');
                                    if (parseFloat(newper) > parseFloat(maxper)) {
                                        $("#polloption" + tabname + "_" + pollid + " .determinate").parent().removeClass('maxper');
                                        $(this).parent().addClass('maxper');
                                        maxper = newper;
                                    }
                                });
                                $('.avgvotebox').each(function () {
                                    var avgper = $(this).attr('data-avg');
                                    if (parseFloat(avgper) > 0)
                                    {
                                        //$(this).html('Avg: '+parseInt(avgper));
                                        $(this).html('Avg: ' + avgper);
                                    } else {
                                        $(this).addClass('hide');
                                    }
                                });
                            }, 100)
                        });
//                    var changebtn = '<span class="votescountbox mr20">\
//                                        <span class="flaticon-click ml0 mr5"></span>\
//                                        <span class="fs14px fw500">' + result['data']['total_votes'] + '  Votes</span>\
//                                    </span>';
                        //$('input[data-pollid="' + pollid + '"].pollbtnvote').parent().prepend(changebtn);
                        //$('input[data-pollid="' + pollid + '"].pollbtnvote').remove();
                        var votesword = result['data']['total_votes'] > 1 ? "Votes" : "Vote";
                        var votecount = result['data']['total_votes'];

                        if (result['data']['total_votes'] > 0 && result['data']['total_votes'] < 99) {
                            $('.votescountbox .votetext_' + pollid + '').addClass('twodigit');
                        } else if (result['data']['total_votes'] > 99) {
                            $('.votescountbox .votetext_' + pollid + '').addClass('threedigit');
                        }

                        if (result['data']['total_votes'] > 0 && result['data']['total_votes'] < 9) {
                            votecount = '0' + result['data']['total_votes'];
                        }
                        $('.votescountbox .votetext_' + pollid + '').html(votecount);
                        loaddatafortrending(categoryid, 0);
                        //loaddataformyraised(0,0);
                        load_my_answered_prediction(categoryid, 0);
                        //$('.votescountbox .votetext_'+pollid+'').html(result['data']['total_votes']);
                        $('#togglecmtsec_' + section + '_' + pollid).slideDown('slow');
                        if (result['isnew'] == 1) {
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
        $('.avgvotebox').each(function () {
            var avgper = $(this).attr('data-avg');
            if (parseFloat(avgper) > 0)
            {
                //$(this).html('Avg: '+parseInt(avgper));
                $(this).html('Avg: ' + avgper);
            } else {
                $(this).addClass('hide');
            }
        });
        var currentpollid = $(".determinate:first").parent().find('input').attr('data-pollid');
        var maxper = 0;
        $(".determinate").each(function () {
            var newper = $(this).attr('data-afterload');
            $(this).css('width', newper + '%');
            var pollid = $(this).parent().find('input').attr('data-pollid');
            if (parseInt(currentpollid) == parseInt(pollid))
            {
                if (parseFloat(newper) > parseFloat(maxper)) {
                    $('.polloption_' + pollid + ' .determinate').parent().removeClass('maxper');
                    $(this).parent().addClass('maxper');
                    maxper = newper;
                }
            } else {
                maxper = newper;
                $(this).parent().addClass('maxper');
                currentpollid = $(this).parent().find('input').attr('data-pollid');
            }
        });
//    $(".determinate").each(function () {
//        var newper = $(this).attr('data-afterload');
//        $(this).css('width', newper + '%');
//    });

        $(".choicedisabled input[type='radio']").attr('disabled', true);

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
            //console.log("share");

        }
//    $('.polllists .card').click(function (e) {
//        var redirectto = $(this).attr('data-clickredirect');
//      //console.log(e.target.className);
//        var classuserd = e.target.className;
//        var isValid = false;
//      //console.log(classuserd.indexOf("customradio"));
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
//      //console.log(isValid);
//        if (isValid || redirectto == "") {
//
//        } else {
//            //window.location.assign(redirectto);
//        }
//    });

        function showdescription(id, type, ele) {
            //console.log(id);
            //console.log(type);
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
                    url: '<?= base_url() ?>Poll/add_comment',
                    method: "POST",
                    data: {poll_comment: poll_comment, poll_id: poll_id, poll_cmt_id: poll_cmt_id},
                }).done(function (result) {
<?php if ( empty( $this -> session -> userdata( 'data' ) ) ) { ?>
                            //                    window.location.assign("<?= base_url() ?>Login?section=poll");
                            var redirecturl = $('#redirecturl').val();
                            redirecturl = redirecturl + "&t=2&pid=" + poll_id;
                            window.location.assign(redirecturl);
<?php } ?>
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

            if ($(this).val() == "") {
                var text = $(this).attr('value');
                //console.log(text);
                $(this).val(text);
            }
        })
        $('html').click(function (e) {
            //console.log(e.target.className);
            var classused = e.target.className;
            if (classused.indexOf("material-icons prefix sendarrow") != -1) {

            } else if (classused.indexOf("textareaicon1") != -1) {

            } else if (classused.indexOf("commentedit") != -1) {

            } else {
                $('.cmteditbox').removeClass('active');
                $(".commentedit").each(function (index) {
                    var oldval = $(this).attr('data-value');
                    $(this).val(oldval);
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
            //console.log(poll_comment);
            //console.log(original_cmt);
            if (poll_comment == "") {
                Materialize.Toast.removeAll();
                Materialize.toast("Please enter your comment", 4000);
            }
            //console.log("ajax call");
            $.ajax({
                url: '<?= base_url() ?>Poll/add_comment',
                method: "POST",
                data: {poll_comment: poll_comment, poll_id: poll_id, poll_cmt_id: poll_cmt_id},
            }).done(function (result) {
<?php if ( empty( $this -> session -> userdata( 'data' ) ) ) { ?>
                        //window.location.assign("<?= base_url() ?>Login?section=poll");
                        var redirecturl = $('#redirecturl').val();
                        redirecturl = redirecturl + "&t=2&pid=" + poll_id;
                        window.location.assign(redirecturl);
<?php } ?>
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
            //console.log(poll_comment);
            //console.log(original_cmt);
            if (poll_comment == "") {
                Materialize.Toast.removeAll();
                Materialize.toast("Please enter your comment", 4000);
            }


            //console.log("ajax call");
            $.ajax({
                url: '<?= base_url() ?>Poll/add_comment',
                method: "POST",
                data: {poll_comment: poll_comment, poll_id: poll_id, poll_cmt_id: poll_cmt_id},
            }).done(function (result) {
<?php if ( empty( $this -> session -> userdata( 'data' ) ) ) { ?>
                        //window.location.assign("<?= base_url() ?>Login?section=poll");
                        var redirecturl = $('#redirecturl').val();
                        redirecturl = redirecturl + "&t=2&pid=" + poll_id;
                        window.location.assign(redirecturl);
<?php } ?>
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
        });
</script>

<script>

        $(document).on('click', '.showreplies,.showreplies_icon', function (e) {
            var pollid = $(this).attr('data-pollid');
            var commentid = $(this).attr('data-cmtid');
<?php if ( empty( $this -> session -> userdata( 'data' ) ) ) { ?>
                    //window.location.assign("<?= base_url() ?>Login");
                    var redirecturl = $('#redirecturl').val();
                    redirecturl = redirecturl + "&t=2&pid=" + pollid + "&cmt=" + commentid;
                    window.location.assign(redirecturl);
<?php } else { ?>

                    var pagelimit = $(this).attr('data-replyset');
                    var currentcontent = $('#replylist_' + commentid).text();
                    var totalreply = $('.showreplies[data-cmtid="' + commentid + '"]').attr('data-totalreply');
                    var totalshow = parseInt(pagelimit) + 1;
                    totalshow = parseInt(totalshow) * 5;
                    $.ajax({
                        url: "<?php echo base_url(); ?>Poll/get_comment_replies",
                        method: "POST",
                        data: {pollid: pollid, commentid: commentid, pagelimit: pagelimit},
                    }).done(function (result) {
                        result = JSON.parse(result);
                        //console.log(result);
                        var html = "";
                        if (result.status) {
                            var groupLength = result['data'].length;
                            for (var i in result['data']) {
                                //console.log(result['data'][i]['id']);
                                var replyby = result['data'][i]['user_id'] ==<?= $uid; ?> ? "You" : result['data'][i]['byuser'];
                                var formattedDate = getDateString(new Date(result['data'][i]['created_date'].replace(' ', 'T')), "d M y");
                                var cmtedit = "";
                                var iscmtedit = result['data'][i]['user_id'] ==<?= $uid; ?> ? "commentedit" : "";
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
                            if (totalreply > totalshow) {
                                html += '<a class="morereplies fs12px fw500 lightgray" data-replyset="' + (parseInt(pagelimit) + 1) + '" data-pollid="' + pollid + '" data-cmtid="' + commentid + '">view more replies</a>'
                            }

                            $('#replylist_' + commentid).html(html);
                        }

                        $('.replies' + commentid).slideToggle();
                    });
<?php } ?>
        });

        $(document).on('click', '.morereplies', function (e) {
            var pollid = $(this).attr('data-pollid');
            var commentid = $(this).attr('data-cmtid');
            var pagelimit = $(this).attr('data-replyset');
            $('.replies' + commentid + ' .morereplies').remove();
            var totalreply = $('.showreplies[data-cmtid="' + commentid + '"]').attr('data-totalreply');
            var totalshow = parseInt(pagelimit) + 1;
            totalshow = parseInt(totalshow) * 5;
            $.ajax({
                url: "<?php echo base_url(); ?>Poll/get_comment_replies",
                method: "POST",
                data: {pollid: pollid, commentid: commentid, pagelimit: pagelimit},
            }).done(function (result) {
                result = JSON.parse(result);
                //console.log(result);
                var html = "";
                if (result.status) {
                    var groupLength = result['data'].length;
                    //result['data'].reverse();
                    //console.log(groupLength);

                    for (var i in result['data']) {
                        //console.log(result['data'][i]['id']);
                        var replyby = result['data'][i]['user_id'] ==<?= $uid; ?> ? "By" : result['data'][i]['byuser'];
                        var formattedDate = getDateString(new Date(result['data'][i]['created_date'].replace(' ', 'T')), "d M y");
                        var iscmtedit = result['data'][i]['user_id'] ==<?= $uid; ?> ? "commentedit" : "";
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
                    if (totalreply > totalshow) {
                        html += '<a class="morereplies fs12px fw500 lightgray" data-replyset="' + (parseInt(pagelimit) + 1) + '" data-pollid="' + pollid + '" data-cmtid="' + commentid + '">view more replies</a>';
                    }

                    $('#replylist_' + commentid).append(html);
                    //$('.replies' + commentid).slideToggle();
                }
                //$('.replies' + commentid).slideToggle();
            });
        });
</script>

<script>
        $(document).on('click', '.loadmore', function (e) {

            var loadlimit = $(this).attr('data-pageid');
            var poll_id = $(this).attr('data-pollid');
            var type = $(this).attr('data-sectype');
            var total_comments = $(this).attr('data-totalcomments');
            var endDate = new Date(Date.parse($(this).attr('data-enddate')));
<?php if ( empty( $this -> session -> userdata( 'data' ) ) ) { ?>
                    var redirecturl = $('#redirecturl').val();
                    redirecturl = redirecturl + "&t=2&pid=" + poll_id
                    window.location.assign(redirecturl);
<?php } else { ?>
                    $.ajax({
                        url: "<?php echo base_url(); ?>Poll/load_more_comments",
                        method: "POST",
                        data: {pollid: poll_id, pagelimit: loadlimit},
                    }).done(function (result) {
                        result = JSON.parse(result);
                        var html = "";
                        if (result.status) {
                            //console.log(result);
                            for (var i in result['data']) {
                                var replyby = result['data'][i]['user_id'] ==<?= $uid; ?> ? "You" : result['data'][i]['byuser'];

                                var cmtedit = "";
                                var TodayDate = new Date();
                                var editcmts = false;
                                var postreply = "";
                                if (endDate <= TodayDate) {
                                    editcmts = true;
                                    // throw error here..
                                }
                                var iscmtedit = "";
                                //console.log(result['data'][i]['user_id'] ==<?= $uid; ?>);
                                //console.log(editcmts);
                                if (result['data'][i]['user_id'] ==<?= $uid; ?> && !editcmts) {
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
                                if (!editcmts) {
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
                                var replyword = parseInt(result['data'][i]['total_replies']) > 1 ? " Replies" : " Reply";
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
                                                                                                                                                                                                                                                                                                                            <span class="mr10 lightgray fs12px fw500 linkpointer showreplies" data-cmtid="' + result['data'][i]['id'] + '" data-pollid="' + result['data'][i]['poll_id'] + '" data-replyset="0" data-totalreply="' + result['data'][i]['total_replies'] + '">' + result['data'][i]['total_replies'] + ' ' + replyword + '</span>\
                                                                                                                                                                                                                                                                                                                        </div>\
                                                                                                                                                                                                                                                                                                                    </div>\
                                                                                                                                                                                                                                                                                                                    <div class="replies' + result['data'][i]['id'] + '" style="display:none;">\
                                                                                                                                                                                                                                                                                                                        <div class="row m10">\
                                                                                                                                                                                                                                                                                                                        ' + postreply + '\
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
                            $('#togglecmtsec_' + type + '_' + poll_id + ' .commentbox').append(html);
                            var newtotalcmts = parseInt(loadlimit) + 1;
                            newtotalcmts = newtotalcmts * 10;

                            if (newtotalcmts <= total_comments) {
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
<?php } ?>
        });


        $('form[name="postpollcmt"]').submit(function (e) {
//    $('#postpollcomment').submit(function (e) {
            e.preventDefault();
            //$('.loadersmall').css('display', 'block');
            var poll_id = $('#postpollcomment input[name="poll_id"]').val();
            var redirecturl = $('#redirecturl').val();
            redirecturl = redirecturl + "&t=2&pid=" + poll_id;

<?php if ( empty( $this -> session -> userdata( 'data' ) ) ) { ?>
                    window.location.assign(redirecturl);
<?php } else { ?>
        <?php if ( $alias == "" ) { ?>
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
                                    //console.log(result['data']);
                                    var isuserlike = result['data']['userlike'] == 0 ? "like.png" : "like1.png";
                                    var formattedDate = getDateString(new Date(result['data']['created_date'].replace(' ', 'T')), "d M y")
                                    var replyby = result['data']['user_id'] ==<?= $uid; ?> ? "You" : result['data']['byuser'];
                                    var iscmtedit = result['data']['user_id'] ==<?= $uid; ?> ? "commentedit" : "";
                                    var cmtedit = "";
                                    if (result['data']['user_id'] ==<?= $uid; ?>) {
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
                                    var replyword = parseInt(result['data']['total_replies']) > 1 ? " Replies" : " Reply";
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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <span class="mr10 lightgray fs12px fw500 linkpointer showreplies" data-cmtid="' + result['data']['id'] + '" data-pollid="' + result['data']['poll_id'] + '" data-replyset="0" data-totalreply="' + result['data']['total_replies'] + '">' + result['data']['total_replies'] + ' ' + replyword + '</span>\
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
                                    //console.log(comments);
                                    if (parseInt(comments) == 0) {
                                        $('[id^="togglecmtsec_"][id$="_' + result['data']['poll_id'] + '"] .nocmtdata').css('display', 'none');
                                    }
                                    var newcommentscount = parseInt(comments) + 1;
                                    $('.showcmtcount[data-pollid=' + result['data']['poll_id'] + ']').attr('data-totalcomments', newcommentscount);
                                    var commentword = newcommentscount > 1 ? "Comments" : "Comment"
                                    $('.showcmtcount[data-pollid=' + result['data']['poll_id'] + ']').html(newcommentscount + " " + commentword);//cmtbadge
                                    $('.show-on-small .showritecmt[data-pollid=' + result['data']['poll_id'] + ']').html(commentword + "<span class='cmtbadge red-text'>" + newcommentscount + "</span>");
                                    //$('.showritecmt[data-pollid=' + result['data']['poll_id'] + '] .cmtbadge').html(newcommentscount);
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
            var _this = $(this);
            var poll_id = $('#postpollcommentrply input[name="poll_id"]').val();
            var redirecturl = $('#redirecturl').val();
            redirecturl = redirecturl + "&t=2&pid=" + poll_id;
<?php if ( empty( $this -> session -> userdata( 'data' ) ) ) { ?>
                    window.location.assign(redirecturl);
<?php } else { ?>
        <?php if ( $alias == "" ) { ?>
                            Materialize.Toast.removeAll();
                            Materialize.toast('Please enter your alias first.', 2000);
                            setTimeout(function () {
                                var redirect_url = $("#redirecturl").val();
                                var redirect_sess = redirect_url.split("?");
                                window.location.href = '<?= base_url() ?>Profile?' + redirect_sess[1];
                            }, 2000)
        <?php } else { ?>
                            //$('.loadersmall').css('display', 'block');
                            $.ajax({
                                url: '<?php echo base_url(); ?>Poll/add_comment_reply',
                                method: "POST",
                                data: $(this).serialize(),
                            }).done(function (result) {

                                result = JSON.parse(result);
                                if (result['status']) {
                                    var html = "";
                                    //console.log(result['data']);
                                    var formattedDate = getDateString(new Date(result['data']['created_date'].replace(' ', 'T')), "d M y");
                                    var cmtedit = "";
                                    html = '<div class="row mb0">\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="col m11 s11">\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <h6 class="forumsubhead fs12px tastart mt5 lightgray fw500"><span class="flaticon-social-2 ml10 mr0"></span><i>By Me, ' + formattedDate + '</i></h6>\
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
                                    var totalreply = parseInt(currentreplies) + 1;
                                    var replyword = totalreply > 1 ? "Replies" : "Reply";
                                    $('.showreplies[data-cmtid=' + result['data']['comment_id'] + ']').html(totalreply + " " + replyword);
                                    //$('.showreplies[data-cmtid=' + result['data']['comment_id'] + ']').html(parseInt(currentreplies) + 1 + " Replies");
                                } else {
                                    Materialize.Toast.removeAll();
                                    Materialize.toast(result['message'], 4000);
                                }
                                var cmt_id = result['data']['comment_id'];
                                //console.log(cmt_id);
                                adv = Math.round($('#pollreact .commentbox').scrollTop() + $("#replylist_" + cmt_id + " > div:last").position().top) - 70;
                                //position = $('.commentbox').scrollTop() + $("#replylist_"+cmt_id+" > div:last-child").position().top - $('.commentbox').height()/2 + $("#replylist_"+cmt_id+" > div:last-child").height()/2;
                                //console.log(adv);
                                //console.log("#replylist_" + cmt_id + " > div:last-child");
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
            var loadpageno = $(this).closest('div.card').find('.loadmore').attr('data-pageid')
//    var pageno = $('.deletecmt').closest('card').find('.loadmorepage').html();
            //console.log(pageno);
            $.ajax({
                url: '<?= base_url() ?>Poll/deactivecmt',
                method: "POST",
                data: {comment: cmt_id, pageno: loadpageno},
            }).done(function (result) {

                result = JSON.parse(result);
                $('#pollreact .commentbox #cm_' + cmt_id).slideUp('slow');
                var commentsword = result['total'] > 1 ? "Comments" : "Comment";
                $('.showcmtcount[data-pollid=' + result['ques_no'] + ']').html(result['total'] + ' ' + commentsword);

                $('.show-on-small .showritecmt[data-pollid="' + result['ques_no'] + '"]').html(commentsword + "<span class='cmtbadge red-text'>" + result['total'] + "</span>");

                $('.showcmtcount[data-pollid=' + result['ques_no'] + ']').attr('data-totalcomments', result['total']);
                var comments = $('.showcmtcount[data-pollid=' + result['ques_no'] + ']').attr('data-totalcomments');

                if (parseInt(comments) == 0) {
                    $('[id^="togglecmtsec_"][id$="_' + result['data']['poll_id'] + '"] .nocmtdata').css('display', 'none');
                }
                var pageno = $('.loadmore[data-pollid=' + result['ques_no'] + ']').attr('data-pageid');
                /*if (parseInt(pageno) > 0) {
                 //console.log(result['total']);
                 //console.log(parseInt(pageno)*10);
                 if (result['total'] >= parseInt(pageno)*10) {
                 $('.loadmore[data-pollid=' + result['ques_no'] + ']').css('display', 'block');
                 } else {
                 $('.loadmore[data-pollid=' + result['ques_no'] + ']').css('display', 'none');
                 }
                 } else {*/
                if (result['total'] > parseInt(pageno) * 10) {
                    $('.loadmore[data-pollid=' + result['ques_no'] + ']').css('display', 'block');
                } else {
                    $('.loadmore[data-pollid=' + result['ques_no'] + ']').css('display', 'none');
                }
                if (result['total'] < 2) {
                    $('.loadmore[data-pollid=' + result['ques_no'] + ']').css('display', 'none');
                }
                setTimeout(function () {
                    var html = "";
                    for (var i in result['data']) {
                        var replyby = result['data'][i]['user_id'] ==<?= $uid; ?> ? "You" : result['data'][i]['byuser'];
                        var iscmtedit = result['data'][i]['user_id'] ==<?= $uid; ?> ? "commentedit" : "";
                        var cmtedit = "";
                        if (result['data'][i]['user_id'] ==<?= $uid; ?>) {
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
                        var replyword = parseInt(result['data'][i]['total_replies']) > 1 ? " Replies" : " Reply";
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
                                                                <span class="mr10 lightgray fs12px fw500 linkpointer showreplies" data-cmtid="' + result['data'][i]['id'] + '" data-pollid="' + result['data'][i]['poll_id'] + '" data-replyset="0" data-totalreply="' + result['data'][i]['total_replies'] + '">' + result['data'][i]['total_replies'] + ' ' + replyword + '</span>\
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
                //}
            });
        });

</script>
<script>
        $(document).on('click', '#editpoll', function (e) {
            $('.linkpreview').remove();
            $('.slide-on-mobile').slideDown('slow');
            var pollid = $(this).attr('data-pollid');
            var data = $(this).attr('data-rowjson');
            data = JSON.parse(data);

            $("#pollcatergory input[value=" + data['category_id'] + "]").attr('checked', true);
            $('#polldescription').val(data['description']);
            $('#poll_id').val(pollid);
            $('#polltopic').val(data['poll']);
            $('#detailurl').val(data['url']);
            $('#poll_preview').val($(this).attr('data-preview'));
            $('#polldescription').parent().append('<div class="linkpreview">' + $(this).attr('data-preview') + '</div>');
            var choiceid = data['choice_id'];
            var choice = data['choice'];
            var html = "";
            var choiceidarr = choiceid.split(',');
            var choicearr = choice.split(',');
            var dbDate = data['end_date'];
            var date2 = new Date(dbDate);
            //console.log(date2);
            $('#enddate').datepicker('setDate', new Date(date2));

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
            var pollid = $(this).attr('data-pollid');
            $('#confirmdelete .yes').attr('data-pollid', pollid);
            //alert("hello");
        });

        $(document).on('click', '.yes', function (e) {
            var pollid = $(this).attr('data-pollid');
            $.ajax({
                url: '<?php echo base_url(); ?>Poll/deactive_poll',
                method: "POST",
                data: {pollid: pollid},
            }).done(function (result) {
                //console.log(result);
                result = JSON.parse(result);
                //console.log(result);
                if (result['status']) {
                    Materialize.Toast.removeAll();
                    Materialize.toast(result['message'], 4000);
                    //$('#card_' + pollid).slideUp('slow');
                    $('#confirmdelete').modal('close');
                    var categoryid =<?= $poll_detail[ 'category_id' ] ?>;
                    loaddatafortrending(categoryid, 0);
                    //loaddataformyraised(categoryid, 0);
                    load_my_answered_prediction(categoryid, 0);
                    setTimeout(function () {
                        window.location.assign("<?= base_url() ?>Poll");
                    }, 2000)
                }
            });
        });

</script>

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
        $(document).on('keypress', '.choice input', function (e) {
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
//                 url: '<?php echo base_url(); ?>Poll/load_more_polls',
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
        function loaddatafortrending(categoryid, pageno)
        {

            $.ajax({
                url: '<?php echo base_url(); ?>Poll/loadmoretrending',
                method: "POST",
                data: {categoryid: categoryid, pageno: pageno},
            }).done(function (result) {

                result = JSON.parse(result);
                var html = "";

                if (result['status']) {
                    if (result['data'] > 9) {

                    } else {
                        $('.loadmoretrending').remove();
                    }
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
                    <a href="<?= base_url() ?>Poll/polldetail/' + result['data'][i]['id'] + '?t=&ct=' + catname + '&pid=">\
                        <div class="col s12">\
                            <div class="blog-title truncate">' + result['data'][i]['poll'] + '</div>\
                            <div class="left fs11px fw600 blog-details mt10 text-upper category-display category ' + result['data'][i]['category_name'].toLowerCase() + '">' + result['data'][i]['category_name'] + '</div>\
                            <div class="right blog-details lightgray">\
                                <i class="lightgray flaticon-click ml0"></i>\
                                <span class="lightgray fs12px">' + result['data'][i]['total_votes'] + ' Votes</span></div>\
                        </div>\
                    </a>\
                </div>\
            </div>';
                    }
                    html += '<div class="loadmoretrending" data-page="' + (parseInt(pageno) + 1) + '" data-catid="' + categoryid + '"></div>';

                    if (pageno < 1) {
                        $('.trend .bindtrend').html(html)
                    } else {
                        $('.trend .bindtrend').append(html)
                    }

                }
            });
        }

        function load_my_answered_prediction(categoryid, pageno) {
            $.ajax({
                url: '<?= base_url(); ?>Poll/load_my_answered_prediction',
                method: "POST",
                data: {categoryid: categoryid, pageno: pageno},
            }).done(function (result) {
                result = JSON.parse(result);
                var html = "";
                //$('.loadersmall').css('display','none');
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
                                <a href="<?= base_url(); ?>Poll/polldetail/' + result['data'][i]['id'] + '?t=&ct=' + catname + '&pid=">\
                                    <div class="col s12">\
                                        <div class="blog-title truncate">' + result['data'][i]['poll'] + '</div>\
                                        <div class="left fs11px fw600 blog-details mt10 text-upper category-display category ' + result['data'][i]['category_name'].toLowerCase() + '">' + result['data'][i]['category_name'].toLowerCase() + '</div>\
                                        <div class="right blog-details lightgray">\
                                            <i class="lightgray flaticon-click ml0"></i>\
                                            <span class="lightgray fs12px">' + result['data'][i]['total_votes'] + ' Votes</span></div>\
                                        </div>\
                                </a>\
                            </div>\
                        </div>';
                    }
                    html += '<div class="loadmoremyraised" data-page="' + (parseInt(pageno) + 1) + '" data-catid="' + categoryid + '"></div>';
                    //console.log(html);
                    if (parseInt(pageno) < 1) {
                        $('.myraised .bindraised').html(html);
                    } else {
                        $('.myraised .bindraised').append(html);
                    }
                }
            });
        }
        function loaddataformyraised(categoryid, pageno)
        {
            //console.log(categoryid);
            //console.log(pageno);
            $.ajax({
                url: '<?php echo base_url(); ?>Poll/loadmoremyraised',
                method: "POST",
                data: {categoryid: categoryid, pageno: pageno},
            }).done(function (result) {

                result = JSON.parse(result);
                var html = "";
                if (result['status']) {
                    $('.loadmoremyraised').remove();

                    var catname = "";
                    //categoryid=result['data'][i]['category_id'];
//    if(categoryid=="1"){
//       catname="Governance"; 
//    } else if(categoryid=="2"){
//       catname="Money"; 
//    } else if(categoryid=="3"){
//        catname="Sports";
//    } else if(categoryid=="4"){
//        catname="Entertainment";
//    } else {
//        catname="Governance"; 
//    }
                    for (var i in result['data']) {
                        html += '<div class="blogs p15_20">\
                <div class="row">\
                    <a href="<?= base_url() ?>Poll/polldetail/' + result['data'][i]['id'] + '?t=&ct=' + result['data'][i]['category_name'] + '&pid=">\
                        <div class="col s12">\
                            <div class="blog-title truncate">' + result['data'][i]['poll'] + '</div>\
                            <div class="left fs11px fw600 blog-details mt10 text-upper category-display category ' + result['data'][i]['category_name'].toLowerCase() + '">' + result['data'][i]['category_name'] + '</div>\
                            <div class="right blog-details lightgray">\
                                <i class="lightgray flaticon-click ml0"></i>\
                                <span class="lightgray fs12px">' + result['data'][i]['total_votes'] + ' Votes</span></div>\
                        </div>\
                    </a>\
                </div>\
            </div>';
                    }
                    html += '<div class="loadmoremyraised" data-page="' + (parseInt(pageno) + 1) + '" data-catid="myraised"></div>';
                    //console.log(html);
                    if (pageno < 1) {
                        $('.myraised .bindraised').html(html)
                    } else {
                        $('.myraised .bindraised').append(html)
                    }

                } else {
                    //$('.loaddataformyraised').remove();
                }
            });
        }


        setTimeout(function () {
            var categoryid =<?= $poll_detail[ 'category_id' ] ?>;
            loaddatafortrending(categoryid, 0);
            load_my_answered_prediction(categoryid, 0);
        }, 2000);

        $('.trend').on('scroll', function () {
            if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                var categoryid = $('.loadmoretrending').attr('data-catid');
                var pageno = $('.loadmoretrending').attr('data-page');
                loaddatafortrending(categoryid, pageno);
            }
        });

        $('.myraised').on('scroll', function () {
            if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                var categoryid = $('.loadmoremyraised').attr('data-catid');
                var pageno = $('.loadmoremyraised').attr('data-page');
                //loaddataformyraised(categoryid, pageno);
                load_my_answered_prediction(categoryid, pageno);
            }
        })
</script>
<script>

//    $(document).on('change','input[type=radio]',function(){
//         if($(this).hasClass('showresults')){
//             var pollid=$(this).attr('data-pollid');
//             $('.polloption_'+pollid).addClass('votedpoll');
//              $(".polloption_"+pollid).each(function () {
//                var newper = $(this).attr('data-afterload');
//                $(this).css('width', newper + '%');
//            });
//         }
//         
//     });
        /*------------Uncommment this for Preview Functionality --------------------*/
        $(document).bind("paste", "#polldescription", function (e) {
            //$('.linkpreview').remove();

            var pastedData = e.originalEvent.clipboardData.getData('text');
            //getpreview(pastedData);
            var linkpreviewcount = $('#polldescription + .linkpreview').length;
            if (linkpreviewcount == 0) {
                var urls = findUrls(pastedData);

                if (urls != null && urls != "null") {
                    //console.log(urls.length);
                    getpreview(urls[0]);
//                for (var i = 0; i < parseInt(urls.length);i++) {
//                    var linkpreviewcount= $('.linkpreview').length;
//                    getpreview(urls[i]);
//                }
                }
                setTimeout(function () {
                    var target = $('#polldescription').val();
                    $('#polldescription').attr('data-oldtext', target);
                }, 100);
            }
        });
        $(document).on('keyup', '#polldescription', function (e)
        {
            var target = $(this).val();
            if (target == "") {
                $('.linkpreview').remove();
                $(this).attr('data-oldtext', '');
            } else {
                var urls = findUrls(target);
                if (urls != null && urls != "null") {
                    var linkpreviewcount = $('#polldescription + .linkpreview').length;
                    if (parseInt(linkpreviewcount) > parseInt(urls.length)) {
                        $('.linkpreview:last').remove();
                    }
                }
            }
        });

        $(document).on('keypress', '#polldescription', function (e)
        {
            var linkpreviewcount = $('#polldescription + .linkpreview').length;
            if (linkpreviewcount == 0) {
                if (e.which == 32 || e.which == 13) {
                    var target = $(this).val();
                    var oldtext = $(this).attr('data-oldtext');
                    $(this).attr('data-oldtext', target);
                    //console.log(target);
                    //console.log(oldtext);
                    if (oldtext != "") {
                        target = target.replace(oldtext, '');
                        //console.log(target);
                    }
                    var urls = findUrls(target);
                    //console.log(urls);
                    if (urls != null && urls != "null") {
                        getpreview(urls[0]);
                        //$('.linkpreview').remove();
                        //for (var i = 0; i < parseInt(urls.length);i++) {
                        //getpreview(urls[i]);
                        //}
                        //$(this).attr('data-oldtext',target);
                    }
                }
            }
        });

        function getpreview(target) {
            var loader = '<div id="videoloader">\
                            <div class="lds-spinner">\
                                <div></div>\
                                <div></div>\
                                <div></div>\
                                <div></div>\
                                <div></div>\
                                <div></div>\
                                <div></div>\
                                <div></div>\
                                <div></div>\
                                <div></div>\
                                <div></div>\
                                <div></div>\
                            </div>\
                            <label>Fetching preview</label>\
                        </div>';
            $('#polldescription').parent().append(loader);
            //console.log(target);
            $.ajax({
                url: '<?php echo base_url(); ?>Poll/getmetatags',
                method: "POST",
                data: {url: target},
            }).done(function (result) {
                result = JSON.parse(result);
                //console.log(result);
                if (result['status']) {
                    //$('.linkpreview').remove();
                    var url = result['data']['url'];
                    var title = result['data']['title'];
                    var image = result['data']['image'];
                    var description = result['data']['description'];

                    var html = '<div class="linkpreview">\
                                    <div class="row">\
                                        <div class="col m4 s12">\
                                            <div class="previewimg">\n\
                                            <img src="' + image + '" class="linkpreviewimg"/></div>\
                                        </div>\
                                        <div class="col m8 s12">\
                                            <div class="previewtext">\
                                                <h3 class="fs14px lightgray tastart">' + title + '</h3>\
                                                <h5 class="fs12px lightgray tastart">' + description + '</h5>\
                                                <a class="fs12px" target="_blank" href=http://' + url + '>' + url + '</a>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>';
                    $('#polldescription').parent().append(html);

                }
                $('#videoloader').remove();
            });
            return true;
        }



        function findUrls(text)
        {
            //urls = text.match(/(\b(?:(?:https?|ftp|file|[A-Za-z]+):\/\/|www\.|ftp\.)(?:\([-A-Z0-9+&@#\/%=~_|$?!:,.]*\)|[-A-Z0-9+&@#\/%=~_|$?!:,.])*(?:\([-A-Z0-9+&@#\/%=~_|$?!:,.]*\)|[A-Z0-9+&@#\/%=~_|$]))/i);
            urls = text.match(/(https?:\/\/[^\s]+)/g);
            return urls;
        }
        /*------------Uncommment this for Preview Functionality till this--------------------*/

        (function ($) {
            var url1 = /(^|&lt;|\s)(www\..+?\..+?)(\s|&gt;|$)/g,
                    url2 = /(^|&lt;|\s)(((https?|ftp):\/\/|mailto:).+?)(\s|&gt;|$)/g,
                    linkifyThis = function () {
                        var childNodes = this.childNodes,
                                i = childNodes.length;
                        while (i--)
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
                            } else if (n.nodeType == 1 && !/^(a|button|textarea)$/i.test(n.tagName)) {
                                linkifyThis.call(n);
                            }
                        }
                    };

            $.fn.linkify = function () {
                return this.each(linkifyThis);
            };

        })(jQuery);

// Usage example:
        jQuery('h6.tastart').linkify();


        $(function () {

            $(document).on("click", ".check_expert_result", function (e) {
                e.preventDefault();
                var _this = $(this);
                _this.parent().find('.tgl-ios').toggleClass("active");
                var id = $(this).attr("data-pollid") || 0;
                var polloptions = _this.closest(".card").find(".polloptions")

                if (!_this.hasClass("data-expert"))
                    get_experts_result(id).done(function (result) {
                        result = JSON.parse(result);
                        $.each(result.data, function (a, b) {
                            var choice = $("[data-choiceid='" + b.choice + "']", polloptions);
                            choice.find(".determinate").attr("data-expert", b.expert_percent);
                            switchexpert(choice);
                            _this.addClass("data-expert");
                        })
                    });
                else {
                    $("[data-choiceid]", polloptions).each(function () {
                        switchexpert($(this));
                    })
                }
            });

        })
        function switchexpert(choice) {
            if (!choice.hasClass("expert"))
            {
                choice.find(".determinate").css('width', choice.find(".determinate").attr("data-expert") + '%');
                choice.find(".avgpercount").html(choice.find(".determinate").attr("data-expert") + " %");
            } else {

                choice.find(".determinate").css('width', choice.find(".determinate").attr("data-afterload") + '%')
                choice.find(".avgpercount").html(choice.find(".determinate").attr("data-afterload") + " %");
            }
            choice.toggleClass("expert");

        }

        function get_experts_result(id) {
            return $.ajax({
                url: "<?= base_url() ?>Poll/experts_result",
                method: "POST",
                data: {id: id}
            })
        }

</script>
<?php

function encodeURIComponent( $str ) {
        $revert = array ( '%21' => '!', '%2A' => '*', '%27' => "'", '%28' => '(', '%29' => ')' );
        return strtr( rawurlencode( $str ), $revert );
}
?>