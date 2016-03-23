@extends('layouts.app')

@section ('content')



<div class="container">
  <div class="row">
    <div class="col-sm-4 col-md-4 col-lg-4">
      <h4>Suppliers</h4>
      @foreach( $invited_suppliers as $invited_supplier)
      <table class="table-condensed">
        <tr>
          <th>Name</th>
          <th>Status</th>
        <tr>
          <td>
            {{ $invited_supplier->name }}
          </td>
          <td>
            {{ $invited_supplier->status }}
          </td>
        </tr>
      </table>
      <table class="table-condensed">
        <tr>
          <th>Response Link</th>
          <th>Resend Email</th>
        </tr>
        <tr>          
          <td>
            <input type="text" value="{{ route('supplierBomView',[$invited_supplier->hashid])  }}">
          </td>
          <td>
            <button data-href="{{ route('sendSupplierReminder',[$invited_supplier->id])  }}" class="resend-email-notification js-resend-email"><i class="icon ion-email"></i></button>    
          </td>
        </tr>
      </table>
      @endforeach
    </div>
    <div class="col-sm-8 col-md-8 col-lg-8">
      <span class="b1">Purchaser Name</span><span class="b2"> Project Name</span>
      <h2>{{ $bom->name }}</h2>
    </div>
  </div>
</div>

@endsection