@extends('email.layout')

@section('content')

    <p>
        Thank you, <strong>{{ $supplier_name }}</strong>
    </p>

    <p>
        Your response has been received successfully.
    </p>

    <p>If you have any questions, please feel free to email us directly at <a href="mailto:info@buildgrid.com">info@buildgrid.com</a></p>


@endsection
