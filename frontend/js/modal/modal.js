 (function($) {
    "use strict";
    

    /*--------------------------
        Video Play Event
       ---------------------------------*/
    if ( $("*").is("#singlevideo") ) {
        document.getElementById('singlevideo').addEventListener('play', function(e) {
            $('.video-action a.play').fadeOut();
            $('.loader').addClass('d-none');
        });
    }
    


    /*--------------------------
        Video Ended Event
       ---------------------------------*/
    if ( $("*").is("#singlevideo") ) {
        document.getElementById('singlevideo').addEventListener('ended', function(e) {
            $('.video-action a.play').fadeIn();
        });
    }

    /*--------------------------
        Video Ended Event
       ---------------------------------*/
    if ( $("*").is("#singlevideo") ) {
        document.getElementById('singlevideo').addEventListener('ended', function(e) {
            $('.video-action a.single_play').fadeIn();
        });
    }

    /*--------------------------
        Video Play Event
       ---------------------------------*/
    if ( $("*").is("#singlevideo") ) {
        document.getElementById('singlevideo').addEventListener('play', function(e) {
            $('.video-action a.single_play').fadeOut();
        });
    }

    /*--------------------------
        Modal Close Action
       ---------------------------------*/
    $('.close-btn').on('click', 'a', function() {
        $('.bg-modal').addClass('d-none');
        $('.modal-content-area').html('');
    });

    /*-------------------------------
        Ellipish Modal Close Action
       -------------------------------------*/
    $('.ellipish-close-btn').on('click', 'a', function() {
        $('.ellipish-modal').addClass('d-none');
    });


    /*-------------------------------
        Video Buffering Action
       -------------------------------------*/
    if ( $("*").is("#singlevideo") ) {
        var getid = document.getElementById("singlevideo");
        let slowInternetTimeout = null;
        let threshold = 500;
        getid.addEventListener('waiting', () => {
            slowInternetTimeout = setTimeout(() => {
                $('.loader').removeClass('d-none');
            }, threshold);
        });
        getid.addEventListener('playing', () => {
            if(slowInternetTimeout != null){
                clearTimeout(slowInternetTimeout);
                slowInternetTimeout = null;
            }
        });
        getid.addEventListener('canplay', () => {
            $('.loader').addClass('d-none');
        });
    }

    /*-------------------------------
        Video Volume Action
       -------------------------------------*/
    if ( $("*").is("#singlevideo") ) {
        $('.volume-action').on('click', 'a', function() {
           var myVideo = document.getElementById("singlevideo");
               myVideo.muted = !myVideo.muted;
               if (myVideo.muted) {
                var muted_img = $('#muted_img').val();
                $('.volume_img').attr('src',muted_img);
            }else{
                var volume_img = $('#volume_img').val();
                $('.volume_img').attr('src',volume_img);
            }
        });
    }

    /*-------------------------------
        Comment Send
       -------------------------------------*/
    $('#comment_send').on('submit',function(e){
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
            success: function(response){ 
                $('#comment').val('');
                $(".modal-comment-list").html(response);
                $('#comment_username').addClass('d-none');
                $('#comment').removeClass('comment_custom');
                $('#comment').attr('placeholder', 'Add a Comment');
                $('#comment_parent').val('');
            },
            error: function(xhr, status, error) 
            {
                $('.errorarea').show();
                $.each(xhr.responseJSON.errors, function (key, item) 
                {
                    Sweet('error',item)
                    $("#errors").html("<li class='text-danger'>"+item+"</li>")
                });
                errosresponse(xhr, status, error);
            }
        })
    });

})(jQuery);

/*-------------------------------
        Comment Reply
    -------------------------------------*/
function reply(id,username,userId)
{
    $('#comment_username').removeClass('d-none');
    $('#comment_username').html(username);
    $('#comment').addClass('comment_custom');
    $('#comment').val(null);
    $('#comment').focus();
    $('#comment').attr('placeholder', ' ');
    $('#comment_parent').val(id);
    $('#mention_id').val(userId);
}

/*-------------------------------
        Profileshow
    -------------------------------------*/
function profileshow()
{
    $('.bg-modal').addClass('d-none');
    $('.ellipish-modal').addClass('d-none');
    $('.modal-content-area').html('');
}

/*-------------------------------
        Ellipsis Modal Open
    -------------------------------------*/
function ellipsis_open(slug)
{
    ellipsis(slug);
    $('.ellipish-modal').removeClass('d-none');
}

/*-------------------------------
        Ellipsis Modal Close
    -------------------------------------*/
function cancel_ellipish()
{
    $('.ellipish-modal').addClass('d-none');
}

/*-------------------------------
        Copy Link
    -------------------------------------*/
function copy_link()
{
    document.execCommand('copy', false, document.getElementById('copy_link').select());
    $('.ellipish-modal').addClass('d-none');
    $('.copied').fadeIn();
    $(".copied").delay( 1000 ).fadeOut( 1000 );
}

/*-------------------------------
        Video Embed Copy
    -------------------------------------*/
function embed_video()
{
    document.execCommand('copy', false, document.getElementById('embed_video').select());
    $('.embed_action').html('Embed Code Copied!');
}

/*-------------------------------
        Video Embed
    -------------------------------------*/
function embed(slug)
{
    var baseurl = $('#base_url').val();
    var video_url = baseurl+'/api/video_embed/'+slug;
    $('.ellipish-list').html('<textarea id="embed_video" class="embed_textarea"><iframe src="'+video_url+'" frameborder="0" width="100%" height="100%"></iframe></textarea><a href="javascript:void(0)" onclick="embed_video()" class="embed_action">Copy Embed Code</a>');
}

/*-------------------------------
        Video Share
    -------------------------------------*/
function share(slug)
{
    var baseurl = $('#base_url').val();
    var video_url = baseurl+'/video/'+slug;
    $('.ellipish-modal').removeClass('d-none');
    $('.ellipish-list').html('<div class="share-header"><h4>Share</h4><div class="single-share"><a target="_blank" href="https://www.facebook.com/dialog/share?app_id=87741124305&href='+video_url+'%3Fv%3DRCEKC6wpj6M%26feature%3Dshare&display=popup"><i class="fab fa-facebook"></i><span>Share to Facebook</span></a></div><div class="single-share"><a target="__blank" href="https://pinterest.com/pin/create/button/?url='+video_url+'"><i class="fab fa-pinterest"></i><span>Share to Pinterest</span></a></div><div class="single-share"><a target="__blank" href="https://twitter.com/intent/tweet?url='+video_url+'&text='+slug+'"><i class="fab fa-twitter-square"></i><span>Share to Twitter</span></a></div><div class="single-share"><a target="__blank" href="mailto:?subject='+slug+'&amp;body=Check out this site '+video_url+'."><i class="far fa-envelope"></i><span>Share via Email</span></a></div><div class="single-share"><a href="javascript:void(0)" onclick="copy_link()"><i class="fas fa-link"></i><span>Copy Link</span></a></div><div class="single-share"><a href="javascript:void(0)" onclick="cancel_ellipish()"><i class="far fa-times-circle"></i><span>Cancel</span></a></div></div>');
}

/*-------------------------------
        Video Report
    -------------------------------------*/
function report(slug)
{
    var url = $("#report_url").val();
    $.ajax({
        url: url,
        data: { slug: slug },
        type: "GET",
        dataType: "HTML",
        beforeSend: function() {
            $('.ellipish-modal').removeClass('d-none');
            $('.ellipish-list').html('<form id="report_form"><textarea id="embed_video" class="embed_textarea" placeholder="Write report issue"></textarea><button type="submit" class="embed_action">Send Report</button></form>');
        },
        success: function(response) {
            $('.ellipish-modal').removeClass('d-none');
            $('.ellipish-list').html(response);
        }
    });
}

/*-------------------------------
        Video Like
    -------------------------------------*/
function like(id)
{
    var url = $("#like_url").val();
    $.ajax({
        url: url,
        data: { id: id },
        type: "GET",
        dataType: "HTML",
        beforeSend: function() {
            if ($("#like").hasClass("far fa-heart")) {
                $('#like').attr('class','fas fa-heart');
            }else{
                $('#like').attr('class','far fa-heart');
            }
        },
        success: function(response) {

        }
    });
}

/*-------------------------------
        Comment Like
    -------------------------------------*/
function comment_like(id)
{
    var url = $("#comment_like_url").val();
    $.ajax({
        url: url,
        data: { id: id },
        type: "GET",
        dataType: "HTML",
        beforeSend: function() {
            if ($("#comment_like"+id).hasClass("far fa-heart")) {
                $('#comment_like'+id).attr('class','fas fa-heart');
            }else{
                $('#comment_like'+id).attr('class','far fa-heart');
            }
        },
        success: function(response) {
            $('#comment_like_count'+id).html(response+'likes');
        }
    });
}


