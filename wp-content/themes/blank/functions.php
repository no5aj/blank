<?php
	function blank_setup() {
		register_nav_menu('primary', __('Navigation Menu'));
		add_theme_support('automatic-feed-links');	
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

	/* custom posts */
	/*function create_post_type() {
		register_post_type('work',
			array(
				'labels' => array(
					'name' => __('Work', 'cycle'),
					'singular_name' => __('Work', 'cycle')
				),
				'public' => true,
				'hierarchical' => true,
				'capability_type' => 'post',
				'supports' => array('title', 'editor', 'page-attributes', 'thumbnail'),
				'rewrite' => array('slug' => 'work', 'with_front' => false),
				'menu_position' => 5
			)
		);
	}
	add_action('init', 'create_post_type');*/

	/* thumbnails */
	//add_image_size('thumbnail', 400, 400, true);

	/* remove wp-admin menu pages */
	/*function blank_menu_page_removing() {
    remove_menu_page('edit-comments.php');
	}
	add_action('admin_menu', 'blank_menu_page_removing');*/

	/* add bugherd embed code */
	if(defined('BUGHERD_API_KEY')) {
		function add_bugherd() {
		  echo '<script type="text/javascript">
				(function (d, t) {
				  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
				  bh.type = "text/javascript";
				  bh.src = "//www.bugherd.com/sidebarv2.js?'.BUGHERD_API_KEY.'";
				  s.parentNode.insertBefore(bh, s);
			  })(document, "script");
			</script>';
		}
		add_action('admin_head', 'add_bugherd');
		add_action('wp_head', 'add_bugherd');
	}

	/* columns shortcode */
	/*function columns_func($atts, $content=null) {
		extract(shortcode_atts(array(
			'count' => '2',
			'class' => ''
		), $atts));

		return '<div class="columns count-'.$count.' '.$class.'">'.do_shortcode($content).'</div><div class="clearfix"></div>';
	}
	add_shortcode('columns', 'columns_func');

	function column_func($atts, $content=null) {
		return '<div class="column">'.do_shortcode($content).'</div>';
	}
	add_shortcode('column', 'column_func');

	remove_filter( 'the_content', 'wpautop' );
	add_filter( 'the_content', 'wpautop', 99 );
	add_filter( 'the_content', 'shortcode_unautop', 100 );*/

	/* widont - widow removal */
	function widont($str = '') {
		return preg_replace('|([^\s])\s+([^\s]+)\s*$|', '$1&nbsp;$2', $str);
	}

	/* excerpts */
	function get_excerpt_max_charlength($charlength) {
		$excerpt = get_the_excerpt();
		$charlength++;

		if(mb_strlen($excerpt) > $charlength) {
			$subex = mb_substr($excerpt, 0, $charlength - 5);
			$exwords = explode(' ', $subex);
			$excut = -(mb_strlen($exwords[count($exwords) - 1]));
			if($excut < 0) {
				$excerpt =  mb_substr($subex, 0, $excut).'&hellip;';
			} else {
				$excerpt = $subex.'&hellip;';
			}
		}
		return $excerpt;
	}

	/* slugify strings */
	function slugify($text) {
		$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
		$text = trim($text, '-');
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		$text = strtolower($text);
		$text = preg_replace('~[^-\w]+~', '', $text);
		if(empty($text)) return 'n-a';
		return $text;
	}

	/* get id by slug */
	function get_id_by_slug($slug) {
		$page = get_page_by_path($slug);
		if($page) return $page->ID;
		else return false;
	}

	/* create blank svg image of specified dimensions */
	function get_blank_image($width=1, $height=1) {
		$svg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="'.$width.'px" height="'.$height.'px" xml:space="preserve"/>';
		return 'data:image/svg+xml;base64,'.base64_encode($svg);
	}

	/* custom url rewrite rules */
	/*function my_insert_rewrite_rules($rules) {
		$newrules = array();
		$newrules['work/(.+)'] = 'index.php?pagename=work/work-detail&workSlug=$matches[1]';
		return $newrules + $rules;
	}
	add_filter('rewrite_rules_array', 'my_insert_rewrite_rules');
	function my_insert_query_vars($vars) {
	  $vars[] = 'workSlug';
	  return $vars;
	}
	add_filter('query_vars', 'my_insert_query_vars');
	remove_filter('template_redirect', 'redirect_canonical');*/

	/* yoast seo filters */
	/*function update_wpseo_canonical($url) {
		return $url;
	}
	add_filter('wpseo_canonical', 'update_wpseo_canonical');

	function update_wpseo_title($title) {
		return $title;
	}
	add_filter('wpseo_title', 'update_wpseo_title');

	function update_wpseo_metadesc($description) {
		return $description;
	}
	add_filter('wpseo_metadesc', 'update_wpseo_metadesc');

	function update_wpseo_opengraph($image) {
		$image = '';
		$GLOBALS['wpseo_og']->image_output($image);
	}
	add_filter('wpseo_opengraph', 'update_wpseo_opengraph');

	function update_wpseo_robots($robots) {
		return $robots;
	}
	add_filter('wpseo_robots', 'update_wpseo_robots');*/

	/* get svg */
	function get_the_svg($svg) {
		switch($svg) {
			case 'logo':
				return '';
			default:
				return '';
		}
	}

?>
