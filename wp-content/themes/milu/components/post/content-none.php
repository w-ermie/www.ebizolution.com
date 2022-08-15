<?php
/**
 * Template part for displaying the content when no post is found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */
?>
<div class="no-results not-found">
	<div class="entry-no-result wrap">
		<?php
			if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses_post( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'milu' ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php else : ?>

			<p><?php esc_html_e( 'Ouch. It seems we can&rsquo;t find what you&rsquo;re looking for.', 'milu' ); ?></p>

			<?php do_action( 'milu_no_result_end' ); ?>
		<?php endif; ?>
	</div><!-- .entry-container -->
</div><!-- #post-## -->