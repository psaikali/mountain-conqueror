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
