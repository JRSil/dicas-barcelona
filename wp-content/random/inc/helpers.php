<?php
/*-----------------------------------------------------------------------------------*/
/*	Helpers and utils functions for theme use
/*-----------------------------------------------------------------------------------*/

/**
 * Returns current page or post ID
 *
 * @since 1.0.0
 */
function setwood_get_the_id() {

	// If singular get_the_ID
	if ( is_singular() ) {
		return get_the_ID();
	}

	// Get ID of WooCommerce product archive
	elseif ( is_post_type_archive( 'product' ) && class_exists( 'Woocommerce' ) && function_exists( 'wc_get_page_id' ) ) {
		$shop_id = wc_get_page_id( 'shop' );
		if ( isset( $shop_id ) ) {
			return wc_get_page_id( 'shop' );
		}
	}

	// Posts page
	elseif ( is_home() && $page_for_posts = get_option( 'page_for_posts' ) ) {
		return $page_for_posts;
	}

	// Return nothing
	else {
		return NULL;
	}

}

/* Social Network Array */
if ( ! function_exists( 'setwood_get_social_networks') ) {
    function setwood_get_social_networks() {
        return array(
            array(
                'name'  => 'facebook',
                'label' => esc_html__( 'Facebook', 'setwood' ),
                'icon'  => 'facebook'
            ),
            array(
                'name'  => 'twitter',
                'label' => esc_html__( 'Twitter', 'setwood' ),
                'icon'  => 'twitter'
            ),
            array(
                'name'  => 'pinterest',
                'label' => esc_html__( 'Pinterest', 'setwood' ),
                'icon'  => 'pinterest'
            ),
            array(
                'name'  => 'instagram',
                'label' => esc_html__( 'Instagram', 'setwood' ),
                'icon'  => 'instagram'
            ),
            array(
                'name'  => 'google_plus',
                'label' => esc_html__( 'Google Plus', 'setwood' ),
                'icon'  => 'google-plus'
            ),
            array(
                'name'  => 'linkedin',
                'label' => esc_html__( 'LinkedIn', 'setwood' ),
                'icon'  => 'linkedin'
            ),
            array(
                'name'  => 'tumblr',
                'label' => esc_html__( 'Tumblr', 'setwood' ),
                'icon'  => 'tumblr'
            ),
            array(
                'name'  => 'flickr',
                'label' => esc_html__( 'Flickr', 'setwood' ),
                'icon'  => 'flickr'
            ),
            array(
                'name'  => 'bloglovin',
                'label' => esc_html__( 'Bloglovin', 'setwood' ),
                'icon'  => 'heart'
            ),
            array(
                'name'  => 'youtube',
                'label' => esc_html__( 'YouTube', 'setwood' ),
                'icon'  => 'youtube'
            ),
            array(
                'name'  => 'vimeo',
                'label' => esc_html__( 'Vimeo', 'setwood' ),
                'icon'  => 'vimeo'
            ),
            array(
                'name'  => 'dribbble',
                'label' => esc_html__( 'Dribbble', 'setwood' ),
                'icon'  => 'dribbble'
            ),
            array(
                'name'  => 'wordpress',
                'label' => esc_html__( 'WordPress', 'setwood' ),
                'icon'  => 'wordpress'
            ),
            array(
                'name'  => '500px',
                'label' => esc_html__( '500px', 'setwood' ),
                'icon'  => '500px'
            ),
            array(
                'name'  => 'soundcloud',
                'label' => esc_html__( 'Soundcloud', 'setwood' ),
                'icon'  => 'soundcloud'
            ),
            array(
                'name'  => 'spotify',
                'label' => esc_html__( 'Spotify', 'setwood' ),
                'icon'  => 'spotify'
            ),
            array(
                'name'  => 'vine',
                'label' => esc_html__( 'Vine', 'setwood' ),
                'icon'  => 'vine'
            ),
            array(
                'name'  => 'rss',
                'label' => esc_html__( 'RSS', 'setwood' ),
                'icon'  => 'rss'
            ),
            array(
                'name'  => 'etsy',
                'label' => esc_html__( 'Etsy', 'setwood' ),
                'icon'  => 'etsy'
            ),
        );
    }
}

/* Font-Awesome - No Etsy icon? No problem!  */

add_action( 'wp_head', 'setwood_wp_css', 100 ); // The CSS code for ‘E’.

if ( !function_exists( 'setwood_wp_css' ) ):
    function setwood_wp_css() {
        echo '<style type="text/css">.fa-etsy:before { content: "\0045"; font-family: georgia, serif; }</style>';
    }
endif;

/**
 * Get JS settings
 * 
 * Function creates list of settings from thme options to pass 
 * them to global JS variable so we can use it in JS files 
 *
 * @return array List of JS settings 
 * @since  1.0
 */

if ( !function_exists( 'setwood_get_js_settings' ) ):
	function setwood_get_js_settings() {
		$js_settings = array();
		$protocol = is_ssl() ? 'https://' : 'http://';
		$js_settings['ajax_url'] = admin_url( 'admin-ajax.php', $protocol );
		$js_settings['logo'] = setwood_get_option('logo');
		$js_settings['logo_retina'] = setwood_get_option('logo_retina');
        $js_settings['logo_mini'] = setwood_get_option('logo_mini');
		$js_settings['logo_retina_mini'] = setwood_get_option('logo_retina_mini');
        $js_settings['header_sticky'] = setwood_get_option( 'header_sticky' ) ? true : false;
		return $js_settings;
	}
endif;

/**
* Additional user profile fields
**/

/* User Profile Settings */

function setwood_modify_contact_methods($profile_fields) {

	// Add new fields
	$profile_fields['facebook'] = 'Facebook URL';
	$profile_fields['googleplus'] = 'Google+ URL';
	$profile_fields['linkedin'] = 'LinkedIn URL';
	$profile_fields['instagram'] = 'Instagram URL';
	$profile_fields['pinterest'] = 'Pinterest URL';
	$profile_fields['twitter'] = 'Twitter URL';
    $profile_fields['tumblr'] = 'Tumblr URL';

	return $profile_fields;
}

add_filter('user_contactmethods', 'setwood_modify_contact_methods');

/**
 * Display navigation to next/previous post when applicable.
 *
 * @since 1.0
 */

function setwood_navigation_markup_template ( $template ) {
 
    $template = '
    <nav class="navigation %1$s">
        <h2 class="screen-reader-text">%2$s</h2>
        <div class="nav-links">%3$s</div>
    </nav>';
 
    return $template;
}

add_filter('navigation_markup_template', 'setwood_navigation_markup_template');

/*
 * Get locale
 */
function setwood_get_locale() {
	$setwood_locale = get_locale();
	if( preg_match( '#^[a-z]{2}\-[A-Z]{2}$#', $setwood_locale ) ) {
		$setwood_locale = str_replace( '-', '_', $setwood_locale );
	} else if ( preg_match( '#^[a-z]{2}$#', $setwood_locale ) ) {
		$setwood_locale .= '_'. mb_strtoupper( $setwood_locale, 'UTF-8' );
	}
	if ( empty( $setwood_locale ) ) {
		$setwood_locale = 'en_US';
	}
	return $setwood_locale;
}
