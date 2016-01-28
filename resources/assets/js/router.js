// Check the current physical route (Browser URI)

$('document').ready( () => $.router.check() );


$.router.add("/", (data) => {

    var index = require("./modules/index")();

    toastr.success('Hello, Welcome to BuildGrid, this site is in development!');

} );


$.router.add("/login", (data) => {

    toastr.info('Please login into your account to upload files to Dropbox');

} );


$.router.add("/password/reset", () => {

    toastr.warning('Remember to provide the same email used when you registered');

});
