// Application Scripts

require('./config');
require('./router');

// These need to be moved into their own modules -SH
$(document).ready(function(){

  // Aligns Header / Footer on small screens vertically  
  var shortWindow = $( document ).height();

  if ( shortWindow <= 900 ){
    $('#app-layout').addClass('veritcal-separator-wrap');
  }

});