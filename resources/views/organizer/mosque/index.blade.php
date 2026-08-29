<x-organizer-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                Kelola Lokasi Masjid
            </div>
            <a href="{{ route('organizer.mosque.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-brand-emerald-900 hover:bg-brand-emerald-950 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-emerald-900 transition">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                Tambah Masjid
            </a>
        </div>
    </x-slot>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Info Masjid</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Alamat & Titik Peta</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($mosques as $mosque)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                                        @if($mosque->photo)
                                            <img src="{{ asset('storage/'.$mosque->photo) }}" class="h-12 w-12 object-cover">
                                        @else
                                            <div class="h-12 w-12 flex items-center justify-center text-gray-400">
                                                <i data-lucide="image" class="w-6 h-6"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900">{{ $mosque->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600 line-clamp-2 max-w-md">{{ $mosque->address }}</div>
                                <div class="mt-1 flex items-center text-xs text-brand-emerald-600">
                                    <i data-lucide="map-pin" class="w-3 h-3 mr-1"></i>
                                    {{ $mosque->latitude }}, {{ $mosque->longitude }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('organizer.mosque.edit', $mosque->id) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm font-medium rounded-md text-brand-ink bg-white hover:bg-gray-50 transition" title="Edit">
                                    <i data-lucide="edit" class="w-4 h-4 sm:mr-1.5"></i>
                                    <span class="hidden sm:inline">Edit</span>
                                </a>
                                <form action="{{ route('organizer.mosque.destroy', $mosque->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data masjid ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-brand-danger text-sm font-medium rounded-md text-white bg-brand-danger hover:bg-red-700 transition" title="Hapus">
                                        <i data-lucide="trash-2" class="w-4 h-4 sm:mr-1.5"></i>
                                        <span class="hidden sm:inline">Hapus</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <i data-lucide="map-pin" class="w-12 h-12 text-gray-300 mb-3"></i>
                                    <p class="text-base font-medium text-gray-900">Belum ada data masjid</p>
                                    <p class="text-sm">Klik tombol Tambah Masjid untuk mendaftarkan lokasi kajian Anda.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-organizer-layout>
