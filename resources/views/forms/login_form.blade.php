<div class="utility-center-row">
    <div class="auth-form">
        <div class="auth-form__header">
            <span class="header">Login to <strong>BuildGrid</strong></span>
        </div>
        <div class="auth-form__content">
            <form role="form" method="POST" action="{{ url('/login') }}" class="login-form" id="loginFormWrap">
                <div class="auth-form__fields">                
                    {!! csrf_field() !!}
{{--                     @if ( $errors->any() )
                            {{ $errors->first('email') }}
                            {{ $errors->first('password') }}
                    @endif --}}
                    <span class="error__modal-text" id="loginErrorMessage" style="display:none;"></span>
                    <div class="@if ($errors->has('email')) has-error @endif utility--stack-col">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="@if ($errors->has('password')) has-error @endif utility--stack-col">
                        <label for="password">Password</label>
                        <input type="password" name="password">
                    </div>
                    <button type="submit" class="auth-form__submit">Login</button>
                    <div class="auth-form__social-logins">
                        <a href="{{ route('login.google') }}" class="auth-form__social-logins--google"></a>
                        <a href="{{ route('login.linkedin') }}" class="auth-form__social-logins--linkedin"></a>
                    </div>
                </div>
                <div class="auth-form__password">
                    <a href="{{ url('/password/reset') }}">Forgot Password?</a><span>&nbsp;&nbsp;</span>
                    <a href="#" id="loginRegistrationRedirect"> Don't have an account? Sign Up</a>
                </div>
            </form>
        </div>
        <div class="auth-form__footer">
        </div>
    </div>
</div>