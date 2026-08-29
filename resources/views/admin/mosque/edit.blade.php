<x-admin-layout>
    <x-slot name="header">
        Edit Data Masjid
    </x-slot>

    <form action="{{ route('admin.mosque.update', $mosque->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white border border-brand-border-card rounded-2xl shadow-sm overflow-hidden mb-8">
            <div class="p-8">
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <!-- KIRI: Informasi Utama -->
                    <div>

                        
                        <div class="space-y-5">
                            <div>
                                <x-admin.input 
                                    label="Nama Masjid" 
                                    :required="true" 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    :value="old('name', $mosque->name)" 
                                    placeholder="Contoh: Masjid Raya Bintaro Jaya"
                                    :error="$errors->first('name')" 
                                />
                            </div>

                            <div x-data="{ fileName: '', dragOver: false }">
                                <label class="block text-sm font-medium text-brand-ink mb-2">Foto Masjid</label>
                                
                                @if($mosque->photo)
                                    <div class="mb-4">
                                        <p class="text-xs text-brand-ink-soft mb-2">Foto saat ini:</p>
                                        <img src="{{ asset('storage/' . $mosque->photo) }}" alt="Foto Masjid" class="w-full max-w-xs h-40 object-cover rounded-xl shadow-sm border border-brand-border-light">
                                    </div>
                                @endif

                                <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-brand-emerald-900 transition-colors"
                                    :class="{ 'border-brand-emerald-900 bg-brand-emerald-900/5': dragOver }"
                                    @dragover.prevent="dragOver = true"
                                    @dragleave.prevent="dragOver = false"
                                    @drop.prevent="dragOver = false; $refs.photoInput.files = $event.dataTransfer.files; fileName = $refs.photoInput.files[0].name"
                                >
                                    <input type="file" name="photo" id="photo" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" x-ref="photoInput" @change="fileName = $event.target.files[0].name">
                                    <i data-lucide="image" class="w-10 h-10 mx-auto text-gray-400 mb-3"></i>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-semibold text-brand-emerald-900">Pilih file</span> atau drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                                    <p class="text-sm font-medium text-brand-emerald-900 mt-2" x-show="fileName" x-text="fileName" x-cloak></p>
                                </div>
                                @error('photo') <p class="text-brand-danger text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- KANAN: Lokasi & Peta -->
                    <div>

                        
                        <div class="space-y-5">
                            <div>
                                <x-admin.textarea 
                                    label="Alamat Lengkap" 
                                    :required="true"
                                    name="address" 
                                    id="address" 
                                    :rows="4" 
                                    placeholder="Masukkan alamat lengkap masjid..."
                                    :error="$errors->first('address')"
                                >{{ old('address', $mosque->address) }}</x-admin.textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-admin.input 
                                        label="Latitude" 
                                        :required="true" 
                                        type="text" 
                                        name="latitude" 
                                        id="latitude" 
                                        :value="old('latitude', $mosque->latitude)" 
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
                                        :value="old('longitude', $mosque->longitude)" 
                                        :error="$errors->first('longitude')" 
                                    />
                                </div>
                            </div>

                            <div>
                                <x-admin.input 
                                    label="Link Google Maps (Opsional)" 
                                    type="url" 
                                    name="google_maps_url" 
                                    id="google_maps_url" 
                                    :value="old('google_maps_url', $mosque->google_maps_url)" 
                                    placeholder="https://maps.google.com/..."
                                    :error="$errors->first('google_maps_url')" 
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-10 pt-6 border-t border-gray-100 flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-4 gap-3 sm:gap-0">
                    <x-admin.button variant="secondary" :href="route('admin.mosque.index')">
                        Batal
                    </x-admin.button>
                    <x-admin.button variant="primary" type="submit">
                        Simpan Perubahan
                    </x-admin.button>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
