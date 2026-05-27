@extends('layouts.app')
@section('title', 'Admin – Categories')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-2">@include('admin.sidebar')</div>
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold"><i class="fas fa-folder text-danger me-2"></i>Categories</h2>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-danger">
                    <i class="fas fa-plus me-1"></i>New Category
                </a>
            </div>

            <div class="card border-0 shadow-sm">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>Name</th><th>Slug</th><th>Posts</th><th>Description</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td class="fw-semibold">{{ $category->name }}</td>
                            <td><code>{{ $category->slug }}</code></td>
                            <td><span class="badge bg-danger">{{ $category->posts_count }}</span></td>
                            <td>{{ Str::limit($category->description, 40) }}</td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-4 text-muted">No categories yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="card-footer bg-white">{{ $categories->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
