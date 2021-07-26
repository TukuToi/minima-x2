<?php
/**
 * This is the Themes functions file.
 *
 * @since 1.0.0
 * @package Minima X2
 */

// Include Files.
include_once( get_template_directory() . '/inc/shims.php' );
include_once( get_template_directory() . '/inc/functions.php' );

/**
 * Add actions
 */
add_action( 'after_setup_theme', 'minimax2_setup' );
add_action( 'wp_head', 'minimax2_fix_header_metatags_order', 1 );
add_action( 'wp_enqueue_scripts', 'minimax2_load_scripts' );
add_action( 'comment_form_before', 'minimax2_enqueue_comment_reply_script' );
add_action( 'wp_body_open', 'minimax2_update_browser_nag', 5 );
add_action( 'wp_body_open', 'minimax2_skip_link', 5 );
add_action( 'widgets_init', 'minimax2_widgets_init' );

/**
 * Remove actions
 */
remove_action( 'wp_head', 'wp_resource_hints', 2 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_site_icon', 99 );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
remove_action( 'rest_api_init', 'wp_oembed_register_route' );

/**
 * Add Filters
 */
add_filter( 'document_title_separator', 'minimax2_document_title_separator' );
add_filter( 'the_title', 'minimax2_title' );
add_filter( 'the_content_more_link', 'minimax2_read_more_link' );
add_filter( 'excerpt_more', 'minimax2_excerpt_read_more_link' );
add_filter( 'intermediate_image_sizes_advanced', 'minimax2_image_insert_override' );
add_filter( 'get_comments_number', 'minimax2_comment_count', 0 );

/**
 * Remove filters
 */
remove_filter( 'wp_robots', 'wp_robots_max_image_preview_large' );
remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

/**
 * Setup the Theme
 */
function minimax2_setup() {

	load_theme_textdomain( 'minimax2', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form' ) );
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1920;
	}
	register_nav_menus(
		array(
			'main-menu' => esc_html__( 'Main Menu', 'blankslate' ),
		)
	);
}

/**
 * WordPress and ClassicPress do not know what proper HTML5 ready Head Meta tags order is.
 * Fix it.
 * Also provide a hook to add meta description and other meta tags at the right place.
 * Also include a custom, better canonical meta tag, that considers archives.
 */
function minimax2_fix_header_metatags_order() {
	do_action( 'minimax2_meta_tags' );
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php minimax2_rel_canonical(); ?>
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<?php
}

/**
 * Enqueue scripts and styles
 */
function minimax2_load_scripts() {
	wp_enqueue_style( 'normalize', get_stylesheet_directory_uri() . '/css/normalize.css', array(), '3.0.3 ', 'all' );
	wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/css/main.css', array( 'normalize' ), '5.3.0', 'all' );
	wp_enqueue_style( 'minimax2', get_stylesheet_uri(), array( 'main' ), wp_get_theme()->Version, 'all' );
	if ( is_404() ) {
		wp_enqueue_style( '404', get_stylesheet_directory_uri() . '/css/404.css', array( 'minimax2' ), wp_get_theme()->Version, 'all' );
	}
	wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/js/modernizr.js', array(), '2.8.3', false );
	wp_enqueue_script( 'plugins', get_stylesheet_directory_uri() . '/js/plugins.js', array( 'modernizr' ), wp_get_theme()->Version, true );
	wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/js/main.js', array( 'plugins' ), wp_get_theme()->Version, true );
}

/**
 * Enqueue comments scripts
 */
function minimax2_enqueue_comment_reply_script() {
	if ( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Nag IE Users to update
 */
function minimax2_update_browser_nag() {
	echo '<!--[if lt IE 8]><p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->';
}

/**
 * Load Skip to content link
 */
function minimax2_skip_link() {
	echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__( 'Skip to the content', 'blankslate' ) . '</a>';
}

/**
 * Register widgets
 *
 * @since 1.0.0
 */
function minimax2_widgets_init() {
	register_sidebar(
		array(
			'name' => esc_html__( 'Sidebar Widget Area', 'minimax2' ),
			'id' => 'sidebar-widget-area',
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__( 'Header Logo Widget Area', 'minimax2' ),
			'id' => 'header-logo-widget-area',
			'before_widget' => '<h1 id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</h1><div id="site-description">' . get_bloginfo( 'description' ) . '</div>',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__( 'Header Menu Widget Area', 'minimax2' ),
			'id' => 'header-menu-widget-area',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__( 'Header Search Widget Area', 'minimax2' ),
			'id' => 'header-search-widget-area',
			'before_widget' => '<div id="search">',
			'after_widget' => '</div>',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__( 'Footer Widget Area 1', 'minimax2' ),
			'id' => 'footer-widget-area-1',
			'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</div>',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__( 'Footer Widget Area 2', 'minimax2' ),
			'id' => 'footer-widget-area-2',
			'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</div>',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__( 'Footer Widget Area 3', 'minimax2' ),
			'id' => 'footer-widget-area-3',
			'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</div>',
		)
	);
	register_sidebar(
		array(
			'name' => esc_html__( 'Footer Widget Area 4', 'minimax2' ),
			'id' => 'footer-widget-area-4',
			'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</div>',
		)
	);
}

/**
 * Add Title Separator
 *
 * @since 1.0.0
 * @param string $sep The Title Separator.
 */
function minimax2_document_title_separator( $sep ) {
	$sep = '|';
	return $sep;
}

/**
 * Filter the document title
 *
 * @since 1.0.0
 * @param string $title The Document title.
 */
function minimax2_title( $title ) {
	if ( '' == $title ) {
		return '...';
	} else {
		return $title;
	}
}

/**
 * Filter the read more link
 *
 * @since 1.0.0
 */
function minimax2_read_more_link() {
	if ( ! is_admin() ) {
		return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">...</a>';
	}
}

/**
 * Filter the excerpt more link
 *
 * @since 1.0.0
 * @param mixed $more the Read More HTML.
 */
function minimax2_excerpt_read_more_link( $more ) {
	if ( ! is_admin() ) {
		global $post;
		return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">...</a>';
	}
}

/**
 * Remove the WordPress silliness
 *
 * @since 1.0.0
 * @param array $sizes  The Media Sizes registered.
 */
function minimax2_image_insert_override( $sizes ) {
	unset( $sizes['medium_large'] );
	return $sizes;
}

/**
 * Filter comments count
 *
 * @since 1.0.0
 * @param int $count The Comments count.
 */
function minimax2_comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$get_comments = get_comments( 'status=approve&post_id=' . $id );
		$comments_by_type = separate_comments( $get_comments );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}
