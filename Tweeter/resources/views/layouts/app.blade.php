<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tweeter</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm ps">

            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    TWEETER
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    {{-- <form action="/users" method="get" class="navbar-nav ml-auto"> --}}
                        {{-- @csrf --}}
                        <a href="/users"  type="submit">Find Users</a>
                    {{-- </form> --}}
                    <!-- Left Side Of Navbar -->
                    {{-- <ul class="navbar-nav mr-auto">
                        <li><a href="/home">Home</a></li>
                        <li><a href="/about">About</a></li>
                    </ul> --}}

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <form action="{{route('search')}}" method="POST" class="navbar-nav ml-auto">
                                @csrf
                                <input type="text" name="search" class="form-control" placeholder="search...">
                                <button class="btn btn-primary" type="submit">Submit</button>

                            </form>


                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- <a class="dropdown-item" href="/profile"> Profile</a> --}}
                                    <a class="dropdown-item" href="/profile/{{Auth::user()->id}}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('profile-form').submit();">
                                     {{ __('Profile') }}
                                 </a>
                                 <form id="profile-form" action="/profile/{{Auth::user()->id}}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>

        </nav>


        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
