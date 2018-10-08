<?php
/**
 * The Events archives template file.
 */

get_header();

if ( have_posts() ) { ?>
	<!--
		TODO: proper <h1> page title could be displayed?
	-->

	<?php
	while ( have_posts() ) {
		the_post();
		get_template_part( 'parts/content', 'event' );
	}

	the_posts_navigation(
		[
			'prev_text'          => esc_html__( 'Older events', 'inp-mc' ),
			'next_text'          => esc_html__( 'Newer events', 'inp-mc' ),
			'screen_reader_text' => esc_html__( 'Events navigation', 'inp-mc' ),
		]
	);

} else {
	esc_html_e( 'Sorry, but we don\'t have any event planned yet!', 'inp-mc' );
	// Or we could use a more complex layout/template if we don't have event yet:
	// get_template_part( 'parts/content', 'no-results' );
}

get_footer();
