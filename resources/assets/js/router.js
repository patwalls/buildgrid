// Check the current physical route (Browser URI)

$('document').ready( () => $.router.check() );


// Define routes and actions on each one.

$.router.add("/create_project", () => {

    require('./modules/create_project')();

});

