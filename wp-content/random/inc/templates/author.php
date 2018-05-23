<div id="author-bio" class="author-bio" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
<div class="avatar-image">
    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
        <?php echo get_avatar( get_the_author_meta( 'ID' ), 96 ); ?>
    </a>
</div><!-- .avatar -->
<div class="author-info">
    <span class="vcard author">
        <span class="fn">
            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author" itemprop="url">
                <span itemprop="name"><?php the_author_meta( 'display_name' ); ?></span>
            </a>
        </span>
    </span>
    <p itemprop="description">
		<?php the_author_meta( 'description' ); ?>
    </p>
    <div class="socials">
    <ul>
	<?php if ( get_the_author_meta( 'user_url' ) != '' ) { ?>
        <li>
            <a href="<?php echo wp_kses( get_the_author_meta( 'user_url' ), null ); ?>" target="_blank">
                <i class="fa fa-globe"></i>
                <span class="screen-reader-text"><?php printf( esc_attr__( 'Website', 'setwood'), get_the_author() ); ?></span>
            </a>
        </li>
    <?php } ?>


    <?php if ( get_the_author_meta( 'facebook' ) != '' ) { ?>
        <li>
            <a href="<?php echo wp_kses( get_the_author_meta( 'facebook' ), null ); ?>" target="_blank">
                <i class="fa fa-facebook"></i>
                <span class="screen-reader-text"><?php printf( esc_attr__( 'Facebook', 'setwood'), get_the_author() ); ?></span>
            </a>
        </li>
    <?php } ?>

    <?php if ( get_the_author_meta( 'twitter' ) != '' ) { ?>
        <li>
            <a href="<?php echo wp_kses( get_the_author_meta( 'twitter' ), null ); ?>" target="_blank">
                <i class="fa fa-twitter"></i>
                <span class="screen-reader-text"><?php printf( esc_attr__( 'Twitter', 'setwood'), get_the_author() ); ?></span>
            </a>
        </li>
    <?php } ?>

    <?php if ( get_the_author_meta( 'googleplus' ) != '' ) { ?>
        <li>
            <a href="<?php echo wp_kses( get_the_author_meta( 'googleplus' ), null ); ?>?rel=author" target="_blank">
                <i class="fa fa-google"></i>
                <span class="screen-reader-text"><?php printf( esc_attr__( 'Google+', 'setwood'), get_the_author() ); ?></span>
            </a>
        </li>
    <?php } ?>

    <?php if ( get_the_author_meta( 'pinterest' ) != '' ) { ?>
        <li>
            <a href="<?php echo wp_kses( get_the_author_meta( 'pinterest' ), null ); ?>" target="_blank">
            <i class="fa fa-pinterest"></i>
                <span class="screen-reader-text"><?php printf( esc_attr__( 'Pinterest', 'setwood'), get_the_author() ); ?></span>
            </a>
         </li>
    <?php } ?>

    <?php if ( get_the_author_meta( 'linkedin' ) != '' ) { ?>
        <li>
            <a href="<?php echo wp_kses( get_the_author_meta( 'linkedin' ), null ); ?>" target="_blank">
                <i class="fa fa-linkedin"></i>
                <span class="screen-reader-text"><?php printf( esc_attr__( 'LinkedIn', 'setwood'), get_the_author() ); ?></span>
            </a>
         </li>
    <?php } ?>

    <?php if ( get_the_author_meta( 'instagram' ) != '' ) { ?>
        <li>
            <a href="<?php echo wp_kses( get_the_author_meta( 'instagram' ), null ); ?>" target="_blank">
                <i class="fa fa-instagram"></i>
                <span class="screen-reader-text"><?php printf( esc_attr__( 'Instagram', 'setwood'), get_the_author() ); ?></span>
            </a>
         </li>
    <?php } ?>
        
    <?php if ( get_the_author_meta( 'tumblr' ) != '' ) { ?>
        <li>
            <a href="<?php echo wp_kses( get_the_author_meta( 'tumblr' ), null ); ?>" target="_blank">
                <i class="fa fa-tumblr"></i>
                <span class="screen-reader-text"><?php printf( esc_attr__( 'Tumblr', 'setwood'), get_the_author() ); ?></span>
            </a>
         </li>
    <?php } ?>


</ul>
</div><!-- .author-social -->
</div><!-- .info -->
</div><!-- #author-bio -->
