// ** Require libraries and frameworks ** //

global.$ = global.jQuery = require('jquery');       // jQuery is expected to be found tied to the window object.
global.router    = require('jquery-router-plugin');
global.inputmask = require('jquery.inputmask');
global.toastr    = require('toastr');
global.dropzone  = require('dropzone');
global.jscroll   = require('jscroll');
global.bootstrap = require('bootstrap-sass');


// ** Options and overrides ** //

// toastr default options override
toastr.options.closeButton = true;
toastr.options.progressBar = true;
toastr.options.timeOut = 3000;

// Dropzone defaults

dropzone.autoDiscover = false;      // Prevents Dropzone from automatically instantiating drop zones.
