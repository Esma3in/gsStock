@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-lg border-0 rounded-lg mt-3">
            <div class="card-header bg-primary text-white text-center py-4">
                <h3 class="font-weight-light my-2">{{ __('Create Account') }}</h3>
            </div>
            <div class="card-body p-4">
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form action="{{ route('register.post') }}" method="POST">
        @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Full Name') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" placeholder="John Doe" required autofocus>
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
        </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
        </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="••••••••" required>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" id="password-confirm" class="form-control"
                                    name="password_confirmation" placeholder="••••••••" required>
                            </div>
                        </div>
        </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">{{ __('Register') }}</button>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-light py-3 border-0">
                <div class="text-center">
                    <div class="small">{{ __('Already have an account?') }}
                        <a href="{{ route('login') }}" class="text-decoration-none">{{ __('Sign in') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
