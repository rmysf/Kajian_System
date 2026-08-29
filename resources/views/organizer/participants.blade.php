<x-organizer-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('organizer.kajian.index') }}" class="mr-4 text-gray-400 hover:text-gray-600">
                <i data-lucide="arrow-left" class="w-6 h-6"></i>
            </a>
            Kelola Peserta Kajian
        </div>
    </x-slot>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
        <div class="p-6 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div>
                <h2 class="text-lg font-bold text-brand-ink">Daftar Peserta</h2>
                <p class="text-sm text-brand-ink-soft">Melihat daftar jamaah yang mendaftar dan hadir pada kajian ini.</p>
            </div>
            <div class="mt-4 sm:mt-0 flex space-x-2">
                <button type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-sm font-medium rounded-lg text-brand-ink hover:bg-gray-50 transition">
                    <i data-lucide="download" class="w-4 h-4 mr-2"></i> Export Data
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Nama Peserta</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Waktu Daftar</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Status Kehadiran</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-medium text-brand-ink">Ahmad Fulan</div>
                            <div class="text-sm text-brand-ink-soft mt-1">Laki-laki</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-brand-ink">ahmad@example.com</div>
                            <div class="text-xs text-brand-ink-soft mt-1">081234567890</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-brand-ink">
                            {{ now()->subDays(2)->format('d M Y H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brand-gold-soft text-brand-gold-text">Belum Hadir</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button type="button" class="inline-flex items-center px-3 py-1.5 border border-brand-emerald-900 text-sm font-medium rounded-md text-white bg-brand-emerald-900 hover:bg-brand-emerald-950 transition">
                                <i data-lucide="check-circle" class="w-4 h-4 sm:mr-1.5"></i>
                                <span class="hidden sm:inline">Check In</span>
                            </button>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-medium text-brand-ink">Fatimah Zahra</div>
                            <div class="text-sm text-brand-ink-soft mt-1">Perempuan</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-brand-ink">fatimah@example.com</div>
                            <div class="text-xs text-brand-ink-soft mt-1">081298765432</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-brand-ink">
                            {{ now()->subDays(3)->format('d M Y H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brand-emerald-100 text-brand-emerald-950">Hadir</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button type="button" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm font-medium rounded-md text-brand-ink bg-white hover:bg-gray-50 transition" disabled>
                                <i data-lucide="check" class="w-4 h-4 sm:mr-1.5 text-brand-emerald-900"></i>
                                <span class="hidden sm:inline">Selesai</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-organizer-layout>

