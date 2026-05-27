@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        {{-- Admin Sidebar --}}
        <div class="col-md-2">
            @include('admin.sidebar')
        </div>

        {{-- Main Content --}}
        <div class="col-md-10">
            <h2 class="fw-bold mb-4">
                <i class="fas fa-tachometer-alt text-danger me-2"></i>Dashboard
            </h2>

            {{-- Stats Cards - COURSE: Passing data (compact) from controller --}}
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card border-0 bg-danger text-white shadow-sm">
                        <div class="card-body text-center py-4">
                            <i class="fas fa-file-alt fa-2x mb-2"></i>
                            <h2 class="fw-bold">{{ $stats['posts'] }}</h2>
                            <p class="mb-0">Total Posts</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 bg-success text-white shadow-sm">
                        <div class="card-body text-center py-4">
                            <i class="fas fa-check-circle fa-2x mb-2"></i>
                            <h2 class="fw-bold">{{ $stats['published'] }}</h2>
                            <p class="mb-0">Published</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 bg-primary text-white shadow-sm">
                        <div class="card-body text-center py-4">
                            <i class="fas fa-folder fa-2x mb-2"></i>
                            <h2 class="fw-bold">{{ $stats['categories'] }}</h2>
                            <p class="mb-0">Categories</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 bg-warning text-white shadow-sm">
                        <div class="card-body text-center py-4">
                            <i class="fas fa-users fa-2x mb-2"></i>
                            <h2 class="fw-bold">{{ $stats['users'] }}</h2>
                            <p class="mb-0">Users</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Posts --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold">
                    <i class="fas fa-clock me-2 text-danger"></i>Recent Posts
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th><th>Author</th><th>Status</th><th>Date</th><th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPosts as $post)
                            <tr>
                                <td>{{ Str::limit($post->title, 40) }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>
                                    {{-- COURSE: Blade @if condition --}}
                                    @if($post->is_published)
                                        <span class="badge bg-success">Published</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>
                                <td>{{ $post->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                </td>
                            </tr>
                            @empty
                                <tr><td colspan="5" class="text-center text-muted py-4">No posts yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
