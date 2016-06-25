@extends('layouts.admin')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-2">

                @include('admin.navigation')

            </div>

            <div class="col-md-10">

                <h2>{{ $bom->project->name }} <small>{{$bom->name}}</small></h2>


                <div class="row">

                    <div class="col-md-8">

                        <div class="row">
                            <div class="col-md-12">
                                <div id="pdf-preview" data-document-url="{{ route('bomDownload', [$bom->id, $bom->filename]) }}"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('bomDownload', [$bom->id]) }}" class="download-bom-link">Download File</a>
                            </div>
                        </div>



                        <div class="row">

                            <h3 class="well">Bom Response</h3>

                            <div class="upload-wrap">
                                <div class="b2">Add A Response</div>
                                <div id="dropzone" class="dropzone"></div>
                            </div>
                            <form onsubmit="return false;" class="response-text-wrap">
                                <div class="b2">Comments</div>
                                <div class="form-group">
                                    <textarea class="form-control" name="comment" id="comment" rows="5" placeholder="Comments..."></textarea>
                                </div>
                                <button id="postResponseBtn" class="btn btn-default">Send</button>
                                <input type="hidden" value="{{ $bom->id }}" name="bom_id">
                                {{ csrf_field() }}
                            </form>

                        </div>



                        <div class="row">

                            <h3 class="well">Project Response Activity</h3>

                            @foreach($responses as $response)

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="response-header-content">
                                                    {{ $response->invitedSupplier->name }}
                                                    <span class="pull-right">{{ $response->created_at->diffForHumans() }}</span>
                                                </div>
                                                @if($response->comment)
                                                    <p> {{$response->comment}} </p>
                                                @endif

                                                <span class="b4 response-file"><i class="ion-paperclip"></i> <a href="{{ route('bomResponseDownload', [$response->id]) }}">Download Response</a></span>

                                            </div>
                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>


                    <div class="col-md-3 col-md-offset-1 well">

                        <h3>Invited Suppliers</h3>
                        @foreach( $invited_suppliers as $invited_supplier)
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <small>Name</small>
                                    <br>
                                    {{ $invited_supplier->name }}
                                    <br>
                                    <small>Status</small>
                                    <br>
                                    <span>{{ ucwords(preg_replace(['/(?<=[^A-Z])([A-Z])/', '/(?<=[^0-9])([0-9])/'], ' $0', $invited_supplier->status)) }}</span>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>




            </div>
        </div>
    </div>
@endsection
