// Admin Scripts

require('./config.js');
require('datatables.net-bs')(window, $);

$(document).ready( () => {

    pdfObject.embed($('#pdf-preview').data('document-url'), '#pdf-preview', { height: "400px" });

    $('table[data-datatables-enabled]').DataTable({
        "processing": true,
        "serverSide": true,
        columns: [
            {data: "id"},
            {data: "full_name"  },
            {data: "email"      },
            {data: "last_login" },
            {data: "created_at" },
            {data: "total_boms" },
            {data: "active_boms_count"},
            {data: "status"},
            {data: "null", defaultContent: "<button id=\"button-show\" data-action-show class=\"btn btn-default btn-xs\"><i class=\"fa fa-eye\"></i></button> <button id=\"button-edit\" data-action-update class=\"btn btn-danger btn-xs\"><i class=\"fa fa-times\"></i></button>"}
        ],
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
                        function(isConfirm){
                            if(isConfirm) {
                                $.ajax({
                                    type: "DELETE",
                                    url: url,
                                    data: data,
                                    headers: {
                                        'X-CSRF-Token': token
                                    },
                                    success: function () {
                                        swal("Deleted!", "The record you selected has been deleted.", "success");
                                    },
                                    error: function () {
                                    },
                                });
                            }
                        });

            });

            $(this).on('click', 'button[data-action-active]', function() {
                var closestRow = $(this).closest('tr');
                var data = table.row(closestRow).data();
                var token = $('table[data-datatables-enabled]').data('token');
                var url = '/admin/users/' + data.id + '/edit';
                swal({  title: "Reactive User",
                        type: "input",
                        inputType:"checkbox",
                        inputName: "active",
                        text: 'Check if you want to active its Projects and BOMs too',
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, active it!",
                        showLoaderOnConfirm: true,
                        closeOnConfirm: false},
                    function(isConfirm){
                        if(isConfirm) {
                            $.ajax({
                                type: "GET",
                                url: url,
                                data: data,
                                headers: {
                                    'X-CSRF-Token': token
                                },
                                success: function () {
                                    swal("Active!", "The record you selected has been actived.", "success");
                                },
                                error: function () {
                                },
                            });
                        }
                    });

            });

        },
        "createdRow": function ( row, data, index ) {
            if (data['status'] == "active") {
                $('td', row).eq(7).html("<button id=\"button-edit\" data-action-delete class=\"btn btn-danger btn-xs\"><i class=\"fa fa-times\"></i></button>");
            }else{
                $("td", row).eq(7).html("<button id=\"button-edit\" data-action-active class=\"btn btn-success btn-xs\"><i class=\"fa fa-check\"></i></button>");
            }
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
