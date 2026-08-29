<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('admin.speaker.index') }}" class="mr-4 text-gray-400 hover:text-gray-600">
                <i data-lucide="arrow-left" class="w-6 h-6"></i>
            </a>
            Tambah Pemateri
        </div>
    </x-slot>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm max-w-3xl">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-bold text-brand-ink">Form Tambah Pemateri</h2>
            <p class="text-sm text-brand-ink-soft">Masukkan profil pemateri / ustadz baru ke dalam sistem.</p>
        </div>

        <form action="{{ route('admin.speaker.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8">
            @csrf

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-brand-ink mb-1">Nama Pemateri / Ustadz <span class="text-brand-danger">*</span></label>
                <input type="text" name="name" id="name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-emerald-900 focus:ring focus:ring-brand-emerald-900 focus:ring-opacity-50" required value="{{ old('name') }}">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-brand-ink mb-2">Foto Profil (Opsional)</label>
                <div class="mt-1 flex items-center">
                    <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4 w-full">
                        <input type="file" id="photo" name="photo" class="hidden"
                                    x-ref="photo"
                                    x-on:change="
                                            photoName = $refs.photo.files[0].name;
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                photoPreview = e.target.result;
                                            };
                                            reader.readAsDataURL($refs.photo.files[0]);
                                    " />

                        <div class="flex items-center gap-4">
                            <!-- New Profile Photo Preview -->
                            <div class="mt-2" x-show="photoPreview" style="display: none;">
                                <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center border border-gray-200"
                                      x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                </span>
                            </div>

                            <!-- Placeholder when no photo is selected -->
                            <div class="mt-2" x-show="!photoPreview">
                                <div class="w-20 h-20 rounded-full border border-gray-300 bg-gray-100 flex items-center justify-center">
                                    <i data-lucide="user" class="w-8 h-8 text-gray-400"></i>
                                </div>
                            </div>

                            <button type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-brand-emerald-900 focus:ring focus:ring-brand-emerald-900 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition" x-on:click.prevent="$refs.photo.click()">
                                <i data-lucide="upload" class="w-4 h-4 mr-2"></i> Pilih Foto
                            </button>
                        </div>
                    </div>
                </div>
                @error('photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, GIF. Maksimal: 2MB.</p>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-brand-ink mb-1">Deskripsi / Biografi Singkat</label>
                <textarea name="description" id="description" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-emerald-900 focus:ring focus:ring-brand-emerald-900 focus:ring-opacity-50">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-4 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.speaker.index') }}" class="mt-3 sm:mt-0 px-6 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-brand-ink bg-white hover:bg-gray-50 focus:outline-none text-center transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-brand-emerald-900 hover:bg-brand-emerald-950 focus:outline-none focus:ring-2 focus:ring-brand-emerald-900 focus:ring-offset-2 text-center transition">
                    Simpan Pemateri
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
