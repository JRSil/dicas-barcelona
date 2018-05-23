<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package setwood
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WZPWJ7S');</script>
<!-- End Google Tag Manager -->
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZPWJ7S"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php
    if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb('
            <p id="breadcrumbs">','</p>
        ');
    }
?>
    
<div id="page" class="hfeed site">
    <?php
    do_action( 'setwood_before_header' ); ?>

    <header id="masthead" class="site-header" style="<?php setwood_header_styles(); ?>">

    <?php
    $setwood_header_layout = get_theme_mod( 'header_layout', '1' );
    
    do_action( 'setwood_header_'.$setwood_header_layout.'' ); ?>
    </header><!-- #masthead -->

    <?php
    do_action( 'setwood_before_content' ); ?>

    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">

        <?php
        do_action( 'setwood_content_top' ); ?>
