<x-organizer-layout>
    <x-slot name="header">
        Tambah Kajian Baru
    </x-slot>

    <div class="w-full pb-12">
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 sm:p-8">
            <form action="{{ route('organizer.kajian.store') }}" method="POST" enctype="multipart/form-data" x-data="{ 
                date: '{{ old('date', '') }}', 
                startTime: '{{ old('start_time', '') }}', 
                endTime: '{{ old('end_time', '') }}',
                isFree: '{{ old('is_free', '1') }}'
            }">
                @csrf
                
                <!-- Hidden inputs to satisfy controller validation without changing backend -->
                <input type="hidden" name="start_at" :value="date && startTime ? date + ' ' + startTime + ':00' : ''">
                <input type="hidden" name="end_at" :value="date && endTime ? date + ' ' + endTime + ':00' : ''">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <!-- KIRI: Informasi Dasar -->
                    <div class="flex flex-col">
                        <h3 class="text-lg font-bold text-brand-ink mb-6 border-b border-gray-100 pb-3 flex items-center">
                            <i data-lucide="info" class="w-5 h-5 mr-2 text-brand-emerald-900"></i> Informasi Dasar
                        </h3>
                        
                        <div class="flex-1 flex flex-col">
                            <div class="mb-5">
                                <x-admin.input 
                                    label="Judul Kajian" 
                                    :required="true" 
                                    type="text" 
                                    name="title" 
                                    id="title" 
                                    :value="old('title')" 
                                    placeholder="Contoh: Fiqih Muamalah Kontemporer"
                                    :error="$errors->first('title')" 
                                />
                            </div>

                            <div class="mb-5 grid grid-cols-2 gap-4">
                                <div>
                                    <x-admin.select 
                                        label="Kategori" 
                                        :required="true" 
                                        name="category_id" 
                                        id="category_id" 
                                        :error="$errors->first('category_id')"
                                    >
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </x-admin.select>
                                </div>
                                <div>
                                    <x-admin.input 
                                        label="Pemateri" 
                                        :required="true" 
                                        type="text" 
                                        name="speaker_name" 
                                        id="speaker_name" 
                                        :value="old('speaker_name')" 
                                        placeholder="Contoh: Ustadz Fulan"
                                        :error="$errors->first('speaker_name')" 
                                    />
                                </div>
                            </div>

                            <div class="mb-5">
                                <label class="block text-sm font-medium text-brand-ink mb-1">Poster Kajian</label>
                                <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-brand-border-light border-dashed rounded-lg hover:border-brand-emerald-900 transition bg-gray-50">
                                    <div class="space-y-1 text-center flex flex-col items-center justify-center">
                                        <svg class="mx-auto h-10 w-10 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600 mt-2">
                                            <label for="poster" class="relative cursor-pointer rounded-md font-medium text-brand-emerald-900 hover:text-brand-emerald-700">
                                                <span>Pilih file</span>
                                                <input id="poster" name="poster" type="file" class="sr-only" accept="image/*">
                                            </label>
                                            <p class="pl-1 text-gray-500">atau drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                                    </div>
                                </div>
                                @error('poster') <p class="text-brand-danger text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="mt-auto">
                                <x-admin.textarea 
                                    label="Deskripsi / Detail Kajian" 
                                    name="description" 
                                    id="description" 
                                    :rows="5" 
                                    placeholder="Jelaskan secara singkat materi yang akan dibahas..."
                                    :error="$errors->first('description')"
                                >{{ old('description') }}</x-admin.textarea>
                            </div>
                        </div>
                    </div>

                    <!-- KANAN: Waktu & Lokasi -->
                    <div>
                        <h3 class="text-lg font-bold text-brand-ink mb-6 border-b border-gray-100 pb-3 flex items-center">
                            <i data-lucide="map-pin" class="w-5 h-5 mr-2 text-brand-emerald-900"></i> Waktu & Lokasi
                        </h3>
                        
                        <div class="space-y-5">
                            <div>
                                <x-admin.input 
                                    label="Tanggal" 
                                    :required="true" 
                                    type="text" 
                                    name="date" 
                                    id="date" 
                                    x-model="date"
                                    x-init="flatpickr($el, {dateFormat: 'Y-m-d'})"
                                    placeholder="Pilih Tanggal"
                                    :error="$errors->first('start_at')" 
                                />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-admin.input 
                                        label="Jam Mulai" 
                                        :required="true" 
                                        type="text" 
                                        name="start_time" 
                                        id="start_time" 
                                        x-model="startTime"
                                        x-init="flatpickr($el, {enableTime: true, noCalendar: true, dateFormat: 'H:i', time_24hr: true})"
                                        placeholder="00:00"
                                    />
                                </div>
                                <div>
                                    <x-admin.input 
                                        label="Jam Selesai" 
                                        :required="true" 
                                        type="text" 
                                        name="end_time" 
                                        id="end_time" 
                                        x-model="endTime"
                                        x-init="flatpickr($el, {enableTime: true, noCalendar: true, dateFormat: 'H:i', time_24hr: true})"
                                        placeholder="00:00"
                                        :error="$errors->first('end_at')" 
                                    />
                                </div>
                            </div>

                            <div>
                                <x-admin.input 
                                    label="Masjid / Lokasi" 
                                    :required="true" 
                                    type="text" 
                                    name="mosque_name" 
                                    id="mosque_name" 
                                    :value="old('mosque_name')" 
                                    placeholder="Contoh: Masjid Raya Bintaro Jaya"
                                    :error="$errors->first('mosque_name')" 
                                />
                            </div>

                            <div>
                                <x-admin.textarea 
                                    label="Alamat Lengkap / Catatan Rute" 
                                    :required="true"
                                    name="address" 
                                    id="address" 
                                    :rows="5" 
                                    placeholder="Alamat lengkap menuju lokasi..."
                                    :error="$errors->first('address')"
                                >{{ old('address') }}</x-admin.textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
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
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BAWAH: Audien & Tiket -->
                <div class="mt-10 pt-8 border-t border-gray-100">
                    <h3 class="text-lg font-bold text-brand-ink mb-6 pb-2 flex items-center">
                        <i data-lucide="users" class="w-5 h-5 mr-2 text-brand-emerald-900"></i> Audien & Tiket
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Kolom 1 -->
                        <div class="space-y-6">
                            <div>
                                <x-admin.select 
                                    label="Tipe Peserta" 
                                    :required="true" 
                                    name="audience" 
                                    id="audience" 
                                    :error="$errors->first('audience')"
                                >
                                    <option value="umum" {{ old('audience') == 'umum' ? 'selected' : '' }}>Umum (Ikhwan & Akhwat)</option>
                                    <option value="ikhwan" {{ old('audience') == 'ikhwan' ? 'selected' : '' }}>Khusus Ikhwan</option>
                                    <option value="akhwat" {{ old('audience') == 'akhwat' ? 'selected' : '' }}>Khusus Akhwat</option>
                                </x-admin.select>
                            </div>

                            <div>
                                <x-admin.input 
                                    label="Kuota Peserta" 
                                    type="number" 
                                    name="quota" 
                                    id="quota" 
                                    min="1" 
                                    :value="old('quota')" 
                                    placeholder="Kosongkan jika tak terbatas"
                                    :error="$errors->first('quota')" 
                                />
                            </div>
                        </div>
                        
                        <!-- Kolom 2 -->
                        <div class="space-y-6 md:ml-20">
                            <div>
                                <label class="block text-sm font-medium text-brand-ink mb-1">Ramah Keluarga</label>
                                <div class="flex items-center space-x-6 h-[42px] pt-1.5 pl-3">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" name="is_family_friendly" value="1" class="w-5 h-5 text-brand-emerald-900 border-gray-300 focus:ring-brand-emerald-900" {{ old('is_family_friendly', '1') == '1' ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-brand-ink">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" name="is_family_friendly" value="0" class="w-5 h-5 text-brand-emerald-900 border-gray-300 focus:ring-brand-emerald-900" {{ old('is_family_friendly') == '0' ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-brand-ink">Tidak</span>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-brand-ink mb-1">Biaya Tiket</label>
                                <div class="flex items-center space-x-4 h-[42px] pt-1.5 pl-3">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" name="is_free" value="1" x-model="isFree" class="w-5 h-5 text-brand-emerald-900 border-gray-300 focus:ring-brand-emerald-900">
                                        <span class="ml-2 text-sm text-brand-ink">Gratis</span>
                                    </label>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" name="is_free" value="0" x-model="isFree" class="w-5 h-5 text-brand-emerald-900 border-gray-300 focus:ring-brand-emerald-900">
                                        <span class="ml-2 text-sm text-brand-ink">Berbayar</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom 3 -->
                        <div class="space-y-6">
                            <div x-show="isFree === '0'" x-transition style="display: none;">
                                <label for="price" class="block text-sm font-medium text-brand-ink mb-1">Harga Tiket (Rp)</label>
                                <div class="relative rounded-lg shadow-sm border border-brand-border-light focus-within:border-brand-emerald-900 focus-within:ring-1 focus-within:ring-brand-emerald-900">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <span class="text-gray-500 font-medium">Rp</span>
                                    </div>
                                    <input type="number" name="price" id="price" class="block w-full rounded-lg border-0 pl-12 py-2.5 focus:ring-0 text-sm" placeholder="0" value="{{ old('price') }}">
                                </div>
                                @error('price') <p class="text-brand-danger text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-10 pt-6 border-t border-gray-100 flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-4 gap-3 sm:gap-0">
                    <x-admin.button variant="secondary" :href="route('organizer.kajian.index')">
                        Batal
                    </x-admin.button>
                    <x-admin.button variant="ghost" type="submit" name="status" value="draft">
                        Simpan Draft
                    </x-admin.button>
                    <x-admin.button variant="primary" type="submit" name="status" value="published">
                        Publikasikan Kajian
                    </x-admin.button>
                </div>
            </form>
        </div>
    </div>
</x-organizer-layout>









