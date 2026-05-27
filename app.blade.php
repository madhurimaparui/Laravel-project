@extends('layouts.app')
@section('title', 'Admin – Create Post')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-2">@include('admin.sidebar')</div>
        <div class="col-md-10">
            <h2 class="fw-bold mb-4"><i class="fas fa-plus-circle text-danger me-2"></i>Create New Post</h2>

            <div class="card border-0 shadow-sm p-4">
                {{--
                  COURSE TOPICS IN THIS FORM:
                  - @csrf token (Forms section)
                  - @error directive (Validation)
                  - old() helper (retain input after failed validation)
                  - File upload with enctype="multipart/form-data" (File Management)
                  - Many-to-many tags select (Eloquent relationships)
                --}}
                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" value="{{ old('title') }}"
                                       class="form-control @error('title') is-invalid @enderror"
                                       placeholder="Post title">
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Excerpt <span class="text-danger">*</span></label>
                                <textarea name="excerpt" rows="2"
                                          class="form-control @error('excerpt') is-invalid @enderror"
                                          placeholder="Short summary...">{{ old('excerpt') }}</textarea>
                                @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Body <span class="text-danger">*</span></label>
                                <textarea name="body" rows="10"
                                          class="form-control @error('body') is-invalid @enderror"
                                          placeholder="Full post content (HTML allowed)...">{{ old('body') }}</textarea>
                                @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                    <option value="">-- Select Category --</option>
                                    {{-- COURSE: Passing data to views, @foreach in forms --}}
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tags (many-to-many)</label>
                                <select name="tags[]" class="form-select" multiple size="5">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                                            #{{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Hold Ctrl/Cmd to select multiple</small>
                            </div>

                            {{-- COURSE: File Management - image upload --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Featured Image</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                       accept="image/*">
                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" name="is_published" class="form-check-input"
                                       id="is_published" {{ old('is_published') ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_published">
                                    Publish immediately
                                </label>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-danger fw-bold">
                                    <i class="fas fa-save me-1"></i>Create Post
                                </button>
                                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
