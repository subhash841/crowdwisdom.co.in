<div class="container" id="mainblog">
    <div class="row mb6">
        <div class="col s12 m12 l12">
            <div class="card-panel raise_voice_banner">
                <img src="<?= base_url() ?>images/icons/blog_banner.png">
                <div class="banner-text" style="float: left;">Create Your Own Blog</div>
                <button class="btn btn-success btn_create">Create Now <img src="<?= base_url() ?>images/icons/megaphone.png" style="height: 28px;margin-left: 5px;vertical-align: middle;"></button>
            </div>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-md-9">
            <?php
            $share_url = urlencode( base_url() . ltrim( $_SERVER[ 'REQUEST_URI' ], '/' ) );
            $title = $data[ 0 ][ 'title' ];
            $voice_id = $data[ 0 ][ 'id' ];
            $is_user_liked = $data[ 0 ][ 'is_user_liked' ];
            $thumb_class = ($is_user_liked == 0) ? "fa-thumbs-o-up" : "fa-thumbs-up";
            ?>
            <h3 class="title"><?= $title ?></h3>
            <?php
            if ( $data[ 0 ][ 'user_id' ] == $uid ) {
                    ?>
                    <p id="blogedit">
                        <a href="<?= base_url() ?>YourVoice/raise_voice/<?= $voice_id ?>" class="a-nostyle edit-voice" data-id="<?= $voice_id ?>">
                            <i class="mr-1 fa fa-pencil-square-o" aria-hidden="true" ></i>
                        </a>
                        <a href="#" class="a-nostyle delete-voice" data-id="<?= $voice_id ?>" data-toggle="modal" data-target="#cnfDeleteVoiceModal">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    </p>
                    <?php
            }
            ?>
            <div class="d-flex justify-content-between mt-3 flex-md-row flex-column mb-2">
                <div class="mb-1">
                    <i id="blog-author">By- <?= $data[ 0 ][ 'alias' ] . " " . date( "F d, Y", strtotime( $data[ 0 ][ 'created_date' ] ) ) ?></i>
                </div>
                <div class="d-flex d-flex flex-row">
                    <a class="d-flex align-items-center bg-facebook text-white rounded cust-btn btn py-0 mx-1"
                       href="http://www.facebook.com/sharer/sharer.php?u=<?= $share_url ?>" target="_blank">
                        <i class="fa fa-facebook-official mr-2"></i>
                        <h6 class="mb-0">Share</h6>
                    </a>
                    <a class="d-flex align-items-center bg-twitter text-white rounded cust-btn btn py-0 mx-1" 
                       href="https://twitter.com/intent/tweet?url=<?= $share_url ?>&text='<?= urlencode( $title ) ?>'&ael;hashtags=Crowdwisdom" target="_blank">
                        <i class="fa fa-twitter mr-2"></i>
                        <h6 class="mb-0">Tweet</h6>
                    </a>
                    <a class="d-flex bg-linkdein align-items-center bg-twitter text-white rounded cust-btn btn py-0 mx-1"
                       href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $share_url ?>&title=<?= urlencode( $title ) ?>"  target="_blank">
                        <i class="fa fa-linkedin mr-2"></i>
                        <h6 class="mb-0">Share</h6>
                    </a>
                    <a class="d-flex bg-whatsapp align-items-center bg-twitter text-white rounded cust-btn btn py-0 mx-1"
                       href="https://wa.me/?text=<?= $share_url ?>"   target="_blank">
                        <i class="fa fa-whatsapp "></i>
                    </a>
                </div>
            </div>
            <div id="blog-content">
                <div class="text-center">
                    <img src="<?= $data[ 0 ][ 'image' ] ?>" class="img-fluid"/>
                </div>
                <div class="description-container">
                    <div class="mt-3 data">
                        <?= $data[ 0 ][ 'description' ] ?>
                    </div>

                </div>
            </div>
            <div class="d-flex " id="bloglikecomment">
                <div class="d-flex mr-4 align-items-center">
                    <i class="like-icon fa <?= $thumb_class ?> fa-2x iconcolor mr-2 "></i>
                    <a href="#" class="a-nostyle voice-like" data-is_user_liked="<?= $is_user_liked ?>" data-id="<?= $data[ 0 ][ 'id' ] ?>">
                        <p class="mb-0">Like</p>
                    </a>
                </div>
                <div class="d-flex align-items-center">
                    <i class="comment-icon fa fa-commenting-o fa-2x mr-2 iconcolor"></i><p class="mb-0">Comment</p>
                </div>
            </div>
            <div id="comentbox" class="rounded border my-3 py-1 cust-shadow">
                <div class="d-flex border-bottom pb-1 px-2" >
                    <div class="d-flex mr-4 align-items-center">
                        <i class="fa fa-thumbs-o-up mr-2"></i><p class="mb-0 total-likes-count"><?= $data[ 0 ][ 'total_likes' ] ?></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fa fa-commenting-o mr-2"></i><p class="mb-0 total-comments-count"><?= $data[ 0 ][ 'total_comments' ] ?></p>
                    </div>
                </div>
                <!-- Like and Conmments section START -->
                <div class="col-12 comment_container">
                    <div class="p-1">

                        <div class="row">
                            <div class="col-1 p-0 text-center pt-1">
                                <img src="<?= base_url() ?>images/other/profile.png" class="img-fluid  text-center">
                            </div>
                            <div class="col-11 pt-2 comment-box-holder">
                                <textarea class="cust-textarea comment-text" placeholder="Write Comment Here"></textarea>
                                <a href="#" class="post-comment" data-id="<?= $voice_id ?>"><i class="sendicon fa fa-chevron-right" aria-hidden="true"></i></a>
                                <p class="error comment-error mb-0 ml-1" style="font-size: 14px;color: red;"></p>
                            </div>
                        </div>
                        <div class="comments-list">
                            <?php
                            foreach ( $data[ 0 ][ 'comments' ] as $comments ):
                                    $users_alias = ($comments[ 'user_id' ] == $uid) ? "You" : $comments[ 'alise' ];
                                    $comment_id = $comments[ 'id' ];
                                    ?>
                                    <div class="row comment_num_<?= $comment_id ?>">
                                        <div class="col-11 offset-1 pt-0 comment-text-holder">
                                            <h6 class="font-weight-bold mb-0 pt-2"><?= $users_alias ?></h6>
                                            <p class="maincolor p-comment mb-0 font-weight-300"><?= $comments[ 'comment' ] ?></p>
                                            <div class="edit_comment_box_holder hide" style="display:none;">
                                                <textarea class="cust-textarea edit-comment-text" placeholder="Write Comment Here"><?= $comments[ 'comment' ] ?></textarea>
                                                <a href="#" class="post-edit-comment" data-id="<?= $voice_id ?>" data-comment_id="<?= $comment_id ?>"><i class="sendicon fa fa-chevron-right" aria-hidden="true"></i></a>
                                                <p class="error edit-comment-error mb-0 ml-1" style="font-size: 14px;color: red;"></p>
                                            </div>
                                            <div class="d-flex justify-content-space">
                                                <p class="mx-2">
                                                    <i class="fa fa-reply"></i>
                                                    <a href="#" class="a-nostyle show-hide-reply" data-id="<?= $voice_id ?>" data-comment_id="<?= $comment_id ?>"><small>reply</small></a>
                                                </p>
                                                <?php
                                                if ( $comments[ 'user_id' ] == $uid ) {
                                                        ?>
                                                        <p class="mx-2"><i class="fa fa-pencil-square-o"></i>
                                                            <a href="#" class="a-nostyle edit-comment" data-id="<?= $voice_id ?>" data-comment_id="<?= $comment_id ?>"><small>Edit</small></a>
                                                        </p>
                                                        <p class="mx-2"><i class="fa fa-trash-o"></i>
                                                            <a href="#" class="a-nostyle comment-delete" data-id="<?= $voice_id ?>" data-comment_id="<?= $comment_id ?>"><small>Delete</small></a>
                                                        </p>
                                                        <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-11 border offset-1 reply-container_<?= $comment_id ?>" style="display:none;">
                                            <div class="row">
                                                <div class="col-md-1 col-2 pr-0">
                                                    <img src="<?= base_url() ?>/images/other/profile.png" class="img-fluid text-center pt-2">
                                                </div>
                                                <div class="col-11 pt-2 comment-reply-box-holder">
                                                    <textarea class="cust-textarea comment-reply-text" placeholder="Write Reply Here"></textarea>
                                                    <a href="#" class="post-comment-reply" data-id="<?= $voice_id ?>" data-comment_id="<?= $comment_id ?>"><i class="sendicon fa fa-chevron-right" aria-hidden="true"></i></a>
                                                    <p class="error comment-reply-error mb-0 ml-1" style="font-size: 14px;color: red;"></p>
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
                        if ( $data[ 0 ][ 'more_comments' ] == "1" ) {
                                ?>
                                <div class="row">
                                    <div class="col-12 pt-1 text-right">
                                        <a href="#" class="a-nostyle view-more-comments" data-id="<?= $voice_id ?>" data-offset="<?= count( $data[ 0 ][ 'comments' ] ) ?>"><small>View more comments</small></a>
                                    </div>
                                </div>
                                <?php
                        }
                        ?>
                    </div>
                </div>
                <!-- ./ Like and Conmments section END -->
            </div>
            <h3 class="tag my-4 font-weight-bold pl-2 py-2 d-none d-lg-block d-xl-block d-md-block ">TRENDING</h3>
            <h5 class="tag d-inline-block my-4 font-weight-bold pl-2 py-2 d-sm-block d-md-none">TRENDING</h5>

            <div class="trending-article-list d-none d-lg-block d-xl-block d-md-block">

            </div>
            <div id="mobile_carousel" class=" d-sm-block d-md-none">
                <div id="carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

                    </div>
                </div>
            </div>
            <!--<div class="d-none d-lg-block d-xl-block d-md-block ">
                <img src="<?= base_url() . 'images/other/bottom banner.png'; ?>" class="img-fluid"/>
            </div>-->
        </div>
        <div class="col-md-3 pr-0 d-lg-block d-xl-block d-md-block" id="ads"><!--d-none-->

            <h3 class="tag font-weight-bold pl-2 py-2">LATEST</h3><!--my-4-->
            <div class="latest-voices-list">

            </div>
            <h6 class="font-weight-bold pl-2 py-2 text-center"><a href="<?= base_url() ?>YourVoice">Read All</a></h6>
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
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="display: block;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Information</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="del_voice_id" id="del_voice_id" value="" />
                <p>You will require minimum 25 Silver Points to raise a voice.</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="" class="btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing...">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>js/voice_detail.js?v=0.5"></script>
