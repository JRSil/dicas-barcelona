<article <?php post_class('grid-item'); ?>>
    <figure class="post-thumbnail">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php the_post_thumbnail($instance['image_size']); ?>
            <?php if ( has_post_format('video') && !is_sticky() ) echo'<span class="format-icon small"><i class="fa fa-play"></i></span>'; ?>
            <?php if ( has_post_format('audio') && !is_sticky() ) echo'<span class="format-icon small"><i class="fa fa-music"></i></span>'; ?>
            <?php if ( is_sticky() ) echo'<span class="format-icon small"><i class="fa fa-star"></i></span>'; ?>
        </a>
    </figure><!--/.post-thumbnail-->
        <header class="entry-header">
            <h4 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h4>
            <p class="entry-meta-header meta">
                <?php if( $meta = setwood_get_meta_data( false, $instance['meta'] ) ) : ?>
                    <?php echo $meta; ?>
                <?php endif; ?>
            </p>
        </header>
</article>
