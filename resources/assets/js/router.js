// Check the current physical route (Browser URI)

$('document').ready( () => $.router.check() );


// Define routes and actions on each one.

$.router.add("/create_project", () => {

    require('./modules/create_project')();

});

$.router.add("/create_project/:bom_id", () => {

    require('./modules/create_project')();

});

$.router.add("/home", () => {

    require('./modules/create_project')();

});


$.router.add("/bom/:bom_id", (data) => {

    require('./modules/view_bom')(data);

});
