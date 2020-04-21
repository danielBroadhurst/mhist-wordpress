<?php

/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

if (!class_exists('Timber')) {
	add_action('admin_notices', function () {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url(admin_url('plugins.php#timber')) . '">' . esc_url(admin_url('plugins.php')) . '</a></p></div>';
	});

	add_filter('template_include', function ($template) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});

	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array('templates', 'views');

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class StarterSite extends Timber\Site
{
	/** Add timber support. */
	public function __construct()
	{
		add_action('after_setup_theme', array($this, 'theme_supports'));
		add_filter('timber/context', array($this, 'add_to_context'));
		add_filter('timber/twig', array($this, 'add_to_twig'));
		add_action('init', array($this, 'register_post_types'));
		add_action('init', array($this, 'register_taxonomies'));
		parent::__construct();
	}
	/** This is where you can register custom post types. */
	public function register_post_types()
	{ }
	/** This is where you can register custom taxonomies. */
	public function register_taxonomies()
	{ }

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context($context)
	{
		$context['foo'] = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::context();';

		$context['site'] = $this;
		$context['menu'] = new \Timber\Menu(2);
		return $context;
	}

	public function theme_supports()
	{
		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		add_theme_support('menus');

		add_post_type_support('page', 'excerpt');

		register_sidebar(array(
			'name' => 'Pages Right Sidebar',
			'id' => 'page_right',
			'before_widget' => '<div class="widget-sidebar">',
			'after_widget' => '</div>',
			'before_title' => '<h4>',
			'after_title' => '</h4>',
		));

		register_sidebar(array(
			'name' => 'Single Widget for Short Pages',
			'id' => 'page_right_small',
			'before_widget' => '<div class="widget-sidebar">',
			'after_widget' => '</div>',
			'before_title' => '<h4>',
			'after_title' => '</h4>',
		));

		register_sidebar(array(
			'name' => 'Sponsor Images for Home Pages',
			'id' => 'home_page_sponsors',
			'before_widget' => '<div class="cell auto shrink">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		));

		register_sidebar(array(
			'name' => 'Footer Widget 1',
			'id' => 'footer_widget_1',
			'before_widget' => '<div class="footer-widget">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		));
		register_sidebar(array(
			'name' => 'Footer Widget 2',
			'id' => 'footer_widget_2',
			'before_widget' => '<div class="footer-widget">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		));
		register_sidebar(array(
			'name' => 'Footer Widget 3',
			'id' => 'footer_widget_3',
			'before_widget' => '<div class="footer-widget">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		));

		/* Editor Menu Role */

		// add editor the privilege to edit theme

		// get the the role object
		$role_object = get_role( 'editor' );

		// add $cap capability to this role object
		$role_object->add_cap( 'edit_theme_options' );

		/*Custom Post type start*/
		// Support Groups
		function bds_post_type_support_groups()
		{
			$supports = array(
				'title', // post title
				'editor', // post content
				'author', // post author
				'revisions', // post revisions
				'thumbnail', // post thumbnails
				'excerpt', // post excerpt
			);
			$labels = array(
				'name' => _x('Support Groups', 'plural'),
				'singular_name' => _x('Support Group', 'singular'),
				'menu_name' => _x('Support Groups', 'admin menu'),
				'name_admin_bar' => _x('Support Group', 'admin bar'),
				'add_new' => _x('Add New', 'add new'),
				'add_new_item' => __('Add New Support Group'),
				'new_item' => __('New Support Group'),
				'edit_item' => __('Edit Support Group'),
				'view_item' => __('View Support Group'),
				'all_items' => __('All Support Groups'),
				'search_items' => __('Search Support Groups'),
				'not_found' => __('No Support Groups found.'),
			);
			$args = array(
				'supports' => $supports,
				'labels' => $labels,
				'public' => true,
				'query_var' => true,
				'rewrite' => array('slug' => 'support-group'),
				'has_archive' => true,
				'hierarchical' => false,
				'publicly_queryable' => true,
				'show_in_rest' => true,
				'taxonomies' => array('post_tag'),				
			);
			register_post_type('support-group', $args);
		}
		add_action('init', 'bds_post_type_support_groups');
		function wpa_cpt_tags( $query ) {
			if ( $query->is_tag() && $query->is_main_query() ) {
				$query->set( 'post_type', array( 'support-group', 'object' ) );
			}
		}
		add_action( 'pre_get_posts', 'wpa_cpt_tags' );
		//Your Stories
		function bds_post_type_your_stories()
		{
			$supports = array(
				'title', // post title
				'editor', // post content
				'author', // post author
				'revisions', // post revisions
				'thumbnail', // post thumbnails
				'excerpt', // post excerpt
			);
			$labels = array(
				'name' => _x('Your Stories', 'plural'),
				'singular_name' => _x('Your Story', 'singular'),
				'menu_name' => _x('Your Stories', 'admin menu'),
				'name_admin_bar' => _x('Your Stories', 'admin bar'),
				'add_new' => _x('Add New', 'add new'),
				'add_new_item' => __('Add New Your Story'),
				'new_item' => __('New Your Story'),
				'edit_item' => __('Edit Your Story'),
				'view_item' => __('View Your Stories'),
				'all_items' => __('All Your Stories'),
				'search_items' => __('Search Your Stories'),
				'not_found' => __('None of Your Stories found.'),
			);
			$args = array(
				'supports' => $supports,
				'labels' => $labels,
				'public' => true,
				'query_var' => true,
				'rewrite' => array('slug' => 'your-stories'),
				'has_archive' => false,
				'hierarchical' => false,
				'publicly_queryable' => true,
				'show_in_rest' => true,
			);
			register_post_type('your-stories', $args);
		}
		add_action('init', 'bds_post_type_your_stories');

		//FAQ
		function bds_post_type_faq()
		{
			$supports = array(
				'title', // post title
				'editor', // post content
				'author', // post author
				'revisions', // post revisions
			);
			$labels = array(
				'name' => _x('FAQ', 'plural'),
				'singular_name' => _x('FAQ', 'singular'),
				'menu_name' => _x('FAQ', 'admin menu'),
				'name_admin_bar' => _x('FAQ', 'admin bar'),
				'add_new' => _x('Add New', 'add new'),
				'add_new_item' => __('Add New FAQ'),
				'new_item' => __('New FAQ'),
				'edit_item' => __('Edit FAQ'),
				'view_item' => __('View FAQ'),
				'all_items' => __('All FAQ'),
				'search_items' => __('Search FAQ'),
				'not_found' => __('No FAQ found.'),
			);
			$args = array(
				'supports' => $supports,
				'labels' => $labels,
				'public' => true,
				'query_var' => true,
				'rewrite' => array('slug' => 'faq'),
				'has_archive' => false,
				'hierarchical' => false,
				'publicly_queryable' => true,
				'show_in_rest' => true,
				'posts_per_page' => -1
				);
			register_post_type('FAQ', $args);
		}
		add_action('init', 'bds_post_type_faq');

		//FAQ
		function bds_post_type_quotes()
		{
			$supports = array(
				'title', // post title
				'editor', // post content
				'author', // post author
				'revisions', // post revisions
			);
			$labels = array(
				'name' => _x('Quotes', 'plural'),
				'singular_name' => _x('Quotes', 'singular'),
				'menu_name' => _x('Quotes', 'admin menu'),
				'name_admin_bar' => _x('Quotes', 'admin bar'),
				'add_new' => _x('Add New', 'add new'),
				'add_new_item' => __('Add New Quotes'),
				'new_item' => __('New Quotes'),
				'edit_item' => __('Edit Quotes'),
				'view_item' => __('View Quotes'),
				'all_items' => __('All Quotes'),
				'search_items' => __('Search Quotes'),
				'not_found' => __('No Quotes found.'),
			);
			$args = array(
				'supports' => $supports,
				'labels' => $labels,
				'public' => true,
				'query_var' => true,
				'rewrite' => array('slug' => 'quotes'),
				'has_archive' => false,
				'hierarchical' => false,
				'publicly_queryable' => true,
				'show_in_rest' => true,
				'posts_per_page' => -1
				);
			register_post_type('Quotes', $args);
		}
		add_action('init', 'bds_post_type_quotes');

		// Testimonials
		function bds_post_type_testimonials()
		{
			$supports = array(
				'title', // post title
				'editor', // post content
				'author', // post author
				'revisions', // post revisions
				'thumbnail', // post thumbnails
			);
			$labels = array(
				'name' => _x('Testimonial', 'plural'),
				'singular_name' => _x('Testimonials', 'singular'),
				'menu_name' => _x('Testimonials', 'admin menu'),
				'name_admin_bar' => _x('Testimonials', 'admin bar'),
				'add_new' => _x('Add New', 'add new'),
				'add_new_item' => __('Add New Testimonial'),
				'new_item' => __('New Testimonial'),
				'edit_item' => __('Edit Testimonial'),
				'view_item' => __('View Testimonial'),
				'all_items' => __('All Testimonials'),
				'search_items' => __('Search Testimonials'),
				'not_found' => __('No Testimonials found.'),
			);
			$args = array(
				'supports' => $supports,
				'labels' => $labels,
				'public' => true,
				'query_var' => true,
				'rewrite' => array('slug' => 'testimonial'),
				'has_archive' => false,
				'hierarchical' => false,
				'publicly_queryable' => true,
				'show_in_rest' => true,
			);
			register_post_type('Testimonials', $args);
		}
		add_action('init', 'bds_post_type_testimonials');
		// Supporters
		function bds_post_type_supporters()
		{
			$supports = array(
				'title', // post title
				'editor', // post content
				'author', // post author
				'revisions', // post revisions
				'thumbnail', // post thumbnails
				'excerpt', // post thumbnails
				'custom-fields'
			);
			$labels = array(
				'name' => _x('Supporters', 'plural'),
				'singular_name' => _x('Supporter', 'singular'),
				'menu_name' => _x('Supporter', 'admin menu'),
				'name_admin_bar' => _x('Supporter', 'admin bar'),
				'add_new' => _x('Add New', 'add new'),
				'add_new_item' => __('Add New Supporter'),
				'new_item' => __('New Supporter'),
				'edit_item' => __('Edit Supporter'),
				'view_item' => __('View Supporter'),
				'all_items' => __('All Supporters'),
				'search_items' => __('Search Supporters'),
				'not_found' => __('No Supporters found.'),
			);
			$args = array(
				'supports' => $supports,
				'labels' => $labels,
				'public' => true,
				'query_var' => true,
				'rewrite' => array('slug' => 'supporters'),
				'has_archive' => false,
				'hierarchical' => false,
				'publicly_queryable' => true,
				'show_in_rest' => true,
			);
			register_post_type('Supporters', $args);
		}
		add_action('init', 'bds_post_type_supporters');
		/*Custom Post type end*/
		flush_rewrite_rules();
	}


	/** This Would return 'foo bar!'.
	 *
	 * @param string $text being 'foo', then returned 'foo bar!'.
	 */
	public function myfoo($text)
	{
		$text .= ' bar!';
		return $text;
	}



	/** This is where you can add your own functions to twig.
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig($twig)
	{
		$twig->addExtension(new Twig_Extension_StringLoader());
		$twig->addFilter(new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
		return $twig;
	}
}

new StarterSite();
