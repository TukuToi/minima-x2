<?php
/**
 * This is the Main Sidebar Template file
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-files
 * @since 1.0.0
 * @package Minima X2
 */

?>
<aside id="sidebar">
	<?php
	if ( is_active_sidebar( 'primary-widget-area' ) ) {
		?>
		<div id="primary" class="widget-area">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'primary-widget-area' ); ?>
			</ul>
		</div>
		<?php
	}
	?>
</aside>
