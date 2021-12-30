<?php
/**
 * Register Image Block
 *
 * @package woo-berg
 */

function register_image_block(){
   $product_image_block_js = 'index.js';
   $dir = dirname( __FILE__ );
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

    wp_localize_script(
        'product-image-block-editor',
        'js_data',
        array(
            'featured_image' => plugins_url( 'assets/woocommerce-placeholder.png', __FILE__ )
        )
    );

    register_block_type('woo-berg/product-image', array(
        'editor_script' => 'product-image-block-editor',
        'render_callback' => 'render_product_image'
    ));
}

function render_product_image( $block_attributes, $content ){
    $post = get_post();
    
    if (!$post || $post->post_type!="product")
        return 'The Image will show here';

   $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
   $src=$image[0];
   
   return "<img src=\"$src\"/>";

}