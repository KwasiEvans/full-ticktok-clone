(function($) {
  "use strict";

    /*-------------------------------
        Paypal Payment Integration
      ----------------------------------*/
    var baseurl = $('#base_url').val();
  	$('#paypal_form').on('submit',function(e){
  		e.preventDefault();
  		var wallet_amount = $('#wallet_amount').val();
  		if(wallet_amount != '')
  		{
  			$('#wallet').modal('hide')
  			$('#paypalb').modal('show')
  		}else{
  			console.log('no');
  		}
  	});

    var paypal_id = $('#paypal_client_id').val();
  	paypal.Button.render({
    	// Configure environment
    	env: 'production',
    	client: {
      		sandbox: paypal_id,
      		production: paypal_id
    	},
    	// Customize button (optional)
    	locale: 'en_US',
    	style: {
      		size: 'large',
      		color: 'black',
      		shape: 'pill',
      		label: 'checkout'
    	},

    	// Enable Pay Now checkout flow (optional)
    	commit: true,

    	// Set up a payment
    	payment: function(data, actions) {
			var wallet_amount = $('#wallet_amount').val();
      var currency_code = $('#currency_code').val();
	      	return actions.payment.create({
	        	transactions: [{
	          		amount: {
	            		total: wallet_amount,
	            		currency: currency_code
	          		}
	        	}]
	      	});
    	},
    	// Execute the payment
    	onAuthorize: function(data, actions) {
    		var wallet_amount = $('#wallet_amount').val();
    		var _token = $('#_token').val();
      		return actions.payment.execute().then(function() {
        	// Show a confirmation message to the buyer
        	return actions.request.post(baseurl+'/create-payment',{
	        	amount: wallet_amount,
	        	_token: _token
	      	})
        	.then(function(res) {
          		if(res == 'ok'){
          			location.reload();
          		}
        	});
      	});
	   }
  }, '#paypal-button');

})(jQuery);