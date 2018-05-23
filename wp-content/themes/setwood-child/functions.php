<?php
/*
 * Setwood Child Theme Function File
 * You can modify any function here. Simply copy any function from parent and paste here. It will override the parent's version.
 */

/**
 * Setwood automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Setwood Core CSS.
 *
 * If you don't plan to dequeue the Setwood Core CSS you can remove the subsequent line and as well
 * as the setwood_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'setwood_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function setwood_child_theme_dequeue_style() {
    wp_dequeue_style( 'setwood-style' );
    wp_dequeue_style( 'setwood-woocommerce-style' );
}

function barcelona_theme_enqueue_style() {
    wp_register_style( 'style.min', get_stylesheet_directory_uri() . '/css/style.min.css'  );
    wp_enqueue_style('style.min');
}

function barcelona_theme_enqueue_script(){
    if(is_front_page() || is_category() || is_search() || is_tag()){
        wp_enqueue_script('home', get_stylesheet_directory_uri() . '/js/home.js');
    }else{
        wp_enqueue_script('home', get_stylesheet_directory_uri() . '/js/home.js');
        wp_enqueue_script('internas', get_stylesheet_directory_uri() . '/js/internas.js');
    }
}

add_action( 'wp_enqueue_scripts', 'barcelona_theme_enqueue_style', 999 );


add_action( 'wp_enqueue_scripts', 'barcelona_theme_enqueue_script', 998);

function setwood_custom_fonts( $standard_fonts ){
    $my_custom_fonts = array();
    $my_custom_fonts['calibri'] = array(
        'label' => 'calibri',
        'variants' => array('regular','italic','700','700italic'),
        'stack' => 'calibri, sans-serif',
    );
    $my_custom_fonts['FuturaBT-Medium'] = array(
        'label' => 'FuturaBT-Medium',
        'variants' => array('regular','italic','700','700italic'),
        'stack' => 'FuturaBT-Medium, sans-serif',
    );
    
    return array_merge_recursive( $my_custom_fonts, $standard_fonts );
}
add_filter( 'kirki/fonts/standard_fonts', 'setwood_custom_fonts', 20 );

// Cria a meta_box
function dicas_metabox() {

    add_meta_box(
     'dicas_meta_box',          // ID da Meta Box 
     'Subtítulo',               // Título
     'dicas_metabox_callback',  // Função de callback
     'post',                    // Local onde ela vai aparecer
     'normal',                   // Contexto
     'high'                      // Prioridade
    );
   
    // } // foreach
    
   } // Cria a meta_box
   add_action( 'add_meta_boxes', 'dicas_metabox', 1 );
   
   // Essa é a função que vai exibir os dados para o usuário
   function dicas_metabox_callback( $post ) {
    
    // Adiciona um campo nonce para verificação posterior
    wp_nonce_field( 'dicas_custom_metabox', 'dicas_custom_metabox_nonce' );
   
    // Configura os campos
    $_tp_mensagem = get_post_meta( $post->ID, '_tp_mensagem', true );
    echo '<textarea name="_tp_mensagem" class="widefat">' . esc_html( $_tp_mensagem ) . '</textarea>';
   }
   
   function dicas_save_custom_metabox_data( $post_id ) {
    $_tp_mensagem = isset( $_POST['_tp_mensagem'] ) ? $_POST['_tp_mensagem'] : null;
   
    // Atualiza os dados no BD
    update_post_meta( $post_id, '_tp_mensagem', $_tp_mensagem );
   }
   add_action( 'save_post', 'dicas_save_custom_metabox_data' );

    // remove dashicons in frontend to non-admin
    function wpdocs_dequeue_dashicon() {
        if ( ! is_user_logged_in() ) {
            wp_deregister_style( 'dashicons' );
        }
    }
    add_action( 'wp_enqueue_scripts', 'wpdocs_dequeue_dashicon' );
/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */
