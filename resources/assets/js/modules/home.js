module.exports = () => {

    "use strict";

    $( "#archive-icon" ).click(function() {
        $( "#archive-bom" ).popover({
            trigger: 'manual',
            html: true,
            content: '<button id="btn-decline" class="btn btn-success btn-decline">Don&#39;t Archive</button> <button id="btn-archive" class="btn btn-success btn-confirm">Yes, Archive</button>',
        });
        $( "#archive-bom" ).popover('show');
    });

    $(document).on('click', "#btn-archive", function() {
        var url = ( "#archive-bom" ).data('href');
        $.ajax({
            url: url
        }).done(function() {
            swal("Archived!", "This BOM was archived", "success");
            location.reload();
        });
    });

    $(document).on('click', "#btn-decline", function() {
        $( "#archive-bom" ).popover('hide');
    });

};