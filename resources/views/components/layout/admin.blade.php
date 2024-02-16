@props([
	'title',
	'h1' => null
])


<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.scss'])
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand">
                RisRoll
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
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
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
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
        <div>
            <div class="container py-2">
                <div class="row">
                    <div class="col col-3">
                        <div class="list-group">
                            <li class="list-group-item">
                                <a href="{{ route('city.index') }}">Города</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('manager.index') }}">Менеджеры</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('pickup.index') }}">Точки самовывоза</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('promotion.index') }}">Акции</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('zone.index') }}">Зоны доставки</a>
                            </li>
                        </div>
                    </div>
                    <div class="col col-9">
                        @if (session('alert'))
                            <div class="alert alert-info" role="alert">
                                {{ session('alert') }}
                            </div>
                        @endif
                        <h1>{{ $h1 ?? $title }}</h1>
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@vite(['resources/js/app.js'])
</body>
</html>

