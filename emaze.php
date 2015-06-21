<?php
/*
Plugin Name: Emaze
Plugin URI:  https://wordpress.org/plugins/emaze/
Description: Embed presentation from Emaze.com into your WordPress site
Version:     1.1
Author:      Rami Yushuvaev
Author URI:  http://GenerateWP.com/
Text Domain: emaze
Domain Path: /languages
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

	$embed = sprintf(
		'<iframe src="https://app.emaze.com/%1$s" width="960" height="540" seamless webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>',
		esc_attr( $matches[1] )
	);

	return apply_filters( 'embed_emaze', $embed, $matches, $attr, $url, $rawattr );

}

function emaze_embed() {

	wp_embed_register_handler(
		'emaze',
		'#https?://app.emaze.com/(.*)#i',
		'emaze_embed_handler'
	);

}

add_action( 'init', 'emaze_embed' );
