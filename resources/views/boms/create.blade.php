@extends('layouts.app')

@section('content')

  <!-- Add new BOM Partial -->
  <div class="container">
    <div class="col-md-12">
      @include('partials.new_project_bom')  
    </div>
  </div>

@endsection