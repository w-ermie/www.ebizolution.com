<?php
/**
 * The sidebar containing the main widget areas for blogs
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

if ( ! milu_display_sidebar() || ! is_active_sidebar( 'sidebar-main' ) ) { // see includes/conditional-functions.php
	return;
}
?>
<div id="secondary" class="sidebar-container sidebar-main single-sidebar" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
	<div class="sidebar-inner">
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar-main' ); ?>
		</div><!-- .widget-area -->
	</div><!-- .sidebar-inner -->
</div><!-- #secondary .sidebar-container -->