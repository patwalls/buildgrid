@extends('layouts.app')

@section('content')

<div class="container footer-align">
  <div class="row">
    <div class="col-md-12">
		<div class="profile-picture">
			<span id="button-upload" class="button-upload" data-toggle="modal" data-target="#modal-picture"><i class="ion-camera"></i></span>
			@if(!$user->getProfilePicture())
    			<img id="image-profile" src="/images/plus-icon.png" class="circle-profile" alt="">
			@else
				<img id="image-profile" src="{{$user->getProfilePicture()}}" class="circle-profile" alt="">
			@endif

			<div id="modal-picture" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="uploadPicture">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div id="image-cropper">
							<div class="cropit-preview">
								<div class="cropit-preview-background-container">
									<img class="cropit-preview-background" />
								</div>
								<div class="cropit-preview-image-container">
									<img class="cropit-preview-image" />
								</div>
							</div>
							<input type="range" class="cropit-image-zoom-input" />
							<input type="file" class="cropit-image-input" />
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="btn btn-default select-image-btn">Upload picture</div>
							<div class="btn btn-default btn-primary save-image-btn" data-href="{{@route('postUploadProfilePicture', $user->id)}}">Save picture</div>
						</div>
					</div>
				</div>
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
