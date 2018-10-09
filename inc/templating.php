<?php

namespace MountainConqueror\Templating;

use MountainConqueror\Options;

if ( ! function_exists( __NAMESPACE__ . '\get_theme_image' ) ) {
	/**
	 * Return a theme images from the /assets/images/ folder.
	 *
	 * @param string $image The image file.
	 * @param string $subfolder An optional subfolder to look into.
	 * @return string The full path URL to the image.
	 */
	function get_theme_image( $image = 'mountain-conqueror-logo.svg', $subfolder = null ) {
		$path = get_template_directory_uri() . '/assets/images/';

		if ( ! is_null( $subfolder ) ) {
			$path .= trailingslashit( $subfolder );
		}

		$image_with_path = $path . $image;

		return apply_filters( 'inp_mc_theme_image', $image_with_path, $image, $subfolder );
	}
}

if ( ! function_exists( __NAMESPACE__ . '\display_event_footer' ) ) {
	/**
	 * Displays event footer (date and location) on Events archive page.
	 */
	function display_event_footer() {
		global $post;

		// Hook on 'inp_mc_post_is_a_valid_event' filter to modify this boolean.
		if ( ! apply_filters( 'inp_mc_post_is_a_valid_event', false, $post ) ) {
			return;
		}

		echo sprintf(
			'<span class="event-date has-string-separator">%1$s</span><span class="event-location">%2$s</span>',
			esc_html( $post->event->startDate()->format( get_option( 'date_format' ) ) ),
			esc_html( $post->event->location()->country() )
		);
	}
}

if ( ! function_exists( __NAMESPACE__ . '\display_entry_footer' ) ) {
	/**
	 * Prints HTML with meta information for the date, author and categories
	 */
	function display_entry_footer() {
		// Display date.
		echo sprintf(
			'<span class="publication-date has-string-separator"><a href="%1$s">%2$s</a></span>',
			esc_url( get_permalink() ),
			esc_html( get_the_date() )
		);

		// Display author name.
		echo sprintf(
			'<span class="author has-string-separator"><a href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'inp-mc' ) );
			if ( $categories_list ) {
				echo sprintf(
					'<span class="category-links">%1$s</span>',
					wp_kses_post( $categories_list )
				);
			}
		}

		// Disabled for now, enable when needed.
		if ( false && ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'inp-mc' ), esc_html__( '1 Comment', 'inp-mc' ), esc_html__( '% Comments', 'inp-mc' ) );
			echo '</span>';
		}
	}
}

if ( ! function_exists( __NAMESPACE__ . '\display_post_image' ) ) {
	/**
	 * Echo a featured post image. Use in the loop.
	 * Will display the featured post image if post does have one.
	 * Will display the first <img /> src if post does not have featured image.
	 * Otherwise, won't display anything at all.
	 *
	 * @param string  $size The image size to display. Default is thumbnail.
	 * @param boolean $wrap_with_link Whether to make the image clickable, or not.
	 */
	function display_post_image( $size = 'thumbnail', $wrap_with_link = true ) {
		$image_src = null;

		if ( ! has_post_thumbnail() && apply_filters( 'inp_mc_should_use_first_content_image_as_thumbnail', true ) ) {
			/**
			 * Post does NOT have featured image.
			 * Use safety net : find the first <img /> from $post_content.
			 */
			global $post;
			$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );

			if ( isset( $matches[1][0] ) && ! empty( $matches[1][0] ) ) {
				$image_src = $matches[1][0];
			}
		} else {
			/**
			 * Post DOES have a featured image.
			 */
			$image_src = get_the_post_thumbnail_url( null, $size );
		}

		if ( is_null( $image_src ) ) {
			return;
		}

		?>
		<figure class="entry-featured-image" style="background-image:url('<?php echo esc_url( $image_src ); ?>');">
			<?php if ( $wrap_with_link ) { ?>
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
			<?php } ?>
			<img src="<?php echo esc_url( $image_src ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
			<?php if ( $wrap_with_link ) { ?>
			</a>
			<?php } ?>
		</figure>

		<?php
	}
}

if ( ! function_exists( __NAMESPACE__ . '\display_copyright_text' ) ) {
	/**
	 * Display the copyright text saved in the Customizer.
	 */
	function display_copyright_text() {

		// Grab our customizer settings.
		$copyright_text = Options\get_option( 'copyright_text' );

		// Stop if there's nothing to display.
		if ( ! $copyright_text ) {
			return false;
		}

		$copyright_text = str_replace( '%year%', date( 'Y' ), $copyright_text );

		?>
		<span class="copyright-text"><?php echo wp_kses_post( do_shortcode( $copyright_text ) ); ?></span>
		<?php
	}
}

if ( ! function_exists( __NAMESPACE__ . '\display_social_network_links' ) ) {
	/**
	 * Display the social links saved in the customizer.
	 */
	function display_social_network_links() {
		$social_networks = [ 'instagram', 'twitter', 'vimeo', 'youtube' ];

		?>
		<ul class="social-icons">
			<li class="title"><?php esc_html_e( 'Follow my adventures', 'inp-mc' ); ?></li>

			<?php
			foreach ( $social_networks as $network ) {
				$network_url = Options\get_option( "social_url_{$network}" );

				if ( ! empty( $network_url ) ) {
					?>
					<li class="social-icon <?php echo esc_attr( $network ); ?>">
						<a href="<?php echo esc_url( $network_url ); ?>" rel="nofollow" target="_blank">
							<i class="socicon socicon-<?php echo esc_attr( $network ); ?>"></i>
							<span class="screen-reader-text">
							<?php
							/* translators: the social network name */
							printf( esc_html__( 'Link to %s', 'inp-mc' ), ucwords( esc_html( $network ) ) ); // WPCS: XSS OK.
							?>
							</span>
						</a>
					</li><!-- .social-icon -->
					<?php
				}
			}
			?>
		</ul><!-- .social-icons -->
		<?php
	}
}
