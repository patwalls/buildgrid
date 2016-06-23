@extends('layouts.app')

@section('content')

<div class="container footer-align">
  <div class="row">
    <div class="col-md-12">
		<div class="profile-picture">
						<div id="image-cropper">
							<div class="cropit-preview">
								<div class="cropit-preview-background-container">
									<img class="cropit-preview-background" />
								</div>
								<div class="cropit-preview-image-container">
									<img class="cropit-preview-image  profile-picture-full" src="{{ route('getProfilePicture', [$user->id, 'full']) }}" />
								</div>
							</div>
							<div class="cropit-controller">
								<i class="icons ion-minus-circled"></i>
								<input type="range" class="cropit-image-zoom-input" />
								<i class="icons ion-plus-circled"></i>
							</div>
							<input type="file" class="cropit-image-input" />
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="btn btn-default select-image-btn">Upload picture</div>
							<div class="btn btn-default standard-blue-button save-image-btn" data-href="{{@route('postUploadProfilePicture', $user->id)}}">Save picture</div>
						</div>
					</div>
	  </div>
	</div>
	<div class="row">
		<div class="col-md-12">
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
