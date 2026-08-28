<x-organizer-layout>
    <x-slot name="header">Kelola Kajian</x-slot>

    <div x-data="{ deleteId: null, deleteTitle: '' }">
        {{-- Header bar --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-5">
            <div>
                <h2 class="text-xl font-bold text-[var(--ink)]">Daftar Kajian</h2>
                <p class="text-sm text-[var(--ink-soft)] mt-0.5">Kelola semua kajian yang Anda selenggarakan.</p>
            </div>
            <a href="{{ route('organizer.kajian.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold bg-[var(--emerald-900)] text-white hover:bg-[var(--emerald-950)] transition-colors shadow-sm">
                <i data-lucide="plus" class="w-4 h-4"></i> Tambah Kajian
            </a>
        </div>

        {{-- Filter bar --}}
        <form method="GET" action="{{ route('organizer.kajian.index') }}" class="flex flex-wrap gap-3 mb-5">
            <select name="status" onchange="this.form.submit()" class="text-sm rounded-xl border border-[var(--border-light)] bg-white px-3 py-2 text-[var(--ink)] focus:outline-none focus:ring-2 focus:ring-[var(--emerald-500)]">
                <option value="">Semua Status</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Publikasi</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </form>

        {{-- Table --}}
        <div class="bg-white rounded-2xl border border-[var(--border-card)] shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-[var(--border-light)]">
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)]">Kajian</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)] hidden md:table-cell">Lokasi</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)] hidden lg:table-cell">Kuota</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)]">Status</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)] text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--border-light)]">
                        @forelse($kajians as $kajian)
                        @php
                            $now = now();
                            if ($kajian->status === 'cancelled') $badgeStatus = 'cancelled';
                            elseif ($kajian->end_at && $now > $kajian->end_at) $badgeStatus = 'done';
                            elseif ($kajian->start_at && $now >= $kajian->start_at && $kajian->end_at && $now <= $kajian->end_at) $badgeStatus = 'ongoing';
                            else $badgeStatus = $kajian->status;

                            $attendeeCount = $kajian->attendees_count ?? $kajian->attendees()->count();
                        @endphp
                        <tr class="hover:bg-[var(--cream)] transition-colors group">
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
                                        <p class="text-sm font-semibold text-[var(--ink)] truncate max-w-[220px]">{{ $kajian->title }}</p>
                                        <p class="text-xs text-[var(--ink-soft)]">{{ $kajian->start_at?->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-sm text-[var(--ink-soft)] hidden md:table-cell">
                                {{ $kajian->mosque?->name ?? '—' }}
                            </td>
                            <td class="px-5 py-4 text-sm text-[var(--ink-soft)] hidden lg:table-cell">
                                @if($kajian->quota)
                                    <span class="font-semibold text-[var(--ink)]">{{ $attendeeCount }}</span> / {{ $kajian->quota }}
                                @else
                                    <span class="italic">Tidak terbatas</span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <x-status-badge :status="$badgeStatus" />
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('organizer.kajian.edit', $kajian) }}"
                                       class="p-2 rounded-lg text-[var(--ink-soft)] hover:bg-[var(--border-light)] hover:text-[var(--ink)] transition-colors"
                                       title="Edit">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>
                                    <button
                                        @click="deleteId = '{{ $kajian->slug }}'; deleteTitle = '{{ addslashes($kajian->title) }}'; $dispatch('open-modal', 'delete-kajian')"
                                        class="p-2 rounded-lg text-[var(--ink-soft)] hover:bg-[var(--danger-soft)] hover:text-[var(--danger)] transition-colors"
                                        title="Hapus">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-12 h-12 rounded-2xl bg-[var(--cream)] flex items-center justify-center text-[var(--nav-inactive)]">
                                        <i data-lucide="calendar-x" class="w-6 h-6"></i>
                                    </div>
                                    <p class="text-sm text-[var(--ink-soft)] font-medium">Belum ada kajian</p>
                                    <a href="{{ route('organizer.kajian.create') }}" class="text-xs font-semibold text-[var(--emerald-600)] hover:underline">Buat sekarang →</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($kajians, 'links') && $kajians->hasPages())
            <div class="px-5 py-4 border-t border-[var(--border-light)]">
                {{ $kajians->links() }}
            </div>
            @endif
        </div>

        {{-- Delete Modal --}}
        <x-modal name="delete-kajian" title="Hapus Kajian?">
            <p class="text-sm text-[var(--ink-soft)] mb-1">Anda akan menghapus kajian:</p>
            <p class="text-sm font-semibold text-[var(--ink)] mb-4" x-text="deleteTitle"></p>
            <p class="text-sm text-[var(--ink-soft)]">Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data peserta terkait.</p>

            <x-slot name="footer">
                <button @click="$dispatch('close-modal', 'delete-kajian')"
                        class="px-4 py-2 text-sm font-medium rounded-xl border border-[var(--border-light)] text-[var(--ink-soft)] hover:bg-[var(--cream)] transition-colors">
                    Batal
                </button>
                <form method="POST" :action="`{{ url('organizer/kajian') }}/${deleteId}`" x-ref="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 text-sm font-semibold rounded-xl bg-[var(--danger)] text-white hover:opacity-90 transition-opacity">
                        Ya, Hapus
                    </button>
                </form>
            </x-slot>
        </x-modal>
    </div>
</x-organizer-layout>
