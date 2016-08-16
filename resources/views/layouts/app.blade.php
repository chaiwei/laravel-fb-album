<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $page_title or "Admin Dashboard" }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome/4.6.3/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/3.3.7/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/global.style.css') }}">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <!-- JavaScripts -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/css/bootstrap/3.3.7/js/bootstrap.min.js') }}"></script>

</head>
<body id="app-layout">
    <div id="page-wrapper">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Laravel
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/home') }}">Home</a></li>
                        <li><a href="{{ url('/album') }}">Album</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div id="main-content">
            <!-- Display Validation Errors -->
            @include('errors.errors')
            @yield('content')
        </div>

        <div id="footer">
            <div class="container">
              <div class="col-md-6"></div>
              <div class="col-md-6 text-right">Version {{ config('app.version') }}</div>
            </div>
        </div>

        @yield('custom_js')
    </div>

    <script src="{{ asset('assets/js/nanobar.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.pjax.js') }}"></script>
    <script type="text/javascript">

        var nano_options = {
          bg: '#acf',
          id: 'loading-nanobar'
        };

        var nanobar = new Nanobar( nano_options );

        $(document).ready(function(){

            // pjax
            $(document).pjax('a', '#page-wrapper');
            $(document).on('pjax:send', function() {
                nanobar.go(30);
                setTimeout( nanobar.go(60), 1500 );
            });
            $(document).on('pjax:complete', function() {
                nanobar.go(100);
            });

            // does current browser support PJAX
            if ($.support.pjax) {
              $.pjax.defaults.timeout = 4000; // time in milliseconds
            }
        });
    </script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
