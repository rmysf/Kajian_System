@props([
    'disabled' => false,
    'label' => null,
    'required' => false,
    'hint' => null,
    'error' => null,
])

@if($label)
    <label for="{{ $attributes->get('id') }}" class="block text-sm font-medium text-brand-ink mb-1">
        {{ $label }} @if($required)<span class="text-brand-danger">*</span>@endif
    </label>
@endif

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'w-full rounded-lg border-brand-border-light shadow-sm focus:border-brand-emerald-900 focus:ring-brand-emerald-900 text-sm py-2.5 px-4 disabled:bg-gray-50 disabled:text-gray-500'
]) !!}>
    {{ $slot }}
</select>

@if($hint)
    <p class="text-xs text-brand-ink-soft mt-1">{{ $hint }}</p>
@endif
@if($error)
    <p class="text-xs text-brand-danger mt-1">{{ $error }}</p>
@endif
