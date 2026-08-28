<x-admin-layout>
    <x-slot name="header">{{ isset($organizers) ? 'Moderasi: Penyelenggara' : 'Moderasi: Kajian' }}</x-slot>

    <div x-data="{ verifyId: null, verifyName: '', verifyStatus: false }">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-5">
            <div>
                <h2 class="text-xl font-bold text-[var(--ink)]">Penyelenggara (Organizer)</h2>
                <p class="text-sm text-[var(--ink-soft)] mt-0.5">Verifikasi dan kelola lembaga penyelenggara kajian.</p>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-2xl border border-[var(--border-card)] shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-[var(--border-light)]">
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)]">Lembaga</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)] hidden md:table-cell">Kontak</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)] hidden lg:table-cell">Bergabung</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)]">Status</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)] text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--border-light)]">
                        @forelse($organizers as $org)
                        <tr class="hover:bg-[var(--cream)] transition-colors">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-[var(--gold-soft)] flex-shrink-0 flex items-center justify-center text-[var(--gold-text)] font-bold text-sm">
                                        {{ strtoupper(substr($org->name, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-[var(--ink)] truncate">{{ $org->name }}</p>
                                        <p class="text-xs text-[var(--ink-soft)] truncate">{{ $org->address }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-sm text-[var(--ink-soft)] hidden md:table-cell">
                                {{ $org->user?->email ?? '—' }}
                            </td>
                            <td class="px-5 py-4 text-sm text-[var(--ink-soft)] hidden lg:table-cell">
                                {{ $org->created_at?->format('d M Y') }}
                            </td>
                            <td class="px-5 py-4">
                                <x-status-badge :status="$org->is_verified ? 'verified' : 'unverified'" />
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end">
                                    <form action="{{ route('admin.organizer.verify', $org->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-xl transition-colors
                                                    {{ $org->is_verified
                                                        ? 'border border-[var(--border-light)] text-[var(--ink-soft)] hover:bg-[var(--danger-soft)] hover:text-[var(--danger)] hover:border-[var(--danger-soft)]'
                                                        : 'bg-[var(--gold-soft)] text-[var(--gold-text)] hover:bg-[var(--gold)] hover:text-white' }}">
                                            @if($org->is_verified)
                                                <i data-lucide="x" class="w-3.5 h-3.5"></i> Cabut Verifikasi
                                            @else
                                                <i data-lucide="badge-check" class="w-3.5 h-3.5"></i> Verifikasi
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center text-sm text-[var(--ink-soft)]">
                                Belum ada data penyelenggara.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($organizers, 'links') && $organizers->hasPages())
            <div class="px-5 py-4 border-t border-[var(--border-light)]">
                {{ $organizers->links() }}
            </div>
            @endif
        </div>
    </div>
</x-admin-layout>
