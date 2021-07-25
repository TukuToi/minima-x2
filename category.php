<?php
/**
 * This is the Category Archive Template file
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-files
 * @since 1.0.0
 * @package Minima X2
 */

get_header(); ?>
	<main id="content">
		<header class="header">
			<h1 class="entry-title"><?php single_term_title(); ?></h1>
			<div class="archive-meta">
			<?php
			if ( '' != the_archive_description() ) {
				echo esc_html( the_archive_description() ); }
			?>
			</div>
		</header>
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'entry' );
			endwhile;
		endif;
		?>
	</main>
	<?php
	get_sidebar();
get_footer();
