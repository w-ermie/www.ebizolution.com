<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */
get_header();
?>

	<div id="primary" class="content-area ebiz-single">

		<main id="content" class="site-content clearfix" role="main">

			<h2 class="ebiz__single-title"><?= the_title(); ?></h2>

			<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					
					/*
					 * Post content
					 */
					get_template_part( 'components/post/content', 'single' );

					/*
					 * If comments are open or we have at least one comment, load up the comment template.
					 */
					// if ( comments_open() || get_comments_number() ) :
					// 	comments_template();
					// endif;

				endwhile; // End of the loop.
			?>
		</main><!-- main#content .site-content-->
	</div><!-- #primary .content-area -->
<?php
get_sidebar();
get_footer();
?>