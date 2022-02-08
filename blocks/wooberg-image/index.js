( function( blocks, blockEditor, element, components ) {

	var registerBlockType = blocks.registerBlockType;
	var el = element.createElement;
	var useBlockProps = blockEditor.useBlockProps;
	var MediaUpload = blockEditor.MediaUpload;
	var Button = components.Button;

	var __ = wp.i18n.__;
	
	registerBlockType('wooberg/wooberg-image', {
		apiVersion: 2,
		title: __( 'Wooberg Image', 'wooberg' ),
		description: __('Edit wooberg image', 'wooberg'),
		icon: 'format-image',
		keywords: [ __( 'wooberg' ), __( 'wooberg image' ) ],
		attributes: {
			imageSrc : {
				type: 'string',
			},

		},
		edit: function( props ){
			var blockProps = useBlockProps();

			return el( 'div', 
						blockProps,
						el( MediaUpload, {
							onSelect: function(value){
								props.setAttributes({
								    imageSrc: value.sizes.full.url,
								})
								
							}, 
							render: function( {open:open} ){

								if(!props.attributes.imageSrc){
									return el( 'div', {
											className: 'wb-editor-media-upload'
										},
										el( Button, {
												onClick: open,
												className: 'wb-editor-btn-primary'
											},
											'Choose image'
										)

									);

									
								} else {
									return [ el( 'img', {
												src: props.attributes.imageSrc,
												onClick: open
											}),
											
									];

								}
								
							}
						}) 
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
