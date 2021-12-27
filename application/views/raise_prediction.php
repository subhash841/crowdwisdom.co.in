<style>
    .choices-list .form-group:first-child .remove-choices{
        display:none;
    }
    /* File Upload button css START */
    .fileUpload {
        position: relative;
        margin: 33px 0px 0px;
        /*position: relative;
        overflow: hidden;
        margin: 10px;*/
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
$sessiondata = $this->session->userdata('data');
$prediction_user_id = (!@$data[0]['user_id']) ? "0" : @$data[0]['user_id'];
if ($prediction_user_id != "0" && $prediction_user_id != $sessiondata['uid']) {
    redirect("Predictions");
}
?>
<div class="container mb-5 blog-list-page data-container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="bg-w-block py-4 d-block title-hr">
                <div class='row mx-3 my-2'>
                    <div class="col">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h1 style="font-weight: 300; font-size: 1.50rem;"><strong>How it works?</strong></h1>
                            </div>
                            <div class="col-md-12">
                                <ol>
                                    <li>Enter your prediction question</li>
                                    <li>List the choices</li>
                                    <li>Write down the e-mail addresses of all your friends</li>
                                    <li>Launch the prediction</li>
                                    <li>Once the last date is done, you will get a mail asking you to choose the right answer</li>
                                    <li>Once you choose the answer, the results and names of the winners will go to all the participants</li>
                                </ol>
                                You can use this in your business for sales predictions, competitive activity monitoring etc. You can also use it for fun activities. None of your questions will be visible to the public.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12 voice-cont">
            <div class="bg-w-block py-4 d-block title-hr">
                <div class='row mx-3 my-2'>
                    <div class="col">
                        <div class="row">
                            <div class="col-md-12">
                                <form name="frm_prediction" id="frm_prediction" method="post" enctype="multipart/form-data" autocomplete="off">
                                    <div class="form-group">
                                        <label for="title">Ask your question with 'What','Why','Which' etc</label>
                                        <?php
                                        $prediction_id = (!@$data[0]['id']) ? "0" : @$data[0]['id'];
                                        $preview_data = json_decode(@$data[0]['data'], TRUE);
                                        ?>
                                        <input type="hidden" name="predictionid" id="predictionid" value="<?= $prediction_id ?>" />
                                        <input type="hidden" name="json_data" id="json_data" value='<?= @$data[0]['data'] ?>' />
                                        <input type="hidden" name="is_topic_change" id="is_topic_change" value="0" />
                                        <input type="hidden" name="is_choice_change" id="is_choice_change" value="0" />
                                        <input type="text" class="form-control" name="title" id="title" required="" value="<?= @$data[0]['title'] ?>" placeholder="" maxlength="75">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" required="" rows="5"><?= @$data[0]['description'] ?></textarea>

                                        <div class="generated-preview mt-3" style="position:relative;">
                                            <div class="<?= (!@$data[0]['data']) ? "d-none" : "" ?>">
                                                <a href="#" target="_blank" class="remove-preview-cls close" style="z-index: 2;position: relative;">×</a>
                                                <a href="<?= $preview_data['link'] ?>" target="_blank" class="text-dark nav-link">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div style="height: 200px; background:url(<?= $preview_data['img'] ?>) center center no-repeat; background-size: cover;"></div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="contain-title"><?= $preview_data['title'] ?></div>
                                                            <div class="contain-description mt-2"><?= $preview_data['description'] ?></div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="form-group">
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
                                    $selectedTopicIds = array();
                                    if (!empty(@$data[0]['topic_associated'])) {
                                        foreach (@$data[0]['topic_associated'] as $ta):
                                            $selectedTopicIds[] = $ta['topic_id'];
                                            ?>
                                                                                                                                                                <div class="float-left alert alert-secondary p-2 mr-3 selected-topic">                                                                                                                             <input type="hidden" name="topics[]" value="<?= $ta['topic_id'] ?>" data-id="<?= $ta['topic_id'] ?>"><?= $ta['topic'] ?>
                                                                                                                                                                 <i class="cancel" style="cursor:pointer">&nbsp; ×</i>
                                                                                                                                                                                                    </div>
                                            <?php
                                        endforeach;
                                    }
                                    ?>
                                        </div>
                                    </div>-->
                                    <div class="choices-list">
                                        <label for="">Your Choices</label>
                                        <!-- choice will appear here-->
                                        <?php
                                        $other_fields = 0;
                                        $options = (!@$data[0]['options']) ? array() : @$data[0]['options'];
                                        if (!empty($options)) {
                                            $other_fields = count($options) - 4;
                                            unset($options[count($options) - 1]);
                                            unset($options[count($options) - 1]);
                                        }
                                        ?>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-11">
                                                    <input type="text" class="form-control" name="choices[]" id="choice2" required="" placeholder="" value="<?= @$data[0]['options'][0]['choice'] ?>">
                                                </div>
                                                <div class="col-md-1">
                                                    <a href="#" class="add-more-choices">
                                                        <span>&#x2b;</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $field_count = count($options) - 1;
                                        foreach ($options as $key => $optns) {
                                            if ($key < 1) {
                                                continue;
                                            }
                                            if ($key === $field_count) {
                                                $cls = "add-more-choices";
                                                $icon = "&#x2b;";
                                            } else {
                                                $cls = "remove-choices";
                                                $icon = "&minus;";
                                            }
                                            echo '<div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-11">
                                                                <input type="text" class="form-control" name="choices[]" id="choice2" required="" placeholder="" value="' . $optns['choice'] . '">
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
                                            <div class="col-md-11">
                                                <label for="startdate" class="">End Date</label>
                                                <div class="input-group input-daterange">
                                                    <input type="text" name="end_date" id="end_date" class="form-control text-left" readonly="readonly" required value="" autocomplete="false">
                                                </div>
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="emails">Email Ids</label>
                                                <input type="text" class="form-control" name="emails" id="emails" placeholder="Enter comma saperated email ids" required="" value="<?= @$data[0]['email_ids'] ?>" data-role="tagsinput" />
                                                <small>Enter comma saperated email ids</small>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-5">
                                                <label for="uploadFile">Upload Image</label>
                                                <input type="text" class="form-control" id="uploadFile" name="uploaded_filename" placeholder="Choose Cover Image" readonly="readonly" required="" value="<?= @$data[0]['image'] ?>">
                                                <!--<br>
                                                <i class="small">File size should be less than 1 MB and dimension should be minimum 200*200</i>-->
                                            </div>
                                            <div class="col-md-1">
                                                <div class="fileUpload">
                                                    <span>
                                                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                                                    </span>
                                                    <?php $required = (!@$data[0]['image'] && empty($preview_data['link'])) ? 'required' : '' ?>
                                                    <input id="uploadImage" name="poll_img" type="file" class="upload" <?= $required ?> aria-required="true" value="">
                                                </div>
                                                <div class="uploaded-img-preview">
                                                    <!--<div class="" style="height:90px; background:url(<?= @$data[0]['image'] ?>) center center no-repeat;background-size:contain;"></div>-->
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
<!--selectedTopicIds: <?= json_encode($selectedTopicIds) ?>-->
<script>
    var options = {
        toast: "<?= $this->session->flashdata('toast'); ?>",
        base_url: "<?= base_url() ?>",
        other_options: <?= ($other_fields == 0) ? $other_fields : $other_fields + 1 ?>,
        prediction_id:<?= $prediction_id ?>,
    };
</script>
<script src="<?= base_url() ?>js/config.js?v=0.00"></script>
<script src="<?= base_url() ?>js/create_prediction.js?v=0.02"></script>
