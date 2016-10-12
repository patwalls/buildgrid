global.bxslider = require('bxslider');
global.smoothScroll = require('smooth-scroll');

$(document).ready(function(){
  $('.as-easy-123-mob').bxSlider({
  });

  $("form[data-form='contact']").submit(function(evt){
    evt.preventDefault();
    var url = $(this).attr("action");
    var data = $(this).serialize();
    $.post(url, data, function(response){
      $("form[data-form='contact']").before("<h4>Thank you for contacting us.  Someone will be in touch with you shortly.</h4>");
        $("form[data-form='contact'] *").attr('disabled', 'disabled');
    });
  });
  
});   // end ready


// Smooth Scrolling for Nav
smoothScroll.init({
  speed: 1100,
  offset: 60
});

$(document).scroll(function(){
  var dataPosition = $('#contrast-item').offset().top - $(window).scrollTop();
  if (dataPosition <= 500 && dataPosition <= 0){
    $('#nav-desk').css('position', 'fixed').addClass('background-transition tran-state');
  }else{
    $('#nav-desk').css('position', 'absolute').removeClass('background-transition tran-state');
  }
});

$('#mobile-nav-link').click(function(){

  // Animation of Menu Icon
  var startingMenuIcon = 'ion-navicon-round';
  var endingMenuIcon = 'ion-close-round';

  if ($('#mobile-nav-link i').hasClass( startingMenuIcon )){
    $('#mobile-nav-link i').removeClass( startingMenuIcon ).addClass( endingMenuIcon );
  }else if ($('#mobile-nav-link i').hasClass( endingMenuIcon )){
    $('#mobile-nav-link i').removeClass( endingMenuIcon ).addClass( startingMenuIcon);
  }else{
    $('#mobile-nav-link i').addClass( startingMenuIcon);
  }

  // Fade Toggle the menu on to the screen
  $('#mobile-menu-wrap').fadeToggle('slow');

  // Animation of Menu Container
  var mobileMenuInEffect = 'fadeInDown';
  var mobileMenuOutEffect = 'fadeOutUp';
  var menuContainer = '#mobile-menu-list';

  if ($( menuContainer ).hasClass( mobileMenuInEffect )){
    $( menuContainer ).removeClass( mobileMenuInEffect ).addClass( mobileMenuOutEffect );
  }else if ($( menuContainer ).hasClass( mobileMenuOutEffect )){
    $( menuContainer ).removeClass( mobileMenuOutEffect ).addClass( mobileMenuInEffect );
  }else{
    $( menuContainer ).addClass( mobileMenuInEffect );
  }
});

$('#mobile-menu-list li a').click(function(){
  $('#mobile-nav-link').click();
});

$('#registerFormClose').click(function(){
  $('#registerForm').fadeOut();
});

$('#registerModalLink').click(function(evt){
  evt.preventDefault();
  $('#registerForm').fadeIn();
});

$('#loginFormClose').click(function(){
  $('#loginForm').fadeOut();
});

$(document).keyup(function(e) {
  if (e.keyCode == 27) { 
    $('#loginForm').fadeOut();
    $('#registerForm').fadeOut();
  }
});

$('#loginModalLink').click(function(evt){
  evt.preventDefault();
  $('#loginForm').show();
});

$("#loginFormWrap").submit(function(evt){
  evt.preventDefault();
  var url = $("#loginFormWrap").attr("action");
  var data = $("#loginFormWrap").serialize();
  $.ajax({
     url: url,
     data: data,
     processData: false,
     type: 'POST',
     success: function ( data ) {
         window.location.replace("/home");
     },
     error: function(XMLHttpRequest, textStatus, errorThrown)
     {
      $.each(XMLHttpRequest.responseJSON, function(i, error) {
         $('#loginErrorMessage').fadeIn().html(error);
      });
     }
  });
});

$("#registerFormWrap").submit(function(evt){
  evt.preventDefault();
  var url = $("#registerFormWrap").attr("action");
  var data = $("#registerFormWrap").serialize();
  $.ajax({
     url: url,
     data: data,
     processData: false,
     type: 'POST',
     success: function ( data ) {
         window.location.replace("/home");
     },
     error: function(XMLHttpRequest, textStatus, errorThrown)
     {
      $.each(XMLHttpRequest.responseJSON, function(i, error) {
         $('#registerErrorMessage').fadeIn().html(error);
      });
     }
  });
});


$('#loginRegistrationRedirect').click(function(){
  $('#loginForm').fadeOut();
  $('#registerForm').fadeIn();
});

$('#registerLoginRedirect').click(function(){
  $('#registerForm').fadeOut();
  $('#loginForm').fadeIn();
});

