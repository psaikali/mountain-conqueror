<?php use MountainConqueror\Templating; ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]--> 
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]--> 
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]--> 
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]--> 
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]--> 
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'inp_mc_before_page' ); ?>

<div id="page" class="hfeed">

	<?php do_action( 'inp_mc_before_masthead' ); ?>

	<section class="site-content container">
		<header id="masthead" role="banner">
			<?php do_action( 'inp_mc_start_masthead' ); ?>

			<?php if ( is_front_page() && is_home() ) { ?>
			<h1 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					<img src="<?php echo esc_url( Templating\get_theme_image( 'mountain-conqueror-logo.svg', 'svg' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
				</a>
			</h1>
			<?php } else { ?>
			<p class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					<img src="<?php echo esc_url( Templating\get_theme_image( 'mountain-conqueror-logo.svg', 'svg' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
				</a>
			</p>
			<?php } ?>

			<nav id="navigation" class="main-navigation">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu(
						[
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'menu dropdown',
						]
					);
				}
				?>
			</nav>

			<?php do_action( 'inp_mc_end_masthead' ); ?>
		</header>

		<?php do_action( 'inp_mc_after_masthead' ); ?>

		<main id="content" role="main">
			<?php do_action( 'inp_mc_start_content' ); ?>
