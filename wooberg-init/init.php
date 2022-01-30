<?php
/**
 * Functions to create Wooberg post type.
 *
 * @package wooberg
 * 
 */

namespace wooberg;

require_once __DIR__."/../blocks/register_wooberg_blocks.php";

function init(){
    register_post_type('wooberg', array(
        'labels' => array(
            'name' => __('Wooberg'),
            'singular_name' => __('Wooberg')
        ),
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'rewrite'     => array( 'slug' => 'woberg' ),
        'suports' => array(
            'editor',
            'revisions'
        ),

    ));


    register_wooberg_blocks();

}
add_action('init', 'wooberg\\init');


function enqueue_block_assets(){
    $blocks_css = '/../css/styles.prod.css';

    wp_enqueue_style(
        'wooberg_block_styles',
        plugins_url( $blocks_css, __FILE__ ),
        array(),
    );
}

add_action( 'enqueue_block_assets', 'wooberg\\enqueue_block_assets' );
