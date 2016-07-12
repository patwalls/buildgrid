@extends('email.layout')

@section('content')

<p>Uh-oh you lost your password? No worries, we got you covered.</p>

<p>
<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">
    Click here to reset your password
</a>
</p>

<p>If you are still having password issues, please email us directly at <a href="mailto:info@buildgrid.com">info@buildgrid.com</a></p>

@endsection

