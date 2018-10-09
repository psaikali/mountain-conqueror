		<?php do_action( 'inp_mc_end_content' ); ?>
	</main><!-- #content -->
</section>

<?php do_action( 'inp_mc_before_footer' ); ?>

<footer id="footer" role="contentinfo">
	<?php do_action( 'inp_mc_start_footer' ); ?>

	<div class="container">
		<section class="footer-data">
			<div class="copyright inline">
				<?php MountainConqueror\Templating\display_copyright_text(); ?>
			</div>

			<nav class="social inline">
				<?php MountainConqueror\Templating\display_social_network_links(); ?>
			</nav>

			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu(
					[
						'theme_location' => 'footer',
						'menu_class'     => 'menu inline',
						'container'      => false,
					]
				);
			}
			?>
		</section>
	</div>

	<?php do_action( 'inp_mc_end_footer' ); ?>
</footer>

<?php do_action( 'inp_mc_after_footer' ); ?>


<?php wp_footer(); ?>

</body>
</html>
