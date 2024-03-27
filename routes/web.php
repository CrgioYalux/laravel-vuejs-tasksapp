<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostTaskController;
use App\Http\Controllers\TaskStatusController;

// Unauthenticated Routes
Route::get('/', [DashboardController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Authenticated Routes
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('/users', UserController::class);
    Route::resource('/posts', PostController::class);
    Route::resource('/tasks', PostTaskController::class);
    Route::resource('/task_statuses', TaskStatusController::class);
});
