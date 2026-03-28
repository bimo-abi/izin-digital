<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DosenDashboardController;
use App\Http\Controllers\MahasiswaDashboardController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\LetterTemplateController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

// Redirect home ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ========================================
// ADMIN ROUTES
// ========================================
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Template Surat (CRUD)
    Route::resource('admin/templates', LetterTemplateController::class);
    
    // Letter Verification
    Route::get('/admin/letters', [LetterController::class, 'index'])->name('admin.letters.index');
    Route::get('/admin/letters/{letter}', [LetterController::class, 'adminShow'])->name('admin.letters.show');
    Route::post('/admin/letters/{letter}/approve', [LetterController::class, 'approve'])->name('admin.letters.approve');
    Route::post('/admin/letters/{letter}/reject', [LetterController::class, 'reject'])->name('admin.letters.reject');
    
    // Generate PDF
    Route::get('/admin/letters/{letter}/pdf', [PdfController::class, 'generate'])->name('admin.letters.pdf');
});

// ========================================
// DOSEN ROUTES
// ========================================
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen/dashboard', [DosenDashboardController::class, 'index'])->name('dosen.dashboard');
    // Tambahkan route dosen lainnya di sini nanti
});

// ========================================
// MAHASISWA ROUTES
// ========================================
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    // Dashboard
    Route::get('/mahasiswa/dashboard', [MahasiswaDashboardController::class, 'index'])->name('mahasiswa.dashboard');
    
    // Letter Management
    Route::get('/mahasiswa/letters/create', [LetterController::class, 'create'])->name('mahasiswa.letters.create');
    Route::post('/mahasiswa/letters', [LetterController::class, 'store'])->name('mahasiswa.letters.store');
    Route::get('/mahasiswa/letters/{letter}', [LetterController::class, 'show'])->name('mahasiswa.letters.show');
});

// ========================================
// PUBLIC ROUTES
// ========================================
// Download surat (untuk mahasiswa yang sudah approved)
Route::get('/surat/{letter}/download', [PdfController::class, 'download'])->name('surat.download');

// Verifikasi publik via QR code
Route::get('/verify/{code}', [PdfController::class, 'verify'])->name('public.verify');

require __DIR__.'/auth.php';