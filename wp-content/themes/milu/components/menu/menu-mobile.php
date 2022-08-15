<?php
/**
 * The main navigation for mobile
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

if ( milu_do_onepage_menu() ) {

	echo milu_one_page_menu( 'mobile' );

} else {

	if ( has_nav_menu( 'mobile' ) ) {

		wp_nav_menu( milu_get_menu_args( 'mobile', 'mobile' ) );

	} else {
		wp_nav_menu( milu_get_menu_args( 'primary', 'mobile' ) );
	}
}