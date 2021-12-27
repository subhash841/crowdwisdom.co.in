<style>
    .choices-list .form-group:first-child .remove-choices{
        display:none;
    }
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

    .datepicker td, .datepicker th{
        width: 40px;
        height: 30px;
    }
</style>
<?php
$sessiondata = $this -> session -> userdata( 'data' );
$question_user_id = ( ! @$data[ 0 ][ 'user_id' ]) ? "0" : @$data[ 0 ][ 'user_id' ];
if ( $question_user_id != "0" && $question_user_id != $sessiondata[ 'uid' ] ) {
        redirect( "AskQuestions" );
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
                                <form name="frm_question" id="frm_question" method="post" enctype="multipart/form-data" autocomplete="off">
                                    <div class="form-group">
                                        <label for="title">Ask your question with 'What','Why','Which' etc</label>
                                        <?php $question_id = ( ! @$data[ 0 ][ 'id' ]) ? "0" : @$data[ 0 ][ 'id' ] ?>
                                        <input type="hidden" name="questionid" id="questionid" value="<?= $question_id ?>" />
                                        <input type="hidden" name="json_data" id="json_data" value="" />
                                        <input type="hidden" name="is_topic_change" id="is_topic_change" value="0" />
                                        <input type="hidden" name="is_choice_change" id="is_choice_change" value="0" />
                                        <input type="text" class="form-control" name="title" id="title" required="" value="<?= @$data[ 0 ][ 'title' ] ?>" placeholder="" maxlength="75">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" required="" rows="5"><?= @$data[ 0 ][ 'description' ] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Search Topics:</label>
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
                                    <div class="choices-list">
                                        <label for="">Your Choices</label>
                                        <!-- choice will appear here-->
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
                                                <div class="col-md-1 pt-2">
                                                    <a href="#" class="add-more-choices">
                                                        <span><?xml version="1.0" encoding="iso-8859-1"?><!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0) --><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="22px" height="22px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><polygon points="272,128 240,128 240,240 128,240 128,272 240,272 240,384 272,384 272,272 384,272 384,240 272,240"/><path d="M256,0C114.609,0,0,114.609,0,256c0,141.391,114.609,256,256,256c141.391,0,256-114.609,256-256C512,114.609,397.391,0,256,0z M256,472c-119.297,0-216-96.703-216-216S136.703,40,256,40s216,96.703,216,216S375.297,472,256,472z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></span>
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
                                                        $icon = '<?xml version="1.0" encoding="iso-8859-1"?><!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0) --><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="22px" height="22px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><polygon points="272,128 240,128 240,240 128,240 128,272 240,272 240,384 272,384 272,272 384,272 384,240 272,240"/><path d="M256,0C114.609,0,0,114.609,0,256c0,141.391,114.609,256,256,256c141.391,0,256-114.609,256-256C512,114.609,397.391,0,256,0z M256,472c-119.297,0-216-96.703-216-216S136.703,40,256,40s216,96.703,216,216S375.297,472,256,472z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>';
                                                } else {
                                                        $cls = "remove-choices";
                                                        $icon = '<?xml version="1.0" encoding="iso-8859-1"?><!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  --><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="22px" height="22px" viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve"><g><g><g><g><g><path d="M306.336,611.994c-8.544,0-17.218-0.362-25.777-1.077c-81.445-6.794-155.37-44.898-208.157-107.296 C19.613,441.225-5.711,362.007,1.083,280.56C7.506,203.594,42.393,132.5,99.32,80.377 C155.926,28.548,229.205,0.006,305.659,0.006c8.544,0,17.217,0.361,25.776,1.076c81.449,6.795,155.376,44.9,208.162,107.297 c52.786,62.396,78.114,141.613,71.319,223.061c-6.421,76.967-41.309,148.061-98.235,200.182 C456.076,583.451,382.795,611.994,306.336,611.994z M305.659,8.036c-74.443,0-145.794,27.797-200.915,78.264 C49.312,137.054,15.341,206.28,9.085,281.228C2.47,360.537,27.131,437.676,78.534,498.435 c51.4,60.759,123.384,97.865,202.693,104.48c8.337,0.694,16.786,1.049,25.109,1.049c74.446,0,145.801-27.795,200.922-78.266 c55.435-50.755,89.404-119.98,95.658-194.929c6.615-79.309-18.046-156.448-69.448-217.206 c-51.4-60.759-123.387-97.863-202.699-104.48C322.43,8.39,313.981,8.036,305.659,8.036z"/></g></g><g><rect x="346.039" y="240.694" width="8.031" height="185.702"/><rect x="296.787" y="240.694" width="8.031" height="185.702"/><rect x="247.534" y="240.694" width="8.031" height="185.702"/><path d="M454.603,190.513H353.84c0.723-1.946,0.938-3.935,0.939-5.568l0.014-21.646c0.006-11.456-9.311-20.784-20.766-20.791 l-72.34-0.037c-0.005,0-0.008,0-0.011,0c-11.448,0-20.772,9.317-20.775,20.77l-0.016,21.642 c-0.001,2.246,0.384,4.086,0.975,5.629h-84.748v8.031h27.135v237.006c0,18.778,15.271,34.04,34.04,34.04H389.42 c18.766,0,34.037-15.26,34.037-34.04V198.544h31.144v-8.031H454.603z M248.933,163.243c0.002-7.025,5.72-12.743,12.745-12.743 h0.006l72.34,0.039c7.027,0.005,12.742,5.728,12.738,12.756l-0.013,21.642c-0.005,5.115-3.097,5.551-7.171,5.555l-5.432-0.103 l-0.079-0.001h-0.08l-77.862,0.059c-1.866-0.001-3.958-0.115-5.287-0.941c-0.527-0.33-1.924-1.203-1.922-4.618L248.933,163.243z M415.428,435.552c0,14.341-11.667,26.009-26.006,26.009H218.29c-14.342,0-26.009-11.668-26.009-26.009V198.841h223.147V435.552 L415.428,435.552z"/></g></g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>';
                                                }
                                                echo '<div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-11">
                                                                <input type="text" class="form-control" name="choices[]" id="choice2" required="" placeholder="" value="' . $optns[ 'choice' ] . '">
                                                            </div>
                                                            <div class="col-md-1 pt-2">
                                                                <a href="#" class="' . $cls . '">
                                                                    <span>' . $icon . '</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>';
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <input type="text" class="form-control" name="choices[]" id="choice11" placeholder="" readonly="" value="See the Results">
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <input type="text" class="form-control" name="choices[]" id="choice12" placeholder="" readonly="" value="None of the above">
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="select_choice" id="select_choice1" value="0" <?php echo (@$data[ 0 ][ 'is_multiple' ] == 0) ? 'checked' : '' ?> />
                                                    <label class="form-check-label" for="select_choice1">
                                                        Single Choice
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="select_choice" id="select_choice2" value="1" <?php echo (@$data[ 0 ][ 'is_multiple' ] == 1) ? 'checked' : '' ?> />
                                                    <label class="form-check-label" for="select_choice2">
                                                        Multiple Choice
                                                    </label>
                                                </div>
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
                                                        <i class="fa fa-picture-o" aria-hidden="true"></i>
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
            other_options: <?= ($other_fields == 0) ? $other_fields : $other_fields + 1 ?>,
            question_id:<?= $question_id ?>,
            selectedTopicIds: <?= json_encode( $selectedTopicIds ) ?>
        };
</script>
<script src="<?= base_url() ?>js/config.js?v=0.00"></script>
<script src="<?= base_url() ?>js/create_update_question.js?v=0.00"></script>