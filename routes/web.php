<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Payment;
use Carbon\Carbon;


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
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
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
        // Asumsi total kamar ada 20. Sebaiknya ini disimpan di database nanti.
        $totalKamar = 6; 
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
            'kamarTerisi', 'kamarKosong', 'denahKamarLantai1', 'denahKamarLantai2', 'penghuniPerKamar'
        )); 
    })->name('dashboard');
    
    // Kelola User
    Route::resource('users', UserController::class)->only(['index', 'create', 'store']);
    Route::resource('users', UserController::class)->only(['index', 'create', 'store', 'destroy']);
});

require __DIR__.'/auth.php';
