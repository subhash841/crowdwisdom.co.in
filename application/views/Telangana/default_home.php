<div class="content container">
    <div class="row minus-m-t20 mb-12">
        <!-- Seat Prediction Card -->
        <div class="col l8 s12 plr15 equal-height">
            <div class="card z-depth-4 " >
                <div class="card-image p15 game1 covercenter">
                    <div class="center-align"><h4 class="mtb5 blueheader">Seat Prediction</h4></div>
                </div>
                <div class="card-content center">
                    <div class="" style="height: 54vh;"><img src="<?= base_url( 'images/common/seat-forecast.png' ); ?>" style="margin: 10% 0;"/></div>
                    <div class=""><a href="<?= base_url() ?>Login?section=seat&e=tel" class="btn btn-black btn-large w40">Predict Now</a></div>
                </div>
            </div>
        </div>
        <!-- Opinion(Blog) Card Large Screen -->
        <div class="col l4 m12 s12 plr15 equal-height hide-on-med-and-down">
            <div class="card z-depth-4 padd0">
                <div class="card-head">
                    <div class="bloghead">Your Voice</div>
                </div>
                <div class="blogs-container withtable">
                    <div class="row">
                        <div class="col s12">
                            <?php
                            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                            foreach ( $blogs as $blog_list ):
                                    if ( ! empty( $blog_list[ 'link' ] ) ) {
                                            if ( preg_match( $reg_exUrl, $blog_list[ 'link' ], $url ) ) {
                                                    $href = $url[ 0 ];
                                                    $target = 'target = "_blank"';
                                            } else {
                                                    $href = base_url() . $blog_list[ 'link' ];
                                                    $target = 'target = "_blank"';
                                            }
                                    } else {
                                            $spchar = array ( "~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "|", "/", ";", "'", "<", ">",
                                                "," );
                                            $title = str_replace( $spchar, "", $blog_list[ 'title' ] );
                                            $title = str_replace( ' ', '-', $title );
                                            $href = base_url() . 'Blogs/getBlogs/' . $blog_list[ 'id' ] . '/' . $title;
                                            $target = 'target = "_blank"';
                                    }
                                    echo '<div class="blogs">
                                        <a href="' . $href . '" ' . $target . '>
                                            <div class="row">
                                                <div class="col s5">
                                                    <img src="' . base_url() . 'images/blogs/' . $blog_list[ 'image' ] . '" class="featured-img" style="width: 100%;">
                                                </div>
                                                <div class="col s7">
                                                    <div class="blog-details text-upper">politics</div>
                                                    <div class="blog-title truncate">' . $blog_list[ 'title' ] . '</div>
                                                    <div class="blog-details">' . date( "d F Y", strtotime( $blog_list[ 'created_date' ] ) ) . '</div>
                                                    <div class="blog-author"><a href="">' . $blog_list[ 'name' ] . '</a></a></div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>';
                            endforeach;
                            ?>
                        </div>
                    </div>    
                </div>
                <div class="card-footer" style="">
                    <a href="<?= base_url() ?>Blogs" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-9" style="">
        <!-- Vote Prediction Card -->
        <div class="col l8 s12 plr15 equal-height">
            <div class="card z-depth-4 " >
                <div class="card-image p15 game2 covercenter">
                    <div class="center-align"><h4 class="mtb5 blueheader">Vote Prediction</h4></div>
                </div>
                <div class="card-content" style="padding:0">
                    <div class="center-align" style="height: 54vh;"><img src="<?= base_url( 'images/common/vote-forecast.png' ); ?>" style="margin: 10% 0;"/></div>
                    <div class="center-align"><a href="<?= base_url() ?>Login?section=vote&e=tel" class="btn btn-black btn-large w40">Predict Now</a></div>
                </div>
            </div>
        </div>
        <!-- Rewards Card Large Screen -->
        <!--<div class="col l4 s12 plr15 equal-height hide-on-med-and-down">
            <div class="card z-depth-4 padd0">
                <div class="card-head">
                    <div class="twitterhead">Rewards</div>
                </div>
                <div class="tweets-container withtable"></div>
            </div>
        </div>-->
    </div>
    <div class="row">
        <!-- Opinion(Blog) Card Mobile Screen -->
        <div class="col l4 m12 s12 plr15 equal-height hide-on-large-only">
            <div class="card z-depth-4 padd0">
                <div class="card-head">
                    <div class="bloghead">Your Voice</div>
                </div>
                <div class="blogs-container withtable">
                    <div class="row">
                        <div class="col s12">
                            <?php
                            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                            foreach ( $blogs as $blog_list ):
                                    if ( ! empty( $blog_list[ 'link' ] ) ) {
                                            if ( preg_match( $reg_exUrl, $blog_list[ 'link' ], $url ) ) {
                                                    $href = $url[ 0 ];
                                                    $target = 'target = "_blank"';
                                            } else {
                                                    $href = base_url() . $blog_list[ 'link' ];
                                                    $target = "";
                                            }
                                    } else {
                                            $spchar = array ( "~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "|", "/", ";", "'", "<", ">",
                                                "," );
                                            $title = str_replace( $spchar, "", $blog_list[ 'title' ] );
                                            $title = str_replace( ' ', '-', $title );
                                            $href = base_url() . 'Blogs/getBlogs/' . $blog_list[ 'id' ] . '/' . $title;
                                            $target = 'target = "_blank"';
                                    }
                                    echo '<div class="blogs">
                                        <a href="' . $href . '" ' . $target . '>
                                            <div class="row">
                                                <div class="col s5">
                                                    <img src="' . base_url() . 'images/blogs/' . $blog_list[ 'image' ] . '" class="featured-img" style="width: 100%;">
                                                </div>
                                                <div class="col s7">
                                                    <div class="blog-details text-upper">politics</div>
                                                    <div class="blog-title truncate">' . $blog_list[ 'title' ] . '</div>
                                                    <div class="blog-details">' . date( "d F Y", strtotime( $blog_list[ 'created_date' ] ) ) . '</div>
                                                    <div class="blog-author"><a href="">' . $blog_list[ 'name' ] . '</a></a></div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>';
                            endforeach;
                            ?>
                        </div>
                    </div>    
                </div>
                <div class="card-footer" style="">
                    <a href="#" class="blueheader fw600 readall" style="" tabindex="0">Read All</a>
                </div>
            </div>
        </div>
        <!-- Rewards Card Mobile Screen -->
        <!--<div class="col l4 s12 plr15 equal-height hide-on-large-only">
            <div class="card z-depth-4 padd0">
                <div class="card-head">
                    <div class="twitterhead">Rewards</div>
                </div>
                <div class="tweets-container withtable"></div>
            </div>
        </div>-->
    </div>
</div>

<script>
        $(function () {
            $("a.head-login").attr("href", "<?= base_url() ?>Login?section=seat&e=tel");
            $("a.head-logout").attr("href", "<?= base_url() ?>Login/logout/tel");
        });
</script>