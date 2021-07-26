<?php
/**
 * This is the Single Post Content Template File
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-files
 * @since 1.0.0
 * @package Minima X2
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<?php
		if ( is_singular() ) {
			echo '<h1 class="entry-title">';
		} else {
			echo '<h2 class="entry-title">';
		}
		?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
		<?php
		if ( is_singular() ) {
			echo '</h1>';
		} else {
			echo '</h2>';
		}
		edit_post_link();
		if ( ! is_search() ) {
			get_template_part( 'entry', 'meta' );
		}
		?>
	</header>
	<?php
	get_template_part(
		'entry',
		(
		is_front_page()
		|| is_home()
		|| is_front_page()
		&& is_home()
		|| is_archive()
		|| is_search()
		? 'summary' : 'content' )
	);
	?>
	<?php
	if ( is_singular() ) {
		get_template_part( 'entry-footer' );
	}
	?>
</article>
