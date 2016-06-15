@extends('layouts.app')

@section ('content')

<div class="app-current-proj-outer-wrap">
    <div class="container" id="app-current-proj-wrap">
        <div class="row">
            <div class="col-md-12 inner-wrap">
                <div class="col-md-6 item-wrap">
                  <span class="b2">{{ $bom->project->name }}</span>
                </div>
                <div class="col-md-6 item-wrap">
                  <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content='<button id="fake-target" class="btn btn-success btn-decline">Don&#39;t Archive</button> <button class="btn btn-success btn-confirm">Yes, Archive</button>'><span class="b2"><i class="icon ion-archive"></i>Archive BOM</span></a>
                  <a href="{{ route('getCreateProject') }}"><button class="btn btn-success new-proj-btn">New Project</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-12 col-md-3 col-lg-3 left-app-dash-outer-wrap">
      <div class="b2 supplier-title">Suppliers</div>
      @foreach( $invited_suppliers as $invited_supplier)
      <div class="panel panel-default suppier-item-wrap">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <div class="b2 supplier-link">
                {{ $invited_supplier->name }} | <span>{{ ucwords(preg_replace(['/(?<=[^A-Z])([A-Z])/', '/(?<=[^0-9])([0-9])/'], ' $0', $invited_supplier->status)) }}</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="b2">
                <button type="button" id="myButton" data-loading-text="Sending..."  autocomplete="off"  data-href="{{ route('sendSupplierReminder',[$invited_supplier->id])  }}" class="btn btn-primary btn-sm resend-email-notification js-resend-email">Resend BOM</button>
                <p class="bg-success" id="bom-notify-success">Your BOM has been resent</p> 
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      <form method="post" action="{{ route('addNewSuppliers', [$bom->id]) }}">
        <hr class="light-hr">
        <div class="row supplier-item-wrap">
{{--           <div class="form-group col-md-12">
              <label>Invite more suppliers to your BOM</label>
              <input type="text" class="form-control" name="supplier[1][name]" placeholder="Supplier Name">
          </div>
          <div class="form-group col-md-12">
              <input type="text" class="form-control" name="supplier[1][email]" placeholder="Supplier Email">
          </div> --}}
        </div>
        <div class="row center-block">
          <button class="add-supplier-to-bom"><i class="icon ion-plus-circled"></i> Add another supplier</button>
        </div>
        <input type="hidden" name="bom_id" value="{{ $bom->id }}">
        {!! csrf_field() !!}
        <div class="row">
          <div class="col-md-12 submit-new-supplier-btn">
            
          </div>
        </div>
      </form>
    </div>
    <div class="col-sm-12 col-md-9 col-lg-9 right-app-dash-outer-wrap">
      <h2>{{ $bom->name }}</h2>
      <div class="b2 update-wrap"><span>Updated:</span> {{ getDaysAgo($bom->updated_at) }}</div> 
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
              <div id="pdf-preview" data-document-url="{{ route('bomDownload', [$bom->id, $bom->filename]) }}"></div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-12">
              <a href="{{ route('bomDownload', [$bom->id]) }}" class="download-bom-link">Download File</a>
          </div>
      </div>
      {{-- / project details--}}

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
                        <span class="b1">{{ getDaysAgo($response->created_at) }}</span>
                      </div>
                      @if($response->comment)
                          <p class="b3">
                              {{$response->comment}}
                          </p>
                      @endif
                    </div>
                    @if($response->status == 'pending')
                        <div class="right-response-inner-wrap">
                           <button class="btn btn-primary new-proj-btn btn-accept-response" data-href="{{route ('setResponseAccepted', $response->id)}}">Accept</button>
                           <button class="btn btn-confirm btn-decline-response" data-href="{{route('setResponseRejected', $response->id)}}">Decline</button>
                        </div>
                    @else
                          <div class="right-response-inner-wrap">
                              <span class="b1">{{ucfirst($response->status)}}</span>
                          </div>
                    @endif
                  </div>
                </div>
                <span class="b4 response-file"><i class="ion-paperclip"></i> <a href="{{ route('bomResponseDownload', [$response->id]) }}">Download Response</a></span>
              </div>
            </div>
        </div>
        @endforeach
      </div>
      {{-- /Responses --}}
    </div>
  </div>
</div>

@endsection
