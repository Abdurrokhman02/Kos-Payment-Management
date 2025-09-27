<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 via-gray-200 to-gray-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full p-8 space-y-8 backdrop-blur-xl bg-white/80 dark:bg-gray-800/70 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 transform hover:scale-[1.02] transition-all duration-300 animate-fade-in">
            
            <!-- Title -->
            <div class="text-center">
                <h2 class="text-4xl font-extrabold text-gray-900 dark:text-gray-100">
                    Masuk ke Akunmu
                </h2>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Kelola pembayaran kos dengan mudah dan cepat.
                </p>
            </div>

            <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

            <!-- Form -->
            <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" value="{{ __('Email') }}" />
                    <x-text-input id="email" 
                        class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" value="{{ __('Password') }}" />
                    <x-text-input id="password" 
                        class="block mt-1 w-full px-4 py-3 bg-gray-50/80 border border-gray-300 rounded-xl focus:border-sunshine focus:ring-sunshine shadow-sm transition duration-300"
                        type="password"
                        name="password"
                        required 
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me + Forgot Password -->
                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-sunshine shadow-sm focus:ring-sunshine" name="remember">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Ingat saya') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm font-medium text-sunshine hover:underline transition" href="{{ route('password.request') }}">
                            {{ __('Lupa password?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                        class="group relative w-full flex justify-center py-3 px-4 text-base font-semibold rounded-xl text-white bg-sunshine shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-300">
                        {{ __('Masuk') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Fade-in Animation -->
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
