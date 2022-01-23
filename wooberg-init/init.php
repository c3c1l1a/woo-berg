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
