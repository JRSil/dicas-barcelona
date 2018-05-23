<?php
/**
 * WooCommerce Template Functions.
 *
 * @package setwood
 */

/**
 * Before Content
 * Wraps all WooCommerce content in wrappers which match the theme markup
 * @since   1.0.0
 * @return  void
 */
if ( ! function_exists( 'setwood_before_content' ) ) {
	function setwood_before_content() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main card">
	    	<?php
	}
}

/**
 * After Content
 * Closes the wrapping divs
 * @since   1.0.0
 * @return  void
 */
if ( ! function_exists( 'setwood_after_content' ) ) {
	function setwood_after_content() {
		?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php do_action( 'setwood_sidebar' );
	}
}

/**
 * Cart Fragments
 * Ensure cart contents update when products are added to the cart via AJAX
 * @param  array $fragments Fragments to refresh via AJAX
 * @return array            Fragments to refresh via AJAX
 */
if ( ! function_exists( 'setwood_cart_link_fragment' ) ) {
	function setwood_cart_link_fragment( $fragments ) {
		global $woocommerce;

		ob_start();

		setwood_cart_link();

		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}

if ( ! function_exists( 'setwood_cart_link_fragment' ) ) {
    /**
     * Cart Fragments
     * Ensure cart contents update when products are added to the cart via AJAX
     *
     * @param  array $fragments Fragments to refresh via AJAX.
     * @return array            Fragments to refresh via AJAX
     */
    function setwood_cart_link_fragment( $fragments ) {
        global $woocommerce;
        ob_start();
        setwood_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();
    }
}
if ( ! function_exists( 'setwood_cart_link' ) ) {
    /**
     * Cart Link
     * Displayed a link to the cart including the number of items present and the cart total
     *
     * @return void
     * @since  1.0.0
     */
    function setwood_cart_link() {
        ?>
            <a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'setwood' ); ?>">
                <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'setwood' ), WC()->cart->get_cart_contents_count() ) );?></span>
            </a>
        <?php
    }
}

/**
 * Upsells
 * Replace the default upsell function with our own which displays the correct number product columns
 * @since   1.0.0
 * @return  void
 * @uses    woocommerce_upsell_display()
 */
if ( ! function_exists( 'setwood_upsell_display' ) ) {
	function setwood_upsell_display() {
		woocommerce_upsell_display( -1, 3 );
	}
}

if ( ! function_exists( 'setwood_sorting_wrapper' ) ) {
	/**
	 * Sorting wrapper
	 *
	 * @since   1.4.3
	 * @return  void
	 */
	function setwood_sorting_wrapper() {
		echo '<div class="setwood-sorting">';
	}
}
if ( ! function_exists( 'setwood_sorting_wrapper_close' ) ) {
	/**
	 * Sorting wrapper close
	 *
	 * @since   1.4.3
	 * @return  void
	 */
	function setwood_sorting_wrapper_close() {
		echo '</div>';
	}
}


/**
 * Setwood shop messages
 * @since   1.4.4
 * @uses    do_shortcode
 */
function setwood_shop_messages() {
	if ( ! is_checkout() ) {
		echo wp_kses_post( setwood_do_shortcode( 'woocommerce_messages' ) );
	}
}

/**
 * Setwood WooCommerce Pagination
 * WooCommerce disables the product pagination inside the woocommerce_product_subcategories() function
 * but since Setwood adds pagination before that function is excuted we need a separate function to
 * determine whether or not to display the pagination.
 * @since 1.4.4
 */
if ( ! function_exists( 'setwood_woocommerce_pagination' ) ) {
	function setwood_woocommerce_pagination() {
		if ( woocommerce_products_will_display() ) {
			woocommerce_pagination();
		}
	}
}

/**
 * Featured and On-Sale Products
 * Check for featured products then on-sale products and use the appropiate shortcode.
 * If neither exist, it can fallback to show recently added products.
 * @since  1.5.1
 * @uses  is_woocommerce_activated()
 * @uses  wc_get_featured_product_ids()
 * @uses  wc_get_product_ids_on_sale()
 * @uses  setwood_do_shortcode()
 * @return void
 */
if ( ! function_exists( 'setwood_promoted_products' ) ) {
	function setwood_promoted_products( $per_page = '2', $columns = '2', $recent_fallback = true ) {
		if ( is_woocommerce_activated() ) {

			if ( wc_get_featured_product_ids() ) {

				echo '<h2>' . esc_html__( 'Featured Products', 'setwood' ) . '</h2>';

				echo setwood_do_shortcode( 'featured_products', array(
											'per_page' 	=> $per_page,
											'columns'	=> $columns,
										) );
			} elseif ( wc_get_product_ids_on_sale() ) {

				echo '<h2>' . esc_html__( 'On Sale Now', 'setwood' ) . '</h2>';

				echo setwood_do_shortcode( 'sale_products', array(
											'per_page' 	=> $per_page,
											'columns'	=> $columns,
										) );
			} elseif ( $recent_fallback ) {

				echo '<h2>' . esc_html__( 'New In Store', 'setwood' ) . '</h2>';

				echo setwood_do_shortcode( 'recent_products', array(
											'per_page' 	=> $per_page,
											'columns'	=> $columns,
										) );
			}
		}
	}
}

/**
 * The search callback function for the handheld footer bar
 * @since 2.0.0
 */
function setwood_handheld_footer_bar_search() {
	echo '<a href="#">' . esc_attr__( 'Search', 'setwood' ) . '</a>';
	setwood_product_search();
}

if ( ! function_exists( 'setwood_recent_products' ) ) {
    /**
     * Display Recent Products
     * Hooked into the `homepage` action in the homepage template
     *
     * @since  1.0.0
     * @param array $args the product section args.
     * @return void
     */
    function setwood_recent_products( $args ) {

        if ( is_woocommerce_activated() ) {

            $args = apply_filters( 'setwood_recent_products_args', array(
                'limit' 			=> 4,
                'columns' 			=> 4,
                'title'				=> __( 'New In', 'setwood' ),
            ) );

            echo '<section class="setwood-product-section setwood-recent-products">';

            do_action( 'setwood_homepage_before_recent_products' );

            echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

            do_action( 'setwood_homepage_after_recent_products_title' );

            echo setwood_do_shortcode( 'recent_products', array(
                'per_page' => intval( $args['limit'] ),
                'columns'  => intval( $args['columns'] ),
            ) );

            do_action( 'setwood_homepage_after_recent_products' );

            echo '</section>';
        }
    }
}

if ( ! function_exists( 'setwood_featured_products' ) ) {
    /**
     * Display Featured Products
     * Hooked into the `homepage` action in the homepage template
     *
     * @since  1.0.0
     * @param array $args the product section args.
     * @return void
     */
    function setwood_featured_products( $args ) {

        if ( is_woocommerce_activated() ) {

            $args = apply_filters( 'setwood_featured_products_args', array(
                'limit'   => 4,
                'columns' => 4,
                'orderby' => 'date',
                'order'   => 'desc',
                'title'   => __( 'We Recommend', 'setwood' ),
            ) );

            echo '<section class="setwood-product-section setwood-featured-products">';

            do_action( 'setwood_homepage_before_featured_products' );

            echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

            do_action( 'setwood_homepage_after_featured_products_title' );

            echo setwood_do_shortcode( 'featured_products', array(
                'per_page' => intval( $args['limit'] ),
                'columns'  => intval( $args['columns'] ),
                'orderby'  => esc_attr( $args['orderby'] ),
                'order'    => esc_attr( $args['order'] ),
            ) );

            do_action( 'setwood_homepage_after_featured_products' );

            echo '</section>';
        }
    }
}

if ( ! function_exists( 'setwood_popular_products' ) ) {
    /**
     * Display Popular Products
     * Hooked into the `homepage` action in the homepage template
     *
     * @since  1.0.0
     * @param array $args the product section args.
     * @return void
     */
    function setwood_popular_products( $args ) {

        if ( is_woocommerce_activated() ) {

            $args = apply_filters( 'setwood_popular_products_args', array(
                'limit'   => 4,
                'columns' => 4,
                'title'   => __( 'Fan Favorites', 'setwood' ),
            ) );

            echo '<section class="setwood-product-section setwood-popular-products">';

            do_action( 'setwood_homepage_before_popular_products' );

            echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

            do_action( 'setwood_homepage_after_popular_products_title' );

            echo setwood_do_shortcode( 'top_rated_products', array(
                'per_page' => intval( $args['limit'] ),
                'columns'  => intval( $args['columns'] ),
            ) );

            do_action( 'setwood_homepage_after_popular_products' );

            echo '</section>';
        }
    }
}

if ( ! function_exists( 'setwood_on_sale_products' ) ) {
    /**
     * Display On Sale Products
     * Hooked into the `homepage` action in the homepage template
     *
     * @param array $args the product section args.
     * @since  1.0.0
     * @return void
     */
    function setwood_on_sale_products( $args ) {

        if ( is_woocommerce_activated() ) {

            $args = apply_filters( 'setwood_on_sale_products_args', array(
                'limit'   => 4,
                'columns' => 4,
                'title'   => __( 'On Sale', 'setwood' ),
            ) );

            echo '<section class="setwood-product-section setwood-on-sale-products">';

            do_action( 'setwood_homepage_before_on_sale_products' );

            echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

            do_action( 'setwood_homepage_after_on_sale_products_title' );

            echo setwood_do_shortcode( 'sale_products', array(
                'per_page' => intval( $args['limit'] ),
                'columns'  => intval( $args['columns'] ),
            ) );

            do_action( 'setwood_homepage_after_on_sale_products' );

            echo '</section>';
        }
    }
}


if ( ! function_exists( 'setwood_woocommerce_init_structured_data' ) ) {
  /**
   * Generate product category structured data...
   * Hooked into the `woocommerce_before_shop_loop_item` action...
   * Apply the `setwood_woocommerce_structured_data` filter hook for structured data customization...
   */
  function setwood_woocommerce_init_structured_data() {
    if ( ! is_product_category() ) {
      return;
    }
    global $product;
    $json['@type']             = 'Product';
    $json['@id']               = 'product-' . get_the_ID();
    $json['name']              = get_the_title();
    $json['image']             = wp_get_attachment_url( $product->get_image_id() );
    $json['description']       = get_the_excerpt();
    $json['url']               = get_the_permalink();
    $json['sku']               = $product->get_sku();
    $json['brand']             = array(
      '@type'                  => 'Thing',
      'name'                   => $product->get_attribute( __( 'brand', 'setwood' ) )
    );
    
    if ( $product->get_rating_count() ) {
      $json['aggregateRating'] = array(
        '@type'                => 'AggregateRating',
        'ratingValue'          => $product->get_average_rating(),
        'ratingCount'          => $product->get_rating_count(),
        'reviewCount'          => $product->get_review_count()
      );
    }
    
    $json['offers']            = array(
      '@type'                  => 'Offer',
      'priceCurrency'          => get_woocommerce_currency(),
      'price'                  => $product->get_price(),
      'itemCondition'          => 'http://schema.org/NewCondition',
      'availability'           => 'http://schema.org/' . $stock = ( $product->is_in_stock() ? 'InStock' : 'OutOfStock' ),
      'seller'                 => array(
        '@type'                => 'Organization',
        'name'                 => get_bloginfo( 'name' )
      )
    );
    
    if ( ! isset( $json ) ) {
      return;
    }
    
    Setwood::set_structured_data( apply_filters( 'setwood_woocommerce_structured_data', $json ) );
  }
}
