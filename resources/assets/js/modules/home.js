module.exports = () => {

    "use strict";

    $(document).on('click', "#archive-icon",function(e) {
        var url = $( this ).data('href');
        $( this ).popover({
            trigger: 'manual',
            html: true,
            content: '<button id="btn-decline" class="btn btn-success btn-decline">Don&#39;t Archive</button> <button id="btn-archive" data-href="'+ url +'" class="btn btn-success btn-confirm">Yes, Archive</button>',
        });
        $( this ).popover('show');
    });

    $(document).on('click', "#btn-archive", function(e) {
        var url = $( this ).data('href');
        $.ajax({
            url: url
        }).done(function() {
            $( this ).popover('hide');
            swal("Archived!", "This BOM was archived", "success");
            location.reload();
        });
    });

    $(document).on('click', "#btn-decline", function(e) {
        e.preventDefault();
        $( "#archive-icon" ).popover('hide');
    });
};