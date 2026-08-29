<x-admin-layout>
    <x-slot name="header">
        Master Data: Masjid
    </x-slot>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
        <div class="p-6 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div>
                <h2 class="text-lg font-bold text-brand-ink">Daftar Masjid</h2>
                <p class="text-sm text-brand-ink-soft">Kelola data masjid utama yang bisa dipilih oleh penyelenggara.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Nama Masjid</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-brand-ink">Masjid Istiqlal</td>
                        <td class="px-6 py-4 text-sm text-gray-500">Jakarta Pusat</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <button class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm font-medium rounded-md text-brand-ink bg-white hover:bg-gray-50 transition">
                                <i data-lucide="edit" class="w-4 h-4 sm:mr-1.5"></i> <span class="hidden sm:inline">Edit</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
