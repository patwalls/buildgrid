@extends('email.layout')

@section('content')

<p>
    <strong>{{ $full_name }}</strong>,
</p>

<p>Welcome to BuildGrid, the materials purchasing marketplace you always wanted.
<br>
Use BuildGrid as a transparent marketplace to request bids on materials you are purchasing.</p>

<p>Create your first BOM today! Click here: <a target="_blank" href="{{ route('getCreateProject')  }}">Create a New Project</a> </p>

<p>If you have any questions, please feel free to email us directly at <a href="mailto:info@buildgrid.com">info@buildgrid.com</a></p>



@endsection
