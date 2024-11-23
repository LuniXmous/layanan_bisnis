<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Apps') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.webp') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}" />
    @yield('css')
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <style>
        .sidebar-wrapper {
            width: 230px;
        }
        #main {
            margin-left: 215px;
        }
    </style>
</head>
<body>
    <div id="app">
    @if(Auth::check())
        <div id="sidebar" class="{{ Route::is('application.create') || Route::is('application.edit') ? '' : 'active' }}">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative pb-0">
                    <div class="logo text-center">
                        <img src="{{ asset('assets/images/logo.webp') }}" alt="Logo" />
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu p-0">
                        @if (Auth::user()->role->alias != 'admin' && Auth::user()->role->alias != 'wadir4')
                            <li class="sidebar-item
                            {{ Request::route()->action['as'] == 'application.index' ? 'active' : null }}">
                                    <a href="{{ route('application.index') }}" class="sidebar-link">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Pengajuan</span>
                                </a>
                            </li>
                        @endif
                        <!-- sidebar wadir 2 -->
                        @if (Auth::user()->role->alias == 'wadir2' || env('GOD_MODE'))
                            <li class="sidebar-item
                            {{ Request::route()->action['as'] == 'application.tebusan' ? 'active' : null }}">
                                <a href="{{ route('application.tebusan') }}" class="sidebar-link">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Tebusan</span>
                                </a>
                            </li>
                        @endif
                        <!-- sidebar wadir 4 -->
                        @if (Auth::user()->role->alias == 'wadir4' || env('GOD_MODE'))
                            <li class="sidebar-item
                            {{ Request::route()->action['as'] == 'application.index' ? 'active' : null }}">
                                <a href="{{ route('application.index', ['approve_status' => '1,2']) }}" class="sidebar-link">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Pengajuan</span>
                                </a>
                            </li>
                        @endif
                        <!-- sidebar admin -->
                        @if (Auth::user()->role->alias == 'admin' || env('GOD_MODE'))
                            <li class="sidebar-item 
                                {{ Request::route()->action['as'] == 'dashboard' ? 'active' : null }}">
                                <a href="{{ route('dashboard') }}" class="sidebar-link">
                                <i class="fa-solid fa-house"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="sidebar-item dropdown 
                                {{ Request::route()->action['as'] == 'application.index' ? 'active' : null }}">
                                <a href="#" class="sidebar-link dropdown-toggle" id="pengajuanDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Pengajuan</span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="pengajuanDropdown">
                                    <li>
                                        <a href="{{ route('application.index') }}" class="dropdown-item">
                                        <i class="fa-solid fa-border-all"></i>
                                            Semua Pengajuan
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('application.index', ['approve_status' => '1,2']) }}" class="dropdown-item">
                                        <i class="fa-solid fa-clock"></i>
                                            Menunggu Review
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('application.index', ['approve_status' => '0', 'status' => '1,2,3']) }}" class="dropdown-item">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                            Perlu Perbaikan
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('application.index', ['approve_status' => '3,4', 'status' => '1,2,3']) }}" class="dropdown-item">
                                            <i class="fa-solid fa-circle-check"></i>
                                            Review Selesai
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item 
                                {{ Request::route()->action['as'] == 'application.report' ? 'active' : null }}">
                                <a href="{{ route('application.report') }}" class="sidebar-link">
                                <i class="fa-solid fa-money-bill-wave"></i>
                                    <span>Laporan Dana</span>
                                </a>
                            </li>
                            <li class="sidebar-item 
                                {{ Request::route()->action['as'] == 'unit.index' ? 'active' : null }}">
                                <a href="{{ route('unit.index') }}" class="sidebar-link">
                                    <i class="fas fa-th"></i>
                                    <span>Unit</span>
                                </a>
                            </li>
                            <li class="sidebar-item 
                                {{ Request::route()->action['as'] == 'user.index' ? 'active' : null }}">
                                <a href="{{ route('user.index') }}" class="sidebar-link">
                                    <i class="fas fa-users"></i>
                                    <span>Pengguna</span>
                                </a>
                            </li>
                        @endif
                        <hr>
                        <li class="sidebar-item
                            {{ Request::route()->action['as'] == 'profile' ? 'active' : null }}">
                            <a href="{{ route('profile') }}" class="sidebar-link">
                                <i class="fas fa-user"></i>
                                <span>Profile Saya</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('logout') }}" class="sidebar-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Keluar</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-xl-4 mb-3">
                <a href="#" class="burger-btn {{ Route::is('application.create') || Route::is('application.edit') ? 'd-block' : 'd-block d-xl-none' }}">
                    <div class="btn btn-primary">
                        <i class="bi bi-justify fs-5"></i>
                    </div>
                </a>
            </header>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>@yield('page-title')</h3>
                        </div>
                    </div>
                </div>
                <section class="content mt-3 ">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        <p>{{ session('error') }}</p>
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success">
                        <p>{{ session('success') }}</p>
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    @yield('content')
                </section>
            </div>
        </div>
        @else
        <section>
            @yield('content')
        </section>

        @endif
    </div>
    @yield('modal')
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    @yield('script')
    @yield('scripts')
</body>
</html>
