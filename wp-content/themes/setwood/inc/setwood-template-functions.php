<?php
/**
 * Setwood template functions.
 *
 * @package setwood
 */

if ( ! function_exists( 'setwood_display_comments' ) ) {
    /**
     * Setwood display comments
     *
     * @since  1.0.0
     */
    function setwood_display_comments() {
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || '0' != get_comments_number() ) :
            comments_template();
        endif;
    }
}

if ( ! function_exists( 'setwood_comment' ) ) {
    /**
     * Setwood comment template
     *
     * @param array $comment the comment array.
     * @param array $args the comment args.
     * @param int   $depth the comment depth.
     * @since 1.0.0
     */
    function setwood_comment( $comment, $args, $depth ) {
        if ( 'div' == $args['style'] ) {
            $tag = 'div';
            $add_below = 'comment';
        } else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
        ?>
        <<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
        <div class="comment-body">
        
            <div class="comment-author vcard">
            <?php echo get_avatar( $comment, 128 ); ?>
            </div>
        
        <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-content">
        <?php endif; ?>
        <div class="comment-text">

            <div class="comment-meta commentmetadata">
            <?php printf( wp_kses_post( '<cite class="fn">%s</cite>', 'setwood' ), get_comment_author_link() ); ?>
            <?php if ( '0' == $comment->comment_approved ) : ?>
                <em class="comment-awaiting-moderation"><?php esc_attr_e( 'Your comment is awaiting moderation.', 'setwood' ); ?></em>
                <br />
            <?php endif; ?>
            <a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>" class="comment-date">
                <?php echo '<time datetime="' . get_comment_date( 'c' ) . '">' . get_comment_date() . '</time>'; ?>
            </a>
            </div>

        <?php comment_text(); ?>
        </div>
        <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        <?php edit_comment_link( esc_html( 'Edit', 'setwood' ), '  ', '' ); ?>
        </div>
        </div>
        <?php if ( 'div' != $args['style'] ) : ?>
        </div>
        <?php endif; ?>
    <?php
    }
}

if ( ! function_exists( 'setwood_credit' ) ) {
    /**
     * Display the theme credit
     *
     * @since  1.0.0
     * @return void
     */
    function setwood_credit() {
        $allowed_html = array(
			'a' => array(
				'href' => array(),
				'title' => array(),
				'target' => array(),
			),
			'br' => array(),
			'em' => array(),
			'strong' => array(),
		);
        ?>
        <div class="site-info">
            <div class="col-full">
                <?php echo wp_kses( get_theme_mod( 'footer_text','Setwood. All Right Reserved. by Macrodreams' ) , $allowed_html ); ?>
            </div>
        </div><!-- .site-info -->
        <!--div class="go-to-top-parent"><a href="#" class="go-to-top"><span><i class="fa fa-angle-up"></i><br>Back To Top</span></a></div-->
        <?php
    }
}

if ( ! function_exists( 'setwood_featured_widgets' ) ) {
    /**
     * Display the featured widget regions
     *
     * @since  1.0.0
     * @return  void
     */
    function setwood_featured_widgets() {
        if (is_home() || is_front_page()) {
            if ( is_active_sidebar( 'featured-4' ) ) {
                $widget_columns = apply_filters( 'setwood_featured_widget_regions', 4 );
            } elseif ( is_active_sidebar( 'featured-3' ) ) {
                $widget_columns = apply_filters( 'setwood_featured_widget_regions', 3 );
            } elseif ( is_active_sidebar( 'featured-2' ) ) {
                $widget_columns = apply_filters( 'setwood_featured_widget_regions', 2 );
            } elseif ( is_active_sidebar( 'featured-1' ) ) {
                $widget_columns = apply_filters( 'setwood_featured_widget_regions', 1 );
            } else {
                $widget_columns = apply_filters( 'setwood_featured_widget_regions', 0 );
            }

            if ( $widget_columns > 0 ) : ?>

                <div class="featured-widgets col-<?php echo intval( $widget_columns ); ?> clearfix">

                    <?php
                    $i = 0;
                    while ( $i < $widget_columns ) : $i++;
                        if ( is_active_sidebar( 'featured-' . $i ) ) : ?>

                            <div class="block featured-widget-<?php echo intval( $i ); ?>">
                                <?php dynamic_sidebar( 'featured-' . intval( $i ) ); ?>
                            </div>

                        <?php endif;
                    endwhile; ?>

                </div><!-- /.featured-widgets  -->

            <?php endif;
        }
    }
}

if ( ! function_exists( 'setwood_footer_widgets' ) ) {
    /**
     * Display the footer widget regions
     *
     * @since  1.0.0
     * @return  void
     */
    function setwood_footer_widgets() {
        if ( is_active_sidebar( 'footer-4' ) ) {
            $widget_columns = apply_filters( 'setwood_footer_widget_regions', 4 );
        } elseif ( is_active_sidebar( 'footer-3' ) ) {
            $widget_columns = apply_filters( 'setwood_footer_widget_regions', 3 );
        } elseif ( is_active_sidebar( 'footer-2' ) ) {
            $widget_columns = apply_filters( 'setwood_footer_widget_regions', 2 );
        } elseif ( is_active_sidebar( 'footer-1' ) ) {
            $widget_columns = apply_filters( 'setwood_footer_widget_regions', 1 );
        } else {
            $widget_columns = apply_filters( 'setwood_footer_widget_regions', 0 );
        }

        if ( $widget_columns > 0 ) : ?>

            <div class="footer-widgets col-<?php echo intval( $widget_columns ); ?> fix">
            <div class="col-full">
                <?php
                $i = 0;
                while ( $i < $widget_columns ) : $i++;
                    if ( is_active_sidebar( 'footer-' . $i ) ) : ?>

                        <div class="block footer-widget-<?php echo intval( $i ); ?>">
                            <?php dynamic_sidebar( 'footer-' . intval( $i ) ); ?>
                        </div>

                    <?php endif;
                endwhile; ?>
            </div>
            </div><!-- /.footer-widgets  -->

        <?php endif;
    }
}

if ( ! function_exists( 'setwood_header_widget_region' ) ) {
    /**
     * Display header widget region
     *
     * @since  1.0.0
     */
    function setwood_header_widget_region() {
        if (is_home() || is_front_page()) {
            if ( is_active_sidebar( 'header-1' ) ) {
            ?>
            <div class="header-widget-region" role="complementary">
                <div class="col-full">
                    <?php dynamic_sidebar( 'header-1' ); ?>
                </div>
            </div>
            <?php
            }
        }
    }
}

if ( ! function_exists( 'setwood_instagram_footer' ) ) {
    /**
     * Display header widget region
     *
     * @since  1.0.0
     */
    function setwood_instagram_footer() {
        if ( is_active_sidebar( 'instagram-footer' ) ) {
        ?>
        <div class="instagram-footer-widget-region col-wide" role="complementary">
                <?php dynamic_sidebar( 'instagram-footer' ); ?>
        </div>
        <?php
        }
    }
}


if ( ! function_exists( 'setwood_site_branding' ) ) {
    /**
     * Display Site Branding
     *
     * @since  1.4.1
     * @return void
     */
    function setwood_site_branding() {
        ?>
        <div class="site-branding">
            <?php setwood_site_title_or_logo(); ?>
        </div>
        <?php
    }
}

if ( ! function_exists( 'setwood_site_title_or_logo' ) ) {
    /**
     * Display the site title or logo
     *
     * @since  1.4.1
     * @return void
     */
    function setwood_site_title_or_logo() {
        
        $logo = setwood_get_option('logo');
        $brand = !empty($logo) ? '<img class="setwood-logo" src="'.esc_url( $logo ).'" alt="'.esc_attr(get_bloginfo( 'name' )).'" >' : get_bloginfo( 'name' );
        ?>
        <?php if ( is_front_page() && is_home() ) : ?>
            <div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo $brand; ?></a></div>
        <?php else : ?>
            <span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo $brand; ?></a></span>
        <?php endif; ?>
        <?php if ( true == setwood_get_option( 'site_description' ) ) : ?>
            <p class="site-description"><?php bloginfo( 'description' );?></p>
        <?php endif;
        }
}


/**
 * Apply inline style to the Setwood header.
 *
 * @uses  get_header_image()
 * @since  2.0.0
 */
function setwood_header_styles() {
	$styles = apply_filters( 'setwood_header_styles', array(
		'background-image' => 'url(' . esc_url( get_header_image() ) . ')',
	) );

	foreach ( $styles as $style => $value ) {
		echo esc_attr( $style . ': ' . $value . '; ' );
	}
}

if ( ! function_exists( 'setwood_primary_navigation' ) ) {
    /**
     * Display Primary Navigation
     *
     * @since  1.0.0
     * @return void
     */
    function setwood_primary_navigation() {
        ?>
        <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'setwood' ); ?>">
			<?php 
            wp_nav_menu(
                array(
                    'theme_location'	  => 'primary',
                    'container_class'     => 'primary-navigation',
                    'container_id'        => 'primary-navigation',
                    )
            );
            ?>
            <?php 
            wp_nav_menu(
                array(
                    'theme_location'      => 'handheld',
                    'container_class'     => 'handheld-navigation',
                    'container_id'        => 'handheld-navigation',
                    'fallback_cb'         => '',
                    )
            );
            ?>
        </nav><!-- #site-navigation -->
        <?php
    }
}

if ( ! function_exists( 'setwood_secondary_navigation' ) ) {
    /**
     * Display Secondary Navigation
     *
     * @since  1.0.0
     * @return void
     */
    function setwood_secondary_navigation() {
        ?>
        <nav class="secondary-navigation" aria-label="<?php esc_html_e( 'Secondary Navigation', 'setwood' ); ?>">
            <?php
                wp_nav_menu(
                    array(
                        'theme_location'	=> 'secondary',
                        'fallback_cb'		=> '',
                    )
                );
            ?>
        </nav><!-- #site-navigation -->
        <?php
    }
}

if ( ! function_exists( 'setwood_site_branding_mini' ) ) {
    /**
     * Display Primary Navigation
     *
     * @since  1.0.0
     * @return void
     */
    function setwood_site_branding_mini() {
        ?>
    
        <div class="site-branding-mini">
        <?php
            $logo_mini = setwood_get_option('logo_mini');
            $brand = !empty($logo_mini) ? '<img class="setwood-logo-mini" src="'.esc_url( $logo_mini ).'" alt="'.esc_attr(get_bloginfo( 'name' )).'" >' : get_bloginfo( 'name' );
        ?>
	   <span class="site-title beta"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo $brand; ?></a></span></div>
        <?php
    }
}

if ( ! function_exists( 'setwood_skip_links' ) ) {
    /**
     * Skip links
     *
     * @since  1.4.1
     * @return void
     */
    function setwood_skip_links() {
        ?>
        <a class="skip-link screen-reader-text" href="#site-navigation"><?php esc_attr_e( 'Skip to navigation', 'setwood' ); ?></a>
        <a class="skip-link screen-reader-text" href="#content"><?php esc_attr_e( 'Skip to content', 'setwood' ); ?></a>
        <?php
    }
}

if ( ! function_exists( 'setwood_page_header' ) ) {
    /**
     * Display the post header with a link to the single post
     *
     * @since 1.0.0
     */
    function setwood_page_header() {
        ?>
        <header class="page-header">
            <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->
        <?php
    }
}

if ( ! function_exists( 'setwood_page_content' ) ) {
    /**
     * Display the page content with a link to the single post
     *
     * @since 1.0.0
     */
    function setwood_page_content() {
        ?>
        <div class="entry-content">
            <?php the_content(); ?>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'setwood' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div><!-- .entry-content -->
        <?php
    }
}

if ( ! function_exists( 'setwood_post_header' ) ) {
    /**
     * Display the post header with a link to the single post
     * @since 1.0.0
     */
    function setwood_post_header() { ?>
        <header class="entry-header">
        <?php $post_layout = setwood_get_option( setwood_layout_prefix().'_post_layout' ); ?>
        <?php
        if ( is_single() ) {
            if (setwood_get_option( 'single_show_cat' )) {
                setwood_post_categories();
            }
            the_title( '<h1 class="entry-title">', '</h1>' );
        } else {
            
            if ( 'post' == get_post_type() ) {
                if (setwood_get_option( $post_layout.'_show_cat')) {
                setwood_post_categories();
                }
            }
            the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
        }
        ?>
        <p class="entry-meta-header meta">
            <?php
            setwood_posted_on();
            setwood_posted_by();
            ?>
        </p>
        </header><!-- .entry-header -->
        <?php
    }
}

if ( ! function_exists( 'setwood_post_content' ) ) {
    /**
     * Display the post content with a link to the single post
     * @since 1.0.0
     */
    function setwood_post_content() {
        ?>

        <div class="entry-content">
        <?php
        $metadados = get_post_meta( get_the_ID() );
                if (isset($metadados['_tp_mensagem'][0])) {
                    echo '<h3 class="dicas-subtitle">'.$metadados['_tp_mensagem'][0].'</h3>';
                }
        the_content(
            sprintf(
                esc_html__( 'Continue reading %s', 'setwood' ),
                '<span class="screen-reader-text">' . get_the_title() . '</span>'
            )
        );

        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'setwood' ),
            'after'  => '</div>',
        ) );
        ?>
        </div><!-- .entry-content -->
        <?php
    }
}

if ( ! function_exists( 'setwood_loop_content' ) ) {
    /**
     * Display the post content with a link to the single post
     * @since 1.0.0
     */
    function setwood_loop_content() {
        ?>

        <div class="entry-content">
            <?php

            $content_type = setwood_get_option( setwood_get_post_entry_layout().'_content_type' );
            
            if( $content_type == 'excerpt' ) :
           
                // echo setwood_get_excerpt( setwood_get_post_entry_layout(), $readmore='true' );
                
                $metadados = get_post_meta( get_the_ID() );
                if (isset($metadados['_tp_mensagem'][0])) {
                    echo '<h3 class="dicas-subtitle">'.$metadados['_tp_mensagem'][0].'</h3>';
                } else {
                    echo setwood_get_excerpt( setwood_get_post_entry_layout(), $readmore='true' );
                }    
    
            else :
    
            the_content();
            
            endif;
            
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'setwood' ),
            'after'  => '</div>',
        ) );
        ?>
        </div><!-- .entry-content -->
        <?php
    }
}

if ( ! function_exists( 'setwood_post_meta_footer' ) ) {
    /**
     * Display the post meta in loop
     * @since 1.0.0
     */
    function setwood_post_meta_footer() {
        ?>
        <aside class="entry-meta-footer meta">
        <?php setwood_get_meta_data( setwood_get_post_entry_layout() ); ?>
        </aside>
        <?php
    }
}

if ( ! function_exists( 'setwood_wide_post_meta_footer' ) ) {
    /**
     * Display the post meta in single post
     * @since 1.0.0
     */
    function setwood_wide_post_meta_footer() {
        ?>
        <aside class="entry-meta-footer wide">
            <div class="meta-left meta">
            <?php setwood_get_meta_data( $layout = 'standard' ); ?>
            </div>
            <?php if (true == setwood_get_option( 'single_show_share' , true ) ) :
            get_template_part('inc/templates/social-sharing');
            endif; ?>
        </aside>
        <?php
    }
}

/*
**
 * Get post meta data
 *
 * Function outputs meta data HTML based on theme options for specifi layout
 *
 * @param string  $layout
 * @return string HTML output of meta data
 * @since  1.0
 */

if ( !function_exists( 'setwood_get_meta_data' ) ):
    function setwood_get_meta_data( $layout = 'standard', $force_meta = false ) {

        $meta_data = $force_meta !== false ? $force_meta : setwood_get_option( 'lay_'.$layout .'_meta' );
        $post_layout = setwood_get_post_entry_layout();

        if ($post_layout == '' & $force_meta == false ) { // Default if Kirki not activated
            setwood_comments();
        }
     
        $output = '';

        if ( !empty( $meta_data ) ) {

            foreach ( $meta_data as $meta_id ) {

                $meta = '';

                switch ( $meta_id ) {

                case 'date':
                    $meta = setwood_posted_on();
                    break;
                        
                case 'author':
                    $meta = setwood_posted_by();
                    break;

                case 'views':
                    $meta = setwood_post_views();
                    break;
                        
                case 'like':
                    $meta = setwood_like();
                    break;

                case 'share':
                    $meta = setwood_share_toggle();
                    break;

                case 'comments':
                    $meta = setwood_comments();
                    break;

                default:
                    break;
                }
            }
        }
        return $output;
    }
endif;

if ( ! function_exists( 'setwood_posted_on' ) ) {
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function setwood_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s">%4$s</time>';
		}

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( 'c' ) ),
            esc_html( get_the_modified_date() )
        );

        $posted_on = sprintf(
            _x( '%s', 'post date', 'setwood' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );


        echo wp_kses( apply_filters( 'setwood_single_post_posted_on_html', '<span class="posted-on">' . $posted_on . '</span>', $posted_on ), array(
            'span' => array(
                'class'  => array(),
            ),
            'a'    => array(
                'href'  => array(),
                'title' => array(),
                'rel'   => array(),
            ),
            'time' => array(
                'datetime' => array(),
                'class'    => array(),
            ),
         ) );
    }
}

if ( ! function_exists( 'setwood_posted_by' ) ) :
function setwood_posted_by() {

    $byline = sprintf(
        esc_html_x( 'by %s', 'post author', 'setwood' ),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );

    echo '<span class="byline">' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'setwood_post_categories' ) ) {
    /**
     * Display the post meta
     * @since 1.0.0
     */
    function setwood_post_categories() {

        // Hide category text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space */
		$categories_list = get_the_category_list( esc_html__( ' &frasl; ', 'setwood' ) );
		if ( $categories_list ) {
			printf( '<span class="cat-links">%1$s</span>', $categories_list ); // WPCS: XSS OK.
		}
	}

    }
}

if ( ! function_exists( 'setwood_post_tag' ) ) {
    /**
     * Display the tags
     * @since 1.0.0
     */
    function setwood_post_tag() {

        if ( 'post' == get_post_type() && true == setwood_get_option( 'single_show_tags' , 'true')) : // Hide category and tag text for pages on Search

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', esc_html__( '', 'setwood' ) );

            if ( $tags_list ) : ?>
                <span class="tags-links">
                    <?php
                    echo '<span class="screen-reader-text">' . esc_attr( __( 'Tags: ', 'setwood' ) ) . '</span>';
                    echo wp_kses_post( $tags_list );
                    ?>
                </span>
            <?php
            endif; // End if $tags_list
        endif; // End if 'post' == get_post_type()
    }
}

if ( ! function_exists( 'setwood_share_toggle' ) ) {
    /**
     * Display share icon
     * @since 1.0.0
     */
    function setwood_share_toggle() {
    ?>
    <span class="share-toggle"><span><i class="fa fa-share-alt"></i></span></span>
        <div class="share-box-wrapper">
             <?php get_template_part('inc/templates/social-sharing'); ?>
        </div>
    <?php
    }
}

if ( ! function_exists( 'setwood_comments' ) ) {
    /**
    * Display the Comments.
    */
    function setwood_comments() {
        if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) :

        global $is_setwood_featured_post;

        ?>

        <?php
        if ($is_setwood_featured_post || is_singular()) :
        ?>
        <span class="comments-link"><i class="fa fa-comments"></i><?php comments_popup_link( esc_html__( 'Comment', 'setwood' ), esc_html__( '1 Comment', 'setwood' ), esc_html__( '% Comments', 'setwood' ), esc_html__( 'Comments are Closed', 'setwood' ) );?></span>
        <?php    
            else :

        ?>
        <span class="comments-link"><i class="fa fa-comments"></i><?php comments_popup_link( esc_html__( '0', 'setwood' ), esc_html__( '1', 'setwood' ), esc_html__( '%', 'setwood' ), esc_html__( 'Comments are Closed', 'setwood' ) );?></span>
        <?php
        endif;   
        endif;
    }
}

if ( ! function_exists( 'setwood_paging_nav' ) ) {
    /**
     * Display navigation to next/previous set of posts when applicable.
     */
    function setwood_paging_nav() {
        global $wp_query;
        $pagination = setwood_get_option( setwood_layout_prefix().'_pagination');

        switch ( $pagination ) {
            /* Classic */
            case 'classic':
				$args = array(
                'next_text' => _x( 'Next', 'Newer posts', 'setwood' ) . '&nbsp;&nbsp;<i class="fa fa-angle-right"></i>',
                'prev_text' => '<i class="fa fa-angle-left"></i>&nbsp;&nbsp;' . _x( 'Previous', 'Older Posts', 'setwood' ),
                );
                the_posts_navigation( $args );
                break;
                /* Numeric */
            case 'numeric':
                $args = array(
                'type' 	    => 'list',
                'next_text' => _x( 'Next', 'Next post', 'setwood' ) . '&nbsp;<span class="meta-nav">&rarr;</span>',
                'prev_text' => '<span class="meta-nav">&larr;</span>&nbsp' . _x( 'Previous', 'Previous post', 'setwood' ),
                );
                the_posts_pagination( $args );
				break;
			}
    }
}

if ( ! function_exists( 'setwood_post_nav' ) ) {
    /**
     * Display navigation to next/previous post when applicable. // TODO translation
     */
    function setwood_post_nav() {
        if (true == setwood_get_option( 'single_show_prev_next' , true ) ) :
        $args = array(
            'next_text' => '<div class="meta-nav">'. esc_html__( 'Next', 'setwood' ) .'</div><div class="meta-nav-text">%title</div>',
            'prev_text' => '<div class="meta-nav">'. esc_html__( 'Prev', 'setwood' ) .'</div><div class="meta-nav-text">%title</div>',
            );
        the_post_navigation( $args );
        endif;
    }
}

if ( ! function_exists( 'setwood_featured' ) ) { // TODO: Featured area in customizer
    /**
     * Display Featured Area for slider and carousel
     * @since  1.0.0
     * @return void
     */
    function setwood_featured() {
        if( setwood_get_option('show_featured_content') ) :
                
        if(is_home() || is_front_page() && !is_paged()) {
            get_template_part( 'featured', 'content' );
        }
        endif;
    }
}

if ( ! function_exists( 'setwood_post_author' ) ) { // TODO: Author Box in customizer
    /**
     * Display Author Box
     * @since  1.0.0
     * @return void
     */
    function setwood_post_author() {
        if( setwood_get_option('single_show_author') ) :

            get_template_part('inc/templates/author');

        endif;
    }
}

if ( ! function_exists( 'setwood_homepage_content' ) ) {
    /**
     * Display homepage content
     * Hooked into the `homepage` action in the homepage template
     * @since  1.0.0
     * @return  void
     */
    function setwood_homepage_content() {
        while ( have_posts() ) : the_post();

            get_template_part( 'content', 'page' );

        endwhile; // end of the loop.
    }
}

if ( ! function_exists( 'setwood_header_social_icons' ) ) {
    /**
     * Display social icons
     * @since 1.0.0
     */
    function setwood_header_social_icons() {
        if ( setwood_get_option( 'show_header_social' ) ) :
            get_template_part('inc/templates/social-icons');
        endif;
        }
}

if ( ! function_exists( 'setwood_footer_social_icons' ) ) {
    /**
     * Display social icons
     * @since 1.0.0
     */
    function setwood_footer_social_icons() {
        if ( setwood_get_option( 'show_footer_social' ) ) :
            get_template_part('inc/templates/social-icons');
        endif;
        }
}

if ( !function_exists( 'setwood_has_sidebar' ) ) {
    /**
     * Check if sidebar is used on current template
     * @since 1.0.0
     */
    function setwood_has_sidebar() {
        $layout_class=setwood_get_post_layout();
        if ($layout_class == 'right-sidebar' || $layout_class == 'left-sidebar' ) {
            return true;
        }    
    }
}

if ( ! function_exists( 'setwood_get_sidebar' ) ) {
    /**
     * Display setwood sidebar
     * @uses get_sidebar()
     * @since 1.0.0
     */
    function setwood_get_sidebar() {
        if ( setwood_has_sidebar() ):
            if ( setwood_is_woo_shop() || setwood_is_woo_tax() || setwood_is_woo_single() ) :
              get_sidebar( 'shop' );
            else :
              get_sidebar();
            endif;
        endif;
    }
}

/* Post Views
/* ------------------------------------ */ 
if ( ! function_exists( 'setwood_post_views' ) ) { //WP-PostViews Plugin
    function setwood_post_views() { 
        if(function_exists('the_views')) { 
            echo the_views();
        }
    }
}

add_filter( 'the_views', 'customisation_of_the_views' );
function customisation_of_the_views( $output ) {
    $output = str_replace("views","",$output);
    echo '<span class="views"><i class="fa fa-eye"></i>'.$output.'<span class="suffix"> ' . esc_html__( 'Views', 'setwood' ) . '</span>'.'</span>';
}

/* Like
/* ------------------------------------ */ 
if ( ! function_exists( 'setwood_like' ) ) { //WP-PostViews Plugin
    function setwood_like() { 
        if( function_exists('dot_irecommendthis') ) {
            echo '<span class="like">';
            dot_irecommendthis();
            echo '</span>';
        }
    }
}

/*  Related posts
/* ------------------------------------ */
if ( ! function_exists( 'setwood_get_related_posts' ) ) {

       function setwood_get_related_posts() {
        if ( setwood_get_option('single_show_related_post')) {
            get_template_part('inc/templates/related-post');
        }
    }

}

if ( ! function_exists( 'setwood_post_media' ) ) :
/**
 * Display post media
 *
 * @var $size thumbnail size. thumbnail|medium|large|full|$custom
 * @uses has_post_thumbnail()
 * @uses the_post_thumbnail
 * @param string $size the post thumbnail size.
 * @since 1.0
 */
function setwood_post_media() {
	$format = get_post_format();
    $post_layout = setwood_get_option( setwood_layout_prefix().'_post_layout' );
        if ( $media = setwood_get_post_media( $format ) ) :?>
            <div class="entry-media">
            <?php if ( $format=='audio' || $format=='quote' && has_post_thumbnail() ) :

                if ( is_singular() ) :
                the_post_thumbnail('setwood-full-width');
                else:
                the_post_thumbnail(setwood_get_entry_image_size());
                endif;
            endif; ?>

                <?php echo $media; ?>
            </div>
        <?php endif;
}
endif;

if ( ! function_exists( 'setwood_post_thumbnail' ) ) :
/**
 * Display post thumbnail
 *
 * @var $size thumbnail size. thumbnail|medium|large|full|$custom
 * @uses has_post_thumbnail()
 * @param string $size the post thumbnail size.
 * @since 1.0
 */
function setwood_post_thumbnail() {
	$format = get_post_format();
    $post_layout = setwood_get_option( setwood_layout_prefix().'_post_layout' );
    if ( post_password_required() || is_attachment() ) :
    return;
    endif;
    
	if ( is_singular() ) :
    
        if ( !empty( $format ) ):
        setwood_post_media(); 
        elseif ( empty( $format ) && has_post_thumbnail() ):?>
        
        <div class="post-thumbnail">
            <?php the_post_thumbnail('setwood-full-width'); ?>
        </div><!-- .post-thumbnail -->
            
        <?php endif; ?>
	<?php else : ?>
    
    <?php if ( !empty( $format ) && has_post_thumbnail() && $post_layout =='standard'):?>
        <?php setwood_post_media(); ?>
    <?php elseif ( !empty( $format ) && !has_post_thumbnail() ):?>
        <?php setwood_post_media(); ?>
    <?php else : ?>

    <figure class="post-thumbnail">
        <a href="<?php the_permalink(); ?>" aria-hidden="true">
            <?php the_post_thumbnail( setwood_get_entry_image_size() , array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
            <?php echo setwood_post_format_icon();?>
        </a>
    </figure>
    
    <?php endif; ?>
	<?php endif; // End is_singular()
}
endif;

/**
* Source http://zourbuth.com/archives/893/creating-default-wordpress-post-thumbnail-or-featured-image/
*/
function setwood_default_post_thumbnail( $html, $post_id, $post_thumbnail_id, $size, $attr ) {

    $image_url=setwood_get_option('default_fimg');
    
    if ( '' == $html && '' != $image_url && 'post' == get_post_type() ) { // or ! $post_thumbnail_id
        
        $post_thumbnail_id = setwood_get_image_id_by_url( $image_url );
        // for "Just In Time" filtering of all of wp_get_attachment_image()'s filters
        do_action( 'begin_fetch_post_thumbnail_html', $post_id, $post_thumbnail_id, $size );
        if ( in_the_loop() )
            update_post_thumbnail_cache();
        $html = wp_get_attachment_image( $post_thumbnail_id, $size, false, $attr );
        do_action( 'end_fetch_post_thumbnail_html', $post_id, $post_thumbnail_id, $size );
    }

    return $html;
}
add_filter( 'post_thumbnail_html', 'setwood_default_post_thumbnail', 1, 5 );
 
/**
 * Get post format icon
 *
 * Checks format of current post and returns icon class.
 *
 * @return string Icon HTML output
 * @since  1.0
 */

if ( !function_exists( 'setwood_post_format_icon' ) ):
	function setwood_post_format_icon() {

		$format = get_post_format();

		$icons = array(
			'video' => 'fa-play',
			'audio' => 'fa-music',
			'image' => 'fa-picture-o',
			'gallery' => 'fa-camera',
            'quote' => 'fa-quote-left'
		);

		if ( $format && array_key_exists( $format, $icons ) ) {

			return '<span class="format-icon"><i class="fa '.esc_attr( $icons[$format] ).'"></i></span>';
		}

		return '';
	}
endif;

/**
 * Display Search
 * @since  1.0.0
 * @return void
 */
if ( ! function_exists( 'setwood_search_toggle' ) ) {
    function setwood_search_toggle($position='top') {

    if ( setwood_get_option( 'nav_search' ) ) : ?>
            
    <div class="search-toggle">
        <span class="fa fa-search fa-fw"></span>
        <a href="#search-link" class="screen-reader-text search-link" aria-expanded="false" aria-controls="search-box-wrapper-<?php echo $position; ?>"><?php esc_html_e( 'Search', 'setwood' ); ?></a>
        <div id="search-box-wrapper-<?php echo $position; ?>" class="search-box-wrapper widget_search">
            <?php get_search_form(); ?>
        </div>
    </div>

    <?php
    endif;
    }
}

/**
 * Facebook
 */
if ( ! function_exists( 'setwood_facebook_page' ) ) {
    function setwood_facebook_page() {
    if ( setwood_get_option( 'setwood_add_facebook_sdk' ) ) { ?>
<div id="fb-root"></div>
<script async>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo setwood_get_locale(); ?>/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php }
}
}

/*** Sticky Header Wrapper
** @since 1.0.0
* @return void */
if ( ! function_exists( 'setwood_sticky_header' ) ) { 
function setwood_sticky_header() {
if ( setwood_get_option( 'header_sticky' ) ) : ?>
<div class="setwood-header-sticky">
    <div class="sticky-content">
        <?php echo setwood_site_branding_mini(); ?>
        <?php setwood_search_toggle($position='sticky'); ?>
        <?php if (is_woocommerce_activated()) : ?>
        <?php setwood_header_cart(); ?>
        <?php endif; ?> 
        <nav id="sticky-navigation" class="main-navigation" aria-label="<?php esc_html_e( 'Sticky Navigation', 'setwood' ); ?>">
        
        <?php 
            wp_nav_menu(
                array(
                    'theme_location'	=> 'sticky',
                    'container_class'	=> 'primary-navigation',
                    'container'         => 'ul',
                    )
            );
        ?>

        </nav>
        <!-- #sticky-navigation -->
    </div>
</div>
<?php
endif;
    }
}

/**
 * Display Header Cart
 * @since  1.0.0
 * @uses  is_woocommerce_activated() check if WooCommerce is activated
 * @return void
 */
if ( ! function_exists( 'setwood_header_cart' ) ) {
    function setwood_header_cart() {
        if ( is_woocommerce_activated() && setwood_get_option( 'nav_cart' ) ) {
            if ( is_cart() ) {
                $class = 'current-menu-item';
            } else {
                $class = '';
            }
        ?>
        <div class="site-header-cart <?php echo esc_attr( $class ); ?>">
                <?php setwood_cart_link(); ?>
        </div>
        <?php
        }
    }
}

if ( ! function_exists( 'setwood_header_top' ) ) {
    /**
     * Top Section Wrapper (Header)
     */
    function setwood_header_top() {
        echo '<div class="header-top-outer"><div class="header-top"><div class="header-top-inner">';
        echo '<div class="menu-mobile main-navigation"></div>';
    }
}

if ( ! function_exists( 'setwood_header_top_close' ) ) {
    /**
     * Top Section Wrapper Close (Header)
     */
    function setwood_header_top_close() {
        echo '</div></div></div>';
    }
}

if ( ! function_exists( 'setwood_header_middle' ) ) {
    /**
     * Top Section Wrapper (Header)
     */
    function setwood_header_middle() {
        echo '<div class="header-middle"><div class="header-middle-inner">';
    }
}

if ( ! function_exists( 'setwood_header_middle_close' ) ) {
    /**
     * Top Section Wrapper Close (Header)
     */
    function setwood_header_middle_close() {
        echo '</div></div>';
    }
}

if ( ! function_exists( 'setwood_nav_wrapper' ) ) {
    /**
     * Navbar Wrapper (Header)
     */
    function setwood_nav_wrapper() {
        echo '<div class="navbar">';
    }
}

if ( ! function_exists( 'setwood_nav_wrapper_close' ) ) {
    /**
     * Navbar Wrapper Close (Header)
     */
    function setwood_nav_wrapper_close() {
        echo '</div>';
    }
}


if ( ! function_exists( 'setwood_entry_wrapper' ) ) {
    /**
     * Entry Wrapper (Content)
     */
    function setwood_entry_wrapper() {
        echo '<div class="entry-wrapper">';
    }
}

if ( ! function_exists( 'setwood_entry_wrapper_close' ) ) {
    /**
     * Entry Wrapper (Content) Close
     */
    function setwood_entry_wrapper_close() {
        echo '</div>';
    }
}

if ( ! function_exists( 'setwood_list_item_col_alpha' ) ) {
    /**
     * List Layout Column
     */
    function setwood_list_item_col_alpha() {
        echo '<div class="list-item-column left" data-mh="list-group">';
    }
}

if ( ! function_exists( 'setwood_list_item_col_alpha_close' ) ) {
    /**
     * List Layout Column Close
     */
    function setwood_list_item_col_alpha_close() {
        echo '</div>';
    }
}

if ( ! function_exists( 'setwood_list_item_col_omega' ) ) {
    /**
     * List Layout Column
     */
    function setwood_list_item_col_omega() {
        echo '<div class="list-item-column right" data-mh="list-group">';
    }
}

if ( ! function_exists( 'setwood_list_item_col_omega_close' ) ) {
    /**
     * List Layout Column Close
     */
    function setwood_list_item_col_omega_close() {
        echo '</div>';
    }
}


if ( ! function_exists( 'setwood_newline' ) ) {
    /**
     * List Layout Column Close
     */
    function setwood_newline() {
        echo '<div class="new-line"></div>';
    }
}

if ( ! function_exists( 'setwood_init_structured_data' ) ) {
    /**
     * Generates structured data.
     *
     * Hooked into the following action hooks:
     *
     * - 'setwood_loop_post'
     * - 'setwood_grid_loop_post'
     * - 'setwood_list_loop_post'
     * - 'setwood_single_post'
     * - 'setwood_page'
     *
     * Applies 'setwood_structured_data' filter hook for structured data customization :)
     */
    function setwood_init_structured_data() {
        // Post's structured data.
        if ( is_home() || is_category() || is_date() || is_search() || is_single() && ( is_woocommerce_activated() && ! is_woocommerce() ) ) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'normal' );
            $logo_url = get_theme_mod('logo');
            $logo  = wp_get_attachment_image_src(  setwood_get_image_id_by_url( $logo_url ), 'full' );
            $json['@type']            = 'BlogPosting';
            $json['mainEntityOfPage'] = array(
                '@type'                 => 'webpage',
                '@id'                   => get_the_permalink(),
            );
            $json['publisher']        = array(
                '@type'                 => 'organization',
                'name'                  => get_bloginfo( 'name' ),
                'logo'                  => array(
                    '@type'               => 'ImageObject',
                    'url'                 => $logo[0],
                    'width'               => $logo[1],
                    'height'              => $logo[2],
                ),
            );
            $json['author']           = array(
                '@type'                 => 'person',
                'name'                  => get_the_author(),
            );
            if ( $image ) {
                $json['image']            = array(
                    '@type'                 => 'ImageObject',
                    'url'                   => $image[0],
                    'width'                 => $image[1],
                    'height'                => $image[2],
                );
            }
            $json['datePublished']    = get_post_time( 'c' );
            $json['dateModified']     = get_the_modified_date( 'c' );
            $json['name']             = get_the_title();
            $json['headline']         = $json['name'];
            $json['description']      = get_the_excerpt();
        // Page's structured data.
        } elseif ( is_page() ) {
            $json['@type']            = 'WebPage';
            $json['url']              = get_the_permalink();
            $json['name']             = get_the_title();
            $json['description']      = get_the_excerpt();
        }
        if ( isset( $json ) ) {
            Setwood::set_structured_data( apply_filters( 'setwood_structured_data', $json ) );
        }
    }
}

/* Layout class
/* ------------------------------------ */ 
if ( ! function_exists( 'setwood_layout_prefix' ) ) { 
    function setwood_layout_prefix() { 
        if (is_home()) { 
            $layout = 'home'; 
        } else { 
            $layout = 'archive'; 
        } // Return layout class return $layout;
        return $layout;
    }
}

/* Get Post entry layout
/* ------------------------------------ */ 
if ( ! function_exists( 'setwood_get_post_entry_layout' ) ) { 
    function setwood_get_post_entry_layout() { 
        global $is_setwood_featured_post;
        $layout = setwood_get_option( setwood_layout_prefix().'_post_layout' );
        // Featured Post
        if ( $is_setwood_featured_post ) :
        $layout = 'standard';
        endif;
        return $layout;
    }
}
