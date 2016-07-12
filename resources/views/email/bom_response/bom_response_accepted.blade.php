@extends('email.layout')

@section('content')

    <p>
        <strong>{{ $invited_supplier_name }}</strong>,
    </p>

    <p>
    {{ $purchaser_name }} has accepted your BOM for project: <strong>{{ $project_name }}</strong>. Great work! <br>
        To contact your client, please email them directly at <a href="mailto:{{ $purchaser_email }}">{{ $purchaser_email }}</a>!
    </p>

    <p>If you have any questions, please feel free to email us directly at <a href="mailto:info@buildgrid.com">info@buildgrid.com</a></p>


@endsection
