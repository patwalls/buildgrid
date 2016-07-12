@extends('email.layout')

@section('content')
<p>
<strong>{{ $supplier_name }}</strong>,
</p>

<p>
{{ $purchaser_name }} has invited you to bid on a list of materials for their project: <strong>{{ $project_name }}</strong>.
</p>

<p>
You can upload your response here: <a href="{{ route('supplierBomView',[$supplier_hashid])  }}"><strong>View on BuildGrid</strong></a>
</p>

@endsection
