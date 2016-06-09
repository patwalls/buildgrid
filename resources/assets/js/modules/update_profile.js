var uploader = new ajaxuploader.SimpleUpload({
      button: 'upload-btn', // HTML element used as upload button
      url: 'profile/uploadProfileImage/' + $('input[name="id"]').val(), // URL of server-side upload handler
      name: 'uploadfile', // Parameter name of the uploaded file
      data: {
        _token: $('input[name="_token"]').val()
      }
});