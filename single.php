<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Pskli Mountain Conqueror
 */

get_header(); ?>

	<div class="primary content-area col-l-8">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			/**
			 * Include /parts/content-single-{$CPT}.php if it exists.
			 * Fallback to /parts/content-{$CPT}.php.
			 *
			 * This allows logic to have same template file for archive/single post layout by default,
			 * or a different template file if needed.
			 */
			$current_post_type = get_post_type();

			if ( locate_template( "parts/content-single-{$current_post_type}.php" ) ) {
				get_template_part( 'parts/content-single', $current_post_type );
			} else {
				get_template_part( 'parts/content', $current_post_type );
			}

			the_post_navigation();

			// (For later) : if comments are open or we have at least one comment, load up the comment template.
			if ( apply_filters( 'inp_mc_display_comments_on_single', false, $current_post_type ) && comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- .primary -->

<?php
get_footer();
