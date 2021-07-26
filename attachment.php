<?php
/**
 * This is the Single Attachment Template file
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-files
 * @since 1.0.0
 * @package Minima X2
 */

get_header();
global $post; 
?>
<main id="content">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="header">
					<h1 class="entry-title"><?php the_title(); ?></h1> 
					<?php edit_post_link(); ?>
					<?php get_template_part( 'entry', 'meta' ); ?>
					<?php // Translators: %s is a placeholder for a dynamic Post Name. ?>
					<a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" title="<?php printf( esc_html__( 'Return to %s', 'blankslate' ), esc_html( get_the_title( $post->post_parent ), 1 ) ); ?>" rev="attachment"><?php printf( esc_html__( '%s Return to ', 'blankslate' ), '<span class="meta-nav">&larr;</span>' ); ?><?php echo esc_textarea( get_the_title( $post->post_parent ) ); ?></a>
					<nav id="nav-above" class="navigation">
						<div class="nav-previous"><?php previous_image_link( false, '&lsaquo;' ); ?></div>
						<div class="nav-next"><?php next_image_link( false, '&rsaquo;' ); ?></div>
					</nav>
				</header>
				<div class="entry-content">
					<div class="entry-attachment">
						<?php
						if ( wp_attachment_is_image( $post->ID ) ) {
							$att_image = wp_get_attachment_image_src( $post->ID, 'full' );
							?>
							<p class="attachment"><a href="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><img src="<?php echo esc_url( $att_image[0] ); ?>" width="<?php echo esc_attr( $att_image[1] ); ?>" height="<?php echo esc_attr( $att_image[2] ); ?>" class="attachment-full" alt="<?php $post->post_excerpt; ?>" /></a></p>
								<?php
						} else {
							?>
							<a href="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>" title="<?php echo esc_attr( get_the_title( $post->ID ), 1 ); ?>" rel="attachment"><?php echo esc_url( basename( $post->guid ) ); ?></a>
							<?php
						}
						?>
					</div>
					<div class="entry-caption">
						<?php
						if ( ! empty( $post->post_excerpt ) ) {
							the_excerpt(); }
						?>
					</div>
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail(); }
					?>
				</div>
			</article>
			<?php comments_template(); ?>
			<?php
		}
	}
	?>
</main>
<?php
get_sidebar();
get_footer();
