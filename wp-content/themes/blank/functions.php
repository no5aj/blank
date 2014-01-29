<?php
	function blank_setup() {
		add_theme_support('automatic-feed-links');	
		register_nav_menu('primary', __('Navigation Menu', 'blank'));
		add_theme_support('post-thumbnails');
	}
	add_action('after_setup_theme', 'blank_setup');
	
	// Scripts & Styles (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
	function blank_scripts_styles() {
		global $wp_styles;

		// Load Comments	
		if(is_singular() && comments_open() && get_option( 'thread_comments' ))
			wp_enqueue_script( 'comment-reply' );
	
		// Load Stylesheets
//		wp_enqueue_style( 'blank-reset', get_template_directory_uri() . '/reset.css' );
//		wp_enqueue_style( 'blank-style', get_stylesheet_uri() );
	
		// Load IE Stylesheet.
//		wp_enqueue_style( 'blank-ie', get_template_directory_uri() . '/css/ie.css', array( 'blank-style' ), '20130213' );
//		$wp_styles->add_data( 'blank-ie', 'conditional', 'lt IE 9' );

		// Modernizr
		// This is an un-minified, complete version of Modernizr. Before you move to production, you should generate a custom build that only has the detects you need.
		// wp_enqueue_script( 'blank-modernizr', get_template_directory_uri() . '/_/js/modernizr-2.6.2.dev.js' );
		
	}
	add_action('wp_enqueue_scripts', 'blank_scripts_styles');
	
	// WP Title (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
	function blank_wp_title($title, $sep) {
		global $paged, $page;
	
		if(is_feed())
			return $title;
	
//		 Add the site name.
		$title .= ' '.$sep.' '.get_bloginfo('name');
	
//		 Add the site description for the home/front page.
		$site_description = get_bloginfo('description', 'display');
		if ($site_description && (is_home() || is_front_page()))
			$title = "$title $sep $site_description";
	
//		 Add a page number if necessary.
		if ($paged >= 2 || $page >= 2)
			$title = "$title $sep ".sprintf(__('Page %s', 'blank'), max($paged, $page));
		return $title;
	}
	add_filter('wp_title', 'blank_wp_title', 10, 2);

//OLD STUFF BELOW


	// Load jQuery
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

	// Clean up the <head>, if you so desire.
	function removeHeadLinks() {
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wlwmanifest_link');
	}
	add_action('init', 'removeHeadLinks');

	// Custom Menu
	register_nav_menu( 'primary', __( 'Navigation Menu', 'blank' ) );

	// Navigation - update coming from twentythirteen
	function post_navigation() {
		echo '<div class="navigation">';
		echo '	<div class="next-posts">'.get_next_posts_link('&laquo; Older Entries').'</div>';
		echo '	<div class="prev-posts">'.get_previous_posts_link('Newer Entries &raquo;').'</div>';
		echo '</div>';
	}

	// Posted On
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
