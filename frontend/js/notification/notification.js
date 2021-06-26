(function($) {
    "use strict";

    setInterval(notification, 10000); 
    
})(jQuery);
/*--------------------------
        Notification Count
    ---------------------------------*/
function notification_count()
{
    var url = $("#notification_count").val();
    $.ajax({
        url: url,
        data: null,
        type: "GET",
        dataType: "HTML",
        success: function(response) {
            if(response > 0)
            {
                $('.notification_count').removeClass('d-none');
                $('.notification_count').html(response);
            }else{
                $('.notification_count').addClass('d-none');
            }
            
        }
    });
}

/*--------------------------
        Notification Append
    ---------------------------------*/
function notification() {
    var url = $("#notification_url").val();
    $.ajax({
        url: url,
        data: null,
        type: "GET",
        dataType: "HTML",
        success: function(response) {
            $('.notification-check').load(' .notification-check');
            notification_count();
        }
    });
}

/*---------------------------
        Notification Unread 
    ---------------------------------*/
function notification_unread()
{
    var url = $("#notification_unread").val();
    $.ajax({
        url: url,
        data: null,
        type: "GET",
        dataType: "HTML",
        beforeSend: function()
        {
            $('.notification_count').addClass('d-none');
        },
        success: function(response) {
            console.log(response);
        }
    });
}