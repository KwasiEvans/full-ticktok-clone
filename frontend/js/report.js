(function($) {
	"use strict";

	/*-------------------------
          Report Form Submit
        ---------------------------*/
	$('#report_form').on('submit',function(e){
		e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: this.action,
			data: new FormData(this),
			type: "POST",
			dataType: "JSON",
			processData: false,
			contentType: false,
			beforeSend: function() {

			},
			success: function(response) {
				if(response.errors) 
				{
					$('.error-message-area').fadeIn();
					$('.error-msg').html(response.errors);
					$(".error-message-area").delay( 2000 ).fadeOut( 2000 );
				}

				if(response == 'ok')
				{
					$('.ellipish-modal').addClass('d-none');
					$('.alert-message-area').fadeIn();
					$('.ale').html('Your Report Successfully Sent');
					$(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
				}
			}
		});
	});

	/*---------------------------------
           User Report Form Submit 
        -------------------------------------*/
	$('#user_report_form').on('submit',function(e){
		e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: this.action,
			data: new FormData(this),
			type: "POST",
			dataType: "JSON",
			processData: false,
			contentType: false,
			beforeSend: function() {

			},
			success: function(response) {
				if(response.errors) 
				{
					$('.error-message-area').fadeIn();
					$('.error-msg').html(response.errors);
					$(".error-message-area").delay( 2000 ).fadeOut( 2000 );
				}

				if(response == 'ok')
				{
					$('.ellipish-modal').addClass('d-none');
					$('.alert-message-area').fadeIn();
					$('.ale').html('Your Report Successfully Sent');
					$(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
				}
			}
		});
	});

})(jQuery);