@props([
    'label' => '',
    'value' => 0,
    'icon' => 'activity',
    'variant' => 'default',
])

@php
$iconStyles = match($variant) {
    'warning' => 'bg-brand-gold-soft text-brand-gold-text',
    'danger'  => 'bg-brand-danger-soft text-brand-danger-text',
    default   => 'bg-brand-emerald-100 text-brand-emerald-900',
};
@endphp

<div class="p-5 bg-white border border-brand-border-card rounded-xl">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-brand-ink-soft">{{ $label }}</p>
            <p class="text-2xl font-bold text-brand-ink mt-1">{{ $value }}</p>
        </div>
        <div class="p-2.5 {{ $iconStyles }} rounded-lg">
            <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
        </div>
    </div>
</div>
