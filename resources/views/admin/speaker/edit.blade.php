<x-admin-layout>
    <x-slot name="header">
        Edit Data Pemateri
    </x-slot>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm max-w-3xl">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-bold text-brand-ink">Form Edit Pemateri</h2>
            <p class="text-sm text-brand-ink-soft">Perbarui profil pemateri / ustadz.</p>
        </div>

        <form action="{{ route('admin.speaker.update', $speaker->id) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8" x-data="photoPreview('{{ $speaker->photo ? Storage::url($speaker->photo) : '' }}')">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Foto Profil -->
                <div>
                    <label class="block text-sm font-medium text-brand-ink mb-2">Foto Profil</label>
                    <div class="flex items-center space-x-6">
                        <div class="flex-shrink-0 w-24 h-24 rounded-full bg-brand-cream border border-brand-border-light flex items-center justify-center overflow-hidden">
                            <template x-if="imageUrl">
                                <img :src="imageUrl" class="w-full h-full object-cover" alt="Preview" />
                            </template>
                            <template x-if="!imageUrl">
                                <i data-lucide="user" class="w-8 h-8 text-brand-nav-inactive"></i>
                            </template>
                        </div>
                        <div>
                            <input type="file" name="photo" id="photo" accept="image/*" class="sr-only" @change="fileChosen">
                            <label for="photo" class="cursor-pointer inline-flex items-center px-4 py-2 border border-brand-border-light rounded-md shadow-sm text-sm font-medium text-brand-ink bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-emerald-900 transition">
                                <i data-lucide="upload" class="w-4 h-4 mr-2"></i> Ubah Foto
                            </label>
                            <p class="mt-2 text-xs text-brand-ink-soft">JPG, PNG atau GIF (Maks. 2MB). Kosongkan jika tidak ingin mengubah.</p>
                            @error('photo')
                                <p class="mt-1 text-sm text-brand-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Nama -->
                <div>
                    <label for="name" class="block text-sm font-medium text-brand-ink mb-1">Nama Pemateri <span class="text-brand-danger">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $speaker->name) }}" class="w-full rounded-lg border-gray-300 focus:border-brand-emerald-500 focus:ring-brand-emerald-500 shadow-sm" required>
                    @error('name')
                        <p class="mt-1 text-sm text-brand-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi / Bio -->
                <div>
                    <label for="description" class="block text-sm font-medium text-brand-ink mb-1">Biografi / Deskripsi Singkat</label>
                    <textarea name="description" id="description" rows="4" class="w-full rounded-lg border-gray-300 focus:border-brand-emerald-500 focus:ring-brand-emerald-500 shadow-sm">{{ old('description', $speaker->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-brand-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row-reverse sm:justify-start">
                <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-brand-emerald-900 hover:bg-brand-emerald-950 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-emerald-900 transition shadow-sm">
                    Simpan Perubahan
                </button>
        <div class="flex items-center">
            <a href="{{ route('admin.speaker.index') }}" class="mr-4 text-gray-400 hover:text-gray-600">
                <i data-lucide="arrow-left" class="w-6 h-6"></i>
            </a>
            Edit Pemateri
        </div>
    </x-slot>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm max-w-3xl">
        <form action="{{ route('admin.speaker.update', $speaker->id) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8" x-data="photoPreview('{{ $speaker->photo ? Storage::url($speaker->photo) : '' }}')">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-brand-ink mb-1">Nama Pemateri / Ustadz <span class="text-brand-danger">*</span></label>
                <input type="text" name="name" id="name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-emerald-900 focus:ring focus:ring-brand-emerald-900 focus:ring-opacity-50" required value="{{ old('name', $speaker->name) }}">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-brand-ink mb-2">Foto Profil (Opsional)</label>
                <div class="mt-1 flex items-center">
                    <div class="col-span-6 sm:col-span-4 w-full">
                        <input type="file" id="photo" name="photo" class="hidden"
                                    x-ref="photo"
                                    @change="fileChosen" />

                        <div class="flex items-center gap-4">
                            <!-- Current Profile Photo -->
                            <div class="mt-2" x-show="!imageUrl">
                                @if($speaker->photo)
                                    <img src="{{ Storage::url($speaker->photo) }}" alt="{{ $speaker->name }}" class="rounded-full h-20 w-20 object-cover border border-gray-200">
                                @else
                                    <div class="h-20 w-20 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold border border-gray-300 text-xl">
                                        {{ substr($speaker->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>

                            <!-- New Profile Photo Preview -->
                            <div class="mt-2" x-show="imageUrl" style="display: none;">
                                <img :src="imageUrl" class="rounded-full w-20 h-20 object-cover border border-gray-200">
                            </div>

                            <button type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition" x-on:click.prevent="$refs.photo.click()">
                                Pilih Foto Baru
                            </button>
                        </div>
                    </div>
                </div>
                @error('photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                <p class="text-xs text-gray-500 mt-2">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, PNG, GIF. Maksimal: 2MB.</p>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-brand-ink mb-1">Deskripsi / Biografi Singkat</label>
                <textarea name="description" id="description" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-emerald-900 focus:ring focus:ring-brand-emerald-900 focus:ring-opacity-50">{{ old('description', $speaker->description) }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-4 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.speaker.index') }}" class="mt-3 sm:mt-0 px-6 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-brand-ink bg-white hover:bg-gray-50 focus:outline-none text-center">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-brand-emerald-900 hover:bg-brand-emerald-950 focus:outline-none text-center">
                    Perbarui Pemateri
                </button>
            </div>
        </form>
    </div>

    <!-- Alpine Component for Image Preview -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('photoPreview', (initialUrl) => ({
                imageUrl: initialUrl,
                fileChosen(event) {
                    this.fileToDataUrl(event, src => this.imageUrl = src)
                },
                fileToDataUrl(event, callback) {
                    if (! event.target.files.length) return
                    let file = event.target.files[0],
                        reader = new FileReader()
                    reader.readAsDataURL(file)
                    reader.onload = e => callback(e.target.result)
                },
            }))
        })
    </script>
</x-admin-layout>
