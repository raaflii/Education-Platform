<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Public Routes (Landing, News, Auth)
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', fn () => view('landing-page'))->name('landing-page');

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// News routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
Route::get('/category/{category}', [NewsController::class, 'category'])->name('news.category');

/*
|--------------------------------------------------------------------------
| Profile Routes (shared across roles)
|--------------------------------------------------------------------------
*/
Route::get('/profile/settings', fn () => view('profile.profile'))->name('profile.settings');
Route::get('/profile/edit', fn () => view('profile.edit'))->name('profile.edit');
Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');

/*
|--------------------------------------------------------------------------
| Admin Routes (prefix + name group)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');

    // CRUD News & Categories
    Route::resource('news', AdminNewsController::class);
    Route::resource('categories', AdminCategoryController::class);
});

/*
|--------------------------------------------------------------------------
| (Optional) Role-Based Dashboard Redirect (if needed later)
|--------------------------------------------------------------------------
| Example:
| Route::middleware('auth')->group(function () {
|     Route::get('/dashboard', function () {
|         $role = auth()->user()->role->name;
|         return redirect()->route("{$role}.dashboard");
|     });
| });
*/
