<?php use MountainConqueror\Templating; ?>
<article <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		the_title( '<h1 class="entry-title">', '</h1>' );
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="entry-text-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->

		<?php get_template_part( 'parts/partials/single-event', 'details' ); ?>

		<?php get_template_part( 'parts/partials/single-event', 'notes' ); ?>
	</div>
</article><!-- #post-## -->
