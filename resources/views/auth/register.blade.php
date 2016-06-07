@extends('layouts.app')

@section('content')

  <!-- Hero Wrap -->
  @include('partials.marketing-index.hero-wrap')

<div class="container">
    <div class="row main-row">
        <div class="col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1">
		    <form role="form" method="POST" action="{{ url('/register') }}" class="register-form">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <span class="header">Create an <strong>Account</strong></span>
                        <p class="body-copy-2">
                            Signing up with BuildGrid is easy and free.
                        </p>
                        <hr>
                    </div>
                </div>
                @if ( $errors->any() )
				<div class="row">
					<div class="col-md-12 col-xs-12 alert alert-danger">
					    {{ $errors->first('first_name') }}
					    {{ $errors->first('last_name') }}
					    {{ $errors->first('email') }}
					    {{ $errors->first('password') }}
					</div>
				</div>
				@endif
                <div class="row">
                    <div class="form-group col-md-6 col-xs-12 @if ($errors->has('first_name')) has-error @endif">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{ old('first_name') }}">
                    </div>
                    <div class="form-group col-md-6 col-xs-12 @if ($errors->has('last_name')) has-error @endif">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
                    </div>
                </div>
                <div class="row">
                        <div class="form-group col-md-6 col-xs-12 @if ($errors->has('email')) has-error @endif">
                            <label for="email">Email address</label>
                            <input type="text" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group col-md-6 col-xs-12 @if ($errors->has('password')) has-error @endif">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                </div>
                <div class="row">
                        <div class="form-group col-md-4 col-md-offset-4 col-xs-6 col-xs-offset-3">
                        	{!! csrf_field() !!}
                            <button type="submit" class="btn btn-block standard-blue-button">Sign Up</button>
                        </div>                	
                </div>                
                <div class="row form-group">
                	<div class="col-md-12 col-xs-12">
	                    <p class="text-center">
	                        Or
	                    </p>
					</div>
                </div>
            <div class="row">
                    <div class="col-md-5 col-md-offset-1 col-xs-5 col-xs-offset-1 form-group">
                        <a class="btn btn-block standard-blue-button" href="{{ route('login.google') }}">Google+</a>
                    </div>
                    <div class="col-md-5 col-xs-5 form-group">
                        <a class="btn btn-block standard-blue-button" href="{{ route('login.linkedin') }}">LinkedIn</a>
                    </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
