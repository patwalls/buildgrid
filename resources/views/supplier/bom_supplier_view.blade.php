@extends('layouts.external_app')

@section('content')

<div class="footer-align">
    <div class="app-current-proj-outer-wrap">
        <div class="container" id="app-current-proj-wrap">
            <div class="row">
                <div class="col-md-12 inner-wrap">
                    <div class="col-md-6 item-wrap">
                        <div class="b2">{{ $supplier->bom->project->name }}</div> 
                    </div>
                    <div class="col-md-6 item-wrap">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="supplier-head-wrap">
            <h2>{{ $supplier->bom->name }}</h2>
            <div class="b2">Uploaded: <span>{{ $supplier->bom->updated_at }} <small>({{ $supplier->bom->updated_at->diffForHumans() }})</small></span></div>
        </div>
    </div>

    <div class="container" id="supplier-upload-wrap">
        <div class="flex">
            <a class="download-link" href="{{ route('supplierBomDownload', [$supplier->hashid]) }}">
                <img id="pdf-preview" src="{{ route('getBomPreview', $supplier->bom->id) }}"/>
                <p><a class="download-link" href="{{ route('supplierBomDownload', [$supplier->hashid]) }}">Download BOM</a></p>
            </a>
        </div>

        <div class="upload-wrap">
            <div class="b2">Add A Response</div>
            <div id="dropzone" class="dropzone">
            </div>
            <br/>Supported file types: <b>.pdf, .doc, .docx, .xls, .xlsx, .csv, .jpg, .png </b><br/>Max size: <b>10 MB</b>
            <form onsubmit="return false;" class="response-text-wrap">
                <div class="b2">Comments</div>
                <div class="form-group">
                    <textarea class="form-control" name="comment" id="comment" rows="5" placeholder="Comments..."></textarea>
                </div>
                <button id="postResponseBtn" class="btn btn-default">Send</button>
                <input type="hidden" name="hashid" id="hashid" value="{{ $supplier->hashid }}">
                {{ csrf_field() }}
            </form>
        </div>
    </div>

</div>

@endsection
