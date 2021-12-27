(function(blocks, element, blockEditor){
	var __ = wp.i18n.__;

	var registerBlockType = blocks.registerBlockType;
	var el = element.createElement;
	var InnerBlocks = blockEditor.InnerBlocks;

	const BLOCKS_TEMPLATE = [
	    [ 'core/columns', {}, 
	    	[
	    		[ 'core/column', {}, 
	    			[
	    				[ 'core/image', {}, ],
	    			]
	    		],
	    		[ 'core/column', {}, 
	    			[
	    				[ 'woo-berg/product-description']
	    			]
	    		]
	    	]
	    ]
	];

	registerBlockType('woo-berg/wb-single-product-template', {
		apiVersion: 2,
		title: __( 'Woo Berg Single product template', 'woo-berg' ),

		edit: function(props){
			return el(
				InnerBlocks,
				{
					template: BLOCKS_TEMPLATE,
					templateLock: false,
				}
			);
		},
		save: function(props){
			return null;
		}

	});
})(
	window.wp.blocks, window.wp.element, window.wp.blockEditor
);