<?php
// Untuk mendapatkan data statistik, Anda perlu mengambilnya dari database di controller.
// Karena kita belum membuat controller khusus dashboard admin, data ini masih berupa dummy/placeholder.
// Anda bisa membuat controller AdminDashboardController dan memanggilnya di routes/web.php
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- RINGKASAN STATISTIK -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Card 1: Total Penyewa -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-sunshine/20">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Penyewa</div>
                    <div class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">15</div>
                </div>

                <!-- Card 2: Status Pembayaran Lunas -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-sunshine/20">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Pembayaran Bulan Ini</div>
                    <div class="mt-1 text-3xl font-bold text-green-600">Rp 7.500.000</div>
                </div>

                <!-- Card 3: Jumlah Tunggakan -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-sunshine/20">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Jumlah Tunggakan</div>
                    <div class="mt-1 text-3xl font-bold text-red-500">3 Penyewa</div>
                </div>

                <!-- Card 4: Kamar Terisi -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-sunshine/20">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Hunian Kos</div>
                    <div class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">88%</div>
                </div>
            </div>

            <!-- AKSES CEPAT & TOOLS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Kelola User/Penyewa -->
                <a href="{{ route('admin.users.index') }}" class="block">
                    <div class="bg-sunshine/10 dark:bg-sunshine/20 p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                        <h3 class="text-xl font-semibold text-sunshine">Kelola Penyewa</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-300">Lihat daftar, edit data, dan atur kamar.</p>
                    </div>
                </a>

                <!-- Tambah User Baru -->
                <a href="{{ route('admin.users.create') }}" class="block">
                    <div class="bg-green-100/50 dark:bg-green-800/50 p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                        <h3 class="text-xl font-semibold text-green-700 dark:text-green-300">Tambah Penyewa Baru</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-300">Daerah pendaftaran user baru secara manual.</p>
                    </div>
                </a>

                <!-- Laporan Keuangan -->
                <div class="bg-yellow-100/50 dark:bg-yellow-800/50 p-6 rounded-xl shadow-lg opacity-50 cursor-not-allowed">
                    <h3 class="text-xl font-semibold text-yellow-700 dark:text-yellow-300">Laporan Keuangan (Segera)</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">Analisis pemasukan dan pengeluaran kos.</p>
                </div>
            </div>
            
            <!-- DAFTAR TUNGGAKAN CEPAT -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-semibold text-red-500 mb-4">Peringatan Tunggakan</h3>
                <p class="text-gray-600 dark:text-gray-300">Tidak ada tunggakan saat ini. Semua pembayaran aman.</p>
                <!-- Di sini nanti bisa loop daftar tunggakan -->
            </div>
        </div>
    </div>
</x-app-layout>
