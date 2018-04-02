<?php
/**
 * Setwood  functions.
 *
 * @package setwood
 */

/* 	Get theme option function */
if ( !function_exists( 'setwood_get_option' ) ):
    function setwood_get_option( $option ) {
        return Setwood_Kirki::get_option( 'setwood_settings', $option );
    }
endif;

/**
 * Query WooCommerce activation
 */
function is_woocommerce_activated() {
    return class_exists( 'woocommerce' ) ? true : false;
}

/**
 * Call a shortcode function by tag name.
 *
 * @since  1.4.6
 *
 * @param string $tag     The shortcode whose function to call.
 * @param array  $atts    The attributes to pass to the shortcode function. Optional.
 * @param array  $content The shortcode's content. Default is null (none).
 *
 * @return string|bool False on failure, the result of the shortcode on success.
 */
function setwood_do_shortcode( $tag, array $atts = array(), $content = null ) {

    global $shortcode_tags;

    if ( ! isset( $shortcode_tags[ $tag ] ) ) {
        return false;
    }

    return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
}

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function setwood_widget_tag_cloud_args( $args ) {
    $args['largest'] = 0.857;
    $args['smallest'] = 0.857;
    $args['number'] = 10; //Limit number of tags
    $args['unit'] = 'em';
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'setwood_widget_tag_cloud_args' );

/**
 * Adjust a hex color brightness
 * Allows us to create hover styles for custom link colors
 *
 * @param  strong  $hex   hex color e.g. #111111.
 * @param  integer $steps factor by which to brighten/darken ranging from -255 (darken) to 255 (brighten).
 * @return string        brightened/darkened hex color
 * @since  1.0.0
 */
function setwood_adjust_color_brightness( $hex, $steps ) {
	// Steps should be between -255 and 255. Negative = darker, positive = lighter.
	$steps  = max( -255, min( 255, $steps ) );

	// Format the hex color string.
	$hex    = str_replace( '#', '', $hex );

	if ( 3 == strlen( $hex ) ) {
		$hex    = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Get decimal values.
	$r  = hexdec( substr( $hex, 0, 2 ) );
	$g  = hexdec( substr( $hex, 2, 2 ) );
	$b  = hexdec( substr( $hex, 4, 2 ) );

	// Adjust number of steps and keep it inside 0 to 255.
	$r  = max( 0, min( 255, $r + $steps ) );
	$g  = max( 0, min( 255, $g + $steps ) );
	$b  = max( 0, min( 255, $b + $steps ) );

	$r_hex  = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
	$g_hex  = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
	$b_hex  = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );

	return '#' . $r_hex . $g_hex . $b_hex;
}

/* Include simple numeric pagination */
if ( !function_exists( 'setwood_pagination' ) ):
    function setwood_pagination( $prev = '&lsaquo;', $next = '&rsaquo;' ) {
        global $wp_query, $wp_rewrite;
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
        $pagination = array(
            'base' => @add_query_arg( 'paged', '%#%' ),
            'format' => '',
            'total' => $wp_query->max_num_pages,
            'current' => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type' => 'plain'
        );
        if ( $wp_rewrite->using_permalinks() )
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

        if ( !empty( $wp_query->query_vars['s'] ) )
            $pagination['add_args'] = array( 's' => str_replace( ' ', '+', get_query_var( 's' ) ) );

        $links = paginate_links( $pagination );

        if ( $links ) {
            return $links;
        }
    }
endif;


/* Get All Translation Strings */
if ( !function_exists( 'setwood_get_translate_options' ) ):
    function setwood_get_translate_options() {
        global $setwood_translate;
        get_template_part( 'inc/translate' );
        $translate = apply_filters( 'setwood_modify_translate_options', $setwood_translate );
        return $translate;
    }
endif;


/* Trim chars of string */
if ( !function_exists( 'setwood_trim_chars' ) ):
    function setwood_trim_chars( $string, $limit, $more = '...' ) {

        if ( !empty( $limit ) && strlen( $string ) > $limit ) {
            $last_space = strrpos( substr( $string, 0, $limit ), ' ' );
            $string = substr( $string, 0, $last_space );
            $string = rtrim( $string, ".,-?!" );
            $string.= $more;
        }

        return $string;
    }
endif;

/* Compress CSS Code  */
if ( !function_exists( 'setwood_compress_css_code' ) ) :
    function setwood_compress_css_code( $code ) {

        // Remove Comments
        $code = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $code );

        // Remove tabs, spaces, newlines, etc.
        $code = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $code );

        return $code;
    }
endif;

/**
 * Get post excerpt
 *
 * Function outputs post excerpt for specific layout
 *
 * @param string  $layout     Layout ID
 * @return string HTML output of category links
 * @since  1.0
 */

if ( !function_exists( 'setwood_get_excerpt' ) ):
	function setwood_get_excerpt( $layout = 'grid' , $readmore = 'true' ) {
        // Get global post data
        global $post;
        $post_layout = setwood_get_post_entry_layout();
		$manual_excerpt = false;
		if ( has_excerpt() ) {
			$content =  the_excerpt();
			$manual_excerpt = true;
		} else {
			$text = get_the_content( '' );
			$text = strip_shortcodes( $text );
			$text = apply_filters( 'the_content', $text );
			$content = str_replace( ']]>', ']]&gt;', $text );
		}

		if ( !empty( $content ) ) {
			$limit = setwood_get_option( $post_layout.'_excerpt_length' );
			if ( !empty( $limit ) || !$manual_excerpt ) {
				$more = setwood_get_option( $post_layout.'_excerpt_more' );
                // Generate excerpt
				$content = wp_trim_words( strip_shortcodes( get_the_content( $post->ID ) ), $limit );
			    //$content = wp_trim_words( strip_shortcodes( apply_filters('the_content', get_the_content( $post->ID ), $limit )));
                // Remove url
                $content = preg_replace( '/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $content );
                
                $readmore_link = sprintf( '<div class="read-more"><a href="%1$s">%2$s <i class="fa fa-angle-right"></i></a></div>',
		        esc_url( get_permalink( get_the_ID() ) ),    
                /* translators: %s: Name of current post */
                sprintf( esc_html__( 'Read More %s', 'setwood' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
                );
                
                // Display readmore link to excerpt if enabled in customizer options
                if ( true == setwood_get_option( $post_layout.'_show_readmore_link' ) ) :
                    $content .= $readmore_link;
                endif;
			}
            
			return wpautop( $content );
		}

	}
endif;

/**
 * Remove more link but add if manual excerpt enabled
 *
 * @since 1.5.2
 */
function setwood_remove_readmore_link( $link ) {

$post_layout = setwood_get_post_entry_layout();

if ( true == setwood_get_option( $post_layout.'_show_readmore_link' ) ) :
	
	return sprintf( '<div class="read-more"><a href="%1$s">%2$s <i class="fa fa-angle-right"></i></a></div>',
	esc_url( get_permalink( get_the_ID() ) ),    
    /* translators: %s: Name of current post */
    sprintf( esc_html__( 'Read More %s', 'setwood' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
    );
	
endif;

return null;

}

add_filter( 'the_content_more_link', 'setwood_remove_readmore_link' );


/* Check if post is paginated */
if ( !function_exists( 'setwood_is_paginated_post' ) ):
    function setwood_is_paginated_post() {

        global $multipage;
        return 0 !== $multipage;

    }
endif;

/* Pull audio video or gallery from the post content */

if ( !function_exists( 'setwood_get_post_media' ) ):
    function setwood_get_post_media( $format ) {
        $media = '';
        
        if ( empty( $format ) )
            return $media;
        
        $media = hybrid_media_grabber( array( 'type' => $format, 'split_media' => true ) );
        
        if ( $format == 'quote' ) {
            global $post;
            $content = get_the_content();
            // check and retrieve blockquote
            if(preg_match('~<blockquote>([\s\S]+?)</blockquote>~', $content, $matches))
            // output blockquote
            $quote = '<blockquote>'.$matches[1];'</blockquote>';
            return $quote;
        }
        
        return $media;
    }   
endif;

/* Filter Quote */
add_filter( 'the_content', 'filter_quote_content', 10);

function filter_quote_content( $content ) {

	/* Check if we're displaying a 'quote' post. */
	if ( has_post_format( 'quote' ) ) {

		/* Match any <blockquote> elements. */
		preg_match( '~<blockquote>([\s\S]+?)</blockquote>~', $content, $matches );

		/* If no <blockquote> elements were found, wrap the entire content in one. */
		if ( ( $matches ) )
			$content = str_replace($matches,"",$content);
	}

	return $content;
}

/* Get featured image */
if ( !function_exists( 'setwood_get_featured_image' ) ) :
	function setwood_get_featured_image( $img_size = false ) {

		$img = '';

		if ( !$img_size ) {
			$img_size = setwood_has_sidebar() ? 'post-thumbnail' : 'setwood-full-width';
		}

		$img = get_the_post_thumbnail( get_the_ID(), $img_size );

		if ( empty( $img ) && $defimg = setwood_get_option( 'default_fimg' ) ) {

				$img = '<img src="'.esc_url( $defimg ).'" alt="'.esc_attr( get_the_title() ).'" class="attachment-setwood-thumb wp-post-image"/>';
			}

			return $img;
		}
	endif;

/**
 * Get image ID from URL
 *
 * It gets image/attachment ID based on URL
 *
 * @param string  $image_url URL of image/attachment
 * @return int|bool Attachment ID or "false" if not found
 * @since  1.0
 */

function setwood_get_image_id_by_url( $image_url ) {
	$attachment_id = 0;
	$dir = wp_upload_dir();
	if ( false !== strpos( $image_url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
		$file = basename( $image_url );
		$query_args = array(
			'post_type'   => 'attachment',
			'post_status' => 'inherit',
			'fields'      => 'ids',
			'meta_query'  => array(
				array(
					'value'   => $file,
					'compare' => 'LIKE',
					'key'     => '_wp_attachment_metadata',
				),
			)
		);
		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) {
			foreach ( $query->posts as $post_id ) {
				$meta = wp_get_attachment_metadata( $post_id );
				$original_file       = basename( $meta['file'] );
				$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
				if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
					$attachment_id = $post_id;
					break;
				}
			}
		}
	}
	return $attachment_id;
}

/**
 * Get featured image url
 *
 * Function gets featured image depending on the size and post id.
 * If image is not set, it gets the default featured image placehloder from theme options.
 *
 * @param string  $size      Image size ID
 * @param int     $post_id   Post ID - if not passed it gets current post id by default
 * @param bool    $ignore_default_img Wheter to apply default featured image post doesn't have featured image
 * @return string Image HTML output
 * @since  1.0
 */

if ( !function_exists( 'setwood_get_featured_image_url' ) ):
	/**
 * Returns just the URL of an image attachment.
 *
 * @param int $image_id The Attachment ID of the desired image.
 * @param string $size The size of the image to return.
 * @return bool|string False on failure, image URL on success.
 */
function setwood_get_featured_image_url( $image_id, $size ) {
	$img_attr = wp_get_attachment_image_src( intval( $image_id ), $size );
	if ( ! empty( $img_attr[0] ) ) {
		return $img_attr[0];
	}
}
endif;

/**
 * Get meta options
 *
 * @param   array $default Enable defaults i.e. array('date', 'comments')
 * @return array List of available options
 * @since  1.0
 */

if ( !function_exists( 'setwood_get_meta_opts' ) ):
	function setwood_get_meta_opts(	$default = array() ) {

		$options = array();

		$options['date'] = esc_html__( 'Date', 'setwood' );
		$options['comments'] = esc_html__( 'Comments', 'setwood' );
		$options['author'] = esc_html__( 'Author', 'setwood' );
		$options['views'] = esc_html__( 'Views', 'setwood' );

		if(!empty($default)){
			foreach($options as $key => $option){
				if(in_array( $key, $default)){
					$options[$key] = 1;
				} else {
					$options[$key] = 0;
				}
			}
		}

		return $options;
	}
endif;


/**
 * Returns current page or post layout
 *
 * @since 1.0.0
 */
function setwood_get_post_layout() {

	// Check URL
	if ( ! empty( $_GET['post_layout'] ) ) {
		return $_GET['post_layout'];
	}

	// Get post ID
	$post_id = setwood_get_the_id();

	// Set default layout
	$layout = 'right-sidebar';

	// Posts
	if ( is_page() ) {
		$layout = setwood_get_option('layout_page');
	}

	// Posts
	elseif ( is_singular() ) {
		$layout = setwood_get_option('layout_single');
	}

	// Full-width pages
	if ( is_404()
		|| is_page_template( 'template-homepage.php' )
	) {
		$layout = 'full-width';
	}

	// Homepage
	elseif ( is_home() || is_front_page() ) {
		$layout = setwood_get_option('layout_home');
	}

	// Search
	elseif ( is_search() ) {
		$layout = setwood_get_option('layout_search');
	}

	// Archive
	elseif ( is_archive() ) {
		$layout = setwood_get_option('layout_archive');
	}
    
	// Apply filters
	$layout = apply_filters( 'setwood_post_layout', $layout );

	// Check meta

    $meta = get_post_meta( setwood_get_the_id(), '_page_layout', true );
      // Get if set and not set to inherit
      if ( isset($meta) && !empty($meta) && $meta != 'inherit' ) { 
        $layout = $meta;
      }
    
    if (is_woocommerce_activated()) {
        if ( setwood_is_woo_single() ) {
            $layout = setwood_get_option( 'layout_product_single', 'full-width' );
        }
        elseif ( setwood_is_woo_shop() || setwood_is_woo_tax() ) {
            $layout = setwood_get_option( 'layout_product_archive', 'full-width' );
        }
        elseif ( is_cart() || is_checkout() ) {
            $layout = setwood_get_option( 'layout_product_page', 'full-width' );
        }
    }
	// Sanitize
	$layout = $layout ? $layout : 'right-sidebar';

	// Return layout
	return $layout;

}

/* Print custom CSS code if specified in theme options  */

add_action( 'wp_head', 'setwood_wp_head', 99 );

if ( !function_exists( 'setwood_wp_head' ) ):
	function setwood_wp_head() {

		//Additional CSS (if user adds his custom css inside theme options)
		$custom_css = trim( preg_replace( '/\s+/', ' ', setwood_get_option( 'custom_css' ) ) );
		if ( !empty( $custom_css ) ) {
			echo '<style type="text/css">'.$custom_css.'</style>';
		}
	}
endif;

/* For advanced use - custom JS code into footer if specified in theme options */

add_action( 'wp_footer', 'setwood_wp_footer', 99 );

if ( !function_exists( 'setwood_wp_footer' ) ):
	function setwood_wp_footer() {

		//Additional JS
		$custom_js = trim( preg_replace( '/\s+/', ' ', setwood_get_option( 'custom_js' ) ) );
		if ( !empty( $custom_js ) ) {
			echo '<script type="text/javascript">
				/* <![CDATA[ */
					'.$custom_js.'
				/* ]]> */
				</script>';
		}

	}
endif;


/**
 * WP Instagram Widget Customization
 */

add_filter( 'wpiw_link_class', 'setwood_instagram_class' );

function setwood_instagram_class( $classes ) {
    $classes = "footer-instagram-title";
    return $classes;
}

/**
 * Get first post with featured image in current query
 *
 * @since 1.0.0
 */
function setwood_get_featured_post( $query = '' ) {
	if ( ! $query ) {
		global $wp_query;
		$query = $wp_query;
	}
	$posts = $query->posts;
	$posts_count = count( $posts );
	if ( $posts_count == 0 ) {
		return;
	}
	$post_with_thumb = 0;
	foreach ( $posts as $post ) {
		if ( has_post_thumbnail( $post->ID ) ) {
			$post_with_thumb = $post->ID;
			break;
		}
	}
	return $post_with_thumb;
}

/* Add classes to body tag */
if ( !function_exists( 'setwood_body_class' ) ):
	function setwood_body_class( $classes ) {

		//Add class if featured image is turned off
		if( ( is_single() && !setwood_get_option('show_fimg') ) || ( ( is_front_page() || is_archive() ) && !setwood_get_option('show_fimg') ) ){
			$classes[] = 'setwood-nofimg';
		}
		return $classes;
	}
endif;

add_filter( 'body_class', 'setwood_body_class' );

if(!function_exists('setwood_check_default_fimg_class')):
function setwood_check_default_fimg_class( $classes ) {
	if(setwood_get_option( 'default_fimg' )){
		$classes[] = 'has-post-thumbnail';
	}
	return $classes;
}
endif;

add_filter( 'post_class', 'setwood_check_default_fimg_class' );

/* Backwards support for wp title tag ( if version < wp 4.1) */
if ( ! function_exists( '_wp_render_title_tag' ) ) :

	if ( ! function_exists( 'setwood_render_title' ) ) :
		function setwood_render_title() { ?>
    <title>
        <?php wp_title( '|', true, 'right' ); ?>
    </title>
    <?php } ?>
        <?php endif; ?>

    <?php add_action( 'wp_head', 'setwood_render_title' );

	/* Add wp_title filter */
	if ( !function_exists( 'setwood_wp_title' ) ):
		function setwood_wp_title( $title, $sep ) {
			global $paged, $page;

			if ( is_feed() )
				return $title;

			// Add the site name.
			$title .= get_bloginfo( 'name' );

			// Add the site description for the home/front page.
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description && ( is_home() || is_front_page() ) )
				$title = "$title $sep $site_description";

			// Add a page number if necessary.
			if ( $paged >= 2 || $page >= 2 )
				$title = "$title $sep " . sprintf( __( 'Page %s', 'setwood' ), max( $paged, $page ) );

			return $title;
		}
	endif;

	add_filter( 'wp_title', 'setwood_wp_title', 10, 2 );

endif;

/**
 * Add classes to the site-main wrap
 *
 * @since 1.5.3
 */
function entry_classes() {

	// Setup classes array
	$classes = array();
    
    if ( is_main_query() ) {
        $classes[] = setwood_get_option( setwood_layout_prefix().'_post_layout');
        $classes[] = setwood_get_option( setwood_layout_prefix().'_grid_column');
    }
	
	// Apply filters for child theming
	$classes = apply_filters( 'entry_classes', $classes );

	// Turn classes into space seperated string
	$classes = implode( ' ', $classes );

	// return classes
	return $classes;
}

/**
 *
/* Add class to gallery images to run our pop-up
 */
if ( !function_exists( 'setwood_gallery_atts' ) ):
	function setwood_gallery_atts( $output, $pairs, $atts ) {

		if ( isset( $atts['link'] ) && $atts['link'] == 'file' ) {
			add_filter( 'wp_get_attachment_link', 'setwood_add_class_attachment_link', 10, 1 );
		} else {
			remove_filter( 'wp_get_attachment_link', 'setwood_add_class_attachment_link' );
		}

		if ( !isset( $output['columns'] ) ) {
			$output['columns'] = 1;
		}

		return $output;
	}
endif;

if ( !function_exists( 'setwood_add_class_attachment_link' ) ):
	function setwood_add_class_attachment_link( $link ) {
		$link = str_replace( '<a', '<a class="setwood-popup"', $link );
		return $link;
	}
endif;

add_filter( 'shortcode_atts_gallery', 'setwood_gallery_atts', 10, 3 );

/** * /* Add theme generated image sizes to media editor */ 
if ( !function_exists( 'setwood_add_sizes_media_editor' ) ): 
    function setwood_add_sizes_media_editor( $sizes ) {
        return array_merge( $sizes, array(
            'post-thumbnail' => esc_html__('Setwood Post Thumbnail' , 'setwood' ),
            'setwood-square-thumbnail' => esc_html__('Setwood Square Thumbnail' , 'setwood' ),
            'setwood-full-width' => esc_html__('Setwood Full Width' , 'setwood' ),
            'setwood-full-screen' => esc_html__('Setwood Full Screen' , 'setwood' ),
        ) );
    }
endif;

add_filter( 'image_size_names_choose', 'setwood_add_sizes_media_editor' );

/**
 *
 * Add media grabber features
 */
if ( !function_exists( 'setwood_add_media_grabber' ) ):
	function setwood_add_media_grabber() {
		if ( !class_exists( 'Hybrid_Media_Grabber' ) ) {
			include_once 'class-hybrid-media-grabber.php';
		}
	}
endif;

add_action( 'init', 'setwood_add_media_grabber' );

if(!function_exists('setwood_check_default_fimg_class')):
function setwood_check_default_fimg_class( $classes ) {
	if(!is_single() && setwood_get_option( 'show_fimg' ) && setwood_get_option( 'default_fimg' )){
		$classes[] = 'has-post-thumbnail';
	}
	return $classes;
}
endif;

add_filter( 'post_class', 'setwood_check_default_fimg_class' );

/**
 * Checks if on the WooCommerce shop page.
 *
 * @since 1.6.0
 */
function setwood_is_woo_shop() {
	if ( ! is_woocommerce_activated() ) {
		return false;
	} elseif ( function_exists( 'is_shop' ) && is_shop() ) {
		return true;
	}
}

/**
 * Checks if on a WooCommerce tax.
 *
 * @since 1.6.0
 */
if ( ! function_exists( 'setwood_is_woo_tax' ) ) {
	function setwood_is_woo_tax() {
		if ( ! is_woocommerce_activated() ) {
			return false;
		} elseif ( ! is_tax() ) {
			return false;
		} elseif ( function_exists( 'is_product_category' ) && function_exists( 'is_product_tag' ) ) {
			if ( is_product_category() || is_product_tag() ) {
				return true;
			}
		}
	}
}

/**
 * Checks if on singular WooCommerce product post.
 *
 * @since 1.6.0
 */
function setwood_is_woo_single() {
	if ( ! is_woocommerce_activated() ) {
		return false;
	} elseif ( is_woocommerce() && is_singular( 'product' ) ) {
		return true;
	}
}

/*
function setwood_remove_hentry( $classes ) {
    if ( is_sticky() ) {
        $classes = array_diff( $classes, array( 'hentry' ) );
    }
    return $classes;
}
add_filter( 'post_class','setwood_remove_hentry' );
*/

/**
 * Remove Post Classes

function setwood_post_classes( $classes ) {
    $class_key = array_search( 'has-post-thumbnail', $classes );
 
    if ( false !== $class_key ) {
        unset( $classes[ $class_key ] );
    }
 
    return $classes;
}
add_filter( 'post_class', 'setwood_post_classes' );
 */

/**
 * Set thumbnail size based on settings
 *
 * @since 1.0
 */

function setwood_get_entry_image_size () {
    global $is_setwood_featured_post;
    $size = 'post-thumbnail';
    $post_layout = setwood_get_post_entry_layout();
	if ( $is_setwood_featured_post ) {
		$size = 'setwood-full-width';
    }
    if ( $post_layout == 'standard' ) {
		$size = 'setwood-full-width';
    }
    if ( $post_layout == 'list' ) {
		$size = 'setwood-square-thumbnail';
    }
    return apply_filters( 'setwood_get_entry_image_size', $size );
}

/**
 * Load styles into the editor
 *
 * @since 1.0
 */

function setwood_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'setwood_add_editor_styles' );
