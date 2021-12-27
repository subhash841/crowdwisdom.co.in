<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * base_url
 *
 * Overwrites the base_url function to support
 * loading your asset from KeyCDN.
 */
function base_url( $uri = '', $protocol = NULL ) {
        if ( ! $uri ) {
                return get_instance() -> config -> base_url( $uri, $protocol );
        }
        if ( $uri[ 0 ] != '/' )
                $uri = '/' . $uri;
        $currentInstance = & get_instance();

        $cdnURL = $currentInstance -> config -> item( 'cdn_url' );
        $assetsURL = $currentInstance -> config -> item( 'assets_url' );

        $imgext = array ( 'jpg', 'jpeg', 'png', 'gif' );

        $othext = array ( 'css', 'js', 'pdf', 'woff', 'tff', 'otf', 'map', 'ico', 'svg' );

        $pathParts = pathinfo( parse_url( $uri )[ 'path' ], PATHINFO_EXTENSION );

        if ( ! empty( $pathParts ) ) {

                if ( ! empty( $cdnURL ) && in_array( strtolower( $pathParts ), $imgext ) ) {
                        //$uri = ( strpos( $uri, 'imgupload' ) == "") ? "/" . $_SERVER[ 'HTTP_HOST' ] . $uri : $uri;
                        return $cdnURL . $uri;
                }
                if ( ! empty( $assetsURL ) && in_array( strtolower( $pathParts ), $othext ) ) {
                        return $assetsURL . $uri;
                }
        }

        return $currentInstance -> config -> base_url( $uri, $protocol );

}
