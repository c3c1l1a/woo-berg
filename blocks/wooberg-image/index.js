( function( blocks, blockEditor, element, components ) {

	var registerBlockType = blocks.registerBlockType;
	var el = element.createElement;
	var useBlockProps = blockEditor.useBlockProps;
	var InspectorControls = blockEditor.InspectorControls;
	var PanelBody = components.PanelBody;
	var ColorPalette = components.ColorPalette;




	var __ = wp.i18n.__;
	
	registerBlockType('wooberg/wooberg-image', {
		apiVersion: 2,
		title: __( 'Wooberg Image', 'wooberg' ),
		description: __('Edit wooberg image', 'wooberg'),
		icon: 'format-image',
		keywords: [ __( 'wooberg' ), __( 'wooberg-image' ) ],
		attributes: {
			imageSrc : {
				type: 'string',
				default: js_data.featured_image
			},
			border_black : {
				type: 'string',
				default: '', 
			}

		},
		styles: [
			{
				name: 'wooberg-product-gallery wooberg-product-gallery-1',
				label: __('1'),
				isDefault: true

			}

		],

		edit: function( props ){
			var blockProps = useBlockProps();

			function onChange_background_color(bg_color){
				props.setAttributes({ 'style': {
					'background-color': bg_color,
				} });
			}


			return  el( 'div', 
				blockProps, 
				el( InspectorControls,
					{ key: 'background-color' },
					el(
						PanelBody,
						{
							title: 'Background Color',
							initialOpen: false,

						},
						el(
							ColorPalette,
							{
								onChange: onChange_background_color,
							}
						)
					), 
				),
				el( 'img', {
					src: props.attributes.imageSrc,
				} ),
				el( 'div', 
					{}, 
					el( 'img', {
						src: props.attributes.imageSrc,
					} ),
					el( 'img', {
						src: props.attributes.imageSrc,
					} ),
					el( 'img', {
						src: props.attributes.imageSrc,
					} )
				)
				
			); 

		},
		save: function( props ){
			return null;
		}, 
	});

} )(
	window.wp.blocks, 
	window.wp.blockEditor, 
	window.wp.element,
	window.wp.components
);
