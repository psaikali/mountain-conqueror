<?php
use MountainConqueror\Templating; 
$post_image = Templating\display_post_image();
$post_classes = ( ! is_null( $post_image ) && ! is_single() ) ? [ 'has-featured-image' ] : [];
?>
<article <?php post_class( $post_classes ); ?>>
	<header class="entry-header">
		<?php
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="entry-text-content">
			<?php
			if ( is_single() ) {
				the_content();

				wp_link_pages(
					array(
						'before' => '<nav class="page-links">' . esc_html__( 'Pages:', 'inp-mc' ),
						'after'  => '</nav>',
					)
				);
			} else {
				the_excerpt();
			}
			?>

			<footer class="entry-footer">
				<?php Templating\display_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div><!-- .entry-content -->

		<?php
		if ( ! is_single() ) {
			echo $post_image;
		}
		?>
	</div>
</article><!-- #post-## -->
