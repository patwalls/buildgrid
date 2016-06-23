module.exports = () => {
    "use strict";

    $(".profile-picture").hover(function () {
        $("#button-upload").show();
    }, function(){
        $("#button-upload").hide();
    });

    $(document).ready(function () {
        var img_src = $('#image-profile').attr('src');

        $('#image-cropper').cropit({
            imageState:{
            },
            imageBackground: true
        });

        $('.select-image-btn').click(function () {
            $('.cropit-image-input').click();
        });

        $('.save-image-btn').click(function () {
            var picture = $('#image-cropper').cropit('export', {type: 'image/png'});
            var picture_thumbnail = $('#image-cropper').cropit('previewSize', { width: 40, height: 40 } );
            picture_thumbnail = picture_thumbnail.cropit('export');
            var url = $(this).data('href');

            var data = {
                'picture': picture,
                'picture_thumbnail': picture_thumbnail,
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
};