<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\NoteController;

// No Auth Routes
Route::get('/', [DashboardController::class, 'index']);

// Auth Routes
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('/tags', TagController::class);
    Route::resource('/notes', NoteController::class);
});
