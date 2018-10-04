<?php

if ( ! defined( 'INP_MC_USE_DUMMY_EVENT_CLASS' ) || ! INP_MC_USE_DUMMY_EVENT_CLASS ) {
	return;
}

require_once get_template_directory() . '/inc/dummy-data/classes/Event.php';
require_once get_template_directory() . '/inc/dummy-data/classes/Location.php';
require_once get_template_directory() . '/inc/dummy-data/classes/ContactPerson.php';

/**
 * Register Event post type, just for testing in the theme
 */
function inp_mc_register_temp_event_post_type() {
	$args = [
		'public'      => true,
		'label'       => 'Events (dummy)',
		'has_archive' => true,
	];
	register_post_type( 'event', $args );
}
add_action( 'init', 'inp_mc_register_temp_event_post_type' );
