<?php
/**
 * Register Image Block
 *
 * @package woo-berg
 */

function register_wooberg_image_block(){
   $wooberg_image_block_js = 'index.js';
   $dir = dirname( __FILE__ );
    wp_register_script(
        'wooberg-image-block-editor',
        plugins_url( $wooberg_image_block_js, __FILE__ ),
        array(
            'wp-blocks',
            'wp-i18n',
            'wp-element',
            'wp-editor',
        ),
        filemtime( "$dir/$wooberg_image_block_js" )
    );

    $defaultImg = plugins_url( 'assets/woocommerce-placeholder.png', __FILE__ );

    wp_localize_script(
        'wooberg-image-block-editor',
        'js_data',
        array(
            'featured_image' => $defaultImg
        )
    );

    register_block_type('wooberg/wooberg-image', array(
        'api_version' => 2,
        'editor_script' => 'wooberg-image-block-editor',
        'render_callback' => 'render_wooberg_image',
        'attributes' => array(
            'imageSrc' => array(
                'type' => 'string',
                'default'=> $defaultImg
            )
        )
    ));
}

function render_wooberg_image( $block_attributes, $content ){
    $post = get_post();
    
    error_log(print_r($block_attributes, true));
    if (!$post || $post->post_type!="product"){
        $src = $block_attributes['imageSrc'];
        return "<img src=\"$src\"/>";;
    }

   $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
   $src=$image[0];
   
   return "<img src=\"$src\"/>";

}