@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
    	<img src="/images/plus-icon.png" class="plus-icon" alt="">
		  <h2>Edit profile</h2>
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
  <div class="row spaced">
			<div class="col-sm-6 col-md-6">
				<form action="{{ route('update.profile') }}" method="post">
				    <div class="form-group">
		        	<label for="first_name">First Name</label>
	           	<input class="form-control" type="text" id="first_name" name="first_name" value="{{ $user->first_name }}">
				    </div>
				    <div class="form-group">
			        <label for="last_name">Last Name</label>
	            <input class="form-control" type="text" id="last_name" name="last_name" value="{{ $user->last_name }}">
				    </div>
				    <div class="form-group">
		        	<label for="email">Email</label>
		          <input class="form-control" type="text" id="email" name="email" value="{{ $user->email }}">
				    </div>
				    <div class="form-group">
			        <label for="phone">Phone</label>
	           	<input class="form-control" type="text" id="phone" name="phone" value="{{ $user->phone }}">
				    </div>
				    <div class="form-group">
				        <label for="phone">Company Name</label>
		           	<input class="form-control" type="text" id="company_name" name="company_name" value="{{ $user->company_name }}">
				    </div>
				    <div class="form-group">
		        	<label for="phone">Position</label>
		          <input class="form-control" type="text" id="position_title" name="position_title" value="{{ $user->position_title }}">
				    </div>
				    <div class="row">
				    	<div class="col-md-6">
						    <div class="form-group">
			            <input type="hidden" name="id" value="{{ $user->id }}">
			            <input type="hidden" name="_token" value="{{ csrf_token() }}">
			            <input type="hidden" name="_method" value="put">
			            <input class="btn btn-block standard-blue-button" type="submit" value="Save">
						    </div>
				    	</div>
				    </div>			    
				</form>  
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
