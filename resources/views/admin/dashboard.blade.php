<x-admin-layout>
    <x-slot name="header">Dashboard Admin</x-slot>

    {{-- KPI Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <x-kpi-card label="Total Kajian"     :value="$totalKajian"    icon="book-open"  color="emerald" />
        <x-kpi-card label="Kajian Hari Ini"  :value="$kajianHariIni"  icon="calendar"   color="gold" />
        <x-kpi-card label="Total Pengguna"   :value="$totalUser"      icon="users"      color="ink" />
        <x-kpi-card label="Total Organizer"  :value="$totalOrganizer" icon="briefcase"  color="emerald" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        {{-- Organizer Pending Verifikasi --}}
        <div class="bg-white rounded-2xl border border-[var(--border-card)] shadow-sm">
            <div class="flex items-center justify-between px-5 py-4 border-b border-[var(--border-light)]">
                <h2 class="text-sm font-semibold text-[var(--ink)]">Organizer Menunggu Verifikasi</h2>
                <a href="{{ route('admin.organizer.index') }}" class="text-xs font-semibold text-[var(--emerald-600)] hover:text-[var(--emerald-900)] flex items-center gap-1">
                    Kelola <i data-lucide="chevron-right" class="w-3 h-3"></i>
                </a>
            </div>
            @php
                $pendingOrganizers = \App\Models\Organizer::with('user')->where('is_verified', false)->latest()->take(5)->get();
            @endphp
            @forelse($pendingOrganizers as $org)
            <div class="flex items-center gap-3 px-5 py-3.5 border-b border-[var(--border-light)] last:border-0 hover:bg-[var(--cream)] transition-colors">
                <div class="w-9 h-9 rounded-full bg-[var(--cream)] border border-[var(--border-light)] flex items-center justify-center text-sm font-bold text-[var(--ink-soft)] flex-shrink-0">
                    {{ strtoupper(substr($org->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-[var(--ink)] truncate">{{ $org->name }}</p>
                    <p class="text-xs text-[var(--ink-soft)]">{{ $org->user?->email }}</p>
                </div>
                <x-status-badge status="unverified" />
            </div>
            @empty
            <div class="flex flex-col items-center justify-center py-10 text-center">
                <div class="w-10 h-10 rounded-2xl bg-[var(--cream)] flex items-center justify-center text-[var(--nav-inactive)] mb-2">
                    <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                </div>
                <p class="text-sm text-[var(--ink-soft)]">Tidak ada organizer yang menunggu verifikasi.</p>
            </div>
            @endforelse
        </div>

        {{-- Kajian Terbaru --}}
        <div class="bg-white rounded-2xl border border-[var(--border-card)] shadow-sm">
            <div class="flex items-center justify-between px-5 py-4 border-b border-[var(--border-light)]">
                <h2 class="text-sm font-semibold text-[var(--ink)]">Kajian Terbaru</h2>
                <a href="{{ route('admin.kajian.index') }}" class="text-xs font-semibold text-[var(--emerald-600)] hover:text-[var(--emerald-900)] flex items-center gap-1">
                    Kelola <i data-lucide="chevron-right" class="w-3 h-3"></i>
                </a>
            </div>
            @php
                $recentKajians = \App\Models\Kajian::with('organizer')->latest()->take(5)->get();
            @endphp
            @forelse($recentKajians as $kajian)
            @php
                $now = now();
                if ($kajian->status === 'cancelled') $bs = 'cancelled';
                elseif ($kajian->end_at && $now > $kajian->end_at) $bs = 'done';
                elseif ($kajian->start_at && $now >= $kajian->start_at && $kajian->end_at && $now <= $kajian->end_at) $bs = 'ongoing';
                else $bs = $kajian->status;
            @endphp
            <div class="flex items-center gap-3 px-5 py-3.5 border-b border-[var(--border-light)] last:border-0 hover:bg-[var(--cream)] transition-colors">
                <div class="w-9 h-9 rounded-xl bg-[var(--emerald-100)] flex-shrink-0 flex items-center justify-center text-[var(--emerald-700)]">
                    <i data-lucide="book-open" class="w-4 h-4"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-[var(--ink)] truncate">{{ $kajian->title }}</p>
                    <p class="text-xs text-[var(--ink-soft)]">{{ $kajian->organizer?->name ?? '—' }}</p>
                </div>
                <x-status-badge :status="$bs" />
            </div>
            @empty
            <div class="flex flex-col items-center justify-center py-10">
                <p class="text-sm text-[var(--ink-soft)]">Belum ada kajian.</p>
            </div>
            @endforelse
        </div>
    </div>
</x-admin-layout>
