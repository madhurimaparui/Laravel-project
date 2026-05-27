<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- COURSE: Blade @yield directive - child views inject their title here --}}
    <title>@yield('title', 'Laravel CMS')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    {{-- COURSE: @yield for page-specific styles --}}
    @yield('styles')
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f8f9fa; }
        .navbar-brand { font-weight: 700; font-size: 1.4rem; color: #e74c3c !important; }
        .post-card { transition: transform .2s, box-shadow .2s; border: none; }
        .post-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,.1); }
        .badge-tag { background: #e74c3c; font-size: .75rem; }
        .sidebar-widget { background: #fff; border-radius: 10px; padding: 1.2rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,.05); }
        .sidebar-widget h5 { color: #e74c3c; font-weight: 700; border-bottom: 2px solid #e74c3c; padding-bottom: .5rem; margin-bottom: 1rem; }
        footer { background: #2c3e50; color: #ecf0f1; padding: 2rem 0; margin-top: 3rem; }
    </style>
</head>
<body>

{{-- COURSE: Blade @include - partials --}}
@include('layouts.navbar')

{{-- COURSE: Flash messages - session() --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show m-0 rounded-0" role="alert">
        <div class="container">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show m-0 rounded-0" role="alert">
        <div class="container">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
@endif

{{-- COURSE: Blade @yield - main content slot --}}
<main>
    @yield('content')
</main>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
{{-- COURSE: @yield for page-specific scripts --}}
@yield('scripts')
</body>
</html>
