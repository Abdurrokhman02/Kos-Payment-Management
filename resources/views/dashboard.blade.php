<?php
// Catatan: Asumsi $paymentAmount sudah dikirim (misalnya Rp 500.000)
// Asumsi $user->payment_status (dari Model User) menghasilkan 'Lunas', 'Belum Lunas', atau 'Menunggu'

// Tentukan skema warna berdasarkan status pembayaran user saat ini
$currentStatus = $user->payment_status; 
$isPaid = $currentStatus === 'Lunas';
$isWaiting = $currentStatus === 'Menunggu';

if ($isPaid) {
    $statusText = 'LUNAS';
    $colorClass = 'border-green-500 bg-green-50 dark:bg-green-900/30 text-green-800 dark:text-green-300';
    $iconClass = 'fas fa-check-circle text-green-500';
} elseif ($isWaiting) {
    $statusText = 'MENUNGGU TAGIHAN';
    $colorClass = 'border-yellow-500 bg-yellow-50 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300';
    $iconClass = 'fas fa-clock text-yellow-500';
} else { // Belum Lunas
    $statusText = 'BELUM LUNAS';
    $colorClass = 'border-vermillion bg-red-50 dark:bg-red-900/30 text-vermillion dark:text-red-300';
    $iconClass = 'fas fa-exclamation-circle text-vermillion';
}
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Pesan Sukses/Error --}}
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg dark:bg-green-900 dark:border-green-700 dark:text-green-300">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- ---------------------------------------------------- --}}
                    {{-- KARTU STATUS UTAMA BULAN INI --}}
                    {{-- ---------------------------------------------------- --}}
                    <div class="p-8 rounded-xl shadow-2xl border-l-8 {{ $colorClass }} flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
                        
                        <div class="flex items-center space-x-4 mb-4 md:mb-0">
                            <i class="{{ $iconClass }} text-4xl"></i>
                            <div>
                                <p class="text-xl font-semibold text-gray-900 dark:text-white">Status Bulan Ini</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Tagihan Kos Bulan {{ Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
                            </div>
                        </div>
                        
                        <div class="text-right">
                            <span class="px-5 py-2 rounded-full font-extrabold text-xl tracking-wider 
                                {{ $isPaid ? 'bg-green-200 dark:bg-green-700' : 
                                   ($isWaiting ? 'bg-yellow-200 dark:bg-yellow-700' : 'bg-red-200 dark:bg-red-700') }}
                                {{ $isPaid ? 'text-green-800 dark:text-green-200' : 
                                   ($isWaiting ? 'text-yellow-800 dark:text-yellow-200' : 'text-vermillion dark:text-red-200') }}">
                                {{ $statusText }}
                            </span>
                        </div>
                    </div>

                    {{-- ---------------------------------------------------- --}}
                    {{-- INFORMASI TAGIHAN DAN TOMBOL BAYAR --}}
                    {{-- ---------------------------------------------------- --}}
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
                        
                        {{-- Detail Pribadi dan Kamar --}}
                        <div class="lg:col-span-2 p-6 bg-gray-50 dark:bg-gray-700 rounded-xl shadow-lg border-t-4 border-sunshine">
                            <h3 class="text-xl font-bold mb-4 border-b pb-2 text-sunshine">Detail Penghuni & Tagihan</h3>
                            <dl class="grid grid-cols-2 gap-x-4 gap-y-3 text-sm">
                                <dt class="font-medium text-gray-500 dark:text-gray-400">Nama:</dt>
                                <dd class="font-semibold text-gray-900 dark:text-white">{{ $user->name }}</dd>

                                <dt class="font-medium text-gray-500 dark:text-gray-400">Nomor Kamar:</dt>
                                <dd class="font-semibold text-gray-900 dark:text-white">{{ $user->nomor_kamar }}</dd>

                                <dt class="font-medium text-gray-500 dark:text-gray-400">Tagihan Bulan Ini:</dt>
                                <dd class="font-semibold text-xl text-green-600 dark:text-green-400">Rp {{ number_format($paymentAmount, 0, ',', '.') }}</dd>
                            </dl>
                        </div>
                        
                        {{-- Tombol Aksi Pembayaran --}}
                        <div class="lg:col-span-1 flex flex-col justify-center items-stretch p-6 bg-white dark:bg-gray-700 rounded-xl shadow-lg">
                            @if (!$isPaid)
                                <form method="POST" action="{{ route('pembayaran.store') }}" class="w-full">
                                    @csrf
                                    <button 
                                        type="submit"
                                        class="w-full inline-flex justify-center items-center px-6 py-4 bg-sunshine text-white font-bold rounded-lg 
                                               text-lg shadow-md hover:shadow-xl hover:scale-[1.01] transition-all duration-300 transform"
                                    >
                                        <i class="fas fa-arrow-right mr-2"></i> {{ __('Bayar Tagihan Sekarang') }}
                                    </button>
                                </form>
                                <p class="mt-3 text-xs text-center text-gray-500 dark:text-gray-400">
                                    Klik untuk melanjutkan ke proses pembayaran.
                                </p>
                            @else
                                <div class="w-full text-center py-4 bg-green-500/80 text-white font-bold rounded-lg text-lg cursor-default shadow-md opacity-90">
                                    <i class="fas fa-check-double mr-2"></i> Sudah Lunas
                                </div>
                                <p class="mt-3 text-xs text-center text-gray-500 dark:text-gray-400">
                                    Pembayaran Anda untuk bulan ini sudah tercatat.
                                </p>
                            @endif
                        </div>
                    </div>


                    {{-- ---------------------------------------------------- --}}
                    {{-- RIWAYAT PEMBAYARAN --}}
                    {{-- ---------------------------------------------------- --}}
                    <h3 class="text-xl font-bold mb-4 border-b pb-2 text-gray-800 dark:text-gray-200">Riwayat Pembayaran</h3>
                    <div class="overflow-x-auto bg-gray-50 dark:bg-gray-700 rounded-xl shadow-inner border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                            <thead class="bg-gray-100 dark:bg-gray-600">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        No.
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Tanggal Bayar
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Jumlah
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                                @forelse ($paymentHistory as $index => $payment)
                                    <tr class="{{ $index % 2 == 0 ? 'bg-white dark:bg-gray-800' : 'bg-gray-50 dark:bg-gray-700' }} hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $payment->payment_date->translatedFormat('d F Y, H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-gray-100">
                                            Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($payment->status === 'lunas') bg-green-100 text-green-800 @else bg-yellow-100 text-yellow-800 @endif
                                                dark:bg-opacity-50 dark:text-white">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400 italic">
                                            Belum ada riwayat pembayaran yang tercatat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
