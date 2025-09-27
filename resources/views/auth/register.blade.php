<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-clean dark:bg-gray-900 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full p-8 space-y-6 backdrop-blur-xl bg-white/80 dark:bg-gray-800/70 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 transform hover:scale-[1.02] transition-all duration-300 animate-fade-in">
            
            <!-- Judul -->
            <div class="text-center">
                <h2 class="text-4xl font-extrabold text-gray-900 dark:text-gray-100">
                    Daftar Akun Baru
                </h2>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Gabung dan mulai kelola kos dengan mudah.
                </p>
            </div>

            <!-- Form -->
            <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama -->
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

                <!-- Email -->
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

                <!-- Password -->
                <div>
                    <x-input-label for="password" value="{{ __('Password') }}" />
                    <x-text-input id="password" 
                        class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300"
                        type="password"
                        name="password"
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <x-input-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" />
                    <x-text-input id="password_confirmation" 
                        class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300"
                        type="password"
                        name="password_confirmation"
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Aksi -->
                <div class="flex items-center justify-between mt-6">
                    <a class="text-sm font-medium text-sunshine hover:underline transition" href="{{ route('login') }}">
                        {{ __('Sudah terdaftar? Masuk') }}
                    </a>

                    <button type="submit" 
                        class="group relative py-3 px-6 text-base font-semibold rounded-xl text-white bg-sunshine shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-300">
                        {{ __('Daftar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.6s ease-out forwards;
        }
    </style>
</x-guest-layout>
