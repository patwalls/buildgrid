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
  $('#mobile-menu-wrap').fadeToggle();
});