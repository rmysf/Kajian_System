<x-admin-layout>
    <x-slot name="header">Data Master: Masjid</x-slot>

    <div x-data="{ deleteId: null, deleteName: '' }">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-5">
            <div>
                <h2 class="text-xl font-bold text-[var(--ink)]">Masjid / Lokasi Kajian</h2>
                <p class="text-sm text-[var(--ink-soft)] mt-0.5">Kelola tempat penyelenggaraan kajian.</p>
            </div>
        </div>

        @php $mosques = \App\Models\Mosque::with('organizer')->latest()->paginate(20); @endphp

        <div class="bg-white rounded-2xl border border-[var(--border-card)] shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-[var(--border-light)]">
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)]">Nama Masjid</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)] hidden md:table-cell">Organizer</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)] hidden lg:table-cell">Alamat</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)] text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--border-light)]">
                        @forelse($mosques as $mosque)
                        <tr class="hover:bg-[var(--cream)] transition-colors">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-[var(--emerald-100)] flex-shrink-0 overflow-hidden">
                                        @if($mosque->photo)
                                            <img src="{{ Storage::url($mosque->photo) }}" class="w-full h-full object-cover" alt="">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[var(--emerald-700)]">
                                                <i data-lucide="map-pin" class="w-4 h-4"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="text-sm font-semibold text-[var(--ink)]">{{ $mosque->name }}</p>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-sm text-[var(--ink-soft)] hidden md:table-cell">{{ $mosque->organizer?->name ?? '—' }}</td>
                            <td class="px-5 py-4 text-sm text-[var(--ink-soft)] hidden lg:table-cell max-w-xs truncate">{{ $mosque->address }}</td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    @if($mosque->google_maps_url)
                                    <a href="{{ $mosque->google_maps_url }}" target="_blank" rel="noopener"
                                       class="p-2 rounded-lg text-[var(--ink-soft)] hover:bg-[var(--border-light)] hover:text-[var(--ink)] transition-colors">
                                        <i data-lucide="map" class="w-4 h-4"></i>
                                    </a>
                                    @endif
                                    <button
                                        @click="deleteId = {{ $mosque->id }}; deleteName = '{{ addslashes($mosque->name) }}'; $dispatch('open-modal', 'delete-mosque')"
                                        class="p-2 rounded-lg text-[var(--ink-soft)] hover:bg-[var(--danger-soft)] hover:text-[var(--danger)] transition-colors">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-5 py-12 text-center text-sm text-[var(--ink-soft)]">Belum ada data masjid.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($mosques->hasPages())
            <div class="px-5 py-4 border-t border-[var(--border-light)]">{{ $mosques->links() }}</div>
            @endif
        </div>

        <x-modal name="delete-mosque" title="Hapus Masjid?">
            <p class="text-sm text-[var(--ink-soft)] mb-1">Anda akan menghapus:</p>
            <p class="text-sm font-semibold text-[var(--ink)] mb-4" x-text="deleteName"></p>
            <p class="text-sm text-[var(--ink-soft)]">Kajian yang menggunakan masjid ini mungkin akan terdampak.</p>
            <x-slot name="footer">
                <button @click="$dispatch('close-modal', 'delete-mosque')"
                        class="px-4 py-2 text-sm font-medium rounded-xl border border-[var(--border-light)] text-[var(--ink-soft)] hover:bg-[var(--cream)] transition-colors">
                    Batal
                </button>
                <form :action="`{{ url('admin/mosque') }}/${deleteId}`" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-sm font-semibold rounded-xl bg-[var(--danger)] text-white hover:opacity-90 transition-opacity">
                        Ya, Hapus
                    </button>
                </form>
            </x-slot>
        </x-modal>
    </div>
</x-admin-layout>
