<?php
/**
 * This is the Main Index Template file
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-files
 * @since 1.0.0
 * @package Minima X2
 */

get_header(); ?>
	<main id="content">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				get_template_part( 'entry' );
				comments_template();
			}
		}
		?>
	</main>
	<?php
	get_sidebar();
get_footer();
