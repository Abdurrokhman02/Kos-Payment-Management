<?php
// --- SETUP VARIABEL DARI ROUTE/CONTROLLER ---
// Variabel yang digunakan: $kamarTerisi, $kamarKosong, $jumlahLakiLaki, $jumlahPerempuan, $paidUsersCount, $unpaidUsersCount, $totalPaymentsThisMonth, $denahKamarLantai1, $denahKamarLantai2, $penghuniPerKamar

// 1. Hitung Total Kamar
$totalRooms = $kamarTerisi + $kamarKosong; 

// 2. Hitung Kamar Terisi per Lantai (untuk label Denah)
$kamarTerisiLantai1 = 0;
foreach ($denahKamarLantai1 as $nomorKamar) {
    if ($penghuniPerKamar->has($nomorKamar)) {
        $kamarTerisiLantai1++;
    }
}

$kamarTerisiLantai2 = 0;
foreach ($denahKamarLantai2 as $nomorKamar) {
    if ($penghuniPerKamar->has($nomorKamar)) {
        $kamarTerisiLantai2++;
    }
}
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- ---------------------------------------------------- --}}
            {{-- 1. CARD METRIK UTAMA (Kamar & Penghuni) --}}
            {{-- ---------------------------------------------------- --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- Card Kamar Terisi (Border Green) --}}
                <div class="bg-white dark:bg-gray-700 p-5 rounded-xl shadow-lg border-l-4 border-green-500 hover:shadow-2xl transition duration-300 transform hover:scale-[1.02] cursor-pointer">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Kamar Terisi</p>
                        <i class="fas fa-users text-green-500 text-2xl"></i>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $kamarTerisi }}</p>
                    <p class="text-xs text-gray-400 mt-2">Dari {{ $totalRooms }} Kamar</p>
                </div>

                {{-- Card Kamar Kosong (Border Vermillion - Merah Kustom) --}}
                <div class="bg-white dark:bg-gray-700 p-5 rounded-xl shadow-lg border-l-4 border-vermillion hover:shadow-2xl transition duration-300 transform hover:scale-[1.02] cursor-pointer">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Kamar Kosong</p>
                        <i class="fas fa-bed text-vermillion text-2xl"></i>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $kamarKosong }}</p>
                    <p class="text-xs text-gray-400 mt-2">Potensi Pendapatan Kosong</p>
                </div>

                {{-- Card Penghuni Laki-laki (Border Sunshine - Biru Kustom) --}}
                <div class="bg-white dark:bg-gray-700 p-5 rounded-xl shadow-lg border-l-4 border-sunshine hover:shadow-2xl transition duration-300 transform hover:scale-[1.02] cursor-pointer">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Laki-laki</p>
                        <i class="fas fa-male text-sunshine text-2xl"></i>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $jumlahLakiLaki }}</p>
                    <p class="text-xs text-gray-400 mt-2">Total Semua Lantai</p>
                </div>

                {{-- Card Penghuni Perempuan (Border Pink) --}}
                <div class="bg-white dark:bg-gray-700 p-5 rounded-xl shadow-lg border-l-4 border-pink-500 hover:shadow-2xl transition duration-300 transform hover:scale-[1.02] cursor-pointer">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Perempuan</p>
                        <i class="fas fa-female text-pink-500 text-2xl"></i>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $jumlahPerempuan }}</p>
                    <p class="text-xs text-gray-400 mt-2">Total Semua Lantai</p>
                </div>

            </div>
            
            {{-- ---------------------------------------------------- --}}
            {{-- 2. DENAH HUNIAN --}}
            {{-- ---------------------------------------------------- --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-6 border-b pb-2">Denah Hunian Kos</h3>
                    
                    {{-- Lantai 1 --}}
                    <div class="mb-8">
                        <h4 class="text-lg font-semibold mb-3 text-gray-600 dark:text-gray-400">
                            Lantai 1 ({{ $kamarTerisiLantai1 }}/{{ count($denahKamarLantai1) }} Terisi) 
                        </h4>
                        <div class="grid grid-cols-3 gap-4"> 
                            @foreach ($denahKamarLantai1 as $nomorKamar)
                                @php
                                    $penghuni = $penghuniPerKamar->get($nomorKamar);
                                    // Mengubah warna latar belakang kamar agar lebih kontras
                                    $statusClass = $penghuni ? 'bg-green-500 text-white shadow-md hover:bg-green-600' : 'bg-red-100 text-red-700 border border-red-300 hover:bg-red-200';
                                @endphp
                                <div class="w-full h-24 rounded-lg flex flex-col items-center justify-center text-center p-2 transition duration-150 {{ $statusClass }}">
                                    <div class="font-bold text-lg">{{ $nomorKamar }}</div>
                                    @if ($penghuni)
                                        <div class="text-xs truncate">{{ $penghuni->name }}</div>
                                    @else
                                        <div class="text-xs italic">Kosong</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <hr class="my-6 border-gray-200 dark:border-gray-700">

                    {{-- Lantai 2 --}}
                    <div>
                        <h4 class="text-lg font-semibold mb-3 text-gray-600 dark:text-gray-400">
                            Lantai 2 ({{ $kamarTerisiLantai2 }}/{{ count($denahKamarLantai2) }} Terisi)
                        </h4>
                        <div class="grid grid-cols-3 gap-4"> 
                            @foreach ($denahKamarLantai2 as $nomorKamar)
                                @php
                                    $penghuni = $penghuniPerKamar->get($nomorKamar);
                                    $statusClass = $penghuni ? 'bg-green-500 text-white shadow-md hover:bg-green-600' : 'bg-red-100 text-red-700 border border-red-300 hover:bg-red-200';
                                @endphp
                                <div class="w-full h-24 rounded-lg flex flex-col items-center justify-center text-center p-2 transition duration-150 {{ $statusClass }}">
                                    <div class="font-bold text-lg">{{ $nomorKamar }}</div>
                                    @if ($penghuni)
                                        <div class="text-xs truncate">{{ $penghuni->name }}</div>
                                    @else
                                        <div class="text-xs italic">Kosong</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- ---------------------------------------------------- --}}
            {{-- 3. DATA KEUANGAN --}}
            {{-- ---------------------------------------------------- --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                {{-- Card Pendapatan (Highlight Sunshine) --}}
                 <div class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg flex items-center space-x-4 border-l-4 border-sunshine hover:shadow-2xl transition duration-300">
                    <div class="bg-sunshine/10 p-3 rounded-full">
                        <i class="fas fa-money-bill-wave text-sunshine text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Pendapatan Bulan Ini</div>
                        <div class="mt-1 text-2xl font-bold text-sunshine">Rp {{ number_format($totalPaymentsThisMonth, 0, ',', '.') }}</div>
                    </div>
                </div>
                
                {{-- Card Sudah Bayar --}}
                 <div class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg flex items-center space-x-4 border-l-4 border-green-500 hover:shadow-2xl transition duration-300">
                    <div class="bg-green-200/50 p-3 rounded-full">
                        <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Sudah Bayar</div>
                        <div class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">{{ $paidUsersCount }} <span class="text-lg font-normal">Penyewa</span></div>
                    </div>
                </div>
                
                {{-- Card Belum Bayar (Highlight Vermillion) --}}
                <div class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg flex items-center space-x-4 border-l-4 border-vermillion hover:shadow-2xl transition duration-300">
                    <div class="bg-red-200/50 p-3 rounded-full">
                        <i class="fas fa-exclamation-triangle text-vermillion text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Belum Bayar</div>
                        <div class="mt-1 text-2xl font-bold text-vermillion">{{ $unpaidUsersCount }} <span class="text-lg font-normal">Penyewa</span></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
