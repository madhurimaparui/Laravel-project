@extends('layouts.app')
@section('title', 'Login – Laravel CMS')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm p-4">
                <h3 class="fw-bold text-center mb-4">
                    <i class="fas fa-lock text-danger me-2"></i>Login
                </h3>

                {{-- COURSE: Form validation errors - @error directive --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                {{-- COURSE: Forms - @csrf, method, action with route() --}}
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        {{-- COURSE: old() helper - retain old input on validation fail --}}
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="admin@laravelcms.com" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>

                    <button type="submit" class="btn btn-danger w-100 fw-bold">Login</button>
                </form>

                <hr>
                <p class="text-center mb-0">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-danger">Register</a>
                </p>
                <p class="text-center text-muted small mt-2">
                    Demo: admin@laravelcms.com / password
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
