<div class="container home-page data-container">
    <div class="row mt-3">
        <div class="col">
            <div class="blog-list-section bg-w-block py-4 d-block  ">
                <div class="row mx-3 my-2 title-hr">
                    <div class="col-md-4 pr-0 "><h4 class="pr-2 bg-white position-relative z-depth-2 d-inline">Trending <b>Competition</b></h4></div>
                    <hr class="z-depth-0 d-md-block d-none one">
                </div>
                <div class="row mx-3 my-2 package-holder">
                    <div class="col">
                        <a class="carousel-control-prev d-none d-md-flex z-depth-3 " href="#" role="button" data-slide="prev">
                            <span class="w-100 rounded-circle bg-ee p-2 d-inline-block">
                                <svg viewBox="0 0 200 200" class="w-100 p-1" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="rgb(164, 164, 164)" d="m143.02937,195.21212c1.433,1.341 3.222,2.012 5.189,2.012c1.968,0 3.758,-0.671 5.19,-2.012c2.861,-2.681 2.861,-7.039 0,-9.722l-91.25,-85.49l91.25,-85.49c2.861,-2.683 2.861,-7.041 0,-9.722c-2.865,-2.683 -7.515,-2.683 -10.379,0l-96.437,90.35c-2.862,2.683 -2.862,7.041 0,9.722l96.437,90.352z" id="svg_1"></path>
                                </svg>
                            </span>
                        </a>
                        <div class="package-cont wide-cont w-100">
                            <div class="row mx-3 my-2 packages-list wide-list">

                            </div>
                        </div>
                        <a class="carousel-control-next d-none d-md-flex z-depth-3" href="#" role="button" data-slide="next">

                            <span class="w-100 rounded-circle bg-ee p-2 d-inline-block">
                                <svg viewBox="0 0 200 200" class="w-100 p-1" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="rgb(164, 164, 164)" transform="rotate(-180 100,100) " d="m143.02937,195.21212c1.433,1.341 3.222,2.012 5.189,2.012c1.968,0 3.758,-0.671 5.19,-2.012c2.861,-2.681 2.861,-7.039 0,-9.722l-91.25,-85.49l91.25,-85.49c2.861,-2.683 2.861,-7.041 0,-9.722c-2.865,-2.683 -7.515,-2.683 -10.379,0l-96.437,90.35c-2.862,2.683 -2.862,7.041 0,9.722l96.437,90.352z" id="svg_1"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3 topics">
        <div class='col-md-12 voice-cont d-flex flex-column'>
            <div class=" mb-3 bg-w-block p-3">
                <div class="row mx-3 my-2 title-hr">
                    <div class="col-md-4 pr-0 "><h4 class="pr-2 bg-white position-relative z-depth-2 d-inline"><b>Competition</b></h4></div>
                    <hr class="z-depth-0 d-none d-md-block one">
                </div>
                <div class="topic-cont-list w-100">
                    <div class="row mx-3 featured-list">

                    </div>
                </div>
            </div>
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

<script src="<?= base_url() ?>js/package.js?v=0.1" type="text/javascript"></script>
<?php

function convert_numbers( $value ) {
        if ( ! is_numeric( $value ) )
                return 0;
        $newvalue = ( int ) $value;
        $suffixNum = 0;
        if ( $value >= 1000 ) {
                $suffixNum = strlen( $value );
                if ( $suffixNum == 4 || $suffixNum == 5 || $suffixNum == 6 ) {
                        $newvalue = round( $value / 1000, 1, PHP_ROUND_HALF_DOWN ) . "K";
                } else {
                        $newvalue = round( $value / 1000000, 1, PHP_ROUND_HALF_DOWN ) . "M";
                }
        }
        return $newvalue;

}
