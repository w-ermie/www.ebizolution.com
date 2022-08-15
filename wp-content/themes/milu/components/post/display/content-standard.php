<?php
/**
 * Template part for displaying posts with the "classic" display
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */
if ( has_post_thumbnail() && ( milu_is_short_post_format() ) ) {
	$style = 'background-image:url(' . get_the_post_thumbnail_url( get_the_ID(), 'large' ) . ');';
}

extract( wp_parse_args( $template_args, array(
	'post_excerpt_type' => 'auto',
	'post_excerpt_length' => 'shorten',
	'post_display_elements' => 'show_thumbnail,show_date,show_text,show_author,show_category,show_extra_meta',
) ) );

$post_display_elements = milu_list_to_array( $post_display_elements );
?>
<article <?php milu_post_attr( 'post-excert-type-' . $post_excerpt_type ); ?>>
	<div class="entry-container">
		<?php
		/**
		 * Hook: milu_before_post_content_standard.
		 *
		 * @hooked milu_output_post_content_standard_sticky_label - 10
		 */
		do_action( 'milu_before_post_content_standard', $post_display_elements );

		/**
		 * Hook: milu_before_post_content_standard_title.
		 *
		 * @hooked milu_output_post_content_standard_media - 10
		 * @hooked milu_output_post_content_standard_date - 10
		 */
		do_action( 'milu_before_post_content_standard_title', $post_display_elements, $display );

		/**
		 * Hook: milu_post_content_standard_title.
		 *
		 * @hooked milu_output_post_content_standard_title - 10
		 */
		do_action( 'milu_post_content_standard_title', $post_display_elements, $display );

		/**
		 * Hook: milu_after_post_content_standard_title.
		 *
		 * @hooked milu_output_post_content_standard_excerpt - 10
		 */
		do_action( 'milu_after_post_content_standard_title', $post_display_elements, $post_excerpt_type );

		/**
		 * Hook: milu_after_post_content_standard.
		 *
		 * @hooked milu_output_post_content_standard_meta - 10
		 */
		do_action( 'milu_after_post_content_standard', $post_display_elements );
		?>
	</div>
</article><!-- #post-## -->