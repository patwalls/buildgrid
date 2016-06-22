@extends('layouts.app')

@section('content')

<div class="container footer-align">
  <div class="row">
    <div class="col-md-12">
    	<img src="/images/plus-icon.png" class="plus-icon" alt="">
		  <h2>Edit profile</h2>
			@if (count($errors) > 0)
				<div class="row">
					<div class="col-sm-6 col-md-6">
	    				<div id="form-error" class="alert alert-danger">
	        			<ul>
	            		@foreach ($errors->all() as $error)
	                		<li>{{ $error }}</li>
	            		@endforeach
	        			</ul>
		    			</div>
					</div>
				</div>
			@endif
		</div>
	</div>
  <div class="row spaced">
	  <div class="col-sm-6">
			@include('forms.edit_user')
	  </div>
  </div>
  <div class="row">
    <div class="col-md-12">
		  <h2>Change Password</h2>
			@if (count($errors) > 0)
				<div class="row">
					<div class="col-sm-6 col-md-6">
	    				<div class="alert alert-danger">
	        			<ul>
	            		@foreach ($errors->all() as $error)
	                		<li>{{ $error }}</li>
	            		@endforeach
	        			</ul>
		    			</div>
		    		</div>
					</div>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<form method="post" action="{{ route('update.password', [$user->id]) }}">
		    <div class="form-group">
        	<label for="first_name">New Password</label>
					<input type="password" name="password" id="password" class="form-control">
		    </div>
		    <div class="form-group">
        	<label for="first_name">Confirm Password</label>
					<input type="password" name="confirm_password" id="confirm_password" class="form-control">
		    </div>
		    <div class="row">
		    	<div class="col-md-6">
				    <div class="form-group">
		      		<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
		      		<input type="submit" class="btn btn-block standard-blue-button">
		      	</div>
		      </div>
		    </div>
			</form>
		</div>
	</div>
</div>

@endsection
