<?php
/**
 * This is the Entry Summary for Single Post Templates
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-files
 * @since 1.0.0
 * @package Minima X2
 */

?>
	<div class="entry-summary">
		<?php
		if ( has_post_thumbnail() ) :
			?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
			<?php
		endif;
		the_excerpt();
		if ( is_search() ) {
			?>
			<div class="entry-links"><?php wp_link_pages(); ?></div>
			<?php
		}
		?>
	</div>
