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
<div class="container mb-5 data-container">
    <div class="row mt-3">
        <div class='col-md-9 voice-cont'>
            <div class="raise_voice_banner row align-items-center m-0">
                <div class="col-4">
                    <img class='img-fluid d-block mx-auto' src="<?= base_url("images/icons/blog_banner_2.png") ?>"/>
                </div>
                <div class="col-8">
                    <div class='row align-items-center'>

                        <div class="col-md-8">
                            <h4 class="text-white">Now create your own blog @ just <span>25 silver points</span></h4>
                        </div>
                        <div class="col-md-4 mt-2 mt-0-md">

                            <a class="btn btn-danger btn_create btn_create_voice rounded-btn" href="#">Create Now</a>
                        </div>
                    </div>
                </div>
            </div>      
            <div class="most-popular mb-3"></div>
            <div class="blog-list-section bg-w-block py-4 d-block">
                <?php
                if (empty($data)) {
                    ?>
                    <div class='row mx-3 my-2'>
                        <div class="col-12 position-relative"><h3 style="font-weight:300;max-width: 90%;">This requested URL is not found</h3></div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class='row mx-3 my-2'>
                        <?php
                        $share_url = urlencode(base_url() . ltrim($_SERVER['REQUEST_URI'], '/'));
                        $title = $data[0]['title'];
                        $voice_id = $data[0]['id'];
                        $is_user_liked = $data[0]['is_user_liked'];
                        $thumb_class = ($is_user_liked == 0) ? "fa-thumbs-o-up" : "fa-thumbs-up";

                        $selectedTopicIds = array();
                        if (!empty(@$data[0]['topic_associated'])) {
                            foreach (@$data[0]['topic_associated'] as $ta):
                                $selectedTopicIds[] = $ta['topic_id'];
                            endforeach;
                        }
                        ?>
                        <div class="col-12 position-relative">
                            <h1 style="font-weight:300;max-width: 85%;font-size: 1.75rem;"><?= $title ?></h1>

                            <?php
                            if ($data[0]['user_id'] === $uid) {
                                ?>
                                <h6 id="blogedit" class='comment-action float-right mr-3'>
                                    <a href="<?= base_url() ?>YourVoice/raise_voice/<?= $voice_id ?>" class="a-nostyle edit-voice" data-id="<?= $voice_id ?>"><small>
                                            EDIT</small>
                                    </a>
                                    <span>&nbsp;&nbsp;&#9679;&nbsp;&nbsp;</span>
                                    <a href="#" class="a-nostyle delete-voice" data-id="<?= $voice_id ?>" data-toggle="modal" data-target="#cnfDeleteVoiceModal"><small>DELETE</small>
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
                            <div class="row">
                                <div class="col">
                                    <div id="blog-content">
                                        <div class="text-center">
                                            <img src="<?= $data[0]['image'] ?>" class="img-fluid"/>
                                        </div>
                                        <div class="description-container">
                                            <div class="mt-3 data">
                                                <?= $data[0]['description'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="" id="bloglikecomment">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="a-nostyle voice-like mr-auto" data-is_user_liked="<?= $is_user_liked ?>" data-id="<?= $data[0]['id'] ?>">
                                        <span class="like-icon d-inline-block" style="width:20px">

                                            <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 25" fill='<?= $is_user_liked ? "#007bff" : "#7d7c8b" ?>'>
                                            <g>
                                            <path id="svg_1" d="m23.159,10.36l-0.543,0c1.017,0 1.841,0.794 1.841,1.774c0,0.979 -0.824,1.773 -1.841,1.773l-0.543,0c1.017,0 1.842,0.794 1.842,1.773c0,0.98 -0.825,1.773 -1.842,1.773l-0.542,0c1.017,0 1.841,0.794 1.841,1.773c0,0.98 -0.824,1.774 -1.841,1.774c0,0 -10.857,0 -11.941,0c-0.794,0 -1.37,-0.632 -2.154,-0.97l0,-10.52c0.147,0 0.314,0 0.507,0c1.581,0 1.655,-1.597 2.721,-2.975c1.273,-1.646 3.028,-2.514 3.028,-4.554c0,-1.094 0.92,-1.981 2.056,-1.981c1.136,0 2.057,0.887 2.057,1.981c0,3.12 -1.517,4.833 -1.517,4.833l6.871,0c1.017,0 1.841,0.794 1.841,1.773c0,0.979 -0.824,1.773 -1.841,1.773zm-23.159,-1.954l5.806,0l0,12.323l-5.806,0l0,-12.323zm2.903,10.469c0.45,0 0.815,-0.352 0.815,-0.785c0,-0.434 -0.365,-0.786 -0.815,-0.786c-0.45,0 -0.815,0.352 -0.815,0.786c0,0.433 0.365,0.785 0.815,0.785z" fill="" fill-rule="evenodd"/>
                                            </g>
                                            </svg></span>
                                        <small class="text-uppercase font-weight-bold <?= $is_user_liked ? "text-primary" : " text-black-50" ?>">Like</small>
                                    </a>
                                    <small class="likes ml-auto"><span class='total-likes-count'><?= $data[0]['total_likes'] ?></span> Likes &nbsp;&nbsp;&#x25cf;&nbsp;&nbsp; <?= @$data[0]['total_views'] ?> Views &nbsp;&nbsp;&#x25cf;&nbsp;&nbsp; <?= @$data[0]['total_comments'] ?> Comments</small>
                                </div>
                            </div>
                            <div id="comentbox" class=" my-3 py-1">
                                <!-- Like and Conmments section START -->
                                <div class="comment_container">
                                    <h4 class='my-3 font-weight-300'><small>Reader's Comments</small></h4>

                                    <!--                                    <div class="row">
                                                                            <div class="col pt-2 comment-box-holder input-group">
                                                                                <textarea class="cust-textarea comment-text form-control" placeholder="Add a Comment"></textarea>
                                                                                <div class="input-group-append" id="button-addon4">
                                                                                    <a href="#" class="post-comment" data-id="<?= $voice_id ?>">
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
                                        <div class="col-11 pr-0">
                                            <textarea class="cust-textarea comment-text form-control" placeholder="Add a Comment" id="user-textarea"  rows="1"></textarea>
                                        </div>
                                        <div class="col-1 pl-0" >
                                            <div class="input-group-append position-absolute" id="button-addon4" style="bottom: 0;">
                                                <a href="#" class="post-comment" data-id="<?= $voice_id ?>">
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
                                            $users_alias = $comments['alise'];
                                            $comment_id = $comments['id'];
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
                                                            <a href="#" class="post-edit-comment" data-id="<?= $voice_id ?>" data-comment_id="<?= $comment_id ?>">
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
                                                            <a href="#" class="show-hide-reply" data-id="<?= $voice_id ?>" data-comment_id="<?= $comment_id ?>"><small>Reply</small></a><?php
                                                            if ($comments['user_id'] == $uid) {
                                                                ?><span>&nbsp;&nbsp;&#9679;&nbsp;&nbsp;</span><a href="#" class="edit-comment" data-id="<?= $voice_id ?>" data-comment_id="<?= $comment_id ?>"><small>Edit</small></a><span>&nbsp;&nbsp;&#9679;&nbsp;&nbsp;</span><a href="#" class="comment-delete" data-id="<?= $voice_id ?>" data-comment_id="<?= $comment_id ?>"><small>Delete</small></a>

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
                                                                <a href="#" class="post-comment-reply"  data-comment_id="<?= $comment_id ?>" data-id="<?= $voice_id ?>"><span class="d-block sendicon" aria-hidden="true"><svg viewBox="0 0 20 20">
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
                                                <a href="#" class="a-nostyle view-more-comments" data-id="<?= $voice_id ?>" data-offset="<?= count($data[0]['comments']) ?>"><small>View more comments</small></a>
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
                <div class='row mx-3 my-2'>
                    <div class="col-md-4"><h4>Trending <b>Predictions</b></h4></div>
                    <div class="col-md-8"><hr /></div>
                    <div class="col ">
                        <div class='predictions-list row h-list'></div>
                    </div>
                </div>
            </div>

            <div class="blog-list-section bg-w-block py-4 d-block mt-3 h-list-detail">
                <div class='row mx-3 my-2'>
                    <div class="col-md-3"><h4>From the <b>Web</b></h4></div>
                    <div class="col-md-9"><hr /></div>
                    <div class="col ">
                        <div class='rated-list row h-list'></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-md-0 py-4 flex-md-fill d-md-flex flex-md-column">

            <div class="bg-w-block p-3 col mb-3  h-50 overflow-hidden-x">
                <h4 class="d-block text-center">Trending <b>Predictions</b></h4>
                <div class="article-list predictions-list row px-3">

                </div>
            </div>
            <div class="bg-w-block p-3 col mb-3   h-50 overflow-hidden-x">
                <h4 class="d-block text-center">Trending <b>Questions</b></h4>
                <div class="article-list questions-list">

                </div>
            </div>
        </div>


    </div>

</div>

<!-- Delete Voice Modal -->
<div class="modal fade" id="cnfDeleteVoiceModal" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="display: block;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Voice</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="del_voice_id" id="del_voice_id" value="" />
                <p>Are you sure want to delete this voice?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_delete_voice_yes" class="btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing...">Yes</button>
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
                <p>You will require minimum 25 Silver Points to raise a voice.</p>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" id="create_voice_no" class="btn btn-secondary rounded-btn" data-dismiss="modal">No</button>
                <button type="button" id="create_voice_yes" class="btn btn-primary rounded-btn">Yes</button>
            </div>

        </div>
    </div>
</div>
<script>
    var options = {toast: "<?= $this->session->flashdata('toast'); ?>"};
    var relatedTopicIds = <?= json_encode($selectedTopicIds) ?>;
</script>
<script src="<?= base_url() ?>js/yourvoice.js?v=1.59"></script>