<?php
/*
Plugin Name: Emaze
Plugin URI:  https://wordpress.org/plugins/emaze/
Description: Embed presentation from Emaze.com into your WordPress site
Version:     1.0
Author:      Rami Yushuvaev
Author URI:  http://GenerateWP.com/
*/



/*
 * Prevent direct access to the file
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/*
 * Register embed handler
 */
function emaze_embed_handler( $matches, $attr, $url, $rawattr ) {

	$scheme = is_ssl() ? 'https' : 'http';

	$embed = sprintf(
		'<iframe src="' . $scheme . '://app.emaze.com/%1$s" width="960px" height="540px" seamless webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>',
		esc_attr( $matches[1] )
	);

	return apply_filters( 'embed_emaze', $embed, $matches, $attr, $url, $rawattr );

}

function emaze_embed() {

	wp_embed_register_handler(
		'emaze',
		'#http://app.emaze.com/(.*)#i',
		'emaze_embed_handler'
	);

}

add_action( 'init', 'emaze_embed' );
