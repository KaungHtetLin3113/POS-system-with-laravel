@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #0f5132, #198754);
        min-height: 100vh;
    }

    .register-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
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
        background: none;
        border: none;
        text-align: center;
        font-size: 24px;
        font-weight: 700;
        color: #556404;
    }

    label {
        font-weight: 600;
        color: #333;
    }

    .form-control {
        border-radius: 10px;
        padding: 10px;
        border: 1px solid #ddd;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.2rem rgba(25,135,84,0.2);
    }

    .btn-primary {
        background: linear-gradient(90deg, #0f5132, #198754);
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background: #146c43;
        transform: translateY(-2px);
    }

    .invalid-feedback {
        font-size: 13px;
    }
</style>

<div class="register-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-8">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection