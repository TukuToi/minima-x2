<?php
/**
 * This is the Entry Meta for Single Post Templates
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-files
 * @since 1.0.0
 * @package Minima X2
 */

?>
	<div class="entry-meta">
		<span class="author vcard"><?php the_author_posts_link(); ?></span>
		<span class="meta-sep"> | </span>
		<span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
	</div>
