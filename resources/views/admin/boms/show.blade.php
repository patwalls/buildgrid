@extends('layouts.admin')

@section('content')
    <div class="app-current-proj-outer-wrap view-bom">
        <div class="container" id="app-current-proj-wrap">
            <div class="row">
                <div class="col-md-12 inner-wrap">
                    <div class="col-md-6 item-wrap">
                        <span class="b2">{{ $bom->project->name }}</span>
                    </div>
                    <div class="col-md-6 item-wrap">
                        @if($bom->status != 'archived' && $bom->status != 'accepted')
                            <a id="archive-bom" tabindex="0" role="button" data-toggle="popover" data-href="{{route('setArchiveBom', $bom->id)}}" data-placement="bottom" title="Are you sure?" data-container="body" - data-content=''><span class="b2"><i class="icon ion-archive"></i>Archive BOM</span></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container bom-info">
        <div class="row">
            <div class="col-sm-2 col-md-3 col-lg-3 left-app-dash-outer-wrap">
                <div class="b2 supplier-title">Invited Suppliers</div>
                @foreach( $invited_suppliers as $invited_supplier)
                    @if($invited_supplier->email ==  \Auth::user()->email)
                        @continue
                    @endif
                    <div class="panel panel-default suppier-item-wrap">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="b2 supplier-link">
                                        <div class="b2 supplier-link">
                                            {{ $invited_supplier->name }} |
                          <span>
                              @if(count($invited_supplier->responseAcceptedFromBom) >= 1 )
                                  Accepted
                              @else
                                  {{ ucwords(preg_replace(['/(?<=[^A-Z])([A-Z])/', '/(?<=[^0-9])([0-9])/'], ' $0', $invited_supplier->status)) }}
                              @endif
                          </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($bom->status != 'archived' && $bom->status != 'accepted')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="b2">
                                            <button type="button" id="myButton" data-loading-text="Sending..."  autocomplete="off"  data-href="{{ route('sendSupplierReminder',[$invited_supplier->id])  }}" class="btn btn-primary btn-sm resend-email-notification js-resend-email">Resend Email</button>
                                            <p class="bg-success" id="bom-notify-success">Your BOM has been resent</p>
                                            <button type="button" id="copyLink" class="btn btn-primary btn-sm copy-link" data-href="{{url('bom_supplier_view', $invited_supplier->hashid)}}">Copy Link</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
                <div class="col-md-12"><p id="copy-notify-success"></p></div>
                @if($bom->status != 'archived' && $bom->status != 'accepted')
                    <form id="add-supplier" method="post" action="{{ route('addNewSuppliers', [$bom->id]) }}">
                        <hr class="light-hr">
                        <div class="row supplier-item-wrap"></div>
                        <div class="row center-block">
                            <button class="add-supplier-to-bom"><i class="icon ion-plus-circled"></i> Add New Supplier</button>
                        </div>
                        <input type="hidden" name="bom_id" value="{{ $bom->id }}">
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-md-12 submit-new-supplier-btn"></div>
                        </div>
                    </form>
                @endif
            </div>
            <div class="col-sm-8 col-md-7 col-lg-7 right-app-dash-outer-wrap">
                <h2>{{ $bom->name }}</h2>
                <div class="b2 update-wrap"><span>Updated:</span> {{ $bom->updated_at->diffForHumans() }}</div>
                @if ($errors->any())
                    @foreach( $errors->all() as $error)
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Yikes!</strong> {{ $error }}
                        </div>
                    @endforeach
                @endif

                {{-- project details --}}
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('bomDownload', [$bom->id]) }}" class="download-bom-link">
                            <img id="pdf-preview" src="{{ route('getBomPreview', $bom->id) }}"/>
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('bomDownload', [$bom->id]) }}" class="download-bom-link">Download File</a>
                        </div>
                    </div>
                    {{-- / project details--}}

                    @if($bom->status != 'archived' && $bom->status != 'accepted')

                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="well">Bom Response</h3>

                                <div class="upload-wrap">
                                    <div class="b2">Add A Response</div>
                                    <div id="dropzone" class="dropzone"></div>
                                </div>
                                <form onsubmit="return false;" class="response-text-wrap admin-response-form">
                                    <div class="b2">Comments</div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="comment" id="comment" rows="5" placeholder="Comments..."></textarea>
                                    </div>
                                    <button id="postResponseBtn" class="btn btn-default">Send</button>
                                    <input type="hidden" value="{{ $bom->id }}" name="bom_id">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>

                    @endif
                    {{-- Responses --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="response-detail">
                                <div class="b2">Project Response Activity</div>
                            </div>
                        </div>
                    </div>
                    <div class="response-outer-wrap">
                        @foreach($responses as $response)
                            <div class="row">
                                <div class="col-md-12 response-detail">
                                    <div class="response-detail-inner">

                                        <div class="response-header-wrap">
                                            <div class="response-inner-wrap-item">
                                                <div class="left-response-inner-wrap">
                                                    <div class="response-header-content">
                                                        <span class="b1">{{ $response->invitedSupplier->name }}</span>
                                                        <span class="b1">{{ $response->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    @if($response->comment)
                                                        <p class="b3">
                                                            {{$response->comment}}
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="right-response-inner-wrap">
                                                   @if($response->status == 'accepted')
                                                        <button class="btn btn-primary new-proj-btn" data-href="{{route('setResponsePending', $response->id)}}">{{ucfirst($response->status)}}</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <img id="pdf-preview" src="{{ route('getBomResponsePreview', $response->id) }}"/>
                                        <span class="b4 response-file"><i class="ion-paperclip"></i> <a href="{{ route('bomResponseDownload', [$response->id]) }}">Download Response</a></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- /Responses --}}
                </div>
            </div>
            <div class="col-md-2">

                @include('admin.navigation')

            </div>
        </div>
    </div>
@endsection
