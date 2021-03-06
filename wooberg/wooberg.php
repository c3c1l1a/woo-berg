<?php
/**
 * Plugin Name:       Wooberg
 * Description:       Build templates for WooCommerce with Gutenbug blocks
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Cecilia
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wooberg
 *
 * @package           wooberg
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_blocks() {
//	error_log("creating block: ".__DIR__ . '/build');
//	register_block_type( __DIR__ . '/build/block.json' );
//	register_block_type( __DIR__ . '/build/block.jsonawef' );

    wp_register_script(
        'wooberg-test-block',
        plugins_url( "build/index.js", __FILE__ ),
        array(
            'wp-blocks',
            'wp-i18n',
            'wp-element',
            'wp-editor',
        )
    );

    register_block_type('wooberg/wooberg-test', array(
        'api_version' => 2,
        'editor_script' => 'wooberg-test-block',
    ));
}
add_action( 'init', 'create_blocks' );
