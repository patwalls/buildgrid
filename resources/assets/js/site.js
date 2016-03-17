global.bxslider = require('bxslider');
global.smoothScroll = require('smooth-scroll');

$(document).ready(function(){
  $('.as-easy-123-mob').bxSlider({
  });
});

// Smooth Scrolling for Nav
smoothScroll.init({
  speed: 1100,
  offset: 60
});

$(document).scroll(function(){
  var dataPosition = $('#contrast-item').offset().top - $(window).scrollTop();
  console.log( dataPosition );
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
