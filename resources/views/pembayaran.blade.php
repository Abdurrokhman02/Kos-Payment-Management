<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 leading-tight">
            <i class="fas fa-credit-card text-indigo-600 mr-2"></i>
            {{ __('Pembayaran Sewa Kamar') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <p class="font-bold">Berhasil!</p>
                    </div>
                    <p class="mt-1">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Error Message -->
            @if(session('error'))
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <p class="font-bold">Gagal!</p>
                    </div>
                    <p class="mt-1">{{ session('error') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Payment Information -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Payment Card -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
                            <h3 class="text-lg font-semibold text-white">
                                <i class="fas fa-receipt mr-2"></i> Detail Tagihan
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-1">
                                    <p class="text-sm font-medium text-gray-500">Nama Penyewa</p>
                                    <p class="font-medium text-gray-900">{{ $user->name }}</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-sm font-medium text-gray-500">Nomor Kamar</p>
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                            <i class="fas fa-door-closed mr-1"></i> {{ $user->nomor_kamar ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-sm font-medium text-gray-500">Nomor Telepon</p>
                                    <div class="flex items-center">
                                        <i class="fas fa-phone-alt text-gray-400 mr-2"></i>
                                        <span class="font-medium">{{ $user->nomor_telepon ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-sm font-medium text-gray-500">Total Tagihan</p>
                                    <p class="text-2xl font-bold text-indigo-600">
                                        Rp {{ number_format($paymentAmount, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Instructions -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
                            <h3 class="text-lg font-semibold text-white">
                                <i class="fas fa-info-circle mr-2"></i> Instruksi Pembayaran
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="bg-blue-50 rounded-lg p-4 mb-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 pt-1">
                                        <div class="flex items-center justify-center h-8 w-8 rounded-full bg-blue-200 text-blue-600">
                                            <i class="fas fa-university"></i>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="text-sm font-medium text-blue-800">Transfer ke Rekening Bank</h4>
                                        <div class="mt-2 space-y-2">
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <p class="text-xs text-gray-500">Bank</p>
                                                    <p class="font-medium">Bank BCA</p>
                                                </div>
                                                <div>
                                                    <p class="text-xs text-gray-500">Nomor Rekening</p>
                                                    <p class="font-mono font-medium">1234567890</p>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-500">Atas Nama</p>
                                                <p class="font-medium">Pemilik Kos Sejahtera</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            Lakukan pembayaran sesuai dengan jumlah tagihan. Setelah melakukan pembayaran, 
                                            sistem akan secara otomatis memperbarui status pembayaran Anda.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 sticky top-6">
                        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
                            <h3 class="text-lg font-semibold text-white">
                                <i class="fas fa-file-invoice-dollar mr-2"></i> Ringkasan Pembayaran
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Sewa Kamar Bulan Ini</span>
                                    <span class="font-medium">Rp {{ number_format($paymentAmount, 0, ',', '.') }}</span>
                                </div>
                                <div class="border-t border-gray-200 my-2"></div>
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold">Total Tagihan</span>
                                    <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($paymentAmount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            
                            <form id="paymentForm" method="POST" action="{{ route('pembayaran.store') }}" class="mt-6">
                                @csrf
                                <button type="button" id="payButton" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                    <i class="fas fa-credit-card mr-2"></i> Bayar Sekarang
                                </button>
                            </form>
                            
                            <div class="mt-8">
                                <div class="bg-blue-50 rounded-lg p-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 pt-1">
                                            <i class="fas fa-headset text-blue-400 text-lg"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-blue-800">Butuh Bantuan?</h3>
                                            <div class="mt-2 text-sm text-blue-700">
                                                <p>Hubungi kami di:</p>
                                                <a href="https://wa.me/{{ env('WHATSAPP_CS_NUMBER', '62895331075779') }}" target="_blank" class="font-medium inline-flex items-center mt-1 hover:text-blue-800">
                                                    <i class="fab fa-whatsapp text-green-500 mr-2 text-lg"></i>
                                                    <span class="hover:underline">+{{ env('WHATSAPP_CS_NUMBER', '62895331075779') }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment History -->
            <div class="mt-12">
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white">
                            <i class="fas fa-history mr-2"></i> Riwayat Pembayaran
                        </h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Bayar</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($paymentHistory as $payment)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $payment->payment_date->format('d M Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $statusColors = [
                                                    'lunas' => 'bg-green-100 text-green-800',
                                                    'belum dibayar' => 'bg-yellow-100 text-yellow-800',
                                                    'pending' => 'bg-blue-100 text-blue-800',
                                                    'approved' => 'bg-green-100 text-green-800',
                                                    'rejected' => 'bg-red-100 text-red-800',
                                                    'expired' => 'bg-gray-100 text-gray-800'
                                                ];
                                                $statusColor = $statusColors[$payment->status] ?? 'bg-gray-100 text-gray-800';
                                            @endphp
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                                            Tidak ada riwayat pembayaran
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            
        </div>
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listener to the payment button
            document.getElementById('payButton').addEventListener('click', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Konfirmasi Pembayaran',
                    text: 'Apakah Anda yakin ingin melanjutkan pembayaran sebesar Rp {{ number_format($paymentAmount, 0, ',', '.') }}?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, lanjutkan pembayaran',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form if confirmed
                        document.getElementById('paymentForm').submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>