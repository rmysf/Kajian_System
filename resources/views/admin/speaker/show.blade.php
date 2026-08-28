<x-admin-layout>
    <x-slot name="header">
        Detail Pemateri
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.speaker.index') }}" class="inline-flex items-center text-sm font-medium text-brand-emerald-700 hover:text-brand-emerald-900 transition">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i> Kembali ke Daftar Pemateri
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm max-w-4xl overflow-hidden">
        <div class="md:flex">
            <!-- Bagian Kiri: Foto & Aksi -->
            <div class="md:w-1/3 bg-gray-50 border-r border-gray-200 p-8 flex flex-col items-center text-center">
                <div class="w-40 h-40 rounded-full border-4 border-white shadow-md overflow-hidden mb-4 bg-brand-cream flex items-center justify-center">
                    @if($speaker->photo)
                        <img src="{{ Storage::url($speaker->photo) }}" alt="{{ $speaker->name }}" class="w-full h-full object-cover">
                    @else
                        <i data-lucide="user" class="w-16 h-16 text-brand-nav-inactive"></i>
                    @endif
                </div>
                
                <h2 class="text-xl font-bold text-brand-ink mb-1">{{ $speaker->name }}</h2>
                <p class="text-xs text-brand-ink-soft mb-6">Ditambahkan pada: {{ $speaker->created_at->format('d M Y') }}</p>
                
                <div class="w-full space-y-2">
                    <a href="{{ route('admin.speaker.edit', $speaker->id) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-brand-emerald-900 text-sm font-medium rounded-lg text-brand-emerald-900 bg-white hover:bg-brand-emerald-50 focus:outline-none transition">
                        <i data-lucide="edit" class="w-4 h-4 mr-2"></i> Edit Profil
                    </a>
                </div>
            </div>

            <!-- Bagian Kanan: Detail Bio -->
            <div class="md:w-2/3 p-8">
                <h3 class="text-lg font-bold text-brand-ink mb-4 border-b border-gray-100 pb-2">Biografi / Deskripsi</h3>
                
                <div class="prose prose-sm max-w-none text-brand-ink-soft">
                    @if($speaker->description)
                        {!! nl2br(e($speaker->description)) !!}
                    @else
                        <p class="italic text-gray-400">Belum ada biografi atau deskripsi untuk pemateri ini.</p>
                    @endif
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <h3 class="text-sm font-bold text-brand-ink mb-3">Statistik Terkait</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100 flex items-center">
                            <div class="bg-brand-emerald-100 text-brand-emerald-700 p-2 rounded-lg mr-3">
                                <i data-lucide="book-open" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-xs text-brand-ink-soft">Total Kajian</p>
                                <p class="text-lg font-bold text-brand-ink">
                                    {{-- Menggunakan relasi jika ada, sementara statis --}}
                                    -
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
