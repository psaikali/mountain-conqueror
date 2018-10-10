<?php
/**
 * The Events archives template file.
 */

get_header();

if ( have_posts() ) { ?>
	<!--
		TODO: proper <h1> page title could be displayed?
	-->
	<div class="flex-list">
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
		?>
	</div>

	<?php
} else {
	get_template_part( 'parts/content', 'no-results' );
}

get_footer();
