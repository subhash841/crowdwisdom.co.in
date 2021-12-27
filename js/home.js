/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function () {

   



    var timestamp = new Date().getTime();
    var checkmark = '<?xml version="1.0" encoding="iso-8859-1"?><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><path d="M504.502,75.496c-9.997-9.998-26.205-9.998-36.204,0L161.594,382.203L43.702,264.311c-9.997-9.998-26.205-9.997-36.204,0    c-9.998,9.997-9.998,26.205,0,36.203l135.994,135.992c9.994,9.997,26.214,9.99,36.204,0L504.502,111.7    C514.5,101.703,514.499,85.494,504.502,75.496z" fill="#D80027"/></svg>';
    checkmark = "&times;";

    $(document).on("click", ".goto", function (e) {
        e.preventDefault();
        var _this = $(this);
        var type = _this.attr('data-type').toLowerCase();
        var id = _this.attr('data-id');
        if (type == "prediction") {
            location.assign("/Predictions/details/" + id);
        }
    });

    /*Redirect to package info*/
    $(document).on("click", ".gotopackage", function (e) {
        e.preventDefault();
        var _this = $(this);
        var id = _this.attr('data-pkg');
        location.assign("Packages/package_info/" + id);
    });

    $(document).on("click", ".topics .carousel-control-prev", function (e) {
        e.preventDefault();
        if ($(".topic-item").length > 1)
            $(".topic-cont").animate({scrollLeft: $(".topic-cont").scrollLeft() - 170}, {duration: 100, queue: false});

    })
    $(document).on("click", ".topics .carousel-control-next", function (e) {
        e.preventDefault();
        if ($(".topic-item").length > 1)
            $(".topic-cont").animate({scrollLeft: $(".topic-cont").scrollLeft() + 170}, {duration: 100, queue: false});

    })

    $(document).on("click", ".package-holder .carousel-control-prev", function (e) {
        e.preventDefault();
        if ($(".package-item").length > 1)
            $(".package-cont").animate({scrollLeft: $(".package-cont").scrollLeft() - 170}, {duration: 100, queue: false});

    })
    $(document).on("click", ".package-holder .carousel-control-next", function (e) {
        e.preventDefault();
        if ($(".package-item").length > 1)
            $(".package-cont").animate({scrollLeft: $(".package-cont").scrollLeft() + 170}, {duration: 100, queue: false});

    })
    $(document).on("click", ".topics .followme", function (e) {
        e.preventDefault();
        var _this = $(this);
        $.post(base_url + "Index/follow_topic", {topic_id: $(this).attr("data-topic"), is_follow: $(this).attr("data-follow")}).done(function (d) {
            _this.attr("data-follow", !d.is_follow)

            if (d.status) {
                if (d.is_follow)
                    _this.removeClass("btn-outline-danger").addClass("btn-danger").html("Following")
                else
                    _this.removeClass("btn-danger").addClass("btn-outline-danger").html("+ Follow")
            } else {
                window.location.assign("Login?section=home");
            }
        });
    })

    $(document).on("click", ".follow-btn", function (e) {
        e.preventDefault();
        var _this = $(this);
        var value = '';
        if (_this.attr("data-follow") == 'true') {
            value = 'false';
        } else {
            value = 'true';
        }
        $.post(base_url + "Index/follow_topic", {topic_id: _this.attr("data-topic"), is_follow: value}).
                done(function (d) {
                    if (d.status) {
                        if (d.is_follow) {
                            _this.attr('data-follow', 'true');
                            _this.html('&#x2714; &nbsp;FOLLOWING');
                        } else {
                            _this.attr('data-follow', 'false');
                            _this.html('+&nbsp;FOLLOW');
                        }
                    } else {
                        window.location.assign(base_url + "Login?section=home");
                    }
                });
    })

    $("#silverPointsCheck").on("show.bs.modal", function (e) {
        if (uid == 0) {
            window.location.assign("/Login");
        }
        var btn = $(e.relatedTarget);
        var id = btn.attr("data-pkg");
        $('#silverPointsCheck .err').html("").removeClass("show");
        $("#silverPointsCheck .play").removeClass("disabled");
        $("#silverPointsCheck .play").attr("href", base_url + "Packages/purchase_package/" + id);
        $("#silverPointsCheck .spp").html(btn.attr("data-price"));
        if (parseInt(btn.attr("data-price")) > parseInt($("body").attr("data-silver_points")))
        {
            $('#silverPointsCheck .err').html("You do not have sufficient Silver Points").addClass("show");
            $("#silverPointsCheck .play").addClass("disabled");
        }
    })

    get_trending_rated_articles();
    get_topic_list();

    function get_topic_list() {
        $.post(base_url + "Index/topic_list").done(function (d) {
            var cont = $(".topic-list");

            var dups = [];
            d.data = d.data.filter(function (el) {
                // If it is not a duplicate, return true
                if (dups.indexOf(el.id) == -1) {
                    dups.push(el.id);
                    return true;
                }

                return false;

            });
            if (d.data.length > 0)
                $(".topics").removeClass("d-none").addClass("show");
            $.each(d.data, function (a, b) {
                cont.append(gettopic(b));
            })
            cont.css("width", (d.data.length + 1) * $(".topic-item").first().outerWidth())

        });
    }

    function get_trending_rated_articles() {
        $.post(base_url + "Index/get_trending_rated_articles", {topic_id: topic_id}).done(function (data) {

            var html = $(".ratedart");
            if (data.length > 0) {
                $(".ratedblock").removeClass("d-none")
                var first = data.splice(0, 1)[0];
                $(".most-popular")
                        .append($('<div >', {class: 'row'})
                                .append(getblock(first, true)));

                for (var i in data) {
                    html.append(getblock(data[i]));
                }
            }
            if (screen.width > 768)
                $(".most-popular .voiceimg").css("height", $(".ratedart").height() - 92)
        });
    }
    function gettopic(data) {
        var btn;
        if (data.is_follow == "0")
            btn = $("<button />", {class: "btn btn-outline-danger rounded-btn followme z-depth-2", "data-topic": data.id, "data-follow": !data.is_follow}).html("+ Follow")
        else
            btn = $("<button />", {class: "btn btn-danger rounded-btn followme z-depth-2", "data-topic": data.id, "data-follow": !data.is_follow}).html("Following")
        var div = $("<div />", {class: "col-sm-2 col-6 blog-list-item pt-3 topic-item text-center wide-list-item"})
                .append($("<div />", {class: "bg-w-block rounded pb-3 step1"})
                        .append($('<a href=' + base_url + 'HotTopics/detail/' + data.id + ' />')
                                .append($("<div />", {
                                    class: "voiceimg p-5 step2 inside of step1",
                                    style: "background: url('" + data.image + "')  no-repeat center center;"}))
                                .append($('<h6 />', {class: "pl-1 step inside of step1"}).html(data.topic)))

                        .append($("<small />")
                                .append(""))) //btn
        return div;



    }

    function getblock(data, top = false) {
        var total_votes = convert_numbers(data.total_votes);
        var total_views = convert_numbers(data.total_views);
        var total_comments = convert_numbers(data.total_comments);
        var slug = create_slug(data.question);
        var overlay = $('<div />', {class: "overlay"});
        var yt = false;
        if (data.data)
            if (data.data.hasOwnProperty("img"))
                yt = (data.data.img.indexOf("ytimg") != -1);

        var div = $("<div />", {class: top ? "col-12 blog-list-item" : "col-12 blog-list-item p-md-0 pl-md-1"})
        var a = $("<a/>", {
            href: base_url + 'FromTheWeb/detail/' + data.id + '/' + slug, // + '?t=' + timestamp
            class: "d-block pb-3"
        })
        if (top && yt)
            var blogimg = $("<div />", {class: "rounded overflow-hidden embed-responsive "}).append($("<iframe />", {
                class: "w-100 voiceimg",
                src: "https://www.youtube.com/embed/" + getytid(data.data.link) + "?color=white&controls=0&modestbranding=1&rel=0",
                frameborder: "0",
                allow: "autoplay; encrypted-media",
                allowfullscreen: true,
                style: "background: url('" + data.image + "')  no-repeat center center; min-height: 511px;"
            }));
        else
            var blogimg = $("<div />", {
                class: "voiceimg",
                style: "background: url('" + data.image + "')  no-repeat center center;"
            });

        if (yt)
            blogimg.addClass("vid");

// &nbsp;&nbsp;&#9679;&nbsp;&nbsp; " + total_views + " Views
        var likes = $("<small />", {class: "likes pl-1"}).html(total_votes + " Votes &nbsp;&nbsp;&#9679;&nbsp;&nbsp; " + total_comments + " Comments")
        var category = $("<small />", {class: "category"}).html(data.category);
        var title = $('<h6 />', {class: "pl-1"}).html(data.question);

        a
                .append(blogimg)
                .append(category)
                .append(title)
                .append(likes)

        div.append(a);
        return div;
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

    /*Slug creation for blog */
    function create_slug(string) {
        var slug_string = '';
        slug_string = string.replace(/[~`!@#$%^&*()_=+{}|\/;'<>?,\n]/g, ''); //remove special characters from slug
        slug_string = slug_string.split(' ').join('-'); //creating slug

        return slug_string;
    }

    var touchStartX = null;

    $('.carousel').each(function () {
        var _carousel = $(this);
        $(this).on('touchstart', function (event) {
            var e = event.originalEvent;
            if (e.touches.length == 1) {
                var _touch = e.touches[0];
                touchStartX = _touch.pageX;
            }
        }).on('touchmove', function (event) {
            var e = event.originalEvent;
            if (touchStartX != null) {
                var touchCurrentX = e.changedTouches[0].pageX;
                if ((touchCurrentX - touchStartX) > 60) {
                    touchStartX = null;
                    _carousel.carousel('prev');
                } else if ((touchStartX - touchCurrentX) > 60) {
                    touchStartX = null;
                    _carousel.carousel('next');
                }
            }
        }).on('touchend', function () {
            touchStartX = null;
        });
    });

    function getytid(url) {
        var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
        if (videoid != null)
            return videoid[1];
        else
            return false;
    }

    get_packages();
    function get_packages() {
        $.get(base_url + 'Packages/lists').done(function (e) {
            if (e.data.length > 0) {
                $(".package-holder").removeClass("d-none");
                $.each(e.data, function (key, value) {
                    $('.packages')
                            .append($('<div/>', {class: "col-sm-4 col-6 package-item"}) //wide-list-item
                                    .append($("<div />", {class: " bg-w-block "})
                                            .append($("<div/>", {class: "holder", style: "background-image:url(" + value.image + ")"}))
                                            .append($("<div/>", {class: "text-center py-3 px-1"})
                                                    .append($('<p />').html(value.name))
                                                    .append($('<button />', {class: "rounded-btn btn btn-primary gotopackage", "data-pkg": value.id, "data-price": parseInt(value.price)}).html("Play Now")))));//"data-toggle": "modal", "data-target": "#silverPointsCheck", 
                });
            }

            $('.packages').css("width", (e.data.length + 1) * $(".package-item").first().outerWidth())
        });
    }
    
    $(document).on("click", ".join-btn", function (e) {
        e.preventDefault();
        var _this = $(this);
        var value = '';
        if (_this.attr("data-join") == 'true') {
            value = 'false';
        } else {
            value = 'true';
        }
        $.post(base_url + "Index/join_topic", {topic_id: _this.attr("data-topic"), is_join: value}).
                done(function (d) { 
                    if (d.status) {
                        if (d.is_join) {
                            _this.attr('data-join', 'true');
                            _this.html('&#x2714; &nbsp;Joined');
                        } else {
                            _this.attr('data-join', 'false');
                            _this.html('+&nbsp;Join our community');
                        }
                    } else {
                        window.location.assign(base_url + "Login?section=home");
                    }
                });
    })
})