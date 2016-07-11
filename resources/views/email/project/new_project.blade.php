@extends('email.layout')

@section('content')

    <p>
        <strong>{{ $name }}</strong>,
    </p>

    <p>
        A new project has been created at BuildGrid. Check out the project here: <br>
        <strong><a href="{{ $project_bom_admin_url }}" target="_blank">{{ $project_name }} : {{ $bom_name }}</a></strong>.
    </p>


@endsection
