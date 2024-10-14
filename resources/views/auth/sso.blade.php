@extends('layouts.app-auth')

@section('content')
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <img src="{{ asset('assets/images/logo.webp') }}" alt="Logo">
            </div>
            <h1 class="auth-title">Register</h1>
            @if (session('error'))
                <div class="alert alert-danger">
                    <p>{{session('error')}}</p>
                </div>
            @endif
            <form method="post">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="email" value="{{$data["email"]}}" disabled id="email" class="form-control form-control-xl" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <input type="hidden" name="name" value="{{$data["name"]}}">
                <input type="hidden" name="email" value="{{$data["email"]}}">
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" id="password" class="form-control form-control-xl" placeholder="Password" name="password" required autocomplete="current-password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" id="repassword" class="form-control form-control-xl" placeholder="Re-Enter Password" name="repassword" required autocomplete="current-password">
                    <small id="emailHelp" class="form-text text-muted">Minimum 8 karakter</small>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Register</button>
            </form>
            <div class="text-center mt-5 fs-5">
                @if (Route::has('register'))
                    <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="font-bold">Sign up</a>.</p>
                @endif
                @if (Route::has('password.request'))
                    <p><a class="font-bold" href="{{ route('password.request') }}">Forgot password?</a></p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right"></div>
    </div>
</div>
@endsection
