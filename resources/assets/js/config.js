// ** Require libraries and frameworks ** //

global.$ = global.jQuery = require('jquery');       // jQuery is expected to be found tied to the window object.
global.router    = require('jquery-router-plugin');
global.cookie    = require('js-cookie');
global.inputmask = require('jquery.inputmask');
global.toastr    = require('toastr');
global.dropzone  = require('dropzone');
global.jscroll   = require('jscroll');
global.bootstrap = require('bootstrap-sass');
global.pdfObject = require('pdfobject');
global.swal      = require('sweetalert');
global.cropit    = require('cropit');

// ** Options and overrides ** //

// toastr default options override
toastr.options.closeButton = true;
toastr.options.progressBar = true;
toastr.options.timeOut = 3000;

// Dropzone defaults

dropzone.autoDiscover = false;      // Prevents Dropzone from automatically instantiating drop zones.
