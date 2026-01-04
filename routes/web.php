<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\DaftarTrialController;
use App\Http\Controllers\DaftarOnlineController;
use App\Http\Controllers\BotManController;
use App\Models\Pengajar;


// Rute Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Rute Pendaftaran (Menu)
Route::get('/pendaftaran', function () {
    return view('pilihan-daftar');
})->name('pendaftaran.menu');

// Rute Kontak
Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

// Redirect jika user akses /tentang manual
Route::get('/tentang', function () {
    return redirect()->route('home');
});

// Auth & Fitur
Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

Route::middleware(['auth'])->group(function () {
    // Redirect Dashboard ke Home
    Route::get('/dashboard', function () { 
        return redirect()->route('home'); 
    })->name('dashboard');

    Route::get('/daftar-trial', [DaftarTrialController::class, 'create'])->name('daftar.trial');
    Route::post('/daftar-trial', [DaftarTrialController::class, 'store'])->name('daftar.trial.store');
    Route::get('/daftar-online', [DaftarOnlineController::class, 'create'])->name('daftar.online');
    Route::post('/daftar-online', [DaftarOnlineController::class, 'store'])->name('daftar.online.store');
    Route::get('/daftar-online/bukti/{id}', [DaftarOnlineController::class, 'showBukti'])->name('daftar.online.bukti');
});

Route::middleware(['auth'])->group(function () {
    // ... route yang sudah ada ...
    
    // Tambahkan Route Download PDF Admin ini:
    Route::get('/admin/download-pdf/{id}', [DaftarOnlineController::class, 'downloadPdf'])
        ->name('admin.download.pdf');
});

Route::get('/', function () {
    // Ambil semua data pengajar
    $pengajars = Pengajar::all(); 
    
    // Kirim ke view 'home'
    return view('home', compact('pengajars'));
})->name('home');

Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
require __DIR__.'/auth.php';