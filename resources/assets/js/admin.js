// Admin Scripts

require('./config.js');
require('datatables.net-bs')(window, $);

$(document).ready( () => {

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

                swal({  title: "Delete Record",
                        text: "Please confirm you want to delete this record",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false },
                        function(){
                            swal("Deleted!", "The record you selected has been deleted.", "success");
                        });

            });

        }
    });

});
