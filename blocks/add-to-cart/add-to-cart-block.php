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

    /*register_block_type( 'woo-berg/login', array(
        'api_version' => 2,
        'editor_script' => 'add-to-cart-block-editor',
        'editor_style'  => 'add-to-cart-block-editor',
        'style'         => 'add-to-cart-block',
    ) );*/


    register_block_type('woo-berg/add-to-cart', array(
        'api_version' => 2,
        'editor_script' => 'add-to-cart-block-editor',
        'render_callback' => 'render_add_to_cart',
        'attributes' => array(
            'buttonStyleClasses' => array(
                'type' => 'string',
                'default' => 'wooberg-button wooberg-add-to-cart-button'
            ), 
        ),
    ));
}

function render_add_to_cart( $block_attributes, $content ){
    $post = get_post();
    
    $buttonStyleClasses = $block_attributes['buttonStyleClasses'];
    
    if (!$post || $post->post_type!="product")
        return 
            "<a class=\"$buttonStyleClasses\">
                <span>
                    Button
                </span>
        </a>";
 
    $product_id = get_the_ID();

    
    
    return 
        "<a class=\"$buttonStyleClasses\" data-product-id=$product_id>
            <span>
                Add To cart
            </span>
        </a>";

    //$price = get_post_meta( get_the_ID(), '_regular_price', true);

    //$currency = get_woocommerce_currency_symbol();

}




function add_to_cart_button_js($hook) {
    $dir = dirname( __FILE__ );
    $add_to_cart_button_js = 'add-to-cart-button.js';
    
    wp_enqueue_script(
        'add_to_cart_button_js',
        plugins_url( $add_to_cart_button_js, __FILE__ ),
        array(
            'jquery'
        ),
        filemtime( "$dir/$add_to_cart_button_js" )
    );
 
}
add_action('wp_enqueue_scripts', 'add_to_cart_button_js');



function wooberg_ajax_add_to_cart(){
    error_log(print_r('testing again', true));
}
add_action('wp_ajax_wooberg_ajax_add_to_cart', 'wooberg_ajax_add_to_cart');
add_action('wp_ajax_nopriv_wooberg_ajax_add_to_cart', 'wooberg_ajax_add_to_cart');