<x-admin-layout>
    <x-slot name="header">
        Tambah Pemateri Baru
    </x-slot>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm max-w-3xl">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-bold text-brand-ink">Form Tambah Pemateri</h2>
            <p class="text-sm text-brand-ink-soft">Masukkan profil pemateri / ustadz baru ke dalam sistem.</p>
        </div>

        <form action="{{ route('admin.speaker.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8" x-data="photoPreview()">
            @csrf

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
                                <i data-lucide="upload" class="w-4 h-4 mr-2"></i> Pilih Foto
                            </label>
                            <p class="mt-2 text-xs text-brand-ink-soft">JPG, PNG atau GIF (Maks. 2MB)</p>
                            @error('photo')
                                <p class="mt-1 text-sm text-brand-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Nama -->
                <div>
                    <label for="name" class="block text-sm font-medium text-brand-ink mb-1">Nama Pemateri <span class="text-brand-danger">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full rounded-lg border-gray-300 focus:border-brand-emerald-500 focus:ring-brand-emerald-500 shadow-sm" required placeholder="Contoh: Ustadz Dr. Syafiq Riza Basalamah, M.A.">
                    @error('name')
                        <p class="mt-1 text-sm text-brand-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi / Bio -->
                <div>
                    <label for="description" class="block text-sm font-medium text-brand-ink mb-1">Biografi / Deskripsi Singkat</label>
                    <textarea name="description" id="description" rows="4" class="w-full rounded-lg border-gray-300 focus:border-brand-emerald-500 focus:ring-brand-emerald-500 shadow-sm" placeholder="Tuliskan biografi singkat pemateri...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-brand-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row-reverse sm:justify-start">
                <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-brand-emerald-900 hover:bg-brand-emerald-950 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-emerald-900 transition shadow-sm">
                    Simpan Pemateri
                </button>
        <div class="flex items-center">
            <a href="{{ route('admin.speaker.index') }}" class="mr-4 text-gray-400 hover:text-gray-600">
                <i data-lucide="arrow-left" class="w-6 h-6"></i>
            </a>
            Tambah Pemateri
        </div>
    </x-slot>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm max-w-3xl">
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

                            <button type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition" x-on:click.prevent="$refs.photo.click()">
                                Pilih Foto Baru
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
                <a href="{{ route('admin.speaker.index') }}" class="mt-3 sm:mt-0 px-6 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-brand-ink bg-white hover:bg-gray-50 focus:outline-none text-center">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-brand-emerald-900 hover:bg-brand-emerald-950 focus:outline-none text-center">
                    Simpan Pemateri
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
