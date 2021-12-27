<style type="text/css">
    .join-btn {
    background: #FF5369;
    font-size: 1.08rem;
    color: #fff;
    font-weight: 500;
    letter-spacing: 1px;
}
    
</style>
<?php
if (isset($topic_id)) {
    $sessiondata = $this->session->userdata('data');
    if (!empty($sessiondata)) {
        if ($is_private == "1" && !in_array($sessiondata['email'], explode(",", $email_ids))) {
            redirect("Index");
        }
    } else {
        //redirect("Login");
    }
}
?>
<div class="container home-page data-container">
    <div class="banner-bg container-fluid px-0 mt-4 rounded <?= $data = isset($topicclass) ? 'show' : 'd-none'; ?> " >
        <div class="d-flex align-items-center justify-content-center h-75 flex-column">

            <h3 class="text-white font-weight-normal"><?= $topic_name; ?></h3>
            <small>
                <?php
                if ($is_follow) {
                    echo '<button class="btn rounded-btn follow-btn z-depth-2 py-2 mt-3" data-topic="' . $topic_id . '" data-follow="true">&#x2714; &nbsp;FOLLOWING</button>';
                } else {
                    echo '<button class="btn rounded-btn follow-btn z-depth-2 py-2 mt-3" data-topic="' . $topic_id . '" data-follow="false">+ follow</button>';
                }
                ?>
         &nbsp;
                <?php
                if ($is_join) {
                    echo '<button class="btn rounded-btn join-btn z-depth-2 py-2 mt-3" data-topic="' . $topic_id . '" data-join="true">&#x2714; &nbsp;Joined</button>';
                } else {
                    echo '<button class="btn rounded-btn join-btn z-depth-2 py-2 mt-3" data-topic="' . $topic_id . '" data-join="false">+ Join our community</button>';
                }
                ?>
            </small>
        </div>
        <div class="col-lg-5 col-12 mx-auto mt-2">
            <?php $share_url = urlencode(base_url() . ltrim($_SERVER['REQUEST_URI'], '/')); ?>
            <div class="row justify-content-md-end justify-content-center">
                <a class="d-flex align-items-center bg-facebook text-white rounded cust-btn btn col   mx-1" href="http://www.facebook.com/sharer/sharer.php?u=<?= $share_url ?>" target="_blank">
                    <i class="fa mx-1 fa-facebook"></i>
                    <h6 class="mb-0 w-100">Share</h6>
                </a>
                <a class="d-flex align-items-center bg-twitter text-white rounded cust-btn btn col  mx-1" href="https://twitter.com/intent/tweet?url=<?= $share_url ?>&text='<?= urlencode($topic_name) ?>'&ael;hashtags=Crowdwisdom" target="_blank">
                    <i class="fa mx-1 fa-twitter"></i>
                    <h6 class="mb-0 w-100">Tweet</h6>
                </a>
                <a class="d-flex bg-linkdein align-items-center text-white rounded cust-btn btn col  mx-1" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $share_url ?>&title=<?= urlencode($topic_name) ?>" target="_blank">
                    <i class="fa mx-1 fa-linkedin"></i>
                    <h6 class="mb-0 w-100">Share</h6>
                </a>
                <a class="d-flex bg-whatsapp align-items-center text-white rounded cust-btn btn col   mx-1"  href="https://wa.me/?text=<?= $share_url ?>" target="_blank">
                    <i class="fa mx-1 fa-whatsapp"></i>
                    <h6 class="mb-0 w-100">Share</h6>
                </a>
            </div>
        </div>
    </div>
    <div class="row mt-3 topics d-none fade">
        <div class="col <?php echo $data = $topicclass ? '' : ''; ?>">
            <div class="blog-list-section bg-w-block py-4 d-block">
                <div class="row mx-3 my-2 title-hr">
                    <div class="col-md-4 pr-0 "><h4 class="pr-2 bg-white position-relative z-depth-2 d-inline"><b>Explore</b></h4></div>
                    <hr class="z-depth-0 d-none d-md-block one">


                </div>
                <div class="row mx-3 my-2">
                    <div class="col">
                        <a class="carousel-control-prev d-none d-md-flex z-depth-3 " href="#" role="button" data-slide="prev">
                            <span class="w-100 rounded-circle bg-ee p-2 d-inline-block">
                                <svg viewBox="0 0 200 200" class="w-100 p-1" xmlns="http://www.w3.org/2000/svg">


                                <path fill="rgb(164, 164, 164)" d="m143.02937,195.21212c1.433,1.341 3.222,2.012 5.189,2.012c1.968,0 3.758,-0.671 5.19,-2.012c2.861,-2.681 2.861,-7.039 0,-9.722l-91.25,-85.49l91.25,-85.49c2.861,-2.683 2.861,-7.041 0,-9.722c-2.865,-2.683 -7.515,-2.683 -10.379,0l-96.437,90.35c-2.862,2.683 -2.862,7.041 0,9.722l96.437,90.352z" id="svg_1"></path>

                                </svg>
                            </span>
                        </a>
                        <div class="topic-cont wide-cont w-100">
                            <div class="row mx-3 my-2 topic-list wide-list"></div>
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
    <div class="row mt-3">
        <div class='col-md-9 voice-cont d-flex flex-column'>
            <div class=" mb-3 bg-w-block p-3 popular-prediction-cont <?= (count($trending_predictions["data"]) < 1 ? "d-none" : "") ?>">
                <div class='row mx-3 my-2 title-hr'>
                    <div class="col-md-6"><h4 class=" pr-2 bg-white position-relative z-depth-2 d-inline pr-2"><b>What do you think will happen?</b></h4></div>
                    <hr class="z-depth-0 d-none d-md-block"  />
                    <div class="offset-md-3 col-md-3 load-btn-holder text-center d-none d-md-block">
                        <a href="/Predictions" class="btn btn-outline-primary readmore rounded-btn load-more-voice-list z-depth-2">Read more</a>
                    </div>
                </div>
                <div id="popularpredictions" class="carousel slide">

                    <div class="carousel-inner">

                        <?php
//                        print_r( $trending_predictions );
                        $indicators = "";
                        $stimg = array(
                            "entertainment" => array(base_url("/images/home/e1.jpg"), base_url("/images/home/e2.jpg"), base_url("/images/home/e3.jpg")),
                            "money" => array(base_url("/images/home/m1.jpg"), base_url("/images/home/m2.jpg")),
                            "elections" => array(base_url("/images/home/p1.jpg"), base_url("/images/home/p2.jpg"), base_url("/images/home/p3.jpg")),
                            "sports" => array(base_url("/images/home/s1.jpg"), base_url("/images/home/s3.jpg"))
                        );
                        // print_r($trending_predictions[ "data" ]);
                        foreach ($trending_predictions["data"] as $key => $data) {
                            $preview_data = json_decode(@$data['data'], TRUE);
                            // print_r($preview_data[ "img" ]);
                            //$popimg = $stimg[ $data[ 'category' ] ][ rand( 0, count( $stimg[ $data[ 'category' ] ] ) - 1 ) ];
                            if ($data['image'] != "") {
                                $popimg = $data['image'];
                            } else if ($preview_data["img"] != "") {
                                $popimg = $preview_data["img"];
                            } else {
                                $popimg = $stimg[$data['category']][rand(0, count($stimg[$data['category']]) - 1)];
                            }
                            ?>

                            <div class="carousel-item <?= $key < 1 ? "active" : "" ?>  px-md-5 px-2  top-blog">
                                <div class="row px-2">
                                    <div class="col-md-6 d-flex pt-md-4 order-md-last">
                                        <div class="rounded w-100 img" style="background: #efefef url('<?= $popimg ?>?') no-repeat center center;background-size:cover" ></div>
                                    </div>
                                    <div class="col-md-6 py-4">
                                        <small class="text-danger text-uppercase">Popular Predictions</small>

                                        <small class="category"></small>
                                        <h1><?= $data['title']; ?></h1>
                                        <small class="likes my-2 d-block"><?= convert_numbers($data["total_votes"]) ?> Votes &nbsp;&nbsp;&#9679;&nbsp;&nbsp; <?= convert_numbers($data["total_comments"]) ?> Comments</small>
                                        <button class="rounded-btn btn lg btn-primary my-2 mt-3 mt-md-0 goto mx-auto mx-md-0 d-block" data-id="<?= $data['id'] ?>" data-type="prediction">Predict Now</button>

                                    </div>  

                                </div>
                            </div>
                            <?php
                            $indicators .= '<li data-target="#popularpredictions" data-slide-to="' . $key . '" class="' . (($key < 1) ? "active" : "") . ' "></li>';
                        }
                        ?>
                    </div>
                    <div class="px-2">
                        <ol class="carousel-indicators carousel-indicators px-5 mx-0 position-relative justify-content-md-start">
                            <?php echo $indicators; ?>
                        </ol>
                    </div>
                    <a class="carousel-control-prev d-none d-md-flex bg-white" href="#popularpredictions" role="button" data-slide="prev">
                        <span class="w-100 rounded-circle bg-ee p-2 d-inline-block">
                            <svg viewBox="0 0 200 200" class="w-100 p-1" xmlns="http://www.w3.org/2000/svg">


                            <path fill="rgb(164, 164, 164)" d="m143.02937,195.21212c1.433,1.341 3.222,2.012 5.189,2.012c1.968,0 3.758,-0.671 5.19,-2.012c2.861,-2.681 2.861,-7.039 0,-9.722l-91.25,-85.49l91.25,-85.49c2.861,-2.683 2.861,-7.041 0,-9.722c-2.865,-2.683 -7.515,-2.683 -10.379,0l-96.437,90.35c-2.862,2.683 -2.862,7.041 0,9.722l96.437,90.352z" id="svg_1"/>

                            </svg>
                        </span>
                    </a>
                    <a class="carousel-control-next d-none d-md-flex bg-white" href="#popularpredictions" role="button" data-slide="next">

                        <span class="w-100 rounded-circle bg-ee p-2 d-inline-block">
                            <svg viewBox="0 0 200 200" class="w-100 p-1" xmlns="http://www.w3.org/2000/svg">


                            <path fill="rgb(164, 164, 164)" transform="rotate(-180 100,100) "  d="m143.02937,195.21212c1.433,1.341 3.222,2.012 5.189,2.012c1.968,0 3.758,-0.671 5.19,-2.012c2.861,-2.681 2.861,-7.039 0,-9.722l-91.25,-85.49l91.25,-85.49c2.861,-2.683 2.861,-7.041 0,-9.722c-2.865,-2.683 -7.515,-2.683 -10.379,0l-96.437,90.35c-2.862,2.683 -2.862,7.041 0,9.722l96.437,90.352z" id="svg_1"/>
                            </svg>
                        </span>
                    </a>
                </div>
                <div class="offset-md-6 col-md-3 load-btn-holder text-center d-block d-md-none mt-4">
                    <a href="/Predictions" class="btn btn-outline-primary readmore rounded-btn load-more-voice-list z-depth-2">Read more</a>
                </div>
            </div>

            <div class=" bg-w-block py-4 flex-fill">
                <div class='row mx-3 my-2 title-hr'>
                    <div class="col-md-6"><h4 class=" pr-2 bg-white position-relative z-depth-2 d-inline pr-2"><b>Explore other topics</b></h4></div>
                    <hr class="z-depth-0  d-none d-md-block"/>
                    <div class="offset-md-3 col-md-3 load-btn-holder text-center d-none d-md-block">
                        <a href="/HotTopics/topic_list" class="btn btn-outline-primary readmore rounded-btn load-more-voice-list z-depth-2">Read more</a>
                    </div>

                </div>
                <div class="row  mx-3 my-2">

                    <?php
                    if (count($trending_voice["data"]) >= 1) {
                        foreach ($trending_voice["data"] as $key => $data) {
                            if ($key > 3)
                                break;
                            ?>
                            <div class="col-md-6 blog-list-item">
                                <a href="<?= base_url() . "YourVoice/blog_detail/" . $data['id'] . "/" ?>" class="pb-3" style="">
                                    <div class="row m-0">
                                        <div class="col-4 voiceimg" style="height:auto;background: url('<?= $data["image"] ?>')  no-repeat center center;"></div>
                                        <div class="col-8">
                                            <!--<small class="category"><?= $data["category"] ?></small>-->
                                            <h6><?= $data['title'] ?></h6>
                                            <small class="likes"><?= convert_numbers($data["total_likes"]) ?>  Likes &nbsp;&nbsp;&#9679;&nbsp;&nbsp; <?= convert_numbers($data["total_views"]) ?>  Views<br><?= convert_numbers($data["total_comments"]) ?>  Comments</small>
                                        </div>
                                    </div>
                                </a>
                            </div>    

                            <?php
                        }
                    }
                    else {
                        echo "<div class='col text-center'><img src='" . base_url("images/infographics/nq.png") . "' class='img-fluid' /></div>";
                    }
                    ?>
                </div>
                <div class="offset-md-6 col-md-3 load-btn-holder text-center d-block d-md-none mt-4">
                    <a href="/HotTopics/topic_list" class="btn btn-outline-primary readmore rounded-btn load-more-voice-list z-depth-2">Read more</a>
                </div>
            </div>

        </div>

        <div class="col-md-3 pl-md-0 pt-md-0 pt-4 d-flex flex-column">

            <div class="bg-w-block p-3 pb-5 flex-fill overflow-hidden-x h-100" style="max-height: 800px;">
                <h4 class="d-block">Trending <b>Questions</b></h4>
                <div class="article-list">

                    <?php
                    if (count($trending_questions["data"]) > 0) {
                        foreach ($trending_questions["data"] as $key => $data) {
                            ?>
                            <div class="col-md-4 blog-list-item">
                                <a href="<?= base_url() . "AskQuestions/details/" . $data['id'] . "/" ?>" class="d-block pb-2" style="">
                                    <?php if ($data['image']) { ?>
                                        <div class="voiceimg p-5" style="background: url('<?= $data['image'] ?>')  no-repeat center center;"></div>
                                    <?php } ?>
                                    <small class="category"></small>
                                    <h6><?= $data['question'] ?></h6>
                                    <small class="likes"><?= convert_numbers($data["total_votes"]) ?> Votes &nbsp;&nbsp;&#9679;&nbsp;&nbsp; <?= convert_numbers($data["total_comments"]) ?> Comments</small></a>
                            </div>    

                            <?php
                        }
                    } else {
                        echo "<img src='" . base_url("images/common/noq.png") . "' class='img-fluid' />";
                    }
                    ?>
                </div>

                <div class="col load-btn-holder mt-4 text-center <?= count($trending_questions["data"]) > 0 ? "" : "d-none" ?>">
                    <a href="/AskQuestions" class="btn btn-outline-primary readmore rounded-btn load-more-voice-list z-depth-2">Read more</a>

                </div>
            </div>
        </div>


    </div>
    <div class="row mt-3 px-3 d-none package-holder">
        <div class="col-12 rounded" style="background:transparent url(<?= base_url('images/common/14.png') ?>) no-repeat top center; background-size:100% 65%;">
            <div class="row py-3 mb-1 title-hr text-white ">
                <div class="col-md-3 pr-0 "><h4 class="pr-2 position-relative z-depth-2 d-inline ml-3"><b>Competition</b></h4></div>
                <hr class="z-depth-0 d-none d-md-block white" style="left: 15%;width:80%"/>
            </div>
            <a class="carousel-control-prev d-none d-md-flex z-depth-3 " href="#" role="button" data-slide="prev">
                <span class="w-100 rounded-circle bg-ee p-2 d-inline-block">
                    <svg viewBox="0 0 200 200" class="w-100 p-1" xmlns="http://www.w3.org/2000/svg">
                    <path fill="rgb(164, 164, 164)" d="m143.02937,195.21212c1.433,1.341 3.222,2.012 5.189,2.012c1.968,0 3.758,-0.671 5.19,-2.012c2.861,-2.681 2.861,-7.039 0,-9.722l-91.25,-85.49l91.25,-85.49c2.861,-2.683 2.861,-7.041 0,-9.722c-2.865,-2.683 -7.515,-2.683 -10.379,0l-96.437,90.35c-2.862,2.683 -2.862,7.041 0,9.722l96.437,90.352z" id="svg_1"></path>
                    </svg>
                </span>
            </a>
            <div class="package-cont wide-cont">
                <div class="row ml-3 px-3 packages wide-list"></div>
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

<div class="container-fluid  mt-3 bg-b-block ratedblock d-none">

    <div class="container">
        <div class="row pt-4">
            <div class="col-md-9">
                <div class="row py-3 mb-1 title-hr">
                    <div class="col-md-4 pr-0 "><h4 class="bg-b-block position-relative z-depth-2">Join Our <b>Community</b></h4></div>
                    <hr class="z-depth-0 d-none d-md-block white" />
                    <div class="offset-md-5 col-md-4 load-btn-holder text-center d-none d-md-block" style="margin-left: 32.667%;">
                        <a href="/HotTopics/topic_list" class="btn btn-outline-primary readmore rounded-btn load-more-voice-list z-depth-2">Read more</a>
                    </div>
                </div>

                <div class="row">
                    <div class="most-popular col"></div>
                </div>
            </div>

            <div class="col-md-3 pl-md-0 py-3">
                <h4 class="pb-4">Other <b>Communities</b></h4>
                <div class="ratedart"></div>
                <div class="load-btn-holder text-center d-block d-md-none">
                    <a href="/HotTopics/topic_list" class="btn btn-outline-primary readmore rounded-btn load-more-voice-list z-depth-2">Read more</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="container mt-3 mb-3 <?= count($trending_voice["data"]) < 1 ? "d-none" : "" ?>">
    <div class="row">
        <div class='col'>
            <div class="blog-list-section bg-w-block py-4 d-block  ">
                <div class='row mx-3 my-2 title-hr'>
                    <div class="col-md-4 pr-0 "><h4 class="pr-2 bg-white position-relative z-depth-2 d-inline">Your <b>Voice</b></h4></div>
                    <hr class="z-depth-0 d-none d-md-block" />
                    <div class="offset-md-5 col-md-3 load-btn-holder text-center d-none d-md-block">
                        <a href="<?= base_url() ?>/HotTopics/topic_list" class="btn btn-outline-primary readmore rounded-btn load-more-voice-list z-depth-2">Read more</a>
                    </div>
                </div>
                <div class="row mx-3 my-2">
                    <div class="col">
                        <div class='row blog-list'>
<?php
foreach ($trending_voice["data"] as $key => $data) {
    ?>
                                                                                                    <div class="col-md-4 blog-list-item"><a href="<?= base_url() ?>/YourVoice/blog_detail/<?= $data["id"] ?>" class="d-block pb-3" style=""><div class="voiceimg p-5" style="background: url('<?= $data["image"] ?>')  no-repeat center center;"></div><small class="category"><?= $data["category"] ?></small><h6><?= $data['title'] ?></h6><small class="likes"> <?= convert_numbers($data["total_likes"]) ?>  Likes &nbsp;&nbsp;&#9679;&nbsp;&nbsp;  <?= convert_numbers($data["total_views"]) ?>  Views &nbsp;&nbsp;&#9679;&nbsp;&nbsp;  <?= convert_numbers($data["total_comments"]) ?>  Comments</small></a></div>    

<?php } ?>
                        </div>
                        <div class="load-btn-holder text-center d-block d-md-none mt-4">
                            <a href="<?= base_url() ?>/HotTopics/topic_list" class="btn btn-outline-primary readmore rounded-btn load-more-voice-list z-depth-2">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->

<div class="container mt-3 mb-5 <?= count($trending_discussions["data"]) < 1 ? "d-none" : "" ?>">
    <div class="row">
        <div class="col">
            <div class="blog-list-section bg-w-block py-4 d-block">
                <div class='row mx-3 my-2 title-hr'>
                    <div class="col-md-4 pr-0 "><h4 class="pr-2 bg-white position-relative z-depth-2 d-inline">Top <b>Discussions</b></h4></div>
                    <hr class="z-depth-0 d-none d-md-block" />
                    <div class="offset-md-5 col-md-3 load-btn-holder text-center d-none d-md-block">
                        <a href="<?= base_url() ?>/HotTopics/topic_list" class="btn btn-outline-primary readmore rounded-btn load-more-voice-list z-depth-2">Read more</a>
                    </div>
                </div>
                <div class="row mx-3 my-2">
                    <?php
                    foreach ($trending_discussions["data"] as $key => $data) {
                        ?>
                        <div class="col-md-4 blog-list-item">
                            <a href="<?= base_url() ?>Wall/detail/<?= $data["id"] ?>" class="d-block pb-3" style="">
                                <div class="voiceimg p-5" style="background: url('<?= $data["image"] ?>') no-repeat center center;"></div>
                                <h6><?= $data['title'] ?></h6>
                                <small class="likes"><?= convert_numbers($data["total_like"]) ?>  Likes &nbsp;&nbsp;●&nbsp;&nbsp; <?= convert_numbers($data["total_neutral"]) ?> Neutral &nbsp;&nbsp;●&nbsp;&nbsp; <?= convert_numbers($data["total_dislike"]) ?>  Dislikes <br><?= convert_numbers($data["total_comments"]) ?> Comments</small>
                            </a>
                        </div>
                    <?php } ?> 
                </div>
                <div class="offset-md-6 col-md-3 load-btn-holder text-center d-block d-md-none mt-4">
                    <a href="/HotTopics/topic_list" class="btn btn-outline-primary readmore rounded-btn load-more-voice-list z-depth-2">Read more</a>
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
                <a href="<?= base_url("Packages/purchase_package/") ?>" class="btn btn-primary rounded-btn play">Play</a>
            </div>

        </div>
    </div>
</div>
<script>
    var topic_id = <?= (!@$topic_id) ? 0 : @$topic_id ?>;
</script>
<script src="<?= base_url() ?>js/home.js?v=0.98" type="text/javascript"></script>
<?php

function convert_numbers($value) {
    if (!is_numeric($value))
        return 0;
    $newvalue = (int) $value;
    $suffixNum = 0;
    if ($value >= 1000) {
        $suffixNum = strlen($value);
        if ($suffixNum == 4 || $suffixNum == 5 || $suffixNum == 6) {
            $newvalue = round($value / 1000, 1, PHP_ROUND_HALF_DOWN) . "K";
        } else {
            $newvalue = round($value / 1000000, 1, PHP_ROUND_HALF_DOWN) . "M";
        }
    }
    return $newvalue;
}
