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
          }
        }
      }).data('smoothState'); // makes public methods available
})(jQuery);

$(document).ready(function() {
  $('#actor_btn').click(function(e){    
          $('#actor_btn').fadeOut('fast', function() {
            $('#actor').fadeIn('fast');
          });
          
  });
  $('#actor_minimize').click(function(e){   
          $('#actor').fadeOut('fast', function() {
            $('#actor_btn').fadeIn('fast');
          });
          
  });

  $('#director_btn').click(function(e){    
          $('#director_btn').fadeOut('fast', function() {
            $('#director').fadeIn('fast');
          });
          
  });
  $('#director_minimize').click(function(e){   
          $('#director').fadeOut('fast', function() {
            $('#director_btn').fadeIn('fast');
          });
          
  });

  $('#movie_btn').click(function(e){    
          $('#movie_btn').fadeOut('fast', function() {
            $('#movie').fadeIn('fast');
          });
          
  });
  $('#movie_minimize').click(function(e){   
          $('#movie').fadeOut('fast', function() {
            $('#movie_btn').fadeIn('fast');
          });
          
  });

  $('#relation_btn').click(function(e){    
          $('#relation_btn').fadeOut('fast', function() {
            $('#relation').fadeIn('fast');
          });
          
  });
  $('#relation_minimize').click(function(e){   
          $('#relation').fadeOut('fast', function() {
            $('#relation_btn').fadeIn('fast');
          });
          
  });

});