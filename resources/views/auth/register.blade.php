@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row main-row">

            <div class="col-md-4 col-md-offset-1">

                <div class="row">
                    <div class="col-md-12">
                        <h2>Sign Up</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad asperiores cupiditate doloremque fuga.
                        </p>
                    </div>
                </div>


                <div class="row">

                    <form role="form" method="POST" action="{{ url('/register') }}">

                        <div class="col-md-12">
                            <label for="first_name">Name</label>
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="first_name" placeholder="First">
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="last_name" placeholder="Last">
                        </div>


                        <div class="form-group col-md-12">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            {!! csrf_field() !!}
                        </div>


                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                        </div>

                    </form>

                </div>

                <div class="row">
                    <p class="text-center">
                        Or
                    </p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <a class="btn btn-block btn-primary bg-google-plus bd-google-plus ho-google-plus" href="{{ url('/password/reset') }}">Sign Up with Google+</a>
                    </div>
                    <div class="col-md-6">
                        <a class="btn btn-block btn-primary bg-linkedin bd-linkedin ho-linkedin" href="{{ url('/password/reset') }}">Sign Up with LinkedIn</a>
                    </div>
                </div>

            </div>

            <div class="col-md-6 col-md-offset-1 hidden-sm hidden-xs">
                <img src="{{ asset('images/brand/BG-logo.jpg') }}" alt="BuildGrid Logo" class="center-block logo"/>
            </div>

        </div>
    </div>

@endsection
