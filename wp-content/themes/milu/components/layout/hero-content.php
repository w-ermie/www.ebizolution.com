<?php
/**
 * Displays hero content
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */
?>
<div id="hero">
	<?php
		/**
		 * milu_hero_background hook
		 * @see milu_output_hero_background function
		 */
		do_action( 'milu_hero_background' );
	?>
	<div id="hero-inner">
		<div id="hero-content">
			<div class="post-title-container hero-section"><?php
				/**
				 * milu_hero_title hook
				 * @see milu_output_post_title function
				 */
				do_action( 'milu_hero_title' );
			?></div><!-- .post-title-container -->
			<div class="post-meta-container hero-section"><?php
				/**
				 * milu_hero_meta hook
				 * @see inc/frontend/hooks.php
				 */
				do_action( 'milu_hero_meta' );
			?></div><!-- .post-meta-container -->
			<div class="post-secondary-meta-container hero-section"><?php
				/**
				 * milu_hero_secondary_meta hook
				 * @see inc/frontend/hooks.php
				 */
				do_action( 'milu_hero_secondary_meta' );
			?></div><!-- .post-meta-container -->
		</div><!-- #hero-content -->
	</div><!-- #hero-inner -->
</div><!-- #hero-container -->
