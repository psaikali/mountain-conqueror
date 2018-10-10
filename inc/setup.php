<?php

namespace MountainConqueror\Setup;

if ( ! function_exists( __NAMESPACE__ . '\setup' ) ) {
	function setup() {

		/**
		 * Define translation files path.
		 */
		load_theme_textdomain( 'inp-mc', get_stylesheet_directory_uri() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Let WordPress manage the document title.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'full-width', 1920, 1080, false );

		/**
		 * Register navigation menus.
		 */
		register_nav_menus(
			[
				'primary' => esc_html__( 'Primary Menu', 'inp-mc' ),
				'footer'  => esc_html__( 'Footer Menu', 'inp-mc' ),
			]
		);

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			]
		);

		/**
		 * Set up the WordPress core custom background feature.
		 */
		$default_page_background_image = apply_filters( 'inp_mc_default_page_background_image', get_stylesheet_directory_uri() . '/assets/images/page-background-default.jpg' );

		add_theme_support(
			'custom-background',
			apply_filters(
				'inp_mc_custom_background_args',
				[
					'default-color' => 'ffffff',
					'default-image' => $default_page_background_image,
				]
			)
		);

		/**
		 * Add theme support for selective refresh for widgets.
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 */
function content_width() {
	$GLOBALS['content_width'] = apply_filters( 'inp_mc_content_width', 640 );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function scripts() {
	/**
	 * If WP is in script debug, or we pass ?script_debug in a URL - set debug to true.
	 */
	$debug = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) || ( isset( $_GET['script_debug'] ) ) ? true : false; // phpcs:ignore

	/**
	 * If we are debugging the site, use a unique version every page load so as to ensure no cache issues.
	 */
	$version = '1.0.0';

	/**
	 * Should we load minified files?
	 */
	$suffix = ( true === $debug ) ? '' : '.min';

	/**
	 * Global variable for IE.
	 */
	global $is_IE;

	$web_font_url  = apply_filters( 'inp_mc_web_font_url', '//fonts.googleapis.com/css?family=Sanchez:400,400i|Teko:500' );
	$icon_font_url = apply_filters( 'inp_mc_icon_font_url', '//d1azc1qln24ryf.cloudfront.net/114779/Socicon/style-cf.css?9ukd8d' );

	// Fonts stylesheets.
	wp_enqueue_style( 'inp-mc-web-font', $web_font_url, [], $version );
	wp_enqueue_style( 'inp-mc-icon-font', $icon_font_url, [], $version );

	// Theme stylesheets & scripts.
	wp_enqueue_style( 'inp-mc-style', get_stylesheet_directory_uri() . '/style' . $suffix . '.css', [], $version );
	wp_enqueue_script( 'inp-mc-scripts', get_template_directory_uri() . '/assets/scripts/project' . $suffix . '.js', [ 'jquery' ], $version, true );

	wp_localize_script( 'inp-mc-scripts', 'inp_mc_data', get_json_data() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\scripts' );

/**
 * Pass PHP data to JS via JSON
 *
 * @return array $data An array of data
 */
function get_json_data() {
	$data = [
		'is_debug' => (int) WP_DEBUG,
	];

	return $data;
}

/**
 * Load admin JS scripts
 *
 * @param string The current admin page slug we're visiting.
 * @return void
 */
function admin_scripts( $hook ) {
	$version = '1.0.0';

	/**
	 * Load /admin/options.js JS file in order to add a few custom validations.
	 */
	if ( 'toplevel_page_inp-mc-options' === $hook ) {
		wp_enqueue_script( 'inp-mc-admin-scripts', get_template_directory_uri() . '/assets/scripts/admin/options.js', [ 'jquery' ], $version, true );
	}
}
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\admin_scripts' );
