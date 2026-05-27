@extends('layouts.app')
@section('title', 'Admin – Edit Post')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-2">@include('admin.sidebar')</div>
        <div class="col-md-10">
            <h2 class="fw-bold mb-4"><i class="fas fa-edit text-danger me-2"></i>Edit Post</h2>

            <div class="card border-0 shadow-sm p-4">
                {{-- COURSE: @method('PUT') for PUT/PATCH requests via HTML forms --}}
                <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Title</label>
                                <input type="text" name="title" value="{{ old('title', $post->title) }}"
                                       class="form-control @error('title') is-invalid @enderror">
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Excerpt</label>
                                <textarea name="excerpt" rows="2"
                                          class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt', $post->excerpt) }}</textarea>
                                @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Body</label>
                                <textarea name="body" rows="10"
                                          class="form-control @error('body') is-invalid @enderror">{{ old('body', $post->body) }}</textarea>
                                @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Category</label>
                                <select name="category_id" class="form-select">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ (old('category_id', $post->category_id) == $category->id) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tags</label>
                                <select name="tags[]" class="form-select" multiple size="5">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            #{{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Replace Image</label>
                                @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}"
                                         class="img-thumbnail mb-2 d-block" style="max-height:100px">
                                @endif
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" name="is_published" class="form-check-input"
                                       id="is_published" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_published">Published</label>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-danger fw-bold">
                                    <i class="fas fa-save me-1"></i>Update Post
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
