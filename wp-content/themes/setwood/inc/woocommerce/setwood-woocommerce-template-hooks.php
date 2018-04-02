<?php
/**
 * setwood WooCommerce hooks
 *
 * @package setwood
 */

/**
 * Styles
 * @see  setwood_woocommerce_scripts()
 */


/**
 * Layout
 * @see  setwood_before_content()
 * @see  setwood_after_content()
 * @see  woocommerce_breadcrumb()
 * @see  setwood_shop_messages()
 */
remove_action( 'woocommerce_before_main_content', 	'woocommerce_breadcrumb',	                20, 0 );
remove_action( 'woocommerce_before_main_content', 	'woocommerce_output_content_wrapper', 		10 );
remove_action( 'woocommerce_after_main_content', 	'woocommerce_output_content_wrapper_end', 	10 );
remove_action( 'woocommerce_sidebar', 				'woocommerce_get_sidebar', 					10 );
remove_action( 'woocommerce_after_shop_loop', 		'woocommerce_pagination', 					10 );
remove_action( 'woocommerce_before_shop_loop', 		'woocommerce_result_count', 				20 );
remove_action( 'woocommerce_before_shop_loop', 		'woocommerce_catalog_ordering', 			30 );
add_action( 'woocommerce_before_main_content', 		'setwood_before_content', 					10 );
add_action( 'woocommerce_after_main_content', 		'setwood_after_content', 					10 );
//add_action( 'setwood_content_top',             	'woocommerce_breadcrumb',                 	10 );
add_action( 'setwood_content_top', 					'setwood_shop_messages', 					15 );

add_action( 'woocommerce_after_shop_loop',			'setwood_sorting_wrapper',					9 );
add_action( 'woocommerce_after_shop_loop', 			'woocommerce_catalog_ordering', 			10 );
add_action( 'woocommerce_after_shop_loop', 			'woocommerce_result_count', 				20 );
add_action( 'woocommerce_after_shop_loop', 			'woocommerce_pagination', 					30 );
add_action( 'woocommerce_after_shop_loop',			'setwood_sorting_wrapper_close',			31 );

add_action( 'woocommerce_before_shop_loop',			'setwood_sorting_wrapper',					9 );
add_action( 'woocommerce_before_shop_loop', 		'woocommerce_catalog_ordering', 			10 );
add_action( 'woocommerce_before_shop_loop', 		'woocommerce_result_count', 				20 );
add_action( 'woocommerce_before_shop_loop', 		'setwood_woocommerce_pagination', 			30 );
add_action( 'woocommerce_before_shop_loop',			'setwood_sorting_wrapper_close',			31 );

/**
 * Products
 * @see  setwood_upsell_display()
 */
remove_action( 'woocommerce_after_single_product_summary', 	'woocommerce_upsell_display', 				15 );
add_action( 'woocommerce_after_single_product_summary', 	'setwood_upsell_display', 					15 );
remove_action( 'woocommerce_before_shop_loop_item_title', 	'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 		'woocommerce_show_product_loop_sale_flash', 6 );

/**
 * Structured Data
 *
 * @see setwood_woocommerce_init_structured_data()
 */
add_action( 'woocommerce_before_shop_loop_item', 'setwood_woocommerce_init_structured_data' );


/**
 * Header
 * @see  setwood_product_search()
 * @see  setwood_header_cart()
 */
//add_action( 'setwood_header_1', 'setwood_product_search', 	30 );
//add_action( 'setwood_header_3', 'setwood_header_cart',			25 );
if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'setwood_cart_link_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'setwood_cart_link_fragment' );
}
