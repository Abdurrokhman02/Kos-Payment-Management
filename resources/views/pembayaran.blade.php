<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Halaman Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('success'))
                        <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Tagihan</h3>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="font-bold">Nama:</p>
                            <p>{{ $user->name }}</p>
                        </div>
                        <div>
                            <p class="font-bold">Nomor Kamar:</p>
                            <p>{{ $user->nomor_kamar }}</p>
                        </div>
                        <div>
                            <p class="font-bold">Nomor Telepon:</p>
                            <p>{{ $user->nomor_telepon }}</p>
                        </div>
                        <div>
                            <p class="font-bold">Tagihan Bulan Ini:</p>
                            <p>Rp {{ number_format($paymentAmount, 2, ',', '.') }}</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('pembayaran.store') }}">
                        @csrf
                        <x-primary-button>
                            {{ __('Bayar Sekarang') }}
                        </x-primary-button>
                    </form>

                    <hr class="my-8">

                    <h3 class="text-lg font-medium text-gray-900 mb-4">Riwayat Pembayaran</h3>
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
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $payment->payment_date->format('d F Y, H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($payment->amount, 2, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                            Belum ada riwayat pembayaran.
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