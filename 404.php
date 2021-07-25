<?php
/**
 * This is the 404 Template file
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-files
 * @since 1.0.0
 * @package Minima X2
 */

get_header(); ?>
	<main id="content">
		<article id="post-0" class="post not-found">
			<header class="header">
				<h1 class="entry-title"><?php esc_html_e( 'Not Found', 'blankslate' ); ?></h1>
			</header>
			<div class="entry-content">
			<p><?php esc_html_e( 'Nothing found for the requested page. Try a search instead?', 'blankslate' ); ?></p>
			<?php get_search_form(); ?>
			</div>
		</article>
	</main>
	<?php
	get_sidebar();
get_footer();

