( function( blocks, blockEditor, element, components, data ) {

	var registerBlockType = blocks.registerBlockType;
	var el = element.createElement;
	var InnerBlocks = blockEditor.InnerBlocks;
	var useBlockProps = blockEditor.useBlockProps;
	var useInnerBlocksProps = blockEditor.useInnerBlocksProps;
	var useSelect = data.useSelect;
	var createBlock = blocks.createBlock;
	var dispatch = data.dispatch;
	var select = data.select;


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

	function galleryPlaceholder(setAttributes, clientId){
		
		return el( BlockVariationPicker, {
					variations: VARIATIONS,
					label: __('Product Gallery Design', 'wooberg'),
					instructions: __('Pick a design template, to start with, for your WooCommerce single product gallery', 'wooberg'),
					onSelect: function( variation ){
						if (variation){
							setAttributes({
								variation: variation,
							})
						}	
						

						var imageBlocks = [];
						for (var i = 0; i < 3; i++){
							var imageBlock = createBlock( 'wooberg/wooberg-image', {
								imageSrc: 'https://cdn.the-scientist.com/assets/articleNo/66864/aImg/35078/foresttb-m.jpg'
							});
							imageBlocks.push(imageBlock);
						}
						console.log(select('core/block-editor').getBlocks());
						console.log(clientId);

						dispatch('core/block-editor').insertBlocks(imageBlocks, 1, clientId);
						
					}
			}); 

			

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
			var blockProps = useBlockProps();
			var innerBlocksProps = useInnerBlocksProps( blockProps, {});

			var setAttributes = props.setAttributes;
			var clientId = props.clientId;
			

			var inner = null;
			if (!props.attributes.variation){

				inner = galleryPlaceholder(setAttributes, clientId);
				//return el( 'div',  blockProps, inner);
				console.log(innerBlocksProps);
				return el( 'div', innerBlocksProps );
			}


	
				
			
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
