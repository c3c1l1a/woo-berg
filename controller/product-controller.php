<?php

namespace wooberg;

require_once __DIR__."/../utils/wp-util.php";


function the_content($content) {

	if (!in_the_loop() ||
			!is_main_query() ||
			!is_singular("product"))
		return $content;

	$post=get_post();
	$tid=get_post_meta($post->ID,"wooberg_template_post_id",TRUE);


	if (!$tid)
		return $content;

	$template_post=get_post($tid);
	
	$content = '';
	if (has_blocks($template_post->post_content)){
		$blocks = parse_blocks($template_post->post_content);
		foreach($blocks as $block){
			$content .= render_block($block);
			
		}
	}


	return $content;
}

add_filter("the_content","wooberg\\the_content",20,1);

function template_include($t) {

	$post=get_post();

	remove_filter('pre_wp_nav_menu', 'gutenberg_output_block_nav_menu', 10);
	remove_filter('the_title', 'capital_P_dangit', 11);

	if ($post->post_type=="product"
			&& get_post_meta($post->ID,"wooberg_template_post_id",TRUE)) {

		$t = get_query_template( 'page' );

		if (!$t)
			$t=get_query_template('index');


		return $t;

	}

	return $t;
}

add_filter("template_include","wooberg\\template_include", 99999,1);



function save_post($postId, $post, $update) {
	if ($post &&
			$post->post_type=="product" &&
			$update &&
			array_key_exists("action",$_POST) &&
			$_POST["action"]=="editpost") {
		$tid=$_POST["wooberg_template_post_id"];
		update_post_meta($postId,"wooberg_template_post_id",$tid);
	}
}

add_action("save_post","wooberg\\save_post",10,3);



function product_template_metabox() {
	$post=get_post();

	$vars=array();
	$vars["pages"]=array();

	$tid=get_post_meta($post->ID,"wooberg_template_post_id",TRUE);
	$vars["wooberg_template_post_id"]=$tid;

	$args = array(
		'numberposts' => -1,
	    'post_type'=> 'wooberg',	
	);    
	$wooberg_posts = get_posts($args);
	

	if ($wooberg_posts){
		foreach ($wooberg_posts as $wooberg_post)
			$vars["pages"][$wooberg_post->ID]=$wooberg_post->post_title;
	
	}
	
	display_template(__DIR__."/../templates/product-metabox.tpl.php",$vars);
}

function add_meta_boxes() {
	add_meta_box(
		"product_template",
		"Wooberg Template",
		"wooberg\\product_template_metabox",
		"product",
		"side"
	);
}

add_action("add_meta_boxes","wooberg\\add_meta_boxes");




function post_thumbnail_html( $html, $post_id, $post_image_id ) {	
	$post=get_post();
	
	if (is_single() && $post->post_type=="product"){
		return null;
	}

	return $html;
}
add_filter( 'post_thumbnail_html', 'wooberg\\post_thumbnail_html', 10, 3 );




function the_title($title, $id) {
	$post=get_post();
	
	if (in_the_loop() && is_single() && $post->post_type=="product"){
		return null;
	}

	return $title;
}
add_filter('the_title', 'wooberg\\the_title', 10, 2);


function get_the_archive_title($title){
	$post=get_post();

	if (is_single() && $post->post_type=="product"){

		return null;
	}

	return $title;
	
}
add_filter('get_the_archive_title', 'wooberg\\get_the_archive_title');













