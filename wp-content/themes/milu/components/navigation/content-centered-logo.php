<?php
/**
 * Displays centered logo navigation type
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */
?>
<div id="nav-bar" class="nav-bar">
	<div class="flex-wrap">
		<?php
			if ( 'left' === milu_get_inherit_mod( 'side_panel_position' ) && milu_can_display_sidepanel() ) {
				/**
				 * Output sidepanel hamburger
				 */
				do_action( 'milu_sidepanel_hamburger' );
			}
		?>
		<nav class="menu-container" itemscope="itemscope"  itemtype="https://schema.org/SiteNavigationElement">
			<?php
				/**
				 * Menu
				 */
				milu_primary_desktop_navigation();
			?>
		</nav><!-- .menu-container -->
		<div class="cta-container">
			<?php
				/**
				 * Secondary menu hook
				 */
				do_action( 'milu_secondary_menu', 'desktop' );
			?>
		</div><!-- .cta-container -->
		<?php
			if ( 'right' === milu_get_inherit_mod( 'side_panel_position' ) && milu_can_display_sidepanel() ) {
				/**
				 * Output sidepanel hamburger
				 */
				do_action( 'milu_sidepanel_hamburger' );
			}
		?>
	</div><!-- .flex-wrap -->
</div><!-- #navbar-container -->