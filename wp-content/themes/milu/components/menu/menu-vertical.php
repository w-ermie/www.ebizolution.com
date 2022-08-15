<?php
/**
 * The main navigation for vertical menus
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

if ( milu_do_onepage_menu() ) {

	echo milu_one_page_menu();

} else {

	if ( has_nav_menu( 'vertical' ) ) {

		wp_nav_menu( milu_get_menu_args( 'vertical', 'vertical' ) );

	} else {
		wp_nav_menu( milu_get_menu_args( 'primary', 'vertical' ) );
	}
}