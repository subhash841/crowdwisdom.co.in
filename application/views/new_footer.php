<?php
if (!strstr($_SERVER['REQUEST_URI'], "Forum")) {
    echo '';
    //echo '<a href="'.base_url().'Forum" class="discussred show-on-small hide-on-med-and-up">Wisdom Forum</a>';
}
?>
<div class="row center-align footer-stripe show-on-small hide-on-med-and-up">
    <a href="<?= base_url() ?>Blogs"><div class="col s4">Opinion</div></a>
    <a href="<?= base_url() ?>Forum"><div class="col s4">WisdomForum</div></a>
    <a href="<?= base_url() ?>"><div class="col s4">Predictions</div></a>
</div>
<div class="white center" id="footer" style="min-height: 40vh;padding: 20px;max-height: 260px;">
    <div class="container">
        <img src="<?= base_url('images/logo/red-logo.png'); ?>" style="margin: 20px;width: 300px;" class="footer-logo" />
        <h6 style="margin: -35px 0px 50px 0;color: #232b3c ;font-size: 12px;">
            powered by <a href="https://www.sundaymobility.com"  target="_blank" style="color:red;font-weight: bold;">Sunday Mobility</a>
        </h6>
        <label style="color:#b9c2d2">Copyright @ 2017 SC Polling Insights and consultancy services LLP</label>
    </div>
</div>

<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/materialize.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/slick/slick.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.matchHeight.js"></script>
<script src="<?php echo base_url(); ?>assets/jQueryCounter/js/jquery.countdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/jQueryCounter/js/lodash.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/dragndrop/dropzone.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/circleprogress/progressbar.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/Pagination/jquery.simplePagination.js" type="text/javascript"></script>

<script>
    $("html, body").animate({scrollTop: 0}, "slow");
    $(function () {
        //initialize materilize select
        $('select').material_select();

        //initialize slick slider
        $('#slickslider').slick({
            autoplay: true
            , autoplaySpeed: 10000
            , centerMode: true
            , slidesToShow: 4
            , slidesToScroll: 1
            , responsive: [
                {
                    breakpoint: 768
                    , settings: {
                        arrows: true
                        , centerMode: true
                        , centerPadding: '40px'
                        , slidesToShow: 1
                    }
                }
                , {
                    breakpoint: 480
                    , settings: {
                        arrows: true
                        , centerMode: true
                        , centerPadding: '40px'
                        , slidesToShow: 1
                    }
                }
                , {
                    breakpoint: 1024
                    , settings: {
                        arrows: true
                        , centerMode: true
                        , centerPadding: '40PX'
                        , slidesToShow: 2
                    }
                }, {
                    breakpoint: 1366
                    , settings: {
                        arrows: true
                        , centerMode: true
                        , centerPadding: '40PX'
                        , slidesToShow: 3
                    }
                }

            ]
        });
    });

    $(document).ready(function () {
        $('.equal-height').matchHeight();
        $('.equal-height-child').matchHeight();
    });
</script>

<script type="text/javascript">
    
    $('.progressforumcir').each(function (event) {
        var forumid = $(this).attr('data-formid');
        var data_per = $(this).attr('data-per');
        var type = $(this).attr('data-btntype');
        var tabname = $(this).attr('data-tabname');
        var percent = data_per;
        if (type == "like") {
            color = '#27ce71';
        } else if (type == "neutral") {
            color = '#00b6ff';
        } else {
            color = '#ff5f4e';
        }
        var bar = new ProgressBar.Circle("#contain" + type + "" + forumid + "" + tabname, {
            strokeWidth: 6,
            easing: 'easeInOut',
            duration: 1400,
            color: color,
            trailColor: '#eee',
            trailWidth: 6,
            svgStyle: null,
            text: {
                value: '<b class="blueblack-txt">' + percent + '%</b><h6 class="fs9px m-0">' + type + '</h6>',
                color: color,
                className: 'progressbar__label',
                autoStyle: true
            }
        });
        bar.animate(data_per / 100);
    });
    function onReady(callback) {
        //$('#forumdetailpage').css('opacity','0.4');
        var intervalId = window.setInterval(function () {
            if (document.getElementsByTagName('body')[0] !== undefined) {
                window.clearInterval(intervalId);
                callback.call(this);
            }
        }, 1000);
    }

    function setVisible(selector, visible) {
        if (selector == ".forumpages") {
            $('#forumdetailpage').css('opacity', '0.4');
        } else {
            $('#forumdetailpage').css('opacity', '1');
        }
        document.querySelector(selector).style.display = visible ? 'block' : 'none';
    }

    onReady(function () {
        setVisible('.forumpages', true);
        setVisible('.loadersmall', false);
    });
</script>

</body>
</html>
