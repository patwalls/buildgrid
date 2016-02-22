@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="row">
                <h1>Edit profile</h1>
            </div>

			<div class="row">
				<div class="col-sm-6 col-md-6">
					@if (count($errors) > 0)
	    				<div class="alert alert-danger">
	        			<ul>
	            		@foreach ($errors->all() as $error)
	                		<li>{{ $error }}</li>
	            		@endforeach
	        			</ul>
	    			</div>
					@endif
				</div>
			</div>
            <div class="row spaced">
				<div class="col-sm-6 col-md-6">
					<form action="{{ route('update.profile') }}" class="form-horizontal" method="post">
					    <div class="form-group form-group-lg">
					        <label class="col-sm-4 control-label" for="first_name">First Name</label>
					        <div class="col-sm-8">
					           <input class="form-control" type="text" id="first_name" name="first_name" value="{{ $user->first_name }}">
					        </div>
					    </div>
					    <div class="form-group form-group-lg">
					        <label class="col-sm-4 control-label" for="last_name">Last Name</label>
					        <div class="col-sm-8">
					           <input class="form-control" type="text" id="last_name" name="last_name" value="{{ $user->last_name }}">
					        </div>
					    </div>
					    <div class="form-group form-group-lg">
					        <label class="col-sm-4 control-label" for="email">Email</label>
					        <div class="col-sm-8">
					           <input class="form-control" type="text" id="email" name="email" value="{{ $user->email }}">
					        </div>
					    </div>					    
					    <div class="form-group form-group-lg">
					        <div class="col-md-offset-4 col-md-4 text-center">
					            <input type="hidden" name="id" value="{{ $user->id }}">
					            <input type="hidden" name="_token" value="{{ csrf_token() }}">
					            <input type="hidden" name="_method" value="put">
					            <input class="btn btn-block standard-blue-button" type="submit" value="Save">
					        </div>
					    </div>
					</form>  
				</div>
            </div>

        </div>
    </div>
</div>

@endsection
