<?php
/**
 * This is the Themes functions file.
 *
 * @since 1.0.0
 * @package Minima X2
 */

// Include Files.
include_once( get_template_directory() . 'inc/shims.php' );

/**
 * Add actions
 */
add_action( 'after_setup_theme', 'minimax2_setup' );
add_action( 'wp_enqueue_scripts', 'minimax2_load_scripts' );
add_action( 'comment_form_before', 'minimax2_enqueue_comment_reply_script' );
add_action( 'wp_footer', 'minimax2_footer_scripts' );
add_action( 'wp_body_open', 'minimax2_skip_link', 5 );
add_action( 'wp_head', 'minimax2_pingback_header' );
add_action( 'widgets_init', 'minimax2_widgets_init' );

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
 * Setup the Theme
 */
function minimax2_setup() {

	load_theme_textdomain( 'minimax2', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
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
 * Enqueue scripts and styles
 */
function minimax2_load_scripts() {
	wp_enqueue_style( 'minimax2-style', get_stylesheet_uri(), array( '' ), wp_get_theme()->Version, 'all' );
	wp_enqueue_script( 'jquery' );
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
 * Add Footer Scripts
 */
function minimax2_footer_scripts() {
	?>
	<script>
		jQuery(document).ready(function ($) {
			var deviceAgent = navigator.userAgent.toLowerCase();
			if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
				$("html").addClass("ios");
				$("html").addClass("mobile");
			}
			if (navigator.userAgent.search("MSIE") >= 0) {
				$("html").addClass("ie");
			}
			else if (navigator.userAgent.search("Chrome") >= 0) {
				$("html").addClass("chrome");
			}
			else if (navigator.userAgent.search("Firefox") >= 0) {
				$("html").addClass("firefox");
			}
			else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
				$("html").addClass("safari");
			}
			else if (navigator.userAgent.search("Opera") >= 0) {
				$("html").addClass("opera");
			}
		});
	</script>
	<?php
}

/**
 * Load Skip to content link
 */
function minimax2_skip_link() {
	echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__( 'Skip to the content', 'blankslate' ) . '</a>';
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
 * Register widgets
 *
 * @since 1.0.0
 */
function minimax2_widgets_init() {
	register_sidebar(
		array(
			'name' => esc_html__( 'Sidebar Widget Area', 'blankslate' ),
			'id' => 'primary-widget-area',
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
}

/**
 * Filter pingbacks
 *
 * @since 1.0.0
 */
function minimax2_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

/**
 * Add a pings comment callback
 *
 * @since 1.0.0
 * @param mixed $comment The Comment.
 * @see minima X2/comments.php wp_list_comments()
 */
function blankslate_custom_pings( $comment ) {
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<?php comment_author_link(); ?>
	</li>
	<?php
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
