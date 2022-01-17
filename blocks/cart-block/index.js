(function ( blocks, blockEditor, element, components){
	var registerBlockType = blocks.registerBlockType;
	var el = element.createElement;


	var __ = wp.i18n.__;
	
	registerBlockType('woo-berg/cart', {
		apiVersion: 2,
		title: __( 'Cart', 'woo-berg' ),
		description: __('Edit Cart', 'woo-berg'),
		icon: 'text',
		keywords: [ __( 'woo' ), __( 'Cart' ) ],

		edit: function ( props ){

			return el(
				'p',
				{},
				'I am cool'
			);
		}


	});
})( 
	window.wp.blocks, 
	window.wp.blockEditor, 
	window.wp.element, 
	window.wp.components

);