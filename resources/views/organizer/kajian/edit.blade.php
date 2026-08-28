<x-organizer-layout>
    <x-slot name="header">Edit Kajian</x-slot>

    <div class="max-w-5xl">
        <div class="flex items-center gap-3 mb-5">
            <a href="{{ route('organizer.kajian.index') }}" class="p-2 rounded-xl text-[var(--ink-soft)] hover:bg-white hover:text-[var(--ink)] border border-transparent hover:border-[var(--border-light)] transition-all">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <div>
                <h2 class="text-xl font-bold text-[var(--ink)]">Edit Kajian</h2>
                <p class="text-sm text-[var(--ink-soft)] truncate max-w-lg">{{ $kajian->title }}</p>
            </div>
        </div>

        @include('organizer.kajian._form', ['kajian' => $kajian, 'categories' => $categories, 'mosques' => $mosques, 'speakers' => $speakers])
    </div>
</x-organizer-layout>
