<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package woo-berg
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/tutorials/block-tutorial/applying-styles-with-stylesheets/
 * 
 */


require_once __DIR__."/product-image/register-product-image-block.php";


function blocks_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = dirname( __FILE__ );

	
	/*
	 * 
	 * Login Block 
	 * 
	 * 
	 * */
	$login_block_js = 'login/index.js';
	wp_register_script(
		'login-block-editor',
		plugins_url( $login_block_js, __FILE__ ),
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
		),
		filemtime( "$dir/$login_block_js" )
	);


	$editor_css = 'login/editor.css';
	wp_register_style(
		'login-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'login/style.css';
	wp_register_style(
		'login-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'woo-berg/login', array(
		'editor_script' => 'login-block-editor',
		'editor_style'  => 'login-block-editor',
		'style'         => 'login-block',
	) );


	/*
	 * 
	 * Product Description Block 
	 * 
	 * 
	 * */

	$product_desciption_block_js = 'product-description/index.js';
	wp_register_script(
		'product-description-block-editor',
		plugins_url( $product_desciption_block_js, __FILE__ ),
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
			'wp-editor',
		),
		filemtime( "$dir/$product_desciption_block_js" )
	);

	register_block_type('woo-berg/product-description', array(
		'editor_script' => 'product-description-block-editor',
		'render_callback' => 'render_product_description'
	));



	/*
	*
	*	Woo Berg single product template
	*	
	*/
	$wb_single_product_template = 'wb-single-product-template/index.js';
	wp_register_script(
		'wb-single-product-template',
		plugins_url( $wb_single_product_template, __FILE__ ),
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
			'wp-editor',
		),
		filemtime( "$dir/$wb_single_product_template" )
	);

	register_block_type('woo-berg/wb-single-product-template', array(
		'editor_script' => 'wb-single-product-template',
		//'render_callback' => 'render_product_description'
	));


	/*
	*
	*
	* 	Woo Berg Product Image
	*
	*
	*/

	register_image_block();

}

function render_product_description( $block_attributes, $content ){
	$post = get_post();
	if (!$post || $post->post_type!="product")
		return "The description will show here";

	return $post->post_content;
}


add_action( 'init', 'blocks_init' );
