<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $queryString = $this -> input -> get();
        $this -> session -> set_userdata( 'querystring', $queryString );

        $userdata = $this -> session -> userdata( 'data' );
        if ( ! empty( $userdata ) ) {
            if ( $this -> input -> get( "section" ) == "home" ) {
                redirect( "Index" );
            } else if ( $this -> input -> get( "section" ) == "wallet" ) {
                redirect( "Wallet" );
            } else if ( $this -> input -> get( "section" ) == "question" ) { /* Question section */
                $vid = $this -> input -> get( "vid" );
                if ( isset( $vid ) && $vid != "" ) {
                    redirect( "AskQuestions/details/$vid" );
                } else {
                    redirect( "AskQuestions" );
                }
            } else if ( $this -> input -> get( "section" ) == "web" ) {
                $vid = $this -> input -> get( "vid" );
                if ( isset( $vid ) && $vid != "" ) {
                    redirect( "FromTheWeb/detail/$vid" );
                } else {
                    redirect( "FromTheWeb" );
                }
            } else if ( $this -> input -> get( "section" ) == "seat" || $this -> input -> get( "section" ) == "vote" ) {
                if ( $this -> input -> get( "e" ) == "in" ) {
                    redirect( "Dashboard?section=" . $this -> input -> get( "section" ) );
                } else if ( $this -> input -> get( "e" ) == "mp" ) {
                    redirect( "MP/Dashboard?section=" . $this -> input -> get( "section" ) );
                } else if ( $this -> input -> get( "e" ) == "ch" ) {
                    redirect( "Chhattisgarh/Dashboard?section=" . $this -> input -> get( "section" ) );
                } else if ( $this -> input -> get( "e" ) == "rj" ) {
                    redirect( "Rajasthan/Dashboard?section=" . $this -> input -> get( "section" ) );
                } else if ( $this -> input -> get( "e" ) == "tel" ) {
                    redirect( "Telangana/Dashboard?section=" . $this -> input -> get( "section" ) );
                } else if ( $this -> input -> get( "e" ) == "ap" ) {
                    redirect( "AP/Dashboard?section=" . $this -> input -> get( "section" ) );
                } else {
                    redirect( "Index" );
                }
            } else if ( $this -> input -> get( "section" ) == "walldetail" ) {
                $vid = $this -> input -> get( "vid" );
                if ( isset( $vid ) && $vid != "" ) {
                    redirect( "Wall/detail/$vid" );
                } else {
                    redirect( "Index" );
                }
            } else {
                redirect( "Index" );
            }
        }
        $this -> load -> view( 'login_revised' );
    }

    public function twitterlogin() {
        require_once APPPATH . 'libraries/twitteroauth/OAuth.php';
        require_once APPPATH . 'libraries/twitteroauth/TwitterOAuth.php';

        define( 'CONSUMER_KEY', 'ULpQloiD7Cc5Tig4RVjzBE7Qp' );
        define( 'CONSUMER_SECRET', 'QTsBYnWrhODkPtmuM3kpdnaDZWoGVuRFFeMEbFmEtUsNPLN7mF' );

        define( 'OAUTH_CALLBACK', base_url() . 'Login/callback' );

        $connection = new TwitterOAuth( CONSUMER_KEY, CONSUMER_SECRET );

        // get the token from connection object
        $request_token = $connection -> getRequestToken( OAUTH_CALLBACK );
        // if request_token exists then get the token and secret and store in the session
        if ( $request_token ) {
            $token = $request_token[ 'oauth_token' ];
            //echo $token."  ";
            $_SESSION[ 'request_token' ] = $token;
            //echo $_SESSION['request_token']." ";
            $_SESSION[ 'request_token_secret' ] = $request_token[ 'oauth_token_secret' ];
            //echo $_SESSION['request_token_secret']." ";
            // get the login url from getauthorizeurl method
            $login_url = $connection -> getAuthorizeURL( $token );
            header( "Location:$login_url" );
        }

        /*
         * PART 2 - PROCESS
         * 1. check for logout
         * 2. check for user session  
         * 3. check for callback
         */

        // 1. to handle logout request
        if ( isset( $_GET[ 'logout' ] ) ) {
            //unset the session
            session_unset();
            // redirect to same page to remove url paramters
            $redirect = 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ];
            header( 'Location: ' . filter_var( $redirect, FILTER_SANITIZE_URL ) );
        }


        // 2. if user session not enabled get the login url
        // 3. if its a callback url


        /*
         * PART 3 - FRONT END 
         *  - if userdata available then print data
         *  - else display the login url
         */

        if ( isset( $login_url ) && ! isset( $_SESSION[ 'data' ] ) ) {
            // echo the login url
            echo "<a href='$login_url'><button>Login with twitter</button></a>";
        } else {
            // get the data stored from the session
            $data = $_SESSION[ 'data' ];
            // echo the name username and photo
            echo "Name : " . $data -> name . "<br>";
            echo "Username : " . $data -> screen_name . "<br>";
            echo "Photo : <img src='" . $data -> profile_image_url . "'/><br><br>";
            // echo the logout button
            echo "<a href='?logout=true'><button>Logout</button></a>";
        }
    }

    public function callback() {
        require_once APPPATH . 'libraries/twitteroauth/OAuth.php';
        require_once APPPATH . 'libraries/twitteroauth/TwitterOAuth.php';

        define( 'CONSUMER_KEY', 'ULpQloiD7Cc5Tig4RVjzBE7Qp' );
        define( 'CONSUMER_SECRET', 'QTsBYnWrhODkPtmuM3kpdnaDZWoGVuRFFeMEbFmEtUsNPLN7mF' );

        define( 'OAUTH_CALLBACK', base_url() . 'Login/callback' );

        if ( isset( $_GET[ 'denied' ] ) ) {
            $this -> logout();
        }

        if ( isset( $_GET[ 'oauth_token' ] ) ) {

            // create a new twitter connection object with request token
            $connection = new TwitterOAuth( CONSUMER_KEY, CONSUMER_SECRET, $_SESSION[ 'request_token' ], $_SESSION[ 'request_token_secret' ] );
            //var_dump($connection);
            // get the access token from getAccesToken method
            $access_token = $connection -> getAccessToken( $_REQUEST[ 'oauth_verifier' ] );
            if ( $access_token ) {
                // create another connection object with access token
                $connection = new TwitterOAuth( CONSUMER_KEY, CONSUMER_SECRET, $access_token[ 'oauth_token' ], $access_token[ 'oauth_token_secret' ] );
                // set the parameters array with attributes include_entities false
                //$params = array('include_entities' => 'false');
                $params = array ( 'include_email' => 'true', 'include_entities' => 'false', 'skip_status' => 'true' );
                // get the data
                $data = $connection -> get( 'account/verify_credentials', $params );
            }
        }

        if ( count( $data -> errors ) == 0 ) {
            /* User details from twitter */
            $user_name = $data -> name;
            $socialid = $data -> id_str;
            $twitterid = $data -> screen_name;
            $login_type = "Twitter";

            $this -> db -> select( "id,alise,location,party_affiliation,certificate_path,unearned_points,tnc_agree" );
            $this -> db -> from( "users" );
            $this -> db -> where( "social_id = '$socialid'" );
            $result = $this -> db -> get();

            $is_exists = $result -> num_rows();

            /* Userdata */
            $userdata = array (
                "name" => $user_name,
                "social_id" => $socialid,
                "twitter_id" => $twitterid,
                "login_type" => $login_type,
                    //"unearned_points" => "35"
            );

            if ( $is_exists == 0 ) {
                /* Insert user data and set session */
                $this -> db -> insert( 'users', $userdata );
                $userid = $this -> db -> insert_id();
                $userdata[ 'uid' ] = $userid;
                $userdata[ 'alise' ] = "";
                $userdata[ 'location' ] = "";
                $userdata[ 'party_affiliation' ] = "";
                $userdata[ 'certificate_path' ] = "";
                $userdata[ 'silver_points' ] = "0";
                $userdata[ 'tnc_agree' ] = "0";
            } else {
                $data = $result -> row_array();
                $userdata[ 'uid' ] = $data[ 'id' ];
                $userdata[ 'alise' ] = $data[ 'alise' ];
                $userdata[ 'location' ] = $data[ 'location' ];
                $userdata[ 'party_affiliation' ] = $data[ 'party_affiliation' ];
                $userdata[ 'certificate_path' ] = $data[ 'certificate_path' ];
                $userdata[ 'silver_points' ] = $data[ 'unearned_points' ];
                $userdata[ 'tnc_agree' ] = $data[ 'tnc_agree' ];
            }

            $_SESSION[ 'data' ] = $userdata;

            if ( ! empty( $_SESSION[ 'data' ] ) ) {
                $session_querystring = $this -> session -> userdata( 'querystring' );
                if ( $_SESSION[ 'data' ][ 'tnc_agree' ] == "0" ) {
                    redirect( 'TnC' );
                } else if ( $_SESSION[ 'data' ][ 'alise' ] == "" && $_SESSION[ 'data' ][ 'location' ] == "" && $session_querystring[ 'section' ] != "sc" && $session_querystring[ 'section' ] != "wkt" ) {
                    redirect( 'Wallet/update_profile' );
                } else {
                    if ( $session_querystring[ 'section' ] == "home" ) { /* Home section */
                        redirect( "Index" );
                    } else if ( $session_querystring[ 'section' ] == "wallet" ) {
                        redirect( "Wallet" );
                    } else if ( $session_querystring[ 'section' ] == "question" ) { /* Question section */
                        $vid = $session_querystring[ 'vid' ];
                        if ( isset( $vid ) && $vid != "" ) {
                            redirect( "AskQuestions/details/$vid" );
                        } else {
                            redirect( "AskQuestions" );
                        }
                    } else if ( $session_querystring[ 'section' ] == "createquestion" ) {
                        redirect( "AskQuestions/raise_question" );
                    } else if ( $session_querystring[ 'section' ] == "web" ) {
                        $vid = $session_querystring[ 'vid' ];
                        $type = $session_querystring[ 'type' ];
                        if ( isset( $vid ) && $vid != "" ) {
                            redirect( "FromTheWeb/detail/$vid" );
                        } else if ( isset( $type ) && $type == "post" ) {
                            redirect( "FromTheWeb/post_article" );
                        } else {
                            redirect( "FromTheWeb" );
                        }
                    } else if ( $session_querystring[ 'section' ] == "seat" || $session_querystring[ 'section' ] == "vote" ) { //&& $session_querystring['url']=="karnataka"
                        if ( @$session_querystring[ 'e' ] == "in" ) {
                            redirect( 'Dashboard?section=' . @$session_querystring[ 'section' ] );
                        }
                        if ( @$session_querystring[ 'e' ] == "mp" ) {
                            redirect( 'MP/Dashboard?section=' . @$session_querystring[ 'section' ] );
                        }
                        if ( @$session_querystring[ 'e' ] == "ch" ) {
                            redirect( 'Chhattisgarh/Dashboard?section=' . @$session_querystring[ 'section' ] );
                        }
                        if ( @$session_querystring[ 'e' ] == "rj" ) {
                            redirect( 'Rajasthan/Dashboard?section=' . @$session_querystring[ 'section' ] );
                        }
                        if ( @$session_querystring[ 'e' ] == "tel" ) {
                            redirect( 'Telangana/Dashboard?section=' . @$session_querystring[ 'section' ] );
                        }
                        if ( @$session_querystring[ 'e' ] == "ap" ) {
                            redirect( 'AP/Dashboard?section=' . @$session_querystring[ 'section' ] );
                        } else {
                            redirect( 'Dashboard?section=' . @$session_querystring[ 'section' ] );
                        }
                    } else if ( @$session_querystring[ 'section' ] == "walldetail" ) {
                        $vid = $session_querystring[ 'vid' ];
                        if ( isset( $vid ) && $vid != "" ) {
                            redirect( "Wall/detail/$vid" );
                        } else {
                            redirect( "Index" );
                        }
                    } else if ( $session_querystring[ 'section' ] == "discussion" ) {
                        redirect( 'Forum' );
                    } else if ( $session_querystring[ 'section' ] == "poll" ) {
                        $pid = "";
                        if ( @$session_querystring[ 'pid' ] ) {
                            $pid = @$session_querystring[ 'pid' ];
                        }
                        if ( @$session_querystring[ 'p' ] == "gov" ) {
                            //redirect('Poll?ct=Governance&pid=' . $pid);
                            $redirect_uri = ($pid == "") ? "Poll?ct=Governance" : "Poll/polldetail/$pid?t=" . time() . "&ct=Governance";
                            redirect( $redirect_uri );
                        } else if ( @$session_querystring[ 'p' ] == "mon" ) {
                            //redirect('Poll?ct=Money&pid=' . $pid);
                            $redirect_uri = ($pid == "") ? "Poll?ct=Money" : "Poll/polldetail/$pid?t=" . time() . "&ct=Money";
                            redirect( $redirect_uri );
                        } else if ( @$session_querystring[ 'p' ] == "spo" ) {
                            //redirect('Poll?ct=Sports&pid=' . $pid);
                            $redirect_uri = ($pid == "") ? "Poll?ct=Sports" : "Poll/polldetail/$pid?t=" . time() . "&ct=Sports";
                            redirect( $redirect_uri );
                        } else if ( @$session_querystring[ 'p' ] == "ent" ) {
                            $redirect_uri = ($pid == "") ? "Poll?ct=Entertainment" : "Poll/polldetail/$pid?t=" . time() . "&ct=Entertainment";
                            redirect( $redirect_uri );
                        } else if ( @$session_querystring[ 'p' ] == "myp" ) {
                            redirect( 'Poll/#mydiscuss' );
                        } else if ( @$session_querystring[ 'p' ] == "pdp" ) {
                            $id = $session_querystring[ 'id' ];
                            $view = $session_querystring[ 'view' ];
                            redirect( 'Poll/polldetail/' . $id . '#' . $view );
                        } else {
                            redirect( 'Poll' );
                        }
                    } else if ( $session_querystring[ 'section' ] == "sc" || $session_querystring[ 'section' ] == "wkt" ) {
                        redirect( 'Sports/Dashboard?section=' . $session_querystring[ 'section' ] );
                    } else if ( $session_querystring[ 'section' ] == "survey" ) {
                        $sid = "";
                        if ( @$session_querystring[ 'pid' ] ) {
                            $sid = @$session_querystring[ 'pid' ];
                        }
                        if ( $sid != "" ) {
                            redirect( 'Survey/surveydetail/' . $sid );
                        } else {
                            redirect( 'Survey' );
                        }
                    } else if ( $session_querystring[ 'section' ] == "article" ) {
                        $aid = "";
                        if ( @$session_querystring[ 'pid' ] ) {
                            $aid = @$session_querystring[ 'pid' ];
                        }
                        if ( $aid != "" ) {
                            redirect( "RatedArticle/articledetail/$aid" );
                        } else {
                            redirect( 'RatedArticle' );
                        }
                    } else if ( $session_querystring[ 'section' ] == "home" ) {
                        redirect( 'Index' );
                    } else if ( $session_querystring[ 'section' ] == "voice" ) {
                        redirect( "YourVoice" );
                    } else if ( $session_querystring[ 'section' ] == "voicedetail" && isset( $session_querystring[ 'vid' ] ) ) {
                        redirect( "YourVoice/blog_detail/" . $session_querystring[ 'vid' ] );
                    } else if ( $session_querystring[ 'section' ] == "predictiondetail" && isset( $session_querystring[ 'vid' ] ) ) {
                        redirect( "Predictions/details/" . $session_querystring[ 'vid' ] );
                    } else {
                        redirect( 'Index' );
                    }
                }
            } else {
                redirect( 'Login' );
            }
        } else {
            $this -> logout();
        }
    }

    //Facebook Login
    public function fblogin() {

        $inputs = $this -> input -> post();
        $user_name = $inputs[ 'name' ];
        $socialid = $inputs[ 'user_id' ];
        $user_email = isset( $inputs[ 'user_email' ] ) ? $inputs[ 'user_email' ] : "";
        $login_type = "Facebook";

        $this -> db -> select( "id,alise,location,party_affiliation,certificate_path,unearned_points,tnc_agree" );
        $this -> db -> from( "users" );
        $this -> db -> where( "social_id = '$socialid' AND login_type = '$login_type'" );
        $result = $this -> db -> get();

        $is_exists = $result -> num_rows();

        /* Userdata */
        $userdata = array (
            "name" => $user_name,
            "social_id" => $socialid,
            "email" => $user_email,
            "login_type" => $login_type,
                //"unearned_points" => "35"
        );

        if ( $is_exists == 0 ) {
            /* Insert user data and set session */
            $this -> db -> insert( 'users', $userdata );
            $userid = $this -> db -> insert_id();
            $userdata[ 'uid' ] = $userid;
            $userdata[ 'alise' ] = "";
            $userdata[ 'location' ] = "";
            $userdata[ 'party_affiliation' ] = "";
            $userdata[ 'certificate_path' ] = "";
            $userdata[ 'silver_points' ] = "0";
            $userdata[ 'tnc_agree' ] = "0";
        } else {
            $data = $result -> row_array();
            $userdata[ 'uid' ] = $data[ 'id' ];
            $userdata[ 'alise' ] = $data[ 'alise' ];
            $userdata[ 'location' ] = $data[ 'location' ];
            $userdata[ 'party_affiliation' ] = $data[ 'party_affiliation' ];
            $userdata[ 'certificate_path' ] = $data[ 'certificate_path' ];
            $userdata[ 'silver_points' ] = $data[ 'unearned_points' ];
            $userdata[ 'tnc_agree' ] = $data[ 'tnc_agree' ];
        }

        $_SESSION[ 'data' ] = $userdata;

        if ( ! empty( $_SESSION[ 'data' ] ) ) {
            $session_querystring = $this -> session -> userdata( 'querystring' );
            if ( $_SESSION[ 'data' ][ 'tnc_agree' ] == "0" ) {
                echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => "TnC" ) );
            } else if ( $_SESSION[ 'data' ][ 'alise' ] == "" && $_SESSION[ 'data' ][ 'location' ] == "" && $session_querystring[ 'section' ] != "sc" && $session_querystring[ 'section' ] != "wkt" ) {
                echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => "Wallet/update_profile" ) );
            } else {
                $redirect_url = "";
                if ( @$session_querystring[ 'section' ] == "home" ) { /* Home section */
                    $redirect_url = "Index";
                    echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => $redirect_url ) );
                } else if ( @$session_querystring[ 'section' ] == "wallet" ) { /* wallet section */
                    echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => "Wallet" ) );
                } else if ( @$session_querystring[ 'section' ] == "question" ) { /* Question section */
                    $vid = @$session_querystring[ 'vid' ];
                    if ( isset( $vid ) && $vid != "" ) {
                        $redirect_url = "AskQuestions/details/$vid";
                    } else {
                        $redirect_url = "AskQuestions";
                    }
                    echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => $redirect_url ) );
                } else if ( @$session_querystring[ 'section' ] == "web" ) { /* from the web section */
                    $vid = @$session_querystring[ 'vid' ];
                    $type = @$session_querystring[ 'type' ];
                    if ( isset( $vid ) && $vid != "" ) {
                        $redirect_url = "AskQuestions/details/$vid";
                    } else if ( isset( $type ) && $type == "post" ) {
                        $redirect_url = "FromTheWeb/post_article";
                    } else {
                        $redirect_url = "AskQuestions";
                    }
                    echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => $redirect_url ) );
                } else if ( isset( $session_querystring[ 'section' ] ) && ($session_querystring[ 'section' ] == "seat" || $session_querystring[ 'section' ] == "vote") ) { //&& $session_querystring['url']=="karnataka"
                    if ( @$session_querystring[ 'e' ] == "in" ) {
                        $redirect_url = "Dashboard?section=" . @$session_querystring[ 'section' ];
                    }
                    if ( @$session_querystring[ 'e' ] == "mp" ) {
                        $redirect_url = "MP/Dashboard?section=" . @$session_querystring[ 'section' ];
                    }
                    if ( @$session_querystring[ 'e' ] == "ch" ) {
                        $redirect_url = "Chhattisgarh/Dashboard?section=" . @$session_querystring[ 'section' ];
                    }
                    if ( @$session_querystring[ 'e' ] == "rj" ) {
                        $redirect_url = "Rajasthan/Dashboard?section=" . @$session_querystring[ 'section' ];
                    }
                    if ( @$session_querystring[ 'e' ] == "tel" ) {
                        $redirect_url = "Telangana/Dashboard?section=" . @$session_querystring[ 'section' ];
                    }
                    if ( @$session_querystring[ 'e' ] == "ap" ) {
                        $redirect_url = "AP/Dashboard?section=" . @$session_querystring[ 'section' ];
                    } else {
                        $redirect_url = "Dashboard?section=" . @$session_querystring[ 'section' ];
                    }
                    echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => $redirect_url ) );
                } else if ( @$session_querystring[ 'section' ] == "walldetail" ) {
                    $vid = @$session_querystring[ 'vid' ];
                    if ( isset( $vid ) && $vid != "" ) {
                        $redirect_url = "Wall/detail/$vid";
                    } else {
                        $redirect_url = "Index";
                    }
                    echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => $redirect_url ) );
                } else if ( $session_querystring[ 'section' ] == "discussion" ) {
                    echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => "Forum" ) );
                } else if ( $session_querystring[ 'section' ] == "poll" ) {
                    $pid = "";
                    if ( @$session_querystring[ 'pid' ] ) {
                        $pid = @$session_querystring[ 'pid' ];
                    }
                    if ( @$session_querystring[ 'p' ] == "gov" ) {
                        $redirect_uri = ($pid == "") ? "Poll?ct=Governance" : "Poll/polldetail/$pid?t=" . time() . "&ct=Governance";
                        echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => $redirect_uri ) );
                    } else if ( @$session_querystring[ 'p' ] == "mon" ) {
                        $redirect_uri = ($pid == "") ? "Poll?ct=Money" : "Poll/polldetail/$pid?t=" . time() . "&ct=Money";
                        echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => $redirect_uri ) );
                    } else if ( @$session_querystring[ 'p' ] == "spo" ) {
                        $redirect_uri = ($pid == "") ? "Poll?ct=Sports" : "Poll/polldetail/$pid?t=" . time() . "&ct=Sports";
                        echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => $redirect_uri ) );
                    } else if ( @$session_querystring[ 'p' ] == "ent" ) {
                        $redirect_uri = ($pid == "") ? "Poll?ct=Entertainment" : "Poll/polldetail/$pid?t=" . time() . "&ct=Entertainment";
                        echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => $redirect_uri ) );
                    } else if ( @$session_querystring[ 'p' ] == "myp" ) {
                        echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => "Poll/#mydiscuss" . $pid ) );
                    } else if ( @$session_querystring[ 'p' ] == "pdp" ) {
                        $id = $session_querystring[ 'id' ];
                        $view = $session_querystring[ 'view' ];
                        echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => "Poll/polldetail/" . $pid . '#' . $view ) );
                    } else {
                        echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => "Poll" ) );
                    }
                } else if ( $session_querystring[ 'section' ] == "sc" || $session_querystring[ 'section' ] == "wkt" ) {
                    echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => "Sports/Dashboard?section=" . $session_querystring[ 'section' ] ) );
                } else if ( $session_querystring[ 'section' ] == "survey" ) {
                    $sid = "";
                    if ( @$session_querystring[ 'pid' ] ) {
                        $sid = @$session_querystring[ 'pid' ];
                    }
                    if ( $sid != "" ) {
                        echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => "Survey/surveydetail/$sid" ) );
                    } else {
                        echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => "Survey" ) );
                    }
                } else if ( $session_querystring[ 'section' ] == "article" ) {
                    $aid = "";
                    if ( @$session_querystring[ 'pid' ] ) {
                        $aid = @$session_querystring[ 'pid' ];
                    }
                    if ( $aid != "" ) {
                        echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => "RatedArticle/articledetail/$aid" ) );
                    } else {
                        echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => "RatedArticle" ) );
                    }
                } else if ( $session_querystring[ 'section' ] == "home" ) {
                    echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => base_url() ) );
                } else if ( $session_querystring[ 'section' ] == "voice" ) {
                    echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => "YourVoice" ) );
                } else if ( $session_querystring[ 'section' ] == "voicedetail" && isset( $session_querystring[ 'vid' ] ) ) {
                    echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => "YourVoice/blog_detail/" . $session_querystring[ 'vid' ] ) );
                } else if ( $session_querystring[ 'section' ] == "predictiondetail" && isset( $session_querystring[ 'vid' ] ) ) {
                    echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => "Predictions/details/" . $session_querystring[ 'vid' ] ) );
                } else {
                    //echo json_encode(array("status" => TRUE, "message" => "", "redirect_url" => "Stock/ForecastDetails"));
                    echo json_encode( array ( "status" => TRUE, "message" => "", "redirect_url" => "Index" ) );
                }
            }
        } else {
            echo json_encode( array ( "status" => FALSE, "message" => "", "redirect_url" => "Login" ) );
        }
    }

    public function googlelogin() {

        require_once APPPATH . 'libraries/src/Google_Client.php';
        require_once APPPATH . 'libraries/src/contrib/Google_Oauth2Service.php';


        $google_client_id = '868573622771-nvhrhff2fi5ls11blfahgvqu6qhnrgvi.apps.googleusercontent.com';
        $google_client_secret = 'GVxMpRks594S97UVKZ9_Ki9L';

        $google_redirect_url = base_url() . 'Login/googleloginresponse';

        $gClient = new Google_Client();
        $gClient -> setApplicationName( 'CrowdWisdom' );
        $gClient -> setClientId( $google_client_id );
        $gClient -> setScopes( 'email' );
        $gClient -> setClientSecret( $google_client_secret );
        $gClient -> setRedirectUri( $google_redirect_url );

        $authUrl = $gClient -> createAuthUrl();

        if ( isset( $authUrl ) ) {
            header( 'Location: ' . filter_var( $authUrl, FILTER_SANITIZE_URL ) );
        }
    }

    public function googleloginresponse() {
        require_once APPPATH . 'libraries/src/Google_Client.php';
        require_once APPPATH . 'libraries/src/contrib/Google_Oauth2Service.php';


        $google_client_id = '868573622771-nvhrhff2fi5ls11blfahgvqu6qhnrgvi.apps.googleusercontent.com';
        $google_client_secret = 'GVxMpRks594S97UVKZ9_Ki9L';

        $google_redirect_url = base_url() . 'Login/googleloginresponse'; // Localhost URL 
        $login_redirect_url = base_url() . 'Login'; // Localhost Login Redirect URL


        $gClient = new Google_Client();
        $gClient -> setApplicationName( 'CrowdWisdom' );
        $gClient -> setClientId( $google_client_id );
        $gClient -> setClientSecret( $google_client_secret );
        $gClient -> setRedirectUri( $google_redirect_url );
        //$gClient->setDeveloperKey($google_developer_key);

        $google_oauthV2 = new Google_Oauth2Service( $gClient );

        //If user wish to log out, we just unset Session variable
        if ( isset( $_REQUEST[ 'reset' ] ) ) {
            unset( $_SESSION[ 'token' ] );
            $gClient -> revokeToken();
            header( 'Location: ' . filter_var( $login_redirect_url, FILTER_SANITIZE_URL ) ); //redirect user back to page
        }

        //If code is empty, redirect user to google authentication page for code.
        //Code is required to aquire Access Token from google
        //Once we have access token, assign token to session variable
        //and we can redirect user back to page and login.
        if ( isset( $_GET[ 'code' ] ) ) {
            $gClient -> authenticate( $_GET[ 'code' ] );
            $_SESSION[ 'token' ] = $gClient -> getAccessToken();
            header( 'Location: ' . filter_var( $google_redirect_url, FILTER_SANITIZE_URL ) );
            return;
        }


        if ( isset( $_SESSION[ 'token' ] ) ) {
            $gClient -> setAccessToken( $_SESSION[ 'token' ] );
        }

        if ( $gClient -> getAccessToken() ) {
            //For logged in user, get details from google using access token
            $user = $google_oauthV2 -> userinfo -> get();

            $_SESSION[ 'token' ] = $gClient -> getAccessToken();

            if ( ! empty( $user ) && ! empty( $user[ 'email' ] ) ) {
                $user_id = $user[ 'id' ];
                if ( empty( $user[ 'name' ] ) ) {
                    $user_name = "";
                } else {
                    $user_name = $user[ 'name' ];
                }

                $user_email = $user[ 'email' ];
                $socialid = $user[ 'id' ];
                $login_type = "Google";

                //check if google id or email exists in the database
                //$response = $this->User_model->checkgooglelogin($googleid, $email); // Call API

                $this -> db -> select( "id,alise,location,party_affiliation,certificate_path,unearned_points,tnc_agree" );
                $this -> db -> from( "users" );
                $this -> db -> where( "social_id = '$socialid' AND login_type = '$login_type'" );
                $result = $this -> db -> get();

                $is_exists = $result -> num_rows();

                /* Userdata */
                $userdata = array (
                    "name" => $user_name,
                    "social_id" => $socialid,
                    "email" => $user_email,
                    "login_type" => $login_type,
                        // "unearned_points" => "35"
                );

                if ( $is_exists == 0 ) {
                    /* Insert user data and set session */
                    $this -> db -> insert( 'users', $userdata );
                    $userid = $this -> db -> insert_id();
                    $userdata[ 'uid' ] = $userid;
                    $userdata[ 'alise' ] = "";
                    $userdata[ 'location' ] = "";
                    $userdata[ 'certificate_path' ] = "";
                    $userdata[ 'silver_points' ] = "0";
                    $userdata[ 'tnc_agree' ] = "0";
                } else {
                    $data = $result -> row_array();
                    $userdata[ 'uid' ] = $data[ 'id' ];
                    $userdata[ 'alise' ] = $data[ 'alise' ];
                    $userdata[ 'location' ] = $data[ 'location' ];
                    $userdata[ 'party_affiliation' ] = $data[ 'party_affiliation' ];
                    $userdata[ 'certificate_path' ] = $data[ 'certificate_path' ];
                    $userdata[ 'silver_points' ] = $data[ 'unearned_points' ];
                    $userdata[ 'tnc_agree' ] = $data[ 'tnc_agree' ];
                }

                $_SESSION[ 'data' ] = $userdata;

                if ( ! empty( $_SESSION[ 'data' ] ) ) {
                    $session_querystring = $this -> session -> userdata( 'querystring' );

                    if ( $_SESSION[ 'data' ][ 'tnc_agree' ] == "0" ) {
                        redirect( 'TnC' );
                    } else if ( $_SESSION[ 'data' ][ 'alise' ] == "" && $_SESSION[ 'data' ][ 'location' ] == "" && @$session_querystring[ 'section' ] != "sc" && @$session_querystring[ 'section' ] != "wkt" ) {
                        redirect( 'Wallet/update_profile' );
                    } else {
                        if ( $session_querystring[ 'section' ] == "home" ) { /* Home section */
                            redirect( "Index" );
                        } else if ( @$session_querystring[ 'section' ] == "wallet" ) { /* wallet section */
                            redirect( "Wallet" );
                        } else if ( $session_querystring[ 'section' ] == "question" ) { /* Question section */
                            redirect( "AskQuestions" );
                        } else if ( $session_querystring[ 'section' ] == "createquestion" ) { /* create Question section */
                            redirect( "AskQuestions/raise_question" );
                        } else if ( $session_querystring[ 'section' ] == "questiondetail" ) {/* Question detail section */
                            $vid = $session_querystring[ 'vid' ];
                            if ( isset( $vid ) && $vid != "" ) {
                                redirect( "AskQuestions/details/$vid" );
                            } else {
                                redirect( "AskQuestions" );
                            }
                        } else if ( $session_querystring[ 'section' ] == "predictions" ) {/* Prediction section */
                            redirect( "Predictions" );
                        } else if ( $session_querystring[ 'section' ] == "predictiondetail" ) {/* Prediction detail section */
                            $vid = $session_querystring[ 'vid' ];
                            if ( isset( $vid ) && $vid != "" ) {
                                redirect( "Predictions/details/$vid" );
                            } else {
                                redirect( "Predictions" );
                            }
                        } else if ( $session_querystring[ 'section' ] == "web" ) {
                            $vid = $session_querystring[ 'vid' ];
                            $type = $session_querystring[ 'type' ];
                            if ( isset( $vid ) && $vid != "" ) {
                                redirect( "FromTheWeb/detail/$vid" );
                            } else if ( isset( $type ) && $type == "post" ) {
                                redirect( "FromTheWeb/post_article" );
                            } else {
                                redirect( "FromTheWeb" );
                            }
                        } else if ( @$session_querystring[ 'section' ] == "seat" ) { //&& $session_querystring['url']=="karnataka"
                            if ( @$session_querystring[ 'e' ] == "in" ) {
                                redirect( "Dashboard?section=" . @$session_querystring[ 'section' ] );
                            }
                            if ( @$session_querystring[ 'e' ] == "mp" ) {
                                redirect( 'MP/Dashboard?section=' . @$session_querystring[ 'section' ] );
                            }
                            if ( @$session_querystring[ 'e' ] == "ch" ) {
                                redirect( 'Chhattisgarh/Dashboard?section=' . @$session_querystring[ 'section' ] );
                            }
                            if ( @$session_querystring[ 'e' ] == "rj" ) {
                                redirect( 'Rajasthan/Dashboard?section=' . @$session_querystring[ 'section' ] );
                            }
                            if ( @$session_querystring[ 'e' ] == "tel" ) {
                                redirect( 'Telangana/Dashboard?section=' . @$session_querystring[ 'section' ] );
                            }
                            if ( @$session_querystring[ 'e' ] == "ap" ) {
                                redirect( 'AP/Dashboard?section=' . @$session_querystring[ 'section' ] );
                            } else {
                                redirect( 'Dashboard?section=' . @$session_querystring[ 'section' ] );
                            }
                        } else if ( @$session_querystring[ 'section' ] == "walldetail" ) {
                            $vid = $session_querystring[ 'vid' ];
                            if ( isset( $vid ) && $vid != "" ) {
                                redirect( "Wall/detail/$vid" );
                            } else {
                                redirect( "Index" );
                            }
                        } else if ( @$session_querystring[ 'section' ] == "discussion" ) {
                            redirect( 'Forum' );
                        } else if ( @$session_querystring[ 'section' ] == "poll" ) {
                            $pid = "";
                            if ( @$session_querystring[ 'pid' ] ) {
                                $pid = @$session_querystring[ 'pid' ];
                            }
                            if ( @$session_querystring[ 'p' ] == "gov" ) {
                                //redirect('Poll?ct=Governance&pid=' . $pid);
                                $redirect_uri = ($pid == "") ? "Poll?ct=Governance" : "Poll/polldetail/$pid?t=" . time() . "&ct=Governance";
                                redirect( $redirect_uri );
                            }
                            if ( @$session_querystring[ 'p' ] == "mon" ) {
                                //redirect('Poll?ct=Money&pid=' . $pid);
                                $redirect_uri = ($pid == "") ? "Poll?ct=Money" : "Poll/polldetail/$pid?t=" . time() . "&ct=Money";
                                redirect( $redirect_uri );
                            }
                            if ( @$session_querystring[ 'p' ] == "spo" ) {
                                //redirect('Poll?ct=Sports&pid=' . $pid);
                                $redirect_uri = ($pid == "") ? "Poll?ct=Sports" : "Poll/polldetail/$pid?t=" . time() . "&ct=Sports";
                                redirect( $redirect_uri );
                            }
                            if ( @$session_querystring[ 'p' ] == "ent" ) {
                                //redirect('Poll?ct=Entertainment&pid=' . $pid);
                                $redirect_uri = ($pid == "") ? "Poll?ct=Entertainment" : "Poll/polldetail/$pid?t=" . time() . "&ct=Entertainment";
                                redirect( $redirect_uri );
                            }
                            if ( @$session_querystring[ 'p' ] == "myp" ) {
                                redirect( 'Poll/#mydiscuss' );
                            }
                            if ( @$session_querystring[ 'p' ] == "pdp" ) {
                                $id = @$session_querystring[ 'id' ];
                                $view = @$session_querystring[ 'view' ];
                                redirect( 'Poll/polldetail/' . $id . '#' . $view );
                            } else {
                                redirect( 'Poll' );
                            }
                        } else if ( @$session_querystring[ 'section' ] == "sc" || @$session_querystring[ 'section' ] == "wkt" ) {
                            redirect( 'Sports/Dashboard?section=' . @$session_querystring[ 'section' ] );
                        } else if ( @$session_querystring[ 'section' ] == "survey" ) {
                            $sid = "";
                            if ( @$session_querystring[ 'pid' ] ) {
                                $sid = @$session_querystring[ 'pid' ];
                            }
                            if ( $sid != "" ) {
                                redirect( 'Survey/surveydetail/' . $sid );
                            } else {
                                redirect( 'Survey' );
                            }
                        } else if ( @$session_querystring[ 'section' ] == "article" ) {
                            $aid = "";
                            if ( @$session_querystring[ 'pid' ] ) {
                                $aid = @$session_querystring[ 'pid' ];
                            }
                            if ( $aid != "" ) {
                                redirect( "RatedArticle/articledetail/$aid" );
                            } else {
                                redirect( 'RatedArticle' );
                            }
                            redirect( 'RatedArticle' );
                        } else if ( @$session_querystring[ 'section' ] == "home" ) {
                            redirect( 'Index' );
                        } else if ( @$session_querystring[ 'section' ] == "voice" ) {
                            redirect( 'YourVoice' );
                        } else if ( @$session_querystring[ 'section' ] == "voicedetail" && isset( $session_querystring[ 'vid' ] ) ) {
                            redirect( "YourVoice/blog_detail/" . $session_querystring[ 'vid' ] );
                        } else if ( @$session_querystring[ 'section' ] == "predictiondetail" && isset( $session_querystring[ 'vid' ] ) ) {
                            redirect( "Predictions/details/" . $session_querystring[ 'vid' ] );
                        } else {
                            redirect( 'Index' );
                        }
                    }
                } else {
                    redirect( 'Login' );
                }
            }
        } else {
            header( 'Location: ' . filter_var( $login_redirect_url, FILTER_SANITIZE_URL ) );
        }
    }

    function logout( $logout_section = "" ) {

        $redirect_to = "Index";
        $session_querystring = $this -> session -> userdata( 'querystring' );

        if ( $logout_section != "" ) {
            $logout_uri = explode( "_", $logout_section );
            if ( $logout_uri[ 0 ] == "seat" ) {
                $redirect_to = "Allindia/Home?a=1";
            } else if ( $logout_uri[ 0 ] == "tel" ) {
                $redirect_to = "Telangana/Home?a=" . time();
            } else if ( $logout_uri[ 0 ] == "Survey" ) {
                $redirect_to = "Survey";
            } else if ( $logout_uri[ 0 ] == "Article" ) {
                $redirect_to = "RatedArticle";
            } else if ( $logout_uri[ 0 ] == "P" ) {
                $redirect_to = "Poll?ct=" . @$logout_uri[ 1 ];
            } else {
                $redirect_to = "Index";
            }
        } else if ( isset( $session_querystring[ 'section' ] ) ) {
            if ( $session_querystring[ 'section' ] == "sc" && $session_querystring[ 'section' ] == "wkt" ) {
                $redirect_to = 'Wallet';
            } else {
                if ( $session_querystring[ 'section' ] == "seat" || $session_querystring[ 'section' ] == "vote" ) { //&& $session_querystring['url']=="karnataka"
                    if ( $this -> input -> get( 'e' ) == "in" ) {
                        $redirect_to = 'Dashboard?section=' . $session_querystring[ 'section' ];
                    }
                    if ( $this -> input -> get( 'e' ) == "mp" ) {
                        $redirect_to = 'MP/Dashboard?section=' . $session_querystring[ 'section' ];
                    }
                    if ( $this -> input -> get( 'e' ) == "ch" ) {
                        $redirect_to = 'Chhattisgarh/Dashboard?section=' . $session_querystring[ 'section' ];
                    }
                    if ( $this -> input -> get( 'e' ) == "rj" ) {
                        $redirect_to = 'Rajasthan/Dashboard?section=' . $session_querystring[ 'section' ];
                    } else {
                        $redirect_to = 'Dashboard?section=' . $session_querystring[ 'section' ];
                    }
                } else if ( $session_querystring[ 'section' ] == "discussion" ) {
                    $redirect_to = 'Forum';
                } else if ( $session_querystring[ 'section' ] == "poll" ) {
                    $pid = "";
                    if ( @$session_querystring[ 'pid' ] ) {
                        $pid = @$session_querystring[ 'pid' ];
                    }
                    if ( @$session_querystring[ 'p' ] == "gov" ) {
                        $redirect_to = 'Poll?ct=Governance&pid=' . $pid;
                    } else if ( @$session_querystring[ 'p' ] == "mon" ) {
                        $redirect_to = 'Poll?ct=Money&pid=' . $pid;
                    } else if ( @$session_querystring[ 'p' ] == "spo" ) {
                        $redirect_to = 'Poll?ct=Sports&pid=' . $pid;
                    } else if ( @$session_querystring[ 'p' ] == "ent" ) {
                        $redirect_to = 'Poll?ct=Entertainment&pid=' . $pid;
                    } else if ( @$session_querystring[ 'p' ] == "myp" ) {
                        $redirect_to = 'Poll/#mydiscuss';
                    } else if ( @$session_querystring[ 'p' ] == "pdp" ) {
                        $id = $session_querystring[ 'id' ];
                        $view = $session_querystring[ 'view' ];
                        $redirect_to = 'Poll/polldetail/' . $id . '#' . $view;
                    } else {
                        $redirect_to = 'NewHome/prediction';
                    }
                } else if ( $session_querystring[ 'section' ] == "sc" || $session_querystring[ 'section' ] == "wkt" ) {
                    $redirect_to = 'Sports/Dashboard?section=' . $session_querystring[ 'section' ];
                } else if ( $session_querystring[ 'section' ] == "survey" ) {
                    $redirect_to = 'Survey';
                } else if ( $session_querystring[ 'section' ] == "article" ) {
                    $redirect_to = 'RatedArticle';
                } else if ( $session_querystring[ 'section' ] == "home" ) {
                    $redirect_to = 'Index';
                } else if ( $session_querystring[ 'section' ] == "voice" ) {
                    $redirect_to = 'YourVoice';
                } else if ( $session_querystring[ 'section' ] == "voicedetail" && isset( $session_querystring[ 'vid' ] ) ) {
                    $redirect_to = 'YourVoice/blog_detail/' . $session_querystring[ 'vid' ];
                } else if ( @$session_querystring[ 'section' ] == "voicedetail" && isset( $session_querystring[ 'vid' ] ) ) {
                    redirect( "Predictions/detail/" . $session_querystring[ 'vid' ] );
                } else {
                    $redirect_to = 'Index';
                }
            }
        }
        session_destroy();
        session_unset();
        redirect( $redirect_to );
    }

    public function privacy_policy() {
        $header_data[ 'page_title' ] = "Privacy Policy";
        $header_data[ 'page_img' ] = base_url( "images/logo/prediction_share_logo.png" );
        $header_data[ 'uid' ] = 0;
        $header_data[ 'silver_points' ] = 0;
        $header_data[ 'alias' ] = "";
        $header_data[ 'page_meta_keywords' ] = "";
        $header_data[ 'page_meta_description' ] = "";

        $this -> load -> view( "bootstrap_header", $header_data );
        $this -> load -> view( "privacy_policy" );
        $this -> load -> view( "bootstrap_footer" );
    }

}
