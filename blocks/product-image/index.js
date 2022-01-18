( function( blocks, blockEditor, element ) {

	var registerBlockType = blocks.registerBlockType;
	var RichText = blockEditor.RichText;
	var el = element.createElement;
	var useBlockProps = blockEditor.useBlockProps;

	var __ = wp.i18n.__;
	
	registerBlockType('woo-berg/product-image', {
		apiVersion: 2,
		title: __( 'Product Image', 'woo-berg' ),
		description: __('Edit woo-commerce product image', 'woo-berg'),
		icon: 'text',
		keywords: [ __( 'woo' ), __( 'product-image' ) ],


		edit: function( props ){

			return el( 'img', {
				src: js_data.featured_image,
			} );

		},
		save: function( props ){
			return null;
		}, 
	});

} )(
	window.wp.blocks, window.wp.blockEditor, window.wp.element
);
