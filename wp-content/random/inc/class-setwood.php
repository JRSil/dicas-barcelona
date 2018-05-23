<?php
/**
 * Setwood Class
 *
 * @author   WooThemes
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Setwood' ) ) :

class Setwood {

    /**
     * Setup class.
     *
     * @since 1.0
     */
    public function __construct() {
        add_action( 'after_setup_theme',		array( $this, 'setup' ) );
        add_action( 'widgets_init',				array( $this, 'widgets_init' ) );
        add_action( 'wp_enqueue_scripts', 		array( $this, 'scripts' ), 			10 );
        add_action( 'wp_enqueue_scripts', 		array( $this, 'child_scripts' ), 	30 ); // After WooCommerce
        add_filter( 'body_class', 				array( $this, 'body_classes' ) );
        add_filter( 'wp_page_menu_args', 		array( $this, 'page_menu_args' ) );
        add_action( 'wp_footer',                array( $this, 'get_structured_data' ) );
    }

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    public function setup() {

        /**
         * Set the content width based on the theme's design and stylesheet.
         */
        if ( ! isset( $content_width ) ) {
            $content_width = 980; /* pixels */
        }

        /**
         * Assign the Setwood version to a var
         */
        $theme 				= wp_get_theme( 'setwood' );
        $setwood_version 	= $theme['Version'];

        /*
         * Load Localisation files.
         *
         * Note: the first-loaded translation file overrides any following ones if the same translation is present.
         */

        // wp-content/languages/themes/setwood-it_IT.mo
        load_theme_textdomain( 'setwood', trailingslashit( WP_LANG_DIR ) . 'themes/' );

        // wp-content/themes/child-theme-name/languages/it_IT.mo
        load_theme_textdomain( 'setwood', get_stylesheet_directory() . '/languages' );

        // wp-content/themes/setwood/languages/it_IT.mo
        load_theme_textdomain( 'setwood', get_template_directory() . '/languages' );

        /**
         * Add default posts and comments RSS feed links to head.
         */
        add_theme_support( 'automatic-feed-links' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 640, 480, true );
        add_image_size( 'setwood-square-thumbnail', 480, 480, true );
        add_image_size( 'setwood-full-width', 1170, 680, true );//1170 pixels wide (and unlimited height)
        add_image_size( 'setwood-full-screen', 1920, 680, true );

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array(
            'video', 'gallery', 'audio', 'quote'
        ) );

        // This theme uses wp_nav_menu() in three locations.
        register_nav_menus( array(
            'primary'		=> esc_html__( 'Primary Menu', 'setwood' ),
            'secondary'		=> esc_html__( 'Secondary Menu', 'setwood' ),
            'handheld'		=> esc_html__( 'Handheld Menu', 'setwood' ),
            'sticky'		=> esc_html__( 'Sticky Menu', 'setwood' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'widgets',
        ) );

        // Setup the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'setwood_custom_background_args', array(
            'default-color' => apply_filters( 'setwood_default_background_color', 'fcfcfc' ),
            'default-image' => '',
        ) ) );

        // Declare WooCommerce support
        add_theme_support( 'woocommerce' );

        // New WooCommerce 3.0 gallery features.
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );

        // Declare support for title theme feature
        add_theme_support( 'title-tag' );
        
		/**
		 * Setup the WordPress core custom header feature.
		 *
		 * @uses setwood_header_style()
		 * @uses setwood_admin_header_style()
		 * @uses setwood_admin_header_image()
		 */
        add_theme_support( 'custom-header', apply_filters( 'setwood_custom_header_args', array(
            'default-image' => '',
            'header-text'   => false,
            'width'         => 1950,
            'height'        => 500,
            'flex-width'    => true,
            'flex-height'   => true,
        ) ) );
    }

    /**
     * Register widget area.
     *
     * @link http://codex.wordpress.org/Function_Reference/register_sidebar
     */
    public function widgets_init() {
        register_sidebar( array(
            'name'          => esc_html__( 'Sidebar', 'setwood' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'setwood' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<div class="widget-title"><h3><span>',
            'after_title'   => '</span></h3></div>',
        ) );

        register_sidebar( array(
            'name'          => esc_html__( 'Below Header', 'setwood' ),
            'id'            => 'header-1',
            'description'   => esc_html__( 'Widgets added to this region will appear beneath the homepage slider and above the main content.', 'setwood' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<div class="widget-title"><h3><span>',
            'after_title'   => '</span></h3></div>',
        ) );
        
        register_sidebar( array(
            'name'          => esc_html__( 'Instagram Footer', 'setwood' ),
            'id'            => 'instagram-footer',
            'description'   => esc_html__( 'Use the Instagram widget here. For best result select "Large" under "Photo Size" and set number of photos to 8.', 'setwood' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<div class="widget-title"><h3><span>',
            'after_title'   => '</span></h3></div>',
        ) );
        
         register_sidebar( array(
            'name'          => esc_html__( 'Shop Sidebar', 'setwood' ),
            'id'            => 'sidebar-shop',
            'description'   => esc_html__( 'Add widgets here to appear in your Shop page sidebar.', 'setwood' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<div class="widget-title"><h3><span>',
            'after_title'   => '</span></h3></div>',
        ) );

        $featured_widget_regions = apply_filters( 'setwood_featured_widget_regions', 4 );

        for ( $i = 1; $i <= intval( $featured_widget_regions ); $i++ ) {
            register_sidebar( array(
                'name' 				=> sprintf( esc_html__( 'Featured %d', 'setwood' ), $i ),
                'id' 				=> sprintf( 'featured-%d', $i ),
                'description' 		=> sprintf( esc_html__( 'Widgetized Featured Region %d.', 'setwood' ), $i ),
                'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
                'after_widget' 		=> '</aside>',
                'before_title'  => '<div class="widget-title"><h3><span>',
                'after_title'   => '</span></h3></div>',
                )
            );
        }

        $footer_widget_regions = apply_filters( 'setwood_footer_widget_regions', 4 );

        for ( $i = 1; $i <= intval( $footer_widget_regions ); $i++ ) {
            register_sidebar( array(
                'name' 				=> sprintf( esc_html__( 'Footer %d', 'setwood' ), $i ),
                'id' 				=> sprintf( 'footer-%d', $i ),
                'description' 		=> sprintf( esc_html__( 'Widgetized Footer Region %d.', 'setwood' ), $i ),
                'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
                'after_widget' 		=> '</aside>',
                'before_title'  => '<div class="widget-title"><h3><span>',
                'after_title'   => '</span></h3></div>',
                )
            );
        }
    }


    /**
     * Enqueue scripts and styles.
     * @since  1.0.0
     */
    public function scripts() {
        global $setwood_version;

        wp_enqueue_style( 'setwood-style', get_template_directory_uri() . '/style.css', '', $setwood_version );
        wp_style_add_data( 'setwood-style', 'rtl', 'replace' ); // FUTURE RTL

        wp_enqueue_style( 'fontawesome-css', get_template_directory_uri(). '/assets/fonts/fontawesome/font-awesome.min.css', '', $setwood_version );
        
        /**
         * Fonts
         */
        $google_fonts = apply_filters( 'setwood_google_font_families', array(
            'poppins' => 'Poppins:400,500,600',
            'lato' => 'Lato:400,400italic,500,700',
            'playfairdisplay' => 'Playfair Display:700,700italic',
        ) );

        $query_args = array(
            'family' => urlencode( implode( '|', $google_fonts ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

        wp_enqueue_style( 'setwood-fonts', $fonts_url, array(), null );

        wp_enqueue_style( 'setwood-slick-css', get_template_directory_uri() . '/inc/slick/slick.css', '', $setwood_version );
        wp_enqueue_style( 'magnific-popup-css', get_template_directory_uri() . '/assets/css/magnific-popup.css', '', $setwood_version );
        
        // Remove Contact Form 7 Styles
		if ( function_exists( 'wpcf7_enqueue_styles') ) {
			wp_dequeue_style( 'contact-form-7' );
		}

        wp_enqueue_script( 'setwood-imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ), $setwood_version, true );
        wp_enqueue_script( 'setwood-fitvids', get_template_directory_uri() . '/assets/js/jquery.fitvids.js', array( 'jquery' ), $setwood_version, true );

        wp_enqueue_script( 'setwood-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), $setwood_version, true );
        wp_enqueue_script( 'setwood-sticky', get_template_directory_uri() . '/assets/js/jquery.sticky.js', array(), $setwood_version, true );
        wp_enqueue_script( 'setwood-theia-sticky-sidebar', get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.js', array(), $setwood_version, true );
        //Slick Nav
        wp_enqueue_script ( 'slicknav', get_template_directory_uri() . '/inc/slicknav/jquery.slicknav.min.js', array( 'jquery' ), $setwood_version, true );

        wp_enqueue_script( 'setwood-slick-js', get_template_directory_uri() . '/inc/slick/slick.min.js', array( 'jquery' ), $setwood_version, true );
        //match height
        wp_enqueue_script( 'setwood-matchheight-js', get_template_directory_uri() . '/assets/js/jquery.matchHeight.js', array( 'jquery' ), $setwood_version, true );

        wp_enqueue_script( 'setwood-magnific-js', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), $setwood_version, true );
        wp_enqueue_script( 'setwood-custom-js', get_template_directory_uri() . '/assets/js/setwood.js', array( 'jquery' ), $setwood_version, true );
        wp_localize_script( 'setwood-custom-js', 'setwood_js_settings', setwood_get_js_settings() );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }

    /**
     * Enqueue child theme stylesheet.
     * A separate function is required as the child theme css needs to be enqueued _after_ the parent theme
     * primary css and the separate WooCommerce css.
     * @since  1.5.3
     */
    public function child_scripts() {
        if ( is_child_theme() ) {
            wp_enqueue_style( 'setwood-child-style', get_stylesheet_uri(), '' );
        }
    }


    /**
     * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
     *
     * @param array $args Configuration arguments.
     * @return array
     */
    public function page_menu_args( $args ) {
        $args['show_home'] = true;
        return $args;
    }

    /**
     * Adds custom classes to the array of body classes.
     *
     * @param array $classes Classes for the body element.
     * @return array
     */
    public function body_classes( $classes ) {
        // Adds a class of group-blog to blogs with more than 1 published author.
        if ( is_multi_author() ) {
            $classes[] = 'group-blog';
        }

        if ( ! function_exists( 'woocommerce_breadcrumb' ) ) {
            $classes[]	= 'no-wc-breadcrumb';
        }

        /**
         * What is this?!
         * Take the blue pill, close this file and forget you saw the following code.
         * Or take the red pill, filter setwood_make_me_cute and see how deep the rabbit hole goes...
         */
        $cute	= apply_filters( 'setwood_make_me_cute', false );

        if ( true === $cute ) {
            $classes[] = 'setwood-cute';
        }
        
        /*Post Layout*/
        $classes[] = setwood_get_post_layout();

        /*Header Layout*/
        $classes[]  = 'site-header-'.get_theme_mod( 'header_layout', '1' );

        /*Site Layout*/
        $classes[] = get_theme_mod( 'site_layout', 'full-width' );

        return $classes;
    }


    /**
     * As far as I see, it's the most appropriate way to store the data generated from the post and product loop...
     */
    private static $structured_data;
    
        /**
         * Check if the passed $json variable is an array and store it into the property...
         */
        public static function set_structured_data( $json ) {
            if ( ! is_array( $json ) ) {
                return;
            }
            self::$structured_data[] = $json;
        }
        /**
         * If self::$structured_data is set, wrap and echo it...
         * Hooked into the `wp_footer` action.
         */
        public function get_structured_data() {
            if ( ! self::$structured_data ) {
                return;
            }
            $structured_data['@context'] = 'http://schema.org/';
            if ( count( self::$structured_data ) > 1 ) {
                $structured_data['@graph'] = self::$structured_data;
            } else {
                $structured_data = $structured_data + self::$structured_data[0];
            }
            $structured_data = $this->sanitize_structured_data( $structured_data );
            echo '<script type="application/ld+json">' . wp_json_encode( $structured_data ) . '</script>';
        }
        /**
         * Sanitize structured data.
         *
         * @param  array $data
         * @return array
         */
        public function sanitize_structured_data( $data ) {
            $sanitized = array();
            foreach ( $data as $key => $value ) {
                if ( is_array( $value ) ) {
                    $sanitized_value = $this->sanitize_structured_data( $value );
                } else {
                    $sanitized_value = sanitize_text_field( $value );
                }
                $sanitized[ sanitize_text_field( $key ) ] = $sanitized_value;
            }
            return $sanitized;
        }
    }
endif;

return new Setwood();
