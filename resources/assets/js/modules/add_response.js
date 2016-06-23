module.exports = () => {
    "use strict";

    var bomResponseDropzone = new dropzone("div#dropzone", {
        url: "/bom_response_upload",
        autoProcessQueue: false,
        maxFiles: 1,
        maxfilesexceeded: function maxfilesexceeded(file) {
            this.removeAllFiles();
            this.addFile(file);
        },
        dictDefaultMessage: "<i class='fa fa-upload fa-4x'></i><br/><h3>Drag & Drop</h3> your response or <span class='underline'>browse...</span>",
        success: function success(file, response) {
            swal({
                title: "Thank you!",
                text: "Your response file and comments were submitted!",
                type: "success"
            }, function () {
                window.location.href = "/";
            })
        },
        error: function error(file, errorMessage) {
            swal("Oops...", "Something went wrong! Please try again later.", "error");
        }
    }).on("sending", function (file, xhr, formData) {
        formData.append("_token",  document.getElementsByName('_token')[0].value);
        formData.append("comment", document.getElementById('comment').value);
        formData.append("hashid", '{{$supplier->hashid}}');
    });
    ;

    document.getElementById('postResponseBtn').onclick = function () {
        bomResponseDropzone.processQueue();
    };

    pdfObject.embed($('#pdf-preview').data('document-url'), '#pdf-preview', {height: "540px"});

}
