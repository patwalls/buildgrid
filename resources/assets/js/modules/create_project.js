module.exports = () => {
    "use strict";


    // Create Dropzone

    var bgDropzone = new dropzone("div#dropzone", {
        url: "/create_project",
        autoProcessQueue: false,
        maxFiles: 1,
        maxfilesexceeded: function(file) {
            this.removeAllFiles();
            this.addFile(file);
        },
        dictDefaultMessage: "<i class='fa fa-upload fa-4x'></i><br/><h3>Drag & Drop</h3> files anywhere or <span class='underline'>browse...</span>"
    })
        .on('addedfile', (file) => {

            var bomName = file.name.toString().toLowerCase()
                .replace(/\.[^/.]+$/, "")
                .replace(/[_-]/g, ' ')
                .replace(/(?:^|\s)\S/g, (a) => {
                    return a.toUpperCase();
                });

            $('input[name=bom_name]').val(bomName);

        });




    // Handle the submit button click

    $('button').on('click', (e) => {

        bgDropzone.options.params = getFormData();
        bgDropzone.processQueue();

        console.info('Submit Button was pressed');

        e.preventDefault();

    });


    // Client Side Form Validation


    /*
     Debe invitar por lo menos a uno completo y validar si hay mas de uno que tengan ambos campos llenos
     */



    // Serialize form fields

    function getFormData(){

        var fdata = {};

        $.each( $('form[name=createProjectForm]').serializeArray(), (index, item) => { fdata[item.name] = item.value; });

        return fdata;

    }


};
