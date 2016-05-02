@extends('layouts.app')

@section('content')

  <!-- Add new BOM Partial -->
  <div class="container">
    <div class="col-md-12">
      @if( $projects->isEmpty() )
          @include('partials.first_login_partial')
      @endif
      @include('partials.create_bom_partial')  
    </div>
  </div>

@endsection
