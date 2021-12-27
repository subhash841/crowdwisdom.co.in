<?php
if (!strstr($_SERVER['REQUEST_URI'], "Forum")) {
    echo '';
    //echo '<a href="'.base_url().'Forum" class="discussred show-on-small hide-on-med-and-up">Wisdom Forum</a>';
}
?>
<div class="row center-align footer-stripe show-on-small hide-on-med-and-up" style="z-index: 9999;">
    <a href="<?= base_url() ?>NewHome/prediction"><div class="col s3">Predictions</div></a>
    <a href="<?= base_url() ?>Survey"><div class="col s2">Ask</div></a>
    <a href="<?= base_url() ?>YourVoice"><div class="col s3">Your Voice</div></a>
    <a href="<?= base_url() ?>RatedArticle"><div class="col s4">Article Rater</div></a><!--Ad Ratingsstyle="display: flex;flex-direction: column;justify-content: center;line-height: 12px;"-->
    <!--<a href="<?= base_url() ?>Forum"><div class="col s4">WisdomForum</div></a>-->
</div>
<div class="white center" id="footer" style="min-height: 40vh;padding: 20px;max-height: 260px;">
    <div class="container">
        <img src="<?= base_url('images/logo/red-logo.png'); ?>" style="margin: 20px;width: 300px;" class="footer-logo" />
        <!--<h6 style="margin: 20px 0px;color:#b9c2d2;font-size: small;">Terms & Conditions | Privacy Policy</h6>-->
        <h6 style="margin: -35px 0px 50px 0;color: #232b3c ;font-size: 12px;">
            powered by <a href="https://www.sundaymobility.com/"  target="_blank" style="color:red;font-weight: bold;">Sunday Mobility</a>
        </h6>
        <label style="color:#b9c2d2">Copyright @ 2017 SC Polling Insights and consultancy services LLP</label>
    </div>
</div>


<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/init.js?v=1.6"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.Marquee/1.5.0/jquery.marquee.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.10/lodash.min.js" ></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js" ></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/progressbar.js/1.0.1/progressbar.min.js" ></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.min.js" ></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>


<?php
if (isset($_SESSION['data'])) {
    if ($_SESSION['data']['tnc_agree'] != "1") {
        ?><script>
            tncagree = <?= $_SESSION['data']['tnc_agree'] ?>;
            if (!tncagree) {
                window.location.assign('<?= base_url() ?>Login/logout');
                localStorage.clear();
            }

        </script>
        <?php
    }
}
?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111765819-1"></script>
<script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-111765819-1');
</script>

<!--<script>
    (function () {
        var cx = '017852666345807103864:9dcqjs_lqyc';
        var gcse = document.createElement('script');
        gcse.type = 'text/javascript';
        gcse.async = true;
        gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(gcse, s);
    })();
</script>
<gcse:search></gcse:search>-->
</body>
</html>
