<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 space-y-6 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">

                <!-- Judul -->
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">
                        Tambah User (Penyewa Kos)
                    </h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Masukkan data penyewa kos baru.
                    </p>
                </div>

                <!-- Form -->
                <form class="mt-8 space-y-6" method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <!-- Nama -->
                    <div>
                        <x-input-label for="name" value="{{ __('Nama') }}" />
                        <x-text-input 
                            id="name"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            autofocus
                            autocomplete="name"
                            class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl 
                                   focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300"
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" value="{{ __('Email') }}" />
                        <x-text-input 
                            id="email"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autocomplete="username"
                            class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl 
                                   focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    
                    <!-- Jenis Kelamin -->
                    <div>
                        <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                        <select 
                            id="jenis_kelamin"
                            name="jenis_kelamin"
                            required
                            class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl 
                                   focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300 
                                   dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600"
                        >
                            <option value="" disabled selected>Pilih jenis kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
                    </div>

                    <!-- Nomor Kamar -->
                    <div>
                        <x-input-label for="nomor_kamar" :value="__('Nomor Kamar')" />
                        <select 
                            id="nomor_kamar"
                            name="nomor_kamar"
                            required
                            class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl 
                                   focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300 
                                   dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600"
                        >
                            <option value="" disabled selected>Pilih kamar yang tersedia</option>
                            @forelse ($kamarKosong as $nomorKamar)
                                <option value="{{ $nomorKamar }}">{{ $nomorKamar }}</option>
                            @empty
                                <option value="" disabled>Semua kamar sudah terisi</option>
                            @endforelse
                        </select>
                        <x-input-error :messages="$errors->get('nomor_kamar')" class="mt-2" />
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <x-input-label for="nomor_telepon" :value="__('Nomor Telepon')" />
                        <x-text-input 
                            id="nomor_telepon"
                            type="text"
                            name="nomor_telepon"
                            :value="old('nomor_telepon')"
                            required
                            class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl 
                                   focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300"
                        />
                        <x-input-error :messages="$errors->get('nomor_telepon')" class="mt-2" />
                    </div>

                    <!-- Alamat Asal -->
                    <div>
                        <x-input-label for="alamat_asal" :value="__('Alamat Asal')" />
                        <x-text-input 
                            id="alamat_asal"
                            type="text"
                            name="alamat_asal"
                            :value="old('alamat_asal')"
                            required
                            class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl 
                                   focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300"
                        />
                        <x-input-error :messages="$errors->get('alamat_asal')" class="mt-2" />
                    </div>

                    <!-- Nomor Darurat -->
                    <div>
                        <x-input-label for="nomor_darurat" :value="__('Nomor Darurat')" />
                        <x-text-input 
                            id="nomor_darurat"
                            type="text"
                            name="nomor_darurat"
                            :value="old('nomor_darurat')"
                            required
                            class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl 
                                   focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300"
                        />
                        <x-input-error :messages="$errors->get('nomor_darurat')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" value="{{ __('Password') }}" />
                        <x-text-input 
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl 
                                   focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <x-input-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" />
                        <x-text-input 
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl 
                                   focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300"
                        />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Submiót -->
                    <div class="flex items-center justify-end mt-6">
                        <button 
                            type="submit"
                            class="group relative py-3 px-6 text-base font-semibold rounded-xl text-white bg-sunshine 
                                   shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-300"
                        >
                            {{ __('Tambahkan Penghuni') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
