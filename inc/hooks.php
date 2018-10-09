<?php

namespace MountainConqueror\Hooks;

use MountainConqueror\Options;

/**
 * Add favicon meta tags in the <head>
 *
 * @link https://www.favicon-generator.org
 */
function add_favicon_tags() {
	?>
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<?php
}
add_action( 'wp_head', __NAMESPACE__ . '\add_favicon_tags' );

/**
 * Change the excerpt length
 */
function excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', __NAMESPACE__ . '\excerpt_length' );

/**
 * Inject Event post data in $post to get direct access
 *
 * @param $post WP_Post The post object.
 */
function inject_event_post_data( $post ) {
	if ( apply_filters( 'inp_mc_enable_injection_event_data_in_post', true ) && ! is_admin() && 'event' === $post->post_type ) {
		$post->event = \Inpsyde\Events\Model\Event::fromPost( $post );
	}
}
add_action( 'the_post', __NAMESPACE__ . '\inject_event_post_data' );

/**
 * Add some custom classes to article.post
 *
 * @param array $classes The post classes.
 * @return array $classes
 */
function custom_post_classes( $classes ) {
	if ( has_post_thumbnail() ) {
		$classes[] = 'has-featured-image';
	}

	return $classes;
}
add_filter( 'post_class', __NAMESPACE__ . '\custom_post_classes' );

/**
 * Check if we are dealing with a valid $post event
 *
 * @param boolean $valid If the analysed post is currently considered an event.
 * @param WP_Post $post The current post being looped.
 */
function is_a_valid_event( $valid, $post ) {
	if ( isset( $post->event ) && is_a( $post->event, 'Inpsyde\Events\Model\Event' ) ) {
		$valid = true;
	}

	return $valid;
}
add_filter( 'inp_mc_post_is_a_valid_event', __NAMESPACE__ . '\is_a_valid_event', 10, 2 );

/**
 * Display top quote before content
 */
function display_header_top_quote() {
	$quote = Options\get_option( 'header_quote' );

	if ( strlen( trim( $quote ) ) > 0 ) {
		?>
		<aside class="header-top-quote">
			<?php echo apply_filters( 'the_content', wp_kses_post( $quote ) ); // WPCS: XSS OK. ?>
		</aside>
		<?php
	}
}
add_action( 'inp_mc_start_content', __NAMESPACE__ . '\display_header_top_quote' );
