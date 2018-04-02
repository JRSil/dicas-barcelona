<?php
/**
 * Setwood WooCommerce Class
 *
 * @author   WooThemes
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Setwood_WooCommerce' ) ) :

class Setwood_WooCommerce {

	/**
	 * Setup class.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_filter( 'loop_shop_columns', array( $this, 'loop_columns' ) );
		add_filter( 'body_class', array( $this, 'woocommerce_body_class' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'woocommerce_scripts' ),	20 );
		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
		add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
		add_filter( 'woocommerce_product_thumbnails_columns', array( $this, 'thumbnail_columns' ) );
		add_filter( 'loop_shop_per_page', array( $this, 'products_per_page' ) );

		if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.5', '<' ) ) {
			add_action( 'wp_footer', array( $this, 'star_rating_script' ) );
		}

	}

	/**
	 * Default loop columns on product archives
	 * @return integer products per row
	 * @since  1.0.0
	 */
	public function loop_columns() {
		return apply_filters( 'setwood_loop_columns', 3 ); // 3 products per row
	}

	/**
	 * Add 'woocommerce-active' class to the body tag
	 * @param  array $classes
	 * @return array $classes modified to include 'woocommerce-active' class
	 */
	public function woocommerce_body_class( $classes ) {
		if ( is_woocommerce_activated() ) {
			$classes[] = 'woocommerce-active';
		}

		return $classes;
	}
    
	/**
	 * WooCommerce specific scripts & stylesheets
	 * @since 1.0.0
	 */
	public function woocommerce_scripts() {
		global $setwood_version;

		wp_enqueue_style( 'setwood-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce/woocommerce.css', $setwood_version );
		wp_style_add_data( 'setwood-woocommerce-style', 'rtl', 'replace' );

		wp_register_script( 'setwood-sticky-payment', get_template_directory_uri() . '/assets/js/woocommerce/checkout.min.js', 'jquery', $setwood_version, true );

		if ( is_checkout() ) {
			wp_enqueue_script( 'setwood-sticky-payment' );
		}
	}

	/**
	 * Star rating backwards compatibility script (WooCommerce <2.5).
	 * @since 1.6.0
	 */
	public function star_rating_script() {
		if ( wp_script_is( 'jquery', 'done' ) && is_product() ) {
	?>
		<script type="text/javascript">
			jQuery( function( $ ) {
				$( 'body' ).on( 'click', '#respond p.stars a', function() {
					var $container = $( this ).closest( '.stars' );
					$container.addClass( 'selected' );
				});
			});
		</script>
	<?php
		}
	}

	/**
	 * Related Products Args
	 * @param  array $args related products args
	 * @since 1.0.0
	 * @return  array $args related products args
	 */
	public function related_products_args( $args ) {
		$args = apply_filters( 'setwood_related_products_args', array(
			'posts_per_page' => 3,
			'columns'        => 3,
		) );

		return $args;
	}

	/**
	 * Product gallery thumnail columns
	 * @return integer number of columns
	 * @since  1.0.0
	 */
	public function thumbnail_columns() {
		return intval( apply_filters( 'setwood_product_thumbnail_columns', 4 ) );
	}

	/**
	 * Products per page
	 * @return integer number of products
	 * @since  1.0.0
	 */
	public function products_per_page() {
		return intval( apply_filters( 'setwood_products_per_page', 12 ) );
	}
}

endif;

return new Setwood_WooCommerce();
