<?php
/**
 * This is the Author Archive Template file
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-files
 * @since 1.0.0
 * @package Minima X2
 */

get_header(); ?>
<main id="content">
	<header class="header">
		<?php the_post(); ?>
		<h1 class="entry-title author"><?php the_author_link(); ?></h1>
		<div class="archive-meta">
			<?php
			if ( '' != get_the_author_meta( 'user_description' ) ) {
				echo esc_html( get_the_author_meta( 'user_description' ) ); }
			?>
		</div>
		<?php rewind_posts(); ?>
	</header>
	<?php
	while ( have_posts() ) {
		the_post();
		get_template_part( 'entry' );
	}
	?>
</main>
<?php
get_sidebar();
get_footer();

