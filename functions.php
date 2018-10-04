<?php

namespace MountainConqueror;

/**
 * Includes all files.
 *
 * The $files_to_include array below defines the list of all included files that we need
 * for this theme to run. It does support child theme overrides.
 *
* @since 1.0.0
 */
function include_all_files() {
	$files_to_include = [
		/**
		 * Helper functions
		 */
		'inc/helpers.php',

		/**
		 * Setup theme entities (menus, widgets, supports...)
		 */
		'inc/setup.php',

		/**
		 * Enqueue CSS & JS assets
		 */
		'inc/assets.php',

		/**
		 * Modify WP logic via hooks
		 */
		'inc/hooks.php',

		/**
		 * Templating functions for outputting things
		 */
		'inc/templating.php',

		/**
		 * Templating functions for outputting things
		 */
		'inc/templating.php',

		/**
		 * Use dummy Event/Location/ContactPerson class while developing this theme
		 */
		'inc/dummy-data/dummy-data.php',
	];

	foreach ( $files_to_include as $file ) {
		if ( ! $filepath = locate_template( $file ) ) {
			trigger_error( 
				sprintf( 
					__( 'Error locating %s for inclusion', 'inp-mc' ), 
					$file
				), 
			E_USER_ERROR);
		}

		require_once $filepath;
	}
}

include_all_files();
