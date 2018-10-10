<?php

namespace MountainConqueror\Options;

use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Boot the Carbon Fields library.
 *
 * @return void
 */
function options_boot() {
	Carbon_Fields::boot();
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\options_boot', 20 );

/**
 * Define the theme options tabs
 *
 * @param array $tabs []
 * @return array $tabs The tabs array: the key is the tab slug use in the filter (to load fields), the value is the tab title.
 */
function options_set_tabs( $tabs ) {
	return [
		'general'  => __( 'General', 'inp-mc' ),
		'social'   => __( 'Social Networks', 'inp-mc' ),
		'advanced' => __( 'Advanced', 'inp-mc' ),
	];
}
add_filter( 'inp_mc_theme_options_tabs', __NAMESPACE__ . '\options_set_tabs' );

/**
 * Setup the admin theme options page with proper settings,
 * and add fields.
 *
 * @link https://carbonfields.net/docs/containers-theme-options/
 *
 * @return void
 */
function options_initialize_admin_page() {
	$tabs = apply_filters( 'inp_mc_theme_options_tabs', [] );

	if ( empty( $tabs ) ) {
		return;
	}

	// Create theme options container.
	$theme_options = Container::make( 'theme_options', __( 'Mountain Conqueror Theme Options', 'inp-mc' ) );

	// Change its slug.
	$theme_options->set_page_file( 'inp-mc-options' );

	// Change its menu title.
	$theme_options->set_page_menu_title( __( 'Theme Options', 'inp-mc' ) );

	// Change its menu position
	$theme_options->set_page_menu_position( 21 );

	// Load the tabs and their fields.
	foreach ( $tabs as $tab_slug => $tab_title ) {
		$theme_options->add_tab(
			esc_html( $tab_title ),
			apply_filters( "inp_mc_theme_options_fields_tab_{$tab_slug}", [] )
		);
	}
}
add_action( 'carbon_fields_register_fields', __NAMESPACE__ . '\options_initialize_admin_page' );

/**
 * Add fields to the General tab
 *
 * @return array $fields An array containing the options fields
 * @link https://carbonfields.net/docs/fields-usage/
 */
function options_general_tab_theme_fields() {
	$fields = [];

	// Header blockquote.
	$fields[] = Field::make( 'rich_text', 'header_quote', 'Top header quote' )
				->set_help_text( __( 'This content will be displayed in the top part of your site, below the main content of the page.', 'inp-mc' ) );

	// Footer copyright text.
	$fields[] = Field::make( 'rich_text', 'copyright_text', 'Footer copyright text' )
				->set_help_text( __( 'Note that use can use the placeholder <code>%year%</code> to automatically display the current year.', 'inp-mc' ) );

	return $fields;
}
add_filter( 'inp_mc_theme_options_fields_tab_general', __NAMESPACE__ . '\options_general_tab_theme_fields' );

/**
 * Add fields to the Social tab
 *
 * @return array $fields An array containing the options fields
 * @link https://carbonfields.net/docs/fields-usage/
 */
function options_social_tab_theme_fields() {
	$fields = [];

	$networks = [
		'instagram',
		'twitter',
		'vimeo',
		'youtube',
	];

	// Social networks URLs
	array_walk(
		$networks,
		function ( $network ) use ( &$fields ) {
			/* Translators: "{social network name} URL" */
			$title    = sprintf( __( '%1$s URL', 'inp-mc' ), ucfirst( $network ) );
			$fields[] = Field::make( 'text', "social_url_{$network}", $title )
						->set_required()
						->set_width( 50 );
		}
	);

	return $fields;
}
add_filter( 'inp_mc_theme_options_fields_tab_social', __NAMESPACE__ . '\options_social_tab_theme_fields' );

/**
 * Add fields to the Advanced tab
 *
 * @return array $fields An array containing the options fields
 * @link https://carbonfields.net/docs/fields-usage/
 */
function options_advanced_tab_theme_fields() {
	$fields = [];

	// wp_head extra scripts/styles.
	$fields[] = Field::make( 'header_scripts', 'extra_header_code' );

	// wp_footer extra scripts/styles.
	$fields[] = Field::make( 'footer_scripts', 'extra_footer_code' );

	return $fields;
}
add_filter( 'inp_mc_theme_options_fields_tab_advanced', __NAMESPACE__ . '\options_advanced_tab_theme_fields' );

/**
 * Custom server-side fields validations.
 * We do have JS client-side validation, but better safe than sorry!
 *
 * @param boolean $save Whether the field value will be saved or ignored (original).
 * @param string $value The field value.
 * @param Field $field Carbon Field object.
 * @param boolean $save Whether if the field value will be saved or ignored (modified).
 *
 * @link https://carbonfields.net/docs/advanced-topics-hooks-3/
 */
function options_custom_validations( $save, $value, $field ) {
	/**
	 * Social networks URL fields validation
	 * - ensure that we have a valid URL, and potentially add "http://" prefix to URL.
	 */
	if ( strpos( $field->get_name(), 'social_url_' ) !== false ) {
		if ( strpos( $value, 'http' ) !== 0 ) {
			$value = "http://$value";
		}

		if ( ! filter_var( $value, FILTER_VALIDATE_URL ) ) {
			return false;
		}

		$field->set_value( $value );
	}

	return $save;
}
add_filter( 'carbon_fields_should_save_field_value', __NAMESPACE__ . '\options_custom_validations', 10, 3 );

/**
 * Proxy function to get a specific option
 *
 * @param string $option The option ID
 * @param string $container_id The container ID
 * @return mixed The option value.
 */
function get_option( $option, $container_id = '' ) {
	return \carbon_get_theme_option( $option, $container_id );
}
