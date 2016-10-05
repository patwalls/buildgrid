@extends('email.layout')

@section('content')

    <p>
        <strong>{{ $purchaser_name }}</strong>,
    </p>

    <p>
    A supplier has responded your BOM for project: <strong>{{ $project_name }}</strong>. Great work! <br>
    </p>

    <p>If you have any questions, please feel free to email us directly at <a href="mailto:info@buildgrid.com">info@buildgrid.com</a></p>


@endsection
