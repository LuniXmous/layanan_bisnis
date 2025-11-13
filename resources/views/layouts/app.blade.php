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
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    @yield('css')
<style>
    :root {
        --sidebar-width: 230px;
        --transition-speed: 0.3s;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Arial', sans-serif;
        overflow-x: hidden;
    }

    .btn-primary {
    background-color: #018797 !important;
    border-color: #018797 !important;
    }

    .btn-primary:hover {
    background-color: #0f5757 !important;
    border-color: #0f5757 !important;
    }

    /* Sidebar Styles - DEFAULT TERBUKA UNTUK DESKTOP */
    .sidebar-wrapper {
        width: var(--sidebar-width);
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1001;
        background: #fff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        transition: transform var(--transition-speed) ease;
        overflow-y: auto;
        /* DEFAULT: SIDEBAR TERBUKA */
        transform: translateX(0);
    }

    /* === Active Sidebar Item Styling === */
    .sidebar-item.active > .sidebar-link,
    .sidebar-item.active > .sidebar-link i,
    .sidebar-item.active > .sidebar-link span {
        color: #018797 !important;
        font-weight: 600;
    }

    .sidebar-item.active > .sidebar-link {
        background-color: rgba(1, 135, 151, 0.1) !important;
        border-left: 4px solid #018797 !important;
    }

    .sidebar-link:hover {
        background-color: #0f5757 !important;
        border-color: #0f5757 !important;
    }

    /* Konten utama - DEFAULT DENGAN MARGIN UNTUK DESKTOP */
    #main {
        margin-left: var(--sidebar-width);
        transition: margin-left var(--transition-speed) ease;
        min-height: 100vh;
        position: relative;
        z-index: 1;
    }

    /* Styling untuk burger button - BIRU (Primary) */
    .burger-btn {
        position: fixed;
        top: 15px;
        left: 15px;
        z-index: 1002;
        background: #018797!important;
        border: none;
        border-radius: 4px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .burger-btn i {
        color: white;
        font-size: 18px;
    }

    /* ========== MOBILE STYLES ========== */
    @media (max-width: 1023px) {
        /* Sidebar tersembunyi di mobile */
        .sidebar-wrapper {
            transform: translateX(-100%);
        }
        
        /* Sidebar terbuka di mobile */
        .sidebar-wrapper.active,
        .sidebar-wrapper.ps.active {
            transform: translateX(0);
        }
        
        /* Konten utama tanpa margin di mobile */
        #main {
            margin-left: 0;
        }
        
        /* Overlay saat sidebar aktif di mobile */
        .sidebar-wrapper.active ~ #main::before,
        .sidebar-wrapper.ps.active ~ #main::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            background: rgba(0, 0, 0, 0.5);
            cursor: pointer;
            
        }

        #page-start{
            margin-top: 20px;
        }

        .modal-backdrop{
            display: none !important;
        }
    }

    /* ========== DESKTOP STYLES ========== */
    @media (min-width: 1024px) {
        .sidebar-wrapper,
        .sidebar-wrapper.active,
        .sidebar-wrapper.ps,
        .sidebar-wrapper.ps.active {
            transform: translateX(0) !important;
        }
        
        #main {
            margin-left: var(--sidebar-width) !important;
        }
        
        /* Tombol burger disembunyikan di desktop */
        .burger-btn {
            display: none !important;
        }
    }

    /* Prevent dropdown from closing sidebar */
    .sidebar-item.dropdown .dropdown-menu {
        position: absolute !important;
        transform: none !important;
        margin-top: 0;
    }

    .dropdown-toggle::after {
        display: inline-block;
        margin-left: auto;
    }

    /* Typography */
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Arial', sans-serif;
        font-weight: 600;
    }

    p, li, span {
        font-family: 'Arial', sans-serif;
        font-weight: 400;
    }

</style>

<body>
    <div id="app">
        @if(Auth::check())
        <div id="mai">
            <div class="sidebar-wrapper">
                <div class="sidebar-header position-relative pb-0">
                    <div class="logo text-center">
                        <img src="{{ asset('assets/images/logo.webp') }}" alt="Logo" />
                        <img src="{{ asset('assets/images/logo_rtpu.png') }}" alt="Logo">
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu p-0">
                        <!-- Menu items -->
                        @if (Auth::user()->role->alias != 'admin' && Auth::user()->role->alias != 'wadir4' && Auth::user()->role->alias != 'wadir2' && Auth::user()->role->alias != 'direktur' && Auth::user()->role->alias != 'wadir1' && Auth::user()->role->alias != 'ppk')
                            <li class="sidebar-item 
                                {{ Request::route()->action['as'] == 'dashboard' ? 'active' : null }}">
                                <a href="{{ route('dashboard') }}" class="sidebar-link">
                                <i class="fa-solid fa-house"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>    
                            <li class="sidebar-item
                            {{ Request::route()->action['as'] == 'application.index' ? 'active' : null }}">
                                    <a href="{{ route('application.index') }}" class="sidebar-link">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Pengajuan</span>
                                </a>
                            </li>
                        @endif
                        <!-- Direktur -->
                        @if (Auth::user()->role->alias == 'direktur'|| env('GOD-Mode'))
                            <li class="sidebar-item 
                                {{ Request::route()->action['as'] == 'dashboard' ? 'active' : null }}">
                                <a href="{{ route('dashboard') }}" class="sidebar-link">
                                <i class="fa-solid fa-house"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="sidebar-item
                                {{ Request::route()->action['as'] == 'application.index' && request()->get('type') == 'pengajuandir' ? 'active' : null }}">
                                <a href="{{ route('application.index', ['type' => 'pengajuandir']) }}" class="sidebar-link">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Pengajuan</span>
                                </a>
                            </li>
                            <li class="sidebar-item {{ Request::get('type') === 'historydir' ? 'active' : null }}">
                                <a href="{{ route('application.index', ['type' => 'historydir']) }}" class="sidebar-link">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    <span>Riwayat Pengajuan</span>
                                </a>
                            </li>
                        @endif
                        <!-- sidebar wadir 1 -->
                        @if (Auth::user()->role->alias == 'wadir1' || env('GOD_MODE'))
                            <li class="sidebar-item 
                                {{ Request::route()->action['as'] == 'dashboard' ? 'active' : null }}">
                                <a href="{{ route('dashboard') }}" class="sidebar-link">
                                <i class="fa-solid fa-house"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="sidebar-item
                                {{ Request::route()->action['as'] == 'application.index' && request()->get('type') == 'pengajuanwd1' ? 'active' : null }}">
                                <a href="{{ route('application.index', ['type' => 'pengajuanwd1']) }}" class="sidebar-link">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Pengajuan</span>
                                </a>
                            </li>
                            <li class="sidebar-item {{ Request::get('type') === 'historywd1' ? 'active' : null }}">
                                <a href="{{ route('application.index', ['type' => 'historywd1']) }}" class="sidebar-link">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    <span>Riwayat Pengajuan</span>
                                </a>
                            </li>
                        @endif
                        <!-- sidebar wadir 2 -->
                        @if (Auth::user()->role->alias == 'wadir2' || env('GOD_MODE'))
                            <li class="sidebar-item 
                                {{ Request::route()->action['as'] == 'dashboard' ? 'active' : null }}">
                                <a href="{{ route('dashboard') }}" class="sidebar-link">
                                <i class="fa-solid fa-house"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="sidebar-item
                                {{ Request::route()->action['as'] == 'application.index' && request()->get('type') == 'pengajuanwd2' ? 'active' : null }}">
                                <a href="{{ route('application.index', ['type' => 'pengajuanwd2']) }}" class="sidebar-link">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Pengajuan</span>
                                </a>
                            </li>
                            <li class="sidebar-item {{ Request::get('type') === 'historywd2' ? 'active' : null }}">
                                <a href="{{ route('application.index', ['type' => 'historywd2']) }}" class="sidebar-link">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    <span>Riwayat Pengajuan</span>
                                </a>
                            </li>
                            <!-- <li class="sidebar-item
                                {{ Request::route()->action['as'] == 'application.tebusan' ? 'active' : null }}">
                                <a href="{{ route('application.tebusan') }}" class="sidebar-link">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Tebusan</span>
                                </a>
                            </li>  -->
                            <li class="sidebar-item {{ Request::get('type') === 'memowd2' ? 'active' : null }}">
                                <a href="{{ route('application.index', ['type' => 'memowd2']) }}" class="sidebar-link">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Memo</span>
                                </a>
                            </li>
                        @endif
                        <!-- sidebar wadir 4 -->
                        @if (Auth::user()->role->alias == 'wadir4' || env('GOD_MODE'))
                            <li class="sidebar-item 
                                {{ Request::route()->action['as'] == 'dashboard' ? 'active' : null }}">
                                <a href="{{ route('dashboard') }}" class="sidebar-link">
                                <i class="fa-solid fa-house"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="sidebar-item 
                                {{ Request::route()->action['as'] == 'application.report' ? 'active' : null }}">
                                <a href="{{ route('application.report') }}" class="sidebar-link">
                                <i class="fa-solid fa-money-bill"></i>
                                    <span>Nilai Kontrak</span>
                                </a>
                            </li>
                            <li class="sidebar-item
                                {{ Request::route()->action['as'] == 'application.index' && request()->get('type') == 'pengajuanwd4' ? 'active' : null }}">
                                <a href="{{ route('application.index', ['type' => 'pengajuanwd4']) }}" class="sidebar-link">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Pengajuan</span>
                                </a>
                            </li>
                            <li class="sidebar-item {{ Request::get('type') === 'historywd4' ? 'active' : null }}">
                                <a href="{{ route('application.index', ['type' => 'historywd4']) }}" class="sidebar-link">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    <span>Riwayat Pengajuan</span>
                                </a>
                            </li>
                        @endif
                        <!-- sidebar ppk -->
                        @if (Auth::user()->role->alias == 'ppk'|| env('GOD-Mode'))
                            <li class="sidebar-item 
                                {{ Request::route()->action['as'] == 'dashboard' ? 'active' : null }}">
                                <a href="{{ route('dashboard') }}" class="sidebar-link">
                                <i class="fa-solid fa-house"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="sidebar-item
                                {{ Request::route()->action['as'] == 'application.index' && request()->get('type') == 'pengajuanppk' ? 'active' : null }}">
                                <a href="{{ route('application.index', ['type' => 'pengajuanppk']) }}" class="sidebar-link">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Pengajuan</span>
                                </a>
                            </li>
                            <li class="sidebar-item {{ Request::get('type') === 'historyppk' ? 'active' : null }}">
                                <a href="{{ route('application.index', ['type' => 'historyppk']) }}" class="sidebar-link">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    <span>Riwayat Pengajuan</span>
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
                                        <a href="{{ route('application.index', ['type' => 'pengajuanadmin']) }}" class="dropdown-item">
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
                                        <a href="{{ route('application.index', ['approve_status' => [3,5], 'status' => [1,2,3]]) }}" class="dropdown-item">
                                            <i class="fa-solid fa-circle-check"></i>
                                            Review Selesai
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item 
                                {{ Request::route()->action['as'] == 'application.report' ? 'active' : null }}">
                                <a href="{{ route('application.report') }}" class="sidebar-link">
                                <i class="fa-solid fa-money-bill"></i>
                                    <span>Nilai Kontrak</span>
                                </a>
                            </li>
                            <li class="sidebar-item 
                                {{ Request::route()->action['as'] == 'unit.index' ? 'active' : null }}">
                                <a href="{{ route('unit.index') }}" class="sidebar-link">
                                    <i class="fas fa-th"></i>
                                    <span>Pusat/Jurusan/Unit</span>
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
                <!-- Hanya satu tombol burger dengan warna biru (primary) -->
                <a href="#" class="burger-btn" id="burgerBtn">
                    <i class="fa-solid fa-bars"></i>
                </a>
            </header>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-8 order-md-1 order-last" id="page-start">
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
    
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const burgerBtn = document.getElementById('burgerBtn');
        const sidebarWrapper = document.querySelector('.sidebar-wrapper');
        let isSidebarOpen = false;

        // Fungsi untuk mendeteksi perangkat mobile
        function isMobileDevice() {
            return window.innerWidth < 1024;
        }

        // Fungsi untuk membuka sidebar (hanya di mobile)
        function openSidebar() {
            if (!isSidebarOpen && isMobileDevice()) {
                isSidebarOpen = true;
                sidebarWrapper.classList.add('active');
                // Tambahkan juga class ps active jika diperlukan
                sidebarWrapper.classList.add('ps', 'active');
                document.body.style.overflow = 'hidden';
                
                // Tambahkan event listener untuk klik di luar sidebar
                setTimeout(() => {
                    document.addEventListener('click', handleOutsideClick);
                }, 10);
            }
        }
        
        // Fungsi untuk menutup sidebar (hanya di mobile)
        function closeSidebar() {
            if (isSidebarOpen && isMobileDevice()) {
                isSidebarOpen = false;
                sidebarWrapper.classList.remove('active');
                // Hapus juga class ps active jika ada
                sidebarWrapper.classList.remove('ps', 'active');
                document.body.style.overflow = '';
                
                // Hapus event listener untuk klik di luar sidebar
                document.removeEventListener('click', handleOutsideClick);
            }
        }
        
        // Fungsi untuk menangani klik di luar sidebar
        function handleOutsideClick(event) {
            if (isSidebarOpen && !sidebarWrapper.contains(event.target) && !burgerBtn.contains(event.target)) {
                closeSidebar();
            }
        }
        
        // Inisialisasi sidebar berdasarkan ukuran layar
        function initializeSidebar() {
            if (isMobileDevice()) {
                // Di mobile: sidebar default tertutup
                closeSidebar();
                // Tampilkan tombol burger
                if (burgerBtn) burgerBtn.style.display = 'flex';
            } else {
                // Di desktop: sidebar default terbuka
                sidebarWrapper.classList.add('active', 'ps');
                isSidebarOpen = true;
                // Sembunyikan tombol burger
                if (burgerBtn) burgerBtn.style.display = 'none';
            }
        }
        
        // Toggle sidebar di mobile/tablet
        if (burgerBtn) {
            burgerBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                if (!isSidebarOpen) {
                    openSidebar();
                } else {
                    closeSidebar();
                }
            });
        }
        
        // Mencegah dropdown menutup sidebar
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
        
        // Tutup sidebar saat item menu biasa diklik di mobile/tablet
        const sidebarLinks = document.querySelectorAll('.sidebar-link:not(.dropdown-toggle)');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (isMobileDevice()) {
                    closeSidebar();
                }
            });
        });
        
        // Handle resize event
        window.addEventListener('resize', function() {
            initializeSidebar();
        });
        
        // Handle escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isSidebarOpen && isMobileDevice()) {
                closeSidebar();
            }
        });
        
        // Inisialisasi awal
        initializeSidebar();
        
        // Force sidebar terbuka di desktop (safety measure)
        if (!isMobileDevice()) {
            setTimeout(() => {
                sidebarWrapper.style.transform = 'translateX(0)';
                sidebarWrapper.style.display = 'block';
                document.getElementById('main').style.marginLeft = '230px';
            }, 100);
        }
    });
</script>
    
    @yield('script')
    @yield('scripts')
</body> 
</html>