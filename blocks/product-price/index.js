( function( blocks, blockEditor, element ) {

	var registerBlockType = blocks.registerBlockType;
	var RichText = blockEditor.RichText;
	var el = element.createElement;
	var useBlockProps = blockEditor.useBlockProps;

	var __ = wp.i18n.__;
	
	registerBlockType('woo-berg/product-price', {
		apiVersion: 2,
		title: __( 'Product Price', 'woo-berg' ),
		description: __('Edit woo-commerce product price', 'woo-berg'),
		icon: 'text',
		keywords: [ __( 'woo' ), __( 'product-price' ) ],

		attributes: {
			content: {
				type: 'string',
			}
		},

		edit: function( props ){
			var blockProps = useBlockProps();
			var content = props.attributes.content;

			function onChangeDescription( descriptionText ){
				props.setAttributes( { content: descriptionText } )
			}

			return el(
				RichText,
				Object.assign(	blockProps, {
					tagName: 'p',
					placeholder: 'Woo Commerce product price',
					onChange: onChangeDescription,
					value: content
				}),
			);

		},
		save: function( props ){
			return null;
		}, 
	});

} )(
	window.wp.blocks, window.wp.blockEditor, window.wp.element
);
