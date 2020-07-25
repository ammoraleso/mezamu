<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title', 'Default Title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('js/home.js')}}"></script>
    <script src="{{ asset('js/reload_cart_icon.js') }}" type="text/javascript"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- bootstrap 4.1.0 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
    <link rel="stylesheet" href="{{asset('css/utils.css')}}">

    @stack('stylesAndScripts')
</head>
<body>
    
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark navbar-laravel" style="background: rgba(0,0,0,.7);">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img alt="Mezamu Logo" class="custom-logo" src="/images/logo_blanco_sin_fondo.png">
                </a>
                <div  class="row">
                    <div id="cartIcon" class="mr-3">
                        @if(Session::has('cart') && \Illuminate\Support\Arr::get(Session::get('cart'),'totalQuantity') > 0)
                            <a  href="{{route('cart')}}">
                                <img class="icon" alt="user" src="{{asset('images/full_cart_icon.png')}}">
                            </a>
                            <span id="cartBadge">
                                <div  class="icon-badge badge-danger">{{\Illuminate\Support\Arr::get(Session::get('cart'),'totalQuantity')}}</div>
                            </span>
                        @else
                            <a href="{{route('cart')}}">
                                <img class="icon" width="100%" height="100%" alt="user" src="{{asset('images/empty_cart_icon.png')}}">
                            </a>
                        @endif
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse column" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->

                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('login') ? 'active' : ''  }}"  href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('register') ? 'active' : ''  }}" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
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
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

    </div>
</body>
</html>
