{{-- Dipakai untuk Create & Edit. Jika $kajian ada → mode Edit --}}
@props(['kajian' => null, 'categories', 'mosques', 'speakers'])

@php
    $isEdit = !is_null($kajian);
    $action = $isEdit ? route('organizer.kajian.update', $kajian) : route('organizer.kajian.store');
    $v = fn($field, $default = '') => old($field, $isEdit ? ($kajian->$field ?? $default) : $default);
@endphp

<div x-data="{
    isFree: {{ $v('is_free', true) ? 'true' : 'false' }},
    posterUrl: '{{ ($isEdit && $kajian->poster) ? Storage::url($kajian->poster) : '' }}',
    setPoster(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => this.posterUrl = e.target.result;
            reader.readAsDataURL(file);
        }
    }
}">
<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if($isEdit) @method('PUT') @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left column --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Card: Info Dasar --}}
            <div class="bg-white rounded-2xl border border-[var(--border-card)] shadow-sm p-5">
                <h3 class="text-sm font-semibold text-[var(--ink)] mb-4">Informasi Dasar</h3>
                <div class="space-y-4">
                    {{-- Judul --}}
                    <div>
                        <label class="block text-sm font-medium text-[var(--ink)] mb-1.5">Judul Kajian <span class="text-[var(--danger)]">*</span></label>
                        <input type="text" name="title" value="{{ $v('title') }}" required placeholder="Contoh: Kajian Tauhid: Mengenal Asmaul Husna"
                               class="w-full px-3.5 py-2.5 text-sm rounded-xl border @error('title') border-[var(--danger)] @else border-[var(--border-light)] @enderror bg-white focus:outline-none focus:ring-2 focus:ring-[var(--emerald-500)] transition">
                        @error('title') <p class="mt-1.5 text-xs text-[var(--danger)]">{{ $message }}</p> @enderror
                    </div>

                    {{-- Kategori & Pemateri --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-[var(--ink)] mb-1.5">Kategori <span class="text-[var(--danger)]">*</span></label>
                            <select name="category_id" required class="w-full px-3.5 py-2.5 text-sm rounded-xl border @error('category_id') border-[var(--danger)] @else border-[var(--border-light)] @enderror bg-white focus:outline-none focus:ring-2 focus:ring-[var(--emerald-500)]">
                                <option value="">— Pilih Kategori —</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $v('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="mt-1.5 text-xs text-[var(--danger)]">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[var(--ink)] mb-1.5">Pemateri <span class="text-[var(--danger)]">*</span></label>
                            <select name="speaker_id" required class="w-full px-3.5 py-2.5 text-sm rounded-xl border @error('speaker_id') border-[var(--danger)] @else border-[var(--border-light)] @enderror bg-white focus:outline-none focus:ring-2 focus:ring-[var(--emerald-500)]">
                                <option value="">— Pilih Pemateri —</option>
                                @foreach($speakers as $sp)
                                    <option value="{{ $sp->id }}" {{ $v('speaker_id') == $sp->id ? 'selected' : '' }}>{{ $sp->name }}</option>
                                @endforeach
                            </select>
                            @error('speaker_id') <p class="mt-1.5 text-xs text-[var(--danger)]">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-sm font-medium text-[var(--ink)] mb-1.5">Deskripsi Kajian</label>
                        <textarea name="description" rows="4" placeholder="Tuliskan deskripsi singkat kajian..."
                                  class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-[var(--border-light)] bg-white focus:outline-none focus:ring-2 focus:ring-[var(--emerald-500)] transition resize-none">{{ $v('description') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Card: Waktu --}}
            <div class="bg-white rounded-2xl border border-[var(--border-card)] shadow-sm p-5">
                <h3 class="text-sm font-semibold text-[var(--ink)] mb-4">Waktu Pelaksanaan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-[var(--ink)] mb-1.5">Mulai <span class="text-[var(--danger)]">*</span></label>
                        <input type="datetime-local" name="start_at"
                               value="{{ $isEdit ? $kajian->start_at?->format('Y-m-d\TH:i') : old('start_at') }}"
                               class="w-full px-3.5 py-2.5 text-sm rounded-xl border @error('start_at') border-[var(--danger)] @else border-[var(--border-light)] @enderror bg-white focus:outline-none focus:ring-2 focus:ring-[var(--emerald-500)]">
                        @error('start_at') <p class="mt-1.5 text-xs text-[var(--danger)]">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[var(--ink)] mb-1.5">Selesai <span class="text-[var(--danger)]">*</span></label>
                        <input type="datetime-local" name="end_at"
                               value="{{ $isEdit ? $kajian->end_at?->format('Y-m-d\TH:i') : old('end_at') }}"
                               class="w-full px-3.5 py-2.5 text-sm rounded-xl border @error('end_at') border-[var(--danger)] @else border-[var(--border-light)] @enderror bg-white focus:outline-none focus:ring-2 focus:ring-[var(--emerald-500)]">
                        @error('end_at') <p class="mt-1.5 text-xs text-[var(--danger)]">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Card: Lokasi --}}
            <div class="bg-white rounded-2xl border border-[var(--border-card)] shadow-sm p-5">
                <h3 class="text-sm font-semibold text-[var(--ink)] mb-4">Lokasi</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-[var(--ink)] mb-1.5">Masjid / Tempat <span class="text-[var(--danger)]">*</span></label>
                        <select name="mosque_id" required class="w-full px-3.5 py-2.5 text-sm rounded-xl border @error('mosque_id') border-[var(--danger)] @else border-[var(--border-light)] @enderror bg-white focus:outline-none focus:ring-2 focus:ring-[var(--emerald-500)]">
                            <option value="">— Pilih Masjid —</option>
                            @foreach($mosques as $mosque)
                                <option value="{{ $mosque->id }}" {{ $v('mosque_id') == $mosque->id ? 'selected' : '' }}>{{ $mosque->name }}</option>
                            @endforeach
                        </select>
                        @error('mosque_id') <p class="mt-1.5 text-xs text-[var(--danger)]">{{ $message }}</p> @enderror
                        <a href="{{ route('organizer.mosque.create') }}" class="inline-flex items-center gap-1 mt-2 text-xs font-medium text-[var(--emerald-600)] hover:text-[var(--emerald-900)]">
                            <i data-lucide="plus" class="w-3 h-3"></i> Daftarkan Masjid Baru
                        </a>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[var(--ink)] mb-1.5">Alamat Lengkap <span class="text-[var(--danger)]">*</span></label>
                        <textarea name="address" rows="2" placeholder="Jl. Contoh No. 1, Kel. Contoh, Kec. Contoh, Kota..."
                                  class="w-full px-3.5 py-2.5 text-sm rounded-xl border @error('address') border-[var(--danger)] @else border-[var(--border-light)] @enderror bg-white focus:outline-none focus:ring-2 focus:ring-[var(--emerald-500)] resize-none">{{ $v('address') }}</textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-[var(--ink)] mb-1.5">Latitude</label>
                            <input type="number" step="any" name="latitude" value="{{ $v('latitude') }}" placeholder="-7.123456"
                                   class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-[var(--border-light)] bg-white focus:outline-none focus:ring-2 focus:ring-[var(--emerald-500)]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[var(--ink)] mb-1.5">Longitude</label>
                            <input type="number" step="any" name="longitude" value="{{ $v('longitude') }}" placeholder="110.456789"
                                   class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-[var(--border-light)] bg-white focus:outline-none focus:ring-2 focus:ring-[var(--emerald-500)]">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right column --}}
        <div class="space-y-5">

            {{-- Card: Poster --}}
            <div class="bg-white rounded-2xl border border-[var(--border-card)] shadow-sm p-5">
                <h3 class="text-sm font-semibold text-[var(--ink)] mb-4">Poster Kajian</h3>
                <div class="relative group cursor-pointer" @click="$refs.posterInput.click()">
                    <div class="w-full aspect-[3/4] rounded-xl border-2 border-dashed border-[var(--border-light)] group-hover:border-[var(--emerald-500)] transition-colors bg-[var(--cream)] flex items-center justify-center overflow-hidden">
                        <template x-if="posterUrl">
                            <img :src="posterUrl" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!posterUrl">
                            <div class="flex flex-col items-center gap-2 text-[var(--nav-inactive)]">
                                <i data-lucide="image-plus" class="w-8 h-8"></i>
                                <p class="text-xs font-medium text-center px-4">Klik untuk memilih gambar</p>
                                <p class="text-[11px] text-center px-4">JPG, PNG, WEBP (Maks. 2MB)</p>
                            </div>
                        </template>
                    </div>
                    <div x-show="posterUrl" class="absolute inset-0 rounded-xl bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <span class="text-white text-xs font-semibold">Ganti Poster</span>
                    </div>
                </div>
                <input type="file" name="poster" x-ref="posterInput" accept="image/*" @change="setPoster($event)" class="sr-only">
            </div>

            {{-- Card: Pengaturan --}}
            <div class="bg-white rounded-2xl border border-[var(--border-card)] shadow-sm p-5">
                <h3 class="text-sm font-semibold text-[var(--ink)] mb-4">Pengaturan</h3>
                <div class="space-y-4">
                    {{-- Audience --}}
                    <div>
                        <label class="block text-sm font-medium text-[var(--ink)] mb-2">Target Jamaah <span class="text-[var(--danger)]">*</span></label>
                        <div class="flex rounded-xl border border-[var(--border-light)] overflow-hidden text-sm font-medium">
                            @foreach(['umum' => 'Umum', 'ikhwan' => 'Ikhwan', 'akhwat' => 'Akhwat'] as $val => $lbl)
                            <label class="flex-1 text-center cursor-pointer">
                                <input type="radio" name="audience" value="{{ $val }}" class="sr-only peer" {{ $v('audience', 'umum') === $val ? 'checked' : '' }}>
                                <span class="block py-2 text-[var(--ink-soft)] peer-checked:bg-[var(--emerald-900)] peer-checked:text-white transition-colors">{{ $lbl }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Ramah Keluarga --}}
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-[var(--ink)]">Ramah Keluarga</p>
                            <p class="text-xs text-[var(--ink-soft)]">Cocok untuk anak-anak</p>
                        </div>
                        <label class="relative cursor-pointer">
                            <input type="checkbox" name="is_family_friendly" class="sr-only peer" {{ $v('is_family_friendly', false) ? 'checked' : '' }}>
                            <div class="w-10 h-6 rounded-full bg-[var(--border-light)] peer-checked:bg-[var(--emerald-600)] transition-colors"></div>
                            <div class="absolute top-1 left-1 w-4 h-4 rounded-full bg-white shadow transition-transform peer-checked:translate-x-4"></div>
                        </label>
                    </div>

                    {{-- Biaya --}}
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <p class="text-sm font-medium text-[var(--ink)]">Biaya</p>
                            </div>
                            <label class="relative cursor-pointer">
                                <input type="checkbox" name="is_free" class="sr-only peer" x-model="isFree" {{ $v('is_free', true) ? 'checked' : '' }}>
                                <div class="w-10 h-6 rounded-full bg-[var(--border-light)] peer-checked:bg-[var(--emerald-600)] transition-colors"></div>
                                <div class="absolute top-1 left-1 w-4 h-4 rounded-full bg-white shadow transition-transform peer-checked:translate-x-4"></div>
                            </label>
                        </div>
                        <p class="text-xs text-[var(--ink-soft)] mb-2" x-text="isFree ? 'Kajian ini GRATIS' : 'Kajian berbayar'"></p>
                        <div x-show="!isFree" x-transition>
                            <input type="number" step="500" name="price" value="{{ $v('price', 0) }}" placeholder="Harga dalam rupiah"
                                   class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-[var(--border-light)] bg-white focus:outline-none focus:ring-2 focus:ring-[var(--emerald-500)]">
                        </div>
                    </div>

                    {{-- Kuota --}}
                    <div>
                        <label class="block text-sm font-medium text-[var(--ink)] mb-1.5">Kuota Peserta</label>
                        <input type="number" name="quota" value="{{ $v('quota') }}" placeholder="Kosongkan = tidak terbatas"
                               class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-[var(--border-light)] bg-white focus:outline-none focus:ring-2 focus:ring-[var(--emerald-500)]">
                    </div>
                </div>
            </div>

            {{-- Submit Buttons --}}
            <div class="space-y-2">
                <button type="submit" name="status" value="published"
                        class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl text-sm font-semibold bg-[var(--emerald-900)] text-white hover:bg-[var(--emerald-950)] transition-colors shadow-sm">
                    <i data-lucide="send" class="w-4 h-4"></i> {{ $isEdit ? 'Simpan & Publikasikan' : 'Publikasikan Kajian' }}
                </button>
                <button type="submit" name="status" value="draft"
                        class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl text-sm font-semibold bg-white text-[var(--ink)] border border-[var(--border-light)] hover:bg-[var(--cream)] transition-colors">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan sebagai Draft
                </button>
                <a href="{{ route('organizer.kajian.index') }}"
                   class="w-full flex items-center justify-center py-2.5 text-sm text-[var(--ink-soft)] hover:text-[var(--ink)] transition-colors">
                    Batal
                </a>
            </div>
        </div>
    </div>
</form>
</div>
