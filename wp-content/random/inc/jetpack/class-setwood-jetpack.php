<?php
/**
 * Setwood Jetpack Class
 *
 * @author   WooThemes
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Setwood_Jetpack' ) ) :

class Setwood_Jetpack {

	/**
	 * Setup class.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'jetpack_setup' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'jetpack_scripts' ), 10 );
	}

	/**
	 * Add theme support for Infinite Scroll.
	 * See: http://jetpack.me/support/infinite-scroll/
	 */
	public function jetpack_setup() {
		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			'footer'    => 'page',
		) );
	}

	/**
	 * Enqueue jetpack styles.
	 * @since  1.6.1
	 */
	public function jetpack_scripts() {
		global $setwood_version;

		if ( class_exists( 'Jetpack' ) ) {
			wp_enqueue_style( 'setwood-jetpack-style', get_template_directory_uri() . '/assets/css/jetpack/jetpack.css', '', $setwood_version );
			wp_style_add_data( 'setwood-jetpack-style', 'rtl', 'replace' );
		}
	}
}

endif;

return new Setwood_Jetpack();
