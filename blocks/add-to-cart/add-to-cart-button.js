( function( $ ){
	
	$(document).ready(function(){
		var addToCartButton = $('.wooberg-add-to-cart-button')
		
		addToCartButton .on('click', function(e){
			e.preventDefault();

			if ($(this).attr('data-product-id')){
				var data = {
					action: 'wooberg_ajax_add_to_cart',
					product_id: $(this).attr('data-product-id'),
					quantity: 1,
				}

				$.ajax({
					url: wc_add_to_cart_params.ajax_url,
					type: 'POST',
					data: data,
					success: function() {
		                $(document.body).trigger('added_to_cart');
		    		}
				});
			} else {
				$(document.body).trigger('added_to_cart');
			}


		});

		$(document.body).on( 'added_to_cart', function(event){
			alert('yeah');
		});

		
	});


	
})(
	jQuery
);