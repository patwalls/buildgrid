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
    <link href="/css/vendor.css" rel="stylesheet">
    <link href="{{  elixir('css/app.css') }}" rel="stylesheet">

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
                                    <img src="{{ route('getProfilePicture', [Auth::user()->id, 'thumbnail']) }}" alt="" class="profile-picture">
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i> Profile</a></li>
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="admin-content">
            @yield('content')
        </div>

        <footer>
           <div class="b2">
                &#169; {{  date('Y') }} Build<span>Grid</span> / All Rights Reserved.
           </div>  
        </footer>
    </div>

    <!-- JavaScripts -->

    <script src="{{ elixir('js/admin.js') }}"></script>


</body>
</html>
