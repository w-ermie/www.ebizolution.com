<?php
/**
 * The portoflio taxonomy template file.
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */
get_header();
?>
	<div id="primary" class="content-area">
		<main id="content" class="clearfix">
			<?php
				/**
				 * Output post loop through hook so we can do the magic however we want
				 */
				do_action( 'milu_posts', array(
					'work_index' => true,
					'el_id' => 'portfolio-index',
					'post_type' => 'work',
					'pagination' => milu_get_theme_mod( 'work_pagination', '' ),
					'works_per_page' => milu_get_theme_mod( 'works_per_page', '' ),
					'grid_padding' => milu_get_theme_mod( 'work_grid_padding', 'yes' ),
					'item_animation' => milu_get_theme_mod( 'work_item_animation' ),
				) );
			?>
		</main><!-- #content -->
	</div><!-- #primary -->
<?php
get_sidebar( 'portfolio' );
get_footer();
?>