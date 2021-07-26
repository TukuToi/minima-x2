<?php
/**
 * This is the Header Template file
 *
 * @see https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/
 * @since 1.0.0
 * @package Minima X2
 */

?>
<!DOCTYPE html>
	<html class="no-js" <?php language_attributes(); ?>>
		<head>
			<meta charset="<?php bloginfo( 'charset' ); ?>" />
			<meta http-equiv="x-ua-compatible" content="ie=edge">
			<?php wp_head(); ?>
		</head>
		<body <?php body_class(); ?>>
			<?php wp_body_open(); ?>
			<header id="header">
				<div id="branding">
					<div id="site-title">
						<?php
						dynamic_sidebar('header-logo-widget-area')
						?>
					</div>
				</div>
				<nav id="menu">
					<?php 
					dynamic_sidebar('header-menu-widget-area');
					dynamic_sidebar('header-search-widget-area') 
					?>
				</nav>
			</header>
			<div id="main">
