<?php
/**
 * The main template file.
 * 
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 * 
 * @link        http://codex.wordpress.org/Template_Hierarchy
 * @since      1.0.0
 */

get_header();

do_action( 'inp_mc_before_content' );

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'parts/content', get_post_format() );
	}
} else {
	get_template_part( 'parts/no-results', 'index' );
}

do_action( 'inp_mc_before_content' );

get_footer();
