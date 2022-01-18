<?php

namespace wooberg;

function render_template($fn, $vars=array()) {
	foreach ($vars as $key=>$value)
		$$key=$value;

	ob_start();
	require $fn;
	return ob_get_clean();
}

function display_template($fn, $vars=array()) {
	foreach ($vars as $key=>$value)
		$$key=$value;

	require $fn;
}

function render_select_options($options, $current=NULL) {
		$res="";

		foreach ( $options as $key => $label ) {
			$res.=sprintf(
				'<option value="%s" %s>%s</option>',
				esc_attr( $key ),
				( ( strval( $current ) === strval( $key ) ) ? 'selected' : '' ),
				esc_html( $label )
			);
		}

		return $res;
	}

function display_select_options($options, $current=NULL) {
	echo render_select_options($options,$current);
}
