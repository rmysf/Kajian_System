<x-admin-layout>
    <x-slot name="header">
        Tambah Pemateri Baru
    </x-slot>

    <div class="bg-white border border-brand-border-card rounded-xl max-w-3xl">
        <div class="p-6 border-b border-brand-border-card">
            <h2 class="text-lg font-bold text-brand-ink">Form Tambah Pemateri</h2>
            <p class="text-sm text-brand-ink-soft mt-1">Masukkan profil pemateri / ustadz baru ke dalam sistem.</p>
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
                            <x-admin.button variant="secondary" x-on:click.prevent="$refs.photoInput ? $refs.photoInput.click() : document.getElementById('photo').click()">
                                <i data-lucide="upload" class="w-4 h-4 mr-1.5"></i> Pilih Foto
                            </x-admin.button>
                            <p class="mt-2 text-xs text-brand-ink-soft">JPG, PNG atau GIF (Maks. 2MB)</p>
                            @error('photo')
                                <p class="mt-1 text-xs text-brand-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Nama -->
                <x-admin.input 
                    label="Nama Pemateri" 
                    :required="true" 
                    type="text" 
                    name="name" 
                    id="name" 
                    :value="old('name')" 
                    placeholder="Contoh: Ustadz Dr. Syafiq Riza Basalamah, M.A."
                    :error="$errors->first('name')" 
                />

                <!-- Deskripsi / Bio -->
                <x-admin.textarea 
                    label="Biografi / Deskripsi Singkat" 
                    name="description" 
                    id="description" 
                    :rows="4" 
                    placeholder="Tuliskan biografi singkat pemateri..."
                    :error="$errors->first('description')"
                >{{ old('description') }}</x-admin.textarea>
            </div>

            <div class="mt-8 pt-6 border-t border-brand-border-card flex flex-col sm:flex-row-reverse sm:justify-start gap-3">
                <x-admin.button variant="primary" type="submit">
                    Simpan Pemateri
                </x-admin.button>
                <x-admin.button variant="secondary" :href="route('admin.speaker.index')">
                    Batal
                </x-admin.button>
            </div>
        </form>
    </div>

    <!-- Alpine Component for Image Preview -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('photoPreview', () => ({
                imageUrl: null,
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
