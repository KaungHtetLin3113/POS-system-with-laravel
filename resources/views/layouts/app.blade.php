<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('Power Point', 'Power Point') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: #f5f7fa;
        }

        /* Navbar Modern Style */
        .navbar {
            background: linear-gradient(90deg, #0f5132, #198754);
            backdrop-filter: blur(10px);
            border-radius: 0 0 15px 15px;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 22px;
            color: #ffc107 !important;
            letter-spacing: 1px;
        }

        .navbar-brand:hover {
            color: #f0cd65 !important;
        }

        .nav-link {
            color: #e9f7ef !important;
            font-weight: 600;
            margin-left: 10px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #ffc107 !important;
            transform: translateY(-2px);
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* Dropdown */
        .dropdown-menu {
            border-radius: 10px;
            border: none;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            padding: 10px;
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 8px 12px;
            transition: 0.2s;
        }

        .dropdown-item:hover {
            background: #198754;
            color: #fff;
        }

        /* Main Content */
        main {
            padding: 30px;
        }

        /* Container spacing */
        .container {
            max-width: 1200px;
        }
        .nav-link.active-link {
            color: #ffc107 !important; /* highlight color */
            font-weight: 700;
            border-bottom: 2px solid #ffc107; /* optional underline for better effect */
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('Power Point', 'Power Point') }}
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
