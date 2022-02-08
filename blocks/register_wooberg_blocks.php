<?php
/**
 *
 * Register wooberg blocks
 * @package wooberg
 */


require_once __DIR__."/wooberg-image/register-wooberg-image-block.php";
require_once __DIR__."/wooberg-product-gallery/register-wooberg-product-gallery-block.php";


function register_wooberg_blocks(){

    global $pagenow;

    // Register wooberg blocks only on wooberg post type
    if (is_admin()){
        $typenow = '';
        $post_id = null;
        if ( 'post-new.php' === $pagenow ) {
            if ( isset( $_REQUEST['post_type'] ) && post_type_exists( $_REQUEST['post_type'] ) ) {
                $typenow = $_REQUEST['post_type'];
            };

        } elseif ('post.php' === $pagenow) {
            
            if ( isset( $_GET['post'] ) && isset( $_POST['post_ID'] ) 
                && (int) $_GET['post'] !== (int) $_POST['post_ID'] ) {

                // Moving oN
            }  elseif ($_GET['post']){
                $post_id = (int)$_GET['post'];
            } elseif ($_POST['post_ID']){
                $post_id = $_POST['post_ID'];
            }
        }

        if ( $post_id ) {
            $post = get_post( $post_id );
            $typenow = $post->post_type;
        }

        if ($typenow != 'wooberg') {
            return;
        }
    }


  
    register_wooberg_image_block();
    register_wooberg_product_gallery_block();

}