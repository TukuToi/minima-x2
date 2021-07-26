<?php
/**
 * This is the Single Post Template file
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
			if ( comments_open()
				&& ! post_password_required()
			) {
				comments_template( '', true );
			}
		}
	}
	?>
</main>
<?php
get_sidebar();
get_footer();
