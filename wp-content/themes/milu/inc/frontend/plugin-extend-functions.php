<?php
/**
 * Milu plugin extend functions
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get single work layout
 *
 * @return string $layout
 */
function milu_get_single_work_layout() {

	$single_work_layout = ( get_post_meta( get_the_ID(), '_single_work_layout', true ) ) ? get_post_meta( get_the_ID(), '_single_work_layout', true ) : 'small-width';

	if ( is_singular( 'work' ) ) {
		return apply_filters( 'milu_single_work_layout', $single_work_layout );
	}
}

/**
 * Filter add to wishlist button class
 *
 * @return string $layout
 */
function milu_filter_addo_to_wishlist_button_class( $class ) {

	$class = str_replace( 'button', '', $class );

	return $class;
}
add_filter( 'wolf_add_to_wishlist_class', 'milu_filter_addo_to_wishlist_button_class' );

/**
 * Set Wolf Gram widget lightbox
 *
 * @return string $lightbox
 */
function milu_set_wolf_gram_lightbox( $lightbox ) {

	return 'fancybox';
}
add_filter( 'wolf_gram_lightbox', 'milu_set_wolf_gram_lightbox' );

/**
 * Filter ticket link CSS class
 *
 * @param string $class
 * @param string $class
 */
function milu_filter_ticket_link_css_class( $class ) {
	return 'button ticket-button';
}
add_filter( 'we_ticket_link_class', 'milu_filter_ticket_link_css_class' );