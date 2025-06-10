<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\AdminNewsCategoryController;
use App\Http\Controllers\Admin\AdminCourseCategoryController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\AuthController;

Route::get('/landing-page', function () {
    return view('landing-page');
});

// Public News Routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
Route::get('/category/{category}', [NewsController::class, 'category'])->name('news.category');

// Guest Routes (Authentication)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
    
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/change-password', [AuthController::class, 'showChangePassword'])->name('password.change');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('password.change.update');
    
    // Role-based Dashboard Routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        
        // Admin Management Routes
        Route::get('/', function () {
            return view('admin.dashboard');
        });

        Route::resource('users', AdminUserController::class);

        Route::resource('courses', AdminCourseController::class);


        Route::resource('course-categories', AdminCourseCategoryController::class);
        Route::post('course-categories/{courseCategory}/toggle-status', [AdminCourseCategoryController::class, 'toggleStatus'])->name('course-categories.toggle-status');
        Route::post('course-categories/bulk-action', [AdminCourseCategoryController::class, 'bulkAction'])->name('course-categories.bulk-action');
        Route::get('course-categories-export', [AdminCourseCategoryController::class, 'export'])->name('course-categories.export');
        Route::get('course-categories-statistics', [AdminCourseCategoryController::class, 'statistics'])->name('course-categories.statistics');
        
        // News Management
        Route::resource('news', AdminNewsController::class);
        
        // Category Management
        Route::resource('news-categories', AdminNewsCategoryController::class);
    });
    
    Route::middleware('role:teacher')->prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/dashboard', function () {
            return view('teacher.dashboard');
        })->name('dashboard');
    });
    
    Route::middleware('role:student')->prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', function () {
            return view('student.dashboard');
        })->name('dashboard');
    });
});