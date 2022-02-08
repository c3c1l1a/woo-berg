( function( blocks, blockEditor, element, components, data ) {

	var registerBlockType = blocks.registerBlockType;
	var el = element.createElement;
	var InnerBlocks = blockEditor.InnerBlocks;
	var useBlockProps = blockEditor.useBlockProps;
	var useSelect = data.useSelect;


	var BlockVariationPicker = blockEditor.__experimentalBlockVariationPicker;
	var Button = components.Button;

	var __ = wp.i18n.__;


	
	const VARIATIONS = [
		{ 
			name: 'design-1',
		},
		{ 
			name: 'design-2',
		}
	];

	function galleryPlaceholder(setAttributes){
		var blockProps = useBlockProps();
		return el( 'div', blockProps, 

						el( BlockVariationPicker, {
							variations: VARIATIONS,
							label: __('Product Gallery Design', 'wooberg'),
							instructions: __('Pick a design template, to start with, for your WooCommerce single product gallery', 'wooberg'),
							onSelect: function( variation ){
								if (variation){
									setAttributes({
										variation: variation,
									})
								}
								
							}
						}) 

			)

	}

	registerBlockType('wooberg/wooberg-product-gallery', {
		apiVersion: 2,
		title: __( 'Wooberg Product Gallery', 'wooberg' ),
		description: __('Edit wooberg product gallery', 'wooberg'),
		icon: 'format-image',
		keywords: [ __( 'wooberg' ), __( 'wooberg product gallery' ) ],
		
		attributes: {
			variation: [
				{
					name: 'string',
				}
			]
		}, 
		edit: function( props ){
			var setAttributes = props.setAttributes;
			
			if (!props.attributes.variation)
				return galleryPlaceholder(setAttributes);
			else 
				return el('p', {}, 'yaha')
		},

		save: function( props ){
			return null;
		}, 
	});

} )(
	window.wp.blocks, 
	window.wp.blockEditor, 
	window.wp.element,
	window.wp.components,
	window.wp.data
);
