<x-organizer-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('organizer.mosque.index') }}" class="mr-4 text-gray-400 hover:text-gray-600">
                <i data-lucide="arrow-left" class="w-6 h-6"></i>
            </a>
            Tambah Lokasi Masjid
        </div>
    </x-slot>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm max-w-4xl mx-auto">
        <form action="{{ route('organizer.mosque.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8">
            @csrf
            
            <div class="mb-8 border-b border-gray-200 pb-8">
                <h3 class="text-lg font-semibold text-brand-ink mb-4 flex items-center">
                    <i data-lucide="info" class="w-5 h-5 mr-2 text-brand-emerald-900"></i> Informasi Utama
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-brand-ink mb-1">Nama Masjid <span class="text-brand-danger">*</span></label>
                        <input type="text" name="name" id="name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-emerald-900 focus:ring focus:ring-brand-emerald-900 focus:ring-opacity-50" required placeholder="Contoh: Masjid Istiqlal" value="{{ old('name') }}">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="photo" class="block text-sm font-medium text-brand-ink mb-1">Foto Masjid</label>
                        <input type="file" name="photo" id="photo" accept="image/*" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-emerald-900 focus:ring focus:ring-brand-emerald-900 focus:ring-opacity-50 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-brand-emerald-50 file:text-brand-emerald-700 hover:file:bg-brand-emerald-100">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                        @error('photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-lg font-semibold text-brand-ink mb-4 flex items-center">
                    <i data-lucide="map-pin" class="w-5 h-5 mr-2 text-brand-emerald-900"></i> Alamat & Koordinat Peta
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-brand-ink mb-1">Alamat Lengkap <span class="text-brand-danger">*</span></label>
                        <textarea name="address" id="address" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-emerald-900 focus:ring focus:ring-brand-emerald-900 focus:ring-opacity-50" required placeholder="Tuliskan alamat lengkap masjid...">{{ old('address') }}</textarea>
                        @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="google_maps_url" class="block text-sm font-medium text-brand-ink mb-1">Link Google Maps (Opsional)</label>
                        <input type="url" name="google_maps_url" id="google_maps_url" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-emerald-900 focus:ring focus:ring-brand-emerald-900 focus:ring-opacity-50" placeholder="https://maps.google.com/..." value="{{ old('google_maps_url') }}">
                        @error('google_maps_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="latitude" class="block text-sm font-medium text-brand-ink mb-1">Garis Lintang (Latitude) <span class="text-brand-danger">*</span></label>
                        <input type="text" name="latitude" id="latitude" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-emerald-900 focus:ring focus:ring-brand-emerald-900 focus:ring-opacity-50" required placeholder="Contoh: -6.200000" value="{{ old('latitude') }}">
                        <p class="text-xs text-gray-500 mt-1">Anda bisa copy-paste dari Google Maps.</p>
                        @error('latitude') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <div>
                        <label for="longitude" class="block text-sm font-medium text-brand-ink mb-1">Garis Bujur (Longitude) <span class="text-brand-danger">*</span></label>
                        <input type="text" name="longitude" id="longitude" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-emerald-900 focus:ring focus:ring-brand-emerald-900 focus:ring-opacity-50" required placeholder="Contoh: 106.816666" value="{{ old('longitude') }}">
                        @error('longitude') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-5 border-t border-gray-200">
                <a href="{{ route('organizer.mosque.index') }}" class="mr-3 px-6 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none text-center">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-brand-emerald-900 hover:bg-brand-emerald-950 focus:outline-none text-center">
                    Simpan Masjid
                </button>
            </div>
        </form>
    </div>
</x-organizer-layout>
