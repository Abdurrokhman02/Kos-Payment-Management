    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>{{ config('app.name', 'Kos Payment Management') }}</title>

            <!-- Fonts -->
            <link rel="preconnect" href="https://fonts.bunny.net">
            <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

            <!-- Scripts -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        </head>
        <body class="font-sans antialiased bg-clean dark:bg-gray-900">
            <div class="min-h-screen flex flex-col sm:justify-center items-center px-4 sm:px-6 lg:px-8">
                
                <!-- HAPUS LOGO DEFAULT LARAVEL -->
                <!-- Kalau mau pakai logomu, bisa taruh di sini -->
                
                <div class="mb-6">
                    <a href="/">
                        <img src="{{ asset('images/Logo.png') }}" alt="Kos Payment Logo" class="h-16 w-auto drop-shadow">
                    </a>
                </div>
            

                <!-- CARD CONTAINER -->
                <div class="w-full max-w-4xl p-8 md:p-12 bg-white/80 dark:bg-gray-800/70 backdrop-blur-xl rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 animate-fade-in">
                    {{ $slot }}
                </div>

            </div>

            <style>
                @keyframes fade-in {
                    from { opacity: 0; transform: translateY(10px); }
                    to { opacity: 1; transform: translateY(0); }
                }
                .animate-fade-in {
                    animation: fade-in 0.4s ease-out forwards;
                }
            </style>
        </body>
    </html>
