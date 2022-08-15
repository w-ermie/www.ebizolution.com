<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing divs of the main content and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */
?>
						</div><!-- .content-wrapper -->
					</div><!-- .content-inner -->
					<?php
						/**
						 * milu_after_content
						 */
						do_action( 'milu_before_footer_block' );
					?>
				</div><!-- .site-content -->
			</div><!-- #main -->
		</div><!-- #page-content -->
		<div class="clear"></div>
		<?php
			/**
			 * milu_footer_before hook
			 */
			do_action( 'milu_footer_before' );
		?>
		<?php
			if ( 'hidden' !== milu_get_inherit_mod( 'footer_type' ) && is_active_sidebar( 'sidebar-footer' ) ) : ?>
			<footer id="colophon" class="<?php echo apply_filters( 'milu_site_footer_class', '' ); ?> site-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
				<div class="footer-inner clearfix">
					<?php get_sidebar( 'footer' ); ?>
				</div><!-- .footer-inner -->
			</footer><!-- footer#colophon .site-footer -->
		<?php endif; ?>
		<?php
			/**
			 * Fires the Milu bottom bar
			 */
			do_action( 'milu_bottom_bar' );
		?>
	</div><!-- #page .hfeed .site -->
</div><!-- .site-container -->
<?php wp_footer(); ?>
</body>
</html>