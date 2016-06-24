module.exports = () => {
    "use strict";

    $(document).ready(function () {
        $('#image-cropper').cropit({
            imageBackground: true
        });

        $('.select-image-btn').click(function () {
            $('.cropit-image-input').click();
            $('.cropit-controller').show();
        });

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
    });

    $('.cropit-preview-background').change(function(){
        alert("none");
    });
};