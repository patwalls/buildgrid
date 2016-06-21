// Admin Scripts

require('./config.js');
require('datatables.net-bs')(window, $);

$(document).ready( () => {

    pdfObject.embed($('#pdf-preview').data('document-url'), '#pdf-preview', { height: "400px" });

    $('table[data-datatables-enabled]').DataTable({
        "processing": true,
        "serverSide": true,
        "initComplete": function(){

            var table = this.api();

            $(this).on('click', 'button[data-action-show]', function() {
                var closestRow = $(this).closest('tr');
                var data = table.row(closestRow).data();
                window.location.href = $(this).closest('table').data('show-url') + '/' + data.id;
            });

            $(this).on('click', 'button[data-action-delete]', function() {
                var closestRow = $(this).closest('tr');
                var data = table.row(closestRow).data();
                var token = $('table[data-datatables-enabled]').data('token');
                var url = '/admin/users/' + data.id;
                swal({  title: "Delete Record",
                        text: "Please confirm you want to delete this record",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        showLoaderOnConfirm: true,
                        closeOnConfirm: false },
                        function(){
                            $.ajax({
                                type: "DELETE",
                                url: url,
                                data: data,
                                headers:
                                {
                                    'X-CSRF-Token': token
                                },
                                success: function()
                                {
                                    swal("Deleted!", "The record you selected has been deleted.", "success");
                                },
                                error: function()
                                {
                                },
                            });

                        });

            });

        }
    });
    $('#user-submit').click(function(e){
       e.preventDefault();
        var url = $('#user-edit-form').attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: $('#user-edit-form').serialize(),
            success: function()
            {
                location.reload();
            },
            error: function(data){
                var response_error = JSON.parse(data.responseText);
                var errorsHtml = '<div id="errors" class="alert alert-danger"><ul>';

                $.each( response_error , function(key, value) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                     errorsHtml += '</ul></div>';

                $('#errors').html(errorsHtml);
            }
        })
    });
});
