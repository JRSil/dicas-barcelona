<?php
    $networks = setwood_get_social_networks();
    $user     = array();
    $global   = array();
    $used     = array();

    if( in_the_loop() ) {
        foreach( $networks as $network ) {
            if( get_the_author_meta( 'user_' . $network['name'] ) ) {
                $user[ $network['name'] ] = get_the_author_meta( 'user_' . $network['name'] );
            }
        }
    }

    foreach( $networks as $network ) {
        if( setwood_get_option( 'social_' . $network['name'] ) ) {
            $global[ $network['name'] ] = setwood_get_option( 'social_' . $network['name'] );
        }
    }

    // Determine whether we should use the user's socials.
    if ( count( $user ) > 0 ) {
        $used = $user;
    } elseif ( count( $global ) > 0 ) {
        $used = $global;
    }

    // Only the content should show the user's socials however.
    if( ! in_the_loop() ) {
        $used = $global;
    }

    if ( ( in_the_loop() && count( $used ) > 0 ) || ( ! in_the_loop() && ( count( $used ) > 0 ) ) ) {
        ?>
    <div class="socials">
        <ul>
        <?php
        foreach ( $networks as $network ) {
            if ( ! empty( $used[ $network['name'] ] ) ) {
                echo sprintf( '<li><a href="%s" target="_blank"><i class="fa fa-%s"></i><span>%s</span></a></li>',
                    esc_url( $used[ $network['name'] ] ),
                    esc_attr( $network['icon'] ),
                    ucwords( $network['name'] )
                );
            }
        }
        ?>
        </ul>
    </div>
<?php
}
