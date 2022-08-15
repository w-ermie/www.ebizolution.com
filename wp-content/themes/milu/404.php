<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Milu
 * @since Milu 1.0.0
 */
get_header();
?>
	<div id="primary" class="content-area entry-content full-height">
		<div id="content" class="site-content" role="main">
			<article id="post-0" class="post error404 not-found">
				<div id="error-404-text-container">
					<h1 id="error-404-bigtext" class="wvc-bigtext">
						<span><?php esc_html_e( '404', 'milu' ); ?></span>
						<span><?php esc_html_e( 'Page not found', 'milu' ); ?></span>
					</h1>
				</div><!-- #error-404-text-container -->
				<p><a class="<?php echo esc_attr( apply_filters( 'milu_404_button_class', 'button' ) ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span>&larr; <?php esc_html_e( 'back home', 'milu' ); ?></span></a></p>
			</article>
		</div><!-- #content .site-content-->
	</div><!-- #primary .content-area -->
<?php
get_footer();
?>