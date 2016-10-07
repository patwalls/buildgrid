@extends('email.layout')

@section('content')

<p>Hi {{ $user->first_name }} {{ $user->last_name }},</p>

<p>It seems that you’ve forgotten your password. No worries, we got you covered. </p>

<p><a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">Click here</a> to reset your password: </p>

<p>So you know, your username is {{ $user->email }}.</p>

<p>If you are still having password issues, please email us directly at <a href="info@buildgrid.com">info@buildgrid.com</a></p>

<p>We appreciate your continued support!</p>

<p>- The team at BuildGrid </p>

@endsection
