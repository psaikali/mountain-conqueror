<?php
/**
 * The template for displaying 404 pages (not found).
 */

get_header();
?>

<article class="content-404">
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<p>
		<?php esc_html_e( 'It seems we can’t find what you’re looking for. Perhaps searching could help?', 'inp-mc' ); ?>
	</p>

	<?php get_search_form(); ?>
</article>

<?php
get_footer();
