<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Kos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-gray-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 font-sans min-h-screen flex flex-col">

    <!-- HEADER -->
    <header class="fixed inset-x-0 top-0 z-50 backdrop-blur-md bg-white/70 dark:bg-gray-800/70 shadow-sm">
        <nav class="mx-auto max-w-7xl flex items-center justify-between p-6">
            <!-- Logo -->
            <div class="flex-1 flex justify-start">
                <a href="#" class="flex items-center gap-2">
                    <img class="h-16 w-auto drop-shadow" src="{{ asset('images/Logo.png') }}" alt="Logo Kos Payment Management">
                    <span class="text-lg font-bold text-gray-900 dark:text-white tracking-wide">
                        Kos Payment
                    </span>
                </a>
            </div>

            <!-- Menu -->
            <div class="flex-1 flex justify-end gap-x-6">
                <a href="{{ route('login') }}" 
                   class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-100 hover:text-sunshine transition-colors">
                   Masuk
                </a>
                <a href="{{ route('register') }}" 
                   class="rounded-full bg-sunshine px-4 py-2 text-sm font-semibold text-white shadow-md hover:shadow-lg hover:scale-105 transform transition-all duration-300">
                   Daftar
                </a>
            </div>
        </nav>
    </header>

    <!-- MAIN SECTION -->
    <main class="flex-grow flex items-center justify-center px-6 pt-28 lg:px-8">
        <div class="max-w-2xl text-center animate-fade-in">
            <h1 class="text-5xl font-extrabold tracking-tight text-gray-900 dark:text-gray-100 sm:text-6xl">
                Kelola Kosmu dengan Mudah
            </h1>
            <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-400">
                Sistem terintegrasi untuk mengelola data penghuni, pembayaran, dan laporan keuangan kosmu.
            </p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="{{ route('login') }}" 
                   class="rounded-full bg-sunshine px-6 py-3 text-base font-semibold text-white shadow-md hover:shadow-xl hover:scale-105 transform transition-all duration-300">
                    Mulai Sekarang
                </a>
                <a href="{{ route('company-profile') }}" 
                   class="text-base font-semibold leading-6 text-gray-900 dark:text-gray-100 hover:text-sunshine transition-colors">
                    Pelajari Lebih Lanjut <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </main>

    <!-- SIMPLE ANIMATION -->
    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.8s ease-out forwards;
        }
    </style>

</body>
</html>
