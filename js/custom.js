(function ($) {

    "use strict";
  
      // PRE LOADER
      $(window).load(function(){
        $('.preloader').fadeOut(1000); // set duration in brackets    
      });
  
  
      // MENU
      $('.navbar-collapse a').on('click',function(){
        $(".navbar-collapse").collapse('hide');
      });
  
      $(window).scroll(function() {
        if ($(".navbar").offset().top > 50) {
          $(".navbar-fixed-top").addClass("top-nav-collapse");
            } else {
              $(".navbar-fixed-top").removeClass("top-nav-collapse");
            }
      });
      
  // SMOOTHSCROLL
      $(function() {
        $('.custom-navbar a, #home a').on('click', function(event) {
          var $anchor = $(this);
            $('html, body').stop().animate({
              scrollTop: $($anchor.attr('href')).offset().top-49
            }, 1000);
              event.preventDefault();
        });
      });  
  
  })(jQuery);
  
  $('.dropdown-toggle').click(function(e) {
    if ($(document).width() > 768) {
      e.preventDefault();
  
      var url = $(this).attr('href');
  
         
      if (url !== '#') {
      
        window.location.href = url;
      }
  
    }
  });
  
  $('.form-control').each(function () {
    floatedLabel($(this));
  });
  
  $('.form-control').on('input', function () {
    floatedLabel($(this));
  });
  
  function floatedLabel(input) {
    var $field = input.closest('.form-group');
    if (input.val()) {
      $field.addClass('input-not-empty');
    } else {
      $field.removeClass('input-not-empty');
    }
  }