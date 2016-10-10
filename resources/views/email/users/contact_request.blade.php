@extends('email.layout')

@section('content')

    <style>
        * {
            line-height: 20px;
        }
    </style>

    <p>New contact request from {{ $name }} (<a href="mailto:{{ $email }}">{{ $email }}</a>):</p>

    <p style="padding: 20px; font-family: 'Courier New' , Monospace">{{ $message_body }}</p>

    <p style="color:darkgray; font-size: 12px;">You can respond directly to this email to continue the conversation.</p>

@endsection


