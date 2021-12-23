( function( blocks, blockEditor, element ) {

	var registerBlockType = blocks.registerBlockType;
	var RichText = blockEditor.RichText;
	var el = element.createElement;
	var useBlockProps = blockEditor.useBlockProps;

	var __ = wp.i18n.__;
	
	registerBlockType('woo-berg/product-description', {
		apiVersion: 2,
		title: __( 'Product Description', 'woo-berg' ),
		description: __('Edit woo-commerce product description', 'woo-berg'),
		icon: 'text',
		keywords: [ __( 'woo' ), __( 'product' ) ],
		
		attributes: {
			content: {
				type: 'array',
				source: 'children',
				selector: 'p'
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
					placeholder: 'Woo Commerce product description',
					onChange: onChangeDescription,
					value: content
				}),
			);
		},
		save: function( props ){
			console.log(props.attributes);
			var blockProps = useBlockProps.save();
			return el(
				RichText.Content,
				Object.assign(blockProps, {
					tagName: 'p',
					value: props.attributes.content
				})
			);
		}, 
	});

} )(
	window.wp.blocks, window.wp.blockEditor, window.wp.element
);
