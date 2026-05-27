<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| COURSE SECTION COVERED: Laravel Fundamentals - Routes
| Topics: Basic routes, named routes, route groups, resource routes,
|         middleware-protected routes
*/

// ─── PUBLIC ROUTES ────────────────────────────────────────────────────────────

// Home - redirect to posts index
Route::get('/', function () {
    return redirect()->route('posts.index');
})->name('home');

// Blog Posts (public) - Resource controller (GET only)
Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('posts.show');

// Categories (public)
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// Tags (public)
Route::get('/tags/{slug}', [TagController::class, 'show'])->name('tags.show');

// ─── AUTH ROUTES ──────────────────────────────────────────────────────────────
// COURSE SECTION COVERED: Authentication
Route::get('/login',  [App\Http\Controllers\Auth\LoginController::class,    'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class,    'login']);
Route::post('/logout',[App\Http\Controllers\Auth\LoginController::class,    'logout'])->name('logout');
Route::get('/register',  [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

// ─── ADMIN ROUTES (protected by auth + admin middleware) ──────────────────────
// COURSE SECTION COVERED: Middleware, Route Groups
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');

    // Posts CRUD
    // COURSE SECTION COVERED: CRUD with Eloquent, Resource Controllers
    Route::resource('posts', AdminPostController::class);

    // Categories CRUD
    Route::resource('categories', AdminCategoryController::class);

    // Users management
    Route::resource('users', AdminUserController::class)->except(['create', 'store']);

    // File upload route (standalone)
    // COURSE SECTION COVERED: File Management
    Route::post('posts/{post}/upload-image', [AdminPostController::class, 'uploadImage'])->name('posts.upload-image');
});
