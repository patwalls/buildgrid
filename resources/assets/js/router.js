// Check the current physical route (Browser URI)

$('document').ready( () => $.router.check() );


// Define routes and actions on each one.

$.router.add("/create_project", () => {

    require('./modules/create_project')();

});

$.router.add("/project/:bom_id/add_bom", () => {

    require('./modules/create_project')();

});

$.router.add("/home", () => {

    require('./modules/home')();

});


$.router.add("/bom/:bom_id", (data) => {

    require('./modules/view_bom')(data);

});


$.router.add("/profile", () => {

    require('./modules/update_profile')();

});


$.router.add("/admin/boms/:bom_id", () => {

    require("./modules/add_response")();
    require("./modules/view_bom")();
});

