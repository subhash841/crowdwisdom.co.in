<footer class="container-fluid p-0 footer-bg">
    <div class="container ">
        <div class="row text-center py-4   ">
            <div class="col-md-4  ">
                <img src="<?= base_url() . 'images/headerlogo/logo-white-vertical-500.png'; ?>" style="width: 55%"/>
                <p class="d-block  mt-3 footer-about footer-font">
                    CrowdWisdom is an innovative question based crowdsourcing platform. The Platform is designed to make decisions in your life easier by accessing the best experts in India and around the world
                </p>
            </div>
            <div class="col-md-4 text-white ">
                <h5 class="footertag">Contact Us</h5>
                <div class="mt-3">
                    <a href="mailto:support@crowdwisdom.co.in" class="a-nohoverstyle nostyle border-right pr-1 footer-font">support@crowdwisdom.co.in</a>
                    <a href="tel:+919930008402" class="a-nohoverstyle nostyle pl-1  footer-font">9930 008 402</a>
                    <!--<p class="mt-3 footer-font">M/s. SC Polling Insights and Consultancy Services LLP B-2205 Lake Homes Phases 3, Powai, Mumbai-400076</p>-->
                </div>
            </div>
            <div class="col-md-4 text-white ">
                <h5 class=" footertag ">Share With Us</h5>
                <p class="mt-3">
                    <i class="fa fa-facebook mx-2 fb-bg"></i>
                    <i class="fa fa-twitter mx-2 twitter-bg"></i>
                    <i class="fa fa-whatsapp mx-2 whatsapp-bg"></i>
                    <i class="fa fa-linkedin mx-2 linkdin-bg"></i>
                </p>
            </div>

        </div>
    </div>
    <div class="container-fluid text-center border-top-0" id="subfooter">
        <div class="container">
            <p class="m-0 py-2 footer-font text-right">
                Copyright &copy; 2018 crowd wisdom All Rights Reserved
            </p>
        </div>

    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>js/home_search.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111765819-1"></script>
<script>
        $('.icon-holder').click(function () {
            if ($('#mobile-search').hasClass('show')) {
                $(this).html('<i class="fa fa-search text-white"></i>');
                $('#mobile-search').removeClass('show').addClass('d-none');
                $('.m-img').removeClass('d-none');
            } else {
                $(this).html('<i class="fa fa-times text-white"></i>');
                $('#mobile-search').addClass('show').removeClass('d-none');
                $('.cust-search').focus();
                $('.m-img').addClass('d-none');
            }
        });
</script>
<script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-111765819-1');
</script>

</body>
</html>