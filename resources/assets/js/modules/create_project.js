module.exports = () => {
    "use strict";

    // Create Dropzone

    var bgDropzone = new dropzone("div#dropzone", {
        url: "/bom_file_upload",
        autoProcessQueue: false,
        maxFiles: 1,
        maxfilesexceeded: (file) => {        // For replacing the current file with another one that was just dropped/selected.
            this.removeAllFiles();
            this.addFile(file);
        },
        dictDefaultMessage: "<i class='fa fa-upload fa-4x'></i><br/><h3>Drag & Drop</h3> files anywhere or <span class='underline'>browse...</span>",
        success: (file, response) => {
            toastr.success('Your project has been succesfully created.', '', { onHidden: () => { window.location.href = "/bom/"+bgDropzone.options.params.bom_id; } });
        },
        error: (file, errorMessage) => {
            toastr.error('There was an error processing your request: ' + errorMessage, '');
        }
        
    })
        .on('addedfile', (file) => {

            var bomName = file.name.toString().toLowerCase()
                .replace(/\.[^/.]+$/, "")
                .replace(/[_-]/g, ' ')
                .replace(/(?:^|\s)\S/g, (a) => {
                    return a.toUpperCase();
                });

            $('input[name=bom_name]').val(bomName);
            $('input[name=filename]').val(file.name.toString());

        });


    // Removes error state styling from form fields and the Dropzone.

    function removeErrorStyles() {

        $('.form-group').removeClass('has-error');
        $('div#dropzone').css('border', '3px dashed #0076be');
        $('div#notifications').hide();

    }


    // Handle the submit button click

    $('button').on('click', (e) => {

        e.preventDefault();

        $.post('/create_project', $('form[name=createNewProjectForm]').serialize())
            .done( (responseData) => {
                $('button[type=submit], input').attr('disabled', 'disabled');
                removeErrorStyles();
                bgDropzone.options.params = responseData;
                bgDropzone.processQueue();
            })
            .fail( (xhr, statusText, errorThrown) => {

                if(xhr.status == 422){

                    var form_keys = $('form').serializeArray().map((input) => { return input.name });
                    var error_keys = Object.keys(xhr.responseJSON).map((key) => { return key.replace(/([a-z]+).([0-9])+.([a-z]+)/i, '$1[$2][$3]'); });

                    removeErrorStyles();

                    $.each(form_keys, (i, item) => {
                        if( error_keys.includes(item) ){
                            $(`input[name='${item}']`).parent('.form-group').addClass('has-error');
                        }
                    });

                    if( error_keys.includes('filename') ){
                        $('div#dropzone').css('border', '3px dashed #E74C3C');
                    }

                    $('div#notifications').html(`
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  Please complete all of the required fields to create the new Project.
                                </div>
                            </div>
                        </div>
                    `).show();

                    $('html, body').animate({ scrollTop: 0 }, 'fast');

                    return;

                }

                toastr.error('There where some issues while trying to process your request. Please try again later');

            } );

    });

};
