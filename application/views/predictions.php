
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
                            <h4 class="text-white">Start Your Own <span>Prediction</span></h4>
                        </div>
                        <div class="col-md-4 mt-2 mt-0-md">
                            <a class="btn btn-danger btn_create btn_create_prediction rounded-btn" href="#">Start Now</a>
                        </div>
                    </div>
                </div>
            </div>      
            <div class="most-popular mb-3"></div>
            <div class="blog-list-section bg-w-block py-4 d-block title-hr">
                <div class='row mx-3 my-2'>
                    <div class="col-md-4"><h4>Trending <b>Prediction</b></h4></div>
                    <div class="col-md-8"><hr /></div>
                    <div class="col ">
                        <div class='row blog-list voice-list'></div>
                    </div>
                </div>
            </div>
            <div class="col load-btn-holder mt-4">
                <button class="btn btn-outline-primary readmore rounded-btn mx-auto d-block load-more-voice-list">Read more</button>
            </div>

            <div class="blog-list-section bg-w-block py-4 d-block mt-3 h-list-detail">
                <div class="row mx-3 my-2">
                    <div class="col-md-4"><h4>Trending <b>Discussions</b></h4></div>
                    <div class="col-md-8"><hr></div>
                    <div class="col ">
                        <div class="wall-list row h-list">

                        </div>
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

            <div class="bg-w-block p-3 col mb-3 h-50 overflow-hidden-x">
                <h4 class="d-block text-center"><b>Explore other topics</b></h4>
                <div class="side-voice-list article-list row px-3">

                </div>
                <div class="col load-btn-holder mt-4 text-center">
                    <a href="#" class="btn btn-outline-primary readmore rounded-btn load-more z-depth-2">Read more</a>
                </div>
            </div>

            <div class="bg-w-block p-3 col h-50 overflow-hidden-x">
                <h4 class="d-block text-center">From the <b>Web</b></h4>
                <div class="side-from-web article-list rated-list row px-3">

                </div>
                <div class="col load-btn-holder mt-4 text-center">
                    <a href="#" class="btn btn-outline-primary readmore rounded-btn load-more z-depth-2">Read more</a>
                </div>
            </div>
        </div>
        <!--        <div class="col-md-3 pl-md-0 pt-md-0 py-4">
        
                    <div class="bg-w-block p-3  mb-3">
                        <h4 class="d-block text-center">Your <b>Voice</b></h4>
                        <div class="article-list">
        
                        </div>
                    </div>
                    
                    <div class="bg-w-block p-3  mb-3">
                        <h4 class="d-block text-center">Trending <b>Questions</b></h4>
                        <div class="article-list">
        
                        </div>
                    </div>
                    
                    <div class="bg-w-block  p-1 pb-4 mb-3">
                        <small class="d-block text-center text-black-50 text-uppercase">advertisement</small>
                        <div class="adimg col-12 mt-3"><a href='http://www.loudst.com/' target='_blank' class='d-block'><img src="<?= base_url( "/images/special/loudst.png" ); ?>" class="img-fluid w-100"></a></div>
                    </div>
                </div>-->


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
<script>
        var options = {toast: "<?= $this -> session -> flashdata( 'toast' ); ?>"};
</script>

<script src="<?= base_url() ?>js/predictions.js?v=0.03"></script>