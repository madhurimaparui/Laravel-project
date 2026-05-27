@extends('layouts.app')
@section('title', 'Admin – Create Category')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-2">@include('admin.sidebar')</div>
        <div class="col-md-6">
            <h2 class="fw-bold mb-4"><i class="fas fa-plus-circle text-danger me-2"></i>Create Category</h2>

            <div class="card border-0 shadow-sm p-4">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="e.g. Laravel">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" rows="3"
                                  class="form-control"
                                  placeholder="Short description...">{{ old('description') }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-danger fw-bold">
                            <i class="fas fa-save me-1"></i>Create
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
