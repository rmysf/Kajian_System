<x-organizer-layout>
    <x-slot name="header">
        Dashboard Penyelenggara
    </x-slot>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
        
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-brand-ink-soft">Kajian Aktif</p>
                    <p class="text-3xl font-bold text-brand-ink mt-1">{{ $kajianAktif ?? 0 }}</p>
                </div>
                <div class="p-3 bg-brand-emerald-100 text-brand-emerald-900 rounded-lg">
                    <i data-lucide="radio" class="w-6 h-6"></i>
                </div>
            </div>
        </div>

        
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-brand-ink-soft">Kajian Bulan Ini</p>
                    <p class="text-3xl font-bold text-brand-ink mt-1">{{ $kajianBulanIni ?? 0 }}</p>
                </div>
                <div class="p-3 bg-brand-emerald-100 text-brand-emerald-900 rounded-lg">
                    <i data-lucide="calendar" class="w-6 h-6"></i>
                </div>
            </div>
        </div>

        
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-brand-ink-soft">Total Calon Peserta</p>
                    <p class="text-3xl font-bold text-brand-ink mt-1">{{ $calonPeserta ?? 0 }}</p>
                </div>
                <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                    <i data-lucide="users" class="w-6 h-6"></i>
                </div>
            </div>
        </div>

        
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-brand-ink-soft">Peserta Hadir (All-time)</p>
                    <p class="text-3xl font-bold text-brand-ink mt-1">{{ $pesertaHadir ?? 0 }}</p>
                </div>
                <div class="p-3 bg-brand-gold-soft text-brand-gold-text rounded-lg">
                    <i data-lucide="user-check" class="w-6 h-6"></i>
                </div>
            </div>
        </div>
    </div>

    
    <div class="mt-8 p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
        <h2 class="text-lg font-bold text-brand-ink mb-4">Langkah Selanjutnya</h2>
        <div class="space-y-4">
            <a href="{{ route('organizer.kajian.create') }}" class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-brand-emerald-900 hover:shadow-sm transition">
                <div class="flex items-center">
                    <div class="p-2 bg-brand-emerald-100 text-brand-emerald-900 rounded-md mr-4">
                        <i data-lucide="plus" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-brand-ink">Buat Kajian Baru</p>
                        <p class="text-sm text-brand-ink-soft">Jadwalkan kajian Anda agar dapat dilihat jamaah.</p>
                    </div>
                </div>
                <i data-lucide="chevron-right" class="w-5 h-5 text-gray-400"></i>
            </a>
            
            <a href="{{ route('organizer.mosque.index') }}" class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-brand-emerald-900 hover:shadow-sm transition">
                <div class="flex items-center">
                    <div class="p-2 bg-gray-100 text-gray-600 rounded-md mr-4">
                        <i data-lucide="map-pin" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-brand-ink">Kelola Lokasi Masjid</p>
                        <p class="text-sm text-brand-ink-soft">Tambahkan atau perbarui data masjid tempat kajian Anda.</p>
                    </div>
                </div>
                <i data-lucide="chevron-right" class="w-5 h-5 text-gray-400"></i>
            </a>
        </div>
    </div>
</x-organizer-layout>

