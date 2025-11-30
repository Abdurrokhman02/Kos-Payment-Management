<!DOCTYPE html>
<html lang="id">
<head>
    @php
        // Dapatkan nomor WhatsApp dari environment variable
        $whatsappNumber = env('WHATSAPP_CS_NUMBER', '6289454464645');
        // Format nomor untuk URL WhatsApp (hapus karakter selain angka)
        $formattedWhatsappNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);
        // Pastikan nomor diawali dengan 62 (kode negara Indonesia)
        if (substr($formattedWhatsappNumber, 0, 1) === '0') {
            $formattedWhatsappNumber = '62' . substr($formattedWhatsappNumber, 1);
        } elseif (substr($formattedWhatsappNumber, 0, 2) !== '62') {
            $formattedWhatsappNumber = '62' . $formattedWhatsappNumber;
        }
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kos Enak - Tempat Tinggal Nyaman di Karawang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 0.8s ease-out forwards; }
        .room-available { border-left: 4px solid #10B981; }
        .room-occupied { border-left: 4px solid #EF4444; }
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        .whatsapp-float:hover {
            background-color: #128C7E;
            transform: scale(1.1);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-gray-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 font-sans min-h-screen flex flex-col">

    <!-- HEADER -->
    <header class="fixed inset-x-0 top-0 z-50 backdrop-blur-md bg-white/70 dark:bg-gray-800/70 shadow-sm">
        <nav class="mx-auto max-w-7xl flex items-center justify-between p-4">
            <!-- Logo -->
            <div class="flex-1 flex justify-start">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img class="h-14 w-auto drop-shadow" src="{{ asset('images/Logo.png') }}" alt="Logo Kos Enak">
                    <span class="text-lg font-bold text-gray-900 dark:text-white tracking-wide">
                        Kos Enak
                    </span>
                </a>
            </div>

            <!-- Menu Navigasi -->
            <div class="hidden md:flex items-center gap-8">
                <a href="#tentang" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-sunshine transition-colors">Tentang</a>
                <a href="#kamar" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-sunshine transition-colors">Kamar</a>
                <a href="#lokasi" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-sunshine transition-colors">Lokasi</a>
                <a href="{{ route('login') }}" class="bg-sunshine text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-opacity-90 transition-colors">
                    Masuk
                </a>
            </div>
            
            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="text-gray-700 dark:text-gray-300" id="mobile-menu-button">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </nav>

        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white dark:bg-gray-800">
                <a href="#tentang" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">Tentang</a>
                <a href="#kamar" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">Kamar</a>
                <a href="#lokasi" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">Lokasi</a>
                <a href="{{ route('login') }}" class="block px-3 py-2 text-center bg-sunshine text-white rounded-md font-medium">
                    Masuk / Daftar
                </a>
            </div>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="relative pt-24 pb-16 md:pt-32 md:pb-24 px-6 bg-gray-900">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2073&q=80" 
                 alt="Kos Nyaman di Karawang" 
                 class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900 to-gray-900/70"></div>
        </div>
        
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6">
                    Tempat Tinggal Nyaman di <span class="text-sunshine">Karawang</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-200 max-w-3xl mx-auto mb-10">
                    Nikmati kenyamanan dan fasilitas terbaik dengan harga terjangkau. Lokasi strategis dekat kampus dan pusat kota.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="https://wa.me/{{ $formattedWhatsappNumber }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-8 rounded-full transition-colors flex items-center justify-center">
                        <i class="fab fa-whatsapp mr-2 text-xl"></i> Hubungi via WhatsApp
                    </a>
                    <a href="#kamar" class="bg-sunshine hover:bg-opacity-90 text-white font-semibold py-3 px-8 rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Lihat Kamar Tersedia
                    </a>
                    <a href="#kontak" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-3 px-8 rounded-full border border-white/30 transition-all duration-300 shadow-lg hover:shadow-xl">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- TENTANG KAMI -->
    <section id="tentang" class="py-16 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Tentang Kos Enak</h2>
                <div class="w-20 h-1 bg-sunshine mx-auto mt-4"></div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Tempat Tinggal Nyaman untuk Mahasiswa dan Karyawan</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Kos Enak hadir sebagai solusi akomodasi yang nyaman dan terjangkau di tengah kota. Kami memahami kebutuhan penghuni kos akan kenyamanan dan keamanan, itulah mengapa kami menyediakan fasilitas terbaik dengan harga yang bersaing.
                    </p>
                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                            <div class="text-sunshine text-2xl mb-2"><i class="fas fa-wifi"></i></div>
                            <h4 class="font-semibold text-gray-800 dark:text-white">Internet Cepat</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Akses internet 24/7 dengan kecepatan tinggi</p>
                        </div>
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                            <div class="text-sunshine text-2xl mb-2"><i class="fas fa-fan"></i></div>
                            <h4 class="font-semibold text-gray-800 dark:text-white">AC & Kamar Mandi Dalam</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Setiap kamar dilengkapi AC dan kamar mandi pribadi</p>
                        </div>
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                            <div class="text-sunshine text-2xl mb-2"><i class="fas fa-utensils"></i></div>
                            <h4 class="font-semibold text-gray-800 dark:text-white">Dapur Bersama</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Area dapur yang luas dan bersih untuk memasak</p>
                        </div>
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                            <div class="text-sunshine text-2xl mb-2"><i class="fas fa-shield-alt"></i></div>
                            <h4 class="font-semibold text-gray-800 dark:text-white">Keamanan 24 Jam</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Keamanan terjamin dengan CCTV dan penjaga</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="rounded-lg overflow-hidden h-64">
                        <img src="https://rhdesainrumah.id/wp-content/uploads/2025/07/menata-kamar-kos-sempit-dengan-sprei-motif-polos.jpg" alt="Kamar Kos" class="w-full h-full object-cover">
                    </div>
                    <div class="space-y-4">
                        <div class="rounded-lg overflow-hidden h-30">
                            <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80" alt="Kamar Mandi" class="w-full h-full object-cover">
                        </div>
                        <div class="rounded-lg overflow-hidden h-30">
                            <img src="https://images.unsplash.com/photo-1560448204-603b3fc33ddc?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80" alt="Dapur Bersama" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- KAMAR TERSEDIA -->
    <section id="kamar" class="py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Kamar Tersedia</h2>
                <div class="w-20 h-1 bg-sunshine mx-auto mt-4"></div>
                <p class="mt-4 text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Pilih kamar yang sesuai dengan kebutuhan Anda. Setiap kamar dilengkapi dengan fasilitas lengkap untuk kenyamanan Anda.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($rooms as $room)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg {{ $room->tersedia ? 'room-available' : 'room-occupied' }}">
                        <div class="relative">
                            <div class="w-full h-48 overflow-hidden">
                                @if($room->gambar)
                                    <img src="{{ asset($room->gambar) }}" alt="Kamar {{ $room->nomor_kamar }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                                @else
                                    @php
                                        // Array of placeholder image URLs from a free image service (using unsplash)
                                        $placeholderImages = [
                                            'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YmVkcm9vbXxlbnwwfHwwfHx8MA%3D%3D',
                                            'https://images.unsplash.com/photo-1513694203232-719a280e022f?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8YmVkcm9vbXxlbnwwfHwwfHx8MA%3D%3D',
                                            'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8YmVkcm9vbXxlbnwwfHwwfHx8MA%3D%3D',
                                            'https://images.unsplash.com/photo-1564078516393-cf04bd966897?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fGJlZHJvb218ZW58MHx8MHx8fDA%3D',
                                            'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fGJlZHJvb218ZW58MHx8MHx8fDA%3D',
                                            'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTJ8fGJlZHJvb218ZW58MHx8MHx8fDA%3D',
                                            'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fGJlZHJvb218ZW58MHx8MHx8fDA%3D'
                                        ];
                                        
                                        // Select a random image for each room
                                        $index = is_numeric($room->nomor_kamar) ? $room->nomor_kamar : crc32($room->nomor_kamar);
                                        $index = abs($index) % count($placeholderImages);
                                        $imageUrl = $placeholderImages[$index];
                                    @endphp
                                    <img src="{{ $imageUrl }}" alt="Kamar {{ $room->nomor_kamar }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                                @endif
                            </div>
                            <div class="absolute top-4 right-4 bg-white dark:bg-gray-900 text-xs font-semibold px-3 py-1 rounded-full shadow-md {{ $room->tersedia ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ $room->tersedia ? 'Tersedia' : 'Terisi' }}
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Kamar {{ $room->nomor_kamar }}</h3>
                                <span class="text-sm text-gray-500">Lantai {{ $room->lantai }}</span>
                            </div>
                            <p class="text-2xl font-bold text-sunshine mb-4">Rp {{ number_format($room->harga, 0, ',', '.') }}<span class="text-sm font-normal text-gray-500">/bulan</span></p>
                            
                            @if(!empty($room->fasilitas))
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Fasilitas:</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($room->fasilitas as $fasilitas)
                                        <span class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded">
                                            {{ $fasilitas }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            
                            <div class="flex justify-between items-center mt-6">
                                @php
                                    $whatsappMessage = "Halo, saya tertarik dengan Kamar " . $room->nomor_kamar . " (Lantai " . $room->lantai . ") dengan harga Rp " . number_format($room->harga, 0, ',', '.') . "/bulan. Apakah kamar ini masih tersedia?";
                                    $encodedMessage = urlencode($whatsappMessage);
                                    $whatsappUrl = "https://wa.me/" . $formattedWhatsappNumber . "?text=" . $encodedMessage;
                                @endphp
                                <a href="{{ $whatsappUrl }}" target="_blank" class="text-sm font-medium text-sunshine hover:underline flex items-center">
                                    <i class="fab fa-whatsapp mr-2"></i> Hubungi via WA
                                </a>
                                @if($room->tersedia)
                                    <a href="{{ $whatsappUrl }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white text-sm font-medium px-4 py-2 rounded-full flex items-center transition-colors">
                                        <i class="fab fa-whatsapp mr-2"></i> Pesan via WA
                                    </a>
                                @else
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Tidak Tersedia</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- LOKASI -->
    <section id="lokasi" class="py-16 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Lokasi Strategis</h2>
                <div class="w-20 h-1 bg-sunshine mx-auto mt-4"></div>
                <p class="mt-4 text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Lokasi kami yang strategis memudahkan akses ke berbagai fasilitas penting di sekitar kawasan.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Alamat Lengkap</h3>
                    <div class="space-y-4 text-gray-600 dark:text-gray-300">
                        <p class="flex items-start">
                            <i class="fas fa-map-marker-alt text-sunshine text-xl mt-1 mr-3"></i>
                            <span>Jl. HS.Ronggo Waluyo, Puseurjaya, Telukjambe Timur, Karawang, Jawa Barat 41361</span>
                        </p>
                        <p class="flex items-center">
                            <i class="fab fa-whatsapp text-sunshine text-lg mr-3"></i>
                            <a href="https://wa.me/{{ $formattedWhatsappNumber }}" target="_blank" class="hover:underline">
                                +{{ $formattedWhatsappNumber }}
                            </a>
                        </p>
                        <p class="flex items-center">
                            <i class="far fa-envelope text-sunshine text-lg mr-3"></i>
                            <span>info@kosenak.com</span>
                        </p>
                    </div>

                    <div class="mt-8">
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Akses Mudah Ke:</h4>
                        <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>1 menit ke Unsika</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>10 menit ke Pusat Perbelanjaan</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>15 menit ke Stasiun Kereta Terdekat</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>5 menit ke Rumah Sakit</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="h-96 rounded-xl overflow-hidden shadow-lg">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d424.4434562959191!2d107.30643628343348!3d-6.323118881278029!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6977ccb34822e1%3A0x6c4c7c12678610e0!2sUniversitas%20Singaperbangsa%20Karawang%20(UNSIKA)!5e1!3m2!1sid!2sid!4v1764238404181!5m2!1sid!2sid"
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy"
                        class="rounded-xl"
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTAK -->
    <section id="kontak" class="py-16">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Tertarik Menjadi Penghuni?</h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto">
                Hubungi kami untuk informasi lebih lanjut atau kunjungi langsung lokasi kami untuk melihat fasilitas yang tersedia.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @if(!empty($formattedWhatsappNumber))
                    @php
                        $defaultMessage = "Halo, saya ingin bertanya tentang kamar kos yang tersedia. Bisa bantu saya?";
                        $encodedDefaultMessage = urlencode($defaultMessage);
                        $whatsappUrl = "https://wa.me/" . $formattedWhatsappNumber . "?text=" . $encodedDefaultMessage;
                    @endphp
                    <a href="{{ $whatsappUrl }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-8 rounded-full transition-colors flex items-center justify-center gap-2">
                        <i class="fab fa-whatsapp text-xl"></i> Hubungi via WhatsApp
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white pt-12 pb-6">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="h-8 w-auto mr-2">
                        Kos Enak
                    </h3>
                    <p class="text-gray-400 text-sm">
                        Menyediakan akomodasi nyaman dengan fasilitas lengkap untuk mahasiswa dan pekerja di tengah kota.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="#tentang" class="text-gray-400 hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="#kamar" class="text-gray-400 hover:text-white transition-colors">Kamar</a></li>
                        <li><a href="#fasilitas" class="text-gray-400 hover:text-white transition-colors">Fasilitas</a></li>
                        <li><a href="#lokasi" class="text-gray-400 hover:text-white transition-colors">Lokasi</a></li>
                        <li><a href="#kontak" class="text-gray-400 hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-4">Jam Operasional</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li class="flex justify-between"><span>Senin - Jumat</span> <span>08:00 - 17:00</span></li>
                        <li class="flex justify-between"><span>Sabtu</span> <span>09:00 - 15:00</span></li>
                        <li class="flex justify-between"><span>Minggu</span> <span>Tutup</span></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-4">Hubungi Kami</h4>
                    <div class="space-y-2 text-gray-400 text-sm">
                        <p class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-sunshine"></i>
                            <span>Jl. HS.Ronggo Waluyo, Puseurjaya, Telukjambe Timur, Karawang, Jawa Barat 41361</span>
                        </p>
                        <p class="flex items-center">
                            <i class="fab fa-whatsapp mr-3 text-sunshine"></i>
                            <a href="https://wa.me/{{ $formattedWhatsappNumber }}" target="_blank" class="hover:underline">
                                +{{ $formattedWhatsappNumber }}
                            </a>
                        </p>
                        <p class="flex items-center">
                            <i class="far fa-envelope mr-3 text-sunshine"></i>
                            <span>info@kosenak.com</span>
                        </p>
                        <div class="flex space-x-4 mt-4">
                            <a href="https://wa.me/{{ $formattedWhatsappNumber }}" target="_blank" class="text-green-400 hover:text-green-300 transition-colors text-2xl">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors text-2xl">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="text-blue-300 hover:text-blue-200 transition-colors text-2xl">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-pink-400 hover:text-pink-300 transition-colors text-2xl">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-6 text-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} Kos Enak. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- FLOATING WHATSAPP BUTTON -->
    @if(!empty($formattedWhatsappNumber))
        @php
            $defaultMessage = "Halo, saya ingin bertanya tentang kamar kos yang tersedia. Bisa bantu saya?";
            $encodedDefaultMessage = urlencode($defaultMessage);
            $whatsappUrl = "https://wa.me/" . $formattedWhatsappNumber . "?text=" . $encodedDefaultMessage;
        @endphp
        <a href="{{ $whatsappUrl }}" 
           class="whatsapp-float" 
           target="_blank"
           aria-label="Hubungi kami via WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    @endif

    <!-- SCRIPTS -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                    // Close mobile menu if open
                    document.getElementById('mobile-menu').classList.add('hidden');
                }
            });
        });

        // Add shadow to header on scroll
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('shadow-md');
                header.classList.remove('shadow-sm');
            } else {
                header.classList.remove('shadow-md');
                header.classList.add('shadow-sm');
            }
        });
    </script>
</body>
</html>
