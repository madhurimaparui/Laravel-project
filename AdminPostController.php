@extends('layouts.app')
@section('title', 'Categories – Laravel CMS')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">All Categories</h2>
    <div class="row g-3">
        @forelse($categories as $category)
            <div class="col-md-4">
                <a href="{{ route('categories.show', $category->slug) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm p-3 h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold text-dark mb-0">
                                <i class="fas fa-folder text-danger me-2"></i>{{ $category->name }}
                            </h5>
                            <span class="badge bg-danger rounded-pill">{{ $category->posts_count }} posts</span>
                        </div>
                        @if($category->description)
                            <p class="text-muted small mt-2 mb-0">{{ $category->description }}</p>
                        @endif
                    </div>
                </a>
            </div>
        @empty
            <p class="text-muted">No categories yet.</p>
        @endforelse
    </div>
</div>
@endsection
