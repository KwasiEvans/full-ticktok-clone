(function($) {
    "use strict";

    /*-----------------------------------
        Scrollbar Active
       -------------------------------------*/
    var user_url = $('#user_url').val();
    var user_slug = $('#user_slug').val();
    var page = 1; 
    var scroll_top = 1;
    $(window).scroll(function() { 
        if($(window).scrollTop() == $(document).height() - $(window).height()) {
            var d = scroll_top;
            if(d == 1)
            {
                if($('*').hasClass('usergrid')){
                    page++; 
                    load_more(page); 
                }
            }
        }
    });  

    /*-----------------------------------
        Data load from database
       -------------------------------------*/
    function load_more(page){
        $.ajax({
            type: "get",
            url: user_url+'?page=' + page,
            data: {id: user_slug,data: 1},
            datatype: "html",
            beforeSend: function()
            {
                $('.scroll-request').fadeIn();
            }
        }).done(function(data){

            if(data == 'no'){
                scroll_top = 0;
                $('.scroll-request').fadeOut();
                    
            }else{
                $("#results").append(data);
            }

        }).fail(function(jqXHR, ajaxOptions, thrownError){
            $('.scroll-error').fadeIn();
        });
    }


    /*----------------------------
        Pjax Start & End Action
       ----------------------------------*/
    $(document).on('pjax:start', function() { page = 1;user_url = $('#user_url').val();scroll_top = 0 });
    $(document).on('pjax:end',   function() { page = 1;user_url = $('#user_url').val();scroll_top = 1  });
    if($.support.pjax){
        $(window).scroll(function() { 
            if($(window).scrollTop() + $(window).height() >= $(document).height()) { 
                var d = scroll_top;
                if(d == 1)
                {
                    if($('*').hasClass('usergrid')){
                        page++; 
                        load_more(page); 
                    }
                }
            }
        });  
    }

})(jQuery);