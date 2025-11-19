<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\PendaftarController;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes (Authenticated Users)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Guest Routes
    Route::middleware('role:guest')->group(function () {
        Route::get('/pendaftar/create/{lowongan}', [PendaftarController::class, 'create'])->name('pendaftar.create');
        Route::post('/pendaftar', [PendaftarController::class, 'store'])->name('pendaftar.store');
    });
    
    // Admin Routes
    Route::middleware('role:admin')->group(function () {
        // Lowongan Management
        Route::resource('lowongan', LowonganController::class);
        
        // Pendaftar Management
        Route::get('/pendaftar', [PendaftarController::class, 'index'])->name('pendaftar.index');
        Route::get('/pendaftar/{pendaftar}', [PendaftarController::class, 'show'])->name('pendaftar.show');
        Route::patch('/pendaftar/{pendaftar}/status', [PendaftarController::class, 'updateStatus'])->name('pendaftar.updateStatus');
        
        // Reports
        Route::get('/report', [PendaftarController::class, 'report'])->name('pendaftar.report');
    });
});
