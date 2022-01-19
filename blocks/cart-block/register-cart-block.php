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

   $editor_css = 'editor.css';
   wp_register_style(
        'cart-block-css',
        plugins_url($editor_css, __FILE__),
        array(),
        filemtime("$dir/$editor_css")
   );

   register_block_type('woo-berg/cart', array(
        'api_version' => 2,
        'editor_script' => 'cart-block-editor',
        'editor_style'  => 'cart-block-css',
        'style'         => 'cart-block-css',
        'render_callback' => 'render_cart_block', 
        'attributes' => array (
            'cartStyleClases' => array (
                'type' => 'string',
                'default' => 'wooberg-cart'
            )
        )

   ));

}

function render_cart_block($block_attributes, $content){

    if (WC()->cart){
        
        $products_in_cart = "";

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ){
            $product_name = $cart_item['data']->name;
            $products_in_cart .= "<div>$product_name</div>";
        }
        $cartStyleClases = $block_attributes['cartStyleClases'];

        return "

            <div class=\"$cartStyleClases\">
                <p>Cart</p>
                <p>x</p>
                $products_in_cart
            </div>

        " ;
    }

    
}


function cart_js(){
    $dir = dirname( __FILE__ );
    $cart_js = 'cart.js';

    wp_enqueue_script(
        'cart_js',
        plugins_url( $cart_js, __FILE__ ),
        array(
            'jquery'
        ),
        filemtime( "$dir/$cart_js" )
    );

}
add_action('wp_enqueue_scripts', 'cart_js');