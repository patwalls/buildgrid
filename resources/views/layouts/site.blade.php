<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/images/buildgrid-favicon-01.png">

    <title>BuildGrid</title>

    <!-- Fonts -->
    <link href="" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="{{  elixir('css/site.css') }}" rel="stylesheet">
    <link href="/css/vendor.css" rel="stylesheet">

</head>
<body>
    
    @include('partials.header')
    
    @yield('content')

    @include('partials.footer')

    <!-- JavaScripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="{{ elixir('js/site.js') }}"></script>

</body>
</html>
