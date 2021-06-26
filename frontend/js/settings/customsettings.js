(function($) {
	"use strict";

	/*----------------------------
        	Profile Img Update
    	---------------------------------*/
	function profile_img()
	{
		var url = $('#profile_img_url').val();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		let token = $('#csrf_token_get').val();
		let form = document.getElementById('profile_form');
		let formdata = new FormData(form);
		formdata.append('_token',token);
		$.ajax({
			url: url,
			data: formdata,
			type: "POST",
			dataType: "JSON",
			processData: false,
			contentType: false,
			beforeSend: function() {
				var reader = new FileReader();
				reader.onload = function (e) {
					$("#profile_img").css("background-image", "url("+e.target.result+")");
					console.log(e.target.result);
					$("#profile_img i").fadeOut();
				}
				reader.readAsDataURL(event.target.files[0]);
			},
			success: function(response) {
				if(response.errors) 
				{
					$('.error-message-area').fadeIn();
					$('.error-msg').html(response.errors);
					$(".error-message-area").delay( 2000 ).fadeOut( 2000 );
				};
				if(response == 'ok')
				{
					$('.alert-message-area').fadeIn();
					$('.ale').html('Your Profile Image Successfully Updated')
					$(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
				}
			}
		});
	}

	/*----------------------------
        	Cover Img Update
    	---------------------------------*/
	function cover_img()
	{
		var url = $('#cover_img_url').val();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		let form = document.getElementById('cover_form');
		let formdata = new FormData(form);
		$.ajax({
			url: url,
			data: formdata,
			type: "POST",
			dataType: "JSON",
			processData: false,
			contentType: false,
			beforeSend: function() {
				var reader = new FileReader();
				reader.onload = function (e) {
					$("#cover_img").css("background-image", "url("+e.target.result+")");
					console.log(e.target.result);
					$("#cover_img i").fadeOut();
				}
				reader.readAsDataURL(event.target.files[0]);
			},
			success: function(response) {
				if(response.errors) 
				{
					$('.error-message-area').fadeIn();
					$('.error-msg').html(response.errors);
					$(".error-message-area").delay( 2000 ).fadeOut( 2000 );
				};
				if(response == 'ok')
				{
					$('.alert-message-area').fadeIn();
					$('.ale').html('Your Cover Image Successfully Updated')
					$(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
				}
			}
		});
	}

	/*----------------------------
        	Cover Img Update
    	---------------------------------*/
	$('#cover').on('change',function(){
		cover_img();
	});
	$(document).on('pjax:complete',function(){
		$('#cover').on('change',function(){
			cover_img();
		});
	});

	/*----------------------------
        	Profile Img Update
    	---------------------------------*/
	$('#profile').on('change',function(){
		profile_img();
	});
	$(document).on('pjax:complete',function(){
		$('#profile').on('change',function(){
			profile_img();
		});
		$('#verification_id').on('change',function(){
			var reader = new FileReader();
			reader.onload = function (e) {
				$("#national_card").css("background-image", "url("+e.target.result+")");
				console.log(e.target.result);
				$("#national_card svg").fadeOut();
			}
			reader.readAsDataURL(event.target.files[0]);
		});
	});


	/*------------------------------------
        	National Id Card Verification
    	--------------------------------------*/
	$('#verification_form').on('submit',function(e){
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
			beforeSend: function()
			{
				$('#profile_verify').html('Please Wait...');
			},
			success: function(response) {
				if(response.errors) 
				{
					$('.error-message-area').fadeIn();
					$('.error-msg').html(response.errors);
					$(".error-message-area").delay( 2000 ).fadeOut( 2000 );
					$('#profile_verify').html('Submit');
				};
				if(response == 'ok')
				{
					$('.settings-content-area').html('<div class="review-verification text-center"><i class="fas fa-history"></i><div class="review-info"><h4>Your request was received and is pending approval</h4></div></div>');
					$('.alert-message-area').fadeIn();
					$('.ale').html('Your Request Successfully Sent')
					$(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
					$('#profile_verify').html('Submit');
				}
			}
		});
	});
	$(document).on('pjax:complete',function(){
		$('#verification_form').on('submit',function(e){
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
				beforeSend: function()
				{
					$('#profile_verify').html('Please Wait...');
				},
				success: function(response) {
					if(response.errors) 
					{
						$('.error-message-area').fadeIn();
						$('.error-msg').html(response.errors);
						$(".error-message-area").delay( 2000 ).fadeOut( 2000 );
						$('#profile_verify').html('Submit');
					};
					if(response == 'ok')
					{
						$('.verification_area').html('<div class="review-verification text-center"><i class="fas fa-history"></i><div class="review-info"><h4>Your request was received and is pending approval</h4></div></div>');
						$('.alert-message-area').fadeIn();
						$('.ale').html('Your Request Successfully Sent')
						$(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
						$('#profile_verify').html('Submit');
					}
				}
			});
		});
	});

	/*----------------------------
        	Img Preview Show
    	---------------------------------*/
	$('#verification_id').on('change',function(){
		var reader = new FileReader();
		reader.onload = function (e) {
			$("#national_card").css("background-image", "url("+e.target.result+")");
			console.log(e.target.result);
			$("#national_card svg").fadeOut();
		}
		reader.readAsDataURL(event.target.files[0]);
	});

	/*----------------------------
        	Two Step Verification
    	---------------------------------*/
	$('#two_step_form').on('submit',function(e){
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
			beforeSend: function()
			{
				$('#two_factor_button').html('Please Wait...');
			},
			success: function(response) {
				if(response.errors) 
				{
					$('.error-message-area').fadeIn();
					$('.error-msg').html(response.errors);
					$(".error-message-area").delay( 2000 ).fadeOut( 2000 );
					$('#two_factor_button').html('Submit');
				};
				if(response == 'ok')
				{
					$('.alert-message-area').fadeIn();
					$('.ale').html('Settings successfully updated!')
					$(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
					$('#two_factor_button').html('Submit');
				}
			}
		});
	});
	$(document).on('pjax:complete',function(){
		$('#two_step_form').on('submit',function(e){
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
				beforeSend: function()
				{
					$('#two_factor_button').html('Please Wait...');
				},
				success: function(response) {
					if(response.errors) 
					{
						$('.error-message-area').fadeIn();
						$('.error-msg').html(response.errors);
						$(".error-message-area").delay( 2000 ).fadeOut( 2000 );
						$('#two_factor_button').html('Submit');
					};
					if(response == 'ok')
					{
						$('.alert-message-area').fadeIn();
						$('.ale').html('Settings successfully updated!')
						$(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
						$('#two_factor_button').html('Submit');
					}
				}
			});
		});
	});

	/*----------------------------
        	Delete Account
    	---------------------------------*/
	$('#delete_form').on('submit',function(e){
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
			dataType: "html",
			processData: false,
			contentType: false,
			beforeSend: function()
			{
				$('#delete_form_button').html('Please Wait...');
			},
			success: function(response) {
				if(response == 'error')
				{
					$('.error-message-area').fadeIn();
					$('.error-msg').html('Your Password is incorrect');
					$(".error-message-area").delay( 2000 ).fadeOut( 2000 );
					$('#delete_form_button').html('Submit');
				}else{
					window.history.pushState("","",response);
					location.reload();
				}
			}
		});
	});
	$(document).on('pjax:complete',function(){
		$('#delete_form').on('submit',function(e){
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
				dataType: "html",
				processData: false,
				contentType: false,
				beforeSend: function()
				{
					$('#delete_form_button').html('Please Wait...');
				},
				success: function(response) {
					if(response == 'error')
					{
						$('.error-message-area').fadeIn();
						$('.error-msg').html('Your Password is incorrect');
						$(".error-message-area").delay( 2000 ).fadeOut( 2000 );
						$('#delete_form_button').html('Submit');
					}else{
						window.history.pushState("","",response);
						location.reload();
					}
				}
			});
		});
	});

	/*----------------------------
        	Delete Session
    	---------------------------------*/
	function delete_session(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var url = $('#delete_session_url').val();
		$.ajax({
			url: url,
			data: {data: null},
			type: "get",
			dataType: "html",
			processData: false,
			contentType: false,
			success: function(response) {
				window.history.pushState("","",response);
				location.reload();
			}
		});
	}

	/*-------------------------------------------
        	Delete Session Confirm Notification
    	-----------------------------------------------*/
	$('.delete-session').on('click','a',function(e){
		e.preventDefault();
		if (confirm('Are you sure you want to log out from this device?')) {
			delete_session();
		}
	});
	$(document).on('pjax:complete',function(){
		$('.delete-session').on('click','a',function(e){
			e.preventDefault();
			if (confirm('Are you sure you want to log out from this device?')) {
				delete_session();
			}
		});
	});

	/*---------------------------------
        	Monetization Request Send
    	-------------------------------------*/
	function monetization_request()
	{
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var url = $('#monetization_request_url').val();
		$.ajax({
			url: url,
			data: {data: null},
			type: "get",
			dataType: "html",
			beforeSend: function(){
				$('#monetization_request').html('Please Wait...');
			},
			success: function(response) {
				$('.monetization_area').html('<div class="review-verification text-center"><i class="fas fa-history"></i><div class="review-info"><h4>Your request was received and is pending approval</h4></div></div>');
				$('.alert-message-area').fadeIn();
				$('.ale').html('Your Request Successfully Sent')
				$(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
				$('#monetization_request').html('Send Monetization Request');
			}
		});
	}

	/*---------------------------------
        	Monetization Request Send
    	-------------------------------------*/
	$('#monetization_request').on('click',function(e){
		e.preventDefault();
		monetization_request();
	});
	$(document).on('pjax:complete',function(){
		$('#monetization_request').on('click',function(e){
			e.preventDefault();
			monetization_request();
		});
	});

	/*---------------------------------
        	Withdraw Request Send
    	-------------------------------------*/
	$('.withdraw_form').on('submit',function(e){
		e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var withdraw_url = $('#withdraw_index').val();
		$.ajax({
			url: this.action,
			data: new FormData(this),
			type: "POST",
			dataType: "JSON",
			processData: false,
			contentType: false,
			beforeSend: function() {
				$('.withdraw_button').html('Please Wait...');
			},
			success: function(response) {
				if(response.errors) 
				{
					$('.error-message-area').fadeIn();
					$('.error-msg').html(response.errors);
					$(".error-message-area").delay( 2000 ).fadeOut( 2000 );
					$('.withdraw_button').html('Submit withdrawal request');
				};

				if(response == 'ok')
				{
					$.pjax({url: withdraw_url, container: '#pjax-container'});
					$('.alert-message-area').fadeIn();
					$('.ale').html('Your Withdraw Request Successfully Sent');
					$(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
					$('.withdraw_button').html('Submit withdrawal request');
				}

				if(response == 'wallet_error')
				{
					$('.error-message-area').fadeIn();
					$('.error-msg').html('Your balence is not available');
					$(".error-message-area").delay( 2000 ).fadeOut( 2000 );
					$('.withdraw_button').html('Submit withdrawal request');
				}

				if(response == 'wallet_not')
				{
					$('.error-message-area').fadeIn();
					$('.error-msg').html('Your balance must be greater than $50');
					$(".error-message-area").delay( 2000 ).fadeOut( 2000 );
					$('.withdraw_button').html('Submit withdrawal request');
				}

			}
		});
	});
	$(document).on('pjax:complete',function(){
		$('.withdraw_form').on('submit',function(e){
			e.preventDefault();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			var withdraw_url = $('#withdraw_index').val();
			$.ajax({
				url: this.action,
				data: new FormData(this),
				type: "POST",
				dataType: "JSON",
				processData: false,
				contentType: false,
				beforeSend: function() {
					$('.withdraw_button').html('Please Wait...');
				},
				success: function(response) {
					if(response.errors) 
					{
						$('.error-message-area').fadeIn();
						$('.error-msg').html(response.errors);
						$(".error-message-area").delay( 2000 ).fadeOut( 2000 );
						$('.withdraw_button').html('Submit withdrawal request');
					};

					if(response == 'ok')
					{
						$.pjax({url: withdraw_url, container: '#pjax-container'});
						$('.alert-message-area').fadeIn();
						$('.ale').html('Your Withdraw Request Successfully Sent');
						$(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
						$('.withdraw_button').html('Submit withdrawal request');
					}

					if(response == 'wallet_error')
					{
						$('.error-message-area').fadeIn();
						$('.error-msg').html('Your balence is not available');
						$(".error-message-area").delay( 2000 ).fadeOut( 2000 );
						$('.withdraw_button').html('Submit withdrawal request');
					}

					if(response == 'wallet_not')
					{
						$('.error-message-area').fadeIn();
						$('.error-msg').html('Your balance must be greater than $50');
						$(".error-message-area").delay( 2000 ).fadeOut( 2000 );
						$('.withdraw_button').html('Submit withdrawal request');
					}

				}
			});
		});
	});

})(jQuery);