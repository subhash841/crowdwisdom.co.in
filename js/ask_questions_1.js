/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var base_url = $("body").attr("data-base_url");
var img_cdn_url = "https://imgcdn.crowdwisdom.co.in/" + base_url.replace("http://", "").replace("https://", "");
var date = new Date();
var timestamp = date.getTime();
var flag = true;
var uid = $("body").attr("data-uid");
var predictionid = $("body").attr("data-detailid");
$(function () {
    $(document).ajaxStart(function () {
        $("#loading").show();
    });
    $(document).ajaxStop(function () {
        $("#loading").hide();
    });
    $("a.head-login").attr("href", base_url + "Login?section=survey");
    var default_prediction_count = 7;
    var voice_list_offset = 0;
    load_questions(voice_list_offset);
    var article_list_offset = 0;
    load_articles(article_list_offset);

    /* This is for detail view */
    if (predictionid != "") {
        var latest_voice_list_offset = 0;
        load_latest_voices(latest_voice_list_offset);
        $("a.head-login").attr("href", base_url + "Login?section=voicedetail&vid=" + predictionid);
    }

    $(".blog-list-page .load-more-voice-list").on("click", function (e) {
        if (voice_list_offset == 0) {
            default_prediction_count = 7;
        } else {
            default_prediction_count = 6;
        }
        voice_list_offset = voice_list_offset + default_prediction_count;
        load_questions(voice_list_offset);
    });

    /* Points checking for create voice */
    $(".btn_create_question").on("click", function (e) {

        e.preventDefault();
        var uid = $("body").attr("data-uid");
        var silver_points = $("body").attr("data-silver_points");
        var body = '';
        if (uid == 0) {
            window.location.assign(base_url + "Login?section=survey");
        } else if (silver_points < 25) {
            body = '<div><img src="' + base_url + 'images/banners/coin_f.png"><span>' + silver_points + '</span></div><p>You can\'t raise any Poll.</p><p>You must have 25 silver points to raise a Voice.</p>';
            $("#silverPointsCheck .modal-title").html("Your Balance Points");
            $('#silverPointsCheck .modal-body').html(body);
            $('#silverPointsCheck button#create_question_yes').hide();
            $('#silverPointsCheck button#create_question_no').hide();
            $('#silverPointsCheck button#create_question_ok').show();
            $('#silverPointsCheck').modal('show');
        } else {
            body = '<div><img src="' + base_url + 'images/banners/coin_f.png"><span>' + silver_points + '</span></div><p>Redeem 25 Points to raise a voice.</p>';
            $("#silverPointsCheck .modal-title").html("Your Balance Points");
            $('#silverPointsCheck .modal-body').html(body);
            $('#silverPointsCheck button#create_question_yes').show();
            $('#silverPointsCheck button#create_question_no').show();
            $('#silverPointsCheck button#create_question_ok').hide();
            $('#silverPointsCheck').modal('show');
        }
    });
    /*Click yes button*/
    $('#silverPointsCheck button#create_question_yes').on("click", function () {
        window.location.assign(base_url + "AskQuestions/raise_question");
    });
    if (options.toast) {
        Materialize.Toast.removeAll();
        Materialize.toast(options.toast, 4000);
        return false;
    }
//    $('.description-container p').each(function () {
//        var $this = $(this);
//        if ($this.html().replace(/\s|&nbsp;/g, '').length == 0)
//            $this.remove();
//    });
    $(".comment").each(function () {
        $(this).find('.userimg').css("background-color", getrandomcolor());
    })


    $(".post-comment").on("click", function (e) {
        e.preventDefault();
        if (uid == 0) {
            window.location.assign(base_url + "Login?section=voicedetail&vid=" + predictionid);
            return false;
        }
        var _this = $(this);
        var comment = _this.closest(".comment-box-holder").find("textarea.comment-text").val().trim();
        var voice_id = _this.attr("data-id");
        var comment_html = $(document.createDocumentFragment());
        var total_comments = parseInt($("#comentbox .total-comments-count").html());
        if (comment == "") {
            _this.closest(".row").find(".comment-error").html('Please enter comment');
            return false;
        }
        _this.addClass("disabled");
        $.ajax({
            url: base_url + "YourVoice/comment_on_voice",
            method: "POST",
            data: {voice_id: voice_id, comment: comment}
        }).done(function (result) {
            result = JSON.parse(result);
            if (result.status) {


                _this.removeClass("disabled");

                _this.closest(".comment-box-holder").find("textarea.comment-text").val('');
                var data = [];

                data.comment_id = result.data.comment_id;
                data.alias = $('body').attr("data-alias") ? $('body').attr("data-alias") : "You";
                data.comment = comment;
                data.voice_id = voice_id;
                data.user_id = uid;
                data.total_replies = 0;

                _this.removeClass("disabled");
                _this.closest(".comment-reply-box-holder").find("textarea.comment-reply-text").val('');

                comment_html = generatecommentbox(data)



                $("#comentbox .total-comments-count").html(total_comments + 1);  //increase total count from 1

                var increased_offset = parseInt(_this.closest(".comment_container").find(".row .view-more-comments").attr("data-offset")) + 1;
                _this.closest(".comment_container").find(".comments-list").prepend(comment_html);
                _this.closest(".comment_container").find(".row .view-more-comments").attr("data-offset", increased_offset);
            } else {
                _this.removeClass("disabled");
            }
        });
    });

    /* Edit comment - START */
    $(document).on("click", ".edit-comment", function (e) {
        e.preventDefault();
        var comment_id = $(this).attr("data-comment_id");

        $(this).closest(".comment_num_" + comment_id)
                .find(".edit_comment_box_holder")
                .toggleClass("d-none")
                .find("textarea")
                .val($(this).closest(".comment_num_" + comment_id).find("p.p-comment").text());
        $(this).closest(".comment_num_" + comment_id).find("p.p-comment").toggleClass("d-none");
    });

    $(document).on("click", ".post-edit-comment", function (e) {
        e.preventDefault();
        var _this = $(this);
        var voice_id = _this.attr("data-id");
        var comment_id = _this.attr("data-comment_id");
        var comment = _this.closest(".edit_comment_box_holder").find("textarea.edit-comment-text").val().trim();

        if (comment == "") {
            _this.closest(".edit_comment_box_holder").find(".edit-comment-error").html('Please enter comment');
            return false;
        }
        _this.addClass("disabled");
        $.ajax({
            url: base_url + "YourVoice/update_comment_on_voice",
            method: "POST",
            data: {voice_id: voice_id, comment_id: comment_id, comment: comment}
        }).done(function (result) {
            result = JSON.parse(result);
            if (result.status) {
                _this.removeClass("disabled");
                _this.closest(".comment_num_" + comment_id).find(".edit_comment_box_holder").toggleClass("d-none");
                _this.closest(".comment_num_" + comment_id).find("p.p-comment").html(comment).toggleClass("d-none");
            } else {
                _this.removeClass("disabled");
            }
        });
    });



    $(document).on("click", ".show-hide-reply", function (e) {
        e.preventDefault();
        var _this = $(this);
        var voice_id = _this.attr("data-id");
        if (uid == 0) {
            window.location.assign(base_url + "Login?section=voicedetail&vid=" + voice_id);
            return false;
        }
        var comment_id = _this.attr("data-comment_id");
        var offset = 0;
        var reply_html = $(document.createDocumentFragment());
        var edit_comment = '';
        var view_more_replies_html = '';
        $.ajax({
            url: base_url + "YourVoice/get_comment_replies",
            method: "POST",
            data: {voice_id: voice_id, comment_id: comment_id, offset: offset}
        }).done(function (result) {
            result = JSON.parse(result);
            console.log(result);
            for (var r in result['data']) {
                var data = [];
                data.comment_reply_id = result['data'][r].id;
                data.comment_id = result['data'][r].comment_id;
                data.alias = result['data'][r].alias;
                data.comment_reply = result['data'][r].reply;
                data.user_id = result['data'][r].user_id;
                data.voice_id = voice_id;
                data.total_replies = result['data'][r].total_replies
                reply_html.append(generatecommentbox(data, true));
            }

            _this.closest(".comment_container").find(".reply-container_" + comment_id + " .comment-reply-list").html(reply_html);
            if (result['is_available'] == "1") {
                var newoffset = offset + 5;
                view_more_replies_html = '<div class="row">\
                                            <div class="col-12 pt-1 text-right">\
                                                <a href="#" class="a-nostyle view-more-replies" data-id="' + voice_id + '" data-comment_id="' + comment_id + '" data-offset="' + newoffset + '"><small>View more replies</small></a>\
                                            </div>\
                                        </div>';


                _this.closest(".comment_container").find(".reply-container_" + comment_id).append(view_more_replies_html);
            }
        });
        _this.closest(".comment_container").find(".reply-container_" + comment_id).toggleClass("d-none");
    });
    /*delete Voice Comment - START */
    $(document).on("click", ".comment-delete", callback_delete_voice_comment);
    /*delete Voice Comment - END */

    $("textarea.comment-reply-text").on('keyup', function (e) {
        $(this).closest(".comment-reply-box-holder").find(".comment-reply-error").html('');
    });
    /* View More Comments of Voice*/
    $(document).on("click", ".view-more-replies", view_more_replies);
    /* Post Reply on comment - START */
    $(document).on("click", ".post-comment-reply", function (e) {
        e.preventDefault();
        if (uid == 0) {
            window.location.assign(base_url + "Login?section=voicedetail&vid=" + predictionid);
            return false;
        }
        var _this = $(this);

        var comment_reply = _this.closest(".comment-reply-box-holder").find("textarea.comment-reply-text").val();
        var comment_id = _this.attr("data-comment_id");
        var voice_id = _this.attr("data-id");
        if (comment_reply == "") {
            _this.closest(".comment-reply-box-holder").find(".comment-reply-error").html('Please enter reply.');
            return false;
        }
        _this.addClass("disabled");
        var comment_reply_html = '';
        $.ajax({
            url: base_url + "YourVoice/reply_on_comment_voice",
            method: "POST",
            data: {voice_id: voice_id, comment_id: comment_id, comment_reply: comment_reply}
        }).done(function (result) {
            result = JSON.parse(result);
            if (result.status) {

                var data = [];
                data.comment_reply_id = result.data.reply_id;
                data.comment_id = comment_id;
                data.alias = $('body').attr("data-alias") ? $('body').attr("data-alias") : "You";
                data.comment_reply = comment_reply;
                data.voice_id = voice_id;
                data.user_id = uid;

                _this.removeClass("disabled");
                _this.closest(".comment-reply-box-holder").find("textarea.comment-reply-text").val('');

                comment_reply_html = generatecommentbox(data, true)

                _this.closest(".reply-container_" + comment_id).find(".comment-reply-list").prepend(comment_reply_html);

            } else {
                _this.removeClass("disabled");
            }
        });
    });
    /* Post Reply on comment - END */

    $(document).on("click", ".post-edit-comment-reply", function (e) {
        e.preventDefault();
        var _this = $(this);
        var voice_id = _this.attr("data-id");
        var comment_id = _this.attr("data-comment_id");
        var comment_reply_id = _this.attr("data-reply_id");
        var comment_reply = _this.closest(".edit_comment_reply_box_holder").find("textarea.edit-comment-reply-text").val().trim();
        if (comment_reply == "") {
            _this.closest(".edit_comment_reply_box_holder").find(".edit-comment-reply-error").html('Please enter reply');
            return false;
        }
        _this.addClass("disabled");
        $.ajax({
            url: base_url + "YourVoice/update_comment_reply_on_voice",
            method: "POST",
            data: {voice_id: voice_id, comment_id: comment_id, comment_reply_id: comment_reply_id, comment_reply: comment_reply}
        }).done(function (result) {
            result = JSON.parse(result);
            if (result.status) {
                _this.removeClass("disabled");
                _this.closest(".reply_num_" + comment_reply_id).find(".edit_comment_reply_box_holder").toggleClass("d-none");
                _this.closest(".reply_num_" + comment_reply_id).find("p.maincolor").html(comment_reply).toggleClass("d-none");
            } else {
                _this.removeClass("disabled");
            }
        });
    });
    /* Edit comment reply - END */




    /*delete Comment reply*/
    $(document).on("click", ".reply-delete", callback_delete_comment_reply);

    $(".voice-like").on("click", callback_voice_like);


    /* View More Comments of Voice*/
    $(".view-more-comments").on("click", view_more_comments);
    /* Edit comment reply - START */
    $(document).on("click", ".edit-comment-reply", function (e) {
        e.preventDefault();
        var comment_reply_id = $(this).attr("data-reply_id");

        $(this).closest(".reply_num_" + comment_reply_id)
                .find(".edit_comment_reply_box_holder")
                .toggleClass("d-none")
                .find("textarea")
                .val($(this).closest(".reply_num_" + comment_reply_id).find("p.maincolor").text());
        $(this).closest(".reply_num_" + comment_reply_id).find("p.maincolor").toggleClass("d-none");
    });

    /* Show Delete voice confirmation modal */
    $("#cnfDeleteVoiceModal").on("show.bs.modal", function (event) {
        var base = "#cnfDeleteVoiceModal ";
        var relatedTarget = $(event.relatedTarget);
        var voice_id = relatedTarget.attr("data-id");
        $(base + "#del_voice_id").val(voice_id);
    });

    /* Delete voice confirmation - Yes*/
    $("#cnfDeleteVoiceModal button#btn_delete_voice_yes").on("click", function (event) {
        var _this = $(this);
        var voice_id = $("#cnfDeleteVoiceModal #del_voice_id").val();

        _this.attr("disabled", "disabled").html('Processing...');
        $.ajax({
            url: base_url + "YourVoice/delete_voice",
            method: "POST",
            data: {voice_id: voice_id}
        }).done(function (result) {
            setTimeout(function () {
                _this.removeAttr("disabled").html('Yes');
                window.location.assign(base_url + "YourVoice");
            }, 2000);
        });
    });


});
function generatecommentbox(data, reply = false) {


    var commentactioncont = $("<div />", {class: "d-flex justify-content-space"})
    var commentactions = $("<p />", {class: "m-0 comment-action mr-auto"})
    if (!reply) {
        commentactions
                .append($("<a />", {
                    href: "#",
                    class: "show-hide-reply",
                    "data-id": data.voice_id,
                    "data-comment_id": data.comment_id,
                    "data-reply_id": data.comment_reply_id
                })
                        .append($('<small />', {
                            class: ""
                        })
                                .html("Reply")))
    }
    if (uid == data.user_id) {
        if (!reply) {
            commentactions.append($("<span />")
                    .html("&nbsp;&nbsp;&#9679;&nbsp;&nbsp;"))

        }
        commentactions
                .append($("<a />", {
                    href: "#",
                    class: reply ? "edit-comment-reply" : "edit-comment",
                    "data-id": data.voice_id,
                    "data-comment_id": data.comment_id,
                    "data-reply_id": data.comment_reply_id
                })
                        .append($('<small />', {
                            class: ""
                        })
                                .html("Edit")))
                .append($("<span />")
                        .html("&nbsp;&nbsp;&#9679;&nbsp;&nbsp;"))
                .append($("<a />", {
                    href: "#",
                    class: reply ? "reply-delete" : "comment-delete",
                    "data-id": data.voice_id,
                    "data-comment_id": data.comment_id,
                    "data-reply_id": data.comment_reply_id
                })
                        .append($('<small />')
                                .html("Delete")))


    }

    var totalreplies = $("<p />", {
        class: "m-0 comment-action ml-auto"
    })
            .append($("<small />", {
                class: "text-black-50"
            })
                    .html(data.total_replies + (data.total_replies == 1 ? " Reply" : " Replies")));

    commentactioncont.append(commentactions)

    if (!reply) {
        commentactioncont.append(totalreplies);
    }

    var row = $("<div />", {
        class: reply ?
                "row reply_num_" + data.comment_reply_id :
                "row comment mb-3 comment_num_" + data.comment_id
    });
    var cont = $('<div />', {
        class: reply ?
                "col-10 col-md-11 pt-0 comment-reply-text-holder" :
                "col-10 col-md-11 pt-0 comment-text-holder"
    })

    var img = $("<div />", {
        class: " col-md-1 col-2 p-2  d-flex"
    })
            .append($("<div />", {
                class: "userimg position-relative",
                "data-line": data.alias[0]
            })
                    .css("background-color", getrandomcolor()))

    var alias = $("<h6 />", {
        class: "font-weight-bold mb-2 pt-2 text-capitalize"
    })
            .html(data.alias);

    var replydesc = $("<p />", {
        class: reply ? "maincolor mb-2 font-weight-300" : "p-comment maincolor mb-2 font-weight-300"
    })
            .html(reply ? data.comment_reply : data.comment)

    var editholder = makereplybox(data, reply);

    var replyboxholder = $("<div />", {
        class: "col-10 col-md-11 offset-md-1 offset-2 mb-3 d-none reply-container_" + data.comment_id
    })
            .append($("<div />", {
                class: "row"
            })
                    .append(makereplybox(data, false, true)))

            .append($("<div />", {class: "comment-reply-list"}));


    cont.append(alias)
            .append(replydesc)
            .append(editholder)
            .append(commentactioncont)
    row.append(img).append(cont);
    if (!reply)
        row.append(replyboxholder);

    return row;



}

function makereplybox(data, reply = false, replybox = false) {

    var rowclass = "edit_comment_box_holder d-none input-group";
    var submitclass = "post-edit-comment";
    var textareaclass = "cust-textarea edit-comment-text form-control"

    if (reply)
    {
        rowclass = "edit_comment_reply_box_holder d-none input-group";
        submitclass = "post-edit-comment-reply";
        textareaclass = "cust-textarea edit-comment-reply-text form-control"
    }
    if (replybox)
    {
        rowclass = "col pt-2 comment-reply-box-holder input-group";
        submitclass = "post-comment-reply";
        textareaclass = "cust-textarea comment-reply-text form-control"
    }


    var row = $("<div />", {
        class: rowclass
    })

    row.append($("<textarea />", {
        class: textareaclass,
        placeholder: "Write Reply"
    }))
            .append($("<div />", {
                class: "input-group-append"
            })
                    .append($("<a />", {
                        href: "#",
                        class: submitclass,
                        "data-id": data.voice_id,
                        "data-comment_id": data.comment_id,
                        "data-reply_id": data.comment_reply_id
                    }).append($("<span />", {
                        class: "d-block sendicon"
                    })
                            .html('<svg viewBox="0 0 20 20"><path fill="rgb(255, 255, 255)" d="M0.000,18.000 L22.000,9.000 L0.000,0.000 L0.000,7.000 L15.714,9.000 L0.000,11.000 L0.000,18.000 Z"/></svg>'))))
            .append($("<p />", {
                class: replybox ? "error comment-error mb-0 ml-1 text-danger" : "error edit-comment-reply-error mb-0 ml-1 text-danger"
            }))
    return row;


}


/* Like Unlike Voice */
var callback_voice_like = function (e) {
    if (uid == 0) {
        window.location.assign(base_url + "Login?section=voicedetail&vid=" + predictionid);
        return false;
    }
    e.preventDefault();
    var _this = $(this);
    var is_user_like = $(this).attr("data-is_user_liked");
    var voice_id = $(this).attr("data-id");

    $.ajax({
        url: base_url + "YourVoice/like_unlike_voice",
        method: "POST",
        data: {voice_id: voice_id, is_user_like: is_user_like}
    }).done(function (result) {
        result = JSON.parse(result);
        if (result.status) {
            var user_like_status = (is_user_like == "0") ? "1" : "0";
            _this.attr("data-is_user_liked", user_like_status);
            /*Change thumb icon color */
            if (is_user_like == "0") {
                $(".voice-like").find("small").addClass('text-primary').removeClass("text-black-50");
                $(".voice-like").find("svg").attr('fill', "#007bff");

            } else {
                $(".voice-like").find("small").removeClass('text-primary').addClass("text-black-50");
                $(".voice-like").find("svg").attr('fill', "#7d7c8b")
            }
            $("#bloglikecomment .total-likes-count").html(result.data.total_likes);
            //$("#comentbox .total-comments-count").html();
        }
    });
}


/* Comment Delete */


var callback_delete_voice_comment = function (e) {
    e.preventDefault();
    var _this = $(this);
    var voice_id = $(this).attr("data-id");
    var comment_id = $(this).attr("data-comment_id");
    var total_comments = parseInt($("#comentbox .total-comments-count").html());
    $.ajax({
        url: base_url + "YourVoice/delete_voice_comment",
        method: "POST",
        data: {voice_id: voice_id, comment_id: comment_id}
    }).done(function (result) {
        result = JSON.parse(result);
        if (result.status) {
            _this.closest(".row.comment_num_" + comment_id).slideUp("slow", function () {});
            $("#comentbox .total-comments-count").html(total_comments - 1); //decrease total count from 1
        }
    });
}


/* Comment reply Delete */
var callback_delete_comment_reply = function (e) {
    e.preventDefault();
    var _this = $(this);
    var voice_id = $(this).attr("data-id");
    var comment_id = $(this).attr("data-comment_id");
    var comment_reply_id = $(this).attr("data-reply_id");
    $.ajax({
        url: base_url + "YourVoice/delete_voice_comment_reply",
        method: "POST",
        data: {voice_id: voice_id, comment_id: comment_id, comment_reply_id: comment_reply_id}
    }).done(function (result) {
        result = JSON.parse(result);
        if (result.status) {
            _this.closest(".row.reply_num_" + comment_reply_id).slideUp("slow", function () {});
        }
    });
}



var view_more_comments = function (e) {
    e.preventDefault();
    if (uid == 0) {
        window.location.assign(base_url + "Login?section=voicedetail&vid=" + predictionid);
        return false;
    }
    var _this = $(this);
    var voice_id = _this.attr("data-id");
    var offset = (_this.attr("data-offset") == 0) ? 2 : _this.attr("data-offset");
    var comment_html = '';
    $.ajax({
        url: base_url + "YourVoice/view_more_comments",
        method: "POST",
        data: {voice_id: voice_id, offset: offset}
    }).done(function (result) {
        result = JSON.parse(result);
        console.log(result);
        var new_offset = parseInt(result['data'].length) + parseInt(offset);
        console.log(new_offset);
        var reply_html = $(document.createDocumentFragment());
        for (var i in result['data']) {

            var data = [];
            data.comment_id = result['data'][i].id;
            data.alias = result['data'][i].alias;
            data.comment = result['data'][i].comment;
            data.user_id = result['data'][i].user_id;
            data.voice_id = voice_id;
            data.total_replies = result['data'][i].total_replies;

            reply_html.append(generatecommentbox(data));


        }

        _this.closest(".comment_container").find(".comments-list").append(reply_html);
        _this.attr("data-offset", new_offset);
        if (result['is_available'] == "1") {
            _this.closest(".row").show();
        } else {
            _this.closest(".row").hide();
        }
    });
}

var view_more_replies = function (e) {
    if (uid == 0) {
        window.location.assign(base_url + "Login?section=voicedetail&vid=" + predictionid);
        return false;
    }
    e.preventDefault();
    var _this = $(this);
    var voice_id = _this.attr("data-id");
    var comment_id = _this.attr("data-comment_id");
    var offset = parseInt(_this.attr("data-offset"));

    var reply_html = $(document.createDocumentFragment());
    var edit_comment = '';
    var view_more_replies_html = '';
    $.ajax({
        url: base_url + "YourVoice/get_comment_replies",
        method: "POST",
        data: {voice_id: voice_id, comment_id: comment_id, offset: offset}
    }).done(function (result) {
        result = JSON.parse(result);
        for (var r in result['data']) {
            var data = [];
            data.comment_reply_id = result['data'][r].id;
            data.comment_id = result['data'][r].comment_id;
            data.alias = result['data'][r].alias;
            data.comment_reply = result['data'][r].reply;
            data.user_id = result['data'][r].user_id;
            data.voice_id = voice_id;
            reply_html.append(generatecommentbox(data, true));
        }


        _this.closest(".comment_container").find(".reply-container_" + comment_id + " .comment-reply-list").append(reply_html);
        if (result['is_available'] == "1") {
            var newoffset = offset + 5;
            view_more_replies_html = '<div class="row">\
                                            <div class="col-12 pt-1 text-right">\
                                                <a href="#" class="a-nostyle view-more-replies" data-id="' + voice_id + '" data-comment_id="' + comment_id + '" data-offset="' + newoffset + '"><small>View more replies</small></a>\
                                            </div>\
                                        </div>';

            _this.closest(".comment_container").find(".reply-container_" + comment_id).append(view_more_replies_html);

            _this.closest(".row").remove();
        } else {
            _this.closest(".comment_container").find(".reply-container_" + comment_id + " .view-more-replies").closest(".row").hide();
        }
    });
}


function convert_numbers(value) {
    if (isNaN(value))
        return 0;
    var newvalue = value;
    var suffixNum = '';
    if (value >= 1000) {
        suffixNum = ("" + value).length;
        if (suffixNum == 4 || suffixNum == 5 || suffixNum == 6) {
            newvalue = Math.floor(value / 1000) + "K";
        }
        if (suffixNum >= 7) {
            newvalue = Math.floor(value / 1000000) + "M";
        }
    }
    return newvalue;
}
function getrandomcolor() {
    var colors = [
        "#1abc9c",
        "#2ecc71",
        "#3498db",
        "#9b59b6",
        "#e67e22",
        "#e74c3c",
        "#d35400",
        "#f1c40f",
        "#2c3e50",
        "#16a085",
        "#34495e",
        "#2980b9",
        "#12CBC4",
        "#EE5A24",
        "#009432",
        "#ED4C67",
        "#FFC312",
        "#5758BB"
    ]

    return colors[Math.floor(Math.random() * colors.length)];
}

/*Slug creation for blog */
function create_slug(string) {
    var slug_string = '';
    slug_string = string.replace(/[~`!@#$%^&*()_=+{}|\/;'<>?,]/g, ''); //remove special characters from slug
    slug_string = slug_string.split(' ').join('-'); //creating slug

    return slug_string;
}


function load_questions(offset) {
    $.ajax({
        url: base_url + "AskQuestions/lists",
        method: "POST",
        data: {offset: offset, notin: 0}
    }).done(function (result) {
        result = JSON.parse(result);
        var data = result['data'];
        var spacer = $('<div />', {class: 'w-100'})
        var ad = $('<div />', {class: 'adimg col-12 mt-3'})
                .append($("<a />", {class: "d-block", href: "http://www.loudst.com/", target: "_blank"})
                        .append($("<img />", {src: img_cdn_url + "images/special/samsung.jpg", class: "img-fluid "})))

        var html = $(".blog-list-section .blog-list");
        if (data.length > 0) {

            if (offset < 1 && $('.blog-list-page').length == 1)
            {
                var first = data.splice(0, 1)[0];
                $(".most-popular")
                        .append($('<div >', {class: 'row'})
                                .append(getblock(first, true)));
            }
            for (var i in data) {
                html.append(getblock(data[i], false));
            }
            $(".blog-detail-trending .blog-list").width($('.blog-detail-trending .blog-list-item').length * $(".blog-detail-trending .blog-list-item").outerWidth() + 100)
//show hide load-more-voice-list button
            if (result['is_available'] == "1") {
                $(".load-more-voice-list").closest('.load-btn-holder').removeClass('hide');
            } else {
                $(".load-more-voice-list").closest('.load-btn-holder').addClass('hide');
            }
        }


        $(".blog-list .adimg").remove();
        $(".blog-list .blog-list-item").each(function (a, b) {
            if ((a % 9 == 0 || a == 3) && a > 0 && $('.blog-list-page').length > 0)
            {
                ad.clone().insertBefore(b)
            }
        })
        if (flag) {
            $(".load-more-voice-list").trigger('click')
            flag = !flag
        }
    });
}

function getblock(data, top = false) {

    var total_likes = convert_numbers(data.total_likes);
    var total_views = convert_numbers(data.total_views);
    var total_comments = convert_numbers(data.total_comments);
    var slug = create_slug(data.title);
    var overlay = $('<div />', {class: "overlay"});
    var div = $("<div />", {class: top ? "col-12 top-blog pt-3 blog-list-item my-1" : "col-md-4 blog-list-item"})
    var a = $("<a/>", {
        href: base_url + 'AskQuestions/details/' + data.id + '/' + slug,
        class: "d-block pb-3",
        "data-content": "Most Popular Prediction",
        style: top ? "background: url('" + data.image + "') no-repeat center center;" : ""
    })

    var blogimg = $("<div />", {
        class: "voiceimg p-5",
        style: "background: url('" + data.image + "')  no-repeat center center;"
    });
    var likes = $("<small />", {class: "likes"}).html(total_likes + " Likes &nbsp;&nbsp;&#9679;&nbsp;&nbsp; " + total_views + " Views &nbsp;&nbsp;&#9679;&nbsp;&nbsp; " + total_comments + " Comments")
    var category = $("<small />", {class: "category"}).html(data.category);
    var title = $('<h6 />').html(data.title);
    var segment = $("<div />", {class: "d-flex flex-column h-100 w-100 justify-content-end"});
    if (!top) {
        a
                .append(blogimg)
                .append(category)
                .append(title)
                .append(likes)

    } else {
        a
                .append(overlay)
                .append(segment
                        .append(category)
                        .append(title)
                        .append(likes)
                        );
    }

    div.append(a);
    return div;
}

var load_articles = function (offset) {
    $.ajax({
        url: base_url + "YourVoice/load_articles",
        method: "POST",
        data: {offset: offset}
    }).done(function (result) {
        result = JSON.parse(result);
        var data = result['data'];
        var html = $("<div />", {class: 'row px-3'});
        if (data.length > 0) {
            for (var i in data) {

                var div = getblock(data[i], false);
                html.append(div);
            }

            $(".article-list").html(html);
        } else {
            $(".article-list").html('<div class="row">\
                    <div class="col s11 m11 l11 offset-s1 offset-m1 offset-l1 text-center">\
                        <img src="' + base_url + 'images/infographics/3.png" style="width: 50%;">\
                        <h5 class="fs16px fieldtitle ">No articles raised yet</h5>\
                    </div>\
                </div>');
        }
    });
}

var load_latest_voices = function (offset) {

    $.ajax({
        url: base_url + "YourVoice/load_latest_voices",
        method: "POST",
        data: {offset: offset, predictionid: predictionid}
    }).done(function (result) {
        result = JSON.parse(result);

        var html = '';
        var slug = '';

        if (result['data'].length > 0) {
            for (var i in result['data']) {
                slug = create_slug(result['data'][i].title);

                html += '<div class="col-md-4 blog-list-item">\
                                <a href="' + base_url + 'YourVoice/blog_detail/' + result['data'][i].id + '/' + slug + '?t=' + timestamp + '" class="d-block pb-3" style="">\
                                    <div class="voiceimg p-5" style="background: url(' + base_url + 'images/blogs/' + result['data'][i].image + ') no-repeat center center;"></div>\
                                    <small class="category">' + result['data'][i].category + '</small>\
                                    <h6>' + result['data'][i].title + '</h6>\
                                    <small class="likes">' + result['data'][i].total_likes + ' Likes &nbsp;&nbsp;???&nbsp;&nbsp; ' + result['data'][i].total_views + ' Views</small>\
                                </a>\
                            </div>';
            }

            $(".blog-list").html(html);//latest-voices-list
        }
    });
}

/* Users answered predictions List */
function load_answered_predictions(offset) {
    $.ajax({
        url: base_url + "Predictions/answered_predictions",
        method: "POST",
        data: {offset: offset}
    }).done(function (result) {
        result = JSON.parse(result);
        console.log(result);
    });
}