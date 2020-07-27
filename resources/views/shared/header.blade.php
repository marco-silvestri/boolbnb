<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BoolBnB</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet"> 
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <!-- Leaflet Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css" />

    <!-- includes the Braintree JS client SDK -->
    <script src="https://js.braintreegateway.com/web/dropin/1.22.1/js/dropin.min.js"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    </head>
<body>
    <div id="app" class="scrolled">
        <nav @if (Request::route()->getName() != 'index' && Request::route()->getName() != 'guest.city') class="navbar navbar-expand-md navbar-light blue-bg" @else class = "navbar navbar-expand-md navbar-light"@endif>
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="img-no-text"src="{{asset('img/logo.png')}}" alt="">
                    <img class="img-text"src="{{asset('img/logotype-nobg1.png')}}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-icon">
                        <i class="fas fa-bars"></i>
                    </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item dropdown">
                                <a class="dropdown-item full" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> <br> <span>{{ __('Login') }}</span>
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item dropdown">
                                    <a class="dropdown-item full" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus pl-2"></i>
                                        <br> <span>{{ __('Registrati') }}</span>
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                 <a class="dropdown-item" href="{{ route('index') }}">
                                    <i class="fas fa-home"></i> <br>
                                    <span @if (Request::route()->getName() == 'index') class="label-active" @else class="label" @endif >Home</span> 
                                </a>

                                <a class="dropdown-item" href="{{route('user.dashboard')}}">
                                    <i class="fas fa-house-user"></i> <br>
                                    <span @if (Request::route()->getName() == 'user.dashboard') class="label-active" @else class="label" @endif >Dashboard</span> 
                                </a>

                                <a class="dropdown-item" href="{{ route('user.message') }}">
                                    <i class="fas fa-envelope"></i> <br>
                                    <span @if (Request::route()->getName() == 'user.message') class="label-active" @else class="label" @endif >Messaggi</span>
                                </a>

                                <a class="dropdown-item" href="{{ route('user.apartment.create')}}">
                                    <i class="fas fa-plus"></i> <br>
                                    <span @if (Request::route()->getName() == 'user.apartment.create') class="label-active" @else class="label" @endif >Aggiungi</span>
                                </a>
                                
                                <a class="dropdown-item"href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                               <i class="fas fa-sign-out-alt"></i></i> <br>
                               <span class="label">{{ __('Logout') }}</span>
                                        
                                </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>