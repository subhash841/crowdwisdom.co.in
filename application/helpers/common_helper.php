<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* Get Current sport period */

function get_current_sport_period( $id ) {
    $CI = & get_instance();

    $CI -> db -> select( "id, from_date, to_date, sport_id, is_result_out" );
    $CI -> db -> from( "sports_period" );
    $CI -> db -> where( "is_active = '1' AND id = '$id'" );
    $election_period = $CI -> db -> get() -> result_array();
    return $election_period;
}

/* Get Current election period */

function get_current_election_period_other( $id ) {
    $CI = & get_instance();

    $CI -> db -> select( "id, from_date, to_date, is_result_out, state_id, total_seats" );
    $CI -> db -> from( "election_period" );
    $CI -> db -> where( "is_active = '1' AND id = '$id'" );
    $election_period = $CI -> db -> get() -> result_array();
    return $election_period;
}

function get_current_election_period() {
    $CI = & get_instance();

    $CI -> db -> select( "id, from_date, to_date, is_result_out, state_id, total_seats" );
    $CI -> db -> from( "election_period" );
    $CI -> db -> where( "is_active = '1' AND id = '3'" );
    $election_period = $CI -> db -> get() -> result_array();
    return $election_period;
}

function get_election_period() {
    $CI = & get_instance();

    $CI -> db -> select( "id,from_date,to_date,is_result_out, state_id, total_seats" );
    $CI -> db -> from( "election_period" );
    $CI -> db -> where( "is_active = '1' AND id = '2'" );
    $election_period = $CI -> db -> get() -> result_array();
    return $election_period;
}

function get_all_states() {
    $CI = & get_instance();

    $CI -> db -> select( "id,name" );
    $CI -> db -> from( "states" );
    $all_states = $CI -> db -> get() -> result_array();
    return $all_states;
}

function get_states() {
    $CI = & get_instance();

    $CI -> db -> select( "id,name" );
    $CI -> db -> from( "states" );
    $CI -> db -> where( "is_active = '1'" );
    $states = $CI -> db -> get() -> result_array();
    return $states;
}

function get_parties() {
    $CI = & get_instance();

    $CI -> db -> select( "id,name,abbreviation,icon" );
    $CI -> db -> from( "parties" );
    $CI -> db -> where( "is_active = '1'" );
    $parties = $CI -> db -> get() -> result_array();
    return $parties;
}

function getConstituencies( $state_id ) {
    $CI = & get_instance();

    $CI -> db -> select( "id,state_id,name" );
    $CI -> db -> from( "constituencies" );
    $CI -> db -> where( "is_active = '1' AND state_id = '$state_id'" );
    $constituencies = $CI -> db -> get() -> result_array();
    return $constituencies;
}

function getUserDetail( $uid ) {
    $CI = & get_instance();

    $CI -> db -> select( "*" );
    $CI -> db -> from( "users" );
    $CI -> db -> where( "id = '$uid'" );
    $userdetail = $CI -> db -> get() -> row_array();
    //$userdetail = $CI->db->get()->result_array();
    return $userdetail;
}

function getUserListing() {
    $CI = & get_instance();

    $CI -> db -> select( "*" );
    $CI -> db -> from( "users" );
    $userdata = $CI -> db -> get() -> result_array();
    return $userdata;
}

function getAllBlogs() {
    $CI = & get_instance();

    $CI -> db -> select( "b.*,bs.name as sub_category,bc.name as category_name" );
    $CI -> db -> from( "blogs b" );
    $CI -> db -> join( "blog_subcategory bs", 'bs.id=b.sub_category_id', 'LEFT' );
    $CI -> db -> join( 'blog_category bc', 'bc.id=b.category_id' );
    $CI -> db -> where( "b.is_active = '1'" );
    $CI -> db -> order_by( 'b.blog_order', 'asc' );
    $CI -> db -> limit( 10 );
    $blogsdata = $CI -> db -> get() -> result_array();
    return $blogsdata;
}

function get_twitter_tweets( $hashtag ) {
    require_once APPPATH . 'libraries/twitteroauth/OAuth.php';
    require_once APPPATH . 'libraries/twitteroauth/TwitterOAuth.php';

    define( 'CONSUMER_KEY', 'ULpQloiD7Cc5Tig4RVjzBE7Qp' );
    define( 'CONSUMER_SECRET', 'QTsBYnWrhODkPtmuM3kpdnaDZWoGVuRFFeMEbFmEtUsNPLN7mF' );
    define( 'ACCESS_TOKEN', '938676930483707904-nsRb8yAZcmbCqI6W0toM7HQwKIJ8FRk' );
    define( 'ACCESS_TOKEN_SECRET', 'nRu1GVNGQzWYVgDD5i3LYncYMrf6PCpKYyFw46k3DsGHR' );

    $toa = new TwitterOAuth( CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET );

    $query = array (
        "q" => $hashtag,
        "result_type" => "recent",
        "count" => 10
    );
    $results = $toa -> get( 'search/tweets', $query );
    $tweets = ( array ) $results -> statuses;
    return $tweets;
}

function get_all_certified_users() {
    $CI = & get_instance();

    $CI -> db -> select( "u.id,u.name,u.twitter_id,uer.points" );
    $CI -> db -> from( "user_election_rankings uer" );
    $CI -> db -> join( "users u", "u.id = uer.user_id", "INNER" );
    $CI -> db -> where( "election_period_id = 2" );
    $CI -> db -> order_by( "uer.points DESC" );
    $all_certified_users = $CI -> db -> get() -> result_array();
    return $all_certified_users;
}

function get_certified_users( $offset = 0 ) {
    $CI = & get_instance();

    $CI -> db -> select( "u.id,u.name,u.twitter_id,uer.points" );
    $CI -> db -> from( "user_election_rankings uer" );
    $CI -> db -> join( "users u", "u.id = uer.user_id", "INNER" );
    $CI -> db -> order_by( "uer.points DESC" );
    $CI -> db -> limit( "10" );
    $CI -> db -> offset( $offset );
    $certified_users = $CI -> db -> get() -> result_array();
    return $certified_users;
}

function get_certified_users_count() {
    $CI = & get_instance();

    $CI -> db -> select( "count(1) as total_certified" );
    $CI -> db -> from( "user_election_rankings uer" );
    $CI -> db -> join( "users u", "u.id = uer.user_id", "INNER" );
    $CI -> db -> order_by( "uer.points DESC" );
    $certified_users_count = $CI -> db -> get() -> row_array();
    return $certified_users_count;
}

function createcertificate( $text, $id, $twitter_id ) {
    $newImage = imagecreatefromjpeg( 'images/common/crowd-wisdom-certificate.jpg' );
    $txtColor = imagecolorallocate( $newImage, 7, 14, 182 );
    $dtColor = imagecolorallocate( $newImage, 0, 0, 0 );
    $font = 'assets/fonts/RougeScript-Regular.ttf';

    // Get image Width and Height
    $image_width = imagesx( $newImage );
    $image_height = imagesy( $newImage );

    // Get Bounding Box Size
    $text_box = imagettfbbox( 35, 0, $font, $text );

    // Get your Text Width and Height
    $text_width = $text_box[ 2 ] - $text_box[ 0 ];
    $text_height = $text_box[ 7 ] - $text_box[ 1 ];

    // Calculate coordinates of the text
    $x = ($image_width / 2) - ($text_width / 2);
    $y = ($image_height / 2) - ($text_height / 2);
    imagettftext( $newImage, 35, 0, $x, $y, $txtColor, $font, $text );
    imagettftext( $newImage, 18, 0, 95, 415, $dtColor, $font, date( 'd-m-Y' ) );
    //header("Content-type: image/jpeg");
    $path = 'images/certificate/cert-' . $twitter_id . '-' . $id . '.jpg';
    imagejpeg( $newImage, $path ); //
    return $path;
}

function get_stock_period() {
    $CI = & get_instance();

    $CI -> db -> select( "id,from_date,to_date,is_result_out,is_weekly_stop,is_monthly_stop,is_yearly_stop,weekly_endon_date,monthly_endon_date,yearly_endon_date" );
    $CI -> db -> from( "stock_period" );
    $CI -> db -> where( "is_active = '1' AND id = '1'" );
    $election_period = $CI -> db -> get() -> result_array();
    return $election_period;
}

function get_stock_price_details( $symbol ) {
    $url = "https://finance.google.com/finance?client=ig&q=nse:$symbol&output=json";
    $curl = curl_init();

    curl_setopt_array( $curl, array (
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ) );

    $response = curl_exec( $curl );
    curl_close( $curl );
    //$err = curl_error($curl);
    return $response;
}

function get_blog_by_id( $id ) {
    $CI = & get_instance();
    $CI -> db -> select( "b.*,bs.name as subcategory_name,bc.name as category_name" );
    $CI -> db -> from( "blogs b" );
    $CI -> db -> join( 'blog_subcategory bs', 'bs.id=b.sub_category_id', 'LEFT' );
    $CI -> db -> join( 'blog_category bc', 'bc.id=b.category_id', 'INNER' );
    $CI -> db -> where( "b.is_active = '1'" );
    $CI -> db -> where( "b.id", $id );
    $CI -> db -> order_by( 'id', 'desc' );
    return $CI -> db -> get() -> row_array();
}

function get_silver_points() {
    $CI = & get_instance();
    $sessiondata = $CI -> session -> userdata( 'data' );
    $uid = $sessiondata[ 'uid' ];
    $CI -> db -> select( 'unearned_points' );
    $CI -> db -> from( 'users' );
    $CI -> db -> where( 'id', $uid );
    $silverpoints = $CI -> db -> get() -> row_array();
    return $silverpoints[ 'unearned_points' ];
}

function getKeywords() {
    $CI = & get_instance();
    $getwords = "select keywords from banned_words";
    $result = $CI -> db -> query( $getwords );
    $words = $result -> row_array();

    return explode( ',', $words[ 'keywords' ] );
}

function is_contain_badwords( $string ) {

    $keywords = getKeywords();

    foreach ( $keywords as $bad ) {
        $bad = trim( $bad );
        if ( stripos( $string, $bad ) !== false ) {
            $badwordfound = FALSE;
            break;
        } else {
            $badwordfound = TRUE;
        }
    }

    if ( $badwordfound ) {
        return TRUE;
    } else {
        return FALSE;
    }
}

/* Get Blogs Categories START */

function get_blog_category() {
    $CI = & get_instance();

    $CI -> db -> select( "bc.id, bc.name" );
    $CI -> db -> from( "blog_category bc" );
    $CI -> db -> where( "bc.is_active = '1'" );
    return $CI -> db -> get() -> result_array();
}

/* Get Blogs Categories END */

/**
 * Turn all URLs in clickable links.
 * 
 * @param string $value
 * @param array  $protocols  http/https, ftp, mail, twitter
 * @param array  $attributes
 * @param string $mode       normal or all
 * @return string
 */
function linkify( $value, $protocols = array ( 'http', 'mail' ), array $attributes = array () ) {
    // Link attributes
    $attr = '';
    foreach ( $attributes as $key => $val ) {
        $attr = ' ' . $key . '="' . htmlentities( $val ) . '"';
    }

    $links = array ();

    // Extract existing links and tags
    $value = preg_replace_callback( '~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) {
        return '<' . array_push( $links, $match[ 1 ] ) . '>';
    }, $value );

    // Extract text links for each protocol
    foreach ( ( array ) $protocols as $protocol ) {
        switch ( $protocol ) {
            case 'http':
            case 'https': $value = preg_replace_callback( '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) {
                    if ( $match[ 1 ] )
                        $protocol = $match[ 1 ];
                    $link = $match[ 2 ] ?: $match[ 3 ];
                    return '<' . array_push( $links, "<a $attr target='_blank' href=\"$protocol://$link\">$link</a>" ) . '>';
                }, $value );
                break;
            case 'mail': $value = preg_replace_callback( '~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~', function ($match) use (&$links, $attr) {
                    return '<' . array_push( $links, "<a $attr target='_blank' href=\"mailto:{$match[ 1 ]}\">{$match[ 1 ]}</a>" ) . '>';
                }, $value );
                break;
            case 'twitter': $value = preg_replace_callback( '~(?<!\w)[@#](\w++)~', function ($match) use (&$links, $attr) {
                    return '<' . array_push( $links, "<a $attr target='_blank' href=\"https://twitter.com/" . ($match[ 0 ][ 0 ] == '@' ? '' : 'search/%23') . $match[ 1 ] . "\">{$match[ 0 ]}</a>" ) . '>';
                }, $value );
                break;
            default: $value = preg_replace_callback( '~' . preg_quote( $protocol, '~' ) . '://([^\s<]+?)(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) {
                    return '<' . array_push( $links, "<a $attr target='_blank' href=\"$protocol://{$match[ 1 ]}\">{$match[ 1 ]}</a>" ) . '>';
                }, $value );
                break;
        }
    }

    // Insert all link
    return preg_replace_callback( '/<(\d+)>/', function ($match) use (&$links) {
        return $links[ $match[ 1 ] - 1 ];
    }, $value );
}

//function getmetatags( $url ) {
//
//        $data = file_get_contents( $url );
//
//        $dom = new DomDocument;
//        @$dom -> loadHTML( $data );
//
//        $xpath = new DOMXPath( $dom );
//        # query metatags with og prefix
//        $metas = $xpath -> query( '//*/meta[starts-with(@property, \'og:\')]' );
//
//        $og = array ();
//
//        foreach ( $metas as $meta ) {
//                # get property name without og: prefix
//                $property = str_replace( 'og:', '', $meta -> getAttribute( 'property' ) );
//                # get content
//                $content = $meta -> getAttribute( 'content' );
//                $og[ $property ] = $content;
//        }
//        //var_dump($og);exit;
//        if ( ! isset( $og[ 'image' ] ) ) {
//                $og[ 'image' ] = base_url() . 'images/common/no-image.png';
//        }
//        if ( ! isset( $og[ 'description' ] ) ) {
//                $og[ 'description' ] = "";
//        }
//        if ( ! isset( $og[ 'url' ] ) ) {
//                $og[ 'url' ] = "";
//        }
//        $og[ 'url' ] = parse_url( $url )[ 'host' ];
//        if ( ! isset( $og[ 'title' ] ) ) {
//                $res = preg_match( "/<title>(.*)<\/title>/siU", $data, $title_matches );
//                if ( ! $res )
//                        return null;
//
//                // Clean up title: remove EOL's and excessive whitespace.
//                $title = preg_replace( '/\s+/', ' ', $title_matches[ 1 ] );
//                $title = trim( $title );
//                $og[ 'title' ] = $title;
//        }
//
//        return $og;
//
//}

function getmetatags( $url ) {

    $data = create_preview_curl( $url );

    $dom = new DomDocument( '1.0', 'UTF-8' );
    @$dom -> loadHTML( $data );
    $xpath = new DOMXPath( $dom );
    # query metatags with og prefix
    $metas = $xpath -> query( '//*/meta[starts-with(@property, \'og:\')]' );

    $og = array ();

    foreach ( $metas as $meta ) {
        # get property name without og: prefix
        $property = str_replace( 'og:', '', $meta -> getAttribute( 'property' ) );
        # get content
        $content = $meta -> getAttribute( 'content' );
        $og[ $property ] = $content;
    }

    if ( ! isset( $og[ 'image' ] ) ) {
        $og[ 'image' ] = base_url() . 'images/common/no-image.png';
    }
    if ( ! isset( $og[ 'description' ] ) ) {
        $og[ 'description' ] = "";
    }
    if ( ! isset( $og[ 'url' ] ) ) {
        $og[ 'url' ] = "";
    }
    $og[ 'url' ] = parse_url( $url )[ 'host' ];
    if ( ! isset( $og[ 'title' ] ) ) {
        $res = preg_match( "/<title>(.*)<\/title>/siU", $data, $title_matches );
        if ( ! $res )
            return null;

        // Clean up title: remove EOL's and excessive whitespace.
        $title = preg_replace( '/\s+/', ' ', $title_matches[ 1 ] );
        $title = trim( $title );
        $og[ 'title' ] = $title;
    }
    return $og;
}

function create_preview_curl( $URL ) {
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $URL );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array ( 'Content-Type: text/html; charset=utf-8' ) );
    curl_setopt( $ch, CURLOPT_HTTPGET, 1 );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );

    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

    $result = curl_exec( $ch );

    return $result;
}

function get_followed_topics( $user_id = 0 ) {
    $CI = & get_instance();
    $result = array ();
    if ( $user_id > 0 ) {
        $CI -> db -> select( "utf.topic_id" );
        $CI -> db -> from( "users_followed_topics utf" );
        $CI -> db -> where( "utf.user_id = '$user_id' AND utf.is_follow = '1'" );
        $result = $CI -> db -> get() -> result_array();
    }

    return $result;
}

function send_mail_to_customer( $type, $customer_name, $customer_mail, $page_name, $vendor_name ) {
    $CI = & get_instance();
    $mail_content = '';
    $title = ($customer_name == "") ? "User" : $customer_name;

    //$user_data = array("type" => $type, "Title" => $title, "Username" => $username, "Password" => $user_password);
    $CI -> load -> library( 'email' );
    $CI -> email -> from( 'petitup@sundaymobility.com', 'Pet it up' ); //will be brand email address and brand name
    $CI -> email -> to( $customer_mail );


    if ( $type == "New Booking" ) {
        $CI -> email -> subject( 'Petitup: New Booking for ' . $page_name . '' );
        $mail_content .= "Hi " . ucwords( $customer_name ) . ",<br/>";
        $mail_content .= "Your booking has been confirmed for page <b>" . $page_name . "</b>. <br/>";
        $mail_content .= "Regards, <br/>";
        $mail_content .= "Petitup Team";
    }

    $CI -> email -> message( $mail_content );
    $CI -> email -> send();

    return TRUE;
}

//function send_email( $to, $from, $title, $message ) {
//        $CI = & get_instance();
//        $CI -> load -> library( 'email' );
//        $CI -> email -> from( $from );
//        $CI -> email -> to( $to );
//        $CI -> email -> subject( $title );
//        $CI -> email -> message( $message );
//        $sent = $CI -> email -> send();
//        if ( $sent ) {
//                //return TRUE;
//                echo "mail sent successfully";
//        } else {
//                //return FALSE;
//                echo "Mail not sent, something went wong";
//                print_r( $CI -> email -> print_debugger(), true );
//        }
//
//}

function send_email( $to, $from, $subject, $msg ,$mail_type='') {
    $config = array ();

    $config[ 'api_key' ] = "8aa5eea08abe60782f6fb7a9ddc36a3f-52cbfb43-35bf5489";
    $config[ 'api_url' ] = "https://api.mailgun.net/v3/notifications.crowdwisdom.co.in/messages";

    $message = array ();
    if(!empty($mail_type)){

        $message[ 'to' ] = 'crowdwisdom360@gmail.com';
        $message[ 'bcc' ] = $to;
    }else{

        $message[ 'to' ] = $to;
    }
    $message[ 'from' ] = "Crowdwisdom Team <notifications@crowdwisdom.co.in>";
    //$message['replyto']=$from;
    $message[ 'subject' ] = $subject;
    $message[ 'html' ] = $msg;
    $message = http_build_query( $message );

    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $config[ 'api_url' ] );
    curl_setopt( $ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );
    curl_setopt( $ch, CURLOPT_USERPWD, "api:{$config[ 'api_key' ]}" );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 20 );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $message );

    $result = curl_exec( $ch );
    curl_close( $ch );
    return $result;
}

/**
 * Piyush 
 * 
 * Get Device type and device token
 */
function get_device_token( $friendid = 0, $userid = 0 ) {
    $CI = & get_instance();
    $get_devicetoken = "";

    if ( $friendid != 0 ) {
        $get_devicetoken = "select id, device_type, device_token from users where id in ($friendid) and ifnull(device_token,'') <> ''";
    }
    if ( $userid != 0 ) {
        $get_devicetoken = "select id, device_type, device_token from users where id not in ($userid) and ifnull(device_token,'') <> ''";
    }

    if ( $get_devicetoken != "" ) {
        $resultset = $CI -> db -> query( $get_devicetoken ) -> result_array();
        return $resultset;
    } else {
        return array ();
    }
}

function get_app_version( $device_type ) {
    $CI = & get_instance();

    $CI -> db -> select( "*" );
    $CI -> db -> from( "settings" );
    $CI -> db -> where( "device_type = '$device_type'" );
    return $CI -> db -> get() -> result_array();
}

function getUserMobile( $uid ) {
    $CI = & get_instance();

    $CI -> db -> select( "phone" );
    $CI -> db -> from( "users" );
    $CI -> db -> where( "id = '$uid'" );
    $usermobile = $CI -> db -> get() -> row_array();
    //$userdetail = $CI->db->get()->result_array();
    return $usermobile;
}
