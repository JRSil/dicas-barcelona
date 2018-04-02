<div class="post-item">
    <div class="post-thumb">
        <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
            <?php the_post_thumbnail($instance['image_size']); ?>
        </a>
    </div>
    <div class="post-item-wrapper">
        <header class="entry-header">
            <h4 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a></h4>
            <p class="entry-meta-header meta">
                <?php if( $meta = setwood_get_meta_data( false, $instance['meta'] ) ) : ?>
                    <?php echo $meta; ?>
                <?php endif; ?>
            </p>
        </header>
    </div>
</div>