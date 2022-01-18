( function($){
	$(document).ready(function(){

		var wooberg_cart = $('.wooberg-cart');


		$(document.body).on('added_to_cart', function(e){

			if (wooberg_cart.hasClass('wooberg-cart-slide-out'))
				wooberg_cart.removeClass('wooberg-cart-slide-out');
			
			wooberg_cart.addClass('wooberg-cart-slide-in');
			wooberg_cart.show();
			
		});

		$('.wooberg-cart p:nth-child(2)').on('click', function(){
			if (wooberg_cart.hasClass('wooberg-cart-slide-in'))
				wooberg_cart.removeClass('wooberg-cart-slide-in')
			
			wooberg_cart.addClass('wooberg-cart-slide-out');
		
			setTimeout(function(){
				wooberg_cart.hide();
			}, 300);
			
			
		});
	

	});
})(
	jQuery
);