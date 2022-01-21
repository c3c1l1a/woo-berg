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
                'type' => 'object',
                'default' => array( 
                    'wooberg_cart' => 'wooberg-cart',
                    'wooberg_cart_product' => 'wooberg-cart-product'
                )
            )
        )

   ));

}

function render_cart_block($block_attributes, $content){
    $currency = get_woocommerce_currency_symbol();

    if (WC()->cart){
        
        $products_in_cart = "";
        $wooberg_cart_product_class = $block_attributes['cartStyleClases']['wooberg_cart_product'];

        
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ){
            $product_name = $cart_item['data']->name;
            $product_quantity = $cart_item['quantity'];
            $total = $currency . $cart_item['line_subtotal'];
            $image_id = (int)$cart_item['data']->image_id;
            $image = wp_get_attachment_image_src($image_id)[0];
            
            $products_in_cart .= 
            "<div class=\"$wooberg_cart_product_class\">
                <img src=\"$image\"/>
                <div>
                    <p>$product_name</p>
                    <div>
                        <span class=\"dashicons dashicons-minus\"></span>
                        <p>$product_quantity</p>
                        <span class=\"dashicons dashicons-plus\"></span>
                    </div>
                </div>
                <div>
                    <img/>
                    <p>$total</p>
                </div>
            </div>";
        }
        $wooberg_cart_class = $block_attributes['cartStyleClases']['wooberg_cart'];

        return "

            <div  class=\"$wooberg_cart_class\">
                <p>Cart</p>
                <p>x</p>
                <div id=\"wooberg-cart-product-container\" class=\"wooberg-cart-product-container\">
                    $products_in_cart
                </div>
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