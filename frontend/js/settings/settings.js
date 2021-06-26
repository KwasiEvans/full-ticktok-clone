(function($) {
    "use strict";

    /*-----------------------
           User Settings 
        ---------------------------*/
    function settings(url,formdata)
    {
    	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            data: formdata,
            type: "POST",
            dataType: "JSON",
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('.usersettings_update').html('Please Wait...');
            },
            success: function(response) {
                if(response.errors)
                {
                    $('.error-message-area').fadeIn();
                    $('.error-msg').html(response.errors);
                    $(".error-message-area").delay( 2000 ).fadeOut( 2000 );
                    $('.usersettings_update').html('Update');
                }

                if(response == 'ok')
                {
                    $('#current_password').val('');
                    $('#password').val('');
                    $('#password_confirmation').val('');
                    $('.alert-message-area').fadeIn();
                    $(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
                    $('.usersettings_update').html('Update');
                }
            }
        });
    }
    $(document).on('pjax:complete',function(){
    	 // user general settings
	    $('form.setting_form').on('submit',function(e){
	        e.preventDefault();
	        var url = this.action;
	        var formdata = new FormData(this);
	        settings(url,formdata);
	    });
    });
    	
    
    /*---------------------------------
            Settings form Submit
        -------------------------------------*/
    $('form.setting_form').on('submit',function(e){
        e.preventDefault();
        var url = this.action;
        var formdata = new FormData(this);
        settings(url,formdata);
    });
   
})(jQuery);