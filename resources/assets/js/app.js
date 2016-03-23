// Application Scripts

require('./config');
require('./router');

  
$('.js-resend-email').click(function(){

  var $_this = $(this);
  var $btn = $( this ).button('loading');
  var emailTargetUrl = $('[data-href]').data( "href");
  // $_this.prop('disabled', true);
  $.ajax({
    url: emailTargetUrl,
    context: document.body
  }).done(function() {
    $btn.button('reset')
    $('#bom-notify-success').fadeIn( 400 ).delay( 1600 ).fadeOut( 400 );;
  });
});

$('.add-supplier-to-bom').click(function(){
  $( '.supplier-item-wrap' ).last().after('<div class="row supplier-item-wrap"><div class="form-group col-md-6"><input type="text" class="form-control" name="supplier[1][name]" placeholder="Supplier Name"></div><div class="form-group col-md-6"><input type="text" class="form-control" name="supplier[1][email]" placeholder="Supplier Email"></div></div>');
});