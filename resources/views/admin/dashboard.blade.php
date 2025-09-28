<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-purple-100 p-6 rounded-lg shadow text-center">
                    <div class="text-sm font-medium text-purple-800">Kamar Terisi</div>
                    <div class="mt-1 text-3xl font-bold text-purple-900">{{ $kamarTerisi }}</div>
                </div>
                <div class="bg-gray-100 p-6 rounded-lg shadow text-center">
                    <div class="text-sm font-medium text-gray-800">Kamar Kosong</div>
                    <div class="mt-1 text-3xl font-bold text-gray-900">{{ $kamarKosong }}</div>
                </div>
                <div class="bg-blue-100 p-6 rounded-lg shadow text-center">
                    <div class="text-sm font-medium text-blue-800">Jumlah Laki-laki</div>
                    <div class="mt-1 text-3xl font-bold text-blue-900">{{ $jumlahLakiLaki }}</div>
                </div>
                <div class="bg-pink-100 p-6 rounded-lg shadow text-center">
                    <div class="text-sm font-medium text-pink-800">Jumlah Perempuan</div>
                    <div class="mt-1 text-3xl font-bold text-pink-900">{{ $jumlahPerempuan }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold mb-4">Denah Hunian Kos</h3>
                    
                    <div>
                        <h4 class="text-lg font-semibold mb-3 text-gray-600">Lantai 1</h4>
                        <div class="grid grid-cols-3 gap-4"> 
                            @foreach ($denahKamarLantai1 as $nomorKamar)
                                @php
                                    $penghuni = $penghuniPerKamar->get($nomorKamar);
                                @endphp
                                <div class="w-full h-24 rounded-lg flex flex-col items-center justify-center text-center p-2
                                            {{ $penghuni ? 'bg-green-200 text-green-900' : 'bg-gray-200 text-gray-700' }}">
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

                    <hr class="my-6">

                    <div>
                        <h4 class="text-lg font-semibold mb-3 text-gray-600">Lantai 2</h4>
                        <div class="grid grid-cols-3 gap-4"> 
                            @foreach ($denahKamarLantai2 as $nomorKamar)
                                @php
                                    $penghuni = $penghuniPerKamar->get($nomorKamar);
                                @endphp
                                <div class="w-full h-24 rounded-lg flex flex-col items-center justify-center text-center p-2
                                            {{ $penghuni ? 'bg-green-200 text-green-900' : 'bg-gray-200 text-gray-700' }}">
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

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                 <div class="bg-green-50 p-6 rounded-lg shadow flex items-center space-x-4">
                    <div class="bg-green-200 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-800" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 13h10M7 13a4 4 0 100 8h10a4 4 0 100-8H7z" /></svg>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-500">Pendapatan Bulan Ini</div>
                        <div class="mt-1 text-2xl font-bold text-green-600">Rp {{ number_format($totalPaymentsThisMonth, 0, ',', '.') }}</div>
                    </div>
                </div>
                 <div class="bg-indigo-50 p-6 rounded-lg shadow flex items-center space-x-4">
                    <div class="bg-indigo-200 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-800" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-500">Sudah Bayar</div>
                        <div class="mt-1 text-2xl font-bold text-gray-900">{{ $paidUsersCount }} <span class="text-lg font-normal">Penyewa</span></div>
                    </div>
                </div>
                <div class="bg-red-50 p-6 rounded-lg shadow flex items-center space-x-4">
                    <div class="bg-red-200 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-500">Belum Bayar</div>
                        <div class="mt-1 text-2xl font-bold text-red-600">{{ $unpaidUsersCount }} <span class="text-lg font-normal">Penyewa</span></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>