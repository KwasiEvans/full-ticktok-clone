(function($) {
  "use strict";

    /*----------------------------
        Sidebar Menu Active
        ------------------------------*/
        let sidebar_nicescroll_opts = {
          cursoropacitymin: 0,
          cursoropacitymax: .8,
          zindex: 892
        }, now_layout_class = null;

        var sidebar_sticky = function() {
          if($("body").hasClass('layout-2')) {
            $("body.layout-2 #sidebar-wrapper").stick_in_parent({
              parent: $('body')
            });
            $("body.layout-2 #sidebar-wrapper").stick_in_parent({recalc_every: 1});
          }
        }
        sidebar_sticky();
        var sidebar_nicescroll;
        var update_sidebar_nicescroll = function() {
          let a = setInterval(function() {
            if(sidebar_nicescroll != null)
              sidebar_nicescroll.resize();
          }, 10);

          setTimeout(function() {
            clearInterval(a);
          }, 600);
        }

        var sidebar_dropdown = function() {
          if($(".main-sidebar").length) {
            $(".main-sidebar").niceScroll(sidebar_nicescroll_opts);
            sidebar_nicescroll = $(".main-sidebar").getNiceScroll();

            $(".main-sidebar .sidebar-menu li a.has-dropdown").off('click').on('click', function() {
              var me     = $(this);
              var active = false;
              if(me.parent().hasClass("active")){
                active = true;
              }
              
              $('.main-sidebar .sidebar-menu li.active > .dropdown-menu').slideUp(500, function() {
                update_sidebar_nicescroll();          
                return false;
              });
              
              $('.main-sidebar .sidebar-menu li.active').removeClass('active');

              if(active==true) {
                me.parent().removeClass('active');          
                me.parent().find('> .dropdown-menu').slideUp(500, function() {            
                  update_sidebar_nicescroll();
                  return false;
                });
              }else{
                me.parent().addClass('active');          
                me.parent().find('> .dropdown-menu').slideDown(500, function() {            
                  update_sidebar_nicescroll();
                  return false;
                });
              }

              return false;
            });

            $('.main-sidebar .sidebar-menu li.active > .dropdown-menu').slideDown(500, function() {
              update_sidebar_nicescroll();        
              return false;
            });
          }
        }
        sidebar_dropdown();

        if($("#top-5-scroll").length) {
          $("#top-5-scroll").css({
            height: 315
          }).niceScroll();
        }

        $(".main-content").css({
          minHeight: $(window).outerHeight() - 108
        })

        $(".nav-collapse-toggle").on('click',function() {
          $(this).parent().find('.navbar-nav').toggleClass('show');
          return false;
        });

        $(document).on('click', function(e) {
          $(".nav-collapse .navbar-nav").removeClass('show');
        });

        var toggle_sidebar_mini = function(mini) {
          let body = $('body');

          if(!mini) {
            body.removeClass('sidebar-mini');
            $(".main-sidebar").css({
              overflow: 'hidden'
            });
            setTimeout(function() {
              $(".main-sidebar").niceScroll(sidebar_nicescroll_opts);
              sidebar_nicescroll = $(".main-sidebar").getNiceScroll();
            }, 500);
            $(".main-sidebar .sidebar-menu > li > ul .dropdown-title").remove();
            $(".main-sidebar .sidebar-menu > li > a").removeAttr('data-toggle');
            $(".main-sidebar .sidebar-menu > li > a").removeAttr('data-original-title');
            $(".main-sidebar .sidebar-menu > li > a").removeAttr('title');
          }else{
            body.addClass('sidebar-mini');
            body.removeClass('sidebar-show');
            sidebar_nicescroll.remove();
            sidebar_nicescroll = null;
            $(".main-sidebar .sidebar-menu > li").each(function() {
              let me = $(this);

              if(me.find('> .dropdown-menu').length) {
                me.find('> .dropdown-menu').hide();
                me.find('> .dropdown-menu').prepend('<li class="dropdown-title pt-3">'+ me.find('> a').text() +'</li>');
              }else{
                me.find('> a').attr('data-toggle', 'tooltip');
                me.find('> a').attr('data-original-title', me.find('> a').text());
                $("[data-toggle='tooltip']").tooltip({
                  placement: 'right'
                });
              }
            });
          }
        }

        $("[data-toggle='sidebar']").on('click',function() {
          var body = $("body"),
          w = $(window);

          if(w.outerWidth() <= 1024) {
            body.removeClass('search-show search-gone');
            if(body.hasClass('sidebar-gone')) {
              body.removeClass('sidebar-gone');
              body.addClass('sidebar-show');
            }else{
              body.addClass('sidebar-gone');
              body.removeClass('sidebar-show');
            }

            update_sidebar_nicescroll();
          }else{
            body.removeClass('search-show search-gone');
            if(body.hasClass('sidebar-mini')) {
              toggle_sidebar_mini(false);
            }else{
              toggle_sidebar_mini(true);
            }
          }

          return false;
        });

        var toggleLayout = function() {
          var w = $(window),
          layout_class = $('body').attr('class') || '',
          layout_classes = (layout_class.trim().length > 0 ? layout_class.split(' ') : '');

          if(layout_classes.length > 0) {
            layout_classes.forEach(function(item) {
              if(item.indexOf('layout-') != -1) {
                now_layout_class = item;
              }
            });
          }

          if(w.outerWidth() <= 1024) {
            if($('body').hasClass('sidebar-mini')) {
              toggle_sidebar_mini(false);
              $('.main-sidebar').niceScroll(sidebar_nicescroll_opts);
              sidebar_nicescroll = $(".main-sidebar").getNiceScroll();
            }

            $("body").addClass("sidebar-gone");
            $("body").removeClass("layout-2 layout-3 sidebar-mini sidebar-show");
            $("body").off('click touchend').on('click touchend', function(e) {
              if($(e.target).hasClass('sidebar-show') || $(e.target).hasClass('search-show')) {
                $("body").removeClass("sidebar-show");
                $("body").addClass("sidebar-gone");
                $("body").removeClass("search-show");

                update_sidebar_nicescroll();
              }
            });

            update_sidebar_nicescroll();

            if(now_layout_class == 'layout-3') {
              let nav_second_classes = $(".navbar-secondary").attr('class'),
              nav_second = $(".navbar-secondary");

              nav_second.attr('data-nav-classes', nav_second_classes);
              nav_second.removeAttr('class');
              nav_second.addClass('main-sidebar');

              let main_sidebar = $(".main-sidebar");
              main_sidebar.find('.container').addClass('sidebar-wrapper').removeClass('container');
              main_sidebar.find('.navbar-nav').addClass('sidebar-menu').removeClass('navbar-nav');
              main_sidebar.find('.sidebar-menu .nav-item.dropdown.show a').on('click');
              main_sidebar.find('.sidebar-brand').remove();
              main_sidebar.find('.sidebar-menu').before($('<div>', {
                class: 'sidebar-brand'
              }).append(
              $('<a>', {
                href: $('.navbar-brand').attr('href'),
              }).html($('.navbar-brand').html())
              ));
              setTimeout(function() {
                sidebar_nicescroll = main_sidebar.niceScroll(sidebar_nicescroll_opts);
                sidebar_nicescroll = main_sidebar.getNiceScroll();
              }, 700);

              sidebar_dropdown();
              $(".main-wrapper").removeClass("container");
            }
          }else{
            $("body").removeClass("sidebar-gone sidebar-show");
            if(now_layout_class)
              $("body").addClass(now_layout_class);

            let nav_second_classes = $(".main-sidebar").attr('data-nav-classes'),
            nav_second = $(".main-sidebar");

            if(now_layout_class == 'layout-3' && nav_second.hasClass('main-sidebar')) {
              nav_second.find(".sidebar-menu li a.has-dropdown").off('click');
              nav_second.find('.sidebar-brand').remove();
              nav_second.removeAttr('class');
              nav_second.addClass(nav_second_classes);

              let main_sidebar = $(".navbar-secondary");
              main_sidebar.find('.sidebar-wrapper').addClass('container').removeClass('sidebar-wrapper');
              main_sidebar.find('.sidebar-menu').addClass('navbar-nav').removeClass('sidebar-menu');
              main_sidebar.find('.dropdown-menu').hide();
              main_sidebar.removeAttr('style');
              main_sidebar.removeAttr('tabindex');
              main_sidebar.removeAttr('data-nav-classes');
              $(".main-wrapper").addClass("container");
            }else if(now_layout_class == 'layout-2') {
              $("body").addClass("layout-2");
            }else{
              update_sidebar_nicescroll();
            }
          }
        }
        toggleLayout();
        $(window).resize(toggleLayout);

        $("[data-toggle='search']").on('click',function() {
          var body = $("body");

          if(body.hasClass('search-gone')) {
            body.addClass('search-gone');
            body.removeClass('search-show');
          }else{
            body.removeClass('search-gone');
            body.addClass('search-show');
          }
        });
        
    /*----------------------------
        Selectric Active
        ------------------------------*/
        if(jQuery().selectric) {
          $(".selectric").selectric({
            disableOnMobile: false,
            nativeOnMobile: false
          });
        }

    /*----------------------------
        Upload Image Show
        ------------------------------*/
        $(document).on("change",".uploadFile", function()
        {
          var uploadFile = $(this);
          var files = !!this.files ? this.files : [];
          if (!files.length || !window.FileReader) return; 

          if (/^image/.test( files[0].type)){ 
            var reader = new FileReader(); 
            reader.readAsDataURL(files[0]); 

            reader.onloadend = function(){ 
              uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
              $("#save_btn").removeClass('disabled');
              $('.imagePreview i').fadeOut();
            }
          }
        });

  /*----------------------------
        Jquery Live Search
      ------------------------------*/
    $('#data_search').keyup(function(){  
      data_table($(this).val());  
    });  
    function data_table(value){  
        $('.table tbody tr').each(function(){  
        var found = 'false';  
        $(this).each(function(){  
          if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)  
          {  
            found = true;  
          }  
        });  
        if(found == true)  
        {  
          $(this).show();  
        }  
        else  
        {  
          $(this).hide();  
        }  
      });  
    } 

  /*------------------------------------------
    Jquery Live Search for header Menu
    -----------------------------------------*/
    $('#header_search').keyup(function(){  
      search_table($(this).val());  
    });  
    function search_table(value){  
      $('.search-result .search-item').each(function(){  
        var found = 'false';  
        $(this).each(function(){  
          if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)  
          {  
            found = true;  
          }  
        });  
        if(found == true)  
        {  
          $(this).show();  
        }  
        else  
        {  
          $(this).hide();  
        }  
      });  
    } 

  /*------------------------------------------
    Checkboxes checked Active
    -----------------------------------------*/
    $("[data-checkboxes]").each(function() {
      var me = $(this),
      group = me.data('checkboxes'),
      role = me.data('checkbox-role');

      me.change(function() {
        var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
        checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
        dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
        total = all.length,
        checked_length = checked.length;

        if(role == 'dad') {
          if(me.is(':checked')) {
            all.prop('checked', true);
          }else{
            all.prop('checked', false);
          }
        }else{
          if(checked_length >= total) {
            dad.prop('checked', true);
          }else{
            dad.prop('checked', false);
          }
        }
      });
    });

  /*------------------------------------------
    Language Value Update
    -----------------------------------------*/
    $('.edit_lang').on('submit',function(e){
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
        success: function(response) {
          $('.card-body table').load(' .card-body table');
          $('.mymodel').modal('hide')
        }
      });
    });

})(jQuery);