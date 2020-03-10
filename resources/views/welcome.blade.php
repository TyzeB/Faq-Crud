<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>
    <div class="position-ref">
        @if (Request::is('login') || Request::is('register'))
            <a href="{{ route('welcome', '') }}" class="left-main">List</a>
        @endif
        @if (Route::has('login'))
        
        <div class="right links">
            
            @auth
            <a href="{{ route('logout') }}">Logout</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif

        @if (Request::is('login'))
            @yield('login')
        @elseif (Request::is('register'))
            @yield('register')
        @else 
            <div id="app">
                <example-component></example-component>
            </div>               
        @endif

        
    </div>
    <script>
        var auth = {{ Auth::check() }} || false;
        window.auth = auth;
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>