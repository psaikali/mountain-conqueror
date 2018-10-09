<?php
/**
 * The template for displaying 404 pages (not found).
 */

get_header();
?>

<article class="content-404">
	<header class="entry-header">
		<h1>
			<?php esc_html_e( 'Nothing found', 'inp-mc' ); ?>
		</h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<p>
			<?php esc_html_e( 'It seems we can’t find what you’re looking for. Perhaps searching could help?', 'inp-mc' ); ?>
		</p>
	</div>

	<?php get_search_form(); ?>
</article>

<?php
get_footer();
