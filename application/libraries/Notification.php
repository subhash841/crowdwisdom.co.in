<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Notification {

    function __construct() {
        $path = dirname( __DIR__ ) . '/third_party/ApnsPHP/';
        $this -> apnsDir = $path;

        $this -> _apns_req();

        return;
    }

    public function get_ids_and_fields( $ids, $fields, $userid = 0 ) {

        $android_target = array ();
        $ios_target = array ();
        $notification_array = array ();

        $CI = & get_instance();

        $resultset = get_device_token( $ids, $userid );

        if ( ! empty( $resultset ) ) {
            foreach ( $resultset as $devices ) {
                if ( $devices[ 'device_type' ] == "Android" ) {
                    $android_target[] = $devices[ 'device_token' ];
                }
                if ( $devices[ 'device_type' ] == "Ios" ) {
                    $ios_target[] = $devices[ 'device_token' ];
                }
            }

            if ( ! empty( $android_target ) ) {
                $this -> send_android_notif( $android_target, $fields );
            }
            if ( ! empty( $ios_target ) ) {
                $this -> send_ios_notif( $ios_target, $fields );
            }

            /* add into notification list */
            foreach ( $resultset as $key => $users_notif ) {
                $userid = $users_notif[ 'id' ];
                $notification_array[ $key ] = $fields;
                $notification_array[ $key ][ 'own_id' ] = $userid;
            }
            if ( ! empty( $notification_array ) ) {
                $CI -> db -> insert_batch( "notifications", $notification_array );
            }
            /* add into notification list */
        }
    }

    public function send_android_notif( $target, $fields ) {

        if ( is_array( $target ) && count( $target ) > 1 ) {
            $notif[ 'registration_ids' ] = $target;
        } else if ( count( $target ) == 0 ) {
            return; //send back
        } else {
            $notif[ 'to' ] = $target[ 0 ];
        }

        $notif[ 'data' ] = $fields;

        $apiKey = 'AIzaSyAotgOq8t3xBcklGjK1ds7CVnCwDB0RSJo';
        $headers = array ( "Content-Type:" . "application/json", "Authorization:key=" . $apiKey );

        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send" );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $notif ) );
        $result = curl_exec( $ch );
        //var_dump($result);
    }

    /**
     * Will send the actual iOS notification to the user
     * @param $token string iOS device token
     * @param $msg string 
     * @param $attrs array Key/value pairs to be sent as meta with APN
     * @return void
     * @access public
     */
    public function send_ios_notif( $token = null, $attrs = array () ) {
        if ( $token == null || $token == '' ) {
            return;
        }
        $msg = array ( 'title' => $attrs[ 'title' ], 'body' => $attrs[ 'text' ] );
        unset( $attrs[ 'title' ] );
        unset( $attrs[ 'text' ] );

        // Instantiate a new ApnsPHP_Push object
        $push = new ApnsPHP_Push(
                ApnsPHP_Abstract::ENVIRONMENT_SANDBOX, $this -> apnsDir . 'SSL/CrowdDevPushPass123.pem'
                //ApnsPHP_Abstract::ENVIRONMENT_PRODUCTION, $this->apnsDir . 'SSL/CrowdDisPushPass123.pem'
        );

        // Set the Provider Certificate passphrase
        // $push->setProviderCertificatePassphrase('tablecan29');
        // Set the Root Certificate Autority to verify the Apple remote peer
        // test
        $push -> setRootCertificationAuthority( $this -> apnsDir . 'SSL/CrowdDevPushPass123.pem' );

        //live
        // $push->setRootCertificationAuthority($this->apnsDir . 'SSL/CrowdDisPushPass123.pem');
        // Connect to the Apple Push Notification Service
        $push -> connect();

        $t = count( $token );
        for ( $i = 0; $i < $t; $i ++ ) {

            // Instantiate a new Message with a single recipient
            $message = new ApnsPHP_Message( $token[ $i ] );

            // Set a custom identifier. To get back this identifier use the getCustomIdentifier() method
            // over a ApnsPHP_Message object retrieved with the getErrors() message.
            $message -> setCustomIdentifier( sprintf( "Message-Badge-%03d", $i ) );
            // Set badge icon to "3"
            // $message->setBadge(0);
            // Set a simple welcome text
            $message -> setText( $msg );

            // Play the default sound
            $message -> setSound();

            // show notification if app in backgound
            $message -> setContentAvailable( true );

            // Set custom properties
            if ( is_array( $attrs ) && count( $attrs ) ) {
                foreach ( $attrs as $attr_key => $attr_val ) {
                    $message -> setCustomProperty( $attr_key, $attr_val );
                }
            }

            // Set the expiry value - in seconds
            $message -> setExpiry( 120 );

            // Add the message to the message queue
            $push -> add( $message );
        }

        // Send all messages in the message queue
        $push -> send();

        // Disconnect from the Apple Push Notification Service
        $push -> disconnect();

        // Examine the error message container
        // $aErrorQueue = $push->getErrors();
        // if (!empty($aErrorQueue)) {
        //  var_dump($aErrorQueue);
        // }

        return TRUE;
    }

    private function _apns_req() {

        require_once $this -> apnsDir . 'Abstract.php';
        require_once $this -> apnsDir . 'Exception.php';
        require_once $this -> apnsDir . 'Feedback.php';
        require_once $this -> apnsDir . 'Message.php';
        require_once $this -> apnsDir . 'Log/Interface.php';
        require_once $this -> apnsDir . 'Log/Embedded.php';
        require_once $this -> apnsDir . 'Message/Custom.php';
        require_once $this -> apnsDir . 'Message/Exception.php';
        require_once $this -> apnsDir . 'Push.php';
        require_once $this -> apnsDir . 'Push/Exception.php';
        require_once $this -> apnsDir . 'Push/Server.php';
        require_once $this -> apnsDir . 'Push/Server/Exception.php';

        return;
    }

}
