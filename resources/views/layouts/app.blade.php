<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('P.P', 'P.P') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700" 
    rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
<link rel="stylesheet" href="css/app.css">
    <style>
         
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('P.P', 'P.P') }}
                </a>

                <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    ☰
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side -->
                    <ul class="navbar-nav ms-auto align-items-center">
                       
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        Login
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        Register
                                    </a>
                                </li>
                            @endif
                        @else
                          <li class="nav-item">
                                   <a class="nav-link {{ request()->routeIs('home') ? 'active-link' : '' }}" href="{{ route('home') }}"> Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('categories.*') ? 'active-link' : '' }}" href="{{ route('categories.index') }}">Category</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('products.*') ? 'active-link' : '' }}" href="{{ route('products.index') }}">Product</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('cart.*') ? 'active-link' : '' }}" href="{{ route('cart.index') }}">🛒Cart
                                     <!-- 🔴 BADGE -->
                                     @if($cartCount > 0)
                                    <span class="badge bg-danger ms-1">{{ $cartCount }}</span>
                                    @endif
                                    </a>
                                </li>
                               
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" v-pre>
                                    <span style="background:#ffc107;color:#000;padding:6px 10px;border-radius:50%;font-weight:600;margin-right:8px;">
                                        {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                                    </span>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
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

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
