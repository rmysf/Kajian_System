<x-organizer-layout>
    <x-slot name="header">
        Profil Penyelenggara
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        @if (session('status') === 'profile-updated')
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="bg-brand-emerald-100 border border-brand-emerald-400 text-brand-emerald-700 px-4 py-3 rounded-lg relative" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">Profil berhasil diperbarui.</span>
            </div>
        @endif

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-bold text-brand-ink">Profil Grup Penyelenggara</h2>
                <p class="text-sm text-brand-ink-soft">Informasi publik mengenai grup/organisasi penyelenggara kajian Anda.</p>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('organizer.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Logo Grup (Opsional)</label>
                            <div class="mt-3 flex items-center gap-x-4">
                                @if($organizer->logo)
                                    <img src="{{ asset('storage/' . $organizer->logo) }}" alt="Logo" class="h-20 w-20 object-cover rounded-full bg-gray-50 border border-gray-200 shadow-sm">
                                @else
                                    <div class="h-20 w-20 rounded-full bg-gray-100 flex items-center justify-center border border-gray-200 shadow-sm">
                                        <i data-lucide="image" class="h-8 w-8 text-gray-300"></i>
                                    </div>
                                @endif
                                <input type="file" name="organizer_logo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-brand-emerald-50 file:text-brand-emerald-700 hover:file:bg-brand-emerald-100 transition">
                            </div>
                            @error('organizer_logo') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="organizer_name" class="block text-sm font-medium text-gray-700">Nama Penyelenggara <span class="text-red-500">*</span></label>
                            <input type="text" name="organizer_name" id="organizer_name" value="{{ old('organizer_name', $organizer->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-emerald-500 focus:ring-brand-emerald-500 sm:text-sm transition" required>
                            @error('organizer_name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="organizer_phone" class="block text-sm font-medium text-gray-700">No HP / WhatsApp (Opsional)</label>
                            <input type="text" name="organizer_phone" id="organizer_phone" value="{{ old('organizer_phone', $organizer->phone) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-emerald-500 focus:ring-brand-emerald-500 sm:text-sm transition">
                            @error('organizer_phone') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="organizer_description" class="block text-sm font-medium text-gray-700">Deskripsi Singkat (Opsional)</label>
                            <textarea id="organizer_description" name="organizer_description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-emerald-500 focus:ring-brand-emerald-500 sm:text-sm transition">{{ old('organizer_description', $organizer->description) }}</textarea>
                            @error('organizer_description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end rounded-b-xl">
                <button type="submit" class="inline-flex justify-center rounded-lg border border-transparent bg-brand-emerald-900 py-2 px-6 text-sm font-medium text-white shadow-sm hover:bg-brand-emerald-950 focus:outline-none focus:ring-2 focus:ring-brand-emerald-500 focus:ring-offset-2 transition">
                    Simpan Perubahan
                </button>
                </form>
            </div>
        </div>
    </div>
</x-organizer-layout>
