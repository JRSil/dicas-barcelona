<?php

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
/* Remove Native Customizer settings */
function remove_customizer_settings( $wp_customize ){
    $wp_customize->remove_section('colors');
}
function modify_customizer_settings( $wp_customize ){
    $wp_customize->get_section( 'title_tagline' )->title = esc_html__( 'Site Identity', 'setwood' );
    $wp_customize->get_section( 'title_tagline' )->priority = 10;
    $wp_customize->get_section( 'title_tagline' )->panel = 'general_settings';
    $wp_customize->get_section( 'background_image' )->panel = 'general_settings';
    $wp_customize->get_section( 'header_image' )->title = esc_html__( 'Header', 'setwood' );
    $wp_customize->get_section( 'header_image' )->panel = 'general_settings';
}
add_action( 'customize_register', 'remove_customizer_settings', 20 );
add_action( 'customize_register', 'modify_customizer_settings', 30 );

/* Early exit if Kirki is not installed */
if ( ! class_exists( 'Kirki' ) ) {
    return;
}

/* Register Kirki config */
Setwood_Kirki::add_config( 'setwood_settings', array(
        'capability'            => 'edit_theme_options',
        'option_type'           => 'theme_mod',
) );

/**
 * General Panel
 */
Setwood_Kirki::add_panel( 'general_settings', array(
    'priority'                  => 40,
    'title'                     => esc_html__( 'General Settings', 'setwood' ),
    'description'               => esc_html__( 'This panel contains the General Controls', 'setwood' ),
) );
/**

/**
 * Blog Panel
 */
Setwood_Kirki::add_panel( 'layout_settings', array(
    'priority'                  => 50,
    'title'                     => esc_html__( 'Layout Settings', 'setwood' ),
    'description'               => esc_html__( 'This panel contains the Layout Controls', 'setwood' ),
) );
/**
 * Content Panel
 */
Setwood_Kirki::add_panel( 'color_settings', array(
    'priority'                  => 330,
    'title'                     => esc_html__( 'Color Settings', 'setwood' ),
    'description'               => esc_html__( 'This panel contains the Color Controls', 'setwood' ),
) );
/**
 * Typography Panel
 */
Setwood_Kirki::add_panel( 'typo_settings', array(
    'priority'                  => 330,
    'title'                     => esc_html__( 'Typography Settings', 'setwood' ),
    'description'               => esc_html__( 'This panel contains the Font Controls', 'setwood' ),
) );

/**
 * Woocommerce Panel
 */
Setwood_Kirki::add_panel( 'woocommerce_settings', array(
    'priority'                  => 330,
    'title'                     => esc_html__( 'Woocommerce', 'setwood' ),
    'description'               => esc_html__( 'This panel contains Woocommerce Controls', 'setwood' ),
) );


/**
 * Logo
 */
Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'image',
        'settings'               => 'logo',
        'label'                 => esc_html__( 'Logo', 'setwood' ),
        'description'           => esc_html__( 'Upload your logo', 'setwood' ),
        'section'               => 'title_tagline',
        'default'               => esc_url( get_template_directory_uri().'/assets/images/setwood-logo.png' ),
    ) );

/**
 * Logo Retina
 */
Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'image',
        'settings'               => 'logo_retina',
        'label'                 => esc_html__( 'Retina Logo - Optional', 'setwood' ),
        'description'           => esc_html__( 'Upload high resolution for devices with retina displays.', 'setwood' ),
        'section'               => 'title_tagline',
        'default'               => esc_url( get_template_directory_uri().'/assets/images/setwood-logo@2x.png' ),
    ) );

/**
 * Logo Mini
 */
Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'image',
        'settings'               => 'logo_mini',
        'label'                 => esc_html__( 'Logo Mini size', 'setwood' ),
        'description'           => esc_html__( 'Upload mini size logo for sticky header', 'setwood' ),
        'section'               => 'title_tagline',
        'default'               => esc_url( get_template_directory_uri().'/assets/images/setwood-logo-mini.png' ),
    ) );

/**
 * Logo Retina Mini
 */
Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'image',
        'settings'               => 'logo_retina_mini',
        'label'                 => esc_html__( 'Retina Logo Mini Size - Optional', 'setwood' ),
        'description'           => esc_html__( 'Upload high resolution for devices with retina displays.', 'setwood' ),
        'section'               => 'title_tagline',
        'default'               => esc_url( get_template_directory_uri().'/assets/images/setwood-logo-mini@2x.png' ),
    ) );

/**
 * Display site description
 */
Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'toggle',
        'settings'               => 'site_description',
        'label'                 => esc_html__( 'Display site description', 'setwood' ),
        'section'               => 'title_tagline',
        'default'               => '0',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'number',
        'settings'               => 'logo_padding_top',
        'label'                 => esc_html__( 'Logo Padding Top', 'setwood' ),
        'section'               => 'title_tagline',
        'default'               => '42',
        'choices'               => array(
        'min'                   => 0,
        'max'                   => 500,
        'step'                  => 1,
    ),
    'output'                    => array(
        array(
            'element'           => '.site-header .site-branding',
            'property'          => 'padding-top',
            'units'             => 'px',
        ),
    ),
    'transport'         => 'auto',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'number',
        'settings'               => 'logo_padding_bottom',
        'label'                 => esc_html__( 'Logo Padding Bottom', 'setwood' ),
        'section'               => 'title_tagline',
        'default'               => '42',
        'choices'               => array(
        'min'                   => 0,
        'max'                   => 500,
        'step'                  => 1,
    ),
    'output'                    => array(
        array(
            'element'           => '.site-header .site-branding',
            'property'          => 'padding-bottom',
            'units'             => 'px',
        ),
    ),
    'transport'         => 'auto',
    ) );

/* Header options */

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'select',
        'settings'               => 'header_layout',
        'label'                 => esc_html__( 'Select Header Layout', 'setwood' ),
        'section'               => 'header_image',
        'priority'              => 2,
        'default'               => '1',
        'choices'               => array(
            '1'                 => esc_html__( 'Header 1', 'setwood' ),
            '2'                 => esc_html__( 'Header 2', 'setwood' ),
            '3'                 => esc_html__( 'Header 3', 'setwood' ),
        ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'switch',
        'settings'               => 'header_sticky',
        'label'                 => esc_html__( 'Display sticky header', 'setwood' ),
        'section'               => 'header_image',
        'default'               => '1',
        'choices'   => array(
            '1'     => esc_attr__( 'On', 'setwood' ),
            '0'     => esc_attr__( 'Off', 'setwood' ),
        ),
    ) );

/* Top Section */

Setwood_Kirki::add_section( 'setwood_top_bar', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Top Section', 'setwood' ),
        'description'           => esc_html__( 'Use these settings to manage top section. To remove top section hide all elements below and unassign secondary menu', 'setwood' ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'toggle',
        'settings'               => 'show_header_social',
        'label'                 => esc_html__( 'Display Social Icons', 'setwood' ),
        'section'               => 'setwood_top_bar',
        'default'               => 1,
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'toggle',
        'settings'               => 'nav_search',
        'label'                 => esc_html__( 'Display Search Icon', 'setwood' ),
        'section'               => 'setwood_top_bar',
        'default'               => 1,
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'toggle',
        'settings'               => 'nav_cart',
        'label'                 => esc_html__( 'Display Cart Icon', 'setwood' ),
        'section'               => 'setwood_top_bar',
        'default'               => 1,
    ) );

/* Typography Section */

Setwood_Kirki::add_section( 'body_typo', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Body', 'setwood' ),
        'panel'                 => 'typo_settings'
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'        => 'typography',
    'settings'    => 'body_font',
    'label'       => esc_html__( 'Body', 'setwood' ),
    'section'     => 'body_typo',
    'default'     => array(
        'font-family'    => 'Lato',
        'variant'        => '400',
        'font-size'      => '1em',
        'letter-spacing' => '0',
        'subsets'        => array( 'latin-ext' ),
        'text-transform' => 'none',
        'text-align'     => 'left',
    ),
    'priority'    => 10,
    'output'      => array(
        array(
            'element' => 'body',
        ),
    ),
    'transport'   => 'auto',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'        => 'typography',
    'settings'    => 'body_font_italic',
    'label'       => esc_html__( 'Blockquote', 'setwood' ),
    'section'     => 'body_typo',
    'default'     => array(
        'font-family'    => 'Poppins',
        'variant'        => 'regular',
        'subsets'        => array( 'latin-ext' ),
        'text-transform' => 'none',
    ),
    'priority'    => 30,
    'output'      => array(
        array(
            'element' => 'blockquote',
        ),
    ),
    'transport'   => 'auto',
) );

Setwood_Kirki::add_section( 'title_typo', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Title & Headings', 'setwood' ),
        'panel'                 => 'typo_settings'
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'        => 'typography',
    'settings'    => 'title_font',
    'label'       => esc_html__( 'Blog Post / Page Title', 'setwood' ),
    'section'     => 'title_typo',
    'default'     => array(
        'font-family'    => 'Poppins',
        'variant'        => '600',
        'subsets'        => array( 'latin-ext' ),
        'text-transform' => 'none',
        'letter-spacing' => '-0.05em',
    ),
    'priority'    => 10,
    'output'      => array(
        array(
            'element' => '.entry-header .entry-title, .entry-title, .page-title, .archive-header .page-title',
        ),
    ),
    'transport'   => 'auto',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'        => 'typography',
    'settings'    => 'heading_font',
    'label'       => esc_html__( 'Headings (H1, H2, H3, H4, H5, H6)', 'setwood' ),
    'section'     => 'title_typo',
    'default'     => array(
        'font-family'    => 'Poppins',
        'variant'        => '600',
        'letter-spacing' => '-0.05em',
        'subsets'        => array( 'latin-ext' ),
        'text-transform' => 'none',
    ),
    'priority'    => 20,
    'output'      => array(
        array(
            'element' => '.entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4, .entry-content h5, .entry-content h6'
        ),
    ),
    'transport'         => 'auto',
) );

Setwood_Kirki::add_section( 'navbar_typo', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Navbar', 'setwood' ),
        'panel'                 => 'typo_settings'
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'        => 'typography',
    'settings'    => 'navbar_font',
    'label'       => esc_html__( 'Navbar', 'setwood' ),
    'section'     => 'navbar_typo',
    'default'     => array(
        'font-family'    => 'Poppins',
        'variant'        => '500',
        'letter-spacing' => '0',
        'subsets'        => array( 'latin-ext' ),
        'text-transform' => 'uppercase',
    ),
    'priority'    => 20,
    'output'      => array(
        array(
            'element' => '.main-navigation ul li a',
        ),
    ),
    'transport'         => 'auto',
) );

Setwood_Kirki::add_section( 'topsection_typo', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Top Section', 'setwood' ),
        'panel'                 => 'typo_settings'
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'        => 'typography',
    'settings'    => 'topsection_font',
    'label'       => esc_html__( 'Top Section', 'setwood' ),
    'section'     => 'topsection_typo',
    'default'     => array(
        'font-family'    => 'Poppins',
        'variant'        => '500',
        'letter-spacing' => '0',
        'subsets'        => array( 'latin-ext' ),
        'text-transform' => 'uppercase',
    ),
    'priority'    => 20,
    'output'      => array(
        array(
            'element' => '.site-header .header-top .socials ul > li a, .secondary-navigation .menu > li > a, .site-header .header-top .search-toggle, .site-header .header-top .site-header-cart a',
        ),
    ),
    'transport'         => 'auto',
) );

/* Featured Image Section */

Setwood_Kirki::add_section( 'setwood_fimg', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Featured Image', 'setwood' ),
        'panel'                 => 'general_settings'
    ) );

/*
Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'        => 'toggle',
        'settings'    => 'show_fimg',
        'label'       => esc_html__( 'Show Featured Image', 'setwood' ),
        'section'     => 'setwood_fimg',
        'default'     => 1,
    ) );
*/

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'        => 'image',
        'settings'    => 'default_fimg',
        'label'       => esc_html__( 'Default Featured Image', 'setwood' ),
        'description' => esc_html__( 'Upload an image to display it for posts which don\'t have featured image set', 'setwood' ),
        'section'     => 'setwood_fimg',
        'default'     => '',
    ) );

/* Featured Content options */

Setwood_Kirki::add_section( 'setwood_featured_content', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Featured Content', 'setwood' ),
        'description'           => esc_html__( 'These are setting for Featured area', 'setwood' ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'toggle',
        'settings'               => 'show_featured_content',
        'label'                 => esc_html__( 'Display Featured Content', 'setwood' ),
        'section'               => 'setwood_featured_content',
        'priority'              => 1,
        'default'               => 1,
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'select',
        'settings'               => 'featured_content_style',
        'label'                 => esc_html__( 'Select Featured content style', 'setwood' ),
        'section'               => 'setwood_featured_content',
        'priority'              => 2,
        'default'               => 'carousel',
        'choices'               => array(
            'carousel'          => esc_html__( 'Carousel', 'setwood' ),
            'boxed'             => esc_html__( 'Boxed', 'setwood' ),
            'full-width'        => esc_html__( 'Full Width', 'setwood' ),
            'grid-style-1'      => esc_html__( 'Grid Style 1', 'setwood' ),
        ),
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'         => 'color',
    'settings'     => 'featured_content_opacity',
    'label'        => esc_html__( 'Overlay', 'setwood' ),
    'section'      => 'setwood_featured_content',
    'alpha'        => true,
    'default'      => 'rgba(0,0,0,0.25)',
    'output'                => array(
            array(
                'element'                   => '.featured-content .slider-content',
                'property'                  => 'background-color',
            ),
        ),
    'transport'         => 'auto',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'switch',
    'settings'                  => 'slick_autoplay',
    'label'                     => esc_html__( 'Auto Play', 'setwood' ),
    'section'                   => 'setwood_featured_content',
    'default'                   => '1',
    'choices'     => array(
        'on'  => esc_attr__( 'True', 'setwood' ),
        'off' => esc_attr__( 'False', 'setwood' ),
    ),
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'text',
    'settings'                  => 'slick_autotime',
    'label'                     => esc_html__( 'Auto Play Speed', 'setwood' ),
    'section'                   => 'setwood_featured_content',
    'default'                   => '6000',
    'required'                  => array(
        array(
            'settings'       => 'slick_autoplay',
            'operator'      => '==',
            'value'         => 'true',
        ),
    ),
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'text',
    'settings'                  => 'slick_autospeed',
    'label'                     => esc_html__( 'Speed', 'setwood' ),
    'section'                   => 'setwood_featured_content',
    'default'                   => '600',
) );

/* Colors Section */
Setwood_Kirki::add_section( 'setwood_base_colors', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Base Colors', 'setwood' ),
        'description'           => esc_html__( 'Use these settings to manage colors.', 'setwood' ),
        'panel'                 => 'color_settings',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'color',
        'settings'              => 'site_background_color',
        'label'                 => esc_html__( 'Site Background color', 'setwood' ),
        'description'           => esc_html__( 'Background color if website layout is boxed', 'setwood' ),
        'default'               => apply_filters( 'setwood_site_background_color', '#e6e6e6' ),
        'section'               => 'setwood_base_colors',
        'priority'              => 101,
        'output'                => array(
            array(
                'element'   => 'body.boxed',
                'property'  => 'background-color',
            ),
        ),
        'transport'         => 'auto',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'color',
        'settings'              => 'base_background_color',
        'label'                 => esc_html__( 'Content Background color', 'setwood' ),
        'default'               => apply_filters( 'setwood_base_background_color', '#f5f5f5' ),
        'section'               => 'setwood_base_colors',
        'priority'              => 101,
        'output'                => array(
            array(
                'element'   => '.site-content',
                'property'  => 'background',
            ),
        ),
        'transport'         => 'auto',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'color',
        'settings'              => 'block_background_color',
        'label'                 => esc_html__( 'Block Background color', 'setwood' ),
        'default'               => apply_filters( 'setwood_block_background_color', '#ffffff' ),
        'section'               => 'setwood_base_colors',
        'priority'              => 101,
        'output'                => array(
            array(
                'element'   => '.hentry .entry-wrapper, .widget-area .widget, .archive-header, .author-bio, .site-main [class*="navigation"], .related-posts, #comments',
                'property'  => 'background-color',
            ),
            array(
                'element'   => '.woocommerce .card',
                'property'  => 'background-color',
            ),
        ),
        'transport'         => 'auto',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'color',
        'settings'              => 'base_text_color',
        'label'                 => esc_html__( 'Primary Text color', 'setwood' ),
        'default'               => apply_filters( 'setwood_base_text_color', '#767676' ),
        'description'           => esc_html__( 'This is the color for standard text', 'setwood' ),
        'section'               => 'setwood_base_colors',
        'priority'              => 101,
        'output'                => array(
            array(
                'element'   => 'body, .author-bio, button, input, textarea',
                'property'  => 'color',
            ),
        ),
        'transport'         => 'auto',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'color',
        'settings'              => 'base_accent_color',
        'label'                 => esc_html__( 'Accent', 'setwood' ),
        'description'           => esc_html__( 'Used for some special elements and rollovers', 'setwood' ),
        'default'               => apply_filters( 'setwood_base_accent_color', '#50aeb5' ),
        'section'               => 'setwood_base_colors',
        'priority'              => 101,
        'output'                => array(
            array(
                'element'   => '.base-accent-color, .top-section a:hover, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, a:hover, .main-navigation ul li a:hover, .main-navigation ul.menu ul li:hover > a, .secondary-navigation .menu ul li:hover > a, .secondary-navigation .menu a:hover, .cat-links a, .cat-links a:hover, .author-bio a:hover, .entry-meta-footer .social-share a:hover, .widget-area .widget a:hover, .widget_setwood_about_me h4, .tp_recent_tweets li a, .search-toggle span:hover, .featured-content .slider-content-info .meta a:hover, .dot-irecommendthis:hover, .dot-irecommendthis.active, .tags-links a:hover',
                'property'  => 'color',
            ),
            array(
                'element'   => '.star-rating span:before, .widget-area .widget a:hover, .product_list_widget a:hover, .quantity .plus, .quantity .minus, p.stars a:hover:after, p.stars a:after, .star-rating span:before',
                'property'  => 'color',
            ),
            array(
                'element'   => '.onsale, .widget_price_filter .ui-slider .ui-slider-range, .widget_price_filter .ui-slider .ui-slider-handle',
                'property'  => 'background-color',
            ),
            array(
                'element'   => 'button.cta:hover, button.alt:hover, input[type="button"].cta:hover, input[type="button"].alt:hover, input[type="reset"].cta:hover, input[type="reset"].alt:hover, input[type="submit"].cta:hover, input[type="submit"].alt:hover, .button.cta:hover, .button.alt:hover, .added_to_cart.cta:hover,     .added_to_cart.alt:hover, button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover, .woocommerce-pagination .page-numbers li .page-numbers.current, .loaded:hover .slick-prev:hover, .widget_setwood_socials .socials ul > li a:hover, .loaded:hover .slick-next:hover, .widget-area .widget a.button:hover, .pagination .page-numbers li .page-numbers.current, .slick-dots .slick-active button',
          'property'  => 'background-color',
            ),
            array(
                'element'   => 'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover, .block-title h3 span,  .woocommerce-pagination .page-numbers li .page-numbers.current, .pagination .page-numbers li .page-numbers.current, .cat-links a, .main-navigation .sub-menu li:first-child > a, .secondary-navigation .sub-menu li:first-child > a',
                'property'  => 'border-color',
            ),
            array(
                'element'   => '#order_review_heading, #order_review',
                'property'  => 'border-color',
            ),
        ),
        'transport'         => 'auto',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'color',
        'settings'              => 'base_meta_color',
        'label'                 => esc_html__( 'Secondary Text Color', 'setwood' ),
        'description'           => esc_html__( 'This color applies to meta elements and some labels...', 'setwood' ),
        'default'               => apply_filters( 'setwood_base_meta_color', '#b2b2b2' ),
        'section'               => 'setwood_base_colors',
        'priority'              => 101,
        'output'                => array(
            array( 
                'element' => '.meta, .meta a, .site-main [class*="navigation"] .meta-nav, span.sl-count, a.liked span.sl-count, .sl-count, .widget-area .widget .meta, .widget-area .widget .meta a', 
                'property' => 'color', ),
        ),
        'transport'         => 'auto',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'multicolor',
        'settings'              => 'base_link_color',
        'label'                 => esc_html__( 'Base Link color', 'setwood' ),
        'section'               => 'setwood_base_colors',
        'default'     => array(
        'link'    => apply_filters( 'setwood_base_link_color', '#1c1e1f' ),
        'hover'   => apply_filters( 'setwood_base_link_color_hover', '#50aeb5' ),
        ),

        'choices'   => array(
        'link'   => esc_html__( 'Link', 'setwood' ),
        'hover'  => esc_html__( 'Hover', 'setwood' ),
        ),

        'priority'  => 101,
          'output'    => array(
              array(
                'choice'   => 'link',
                'element'  => '.site-branding .site-title a, .author-bio a, .widget-area .widget a, .hentry .read-more a, .entry-content a',
                'property' => 'color',
              ),
              array(
                'choice'   => 'hover',
                'element'  => '.site-branding .site-title a:hover, .author-bio a:hover, .widget-area .widget a:hover, .hentry .read-more a:hover, .entry-content a:hover',
                'property' => 'color',
              ),
          ),
          'transport' => 'auto',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'color',
        'settings'              => 'base_heading_color',
        'label'                 => esc_html__( 'Heading (Title) color', 'setwood' ),
        'description'           => esc_html__( 'This color applies to headings...', 'setwood' ),
        'default'               => apply_filters( 'setwood_base_heading_color', '#1c1e1f' ),
        'section'               => 'setwood_base_colors',
        'priority'              => 101,
        'output'                => array(
            array(
                'element'   => 'h1, h2, h3, h4, h5, h6',
                'property'  => 'color',
            ),
        ),
        'transport'         => 'auto',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'color',
        'settings'              => 'base_border_color',
        'label'                 => esc_html__( 'Base Border Color', 'setwood' ),
        'default'               => apply_filters( 'setwood_base_border_color', '#efefef' ),
        'section'               => 'setwood_base_colors',
        'priority'              => 101,
        'output'                => array(
            array( 
                'element' => '.entry-meta-footer, .widget .widget-title, .widget_recent_entries ul li, .widget_pages ul li, .widget_categories ul li, .widget_archive ul li, .widget_recent_comments ul li, .widget_nav_menu ul li, .widget_links ul li, .post-navigation, .posts-navigation, .post-navigation:after, .posts-navigation:after, .block-title, .meta > .meta-data:after, .tags-links a, .tags-clouds a', 
                'property' => 'border-color', ),
        ),
        'transport'         => 'auto',
    ) );

/* Button Colors Section */

Setwood_Kirki::add_section( 'setwood_button_colors', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Button Colors', 'setwood' ),
        'description'           => esc_html__( 'Use these settings to manage button colors.', 'setwood' ),
        'panel'                 => 'color_settings',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'multicolor',
        'settings'              => 'base_button_text_color',
        'label'                 => esc_html__( 'Button Text Color', 'setwood' ),
        'section'               => 'setwood_button_colors',
        'priority'              => 101,
        'default'     => array(
        'link'    => apply_filters( 'setwood_base_button_text_color_link', '#434343' ),
        'hover'   => apply_filters( 'setwood_base_button_text_color_hover', '#ffffff' ),
        ),

        'choices'   => array(
        'link'   => esc_html__( 'Color', 'setwood' ),
        'hover'  => esc_html__( 'Hover', 'setwood' ),
        ),

        'transport' => 'auto',
          'output'    => array(
              array(
                'choice'   => 'link',
                'element'  => 'button, input[type="button"], input[type="reset"], input[type="submit"], .button, .added_to_cart',
                'property' => 'color',
              ),
              array(
                'choice'   => 'hover',
                'element'  => 'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover',
                'property' => 'color',
              ),
          ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'multicolor',
        'settings'              => 'base_button_background_color',
        'label'                 => esc_html__( 'Button Background Color', 'setwood' ),
        'section'               => 'setwood_button_colors',
        'priority'              => 101,
        'default'     => array(
        'link'    => apply_filters( 'setwood_base_button_background_color_link', '#ffffff' ),
        'hover'   => apply_filters( 'setwood_base_button_background_color_hover', '#50aeb5' ),
        ),

        'choices'   => array(
        'link'   => esc_html__( 'Color', 'setwood' ),
        'hover'  => esc_html__( 'Hover', 'setwood' ),
        ),

        'transport' => 'auto',
          'output'    => array(
              array(
                'choice'   => 'link',
                'element'  => 'button, input[type="button"], input[type="reset"], input[type="submit"], .button, .added_to_cart',
                'property' => 'background-color',
              ),
              array(
                'choice'   => 'hover',
                'element'  => 'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover',
                'property' => 'background-color',
              ),
          ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'multicolor',
        'settings'              => 'base_button_border_color',
        'label'                 => esc_html__( 'Button Border Color', 'setwood' ),
        'section'               => 'setwood_button_colors',
        'priority'              => 101,
        'default'     => array(
        'link'    => apply_filters( 'setwood_base_button_border_color_link', '#efefef' ),
        'hover'   => apply_filters( 'setwood_base_button_border_color_hover', '#50aeb5' ),
        ),

        'choices'   => array(
        'link'   => esc_html__( 'Color', 'setwood' ),
        'hover'  => esc_html__( 'Hover', 'setwood' ),
        ),

        'transport' => 'auto',
          'output'    => array(
              array(
                'choice'   => 'link',
                'element'  => 'button, input[type="button"], input[type="reset"], input[type="submit"], .button, .added_to_cart',
                'property' => 'border-color',
              ),
              array(
                'choice'   => 'hover',
                'element'  => 'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover',
                'property' => 'border-color',
              ),
          ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'multicolor',
        'settings'              => 'base_button_alt_text_color',
        'label'                 => esc_html__( 'Button CTA Text Color', 'setwood' ),
        'section'               => 'setwood_button_colors',
        'priority'              => 101,
        'default'     => array(
        'link'    => apply_filters( 'setwood_base_button_alt_text_color_link', '#ffffff' ),
        'hover'   => apply_filters( 'setwood_base_button_alt_text_color_hover', '#ffffff' ),
        ),

        'choices'   => array(
        'link'   => esc_html__( 'Color', 'setwood' ),
        'hover'  => esc_html__( 'Hover', 'setwood' ),
        ),

        'transport' => 'auto',
          'output'    => array(
              array(
                'choice'   => 'link',
                'element'  => 'button.cta, button.alt, input[type="button"].cta, input[type="button"].alt, input[type="reset"].cta, input[type="reset"].alt, input[type="submit"].cta, input[type="submit"].alt, .button.cta, .button.alt, .added_to_cart.cta, .added_to_cart.alt, .widget_setwood_socials .socials ul > li a',
                'property' => 'background-color',
              ),
              array(
                'choice'   => 'hover',
                'element'  => 'button.cta:hover, button.alt:hover, input[type="button"].cta:hover, input[type="button"].alt:hover, input[type="reset"].cta:hover, input[type="reset"].alt:hover, input[type="submit"].cta:hover, input[type="submit"].alt:hover, .button.cta:hover, .button.alt:hover, .added_to_cart.cta:hover, .added_to_cart.alt:hover, button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover, .woocommerce-pagination .page-numbers li .page-numbers.current, .loaded:hover .slick-prev:hover, .widget_setwood_socials .socials ul > li a:hover, .loaded:hover .slick-next:hover, .widget-area .widget a.button:hover, .pagination .page-numbers li .page-numbers.current, .slick-dots .slick-active button',
                'property' => 'background-color',
              ),
          ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'multicolor',
        'settings'              => 'base_button_alt_background_color',
        'label'                 => esc_html__( 'Button CTA Background Color', 'setwood' ),
        'section'               => 'setwood_button_colors',
        'priority'              => 101,
        'default'     => array(
        'link'    => apply_filters( 'setwood_base_button_alt_background_color_link', '#434343' ),
        'hover'   => apply_filters( 'setwood_base_button_alt_background_color_hover', '#50aeb5' ),
        ),

        'choices'   => array(
        'link'   => esc_html__( 'Color', 'setwood' ),
        'hover'  => esc_html__( 'Hover', 'setwood' ),
        ),

        'transport' => 'auto',
          'output'    => array(
              array(
                'choice'   => 'link',
                'element'  => 'button.cta, button.alt, input[type="button"].cta, input[type="button"].alt, input[type="reset"].cta, input[type="reset"].alt, input[type="submit"].cta, input[type="submit"].alt, .button.cta, .button.alt, .added_to_cart.cta, .added_to_cart.alt, .widget_setwood_socials .socials ul > li a',
                'property' => 'background-color',
              ),
              array(
                'choice'   => 'hover',
                'element'  => 'button.cta:hover, button.alt:hover, input[type="button"].cta:hover, input[type="button"].alt:hover, input[type="reset"].cta:hover, input[type="reset"].alt:hover, input[type="submit"].cta:hover, input[type="submit"].alt:hover, .button.cta:hover, .button.alt:hover, .added_to_cart.cta:hover, .added_to_cart.alt:hover, button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover, .woocommerce-pagination .page-numbers li .page-numbers.current, .loaded:hover .slick-prev:hover, .widget_setwood_socials .socials ul > li a:hover, .loaded:hover .slick-next:hover, .widget-area .widget a.button:hover, .pagination .page-numbers li .page-numbers.current, .slick-dots .slick-active button',
                'property' => 'background-color',
              ),
          ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'multicolor',
        'settings'              => 'base_button_alt_border_color',
        'label'                 => esc_html__( 'Button CTA Border Color', 'setwood' ),
        'section'               => 'setwood_button_colors',
        'priority'              => 101,
        'default'     => array(
        'link'    => apply_filters( 'setwood_base_button_alt_border_color_link', '#434343' ),
        'hover'   => apply_filters( 'setwood_base_button_alt_border_color_hover', '#50aeb5' ),
        ),

        'choices'   => array(
        'link'   => esc_html__( 'Color', 'setwood' ),
        'hover'  => esc_html__( 'Hover', 'setwood' ),
        ),

        'transport' => 'auto',
          'output'    => array(
              array(
                'choice'   => 'link',
                'element'  => 'button.cta, button.alt, input[type="button"].cta, input[type="button"].alt, input[type="reset"].cta, input[type="reset"].alt, input[type="submit"].cta, input[type="submit"].alt, .button.cta, .button.alt, .added_to_cart.cta, .added_to_cart.alt, .widget_setwood_socials .socials ul > li a',
                'property' => 'border-color',
              ),
              array(
                'choice'   => 'hover',
                'element'  => 'button.cta:hover, button.alt:hover, input[type="button"].cta:hover, input[type="button"].alt:hover, input[type="reset"].cta:hover, input[type="reset"].alt:hover, input[type="submit"].cta:hover, input[type="submit"].alt:hover, .button.cta:hover, .button.alt:hover, .added_to_cart.cta:hover, .added_to_cart.alt:hover, button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover, .woocommerce-pagination .page-numbers li .page-numbers.current, .loaded:hover .slick-prev:hover, .widget_setwood_socials .socials ul > li a:hover, .loaded:hover .slick-next:hover, .widget-area .widget a.button:hover, .pagination .page-numbers li .page-numbers.current, .slick-dots .slick-active button',
                'property' => 'border-color',
              ),
          ),
    ) );


/* Header Colors Section */

Setwood_Kirki::add_section( 'setwood_header_colors', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Header Colors', 'setwood' ),
        'description'           => esc_html__( 'Use these settings to manage header colors.', 'setwood' ),
        'panel'                 => 'color_settings',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'color',
        'settings'              => 'header_background_color',
        'label'                 => esc_html__( 'Header Background Color', 'setwood' ),
        'section'               => 'setwood_header_colors',
        'default'               => apply_filters( 'setwood_header_background_color', '#ffffff' ),
        'priority'              => 1,
        'output'                => array(
            array(
                'element'   => '.site-header',
                'property'  => 'background-color',
            ),
        ),
        'transport'         => 'auto',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'color',
        'settings'              => 'header_text_color',
        'label'                 => esc_html__( 'Header Text Color', 'setwood' ),
        'section'               => 'setwood_header_colors',
        'default'               => apply_filters( 'setwood_header_text_color', '#767676' ),
        'priority'              => 2,
        'output'                => array(
            array(
                'element'   => '.site-header',
                'property'  => 'color',
            ),
        ),
        'transport'         => 'auto',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'color',
        'settings'              => 'header_accent_color',
        'label'                 => esc_html__( 'Header Accent Color', 'setwood' ),
        'section'               => 'setwood_header_colors',
        'default'               => apply_filters( 'setwood_header_accent_color', '#50aeb5' ),
        'priority'              => 3,
        'output'                => array(
            array(
                'element'   => '.site-branding .site-title a',
                'property'  => 'color',
            ),
        ),
        'transport'         => 'auto',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'multicolor',
        'settings'              => 'header_menu_color',
        'label'                 => esc_html__( 'Link Color', 'setwood' ),
        'description'           => '',
        'section'               => 'setwood_header_colors',
        'default'     => array(
        'link'    => apply_filters( 'setwood_header_menu_color_link', '#767676' ),
        'hover'   => apply_filters( 'setwood_header_menu_color_hover', '#50aeb5' ),
        ),

        'choices'   => array(
        'link'   => esc_html__( 'Link', 'setwood' ),
        'hover'  => esc_html__( 'Hover', 'setwood' ),
        ),

        'priority'  => 101,
          'output'    => array(
              array(
                'choice'   => 'link',
                'element'  => '.site-header .header-middle a',
                'property' => 'color',
              ),
              array(
                'choice'   => 'hover',
                'element'  => '.site-header .header-middle a:hover',
                'property' => 'color',
              ),
          ),
          'transport' => 'auto',
    ) );

/* Top Section Colors*/

Setwood_Kirki::add_section( 'setwood_top_bar_colors', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Top Section Colors', 'setwood' ),
        'description'           => esc_html__( 'Use these settings to manage Top section Colors.', 'setwood' ),
        'panel'                 => 'color_settings'
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'color',
        'settings'              => 'top_section_background_color',
        'label'                 => esc_html__( 'Background', 'setwood' ),
        'section'               => 'setwood_top_bar_colors',
        'default'               => apply_filters( 'setwood_top_section_background_color', '#f5f5f5' ),
        'priority'              => 101,
        'output'                => array(
            array(
                'element'                   => '.site-header .header-top',
                'property'                  => 'background-color',
            ),
        ),
        'transport'         => 'auto',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'multicolor',
        'settings'              => 'top_section_menu_color',
        'label'                 => esc_html__( 'Link Color', 'setwood' ),
        'description'           => '',
        'section'               => 'setwood_top_bar_colors',
        'default'     => array(
        'link'    => apply_filters( 'setwood_top_section_menu_color_link', '#767676' ),
        'hover'   => apply_filters( 'setwood_top_section_menu_color_hover', '#50aeb5' ),
        ),

        'choices'   => array(
        'link'   => esc_html__( 'Link', 'setwood' ),
        'hover'  => esc_html__( 'Hover', 'setwood' ),
        ),

        'priority'  => 101,
          'output'    => array(
              array(
                'choice'   => 'link',
                'element'  => '.site-header .header-top a, .secondary-navigation .menu a, .site-header .header-top .search-toggle',
                'property' => 'color',
              ),
              array(
                'choice'   => 'hover',
                'element'  => '.site-header .header-top a:hover, .secondary-navigation .menu ul a:hover, .secondary-navigation .menu a:hover, .site-header .header-top .search-toggle:hover',
                'property' => 'color',
              ),
          ),
          'transport' => 'auto',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'color',
        'settings'              => 'top_section_text_color',
        'label'                 => esc_html__( 'Text Color', 'setwood' ),
        'section'               => 'setwood_top_bar_colors',
        'default'               => apply_filters( 'setwood_top_section_text_color', '#767676' ),
        'priority'              => 101,
        'output'                => array(
            array(
                'element'   => '.site-header .header-top',
                'property'  => 'color',
            ),
        ),
        'transport'         => 'auto',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'color',
        'settings'              => 'top_section_border_color',
        'label'                 => esc_html__( 'Border Color', 'setwood' ),
        'section'               => 'setwood_top_bar_colors',
        'default'               => apply_filters( 'setwood_top_section_border_color', '#efefef' ),
        'priority'              => 101,
        'output'                => array(
            array(
                'element'   => '.site-header .header-top',
                'property'  => 'border-color',
            ),
        ),
        'transport'         => 'auto',
    ) );

/* Navbar Colors */

Setwood_Kirki::add_section( 'setwood_primary_menu_colors', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Navbar Colors', 'setwood' ),
        'description'           => esc_html__( 'Use these settings to manage navigation colors.', 'setwood' ),
        'panel'                 => 'color_settings'
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'color',
        'settings'              => 'primary_menu_background_color',
        'label'                 => esc_html__( 'Background Color', 'setwood' ),
        'section'               => 'setwood_primary_menu_colors',
        'default'               => apply_filters( 'setwood_primary_menu_background_color', '#ffffff' ),
        'priority'              => 101,
        'output'                => array(
            array(
                'element'   => '.navbar, .navbar .main-navigation .sub-menu, .navbar .main-navigation .children',
                'property'  => 'background-color',
            ),
        ),
        'transport'         => 'auto',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'multicolor',
        'settings'              => 'primary_menu_color',
        'label'                 => esc_html__( 'Link Color', 'setwood' ),
        'section'               => 'setwood_primary_menu_colors',
        'priority'              => 101,
        'default'     => array(
        'link'    => apply_filters( 'setwood_primary_menu_color_link', '#434343' ),
        'hover'   => apply_filters( 'setwood_primary_menu_color_hover', '#50aeb5' ),
        ),

        'choices'   => array(
        'link'   => esc_html__( 'Link', 'setwood' ),
        'hover'  => esc_html__( 'Hover', 'setwood' ),
        ),
        'output'                => array(
            array(
                'choice'   => 'link',
                'element'   => '.navbar .main-navigation ul li a, .navbar .main-navigation ul.menu ul li a',
                'property'  => 'color',
            ),
            array(
                'choice'   => 'hover',
                'element'   => '.navbar .main-navigation ul li a:hover, .navbar .main-navigation ul.menu ul li a:hover',
                'property'  => 'color',
            ),
        ),
        'transport'         => 'auto',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'color',
        'settings'              => 'primary_menu_border_color',
        'label'                 => esc_html__( 'Border Color', 'setwood' ),
        'section'               => 'setwood_primary_menu_colors',
        'default'               => apply_filters( 'setwood_primary_menu_border_color', '#efefef' ),
        'priority'              => 101,
        'output'                => array(
            array(
                'element'   => '.navbar, .main-navigation ul.menu ul li a',
                'property'  => 'border-color',
            ),
        ),
        'transport'         => 'auto',
    ) );

/* Footer Widget Colors Section */

Setwood_Kirki::add_section( 'setwood_footer_widget_colors', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Footer Widget Colors', 'setwood' ),
        'description'           => esc_html__( 'Use these settings to manage Footer Widget colors.', 'setwood' ),
        'panel'                 => 'color_settings',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'color',
    'settings'                  => 'footer_widget_background_color',
    'label'                     => esc_html__( 'Widget Background Color', 'setwood' ),
    'section'                   => 'setwood_footer_widget_colors',
    'default'               => apply_filters( 'setwood_footer_widget_background_color', '#ffffff' ),
    'output'                            => array(
        array(
            'element'   => '.site-footer .footer-widgets',
            'property'  => 'background-color',
        ),
    ),
    'transport'         => 'auto',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'color',
    'settings'                  => 'footer_widget_heading_color',
    'label'                     => esc_html__( 'Widget Heading Color', 'setwood' ),
    'section'                   => 'setwood_footer_widget_colors',
    'default'                   => apply_filters( 'setwood_footer_widget_heading_color', '#1c1e1f' ),
    'output'                            => array(
        array(
            'element'   => '.site-footer .footer-widgets .widget-title h1, .site-footer .footer-widgets .widget-title h2, .site-footer .footer-widgets .widget-title h3',
            'property'  => 'color',
        ),
    ),
    'transport'         => 'auto',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'color',
    'settings'                  => 'footer_widget_border_color',
    'label'                     => esc_html__( 'Widget Base Border Color', 'setwood' ),
    'section'                   => 'setwood_footer_widget_colors',
    'default'                   => apply_filters( 'setwood_footer_widget_border_color', '#efefef' ),
    'output'                    => array(
        array(
            'element'   => '.footer-widgets .widget-title, .footer-widgets .tagcloud a',
            'property'  => 'border-color',
        ),
    ),
    'transport'         => 'auto',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'color',
    'settings'                  => 'footer_widget_text_color',
    'label'                     => esc_html__( 'Widget Text Color', 'setwood' ),
    'section'                   => 'setwood_footer_widget_colors',
    'default'                   => apply_filters( 'setwood_footer_widget_text_color', '#767676' ),
    'output'                    => array(
        array(
            'element'           => '.site-footer .footer-widgets, .site-footer .footer-widgets .meta a',
            'property'          => 'color',
        ),
    ),
    'transport'                 => 'auto',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'color',
    'settings'                  => 'footer_widget_link_color',
    'label'                     => esc_html__( 'Widget Link Color', 'setwood' ),
    'section'                   => 'setwood_footer_widget_colors',
    'default'                   => apply_filters( 'setwood_footer_widget_link_color', '#1c1e1f' ),
    'output'                    => array(
        array(
            'element'   => '.site-footer .footer-widgets a:not(.button)',
            'property'  => 'color',
        ),
    ),
    'transport'         => 'auto',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'color',
    'settings'                  => 'footer_widget_accent_color',
    'label'                     => esc_html__( 'Widget Accent Color', 'setwood' ),
    'section'                   => 'setwood_footer_widget_colors',
    'default'                   => apply_filters( 'setwood_footer_widget_accent_color', '#50aeb5' ),
    'output'                    => array(
        array(
            'element'   => '.footer-widgets a:hover, .footer-widgets .tagcloud a:hover, .footer-widgets .slick-dots .slick-active button',
            'property'  => 'color',
        ),

        array(
            'element'   => '.footer-widgets .slick-dots .slick-active button',
            'property'  => 'background-color',
        ),
    ),
    'transport'         => 'auto',
) );

/* Footer Colors Section */

Setwood_Kirki::add_section( 'setwood_footer_colors', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Footer Colors', 'setwood' ),
        'description'           => esc_html__( 'Use these settings to manage Footer colors.', 'setwood' ),
        'panel'                 => 'color_settings',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'color',
    'settings'                  => 'footer_background_color',
    'label'                     => esc_html__( 'Footer Background Color', 'setwood' ),
    'section'                   => 'setwood_footer_colors',
    'default'                   => apply_filters( 'setwood_footer_background_color', '#f5f5f5' ),
    'output'                    => array(
        array(
            'element'   => '.site-footer .site-info',
            'property'  => 'background-color',
        ),
    ),
    'transport'         => 'auto',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'color',
    'settings'                  => 'footer_text_color',
    'label'                     => esc_html__( 'Footer Text Color', 'setwood' ),
    'section'                   => 'setwood_footer_colors',
    'default'                   => apply_filters( 'setwood_footer_text_color', '#767676' ),
    'output'                    => array(
        array(
            'element'   => '.site-info',
            'property'  => 'color',
        ),
    ),
    'transport'         => 'auto',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'color',
    'settings'                  => 'footer_link_color',
    'label'                     => esc_html__( 'Footer Link Color', 'setwood' ),
    'section'                   => 'setwood_footer_colors',
    'default'                   => apply_filters( 'setwood_footer_link_color', '#1c1e1f' ),
    'output'                    => array(
        array(
            'element'   => '.site-footer .site-info a:not(.button)',
            'property'  => 'color',
        ),
    ),
    'transport'         => 'auto',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'color',
    'settings'                  => 'footer_social_background_color',
    'label'                     => esc_html__( 'Footer Social Background Color', 'setwood' ),
    'section'                   => 'setwood_footer_colors',
    'default'                   => apply_filters( 'setwood_footer_social_background_color', '#ffffff' ),
    'output'                    => array(
        array(
            'element'   => '.site-footer .socials',
            'property'  => 'background-color',
        ),
    ),
    'transport'         => 'auto',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'color',
    'settings'                  => 'footer_social_border_color',
    'label'                     => esc_html__( 'Footer Social Border Color', 'setwood' ),
    'section'                   => 'setwood_footer_colors',
    'default'                   => apply_filters( 'footer_social_border_color', '#ffffff' ),
    'output'                    => array(
        array(
            'element'   => '.site-footer .socials',
            'property'  => 'border-color',
        ),
    ),
    'transport'         => 'auto',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'multicolor',
    'settings'                  => 'footer_social_link_color',
    'label'                     => esc_html__( 'Footer Social Link Color', 'setwood' ),
    'section'                   => 'setwood_footer_colors',
    'default'     => array(
        'link'    => apply_filters( 'setwood_footer_social_link_color', '#434343' ),
        'hover'   => apply_filters( 'setwood_footer_social_link_color_hover', '#50aeb5' ),
        ),

        'choices'   => array(
        'link'      => esc_html__( 'Link', 'setwood' ),
        'hover'     => esc_html__( 'Hover', 'setwood' ),
        ),

        'output'    => array(
            array(
                'choice'   => 'link',
                'element'   => '.site-footer .socials ul a',
                'property'  => 'color',
            ),
            array(
                'choice'   => 'hover',
                'element'   => '.site-footer .socials ul a:hover',
                'property'  => 'color',
            ),
        ),
    'transport'         => 'auto',
) );

/* Site Layout Section*/

Setwood_Kirki::add_section( 'setwood_layout', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Site Layout', 'setwood' ),
        'description'           => esc_html__( 'Switch between Boxed or Full Width Layout',  'setwood' ),
        'panel'                 => 'general_settings',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'radio',
        'settings'              => 'site_layout',
        'label'                 => esc_html__( 'Site Layout', 'setwood' ),
        'section'               => 'setwood_layout',
        'default'               => 'full-width',
        'choices'               => array(
            'full-width'           => esc_html__( 'Full Width', 'setwood' ),
            'boxed'                => esc_html__( 'Boxed', 'setwood' ),
        ),
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'textarea',
    'settings'                  => 'footer_text',
    'label'                     => esc_html__( 'Footer Text', 'setwood' ),
    'section'                   => 'setwood_footer',
    'description'               => esc_html__( 'Copyright text in the footer.',  'setwood' ),
    'default'                   => esc_html__( 'Setwood. All Right Reserved. by Macrodreams',  'setwood' ),
    'sanitize_callback'         => 'balanceTags',
) );

/* Footer Section*/

Setwood_Kirki::add_section( 'setwood_footer', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Footer', 'setwood' ),
        'description'           => esc_html__( 'Customise the look & feel of your web site footer.',  'setwood' ),
        'panel'                 => 'general_settings',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'toggle',
        'settings'               => 'show_footer_social',
        'label'                 => esc_html__( 'Display Social Icons', 'setwood' ),
        'section'               => 'setwood_footer',
        'default'               => 1,
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'textarea',
    'settings'                  => 'footer_text',
    'label'                     => esc_html__( 'Footer Text', 'setwood' ),
    'section'                   => 'setwood_footer',
    'description'               => esc_html__( 'Copyright text in the footer.',  'setwood' ),
    'default'                   => esc_html__( 'Setwood. All Right Reserved. by Macrodreams',  'setwood' ),
    'sanitize_callback'         => 'balanceTags',
) );

/* Layout Settings Panel */

/* Home Section */

Setwood_Kirki::add_section( 'setwood_home', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Home', 'setwood' ),
        'description'           => esc_html__( 'These are general settings for home', 'setwood' ),
        'panel'                 => 'layout_settings'
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'radio-image',
        'settings'               => 'layout_home',
        'label'                 => esc_html__( 'Home layout', 'setwood' ),
        'section'               => 'setwood_home',
        'default'               => 'right-sidebar',
        'choices'               => array(
            'left-sidebar'           => get_template_directory_uri() . '/assets/images/admin/sidebar-left.png',
            'right-sidebar'          => get_template_directory_uri() . '/assets/images/admin/sidebar-right.png',
            'no-sidebar-full-width'  => get_template_directory_uri() . '/assets/images/admin/full-width.png',
        ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'radio-image',
        'settings'               => 'home_post_layout',
        'label'                 => esc_html__( 'Post layout', 'setwood' ),
        'section'               => 'setwood_home',
        'default'               => 'grid',
        'choices'               => array(
            'standard' => get_template_directory_uri() . '/assets/images/admin/standard.png',
            'grid'        => get_template_directory_uri() . '/assets/images/admin/grid.png',
            'list'        => get_template_directory_uri() . '/assets/images/admin/list.png',
        ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'radio-image',
        'settings'               => 'home_grid_column',
        'label'                 => esc_html__( 'Grid Column', 'setwood' ),
        'description'           => esc_html__( 'Specify your Grid Column (number of Columns)', 'setwood' ),
        'section'               => 'setwood_home',
        'default'               => 'col-2',
        'choices'               => array(
            'col-2'             => get_template_directory_uri() . '/assets/images/admin/grid-col-2.png',
            'col-3'             => get_template_directory_uri() . '/assets/images/admin/grid-col-3.png',
        ),
        'required'              => array(
            array(
                'settings'       => 'home_post_layout',
                'operator'      => '==',
                'value'         => 'grid',
            ),
        ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'        => 'toggle',
        'settings'    => 'home_first_full',
        'label'       => esc_html__( 'First Post Standard', 'setwood' ),
        'section'     => 'setwood_home',
        'default'     => 1,
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'radio',
        'settings'               => 'home_pagination',
        'label'                 => esc_html__( 'Pagination', 'setwood' ),
        'section'               => 'setwood_home',
        'default'               => 'numeric',
        'choices'               => array(
            'numeric'           => esc_html__( 'Numeric', 'setwood' ),
            'classic'           => esc_html__( 'Classic (prev/next)', 'setwood' ),
        ),
    ) );

/* Archive Section */

Setwood_Kirki::add_section( 'setwood_archive', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Archive', 'setwood' ),
        'description'           => esc_html__( 'These are general settings for archive', 'setwood' ),
        'panel'                 => 'layout_settings'
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'radio-image',
        'settings'               => 'layout_archive',
        'label'                 => esc_html__( 'Archive layout', 'setwood' ),
        'section'               => 'setwood_archive',
        'default'               => 'right-sidebar',
        'choices'               => array(
            'left-sidebar'           => get_template_directory_uri() . '/assets/images/admin/sidebar-left.png',
            'right-sidebar'          => get_template_directory_uri() . '/assets/images/admin/sidebar-right.png',
            'no-sidebar-full-width'  => get_template_directory_uri() . '/assets/images/admin/full-width.png',
        ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'radio-image',
        'settings'               => 'archive_post_layout',
        'label'                 => esc_html__( 'Post layout', 'setwood' ),
        'section'               => 'setwood_archive',
        'default'               => 'grid',
        'choices'               => array(
            'standard' => get_template_directory_uri() . '/assets/images/admin/standard.png',
            'grid'        => get_template_directory_uri() . '/assets/images/admin/grid.png',
            'list'        => get_template_directory_uri() . '/assets/images/admin/list.png',
        ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'radio-image',
        'settings'               => 'archive_grid_column',
        'label'                 => esc_html__( 'Grid Column', 'setwood' ),
        'description'           => esc_html__( 'Specify your Grid Column (number of Columns)', 'setwood' ),
        'section'               => 'setwood_archive',
        'default'               => 'col-2',
        'choices'               => array(
            'col-2'             => get_template_directory_uri() . '/assets/images/admin/grid-col-2.png',
            'col-3'             => get_template_directory_uri() . '/assets/images/admin/grid-col-3.png',
        ),
        'required'              => array(
            array(
                'settings'       => 'archive_post_layout',
                'operator'      => '==',
                'value'         => 'grid',
            ),
        ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'        => 'toggle',
        'settings'    => 'archive_first_full',
        'label'       => esc_html__( 'First Post Standard', 'setwood' ),
        'section'     => 'setwood_archive',
        'default'     => 1,
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'radio',
        'settings'               => 'archive_pagination',
        'label'                 => esc_html__( 'Pagination', 'setwood' ),
        'section'               => 'setwood_archive',
        'default'               => 'numeric',
        'choices'               => array(
            'numeric'           => esc_html__( 'Numeric', 'setwood' ),
            'classic'           => esc_html__( 'Classic (prev/next)', 'setwood' ),
        ),
    ) );

/* Single Post Section */

Setwood_Kirki::add_section( 'setwood_single', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Single', 'setwood' ),
        'description'           => esc_html__( 'These are settings which are applied to your single post template', 'setwood' ),
        'panel'                 => 'layout_settings'
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'radio-image',
        'settings'               => 'layout_single',
        'label'                 => esc_html__( 'Single posts layout', 'setwood' ),
        'section'               => 'setwood_single',
        'default'               => 'right-sidebar',
        'choices'               => array(
            'left-sidebar'           => get_template_directory_uri() . '/assets/images/admin/sidebar-left.png',
            'right-sidebar'          => get_template_directory_uri() . '/assets/images/admin/sidebar-right.png',
            'no-sidebar-full-width'  => get_template_directory_uri() . '/assets/images/admin/full-width.png',
        ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'checkbox',
        'settings'               => 'single_show_cat',
        'label'                 => esc_html__( 'Display category above title', 'setwood' ),
        'section'               => 'setwood_single',
        'default'               => 1,
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'checkbox',
        'settings'               => 'single_show_tags',
        'label'                 => esc_html__( 'Display tags', 'setwood' ),
        'section'               => 'setwood_single',
        'default'               => 1,
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'checkbox',
        'settings'               => 'single_show_prev_next',
        'label'                 => esc_html__( 'Display previous/next post links', 'setwood' ),
        'section'               => 'setwood_single',
        'default'               => 1,
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'checkbox',
        'settings'               => 'prev_next_cat',
        'label'                 => esc_html__( 'Previous/next links to posts from same category?', 'setwood' ),
        'section'               => 'setwood_single',
        'default'               => 1,
        'required'              => array(
            array(
                'settings'       => 'single_show_prev_next',
                'operator'      => '==',
                'value'         => 1,
            ),
        ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'checkbox',
        'settings'               => 'single_show_share',
        'label'                 => esc_html__( 'Display Social Share', 'setwood' ),
        'section'               => 'setwood_single',
        'default'               => 1,
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'checkbox',
        'settings'               => 'single_show_author',
        'label'                 => esc_html__( 'Display author info', 'setwood' ),
        'section'               => 'setwood_single',
        'default'               => 1,
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'checkbox',
        'settings'               => 'single_show_related_post',
        'label'                 => esc_html__( 'Display Related Posts', 'setwood' ),
        'section'               => 'setwood_single',
        'default'               => 1,
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'radio',
        'settings'               => 'related_post',
        'label'                 => esc_html__( 'Category or Tags', 'setwood' ),
        'section'               => 'setwood_single',
        'default'               => 'category',
        'choices'               => array(
            'category'          => esc_html__( 'Category', 'setwood' ),
            'tags'              => esc_html__( 'Tags', 'setwood' ),
        ),
        'required'              => array(
            array(
                'settings'       => 'single_show_related_post',
                'operator'      => '==',
                'value'         => 1,
            ),
        ),
    ) );

/* Standard Post Section */

Setwood_Kirki::add_section( 'setwood_standard', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Standard Layout', 'setwood' ),
        'description'           => esc_html__( 'Use these settings to manage meta options content header.', 'setwood' ),
        'panel'                 => 'layout_settings',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'checkbox',
        'settings'               => 'standard_show_cat',
        'label'                 => esc_html__( 'Display category', 'setwood' ),
        'section'               => 'setwood_standard',
        'default'               => 1,
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'radio',
        'settings'               => 'standard_content_type',
        'label'                 => esc_html__( 'Content limit type', 'setwood' ),
        'section'               => 'setwood_standard',
        'default'               => 'excerpt',
        'choices'               => array(
            'content'           => esc_html__( 'Manual (using <!--more--> tag)', 'setwood' ),
            'excerpt'           => esc_html__( 'Automatic (excerpt)', 'setwood' ),
        ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'text',
        'settings'               => 'standard_excerpt_length',
        'label'                 => esc_html__( 'Excerpt length', 'setwood' ),
        'description'           => esc_html__( 'Specify your excerpt length (number of characters)', 'setwood' ),
        'section'               => 'setwood_standard',
        'default'               => 24,
        'required'              => array(
            array(
                'settings'       => 'standard_content_type',
                'operator'      => '==',
                'value'         => 'excerpt',
            ),
        ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'text',
        'settings'               => 'standard_excerpt_more',
        'label'                 => esc_html__( 'Excerpt "more" string', 'setwood' ),
        'description'           => esc_html__( 'Specify more string to append after excerpts', 'setwood' ),
        'section'               => 'setwood_standard',
        'default'               => '...',
        'required'              => array(
            array(
                'settings'       => 'standard_content_type',
                'operator'      => '==',
                'value'         => 'excerpt',
            ),
        ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'toggle',
        'settings'               => 'standard_show_readmore_link',
        'label'                 => esc_html__( 'Display Readmore Link', 'setwood' ),
        'section'               => 'setwood_standard',
        'default'               => 1,
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'sortable',
        'settings'               => 'lay_standard_meta',
        'label'                 => esc_html__( 'Standard Post Meta', 'setwood' ),
        'section'               => 'setwood_standard',
        'default'               => array( 'like', 'views', 'comments'),
        'choices'               => array(
            'date'              => esc_html__( 'Date', 'setwood' ),
            'author'            => esc_html__( 'Author', 'setwood' ),
            'comments'          => esc_html__( 'Comments', 'setwood' ),
            'like'              => esc_html__( 'Like', 'setwood' ),
            'views'             => esc_html__( 'Views', 'setwood' ),
        ),
    ) );


/* Grid Post Section */

Setwood_Kirki::add_section( 'setwood_grid', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Grid Layout', 'setwood' ),
        'description'           => esc_html__( 'Use these settings to manage meta options content header.', 'setwood' ),
        'panel'                 => 'layout_settings',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'checkbox',
        'settings'               => 'grid_show_cat',
        'label'                 => esc_html__( 'Display category', 'setwood' ),
        'section'               => 'setwood_grid',
        'default'               => 1,
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'radio',
        'settings'               => 'grid_content_type',
        'label'                 => esc_html__( 'Content limit type', 'setwood' ),
        'section'               => 'setwood_grid',
        'default'               => 'excerpt',
        'choices'               => array(
            'content'           => esc_html__( 'Manual (using <!--more--> tag)', 'setwood' ),
            'excerpt'           => esc_html__( 'Automatic (excerpt)', 'setwood' ),
        ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'text',
        'settings'               => 'grid_excerpt_length',
        'label'                 => esc_html__( 'Excerpt length', 'setwood' ),
        'description'           => esc_html__( 'Specify your excerpt length (number of characters)', 'setwood' ),
        'section'               => 'setwood_grid',
        'default'               => 24,
        'required'              => array(
            array(
                'settings'       => 'grid_content_type',
                'operator'      => '==',
                'value'         => 'excerpt',
            ),
        ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'text',
        'settings'               => 'grid_excerpt_more',
        'label'                 => esc_html__( 'Excerpt "more" string', 'setwood' ),
        'description'           => esc_html__( 'Specify more string to append after excerpts', 'setwood' ),
        'section'               => 'setwood_grid',
        'default'               => '...',
        'required'              => array(
            array(
                'settings'       => 'grid_content_type',
                'operator'      => '==',
                'value'         => 'excerpt',
            ),
        ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'toggle',
        'settings'               => 'grid_show_readmore_link',
        'label'                 => esc_html__( 'Display Readmore Link', 'setwood' ),
        'section'               => 'setwood_grid',
        'default'               => 1,
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'sortable',
        'settings'               => 'lay_grid_meta',
        'label'                 => esc_html__( 'grid Post Meta', 'setwood' ),
        'section'               => 'setwood_grid',
        'default'               => array( 'like', 'views', 'comments', 'share' ),
        'choices'               => array(
            'date'              => esc_html__( 'Date', 'setwood' ),
            'author'            => esc_html__( 'Author', 'setwood' ),
            'comments'          => esc_html__( 'Comments', 'setwood' ),
            'like'              => esc_html__( 'Like', 'setwood' ),
            'views'             => esc_html__( 'Views', 'setwood' ),
            'share'             => esc_html__( 'Share', 'setwood' ),
        ),
    ) );

/* List Post Section */

Setwood_Kirki::add_section( 'setwood_list', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'List Layout', 'setwood' ),
        'description'           => esc_html__( 'Use these settings to manage meta options content header.', 'setwood' ),
        'panel'                 => 'layout_settings',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'checkbox',
        'settings'               => 'list_show_cat',
        'label'                 => esc_html__( 'Display category', 'setwood' ),
        'section'               => 'setwood_list',
        'default'               => 1,
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'radio',
        'settings'               => 'list_content_type',
        'label'                 => esc_html__( 'Content limit type', 'setwood' ),
        'section'               => 'setwood_list',
        'default'               => 'excerpt',
        'choices'               => array(
            'content'           => esc_html__( 'Manual (using <!--more--> tag)', 'setwood' ),
            'excerpt'           => esc_html__( 'Automatic (excerpt)', 'setwood' ),
        ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'text',
        'settings'               => 'list_excerpt_length',
        'label'                 => esc_html__( 'Excerpt length', 'setwood' ),
        'description'           => esc_html__( 'Specify your excerpt length (number of characters)', 'setwood' ),
        'section'               => 'setwood_list',
        'default'               => 18,
        'required'              => array(
            array(
                'settings'       => 'list_content_type',
                'operator'      => '==',
                'value'         => 'excerpt',
            ),
        ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'text',
        'settings'               => 'list_excerpt_more',
        'label'                 => esc_html__( 'Excerpt "more" string', 'setwood' ),
        'description'           => esc_html__( 'Specify more string to append after excerpts', 'setwood' ),
        'section'               => 'setwood_list',
        'default'               => '...',
        'required'              => array(
            array(
                'settings'       => 'list_content_type',
                'operator'      => '==',
                'value'         => 'excerpt',
            ),
        ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'toggle',
        'settings'               => 'list_show_readmore_link',
        'label'                 => esc_html__( 'Display Readmore Link', 'setwood' ),
        'section'               => 'setwood_list',
        'default'               => 1,
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'sortable',
        'settings'               => 'lay_list_meta',
        'label'                 => esc_html__( 'list Post Meta', 'setwood' ),
        'section'               => 'setwood_list',
        'default'               => array( 'like', 'views', 'comments', 'share' ),
        'choices'               => array(
            'date'              => esc_html__( 'Date', 'setwood' ),
            'author'            => esc_html__( 'Author', 'setwood' ),
            'comments'          => esc_html__( 'Comments', 'setwood' ),
            'like'              => esc_html__( 'Like', 'setwood' ),
            'views'             => esc_html__( 'Views', 'setwood' ),
            'share'             => esc_html__( 'Share', 'setwood' ),
        ),
    ) );


/* Pages Section */

Setwood_Kirki::add_section( 'setwood_page', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Pages', 'setwood' ),
        'description'           => esc_html__( 'These are settings which are applied to your pages template', 'setwood' ),
        'panel'                 => 'layout_settings',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'radio-image',
        'settings'               => 'layout_page',
        'label'                 => esc_html__( 'Pages layout', 'setwood' ),
        'section'               => 'setwood_page',
        'default'               => 'right-sidebar',
        'choices'               => array(
            'left-sidebar'           => get_template_directory_uri() . '/assets/images/admin/sidebar-left.png',
            'right-sidebar'          => get_template_directory_uri() . '/assets/images/admin/sidebar-right.png',
            'no-sidebar-full-width'  => get_template_directory_uri() . '/assets/images/admin/full-width.png',
        ),
    ) );

/* Woocommerce Section */

Setwood_Kirki::add_section( 'setwood_woocommerce', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Shop Layout', 'setwood' ),
        'description'           => esc_html__( 'These are settings which are applied to your woocommerce template.', 'setwood' ),
        'panel'                 => 'layout_settings',
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'radio-image',
        'settings'               => 'layout_product_archive',
        'label'                 => esc_html__( 'Product Archive layout', 'setwood' ),
        'section'               => 'setwood_woocommerce',
        'default'               => 'left-sidebar',
        'choices'               => array(
            'left-sidebar'           => get_template_directory_uri() . '/assets/images/admin/sidebar-left.png',
            'right-sidebar'          => get_template_directory_uri() . '/assets/images/admin/sidebar-right.png',
            'no-sidebar-full-width'  => get_template_directory_uri() . '/assets/images/admin/full-width.png',
        ),
    ) );


Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'radio-image',
        'settings'               => 'layout_product_single',
        'label'                 => esc_html__( 'Single Product layout', 'setwood' ),
        'section'               => 'setwood_woocommerce',
        'default'               => 'no-sidebar-full-width',
        'choices'               => array(
            'left-sidebar'           => get_template_directory_uri() . '/assets/images/admin/sidebar-left.png',
            'right-sidebar'          => get_template_directory_uri() . '/assets/images/admin/sidebar-right.png',
            'no-sidebar-full-width'  => get_template_directory_uri() . '/assets/images/admin/full-width.png',
        ),
    ) );


Setwood_Kirki::add_field( 'setwood_settings', array(
        'type'                  => 'radio-image',
        'settings'               => 'layout_product_page',
        'label'                 => esc_html__( 'Pages layout', 'setwood' ),
        'description'           => esc_html__( 'Cart,  Checkout, My Account Pages', 'setwood' ),
        'section'               => 'setwood_woocommerce',
        'default'               => 'no-sidebar-full-width',
        'choices'               => array(
            'left-sidebar'           => get_template_directory_uri() . '/assets/images/admin/sidebar-left.png',
            'right-sidebar'          => get_template_directory_uri() . '/assets/images/admin/sidebar-right.png',
            'no-sidebar-full-width'  => get_template_directory_uri() . '/assets/images/admin/full-width.png',
        ),
    ) );

/* Social Network Section */

Setwood_Kirki::add_section( 'setwood_social', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Social Network', 'setwood' ),
        'description'           => esc_html__( 'Use these settings to manage Social links.', 'setwood' ),
    ) );

/* Facebook */
Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'toggle',
    'settings'                  => 'setwood_add_facebook_sdk',
    'label'                     => esc_html__( 'Add Facebook SDK to Header', 'setwood' ),
    'description'               => esc_html__( 'Keep this enabled for facebook integration', 'setwood' ),
    'section'                   => 'setwood_social',
    'default'                   => 1,
) );

/* adding social network fields */
Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'text',
    'settings'                  => 'social_facebook',
    'label'                     => esc_html__( 'Facebook', 'setwood' ),
    'section'                   => 'setwood_social',
    'default'                   => 'http://www.facebook.com',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'text',
    'settings'                  => 'social_twitter',
    'label'                     => esc_html__( 'Twitter', 'setwood' ),
    'section'                   => 'setwood_social',
    'default'                   => 'http://www.twitter.com',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'text',
    'settings'                  => 'social_google_plus',
    'label'                     => esc_html__( 'Google Plus', 'setwood' ),
    'section'                   => 'setwood_social',
    'default'                   => '',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'text',
    'settings'                  => 'social_instagram',
    'label'                     => esc_html__( 'Instagram', 'setwood' ),
    'section'                   => 'setwood_social',
    'default'                   => 'http://www.instagram.com',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'text',
    'settings'                  => 'social_pinterest',
    'label'                     => esc_html__( 'Pinterest', 'setwood' ),
    'section'                   => 'setwood_social',
    'default'                   => 'http://www.pinterest.com',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'text',
    'settings'                  => 'social_youtube',
    'label'                     => esc_html__( 'Youtube', 'setwood' ),
    'section'                   => 'setwood_social',
    'default'                   => '',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'text',
    'settings'                  => 'social_linkedin',
    'label'                     => esc_html__( 'Linkedin', 'setwood' ),
    'section'                   => 'setwood_social',
    'default'                   => '',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'text',
    'settings'                  => 'social_tumblr',
    'label'                     => esc_html__( 'Tumblr', 'setwood' ),
    'section'                   => 'setwood_social',
    'default'                   => '',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'text',
    'settings'                  => 'social_bloglovin',
    'label'                     => esc_html__( 'Bloglovin', 'setwood' ),
    'section'                   => 'setwood_social',
    'default'                   => 'http://www.bloglovin.com',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'text',
    'settings'                  => 'social_soundcloud',
    'label'                     => esc_html__( 'Soundcloud', 'setwood' ),
    'section'                   => 'setwood_social',
    'default'                   => '',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'text',
    'settings'                  => 'social_rss',
    'label'                     => esc_html__( 'RSS', 'setwood' ),
    'section'                   => 'setwood_social',
    'default'                   => '',
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'text',
    'settings'                  => 'social_etsy',
    'label'                     => esc_html__( 'Etsy', 'setwood' ),
    'section'                   => 'setwood_social',
    'default'                   => '',
) );

/* Custom CSS */

Setwood_Kirki::add_section( 'setwood_code', array(
        'priority'              => 102,
        'title'                 => esc_html__( 'Custom Code', 'setwood' ),
        'description'           => esc_html__( 'Add your custom code here.',  'setwood' ),
    ) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'code',
    'settings'                  => 'custom_css',
    'label'                     => esc_html__( 'Custom CSS', 'setwood' ),
    'section'                   => 'setwood_code',
    'description'               => esc_html__( 'Add your custom css here.',  'setwood' ),
    'sanitize_callback'         => 'wp_filter_nohtml_kses',
    'sanitize_js_callback'      => 'wp_filter_nohtml_kses',
    'choices'     => array(
        'language' => 'css',
        'theme'    => 'monokai',
        'height'   => 250,
    ),
) );

Setwood_Kirki::add_field( 'setwood_settings', array(
    'type'                      => 'code',
    'settings'                  => 'custom_js',
    'label'                     => esc_html__( 'Custom Javascript', 'setwood' ),
    'section'                   => 'setwood_code',
    'description'               => esc_html__( 'Add your custom js here.',  'setwood' ),
    'choices'     => array(
        'language' => 'css',
        'theme'    => 'monokai',
        'height'   => 250,
    ),
) );