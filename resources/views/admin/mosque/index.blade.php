<x-admin-layout>
    <x-slot name="header">
        Master Data: Masjid
    </x-slot>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <div>
                <h2 class="text-lg font-bold text-brand-ink">Daftar Masjid</h2>
                <p class="text-sm text-brand-ink-soft">Kelola data masjid utama yang bisa dipilih oleh penyelenggara.</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('admin.mosque.create') }}" class="inline-flex items-center px-4 py-2 bg-brand-emerald-900 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-brand-emerald-950 transition">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Tambah Masjid
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Masjid / Lokasi</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($mosques as $mosque)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-brand-ink">{{ $mosque->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($mosque->address, 50) }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.mosque.edit', $mosque->id) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm font-medium rounded-md text-brand-ink bg-white hover:bg-gray-50 transition">
                                    <i data-lucide="edit" class="w-4 h-4 sm:mr-1.5"></i> <span class="hidden sm:inline">Edit</span>
                                </a>
                                <form action="{{ route('admin.mosque.destroy', $mosque->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus masjid ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-red-300 text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 transition">
                                        <i data-lucide="trash-2" class="w-4 h-4 sm:mr-1.5"></i> <span class="hidden sm:inline">Hapus</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">Belum ada data masjid.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($mosques->hasPages())
            <div class="p-4 border-t border-gray-200">
                {{ $mosques->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>



