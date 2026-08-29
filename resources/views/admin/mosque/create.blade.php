<x-admin-layout>
    <x-slot name="header">
        Tambah Masjid Baru
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            <form action="{{ route('admin.mosque.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8">
                @csrf

                <div class="mb-8 border-b border-brand-border-card pb-8">
                    <h3 class="text-lg font-semibold text-brand-ink mb-4 flex items-center">
                        <i data-lucide="info" class="w-5 h-5 mr-2 text-brand-emerald-900"></i> Informasi Masjid
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <x-admin.input 
                                label="Nama Masjid" 
                                :required="true" 
                                type="text" 
                                name="name" 
                                id="name" 
                                :value="old('name')" 
                                placeholder="Contoh: Masjid Raya Istiqlal"
                                :error="$errors->first('name')" 
                            />
                        </div>

                        <div class="md:col-span-2">
                            <label for="photo" class="block text-sm font-medium text-brand-ink mb-1">Foto Masjid</label>
                            <input type="file" name="photo" id="photo" accept="image/*" class="w-full rounded-lg border-brand-border-light shadow-sm focus:border-brand-emerald-900 focus:ring-brand-emerald-900 text-sm">
                            <p class="text-xs text-brand-ink-soft mt-1">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                            @error('photo') <p class="text-brand-danger text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <x-admin.textarea 
                                label="Alamat Lengkap" 
                                :required="true"
                                name="address" 
                                id="address" 
                                :rows="3" 
                                placeholder="Masukkan alamat lengkap masjid..."
                                :error="$errors->first('address')"
                            >{{ old('address') }}</x-admin.textarea>
                        </div>

                        <div>
                            <x-admin.input 
                                label="Latitude" 
                                :required="true" 
                                type="text" 
                                name="latitude" 
                                id="latitude" 
                                :value="old('latitude', '-6.200000')" 
                                :error="$errors->first('latitude')" 
                            />
                        </div>
                        <div>
                            <x-admin.input 
                                label="Longitude" 
                                :required="true" 
                                type="text" 
                                name="longitude" 
                                id="longitude" 
                                :value="old('longitude', '106.816666')" 
                                :error="$errors->first('longitude')" 
                            />
                        </div>

                        <div class="md:col-span-2">
                            <x-admin.input 
                                label="Link Google Maps (Opsional)" 
                                type="url" 
                                name="google_maps_url" 
                                id="google_maps_url" 
                                :value="old('google_maps_url')" 
                                placeholder="https://maps.google.com/..."
                                :error="$errors->first('google_maps_url')" 
                            />
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <x-admin.button variant="secondary" :href="route('admin.mosque.index')">
                        Batal
                    </x-admin.button>
                    <x-admin.button variant="primary" type="submit">
                        Simpan Masjid
                    </x-admin.button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
