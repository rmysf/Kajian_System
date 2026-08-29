<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('admin.mosque.index') }}" class="mr-4 text-gray-400 hover:text-gray-600">
                <i data-lucide="arrow-left" class="w-6 h-6"></i>
            </a>
            Edit Masjid
        </div>
    </x-slot>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm max-w-3xl">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-bold text-brand-ink">Form Edit Masjid</h2>
            <p class="text-sm text-brand-ink-soft">Perbarui informasi masjid.</p>
        </div>

        <form action="{{ route('admin.mosque.update', $mosque->id) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-brand-ink mb-1">Masjid / Lokasi <span class="text-brand-danger">*</span></label>
                    <input type="text" name="name" id="name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-emerald-900 focus:ring focus:ring-brand-emerald-900 focus:ring-opacity-50" required value="{{ old('name', $mosque->name) }}">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-brand-ink mb-1">Alamat Lengkap <span class="text-brand-danger">*</span></label>
                    <textarea name="address" id="address" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-emerald-900 focus:ring focus:ring-brand-emerald-900 focus:ring-opacity-50" required>{{ old('address', $mosque->address) }}</textarea>
                    @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                
                <div>
                    <label for="latitude" class="block text-sm font-medium text-brand-ink mb-1">Latitude <span class="text-brand-danger">*</span></label>
                    <input type="text" name="latitude" id="latitude" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-emerald-900 focus:ring focus:ring-brand-emerald-900 focus:ring-opacity-50" required value="{{ old('latitude', $mosque->latitude) }}">
                    @error('latitude') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="longitude" class="block text-sm font-medium text-brand-ink mb-1">Longitude <span class="text-brand-danger">*</span></label>
                    <input type="text" name="longitude" id="longitude" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-emerald-900 focus:ring focus:ring-brand-emerald-900 focus:ring-opacity-50" required value="{{ old('longitude', $mosque->longitude) }}">
                    @error('longitude') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                
                <div class="md:col-span-2">
                    <label for="photo" class="block text-sm font-medium text-brand-ink mb-1">Foto Masjid (Opsional)</label>
                    
                    @if($mosque->photo)
                        <div class="mb-4">
                            <p class="text-xs text-gray-500 mb-2">Foto Saat Ini:</p>
                            <img src="{{ asset('storage/' . $mosque->photo) }}" alt="Foto {{ $mosque->name }}" class="h-32 w-auto rounded-lg border border-gray-200 object-cover">
                        </div>
                    @endif

                    <input type="file" name="photo" id="photo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-brand-emerald-50 file:text-brand-emerald-900 hover:file:bg-brand-emerald-100 transition">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG. Maks: 2MB. Biarkan kosong jika tidak ingin mengubah foto.</p>
                    @error('photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-4 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.mosque.index') }}" class="mt-3 sm:mt-0 px-6 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-brand-ink bg-white hover:bg-gray-50 focus:outline-none text-center transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-brand-emerald-900 hover:bg-brand-emerald-950 focus:outline-none focus:ring-2 focus:ring-brand-emerald-900 focus:ring-offset-2 text-center transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>



