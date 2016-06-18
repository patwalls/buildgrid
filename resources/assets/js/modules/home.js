module.exports = () => {

    "use strict";

    $(document).on('click', "#archive-icon",function(e) {
        $( "#archive-icon" ).popover({
            trigger: 'manual',
            html: true,
            content: '<button id="btn-decline" class="btn btn-success btn-decline">Don&#39;t Archive</button> <button id="btn-archive" class="btn btn-success btn-confirm">Yes, Archive</button>',
        });
        $( "#archive-icon" ).popover('show');
    });

    $(document).on('click', "#btn-archive", function(e) {
        var url = $( "#archive-icon" ).data('href');
        $.ajax({
            url: url
        }).done(function() {
            $( "#archive-icon" ).popover('hide');
            swal("Archived!", "This BOM was archived", "success");
            location.reload();
        });
    });

    $(document).on('click', "#btn-decline", function(e) {
        e.preventDefault();
        $( "#archive-icon" ).popover('hide');
    });
};