<x-admin-layout>
    <x-slot name="header">
        Dashboard Admin
    </x-slot>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
        <!-- Card 1 -->
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-brand-ink-soft">Total Kajian</p>
                    <p class="text-3xl font-bold text-brand-ink mt-1">{{ $totalKajian ?? 0 }}</p>
                </div>
                <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                    <i data-lucide="book-open" class="w-6 h-6"></i>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-brand-ink-soft">Kajian Hari Ini</p>
                    <p class="text-3xl font-bold text-brand-ink mt-1">{{ $kajianHariIni ?? 0 }}</p>
                </div>
                <div class="p-3 bg-brand-gold-soft text-brand-gold-text rounded-lg">
                    <i data-lucide="calendar-clock" class="w-6 h-6"></i>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-brand-ink-soft">Total User Aktif</p>
                    <p class="text-3xl font-bold text-brand-ink mt-1">{{ $totalUser ?? 0 }}</p>
                </div>
                <div class="p-3 bg-brand-emerald-100 text-brand-emerald-900 rounded-lg">
                    <i data-lucide="users" class="w-6 h-6"></i>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-brand-ink-soft">Total Penyelenggara</p>
                    <p class="text-3xl font-bold text-brand-ink mt-1">{{ $totalOrganizer ?? 0 }}</p>
                </div>
                <div class="p-3 bg-purple-50 text-purple-600 rounded-lg">
                    <i data-lucide="building" class="w-6 h-6"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Alerts -->
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
            <h2 class="text-lg font-bold text-brand-ink mb-4 flex items-center">
                <i data-lucide="shield-alert" class="w-5 h-5 mr-2 text-brand-gold-text"></i> Perlu Moderasi
            </h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-100">
                    <div>
                        <p class="font-semibold text-sm text-brand-ink">5 Kajian Baru</p>
                        <p class="text-xs text-brand-ink-soft">Menunggu verifikasi untuk dipublikasikan</p>
                    </div>
                    <a href="{{ route('admin.kajian.index') }}" class="px-3 py-1.5 text-xs font-medium text-brand-emerald-900 border border-brand-emerald-900 rounded hover:bg-brand-emerald-100">Tinjau</a>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-100">
                    <div>
                        <p class="font-semibold text-sm text-brand-ink">2 Akun Penyelenggara</p>
                        <p class="text-xs text-brand-ink-soft">Menunggu verifikasi dokumen pengajuan</p>
                    </div>
                    <a href="{{ route('admin.organizer.index') }}" class="px-3 py-1.5 text-xs font-medium text-brand-emerald-900 border border-brand-emerald-900 rounded hover:bg-brand-emerald-100">Tinjau</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
