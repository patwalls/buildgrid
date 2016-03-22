<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BuildGrid - {{ $supplier->bom->project->name }}</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <link rel="shortcut icon" href="/images/buildgrid-favicon-01.png">

    <style>

        @font-face {
            font-family: AvenirLTStd;
            src: url(../../fonts/AvenirLTStd-Roman.otf);
            font-weight: 500; }

        @font-face {
            font-family: AvenirLTStd;
            src: url(../../fonts/AvenirLTStd-Black.otf);
            font-weight: 700; }

        body {
            font-family: AvenirLTStd;
            margin: 30px 0;
        }

        h1{
            font-weight: bold;
        }

        .giant-icon{
            font-size: 14em;
            margin: 20px 0;
            color: #666970;
        }

        .download-link {
            display: block;
            margin: 20px 0;
            color: #666970;
            font-weight: bold;
            text-decoration: underline;
        }

        .download-link:hover{
            color: #00468b;
        }

        .dropzone{
            text-align: center;
            border: 2px dashed #666970;
            border-radius: 8px;
            padding: 30px;
            cursor: pointer;
            margin: 20px 0;
        }

    </style>
</head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-2">
                   <h2>
                       {{ $supplier->bom->project->user->fullname }}
                   <small>{{ $supplier->bom->project->name }}</small>
                   </h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-2">
                    <h1>{{ $supplier->bom->name }}</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-2">
                    <i class="fa fa-file-text-o giant-icon"></i>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-2">
                    {{ $supplier->bom->filename }}
                    <a class="download-link" href="{{ route('bomFileDownload', [$supplier->hashid]) }}">Download file</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div id="dropzone" class="dropzone"></div>
                    <form onsubmit="return false;">
                        <div class="form-group">
                            <textarea class="form-control" name="comment" id="comment" rows="5" placeholder="Comments..."></textarea>
                        </div>
                        <button id="postResponseBtn" class="btn btn-default pull-right">Send my response</button>
                    </form>
                </div>
            </div>

        </div>

        <script src="//cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

        <script>

            Dropzone.autoDiscover = false;

            var bomResponseDropzone = new Dropzone("div#dropzone", {
                url: "/bom_response_upload",
                autoProcessQueue: false,
                maxFiles: 1,
                maxfilesexceeded: function maxfilesexceeded(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                },
                dictDefaultMessage: "<i class='fa fa-upload fa-4x'></i><br/><h3>Drag & Drop</h3> your response or <span class='underline'>browse...</span>",
                success: function success(file, response) {
                    swal({title : "Thank you!", text : "Your response file and comments were submitted!", type : "success"}, function(){
                        window.location.href = "/";
                    })
                },
                error: function error(file, errorMessage) {
                    swal("Oops...", "Something went wrong! Please try again later.", "error");
                }
            }).on("sending", function(file, xhr, formData) {
                formData.append("_token", '{{csrf_token()}}');
                formData.append("comment", document.getElementById('comment').value);
                formData.append("hashid", '{{$supplier->hashid}}');
            });;

            document.getElementById('postResponseBtn').onclick = function(){
                bomResponseDropzone.processQueue();
            };

        </script>

    </body>
</html>
