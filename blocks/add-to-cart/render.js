( function( $ ){
	
	$(document).ready(function(){
		$('.wooberg-add-to-cart-btn').on('click', woobergAddToCartBtnHandler);

		function woobergAddToCartBtnHandler(event){
			alert('clicked');
		}
	});


	
})(
	jQuery
);