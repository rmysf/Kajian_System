@props(['category'])

<a href="{{ url('/kajian?category=' . $category->slug) }}" class="flex-none px-4 py-2 bg-white text-brand-ink-soft rounded-full text-sm font-medium border border-brand-border-card shadow-[0_1px_2px_0_rgba(0,0,0,0.02)] hover:bg-brand-emerald-50 hover:text-brand-emerald-900 transition whitespace-nowrap">
    {{ $category->name }}
</a>
