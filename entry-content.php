<?php
/**
 * The Single Entry Content Template
 *
 * @since 1.0.0
 * @package Minima X2
 */

?>
<div class="entry-content">
	<?php
	if ( has_post_thumbnail() ) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false );
		?>
		<a href="<?php echo esc_url( $src[0] ); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
		<?php
	}
	?>
	<?php the_content(); ?>
	<div class="entry-links"><?php wp_link_pages(); ?></div>
</div>
