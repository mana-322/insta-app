<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- CSS Link --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{---style---}}
    <style>
    body.instagram-bg {
        background-color: #cde8f8;
    }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="instagram-bg">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #fcf8ef; color: rgb(70, 46, 15);">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   <h1><i class="fa-brands fa-instagram" style="color: rgb(252, 200, 228); font-size: 50px !important;"></i></h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    {{-- [SOON] Search bar here --}}
                   @auth
                       @if (!request()->is('admin/*'))
                       <ul class="navbar-nav ms-auto">
                        <form action="{{route('search')}}" style="width: 300px">
                            <div class="d-flex align-items-center">
                            <i class="fa-solid fa-magnifying-glass" style="color: rgb(252, 200, 228); font-size: 40px;"></i>
                            <input type="serach" name="search" class="form-control form-control-sm" style="background-color: rgba(252, 200, 228, 0.726); border: none;">
                            </div>
                        </form>
                       </ul>       
                       @endif
                   @endauth

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
                            {{-- Home --}}
                            <li class="nav-item" title="Home">
                                <a href="{{route('index')}}" class="nav-link">
                                    <i class="fa-solid fa-house icon-sm" style="color: rgb(252, 200, 228);"></i>
                                </a>
                            </li>

                            {{-- Create Post --}}
                             <li class="nav-item" title="Create Post">
                                <a href="{{route('post.create')}}" class="nav-link">
                                    <i class="fa-solid fa-circle-plus icon-sm" style="color: rgb(252, 200, 228);"></i>
                                </a>
                            </li>

                            {{-- Account --}}
                            <li class="nav-item dropdown">
                               <button id="account-dropdown" class="btn shadow-none nav-link" data-bs-toggle="dropdown">
                                @if (Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle avatar-sm" style="color: rgb(252, 200, 228);">
                                    
                                @else
                                 <i class="fa-solid fa-circle-user icon-sm" style="color: rgb(252, 200, 228);"></i>
                                @endif
                               </button>



                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                                    {{-- [SOON] ADMIN CONTROLS --}}
                                    {{-- @can('admin') --}}
                                    @if (Gate::allows('admin'))
                                    <a href="{{ route('admin.users') }}" class="dropdown-item">
                                        <i class="fa-solid fa-user-gear" style="color: rgb(252, 200, 228);"></i>Admin
                                    </a>
                                    
                                    <hr class="dropdown-divider">
                                        
                                    @endif

                                    {{-- @endcan --}}


                                    {{-- Profile --}}
                                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="dropdown-item">
                                        <i class="fa-solid fa-circle-user" style="color: rgb(252, 200, 228);"></i>Profile
                                    </a>

                                    {{-- Logout --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa-solid fa-right-from-bracket" style="color: rgb(252, 200, 228);"></i> 
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

        <main class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    {{-- [SOON] ADMIN MENU --}}
                    @if (request()->is('admin/*'))
                    <div class="col-3">
                        <div class="list-group">
                            <a href="{{ route('admin.users') }}" class="list-group-item {{ request()->is('admin/users') ? 'active' : '' }}">
                                <i class="fas fa-user"></i>Users
                            </a>
                            <a href="{{ route('admin.posts' )}}" class="list-group-item {{ request()->is('admin/posts') ? 'active' : '' }}">
                                <i class="fa-solid fa-newspaper"></i>Posts
                            </a>
                            <a href="{{ route('admin.categories') }}" class="list-group-item {{ request()->is('admin/categories') ? 'active' : '' }}">
                                <i class="fa-solid fa-tags"></i>Categories
                            </a>
                        </div>
                    </div>
                        
                    @endif

                    <div class="col-9">
                        @yield('content')

                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
