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
		?>
		<header class="header">
			<h1 class="entry-title">
				<?php
				// Translators: %s stands for a dynamic search term.
				printf( esc_html__( 'Search Results for: %s', 'blankslate' ), get_search_query() );
				?>
			</h1>
		</header>
		<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( 'entry' );
		}
		get_template_part( 'nav', 'below' );
	} else {
		?>
		<article id="post-0" class="post no-results not-found">
			<header class="header">
				<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'blankslate' ); ?></h1>
			</header>
			<div class="entry-content">
				<p><?php esc_html_e( 'Sorry, nothing matched your search. Please try again.', 'blankslate' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</article>
		<?php
	}
	?>
</main>
<?php
get_sidebar();
get_footer();
