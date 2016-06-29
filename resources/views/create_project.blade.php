@extends('layouts.app')

@section('content')

 @include('partials.add-project-header')

  <!-- Add new BOM Partial -->
  <div class="container footer-align">
    <div class="col-md-12">
      @if( is_null($project) )
          @include('partials.first_login_partial')
      @endif
      @include('partials.create_bom_partial')  
    </div>
  </div>

@endsection
