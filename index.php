<?php
/**
 * The main template file.
 */

get_header();

if ( have_posts() ) { ?>
	<!--
		TODO: proper <h1> page title could be displayed?
	-->

	<?php
	while ( have_posts() ) {
		the_post();
		get_template_part( 'parts/content', get_post_type() );
	}

	the_posts_navigation();
} else {
	get_template_part( 'parts/content', 'no-results' );
}

get_footer();
