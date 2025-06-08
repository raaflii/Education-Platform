<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminNewsController;


Route::get('/landing-page', function () {
    return view('landing-page');
});

// Public News Routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
Route::get('/category/{category}', [NewsController::class, 'category'])->name('news.category');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    // News Management
    Route::resource('news', AdminNewsController::class);
    
    // Category Management
    Route::resource('categories', AdminCategoryController::class);
});