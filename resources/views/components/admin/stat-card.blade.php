@props([
    'label' => '',
    'value' => 0,
    'icon' => 'activity',
    'variant' => 'default',
    'href' => null,
])

@php
$iconStyles = match($variant) {
    'warning' => 'bg-brand-gold-soft text-brand-gold-text',
    'danger'  => 'bg-brand-danger-soft text-brand-danger-text',
    default   => 'bg-brand-emerald-100 text-brand-emerald-900',
};
$tag = $href ? 'a' : 'div';
@endphp

<{{ $tag }} @if($href) href="{{ $href }}" @endif class="p-5 bg-white border border-brand-border-card rounded-xl block {{ $href ? 'hover:shadow-md hover:scale-[1.01] transition-all duration-200 cursor-pointer hover:border-brand-emerald-900' : '' }}">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-brand-ink-soft">{{ $label }}</p>
            <p class="text-2xl font-bold text-brand-ink mt-1">{{ $value }}</p>
        </div>
        <div class="p-2.5 {{ $iconStyles }} rounded-lg">
            <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
        </div>
    </div>
</{{ $tag }}>
