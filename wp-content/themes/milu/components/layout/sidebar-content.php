<?php
/**
 * Displays sidebar content
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

if ( milu_is_woocommerce_page() ) {

	dynamic_sidebar( 'sidebar-shop' );

} else {

	if ( function_exists( 'wolf_sidebar' ) ) {

		wolf_sidebar();

	} else {

		dynamic_sidebar( 'sidebar-page' );
	}
}