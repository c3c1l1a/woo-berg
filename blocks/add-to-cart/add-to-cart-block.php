<?php
/**
 * Register Add To Cart Block
 *
 * @package woo-berg
 */

function register_add_to_cart_block(){
   $add_to_cart_block_js = 'index.js';
   $dir = dirname( __FILE__ );
    
    wp_register_script(
        'add-to-cart-block-editor',
        plugins_url( $add_to_cart_block_js, __FILE__ ),
        array(
            'wp-blocks',
            'wp-element',
            'wp-editor',
        ),
        filemtime( "$dir/$add_to_cart_block_js" )
    );

    $editor_css = '/editor.css';
    wp_register_style(
        'add-to-cart-block-editor',
        plugins_url( $editor_css, __FILE__ ),
        array(
            'wp-edit-blocks'
        ),
        filemtime( "$dir/$editor_css" )
    );

    $style_css = '/style.css';
    wp_register_style(
        'add-to-cart-block',
        plugins_url( $style_css, __FILE__ ),
        array(),
        filemtime( "$dir/$style_css" )
    );

    register_block_type( 'woo-berg/login', array(
        'api_version' => 2,
        'editor_script' => 'add-to-cart-block-editor',
        'editor_style'  => 'add-to-cart-block-editor',
        'style'         => 'add-to-cart-block',
    ) );


    register_block_type('woo-berg/add-to-cart', array(
        'editor_script' => 'add-to-cart-block-editor',
        'render_callback' => 'render_add_to_cart',
        'attributes' => array(
            'style' => array(
                'type' => 'object',
            ), 
        ),
    ));
}

function render_add_to_cart( $block_attributes, $content ){
    $post = get_post();
    
    //if (!$post || $post->post_type!="product")
    //    return 'Add to cart will show here';

    //$price = get_post_meta( get_the_ID(), '_regular_price', true);

    //$currency = get_woocommerce_currency_symbol();
    
    $style = '';

    foreach ($block_attributes['style'] as $key => $value){
        $style .= "$key: $value;";
    }
    
   return 
        "<button style=\"$style\">
            Add To cart
        </button>";

}