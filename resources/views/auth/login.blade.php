@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row main-row">
			<form role="form" method="POST" action="{{ url('/login') }}" class="login-form">
            <div class="col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1">

                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Login to BuildGrid</h2>
                        <p>
                            Login to BuildGrid to access your account
                        </p>
                        
                        <hr>
                    </div>
                </div>

                <div class="row">
                        <div class="form-group col-md-6 col-xs-12">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>

                        <div class="form-group col-md-6 col-xs-12">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <!-- 
                            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                             -->
                            {!! csrf_field() !!}
                        </div>                    
                </div>
                <div class="row">
                        <div class="form-group col-md-4 col-md-offset-4 col-xs-6 col-xs-offset-3">
                            <button type="submit" class="btn btn-block standard-blue-button">Log in</button>
                        </div>                	
                </div>
				</form>
				
                <div class="row form-group">
                	<div class="col-md-12 col-xs-12">
	                    <p class="text-center">
	                        Or
	                    </p>
					</div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-6 form-group">
                        <a class="btn btn-block standard-blue-button" href="{{ url('/password/reset') }}">Google+</a>
                    </div>
                    <div class="col-md-6 col-xs-6 form-group">
                        <a class="btn btn-block standard-blue-button" href="{{ url('/password/reset') }}">LinkedIn</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
