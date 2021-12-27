<style>
    .tabs_content{
        display:none;
    }
</style>
<script>
$(document).on('click','a#show-mobile-discussion',function(){
    console.log('here');
    $('.slide-on-mobile').slideToggle();
})
</script>
<!--<div class="loadersmall" style="display:none"></div>-->
<div class="content container forumpages forumpagelist" id="forumdetailpage">
    <div class="row mb0">
        <div class="col m12 s12">
            <ul id="tabs-swipe-demo" class="tabs forumtypetab">
                <li class="tab col m2 m2_5"><a href="#mydiscuss"><i class="flaticon-social"></i> My Forums</a></li>
                <li class="tab col m2 m2_5"><a href="#elecforum" class="active"><i class="flaticon-interface"></i> Elections</a></li>
                <li class="tab col m2 m2_5"><a href="#stockforum"><i class="flaticon-money"></i> Stocks</a></li>
                <li class="tab col m2 m2_5"><a href="#sportforum"><i class="flaticon-ball"></i> Sports</a></li>
                <li class="tab col m2 m2_5"><a href="#movieforum"><i class="flaticon-tool"></i> Movies</a></li>
            </ul>
<!--            <select id="mobtabcategories" class="hide-on-med-and-up mobcatselecttabs center mtb10" name="mobtabcategories">
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
            ?> <a id="show-mobile-discussion" class="btn btn-default start-discussion themered">Start discussion</a> <?php
        } ?>
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
    <div id="mydiscuss" class="col s12">
        <div class="row">
            <?php if (!empty($mydiscussions)) { ?>
                <?php foreach ($mydiscussions as $md) { ?>
                    <div class="col l3 m6 s12">
                        <?php
                        $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                            "(", ")", "{", "}", "|", "/", ";", "'", "<",
                            ">", ",");
                        $title = str_replace($spchar, "", $md['title']);
                        $title = str_replace(' ', '-', $title);
                        $href = base_url() . 'Forum/forumdetail/' . $md['id'] . "/" . $title;
                        $target = 'target = "_blank"';
                        ?>
                        <a href="<?= $href ?>" style="color:#232b3c">
                            <div class="card p-0 equal-height">
                                <div class="mb0">
                                    <div class="posrel tint">

                                        <img class="forumcardimg" src="<?= base_url() . 'images/forums/' . $md['image']?>" alt="Crowd Prediction">

                                        <div class="btn reactforum category <?= strtolower($md['category_name']); ?>"><?= $md['category_name']; ?></div>
                                    </div>
                                </div>
                                <div class="row mb0 author-detail">
                                    <div class="col m8 s7"><h6 class="forumsubhead fs10px tastart" style="color: #6F7781;"><i class="flaticon-social-2"></i><i style="margin-left: 10px;">By <?= $user_id == $md['user_id'] ? 'You' : $md['byuser']; ?></i></h6></div>
                                    <div class="col m4 s5"><h6 class="forumsubhead fs10px right right-align"><i><?= date('j M Y', strtotime($md['created_date'])); ?></i></h6></div>
                                </div>
                                <div class="card_content p0-10 forumcardbox">
                                    <!--<label class="forumsubhead text-uppercase fw700 fs12px"><?= $md['category_name'] ?></label>-->
                                    <h6 class="fs14px tastart" style=""><?= $md['title'] ?></h6>
                                </div>
                                <div class="newforumfooter" style="padding: 0 10px 5px;">

                                    <?php
                                    $total_like = $md['total_like'];
                                    $total_neutral = $md['total_neutral'];
                                    $total_dislike = $md['total_dislike'];
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
                                    <div id="formsprogressbar">
                                        <div class="row mb-0 center">
                                            <div class="progressforumcir col m4 s4" id="containlike<?= $md['id'] ?>md" data-tabname="md" data-btntype="like" data-formid="<?= $md['id'] ?>" data-per="<?= $likeper ?>">
                                            </div>
                                            <div class="progressforumcir col m4 s4" id="containneutral<?= $md['id'] ?>md" data-tabname="md" data-btntype="neutral" data-formid="<?= $md['id'] ?>" data-per="<?= $neutralper ?>">
                                            </div>
                                            <div class="progressforumcir col m4 s4" id="containdislike<?= $md['id'] ?>md" data-tabname="md" data-btntype="dislike" data-formid="<?= $md['id'] ?>" data-per="<?= $dislikeper ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div></a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <!--                <h5 >Your Discussion will appear here</h5>-->
            <?php } ?>
        </div>
    </div>
    <div id="elecforum" class="col s12 active">
        <div class="row">
            <?php if (!empty($elections)) { ?>
                <?php foreach ($elections as $el) { ?>
                    <div class="col l3 m6 s12">
                        <?php
                        $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                            "(", ")", "{", "}", "|", "/", ";", "'", "<",
                            ">", ",");
                        $title = str_replace($spchar, "", $el['title']);
                        $title = str_replace(' ', '-', $title);
                        $href = base_url() . 'Forum/forumdetail/' . $el['id'] . "/" . $title;
                        $target = 'target = "_blank"';
                        ?>
                        <a href="<?= $href ?>" style="color:#232b3c">
                            <div class="card p-0 equal-height">
                                <div class="mb0">

                                    <div class="posrel tint">

                                        <img class="forumcardimg" src="<?= base_url() . 'images/forums/' . $el['image']?>" alt="Crowd Prediction">


                                    </div>
                                </div>
                                <div class="row mb0 author-detail">
                                    <div class="col m8 s7"><h6 class="forumsubhead fs10px tastart" style="color: #6F7781;"><i class="flaticon-social-2"></i><i style="margin-left: 10px;">By <?= $user_id == $el['user_id'] ? 'You' : $el['byuser']; ?></i></h6></div>
                                    <div class="col m4 s5"><h6 class="forumsubhead fs10px right right-align"><i><?= date('j M Y', strtotime($el['created_date'])); ?></i></h6></div>
                                </div>
                                <div class="card_content p0-10 forumcardbox">
                                    <!--<label class="forumsubhead text-uppercase fw700 fs12px"><?= $el['category_name'] ?></label>-->
                                    <h6 class="fs14px tastart" style=""><?= $el['title'] ?></h6>
                                </div>
                                <div class="newforumfooter" style="padding: 0 10px 5px;">
                                    <?php
                                    $total_like = $el['total_like'];
                                    $total_neutral = $el['total_neutral'];
                                    $total_dislike = $el['total_dislike'];
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
                                    <div id="formsprogressbar">
                                        <div class="row mb-0 center">
                                            <div class="progressforumcir col m4 s4" id="containlike<?= $el['id'] ?>el" data-tabname="el" data-btntype="like" data-formid="<?= $el['id'] ?>" data-per="<?= $likeper ?>">
                                            </div>
                                            <div class="progressforumcir col m4 s4" id="containneutral<?= $el['id'] ?>el" data-tabname="el" data-btntype="neutral" data-formid="<?= $el['id'] ?>" data-per="<?= $neutralper ?>">
                                            </div>
                                            <div class="progressforumcir col m4 s4" id="containdislike<?= $el['id'] ?>el" data-tabname="el" data-btntype="dislike" data-formid="<?= $el['id'] ?>" data-per="<?= $dislikeper ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div></a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <!--                <h5 >Your Election Discussion will appear here</h5>-->
            <?php } ?>
        </div>
    </div>
    <div id="stockforum" class="col s12">
        <div class="row">
            <?php if (!empty($stocks)) { ?>
                <?php foreach ($stocks as $s) { ?>
                    <div class="col l3 m6 s12">
                        <?php
                        $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                            "(", ")", "{", "}", "|", "/", ";", "'", "<",
                            ">", ",");
                        $title = str_replace($spchar, "", $s['title']);
                        $title = str_replace(' ', '-', $title);
                        $href = base_url() . 'Forum/forumdetail/' . $s['id'] . "/" . $title;
                        $target = 'target = "_blank"';
                        ?>
                        <a href="<?= $href ?>"   style="color:#232b3c">
                            <div class="card p-0 equal-height">
                                <div class="mb0">

                                    <div class="posrel tint">

                                        <img class="forumcardimg" src="<?= base_url() . 'images/forums/' . $s['image'] ?>" alt="Crowd Prediction">


                                    </div>
                                </div>
                                <div class="row mb0 author-detail">
                                    <div class="col m8 s7"><h6 class="forumsubhead fs10px tastart" style="color: #6F7781;"><i class="flaticon-social-2"></i><i style="margin-left: 10px;">By <?= $user_id == $s['user_id'] ? 'You' : $s['byuser']; ?></i></h6></div>
                                    <div class="col m4 s5"><h6 class="forumsubhead fs10px right right-align"><i><?= date('j M Y', strtotime($s['created_date'])); ?></i></h6></div>
                                </div>
                                <div class="card_content p0-10 forumcardbox">
                                    <!--<label class="forumsubhead text-uppercase fw700 fs12px"><?= $s['category_name'] ?></label>-->
                                    <h6 class="fs14px tastart" style=""><?= $s['title'] ?></h6>
                                </div>
                                <div class="newforumfooter" style="padding: 0 10px 5px;">

                                    <?php
                                    $total_like = $s['total_like'];
                                    $total_neutral = $s['total_neutral'];
                                    $total_dislike = $s['total_dislike'];
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
                                    <div id="formsprogressbar">
                                        <div class="row mb-0 center">
                                            <div class="progressforumcir col m4 s4" id="containlike<?= $s['id'] ?>s" data-tabname="s" data-btntype="like" data-formid="<?= $s['id'] ?>" data-per="<?= $likeper ?>">
                                            </div>
                                            <div class="progressforumcir col m4 s4" id="containneutral<?= $s['id'] ?>s" data-tabname="s" data-btntype="neutral" data-formid="<?= $s['id'] ?>" data-per="<?= $neutralper ?>">
                                            </div>
                                            <div class="progressforumcir col m4 s4" id="containdislike<?= $s['id'] ?>s" data-tabname="s" data-btntype="dislike" data-formid="<?= $s['id'] ?>" data-per="<?= $dislikeper ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div></a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <!--                <h5 >Your Stock Discussion will appear here</h5>-->
            <?php } ?>
        </div>
    </div>
    <div id="sportforum" class="col s12 ">
        <div class="row">
            <?php
            if (!empty($sports)) {
                foreach ($sports as $sp) {
                    ?>
                    <div class="col l3 m6 s12">
                        <?php
                        $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                            "(", ")", "{", "}", "|", "/", ";", "'", "<",
                            ">", ",");
                        $title = str_replace($spchar, "", $sp['title']);
                        $title = str_replace(' ', '-', $title);
                        $href = base_url() . 'Forum/forumdetail/' . $sp['id'] . "/" . $title;
                        $target = 'target = "_blank"';
                        ?>
                        <a href="<?= $href ?>"   style="color:#232b3c">
                            <div class="card p-0 equal-height">
                                <div class="mb0">

                                    <div class="posrel tint">

                                        <img class="forumcardimg" src="<?= base_url() . 'images/forums/' . $sp['image']?>" alt="Crowd Prediction">


                                    </div>
                                </div>
                                <div class="row mb0 author-detail">
                                    <div class="col m8 s7"><h6 class="forumsubhead fs10px tastart" style="color: #6F7781;"><i class="flaticon-social-2"></i><i style="margin-left: 10px;">By <?= $user_id == $sp['user_id'] ? 'You' : $sp['byuser']; ?></i></h6></div>
                                    <div class="col m4 s5"><h6 class="forumsubhead fs10px right right-align"><i><?= date('j M Y', strtotime($sp['created_date'])); ?></i></h6></div>
                                </div>
                                <div class="card_content p0-10 forumcardbox">
                                    <!--<label class="forumsubhead text-uppercase fw700 fs12px"><?= $sp['category_name'] ?></label>-->
                                    <h6 class="fs14px tastart" style=""><?= $sp['title'] ?></h6>
                                </div>
                                <div class="newforumfooter" style="padding: 0 10px 5px;">

                                    <?php
                                    $total_like = $sp['total_like'];
                                    $total_neutral = $sp['total_neutral'];
                                    $total_dislike = $sp['total_dislike'];
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
                                    <div id="formsprogressbar">
                                        <div class="row mb-0 center">
                                            <div class="progressforumcir col m4 s4" id="containlike<?= $sp['id'] ?>sp" data-tabname="sp" data-btntype="like" data-formid="<?= $sp['id'] ?>" data-per="<?= $likeper ?>">
                                            </div>
                                            <div class="progressforumcir col m4 s4" id="containneutral<?= $sp['id'] ?>sp" data-tabname="sp" data-btntype="neutral" data-formid="<?= $sp['id'] ?>" data-per="<?= $neutralper ?>">
                                            </div>
                                            <div class="progressforumcir col m4 s4" id="containdislike<?= $sp['id'] ?>sp" data-tabname="sp" data-btntype="dislike" data-formid="<?= $sp['id'] ?>" data-per="<?= $dislikeper ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div></a>
                    </div>
                    <?php
                }
            } else {
                ?>
                <!--                <h5 >Your Sports Discussion will appear here</h5>-->
            <?php } ?>
        </div>
    </div>
    <div id="movieforum" class="col s12">
        <div class="row">
            <?php if (!empty($movies)) { ?>
                <?php foreach ($movies as $mov) { ?>
                    <div class="col l3 m6 s12">
                        <?php
                        $spchar = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*",
                            "(", ")", "{", "}", "|", "/", ";", "'", "<",
                            ">", ",");
                        $title = str_replace($spchar, "", $mov['title']);
                        $title = str_replace(' ', '-', $title);
                        $href = base_url() . 'Forum/forumdetail/' . $mov['id'] . "/" . $title;
                        $target = 'target = "_blank"';
                        ?>
                        <a href="<?= $href ?>"   style="color:#232b3c">

                            <div class="card p-0 equal-height">
                                <div class="mb0">

                                    <div class="posrel tint">

                                        <img class="forumcardimg" src="<?= base_url() . 'images/forums/' . $mov['image'] ?>" alt="Crowd Prediction">


                                    </div>
                                </div>
                                <div class="row mb0 author-detail">
                                    <div class="col m8 s7"><h6 class="forumsubhead fs10px tastart" style="color: #6F7781;"><i class="flaticon-social-2"></i><i style="margin-left: 10px;">By <?= $user_id == $mov['user_id'] ? 'You' : $mov['byuser']; ?></i></h6></div>
                                    <div class="col m4 s5"><h6 class="forumsubhead fs10px right right-align"><i><?= date('j M Y', strtotime($mov['created_date'])); ?></i></h6></div>
                                </div>
                                <div class="card_content p0-10 forumcardbox">
                                    <!--<label class="forumsubhead text-uppercase fw700 fs12px"><?= $mov['category_name'] ?></label>-->
                                    <h6 class="fs14px tastart" style=""><?= $mov['title'] ?></h6>
                                </div>
                                <div class="newforumfooter" style="padding: 0 10px 5px;">

                                    <?php
                                    $total_like = $mov['total_like'];
                                    $total_neutral = $mov['total_neutral'];
                                    $total_dislike = $mov['total_dislike'];
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
                                    <div id="formsprogressbar">
                                        <div class="row mb-0 center">
                                            <div class="progressforumcir col m4 s4" id="containlike<?= $mov['id'] ?>mov" data-tabname="mov" data-btntype="like" data-formid="<?= $mov['id'] ?>" data-per="<?= $likeper ?>">
                                            </div>
                                            <div class="progressforumcir col m4 s4" id="containneutral<?= $mov['id'] ?>mov" data-tabname="mov" data-btntype="neutral" data-formid="<?= $mov['id'] ?>" data-per="<?= $neutralper ?>">
                                            </div>
                                            <div class="progressforumcir col m4 s4" id="containdislike<?= $mov['id'] ?>mov" data-tabname="mov" data-btntype="dislike" data-formid="<?= $mov['id'] ?>" data-per="<?= $dislikeper ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div></a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <!--                <h5 >Your Movie Discussion will appear here</h5>-->
            <?php } ?>
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
        var forumcategory = $("#forumcatergory").val();

        var Coverimage = $("#fileUpload").val();
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
        if (!Coverimage && cwimg == "") { // returns true if the string is not empty
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
                    $('input[type=file]').val(null) ;
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
</script>


