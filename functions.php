<?php
/**
 * Luminate functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Luminate
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function luminate_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Luminate, use a find and replace
		* to change 'luminate' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'luminate', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'luminate' ),
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
			'luminate_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

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

	// Register custom menu with name secondary menu.
    register_nav_menus( array(
        'secondary-menu' => __( 'Secondary Menu', 'luminate' ),
    ) );
}
add_action( 'after_setup_theme', 'luminate_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function luminate_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'luminate_content_width', 640 );
}
add_action( 'after_setup_theme', 'luminate_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function luminate_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'luminate' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'luminate' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Positiva Gravity Forms Sidebar', 'luminate' ),
			'id'            => 'positiva-gravity-forms-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'luminate' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Positiva Sidebar', 'luminate' ),
			'id'            => 'positiva-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'luminate' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'luminate_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function luminate_scripts() {
	
	wp_enqueue_style( 'luminate-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'luminate-style', 'rtl', 'replace' );

	wp_enqueue_script( 'luminate-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Enqueue the slick library style from CDN.
    wp_enqueue_style( 'slick', 'https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css' );

	//Enqueue the slick library script from CDN.
    wp_enqueue_script( 'slick', 'https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js', array( 'jquery' ), '1.6.0', true );

	// Enqueue the swiper library style from CDN.
    wp_enqueue_style( 'swiper-style', 'https://unpkg.com/swiper/swiper-bundle.min.css' );

	// Enqueue the swiper library script from CDN.
    wp_enqueue_script( 'swiper-script', 'https://unpkg.com/swiper/swiper-bundle.min.js', array( 'jquery' ), '6.8.4', true );

	// Enqueue the owl carousel library style from CDN.
    wp_enqueue_style( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css' );

	// Enqueue the owl carousel library script from CDN.
    wp_enqueue_script( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );

	// Enqueue Bootstrap CSS from CDN
    wp_enqueue_style( 'bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );

	// Enqueue Bootstrap JavaScript from CDN
    wp_enqueue_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array( 'jquery' ), '4.0.0', true );

	// Enqueue font awesome library from CDN.
    wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', array(), '5.15.3', 'all' );

	// Enqueue jQuery UI Datepicker script.
    wp_enqueue_script( 'jquery-ui-datepicker' );

	// Enqueue jQuery UI Datepicker style.
    wp_enqueue_style( 'jquery-ui-datepicker-style', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );

	// Enqueue JS files.
	wp_enqueue_script( 'cpt-event-scripts', get_template_directory_uri() . '/js/positiva-events.js', array( 'jquery' ), _S_VERSION, true );

	wp_enqueue_script( 'cpt-all-event-scripts', get_template_directory_uri() . '/js/positiva-archive-all-events.js', array( 'jquery' ), '1.0', true );
	
    wp_enqueue_script( 'cpt-upcoming-event-scripts', get_template_directory_uri() . '/js/positiva-archive-upcoming-events.js', array( 'jquery' ), '1.0', true );
	
    wp_enqueue_script( 'cpt-past-event-scripts', get_template_directory_uri() . '/js/positiva-archive-past-events.js', array( 'jquery' ), '1.0', true );

    wp_enqueue_script( 'positiva-gravity-forms-tabs', get_template_directory_uri() . '/js/positiva-gravity-forms-tabs.js', array( 'jquery' ), '1.0', true );

    wp_enqueue_script( 'positiva-slider-scripts', get_template_directory_uri() . '/js/positiva-slider-scripts.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'luminate_scripts' );

/**
 * Enqueue admin style scripts for admin dashboard style.
 *
 * @return void
 */
function enqueue_admin_styles() {
    wp_enqueue_style('admin-styles', get_template_directory_uri() . '/css/admin.css', array(), '1.0', 'all');
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Required the file of theme options.php
require_once( get_template_directory() . '/inc/theme-options.php' );

// Required the file of positiva nav walker menu.php
require get_template_directory() . '/inc/positiva-nav-walker-menu.php';

// Required the file of positiva ajax.php
require_once( get_template_directory() . '/inc/positiva-ajax.php' );

// Required the file of custom theme widgets.php
require_once( get_template_directory() . '/inc/theme-widgets.php' );

// Required the file of custom theme shortcodes.php
require_once( get_template_directory() . '/inc/theme-shortcodes.php' );

// Required the file of custom post type slider.php
require_once( get_template_directory() . '/inc/cpt-slider.php' );

// Required the file of custom post type events.php
require_once( get_template_directory() . '/inc/cpt-events.php' );

// Required the file of display saved theme options data.php
require_once( get_template_directory() . '/inc/display-theme-options.php' );

function display_positiva_cpt_events( $query ) {
	// check if the query has any past posts
	if ( $query->have_posts() ) {
		?>
		<div class="row archive-events-block" id="archive-event-container">
			<?php
			while ( $query->have_posts() ) {
				// set up post data
				$query->the_post();
				// Display the start and end dates
				$event_start_date = get_post_meta(get_the_ID(), '_event_date', true);
				$event_start_time = get_post_meta(get_the_ID(), '_event_start_time', true);
				$event_end_time   = get_post_meta(get_the_ID(), '_event_end_time', true);
				?>
				<div class="col-md-3 col-sm-12 cpt-event-item">
					<div class="row">
						<div class="archive-event-image">
							<?php if (has_post_thumbnail()) : ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail('full'); ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
					<div class="row">
						<div class="archive-event-details">
							<h2 class="archive-event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<div class="archive-event-date">
								<?php echo date_i18n('F j, Y', strtotime($event_start_date)); ?>
							</div>
							<div class="archive-event-time">
								<?php echo date_i18n('g:i A', strtotime($event_start_time)); ?>
								<?php echo "-"; ?>
								<?php echo date_i18n('g:i A', strtotime($event_end_time)); ?>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			// Reset the post data.
			wp_reset_postdata();
			?>
		</div>   
		<?php
	} else {
		echo '<h2>No events found.</h2>';
	}
}