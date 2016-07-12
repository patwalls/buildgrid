@extends('email.layout')

@section('content')

<p>
<strong>{{ $name }}</strong>,
</p>

<p>
    A new BOM has been added to project {{ $project_name }}. Click here to view and respond to the BOM: <br>
    <strong><a href="{{ $project_bom_admin_url }}" target="_blank">{{ $project_name }} : {{ $bom_name }}</a></strong>.
</p>


@endsection
