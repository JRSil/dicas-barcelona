<?php
// Get our Featured Content posts
$slider_posts = setwood_get_featured_posts();
$featured_content_style = setwood_get_option( 'featured_content_style' , 'carousel' );

// Check if there is Featured Content
if ( empty( $slider_posts ) and current_user_can( 'edit_theme_options' ) ) : ?>

<p class="frontpage-slider-empty-posts col-full">
    <?php esc_html_e( 'There is no featured content to be displayed in the slider. To set up the slider, go to Appearance &#8594; Customize &#8594; Featured Content, and add a featured tag in the Tag field. The slideshow displays all your posts which are tagged with that keyword.', 'setwood' ); ?>
</p>

<?php
    return;
endif;
?>

<?php
    /**
     * Fires before the Setwood featured content.
     */
    do_action( 'setwood_featured_posts_before' );


    if ($featured_content_style == 'grid-style-1') :
        get_template_part( 'content-featured', 'grid' );
    else:
        get_template_part( 'content-featured', 'slide' );
    endif;
    
    /**
     * Fires after the Setwood featured content.
     */
    do_action( 'setwood_featured_posts_after' );

    wp_reset_postdata();
?>