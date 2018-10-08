<?php

namespace MountainConqueror\Hooks;

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
	if ( apply_filters( 'inp_mc_enable_injection_event_data_in_post', true ) && ! is_admin() && $post->post_type === 'event' ) {
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

function display_header_top_quote() {
	$quote = \carbon_get_theme_option( 'header_quote' );

	if ( strlen( trim( $quote ) ) > 0 ) {
		?>
		<aside class="header-top-quote">
			<?php echo apply_filters( 'the_content', wp_kses_post( $quote ) ); ?>
		</aside>
		<?php
	}
}
add_action( 'inp_mc_start_content', __NAMESPACE__ . '\display_header_top_quote' );
