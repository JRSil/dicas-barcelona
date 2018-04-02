<?php
/**
 * The template for displaying featured posts on the front page
 *
 * @since Setwood 1.0
 */
?>
<?php $featured_post_style = setwood_get_option( 'featured_content_style' , 'carousel' ); ?>

<?php if ( $featured_post_style == 'full-width' ) {
    $img_size = 'setwood-full-screen';
} else {
    $img_size = 'setwood-full-width'; //carousel
} ?>

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
