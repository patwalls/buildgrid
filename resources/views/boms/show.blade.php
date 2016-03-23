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
              <div class="b2">
                {{ $invited_supplier->status }}
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
              <div class="b3">Email</div>
              <div class="b2">
                <button type="button" id="myButton" data-loading-text="Sending..."  autocomplete="off"  data-href="{{ route('sendSupplierReminder',[$invited_supplier->id])  }}" class="btn btn-primary btn-sm resend-email-notification js-resend-email">Resend BOM</button>
                <p class="bg-success" id="bom-notify-success">Your BOM has been resent</p> 
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="col-sm-8 col-md-8 col-lg-8">
      <span class="b1">{{ $user->first_name . " " .  $user->last_name . " | "}}</span><span class="b2"> {{ $bom->project->name }}</span>
      <h2>{{ $bom->name }}</h2>
      <form method="post" action="{{ route('addNewSuppliers', [$bom->id]) }}">
        <div class="row supplier-item-wrap">
          <div class="form-group col-md-6">
              <label>Invite suppliers to your BOM</label>
              <input type="text" class="form-control" name="supplier[1][name]" placeholder="Supplier Name">
          </div>
          <div class="form-group col-md-6">
              <label>&nbsp;</label>
              <input type="text" class="form-control" name="supplier[1][email]" placeholder="Supplier Email">
          </div>
        </div>
        <div class="row center-block">
          <button class="add-supplier-to-bom"><i class="icon ion-ios-plus-outline"></i> Add another supplier</button>
        </div>
        <input type="hidden" name="bom_id" value="{{ $bom->id }}">
        {!! csrf_field() !!}
        <div class="row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary btn-sm update-suppliers-btn">Update Suppliers</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection