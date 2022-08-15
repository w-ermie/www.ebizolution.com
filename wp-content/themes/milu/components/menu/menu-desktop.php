<?php
/**
 * The main navigation for desktop
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

if ( milu_do_onepage_menu() ) {

	echo milu_one_page_menu();

} else {
	wp_nav_menu( milu_get_menu_args() );
}
