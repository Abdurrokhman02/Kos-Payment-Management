<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Menampilkan halaman pembayaran.
     */
    public function create()
    {
        $user = Auth::user();
        // Ambil riwayat pembayaran untuk user yang sedang login
        $paymentHistory = Payment::where('user_id', $user->id)
                                ->orderBy('payment_date', 'desc')
                                ->get();

        // Kita asumsikan biaya kos per bulan adalah Rp 500.000 (contoh)
        $paymentAmount = 550000;

        return view('pembayaran', [
            'user' => $user,
            'paymentAmount' => $paymentAmount,
            'paymentHistory' => $paymentHistory,
        ]);
    }

    /**
     * Menyimpan data pembayaran baru.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Simpan data pembayaran ke database
        Payment::create([
            'user_id' => $user->id,
            'amount' => 550000, // Jumlah pembayaran (sesuaikan jika dinamis)
            'payment_date' => now(), // Waktu saat ini
            'status' => 'lunas',
        ]);

        return redirect()->route('pembayaran.create')->with('success', 'Pembayaran berhasil!');
    }
}