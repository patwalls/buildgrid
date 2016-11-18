module.exports = (data) => {

    "use strict";

    $('.js-resend-email').click(function(){
        var $btn = $( this ).button('loading');
        var emailTargetUrl = $( this ).data( "href");
        $.ajax({
            url: emailTargetUrl,
            context: document.body
        }).done(function() {
            $btn.button('reset');
            $('#bom-notify-success').fadeIn( 400 ).delay( 1600 ).fadeOut( 400 );
        });
    });

    $('.add-supplier-to-bom').click((e) => {
        e.preventDefault();
        var group_count = $( '.supplier-item-wrap' ).length;
        $( '.supplier-item-wrap' ).last().after('<div class="row supplier-item-wrap"><div class="form-group col-md-12"><input type="text" class="form-control" name="supplier[' + group_count + '][name]" placeholder="Name"></div><div class="form-group col-md-12"><input type="text" class="form-control" name="supplier[' + group_count + '][email]" placeholder="Email"></div></div>');
    });

    $('.copy-link').click(() => {
        $('#copy-notify-success').fadeIn( 400 ).delay( 4000 ).fadeOut( 400 );
    });
    
    $(document).ready(function(){

        var status = $(".bom-status-color").html().trim();

        if ( status == 'Not Viewed' ){
            $(".bom-status-color").css('color', 'red');
        }
        else if ( status == 'Viewed'){
            $(".bom-status-color").css('color', 'green');
        }
        else if ( status == 'Responded' ){
            $(".bom-status-color").css('color', 'darkgreen');
        }
        $('[data-toggle="popover"]').popover();

    });

  

    $("#add-supplier").keypress( function (e) {
        if(e.which == 13) {
            e.preventDefault();
            this.submit();
            return false;
        }
    });

    $( ".btn-accept-response" ).click((e) => {
        e.preventDefault();
        var url = $( ".btn-accept-response" ).data('href');
        swal({  title: "Accept Response",
            text: "Please confirm you want to accept this response",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#8CD4F5",
            confirmButtonText: "Yes, accept it!",
            closeOnConfirm: false,
            closeOnCancel: true,
            showLoaderOnConfirm: true,
        },
        function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url: url
                }).done(function() {
                    swal("Accepted!", "This response was accepted", "success");
                    location.reload();
                });
            }
        });
    });

    $( ".btn-decline-response" ).click((e) => {
        e.preventDefault();
        var url = $( ".btn-decline-response" ).data('href');
        swal({  title: "Decline Response",
            text: "Please confirm you want to decline this response",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, decline it!",
            closeOnConfirm: false,
            closeOnCancel: true,
            showLoaderOnConfirm: true,
        },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        url: url
                    }).done(function() {
                        swal("Declined!", "This response was declined", "success");
                        location.reload();
                    });
                }
         });
    });

    $( "#archive-bom" ).click(function() {
            $( "#archive-bom" ).popover({
                trigger: 'manual',
                html: true,
                content: '<button id="btn-decline" class="btn btn-success btn-decline">Don&#39;t Archive</button> <button id="btn-archive" class="btn btn-success btn-confirm">Yes, Archive</button>',
            });
            $( "#archive-bom" ).popover('show');
    });

    $(document).on('click', "#btn-archive", function() {
        var url = $( "#archive-bom" ).data('href');
        $.ajax({
            url: url
        }).done(function() {
            $( "#archive-bom" ).popover('hide');
            swal("Archived!", "This BOM was archived", "success");
            location.reload();
        });
    });


    $(document).on('click', "#btn-decline", function() {
        $( "#archive-bom" ).popover('hide');
    });

    $( ".btn-undo-response" ).click((e) => {
        e.preventDefault();
        var url = $( ".btn-undo-response" ).data('href');
        swal({  title: "Undo Response",
                text: "Please confirm you want to undo this response",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#8CD4F5",
                confirmButtonText: "Yes, undo!",
                closeOnConfirm: false,
                closeOnCancel: true,
                showLoaderOnConfirm: true,
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        url: url
                    }).done(function() {
                        swal("Undo!", "This response is pending", "success");
                        location.reload();
                    });
                }
            });
    });
};
