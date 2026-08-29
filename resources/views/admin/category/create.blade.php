<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('admin.category.index') }}" class="mr-4 text-gray-400 hover:text-gray-600">
                <i data-lucide="arrow-left" class="w-6 h-6"></i>
            </a>
            Tambah Kategori
        </div>
    </x-slot>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm max-w-3xl">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-bold text-brand-ink">Form Tambah Kategori</h2>
            <p class="text-sm text-brand-ink-soft">Masukkan nama kategori kajian yang baru.</p>
        </div>

        <form action="{{ route('admin.category.store') }}" method="POST" class="p-6 sm:p-8">
            @csrf

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-brand-ink mb-1">Nama Kategori <span class="text-brand-danger">*</span></label>
                <input type="text" name="name" id="name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-emerald-900 focus:ring focus:ring-brand-emerald-900 focus:ring-opacity-50" required value="{{ old('name') }}">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-4 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.category.index') }}" class="mt-3 sm:mt-0 px-6 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-brand-ink bg-white hover:bg-gray-50 focus:outline-none text-center transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-brand-emerald-900 hover:bg-brand-emerald-950 focus:outline-none focus:ring-2 focus:ring-brand-emerald-900 focus:ring-offset-2 text-center transition">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>

