<div class="container">
    <div class="row my-3 py-5 bg-white text-center align-items-center">
        <div class="col-md-4">
            <!--<img src="<?= base_url( "images/package_info/LS.png" ) ?>" class="img-fluid height200" alt='img'>-->
            <img src="<?= @$data[ 'package_info' ][ 0 ][ 'image' ] ?>" class="img-fluid" width="220" alt='img'>
            <h5 class="font-weight-500 mb-0 mt-2">End Date: <?= date( "d-m-Y", strtotime( @$data[ 'package_info' ][ 0 ][ 'end_date' ] ) ) ?></h5>
        </div>
        <div class="col-md-4 mb-5 mt-3">
            <div class="col position-relative d-flex align-items-center justify-content-center height80">
                <h5 class="font-weight-500 mb-0"><?= @$data[ 'question_count' ] ?></h5>
                <img src="<?= base_url( "/images/icons/v2.svg?v=1" ) ?>" class="position-absolute top-0 height80 " style="">
            </div>
            <h5 class="my-3 font-weight-400">No of Question</h5>
            <h5 class="mb-4 font-weight-500"><!--&#x20b9;--> <?= @$data[ 'package_info' ][ 0 ][ 'price' ] ?> <small>Points</small></h5>
            <a href="#" data-toggle="modal" data-target="#silverPointsCheck" data-pkg="<?= @$data[ 'package_info' ][ 0 ][ 'id' ] ?>" data-price="<?= @$data[ 'package_info' ][ 0 ][ 'price' ] ?>" class="rounded-semi btn btn-primary shadow mx-auto">Pay Now</a><!--href="<?= base_url() ?>Packages/purchase_package/<?= @$data[ 'package_info' ][ 0 ][ 'id' ] ?>"-->
        </div>
        <div class="col-md-4">
            <h5 class="font-weight-500 d-inline-block cust-border-bottom pb-1">&nbsp;Rewards&nbsp;</h5>
            <img src="<?= base_url( "images/package_info/Trophy.png" ) ?>" alt="img" class="img-fluid d-block mx-auto height200">
            <h5 class="font-weight-500"><?= @$data[ 'package_info' ][ 0 ][ 'reward_text' ] ?></h5>
        </div>
        <?php
        $share_url = urlencode( base_url() . ltrim( $_SERVER[ 'REQUEST_URI' ], '/' ) );
        $title = @$data[ 'package_info' ][ 0 ][ 'name' ];
        ?>
        <div class="col-lg-5 col-12 mx-auto mt-2">
            <div class="row justify-content-md-end justify-content-center">
                <a class="d-flex align-items-center bg-facebook text-white rounded cust-btn btn col mx-1" href="http://www.facebook.com/sharer/sharer.php?u=<?= $share_url ?>" target="_blank">
                    <i class="fa mx-1 fa-facebook"></i>
                    <h6 class="mb-0 w-100">Share</h6>
                </a>
                <a class="d-flex align-items-center bg-twitter text-white rounded cust-btn btn col mx-1" href="https://twitter.com/intent/tweet?url=<?= $share_url ?>&text='<?= urlencode( $title ) ?>'&ael;hashtags=Crowdwisdom" target="_blank">
                    <i class="fa mx-1 fa-twitter"></i>
                    <h6 class="mb-0 w-100">Tweet</h6>
                </a>
                <a class="d-flex bg-linkdein align-items-center text-white rounded cust-btn btn col mx-1" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $share_url ?>&title=<?= urlencode( $title ) ?>" target="_blank">
                    <i class="fa mx-1 fa-linkedin"></i>
                    <h6 class="mb-0 w-100">Share</h6>
                </a>
                <a class="d-flex bg-whatsapp align-items-center text-white rounded cust-btn btn col mx-1" href="https://wa.me/?text=<?= $share_url ?>" target="_blank">
                    <i class="fa mx-1 fa-whatsapp"></i>
                    <h6 class="mb-0 w-100">Share</h6>
                </a>
            </div>
        </div>
    </div>
    <div class="row mb-3 package-holder text-center py-5 bg-white">
        <div class="col-md-12 col-12">
            <h5 class="font-weight-500 d-inline-block cust-border-bottom pb-1">&nbsp;Rules&nbsp;</h5>
        </div>
        <div class="col-md-3 col-6">
            <img src="<?= base_url( "images/package_info/16.png" ) ?>" alt="img" class="img-fluid my-4">
            <h5 class="font-weight-400">Closest to the result</h5>
        </div>
        <div class="col-md-3 col-6">
            <img src="<?= base_url( "images/package_info/17.png" ) ?>" alt="img" class="img-fluid my-4">
            <h5 class="font-weight-400"><?= @$data[ 'package_info' ][ 0 ][ 'prize_text' ] ?></h5>
        </div>
        <div class="col-md-3 col-6">
            <img src="<?= base_url( "images/package_info/18.png" ) ?>" alt="img" class="img-fluid my-4">
            <h5 class="font-weight-400">You can change your prediction often</h5>
        </div>
        <div class="col-md-3 col-6">
            <img src="<?= base_url( "images/package_info/19.png" ) ?>" alt="img" class="img-fluid my-4">
            <h5 class="font-weight-400"><?= @$data[ 'package_info' ][ 0 ][ 'point_required_text' ] ?></h5>
        </div>
    </div>
</div>

<div class="modal fade" id="silverPointsCheck" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm rounded">
        <!-- Modal content-->
        <div class="modal-content  border-0">
            <div class="modal-header  border-0 text-center">
                <h5 class="modal-title text-center w-100 font-weight-500">Play</h5>
            </div>
            <div class="modal-body text-center  border-0">
                <p>You will require <b class="spp"></b> Silver Points to Play this Pack.</p>
                <p class="m-0 err alert alert-danger fade"></p>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn btn-secondary rounded-btn cancel" data-dismiss="modal">Cancel</button>
                <a href="<?= base_url( "Packages/purchase_package/" ) ?>" class="btn btn-primary rounded-btn play">Play</a>
            </div>

        </div>
    </div>
</div>
<script>
        $(function () {
            var uid = $("body").attr("data-uid");

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
            });
        });
</script>