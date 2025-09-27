<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
             <div class="p-8 space-y-6 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
                
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">
                        Tambah User (Penyewa Kos)
                    </h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Masukkan data penyewa kos baru.
                    </p>
                </div>

                <form class="mt-8 space-y-6" method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <div>
                        <x-input-label for="name" value="{{ __('Nama') }}" />
                        <x-text-input id="name" 
                            class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300"
                            type="text" 
                            name="name" 
                            :value="old('name')" 
                            required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" value="{{ __('Email') }}" />
                        <x-text-input id="email" 
                            class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300"
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    
                    <div>
                        <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                        <x-select id="jenis_kelamin" name="jenis_kelamin" class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300" required>
                            <option value="" disabled selected>{{ __('Pilih Jenis Kelamin') }}</option>
                            <option value="Laki-laki" @if (old('jenis_kelamin') == 'Laki-laki') selected @endif>{{ __('Laki-laki') }}</option>
                            <option value="Perempuan" @if (old('jenis_kelamin') == 'Perempuan') selected @endif>{{ __('Perempuan') }}</option>
                        </x-select>
                        <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
                    </div>

                    <!-- Nomor Kamar (FIXED: Menggunakan x-select) -->
                    <div>
                        <x-input-label for="nomor_kamar" :value="__('Nomor Kamar')" />
                        <x-select id="nomor_kamar" name="nomor_kamar" class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300" required>
                            <option value="" disabled selected>{{ __('Pilih Nomor Kamar') }}</option>
                            @foreach (range(1, 10) as $kamar)
                                <option value="K{{ $kamar }}" @if (old('nomor_kamar') == 'K' . $kamar) selected @endif>{{ __('Kamar') }} K{{ $kamar }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('nomor_kamar')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="nomor_telepon" :value="__('Nomor Telepon')" />
                        <x-text-input id="nomor_telepon" class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300" 
                        type="text" name="nomor_telepon" :value="old('nomor_telepon')" required />
                        <x-input-error :messages="$errors->get('nomor_telepon')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="alamat_asal" :value="__('Alamat Asal')" />
                        <x-text-input id="alamat_asal" class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300" 
                        type="text" name="alamat_asal" :value="old('alamat_asal')" required />
                        <x-input-error :messages="$errors->get('alamat_asal')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="nomor_darurat" :value="__('Nomor Darurat')" />
                        <x-text-input id="nomor_darurat" class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300" 
                        type="text" name="nomor_darurat" :value="old('nomor_darurat')" required />
                        <x-input-error :messages="$errors->get('nomor_darurat')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" value="{{ __('Password') }}" />
                        <x-text-input id="password" 
                            class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" />
                        <x-text-input id="password_confirmation" 
                            class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300"
                            type="password"
                            name="password_confirmation"
                            required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <button type="submit" 
                            class="group relative py-3 px-6 text-base font-semibold rounded-xl text-white bg-sunshine shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-300">
                            {{ __('Tambahkan User') }}
                            
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>