<?php
/**
 * Register Image Block
 *
 * @package woo-berg
 */

function register_image_block(){
   $product_image_block_js = 'index.js';
    wp_register_script(
        'product-image-block-editor',
        plugins_url( $product_image_block_js, __FILE__ ),
        array(
            'wp-blocks',
            'wp-i18n',
            'wp-element',
            'wp-editor',
        ),
        filemtime( "$dir/$product_image_block_js" )
    );

    register_block_type('woo-berg/product-image', array(
        'editor_script' => 'product-image-block-editor',
        'render_callback' => 'render_product_image'
    ));
}

function render_product_image( $block_attributes, $content ){
    $post = get_post();
    
    if (!$post || $post->post_type!="product")
        return "The description will show here";

    return $post->post_content;
}