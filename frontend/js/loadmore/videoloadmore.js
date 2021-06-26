(function($) {
    "use strict";

    /*-----------------------------------
        Scrollbar Active
       -------------------------------------*/
    var page = 1; 
    var scroll_top = 1;
    $(window).scroll(function() { 
        if($(window).scrollTop() == $(document).height() - $(window).height()) { 
            var d = scroll_top;
            if(d == 1)
            {
                if($('*').hasClass('trending')){
                    var url = $('#trending_url').val();
                    page++; 
                    load_more(page,url); 
                }
                if($('*').hasClass('popular')){
                    var url = $('#popular_url').val();
                    page++; 
                    load_more(page,url); 
                }
                if($('*').hasClass('latest')){
                    var url = $('#latest_url').val();
                    page++; 
                    load_more(page,url); 
                }
            }
        }
    });  

    /*-----------------------------------
        Data load from database
       -------------------------------------*/
    function load_more(page,url){
        $.ajax({
            type: "get",
            url: url+'?page=' + page,
            data: {data: 1},
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
    $(document).on('pjax:start', function() { page = 1;scroll_top = 0 });
    $(document).on('pjax:end',   function() { page = 1;scroll_top = 1  });
    if($.support.pjax){
        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() >= $(document).height()) { 
                var d = scroll_top;
                if(d == 1)
                {
                    if($('*').hasClass('trending')){
                        var url = $('#trending_url').val();
                        page++; 
                        load_more(page,url); 
                    }
                    if($('*').hasClass('popular')){
                        var url = $('#popular_url').val();
                        page++; 
                        load_more(page,url); 
                    }
                    if($('*').hasClass('latest')){
                        var url = $('#latest_url').val();
                        page++; 
                        load_more(page,url); 
                    }
                }
            }
        });  
    }

})(jQuery);