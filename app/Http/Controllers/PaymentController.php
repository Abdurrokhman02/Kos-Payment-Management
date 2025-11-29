<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        // Dapatkan harga kamar dari database berdasarkan nomor kamar user
        $kamar = Kamar::where('nomor_kamar', $user->nomor_kamar)->first();
        
        // Jika kamar tidak ditemukan, gunakan nilai default
        $paymentAmount = $kamar ? $kamar->harga : 0;

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
        
        // Cek apakah sudah ada pembayaran di bulan ini
        $currentMonthPayment = Payment::where('user_id', $user->id)
            ->whereYear('payment_date', now()->year)
            ->whereMonth('payment_date', now()->month)
            ->first();
            
        if ($currentMonthPayment) {
            return redirect()->back()
                ->with('error', 'Anda sudah melakukan pembayaran untuk bulan ini.');
        }
        
        // Dapatkan harga kamar dari database
        $kamar = Kamar::where('nomor_kamar', $user->nomor_kamar)->first();
        
        if (!$kamar) {
            return redirect()->back()
                ->with('error', 'Data kamar tidak ditemukan.');
        }
        
        // Pastikan harga valid
        $paymentAmount = (float) $kamar->harga;
        \Log::info('Mencoba menyimpan pembayaran', [
            'user_id' => $user->id,
            'kamar_id' => $kamar->id,
            'amount' => $paymentAmount,
            'tipe_amount' => gettype($paymentAmount)
        ]);

        // Pastikan nilai tidak melebihi batas
        if ($paymentAmount > 9999999999999.99) { // 13 digit
            return redirect()->back()
                ->with('error', 'Nilai pembayaran melebihi batas maksimum yang diizinkan.');
        }

        // Simpan data pembayaran ke database
        try {
            // Simpan data pembayaran dengan waktu saat ini
            $payment = new Payment([
                'user_id' => $user->id,
                'amount' => $paymentAmount,
                'payment_date' => now(),
                'status' => 'lunas',
                'kamar_id' => $kamar->id
            ]);
            
            $payment->save();

            return redirect()->route('pembayaran.create')
                ->with('success', 'Pembayaran berhasil dicatat sebagai LUNAS.');
                
        } catch (\Exception $e) {
            \Log::error('Gagal menyimpan pembayaran: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}