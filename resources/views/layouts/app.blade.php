<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title', 'Mezamu')</title>

    <!-- Scripts -->
    <script src="{{asset('js/home.js')}}"></script>
    <script src="{{ asset('js/reload_cart_icon.js') }}" type="text/javascript"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- bootstrap 4.1.0 Also at the end -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- End bootstrap -->


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
    <link rel="stylesheet" href="{{asset('css/utils.css')}}">


    @stack('stylesAndScripts')
</head>
<body>
    
    <!-- Floating flash message -->
    <div id="success_message" class="ajax_response floating" ></div>
    <div id="error_message" class="ajax_response red-floating" ></div>
    
    <div id="app">
        <div style="height: 97px"><!--We need the hide to move content at the end of navbar-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img alt="Mezamu Logo" class="custom-logo" src="https://mezamublobstorage.blob.core.windows.net/images/logo_blanco_sin_fondo.png">
            </a>
            <div class="d-flex">
                <div class="d-sm-inline-block d-lg-none">
                    @guest
                        <div id="cartIconSmall" class="mr-3 d-sm-inline-block d-lg-none">
                            @if(Session::has('cart') && Session::get('totalQuantity') > 0)
                                <a href="{{route('cart')}}">
                                    <img class="icon" alt="user" src="https://mezamublobstorage.blob.core.windows.net/images/full_cart_icon.png">
                                </a>
                                <span id="cartBadgeSmall">
                                    <div  class="icon-badge badge-danger">{{Session::get('totalQuantity')}}</div>
                                </span>
                            @else
                                <a href="{{route('cart')}}">
                                    <img class="icon" width="100%" height="100%" alt="user" src="https://mezamublobstorage.blob.core.windows.net/images/empty_cart_icon.png">
                                </a>
                            @endif
                        </div>
                    @endguest
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                </ul>
                <!-- Authentication Links -->
                <ul class="navbar-nav">
                    @guest
                        <div class="d-none d-lg-inline-block">
                            <div id="cartIconLarge" class="mr-3 d-none d-lg-inline-block">
                                @if(Session::has('cart') && Session::get('totalQuantity') > 0)
                                    <a href="{{route('cart')}}">
                                        <img class="icon" alt="user" src="https://mezamublobstorage.blob.core.windows.net/images/full_cart_icon.png">
                                    </a>
                                    <span id="cartBadgeLarge">
                                        <div  class="icon-badge badge-danger">{{Session::get('totalQuantity')}}</div>
                                    </span>
                                @else
                                    <a href="{{route('cart')}}">
                                        <img class="icon" width="100%" height="100%" alt="user" src="https://mezamublobstorage.blob.core.windows.net/images/empty_cart_icon.png">
                                    </a>
                                @endif
                            </div>
                        </div>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('login') ? 'active' : ''  }}"  href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }} 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('register') ? 'active' : ''  }}" href="{{ route('register') }}">{{ __('Registro') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('register') ? 'active' : ''  }}" role="button" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
        </div>

        <main>
            @yield('content')
        </main>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script type="application/javascript" src="{{asset('js/app.js')}}"></script>
    @stack('finalScripts')
</body>
</html>
