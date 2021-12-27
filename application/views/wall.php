<?php
$sessiondata = $this->session->userdata('data');
if (!empty($data)) {
    $email_ids = $data[0]['topic_associated'][0]['email_ids'];

    if ($data[0]['topic_associated'][0]['is_private'] == "1" && empty($sessiondata)) { // not logged in user
        redirect("Login");
    } else if ($data[0]['topic_associated'][0]['is_private'] == "1" && !empty($sessiondata) && !in_array($sessiondata['email'], explode(",", $email_ids))) {
        redirect("Index");
    }
}
?>
<div class="container mb-5 data-container poll">
    <?php //print "<pre>"; print_r( $data ); print "</pre>"; exit;?>
    <div class="row mt-3">
        <div class='col-md-9 voice-cont  flex-fill d-flex flex-column'>
            <div class="raise_voice_banner row align-items-center m-0">
                <div class="col-4">
                    <img class='img-fluid d-block mx-auto' src="<?= base_url("images/icons/blog_banner_2.png") ?>"/>
                </div>
                <div class="col-8">
                    <div class='row align-items-center'>

                        <div class="col-md-8">
                            <h4 class="text-white">Start discussion on any <span>Topic</span></h4>
                        </div>
                        <div class="col-md-4 mt-2 mt-0-md">
                            <a class="btn btn-danger btn_create btn_create_wall rounded-btn" href="#">Ask Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog-list-section bg-w-block py-4 d-block mt-3">
                <?php
                if (empty($data)) {
                    ?>
                    <div class='row mx-3 my-2'>
                        <div class="col-12 position-relative"><h3 style="font-weight:300;max-width: 90%;">This requested URL is not found</h3></div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class='row mx-3 my-2 pollcont'>
                        <?php
                        $share_url = urlencode(base_url() . ltrim($_SERVER['REQUEST_URI'], '/'));
                        $title = $data[0]['title'];
                        $did = $data[0]['id'];

                        $userchoice = $data[0]['users_choice'];
                        $enddate = strtotime($data[0]['end_date']) < time() ? true : false;
                        $showper = $enddate ? true : ($userchoice ? true : false);

                        $selectedTopicIds = array();
                        if (!empty(@$data[0]['topic_associated'])) {
                            foreach (@$data[0]['topic_associated'] as $ta):
                                $selectedTopicIds[] = $ta['topic_id'];
                            endforeach;
                        }
                        ?>
                        <?php if ($data[0]['image']) { ?>
                            <div class="col-12 position-relative mb-3 text">

                                <img src="<?= $data[0]['image'] ?>" class="img-fluid w-100" />
                            </div>
                        <?php } ?>
                        <div class="col-12 position-relative">

                            <h1 class="font-weight-175" style="font-weight:300;max-width: 85%; "><?= $data[0]['title'] ?></h1>

                            <?php
                            if ($data[0]['user_id'] === $uid) {
                                ?>
                                <h6 id="blogedit" class='comment-action float-right mr-3'>
                                    <a href="<?= base_url() ?>Wall/raise_wall/<?= $did ?>" class="a-nostyle edit-voice" data-id="<?= $did ?>"><small>
                                            EDIT</small>
                                    </a>
                                    <span>&nbsp;&nbsp;&#9679;&nbsp;&nbsp;</span>
                                    <a href="#" class="a-nostyle delete-voice" data-id="<?= $did ?>" data-toggle="modal" data-target="#cnfDeleteModal"><small>DELETE</small>
                                    </a>
                                </h6>
                                <?php
                            }
                            ?></div>

                        <div class="col-12 ">
                            <div class="row">
                                <div class="mb-1 col-md-6 mt-3">
                                    <p><b id="blog-author" class="text-black-50 text-capitalize">By </b><?= $data[0]['alias'] ? $data[0]['alias'] : "<img src='" . base_url("/images/logo/crowd-wisdom.png") . "' class='img-fluid author-img'>" ?> | <i class="text-black-50"><?= date("F d, Y", strtotime($data[0]['created_date'])) ?></i></p>
                                </div>

                                <div class="col-md-6 my-2">
                                    <div class="d-flex flex-row justify-content-md-end justify-content-center">
                                        <a class="d-flex align-items-center bg-facebook text-white rounded cust-btn btn  mx-2-md mx-1"
                                           href="http://www.facebook.com/sharer/sharer.php?u=<?= $share_url ?>" target="_blank">
                                            <i class="fa fa-facebook"></i>
                                            <h6 class="mb-0">Share</h6>
                                        </a>
                                        <a class="d-flex align-items-center bg-twitter text-white rounded cust-btn btn mx-2-md mx-1" 
                                           href="https://twitter.com/intent/tweet?url=<?= $share_url ?>&text='<?= urlencode($title) ?>'&ael;hashtags=Crowdwisdom" target="_blank">
                                            <i class="fa fa-twitter"></i>
                                            <h6 class="mb-0">Tweet</h6>
                                        </a>
                                        <a class="d-flex bg-linkdein align-items-center text-white rounded cust-btn btn mx-2-md mx-1"
                                           href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $share_url ?>&title=<?= urlencode($title) ?>"  target="_blank">
                                            <i class="fa fa-linkedin"></i>
                                            <h6 class="mb-0">Share</h6>
                                        </a>
                                        <a class="d-flex bg-whatsapp align-items-center text-white rounded cust-btn btn  mx-2-md mx-1"
                                           href="https://wa.me/?text=<?= $share_url ?>"   target="_blank">
                                            <i class="fa fa-whatsapp"></i>
                                            <h6 class="mb-0">Share</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="row ml-0">
                                <?php
                                if (!empty($data[0]['user_actions'])) {
                                    foreach ($data[0]['user_actions'] as $actions) {
                                        $user_like = $actions['likes'];
                                        $user_dislike = $actions['dislikes'];
                                        $user_neutral = $actions['neutral'];
                                    }
                                } else {
                                    $user_like = $user_dislike = $user_neutral = 0;
                                }
                                ?>
                                <div class="mr-auto">
                                    <div class="float-left mr-4 text-center d-block wall-action" data-type="like" data-val="<?= $user_like ?>">
                                        <div class="mb-1 p-3 btn btn-outline-success rounded-circle d-block">
                                            <img src="<?= base_url() ?>images/icons/likew.png" width="20px" >
                                        </div>
                                        <small class="text-primary font-weight-500">Like</small>
                                    </div>   
                                    <div class="float-left mr-4 text-center d-block wall-action" data-type="dislike" data-val="<?= $user_dislike ?>">
                                        <div class="mb-1 p-3 btn btn-outline-danger rounded-circle d-block">
                                            <img src="<?= base_url() ?>images/icons/dislikew.png" width="20px" >
                                        </div>
                                        <small class="text-primary font-weight-500">Dislike</small>
                                    </div>
                                    <div class="float-left mr-4 text-center d-block wall-action" data-type="neutral" data-val="<?= $user_neutral ?>">
                                        <div class="mb-1 p-3 btn btn-outline-info rounded-circle d-block">
                                            <img src="<?= base_url() ?>images/icons/neutralw.png" width="20px" >
                                        </div>
                                        <small class="text-primary font-weight-500">Neutral</small>
                                    </div>
                                    <div class="clearfix"></div>

                                </div>
                                <div class="flex-wrapper ml-auto">
                                    <?php
                                    if (!empty($data[0]['count_actions'])) {
                                        foreach ($data[0]['count_actions'] as $actions_count) {
                                            $total_counts = $actions_count['total_counts'];
                                            $total_likes = $actions_count['total_likes'];
                                            $total_dislikes = $actions_count['total_dislikes'];
                                            $total_neutral = $actions_count['total_neutral'];

                                            $total_likes = $total_likes / $total_counts * 100;
                                            $total_dislikes = $total_dislikes / $total_counts * 100;
                                            $total_neutral = $total_neutral / $total_counts * 100;
                                        }
                                    } else {
                                        $total_counts = $total_likes = $total_dislikes = $total_neutral = 0;
                                    }
                                    ?>
                                    <?php
                                    if (!empty($data[0]['user_actions'])) {
                                        ?>
                                        <div class="single-chart text-center">
                                            <svg viewBox="0 0 36 36" class="circular-chart green">
                                            <path class="circle-bg"
                                                  d="M18 2.0845
                                                  a 15.9155 15.9155 0 0 1 0 31.831
                                                  a 15.9155 15.9155 0 0 1 0 -31.831"
                                                  />
                                            <path class="circle"
                                                  stroke-dasharray="<?= $total_likes ?>, 100"
                                                  d="M18 2.0845
                                                  a 15.9155 15.9155 0 0 1 0 31.831
                                                  a 15.9155 15.9155 0 0 1 0 -31.831"
                                                  />
                                            <text x="18" y="20.35" class="percentage"><?= round($total_likes) ?>%</text>
                                            </svg>
                                            <small class="mt-1 text-primary font-weight-500">Like</small>
                                        </div>

                                        <div class="single-chart text-center">
                                            <svg viewBox="0 0 36 36" class="circular-chart orange">
                                            <path class="circle-bg"
                                                  d="M18 2.0845
                                                  a 15.9155 15.9155 0 0 1 0 31.831
                                                  a 15.9155 15.9155 0 0 1 0 -31.831"
                                                  />
                                            <path class="circle"
                                                  stroke-dasharray="<?= $total_dislikes ?>, 100"
                                                  d="M18 2.0845
                                                  a 15.9155 15.9155 0 0 1 0 31.831
                                                  a 15.9155 15.9155 0 0 1 0 -31.831"
                                                  />
                                            <text x="18" y="20.35" class="percentage"><?= round($total_dislikes) ?>%</text>
                                            </svg>
                                            <small class="mt-1 text-primary font-weight-500">Dislike</small>
                                        </div>

                                        <div class="single-chart text-center">
                                            <svg viewBox="0 0 36 36" class="circular-chart blue">
                                            <path class="circle-bg"
                                                  d="M18 2.0845
                                                  a 15.9155 15.9155 0 0 1 0 31.831
                                                  a 15.9155 15.9155 0 0 1 0 -31.831"
                                                  />
                                            <path class="circle"
                                                  stroke-dasharray="<?= $total_neutral ?>, 100"
                                                  d="M18 2.0845
                                                  a 15.9155 15.9155 0 0 1 0 31.831
                                                  a 15.9155 15.9155 0 0 1 0 -31.831"
                                                  />
                                            <text x="18" y="20.35" class="percentage"><?= round($total_neutral) ?>%</text>
                                            </svg>
                                            <small class="mt-1 text-primary font-weight-500">Neutral</small>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="" id="bloglikecomment">
                                <div class="d-flex align-items-center">
                                    <?php if (!$enddate) { ?>
                                        <a href="#" class="rounded-semi btn btn-primary shadow mr-3 vote">Vote</a>
                                    <?php } ?>
                                    <a href="#" class="rounded-semi btn btn-default bg-w-block shadow trend d-none">Trend</a>
                                    <small class="likes mt-2 ml-auto"><span class='total-likes-count'><?= "" /* @$data[ 0 ][ 'total_views' ] */ ?> <!--Views &nbsp;&nbsp;&#x25cf;&nbsp;&nbsp; --> <?= @$data[0]['total_comments'] ?> Comments</small>
                                </div>
                            </div>
                            <div id="comentbox" class=" my-3 py-1">
                                <!-- Like and Conmments section START -->
                                <div class="comment_container">
                                    <h4 class='my-3 font-weight-400'><small>Reader's Comments</small></h4>

                                    <!--<div class="row">
                                        <div class="col pt-2 comment-box-holder input-group">
                                            <textarea class="cust-textarea comment-text form-control" placeholder="Add a Comment"></textarea>
                                            <div class="input-group-append" id="button-addon4">
                                                <a href="#" class="post-comment" data-id="<?= $did ?>">
                                                    <span class="d-block sendicon" aria-hidden="true"><svg  viewBox="0 0 20 20">
                                                        <path fill="rgb(255, 255, 255)" d="M0.000,18.000 L22.000,9.000 L0.000,0.000 L0.000,7.000 L15.714,9.000 L0.000,11.000 L0.000,18.000 Z"/>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>

                                        <p class="error comment-error mb-0 ml-1 col-12 text-right" style="font-size: 14px;color: red;"></p>
                                    </div>-->
                                    <div class="row comment-box-holder">
                                        <div class="col-11 pr-0" >
                                            <textarea class="cust-textarea comment-text form-control" placeholder="Add a Comment" id="user-textarea"  rows="1"></textarea>
                                        </div>
                                        <div class="col-1 pl-0" >
                                            <div class="input-group-append position-absolute" id="button-addon4" style="bottom: 0;">
                                                <a href="#" class="post-comment" data-id="<?= $did ?>">
                                                    <span class="d-block sendicon" aria-hidden="true"><svg viewBox="0 0 20 20">
                                                        <path fill="rgb(255, 255, 255)" d="M0.000,18.000 L22.000,9.000 L0.000,0.000 L0.000,7.000 L15.714,9.000 L0.000,11.000 L0.000,18.000 Z"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <p class="error comment-error mb-0 ml-1 col-12 text-right" style="font-size: 14px;color: red;"></p>
                                    </div>
                                    <div class="comments-list mt-3">
                                        <?php
                                        foreach ($data[0]['comments'] as $comments):
                                            $users_alias = $comments['alias'];
                                            $comment_id = $comments['comment_id'];
                                            $total_replies = $comments['total_replies'];
                                            ?>
                                            <div class="row comment mb-3 comment_num_<?= $comment_id ?>">
                                                <div class=' col-md-1 col-2 p-2  d-flex'>
                                                    <div class='userimg position-relative' data-line='<?= $users_alias[0] ?>'></div>
                                                </div>
                                                <div class="col-10 col-md-11 pt-0 comment-text-holder">
                                                    <h6 class="font-weight-bold mb-2 pt-2 text-capitalize"><?= $users_alias ?></h6>
                                                    <p class="maincolor p-comment mb-2 font-weight-300"><?= $comments['comment'] ?></p>
                                                    <div class="edit_comment_box_holder d-none input-group">
                                                        <textarea class="cust-textarea edit-comment-text form-control" placeholder="Write Comment Here"><?= $comments['comment'] ?></textarea>

                                                        <div class="input-group-append" id="button-addon4">
                                                            <a href="#" class="post-edit-comment" data-id="<?= $did ?>" data-comment_id="<?= $comment_id ?>">
                                                                <span class="d-block sendicon" aria-hidden="true"><svg  viewBox="0 0 20 20">
                                                                    <path fill="rgb(255, 255, 255)" d="M0.000,18.000 L22.000,9.000 L0.000,0.000 L0.000,7.000 L15.714,9.000 L0.000,11.000 L0.000,18.000 Z"/>
                                                                    </svg>

                                                                </span>
                                                            </a>
                                                        </div>
                                                        <p class="error edit-comment-error mb-0 ml-1" style="font-size: 14px;color: red;"></p>
                                                    </div>
                                                    <div class="d-flex justify-content-space">
                                                        <p class="m-0 comment-action mr-auto">
                                                            <a href="#" class="show-hide-reply" data-id="<?= $did ?>" data-comment_id="<?= $comment_id ?>"><small>Reply</small></a><?php
                                                            if ($comments['user_id'] == $uid) {
                                                                ?><span>&nbsp;&nbsp;&#9679;&nbsp;&nbsp;</span><a href="#" class="edit-comment" data-id="<?= $did ?>" data-comment_id="<?= $comment_id ?>"><small>Edit</small></a><span>&nbsp;&nbsp;&#9679;&nbsp;&nbsp;</span><a href="#" class="comment-delete" data-id="<?= $did ?>" data-comment_id="<?= $comment_id ?>"><small>Delete</small></a>

                                                                <?php
                                                            }
                                                            ?>
                                                        </p>

                                                        <p class="m-0 comment-action ml-auto">

                                                            <small class="text-black-50"><?= $total_replies ?> Replies</small>

                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-10 col-md-11 offset-2 offset-md-1 mb-3 d-none reply-container_<?= $comment_id ?>">
                                                    <div class="row">

                                                        <div class="col pt-2 comment-reply-box-holder input-group">
                                                            <textarea class="cust-textarea comment-reply-text form-control" placeholder="Write Reply"></textarea>
                                                            <div class="input-group-append" id="button-addon4">
                                                                <a href="#" class="post-comment-reply"  data-comment_id="<?= $comment_id ?>" data-id="<?= $did ?>"><span class="d-block sendicon" aria-hidden="true"><svg viewBox="0 0 20 20">
                                                                        <path fill="rgb(255, 255, 255)" d="M0.000,18.000 L22.000,9.000 L0.000,0.000 L0.000,7.000 L15.714,9.000 L0.000,11.000 L0.000,18.000 Z"/>
                                                                        </svg></span></a>
                                                            </div>
                                                            <p class="error comment-error mb-0 ml-1" style="font-size: 14px;color: red;"></p>
                                                        </div>


                                                    </div>
                                                    <div class="comment-reply-list">

                                                    </div>

                                                </div>
                                            </div>
                                            <?php
                                        endforeach;
                                        ?>
                                    </div>
                                    <?php
                                    if ($data[0]['more_comments'] == "1") {
                                        ?>
                                        <div class="row">
                                            <div class="col-12 pt-1 text-right">
                                                <a href="#" class="a-nostyle view-more-comments" data-id="<?= $did ?>" data-offset="<?= count($data[0]['comments']) ?>"><small>View more comments</small></a>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <!-- ./ Like and Conmments section END -->
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>

            </div>
            <div class="blog-list-section bg-w-block py-4 d-block mt-3 h-list-detail">
                <div class="row mx-3 my-2">
                    <div class="col-md-4"><h4>Trending <b>Discussions</b></h4></div>
                    <div class="col-md-8"><hr></div>
                    <div class="col ">
                        <div class="wall-list row h-list">

                        </div>
                    </div>
                </div>
            </div>
            <div class="blog-list-section bg-w-block py-4 d-block mt-3 h-list-detail">
                <div class="row mx-3 my-2">
                    <div class="col-md-4"><h4>Trending <b>Predictions</b></h4></div>
                    <div class="col-md-8"><hr></div>
                    <div class="col ">
                        <div class="predictions-list row h-list">

                        </div>
                    </div>
                </div>
            </div>
            <div class="blog-list-section bg-w-block py-4 d-block mt-3 h-list-detail">
                <div class='row mx-3 my-2'>
                    <div class="col-md-4"><h4>Trending <b>Questions</b></h4></div>
                    <div class="col-md-8"><hr /></div>
                    <div class="col ">
                        <div class='questions-list row h-list'></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-md-0 py-4 flex-fill d-flex flex-column">

            <div class="bg-w-block p-3 col mb-3 h-50 overflow-hidden-x">
                <h4 class="d-block text-center">Your <b>Voice</b></h4>
                <div class="voice-list article-list row px-3">

                </div>
                <div class="col load-btn-holder mt-4 text-center">
                    <a href="#" class="btn btn-outline-primary readmore rounded-btn load-more z-depth-2">Read more</a>

                </div>
            </div>

            <div class="bg-w-block p-3 col h-50 overflow-hidden-x">
                <h4 class="d-block text-center">Rated <b>Article</b></h4>
                <div class="article-list rated-list row  px-3">

                </div>
                <div class="col load-btn-holder mt-4 text-center">
                    <a href="#" class="btn btn-outline-primary readmore rounded-btn load-more z-depth-2">Read more</a>

                </div>
            </div>
        </div>


    </div>

</div>

<!-- Delete Voice Modal -->
<div class="modal fade" id="cnfDeleteModal" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="display: block;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Discussion Topic</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="del_id" id="del_id" value="" />
                <p>Are you sure want to delete this Discussion Topic?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_delete_yes" class="btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing...">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="silverPointsCheck" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="display: block;border-bottom:none;">
                <h5 class="modal-title text-center">Raise Your Voice</h5>
            </div>
            <div class="modal-body text-center">
                <p>You will require minimum 25 Silver Points to start a discussion.</p>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" id="create_no" class="btn btn-secondary rounded-semi" data-dismiss="modal">No</button>
                <button type="button" id="create_yes" class="btn btn-primary rounded-semi">Yes</button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="earnedpoints" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body text-center">
                <svg class="img-fluid w-50 my-4"  id="object" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"      viewBox="0 0 497.1 477.7">
                <style type="text/css">
                    .st0{fill:url(#SVGID_1_);}
                    .st1{fill:url(#SVGID_2_);}
                    .st2{opacity:0.4;fill:#FFFFFF;enable-background:new    ;}
                    .st3{fill:url(#SVGID_3_);}
                    .st4{fill:url(#SVGID_4_);}
                    .st5{fill:url(#SVGID_5_);}
                    .st6{fill:url(#SVGID_6_);}
                    .st7{opacity:0.6;fill:url(#SVGID_7_);enable-background:new    ;}
                    .st8{opacity:0.3;fill:url(#SVGID_8_);enable-background:new    ;}
                    .st9{fill:#878788;}
                    .st10{fill:#868687;}
                    .st11{fill:#8A8A8B;}
                    .st12{fill:#8B8B8C;}
                    .st13{fill:#929293;}
                    .st14{fill:#8E8E8F;}
                    .st15{fill:#F7F7F7;}
                    .st16{fill:#F6F6F6;}
                    .st17{opacity:0.6;fill:url(#SVGID_9_);enable-background:new    ;}
                    .st18{fill:#423539;}
                    .st19{opacity:5.000000e-02;}
                    .st20{fill:#FFFFFF;}
                    .st21{fill:#362B2F;}
                    .st22{fill:#4D3E43;}
                    .st23{fill:#FFCC05;}
                    .st24{opacity:0.5;}
                </style>

                <g class="coin" >
                <g transform="translate(0 -200)">
                <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="254.6521" y1="180.178" x2="413.3863" y2="271.8231" gradientTransform="matrix(0.9646 0.2639 0.2639 -0.9646 -158.751 221.5041)">
                <stop  offset="1.000000e-02" style="stop-color:#6D6F70"/>
                <stop  offset="0.14" style="stop-color:#949697"/>
                <stop  offset="0.27" style="stop-color:#B4B6B7"/>
                <stop  offset="0.38" style="stop-color:#C8CACB"/>
                <stop  offset="0.46" style="stop-color:#CFD1D2"/>
                <stop  offset="0.58" style="stop-color:#CBCDCE"/>
                <stop  offset="0.7" style="stop-color:#C0C2C3"/>
                <stop  offset="0.82" style="stop-color:#ADAEB0"/>
                <stop  offset="0.93" style="stop-color:#939496"/>
                <stop  offset="1" style="stop-color:#808083"/>
                </linearGradient>
                <circle class="st0" cx="223.1" cy="91.7" r="91.6"/>
                <linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="289.3964" y1="148.697" x2="378.6434" y2="303.2843" gradientTransform="matrix(0.9646 0.2639 0.2639 -0.9646 -158.7425 221.5123)">
                <stop  offset="0" style="stop-color:#919395"/>
                <stop  offset="1.000000e-02" style="stop-color:#949698"/>
                <stop  offset="0.1" style="stop-color:#B4B6B8"/>
                <stop  offset="0.17" style="stop-color:#C8CACB"/>
                <stop  offset="0.22" style="stop-color:#CFD1D2"/>
                <stop  offset="0.23" style="stop-color:#D2D4D5"/>
                <stop  offset="0.27" style="stop-color:#E6E7E8"/>
                <stop  offset="0.31" style="stop-color:#F4F5F5"/>
                <stop  offset="0.37" style="stop-color:#FCFDFD"/>
                <stop  offset="0.46" style="stop-color:#FFFFFF"/>
                <stop  offset="0.57" style="stop-color:#FCFCFC"/>
                <stop  offset="0.65" style="stop-color:#F2F2F3"/>
                <stop  offset="0.73" style="stop-color:#E1E2E3"/>
                <stop  offset="0.79" style="stop-color:#CFD1D2"/>
                <stop  offset="0.84" style="stop-color:#CACCCD"/>
                <stop  offset="0.9" style="stop-color:#BCBEC0"/>
                <stop  offset="0.96" style="stop-color:#A6A8A9"/>
                <stop  offset="1" style="stop-color:#919395"/>
                </linearGradient>
                <circle class="st1" cx="223.1" cy="91.7" r="89.2"/>
                <path class="st2" d="M236.6,42.2c40.5,11.1,67.8,48.9,65.6,90.8c22.8-43.7,5.8-97.6-38-120.4s-97.6-5.8-120.4,38
                      c-5.9,11.3-9.3,23.7-10,36.4C153.3,49.8,196.1,31.1,236.6,42.2z"/>
                <linearGradient id="SVGID_3_" gradientUnits="userSpaceOnUse" x1="267.399" y1="187.5528" x2="400.6728" y2="264.4934" gradientTransform="matrix(0.9646 0.2639 0.2639 -0.9646 -158.7925 221.5006)">
                <stop  offset="0" style="stop-color:#919395"/>
                <stop  offset="0.1" style="stop-color:#AAACAD"/>
                <stop  offset="0.25" style="stop-color:#CACCCC"/>
                <stop  offset="0.38" style="stop-color:#DEDFDF"/>
                <stop  offset="0.46" style="stop-color:#E5E6E6"/>
                <stop  offset="0.6" style="stop-color:#E1E2E2"/>
                <stop  offset="0.73" style="stop-color:#D6D7D7"/>
                <stop  offset="0.87" style="stop-color:#C2C3C5"/>
                <stop  offset="0.99" style="stop-color:#A8A9AC"/>
                <stop  offset="1" style="stop-color:#A6A7AA"/>
                </linearGradient>
                <circle class="st3" cx="223" cy="91.6" r="76.9"/>
                <linearGradient id="SVGID_4_" gradientUnits="userSpaceOnUse" x1="296.2368" y1="160.5501" x2="371.8145" y2="291.4659" gradientTransform="matrix(0.9646 0.2639 0.2639 -0.9646 -158.7631 221.5155)">
                <stop  offset="0" style="stop-color:#BDBFC1"/>
                <stop  offset="4.000000e-02" style="stop-color:#C4C6C8"/>
                <stop  offset="0.21" style="stop-color:#E4E5E6"/>
                <stop  offset="0.36" style="stop-color:#F8F8F8"/>
                <stop  offset="0.46" style="stop-color:#FFFFFF"/>
                <stop  offset="0.6" style="stop-color:#FBFBFB"/>
                <stop  offset="0.72" style="stop-color:#F0F0F1"/>
                <stop  offset="0.85" style="stop-color:#DCDDDE"/>
                <stop  offset="0.97" style="stop-color:#C2C3C5"/>
                <stop  offset="1" style="stop-color:#BABCBE"/>
                </linearGradient>
                <circle class="st4" cx="223.1" cy="91.7" r="75.6"/>
                <linearGradient id="SVGID_5_" gradientUnits="userSpaceOnUse" x1="261.1772" y1="226.0144" x2="406.8723" y2="226.0144" gradientTransform="matrix(0.9646 0.2639 0.2639 -0.9646 -158.7695 221.5151)">
                <stop  offset="0" style="stop-color:#919395"/>
                <stop  offset="0.1" style="stop-color:#AAACAD"/>
                <stop  offset="0.25" style="stop-color:#CACCCC"/>
                <stop  offset="0.38" style="stop-color:#DEDFDF"/>
                <stop  offset="0.46" style="stop-color:#E5E6E6"/>
                <stop  offset="0.6" style="stop-color:#E1E2E2"/>
                <stop  offset="0.73" style="stop-color:#D6D7D7"/>
                <stop  offset="0.87" style="stop-color:#C2C3C5"/>
                <stop  offset="0.99" style="stop-color:#A8A9AC"/>
                <stop  offset="1" style="stop-color:#A6A7AA"/>
                </linearGradient>
                <circle class="st5" cx="223.1" cy="91.7" r="72.8"/>
                <linearGradient id="SVGID_6_" gradientUnits="userSpaceOnUse" x1="299.8768" y1="163.2337" x2="371.4268" y2="287.1636" gradientTransform="matrix(0.96 0.26 0.26 -0.96 -156.82 219.7)">
                <stop  offset="0" style="stop-color:#A6A7AA"/>
                <stop  offset="0.31" style="stop-color:#E5E5E6"/>
                <stop  offset="0.46" style="stop-color:#FFFFFF"/>
                <stop  offset="0.56" style="stop-color:#F9F9F9"/>
                <stop  offset="0.69" style="stop-color:#E7E7E8"/>
                <stop  offset="0.85" style="stop-color:#CACACC"/>
                <stop  offset="1" style="stop-color:#A6A7AA"/>
                </linearGradient>
                <path class="st6" d="M292.1,110.6c-10.4,38.1-49.8,60.5-87.9,50.1s-60.5-49.8-50.1-87.9c10.4-38.1,49.8-60.5,87.9-50.1
                      C280.1,33.1,302.5,72.4,292.1,110.6C292.1,110.5,292.1,110.5,292.1,110.6z"/>
                <linearGradient id="SVGID_7_" gradientUnits="userSpaceOnUse" x1="362.0142" y1="160.9297" x2="362.0142" y2="234.8097" gradientTransform="matrix(0.96 0.26 0.26 -0.96 -156.82 219.7)">
                <stop  offset="0" style="stop-color:#FFFFFF;stop-opacity:0"/>
                <stop  offset="0" style="stop-color:#FFFFFF;stop-opacity:1.000000e-02"/>
                <stop  offset="3.000000e-02" style="stop-color:#FFFFFF;stop-opacity:0.2"/>
                <stop  offset="5.000000e-02" style="stop-color:#FFFFFF;stop-opacity:0.37"/>
                <stop  offset="8.000000e-02" style="stop-color:#FFFFFF;stop-opacity:0.52"/>
                <stop  offset="0.11" style="stop-color:#FFFFFF;stop-opacity:0.65"/>
                <stop  offset="0.14" style="stop-color:#FFFFFF;stop-opacity:0.76"/>
                <stop  offset="0.18" style="stop-color:#FFFFFF;stop-opacity:0.85"/>
                <stop  offset="0.22" style="stop-color:#FFFFFF;stop-opacity:0.92"/>
                <stop  offset="0.27" style="stop-color:#FFFFFF;stop-opacity:0.96"/>
                <stop  offset="0.34" style="stop-color:#FFFFFF;stop-opacity:0.99"/>
                <stop  offset="0.52" style="stop-color:#FFFFFF"/>
                <stop  offset="0.7" style="stop-color:#FFFFFF;stop-opacity:0.99"/>
                <stop  offset="0.76" style="stop-color:#FFFFFF;stop-opacity:0.97"/>
                <stop  offset="0.81" style="stop-color:#FFFFFF;stop-opacity:0.92"/>
                <stop  offset="0.85" style="stop-color:#FFFFFF;stop-opacity:0.85"/>
                <stop  offset="0.88" style="stop-color:#FFFFFF;stop-opacity:0.77"/>
                <stop  offset="0.91" style="stop-color:#FFFFFF;stop-opacity:0.66"/>
                <stop  offset="0.93" style="stop-color:#FFFFFF;stop-opacity:0.53"/>
                <stop  offset="0.96" style="stop-color:#FFFFFF;stop-opacity:0.39"/>
                <stop  offset="0.98" style="stop-color:#FFFFFF;stop-opacity:0.22"/>
                <stop  offset="1" style="stop-color:#FFFFFF;stop-opacity:4.000000e-02"/>
                <stop  offset="1" style="stop-color:#FFFFFF;stop-opacity:0"/>
                </linearGradient>
                <path class="st7" d="M192.5,149.7c-0.7-0.3,67,23.3,91-44.1c2.8-0.8,5.3-2.3,7.5-4.3C290.9,101.4,269.3,184.1,192.5,149.7z"/>
                <linearGradient id="SVGID_8_" gradientUnits="userSpaceOnUse" x1="390.0625" y1="237.8774" x2="400.7125" y2="256.3274" gradientTransform="matrix(0.96 0.26 0.26 -0.96 -156.82 219.7)">
                <stop  offset="0" style="stop-color:#FFFFFF;stop-opacity:0"/>
                <stop  offset="0" style="stop-color:#FFFFFF;stop-opacity:1.000000e-02"/>
                <stop  offset="3.000000e-02" style="stop-color:#FFFFFF;stop-opacity:0.2"/>
                <stop  offset="5.000000e-02" style="stop-color:#FFFFFF;stop-opacity:0.37"/>
                <stop  offset="8.000000e-02" style="stop-color:#FFFFFF;stop-opacity:0.52"/>
                <stop  offset="0.11" style="stop-color:#FFFFFF;stop-opacity:0.65"/>
                <stop  offset="0.14" style="stop-color:#FFFFFF;stop-opacity:0.76"/>
                <stop  offset="0.18" style="stop-color:#FFFFFF;stop-opacity:0.85"/>
                <stop  offset="0.22" style="stop-color:#FFFFFF;stop-opacity:0.92"/>
                <stop  offset="0.27" style="stop-color:#FFFFFF;stop-opacity:0.96"/>
                <stop  offset="0.34" style="stop-color:#FFFFFF;stop-opacity:0.99"/>
                <stop  offset="0.52" style="stop-color:#FFFFFF"/>
                <stop  offset="0.7" style="stop-color:#FFFFFF;stop-opacity:0.99"/>
                <stop  offset="0.76" style="stop-color:#FFFFFF;stop-opacity:0.97"/>
                <stop  offset="0.81" style="stop-color:#FFFFFF;stop-opacity:0.92"/>
                <stop  offset="0.85" style="stop-color:#FFFFFF;stop-opacity:0.85"/>
                <stop  offset="0.88" style="stop-color:#FFFFFF;stop-opacity:0.77"/>
                <stop  offset="0.91" style="stop-color:#FFFFFF;stop-opacity:0.66"/>
                <stop  offset="0.93" style="stop-color:#FFFFFF;stop-opacity:0.53"/>
                <stop  offset="0.96" style="stop-color:#FFFFFF;stop-opacity:0.39"/>
                <stop  offset="0.98" style="stop-color:#FFFFFF;stop-opacity:0.22"/>
                <stop  offset="1" style="stop-color:#FFFFFF;stop-opacity:4.000000e-02"/>
                <stop  offset="1" style="stop-color:#FFFFFF;stop-opacity:0"/>
                </linearGradient>

                <path class="st8" d="M285.1,100.1l6-3.9c0,0,3.6-14.1-4.7-25.1C286.4,71,290.7,90.9,285.1,100.1z"/>
                <g>
                <path class="st9" d="M223.6,126c-2.7-1.4-5.4-2.8-8.1-4.2c-3.8-2-8-1.7-12.1-2.1c-1.2-0.1-2.5-0.1-3.7-0.3c-0.4,0-0.8-0.3-1.5-0.5
                      c0.9-0.7,1.5-1.2,2.2-1.6c1.8-1.2,3.6-2.5,5.5-3.6c1.2-0.7,1.3-1.5,0.5-2.6c-0.6-0.8-1-1.6-1.7-2.3c-0.5-0.5-1.2-1-1.9-1.1
                      c-3.5-0.4-6.9-0.7-10.4-1.1c-0.4,0-0.8-0.4-1.2-0.6c0.3-0.4,0.5-0.9,0.9-1.1c4.9-3.1,9.9-6.1,14.9-9.2c1-0.6,1.8-0.6,2.4,0.7
                      c1.7,3.3,3.6,6.5,5.4,9.8c1,1.7,1.4,1.8,3.1,0.8c3.1-1.8,6.2-3.7,9.2-5.5c1.1-0.7,1.8-0.5,2.5,0.6c2.9,5,5.8,9.9,8.7,14.8
                      c0.1,0.2,0.2,0.4,0.2,0.5c0.1,0.5,0.1,0.9,0.1,1.4c-0.4-0.1-0.9,0-1.2-0.2c-3.3-1.4-6.6-2.8-9.9-4.2c-1.1-0.5-2-0.4-3.1,0.2
                      c-3.5,2-3.5,2-1.6,5.6c0.8,1.6,1.7,3.1,2.6,4.7c0.3,0.6,0.6,1.2-0.3,1.5C224.4,126.2,224,126.1,223.6,126z"/>
                <path class="st10" d="M243,59.3c-1.2-0.7-1.9-1.2-2.6-1.7c-2.4-1.8-5.1-2.4-8.1-1.9c-1.4,0.2-3.4-0.3-4.4-1.3
                      c-2.4-2.3-5-2.9-8.1-2.4c-1,0.1-2,0.2-3.1,0.4c1.4,1,0.9,2.2,0.7,3.4c-0.4,3.6,1.4,5.6,5.9,6.5c0,5.6,0,11.2,0.1,17.3
                      c3.2-5.1,6.1-9.8,9.2-14.6c0.6,0.2,1.3,0.5,1.9,0.7c3,0.7,5.2-0.7,6.5-3.7c0.4-0.9,0.4-2.4,2.3-2c0.2,2.8,0.3,5.7,0.5,8.6
                      c0.2,2.3,0.4,4.7,0.8,7c0.5,3.4,0,4.6-3,6.4c-6.5,3.8-13,7.7-19.6,11.5c-2,1.2-3.2,0.8-4.3-1.1c-2.6-4.4-5.1-8.8-7.7-13.2
                      c-1.3-2.3-2.6-4.7-3.9-7c-1-1.9-0.7-3.8,0.4-5.4c3.9-5.9,8-11.6,12-17.4c0.6-0.9,1.5-1.7,2.2-2.6c2.2-2.4,5.1-2.6,8-2.4
                      c3.7,0.2,7.1,1.5,10.1,3.7c2.3,1.7,3.8,3.9,3.9,6.9C242.6,56.2,242.8,57.5,243,59.3z"/>
                <path class="st11" d="M227.6,56.9c-1.4,3.7-4.4,5.1-7.3,3.4c-1.8-1.1-2.6-4.6-1.4-6.3c0.3-0.4,0.9-0.8,1.5-0.9
                      c2.2-0.4,4.3,0.1,6,1.5C227,55.2,227.2,56.2,227.6,56.9z M221.5,53.8c-1.8,1.4-2,3.1-1,4.3c1,1.2,2.9,1.2,4.5-0.1
                      c-0.6-0.2-1.1-0.4-1.5-0.4c-1.9,0.1-2.7-0.8-2-2.6C221.6,54.6,221.5,54.2,221.5,53.8z"/>
                <path class="st11" d="M231.3,58c0.6-0.4,1.2-1.2,1.9-1.2c1.4-0.1,2.8,0,4.1,0.4c2.3,0.7,3.2,1.9,2.9,3.2c-0.5,2.4-2.4,4.2-4.4,4.2
                      c-2.2,0-3.9-1.2-4.3-3.2C231.3,60.5,231.4,59.4,231.3,58z M232.8,60.4c1.3,2.3,3.2,3,4.6,2c1.4-0.9,1.7-2.7,0.6-4
                      c-0.2,0.4-0.5,0.8-0.6,1.2c-0.5,1.8-1.3,2.1-2.9,1.1C234.2,60.4,233.6,60.5,232.8,60.4z"/>
                <path class="st12" d="M228.5,58.5c0-0.6,0.1-1.2,0.1-2c0.7,0.1,1.3,0.3,2,0.4c-0.4,0.8-0.6,1.4-0.9,2
                      C229.4,58.7,229,58.6,228.5,58.5z"/>
                <path class="st13" d="M225.4,64.6c-0.3-0.6-0.7-1.3-0.9-1.9c0,0,0.5-0.3,0.7-0.5c0.3,0.7,0.6,1.4,0.9,2
                      C225.9,64.4,225.7,64.5,225.4,64.6z"/>
                <path class="st14" d="M228.5,64.8c0.5-0.4,1-0.8,1.6-1.1c0.1,0,0.4,0.4,0.6,0.6c-0.6,0.4-1.2,0.7-1.8,1.1
                      C228.8,65.2,228.6,65,228.5,64.8z"/>
                <path class="st15" d="M221.5,53.8c0,0.4,0.1,0.8-0.1,1.2c-0.7,1.7,0.1,2.7,2,2.6c0.4,0,0.9,0.2,1.5,0.4c-1.6,1.4-3.4,1.3-4.5,0.1
                      C219.4,56.9,219.6,55.2,221.5,53.8z"/>
                <path class="st16" d="M232.8,60.4c0.8,0.1,1.3,0,1.7,0.3c1.6,1,2.4,0.7,2.9-1.1c0.1-0.4,0.3-0.7,0.6-1.2c1.1,1.3,0.7,3.1-0.6,4
                      C236,63.3,234.2,62.7,232.8,60.4z"/>
                </g>
                <linearGradient id="SVGID_9_" gradientUnits="userSpaceOnUse" x1="111.6329" y1="217.4379" x2="111.6329" y2="291.3172" gradientTransform="matrix(-0.9795 -0.2016 -0.2016 0.9795 361.9924 -170.1793)">
                <stop  offset="0" style="stop-color:#FFFFFF;stop-opacity:0"/>
                <stop  offset="0" style="stop-color:#FFFFFF;stop-opacity:1.000000e-02"/>
                <stop  offset="3.000000e-02" style="stop-color:#FFFFFF;stop-opacity:0.2"/>
                <stop  offset="5.000000e-02" style="stop-color:#FFFFFF;stop-opacity:0.37"/>
                <stop  offset="8.000000e-02" style="stop-color:#FFFFFF;stop-opacity:0.52"/>
                <stop  offset="0.11" style="stop-color:#FFFFFF;stop-opacity:0.65"/>
                <stop  offset="0.14" style="stop-color:#FFFFFF;stop-opacity:0.76"/>
                <stop  offset="0.18" style="stop-color:#FFFFFF;stop-opacity:0.85"/>
                <stop  offset="0.22" style="stop-color:#FFFFFF;stop-opacity:0.92"/>
                <stop  offset="0.27" style="stop-color:#FFFFFF;stop-opacity:0.96"/>
                <stop  offset="0.34" style="stop-color:#FFFFFF;stop-opacity:0.99"/>
                <stop  offset="0.52" style="stop-color:#FFFFFF"/>
                <stop  offset="0.7" style="stop-color:#FFFFFF;stop-opacity:0.99"/>
                <stop  offset="0.76" style="stop-color:#FFFFFF;stop-opacity:0.97"/>
                <stop  offset="0.81" style="stop-color:#FFFFFF;stop-opacity:0.92"/>
                <stop  offset="0.85" style="stop-color:#FFFFFF;stop-opacity:0.85"/>
                <stop  offset="0.88" style="stop-color:#FFFFFF;stop-opacity:0.77"/>
                <stop  offset="0.91" style="stop-color:#FFFFFF;stop-opacity:0.66"/>
                <stop  offset="0.93" style="stop-color:#FFFFFF;stop-opacity:0.53"/>
                <stop  offset="0.96" style="stop-color:#FFFFFF;stop-opacity:0.39"/>
                <stop  offset="0.98" style="stop-color:#FFFFFF;stop-opacity:0.22"/>
                <stop  offset="1" style="stop-color:#FFFFFF;stop-opacity:4.000000e-02"/>
                <stop  offset="1" style="stop-color:#FFFFFF;stop-opacity:0"/>
                </linearGradient>

                <path class="st17" d="M248.8,29.9c0.7,0.3-68.4-19-87.9,49.8c-2.7,1-5.2,2.6-7.2,4.7C153.7,84.4,169.9,0.5,248.8,29.9z"/>
                </g></g>

                <g class="wallet">
                <path class="st18" d="M37.2,120.9h389c20.5,0,37.2,16.6,37.2,37.2v282.4c0,20.5-16.6,37.2-37.2,37.2h-389
                      C16.6,477.7,0,461.1,0,440.6V158.1C0,137.6,16.6,120.9,37.2,120.9z"/>
                <g class="st19">
                <path class="st20" d="M0,158.1c0-22.8,19.4-37.2,35.2-37.2l391,0.1c20.5,0.1,37.1,16.7,37.2,37.2v4H0V158.1z"/>
                <path class="st20" d="M463.3,435.1v5.5c-0.1,20.5-16.7,37.1-37.2,37.2h-389C16.6,477.7,0,461.1,0,440.6v-5.5H463.3z"/>
                </g>
                <path class="st21" d="M463.3,317.5H298.1v-44.1c0-18.7,15.2-33.9,33.9-33.9h131.3V317.5z"/>
                <path class="st22" d="M327.2,249.2h140.4c16.3,0,29.5,13.2,29.5,29.5v38.4c0,16.3-13.2,29.5-29.5,29.5H327.2
                      c-16.3,0-29.5-13.2-29.5-29.5v-38.4C297.6,262.4,310.8,249.2,327.2,249.2z"/>
                <ellipse transform="matrix(0.1719 -0.9851 0.9851 0.1719 3.7168 597.8129)" class="st23" cx="357.4" cy="296.7" rx="35.5" ry="35.5"/>
                <g class="st24">
                <path class="st20" d="M127.1,159.5c0.3-0.3,0.7-0.4,1.1-0.4h16c0.8,0,1.5,0.7,1.5,1.5c0,0.8-0.7,1.5-1.5,1.5h-16
                      c-0.8,0-1.5-0.7-1.5-1.5C126.6,160.2,126.7,159.7,127.1,159.5z"/>
                <path class="st20" d="M192.1,159.1h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S191.3,159.1,192.1,159.1
                      z"/>
                <path class="st20" d="M160.1,159.1h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S159.3,159.1,160.1,159.1
                      z"/>
                <path class="st20" d="M288.2,159.1h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S287.4,159.1,288.2,159.1
                      z"/>
                <path class="st20" d="M224.2,159.1h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S223.3,159.1,224.2,159.1
                      z"/>
                <path class="st20" d="M448.3,159.1h15.1v3h-15.1c-0.8,0-1.5-0.7-1.5-1.5S447.4,159.1,448.3,159.1z"/>
                <path class="st20" d="M416.3,159.1h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S415.5,159.1,416.3,159.1
                      z"/>
                <path class="st20" d="M320.2,159.1h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S319.4,159.1,320.2,159.1
                      z"/>
                <path class="st20" d="M384.3,159.1h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S383.5,159.1,384.3,159.1
                      L384.3,159.1z"/>
                <path class="st20" d="M352.3,159.1h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S351.4,159.1,352.3,159.1
                      z"/>
                <path class="st20" d="M256.2,159.1h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S255.4,159.1,256.2,159.1
                      z"/>
                <path class="st20" d="M64.1,159h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S63.2,159,64.1,159z"/>
                <path class="st20" d="M96.1,159h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5l0,0h-16c-0.8,0-1.5-0.7-1.5-1.5S95.3,159,96.1,159z"/>
                <path class="st20" d="M32,159h16c0.8,0,1.5,0.7,1.5,1.5S48.9,162,48,162H32c-0.8,0-1.5-0.7-1.5-1.5S31.2,159,32,159z"/>
                <path class="st20" d="M0,159h16c0.8,0,1.5,0.7,1.5,1.5S16.8,162,16,162H0L0,159z"/>
                </g>
                <g class="st24">
                <path class="st20" d="M127.2,434.4c0.3-0.3,0.7-0.4,1.1-0.4h16c0.8,0,1.5,0.7,1.5,1.5c0,0.8-0.7,1.5-1.5,1.5h-16
                      c-0.8,0-1.5-0.7-1.5-1.5C126.7,435.1,126.8,434.7,127.2,434.4z"/>
                <path class="st20" d="M192.2,434h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S191.4,434,192.2,434z"/>
                <path class="st20" d="M160.2,434h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S159.4,434,160.2,434z"/>
                <path class="st20" d="M288.3,434h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S287.5,434,288.3,434z"/>
                <path class="st20" d="M224.2,434h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S223.4,434,224.2,434z"/>
                <path class="st20" d="M448.4,434h15.1v3h-15.1c-0.8,0-1.5-0.7-1.5-1.5S447.5,434,448.4,434z"/>
                <path class="st20" d="M416.4,434h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S415.6,434,416.4,434z"/>
                <path class="st20" d="M320.3,434h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5l0,0h-16c-0.8,0-1.5-0.7-1.5-1.5S319.5,434,320.3,434
                      L320.3,434z"/>
                <path class="st20" d="M384.4,434h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S383.6,434,384.4,434
                      L384.4,434z"/>
                <path class="st20" d="M352.4,434h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S351.5,434,352.4,434z"/>
                <path class="st20" d="M256.3,434h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S255.4,434,256.3,434z"/>
                <path class="st20" d="M64.2,434h16c0.8,0,1.5,0.7,1.5,1.5S81,437,80.2,437h-16c-0.8,0-1.5-0.7-1.5-1.5S63.3,434,64.2,434z"/>
                <path class="st20" d="M96.2,434h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16c-0.8,0-1.5-0.7-1.5-1.5S95.4,434,96.2,434z"/>
                <path class="st20" d="M32.1,434h16c0.8,0,1.5,0.7,1.5,1.5S49,437,48.1,437h-16c-0.8,0-1.5-0.7-1.5-1.5S31.3,434,32.1,434z"/>
                <path class="st20" d="M0.1,434h16c0.8,0,1.5,0.7,1.5,1.5s-0.7,1.5-1.5,1.5h-16V434z"/>
                </g>
                </g>
                </svg>

                <p>You got <b>1</b> Trust point.</p>
            </div>
        </div>
    </div>
</div>


<script>
    var options = {toast: "<?= $this->session->flashdata('toast'); ?>"};
    var id = <?= $data[0]['id'] ?>;
    var uid = $("body").attr("data-uid");
    var relatedTopicIds = <?= json_encode($selectedTopicIds) ?>;
</script>
<script src="<?= base_url() ?>js/wall.js?v=1.48"></script>