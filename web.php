{{-- COURSE: Blade @include with extra data passed as second argument --}}
<div class="sidebar-widget">
    <h5><i class="fas fa-folder me-2"></i>Categories</h5>
    @foreach($categories as $category)
        <a href="{{ route('categories.show', $category->slug) }}"
           class="d-flex justify-content-between align-items-center text-decoration-none text-dark py-1 border-bottom">
            {{ $category->name }}
            <span class="badge bg-danger rounded-pill">{{ $category->posts_count }}</span>
        </a>
    @endforeach
</div>
