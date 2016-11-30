@extends('email.layout')

@section('content')

    <p>
        <strong>{{ $supplier_name }}</strong>,
    </p>

    <p>
        Congrats! You have successfully completed your submission for project <strong>{{$bom_name}}</strong>. <strong>{{$purchaser_name}}</strong> has been notified and will review your bid.

    </p>

    <p>If you have any questions, please feel free to email us directly at <a href="mailto:info@buildgrid.com">info@buildgrid.com</a></p>


@endsection
