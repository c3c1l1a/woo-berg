<?php
/**
 * Register Image Block
 *
 * @package woo-berg
 */

function register_price_block(){
   $product_price_block_js = 'index.js';
   $dir = dirname( __FILE__ );
    
    wp_register_script(
        'product-price-block-editor',
        plugins_url( $product_price_block_js, __FILE__ ),
        array(
            'wp-blocks',
            'wp-element',
            'wp-editor',
        ),
        filemtime( "$dir/$product_price_block_js" )
    );


    register_block_type('woo-berg/product-price', array(
        'editor_script' => 'product-price-block-editor',
        'render_callback' => 'render_product_price'
    ));
}

function render_product_price( $block_attributes, $content ){
    $post = get_post();
    
    if (!$post || $post->post_type!="product")
        return 'The price will show here';

    $price = get_post_meta( get_the_ID(), '_regular_price', true);

    $currency = get_woocommerce_currency_symbol();


   return "<p><span>$currency</span><span>$price</span></p>";

}