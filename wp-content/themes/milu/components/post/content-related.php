<?php
/**
 * Template part for displaying related posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */
?>
<article <?php milu_post_attr(); ?>>
	<?php
		/**
		 * Output related post content
		 */
		do_action( 'milu_related_post_content' );
	?>
</article><!-- #post-## -->