<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/images/buildgrid-favicon-01.png">

    <title>BuildGrid - {{ $supplier->bom->project->name }}</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link href="/css/vendor.css" rel="stylesheet">
    <link href="{{  elixir('css/app.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="/images/buildgrid-favicon-01.png">
</head>

    <body id="app-layout">
        <div class="app-inner-wrap">
            <nav class="navbar navbar-default">
                <div class="container" id="app-content-wrap">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url( Auth::guest() ? '/' :'/home' ) }}">
                            <img src="/images/logo.png" alt="">
                        </a>
                        <div class="navbar-link-wrap">
                            <a href="{{ url('/') }}" target="_blank">Home</a>
                            {{-- <a href="{{ url('/home') }}">Current Projects </a> --}}
                            {{-- This was the project counter, commented it out --}}
                            {{-- <span class="red-counter">4</span> --}}
                            <a href="{{ url('/#contact-us') }}" target="_blank">Contact</a>
                        </div>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                                <li><a href="{{ url('/login') }}">Login</a></li>
                                <li><a href="{{ url('/register') }}">Sign Up</a></li>
                            @else
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} 
                                        <img src="/images/sample_profile.png" alt="">
                                        <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('/home') }}"> <i class="fa fa-btn fa-home"></i>Home</a></li>
                                        <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i> Profile</a></li>
                                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('content')

            <footer>
               <div class="b2">
                    &#169; {{  date('Y') }} Build<span>Grid</span> / All Rights Reserved.
               </div>  
            </footer>
        </div>

        <script src="//cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <script src="{{ elixir('js/app.js') }}"></script>
        
    </body>
</html>

