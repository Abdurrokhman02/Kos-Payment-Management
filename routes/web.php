<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\UserController; // <<< PASTIKAN INI ADA

Route::get('/company-profile', function () {
    return view('company-profile');
})->name('company-profile');


Route::get('/', function () {
    return view('welcome');
})->name('home');

// ====================================================================
// GRUP RUTE DENGAN MIDDLEWARE 'auth' (Untuk Admin dan User Biasa)
// ====================================================================
Route::middleware('auth')->group(function () {
    
    // 1. Rute Profile (Akses untuk semua user yang login)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // 2. Rute Dashboard Default (Mengalihkan ke Dashboard Spesifik)
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('pembayaran.create');
    })->name('dashboard');
    
    // 3. Rute Pembayaran (Dashboard Khusus User Biasa)
    Route::get('/pembayaran', [PaymentController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PaymentController::class, 'store'])->name('pembayaran.store');
});

// ====================================================================
// GRUP RUTE KHUSUS ADMIN
// ====================================================================
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('dashboard');
    
    // Kelola User (Menambah, Melihat Daftar Penyewa)
    Route::resource('users', UserController::class)->only(['index', 'create', 'store']);
});

require __DIR__.'/auth.php'; // Rute Login, Logout, dan Reset Password
