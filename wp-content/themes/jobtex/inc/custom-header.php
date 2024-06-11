<?php
/**
 * Custom Header functionality for Jobtex
 *
 * @package WordPress
 * @subpackage Jobtex
 * @since Jobtex 1.0
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses jobtex_header_style()
 */
function jobtex_custom_header_setup() {
	$color_scheme        = jobtex_get_color_scheme();
	$default_text_color  = trim( $color_scheme[4], '#' );

	/**
	 * Filter Jobtex custom-header support arguments.
	 *
	 * @since Jobtex 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default_text_color     Default color of the header text.
	 *     @type int    $width                  Width in pixels of the custom header image. Default 954.
	 *     @type int    $height                 Height in pixels of the custom header image. Default 1300.
	 *     @type string $wp-head-callback       Callback function used to styles the header image and text
	 *                                          displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'jobtex_custom_header_args', array(
		'default-text-color'     => $default_text_color,
		'width'                  => 954,
		'height'                 => 1300,
		'wp-head-callback'       => 'jobtex_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'jobtex_custom_header_setup' );

/**
 * Convert HEX to RGB.
 *
 * @since Jobtex 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */

if ( ! function_exists( 'jobtex_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @since Jobtex 1.0
 *
 * @see jobtex_custom_header_setup()
 */
function jobtex_header_style() {
	return '';
}
endif; // jobtex_header_style

