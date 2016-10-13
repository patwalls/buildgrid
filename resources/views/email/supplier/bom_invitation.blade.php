@extends('email.layout')

@section('content')

<p>Hi {{ $supplier_name }}, </p>

<p>Congrats! - You’ve just been invited by {{ $purchaser_name }} to bid on a new project! </p>
 
<p>BuildGrid offers a purchasing materials marketplace where your clients can connect with you and manage the purchasing process. As such, this is a great place for you to connect with your clients with the opportunity of increasing your revenue and finding new customers. </p>

<p>We will be launching new tools and resources for Suppliers like you in order to help you manage existing client, and discover new business. </p>

<p>Hurry now! <a href="{{ route('supplierBomView',[$supplier_hashid])  }}">Click here</a> to reply to {{ $purchaser_name }}’s BOM. </p>

<p>{{ $purchaser_name }} and BuildGrid appreciate your prompt reply to this bid and your continued support!</p>

<p>If you have any questions about our platform or need support, please feel free to email us directly at <a href="mailto:support@buildgrid.com">support@buildgrid.com</a>. </p>

<p>- The team at BuildGrid</p>

@endsection


