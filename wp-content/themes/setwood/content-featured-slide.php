<?php
/**
 * The template for displaying featured posts on the front page
 *
 * @since Setwood 1.0
 */
?>

<?php
$featured_post_style = setwood_get_option( 'featured_content_style' , 'carousel' );
$slick_autoplay = setwood_get_option( 'slick_autoplay' ) ? 'true' : 'false';
$slick_autotime = setwood_get_option( 'slick_autotime' );
$slick_autospeed = setwood_get_option( 'slick_autospeed' );
$featured_posts = setwood_get_featured_posts();
$i=1;
$post_count = count($featured_posts);

if ($featured_post_style == 'full-width') {
    $img_size = 'setwood-full-screen';
} else {
    $img_size = 'setwood-full-width'; //carousel
}
?>
<div id="featured-content" class="featured-content">
    <div class="featured-carousel <?php echo setwood_get_option( 'featured_content_style' , 'carousel' ); ?>" data-auto="<?php echo $slick_autoplay; ?>" data-autotime="<?php echo absint($slick_autotime); ?>" data-speed="<?php echo absint($slick_autospeed); ?>">
        <?php 
        /**
         * Fires before the Setwood featured content.
         */
        do_action( 'setwood_featured_posts_before' );
        ?>
       
        <?php
        foreach ( (array) $featured_posts as $order => $post ) :
            setup_postdata( $post );
            // Include the featured content template.
        ?>
        <div class="slider-wrap">
        <div class="slider-content-wrap" style="background-image:url('<?php the_post_thumbnail_url($img_size);?>')";>
            <article class="slider-content">
                <div class="slider-content-inner">
                    <div class="slider-content-info">
                        <?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) ) : ?>
                            <?php setwood_post_categories(); ?>
                        <?php endif; ?>
                    <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
                        <p class="entry-meta-header meta">
                            <?php
                            setwood_posted_on();
                            setwood_posted_by();
                            ?>
                        </p>
                    </div>
                </div>
            </article>
        </div>
        </div>
        <?php
            
        endforeach;
        ?>
        
        <?php
        /**
         * Fires after the Setwood featured content.
         */
        do_action( 'setwood_featured_posts_after' );

        wp_reset_postdata();
    ?>
    </div>
</div>