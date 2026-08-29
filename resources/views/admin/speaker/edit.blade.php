<x-admin-layout>
    <x-slot name="header">
        Edit Data Pemateri
    </x-slot>

    <div class="bg-white border border-brand-border-card rounded-2xl shadow-sm overflow-hidden mb-8">
        <form action="{{ route('admin.speaker.update', $speaker->id) }}" method="POST" enctype="multipart/form-data" class="p-8" x-data="photoPreview('{{ $speaker->photo ? Storage::url($speaker->photo) : '' }}')">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <!-- KIRI: Foto Profil -->
                <div>
                    <div>
                        <label class="block text-sm font-medium text-brand-ink mb-4">Foto Profil</label>
                        <div class="flex items-center space-x-6">
                            <div class="flex-shrink-0 w-32 h-32 rounded-full bg-brand-cream border border-brand-border-light flex items-center justify-center overflow-hidden shadow-sm">
                                <template x-if="imageUrl">
                                    <img :src="imageUrl" class="w-full h-full object-cover" alt="Preview" />
                                </template>
                                <template x-if="!imageUrl">
                                    <i data-lucide="user" class="w-10 h-10 text-brand-nav-inactive"></i>
                                </template>
                            </div>
                            <div>
                                <input type="file" name="photo" id="photo" accept="image/*" class="sr-only" @change="fileChosen">
                                <x-admin.button variant="secondary" x-on:click.prevent="document.getElementById('photo').click()">
                                    <i data-lucide="upload" class="w-4 h-4 mr-1.5"></i> Ubah Foto
                                </x-admin.button>
                                <p class="mt-2 text-xs text-brand-ink-soft">JPG, PNG atau GIF (Maks. 2MB). Kosongkan jika tak diubah.</p>
                                @error('photo')
                                    <p class="mt-1 text-xs text-brand-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KANAN: Informasi Personal -->
                <div class="space-y-6">
                    <!-- Nama -->
                    <x-admin.input 
                        label="Nama Pemateri" 
                        :required="true" 
                        type="text" 
                        name="name" 
                        id="name" 
                        :value="old('name', $speaker->name)" 
                        :error="$errors->first('name')" 
                    />

                    <!-- Deskripsi / Bio -->
                    <x-admin.textarea 
                        label="Biografi / Deskripsi Singkat" 
                        name="description" 
                        id="description" 
                        :rows="5" 
                        :error="$errors->first('description')"
                    >{{ old('description', $speaker->description) }}</x-admin.textarea>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-10 pt-6 border-t border-gray-100 flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-4 gap-3 sm:gap-0">
                <x-admin.button variant="secondary" :href="route('admin.speaker.index')">
                    Batal
                </x-admin.button>
                <x-admin.button variant="primary" type="submit">
                    Simpan Perubahan
                </x-admin.button>
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
