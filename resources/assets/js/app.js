// Application Scripts

require('./config');
require('./router');

  $('[data-toggle="popover"]').popover({
    html: true,
    title: 'Are you sure?',
    trigger: 'focus'
  });

  $('#fake-target').click(function(){
    // $('[data-toggle="popover"]').popover('hide');
    $('body').css('background', 'red');
  });

});
