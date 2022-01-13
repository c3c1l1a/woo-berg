( function( blocks, blockEditor, element, components ) {
	
	var registerBlockType = blocks.registerBlockType;
	var Button = components.Button;
	var PanelBody = components.PanelBody;
	var ColorPalette = components.ColorPalette;
	var el = element.createElement;
	var useBlockProps = blockEditor.useBlockProps;
	var InspectorControls = blockEditor.InspectorControls;

	var __ = wp.i18n.__;
	
	registerBlockType('woo-berg/add-to-cart', {
		apiVersion: 2,
		title: __( 'Add To Cart', 'woo-berg' ),
		description: __('Edit Add to cart', 'woo-berg'),
		icon: 'text',
		keywords: [ __( 'woo' ), __( 'add to cart' ) ],

		attributes : {
			buttonStyleClasses: {
				type: 'string', 
				default: 'btn btn-primary w-50'
			},
		},

		edit: function( props ){
	
			var blockProps = useBlockProps();
			//var content = props.attributes.content;

			

			function onChange_background_color(bg_color){
				props.setAttributes({ 'style': {
					'background-color': bg_color,
				} });
			}
			
		
			return [
				el(
					'div',
					blockProps,
					el(
						InspectorControls,
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

					el (
						'a' ,
						{ 
							className : props.attributes.buttonStyleClasses,
						},
						'Add to cart'
					)
				)
				
			];
		},
		save: function( props ){
			return null;
		}, 
	});

} )(
	window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.components
);


