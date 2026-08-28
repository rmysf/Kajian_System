<x-organizer-layout>
    <x-slot name="header">Dashboard Organizer</x-slot>

    {{-- KPI Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <x-kpi-card label="Kajian Aktif"     :value="$kajianAktif"    icon="radio"       color="emerald" />
        <x-kpi-card label="Kajian Bulan Ini" :value="$kajianBulanIni" icon="calendar"    color="ink" />
        <x-kpi-card label="Calon Peserta"    :value="$calonPeserta"   icon="user-plus"   color="gold" />
        <x-kpi-card label="Peserta Hadir"    :value="$pesertaHadir"   icon="user-check"  color="emerald" />
    </div>

    {{-- Recent Kajian --}}
    <div class="bg-white rounded-2xl border border-[var(--border-card)] shadow-sm">
        <div class="flex items-center justify-between px-5 py-4 border-b border-[var(--border-light)]">
            <h2 class="text-sm font-semibold text-[var(--ink)]">Kajian Terbaru</h2>
            <a href="{{ route('organizer.kajian.index') }}" class="text-xs font-semibold text-[var(--emerald-600)] hover:text-[var(--emerald-900)] flex items-center gap-1">
                Lihat Semua <i data-lucide="chevron-right" class="w-3 h-3"></i>
            </a>
        </div>

        @php
            $recentKajians = \App\Models\Kajian::where('organizer_id', auth()->user()->organizer?->id)
                ->with(['mosque', 'speaker'])
                ->latest()
                ->take(5)
                ->get();
        @endphp

        @forelse($recentKajians as $kajian)
        <div class="flex items-center gap-4 px-5 py-3.5 border-b border-[var(--border-light)] last:border-0 hover:bg-[var(--cream)] transition-colors">
            {{-- Poster --}}
            <div class="w-10 h-10 rounded-xl bg-[var(--emerald-100)] flex-shrink-0 overflow-hidden">
                @if($kajian->poster)
                    <img src="{{ Storage::url($kajian->poster) }}" alt="" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-[var(--emerald-700)]">
                        <i data-lucide="book-open" class="w-4 h-4"></i>
                    </div>
                @endif
            </div>
            {{-- Info --}}
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-[var(--ink)] truncate">{{ $kajian->title }}</p>
                <p class="text-xs text-[var(--ink-soft)] truncate">
                    {{ $kajian->start_at?->format('d M Y, H:i') }} · {{ $kajian->mosque?->name ?? '—' }}
                </p>
            </div>
            {{-- Status --}}
            @php
                $now = now();
                if ($kajian->status === 'cancelled') $s = 'cancelled';
                elseif ($kajian->end_at && $now > $kajian->end_at) $s = 'done';
                elseif ($kajian->start_at && $now >= $kajian->start_at && $kajian->end_at && $now <= $kajian->end_at) $s = 'ongoing';
                else $s = $kajian->status;
            @endphp
            <x-status-badge :status="$s" />
            {{-- Action --}}
            <a href="{{ route('organizer.kajian.edit', $kajian) }}" class="flex-shrink-0 p-1.5 rounded-lg text-[var(--ink-soft)] hover:bg-[var(--border-light)] hover:text-[var(--ink)]">
                <i data-lucide="edit-3" class="w-4 h-4"></i>
            </a>
        </div>
        @empty
        <div class="flex flex-col items-center justify-center py-12 text-center">
            <div class="w-12 h-12 rounded-2xl bg-[var(--cream)] flex items-center justify-center text-[var(--nav-inactive)] mb-3">
                <i data-lucide="calendar-plus" class="w-6 h-6"></i>
            </div>
            <p class="text-sm font-medium text-[var(--ink-soft)] mb-4">Belum ada kajian. Mulai buat sekarang!</p>
            <a href="{{ route('organizer.kajian.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-[var(--emerald-900)] text-white hover:bg-[var(--emerald-950)] transition-colors">
                <i data-lucide="plus" class="w-4 h-4"></i> Buat Kajian Pertama
            </a>
        </div>
        @endforelse
    </div>
</x-organizer-layout>
