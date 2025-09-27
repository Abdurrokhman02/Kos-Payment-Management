<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-900 px-4 py-12">
        <div class="max-w-3xl w-full bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-10 space-y-8">

            <!-- Logo + Nama Perusahaan -->
            <div class="text-center">
                <img src="{{ asset('images/Logo.png') }}" class="mx-auto h-20 w-auto drop-shadow-lg">
                <h1 class="mt-4 text-4xl font-extrabold text-sunshine tracking-wide">
                    Kos Payment Management
                </h1>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    Solusi pembayaran kos yang aman, cepat, dan terintegrasi.
                </p>
            </div>

            <!-- Deskripsi Perusahaan -->
            <div class="space-y-4 text-gray-700 dark:text-gray-300">
                <h2 class="text-2xl font-semibold">Tentang Kami</h2>
                <p>
                    Kami hadir untuk membantu pemilik kos dan penyewa dalam mengelola pembayaran secara
                    digital. Dengan platform ini, semua pembayaran dapat dilakukan secara transparan,
                    mudah dipantau, dan memiliki catatan yang jelas.
                </p>
            </div>

            <!-- Visi & Misi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-4 rounded-xl bg-clean dark:bg-gray-700 shadow-md">
                    <h3 class="text-xl font-semibold text-sunshine">Visi</h3>
                    <p class="mt-2">
                        Menjadi platform pembayaran kos nomor satu di Indonesia yang memudahkan hidup
                        pemilik kos dan penyewa.
                    </p>
                </div>

                <div class="p-4 rounded-xl bg-clean dark:bg-gray-700 shadow-md">
                    <h3 class="text-xl font-semibold text-sunshine">Misi</h3>
                    <ul class="mt-2 list-disc list-inside space-y-1">
                        <li>Memberikan sistem pembayaran yang aman dan mudah.</li>
                        <li>Menyediakan laporan keuangan yang transparan.</li>
                        <li>Membantu pemilik kos meningkatkan manajemen bisnisnya.</li>
                    </ul>
                </div>
            </div>

            <!-- CTA -->
            <div class="text-center mt-8">
                <a href="{{ route('register') }}"
                   class="inline-block bg-sunshine text-white px-6 py-3 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300">
                    Daftar Sekarang
                </a>
            </div>

        </div>
    </div>
</x-guest-layout>
