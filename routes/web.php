<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacebookController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::controller(FacebookController::class)->group(function () {
    Route::get('facebook/redirect', 'redirectToFacebook')->name('auth.facebook');
    Route::get('facebook/callback', 'handleFacebookCallback');
});
