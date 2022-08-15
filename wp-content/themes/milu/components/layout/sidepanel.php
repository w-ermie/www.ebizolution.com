<?php
/**
 * Displays side panel
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */
$sp_classes = apply_filters( 'milu_side_panel_class', '' );
?>
<div class="side-panel <?php echo milu_sanitize_html_classes( $sp_classes ) ?>">
	<div class="side-panel-inner">
		<?php
			/* Side Panel start hook */
			do_action( 'milu_sidepanel_start' );
		
			get_sidebar( 'side-panel' );
		?>
	</div><!-- .side-panel-inner -->
</div><!-- .side-panel -->