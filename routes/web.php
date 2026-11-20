<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [AspirasiController::class, 'index'])->name('home');

Route::post('/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Admin
Route::middleware(['auth', 'admin'])
    ->prefix('admin')->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/aspirasi', [AdminController::class, 'showAllAspirasi'])->name('aspirasi');
    });
