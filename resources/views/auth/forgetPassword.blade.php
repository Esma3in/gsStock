@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-3">
            <div class="card-header bg-primary text-white text-center py-4">
                <h3 class="font-weight-light my-2">{{ __('Forgot Password') }}</h3>
            </div>
            <div class="card-body p-4">
                @if(session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <p class="text-muted mb-4">{{ __('Enter your email address and we\'ll send you a link to reset your password.') }}</p>

                <form action="{{ route('forget.password.post') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email_address" class="form-label">{{ __('Email Address') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" id="email_address" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" placeholder="name@example.com" required autofocus>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">{{ __('Send Password Reset Link') }}</button>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-light py-3 border-0">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('login') }}" class="text-decoration-none">
                        <i class="bi bi-arrow-left"></i> {{ __('Back to Login') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
