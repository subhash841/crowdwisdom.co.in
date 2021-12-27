<?php
$this -> load -> helper( 'common_helper' );
$today = date( "Y-m-d H:i:s" );
?>
<input type="hidden" id="redirecturl" value="<?= base_url() ?>Login?section=poll&p=gov">
<div class="content container forumpages forumpagelist polllists" id="forumdetailpage">
    <div class="col s12">
        <div class="row">
            <div class="col l8 s12 plr15">
                <div class="row mb0">
                    <div class="col m12 s12">
                        <ul id="tabs-swipe-demo" class="tabs forumtypetab">
                            <!--<li class="tab col m2 m2_5"><a href="#mydiscuss"><i class="flaticon-social"></i> My Decisions</a></li>-->
                            <li class="tab col m3"><a href="#elecpoll" data-catid="<?= $category_list[ 0 ][ 'id' ] ?>" data-type="gov" class="<?= ! empty( $governance ) ? "active" : "" ?>"><i class="flaticon-interface"></i> Elections</a></li>
                            <li class="tab col m3"><a href="#stockpoll" data-catid="<?= $category_list[ 1 ][ 'id' ] ?>" data-type="money" class="<?= ! empty( $money ) ? "active" : "" ?>"><i class="flaticon-money"></i> Money</a></li>
                            <li class="tab col m3"><a href="#sportpoll" data-catid="<?= $category_list[ 2 ][ 'id' ] ?>" data-type="sport" class="<?= ! empty( $sports ) ? "active" : "" ?>" ><i class="flaticon-ball"></i> Sports</a></li>
                            <li class="tab col m3"><a href="#moviepoll" data-catid="<?= $category_list[ 3 ][ 'id' ] ?>" data-type="entert" class="<?= ! empty( $entertainment ) ? "active" : "" ?>" ><i class="flaticon-movie"></i> Entertainment</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row slide-on-mobile-button">
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
                            <form id="postpoll" name="myform" method="POST" action="<?= base_url() ?>Poll/add_update_poll"  onsubmit="return validateForm()">
                                <div class="card forumarea">
                                    <div class="row mb0">
                                        <div class="col m12 s12">
                                            <div class="row mb0">
                                                <div class="col s12">
                                                    <textarea id="polltopic" name="polltopic" placeholder="Ask your question with 'What' , 'Why' , 'Which' etc" maxlength="75"></textarea>
                                                </div>
                                            </div>
                                            <div class="row mb0">
                                                <div class="col s12">
                                                    <h5 class="fs13px fw600 fieldtitle">Select a Category</h5>
                                                    <div id="pollcatergory">
                                                        <?php
                                                        foreach ( $category_list as $pollcat ) {
                                                                echo '<div class="col m3 s6">';
                                                                echo '<input type="radio" id="cat_' . $pollcat[ 'id' ] . '" name="pollcatergory" value="' . $pollcat[ 'id' ] . '">
                                                                                                                                <label for="cat_' . $pollcat[ 'id' ] . '"><div class="p5-10 ">' . $pollcat[ 'name' ] . '</div></label>';

                                                                echo '</div>';
                                                        }
                                                        ?>
                                                    </div>
                                                    <!--<input type="radio" id="test2" name="radio-group">
                                                        <label for="test2"><span>Peach</span></label>

                                                        <input type="radio" id="test3" name="radio-group">
                                                        <label for="test3"><span>Orange</span></label>-->
                                                </div>
                                            </div>
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
                                            <input type="" id="enddate" id="enddate" name="enddate" data-toggle="datepicker" autocomplete="off" readonly="true">
                                        </div>
                                    </div>
                                    <div class="row center mt35b20">
                                        <input type="hidden" id="poll_id" name="poll_id" value="0">
                                        <input type="hidden" id="poll_preview" name="poll_preview" value="">
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
                        <div class="loadersmall" style="display:none;">
                            <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                        </div>
                    </div>
                    <div id="elecpoll" class="col s12 pollcat" <?= ! empty( $governance ) ? "active" : "" ?>></div>
                    <div id="stockpoll" class="col s12 pollcat" <?= ! empty( $money ) ? "active" : "" ?>></div>
                    <div id="sportpoll" class="col s12  pollcat" <?= ! empty( $sports ) ? "active" : "" ?>></div>
                    <div id="moviepoll" class="col s12 pollcat" <?= ! empty( $entertainment ) ? "active" : "" ?>></div>
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


                                    <div class="center">
                                        <img src="<?= base_url( 'images/infographics/2.png' ); ?>" style="width: 50%;">
                                        <h3 class="fs16px fieldtitle ">No trending questions available. </h3>
                                    </div>
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

                                    <div class="loadmoremyraised" data-page="1" data-catid="myraised"></div>
                                    <div class="center">
                                        <img src="<?= base_url( 'images/infographics/3.png' ); ?>" style="width: 50%;">
                                        <h3 class="fs16px fieldtitle ">You havent Answered any questions yet.</h3>
                                    </div>
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

                                    <div class="center">
                                        <img src="<?= base_url( 'images/infographics/2.png' ); ?>" style="width: 50%;">
                                        <h3 class="fs16px fieldtitle ">No trending questions available. </h3>
                                    </div>
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

                                    <div class="center">
                                        <img src="<?= base_url( 'images/infographics/3.png' ); ?>" style="width: 50%;">
                                        <h3 class="fs16px fieldtitle ">You havent Answered any questions yet.</h3>
                                    </div>
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
        <h5 class="fs16px">Are you sure want to delete this Poll ?</h5>
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
        var options = {
            loggedin:<?php echo empty( $this -> session -> userdata( 'data' ) ) ? 'false' : 'true'; ?>,
            alias: '<?= $alias; ?>',
            toast: '<?= $this -> session -> flashdata( 'toast' ); ?>',
            uid: <?= $uid; ?>,
            baseurl: '<?= base_url(); ?>'
    
        }
</script>

<script src="<?= base_url(); ?>js/poll.js?v=1.9.3" ></script>
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
