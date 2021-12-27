<style>
    /* File Upload button css START */
    .fileUpload {
        position: relative;
        margin: 33px 0px 0px;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    /* File Upload button css END */
</style>
<?php
$sessiondata = $this -> session -> userdata( 'data' );
$web_user_id = ( ! @$data[ 0 ][ 'user_id' ]) ? "0" : @$data[ 0 ][ 'user_id' ];
if ( $web_user_id != "0" && $web_user_id != $sessiondata[ 'uid' ] ) {
        redirect( "FromTheWeb/detail/" . @$data[ 0 ][ 'id' ] );
}
?>
<div class="container mb-5 blog-list-page data-container">
    <div class="row mt-3">
        <div class="col-md-12 voice-cont">
            <div class="bg-w-block py-4 d-block title-hr">
                <div class='row mx-3 my-2'>
                    <div class="col">
                        <div class="row">
                            <div class="col-md-12">
                                <form name="frm_web" id="frm_web" method="post" enctype="multipart/form-data" autocomplete="off">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <?php
                                        $web_id = ( ! @$data[ 0 ][ 'id' ]) ? "0" : @$data[ 0 ][ 'id' ];
                                        $showimgclass = ( ! @$data[ 0 ][ 'data' ]) ? "" : "d-none";
                                        $preview_data = json_decode( @$data[ 0 ][ 'data' ], TRUE );
                                        ?>
                                        <input type="hidden" name="webid" id="webid" value="<?= $web_id ?>" />
                                        <input type="hidden" name="json_data" id="json_data" value='<?= @$data[ 0 ][ 'data' ] ?>' />
                                        <input type="hidden" name="is_topic_change" id="is_topic_change" value="0" />
                                        <input type="text" class="form-control" name="title" id="title" required="" value="<?= @$data[ 0 ][ 'title' ] ?>" placeholder="" maxlength="75">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" required="" rows="5"><?= @$data[ 0 ][ 'description' ] ?></textarea>

                                        <div class="generated-preview mt-3" style="position:relative;">
                                            <div class="<?= ( ! @$data[ 0 ][ 'data' ]) ? "d-none" : "" ?>">
                                                <a href="#" target="_blank" class="remove-preview-cls close" style="z-index: 2;position: relative;">×</a>
                                                <a href="<?= $preview_data[ 'link' ] ?>" target="_blank" class="text-dark nav-link">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div style="height: 200px; background:url(<?= $preview_data[ 'img' ] ?>) center center no-repeat; background-size: cover;"></div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="contain-title"><?= $preview_data[ 'title' ] ?></div>
                                                            <div class="contain-description mt-2"><?= $preview_data[ 'description' ] ?></div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="search_topics">Search Topics:</label>
                                        <div class="show-error"></div>
                                        <input type="text" class="form-control" name="search_topics" id="search_topics" placeholder="search by topic name">
                                    </div>
                                    <div class="form-group searched_topics position-absolute w-75 bg-light z-depth-3">

                                    </div>
                                    <br/>
                                    <div class="form-group selected_topics">
                                        <label class="col-xs-12">Selected Topics:</label>
                                        <div class="row px-4">
                                            <?php
                                            $selectedTopicIds = array ();
                                            if ( ! empty( @$data[ 0 ][ 'topic_associated' ] ) ) {
                                                    foreach ( @$data[ 0 ][ 'topic_associated' ] as $ta ):
                                                            $selectedTopicIds[] = $ta[ 'topic_id' ];
                                                            ?>
                                                            <div class="float-left alert alert-secondary p-2 mr-3 selected-topic">
                                                                <input type="hidden" name="topics[]" value="<?= $ta[ 'topic_id' ] ?>" data-id="<?= $ta[ 'topic_id' ] ?>"><?= $ta[ 'topic' ] ?>
                                                                <i class="cancel" style="cursor:pointer">&nbsp; ×</i>
                                                            </div>
                                                            <?php
                                                    endforeach;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group <?= $showimgclass ?>">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="uploadFile">Upload Image</label>
                                                <input type="text" class="form-control" id="uploadFile" name="uploaded_filename" placeholder="Choose Cover Image" readonly="readonly" required="" value="<?= @$data[ 0 ][ 'image' ] ?>">
                                                <!--<br>
                                                <i class="small">File size should be less than 1 MB and dimension should be minimum 200*200</i>-->
                                            </div>
                                            <div class="col-md-1">
                                                <div class="fileUpload">
                                                    <span>
                                                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                                                    </span>
                                                    <?php //$required = ($web_id != "0" && $showimgclass != "") ? "" : (( ! @$data[ 0 ][ 'image' ] ) ? 'required' : '') ?>
                                                    <input id="uploadImage" name="poll_img" type="file" class="upload" <?= $required ?> aria-required="true" value="">
                                                </div>
                                                <div class="uploaded-img-preview">
                                                    <!--<div class="" style="height:90px; background:url(<?= @$data[ 0 ][ 'image' ] ?>) center center no-repeat;background-size:contain;"></div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mt-4 text-center">
                                        <button type="submit" class="btn lg btn-outline-primary btn-primary rounded-btn mx-auto">Submit</button>
                                        <!--<button type="button" class="btn lg btn-outline-primary rounded-btn mx-auto">Cancel</button>-->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
        var options = {
            toast: "<?= $this -> session -> flashdata( 'toast' ); ?>",
            base_url: "<?= base_url() ?>",
            web_id:<?= $web_id ?>,
            selectedTopicIds: <?= json_encode( $selectedTopicIds ) ?>
        };
</script>
<script src="<?= base_url() ?>js/config.js?v=0.00"></script>
<script src="<?= base_url() ?>js/create_update_web.js?v=0.00"></script>