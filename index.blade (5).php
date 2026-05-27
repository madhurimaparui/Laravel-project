@extends('layouts.app')
@section('title', 'Admin – Edit Category')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-2">@include('admin.sidebar')</div>
        <div class="col-md-6">
            <h2 class="fw-bold mb-4"><i class="fas fa-edit text-danger me-2"></i>Edit Category</h2>

            <div class="card border-0 shadow-sm p-4">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Name</label>
                        <input type="text" name="name" value="{{ old('name', $category->name) }}"
                               class="form-control @error('name') is-invalid @enderror">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" rows="3"
                                  class="form-control">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-danger fw-bold">
                            <i class="fas fa-save me-1"></i>Update
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
