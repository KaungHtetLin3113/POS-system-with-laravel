@extends('layouts.app')

@section('content')
<style>
    body {
         background: linear-gradient(135deg, #0f5132, #198754);
        min-height: 100vh;
    }

    .login-box {
        margin-top: 80px;
    }

    .card {
         border: none;
        border-radius: 35px;
        backdrop-filter: blur(15px);
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        padding: 20px;
    }

    .card-header {
        background: #ffffff00;
         color: #556404;
        border-bottom: none;
        font-size: 24px;
        font-weight: 700;
        text-align: center;
    }

    .form-control {
        border-radius: 8px;
        padding: 10px;
    }

    .form-control:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.1rem rgba(25,135,84,0.2);
    }

    .btn-primary {
        background: #198754;
        border: none;
        border-radius: 8px;
        padding: 10px;
        font-weight: 500;
    }

    .btn-primary:hover {
        background: #157347;
    }

    .form-check-label {
        font-size: 14px;
    }

    .btn-link {
        font-size: 14px;
        text-decoration: none;
    }
</style>

<div class="container login-box">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}"
                                   required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox"
                                   name="remember" id="remember"
                                   {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <div class="d-grid mb-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-center">
                                <a class="btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection