<?php

defined('ABSPATH') or die("No script kiddies please!");

/*

  Plugin name: AccessPress Pinterest - Pinterest WordPress Plugin

  Plugin URI: https://accesspressthemes.com/wordpress-plugins/accesspress-pinterest/

  Description: A plugin to add various pinterest widgets and pins to a site with dynamic configuration options.

  Version: 3.2.0

  Author: AccessPress Themes

  Author URI: http://accesspressthemes.com

  Text Domain:accesspress-pinterest

  Domain Path: /languages/

  License: GPLv2 or later

 */



//Decleration of the necessary constants for plugin

if (!defined('APSP_VERSION')) {

    define('APSP_VERSION', '3.2.0');

}



if (!defined('APSP_IMAGE_DIR')) {

    define('APSP_IMAGE_DIR', plugin_dir_url(__FILE__) . 'images');

}



if (!defined('APSP_JS_DIR')) {

    define('APSP_JS_DIR', plugin_dir_url(__FILE__) . 'js');

}



if (!defined('APSP_CSS_DIR')) {

    define('APSP_CSS_DIR', plugin_dir_url(__FILE__) . 'css');

}



if (!defined('APSP_LANG_DIR')) {

    define('APSP_LANG_DIR', basename(dirname(__FILE__)) . '/languages/');

}



if (!defined('APSP_TEXT_DOMAIN')) {

    define('APSP_TEXT_DOMAIN', 'accesspress-pinterest');

}



if (!defined('APSP_SETTINGS')) {

    define('APSP_SETTINGS', 'apsp-settings');

}



/*

 * Register of widgets

 *

 */

include_once('inc/backend/widget.php');



//Decleration of the class for necessary configuration of a plugin

if (!class_exists('APSP_Class_free')) {



    class APSP_Class_free {



        var $apsp_settings;



        function __construct() {

            $this->apsp_settings = get_option(APSP_SETTINGS);

            add_action('init', array($this, 'session_init')); //start the session if not started yet.

            register_activation_hook(__FILE__, array($this, 'plugin_activation')); //load the default setting for the plugin while activating

            add_action('init', array($this, 'plugin_text_domain')); //load the plugin text domain

            add_action('admin_enqueue_scripts', array($this, 'register_admin_assets')); //registers all the assets required for wp-admin

            add_action('wp_enqueue_scripts', array($this, 'register_frontend_assets')); // registers all the assets required for the frontend

            add_action('admin_menu', array($this, 'add_apsp_menu')); //register the plugin menu in backend

            add_action('widgets_init', array($this, 'add_apsp_widget'));

            add_shortcode('apsp-follow-button', array($this, 'apsp_follow_button_shortcode'));

            add_shortcode('apsp-profile-widget', array($this, 'apsp_profile_widget_shortcode'));

            add_shortcode('apsp-board-widget', array($this, 'apsp_board_widget_shortcode'));

            add_shortcode('apsp-pin-image', array($this, 'apsp_pin_widget_shortcode'));

            add_shortcode('apsp_save_button', array($this, 'apsp_save_button_shortcode') );

            add_shortcode('apsp-latest-pins', array($this, 'apsp_latest_pins_widget_shortcode'));

            add_shortcode( 'apsp_share', array($this, 'apsp_share') ); //add pinterest share button using shortcode

            add_action('admin_post_apsp_save_options', array($this, 'apsp_save_options')); //save the options in the wordpress options table.

            add_action('admin_post_apsp_restore_default_settings', array($this, 'apsp_restore_default_settings')); //restores default settings.

            add_filter('clean_url', array($this, 'add_async')); //filter the scripts to add async attributes.

        }



        //starts the session with the call of init hook

        function session_init() {

            if (!session_id() && !headers_sent() ) {

                session_start();

            }

        }



        //load the default settings of the plugin

        function plugin_activation() {

            if (!get_option(APSP_SETTINGS)) {

                include( 'inc/backend/activation.php' );

            }

        }



        //loads the text domain for translation

        function plugin_text_domain() {

            load_plugin_textdomain( 'accesspress-pinterest', false, APSP_LANG_DIR );

        }



        //registration of the backend assets

        function register_admin_assets() {

            if (isset($_GET['page']) && $_GET['page'] == 'accesspress-pinterest') {

                //registration of css in the admin panel

                wp_enqueue_style('apsp-fontawesome-css', APSP_CSS_DIR.'/font-awesome/font-awesome.min.css', '', APSP_VERSION);

                wp_enqueue_style('apsp-frontend-css', APSP_CSS_DIR . '/backend.css', '', APSP_VERSION);



                //registration of the scripts in the admin panel

                wp_enqueue_script('apsp-backend-js', APSP_JS_DIR . '/backend.js', array('jquery', 'jquery-ui-sortable', 'wp-color-picker'), APSP_VERSION);

            }

        }



        //registration of the plugins frontend assets

        function register_frontend_assets() {

            wp_enqueue_style('apsp-font-opensans', '//fonts.googleapis.com/css?family=Open+Sans', array(), false);

            wp_enqueue_style('apsp-frontend-css', APSP_CSS_DIR . '/frontend.css', '', APSP_VERSION);

            wp_enqueue_script('masionary-js', APSP_JS_DIR . '/jquery-masionary.js#async', array('jquery'), APSP_VERSION, true);

            wp_enqueue_script('frontend-js', APSP_JS_DIR . '/frontend.js#async', array('jquery', 'masionary-js'), APSP_VERSION, true);

            wp_enqueue_script( 'jquery-masonry' );

            if ($this->apsp_settings['js_enabled'] == 'on') {

                if(!isset($this->apsp_settings['display_options'])){

                    // echo "need to show the pinterest icon in all";

                     if ($this->apsp_settings['pinit_js_disable'] == 'off') {

                        wp_enqueue_script('pinit-js', '//assets.pinterest.com/js/pinit.js', false, null, true);

                    }

                    add_filter('clean_url', array($this, 'pinit_js_config'));

                }

                $check = $this->add_native_pinterest_buttons();

                if(isset($check) && $check=='1'){

                    if ($this->apsp_settings['pinit_js_disable'] == 'off') {

                        wp_enqueue_script('pinit-js', '//assets.pinterest.com/js/pinit.js', false, null, true);

                    }

                    add_filter('clean_url', array($this, 'pinit_js_config'));

                }

            } else {

                if ($this->apsp_settings['pinit_js_disable'] == 'off') {

                    wp_enqueue_script('pinit-js', '//assets.pinterest.com/js/pinit.js', false, null, true);

                }

            }

        }



        /* True if plugin should be added to the current post/page */

        function add_native_pinterest_buttons() {

            global $post;

            $options = get_option( APSP_SETTINGS );

            if(empty($options['display_options'])){

                return false;

            }else{

                if(isset($post->ID)){

                    if( is_home() ){

                        $home_page=in_array( 'home_page', $options['display_options'] );

                        $is_home=(is_home()) && $home_page ? true : false;

                        return $home_page;

                    }else if ( is_front_page() ){

                        $front_page = in_array('front_page', $options['display_options']);

                        $is_front_page = ( is_front_page() ) && $front_page ? true : false;

                        return $is_front_page;



                    }else if ( is_singular() ){

                        $is_single = ( is_singular($options['display_options']) && !is_front_page() ) ? true : false;

                        return $is_single;



                    }else if(is_tax()){

                        $taxonomies = self::get_registered_taxonomies();

                        $content_flag = false;

                        if (!empty($taxonomies)) {

                            foreach ($taxonomies as $key => $value) {

                                $required_tax_objects = $value->labels;

                                $name = $required_tax_objects->name;

                                //echo $value->name;

                                if(is_tax($value->name)){

                                    if (in_array($value->name, $options['display_options'])) {

                                         $content_flag = true;

                                         $custom_tax = (is_tax() ) ? true : false;

                                         return $custom_tax;

                                    }

                                }

                            }

                        }

                    }else if ( is_archive() && !is_category()|| is_search() || is_tag() ){

                        $is_default_archive = in_array( 'archives', $options['display_options'] );

                        $default_archives = ( (is_archive() && !is_tax() ) && !is_category() ) && $is_default_archive ? true : false;

                        return $default_archives;



                    }else if( is_category() ){

                        $is_default_categories = in_array( 'categories', $options['display_options'] );

                        $default_categories =(is_category() && !is_tax() && is_archive()) && $is_default_categories ? true : false;

                        return $default_categories;



                    }

                }

            }

        }



        //returns all the registered post types only

        function get_registered_post_types() {

            $post_types = get_post_types();

            unset($post_types['post']);

            unset($post_types['page']);

            unset($post_types['attachment']);

            unset($post_types['revision']);

            unset($post_types['nav_menu_item']);

            return $post_types;

        }



        // returns all the registered taxonomies

        function get_registered_taxonomies() {

            $output = 'objects';

            $args = '';

            $taxonomies = get_taxonomies($args, $output);

            unset($taxonomies['category']);

            unset($taxonomies['post_tag']);

            unset($taxonomies['nav_menu']);

            unset($taxonomies['link_category']);

            unset($taxonomies['post_format']);

            return $taxonomies;

        }



        //register the plugin menu for backend.

        function add_apsp_menu() {

            add_menu_page('AccessPress Pinterest', 'AccessPress Pinterest', 'manage_options', 'accesspress-pinterest', array($this, 'main_page'), APSP_IMAGE_DIR . '/apsp-icon.png');

        }



        //plugins backend admin page

        function main_page() {

            include( 'inc/backend/main-page.php' );

        }



        //registration of the widget

        function add_apsp_widget() {

            register_widget('APSP_Follow_Widget_Free');

            register_widget('APSP_Profile_Widget_Free');

            register_widget('APSP_Board_Widget_Free');

            register_widget('APSP_Single_Pin_Widget_Free');

            register_widget('APSP_Latest_Pins_Widget_Free');

        }



        //pinterest follow button shortcode generator

        function apsp_follow_button_shortcode($attr) {

            ob_start();

            include( 'inc/frontend/follow-shortcode.php' );

            $html = ob_get_contents();

            ob_get_clean();

            return $html;

        }



        //pinterest profile widget shortcode

        function apsp_profile_widget_shortcode($profile_attr) {

            ob_start();

            include( 'inc/frontend/profile-shortcode.php' );

            $html = ob_get_contents();

            ob_get_clean();

            return $html;

        }



        //pinterest board widget shortcode

        function apsp_board_widget_shortcode($board_attr) {

            ob_start();

            include( 'inc/frontend/board-shortcode.php' );

            $html = ob_get_contents();

            ob_get_clean();

            return $html;

        }



        function apsp_save_button_shortcode($attr){

            ob_start();

            include( 'inc/frontend/save_button_shortcode.php' );

            $html = ob_get_contents();

            ob_get_clean();

            return $html;

        }



        //pinterest single pin widget shortcode

        function apsp_pin_widget_shortcode($atts) {

            ob_start();

            include( 'inc/frontend/pin-widget-shortcode.php' );

            $html = ob_get_contents();

            ob_get_clean();

            return $html;

        }



        //pinterest latest pins widget shortcode

        function apsp_latest_pins_widget_shortcode($attr) {

            ob_start();

            include( 'inc/frontend/latest-pins-shortcode.php' );

            $html = ob_get_contents();

            ob_get_clean();

            return $html;

        }



        function apsp_share(){

            ob_start();

            include( 'inc/frontend/apsp_share.php' );

            $html = ob_get_contents();

            ob_get_clean();

            return $html;

        }



        function return_cache_period($seconds) {

            //please set the integer value in seconds

            return 2;

        }



        //function to get the rss feed items from pinterest

        function apsp_pinterest_get_rss_feed($feed_url, $number_of_pins_to_show) {

            // Get a pinterest feed object from the specified feed source.

            add_filter('wp_feed_cache_transient_lifetime', array($this, 'return_cache_period'));

            $rss = fetch_feed($feed_url);

            remove_filter('wp_feed_cache_transient_lifetime', array($this, 'return_cache_period'));

            if (!is_wp_error($rss)) {

                // Figure out how many total items there are, but limit it to number specified

                $maxitems = $rss->get_item_quantity($number_of_pins_to_show);

                $rss_items = $rss->get_items(0, $maxitems);

                return $rss_items;

            } else {

                return false;

            }

        }



        function trim_text($text, $length) {

            //strip html

            $text = strip_tags($text);

            //no need to trim if its shorter than length

            if (strlen($text) <= $length) {

                return $text;

            }

            $last_space = strrpos(substr($text, 0, $length), ' ');

            $trimmed_text = substr($text, 0, $last_space);

            $trimmed_text .= '...';

            return $trimmed_text;

        }



        function pinit_js_config($url) {

            if (FALSE === strpos($url, 'pinit') || FALSE === strpos($url, '.js') || FALSE === strpos($url, 'pinterest.com')) {

                // this isn't a Pinterest URL, ignore it

                return $url;

            }



            $return_string = "' async";

            $hover_op   = $this->apsp_settings['js_enabled'];

            $color_op   = $this->apsp_settings['color'];

            $size_op    = $this->apsp_settings['size'];

            $lang_op    = $this->apsp_settings['language'];

            $shape_op   = $this->apsp_settings['shape'];



            // if image hover is enabled, append the data-pin-hover attribute

            if (isset($hover_op) && $hover_op == "on") {

                $return_string = "$return_string data-pin-hover='true";

            }



            // data pin count

            // data-pin-count=above, beside

            if(isset($counter_op)){

                if ($counter_op == "above") {

                    $return_string = "$return_string' data-pin-count='$counter_op";

                } else if ($counter_op == "beside") {

                    $return_string = "$return_string' data-pin-count='$counter_op";

                }

            }

            // add the shape

            if (isset($shape_op) && $shape_op == 'round') {

                $return_string = "$return_string' data-pin-shape='$shape_op";

            }



            // add the size only if it's set to something besides small

            if (isset($size_op)) {

                if ($size_op == "28" && $shape_op == 'rectangular') {

                    $return_string = "$return_string' data-pin-height='$size_op";

                } else if ($size_op == "28" && $shape_op == 'round') {

                    $size_op = '32';

                    $return_string = "$return_string' data-pin-height='$size_op";

                }

            }



            // if shape is not round, add the color and language

            if ($shape_op != "round") {

                // add the color

                if (isset($color_op)) {

                    $return_string = "$return_string' data-pin-color='$color_op";

                }

                // add the language (EN or JP)

                if (isset($lang_op)) {

                    $return_string = "$return_string' data-pin-lang='$lang_op";

                }

            }

            if ($return_string == "") {

                return $url;

            }

            return $url . $return_string;

        }



        // function to save the settings of a plugin

        function apsp_save_options() {

            if (isset($_POST['apsp_add_nonce_save_settings']) && isset($_POST['apsp_save_settings']) && wp_verify_nonce($_POST['apsp_add_nonce_save_settings'], 'apsp_nonce_save_settings'))

                include( 'inc/backend/save-settings.php' );

        }



        //function to restore the default setting of a plugin

        function apsp_restore_default_settings() {

            $nonce = $_REQUEST['_wpnonce'];

            if (!empty($_GET) && wp_verify_nonce($nonce, 'apsp-restore-default-settings-nonce')) {

                //restore the default plugin activation settings from the activation page.

                include( 'inc/backend/activation.php' );

                $_SESSION['apsp_message'] = __('Settings restored Successfully.', 'accesspress-pinterest');

                wp_redirect(admin_url() . 'admin.php?page=' . 'accesspress-pinterest');

                exit;

            } else {

                die('No script kiddies please!');

            }

        }



        /*

         * Function to add async loading of scripts

         */



        function add_async($url) {

            if (strpos($url, "#async") === false)

                return $url;

            else if (is_admin())

                return str_replace("#async", "", $url);

            else

                return str_replace("#async", "", "$url' async='async");

        }



        //returns the current page url

        function curPageURL() {

            $pageURL = 'http';

            if ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' ) {

                $pageURL .= "s";

            }

            $pageURL .= "://";

            if ( $_SERVER["SERVER_PORT"] != "80" ) {

                $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];

            } else {

                $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

            }

            return $pageURL;

        }



    }



    $apsp_object = new APSP_Class_free();

}





