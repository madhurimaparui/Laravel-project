@extends('layouts.app')
@section('title', 'Admin – Manage Posts')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-2">@include('admin.sidebar')</div>
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold"><i class="fas fa-file-alt text-danger me-2"></i>Posts</h2>
                <a href="{{ route('admin.posts.create') }}" class="btn btn-danger">
                    <i class="fas fa-plus me-1"></i>New Post
                </a>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th><th>Title</th><th>Category</th><th>Author</th><th>Status</th><th>Date</th><th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ Str::limit($post->title, 35) }}</td>
                                <td><span class="badge bg-danger">{{ $post->category->name }}</span></td>
                                <td>{{ $post->user->name }}</td>
                                <td>
                                    @if($post->is_published)
                                        <span class="badge bg-success">Published</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Draft</span>
                                    @endif
                                </td>
                                <td>{{ $post->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {{-- COURSE: DELETE via POST form with @method('DELETE') --}}
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Delete this post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr><td colspan="7" class="text-center py-4 text-muted">No posts yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white">{{ $posts->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
