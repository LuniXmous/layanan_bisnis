@extends('layouts.app-auth')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

<style>
    .auth-logo {
        display: flex;
        align-items: center;
        justify-content: start;
        gap: 15px;
        flex-wrap: nowrap;
        margin-bottom: 2rem;
    }
    
    .auth-logo img {
        max-width: 100%;
        height: auto;
        max-height: 100px;
        object-fit: contain;
    }
    
    /* Responsif untuk layar kecil */
    @media (max-width: 576px) {
        .auth-logo {
            gap: 10px;
        }
        
        .auth-logo img {
            max-height: 60px;
        }
    }

    .auth-title {
        font-size: 2rem !important;
    }
    
    @media (max-width: 400px) {
        .auth-logo {
            gap: 8px;
        }
        
        .auth-logo img {
            max-height: 50px;
        }
    }

    #auth-right {
    position: relative;
    width: 100%;
    height: 100vh;
    background: url("{{ asset('assets/images/background_homepage.jpg') }}") center/cover no-repeat !important;
    overflow: hidden;
    }

    #auth-right::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.2); /* ubah opacity sesuai selera */
    }

    #auth-right img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* ⬅️ Penting agar gambar memenuhi area */

    }

</style>

@section('content')

    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
            <a href="{{ route('home') }}" class="back">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
                <div class="auth-logo">
                    <img src="{{ asset('assets/images/logo.webp') }}" alt="Logo">
                    <img src="{{ asset('assets/images/logo_rtpu.png') }}" alt="Logo">
                </div>
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
                <h1 class="auth-title">Login.</h1>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="email" id="email" name="email" class="form-control form-control-xl" 
                            placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <div class="form-control-icon">
                            <i class="fa-solid fa-envelope" style="margin-top:5px;"></i>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" id="password" class="form-control form-control-xl" placeholder="Password"
                            name="password" required autocomplete="current-password">

                        <div class="form-control-icon">
                            <i class="fa-solid fa-lock" style="margin-top:5px;"></i>
                        </div>

                        <!-- 👁️ Ikon toggle password -->
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword" style="cursor:pointer;">
                            <i class="fa-solid fa-eye-slash"></i>
                        </span>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-check form-check-lg d-flex align-items-end">
                        <input class="form-check-input me-2" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-gray-600" for="flexCheckDefault">
                            Keep me logged in
                        </label>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg mt-5">Log in</button>
                    <a href="{{ route('sso.login') }}"
                        class="btn btn-success btn-block btn-lg mt-3 d-flex align-items-center text-center justify-content-center">
                        <div>
                            <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo" width="28" height="28">
                        </div>
                        <div class="ms-2">
                            Log In / Register with SSO PNJ
                        </div>
                    </a>
                </form>
                <div class="text-center mt-5 fs-5">
                    @if (Route::has('register'))
                        <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}"
                                class="font-bold">Sign up</a>.</p>
                    @endif
                    @if (Route::has('password.request'))
                        <p><a class="font-bold" href="{{ route('password.request') }}">Forgot password?</a></p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const icon = togglePassword.querySelector('i');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Ubah icon eye / eye-slash
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    });
</script>