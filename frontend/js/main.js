(function($) {
    "use strict";

    /*---------------------------------
           Settings Menu Class Active
        -------------------------------------*/
    $('.settings-menu').on('click','li',function(){
        $(this).addClass('active').siblings().removeClass('active');
    });

    /*---------------------------------
            Data Append
        -------------------------------------*/
    var asset_url = $('#asset_url').val();
    if($('*').hasClass('grid')){
        var elem = document.querySelector('.grid');
        var infScroll = new InfiniteScroll( elem, {
            // options
            path: asset_url+'?page={{#}}',
            append: '.col-lg-4',
            history: false,
            status: '.page-load-status'
        });
    }
    
    /*---------------------------------
            Data Append with Pjax
        -------------------------------------*/
    $(document).on('pjax:complete', function(){
        if($('*').hasClass('grid')){
            var elem = document.querySelector('.grid');
            var infScroll = new InfiniteScroll( elem, {
              // options
              path: asset_url+'?page={{#}}',
              append: '.col-lg-4',
              history: false,
              status: '.page-load-status'
          });
        }
        $('.settings-menu').on('click','li',function(){
            $(this).addClass('active').siblings().removeClass('active');
        });
    });
    
    /*------------------------------
            Video Upload With Pjax
        ------------------------------------*/
    $(document).on('pjax:complete', function(){
        $('#video_upload').on('change',function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let url = $('#video_url').val();
            let form = document.getElementById('video_form');
            let formdata = new FormData(form);
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            $('.video_percentence_number').html(percentComplete.toFixed(0)+'%');
                            $('.percent').addClass('value'+percentComplete.toFixed(0));
                            if(percentComplete.toFixed(0) == 100){
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    $('.video-upload-input-area').addClass('p-0');
                                    $('.video-upload-input-area').html('<video controls autoplay muted="muted"><source src="'+e.target.result+'" type="video/mp4"></video>');
                                }
                                reader.readAsDataURL(e.target.files[0]);
                            }
                        }
                    }, false);
                    return xhr;
                },
                url: url,
                data: formdata,
                type: "POST",
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('.video-upload-input-area').html('<div class="box"><div class="percent"><svg><circle cx="70" cy="70" r="70"></circle><circle cx="70" cy="70" r="70"></circle></svg></div><div class="number"><h2 class="video_percentence_number">0%</h2></div></div>');
                },
                success: function(response) {
                    var base_url = $('#base_url').val();
                    if(response.errors)
                    {
                        $('.error-message-area').fadeIn();
                        $('.error-msg').html(response.errors);
                        $(".error-message-area").delay( 2000 ).fadeOut( 2000 );
                        $.pjax({url: base_url+'/upload', container: '#pjax-container'});
                    }else{
                       $('.video-upload-input-area').append(response);
                        if($('#caption').val() != '')
                        {
                            $('#upload_btn').removeClass('disabled');
                        }
                        
                    }
                }
            });
        });
    });

    /*------------------------
            Video Upload
        -----------------------------*/
    $('#video_upload').on('change',function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let url = $('#video_url').val();
        let form = document.getElementById('video_form');
        let formdata = new FormData(form);
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        $('.video_percentence_number').html(percentComplete.toFixed(0)+'%');
                        $('.percent').addClass('value'+percentComplete.toFixed(0));
                        if(percentComplete.toFixed(0) == 100){
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('.video-upload-input-area').addClass('p-0');
                                $('.video-upload-input-area').html('<video controls autoplay muted="muted"><source src="'+e.target.result+'" type="video/mp4"></video>');
                            }
                            reader.readAsDataURL(e.target.files[0]);
                        }
                    }
                }, false);
                return xhr;
            },
            url: url,
            data: formdata,
            type: "POST",
            dataType: "json",
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('.video-upload-input-area').html('<div class="box"><div class="percent"><svg><circle cx="70" cy="70" r="70"></circle><circle cx="70" cy="70" r="70"></circle></svg></div><div class="number"><h2 class="video_percentence_number">0%</h2></div></div>');
            },
            success: function(response) {
                var base_url = $('#base_url').val();
                if(response.errors)
                {
                    $('.error-message-area').fadeIn();
                    $('.error-msg').html(response.errors);
                    $(".error-message-area").delay( 2000 ).fadeOut( 2000 );
                    $.pjax({url: base_url+'/upload', container: '#pjax-container'});
                }else{
                   $('.video-upload-input-area').append(response);
                    if($('#caption').val() != '')
                    {
                        $('#upload_btn').removeClass('disabled');
                    }
                    
                }
            }
        });
    });

    /*-----------------------
            Post Submit
        ---------------------------*/
    $('#submit_post').on('submit',function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let url = $('#post_url').val();
        let form = document.getElementById('submit_post');
        let formdata = new FormData(form);
        formdata.append('video_file',$('#video_path').val());
        $.ajax({
            url: this.action,
            data: formdata,
            type: "POST",
            dataType: "JSON",
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#upload_btn').html('Please Wait...');
            },
            success: function(response) {
                if(response.errors)
                {
                    $('.error-message-area').fadeIn();
                    $('.error-msg').html(response.errors);
                    $(".error-message-area").delay( 2000 ).fadeOut( 2000 );
                    $('#upload_btn').html('Post');
                }else{
                    $('#upload_btn').html('Post');
                    var url = $('#base_url').val();
                    $('.ellipish-modal').removeClass('d-none');
                    $('.ellipish-close-btn').fadeOut();
                    $('.ellipish-modal-content').html('<div class="upload_success"><i class="fas fa-check"></i><h4>Your video successfully uploaded</h4><a class="pjax" href="'+url+'/upload">Upload Another Video</a><a class="pjax" href="'+url+'/user/'+response+'">View Profile</a></div>');
                }
            }
        });
    });

    /*------------------------------
            Post Submit With Pjax
        ------------------------------------*/
    $(document).on('pjax:complete', function(){
        $('#submit_post').on('submit',function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let url = $('#post_url').val();
            let form = document.getElementById('submit_post');
            let formdata = new FormData(form);
            formdata.append('video_file',$('#video_path').val());
            $.ajax({
                url: this.action,
                data: formdata,
                type: "POST",
                dataType: "JSON",
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#upload_btn').html('Please Wait...');
                },
                success: function(response) {
                    if(response.errors)
                    {
                        $('.error-message-area').fadeIn();
                        $('.error-msg').html(response.errors);
                        $(".error-message-area").delay( 2000 ).fadeOut( 2000 );
                        $('#upload_btn').html('Post');
                    }else{
                        $('#upload_btn').html('Post');
                        var url = $('#base_url').val();
                        $('.ellipish-modal').removeClass('d-none');
                        $('.ellipish-close-btn').fadeOut();
                        $('.ellipish-modal-content').html('<div class="upload_success"><i class="fas fa-check"></i><h4>Your video successfully uploaded</h4><a class="pjax" href="'+url+'/upload">Upload Another Video</a><a class="pjax" href="'+url+'/user/'+response+'">View Profile</a></div>');
                    }
                }
            });
        });
    });


})(jQuery);


/*------------------------------
        Ellipsis Modal Open
    ------------------------------------*/
function ellipsis(slug)
{
    var url = $("#ellipsis_url").val();
    $.ajax({
        url: url,
        data: { slug: slug },
        type: "GET",
        dataType: "HTML",
        beforeSend: function() {
            $('.ellipish-modal-content').html('<div class="ellipish-list text-center"> <nav><ul><li><a href="#" class="active">Report Inappropriate</a></li><li><a href="#">View Profile</a></li><li><a href="#">Go to video</a></li><li><a href="javascript:void(0)">Share</a></li><li><a href="javascript:void(0)">Copy Link</a></li><li><a href="javascript:void(0)">Embed</a></li><li><a href="javascript:void(0)">Cancel</a></li></ul> </nav></div>');
        },
        success: function(response) {
            $('.ellipish-modal-content').html(response);
        }
    });
}

/*---------------------------------
        Ads Show in video section
    ------------------------------------*/
function ads(slug)
{
    var url = $("#video_ads_url").val();
    $.ajax({
        url: url,
        data: { slug: slug },
        type: "GET",
        dataType: "HTML",
        beforeSend: function() {
        },
        success: function(response) {
            $('.video-ads-append-area').html(response);
        }
    });
}

/*------------------------------
        Modal Popup data Append
    ------------------------------------*/
function popup(slug)
{
    var url = $("#popup_url").val();
    $.ajax({
        url: url,
        data: { slug: slug },
        type: "GET",
        dataType: "HTML",
        beforeSend: function() {
            $('.loading').removeClass('d-none');
        },
        success: function(response) {
            $('.loading').addClass('d-none');
            $('.bg-modal').removeClass('d-none');
            $('.modal-content-area').html(response);
            ellipsis(slug);
            ads(slug);
        }
    });
}

/*-------------------
        Video Play
    -------------------------*/
function play() {

    var myVideo = document.getElementById("singlevideo");
    if (myVideo.paused) {
        myVideo.play();
        $('.video-action a.play').fadeOut();
    } else {
        myVideo.pause();
        $('.video-action a.play').fadeIn();
    }

}

/*-------------------
        Video Play
    -------------------------*/
function single_play() {

    var myVideo = document.getElementById("singlevideo");
    if (myVideo.paused) {
        myVideo.play();
        $('.video-action a.single_play').fadeOut();
    }else{
        myVideo.pause();
        $('.video-action a.single_play').fadeIn();
    }

}

/*------------------------
        Video Mousrover
    -----------------------------*/
function mouseover(id) {

    var getid = document.getElementById(id);

    var mediaPlayer;
    
    let slowInternetTimeout = null;

    let threshold = 500;
    
    getid.addEventListener('waiting', () => {
        slowInternetTimeout = setTimeout(() => {
            $('.loader'+id).removeClass('d-none');
        }, threshold);
    });
    getid.addEventListener('playing', () => {
        if(slowInternetTimeout != null){
            clearTimeout(slowInternetTimeout);
            slowInternetTimeout = null;
        }
    });
    
    getid.addEventListener('canplay', () => {
        $('.loader'+id).addClass('d-none');
    });

    mediaPlayer = getid;
    mediaPlayer.play();

}

/*-------------------
        Video Mouseout
    -------------------------*/
function mouseout(id) {
    var mediaPlayer;
    mediaPlayer = document.getElementById(id);
    mediaPlayer.pause();

}

/*-----------------------------
        Caption Length Check
    -------------------------------*/
function mycaption()
{
    if($("#video_path").length)
    {
        $('#upload_btn').removeClass('disabled');
    }
}

/*-------------------
        Plus Count
    -------------------------*/
var l = $('#total_limit').val();
function limit_plus() {
    l++;
    document.getElementById('total_limit').value = l;
}

/*-------------------
        Minus Count
    -------------------------*/
function limit_minus() {
    if($('#total_limit').val() > 1)
    {
        l--;
        document.getElementById('total_limit').value = l;
    }
}

/*--------------------------
        Image Preview Show
    -----------------------------*/
$(document).on('pjax:complete',function(){
    $('#ads_media').on('change',function(){
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#ads_label").css("background-image", "url("+e.target.result+")");
            $("#ads_label i").fadeOut();
        }
        reader.readAsDataURL(event.target.files[0]);
    });
});

/*-------------------
        Video Mouseout
    -------------------------*/
$('#ads_media').on('change',function(){
    var reader = new FileReader();
    reader.onload = function (e) {
        $("#ads_label").css("background-image", "url("+e.target.result+")");
        $("#ads_label i").fadeOut();
    }
    reader.readAsDataURL(event.target.files[0]);
});

/*-----------------------
        Ads Form Submit
    -------------------------*/
$('#ads_form').on('submit',function(e){
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
            $('.ads_button').html('Please Wait');
        },
        success: function(response) {
            if(response.errors) 
            {
                $('.error-message-area').fadeIn();
                $('.error-msg').html(response.errors);
                $(".error-message-area").delay( 2000 ).fadeOut( 2000 );
                $('.ads_button').html('Submit');
            }

            if (response == 'wallet_error') {
                $('.error-message-area').fadeIn();
                $('.error-msg').html('Your Balance is not Available');
                $(".error-message-area").delay( 2000 ).fadeOut( 2000 );
                $('.ads_button').html('Submit');
            }

            if(response == 'ok')
            {
                var url = $('#ads_url').val();
                $.pjax({url: url, container: '#pjax-container'});
                $('.alert-message-area').fadeIn();
                $(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
                $('.ads_button').html('Submit');
            }
        }
    });
});

/*---------------------------------
        Ads Form Submit With Pjax
    ----------------------------------*/
$(document).on('pjax:complete',function(){
    $('#ads_form').on('submit',function(e){
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
                $('.ads_button').html('Please Wait...');
            },
            success: function(response) {
                if(response.errors) 
                {
                    $('.error-message-area').fadeIn();
                    $('.error-msg').html(response.errors);
                    $(".error-message-area").delay( 2000 ).fadeOut( 2000 );
                    $('.ads_button').html('Submit');
                }


                if (response == 'wallet_error') {
                    $('.error-message-area').fadeIn();
                    $('.error-msg').html('Your Balance is not Available');
                    $(".error-message-area").delay( 2000 ).fadeOut( 2000 );
                    $('.ads_button').html('Submit');
                }

                if(response == 'ok')
                {
                    var url = $('#ads_url').val();
                    $.pjax({url: url, container: '#pjax-container'});
                    $('.alert-message-area').fadeIn();
                    $(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
                    $('.ads_button').html('Submit');
                }
            }
        });
    });
});

/*-----------------------
        Ads Close
    -------------------------*/
function ads_close()
{
    $('.video-ads-append-area').fadeOut();
}

/*-----------------------
        Ads Delete
    -------------------------*/
function ads_delete(id)
{
    if (confirm('Are You sure to delete this?')) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var ads_delete_url = $('#ads_delete_url').val();
        $.ajax({
            url: ads_delete_url,
            data: {id: id},
            type: "GET",
            dataType: "HTML",
            success: function(response) {
                if (response == 'ok') {
                    var url = $('#ads_url').val();
                    $.pjax({url: url, container: '#pjax-container'});
                    $('.alert-message-area').fadeIn();
                    $('.ale').html('Your Advertising successfully deleted');
                    $(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
                }
                console.log(response);
            }
        });
    }
}

/*-----------------------
        Ads Form Update
    -------------------------*/
$('#update_ads_form').on('submit',function(e){
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
            $('.ads_button').html('Please Wait...');
        },
        success: function(response) {
            if(response.errors) 
            {
                $('.error-message-area').fadeIn();
                $('.error-msg').html(response.errors);
                $(".error-message-area").delay( 2000 ).fadeOut( 2000 );
                $('.ads_button').html('Submit');
            }


            if (response == 'wallet_error') {
                $('.error-message-area').fadeIn();
                $('.error-msg').html('Your Balance is not Available');
                $(".error-message-area").delay( 2000 ).fadeOut( 2000 );
                $('.ads_button').html('Submit');
            }

            if(response == 'ok')
            {
                var url = $('#ads_url').val();
                $.pjax({url: url, container: '#pjax-container'});
                $('.alert-message-area').fadeIn();
                $(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
                $('.ads_button').html('Submit');
            }
        }
    });
});

/*---------------------------------
        Ads Form Update with Pjax
    -----------------------------------*/
$(document).on('pjax:complete',function(){
    $('#update_ads_form').on('submit',function(e){
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
                $('.ads_button').html('Please Wait...');
            },
            success: function(response) {
                if(response.errors) 
                {
                    $('.error-message-area').fadeIn();
                    $('.error-msg').html(response.errors);
                    $(".error-message-area").delay( 2000 ).fadeOut( 2000 );
                    $('.ads_button').html('Submit');
                }


                if (response == 'wallet_error') {
                    $('.error-message-area').fadeIn();
                    $('.error-msg').html('Your Balance is not Available');
                    $(".error-message-area").delay( 2000 ).fadeOut( 2000 );
                    $('.ads_button').html('Submit');
                }

                if(response == 'ok')
                {
                    var url = $('#ads_url').val();
                    $.pjax({url: url, container: '#pjax-container'});
                    $('.alert-message-area').fadeIn();
                    $(".alert-message-area").delay( 2000 ).fadeOut( 2000 );
                    $('.ads_button').html('Submit');
                }
            }
        });
    });
});

/*-----------------------
        Live Data Search
    -------------------------*/
function search()
{
    var data = $('#search').val();
    var url = $('#search_url').val();
    $.ajax({
        url: url,
        data: {search: data},
        type: "GET",
        dataType: "HTML",
        success: function(response) {
            $('.search-append').html(response);
        }
    });
}

/*-----------------------
        User Search
    -------------------------*/
function user_search(username)
{
    $('#search').val(username);
    $('.search-append').html('');
}

/*-----------------------
        Data Append
    -------------------------*/
$(document).on('click',function(){
    $('.search-append').html('');
});

/*-----------------------
        User Report
    -------------------------*/
function user_report(slug)
{
    var url = $("#user_report_url").val();
    $.ajax({
        url: url,
        data: { slug: slug },
        type: "GET",
        dataType: "HTML",
        beforeSend: function() {
            $('.ellipish-modal').removeClass('d-none');
            $('.ellipish-modal-content').html('<div class="ellipish-close-btn"><a href="javascript:void(0)" onclick="cancel_ellipish()"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="17" height="17" viewBox="0 0 17 17"><g></g><path d="M9.207 8.5l6.646 6.646-0.707 0.707-6.646-6.646-6.646 6.646-0.707-0.707 6.646-6.646-6.647-6.646 0.707-0.707 6.647 6.646 6.646-6.646 0.707 0.707-6.646 6.646z" fill="#ED4956" /></svg></a></div><div class="ellipish-list text-center"><form id="user_report_form"><textarea id="embed_video" class="embed_textarea" placeholder="Write report issue"></textarea><button type="submit" class="embed_action">Send Report</button></form></div>');
        },
        success: function(response) {
            $('.ellipish-modal').removeClass('d-none');
            $('.ellipish-modal-content').html(response);
        }
    });
}

/*-----------------------
        Night & Day Mode
    -------------------------*/
function mode()
{
    var url = $('#mode_url').val();
    $.ajax({
        url: url,
        data: null,
        type: "GET",
        dataType: "HTML",
        beforeSend: function() {
            
        },
        success: function(response) {
            if(response == 'night')
            {
                logo_change();
                var baseurl = $('#base_url').val();
                $('#mode').attr('href',baseurl+'/frontend/css/dark.css');
                $('#home_mode').attr('src',baseurl+'/frontend/img/white_home.png');
                $('#notification_mode').attr('src',baseurl+'/frontend/img/white_notification.png');
                $('#upload_mode').attr('src',baseurl+'/frontend/img/white_upload.png');
                $('#mode_action').html('Day Mode <div class="mode day"><i class="far fa-sun"></i></div>');
            }

            if(response == 'day')
            {
                logo_change();
                var baseurl = $('#base_url').val();
                $('#mode').attr('href',baseurl+'/frontend/css/style.css');
                $('#home_mode').attr('src',baseurl+'/frontend/img/home.png');
                $('#notification_mode').attr('src',baseurl+'/frontend/img/notification.png');
                $('#upload_mode').attr('src',baseurl+'/frontend/img/upload.png');
                $('#mode_action').html('Night Mode <div class="mode night"><i class="far fa-moon"></i></div>');

            }
        }
    });
}

/*-----------------------
        Logo Change
    -------------------------*/
function logo_change()
{
    var url = $('#logo_change_url').val();
    $.ajax({
        url: url,
        data: null,
        type: "GET",
        dataType: "HTML",
        success: function(response) {
            var baseurl = $('#base_url').val();
            $('#logo_mode').attr('src',baseurl+'/'+response);
        }
    });
}