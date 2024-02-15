<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('google/authorize', [GoogleAuthController::class, 'authorize'])
        ->name('google.authorize');
});
