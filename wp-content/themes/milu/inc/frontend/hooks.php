<?php
/**
 * Milu hook functions
 *
 * Inject content through template hooks
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

/**
 * Site page hooks
 */
include_once( get_parent_theme_file_path( '/inc/frontend/hooks/site.php' ) );

/**
 * Navigation hooks
 */
include_once( get_parent_theme_file_path( '/inc/frontend/hooks/navigation.php' ) );

/**
 * Post hooks
 */
include_once( get_parent_theme_file_path( '/inc/frontend/hooks/post.php' ) );
