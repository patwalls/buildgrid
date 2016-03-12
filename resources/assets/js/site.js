function menuBackgroundColor(){
  if (isMenuScrollOutsideHeader($('#nav-desk'))){
      $(this).css('background', 'red');
  }
};

function isMenuScrollOutsideHeader(element){
  var scrollOutSide = false;

  var menuPosition = element.offset().top - $(window).scrollTop() + 25;

  console.log(menuPosition);

  console.log(scrollOutSide);
};

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

  $('#mobile-menu-wrap').fadeToggle('slow');

  // // Animation of Menu Container
  // var mobileMenuInEffect = 'fadeInDown';
  // var mobileMenuOutEffect = 'fadeOutUp';

  // if ($('#mobile-menu-wrap').hasClass( mobileMenuInEffect )){
  //   $('#mobile-menu-wrap').fadeToggle('slow').removeClass( mobileMenuInEffect ).addClass('animated ' + mobileMenuOutEffect );
  // }else if ($('#mobile-menu-wrap').hasClass( mobileMenuOutEffect )){
  //   $('#mobile-menu-wrap').fadeToggle('slow').removeClass( mobileMenuOutEffect ).addClass('animated ' + mobileMenuInEffect);
  // }else{
  //   $('#mobile-menu-wrap').fadeToggle('slow').addClass('animated ' + mobileMenuInEffect);
  // } 
});