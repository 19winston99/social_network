<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Window</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark sticky-top z-3" data-bs-theme="dark">
            <div class="container-fluid">
                @auth
                <a class="navbar-brand text-white hover" href="{{ route('home') }}"><i class="bi bi-strava"></i> Window</a>
                @endauth
                @guest
                <a class="navbar-brand text-white hover m-auto" href="{{ route('home') }}"><i class="bi bi-strava"></i> Window</a>
                @endguest
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @auth
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-white hover" href="/users/{{ Auth::user()->id }}"><i class="bi bi-person-circle"></i> {{ Auth::user()->name }} {{ Auth::user()->lastname }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white hover" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-gear-wide-connected"></i>
                                Impostazioni
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/users/{{ Auth::user()->id }}/edit"><i class="bi bi-pencil-square"></i> Modifica Dati Personali</a></li>
                                <li><a class="dropdown-item" href="{{ url('/terms&conditions') }}"><i class="bi bi-file-earmark-text"></i> Termini & Condizioni</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-door-closed-fill"></i> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex" role="search" method="GET" action="{{ url('/search') }}">
                        <input class="form-control me-2" name="search" type="search" placeholder="Trova i tuoi amici..." aria-label="Search">
                        <button class="btn btn-sm btn-outline-light" type="submit">Cerca</button>
                    </form>
                </div>
                @endauth
            </div>
        </nav>
        @auth
        <div class="sidebar">
            <div class="rainbow-line"></div>
            <div class="profile-container mt-4">
                <img src="{{ asset('images/users/'. Auth::user()->profile) }}" alt="Profile Image" class="mt-4 ms-2">
            </div>
        </div>
        @endauth
        <main class="mt-4">
            @yield('content')
            @extends('layouts.footer')
        </main>
    </div>
</body>

</html>