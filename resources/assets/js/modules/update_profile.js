module.exports = () => {
    "use strict";

    $(document).ready(function () {
        $('#image-cropper').cropit();

        $('.save-image-btn').click(function () {
            var picture = $('#image-cropper').cropit('export', {type: 'image/png'});

            var url = $(this).data('href');

            var data = {
                'picture': picture,
            };
            var token = $('#image-cropper input[name=_token]').val();

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-Token': token
                },
            }).done(function() {
                    swal("Updated!", "Profile picture updated", "success");
                    location.reload();
            });
        });

        $( "#image-cropper" ).hover(
            function() {
                $( "#action-upload" ).show();
            }, function() {
                $( "#action-upload" ).hide();
            }
        );

        $( "#action-upload" ).click(function () {
            $('.cropit-image-input').click();;
            $('.save-image-btn').show();
            $('.cropit-controller').show();
        })
    });
};