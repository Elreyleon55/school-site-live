<?php

/**
 * School site functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SCH_School_Theme
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function school_theme_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on School site, use a find and replace
		* to change 'school-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('school-theme', get_template_directory() . '/languages');

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

	// adding theme support for wide images
	add_theme_support('align-wide');
	/*
    * student-thumbnail size
	*/
	add_image_size('student-thumbnail', 200, 300, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'school-theme'),
			'footer-left' => esc_html__('Footer - left Side', 'sch',),
			'footer-right' => esc_html__('Footer - right side', 'sch',)
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'school_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Change Excerpt Length to 20 words 
	function fwd_excerpt_length($length)
	{
		return 20;
	}
	add_filter('excerpt_length', 'fwd_excerpt_length', 999);

	// Change the excerpt "more" text
	function fwd_excerpt_more($more)
	{
		$more = '... <a class="read-more" href="' . esc_url(get_permalink()) . '">Continue Reading</a>';
		return $more;
	}
	add_filter('excerpt_more', 'fwd_excerpt_more', 999);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'school_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function school_theme_content_width()
{
	$GLOBALS['content_width'] = apply_filters('school_theme_content_width', 640);
}
add_action('after_setup_theme', 'school_theme_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function school_theme_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'school-theme'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'school-theme'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'school_theme_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function school_theme_scripts()
{

	wp_enqueue_style(
		'SCH-googlefonts', // unique handle
		'https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap',
		array(),
		null // version number, for google Fonts always set to null
	);

	wp_enqueue_style('school-theme-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('school-theme-style', 'rtl', 'replace');

	wp_enqueue_script('school-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'school_theme_scripts');

function enqueue_aos_library()
{
	if (is_singular('post') || is_post_type_archive('post') || is_home()) {
		wp_enqueue_style('aos-css', get_template_directory_uri() . '/css/aos.css');
		wp_enqueue_script('aos-js', get_template_directory_uri() . '/js/aos.js', array(), null, true);

		wp_add_inline_script('aos-js', 'AOS.init();');
	}
}

add_action('wp_enqueue_scripts', 'enqueue_aos_library');




/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * CPT and Taxonomies
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';

// Include the taxonomy for staff
require get_template_directory() . '/taxanomy-sch-staff-type.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Enqueue scripts and styles.
 */
// function fwd_scripts()
// {
// 	wp_enqueue_style(
// 		'fwd-googlefonts', // unique handle
// 		'https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap',
// 		array(),
// 		null // version number, for google Fonts always set to null
// 	);

// }
// add_action('wp_enqueue_scripts', 'fwd_scripts');


// add Block Editor template for Student CPT

function sch_school_student_block_template()
{

	$post_type_object = get_post_type_object('sch-student');

	if (!$post_type_object) {
		return;
	}

	$post_type_object->template = array(
		array('core/paragraph', array(
			'placeholder' => 'Add short biography here...',
		)),
		array('core/button', array(
			'text' => 'View Portfolio',
			'url' => '#',
		)),
	);

	$post_type_object->template_lock = 'all'; // locks all blocks
}
add_action('init', 'sch_school_student_block_template');

// Add student name
function change_student_title_placeholder($title)
{
	$screen = get_current_screen();
	if ('sch-student' == $screen->post_type) {
		$title = 'Add student name';
	}
	return $title;
}
add_filter('enter_title_here', 'change_student_title_placeholder');


// Add staff placeholder
function change_staff_title_placeholder( $title ) {
    $screen = get_current_screen();


    if ( 'sch-staff' == $screen->post_type ) {
        $title = 'Add staff name';
    }

    return $title;
}
add_filter( 'enter_title_here', 'change_staff_title_placeholder' );

