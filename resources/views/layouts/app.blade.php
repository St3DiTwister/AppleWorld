<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/toastr.min.js')}}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/helper.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/toastr.css')}}">

    <script>
        $(document).ready(function (){
            toastr.options = {
                "positionClass": "toast-bottom-right",
                "progressBar": true,
                "timeOut": "3000",
            }
            @if(session()->has('basket_add') and Route::currentRouteName() != 'basket')
                toastr.success('{{session()->get('basket_add')}}');
            @endif
            @if(session()->has('like_info'))
                toastr.info('{{session()->get('like_info')}}');
            @endif
            @if(session()->has('like_success'))
                toastr.success('{{session()->get('like_success')}}');
            @endif
        });
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container container-desktop">
                <a class="navbar-brand fw-bold p-3" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-0 me-sm-5">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories') }}">{{ __('Категории') }}</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav w-100 ms-sm-5 me-sm-5">
                        <li class="nav-item w-100">
                            <form action="{{route('main')}}" method="get" class="search_form">
                                <div class="input-group">
                                    <input type="text" required class="form-control bg-transparent search-input" name="search" placeholder="Введите название товара" value="{{$_GET['search'] ?? ''}}"
                                           aria-label="Введите название товара" aria-describedby="basic-addon2">
                                    <button type="submit" class="input-group-text bg-transparent border-0 position-absolute search-loupe" id="basic-addon2"><img src="{{asset('img/search.png')}}" alt="лупа"/></button>
                                </div>
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-0 me-0 ms-sm-5 me-sm-4">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item me-sm-3">
                                @php
                                  $favourites = count(\App\Models\User::find(Auth::id())->favourites);
                                @endphp
                                <a class="nav-link" href="{{route('favourites')}}">@if($favourites != 0)<span class="nav-count">{{$favourites}}</span>@endif{{__('Избранное')}}</a>
                            </li>
                            <li class="nav-item me-sm-3">
                                @php
                                    try {
                                        $basket = \App\Models\User::find(Auth::id())->currentOrder[0]->getCount();
                                    } catch (Exception $e){
                                        $basket = 0;
                                    }
                                @endphp
                                <a class="nav-link" href="{{route('basket')}}">@if($basket != 0)<span class="nav-count">{{$basket}}</span>@endif{{__('Корзина')}}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->login }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">{{ __('Профиль') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Выйти') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
            <div class="container">
                @if(session()->has('success'))
                    <p class="alert alert-success">
                        {{session()->get('success')}}
                    </p>
                @endif
                @if(session()->has('error'))
                    <p class="alert alert-danger">
                        {{session()->get('error')}}
                    </p>
                @endif
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
