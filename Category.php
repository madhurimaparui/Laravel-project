{{-- COURSE: Blade @extends - extending master layout --}}
@extends('layouts.app')

@section('title', 'Blog – Laravel CMS')

{{-- COURSE: Blade @section - injecting content into @yield slots --}}
@section('content')
<div class="container py-5">
    <div class="row">

        {{-- Main Content --}}
        <div class="col-lg-8">
            <h2 class="fw-bold mb-4">Latest Posts</h2>

            {{-- COURSE: Blade @forelse - loop with empty fallback --}}
            @forelse($posts as $post)
            <div class="card post-card mb-4 shadow-sm">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" style="height:220px;object-fit:cover;" alt="{{ $post->title }}">
                @endif
                <div class="card-body p-4">
                    <div class="d-flex gap-2 mb-2">
                        {{-- COURSE: Blade {{ }} - echo data, route() helper --}}
                        <a href="{{ route('categories.show', $post->category->slug) }}"
                           class="badge bg-danger text-decoration-none">
                            {{ $post->category->name }}
                        </a>
                        {{-- COURSE: Blade @foreach - loop over relationship data --}}
                        @foreach($post->tags as $tag)
                            <a href="{{ route('tags.show', $tag->slug) }}"
                               class="badge bg-secondary text-decoration-none">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                    <h4 class="card-title">
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-dark text-decoration-none">
                            {{ $post->title }}
                        </a>
                    </h4>
                    <p class="text-muted">{{ $post->excerpt }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="fas fa-user me-1"></i>{{ $post->user->name }}
                            &nbsp;·&nbsp;
                            <i class="fas fa-calendar me-1"></i>{{ $post->created_at->format('M d, Y') }}
                        </small>
                        <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-outline-danger btn-sm">
                            Read More <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
                <div class="alert alert-info">No posts published yet. Check back soon!</div>
            @endforelse

            {{-- COURSE: Pagination --}}
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">
            @include('layouts.sidebar', ['categories' => $categories])
        </div>

    </div>
</div>
@endsection
