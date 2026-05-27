# Laravel CMS — Course Project

> **Full CMS project** built to cover every topic in *PHP with Laravel for Beginners – Become a Master in Laravel* by Edwin Diaz (Udemy).

---

## 📚 Course Topics Covered

| Section | What's in this project |
|---|---|
| ✅ Laravel Fundamentals: Routes | `routes/web.php` — basic routes, named routes, route groups, resource routes |
| ✅ Laravel Fundamentals: Controllers | All controllers in `app/Http/Controllers/` including resource controllers |
| ✅ Laravel Fundamentals: Views | All Blade views in `resources/views/` |
| ✅ Blade Templating Engine | `layouts/app.blade.php` with @extends, @yield, @section, @include |
| ✅ Database: Migrations | `database/migrations/` — create, alter, foreign keys, pivot tables |
| ✅ Raw SQL Queries | See `PostController` comments for DB facade examples |
| ✅ Eloquent / ORM | All Models with scopes, accessors, eager loading |
| ✅ Eloquent CRUD | `AdminPostController` — create, read, update, delete |
| ✅ Eloquent Relationships | hasOne, hasMany, belongsTo, belongsToMany (tags pivot) |
| ✅ Forms & Validation | All admin forms with `$request->validate()`, @error directive |
| ✅ Flash Messages | `->with('success', ...)` displayed in master layout |
| ✅ Authentication | Login, Register, Logout in `app/Http/Controllers/Auth/` |
| ✅ Middleware | `AdminMiddleware` protecting all `/admin/*` routes |
| ✅ File Management | Image upload in `AdminPostController@store` using Storage facade |
| ✅ Pagination | `->paginate(6)` in all listing controllers |
| ✅ GitHub / Git | Push this project to GitHub! |

---

## 🚀 Setup Instructions

### 1. Clone / Download
```bash
git clone https://github.com/yourusername/laravel-cms.git
cd laravel-cms
```

### 2. Install dependencies
```bash
composer install
```

### 3. Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` with your database credentials:
```
DB_DATABASE=laravel_cms
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

### 4. Create database
In MySQL:
```sql
CREATE DATABASE laravel_cms;
```

### 5. Run migrations + seed
```bash
php artisan migrate --seed
```

### 6. Create storage symlink (for images)
```bash
php artisan storage:link
```

### 7. Serve the application
```bash
php artisan serve
```

Visit: **http://localhost:8000**

---

## 🔑 Demo Credentials

| Role  | Email                    | Password |
|-------|--------------------------|----------|
| Admin | admin@laravelcms.com     | password |
| User  | john@example.com         | password |

Admin panel: **http://localhost:8000/admin**

---

## 📁 Project Structure

```
laravel-cms/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── AdminDashboardController.php
│   │   │   │   ├── AdminPostController.php     ← Full CRUD + File Upload
│   │   │   │   ├── AdminCategoryController.php ← Full CRUD
│   │   │   │   └── AdminUserController.php
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php         ← Auth
│   │   │   │   └── RegisterController.php
│   │   │   ├── PostController.php              ← Public blog
│   │   │   ├── CategoryController.php
│   │   │   └── TagController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php             ← Role-based access
│   └── Models/
│       ├── User.php        ← Roles (admin/user)
│       ├── Post.php        ← hasMany, belongsTo, belongsToMany, scopes
│       ├── Category.php    ← hasMany posts
│       ├── Tag.php         ← belongsToMany posts
│       └── Comment.php     ← belongsTo post, user
├── database/
│   ├── migrations/         ← 5 migrations covering all tables
│   └── seeders/
│       └── DatabaseSeeder.php  ← Seeds users, categories, posts, tags
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php   ← Master layout (@yield, flash messages)
│   │   ├── navbar.blade.php
│   │   ├── footer.blade.php
│   │   └── sidebar.blade.php
│   ├── posts/              ← index, show
│   ├── categories/         ← index, show
│   ├── tags/               ← show
│   ├── auth/               ← login, register
│   └── admin/              ← dashboard, posts CRUD, categories CRUD
└── routes/
    └── web.php             ← All routes with named routes + middleware groups
```

---

## 🛠️ Artisan Commands Reference

```bash
# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Fresh migrate + seed
php artisan migrate:fresh --seed

# Create a new model + migration
php artisan make:model ModelName -m

# Create a controller
php artisan make:controller MyController --resource

# Create middleware
php artisan make:middleware MyMiddleware

# Laravel Tinker (COURSE: Tinker section)
php artisan tinker
>>> Post::all()
>>> Post::find(1)
>>> Post::where('is_published', true)->get()

# List all routes (named routes)
php artisan route:list
```

---

## 💡 Key Laravel Concepts in This Project

### Named Routes (routes/web.php)
```php
Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
// Used in Blade as: {{ route('posts.index') }}
```

### Eloquent Relationships (app/Models/Post.php)
```php
$post->user;      // belongsTo User
$post->category;  // belongsTo Category
$post->tags;      // belongsToMany Tag (pivot: post_tag)
$post->comments;  // hasMany Comment
```

### Blade Templating
```blade
@extends('layouts.app')
@section('content')
    @foreach($posts as $post)
        {{ $post->title }}
    @endforeach
    {{ $posts->links() }}
@endsection
```

### Middleware (routes/web.php)
```php
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('posts', AdminPostController::class);
});
```

---

Built with ❤️ while learning Laravel.
