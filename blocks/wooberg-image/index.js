( function( blocks, blockEditor, element ) {

	var registerBlockType = blocks.registerBlockType;
	var RichText = blockEditor.RichText;
	var el = element.createElement;
	var useBlockProps = blockEditor.useBlockProps;

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
				default: 'w-32', 
			}

		},

		edit: function( props ){
			console.log(props.attributes.imageSrc);
			return el( 'img', {
				src: props.attributes.imageSrc,
				className: props.attributes.border_black
			} );

		},
		save: function( props ){
			return null;
		}, 
	});

} )(
	window.wp.blocks, window.wp.blockEditor, window.wp.element
);
