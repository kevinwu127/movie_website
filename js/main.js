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
            success: function displayResult(text) {
                $('.notif').fadeIn('fast');
                $('.alert').show().html(text);
                window.setTimeout(function(){
                  $('.notif').fadeOut('fast');

                }, 3000);
            }
      });
}

function replace_in_form(name, value, formData) {
  var index;
  for (index = 0; index < formData.length; ++index)
    if(formData[index].name == name) {
      formData[index].value = value;
      break;
    }
}

function handle_relation(form, movie_actor, movie_director, actor, director) {

  var formData = $(form).serializeArray();

  replace_in_form("movie_actor_movie", movie_actor, formData);
  replace_in_form("movie_actor_actor", actor, formData);
  replace_in_form("movie_director_movie", movie_director, formData);
  replace_in_form("movie_director_director", director, formData);

  formData = jQuery.param(formData);

  $.ajax({
        type: "POST",
        url: "php/handle.php",
        data: formData,
        success: function displayResult(text) {
            $('.notif').fadeIn('fast');
            $('.alert').show().html(text);
            window.setTimeout(function(){
                  $('.notif').fadeOut('fast');

                }, 3000);
        }
  });

}

// RELATIONS


$(function(){

  var movie_actor_id = "";
  var movie_director_id = "";
  var actor_id = "";
  var director_id = "";

  function setMovieActorID(item) {
    movie_actor_id = item.value;
  }

  function setMovieDirectorID(item) {
    movie_director_id = item.value;
  }

  function setActorID(item) {
    actor_id = item.value;
  }

  function setDirectorID(item) {
    director_id = item.value;
  }

  $('#movie_actor_movie').typeahead({
      ajax: {
        url: 'php/movies.php',

        displayField: 'title',
        valueField: 'id'
      },
      onSelect: setMovieActorID
  });

  $('#movie_actor_actor').typeahead({
      ajax: {
      url: 'php/actors.php',

      displayField: 'name' ,
      valueField: 'id'
      },
      onSelect: setActorID
  });

  $('#movie_director_movie').typeahead({
      ajax: {
        url: 'php/movies.php',

        displayField: 'title',
        valueField: 'id'
      },
      onSelect: setMovieDirectorID
  });

  $('#movie_director_director').typeahead({
      ajax: {
        url: 'php/directors.php',

        displayField: 'name',
        valueField: 'id'
      },
      onSelect: setDirectorID
  });

  $('.relation_form_button').on("click", function(e) {
        e.preventDefault();
        handle_relation('#form_r', movie_actor_id, movie_director_id, actor_id, director_id);
  });


});


// SEARCH PAGES
$(function() {

  $('.actorLink').each(function() {

    var tableData = $(this).children("td").map(function() {
      return $(this).text();
    }).get();

    var id = $.trim(tableData[1]);

    $(this).attr("id", id);

  });


  $('.actorLink').click(function(){
    var tableData = $(this).children("td").map(function() {
      return $(this).text();
    }).get();

    var params = { id:$.trim(tableData[1]) };
    var str = jQuery.param(params);
    
    var url = "profile.php?" + str;
    window.location.href = url;

  });

  $('.movieLink').each(function() {

    var tableData = $(this).children("td").map(function() {
      return $(this).text();
    }).get();

    var id = $.trim(tableData[1]);

    $(this).attr("id", id);

  });

  $('.movieLink').click(function(){
    var tableData = $(this).children("td").map(function() {
      return $(this).text();
    }).get();

    var params = { id:$.trim(tableData[1]) };
    var str = jQuery.param(params);
    
    var url = "movie_info.php?" + str;
    window.location.href = url;

  });

});

// ACTOR PROFILE PAGES

$(function() {

  $('.movie_starred').each(function() {

      var mid = $(this).children('.movie_id').text();
      $(this).children('.movie_page_link').attr('id', mid);
  });

  $('.movie_page_link').click(function() {

      var params = { id: $(this).attr('id') };
      var str = jQuery.param(params);

      var url = "movie_info.php?" + str;
      window.location.href = url;
  });

});

// MOVIE INFO PAGES



$(function() {

  $('.actor_links').each(function() {

      var mid = $(this).children('.actor_id').text();
      $(this).children('.actor_page_link').attr('id', mid);

  });

  $('.actor_page_link').click(function() {

      var params = { id: $(this).attr('id') };
      var str = jQuery.param(params);

      var url = "profile.php?" + str;
      window.location.href = url;
  });

  var average = parseInt($('#average').text());

  $('#average_rating').barrating('show', {
      theme: 'bootstrap-stars',
      hoverState:false,
      readonly:true,
      initialRating: average
  });

  $('#review_rating').barrating( 'show', {
      theme: 'bootstrap-stars'

  });

  function reviewSuccess(json_data) {

    var data = $.parseJSON(json_data);

    var average = parseFloat(data.average).toFixed(2);
    $('#average_result').text(average);

    $('#review_count').text(data.count);

    $('#average_rating').barrating('set', parseInt(average));

    var name = data.reviewer;
    if (name == "")
    {
      name = "Anonymous";
    }

    var comment = "<p>" + name + " [" + data.time + "] rated it:&nbsp;&nbsp;" + data.rating + " / 5</p>" +
                  "<p>" + data.review + "</p>" +
                  "<div class='line-separator-long'></div>";
    $('#comments').prepend(comment);

  }

  $('#review_form_button').on('click', function(e) {
      e.preventDefault();
      var formData = $('#review_box').serialize();

      $.ajax({
            type: "POST",
            url: "add_review.php",
            data: formData,
            success: reviewSuccess            
      });

  });

});



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


