(function ( blocks, blockEditor, element, components){
	var registerBlockType = blocks.registerBlockType;
	var el = element.createElement;
	var useBlockProps = blockEditor.useBlockProps;

	var __ = wp.i18n.__;

	registerBlockType('woo-berg/cart', {
		apiVersion: 2,
		title: __( 'Cart', 'woo-berg' ),
		description: __('Edit Cart', 'woo-berg'),
		icon: 'text',
		keywords: [ __( 'woo' ), __( 'Cart' ) ],

		attributes: {
			cartStyleClases : {
				type: 'string', 
				default: 'wooberg-cart'
			}
		},

		edit: function ( props ){
			var blockProps = useBlockProps();

			return el(
				'div',
				blockProps,
				el (
					'div',
					{
						className: props.attributes.cartStyleClases,
					},
					el (
						'p',
						{},
						'Cart'
					),
					el (
						'p',
						{},
						'x'
					)
				)

			);
		},
		save: function(){
			return null
		}


	});
})( 
	window.wp.blocks, 
	window.wp.blockEditor, 
	window.wp.element, 
	window.wp.components

);