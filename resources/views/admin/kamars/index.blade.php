<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold">Daftar Kamar</h3>
                        <a href="{{ route('admin.kamars.create') }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                            Tambah Kamar
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 text-green-700 dark:text-green-300">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th class="py-3 px-4 text-left">No. Kamar</th>
                                    <th class="py-3 px-4 text-left">Lantai</th>
                                    <th class="py-3 px-4 text-right">Harga/Bulan</th>
                                    <th class="py-3 px-4 text-left">Fasilitas</th>
                                    <th class="py-3 px-4 text-center">Status</th>
                                    <th class="py-3 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($kamars as $kamar)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="py-3 px-4 font-medium">{{ $kamar->nomor_kamar }}</td>
                                        <td class="py-3 px-4">Lantai {{ $kamar->lantai }}</td>
                                        <td class="py-3 px-4 text-right">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</td>
                                        <td class="py-3 px-4">
                                            <div class="flex flex-wrap gap-1">
                                                @forelse (array_slice($kamar->fasilitas ?? [], 0, 3) as $fasilitas)
                                                    <span class="text-xs bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-2 py-1 rounded">
                                                        {{ $fasilitas }}
                                                    </span>
                                                @empty
                                                    <span class="text-gray-500 dark:text-gray-400 text-sm">-</span>
                                                @endforelse
                                                @if(count($kamar->fasilitas ?? []) > 3)
                                                    <span class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 px-2 py-1 rounded">+{{ count($kamar->fasilitas) - 3 }} lagi</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $kamar->tersedia ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                                {{ $kamar->tersedia ? 'Tersedia' : 'Tidak Tersedia' }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-right">
                                            <div class="flex justify-end space-x-2">
                                                <a href="{{ route('admin.kamars.edit', $kamar) }}" 
                                                   class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.kamars.destroy', $kamar) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kamar ini?')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-4 px-6 text-center text-gray-500 dark:text-gray-400">
                                            Belum ada data kamar.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{-- {{ $kamars->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
