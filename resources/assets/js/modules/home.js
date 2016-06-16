module.exports = () => {

    "use strict";

    $(document).on('click', "#archive-icon",function(e) {
        e.preventDefault();
        $( "#archive-bom" ).popover({
            trigger: 'manual',
            html: true,
            content: '<button id="btn-decline" class="btn btn-success btn-decline">Don&#39;t Archive</button> <button id="btn-archive" class="btn btn-success btn-confirm">Yes, Archive</button>',
        });
        $( "#archive-bom" ).popover('show');
    });

    $(document).on('click', "#btn-archive", function(e) {
        e.preventDefault();
        var url = $( "#archive-bom" ).data('href');
        $.ajax({
            url: url
        }).done(function() {
            $( "#archive-bom" ).popover('hide');
            swal("Archived!", "This BOM was archived", "success");
            location.reload();
        });
    });

    $(document).on('click', "#btn-decline", function(e) {
        e.preventDefault();
        $( "#archive-bom" ).popover('hide');
    });

    $( ".info-card" ).click(function(e){
        e.preventDefault();
        alert(1);
    });
};