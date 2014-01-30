<?php
	function blank_setup() {
		add_theme_support('automatic-feed-links');	
		register_nav_menu('primary', __('Navigation Menu', 'blank'));
		add_theme_support('post-thumbnails');
	}
	add_action('after_setup_theme', 'blank_setup');
	
	function blank_scripts_styles() {
		global $wp_styles;
	
		wp_enqueue_style('style', get_template_directory_uri().'/static/css/style.css');
		wp_enqueue_script('modernizr', get_template_directory_uri().'/static/js/modernizr.min.js');
		wp_enqueue_script('functions', get_template_directory_uri().'/static/js/functions.min.js', array('modernizr','jquery'), true, true);
	}
	add_action('wp_enqueue_scripts', 'blank_scripts_styles');
	
	function blank_wp_title($title, $sep) {
		global $paged, $page;
	
		if(is_feed())
			return $title;
	
		$title .= ' '.$sep.' '.get_bloginfo('name');
	
		$site_description = get_bloginfo('description', 'display');
		if ($site_description && (is_home() || is_front_page()))
			$title = "$title $sep $site_description";
	
		if ($paged >= 2 || $page >= 2)
			$title = "$title $sep ".sprintf(__('Page %s', 'blank'), max($paged, $page));
		return $title;
	}
	add_filter('wp_title', 'blank_wp_title', 10, 2);

	if(!function_exists('core_mods')) {
		function core_mods() {
			if(!is_admin()) {
				wp_deregister_script('jquery');
				wp_register_script('jquery', ('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'), false);
				wp_enqueue_script('jquery');
			}
		}
		add_action('wp_enqueue_scripts', 'core_mods');
	}

	function removeHeadLinks() {
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wlwmanifest_link');
	}
	add_action('init', 'removeHeadLinks');

	register_nav_menu( 'primary', __( 'Navigation Menu', 'blank' ) );

	function post_navigation() {
		echo '<div class="navigation">';
		echo '	<div class="next-posts">'.get_next_posts_link('&laquo; Older Entries').'</div>';
		echo '	<div class="prev-posts">'.get_previous_posts_link('Newer Entries &raquo;').'</div>';
		echo '</div>';
	}

	function posted_on() {
		printf( __( '<span class="sep">Posted </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a> by <span class="byline author vcard">%5$s</span>', '' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_author() )
		);
	}

?>
