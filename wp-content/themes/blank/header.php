<!doctype html>
<!--[if lt IE 9]>			 <html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gte IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php
		if(is_search())
			echo '<meta name="robots" content="noindex, nofollow">';
	?>

	<title><?php wp_title(''); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/static/css/style.css">
	<script src="<?php echo get_template_directory_uri(); ?>/static/js/modernizr.min.js"></script>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrap">
	<header role="banner">
		<h1><a href="/"><?php bloginfo( 'name' ); ?></a></h1>
	</header>
	<nav id="nav" role="navigation">
		<?php wp_nav_menu( array('menu' => 'primary') ); ?>
	</nav>
