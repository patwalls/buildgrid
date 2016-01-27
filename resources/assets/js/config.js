// Require libraries and frameworks

var  jQuery = require('jquery');
window.$ = window.jQuery = jQuery       // jQuery is expected to be found tied to the window object.
var modal = require('jquery-modal');
var toastr = require('toastr');
var dropzone = require('dropzone');
var jscroll = require('jscroll');
var bootstrap = require('bootstrap-sass');


// Globals, options and overrides

// toastr default options override
toastr.options.closeButton = true;
toastr.options.progressBar = true;
toastr.options.timeOut = 3000;

