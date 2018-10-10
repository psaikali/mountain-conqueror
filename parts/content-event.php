<?php use MountainConqueror\Templating; ?>
<article <?php post_class( [ 'post' ] ); ?>>
	<footer class="entry-footer">
		<?php Templating\display_event_footer(); ?>
	</footer><!-- .entry-footer -->

	<header class="entry-header">
		<?php
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="entry-text-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
