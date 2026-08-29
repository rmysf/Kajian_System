@props([
    'variant' => 'primary',
    'size' => 'default',
    'type' => 'button',
    'href' => null,
    'disabled' => false,
])

@php
$base = 'inline-flex items-center justify-center font-semibold rounded-lg transition focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

$sizes = [
    'default' => 'px-4 py-2 text-sm',
    'sm'      => 'px-3 py-1.5 text-xs',
];

$variants = [
    'primary'   => 'bg-brand-emerald-900 text-white border border-transparent hover:bg-brand-emerald-950 focus:ring-brand-emerald-900 shadow-sm',
    'secondary' => 'bg-white text-brand-emerald-900 border border-brand-emerald-900 hover:bg-brand-emerald-100 focus:ring-brand-emerald-900',
    'danger'    => 'bg-brand-danger text-white border border-transparent hover:opacity-90 focus:ring-brand-danger shadow-sm',
    'ghost'     => 'bg-transparent text-brand-ink-soft border border-transparent hover:bg-brand-border-card focus:ring-brand-emerald-900',
];

$classes = $base . ' ' . ($sizes[$size] ?? $sizes['default']) . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes, 'disabled' => $disabled]) }}>
        {{ $slot }}
    </button>
@endif
