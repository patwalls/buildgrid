@extends('layouts.app')

@section ('content')

<div class="container">
  <div class="row">
    <div class="col-sm-4 col-md-4 col-lg-4">
      <div class="b2">Suppliers</div>
      @foreach( $invited_suppliers as $invited_supplier)
      <div class="panel panel-default suppier-item-wrap">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-6">
              <div class="b3">Name</div>
              <div class="b2">
                {{ $invited_supplier->name }}
              </div>
            </div>
             <div class="col-md-6">
              <div class="b3">Status</div>
              <div class="b2 bom-status-color">
                {{ ucwords(preg_replace(['/(?<=[^A-Z])([A-Z])/', '/(?<=[^0-9])([0-9])/'], ' $0', $invited_supplier->status)) }}
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="b3">Response Link</div>
              <div class="b2">
                <input type="text" value="{{ route('supplierBomView',[$invited_supplier->hashid])  }}">
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
          <button class="add-supplier-to-bom"><i class="icon ion-ios-plus-outline"></i> Add another supplier</button>
        </div>
        <input type="hidden" name="bom_id" value="{{ $bom->id }}">
        {!! csrf_field() !!}
        <div class="row">
          <div class="col-md-12 submit-new-supplier-btn">
            
          </div>
        </div>
      </form>
    </div>
    <div class="col-sm-8 col-md-8 col-lg-8">
      <span class="b1">{{ $user->fullName}} |</span>  <span class="b2"> {{ $bom->project->name }}</span>
      <h2>{{ $bom->name }}</h2>
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
            <div class="col-md-6">
                <div id="pdf-preview" data-document-url="{{ route('bomDownload', [$bom->id, $bom->filename]) }}"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('bomDownload', [$bom->id]) }}">Download BOM</a>
            </div>
        </div>
        {{-- / project details--}}


        {{-- Responses --}}
        <div class="response-detail">
          <div class="b2">Project Response Activity</div>
        </div>
        @foreach($responses as $response)
        <div class="row">
            <div class="col-md-12 response-detail">
              <div class="response-header-wrap">
                <div class="response-inner-wrap-item">
                  <span class="b1">{{ $response->invitedSupplier->name }}</span> Uploaded {{ Date::parse($response->created_at)->ago() }}
                </div>
                <div class="response-inner-wrap-item">
                  <span class="b4 response-file"><i class="ion-paperclip"></i> <a href="{{ route('bomResponseDownload', [$response->id]) }}">Download Response</a></span>
                </div>
              </div>
              <div class="b4">Comments:</div>
                @if($response->comment)
                    <p class="b3">
                        {{$response->comment}}
                    </p>
                @endif
            </div>
        </div>
        @endforeach

        {{-- /Responses --}}


    </div>
  </div>
</div>

@endsection
