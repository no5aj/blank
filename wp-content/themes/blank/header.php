<!doctype html>
<!--[if lt IE 9]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gte IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if(is_search()) echo '<meta name="robots" content="noindex, nofollow">'; ?>
	<title><?php wp_title(''); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrap">
	<header role="banner">
		<?php if(is_front_page()): ?>
		<h1><a href="/"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else: ?>
		<h2><a href="/"><?php bloginfo( 'name' ); ?></a></h2>
		<?php endif; ?>
	</header>
	<nav id="nav" role="navigation">
		<?php wp_nav_menu( array('menu' => 'primary') ); ?>
	</nav>
