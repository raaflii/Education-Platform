<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;


Route::get('/landing-page', function () {
    return view('landing-page');
});

Route::prefix('admin')->group(function () {
    Route::resource('news', NewsController::class);
});