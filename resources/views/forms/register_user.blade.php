<div class="utility-center-row">
    <div class="auth-form">
        <div class="auth-form__header">
            <span class="header">Sign Up with <strong>BuildGrid</strong></span>
        </div>
        <div class="auth-form__content">
            <form role="form" method="POST" action="{{ url('/register') }}" class="register-form">
                <div class="auth-form__fields">
                  {!! csrf_field() !!}
                    @if ( $errors->any() )
                        {{ $errors->first('first_name') }}
                        {{ $errors->first('last_name') }}
                        {{ $errors->first('email') }}
                        {{ $errors->first('password') }}
                    @endif
                    <div class="@if ($errors->has('first_name')) has-error @endif utility--stack-col">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
                    </div>
                    <div class="@if ($errors->has('last_name')) has-error @endif utility--stack-col">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                    </div>
                    <div class="@if ($errors->has('email')) has-error @endif utility--stack-col">
                        <label for="email">Email address</label>
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="@if ($errors->has('password')) has-error @endif utility--stack-col">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <button type="submit" class="auth-form__submit">Sign Up</button>
                    <div class="auth-form__social-logins">
                        <a href="{{ route('login.google') }}" class="auth-form__social-logins--google"></a>
                        <a href="{{ route('login.linkedin') }}" class="auth-form__social-logins--linkedin"></a>
                    </div>
                </div>
            </form> 
        </div>
    </div>
</div>