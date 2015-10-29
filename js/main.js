;(function ($) {
  'use strict';
  var content  = $('#main').smoothState({
        // onStart runs as soon as link has been activated
        onStart : {
          
          // Set the duration of our animation
          duration: 250,
          
          // Alterations to the page
          render: function () {

            // Quickly toggles a class and restarts css animations
            content.toggleAnimationClass('is-exiting');

            // Scroll user to the top
            $body.animate({ 'scrollTop': 0 });
          }
        }
      }).data('smoothState'); // makes public methods available
})(jQuery);

$(function(){
 
  $(document).on( 'scroll', function(){
 
    if ($(window).scrollTop() > 100) {
      $('.scroll-top-wrapper').addClass('show');
    } else {
      $('.scroll-top-wrapper').removeClass('show');
    }
  });
});

$(function(){
 
  $(document).on( 'scroll', function(){
 
    if ($(window).scrollTop() > 100) {
      $('.scroll-top-wrapper').addClass('show');
    } else {
      $('.scroll-top-wrapper').removeClass('show');
    }
  });
 
  $('.scroll-top-wrapper').on('click', scrollToTop);
});
 
function scrollToTop() {
  verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
  element = $('body');
  offset = element.offset();
  offsetTop = offset.top;
  $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
}

// FORM HANDLING
function handle(form) {

      // Initiate Variables with Form Content
      var formData = $(form).serialize();

      $.ajax({
            type: "POST",
            url: "php/handle.php",
            data: formData,
            success: function(text) {
              alert(text);
            }
      });
}

$(document).ready(function() {

  // ACTOR

  $('#actor_form_button').on("click", function(e) {
        e.preventDefault();
        handle('#form_a');
  });


  $('#actor_btn').click(function(){    
          $('#actor_btn').fadeOut('fast', function() {
            $('#actor').fadeIn('fast');
          });
          
  });
  $('#actor_minimize').click(function(){   
          $('#actor').fadeOut('fast', function() {
            $('#actor_btn').fadeIn('fast');
          });
          
  });
  $('#actor_cancel').click(function(){   
          $('#actor').fadeOut('fast', function() {
            $('#actor_btn').fadeIn('fast');
          });
          
  });


  // DIRECTOR

  $('#director_form_button').on("click", function(e) {
        e.preventDefault();
        handle('#form_d');
  });

  $('#director_btn').click(function(){    
          $('#director_btn').fadeOut('fast', function() {
            $('#director').fadeIn('fast');
          });
          
  });
  $('#director_minimize').click(function(){   
          $('#director').fadeOut('fast', function() {
            $('#director_btn').fadeIn('fast');
          });
          
  });
  $('#director_cancel').click(function(){   
          $('#director').fadeOut('fast', function() {
            $('#director_btn').fadeIn('fast');
          });
          
  });


  // MOVIE

  $('#movie_form_button').on("click", function(e) {
        e.preventDefault();
        handle('#form_m');
  });

  $('#movie_btn').click(function(){    
          $('#movie_btn').fadeOut('fast', function() {
            $('#movie').fadeIn('fast');
          });
  });
  $('#movie_minimize').click(function(){   
          if ( $(window).width() > 769 ) {  
              $("html, body").animate({ scrollTop: 0 }, 500, function () {
                $('#movie').fadeOut('fast', function() {
                  $('#movie_btn').fadeIn('fast');
                });
              });
            }
            else {
              $('#movie').fadeOut('fast', function() {
                  $('#movie_btn').fadeIn('fast');
                });
            }
  });
  $('#movie_cancel').click(function(){ 

            if ( $(window).width() > 769 ) {  
              $("html, body").animate({ scrollTop: 0 }, 500, function () {
                $('#movie').fadeOut('fast', function() {
                  $('#movie_btn').fadeIn('fast');
                });
              });
            }
            else {
              $('#movie').fadeOut('fast', function() {
                  $('#movie_btn').fadeIn('fast');
                });
            }
          
  });


  // RELATION

  $('.relation_form_button').on("click", function(e) {
        e.preventDefault();
        handle('#form_r');
  });

  $('#relation_btn').click(function(){    
          $('#relation_btn').fadeOut('fast', function() {
            $('#relation').fadeIn('fast');
          });

          var relationVal = $('input[name="relation"]:checked').val();
          if (relationVal == 'movie_actor') {
            $('#movie_director_div').hide();
            $('#movie_actor_div').show();
          }
          else {
            $('#movie_actor_div').hide();
            $('#movie_director_div').show();
          }
          
  });

  $('input[name="relation"]').on('change', function() {

          if ( $(this).val() == 'movie_actor' ) {
            $('#movie_director_div').fadeOut('fast', function() {
              $('#movie_actor_div').fadeIn('fast');
            });
          }
          else {
            $('#movie_actor_div').fadeOut('fast', function() {
              $('#movie_director_div').fadeIn('fast');
            });
          }
  });

  $('#relation_minimize').click(function(){   
          $('#relation').fadeOut('fast', function() {
            $('#relation_btn').fadeIn('fast');
          });
          
  });
  $('#movie_actor_cancel').click(function(){   
          $('#relation').fadeOut('fast', function() {
            $('#relation_btn').fadeIn('fast');
          });
          
  });
  $('#movie_director_cancel').click(function(){   
          $('#relation').fadeOut('fast', function() {
            $('#relation_btn').fadeIn('fast');
          });
          
  });


});


