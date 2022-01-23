<?php
/**
 *
 * Register wooberg blocks
 * @package wooberg
 */


require_once __DIR__."/product-image/register-product-image-block.php";


function register_wooberg_blocks(){

    global $pagenow;

    // Register wooberg blocks only on wooberg post type
    if (is_admin()){
        $typenow = '';
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


  
    register_image_block();

}