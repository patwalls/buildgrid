@extends('layouts.app')

@section('content')

  <!-- Add new BOM Partial -->
  <div class="container">
    <div class="col-md-12">
      @include('partials.create_bom_partial')  
    </div>
  </div>

@endsection
