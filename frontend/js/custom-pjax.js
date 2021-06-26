(function($) {
	"use strict";

	/*---------------------------------
        	Pjax Active
    	-------------------------------------*/
	$.pjax.defaults.timeout = 90000;
	$(document).pjax('a.pjax','#pjax-container');
	$(document).on('pjax:start', function() { NProgress.start();$('.video-empty').html(''); });
	$(document).on('pjax:end',   function() { NProgress.done();$('.video-empty').html('');  });

})(jQuery);