module.exports = () => {

    "use strict";

    $(document).on('click', "#archive-icon",function(e) {
        var url = $( this ).data('href');
        $( this ).popover({
            trigger: 'focus',
            html: true,
            template: '<div class="popover archive-popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
            content: '<button id="btn-decline" class="btn btn-success btn-decline">Don&#39;t Archive</button> <button id="btn-archive" data-href="'+ url +'" class="btn btn-success btn-confirm">Yes, Archive</button>',
        });
        $( this ).popover('toggle');
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
        $( this ).popover('hide');
    });

    $(document).on('toogle.bs.popover', '.popover', function() {
        alert("action");
        var currentLeft = parseInt($(this).css('left'));
alert(currentLeft);
        $(this).css({
            left: (currentLeft - 100) + 'px'
        });
    });
};