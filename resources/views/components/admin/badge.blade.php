@props([
    'variant' => 'neutral',
])

@php
$styles = match($variant) {
    'success' => 'bg-brand-emerald-100 text-brand-emerald-900',
    'warning' => 'bg-brand-gold-soft text-brand-gold-text',
    'danger'  => 'bg-brand-danger-soft text-brand-danger-text',
    'live'    => 'bg-brand-badge-live text-white',
    default   => 'bg-gray-100 text-brand-ink',
};
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold $styles"]) }}>
    {{ $slot }}
</span>
