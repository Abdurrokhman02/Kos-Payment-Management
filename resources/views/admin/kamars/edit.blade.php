<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Kamar') }} - {{ $kamar->nomor_kamar }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 space-y-6 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
                <!-- Back button -->
                <div class="mb-6">
                    <a href="{{ route('admin.kamars.index') }}" 
                       class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Kembali ke Daftar Kamar
                    </a>
                </div>

                <!-- Current Image Preview -->
                @if($kamar->gambar)
                    <div class="mb-6">
                        <x-input-label :value="__('Gambar Saat Ini')" />
                        <div class="mt-2">
                            <img src="{{ asset($kamar->gambar) }}" alt="Gambar Kamar {{ $kamar->nomor_kamar }}" class="h-48 w-full object-cover rounded-lg">
                        </div>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Kosongkan jika tidak ingin mengubah gambar.
                        </p>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('admin.kamars.update', $kamar) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nomor Kamar -->
                        <div>
                            <x-input-label for="nomor_kamar" :value="__('Nomor Kamar')" />
                            <x-text-input 
                                id="nomor_kamar"
                                name="nomor_kamar"
                                type="text"
                                class="block mt-1 w-full"
                                :value="old('nomor_kamar', $kamar->nomor_kamar)"
                                required
                                autofocus
                            />
                            <x-input-error :messages="$errors->get('nomor_kamar')" class="mt-2" />
                        </div>

                        <!-- Lantai -->
                        <div>
                            <x-input-label for="lantai" :value="__('Lantai')" />
                            <select 
                                id="lantai" 
                                name="lantai"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required
                            >
                                <option value="" disabled>Pilih Lantai</option>
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ old('lantai', $kamar->lantai) == $i ? 'selected' : '' }}>Lantai {{ $i }}</option>
                                @endfor
                            </select>
                            <x-input-error :messages="$errors->get('lantai')" class="mt-2" />
                        </div>

                        <!-- Harga -->
                        <div>
                            <x-input-label for="harga" :value="__('Harga per Bulan')" />
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input 
                                    type="number" 
                                    name="harga" 
                                    id="harga" 
                                    value="{{ old('harga', $kamar->harga) }}"
                                    class="block w-full pl-10 pr-12 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    placeholder="0.00"
                                    required
                                >
                            </div>
                            <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                        </div>

                        <!-- Status Ketersediaan -->
                        <div class="flex items-center">
                            <div class="flex items-center h-5">
                                <input 
                                    id="tersedia" 
                                    name="tersedia" 
                                    type="checkbox" 
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                    {{ old('tersedia', $kamar->tersedia) ? 'checked' : '' }}
                                >
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="tersedia" class="font-medium text-gray-700 dark:text-gray-300">Kamar Tersedia</label>
                                <p class="text-gray-500 dark:text-gray-400">Centang jika kamar tersedia untuk disewa</p>
                            </div>
                        </div>

                        <!-- Upload Gambar -->
                        <div class="md:col-span-2">
                            <x-input-label for="gambar" :value="__('Ganti Gambar (Opsional)')" />
                            <div class="mt-1">
                                <input 
                                    id="gambar" 
                                    name="gambar" 
                                    type="file" 
                                    class="block w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-md file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-indigo-50 file:text-indigo-700
                                        hover:file:bg-indigo-100"
                                    accept="image/*"
                                >
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Format: PNG, JPG, GIF (Maks. 2MB)
                                    @if($kamar->gambar)
                                    <br>Kosongkan jika tidak ingin mengubah gambar.
                                    @endif
                                </p>
                            </div>
                            <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                        </div>

                        <!-- Fasilitas -->
                        <div class="md:col-span-2">
                            <x-input-label :value="__('Fasilitas Kamar')" />
                            <div class="mt-2 space-y-2">
                                @php
                                    $commonFacilities = [
                                        'AC', 'Kamar Mandi Dalam', 'Dapur', 'Tempat Tidur', 'Lemari', 'Meja Kerja',
                                        'Kursi', 'Kipas Angin', 'TV', 'Kulkas', 'Dispenser', 'WiFi', 'Air Hangat',
                                        'Dapur Bersama', 'Laundry', 'Parkir Motor', 'Parkir Mobil', 'CCTV', 'Security 24 Jam'
                                    ];
                                    
                                    $existingFacilities = old('fasilitas', $kamar->fasilitas ?? []);
                                    $customFacilities = array_diff($existingFacilities, $commonFacilities);
                                @endphp
                                
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
                                    @foreach($commonFacilities as $facility)
                                        <div class="flex items-center">
                                            <input 
                                                id="facility-{{ $loop->index }}" 
                                                name="fasilitas[]" 
                                                type="checkbox" 
                                                value="{{ $facility }}"
                                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                                {{ in_array($facility, $existingFacilities) ? 'checked' : '' }}
                                            >
                                            <label for="facility-{{ $loop->index }}" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                                {{ $facility }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <!-- Custom Facilities Display -->
                                @if(count($customFacilities) > 0)
                                    <div class="mt-4">
                                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Fasilitas Tambahan:</p>
                                        <div class="flex flex-wrap gap-2" id="existing-custom-facilities">
                                            @foreach($customFacilities as $index => $facility)
                                                <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                                    {{ $facility }}
                                                    <button type="button" class="ml-1.5 inline-flex items-center justify-center h-4 w-4 rounded-full text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 dark:hover:bg-indigo-800 dark:hover:text-indigo-300 remove-facility">
                                                        <span class="sr-only">Hapus fasilitas</span>
                                                        <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                                                            <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                                                        </svg>
                                                    </button>
                                                    <input type="hidden" name="fasilitas[]" value="{{ $facility }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Custom Facility Input -->
                                <div class="mt-4">
                                    <div class="flex">
                                        <input
                                            type="text"
                                            id="custom-facility"
                                            class="block w-full rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            placeholder="Tambah fasilitas lainnya..."
                                        >
                                        <button 
                                            type="button" 
                                            id="add-facility" 
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-r-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        >
                                            Tambah
                                        </button>
                                    </div>
                                    <div id="custom-facilities" class="mt-2 flex flex-wrap gap-2">
                                        <!-- New custom facilities will be added here -->
                                    </div>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('fasilitas')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-8">
                        <button type="button" 
                                onclick="if(confirm('Apakah Anda yakin ingin menghapus kamar ini?')) { document.getElementById('delete-form').submit(); }"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Hapus Kamar
                        </button>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.kamars.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md font-medium text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Delete Form -->
                <form id="delete-form" action="{{ route('admin.kamars.destroy', $kamar) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const customFacilityInput = document.getElementById('custom-facility');
            const addFacilityBtn = document.getElementById('add-facility');
            const customFacilitiesContainer = document.getElementById('custom-facilities');
            const hiddenInputsContainer = document.createElement('div');
            document.querySelector('form').appendChild(hiddenInputsContainer);

            // Handle removal of existing custom facilities
            document.querySelectorAll('.remove-facility').forEach(button => {
                button.addEventListener('click', function() {
                    this.parentElement.remove();
                });
            });

            // Add facility from input
            addFacilityBtn.addEventListener('click', function() {
                const facilityName = customFacilityInput.value.trim();
                if (facilityName) {
                    addFacility(facilityName);
                    customFacilityInput.value = '';
                }
            });

            // Add facility on Enter key
            customFacilityInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const facilityName = customFacilityInput.value.trim();
                    if (facilityName) {
                        addFacility(facilityName);
                        customFacilityInput.value = '';
                    }
                }
            });

            function addFacility(name) {
                const facilityId = 'facility-custom-' + Date.now();
                
                // Create hidden input
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'fasilitas[]';
                hiddenInput.value = name;
                hiddenInput.id = facilityId + '-input';
                
                // Create visual badge
                const badge = document.createElement('div');
                badge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200';
                badge.innerHTML = `
                    ${name}
                    <button type="button" class="ml-1.5 inline-flex items-center justify-center h-4 w-4 rounded-full text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 dark:hover:bg-indigo-800 dark:hover:text-indigo-300" data-facility-name="${name}">
                        <span class="sr-only">Hapus fasilitas</span>
                        <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                            <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                        </svg>
                    </button>
                `;
                
                // Add remove functionality
                const removeBtn = badge.querySelector('button');
                removeBtn.addEventListener('click', function() {
                    badge.remove();
                    hiddenInput.remove();
                });
                
                // Add to DOM
                customFacilitiesContainer.appendChild(badge);
                hiddenInputsContainer.appendChild(hiddenInput);
                
                // Trigger change event on form for validation
                const event = new Event('change', { bubbles: true });
                hiddenInput.dispatchEvent(event);
            }

            // Add any new custom facilities from validation errors that aren't already displayed
            @if(old('fasilitas') && count(old('fasilitas')) > 0)
                @foreach(old('fasilitas') as $facility)
                    @if(!in_array($facility, $commonFacilities) && !in_array($facility, $customFacilities))
                        addFacility('{{ $facility }}');
                    @endif
                @endforeach
            @endif
        });
    </script>
    @endpush
</x-app-layout>
