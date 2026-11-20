<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspirasiController;

Route::get('/', [AspirasiController::class, 'index'])->name('home');

Route::post('/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');
