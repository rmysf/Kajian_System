<x-admin-layout>
    <x-slot name="header">Moderasi: Kajian</x-slot>

    <div x-data="{ deleteId: null, deleteSlug: null }">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-5">
            <div>
                <h2 class="text-xl font-bold text-[var(--ink)]">Semua Kajian</h2>
                <p class="text-sm text-[var(--ink-soft)] mt-0.5">Tinjau dan moderasi seluruh kajian di platform.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-[var(--border-card)] shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-[var(--border-light)]">
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)]">Kajian</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)] hidden md:table-cell">Organizer</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)] hidden lg:table-cell">Tanggal</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)]">Status</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)] text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--border-light)]">
                        @php $allKajians = \App\Models\Kajian::with(['organizer', 'speaker'])->latest()->paginate(20); @endphp
                        @forelse($allKajians as $kajian)
                        @php
                            $now = now();
                            if ($kajian->status === 'cancelled') $bs = 'cancelled';
                            elseif ($kajian->end_at && $now > $kajian->end_at) $bs = 'done';
                            elseif ($kajian->start_at && $now >= $kajian->start_at && $kajian->end_at && $now <= $kajian->end_at) $bs = 'ongoing';
                            else $bs = $kajian->status;
                        @endphp
                        <tr class="hover:bg-[var(--cream)] transition-colors">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-[var(--emerald-100)] flex-shrink-0 overflow-hidden">
                                        @if($kajian->poster)
                                            <img src="{{ Storage::url($kajian->poster) }}" class="w-full h-full object-cover" alt="">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[var(--emerald-700)]">
                                                <i data-lucide="book-open" class="w-4 h-4"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-[var(--ink)] truncate max-w-[200px]">{{ $kajian->title }}</p>
                                        <p class="text-xs text-[var(--ink-soft)]">{{ $kajian->speaker?->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-sm text-[var(--ink-soft)] hidden md:table-cell">{{ $kajian->organizer?->name }}</td>
                            <td class="px-5 py-4 text-sm text-[var(--ink-soft)] hidden lg:table-cell">{{ $kajian->start_at?->format('d M Y') }}</td>
                            <td class="px-5 py-4"><x-status-badge :status="$bs" /></td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button
                                        @click="deleteId = {{ $kajian->id }}; deleteSlug = '{{ $kajian->slug }}'; $dispatch('open-modal', 'delete-admin-kajian')"
                                        class="p-2 rounded-lg text-[var(--ink-soft)] hover:bg-[var(--danger-soft)] hover:text-[var(--danger)] transition-colors">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="px-5 py-12 text-center text-sm text-[var(--ink-soft)]">Belum ada kajian.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($allKajians->hasPages())
            <div class="px-5 py-4 border-t border-[var(--border-light)]">{{ $allKajians->links() }}</div>
            @endif
        </div>

        <x-modal name="delete-admin-kajian" title="Hapus Kajian?">
            <p class="text-sm text-[var(--ink-soft)]">Hapus kajian ini dari seluruh platform? Tindakan ini tidak dapat dibatalkan.</p>
            <x-slot name="footer">
                <button @click="$dispatch('close-modal', 'delete-admin-kajian')"
                        class="px-4 py-2 text-sm font-medium rounded-xl border border-[var(--border-light)] text-[var(--ink-soft)] hover:bg-[var(--cream)] transition-colors">
                    Batal
                </button>
                <form :action="`{{ url('admin/kajian') }}/${deleteSlug}`" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-sm font-semibold rounded-xl bg-[var(--danger)] text-white hover:opacity-90 transition-opacity">
                        Ya, Hapus
                    </button>
                </form>
            </x-slot>
        </x-modal>
    </div>
</x-admin-layout>
