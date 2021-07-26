<?php
/**
 * This is the Footer Template file
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-files
 * @since 1.0.0
 * @package Minima X2
 */

?>
		</div>
		<footer id="footer">
			<?php
			dynamic_sidebar( 'footer-widget-area-1' );
			dynamic_sidebar( 'footer-widget-area-2' );
			dynamic_sidebar( 'footer-widget-area-3' );
			dynamic_sidebar( 'footer-widget-area-4' );
			?>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
