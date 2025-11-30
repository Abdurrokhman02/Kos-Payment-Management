<?php
/**
 * View ini diakses oleh Admin untuk melihat daftar penyewa.
 * Variabel $users datang dari App\Http\Controllers\Admin\UserController@index
 */
?>
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Daftar Penyewa Kos') }}
            </h2>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-sunshine border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sunshine/80 transition duration-150 ease-in-out">
                {{ __('+ Tambah Penyewa Baru') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Search Form -->
                    <div class="mb-6">
                        <form action="{{ route('admin.users.index') }}" method="GET">
                            <div class="flex items-center">
                                <div class="relative flex-1">
                                    <input 
                                        type="text" 
                                        name="search" 
                                        value="{{ request('search') }}" 
                                        placeholder="Cari nama, email, nomor kamar, atau telepon..." 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900"
                                    >
                                </div>
                                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-r-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                                @if(request('search'))
                                    <a href="{{ route('admin.users.index') }}" class="ml-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            @php
                                                $sortDirection = $sortBy === 'name' && $sortDirection === 'asc' ? 'desc' : 'asc';
                                                $isSortedByName = $sortBy === 'name';
                                            @endphp
                                            <a href="?sort_by=name&sort={{ $sortDirection }}{{ request('search') ? '&search='.request('search') : '' }}" class="flex items-center hover:text-indigo-600">
                                                Nama
                                                @if($isSortedByName)
                                                    <span class="ml-1">
                                                        @if($sortDirection === 'desc')
                                                            <i class="fas fa-sort-up"></i>
                                                        @else
                                                            <i class="fas fa-sort-down"></i>
                                                        @endif
                                                    </span>
                                                @else
                                                    <i class="fas fa-sort ml-1 text-gray-400"></i>
                                                @endif
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            @php
                                                $sortDirection = $sortBy === 'email' && $sortDirection === 'asc' ? 'desc' : 'asc';
                                                $isSortedByEmail = $sortBy === 'email';
                                            @endphp
                                            <a href="?sort_by=email&sort={{ $sortDirection }}{{ request('search') ? '&search='.request('search') : '' }}" class="flex items-center hover:text-indigo-600">
                                                Email
                                                @if($isSortedByEmail)
                                                    <span class="ml-1">
                                                        @if($sortDirection === 'desc')
                                                            <i class="fas fa-sort-up"></i>
                                                        @else
                                                            <i class="fas fa-sort-down"></i>
                                                        @endif
                                                    </span>
                                                @else
                                                    <i class="fas fa-sort ml-1 text-gray-400"></i>
                                                @endif
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            @php
                                                $sortDirection = $sortBy === 'nomor_kamar' && $sortDirection === 'asc' ? 'desc' : 'asc';
                                                $isSortedByRoom = $sortBy === 'nomor_kamar';
                                            @endphp
                                            <a href="?sort_by=nomor_kamar&sort={{ $sortDirection }}{{ request('search') ? '&search='.request('search') : '' }}" class="flex items-center hover:text-indigo-600">
                                                No. Kamar
                                                @if($isSortedByRoom)
                                                    <span class="ml-1">
                                                        @if($sortDirection === 'desc')
                                                            <i class="fas fa-sort-up"></i>
                                                        @else
                                                            <i class="fas fa-sort-down"></i>
                                                        @endif
                                                    </span>
                                                @else
                                                    <i class="fas fa-sort ml-1 text-gray-400"></i>
                                                @endif
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            @php
                                                $sortDirection = $sortBy === 'nomor_telepon' && $sortDirection === 'asc' ? 'desc' : 'asc';
                                                $isSortedByPhone = $sortBy === 'nomor_telepon';
                                            @endphp
                                            <a href="?sort_by=nomor_telepon&sort={{ $sortDirection }}{{ request('search') ? '&search='.request('search') : '' }}" class="flex items-center hover:text-indigo-600">
                                                No. HP
                                                @if($isSortedByPhone)
                                                    <span class="ml-1">
                                                        @if($sortDirection === 'desc')
                                                            <i class="fas fa-sort-up"></i>
                                                        @else
                                                            <i class="fas fa-sort-down"></i>
                                                        @endif
                                                    </span>
                                                @else
                                                    <i class="fas fa-sort ml-1 text-gray-400"></i>
                                                @endif
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            @php
                                                $sortDirection = $sortBy === 'created_at' && $sortDirection === 'asc' ? 'desc' : 'asc';
                                                $isSortedByDate = $sortBy === 'created_at';
                                            @endphp
                                            <a href="?sort_by=created_at&sort={{ $sortDirection }}{{ request('search') ? '&search='.request('search') : '' }}" class="flex items-center hover:text-indigo-600">
                                                Terdaftar Sejak
                                                @if($isSortedByDate)
                                                    <span class="ml-1">
                                                        @if($sortDirection === 'desc')
                                                            <i class="fas fa-sort-up"></i>
                                                        @else
                                                            <i class="fas fa-sort-down"></i>
                                                        @endif
                                                    </span>
                                                @else
                                                    <i class="fas fa-sort ml-1 text-gray-400"></i>
                                                @endif
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Status Pembayaran
                                    </th>  
                                    <th scope="col" class="px-14 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $user->nomor_kamar }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $user->nomor_telepon }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($user->payment_status == 'Lunas')
                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                                Lunas
                                            </span>
                                        @elseif ($user->payment_status == 'Belum Lunas')
                                            <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full">
                                                Belum Lunas
                                            </span>
                                        @elseif ($user->payment_status == 'Menunggu')
                                            <span class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full">
                                                Menunggu
                                            </span>
                                        @else
                                            <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full">
                                                -
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-12 py-4">
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus penghuni ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <!-- Pagination -->
                        @if($users->hasPages())
                            <div class="mt-4">
                                {{ $users->links() }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
