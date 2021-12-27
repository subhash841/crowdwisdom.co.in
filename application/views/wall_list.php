
<div class="container mb-5 blog-list-page data-container">
    <div class="row mt-3">
        <div class='col-md-9 voice-cont'>
            <div class="raise_voice_banner row align-items-center m-0">
                <div class="col-4">
                    <img class='img-fluid d-block mx-auto' src="<?= base_url( "images/icons/blog_banner_2.png" ) ?>"/>
                </div>
                <div class="col-8">
                    <div class='row align-items-center'>

                        <div class="col-md-8">
                            <h4 class="text-white">Start discussion on any <span>Topic</span></h4>
                        </div>
                        <div class="col-md-4 mt-2 mt-0-md">

                            <a class="btn btn-danger btn_create btn_create_wall rounded-btn" href="#">Ask Now</a>
                        </div>
                    </div>
                </div>
            </div>      
            <div class="most-popular mb-3"></div>
            <div class="blog-list-section bg-w-block py-4 d-block title-hr">
                <div class='row mx-3 my-2'>
                    <div class="col-md-4"><h4>Trending <b>Discussion</b></h4></div>
                    <div class="col-md-8"><hr /></div>
                    <div class="col ">
                        <div class='row blog-list'></div>
                    </div>
                </div>
            </div>
            <div class="col load-btn-holder mt-4">
                <button class="btn btn-outline-primary readmore rounded-btn mx-auto d-block load-more-voice-list">Read more</button>
            </div>

            <div class="blog-list-section bg-w-block py-4 d-block mt-3 h-list-detail">
                <div class='row mx-3 my-2'>
                    <div class="col-md-4"><h4>Trending <b>Predictions</b></h4></div>
                    <div class="col-md-8"><hr /></div>
                    <div class="col ">
                        <div class='predictions-list row h-list'></div>
                    </div>
                </div>
            </div>

            <div class="blog-list-section bg-w-block py-4 d-block mt-3 h-list-detail">
                <div class='row mx-3 my-2'>
                    <div class="col-md-4"><h4>Trending <b>Questions</b></h4></div>
                    <div class="col-md-8"><hr /></div>
                    <div class="col ">
                        <div class='questions-list row h-list'></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-md-0 py-4 flex-md-fill d-md-flex flex-md-column">
            <!--Right side Your voice list-->
            <div class="bg-w-block p-3 col mb-3 h-50 overflow-hidden-x">
                <h4 class="d-block text-center">Your <b>Voice</b></h4>
                <div class="side-voice-list article-list row px-3">

                </div>
                <div class="col load-btn-holder mt-4 text-center">
                    <a href="#" class="btn btn-outline-primary readmore rounded-btn load-more z-depth-2">Read more</a>
                </div>
            </div>
            <!--Right side From the web list-->
            <div class="bg-w-block p-3 col h-50 overflow-hidden-x">
                <h4 class="d-block text-center">From the <b>Web</b></h4>
                <div class="side-from-web article-list rated-list row px-3">

                </div>
                <div class="col load-btn-holder mt-4 text-center">
                    <a href="#" class="btn btn-outline-primary readmore rounded-btn load-more z-depth-2">Read more</a>
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
                <button type="button" id="create_question_no" class="btn btn-secondary rounded-btn" data-dismiss="modal">No</button>
                <button type="button" id="create_question_yes" class="btn btn-primary rounded-btn">Yes</button>
                <button type="button" id="create_question_ok" class="btn btn-secondary rounded-btn" data-dismiss="modal">OK</button>
            </div>

        </div>
    </div>
</div>
<script>
    var options = {toast: "<?= $this -> session -> flashdata( 'toast' ); ?>"};
    var id = "";
</script>

<script src="<?= base_url() ?>js/wall_list.js?v=0.00"></script>