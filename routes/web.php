<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Payment;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Rute Web
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute-rute ini
| akan dimuat oleh RouteServiceProvider dan semuanya akan diberi prefiks 'web'.
|
*/

// ====================================================================
// RUTE UMUM (Tanpa Autentikasi)
// ====================================================================

/**
 * Halaman Profil Perusahaan
 * Menampilkan informasi tentang perusahaan/pemilik kos
 */
Route::get('/company-profile', function () {
    return view('company-profile');
})->name('company-profile');

/**
 * Halaman Beranda
 * Halaman landing page aplikasi
 */
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ====================================================================
// RUTE YANG MEMERLUKAN AUTENTIKASI (Untuk Admin dan User Biasa)
// ====================================================================
Route::middleware('auth')->group(function () {
    
    /**
     * Rute untuk mengelola profil pengguna
     * - Menampilkan form edit profil
     * - Memperbarui data profil
     * - Menghapus akun pengguna
     */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    /**
     * Dashboard Default
     * Mengarahkan pengguna ke dashboard yang sesuai berdasarkan peran mereka
     */
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('pembayaran.create');
    })->name('dashboard');
    
    /**
     * Rute untuk Pembayaran
     * - Menampilkan form pembayaran
     * - Menyimpan data pembayaran
     */
    Route::get('/pembayaran', [PaymentController::class, 'create'])
        ->name('pembayaran.create');
    Route::post('/pembayaran', [PaymentController::class, 'store'])
        ->name('pembayaran.store');
});

// ====================================================================
// RUTE KHUSUS ADMIN
// ====================================================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin') // Semua URL dimulai dengan /admin
    ->name('admin.')  // Semua nama rute dimulai dengan admin.
    ->group(function () {
    
    /**
     * Dashboard Admin
     * Menampilkan ringkasan statistik dan informasi penting
     */
    Route::get('/dashboard', function () {
        // --- DATA PENYEWA ---
        $penyewa = User::where('role', 'user')->get();
        $totalPenyewa = $penyewa->count();
        $jumlahLakiLaki = $penyewa->where('jenis_kelamin', 'Laki-laki')->count();
        $jumlahPerempuan = $penyewa->where('jenis_kelamin', 'Perempuan')->count();

        // --- DATA PEMBAYARAN ---
        $paidUsersCount = $penyewa->filter(fn($user) => $user->payment_status === 'Lunas')->count();
        $unpaidUsersCount = $totalPenyewa - $paidUsersCount;
        $totalPaymentsThisMonth = Payment::whereMonth('created_at', Carbon::now()->month)
                                        ->whereYear('created_at', Carbon::now()->year)
                                        ->sum('amount');

        // --- DATA KAMAR ---
        $totalKamar = 6; // TODO: Pindahkan ke konfigurasi/database
        $kamarTerisi = $totalPenyewa;
        $kamarKosong = $totalKamar - $kamarTerisi;
        
        // Buat daftar denah kamar (Lantai 1 & 2)
        $denahKamarLantai1 = [];
        $denahKamarLantai2 = [];
        for ($i = 1; $i <= 3; $i++) {
            $denahKamarLantai1[] = 'A' . $i; // Kamar A1 - A3
            $denahKamarLantai2[] = 'B' . $i; // Kamar B1 - B3
        }
        
        // Petakan penyewa ke nomor kamarnya untuk denah
        $penghuniPerKamar = $penyewa->keyBy('nomor_kamar');

        return view('admin.dashboard', compact(
            'totalPenyewa', 'jumlahLakiLaki', 'jumlahPerempuan',
            'paidUsersCount', 'unpaidUsersCount', 'totalPaymentsThisMonth',
            'kamarTerisi', 'kamarKosong', 'denahKamarLantai1', 
            'denahKamarLantai2', 'penghuniPerKamar'
        )); 
    })->name('dashboard');
    
    /**
     * Manajemen Pengguna
     * - Melihat daftar pengguna
     * - Menambahkan pengguna baru
     * - Menghapus pengguna
     */
    Route::resource('users', UserController::class)
        ->only(['index', 'create', 'store', 'destroy']);
});

// ====================================================================
// RUTE AUTHENTIKASI (Dari Laravel Breeze)
// ====================================================================
require __DIR__.'/auth.php';
