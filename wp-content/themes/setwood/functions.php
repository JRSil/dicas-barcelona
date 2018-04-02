<?php
/**
 * setwood engine room
 *
 * @package setwood
 */

/**
 * Initialize all the things.
 */
require ( get_template_directory() . '/inc/class-setwood.php');
require ( get_template_directory() . '/inc/tgmpa.php');
require ( get_template_directory() . '/inc/jetpack/class-setwood-jetpack.php');
require ( get_template_directory() . '/inc/customizer/include-kirki.php'); // Recommend the Kirki plugin
require ( get_template_directory() . '/inc/customizer/class-setwood-kirki.php'); // Load the Kirki Fallback class
require ( get_template_directory() . '/inc/customizer/class-setwood-customizer.php');
require ( get_template_directory() . '/inc/customizer/class-featured-content.php');
require ( get_template_directory() . '/inc/helpers.php');
require ( get_template_directory() . '/inc/setwood-functions.php');
require ( get_template_directory() . '/inc/setwood-template-hooks.php');
require ( get_template_directory() . '/inc/setwood-template-functions.php');

// admin
require ( get_template_directory() . '/inc/admin/meta-boxes.php');

//Widgets
require ( get_template_directory() . '/inc/widgets/posts.php');
require ( get_template_directory() . '/inc/widgets/socials.php');
require ( get_template_directory() . '/inc/widgets/about.php');
require ( get_template_directory() . '/inc/widgets/feature.php');
require ( get_template_directory() . '/inc/widgets/advertisement.php');
require ( get_template_directory() . '/inc/widgets/facebook.php');

if ( is_woocommerce_activated() ) {
    require ( get_template_directory() . '/inc/woocommerce/class-setwood-woocommerce.php');
    require ( get_template_directory() . '/inc/woocommerce/setwood-woocommerce-template-hooks.php');
    require ( get_template_directory() . '/inc/woocommerce/setwood-woocommerce-template-functions.php');
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woothemes/theme-customisations
 */
add_action( 'admin_enqueue_scripts', 'setwood_admin_enqueue_scripts' );
    /**
     * Enqueue a script in the WordPress admin, excluding edit.php.
     *
     * @param int $hook Hook suffix for the current admin page.
     */

    function setwood_admin_enqueue_scripts( $hook ) {
        global $setwood_version;
        wp_enqueue_media();
        wp_enqueue_script( 'setwood-media-uploader-js', get_template_directory_uri() . '/assets/js/admin/media-uploader.js', array( 'jquery' ), $setwood_version, true );
        wp_enqueue_style( 'setwood-admin-style', get_template_directory_uri() . '/assets/css/admin.css', '', $setwood_version );
    }

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
    $content_width = 980; /* pixels */
}

/**
 * Getter function for Featured Content Plugin.
 * @return array An array of WP_Post objects.
 */
function setwood_get_featured_posts() {
    /**
     * Filter the featured posts to return.
     * @param array|bool $posts Array of featured posts, otherwise false.
     */
    return apply_filters( 'setwood_get_featured_content', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 * @return bool Whether there are featured posts.
 */
function setwood_has_featured_posts() {
    return ! is_paged() && (bool) setwood_get_featured_posts();
}

/**
 * Remove plugin stylesheet.
 */

function remove_plugin_assets() {
    wp_dequeue_style('dot-irecommendthis');
    wp_deregister_style('dot-irecommendthis');
}
add_action('wp_print_styles', 'remove_plugin_assets', 99999);

/* Remove Recent Tweets Widget Plugin CSS*/
remove_action( 'wp_enqueue_scripts', 'tp_twitter_plugin_styles' );

/* Update Default Thumbnail Sizes */

update_option( 'thumbnail_size_w', 260 );
update_option( 'thumbnail_size_h', 195 );