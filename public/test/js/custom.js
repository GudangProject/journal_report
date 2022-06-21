jQuery(document).ready(function ($) {

/////////////////////////////////////////////////////////////////////////
//        Sticky header
//////////////////////////////////////////////////////////////////////////  
  var jl_stick;
    if ($(".jl_menu_sticky").hasClass('jl_stick')) {
        var jl_stick = $(".jl_menu_sticky").offset().top;
    }
    $(window).scroll(function() {
        var jlscroll = $(window).scrollTop();
        if (jlscroll > jl_stick) {
            $(".jl_menu_sticky.jl_stick").addClass("jl_sticky");
            var nav_height = $(".jl_menu_sticky.jl_stick").outerHeight();
            $(".jl_blank_nav").css({
                "height": nav_height
            });
        } else {
            $(".jl_menu_sticky.jl_stick").removeClass("jl_sticky");
            $(".jl_blank_nav").css({
                "height": 0
            });
        }
    });


/////////////////////////////////////////////////////////////////////////
//        widget
//////////////////////////////////////////////////////////////////////////  
$('.jl_w_slider').slick({
    dots: false,
    speed: 600,
    arrows: true,
    autoplaySpeed: 6000,
    autoplay: true,
    pauseOnHover: true,
    adaptiveHeight: true,
    prevArrow:'<div class="jl-slider-prev jl_es_pre"><i class="jli-left-chevron"></i></div>',
    nextArrow:'<div class="jl-slider-next jl_es_next"><i class="jli-right-chevron"></i></div>',
    slidesToShow: 1,
    slidesToScroll: 1
  });
$('.jl-s-slider').slick({
    dots: true,
    speed: 600,
    arrows: true,
    autoplaySpeed: 6000,
    autoplay: true,
    pauseOnHover: true,
    adaptiveHeight: true,
    prevArrow:'<div class="jl-slider-prev jl_es_pre"><i class="jli-left-chevron"></i></div>',
    nextArrow:'<div class="jl-slider-next jl_es_next"><i class="jli-right-chevron"></i></div>',
    dotsClass:'jl_s_pagination',
    slidesToShow: 1,
    slidesToScroll: 1
  });

$('.jl_day_night .jl_moon').on("click", function() {
        $('.jl_day_night').addClass('jl_night_en'); 
        $('.jl_day_night').removeClass('jl_day_en');       
        $('.jl_en_day_night').addClass('options_dark_skin'); 
        $('.mobile_nav_class').addClass('wp-night-mode-on');        
});

$('.jl_day_night .jl_sun').on("click", function() {
        $('.jl_day_night').addClass('jl_day_en');  
        $('.jl_day_night').removeClass('jl_night_en');
        $('.jl_en_day_night').removeClass('options_dark_skin'); 
        $('.mobile_nav_class').removeClass('wp-night-mode-on');                    
});

//////////////////////////////////////////////////////////////////////////
//        Menu
//////////////////////////////////////////////////////////////////////////  

$('.menu_mobile_icons, .mobile_menu_overlay').on("click", function() {
        $('#content_nav').toggleClass('jl_mobile_nav_open');
        $('.mobile_menu_overlay').toggleClass('mobile_menu_active');
        $('.mobile_nav_class').toggleClass('active_mobile_nav_class');
});

$("#mobile_menu_slide .menu-item-has-children > a").append($("<span/>",{class:'arrow_down'}).html('<i class="jli-down-chevron" aria-hidden="true"></i>')); 
$('#mobile_menu_slide .arrow_down i').on("click",  function() {
            var $submenu = $(this).closest('.menu-item-has-children').find(' > .sub-menu');
            $(this).toggleClass("jli-down-chevron").toggleClass("jli-up-chevron");
            if ( $submenu.hasClass('menu-active-class') ) {
                $submenu.removeClass('menu-active-class');
            } else {
                $submenu.addClass('menu-active-class');
            }
            return false;
        });


$('.search_form_menu_personal_click').on("click", function() {
      $('.search_form_menu_personal').toggleClass('search_form_menu_personal_active');
      $('.mobile_nav_class').toggleClass('active_mobile_nav_class');
      
});

$('.single_post_share_icons').on("click", function() {
      $('.single_post_share_wrapper').toggleClass('share_single_active');
      $('.mobile_nav_class').toggleClass('active_mobile_nav_class');
});


$('.search_form_menu_click').on('click', function ( e ) {
    e.preventDefault();
      $('.search_form_menu').toggle();
    $(this) .toggleClass('active');
    });


 if ( $('.sb-toggle-left').length ) {
            $('.sb-toggle-left').on("click",  function(){
                $('#nav-wrapper').toggle(100);
            } ); 
            $("#menu-main-menu .menu-item-has-children > a").append($("<span/>",{class:'arrow_down'}).html('<i class="jli-down-chevron-1"></i>'));     
        }
        
        $('#nav-wrapper .menu .arrow_down').on("click",  function() {
            var $submenu = $(this).closest('.menu-item-has-children').find(' > .sub-menu');
            
            if ( $submenu.hasClass('menu-active-class') ) {
                $submenu.removeClass('menu-active-class');
            } else {
                $submenu.addClass('menu-active-class');
            }
            
            return false;
        });


    $('#menu_wrapper li').hover(function(){
    var marginAdjust = 100;
    var parentElement = $(this).parent();
    
    var navPosition = $(parentElement).position();
    var navWidth = $(parentElement).width();
    var navRight = navPosition.left+navWidth;
    
    var position = $(this).position();
    var thisWidth = $(this).children('ul').width();
    var thisRight = position.left+thisWidth-marginAdjust;
    
    if (thisRight > navWidth) $(this).children('ul').addClass('jl_menu_tls');
    });

 //////////////////////////////////////////////////////////////////////////
//        Tab
//////////////////////////////////////////////////////////////////////////  
  
    var $tabsNav = $('.tabs-product'),
        $tabsNavLis = $tabsNav.children('li');
    $tabsNav.each(function () {
        var $this = $(this);
        $this.next().children('.tab-content').stop(true, true).hide()
            .first().show();
       $this.children('li').first().addClass('active').stop(true, true).show();
    });
    $tabsNavLis.on('click', function (e) {
        var $this = $(this);
        $this.siblings().removeClass('active').end()
            .addClass('active');
        $this.parent().next().children('.tab-content').stop(true, true).hide()
            .siblings($this.find('a').attr('href')).fadeIn();
        e.preventDefault();
    });
    
//////////////////////////////////////////////////////////////////////////
//        Go to top
//////////////////////////////////////////////////////////////////////////

  jQuery(window).scroll(function () {
    var scroll = $(window).scrollTop();

    if (scroll >= 100) {
        $(".jl_large_menu_logo").addClass("jl_custom_height_small");
        $(".options_dark_header").addClass("dark_header_menu");
    } else {
        $(".jl_large_menu_logo").removeClass("jl_custom_height_small");
        $(".options_dark_header").removeClass("dark_header_menu");
    }


    if (jQuery(this).scrollTop() > 500) {
      jQuery("#go-top").fadeIn();
    } else {
      jQuery("#go-top").fadeOut();
    }
  });
  
  $("#go-top").on("click", function () {
    jQuery("body,html").animate({ scrollTop: 0 }, 800 );
    return false;
  }); 

/* ---------------------------------------------
Slider
----------------------------------------------*/ 
var slider_element = $('.jl-eb-slider');
      for (i = 0; i < slider_element.length; i++) {
      var $slider_element = $(slider_element[i]);
  $slider_element.slick({
        arrows: $slider_element.attr("data-arrows") == "true",
                prevArrow:'<div class="jl-slider-prev jl_es_pre"><i class="jli-left-chevron"></i></div>',
                nextArrow:'<div class="jl-slider-next jl_es_next"><i class="jli-right-chevron"></i></div>',
                dotsClass:'jl_s_pagination',
                speed: parseInt($slider_element.attr('data-speed')) || 500,
                fade: $slider_element.attr("data-effect") == "true",
                dots: $slider_element.attr("data-dots") == "true",
                infinite: $slider_element.attr("data-loop") == "true",
                autoplay: $slider_element.attr("data-play") == "true",
                autoplaySpeed: parseInt($slider_element.attr('data-autospeed')) || 7000,
                swipe: $slider_element.attr("data-swipe") == "true",
                pauseOnHover: true,
                slidesToShow: parseInt($slider_element.attr('data-xl-items')) || 1,
                adaptiveHeight: true,
                responsive: [
                      {
                        breakpoint: 0,
                        settings: {
                          slidesToShow: parseInt($slider_element.attr('data-items')) || 1,
                        }
                      },
                      {
                        breakpoint: 479,
                        settings: {
                          slidesToShow: parseInt($slider_element.attr('data-xs-items')) || 1,
                        }
                      },
                      {
                        breakpoint: 767,
                        settings: {
                          slidesToShow: parseInt($slider_element.attr('data-sm-items')) || 1,
                        }
                      },
                      {
                        breakpoint: 991,
                        settings: {
                          slidesToShow: parseInt($slider_element.attr('data-md-items')) || 1,
                        }
                      },
                      {
                        breakpoint: 1199,
                        settings: {
                          slidesToShow: parseInt($slider_element.attr('data-lg-items')) || 1,
                        }
                      },
                      {
                        breakpoint: 1799,
                        settings: {
                          slidesToShow: parseInt($slider_element.attr('data-xl-items')) || 1,
                        }
                      },
                ]
  });
    }
    
//////////////////////////////////////////////////////////////////////////
//        Video responsive
//////////////////////////////////////////////////////////////////////////

fluidvids.init({
      selector: 'iframe',
      players: ['www.youtube.com', 'player.vimeo.com', 'www.facebook.com']
    }); 


$('.quantity .jlb-btn').on("click", function(e){
            e.preventDefault();
            var button = $(this);
            var step = 1;
            var input = button.parent().find('input');
            var min = 1;
            var max = 1000;
            var value_old = parseInt(input.val());
            var value_new = parseInt(input.val());

            if (input.attr('step')) {
                step = parseInt(input.attr('step'));
            }

            if (input.attr('min')) {
                min = parseInt(input.attr('min'));
            }

            if (input.attr('max')) {
                max = parseInt(input.attr('max'));
            }

            if (button.hasClass('up')) {
                if (value_old < max) {
                    value_new = value_old + step;
                } else {
                    value_new = max;
                }
            } else if (button.hasClass('down')) {
                if (value_old > min) {
                    value_new = value_old - step;
                } else {
                    value_new = min;
                }
            }

            if (!input.attr('disabled')) {
                input.val(value_new).change();
            }
        });

});
