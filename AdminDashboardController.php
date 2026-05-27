@extends('layouts.app')
@section('title', $category->name . ' – Laravel CMS')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h2 class="fw-bold"><i class="fas fa-folder text-danger me-2"></i>{{ $category->name }}</h2>
        @if($category->description)
            <p class="text-muted">{{ $category->description }}</p>
        @endif
    </div>
    <div class="row g-3">
        @forelse($posts as $post)
            <div class="col-md-6">
                <div class="card post-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5><a href="{{ route('posts.show', $post->slug) }}" class="text-dark text-decoration-none">{{ $post->title }}</a></h5>
                        <p class="text-muted small">{{ $post->excerpt }}</p>
                        <small class="text-muted">{{ $post->created_at->format('M d, Y') }} · {{ $post->user->name }}</small>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No posts in this category yet.</p>
        @endforelse
    </div>
    <div class="mt-4">{{ $posts->links() }}</div>
</div>
@endsection
