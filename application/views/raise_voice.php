<script src="https://cdn.ckeditor.com/4.10.0/full-all/ckeditor.js"></script>
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
    #userActions { 
        position: relative;
        padding: 20px;
        display: table-cell;
        width: inherit;
        vertical-align: middle;
        text-align: center;
        color: #c0c7d6;
        background-color: #FFF;
        border: dashed 1px #c0c7d6;
        margin: 10px 0;
    }
    #imgPrime {
        height: 100%;
        position: absolute;
        width: 100%;
        display: none;
        top: 0;
        left: 0;
    }
    #removethumb {
        cursor: pointer;
        display: none;
        position: absolute;
        top: 0;
        right: 0;
        width: 25px;
        color: #fff;
        background-color: red;
        height: 25px;
        font-weight: 600;
    }

</style>
<?php
//print_r($blog_data['data'][0]);
if ( @$blog_data[ 'data' ][ 0 ][ 'image' ] ) {
        $image = $blog_data[ 'data' ][ 0 ][ 'image' ];
}
$selectedTopicIds = array ();
if ( ! empty( @$topic_associated ) ) {
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
<div class="container">
    <div class="row" style="margin-top: 50px;">
        <div class="col s12 m12 l12">
            <form id="postpoll" name="yourvoice" method="POST" action="" enctype="multipart/form-data">
            <!--<form id="postpoll" name="yourvoice" method="POST" action="<?= base_url() ?>YourVoice/create_update_voice" enctype="multipart/form-data">-->
                <div class="card p-4">
                    <div class="row mb0">
                        <div class="col m12 s12">
                            <h5 class="fs13px fw600 fieldtitle">Title</h5>
                            <input type="hidden" name="voice_id" id="voice_id" value="<?= ( ! @$blog_data[ 'data' ][ 0 ][ 'id' ]) ? 0 : @$blog_data[ 'data' ][ 0 ][ 'id' ]; ?>" />
                            <input type="hidden" name="is_topic_change" id="is_topic_change" value="0" />
                            <input type="hidden" name="is_choice_change" id="is_choice_change" value="0" />
                            <input type="text" class="form-control textarea-scrollbar mt-3 mb-4"  placeholder="Type your Title here" name="voice_topic"  value='<?= @$blog_data[ 'data' ][ 0 ][ 'title' ]; ?>'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Search Topics:</label>
                        <div class="show-error"></div>
                        <input type="text"  class="form-control" name="search_topics" id="search_topics" placeholder="search by topic name">
                        <div class="form-group searched_topics position-absolute w-75 bg-light z-depth-3">

                        </div>
                        <br/>
                        <div class="form-group selected_topics">
                            <label class="col-xs-12">Selected Topics:</label>
                            <div class="row px-4">
                                <?php
                                $selectedTopicIds = array ();
                                if ( ! empty( @$topic_associated ) ) {
                                        foreach ( @$topic_associated as $ta ):
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
                    </div>


                    <div class="row">
                        <div class="col m12 s12">
                            <h5 class="fs13px fw600 fieldtitle">Description</h5>
                            <textarea  name="voice_desc" id="voice_desc" rows="50" cols="80"><?= @$blog_data[ 'data' ][ 0 ][ 'description' ]; ?></textarea>
                            <span class="error-display text-danger"><?= form_error( "voice_desc" ) ?></span>
                        </div>
                    </div>

                    <!--                    <div class="form-group mt-4">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <label for="uploadFile">Upload Image</label>
                                                    <input type="text" class="form-control" id="uploadFile" name="uploaded_filename" placeholder="Choose Cover Image" readonly="readonly" required="" value="">                                
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="fileUpload">
                                                        <span>
                                                            <i class="fa fa-picture-o" aria-hidden="true"></i>
                                                            <h3>Upload img</h3>
                                                        </span>
                                                        <input id="uploadImage" name="poll_img" type="file" class="upload" required="" aria-required="true" value="">
                                                    </div>
                                                    <div class="uploaded-img-preview">
                                                        <div class="" style="height:90px; background:url() center center no-repeat;background-size:contain;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->

                    <div class="row">
                        <div class="col m12 s12 mt-3">
                            <div id="userActions">
                                <p class="fs14px center" style="margin: 0;">Upload Image</p>
                                <p class="fs12px center" style="margin-top: 0;">(.jpeg or .png)</p>
                                <label class="fileContainer btn drag-browsebtn fallback" for="fileUpload" style="background:#00b6ff;color:white;">
                                    Browse
                                    <input type="file" id="fileUpload" name="voiceImageUpload" accept="image/*;capture=camera" onchange="readURL(this);" style="display:none">
                                </label>
                                <img id="imgPrime" src="<?= @$image ?>" name="drangndropimg">
                                <div id="removethumb"><i class="fa fa-times mt-1"></i></div>
                                <div><small style="color:#000;">(Maximum filesize 300KB)</small></div>
                            </div>
                        </div>
                    </div>

                    <div class="row center mt35b20 mt-4">
                        <button type="submit" class="btn lg btn-outline-primary btn-primary rounded-btn mx-auto" id="raise-topic-btn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id='alert_placeholder' class="col-md-3 mx-auto fixed-bottom"></div>
<script>
        var config = {
            subcategory_id: '<?= @$blog_data[ 'data' ][ 0 ][ 'sub_category_id' ]; ?>',
            category_id: '<?= @$blog_data[ 'data' ][ 0 ][ 'category_id' ]; ?>'
        };
        var options = {
            base_url: "<?= base_url() ?>"};
        var selectedTopicId = [];
        //search Topics
        $("#search_topics").on('keyup', function (e) {
            var topic = $(this).val();
            var html = '';

            if (topic != "" && topic.length > 2) {
                $.ajax({
                    url: options.base_url + "HotTopics/search_topics",
                    method: "POST",
                    data: {topic: topic, excludetopic: JSON.stringify(selectedTopicId)}
                }).done(function (result) {

                    $(".searched_topics").html("");
                    for (var i in result) {

                        html = $("<div />", {class: "col-sm-4"})
                                .append($("<a />", {class: "foundtopic nav-link", href: "#", "data-id": result[i].id, "data-name": result[i].topic}).html(result[i].topic)

                                        );

                        $(".searched_topics").append(html);
                    }

                });
            } else {

                $(".searched_topics").html("");
            }
        });

        $(document).on('click', 'a.foundtopic', function (e) {
            e.preventDefault();

            var selected = $("<div>", {class: "float-left alert alert-secondary p-2 mr-3 selected-topic"})
                    .append('<input type="hidden" name="topics[]" value="' + $(this).attr('data-id') + '" data-id="' + $(this).attr('data-id') + '">' + $(this).attr('data-name'))
                    .append($("<i>", {class: "cancel", style: "cursor:pointer"}).html('&nbsp; &times;')
                            )


            $(this).closest('.searched_topic').parent().remove();
            $('.selected_topics').show();
            $('.selected_topics .row').append(selected);
            $("#search_topics").val('').trigger("keyup");
            $("#is_topic_change").val('1');
            selectedTopicId.push($(this).attr('data-id'));
        });

        $(document).on('click', '.selected_topics .cancel', function (e) {
            $(this).closest('.selected-topic').remove();
            var index = selectedTopicId.indexOf($(this).prev().attr('data-id'));
            if (index > -1) {
                selectedTopicId.splice(index, 1);
                $("#is_topic_change").val('1');
            }
        });

        /* Search Topic - END */

</script>

<script src="<?= base_url() ?>js/config.js?v=0.00"></script>
<script src="<?= base_url() ?>js/create_voice.js?v=0.5"></script>