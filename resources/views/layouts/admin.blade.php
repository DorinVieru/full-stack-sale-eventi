<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- DATATABLE --}}
    <link href="https://cdn.datatables.net/v/ju/jq-3.6.0/dt-2.0.8/datatables.min.css" rel="stylesheet"> 

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
         {{-- HEADER --}}
        @include('partials.header')

        {{-- SIDEBAR --}}
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 navbar-dark bg-dark d-flex flex-column justify-content-between lateral-sidebar">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column pt-5">
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link text-white {{ Route::currentRouteName() == 'dashboard' ? 'bg-violet rounded-2' : '' }}"><i class="fa-solid fa-tachometer-alt"></i> Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.rooms.index') }}" class="nav-link text-white {{ Route::currentRouteName() == 'admin.rooms.index' ? 'bg-violet rounded-2' : '' }}"><i class="fa-solid fa-house-user"></i> Sala Meeting</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.events.index') }}" class="nav-link text-white {{ Route::currentRouteName() == 'admin.events.index' ? 'bg-violet rounded-2' : '' }}"><i class="fa-solid fa-calendar-days"></i> Eventi</a>
                            </li>
                        </ul>
                    </div>
                    <div class="pb-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="https://laravel.com/docs/11.x" class="nav-link nav-bottom text-white"><i class="fa-solid fa-headset"></i> Support</a>
                            </li>
                            <li class="nav-item">
                                <a href="http://127.0.0.1:8000/profile" class="nav-link nav-bottom text-white"><i class="fa-solid fa-gear"></i> Settings</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                {{-- MAIN --}}
                <div id="content">
                    <main class="col-md-9 ms-sm-auto col-lg-10 pt-3">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.datatables.net/v/ju/jq-3.6.0/dt-2.0.8/datatables.min.js"></script>

</html>
