<x-organizer-layout>
    <x-slot name="header">
        Dashboard Penyelenggara
    </x-slot>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
        <x-admin.stat-card label="Kajian Aktif" :value="$kajianAktif ?? 0" icon="radio" />
        <x-admin.stat-card label="Kajian Bulan Ini" :value="$kajianBulanIni ?? 0" icon="calendar" />
        <x-admin.stat-card label="Total Calon Peserta" :value="$calonPeserta ?? 0" icon="users" />
        <x-admin.stat-card label="Peserta Hadir (All-time)" :value="$pesertaHadir ?? 0" icon="user-check" variant="warning" />
    </div>

    <!-- Langkah Selanjutnya -->
    <div class="mt-8 p-6 bg-white border border-brand-border-card rounded-xl">
        <h2 class="text-lg font-bold text-brand-ink mb-4">Langkah Selanjutnya</h2>
        <div class="space-y-3">
            <a href="{{ route('organizer.kajian.create') }}" class="flex items-center justify-between p-4 border border-brand-border-card rounded-lg hover:border-brand-emerald-300 transition group">
                <div class="flex items-center">
                    <div class="p-2 bg-brand-emerald-100 text-brand-emerald-900 rounded-lg mr-4">
                        <i data-lucide="plus" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-brand-ink">Buat Kajian Baru</p>
                        <p class="text-sm text-brand-ink-soft">Jadwalkan kajian Anda agar dapat dilihat jamaah.</p>
                    </div>
                </div>
                <i data-lucide="chevron-right" class="w-5 h-5 text-brand-nav-inactive group-hover:text-brand-emerald-900 transition"></i>
            </a>
            
            <a href="{{ route('organizer.mosque.index') }}" class="flex items-center justify-between p-4 border border-brand-border-card rounded-lg hover:border-brand-emerald-300 transition group">
                <div class="flex items-center">
                    <div class="p-2 bg-brand-emerald-100 text-brand-emerald-900 rounded-lg mr-4">
                        <i data-lucide="map-pin" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-brand-ink">Kelola Lokasi Masjid</p>
                        <p class="text-sm text-brand-ink-soft">Tambahkan atau perbarui data masjid tempat kajian Anda.</p>
                    </div>
                </div>
                <i data-lucide="chevron-right" class="w-5 h-5 text-brand-nav-inactive group-hover:text-brand-emerald-900 transition"></i>
            </a>
        </div>
    </div>
</x-organizer-layout>
