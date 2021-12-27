<style>
    .choices-list .form-group:first-child .remove-choices{
        display:none;
    }
    /* File Upload button css START */
    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
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

    .datepicker td, .datepicker th{
        width: 40px;
        height: 30px;
    }
    .remove-preview-cls{
        font-size: 30px;
        position: absolute;
        right: 8px;
        top: -15px; 
        z-index:1;
    }
</style>
<div class="container mb-5 blog-list-page data-container">
    <div class="row mt-3">
        <div class="col-md-12 voice-cont">
            <div class="bg-w-block py-4 d-block title-hr">
                <div class='row mx-3 my-2'>
                    <div class="col">
                        <div class="row">
                            <div class="col-md-12">
                                <form name="frm_article" id="frm_article" method="post" enctype="multipart/form-data" autocomplete="off">
                                    <div class="form-group">
                                        <?php $article_id = ( ! @$data[ 0 ][ 'id' ]) ? "0" : @$data[ 0 ][ 'id' ] ?>
                                        <input type="hidden" name="articleid" id="articleid" value="<?= $article_id ?>" />
                                        <input type="hidden" id="article_preview" name="article_preview" value="">
                                        <input type="hidden" id="json_data" name="json_data" value="" />
                                        <input type="text" class="form-control" name="title" id="title" required="" value="<?= @$data[ 0 ][ 'title' ] ?>" placeholder="Ask your question with 'What','Why','Which' etc" maxlength="75">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" required="" rows="5"><?= @$data[ 0 ][ 'description' ] ?></textarea>

                                        <div class="generated-preview mt-3" style="position:relative;">
                                            <!--<a href="javascript:void(0)" class="remove-preview-cls" style="font-size: 30px;position: absolute;right: 8px;top: -15px;">&times;</a>
                                            <a href="#" target="_blank" class="text-dark no-underline">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div style="height: 200px; background: url(https://imgcdn.crowdwisdom.co.in/www.crowdwisdom.co.in/images/logo/preview.jpg) center center no-repeat"></div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="contain-title">Wisdom Of The Crowds: India Crowd Sourcing, India Free Surveys - CrowdWisdom</div>
                                                        <div class="contain-description mt-2">CrowdWisdom</div>
                                                    </div>
                                                </div>
                                            </a>-->
                                        </div>
                                    </div>
                                    <!-- choice-list section can be useful later-->
                                    <!--<div class="choices-list">
                                        <label for="">Your Choices</label>
                                         choice will appear here
                                    <?php
                                    $other_fields = 0;
                                    $options = ( ! @$data[ 0 ][ 'options' ]) ? array () : @$data[ 0 ][ 'options' ];
                                    if ( ! empty( $options ) ) {
                                            $other_fields = count( $options ) - 4;
                                            unset( $options[ count( $options ) - 1 ] );
                                            unset( $options[ count( $options ) - 1 ] );
                                    }
                                    ?>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-11">
                                                    <input type="text" class="form-control" name="choices[]" id="choice2" required="" placeholder="" value="<?= @$data[ 0 ][ 'options' ][ 0 ][ 'choice' ] ?>">
                                                </div>
                                                <div class="col-md-1">
                                                    <a href="#" class="add-more-choices">
                                                        <span>&#x2b;</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    $field_count = count( $options ) - 1;
                                    foreach ( $options as $key => $optns ) {
                                            if ( $key < 1 ) {
                                                    continue;
                                            }
                                            if ( $key === $field_count ) {
                                                    $cls = "add-more-choices";
                                                    $icon = "&#x2b;";
                                            } else {
                                                    $cls = "remove-choices";
                                                    $icon = "&minus;";
                                            }
                                            echo '<div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-11">
                                                                <input type="text" class="form-control" name="choices[]" id="choice2" required="" placeholder="" value="' . $optns[ 'choice' ] . '">
                                                            </div>
                                                            <div class="col-md-1">
                                                                <a href="#" class="' . $cls . '">
                                                                    <span>' . $icon . '</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>';
                                    }
                                    ?>
                                    </div>-->
                                    <!--above commented choice-list section can be useful later-->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <input type="text" class="form-control" name="choices[]" id="choice11" placeholder="" readonly="" value="One of the best Ads I have Seen">
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <input type="text" class="form-control" name="choices[]" id="choice11" placeholder="" readonly="" value="I like this Ad, Will buy">
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <input type="text" class="form-control" name="choices[]" id="choice11" placeholder="" readonly="" value="I like this Ad, Will Consider, May Not Buy">
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <input type="text" class="form-control" name="choices[]" id="choice11" placeholder="" readonly="" value="I like this Ad, nothing more">
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <input type="text" class="form-control" name="choices[]" id="choice11" placeholder="" readonly="" value="I don't like this Ad" >
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <input type="text" class="form-control" name="choices[]" id="choice11" placeholder="" readonly="" value="I don't like this Ad - One of the worst Ads I have seen">
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                    </div>

                                    <!--<div class="row choice mb10">
                                        <div class="col s11">
                                            <div style="position:relative">
                                                <input type="text" name="choice[]" value="Don't Read/Watch, Biased"  readonly/>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row choice mb10">
                                        <div class="col s11">
                                            <div style="position:relative">
                                                <input type="text" name="choice[]" value="Mostly Fake"  readonly/>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row choice mb10">
                                        <div class="col s11">
                                            <div style="position:relative">
                                                <input type="text" name="choice[]" value="Fully Fake"  readonly/>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row choice mb10">
                                        <div class="col s11">
                                            <div style="position:relative">
                                                <input type="text" name="choice[]" value="Others (Add in Comment Section)"  readonly/>

                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <input type="text" class="form-control" name="choices[]" id="choice11" placeholder="" readonly="" value="Click to see Rating">
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <input type="text" class="form-control" name="choices[]" id="choice11" placeholder="" readonly="" value="None of the above">
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
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
                                                        <?xml version="1.0" encoding="iso-8859-1"?>
                                                        <!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                             viewBox="0 0 419.2 419.2" style="enable-background:new 0 0 419.2 419.2;" xml:space="preserve">
                                                        <circle cx="158" cy="144.4" r="28.8"/>
                                                        <path d="M394.4,250.4c-13.6-12.8-30.8-21.2-49.6-23.6V80.4c0-15.6-6.4-29.6-16.4-40C318,30,304,24,288.4,24h-232
                                                              c-15.6,0-29.6,6.4-40,16.4C6,50.8,0,64.8,0,80.4v184.4V282v37.2c0,15.6,6.4,29.6,16.4,40c10.4,10.4,24.4,16.4,40,16.4h224.4
                                                              c14.8,12,33.2,19.6,53.6,19.6c23.6,0,44.8-9.6,60-24.8c15.2-15.2,24.8-36.4,24.8-60C419.2,286.8,409.6,265.6,394.4,250.4z
                                                              M21.2,80.4c0-9.6,4-18.4,10.4-24.4c6.4-6.4,15.2-10.4,24.8-10.4h232c9.6,0,18.4,4,24.8,10.4c6.4,6.4,10.4,15.2,10.4,24.8v124.8
                                                              l-59.2-59.2c-4-4-10.8-4.4-15.2,0L160,236l-60.4-60.8c-4-4-10.8-4.4-15.2,0l-63.2,64V80.4z M56,355.2v-0.8
                                                              c-9.6,0-18.4-4-24.8-10.4c-6-6.4-10-15.2-10-24.8V282v-12.4L92,198.4l60.4,60.4c4,4,10.8,4,15.2,0l89.2-89.6l58.4,58.8
                                                              c-1.2,0.4-2.4,0.8-3.6,1.2c-1.6,0.4-3.2,0.8-5.2,1.6c-1.6,0.4-3.2,1.2-4.8,1.6c-1.2,0.4-2,0.8-3.2,1.6c-1.6,0.8-2.8,1.2-4,2
                                                              c-2,1.2-4,2.4-6,3.6c-1.2,0.8-2,1.2-3.2,2c-0.8,0.4-1.2,0.8-2,1.2c-3.6,2.4-6.8,5.2-9.6,8.4c-15.2,15.2-24.8,36.4-24.8,60
                                                              c0,6,0.8,11.6,2,17.6c0.4,1.6,0.8,2.8,1.2,4.4c1.2,4,2.4,8,4,12v0.4c1.6,3.2,3.2,6.8,5.2,9.6H56z M378.8,355.2
                                                              c-11.6,11.6-27.2,18.4-44.8,18.4c-16.8,0-32.4-6.8-43.6-17.6c-1.6-1.6-3.2-3.6-4.8-5.2c-1.2-1.2-2.4-2.8-3.6-4
                                                              c-1.6-2-2.8-4.4-4-6.8c-0.8-1.6-1.6-2.8-2.4-4.4c-0.8-2-1.6-4.4-2-6.8c-0.4-1.6-1.2-3.6-1.6-5.2c-0.8-4-1.2-8.4-1.2-12.8
                                                              c0-17.6,7.2-33.2,18.4-44.8c11.2-11.6,27.2-18.4,44.8-18.4s33.2,7.2,44.8,18.4c11.6,11.6,18.4,27.2,18.4,44.8
                                                              C397.2,328,390,343.6,378.8,355.2z"/>
                                                        <path d="M341.6,267.6c-0.8-0.8-2-1.6-3.6-2.4c-1.2-0.4-2.4-0.8-3.6-0.8c-0.4,0-0.4,0-0.4,0c-0.4,0-0.4,0-0.4,0
                                                              c-1.2,0-2.4,0.4-3.6,0.8c-1.2,0.4-2.4,1.2-3.6,2.4l-24.8,24.8c-4,4-4,10.8,0,15.2c4,4,10.8,4,15.2,0l6.4-6.4v44
                                                              c0,6,4.8,10.8,10.8,10.8s10.8-4.8,10.8-10.8v-44l6.4,6.4c4,4,10.8,4,15.2,0c4-4,4-10.8,0-15.2L341.6,267.6z"/>
                                                        </svg>
                                                    </span>
                                                    <?php $required = ( ! @$data[ 0 ][ 'image' ] ) ? 'required' : '' ?>
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
                                        <button type="button" class="btn lg btn-outline-primary rounded-btn mx-auto">Cancel</button>
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
            other_options: <?= ($other_fields == 0) ? $other_fields : $other_fields + 1 ?>,
            article_id:<?= $article_id ?>
        };
</script>
<script src="<?= base_url() ?>js/config.js?v=0.00"></script>
<script src="<?= base_url() ?>js/create_update_article.js?v=0.00"></script>