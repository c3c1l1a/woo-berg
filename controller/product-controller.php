<?php

namespace wooberg;

require_once __DIR__."/../utils/wp-util.php";

function shortcode_description($attrs) {
	$post=get_post();
	if (!$post || $post->post_type!="product")
		return "The product description will show here";

	return do_shortcode($post->post_content);
}

add_shortcode("wooberg_description","wooberg\\shortcode_description");

function shortcode_price($attrs) {
	$post=get_post();
	if (!$post || $post->post_type!="product")
		return "The price will show here";

	$price=get_post_meta($post->ID,"_price",TRUE);

	return $price;
}

add_shortcode("wooberg_price","wooberg\\shortcode_price");

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

	if (has_blocks($template_post->post_content)){
		$blocks = parse_blocks($template_post->post_content);
		foreach($blocks as $block){
			echo render_block($block);
		}
	}
}

add_filter("the_content","wooberg\\the_content",11,1);

function template_include($t) {
	$post=get_post();


	if ($post->post_type=="product"
			&& get_post_meta($post->ID,"wooberg_template_post_id",TRUE)) {

		$post->post_title = '';

		$t=locate_template("page.php");

		if (!$t)
			$t=locate_template("index.php");
	}

	return $t;
}

add_filter("template_include","wooberg\\template_include",11,1);

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

	$pages=get_pages();
	foreach ($pages as $page)
		$vars["pages"][$page->ID]=$page->post_title;

	display_template(__DIR__."/../templates/product-metabox.tpl.php",$vars);
}

function add_meta_boxes() {
	add_meta_box(
		"product_template",
		"WooBerg Template",
		"wooberg\\product_template_metabox",
		"product",
		"side"
	);
}

add_action("add_meta_boxes","wooberg\\add_meta_boxes");