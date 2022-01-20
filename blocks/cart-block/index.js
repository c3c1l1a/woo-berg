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
				type: 'object', 
				default: {
					'wooberg_cart': 'wooberg-cart',
					'wooberg_cart_product': 'wooberg-cart-product'
				}
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
						className: props.attributes.cartStyleClases.wooberg_cart,
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
					),
					el(
						'div',
						{
							className: props.attributes.cartStyleClases.wooberg_cart_product
						},
						el ( 
							'img', {}, 
						),
						el ( 
							'div', {}, 
							el(
								'p', {}, 'Title'
							),
							el (
								'div',
								{},
								el(
									'p', {}, '-'
								), 
								el(
									'p', {}, '2'
								),
								el(
									'p', {}, '+'
								),

							)

						),
						el ( 'div', {}, 
							el(
								'img',
								{},
								
							),
							el (
								'p',
								{},
								'$45'
							)

						)

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