{{-- Admin Sidebar - COURSE: @include partials --}}
<div class="bg-dark text-white rounded p-3" style="min-height:80vh">
    <p class="text-muted small text-uppercase fw-bold mb-3">Admin Panel</p>
    <ul class="nav flex-column gap-1">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.posts.index') }}" class="nav-link text-white">
                <i class="fas fa-file-alt me-2"></i>Posts
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.categories.index') }}" class="nav-link text-white">
                <i class="fas fa-folder me-2"></i>Categories
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link text-white">
                <i class="fas fa-users me-2"></i>Users
            </a>
        </li>
        <li class="nav-item mt-3">
            <a href="{{ route('posts.index') }}" class="nav-link text-muted">
                <i class="fas fa-external-link-alt me-2"></i>View Site
            </a>
        </li>
    </ul>
</div>
