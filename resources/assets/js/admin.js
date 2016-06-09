// Admin Scripts

require('./config.js');
require('datatables.net-bs')(window, $);

$(document).ready(function(){
    $('table[data-datatables-enabled]').DataTable({
        "processing": true,
        "serverSide": true
    });
});
