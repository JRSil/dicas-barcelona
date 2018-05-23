<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );

$feed_url = isset( $attr['feed_url'] ) ? $attr['feed_url'] : 'https://www.pinterest.com/pinterest';

$specific_board = isset( $attr['specific_board'] ) ? $attr['specific_board'] : '';
if( isset( $specific_board ) && $specific_board != '' ) {
    $pinterest_url = $feed_url . '/' . $specific_board;
    $feed_url = $feed_url . '/' . $specific_board . '.rss';
}
else {
    $pinterest_url = $feed_url;
    $feed_url = $feed_url . '/feed.rss';
}

$number_of_pins_to_show = isset( $attr['feed_count'] ) ? $attr['feed_count'] : '4';

$caption_enabled = isset( $attr['caption'] ) ? $attr['caption'] : '0';

$latest_pins = $this->apsp_pinterest_get_rss_feed( $feed_url, $number_of_pins_to_show );

$show_pinterest_link = isset( $attr['show_pinterest_link'] ) ? $attr['show_pinterest_link'] : '';
?>
<?php if( !empty( $latest_pins ) ) { ?>
    <ul id="apsp-pinterest-latest-pins" <?php if( $caption_enabled == '1' ) { ?> class='apsp-caption-enabled' <?php
    }
    else { ?> class='apsp-caption-disabled clearfix' <?php
    } ?>>
        <?php
    $count = 0;
    foreach( $latest_pins as $item ):
        $count++;
        $rss_pin_description = $item->get_description();
        preg_match( '/https[^"]+/i', $rss_pin_description, $pin_image );
        $pin_caption = $this->trim_text( strip_tags( $rss_pin_description ), 400 );
        ?>
        <li class="apsp-pinterest-latest-pin">
            <div class="apsp-pinterest-image">
                <a href="<?php echo esc_url( $item->get_permalink() ); ?>" target="_blank" title="<?php echo 'Posted ' . $item->get_date( 'j F Y | g:i a' ); ?>" rel='nofollow' ><img src='<?php echo $pin_image[0]; ?>' title='<?php echo $item->get_title(); ?>' alt="<?php echo $item->get_title(); ?>" /></a>
                <?php if( $caption_enabled == '1' ) { ?>
                    <span class="apsp-pinterest-text"><?php echo strip_tags( $pin_caption ); ?></span>
                <?php
                } ?>
            </div>
        </li>
        <?php
    endforeach; ?>
    </ul>
    <?php if( $show_pinterest_link == 'yes' ) { ?>
        <div class='apsp-pinterest-link'><a href='<?php echo $pinterest_url; ?>' target='_blank' rel='nofollow'><?php _e( 'View on Pinterest', 'accesspress-pinterest' ); ?></a></div>
    <?php
    }
}
else { ?>
    <span class='apsp-no-feeds'><?php _e( 'No feeds available.', 'accesspress-pinterest' ); ?></span>
<?php
}
