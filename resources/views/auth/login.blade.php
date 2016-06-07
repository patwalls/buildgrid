@extends('layouts.site')

@section('content')

@include('partials.login-hero')
<div class="utility-center-row">
    <div class="auth-form">
        <div class="auth-form__header">
            <span class="header">Login to <strong>BuildGrid</strong></span>
        </div>
        <div class="auth-form__content">
            <form role="form" method="POST" action="{{ url('/login') }}" class="login-form">
                <div class="auth-form__fields">                
                    {!! csrf_field() !!}
                    @if ( $errors->any() )
                            {{ $errors->first('email') }}
                            {{ $errors->first('password') }}
                    @endif
                    <div class="@if ($errors->has('email')) has-error @endif utility--stack-col">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                    </div>
                    <div class="@if ($errors->has('password')) has-error @endif utility--stack-col">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="auth-form__submit">Sign in</button>
                    <div class="auth-form__social-logins">
                        <a href="{{ route('login.google') }}" class="auth-form__social-logins--google"></a>
                        <a href="{{ route('login.linkedin') }}" class="auth-form__social-logins--linkedin"></a>
                    </div>
                </div>
                <div class="auth-form__password">
                    <a href="{{ url('/password/reset') }}">Forgot Password?</a>
                </div>
            </form>
        </div>
        <div class="auth-form__footer">
        </div>
    </div>
</div>

@endsection
