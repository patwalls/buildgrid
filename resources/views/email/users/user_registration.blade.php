@extends('email.layout')

@section('content')

<style>
  * {
    line-height: 20px;
  }
</style>

<p>Hi {{ $full_name }} and welcome to BuildGrid, the materials purchasing marketplace you always wanted. Thanks for signing up! You’ve joined hundreds of people who use BuildGrid to get their projects done in a more transparent and reliable way. Here are a few handy tip to get you started.</p>

<ul>
  <li>Use BuildGrid as a transparent marketplace to request bids on materials you are purchasing.</li>
  <li>Kick things off… <a href="{{ route('getCreateProject')  }}">Create your first BOM today!</a></li>
  <li>If you want to know more about how the BuildGrid commuity works, check out our <a href="https://buildgrid.ktcdev.com/#how-it-works">3 easy steps</a></li>
</ul>

<p>If you need anything else from our team of experts, please feel free to email us directly at <a href="mailto:info@buildgrid.com">info@buildgrid.com</a>.</p>

<p>Thanks again for signing up! We’re so happy to have you join the BuildGrid movement.</p>

<p>- The team at BuildGrid</p>

@endsection



 



 



