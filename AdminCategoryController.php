@extends('layouts.app')
@section('title', '#' . $tag->name . ' – Laravel CMS')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4"><span class="badge bg-danger fs-4">#{{ $tag->name }}</span></h2>
    <div class="row g-3">
        @forelse($posts as $post)
            <div class="col-md-6">
                <div class="card post-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5><a href="{{ route('posts.show', $post->slug) }}" class="text-dark text-decoration-none">{{ $post->title }}</a></h5>
                        <p class="text-muted small">{{ $post->excerpt }}</p>
                        <a href="{{ route('categories.show', $post->category->slug) }}" class="badge bg-danger text-decoration-none">
                            {{ $post->category->name }}
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No posts with this tag yet.</p>
        @endforelse
    </div>
    <div class="mt-4">{{ $posts->links() }}</div>
</div>
@endsection
