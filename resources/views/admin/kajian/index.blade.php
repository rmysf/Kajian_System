<x-admin-layout>
    <x-slot name="header">
        Moderasi Kajian
    </x-slot>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-bold text-brand-ink">Moderasi Kajian Masuk</h2>
            <p class="text-sm text-brand-ink-soft">Tinjau dan verifikasi kajian baru yang dikirimkan oleh penyelenggara.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Judul & Penyelenggara</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Waktu</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Status Verifikasi</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Dummy Data 1 -->
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-medium text-brand-ink">Fiqih Muamalah Dasar</div>
                            <div class="text-sm text-brand-ink-soft mt-1">Oleh: Yayasan Dakwah Islam</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-brand-ink">28 Agu 2026</div>
                            <div class="text-xs text-brand-ink-soft mt-1">19:30 - 21:00</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brand-gold-soft text-brand-gold-text">Menunggu</span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <button type="button" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-brand-emerald-900 hover:bg-brand-emerald-950 transition">
                                <i data-lucide="check" class="w-4 h-4 sm:mr-1.5"></i>
                                <span class="hidden sm:inline">Setujui</span>
                            </button>
                            <button type="button" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-brand-danger hover:bg-red-700 transition">
                                <i data-lucide="x" class="w-4 h-4 sm:mr-1.5"></i>
                                <span class="hidden sm:inline">Tolak</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
