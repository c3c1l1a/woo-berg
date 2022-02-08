<?php
/**
 * Register Product gallery Block
 *
 * @package wooberg
 */

function register_wooberg_product_gallery_block(){
   $product_gallery_block_js = 'index.js';
   $dir = dirname( __FILE__ );
    wp_register_script(
        'product-gallery-block-editor',
        plugins_url( $product_gallery_block_js, __FILE__ ),
        array(
            'wp-blocks',
            'wp-i18n',
            'wp-element',
            'wp-editor',
        ),
        filemtime( "$dir/$product_gallery_block_js" )
    );

    

    register_block_type('wooberg/product-gallery', array(
        'api_version' => 2,
        'editor_script' => 'product-gallery-block-editor',
        'render_callback' => 'render_product_gallery',
        
    ));
}

function render_product_gallery($block_attributes, $content){

}