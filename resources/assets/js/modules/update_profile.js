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
            var picture = $('#image-cropper').cropit('export');
            var picture_thumbnail = $('#image-cropper').cropit('previewSize', { width: 40, height: 40 } );
            picture_thumbnail = picture_thumbnail.cropit('export');
            var url = $(this).data('href');
            $.ajax({
                url: url,
                picture: picture,
                thumbnail: picture_thumbnail,
            }).done(function() {
                    swal("Updated!", "Profile picture updated", "success");
                    location.reload();
            });
        });
    });
};