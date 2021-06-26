(function ($) {
	"use strict";

	/*-----------------------------------
        Installer Database Seed Action
       -------------------------------------*/
	function seed()
	{
		var url = $('#seed_url').val();
		var home_url = $('#home_url').val();
		$.ajaxSetup({
	 		headers: {
	 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	 		}
	 	});
	 	$.ajax({
	 		type: 'GET',
	 		url: url,
	 		data: new FormData(this),
	 		dataType: 'html',
	 		contentType: false,
	 		cache: false,
	 		processData:false,
	 		success: function(response){ 
	 			$(".install-info").html(response);
	 			window.location.href = home_url+'/install/complete';
	 		}
	 	});
	}

	/*-----------------------------------
        Installer Database migrate Action
       -------------------------------------*/
	function migrate()
	{
		var url = $('#migrate_url').val();
		$.ajaxSetup({
	 		headers: {
	 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	 		}
	 	});
	 	$.ajax({
	 		type: 'GET',
	 		url: url,
	 		data: new FormData(this),
	 		dataType: 'html',
	 		contentType: false,
	 		cache: false,
	 		processData:false,
	 		success: function(response){ 
	 			$(".install-info").html(response);
	 			seed();
	 		}
	 	});
	}

	/*-----------------------------------
        Installer Database Check Action
       -------------------------------------*/
	function check()
	{
		var url = $('#check_url').val();
		$.ajaxSetup({
	 		headers: {
	 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	 		}
	 	});
	 	$.ajax({
	 		type: 'GET',
	 		url: url,
	 		data: new FormData(this),
	 		dataType: 'html',
	 		contentType: false,
	 		cache: false,
	 		processData:false,
	 		success: function(response){ 
	 			if (response == false) {
	 				$(".install-info").html("Could not find the database. Please check your configuration.");
	 				$(".back").removeClass('d-none');
	 			}else{	
	 				$(".install-info").html(response);
	 				migrate();
	 			}
	 		}
	 	});
	}

	 /*-----------------------------------
        Installer Submit
       -------------------------------------*/
	 $('#install_submit').on('submit',function(e){
	 	e.preventDefault();
	 	$.ajaxSetup({
	 		headers: {
	 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	 		}
	 	});
	 	$.ajax({
	 		type: 'POST',
	 		url: this.action,
	 		data: new FormData(this),
	 		dataType: 'html',
	 		contentType: false,
	 		cache: false,
	 		processData:false,
	 		beforeSend: function() {
	 			$(".loading_bar").fadeIn();
	 			$(".install-info").html("Sending Credentials");
		    },
	 		success: function(response){ 
	 			$(".install-info").html(response);
	 			check();
	 		}
	 	});
	});

})(jQuery);	
