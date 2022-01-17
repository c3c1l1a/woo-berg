<?php
/**
 * Register Cart Block
 *
 * @package woo-berg
 */


function register_cart_block(){
   $cart_block_js = 'index.js';
   $dir = dirname( __FILE__ ); 

   wp_register_script(
        'cart-block-editor', 
        plugins_url($cart_block_js, __FILE__),
        array(
            'wp-blocks',
            'wp-element',
            'wp-editor'
        ),
        filemtime("$dir/$cart_block_js")
   );

   register_block_type('woo-berg/cart', array(
        'api_version' => 2,
        'editor_script' => 'cart-block-editor',
        'render_callback' => 'render_cart_block', 
   ));

}