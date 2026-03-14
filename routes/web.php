<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Dosen\DashboardController as DosenDashboard;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root redirect to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Guest routes (hanya untuk yang belum login)
Route::middleware('guest')->group(function () {
    // Login routes
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    // Register routes
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

// Authenticated routes (harus login)
Route::middleware('auth')->group(function () {
    // Logout route
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Admin routes (hanya admin yang bisa akses)
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
    });

    // Dosen routes (hanya dosen yang bisa akses)
    Route::middleware('role:dosen')->prefix('dosen')->group(function () {
        Route::get('/dashboard', [DosenDashboard::class, 'index'])->name('dosen.dashboard');
    });

    // Mahasiswa routes (hanya mahasiswa yang bisa akses)
    Route::middleware('role:mahasiswa')->prefix('mahasiswa')->group(function () {
        Route::get('/dashboard', [MahasiswaDashboard::class, 'index'])->name('mahasiswa.dashboard');
    });
});
