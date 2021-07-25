<?php
/**
 * Include shims for functions that may not exist.
 *
 * @since 1.0.0
 * @package Minima X2
 * @subpackage Minima X2/inc
 */

/**
 * Include a shim for wp_body_open
 * This function was introduced with WordPress 5.2.0
 *
 * @see https://developer.wordpress.org/reference/functions/wp_body_open/
 */
if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Fire the wp_body_open action.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
