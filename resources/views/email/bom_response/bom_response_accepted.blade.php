@extends('email.layout')

@section('content')

    <p>
        <strong>{{ $name }}</strong>,
    </p>

    <p>
        A new project has been created at BuildGrid. Check out the project here: <br>
        <strong><a href="{{ $project_bom_admin_url }}" target="_blank">{{ $project->name }} : {{ $bom_name }}</a></strong>.
    </p>


    ___ (Client Name) has accepted your BOM. Great work! To contact your client,
    please click here ___ (Link to respond?) or email them directly at ____ (client email)!

    If you have any questions, please feel free to email us directly at info@buildgrid.com



    <p>
        A Response for BOM: <strong>{{ $bom_name }}</strong> has been accepted.
    </p>


    <p>
        You can view it here:  <a href="{{ route('getShowBom', $bom_id)  }}"><strong>View on BuildGrid</strong></a>
    </p>

@endsection

