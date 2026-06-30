<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

// Biblioteca
Route::get('/biblioteca', [LibraryController::class, 'index'])->name('library.index');
Route::get('/biblioteca/{id}', [LibraryController::class, 'show'])->name('library.show');
Route::post('/biblioteca/{id}/guardar', [LibraryController::class, 'save'])->name('library.save')->middleware('auth');

// Descargas (AJAX)
Route::post('/resources/{id}/download', [LibraryController::class, 'download'])->name('resources.download');
Route::get('/resources/{id}/archivo', [LibraryController::class, 'file'])->name('resources.file');

// Autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard y recursos (protegidos)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/recursos/crear', [ResourceController::class, 'create'])->name('resources.create');
    Route::post('/recursos', [ResourceController::class, 'store'])->name('resources.store');
    Route::get('/recursos/{id}/editar', [ResourceController::class, 'edit'])->name('resources.edit');
    Route::put('/recursos/{id}', [ResourceController::class, 'update'])->name('resources.update');
    Route::delete('/recursos/{id}', [ResourceController::class, 'destroy'])->name('resources.destroy');
});

// Admin routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/resources', [AdminController::class, 'resources'])->name('admin.resources');
    Route::post('/resources/{id}/approve', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/resources/{id}/reject', [AdminController::class, 'reject'])->name('admin.reject');
    Route::post('/resources/{id}/draft', [AdminController::class, 'draft'])->name('admin.draft');
});