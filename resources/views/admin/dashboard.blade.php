<?php
// --- SETUP VARIABEL DARI ROUTE/CONTROLLER ---
// Variabel yang digunakan: $kamarTerisi, $kamarKosong, $jumlahLakiLaki, $jumlahPerempuan, $paidUsersCount, $unpaidUsersCount, $totalPaymentsThisMonth, $denahKamarLantai1, $denahKamarLantai2, $penghuniPerKamar

// 1. Hitung Total Kamar
$totalRooms = $kamarTerisi + $kamarKosong; 
$occupancyRate = $totalRooms > 0 ? round(($kamarTerisi / $totalRooms) * 100) : 0;

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

// Format currency
$formattedIncome = 'Rp ' . number_format($totalPaymentsThisMonth, 0, ',', '.');
?>

<x-app-layout>
    @push('styles')
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #818cf8;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 12px;
            overflow: hidden;
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
        }
        
        .occupied { background-color: var(--success); }
        .vacant { background-color: var(--danger); }
        .pending { background-color: var(--warning); }
        
        .room-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            cursor: pointer;
        }
        
        .room-card:hover {
            transform: translateY(-3px) scale(1.03);
        }
        
        .room-occupied {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            border: 1px solid #a7f3d0;
            color: #065f46;
        }
        
        .room-vacant {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border: 1px solid #fecaca;
            color: #991b1b;
        }
        
        .activity-item {
            position: relative;
            padding-left: 28px;
            margin-bottom: 1.5rem;
            border-left: 2px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .activity-item:hover {
            border-left-color: var(--primary);
        }
        
        .activity-item::before {
            content: '';
            position: absolute;
            left: -6px;
            top: 4px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--primary);
        }
        
        .progress-bar {
            height: 6px;
            border-radius: 3px;
            background: #e5e7eb;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            border-radius: 3px;
            transition: width 0.6s ease;
        }
        
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }
        
        .dark .gradient-bg {
            background: linear-gradient(135deg, #4338ca 0%, #5b21b6 100%);
        }
        
        .dark .card-hover {
            background: #1f2937;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }
        
        .dark .room-occupied {
            background: linear-gradient(135deg, #064e3b 0%, #065f46 100%);
            border-color: #047857;
            color: #d1fae5;
        }
        
        .dark .room-vacant {
            background: linear-gradient(135deg, #7f1d1d 0%, #991b1b 100%);
            border-color: #dc2626;
            color: #fee2e2;
        }
    </style>
    @endpush
    <!-- Header with Gradient Background -->
    <div class="gradient-bg text-white pb-24 pt-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0 py-4">
                <div class="space-y-2">
                    <h1 class="text-3xl md:text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-blue-100">
                        Dashboard Admin
                    </h1>
                    <p class="text-blue-100 text-sm md:text-base flex items-center">
                        Selamat datang di Sistem Manajemen Kos
                    </p>
                </div>
                <div class="backdrop-blur-sm rounded-xl p-3 md:p-4 shadow-lg">
                    <div class="text-right">
                        <p class="text-blue-50 text-sm font-medium">{{ now()->translatedFormat('l, d F Y') }}</p>
                        <p class="text-blue-100 text-2xl font-bold tracking-wide">{{ now()->format('H:i') }} <span class="text-sm font-normal">WIB</span></p>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 -mb-16">
                <!-- Kamar Terisi -->
                <div class="card-hover group" >
                    <div class="p-5 h-full flex flex-col bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                        <div class="flex justify-between items-start mb-3">
                            <div class="p-2.5 bg-blue-100 dark:bg-blue-900/40 rounded-lg group-hover:bg-blue-200 dark:group-hover:bg-blue-900/60 transition-colors">
                                <i class="fas fa-home text-blue-600 dark:text-blue-300 text-lg"></i>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/20 text-blue-100">
                                {{ $occupancyRate }}%
                            </span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $kamarTerisi }}<span class="text-lg text-gray-500 dark:text-gray-400">/{{ $totalRooms }}</span></h3>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mt-1">Kamar Terisi</p>
                        <div class="mt-4">
                            <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400 mb-1">
                                <span>Terisi {{ $occupancyRate }}%</span>
                                <span>Kapasitas</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill bg-blue-500" style="width: {{ $occupancyRate }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kamar Kosong -->
                <div class="card-hover group">
                    <div class="p-5 h-full flex flex-col bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                        <div class="flex justify-between items-start mb-3">
                            <div class="p-2.5 bg-red-100 dark:bg-red-900/40 rounded-lg group-hover:bg-red-200 dark:group-hover:bg-red-900/60 transition-colors">
                                <i class="fas fa-bed text-red-600 dark:text-red-300 text-lg"></i>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/20 text-red-100">
                                {{ 100 - $occupancyRate }}%
                            </span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $kamarKosong }}<span class="text-lg text-gray-500 dark:text-gray-400">/{{ $totalRooms }}</span></h3>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mt-1">Kamar Kosong</p>
                        <div class="mt-4">
                            <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400 mb-1">
                                <span>Kosong {{ 100 - $occupancyRate }}%</span>
                                <span>Kapasitas</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill bg-red-500" style="width: {{ 100 - $occupancyRate }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Penghuni -->
                <div class="card-hover group">
                    <div class="p-5 h-full flex flex-col bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                        <div class="flex justify-between items-start mb-3">
                            <div class="p-2.5 bg-purple-100 dark:bg-purple-900/40 rounded-lg group-hover:bg-purple-200 dark:group-hover:bg-purple-900/60 transition-colors">
                                <i class="fas fa-users text-purple-600 dark:text-purple-300 text-lg"></i>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/20 text-purple-100">
                                {{ $kamarTerisi }} Total
                            </span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $kamarTerisi }}</h3>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mt-1">Total Penghuni</p>
                        <div class="mt-4 space-y-2">
                            <div class="flex items-center text-sm">
                                <div class="w-2 h-2 rounded-full bg-blue-500 mr-2"></div>
                                <span class="text-gray-600 dark:text-gray-300">Laki-laki: {{ $jumlahLakiLaki }}</span>
                                <span class="mx-2 text-gray-400">•</span>
                                <span class="text-gray-600 dark:text-gray-300">{{ $jumlahLakiLaki > 0 ? round(($jumlahLakiLaki / $kamarTerisi) * 100) : 0 }}%</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <div class="w-2 h-2 rounded-full bg-pink-500 mr-2"></div>
                                <span class="text-gray-600 dark:text-gray-300">Perempuan: {{ $jumlahPerempuan }}</span>
                                <span class="mx-2 text-gray-400">•</span>
                                <span class="text-gray-600 dark:text-gray-300">{{ $jumlahPerempuan > 0 ? round(($jumlahPerempuan / $kamarTerisi) * 100) : 0 }}%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Keuangan -->
                <div class="card-hover group">
                    <div class="p-5 h-full flex flex-col bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                        <div class="flex justify-between items-start mb-3">
                            <div class="p-2.5 bg-green-100 dark:bg-green-900/40 rounded-lg group-hover:bg-green-200 dark:group-hover:bg-green-900/60 transition-colors">
                                <i class="fas fa-wallet text-green-600 dark:text-green-300 text-lg"></i>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/20 text-green-100">
                                {{ $paidUsersCount > 0 ? round(($paidUsersCount / ($paidUsersCount + $unpaidUsersCount)) * 100) : 0 }}%
                            </span>
                        </div>
                        
                        <!-- Income Amount -->
                        <div class="mt-2">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $formattedIncome }}</h3>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pendapatan Bulan Ini</p>
                        </div>
                        
                        <!-- Payment Progress -->
                        <div class="mt-5 space-y-3">
                            <!-- Progress Bar with Percentage -->
                            <div>
                                <div class="flex justify-between items-center text-xs text-gray-500 dark:text-gray-400 mb-1">
                                    <span>Status Pembayaran</span>
                                    <span>{{ $paidUsersCount }} Lunas ({{ $paidUsersCount > 0 ? round(($paidUsersCount / ($paidUsersCount + $unpaidUsersCount)) * 100) : 0 }}%)</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill bg-green-500" style="width: {{ $paidUsersCount > 0 ? ($paidUsersCount / ($paidUsersCount + $unpaidUsersCount)) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                            
                            <!-- Payment Status Summary -->
                            <div class="grid grid-cols-2 gap-2 mt-3">
                                <div class="bg-green-50 dark:bg-green-900/20 p-2 rounded-lg text-center">
                                    <p class="text-green-700 dark:text-green-300 font-medium">{{ $paidUsersCount }}</p>
                                    <p class="text-xs text-green-600 dark:text-green-400">Lunas</p>
                                </div>
                                <div class="bg-red-50 dark:bg-red-900/20 p-2 rounded-lg text-center">
                                    <p class="text-red-700 dark:text-red-300 font-medium">{{ $unpaidUsersCount }}</p>
                                    <p class="text-xs text-red-600 dark:text-red-400">Belum Bayar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Denah Kamar -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Denah Kamar</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Status kamar kosong dan terisi</p>
                    </div>
                    <div class="p-6">
                        <!-- Lantai 1 -->
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                                    Lantai 1
                                </h3>
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-200">
                                    {{ $kamarTerisiLantai1 }}/{{ count($denahKamarLantai1) }} Kamar Terisi
                                </span>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                                @foreach ($denahKamarLantai1 as $nomorKamar)
                                    @php
                                        $penghuni = $penghuniPerKamar->get($nomorKamar);
                                        $statusClass = $penghuni 
                                            ? 'bg-green-50 border-green-100 text-green-800 dark:bg-green-900/20 dark:border-green-800/50 dark:text-green-200' 
                                            : 'bg-gray-50 border-gray-100 text-gray-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400';
                                    @endphp
                                    <div class="room-card">
                                        <div class="h-20 rounded-lg border-2 flex flex-col items-center justify-center transition-all duration-200 {{ $statusClass }} hover:shadow-md">
                                            <span class="font-bold">{{ $nomorKamar }}</span>
                                            @if($penghuni)
                                                <div class="text-xs mt-1 truncate px-2 w-full">{{ $penghuni->name }}</div>
                                                <div class="absolute -top-1 -right-1 w-5 h-5 rounded-full bg-green-500 flex items-center justify-center">
                                                    <i class="fas fa-check text-white text-xs"></i>
                                                </div>
                                            @else
                                                <div class="text-xs mt-1 italic">Kosong</div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <hr class="my-6 border-gray-200 dark:border-gray-700">

                        <!-- Lantai 2 -->
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                                    Lantai 2
                                </h3>
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900/50 dark:text-purple-200">
                                    {{ $kamarTerisiLantai2 }}/{{ count($denahKamarLantai2) }} Kamar Terisi
                                </span>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                                @foreach ($denahKamarLantai2 as $nomorKamar)
                                    @php
                                        $penghuni = $penghuniPerKamar->get($nomorKamar);
                                        $statusClass = $penghuni 
                                            ? 'bg-green-50 border-green-100 text-green-800 dark:bg-green-900/20 dark:border-green-800/50 dark:text-green-200' 
                                            : 'bg-gray-50 border-gray-100 text-gray-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400';
                                    @endphp
                                    <div class="room-card">
                                        <div class="h-20 rounded-lg border-2 flex flex-col items-center justify-center transition-all duration-200 {{ $statusClass }} hover:shadow-md">
                                            <span class="font-bold">{{ $nomorKamar }}</span>
                                            @if($penghuni)
                                                <div class="text-xs mt-1 truncate px-2 w-full">{{ $penghuni->name }}</div>
                                                <div class="absolute -top-1 -right-1 w-5 h-5 rounded-full bg-green-500 flex items-center justify-center">
                                                    <i class="fas fa-check text-white text-xs"></i>
                                                </div>
                                            @else
                                                <div class="text-xs mt-1 italic">Kosong</div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Ringkasan Pembayaran -->
                <div class="card-hover h-full flex flex-col bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center">
                                <i class="fas fa-credit-card text-blue-500 mr-2"></i>
                                Ringkasan Pembayaran
                            </h2>
                            <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-200">
                                {{ now()->translatedFormat('M Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="space-y-6">
                            <!-- Ringkasan Status -->
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-100 dark:border-green-800/50">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-green-100 dark:bg-green-800/50 rounded-lg mr-3">
                                            <i class="fas fa-check-circle text-green-600 dark:text-green-300"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Lunas</p>
                                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $paidUsersCount }} Penyewa</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-block px-2.5 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200">
                                            {{ $paidUsersCount > 0 ? round(($paidUsersCount / ($paidUsersCount + $unpaidUsersCount)) * 100) : 0 }}%
                                        </span>
                                        <p class="text-xs text-green-600 dark:text-green-400 mt-1">Tepat waktu</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between p-3 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-100 dark:border-red-800/50">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-red-100 dark:bg-red-800/50 rounded-lg mr-3">
                                            <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-300"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Belum Bayar</p>
                                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $unpaidUsersCount }} Penyewa</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-block px-2.5 py-0.5 text-xs font-medium rounded-full bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-200">
                                            {{ $unpaidUsersCount > 0 ? round(($unpaidUsersCount / ($paidUsersCount + $unpaidUsersCount)) * 100) : 0 }}%
                                        </span>
                                        <p class="text-xs text-red-600 dark:text-red-400 mt-1">Jatuh tempo</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Total Pendapatan -->
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/20 p-4 rounded-xl border border-blue-100 dark:border-blue-800/50">
                                <p class="text-sm font-medium text-blue-800 dark:text-blue-200 mb-1">Total Pendapatan Bulan Ini</p>
                                <div class="flex items-end justify-between">
                                    <p class="text-2xl font-bold text-blue-900 dark:text-white">{{ $formattedIncome }}</p>
                                    <div class="flex items-center text-green-500 dark:text-green-400 text-sm">
                                        <i class="fas fa-arrow-up mr-1"></i>
                                        <span>12% dari bulan lalu</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="h-2 bg-blue-200 dark:bg-blue-800/50 rounded-full overflow-hidden">
                                        <div class="h-full bg-blue-500 rounded-full" style="width: 75%"></div>
                                    </div>
                                    <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">75% dari target bulanan</p>
                                </div>
                            </div>
                        </div>
                        
                        <button class="mt-6 w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium py-2.5 px-4 rounded-xl transition-all duration-300 flex items-center justify-center group shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                            <i class="fas fa-file-invoice-dollar mr-2 group-hover:scale-110 transition-transform"></i>
                            Lihat Laporan Keuangan
                            <i class="fas fa-arrow-right ml-2 text-sm opacity-0 group-hover:opacity-100 group-hover:ml-3 transition-all duration-300"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
