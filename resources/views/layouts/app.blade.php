<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/blog.js') }}" defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" defer></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link  href="{{ asset('css/home.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img width='50' height='50' src='data:image/png;base64,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'>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

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

                        <li class="nav-item">
                        <a class="nav-link " href='{{url('home/profile')}}/{{Auth::id()}}' >My Profile
                            </a></li>
                            <li class="nav-item">
                                <a class="nav-link " href='{{url('home/')}}' >Home
                                    </a></li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
