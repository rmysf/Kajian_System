{{-- 
    Komponen KPI Card — Dashboard
    Props: $label (string), $value (int/string), $icon (lucide icon name), $color ('emerald'|'gold'|'ink')
    Usage: <x-kpi-card label="Kajian Aktif" :value="$kajianAktif" icon="book-open" color="emerald" />
--}}
@props(['label', 'value', 'icon', 'color' => 'emerald', 'suffix' => ''])

@php
$colorMap = [
    'emerald' => ['icon_bg' => 'bg-[var(--emerald-100)]', 'icon_text' => 'text-[var(--emerald-700)]'],
    'gold'    => ['icon_bg' => 'bg-[var(--gold-soft)]',   'icon_text' => 'text-[var(--gold-text)]'],
    'ink'     => ['icon_bg' => 'bg-[var(--border-light)]','icon_text' => 'text-[var(--ink-soft)]'],
    'danger'  => ['icon_bg' => 'bg-[var(--danger-soft)]', 'icon_text' => 'text-[var(--danger-text)]'],
];
$c = $colorMap[$color] ?? $colorMap['emerald'];
@endphp

<div class="bg-white rounded-2xl border border-[var(--border-card)] p-5 flex items-center gap-4 shadow-sm">
    <div class="flex-shrink-0 w-12 h-12 rounded-xl {{ $c['icon_bg'] }} {{ $c['icon_text'] }} flex items-center justify-center">
        <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
    </div>
    <div class="min-w-0">
        <p class="text-[11px] font-semibold text-[var(--ink-soft)] uppercase tracking-wide leading-none mb-1">{{ $label }}</p>
        <p class="text-3xl font-bold text-[var(--ink)] leading-tight tabular-nums">{{ number_format($value) }}{{ $suffix }}</p>
    </div>
</div>
