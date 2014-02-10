<!DOCTYPE html>

<!-- html BEGIN -->
<html <?php language_attributes(); ?>>
<!-- An Vinny Singh Design - Proudly powered by WordPress (http://wordpress.org) -->
<!-- Gesture Tutorail by Vinny Singh for WPTuts+ -->

<!-- head BEGIN -->
<head>

	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<!-- Title -->
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

	<meta name="viewport" content="width=device-width,initial-scale=1">

	<?php wp_head(); ?>

<!-- head END -->
</head>

<!-- body BEGIN -->
<body id="gesture" <?php body_class(); ?>> 


	<!-- .container BEGIN -->
	<div class="container clearfix">

		<!-- #logo BEGIN -->
		<div id="logo">

			<a href="<?php echo home_url() ?>"><img src="<?php echo get_template_directory_uri() ?>/images/logo.png" alt="Gesture Tutorial" /></a>

		</div><!-- #logo END -->


		<!-- #navigaton BEGIN -->
		<div id="navigation">

			<?php wp_nav_menu( array( 'theme_location' => 'navigation' ) ); ?>

		</div><!-- #navigation END -->

		<div class="clearfix"></div>

		<hr />

		
