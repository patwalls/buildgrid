@extends('layouts.app')

@section ('content')

<div class="container">
  <div class="row">
    <div class="col-sm-2 col-md-2 col-lg-2">
      <h4>Suppliers</h4>
    </div>
    <div class="col-sm-10 col-md-12 col-lg-10">
      <span class="b1">Purchaser Name</span><span class="b2"> Project Name</span>
      <h2>{{ $bom->name }}</h2>
    </div>
  </div>
</div>

@endsection