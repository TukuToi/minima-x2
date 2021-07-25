<?php
/**
 * This is the Footer Template file
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-files
 * @since 1.0.0
 * @package Minima X2
 */

?>
			</div><!-- End #container-->
			<footer id="footer">
				<div id="copyright">
					&copy; <?php echo esc_html( date_i18n( __( 'Y', 'blankslate' ) ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
				</div>
			</footer>
		</div><!-- End #wrapper-->
	<?php wp_footer(); ?>
	</body>
</html>
