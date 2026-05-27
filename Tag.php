@extends('layouts.app')

@section('title', $post->title . ' – Laravel CMS')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Blog</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('categories.show', $post->category->slug) }}">{{ $post->category->name }}</a></li>
                    <li class="breadcrumb-item active">{{ Str::limit($post->title, 30) }}</li>
                </ol>
            </nav>

            <article class="card border-0 shadow-sm p-4 mb-4">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded mb-4" alt="{{ $post->title }}">
                @endif

                <h1 class="fw-bold mb-2">{{ $post->title }}</h1>

                <div class="d-flex gap-3 text-muted small mb-3">
                    <span><i class="fas fa-user me-1"></i>{{ $post->user->name }}</span>
                    <span><i class="fas fa-calendar me-1"></i>{{ $post->created_at->format('F d, Y') }}</span>
                    <span><i class="fas fa-folder me-1"></i>
                        <a href="{{ route('categories.show', $post->category->slug) }}" class="text-decoration-none text-danger">
                            {{ $post->category->name }}
                        </a>
                    </span>
                </div>

                {{-- Tags --}}
                <div class="mb-4">
                    @foreach($post->tags as $tag)
                        <a href="{{ route('tags.show', $tag->slug) }}" class="badge badge-tag text-decoration-none me-1">#{{ $tag->name }}</a>
                    @endforeach
                </div>

                {{-- Post body - COURSE: {!! !!} for unescaped HTML --}}
                <div class="post-body">{!! $post->body !!}</div>
            </article>

            {{-- Comments Section - COURSE: hasMany relationship --}}
            <div class="card border-0 shadow-sm p-4 mb-4">
                <h4 class="fw-bold mb-3">
                    <i class="fas fa-comments me-2 text-danger"></i>
                    Comments ({{ $post->comments->count() }})
                </h4>

                @forelse($post->comments as $comment)
                    <div class="d-flex mb-3 pb-3 border-bottom">
                        <div class="me-3">
                            <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center"
                                 style="width:40px;height:40px;font-weight:bold">
                                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                            </div>
                        </div>
                        <div>
                            <strong>{{ $comment->user->name }}</strong>
                            <small class="text-muted ms-2">{{ $comment->created_at->diffForHumans() }}</small>
                            <p class="mb-0 mt-1">{{ $comment->body }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No comments yet. Be the first!</p>
                @endforelse

                {{-- Add comment form - COURSE: Forms, CSRF, Validation --}}
                @auth
                    <h5 class="mt-3">Leave a Comment</h5>
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea name="body" class="form-control @error('body') is-invalid @enderror"
                                      rows="3" placeholder="Write your comment...">{{ old('body') }}</textarea>
                            @error('body')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-danger" type="submit">Post Comment</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-danger btn-sm">Login to comment</a>
                @endauth
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">
            {{-- Related Posts --}}
            @if($related->count())
            <div class="sidebar-widget">
                <h5>Related Posts</h5>
                @foreach($related as $rel)
                    <div class="mb-3 pb-3 border-bottom">
                        <a href="{{ route('posts.show', $rel->slug) }}" class="text-dark text-decoration-none fw-semibold">
                            {{ $rel->title }}
                        </a>
                        <div class="small text-muted mt-1">{{ $rel->created_at->format('M d, Y') }}</div>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
