// Application Scripts

require('./config');
require('./router');

  
  $('.js-resend-email').click(function(){

    var $_this = $(this);
    
    var emailTargetUrl = $('[data-href]').data( "href");
    $_this.prop('disabled', true);
    console.log( emailTargetUrl );
    $.ajax({
      url: emailTargetUrl,
      context: document.body
    }).done(function() {
      $_this.prop('disabled', false);
    });
  });