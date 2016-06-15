module.exports = (data) => {

    "use strict";

    $('.js-resend-email').click(function(){
        // var $_this = $(this);
        var $btn = $( this ).button('loading');
        var emailTargetUrl = $('[data-href]').data( "href");
        // $_this.prop('disabled', true);
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
        $( '.supplier-item-wrap' ).last().after('<div class="row supplier-item-wrap"><div class="form-group col-md-12"><input type="text" class="form-control" name="supplier[' + group_count + '][name]" placeholder="Supplier Name"></div><div class="form-group col-md-12"><input type="text" class="form-control" name="supplier[' + group_count + '][email]" placeholder="Supplier Email"></div></div>');
    });


    pdfObject.embed($('#pdf-preview').data('document-url'), '#pdf-preview', { height: "500px" });
    
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
    });

    $( ".add-supplier-to-bom" ).one( "click", function() {
        $('.submit-new-supplier-btn').append('<button type="submit" class="btn btn-primary btn-sm update-suppliers-btn">Update Suppliers</button>');
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

};