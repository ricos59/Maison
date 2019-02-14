/*
* Welcome to your app's main JavaScript file!
*
* We recommend including the built version of this JavaScript file
* (and its CSS file) in your base layout (base.html.twig).
*/

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
 const $ = require('jquery');
require('bootstrap');

$(document).ready(function(){
  $('.login-info-box').fadeOut();
  $('.login-show').addClass('show-log-panel');
});


$('.login-reg-panel input[type="radio"]').on('change', function() {
  if($('#log-login-show').is(':checked')) {
    $('.register-info-box').fadeOut();
    $('.login-info-box').fadeIn();

    $('.white-panel').addClass('right-log');
    $('.register-show').addClass('show-log-panel');
    $('.login-show').removeClass('show-log-panel');

  }
  else if($('#log-reg-show').is(':checked')) {
    $('.register-info-box').fadeIn();
    $('.login-info-box').fadeOut();

    $('.white-panel').removeClass('right-log');

    $('.login-show').addClass('show-log-panel');
    $('.register-show').removeClass('show-log-panel');
  }
});
