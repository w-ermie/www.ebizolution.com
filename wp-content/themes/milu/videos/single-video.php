<?php
/**
 * The template for displaying all single video posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */
get_header();
?>
	<div id="primary" class="content-area">
		<main id="content" class="site-content clearfix" role="main">
			<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Post content
					 */
					get_template_part( 'components/video/content', 'single' );

					/*
					 * If comments are open or we have at least one comment, load up the comment template.
					 */
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
			?>
		</main><!-- main#content .site-content-->
	</div><!-- #primary .content-area -->
<?php
get_sidebar( 'videos' );
get_footer();
?>